<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Focus extends Model
{
    public $fillable = ['data'];

    public $casts = [
       'data' => 'array'
    ];
}
