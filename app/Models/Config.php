<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $fillable = [
      'data','name'
    ];

    //casts 把字符串转换成数组
    protected $casts = [
        'data'=>'array',
    ];

}
