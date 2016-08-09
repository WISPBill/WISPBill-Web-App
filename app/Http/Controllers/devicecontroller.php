<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Helpers\Radius;

use App\Models\Devices;

use App\Models\Settings;

use App\Models\DevicesPorts;

use App\Models\RadioData;

use DateTime;

use Crypt;

class devicecontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role');
    }
    
    public function index()
    {
        $total = Devices::all()->count();
        $devices = Devices::all();

        return view('device.view', compact('devices','total'));
    }
    
     public function show($id)
    {
  
        $device = Devices::with('ports.ips','DHCP_Servers.ips')->findOrFail($id);
  
            $date = new DateTime;
            $date->modify('-1 month');
            $formatted_date = $date->format('Y-m-d H:i:s');
            
        
        $imagepath = "img/deviceimg/$device->manufacturer/$device->model".".png";
        
        if(file_exists(public_path($imagepath))){
            
            $image = asset($imagepath);
            
        }else{
            
            $image = asset("img/deviceimg/default.svg.png");
            
        }
        
        $mgmtip = $device->SSH_Credentials->IP->address;
        
        $webaddress = 'https://'.$mgmtip;
        
        if($device->type == 'Radio'){
        
            $radiodata = RadioData::where('device_id',$id)->orderBy('created_at', 'desc')->first();
        
            $frequency = $radiodata['frequency'];
            $txpower = $radiodata['txPower'];
        
        }else{
            
            $frequency = NULL;
            $txpower = NULL;
            
        }
        
      return view('device.viewinfo', compact('device','image','webaddress','formatted_date','frequency','txpower'));
    }
    
    public function radiusnewnas()
    {
        
        $radius = Settings::where('setting_name', 'Radius Billing')->first();
        $radius = $radius['setting_value'];
        
        if($radius == false){
            
            abort(500, 'Radius is not Configured');
            
        }elseif($radius == true){
            
            $devices = Devices::where('type', 'Router')->get();

            return view('device.radius.newnas', compact('devices'));
            
        }else{
            
             abort(500, 'Error Retrieving Radius Settings from Database');
            
        }
       
    }
    
    public function storeradiusnewnas(Request $request)
    {
        
        $radius = Settings::where('setting_name', 'Radius Billing')->first();
        $radius = $radius['setting_value'];
        
        if($radius == false){
            
            abort(500, 'Radius is not Configured');
            
        }elseif($radius == true){
            
            $this->validate($request, [
            'configuration' => 'required|in:manual,auto',
            'name' => 'required_if:configuration,manual',
            'type' => 'required_if:configuration,manual',
            'IP Address' => 'required_if:configuration,manual|ip',
            'secret' => 'required_if:configuration,manual|confirmed',
            'id' => 'required_if:configuration,auto',
            ]);
            
            if($request['configuration'] == 'auto'){
                
                $router = Devices::findorfail($request['id']);
                
                if(empty($router->name)){
                    
                    $name = $router->id;
                    
                }
                
                $type = 'other';
                
                $ip = $router->SSH_Credentials->IP->address;
                
                $secret = substr( md5(rand()), 0, 7);
                
                
            }elseif($request['configuration'] == 'manual'){
                
                $name = $request['name'];
                $type = $request['type'];
                $ip = $request['IP Address'];
                $secret = $request['secret'];
                
            }else{
                
                 abort(500, 'Unexpected Error');
                
            }
            
            if(Radius::newnas($name,$ip,$type,$secret)){
                
                return redirect("/");
                
            }else{
                
                 abort(500, 'Unexpected Error');
                
            }
            
        }else{
            
             abort(500, 'Error Retrieving Radius Settings from Database');
            
        }
       
    }
}
