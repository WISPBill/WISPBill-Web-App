<?php

namespace App\Models;
    
use Illuminate\Database\Eloquent\Model;
    
class PaymentType extends Model {
    
    public $timestamps = false;
    
    public function user()
    {
        return $this->hasMany('User');
    }
       
}