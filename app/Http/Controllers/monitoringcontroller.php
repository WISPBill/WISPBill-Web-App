<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Response;

use App\Models\Networks;

use App\Models\SSHCredentials;

use App\Models\DeviceIPs;

use App\Models\PortData;

use App\Models\RadioData;

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
    
     public function displayportdata($id,$timeframe)
    {
      
      $data = PortData::where('port_id', $id)->where('created_at','>=', $timeframe)->get();
      
      $output = array();
      
      $outputfile = '';
      
      $outputheaders=array('Datetime','Rx Rate','Tx Rate');
      
      array_push($output, $outputheaders);
      
      foreach($data as $row){
          
          $outputdata = array($row['created_at'], $row['rx_rate']*8/1000000, $row['tx_rate']*8/1000000);
          
          array_push($output, $outputdata);
          
      }
      
      foreach($output as $outputrow){
          
          $outputfile .= implode(',', $outputrow);
          $outputfile.= "\n";
          
      }
      
          $headers = array(
      'Content-Type' => 'text/csv',
      'Content-Disposition' => 'attachment; filename="Data.csv"',
        );

          return Response::make(rtrim($outputfile, "\n"), 200, $headers);
        
    }
    
    public function displayradiodata($id,$timeframe,$type)
    {
      
      $data = RadioData::where('device_id', $id)->where('created_at','>=', $timeframe)->get();
      
      $output = array();
      
      $outputfile = '';
      
      $outputheaders=array('Datetime',$type);
      
      array_push($output, $outputheaders);
      
      foreach($data as $row){
          
          if($type != 'ccq'){
          
          $outputdata = array($row['created_at'], $row["$type"]);
          
          }else{
              
              $outputdata = array($row['created_at'], $row["$type"]/10);
              
          }
          array_push($output, $outputdata);
          
      }
      
      foreach($output as $outputrow){
          
          $outputfile .= implode(',', $outputrow);
          $outputfile.= "\n";
          
      }
      
          $headers = array(
      'Content-Type' => 'text/csv',
      'Content-Disposition' => 'attachment; filename="Data.csv"',
        );

          return Response::make(rtrim($outputfile, "\n"), 200, $headers);
        
    }
}
