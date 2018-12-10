<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends CommonController
{
    public function __construct()
    {
        // 除login外都需要验证
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    //登录请求
    public function login()
    {
        //dd(\request()->only(['email','password']));
        if (!$token = auth('api')->attempt(request()->only(['email', 'password']))) {
            //登录失败
            return $this->response->errorUnauthorized('帐号或密码错误');
        }
        //登录成功
        return $this->respondWithToken($token);
    }

    //响应token
    protected function respondWithToken($token)
    {
        //dd(auth('api')->factory()->getTTL());
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
        ]);
    }

    //退出登录
    public function logout()
    {
        auth('api')->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    //我的
    public function me()
    {
        return response()->json(auth('api')->user());
    }
}
