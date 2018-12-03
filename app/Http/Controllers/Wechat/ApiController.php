<?php

namespace App\Http\Controllers\Wechat;

use App\Services\WechatService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * 跟微信通信
 * Class ApiController
 *
 * @package App\Http\Controllers\Wechat
 */
class ApiController extends Controller
{
    //微信的后台接口配置 url填写的地址指向这里
    //调用WechatService，该类构造方法有微信通过验证
    public function port(WechatService $wechatService){
           //echo 111;
    }
}
