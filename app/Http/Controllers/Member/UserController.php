<?php

namespace App\Http\Controllers\Member;

use App\Models\Article;
use App\Models\Category;
use App\User;
use foo\bar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user,Request $request)
    {
        //接受category参数
        $category = $request->query('category');
        //dd($category);
        $articles =  Article::latest();
        if ($category){
            $articles = $articles->where('category_id',$category);
        }
        $articles = $articles->where('user_id',$user->id)->paginate(5);
        //dd($articles);
        //获取所有栏目
        $categorise = Category::all();
        //dd($categorise);
        return view('member.user.show',compact('user','articles','categorise'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user,Request $request)
    {
        //调用策略
        $this->authorize('isMine',$user);
        //接受type参数
        $type = $request->query('type');
        //dd($type);
        //接受category参数
        $category = $request->query('category');
        //dd($category);
        $articles =  Article::latest();
        if ($category){
            $articles = $articles->where('category_id',$category);
        }
        $articles = $articles->where('user_id',$user->id)->paginate(5);
        //获取所有栏目
        $categorise = Category::all();
        return view('member.user.edit_'.$type,compact('user','articles','categorise'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //获取所有数据
        $data = $request->all();
        //手册：表单验证里面的有条件的添加规则
        $this->validate($request,[
            'password' => 'sometimes|required|min:3|confirmed',
            'name'     => 'sometimes|required|unique:users',
        ],[
            'password.required' =>'新密码不能不写噢~',
            'password.min'      =>'密码太短啦~',
            'password.confirmed'=>'两次密码输入不一样呀~',
            'name.required'     =>'新昵称不能不写噢~',
            'name.unique'       =>'新昵称不能和旧昵称一样哦'
        ]);
        //判断如果有密码框输入就加密，没有就不加密
        if($request['password']){
            $data['password'] = bcrypt($data['password']);
        }
        //执行更新
        $user->update($data);
        //跳转弹窗
        return back()->with('success','修改密码成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
