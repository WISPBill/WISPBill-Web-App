<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

use App\Models\Locations;

use App\Models\Settings;

class marketingcontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role');
    }
    
    public function listsites()
    {
        $total = Locations::wherenotNull('coverage')->count();
       
        $sites = Locations::wherenotNull('coverage')->get();
        
        return view('marketing.list', compact('sites','total'));
    }
    
    public function getlist(Request $request)
    {
         $this->validate($request, [
        'siteid' => 'required',
        ]);
        
        $baseurl = Settings::where('setting_name', 'Open-Mail-Marketing URL')->first();
        $baseurl = $baseurl['setting_value'];
        
        $siteid = $request['siteid'];
        
        $site = Locations::find($siteid);
        
        $cov = $site->coverage;
        
        $url = "$baseurl/?geojson=$cov";
                /* Run query using cURL */
	
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $result = curl_exec($ch);
                curl_close($ch);
                
        $data = json_decode($result);
        return view('marketing.mailist', compact('data'));
    }
}
