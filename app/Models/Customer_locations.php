<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer_locations extends Model
{
    public $table = "customer_locations";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'longitude', 'latitude', 'status','add','city','zip','state','customer_info_id'
    ];

       public function customer()
    {
        return $this->belongsTo('App\Models\Customer_info','customer_info_id','id');
    }
    
    public function plans()
    {
        return $this->belongsToMany('App\Models\Customer_locations', 'customer_location_plans', 'customer_location_id', 'plan_id')->withPivot('mode')->withTimestamps();
    }
    
    public function devices()
    {
        return $this->hasMany('App\Models\Devices','customer_location_id','id');
    }
}
