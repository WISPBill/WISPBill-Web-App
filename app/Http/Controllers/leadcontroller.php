<?php

namespace App\Http\Controllers;

use App\Models\Customer_info;

use App\Models\Settings;

use App\Models\Customer_locations;

use App\Helpers\Helper;

use App\Helpers\Billing;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

class leadcontroller extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role');
    }

    public function create()
    {
        return view('lead.new');
    }

    public function map()
    {
        $api = Settings::where('setting_name', 'geocoder API key')->first();
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

        $key = $api['setting_value'];
        $geoleads = Customer_locations::with('customer')->get();
        return view('lead.map', compact('key','geoleads','mapsettings'));
    }

    public function addlocation()
    {
        $total = Customer_info::whereNull('billing_id')->count();
        $leads = Customer_info::whereNull('billing_id')->get();
        
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
        
        return view('lead.addlocation', compact('leads','total','geoservice','mapsettings'));
    }

    public function storeaddlocation(Request $request)
    {
         $this->validate($request, [
        'id' => 'required|numeric',
        'location' => 'required|in:same,different',
        'add' => 'required_if:location,different',
        'city' => 'required_if:location,different',
        'zip' => 'required_if:location,different|numeric',
        'state' => 'required_if:location,different',
        'lat' => 'required_if:geocoder,manual',
        'lon' => 'required_if:geocoder,manual',
        'geocoder' => 'required|in:manual,auto',
        ]);
        
         if($request['location'] == 'same'){
             $customer = Customer_info::find($request['id']);
             $add = $customer['add'];
             $city = $customer['city'];
             $state = $customer['state'];
             $zip = $customer['zip'];
         }else{
            $add = $request['add'];
            $city = $request['city'];
            $state = $request['state'];
            $zip = $request['zip'];
         }
         
         if($request['geocoder'] == 'auto'){
             
             $place = "$add $city $state $zip";

             $cords = Helper::geocode("$place");
 
             $lat = $cords['lat'];
             $lon = $cords['lon'];
             
        }elseif($request['geocoder'] == 'manual'){
            
            $lat = $request['lat'];
            $lon = $request['lon'];
            
        }else{
            
             abort(500, 'The Geocoding System is not Set');
        }

        Customer_locations::create([
            'longitude' => $lon,
            'latitude' => $lat,
            'add' => $add,
            'city' => $city,
            'zip' => $zip,
            'state' => $state,
            'customer_info_id' => $request['id'],
            'status' => NULL,
        ]);

        return redirect("/");
    }

    public function store(Request $request)
    {
         $this->validate($request, [
        'type' => 'required|in:residential,business',
        'name' => 'required',
        'email' => 'required|email|max:255|unique:customer_info|unique:users',
        'tel' => 'required|regex:/\d{3}\-\d{3}\-\d{4}/',
        'add' => 'required',
        'city' => 'required',
        'zip' => 'required|numeric',
        'state' => 'required',
        'source' => 'required|in:tel,friend,d2d,email,booth,other',
        ]);

        $lead = Customer_info::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'type' => $request['type'],
            'add' => $request['add'],
            'city' => $request['city'],
            'zip' => $request['zip'],
            'state' => $request['state'],
            'source' => $request['source'],
            'tel' => $request['tel'],
            'pin' => NULL,
            'billing_id' => NULL,
        ]);
        $id = $lead['id'];
        return redirect("/viewalead/$id");
    }

    public function index()
    {
        $total = Customer_info::whereNull('billing_id')->count();
        $leads = Customer_info::whereNull('billing_id')->get();

        return view('lead.view', compact('leads','total'));
    }

     public function show($id)
    {
        $total = Customer_info::count();
        $leads['1'] = Customer_info::findOrFail($id);

      return view('lead.view', compact('leads','total'));
    }
    
    public function addaccount()
    {
        $total = Customer_info::has('users', '<', 1)->whereNull('billing_id')->count();
        $leads = Customer_info::has('users', '<', 1)->whereNull('billing_id')->get();
        
        $pin = Settings::where('setting_name', 'Customer PIN')->first();
        $pin = $pin['setting_value'];
        
        return view('lead.addaccount', compact('leads','total','pin'));
    }
    
    public function storeaddaccount(Request $request)
    {
         $this->validate($request, [
         'name' => 'required|max:255',
         'password' => 'required|confirmed|min:6',
         'pin' => 'required_if:setpin,true|confirmed|min:4|numeric',
         'theme' => 'required|in:skin-blue,skin-blue-light,skin-yellow,skin-yellow-light,skin-green,skin-green-light,skin-purple,skin-purple-light,skin-red,skin-red-light,skin-black,skin-black-light',
         'id' => 'required|numeric',
        ]);
        
        $customer = Customer_info::find($request['id']);
        
        User::create([
            'name' => $request['name'],
            'email' => $customer['email'],
            'password' => bcrypt($request['password']),
            'skin' => $request['theme'],
            'img' => 'user_default_img.jpg',
            'role' => 'Customer',
            'phone' => $customer['tel'],
            'customer_info_id' => $request['id'],
        ]);
        
        $customer->pin = bcrypt($request['pin']);

        $customer->save();
        
        return redirect("/");
    }
    
     public function addbilling()
    {
        $total = Customer_info::whereNull('billing_id')->count();
        $leads = Customer_info::whereNull('billing_id')->get();
        
        return view('lead.addbilling', compact('leads','total'));
    }
    
    public function addbillingstore(Request $request)
    {
         $this->validate($request, [
         'id' => 'required|numeric',
        ]);
        
        $id = $request['id'];
        
        $billingid = Billing::createcustomer($id,$request);
        
        $customer = Customer_info::find($id);

        $customer->billing_id = $billingid;

        $customer->save();
        
        return redirect("/");
    }
}
