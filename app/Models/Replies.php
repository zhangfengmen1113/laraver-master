<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Replies extends Model
{
    protected $fillable = ['content','rule_id'];

    //关联规则
    public function rule(){
        //反向一对多 多个关键词对一个规则
        return $this->belongsTo(Rule::class);
    }
}
