<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Helpers\Billing;

use Event;

use App\Events\NewStripeWebhook;

class webhookcontroller extends Controller
{
    public function __construct()
    {
        // No need to Auth APIs do it themselves
    }
    
    public function verfiyhook(Request $request,$service)
    {
      
      if($service === "stripe"){
          
              $id = $request['id'];
              
              if(Billing::verfiystripeevent($id)){
                  
                  Event::fire(new NewStripeWebhook($id));
                  
                  abort(200, 'Valid Stripe Webhook Received');
                  
              }else{
                  
                  abort(400, 'Stripe Webhook dose not match Stripe Event');
                  
              }
          
      }else{
          
          abort(501, 'Service Not Supported');
          
      }
      
    }
}
