<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Devices;

use App\Models\DevicePorts;

use App\Models\PortData;

use phpseclib\Net\SSH2;

use Log;

use App\Helpers\Helper;

class getportstats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'monitoring:portstats {device : The ID of the Device to get port Stats for}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gets and Stores Stats for all of a Devices ports';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
         $deviceid = $this->argument('device');
         
         $device = Devices::where('id', $deviceid)->with('SSH_Credentials.IP')->firstOrFail();;
         
         $ssh = new SSH2($device->SSH_Credentials->IP->address);
            if (!$ssh->login($device->SSH_Credentials->username,$device->SSH_Credentials->password)) {
                
                Log::error('SSH Credentials Rejected ID:'.$device->SSH_Credentials->id);

                exit;
            }
         
         $portdata = $ssh->exec(" /sbin/ifconfig");
         
         $statdata = Helper::buildstats($portdata);
         
         foreach($statdata as $portdata){
             
             $port = DevicePorts::where('device_id', $deviceid)->where('name', $portdata['name'])->firstOrFail();
             
             $lastdata = PortData::where('port_id', $port['id'])->orderBy('created_at', 'desc')->first();
             
             $dataentry = PortData::create([
            'port_id' => $port['id'],
            'rx_bytes' => $portdata['rx_bytes'],
            'tx_bytes' => $portdata['tx_bytes'],
            'rx_packets' => $portdata['rx_packets'],
            'tx_packets' => $portdata['tx_packets'],
            'rx_dropped' => $portdata['rx_dropped'],
            'tx_dropped' => $portdata['tx_dropped'],
            ]);
            
            $newtime = strtotime($dataentry['created_at']);
            $oldtime = strtotime($lastdata['created_at']);
            
            $timedifference = $newtime - $oldtime;
            
            if($portdata['tx_bytes'] >= $lastdata['tx_bytes'] and $portdata['rx_bytes'] >= $lastdata['rx_bytes']){
                
                $txbytediffrence = $portdata['tx_bytes'] - $lastdata['tx_bytes'];
                $rxbytediffrence = $portdata['rx_bytes'] - $lastdata['rx_bytes'];
                
            }else{
                
                $txbytediffrence = $portdata['tx_bytes'];
                $rxbytediffrence = $portdata['rx_bytes'];
                
            }
            
            $rxrate = $rxbytediffrence / $timedifference;
            $txrate = $txbytediffrence / $timedifference;
            
            $dataupdate = PortData::find($dataentry['id']);

            $dataupdate->tx_rate = $txrate;
            $dataupdate->rx_rate = $rxrate;

            $dataupdate->save();
         }

    }
}
