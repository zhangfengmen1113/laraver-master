<?php

namespace App\Http\Controllers\Util;

use App\Notifications\RegisterNotify;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CodeController extends Controller
{
    //发送验证码
    public function send(Request $request){
         //打印全部数据
         //dd($request->all());
         //随机获得4个数字
         $code = $this->random();
         //dd($code);die();//正常获得随机数
         //发送验证码
         //操作user模型类就会去找users表里面找数据
         //如果没有数据，firstOrNew方法会帮我们新new一个这个email
         $user = User::firstOrNew(['email'=>$request->username]);
         //dd($user);die();
         //toArray是找简单的数组，我们熟悉的那种数组
         //dd($user->toArray());
         //需要创建的通知类 (手册里面的消息通知)
         $user->notify(new RegisterNotify($code));
         //dd(11);
         //再将验证码存入session
         session()->put('code',$code);
         //验证码发送成功，返回数据
         return ['code' => 1,'message' => '验证码发送OK'];
    }
    //随机生成4个数字
    public function random($len=4){
        //给个空字符串
        $str = '';
        //循环拼组给定义的空字符串
        for($i=0;$i<$len;$i++){
            $str .= mt_rand(0,9);
        }
        return $str;
    }
}
