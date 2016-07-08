<?php

namespace App\Events;

use App\Models\DeviceIPs;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewIP extends Event
{
    use SerializesModels;

    public $address;

    
    public function __construct($address)
    {
        $this->address = $address;
    }

}
