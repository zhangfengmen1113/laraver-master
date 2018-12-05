<?php

namespace App\Http\Controllers\Wechat;

use App\Models\Replies;
use App\Services\WechatService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RepliesController extends Controller
{

    public function index()
    {
        //读取所有回复数据
        $field = Replies::all();
        //dd($field);
        return view('wechat.replies.index',compact('field'));
    }


    public function create(WechatService $wechatService)
    {
        $ruleView = $wechatService->ruleView();
        return view('wechat.replies.create',compact('ruleView'));
    }


    public function store(Request $request,WechatService $wechatService)
    {
        //开启事务
        //dd($request->all());
        DB::beginTransaction();
        //dd($request->data);
        $rule = $wechatService->ruleStore('text');
        //dd($rule);
        //添加回复内容
        Replies::create([
            'content'=>$request['data'],
            'rule_id'=>$rule['id'],
        ]);
        //事务提交
        DB::commit();
        return redirect()->route('wechat.reply.index')->with('success','操作成功');
    }


    public function edit(Replies $reply,WechatService $wechatService)
    {
         //dd($reply);
         //dd($replies);
         $ruleView = $wechatService->ruleView($reply['rule_id']);
         //dd($ruleView);
         return view('wechat.replies.edit',compact('ruleView','reply'));
    }


    public function update(Request $request, Replies $reply,WechatService $wechatService)
    {
        //开启事务
        //dd($reply);
        //dd($request->all());
        DB::beginTransaction();
        //dd($request->data);
        $wechatService->ruleUpload($reply['rule_id']);
        //dd($rule);
        //添加回复内容
        $reply->update([
            'content'=>$request['data'],
            'rule_id'=>$reply['id'],
        ]);
        //事务提交
        DB::commit();
        return redirect()->route('wechat.reply.index')->with('success','操作成功');
    }


    public function destroy(Replies $reply)
    {
        //删除数据
        //dd($replies);
        $reply->rule()->delete();
        return redirect()->route('wechat.reply.index')->with('success','操作成功');

    }
}
