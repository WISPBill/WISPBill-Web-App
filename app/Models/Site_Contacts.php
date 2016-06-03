<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site_Contacts extends Model
{
     public $table = "site_contacts";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'location_id', 'contact_id'
    ];
}
