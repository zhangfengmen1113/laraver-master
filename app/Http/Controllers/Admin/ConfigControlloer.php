<?php

namespace App\Http\Controllers\Admin;

use App\Models\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConfigControlloer extends Controller
{
    //加载模板页面
    public function edit($name)
    {
        //dd($name);
        //dd(1);
        //获取配置项的所有的数据
        $config = Config::firstOrnew(
            ['name'=>$name]
        );
        return view('admin.config.edit_'.$name,compact('name','config'));
    }

    //数据的更新和添加
    public function update($name,Request $request)
    {

         //updateOrcreate 更新或者添加 手册里面
        $res = Config::updateOrcreate(
            //查询条件
            ['name'=>$name],
            //如果直接写$request->all() 会报错，因为他是json格式的字符串
            //所以我们需要借助casts这个模型
            //更新或者添加的数据
            ['name'=>$name,'data'=>$request->all()]
        );
         hd_edit_env($request->all());
        //dd(1);
        //跳转
        return back()->with('success','配置更新成功');
    }
}
