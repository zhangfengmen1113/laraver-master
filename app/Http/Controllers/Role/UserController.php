<?php

namespace App\Http\Controllers\Role;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    //权限里面的用户管理首页
    public function index()
    {
        //dd(1);
        $users = User::paginate(10);
        return view('role.user.index',compact('users'));
    }

    //展示用户数据的页面
    public function setUserRoleCreate(User $user)
    {
        //获取所有的角色数据
        $roles = Role::all();
        //dd($roles);
        return view('role.user.set_role',compact('roles','user'));
    }

    //设置角色完成提交
    public function setUserRoleStore(User $user,Request $request)
    {
        //dd(1);
        //dd($request->roles);
        //dd($user);
        $user->syncRoles($request->roles);
        return redirect()->route('role.user.index')->with('success','设置成功');
    }
}
