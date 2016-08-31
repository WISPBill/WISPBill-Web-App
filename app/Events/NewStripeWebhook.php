<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewStripeWebhook extends Event
{
    use SerializesModels;

    public $id;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
        
        $event = Billing::retrievestripeevent($id);
        
        $type = $event->type; 
        
        if($type == "invoice.payment_failed"){
            //Failed Invoice
        }elseif($type == "invoice.payment_succeeded"){
            //Successful Invoice
        }elseif($type == "invoice.created"){
            // Invoice Created
        }
    }

   
}
