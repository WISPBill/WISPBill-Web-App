<?php

namespace App;

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

}
