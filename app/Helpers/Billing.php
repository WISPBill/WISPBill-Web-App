<?php 
namespace App\Helpers;

use App\Models\Settings;

use App\Models\Customer_info;

use Illuminate\Http\Request;

class Billing
{
    public static function displayform() { 
    	$service = 'Stripe'; // Placeholder
    	
    	if($service == 'Stripe'){
    		
    		$stripekey = Settings::where('setting_name', 'stripe publishable key')->first();
    		$stripekey = $stripekey['setting_value'];
    		
    		echo '<script
    		src="https://checkout.stripe.com/checkout.js" class="stripe-button"';
    		
    		echo"
    		data-key='$stripekey';";
    		
    		echo 'data-allow-remember-me="false"
          data-zip-code="true"
          data-label="Add Billing Info"
          data-panel-label="Submit Info"
          data-description="Enter Billing Info"
          data-billing-address="true">
 					 </script>';
          
    	}else{
    		// Do Nothing
    	}
    	
    }
    
    public static function createcustomer($id,$request) { 
    	$service = 'Stripe'; // Placeholder
    	
    	if($service == 'Stripe'){
    		
    		$stripekey = Settings::where('setting_name', 'stripe secret key')->first();
    		$stripekey = $stripekey['setting_value'];
    		
    		$customer = Customer_info::find($id);
    		
    		\Stripe\Stripe::setApiKey("$stripekey");
    		
    		$stripe = \Stripe\Customer::create(array(
  			"description" => $customer['name'],
  			"source" => $request['stripeToken'],
  			"email" => $customer['email'],
				));
				
				$stripedid = $stripe['id'];
    		
        return($stripedid);  
          
    	}else{
    		// Do Nothing
    	}
    	
    }
    
    public static function createplan($price,$interval,$name,$id) { 
    	$service = 'Stripe'; // Placeholder
    	
    	if($service == 'Stripe'){
    		
    		$price = $price *100;
    		
    		$stripekey = Settings::where('setting_name', 'stripe secret key')->first();
    		$stripekey = $stripekey['setting_value'];
    		
    		\Stripe\Stripe::setApiKey("$stripekey");
    		
    		\Stripe\Plan::create(array(
              "amount" => $price,
              "interval" => $interval,
              "name" => $name,
              "currency" => "usd",
              "id" => $id)
            );

    	}else{
    		// Do Nothing
    	}
    	
    }
	
	public static function subscribeusertoplan($userid,$planid) { 
    	$service = 'Stripe'; // Placeholder
    	
    	if($service == 'Stripe'){
    		
    		$stripekey = Settings::where('setting_name', 'stripe secret key')->first();
    		$stripekey = $stripekey['setting_value'];
    		
    		\Stripe\Stripe::setApiKey("$stripekey");
				
				$customer = Customer_info::findorfail($userid);
				
				$stripeid = $customer->billing_id;
				
				\Stripe\Subscription::create(array(
  				"customer" => "$stripeid",
 			 		"plan" => "$planid"
				));
          
    	}else{
    		// Do Nothing
    	}
    	
    }

}

?>