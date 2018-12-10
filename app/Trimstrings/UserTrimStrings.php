<?php

namespace App\Trimstrings;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Fractal\TransformerAbstract;

class UserTrimStrings extends TransformerAbstract
{
    #定义可以include 使用的字段
    public function transform(User $user)
    {
        return [
            'id'=>$user['id'],
            'name'=>$user['name'],
        ];
    }
}
