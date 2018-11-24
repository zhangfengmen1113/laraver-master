<?php

namespace App;

use App\Models\Article;
use App\Models\Attachment;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','email_verified_at','icon'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getIconAttribute($key)
    {
        //dd($key);
        return $key ? : asset('org/gyp.jpg');
    }

    //获取指定用户的粉丝
    public function fans(){
       //followers是表 //user_id是被关注的人 //followers_id粉丝
       return $this->belongsToMany(User::class,'followers','user_id','followers_id');
    }

    //获取关注的人
    public function followers(){
       //followers是表 //followers_id是被关注的人 //user_id粉丝
       return $this->belongsToMany(User::class,'followers','followers_id','user_id');
    }

    //关联附件
    public function attachment(){

        return $this->hasMany(Attachment::class);
    }

}
