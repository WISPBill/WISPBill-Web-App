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
        'name', 'type','model','manufacturer','mac','serial_number','os','version','revision'
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
    
}
