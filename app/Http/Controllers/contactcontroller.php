<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Contacts;

class contactcontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function create()
    {
        return view('contact.new');
    }
    
    public function store(Request $request)
    {
         $this->validate($request, [
        'organization' => 'required',
        'name' => 'required',
        'email' => 'required|email|max:255|unique:contacts',
        'tel' => 'required|regex:/\d{3}\-\d{3}\-\d{4}/',
        'add' => 'required',
        'city' => 'required',
        'zip' => 'required|numeric',
        'state' => 'required',
        ]);

        Contacts::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'organization' => $request['organization'],
            'add' => $request['add'],
            'city' => $request['city'],
            'zip' => $request['zip'],
            'state' => $request['state'],
            'tel' => $request['tel'],
        ]);
        
        return redirect("/");
    }
}
