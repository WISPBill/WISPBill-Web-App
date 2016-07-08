<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Networks extends Model
{
     public $table = "networks";
     
      protected $fillable = [
        'ip', 'CIDR'
    ];
    
     public function ips()
    {
        return $this->hasMany('App\Models\DeviceIPs','network_id','id');
    }
}
