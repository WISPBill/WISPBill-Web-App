<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Devices;

use App\Models\DHCPServers;

use App\Models\IPLeases;

use phpseclib\Net\SSH2;

use Log;

use App\Helpers\Helper;

class GetEdgeOSConfigDetails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'monitoring:edgeosconfig {device : The ID of the Device to get config from}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pulls the Config from UBNT EdgeOS Routers and (Switches)?';

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
        
        $device = Devices::where('id', $deviceid)->where('os', 'EdgeOS')->with('SSH_Credentials.IP')->firstOrFail();
        
        $ssh = new SSH2($device->SSH_Credentials->IP->address);
            if (!$ssh->login($device->SSH_Credentials->username,$device->SSH_Credentials->password)) {
                
                Log::error('SSH Credentials Rejected ID:'.$device->SSH_Credentials->id);

                exit;
            }
            
        $data = $ssh->exec("/opt/vyatta/bin/vyatta-op-cmd-wrapper show configuration");
        
        $dhcp = Helper::dhcpserverinfo($data);
        
        if($dhcp == false){
            //Nothing 
        }else{
            
            foreach($dhcp as $server){
                
                DHCPServers::firstOrCreate([
                    'name' => $server['name'],
                    'subnet' => $server['subnet'],
                    'lease' => $server['lease'],
                    'start' => $server['start'],
                    'stop' => $server['stop'],
                    'router' => $server['router'],
                    'dns1' => $server['dns1'],
                    'dns2' => $server['dns2'],
                    'device_id' => $deviceid,
                    ]);
            }
        }
        
        $statics = Helper::getstaticmap($data);
        
        if($statics == false){
            //Nothing 
        }else{
            
            foreach($statics as $static){
                
                $server = DHCPServers::where('device_id', $deviceid)->where('name',$static['name'])->firstOrFail();
                
                IPLeases::firstOrCreate([
                    'name' => $static['mapname'],
                    'mac' => $static['mac'],
                    'ip' => $static['ip'],
                    'static' => true,
                    'server_id' => $server['id'],
                    ]);
            }
        }
    }
}
