<?php 
namespace App\Helpers;

use App\Models\Settings;

use App\Models\Customer_info;

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
          data-description="Enter Billing Info">
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
  			"source" => $request['token'],
  			"email" => $customer['email'],
				));
				
				$stripedid = $stripe['id'];
    		
        return($stripedid);  
          
    	}else{
    		// Do Nothing
    	}
    	
    }

}

?>