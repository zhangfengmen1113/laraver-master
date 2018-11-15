<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordRequest;
use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //中间件
    public function __construct()
    {
        //保护管理员登录
        //中间件第一个参数是游客参数'guest',第二个参数是游客以后仅仅能访问哪些功能，是个数组
       $this->middleware('guest',[
           'only'=> ['login','userLogin','register','StorageChgPassword','changePassword','store']
       ]);
    }

    //加载登录页面
    public function login(){
        //加载模板
        //dd(1);
        return view('user.login');
    }

    //用户登录
    public function userLogin(Request $request){
        //登录验证
        //dd(1);die();
        $this->validate($request,[
             'email'   =>'email',
             'password'=> 'required|min:2'
        ],[
            'email.email'       => '请输入正常邮箱',
            'password.required' => '请输入密码',
            'password.min'      => '密码不对'
        ]);
        //手册：用户认证里面的手动用户认证
        //执行登录
        $credentials = $request->only('email', 'password');

        if (\Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->route('index')->with('success','登录成功');
        }
        //反之刷新页面，登录失败
        return redirect()->back()->with('danger','输入有误');
    }
    //注销用户
    public function loginOut(){
        \Auth::logout();
        //返回首页
        return redirect()->route('index');
    }
    //加载注册页面
    public function register(){
        //加载模板
        return view('user.register');
    }

    //修改密码
    public function StorageChgPassword(){
        //dd(1);
        return view('user.password');
    }

    //修改密码完成提交
    public function changePassword(PasswordRequest $request){
        //dd(1);
        //dd($request->all());
        //打印根据用户发送过来的邮箱去查找数据
        $res = User::where('email',$request->email)->first();
        //dd($res);
        if ($res){
           $res->password = bcrypt($request->password);
           //save这个方法是保存的意思
           $res->save();
           return redirect()->route('user.login')->with('success','OK啦，一定要记牢噢~');
        }
        return redirect()->back()->with('danger','朋友，邮箱没注册');
    }

    //用户提交注册
    public function store(UserRequest $request){
        //测试正常post输出
        //dd($request->all());
        //现在将数据存储到数据库里面去
        $req = $request->all();
        //dd($req);
        //bcrypt是laravel里面加密密码的函数
        $req['password'] = bcrypt($req['password']);
        //dd($req);
        //静态
        //UserRequest::create($data);
        User::create($req);
        //dd($request->all());
        //提示并跳转 redirect重定向，重新跳转的意思  with把注册OK存入success
        return redirect()->route('user.login')->with('success','注册OK，成功跳转');

    }
}
