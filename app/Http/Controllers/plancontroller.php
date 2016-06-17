<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Settings;

use App\Models\Plans;

use App\Models\Plan_attributes;

use App\Helpers\Billing;

class plancontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role');
    }
    
    public function create()
    {
        $speed = Settings::where('setting_name', 'Rate Limit Plans')->first();
        $speed = $speed['setting_value'];
        
        $data = Settings::where('setting_name', 'Data Cap Plans')->first();
        $data = $data['setting_value'];
        
        $burst = Settings::where('setting_name', 'Rate Limit Bursting Plans')->first();
        $burst = $burst['setting_value'];

        return view('plan.new', compact('speed','data','burst'));
    }
    
    public function store(Request $request)
    {
         $this->validate($request, [
        'frequency' => 'required|in:day,week,month,year',
        'name' => 'required|unique:plans,name',
        'price' => 'required|numeric',
        'data' => 'required|in:true,false',
        'speed' => 'required|in:true,false',
        'uploadrate' => 'required_if:speed,true,|numeric',
        'downloadrate' => 'required_if:speed,true,|numeric',
        'upload' => 'required_if:data,true,|numeric',
        'download' => 'required_if:data,true,|numeric',
        ]);

        $plan = Plans::create([
            'name' => $request['name'],
            'price' => $request['price'],
            'interval' => $request['frequency'],
        ]);
        
        $planid = $plan['id'];
        
        if($request['data'] == 'true'){
            
            Plan_attributes::create([
            'plan_id' => $planid,
            'attribute_name' => 'Upload Data Cap in GB',
            'attribute_value' => $request['upload'],
            ]);
            
            Plan_attributes::create([
            'plan_id' => $planid,
            'attribute_name' => 'Download Data Cap in GB',
            'attribute_value' => $request['download'],
            ]);
            
        }else{
            // DO nothing
        }
        
        if($request['speed'] == 'true'){
            
            Plan_attributes::create([
            'plan_id' => $planid,
            'attribute_name' => 'Upload Rate in Mbps',
            'attribute_value' => $request['uploadrate'],
            ]);
            
            Plan_attributes::create([
            'plan_id' => $planid,
            'attribute_name' => 'Download Rate in Mbps',
            'attribute_value' => $request['downloadrate'],
            ]);
            
        }else{
            // DO nothing
        }
        
        Billing::createplan($request['price'],$request['frequency'],$request['name'],$planid);
        
        return redirect("/");
    }
}
