<?php 
namespace App\Helpers;

use App\Models\Settings;

class Helper
{
    public static function geocode($place)
    {
        $service = Settings::where('setting_name', 'geocoder service')->first();
        
        if($service['setting_value'] === 'mapzen'){
            $api = Settings::where('setting_name', 'geocoder API key')->first();
            
            if(isset($api['setting_value'])){
                /* Build a URL */
                
                $api = $api['setting_value'];
                
                $place = urlencode($place);
                
                $url = "https://search.mapzen.com/v1/search?api_key=$api&text=$place&size=1";
                /* Run query using cURL */
	
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $result = curl_exec($ch);
                curl_close($ch);
                
              $result = json_decode($result, true);
              $result = $result['features']['0']['geometry']['coordinates'];
               $lon = $result['0'];
               $lat = $result['1'];
                
                $coordinates = array(
                 "lat" => "$lat",
                 "lon" => "$lon",
                );
                
                return($coordinates);
                
            }else{
                abort(500, 'Failed to find Mapzen API in DB');
            }
        }elseif($service['setting_value'] === 'census'){
	
	        $place = urlencode($place);
	        
	        $url = "http://geocoding.geo.census.gov/geocoder/locations/onelineaddress?address=$place&benchmark=9&format=json";
	        /* Run query using cURL */
	
	        $ch = curl_init();
	        curl_setopt($ch, CURLOPT_URL, $url);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	        $result = curl_exec($ch);
	        curl_close($ch);

            $geo = json_decode($result, true);
             $data= $geo["result"];
                $data2= $data["addressMatches"];
                if(empty($data2)){
                   
                    $coordinates = array(
                     "lat" => "38.0000",
                     "lon" => "-97.0000",
                    );
                
                return($coordinates);
                   
                }else{
                    // We have a Match
                    $data3= $data2["0"];
                    $data4= $data3["coordinates"];
                    $lon= $data4["x"];
                    $lat= $data4["y"];
                    
                    $coordinates = array(
                     "lat" => "$lat",
                     "lon" => "$lon",
                    );
                
                return($coordinates);
                }
        }else{
            
            abort(500, 'Failed to find Geocoding Service in DB');
        }
    }
}

?>