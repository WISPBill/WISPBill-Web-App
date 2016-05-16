<?php

namespace App\Models;
    
use Illuminate\Database\Eloquent\Model;
    
class Service extends Model {
    
    public $timestamps = false;

    public function serviceLocation()
    {
        return $this->hasMany('ServiceLocation');
    }
       
}