<?php

namespace App\Http\Controllers\Wechat;

use App\Models\Keyword;
use App\Models\Rule;
use App\Services\WechatService;
use Houdunwang\WeChat\WeChat;
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
        //$rule = Rule::find(1);
        //dd($rule);
        //获取所有回复内容的数据
        //$rules = json_decode($rule->replies->pluck('content')->toArray()[0], true);
        //dd($rules);//content" => "asdasda
        //从中随机一个
        //array_random是数组随机
        //$content = array_random($rules)['content'];
        //dd($content);

        //file_put_contents('abc.php',1);

        //消息管理模块
        $instance =WeChat::instance('message');

        //判断是否为关注
        if($instance->isSubscribeEvent()){

            $content = ResponseBase::find(1);
            //向用户回复消息
            return $instance->text($content['data']['subscribe']);
        }

        //判断是否是文本消息
        if ($instance->isTextMsg())
        {
            //获取粉丝发来的消息
            $content = $instance->Content;
            //向用户回复消息
            return $this->KeywordToFind($instance,$content);
        }

    }

    //根据关键词回复内容
    private function KeywordToFind($instance,$content){
         if($keyword = Keyword::where('key',$content)->first()){
             //通过关键词模型关联
             $rule = $keyword->rule;
             //file_put_contents('abc.php',$rule['type']);
             //判断是否能找到相对应的关键词
             if($rule['type']=='text'){
                 //获取所有回复内容的数据
                 $rules = json_decode($rule->replies->pluck('content')->toArray()[0], true);
                 //从中随机一个
                 //array_random是数组随机
                 $content = array_random($rules)['content'];
                 return $instance->text($content);
             }elseif ($rule['type']=='news'){
                 //获取所有回复图文的数据
                 $news = json_decode($rule->teletext->toArray()[0]['data'], true);

                 return $instance->news([$news]);
             }

         }

        //当匹配不到关键词的时候 执行默认回复
        $content = ResponseBase::find(1);
        return $instance->text($content['data']['default']);
    }
}
