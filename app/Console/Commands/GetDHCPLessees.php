<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Devices;

use App\Models\IPLeases;

use phpseclib\Net\SSH2;

use Log;

use App\Helpers\Helper;

class GetDHCPLessees extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'monitoring:DHCPleaseget {device : The ID of Device to get Severs than leases from}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gets all DHCP leases from a DHCP server';

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
        
        $device = Devices::where('id', $deviceid)->where('os', 'EdgeOS')->with('SSH_Credentials.IP','DHCP_Servers')->firstOrFail();
        
        $ssh = new SSH2($device->SSH_Credentials->IP->address);
            if (!$ssh->login($device->SSH_Credentials->username,$device->SSH_Credentials->password)) {
                
                Log::error('SSH Credentials Rejected ID:'.$device->SSH_Credentials->id);

                exit;
            }
            
        foreach($device->DHCP_Servers as $server){
            
            $name = $server['name'];
            
            $data = $ssh->exec("/opt/vyatta/bin/vyatta-op-cmd-wrapper show dhcp leases pool $name");
            
            $leases = Helper::getdhcpleases($data);
            
            foreach($leases as $lease){
                
                $dblease = IPLeases::firstOrCreate([
                    'name' => $lease['name'],
                    'mac' => $lease['mac'],
                    'ip' => $lease['ip'],
                    'static' => false,
                    'server_id' => $server['id'],
                    ]);
                    
                $dblease->expires = $lease['expires'];
                
                $dblease->save();
            }
            
        }
    }
}
