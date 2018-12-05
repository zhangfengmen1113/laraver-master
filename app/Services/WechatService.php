<?php
namespace App\Services;

use App\Models\Keyword;
use App\Models\Rule;
use Houdunwang\WeChat\WeChat;
use Illuminate\Http\Request;

class WechatService{

    public function __construct()
    {
        ob_clean();
        //与微信通讯绑定
        //读取config里面的hd_wechat文件
        //config()读取框架配置项,框架配置项读取env对应数据,env数据来源于我们自己后台
        $config = config('hd_wechat');//config是个函数框架
        //dd($config);
        WeChat::config($config);
        WeChat::valid();
    }
      //加载规则视图文件
      public function ruleView($rule_id=0){
           //dd($rule_id);
          //我们要根据规则id去找旧数据
          $rule = Rule::find($rule_id);
          //dd($rule);//null

          $ruleData = [
              //规则名称
              'name' => $rule?$rule['name']:'',
              'keywords'=> $rule?$rule->keyword()->select('key')->get()->toArray():[],
          ];
          //dd(json_encode($ruleData));
          //dd($ruleData);
          //dd($rule);
          ///dd($rule->keyword()->select('key')->get()->toArray());
          return view('wechat.layouts.rule',compact('ruleData'));
      }

      //添加数据
      public function ruleStore($type){
          //dd(1);
          //dd($type);//news
          $post = request()->all();
          //dd($post);
          $rule = json_decode($post['rule'], true);
          //dd($rule);
          //dd($rule);
          //执行规则表的添加
          \Validator::make($rule,[
               'name'=> 'required',
          ],[
              'name.required'=> '规则名称没填'
          ]);
          $ruleModel = Rule::create(['name'=> $rule['name'],'type'=>$type]);
          //dd($rule['keywords']);
          //关键词添加
          foreach ($rule['keywords'] as $value){
              Keyword::create([
                  'key'=>$value['key'],
                  'rule_id'=>$ruleModel['id']
              ]);
          }
          return $ruleModel;
      }

      //编辑数据
      public function ruleUpload($rule_id){
          //dd(1);
          //dd($rule_id);//7
          //执行数据的编辑
          $rule = Rule::find($rule_id);
          //dd($rule);
          $post = request()->all();
          //dd($post);
          $ruleData = json_decode($post['rule'], true);
          //dd($ruleData);
          $rule->update(['name'=>$rule['name']]);
               //删除数据

               $rule->keyword()->delete();
               foreach ($ruleData['keywords'] as $value){
                  Keyword::create([
                      'key'=>$value['key'],
                      'rule_id'=>$rule_id
                  ]);
               }
          //return $rule;
      }
}