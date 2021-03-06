<?php

namespace App;

use App\Models\Article;
use App\Models\Attachment;
use App\Models\Enshrine;
use App\Models\Zan;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'email_verified_at', 'icon'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //重新写 数据库通知中获取所有通知的notifications方法
    public function notifications()
    {
        return $this->morphMany(DatabaseNotification::class, 'notifiable')->orderBy('read_at', 'asc')->orderBy('created_at', 'desc');
    }

    public function getIconAttribute($key)
    {
        //dd($key);
        return $key ?: asset('org/gyp.jpg');
    }

    //获取指定用户的粉丝
    public function fans()
    {
        //followers是表 //user_id是被关注的人 //followers_id粉丝
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'followers_id');
    }

    //获取关注的人
    public function followers()
    {
        //followers是表 //followers_id是被关注的人 //user_id粉丝
        return $this->belongsToMany(User::class, 'followers', 'followers_id', 'user_id');
    }

    //关联附件
    public function attachment()
    {

        return $this->hasMany(Attachment::class);
    }

    //用户关联 zan
    public function zan()
    {

        return $this->hasMany(Zan::class);
    }

    //用户关联 enshrine
    public function enshrine()
    {

        return $this->hasMany(Enshrine::class);
    }

    /**
     * 获取将存储在JWT主题声明中的标识符.
     * 就是⽤户表主键 id
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * 返回⼀个键值数组，其中包含要添加到JWT的任何⾃定义声明.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
