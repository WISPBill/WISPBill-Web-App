<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site_Notes extends Model
{
    public $table = "site_notes";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'note','location_id','user_id'
    ];
    
    public function site()
    {
        return $this->belongsTo('App\Models\Locations','location_id','id');
    }
    
    public function creator()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
}
