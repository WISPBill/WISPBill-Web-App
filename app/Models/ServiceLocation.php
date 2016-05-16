<?php
    
namespace App\Models;
    
use Illuminate\Database\Eloquent\Model;

class ServiceLocation extends Model {
    
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('User');
    }
    
    public function device()
    {
        return $this->hasMany('App\Models\Device');
    }
    
    public function ip()
    {
        return $this->hasManyThrough('App\Models\IP', 'App\Models\Device');
    }
       
}