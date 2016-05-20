<?php

namespace App\Http\Controllers;

use App\Settings;

use Gate;

use Illuminate\Http\Request;

use App\Http\Requests;

class settingscontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function main()
    {
        if (Gate::denies('admin')) {
            abort(403,'Unauthorized action.');
        }

        return view('admin.main');
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
}
