<?php

namespace App\Models;
    
use Illuminate\Database\Eloquent\Model;
    
class Company extends Model {
    
    protected $table = 'companies';
    
    public $timestamps = false;

    public function serviceLocation()
    {
        return $this->hasMany('serviceLocation');
    }
       
}