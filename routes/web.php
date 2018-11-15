<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//首页
Route::get('/','Index\IndexController@index')->name('index');

//用户管理
Route::get('/user/register','UserController@register')->name('user.register');
//注册提交
Route::post('/user/register','UserController@store')->name('user.store');
//登录页面
Route::get('/user/login','UserController@login')->name('user.login');
//用户登录
Route::post('/user/login','UserController@userLogin')->name('user.login');
//用户注销
Route::get('/user/loginOut','UserController@loginOut')->name('user.loginOut');
//修改密码
Route::get('/user/password','UserController@StorageChgPassword')->name('user.password');
//修改密码提交
Route::post('/user/changePassword','UserController@changePassword')->name('user.changePassword');

//工具
Route::any('/code/send','Util\CodeController@send')->name('code.send');

//后台
//Route::get('index','Admin\BackstageController@index')->name('admin.index');
Route::group(['middleware'=>['admin.auth'],'prefix'=>'admin','namespace'=>'Admin','as'=>'admin.'],function (){
    Route::get('index','BackstageController@index')->name('index');
});