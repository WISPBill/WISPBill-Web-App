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
        'name', 'email', 'type','add','city','zip','state','source','tel','pin'
    ];

     public function locations()
    {
        return $this->hasMany('App\Models\Customer_locations','customer_info_id','id');
    }
    
    public function users()
    {
        return $this->hasMany('App\User','customer_info_id','id');
    }
}
