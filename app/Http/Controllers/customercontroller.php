<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Customer_info;

use App\Models\Settings;

use App\Models\Customer_locations;

use App\Helpers\Helper;

use App\User;

class customercontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role');
    }
  
  public function addlocation()
    {
        $total = Customer_info::whereNotNull('billing_id')->count();
        $customers = Customer_info::whereNotNull('billing_id')->get();
        
        $geoservice = Settings::where('setting_name', 'geocoder service')->first();
        $geoservice = $geoservice['setting_value'];
        
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
        
        return view('customer.addlocation', compact('customers','total','geoservice','mapsettings'));
    }
}
