<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Models\Module;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin.auth', [
            'except' => [],
        ]);
    }

    public function index()
    {
        $roles = Role::all();
        //dd($roles->toArray());
        return view('role.role.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('role.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        Role::create($request->all());
        return redirect()->route('role.role.index')->with('success','添加成功');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('role.role.edit',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //dd(1);
        $role->update($request->all());
        return redirect()->route('role.role.index')->with('success','编辑成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('role.role.index')->with('success','删除成功');

    }

    //设置权限的模板页面
    public function show(Role $role)
    {
        $modules = Module::all();
        //dump($modules->toArray());
        return view('role.role.give_permission',compact('modules','role'));
    }

    //设置权限功能的页面
    public function setRolePermission(Role $role,Request $request)
    {
        //dd($request->all());
        //dump($request->all());die();
        //给角色添加权限
        $role->syncPermissions($request->permission);
        return redirect()->route('role.role.index')->with('success','设置成功');
    }
}
