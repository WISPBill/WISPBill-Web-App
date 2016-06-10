<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
     public $table = "locations";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'type','longitude','latitude','coverage'
    ];
    
    public function contacts()
    {
        return $this->belongsToMany('App\Models\Contacts', 'site_contacts', 'location_id', 'contact_id')->withTimestamps();

    }
    
    public function notes()
    {
        return $this->hasMany('App\Models\Site_Notes','location_id');
    }
}
