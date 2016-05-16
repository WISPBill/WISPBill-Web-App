<?php
    
namespace App\Models;
    
use Illuminate\Database\Eloquent\Model;

class Device extends Model {
    
    public $timestamps = false;

    public function ip()
    {
        return $this->hasMany('App\Models\IP');
    }
    
    public function serviceLocation()
    {
        return $this->hasOne('ServiceLocation');
    }
       
}