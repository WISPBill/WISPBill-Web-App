<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Models\Networks;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\MonitoringNetworkPing::class,
        
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
        
    }
    }
