<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceIPs extends Model
{
     public $table = "device_IPs";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address', 'network_id','port_id'
    ];

       public function network()
    {
        return $this->belongsTo('App\Models\Networks','network_id','id');
    }
    
     public function SSH_Credentials()
    {
        return $this->hasOne('App\Models\SSHCredentials','device_IP_id','id');
    }
    
      public function port()
    {
        return $this->belongsTo('App\Models\DevicePorts','port_id','id');
    }
    
}
