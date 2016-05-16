<?php

namespace App\Models;
    
use Illuminate\Database\Eloquent\Model;
    
class RadioCard extends Model {
    
    public $timestamps = false;

    public function device()
    {
        return $this->hasMany('App\Models\Device');
    }
       
}