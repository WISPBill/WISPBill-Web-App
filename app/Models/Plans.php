<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plans extends Model
{
       public $table = "plans";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'price', 'interval'
    ];

     public function attributes()
    {
        return $this->hasMany('App\Models\Plan_attributes','plan_id','id');
    }
    
    public function customer_locations()
    {
        return $this->belongsToMany('App\Models\Customer_locations', 'customer_location_plans', 'plan_id', 'customer_location_id')->withPivot('mode')->withTimestamps();
    }
}
