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
        'readable_name', 'name','mac','device_id'
    ];
    
    public function ips()
    {
        return $this->hasMany('App\Models\DeviceIPs','portid_id','id');
    }
    
    public function device()
    {
        return $this->belongsTo('App\Models\Devices','device_id','id');
    }
}
