<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Models\DeviceIPs;

use App\Models\SSHCredentials;

class NewSSH extends Event
{
    use SerializesModels;
    
    
    public $SSHCredentials;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($SSHCredentials)
    {
        $this->address = $SSHCredentials;
    }

}
