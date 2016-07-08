<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Networks;

use App\Models\DeviceIPs;

class MonitoringNetworkPing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'monitoring:pingnetwork {network : The ID of the Network to Ping}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pings Network and Adds IP to Database';

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
        $networkid = $this->argument('network');
        
        $network = Networks::find($networkid);
        
        $ip = $network->ip;
        $CIDR = $network->CIDR;
        
        exec("nmap -sn $ip/$CIDR",$ping);
      
        $ping = implode("", $ping);
        
        // This will filter any non IPs from NMAP
        preg_match_all('/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/', $ping, $match);
      
        // This will make an array of ips that are up
        $upips = $match[0];
        
        foreach($upips as $ip){
            
        DeviceIPs::firstOrCreate([
            'address' => $ip,
            'network_id' => $networkid,
            ]);
            
        }
        
    }
}
