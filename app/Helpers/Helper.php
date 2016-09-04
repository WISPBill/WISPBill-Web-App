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
        
        $ports = Helper::buildportarray($data);
        
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
    
     public static function buildstats($data)
    {
        
        $ports = Helper::buildportarray($data);
        
        $results = array();
        
        foreach($ports as $port){
            
                
                if(str_contains($port[0], 'Loopback') or str_contains($port[0], 'imq')){
                        //Ignores LoopBack and imq ports
                }else{
                    
                       $port = implode("\n", $port);
             
                       if(preg_match('/\QRX packets:\E(\d{1,})\s/', $port,$matchs)){
                        
                        $rx_packets = $matchs[1];
                        
                        }
                        
                        if(preg_match('/\QTX packets:\E(\d{1,})\s/', $port,$matchs)){
                        
                        $tx_packets = $matchs[1];
                        
                        }
                        
                        if(preg_match('/\QRX bytes:\E(\d{1,})\s/', $port,$matchs)){
                        
                        $rx_bytes = $matchs[1];
                        
                        }
                        
                        if(preg_match('/\QTX bytes:\E(\d{1,})\s/', $port,$matchs)){
                        
                        $tx_bytes = $matchs[1];
                        
                        }
                        
                        if(preg_match('/\QRX packets:\E\d{1,}\s\Qerrors:\E\d{1,}\s\Qdropped:\E(\d{1,})/', $port,$matchs)){
                        
                        $rx_drop = $matchs[1];
                        
                        }
                        
                        if(preg_match('/\QTX packets:\E\d{1,}\s\Qerrors:\E\d{1,}\s\Qdropped:\E(\d{1,})/', $port,$matchs)){
                        
                        $tx_drop = $matchs[1];
                        
                        }
                        
                        if(preg_match('/(\S{1,})\s/', $port,$matchs)){
                        
                        $name = $matchs[1];
                        
                        }
                       
                       $portdata  = array(
                               "rx_packets" => $rx_packets,
                               "tx_packets" => $tx_packets,
                               "rx_bytes" => $rx_bytes,
                               "tx_bytes" => $tx_bytes,
                               "rx_dropped" => $rx_drop,
                               "tx_dropped" => $tx_drop,
                               "name" => $name,
                               );
                               
                        array_push($results, $portdata);
                
                }
        }
        
        return($results);
    }
    
    public static function dhcpserverinfo($data)
    {
       
        $servers = Helper::getdhcpserver($data);
        
        if($servers == false){
            return false;
        }
        
        $results = array();
        
        foreach($servers as $server){
                
                $name = NULL;
                $subnet = NULL;
                $router = NULL;
                $dns1 = NULL;
                $dns2 = NULL;
                $lease = NULL;
                $start = NULL;
                $stop = NULL;
                
                foreach($server as $row){
                        
                        if(str_contains($row,'shared-network-name')){
                                
                                if(preg_match('/\Qshared-network-name\E\s(.{1,})\s\{/', $row,$match)){
                    
                                    $name = $match[1];

                                }else{
                   
                                }
                                
                        }elseif(str_contains($row,'subnet')){
                                
                                if(preg_match('/\Qsubnet\E\s(.{1,})\s\{/', $row,$match)){
                    
                                    $subnet = $match[1];

                                }else{
                   
                                }
                                
                        }elseif(str_contains($row,'default-router')){
                                
                                if(preg_match('/\Qdefault-router\E\s(\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})/', $row,$match)){
                    
                                    $router = $match[1];

                                }else{
                   
                                }
                                
                        }elseif(str_contains($row,'dns-server')){
                                
                                if(preg_match('/\Qdns-server\E\s(\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})/', $row,$match)){
                                
                                    if(empty($dns1)){
                                            
                                        $dns1 = $match[1];

                                    }elseif(empty($dns2)){
                                            
                                        $dns2 = $match[1];
                                            
                                    }else{
                                           
                                    }
                                    
                                }else{
                   
                                }
                                
                        }elseif(str_contains($row,'lease')){
                                
                                if(preg_match('/\Qlease\E\s(\d{1,})/', $row,$match)){
                    
                                    $lease = $match[1];

                                }else{
                   
                                }
                                
                        }elseif(str_contains($row,'start')){
                                
                                if(preg_match('/\Qstart\E\s(.{1,})\s\{/', $row,$match)){
                    
                                    $start = $match[1];

                                }else{
                   
                                }
                                
                        }elseif(str_contains($row,'stop')){
                                
                                if(preg_match('/\Qstop\E\s(\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})/', $row,$match)){
                    
                                    $stop = $match[1];

                                }else{
                   
                                }
                                
                        }else{
                                //Nothing
                        }
                }
                
                $serversettings = array(
                        "name" => $name, 
                        "subnet" => $subnet, 
                        "router" => $router, 
                        "dns1" => $dns1, 
                        "dns2" => $dns2, 
                        "lease" => $lease, 
                        "start" => $start, 
                        "stop" => $stop, 
                        );
                        
                array_push($results, $serversettings);
        }
        
        return($results);
       
    }
    
     protected static function getdhcpserver($data)
    {
        if(preg_match('/\Qservice {\E\n\s{4}\Qdhcp-server {\E(.{1,})\Qdns {\E/s', $data,$dhcp)){
                    
                    $dhcp = $dhcp[1];

                }else{
                   
                   return false;
                   
                }
                
         $data = explode("\n", $dhcp);
         
         $data = array_slice($data, 3);
         
         $masterlength = count($data) - 2;
         
         $data = array_slice($data,0,$masterlength);
         
         $data = array_reverse($data);
        
        $servers = array();
        
        $offset = 0;
        $lastlength = 0;
        
        foreach($data as $key=>$row){
                
                if(str_contains($row,'shared-network-name')){
                           
                           $length = $key + 1 - $lastlength;

                           $server = array_slice($data, $offset,$length);
                           
                           $offset = $key + 1;
                           
                           $lastlength = $length;
                           
                           $server = array_reverse($server);
                           
                           array_push($servers, $server);
                        
                }else{
                        
                }
                
        }
        
        return($servers);
    }
    
    public static function getstaticmap($data)
    {
        
        $servers = Helper::getdhcpserver($data);
        
        if($servers == false){
            return false;
        }
        
        $results = array();
        
        $statics = array();
        
        foreach($servers as $server){
                
                foreach($server as $key=>$row){
                
                        if(str_contains($row,'static-mapping')){
                                   
                                   $offset = $key;

                                   $static = array_slice($server, $offset,3);
                                   
                                   $static[4] = $server[0];
                                   
                                   array_push($statics, $static);
                        
                        }else{
                        
                        }
                        
                        
                }
        }
        
           foreach($statics as $static){
                   
                   $name = NULL;
                   $ip = NULL;
                   $mac = NULL;
                   $mapname = NULL;
                   
                   foreach($static as $row){
                  
                   if(str_contains($row,'shared-network-name')){
                                
                                if(preg_match('/\Qshared-network-name\E\s(.{1,})\s\{/', $row,$match)){
                    
                                    $name = $match[1];

                                }else{
                   
                                }
                                
                        }elseif(str_contains($row,'ip-address')){
                                
                                if(preg_match('/\Qip-address\E\s(\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})/', $row,$match)){
                    
                                    $ip = $match[1];

                                }else{
                   
                                }
                                
                        }elseif(str_contains($row,'mac-address')){
                                
                                if(preg_match('/((?:[a-zA-Z0-9]{2}[:-]){5}[a-zA-Z0-9]{2})/', $row,$match)){
                    
                                    $mac = $match[1];

                                }else{
                   
                                }
                                
                        }elseif(str_contains($row,'static-mapping')){
                                
                                if(preg_match('/\Qstatic-mapping\E\s(.{1,})\s\{/', $row,$match)){
                                
                                    $mapname = $match[1];
                                    
                                }else{
                   
                                }
                                
                        }else{
                                
                        }
                        
                   }
                   
                $staticsettings = array(
                        "name" => $name, 
                        "ip" => $ip, 
                        "mac" => $mac, 
                        "mapname" => $mapname, 
                        );
                        
                array_push($results, $staticsettings);
           }
           
           return($results);
    }
    
    public static function getdhcpleases($data)
    {
        
        $leases = explode("\n", $data);
         
         unset($leases[0]);
         
         unset($leases[1]);
         
         $leases = array_values($leases);
         
         $results = array();
         
         foreach($leases as $lease){
                 
                 $iplease = array(
                         "ip" => NULL,
                         "mac" => NULL,
                         "expires" => NULL,
                         "name" => NULL,
                         );
                 
                 $lease = $str = preg_replace('/\s{2,}/', ' ', $lease);
                 
                 if(preg_match('/(\S{1,})\s(\S{1,})\s(\S{1,}\s\S{1,})\s\S{1,}\s(\S{1,})/', $lease,$match)){
                                
                                    $iplease['ip'] = $match[1];
                                    $iplease['mac'] = $match[2];
                                    $iplease['expires'] = $match[3];
                                    $iplease['name'] = $match[4];
                                    
                                    array_push($results, $iplease);
                                    
                                }else{
                                        
                                        if(preg_match('/(\S{1,})\s(\S{1,})\s(\S{1,}\s\S{1,})\s\S{1,}\s/', $lease,$match)){
                                
                                            $iplease['ip'] = $match[1];
                                            $iplease['mac'] = $match[2];
                                            $iplease['expires'] = $match[3];
                                            
                                            array_push($results, $iplease);
                                    
                                       }else{
                           
                                        }
                   
                                }
     
         }
         
         return($results);
    }
    
    public static function getAirOSstat($data, $data2) 
    {
	
                $data = str_replace(array("\r", "\n", "\t"), "", $data);
                $data = str_replace(" ", "|", $data);

                /* Capture Frequency */
                preg_match("/\Frequency:(.*?)\|/", $data, $matches);
                $airOS["frequency"] = str_replace("\"", "", $matches[1]);

                /* Capture TX Power */
                preg_match("/\Tx-Power=(.*?)\|/", $data, $matches);
                $airOS["txPower"] = str_replace("\"", "", $matches[1]);

                /* Capture Signals */
                preg_match_all("/level=(.*?)\|/", $data, $matches);
                $airOS["signal"] = str_replace("\"", "", $matches[1][0]);
                $airOS["noise"] = str_replace("\"", "", $matches[1][1]);
	
	
      
               $data2 = str_replace(array("\r", "\n", "\t"), "", $data2);
               $data2 = str_replace(" ", "|", $data2);
	
            $start = strpos($data2, 'ccq=');
            $start = $start +4;
      	$end = strpos($data2, 'uptime=');
      	$length = $end - $start;
      	$airOS["ccq"] = substr("$data2", "$start","$length" );
	
      	$start = strpos($data2, 'wlanTxLatency=');
      	$end = strpos($data2, 'wlanPolling=');
            $start = $start +14;
      	$length = $end - $start;
      	$airOS["latency"] = substr("$data2", "$start","$length" );
	 
          return($airOS);
	}
	
	  public static function buildmapsettings()
		{
			
			 $lat = Settings::where('setting_name', 'map lat')->first();
        $lon = Settings::where('setting_name', 'map lon')->first();
        $zoom = Settings::where('setting_name', 'map zoom')->first();

        $lat = $lat['setting_value'];
        $lon = $lon['setting_value'];
        $zoom = $zoom['setting_value'];

        $mapsettings = array(
        "lat" => "$lat",
        "lon" => "$lon",
        "zoom" => "$zoom",
        );
			
			return($mapsettings);
		}
		
		public static function getpppoeserver($data)
    {
        
        $output = preg_match("/\Qpppoe-server\E.{1,}\Qsnmp\E/s", $data, $result1);
    
        if($output == false){
            
            return false;
            
        }
        
        $config = str_replace(array("\r","\n")," ",$result1[0]);
    
        $patterns = array(
        	"server" => "/\Qradius-server\E\s(\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})/", 
        	"start" => "/\Qstart\E\s(\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})/", 
    	    "stop" => "/\Qstop\E\s(\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})/", 
    	    "dns1" => "/\Qserver-1\E\s(\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})/", 
    	    "dns2" => "/\Qserver-2\E\s(\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})/", 
    	    "interface" => "/\Qinterface\E\s(\S{1,12})/",
    	);
    
        $results = array();
    
        foreach($patterns as $key => $pattern){
    	
    	    if($key == 'interface'){
    		
    		    $output = preg_match_all ($pattern, $config, $result);
    		
        	}else{
    
        		$output = preg_match($pattern, $config, $result);
    	
        	}
    	
        	if($output == false){
    		
        		$results["$key"] = NULL; 
    		
        	}else{
    
        		$results["$key"] = $result[1];
    			
        	}
    	
        }
        
        return($results);
       
    }
    
}

?>