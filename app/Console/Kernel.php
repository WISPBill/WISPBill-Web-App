<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Models\Networks;

use App\Models\Devices;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\MonitoringNetworkPing::class,
        Commands\getportstats::class,
        
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            
            $networks = Networks::all();
            
            foreach($networks as $network){
                
                 $this->call('monitoring:pingnetwork', [
                'network' => $network->id
                ]);

            }
            
        })->everyFiveMinutes()->name('monitoring:pingnetwork');
        
        $schedule->call(function () {
            
            $devices = Devices::all();
            
            foreach($devices as $device){
                
                 $this->call('monitoring:portstats', [
                'device' => $device->id
                ]);

            }
            
        })->everyFiveMinutes()->name('monitoring:portstats');
        
    }
    }
