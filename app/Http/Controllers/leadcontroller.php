<?php

namespace App\Http\Controllers;

use App\Customer_info;

use App\Customer_locations;

use App\Helpers\Helper;

use Illuminate\Http\Request;

use App\Http\Requests;

class leadcontroller extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function create()
    {
        return view('lead.new');
    }
    
    public function addlocation()
    {
        $total = Customer_info::count();
        $leads = Customer_info::all();
        
        return view('lead.addlocation', compact('leads','total'));
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
         $place = "$add $city $state $zip";
         
        $cords = Helper::geocode("$place");
        
        $lat = $cords['lat'];
        $lon = $cords['lon'];
        
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
        'email' => 'required|email|max:255|unique:customer_info',
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
        ]);
        $id = $lead['id'];
        return redirect("/viewalead/$id");
    }
    
    public function index()
    {
        $total = Customer_info::count();
        $leads = Customer_info::all();
        
        return view('lead.view', compact('leads','total'));
    }
    
     public function show($id)
    {
        $total = Customer_info::count();
        $leads['1'] = Customer_info::findOrFail($id);
        
      return view('lead.view', compact('leads','total'));
    }
}
