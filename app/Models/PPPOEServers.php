<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PPPOEServers extends Model
{
     public $table = "pppoe_servers";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','start','device_id','stop','radius','dns1','dns2'
    ];
    
    public function ports()
    {
        return $this->hasMany('App\Models\DevicePorts','pppoe_server_id','id');
    }
    
    public function device()
    {
        return $this->belongsTo('App\Models\Devices','device_id','id');
    }
}
