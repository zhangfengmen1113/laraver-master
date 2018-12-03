<?php

namespace App\Http\Controllers\Wechat;

use App\Models\Button;
use App\Services\WechatService;
use Houdunwang\WeChat\WeChat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ButtonController extends Controller
{
    //微信管理的首页
    public function index()
    {
        //dd(1);
        $buttons = Button::latest()->paginate(10);
        //dd($buttons);
        //引入模板页面
        return view('wechat.button.index',compact('buttons'));
    }

    //微信管理添加的模板页面
    public function create()
    {
         return view('wechat.button.create');
    }

    //微信管理实现添加功能的方法
    public function store(Request $request)
    {
       Button::create($request->all());
       return redirect()->route('wechat.button.index')->with('success','菜单添加成功');
       //dd($ee);
    }

    //微信管理编辑的模板页面
    public function edit(Button $button)
    {
        return view('wechat.button.edit',compact('button'));
    }

    //微信管理编辑功能实现的方法
    public function update(Request $request, Button $button)
    {
        //dd(1);
        $button->update($request->all());
        return redirect()->route('wechat.button.index')->with('success','菜单编辑成功');
    }

    //微信管理删除功能实现的方法
    public function destroy(Button $button)
    {
        //dd(1);
        $button->delete();
        return redirect()->back()->with('success','菜单删除成功');
    }

    //将微信菜单推送到公众号
    //推送菜单之前 先实例化WechatService,该类构造方法有微信通信验证
    public function push(Button $button,WechatService $wechatService)
    {
         //dd(1);
        //dd($button);
        //dd($wechatService);
        //将原来的数据库json格式的数据转换为数组形式
        $menu = json_decode($button['data'],true);
        //dd($menu);
        $res = WeChat::instance('button')->create($menu);
        //$dd = $button->update(['status'=>1]);
        //dd($dd);
        //dd($res);
        if($res['errcode'] == 0){
            //将当前的数据表里面的status改为1，其余改为0
            $button->update(['status'=>1]);
            //id 这是id是数据表里面的id，$button->id是参数传过来的数据里面的id
            Button::where('id','!=',$button->id)->update(['status'=>0]);
            //dd($dd);
            //弹窗
            return back()->with('success','菜单推送OK');
        }else{
            return back()->with('danger',$res['errmsg']);
        }
    }
}
