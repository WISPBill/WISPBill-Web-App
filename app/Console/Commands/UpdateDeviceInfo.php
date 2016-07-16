<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Devices;

use phpseclib\Net\SSH2;

use Log;

class UpdateDeviceInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'monitoring:updatedeviceinfo {device : The ID of the Device to get port info about}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates A Device\'s Info';

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
        
        if($device['manufacturer'] == 'UBIQUITI NETWORKS INC.'){
            
            if($device['os'] == 'AirOS' ){
                
                $data = $ssh->exec("vi /var/etc/version");
        
                if(preg_match('/([X][M]|[X][W]|[T][I]|[W][A]|[X][C])\.[v](.{1,10})/', $data,$output)){
                    $version = $output[2];
                    
                    $device->version = $version;
                    
                    $device->save();
                    
                }else{
                     Log::error('Failed to Find AirOS Version and Revsion ID:'.$device->SSH_Credentials->id);
                    exit;
                }
                
            }elseif($device['os'] == 'EdgeOS'){
                
                $data = $ssh->exec("/opt/vyatta/bin/vyatta-op-cmd-wrapper show version");
                
                if(preg_match('/\QVersion:\E\s{6}\Qv\E(.{1,10})/', $data,$version)){
                    
                    $version = $version[1];
                    
                    $device->version = $version;
                    
                    $device->save();
                    
                }else{
                    // SN not found
                     Log::error('Failed to Find EdgeOS Version ID:'.$SSHcredential['id']);
                    exit;
                }
                
            }else{
                //Nothing
            }
            
        }else{
            //Nothing
        }
    }
}
