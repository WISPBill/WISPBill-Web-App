<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Networks;

class monitoringcontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role');
    }
    
    public function networkcreate()
    {
        return view('monitoring.network.new');
    }
    
    public function networkstore(Request $request)
    {
         $this->validate($request, [
        'IP' => 'required|ip',
        'CIDR' => 'required|integer',
        ]);
        
         $plan = Networks::create([
            'ip' => $request['IP'],
            'CIDR' => $request['CIDR'],
        ]);
        
        return redirect("/");
        
    }
}
