<?php

namespace App\Models;

use Crypt;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SSHCredentials extends Model

{
    
    use SoftDeletes;

    public $table = "SSH_Credentials";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password','device_IP_id','device_id'
    ];
    
    protected $dates = ['deleted_at'];
    
    public function IP()
    {
        return $this->belongsTo('App\Models\DeviceIPs','device_IP_id','id');
    }
    
    public function device()
    {
        return $this->belongsTo('App\Models\Devices','device_id','id');
    }
    
       public function setusernameAttribute($value)
    {
        $this->attributes['username'] = Crypt::encrypt($value);
    }
    
    public function setpasswordAttribute($value)
    {
        $this->attributes['password'] = Crypt::encrypt($value);
    }
    
    public function getusernameAttribute($value)
    {
        return Crypt::decrypt($value);
    }
    
    public function getpasswordAttribute($value)
    {
        return Crypt::decrypt($value);
    }

}
