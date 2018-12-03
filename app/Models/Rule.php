<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    protected $fillable = ['name'];

    //关联关键词
    public function keyword(){
        //一对多的关系  一个规则对多个关键词
        return $this->hasMany(Keyword::class);
    }
}
