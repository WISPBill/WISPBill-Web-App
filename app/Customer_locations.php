<?php

namespace App;

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
        return $this->belongsTo('App\Customer_info');
    }
}
