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
    }
    
}
