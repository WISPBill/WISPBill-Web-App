<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RadioData extends Model
{
    public $table = "radio_data";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'frequency', 'txPower','signal','noise','ccq','latency','device_id'
    ];
    
    public function radiodata()
    {
        return $this->belongsTo('App\Models\Devices','device_id','id');
    }
}
