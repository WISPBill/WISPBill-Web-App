<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Networks extends Model
{
     public $table = "networks";
     
      protected $fillable = [
        'ip', 'CIDR'
    ];
}
