<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Models\Module;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin.auth', [
            'except' => [],
        ]);
    }

    //权限列表
    public function index(){
        //获取modules所有数据
        $modules = Module::all();
        //dd($modules->toArray());
        //加载模板
        return view('role.permission.index',compact('modules'));
    }
}
