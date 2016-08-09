<?php 
namespace App\Helpers;

use App\Models\Settings;

use Illuminate\Http\Request;

use mysqli;

use Crypt;

class Radius
{
    public static function newnas($name,$ip,$type,$secret) { 
    	
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

}

?>