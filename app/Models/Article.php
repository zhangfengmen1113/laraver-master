<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Laravel\Scout\Searchable;

class Article extends Model
{
    //引入 trait 类
    use LogsActivity,Searchable;

    protected $fillable = ['title','content','id'];

    //如果需要记录所有$fillable设置的填充属性，可以使用
    protected static $logFillable = true;
    //设置模型属性
    protected static $recordEvents = ['created', 'updated', 'deleted'];
    //自定义日志名称
    protected static $logName = 'article';
    //定义文章和用户关联
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //定义栏目关联
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //定义zan多态关联
    public function zan(){
        //morphMany(模型关联，数据迁移)
        return $this->morphMany(Zan::class,'zan');
    }

    //多态关联收藏
    public function enshrine(){

        return $this->morphMany(Enshrine::class,'enshrine');
    }

}
