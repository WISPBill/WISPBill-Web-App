<?php 
namespace App\Helpers;

use App\Models\Settings;

use Illuminate\Http\Request;

use mysqli;

use Crypt;

use App\Models\Plans;

use App\Models\Customer_info;

class Radius
{
    
     protected static function buildconnection()
    {
        $radiususername = Settings::where('setting_name', 'Radius Username')->firstOrFail();
        $radiususername = $radiususername['setting_value'];
            
        $radiuspassword= Settings::where('setting_name', 'Radius Password')->firstOrFail();
        $radiuspassword = $radiuspassword['setting_value'];
        $radiuspassword = Crypt::decrypt($radiuspassword);
            
        $radiusport = Settings::where('setting_name', 'Radius Port')->firstOrFail();
        $radiusport = $radiusport['setting_value'];
            
        $radiusip = Settings::where('setting_name', 'Radius IP')->firstOrFail();
        $radiusip = $radiusip['setting_value'];
          
        // Create connection
        $conn = new mysqli($radiusip, $radiususername, $radiuspassword, 'radius', $radiusport);
        // Check connection
        
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }
        
        return($conn);
    }
    
    public static function newnas($name,$ip,$type,$secret) { 
        
        $conn = Radius::buildconnection();
    	
             $sql = "INSERT INTO  nas VALUES (NULL ,  '$ip',  '$name',  '$type', NULL ,  '$secret', NULL , NULL ,  'Set By WISPBill'
            );";

        if ($conn->query($sql) === TRUE) {
            $result = true;
        } else {
            $result = false;
        }

        $conn->close();

		return $result;
    	
    }
	
	public static function createuserwithplan($id,$planid,$locid) { 
        
        $conn = Radius::buildconnection();
	
				$plan = Plans::findorfail($planid);
	
				$customer = Customer_info::findorfail($id);
	
				$email = $customer->email;
	
				$user = "$locid"."$email"."$planid";
	
				$radiuspass = substr( md5(rand()), 0, 7); // Not meant to be secure as Radius should enforce a connection limit
    	
        $sql = "INSERT INTO radcheck VALUES (NULL, '$user', 'Cleartext-Password', ':= ', '$radiuspass');";

        if ($conn->query($sql) === TRUE) {
            $result = true;
        } else {
            $result = false;
					
						return $result;
        }
	
				foreach($plan->attributes as $attribute){
					
					if($attribute['attribute_name'] == 'Download Rate in Mbps'){
                    
              $downrate = $attribute['attribute_value']*1000000;
						
						$sql = "INSERT INTO radreply VALUES (NULL, '$user', 'WISPr-Bandwidth-Max-Down', ':=', '$downrate');";

     		   if ($conn->query($sql) === TRUE) {
     		       $result = true;
    		    } else {
      		      $result = false;
					
								return $result;
        		}
                    
         	}elseif($attribute['attribute_name'] == 'Upload Rate in Mbps'){
                    
              $uprate = $attribute['attribute_value']*1000000;
						
						$sql = "INSERT INTO radreply VALUES (NULL, '$user', 'WISPr-Bandwidth-Max-Up', ':=', '$uprate');";

     		   if ($conn->query($sql) === TRUE) {
     		       $result = true;
    		    } else {
      		      $result = false;
					
								return $result;
        		}
                    
					}elseif($attribute['attribute_name'] == 'Download Data Cap in GB'){
                    
               $downcap = $attribute['attribute_value']*1000000000;
						
						$sql = "INSERT INTO radreply VALUES (NULL, '$user', 'Acct-Output-Octets', ':=', '$downcap');";

     		   if ($conn->query($sql) === TRUE) {
     		       $result = true;
    		    } else {
      		      $result = false;
					
								return $result;
        		}
                    
       	  }elseif($attribute['attribute_name'] == 'Upload Data Cap in GB'){
                    
               $upcap = $attribute['attribute_value']*1000000000;
						
						$sql = "INSERT INTO radreply VALUES (NULL, '$user', 'Acct-Input-Octets', ':=', '$upcap');";

     		   if ($conn->query($sql) === TRUE) {
     		       $result = true;
    		    } else {
      		      $result = false;
					
								return $result;
        		}
                    
                }
				}

        $conn->close();

		return $result;
    	
    }
    
    public static function getcredentials($id,$planid,$locid) { 
        
        $conn = Radius::buildconnection();
	
				$plan = Plans::findorfail($planid);
	
				$customer = Customer_info::findorfail($id);
	
				$email = $customer->email;
	
				$user = "$locid"."$email"."$planid";
	
		
    	
        $sql = "SELECT * FROM `radcheck` WHERE `username` = '$user'";
        
        $data = $conn->query($sql);
        
        if($data == false){
            return false;
        }else{
        
            while ($row = $data->fetch_assoc()) {
	
	            $result = array(
	                'username' => $user,
	                'password' => $row['value'],
	            );
	        
            }	
        }
        
        $conn->close();

		return $result;
    	
    }

}

?>