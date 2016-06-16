<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','skin','img','role','phone','customer_info_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function contactnotes()
    {
        return $this->hasMany('App\Models\Contact_Notes','id');
    }
    
    public function sitenotes()
    {
        return $this->hasMany('App\Models\Site_Notes','id');
    }
    
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer_info','customer_info_id','id');
    }
}
