<?php

namespace App\Listeners;

use App\Events\NewIP;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\DeviceIPs;

use App\Models\SSHCredentials;

class FindSSH
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewIP  $event
     * @return void
     */
    public function handle(NewIP $event)
    {
        $address = $event->address;
        
        $ip = $address['address'];
        $addressid = $address['id'];
        
        exec("nmap -p22 $ip",$ping);
      
        $ping = implode("", $ping);
        
        if(str_contains($ping,'22/tcp open  ssh')){
            
             SSHCredentials::firstOrCreate([
            'username' => NULL,
            'password' => NULL,
            'device_IP_id' => $addressid,
            ]);
            
        }
    }
}
