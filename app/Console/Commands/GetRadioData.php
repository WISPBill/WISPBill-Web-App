<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Devices;

use App\Models\RadioData;

use phpseclib\Net\SSH2;

use Log;

use App\Helpers\Helper;

class GetRadioData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'monitoring:radiodata {device : The ID of the Device to get config from}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gets Radio data from AIROS radios';

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
        
        $device = Devices::where('id', $deviceid)->where('os', 'AirOS')->with('SSH_Credentials.IP')->firstOrFail();
        
        $ssh = new SSH2($device->SSH_Credentials->IP->address);
            if (!$ssh->login($device->SSH_Credentials->username,$device->SSH_Credentials->password)) {
                
                Log::error('SSH Credentials Rejected ID:'.$device->SSH_Credentials->id);

                exit;
            }
            
         $data = $ssh->exec("iwconfig");
         $data2 = $ssh->exec("mca-status");
         
         $radiodata = Helper::getAirOSstat($data, $data2);
         
          RadioData::create([
            'frequency' => $radiodata['frequency'],
            'txPower' => $radiodata['txPower'],
            'signal' => $radiodata['signal'],
            'noise' => $radiodata['noise'],
            'ccq' => $radiodata['ccq'],
            'latency' => $radiodata['latency'],
            'device_id' => $deviceid,
            ]);
    }
}
