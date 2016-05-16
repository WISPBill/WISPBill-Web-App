<?php

namespace App\Models;
    
use Illuminate\Database\Eloquent\Model;
    
class IntegratedRadio extends Model {
    
    public $timestamps = false;

    public function device()
    {
        return $this->hasMany('App\Models\Device');
    }
       
}