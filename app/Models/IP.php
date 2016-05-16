<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IP extends Model
{
    protected $table = 'ips';
    
    public $timestamps = false;
    
    public function device()
    {
        return $this->belongsTo('App\Models\Device');
    }
}
