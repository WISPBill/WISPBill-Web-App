<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Networks;

use App\Models\SSHCredentials;

use App\Models\DeviceIPs;

use Event;

use App\Events\NewSSH;

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
        
         Networks::create([
            'ip' => $request['IP'],
            'CIDR' => $request['CIDR'],
        ]);
        
        return redirect("/");
        
    }
    
    public function setssh()
    {
        $total = SSHCredentials::whereNull('username')->with('IP')->count();
        $servers = SSHCredentials::whereNull('username')->with('IP.network')->get();

        return view('monitoring.ssh.new', compact('servers','total'));
    }
    
    public function storessh(Request $request)
    {
         $this->validate($request, [
         'username' => 'required|max:255',
         'password' => 'required|confirmed',
         'id' => 'required|numeric',
        ]);
        
        $server = SSHCredentials::find($request['id']);

        $server->username = $request['username'];
        $server->password = $request['password'];

        $server->save();
        
        $SSHCredentials = SSHCredentials::with('IP')->where('id', $request['id'])->get();
        
        event(new NewSSH($SSHCredentials));
        
        return redirect("/");
    }
}
