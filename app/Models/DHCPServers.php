<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DHCPServers extends Model
{
    public $table = "dhcp_servers";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'subnet','lease','leased','start','stop','router','dns1','dns2','device_id','port_id'
    ];
    
    public function device()
    {
        return $this->belongsTo('App\Models\Devices','device_id','id');
    }
    
    public function port()
    {
        return $this->belongsTo('App\Models\DevicePorts','port_id','id');
    }
}
