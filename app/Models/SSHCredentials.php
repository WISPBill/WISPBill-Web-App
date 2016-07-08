<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SSHCredentials extends Model
{
    public $table = "SSH_Credentials";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password','device_IP_id'
    ];
    
    public function IP()
    {
        return $this->belongsTo('App\Models\DeviceIPs','device_IP_id','id');
    }
}
