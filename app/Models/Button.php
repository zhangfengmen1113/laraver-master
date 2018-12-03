<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Button extends Model
{
    public $fillable = [
        'data','status','title'
    ];
}
