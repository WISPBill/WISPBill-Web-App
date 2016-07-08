<?php

namespace App\Http\Controllers;

use App\Models\Settings;

use Gate;

use App\User;

use Illuminate\Http\Request;

use App\Http\Requests;

class settingscontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role');
        if (Gate::denies('admin')) {
            abort(403,'Unauthorized action.');
        }
    }

    public function main()
    {
        $api = Settings::where('setting_name', 'geocoder API key')->first();
        $key = $api['setting_value'];
        
        $verifypin = Settings::where('setting_name', 'Customer PIN')->first();
        $verifypin = $verifypin['setting_value'];
        
        $speed = Settings::where('setting_name', 'Rate Limit Plans')->first();
        $speed = $speed['setting_value'];
        
        $data = Settings::where('setting_name', 'Data Cap Plans')->first();
        $data = $data['setting_value'];
        
        $burst = Settings::where('setting_name', 'Rate Limit Bursting Plans')->first();
        $burst = $burst['setting_value'];

        return view('admin.main',compact('key','verifypin','speed','data','burst'));
    }

     public function setstripekey(Request $request)
    {
         $this->validate($request, [
        'publishable' => 'required',
        'secret' => 'required',
        ]);

        // Clear out DB of old keys
        Settings::where('setting_name', 'stripe secret key')->delete();
        Settings::where('setting_name', 'stripe publishable key')->delete();

        $publishable = trim($request['publishable']);
        $secret = trim($request['secret']);

        Settings::create([
            'setting_name' => 'stripe publishable key',
            'setting_value' => $publishable,
        ]);

        Settings::create([
            'setting_name' => 'stripe secret key',
            'setting_value' => $secret,
        ]);
        return redirect("/");
    }

    public function setgeocoder(Request $request)
    {
         $this->validate($request, [
        'service' => 'required|in:mapzen,census,manual',
        'api' => 'required_if:service,mapzen',
        ]);

        // Clear out DB of old keys
        Settings::where('setting_name', 'geocoder service')->delete();
        Settings::where('setting_name', 'geocoder API key')->delete();
        
        if($request['service'] == 'mapzen'){
            
            $API = trim($request['api']);
            
        }elseif($request['service'] == 'census'){
            
            $API = 'Not Needed for this Service';
            
        }elseif($request['service'] == 'manual'){
            
            $API = 'Not Needed for this Service';
            
        }
        
        Settings::create([
            'setting_name' => 'geocoder service',
            'setting_value' => $request['service'],
        ]);

        Settings::create([
            'setting_name' => 'geocoder API key',
            'setting_value' => $API,
        ]);
        return redirect("/");
    }

    public function setmapview(Request $request)
    {
         $this->validate($request, [
        'lat' => 'required|numeric',
        'lon' => 'required|numeric',
        'zoom' => 'required|numeric',
        ]);

        // Clear out DB of old keys
        Settings::where('setting_name', 'map lat')->delete();
        Settings::where('setting_name', 'map lon')->delete();
        Settings::where('setting_name', 'map zoom')->delete();

        Settings::create([
            'setting_name' => 'map lat',
            'setting_value' => $request['lat'],
        ]);

        Settings::create([
            'setting_name' => 'map lon',
            'setting_value' => $request['lon'],
        ]);

         Settings::create([
            'setting_name' => 'map zoom',
            'setting_value' => $request['zoom'],
        ]);
        return redirect("/");
    }
    
    public function indexusers()
    {
        $total = User::count();
        $users = User::all();

        return view('admin.viewusers', compact('users','total'));

    }
    
    public function manageuserpermissions()
    {
        $total = User::count();
        $users = User::all();

        return view('admin.manageusers', compact('users','total'));

    }
    
    public function storemanageuserpermissions(Request $request)
    {
         $this->validate($request, [
        'userid' => 'required|numeric',
        'role' => 'required|in:admin,nonadmin',
        ]);

        User::where('id', $request['userid'])->update(['role' => $request['role']]);
        return redirect("/settings");
    }
    
    public function togglesettings(Request $request)
    {

        // Clear out DB of old settings
        Settings::where('setting_name', 'Customer PIN')->delete();
        Settings::where('setting_name', 'Rate Limit Plans')->delete();
        Settings::where('setting_name', 'Data Cap Plans')->delete();
        Settings::where('setting_name', 'Rate Limit Bursting Plans')->delete();

        if(isset($request['pin'])){
            $pinvalue = true;
        }elseif(!isset($request['pin'])){
            $pinvalue = false;
        }else{
            abort(500, 'Unexpected Issue Please Contact Administrator');
        }
        
        if(isset($request['speed'])){
            $speed = true;
        }elseif(!isset($request['speed'])){
            $speed = false;
        }else{
            abort(500, 'Unexpected Issue Please Contact Administrator');
        }
        
        if(isset($request['data'])){
            $data = true;
        }elseif(!isset($request['data'])){
            $data = false;
        }else{
            abort(500, 'Unexpected Issue Please Contact Administrator');
        }
        
        if(isset($request['burst'])){
            $burst = true;
        }elseif(!isset($request['burst'])){
            $burst = false;
        }else{
            abort(500, 'Unexpected Issue Please Contact Administrator');
        }
        
        Settings::create([
            'setting_name' => 'Customer PIN',
            'setting_value' => $pinvalue,
        ]);
        
        Settings::create([
            'setting_name' => 'Rate Limit Plans',
            'setting_value' => $speed,
        ]);
        
        Settings::create([
            'setting_name' => 'Data Cap Plans',
            'setting_value' => $data,
        ]);
        
        Settings::create([
            'setting_name' => 'Rate Limit Bursting Plans',
            'setting_value' => $burst,
        ]);
        
        return redirect("/");
    }
    
     public function mailmarketingurl(Request $request)
    {
         $this->validate($request, [
        'url' => 'required|url',
        ]);

        // Clear out DB of old keys
        Settings::where('setting_name', 'Open-Mail-Marketing URL')->delete();

        $url = trim($request['url']);

        Settings::create([
            'setting_name' => 'Open-Mail-Marketing URL',
            'setting_value' => $url,
        ]);

        return redirect("/");
    }
    
    public function setssh(Request $request)
    {
         $this->validate($request, [
        'ssh' => 'required|numeric',
        ]);

        // Clear out DB of old keys
        Settings::where('setting_name', 'SSH Port')->delete();

        Settings::create([
            'setting_name' => 'SSH Port',
            'setting_value' => $request['ssh'],
        ]);
        return redirect("/");
    }

}
