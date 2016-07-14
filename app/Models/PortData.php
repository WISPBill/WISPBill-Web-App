<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortData extends Model
{
     public $table = "port_data";
     
     protected $fillable = [
        'port_id', 'rx_rate','tx_rate','rx_packets','tx_packets','rx_bytes','tx_bytes','rx_dropped','tx_dropped'
    ];
    
    public function port()
    {
        return $this->belongsTo('App\Models\DevicePorts','port_id','id');
    }
    
}
