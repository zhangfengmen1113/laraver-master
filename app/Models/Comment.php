<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Comment extends Model
{
    //引入 trait 类
    use LogsActivity;
    protected $fillable = ['content','article_id'];

    //如果需要记录所有$fillable设置的填充属性，可以使用
    protected static $logFillable = true;
    //设置模型属性
    protected static $recordEvents = ['created', 'updated', 'deleted'];
    //自定义日志名称
    protected static $logName = 'comment';
	/**
	 * 这个属性被转换为原生的类型.
	 * @var array
	 */
	protected $casts = [
		'created_at' => 'datetime:H:i',
	];

	//关联用户
    public function user(){
        //dd(1);
		return $this->belongsTo(User::class);
	}

	//定义zan多态关联
    public function zan(){
        //morphMany(模型关联，数据迁移)
        return $this->morphMany(Zan::class,'zan');
    }

    //评论关联通知
    public function article(){
        return $this->belongsTo(Article::class);
    }
}
