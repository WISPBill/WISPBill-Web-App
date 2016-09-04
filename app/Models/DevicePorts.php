<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DevicePorts extends Model
{
    public $table = "device_ports";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'readable_name', 'name','mac','device_id','pppoe_server_id'
    ];
    
    public function ips()
    {
        return $this->hasMany('App\Models\DeviceIPs','port_id','id');
    }
    
    public function device()
    {
        return $this->belongsTo('App\Models\Devices','device_id','id');
    }
    
    public function data()
    {
        return $this->hasMany('App\Models\PortData','port_id','id');
    }
    
    public function DHCP_Servers()
    {
        return $this->hasMany('App\Models\DHCPServers','port_id','id');
    }
    
     public function PPPOE_Server()
    {
        return $this->belongsTo('App\Models\PPPOEServers','pppoe_server_id','id');
    }
}
