<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Zan extends Model
{
   public $fillable = ['user_id'];

   //点赞关联用户
   public function user(){

       return $this->belongsTo(User::class);
   }

   //多态，获取多态关联模型Article/Comment
   public function belongsModel(){

       return $this->morphTo('zan');
   }
}
