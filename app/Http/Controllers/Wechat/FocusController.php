<?php

namespace App\Http\Controllers\Wechat;

use App\Http\Controllers\Controller;
use App\Models\Focus;
use Illuminate\Http\Request;

class FocusController extends Controller
{

    public function create()
    {
        $field = Focus::find(1);
        //dd($field);
        return view('wechat.focus.create',compact('field'));
    }


    public function store(Request $request)
    {
        $focus = Focus::firstOrNew(['id'=>1]);
        $focus['data'] = $request->all();
        $focus->save();
        return back()->with('success','操作成功');
    }

}
