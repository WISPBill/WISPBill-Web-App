<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan_attributes extends Model
{
     public $table = "plan_attributes";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'attribute_name', 'attribute_value', 'plan_id'
    ];

       public function customer()
    {
        return $this->belongsTo('App\Models\Plans','plan_id','id');
    }
}
