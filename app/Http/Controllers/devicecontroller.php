<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Devices;

use App\Models\DevicesPorts;

use App\Models\RadioData;

use DateTime;

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
}
