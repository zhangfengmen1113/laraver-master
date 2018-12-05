<?php

namespace App\Http\Controllers\Wechat;

use App\Models\Teletext;
use App\Services\WechatService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class TeletextController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd(1);
        //读取所有回复数据
        $field = Teletext::all();

        return view('wechat.teletext.index',compact('field'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(WechatService $wechatService)
    {
        $ruleView = $wechatService->ruleView();
        return view('wechat.teletext.create',compact('ruleView'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,WechatService $wechatService)
    {
        //开启事务
        //dd($request->all());
        DB::beginTransaction();
        //dd($request->data);
        //这里的news是和微信连接有关系
        $rule = $wechatService->ruleStore('news');
        //dd($rule);
        //添加回复内容
        Teletext::create([
            'data'=>$request['data'],
            'rule_id'=>$rule['id'],
        ]);
        //事务提交
        DB::commit();
        return redirect()->route('wechat.teletext.index')->with('success','操作成功');
    }


    public function edit(Teletext $teletext,WechatService $wechatService)
    {
        //dd($teletext);
        $ruleView = $wechatService->ruleView($teletext['rule_id']);
        //dd($ruleView);
        return view('wechat.teletext.edit',compact('ruleView','teletext'));
    }


    public function update(Request $request, Teletext $teletext,WechatService $wechatService)
    {
          //dd($teletext);
        //dd($teletext['id']);
        //开启事务
        //dd($request->all());
        DB::beginTransaction();
        //dd($request->data);
        $wechatService->ruleUpload($teletext['rule_id']);
        //dd($rule);
        //添加回复内容
        $teletext->update([
            'data'=>$request['data'],
            'rule_id'=>$teletext['id'],
        ]);
        //事务提交
        DB::commit();
        return redirect()->route('wechat.teletext.index')->with('success','操作成功');
    }


    public function destroy(Teletext $teletext)
    {
        //删除数据
        $teletext->rule()->delete();
        return redirect()->route('wechat.teletext.index')->with('success','操作成功');
    }
}
