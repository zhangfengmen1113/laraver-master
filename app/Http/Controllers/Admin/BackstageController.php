<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BackstageController extends Controller
{
    //后台首页
    public function index(){
        //加载模板
       return view('admin.index.index');
    }
}
