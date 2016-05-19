<?php

namespace App\Http\Controllers;

use App\Customer_info;

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
         
        Customer_info::create([
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
           
        return redirect("/");
    }
    
    public function index()
    {
        $total = Customer_info::count();
        $leads = Customer_info::all();
        
        return view('lead.view', compact('leads','total'));
    }
}
