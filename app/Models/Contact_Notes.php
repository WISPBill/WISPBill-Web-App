<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact_Notes extends Model
{
    
     public $table = "contact_notes";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'note','contact_id','user_id'
    ];
    
    public function contact()
    {
        return $this->belongsTo('App\Models\Contacts','id');
    }
    
    public function creator()
    {
        return $this->belongsTo('App\Users','id');
    }
}
