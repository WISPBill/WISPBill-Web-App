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
        }elseif($service['setting_value'] === 'manual'){
	    
	        // This code should never run
	        
	        abort(500, 'The Geocoding System is Set to Manual');
                
        }else{
            
            abort(500, 'Failed to find Geocoding Service in DB');
        }
    }
    
    public static function portlist($data)
    {
        
        $ports = $this->buildportarray($data);
        
        $results = array();
        
        foreach($ports as $port){
                
                if(str_contains($port[0], 'Loopback') or str_contains($port[0], 'imq')){
                        //Ignores LoopBack and imq ports
                }else{
                        $name = NULL;
                        $mac = NULL;
                        $ip = NULL;
                        
                        if(preg_match('/(\S{1,})\s{1,}.{1,50}((?:[a-zA-Z0-9]{2}[:-]){5}[a-zA-Z0-9]{2})/', $port[0],$matchs)){
                        
                        $name = $matchs[1];
                        $mac = $matchs[2];
                        }
                        
                        if(preg_match('/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/', $port[1],$matchs)){
                                $ip = $matchs[0];
                        }
                       
                       $portdata  = array(
                               "name" => $name,
                               "mac" => $mac,
                               "ip" => $ip,
                               );
                               
                        array_push($results, $portdata);
                
                }
        }
        
        return($results);
    }
    
    protected static function buildportarray($data)
    {
        $data = explode("\n", $data);
        
        $offset = 0;
        
        $ports = array();
        
        foreach($data as $key=>$row){
                if(empty($row)){
                        if($offset == 0){
                        $lenght = $key - $offset;        
                        $port = array_slice($data,$offset,$lenght);
                
                        $offset = $key;
                
                        array_push($ports, $port);
                        
                        }else{
                                
                        $offset ++;
                        $lenght = $key - $offset;        
                        $port = array_slice($data,$offset,$lenght);
                
                        $offset = $key;
                                if(empty($port)){
                                
                                }else{
                                array_push($ports, $port);
                                }
                        }
                }
        }
        
        return($ports);
    }
    
}

?>