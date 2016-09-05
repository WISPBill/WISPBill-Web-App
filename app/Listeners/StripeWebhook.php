<?php

namespace App\Listeners;

use App\Events\NewStripeWebhook;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Helpers\Billing;

class StripeWebhook
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
     * @param  NewStripeWebhook  $event
     * @return void
     */
    public function handle(NewStripeWebhook $event)
    {
        
        $id = $event->id;
        
        echo "fgfrg";
        
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
