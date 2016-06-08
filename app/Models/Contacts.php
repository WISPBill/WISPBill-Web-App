<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    public $table = "contacts";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'organization','add','city','zip','state','tel'
    ];
    
    public function sites()
    {
        return $this->belongsToMany('App\Models\Locations', 'site_contacts', 'contact_id', 'location_id')->withTimestamps();

    }
    
    public function notes()
    {
        return $this->hasMany('App\Models\Contact_Notes','id');
    }
}
