<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer_info extends Model
{
     public $table = "customer_info";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'type','add','city','zip','state','source','tel'
    ];

     public function locations()
    {
        return $this->hasMany('App\Customer_locations','id');
    }
}
