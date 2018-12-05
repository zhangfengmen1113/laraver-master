<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teletext extends Model
{
    protected $fillable = ['data','rule_id'];

    //关联规则
    public function rule(){

        return $this->belongsTo(Rule::class);
    }
}
