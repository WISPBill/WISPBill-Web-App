<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Devices extends Model
{
    public $table = "Devices";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'type','model','manufacturer','mac','serial_number','os','version','revision','customer_location_id'
    ];
    
    public function ports()
    {
        return $this->hasMany('App\Models\DevicePorts','device_id','id');
    }
    
     public function SSH_Credentials()
    {
        return $this->hasOne('App\Models\SSHCredentials','device_id','id');
    }
    
    public function DHCP_Servers()
    {
        return $this->hasMany('App\Models\DHCPServers','device_id','id');
    }
    
    public function radiodata()
    {
        return $this->hasMany('App\Models\RadioData','device_id','id');
    }
    
    public function PPPOE_Servers()
    {
        return $this->hasMany('App\Models\PPPOEServers','device_id','id');
    }
    
    public function customer_location()
    {
        return $this->belongsTo('App\Models\Customer_locations','customer_location_id','id');
    }
    
}
