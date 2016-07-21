<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Models\Networks;

use App\Models\Devices;

use App\Models\IPLeases;

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
        Commands\UpdateDeviceInfo::class,
        Commands\GetEdgeOSConfigDetails::class,
        Commands\GetDHCPLessees::class,
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
        
        $schedule->call(function () {
            
            $devices = Devices::all();
            
            foreach($devices as $device){
                
                 $this->call('monitoring:updatedeviceinfo', [
                'device' => $device->id
                ]);

            }
            
        })->daily()->name('monitoring:updatedeviceinfo');
        
        $schedule->call(function () {
            
            $devices = Devices::where('os', 'EdgeOS')->get();
            
            foreach($devices as $device){
                
                 $this->call('monitoring:edgeosconfig', [
                'device' => $device->id
                ]);

            }
            
        })->hourly()->name('monitoring:edgeosconfig');
        
         $schedule->call(function () {
            
            $devices = Devices::where('os', 'EdgeOS')->get();
            
            foreach($devices as $device){
                
                 $this->call('monitoring:DHCPleaseget', [
                'device' => $device->id
                ]);

            }
            
        })->everyFiveMinutes()->name('monitoring:DHCPleaseget');
        
        // DB Clean UP
        
        $schedule->call(function () {
            
            $date = new DateTime;
            $formatted_date = $date->format('Y-m-d H:i:s');
            
            IPLeases::where('expires', '<', $formatted_date)->whereNotNull('expires')->delete();
            
        })->daily();
        
    }
    }
