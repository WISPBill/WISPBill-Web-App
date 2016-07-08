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
        'address', 'network_id'
    ];

       public function network()
    {
        return $this->belongsTo('App\Models\Networks','network_id','id');
    }
}
