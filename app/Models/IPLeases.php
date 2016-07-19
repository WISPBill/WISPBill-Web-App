<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IPLeases extends Model
{
    public $table = "ip_leases";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','mac','ip','static','expires','server_id'
    ];
    
    public function server()
    {
        return $this->belongsTo('App\Models\DHCPServers','server_id','id');
    }
}
