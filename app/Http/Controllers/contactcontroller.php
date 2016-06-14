<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Contacts;

use App\Models\Contact_Notes;

use App\Models\Locations;

use Auth;

class contactcontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role');
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
    
    public function add()
    {
        $contacts = Contacts::all();
        $sites = Locations::all();
        
        return view('contact.add', compact('contacts','sites'));
    }
    
     public function storeadd(Request $request)
    {
         $this->validate($request, [
        'siteid' => 'required',
        'contactid' => 'required',
        ]);

        $location = Locations::find($request['siteid']);
        $location->contacts()->attach($request['contactid']);
    
      return redirect("/");
    }
    
    public function index()
    {
        $total = Contacts::count();
        $contacts = Contacts::with('notes.creator')->get();
        
        return view('contact.view', compact('contacts','total'));
    }
    
    public function notecreate()
    {
         $contacts = Contacts::all();
    
         return view('contact.newnote', compact('contacts'));
    }
    
    public function notestore(Request $request)
    {
         $this->validate($request, [
        'contactid' => 'required',
        'note' => 'required',
        ]);
        
        $userid = Auth::user()->id;
        
        Contact_Notes::create([
            'contact_id' => $request['contactid'],
            'user_id' => $userid,
            'note' => $request['note'],
        ]);

        return redirect("/");
    }
}
