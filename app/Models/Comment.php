<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
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
}
