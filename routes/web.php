<?php

//首页
Route::get('/','Index\IndexController@index')->name('index');

//前台管理
Route::group(['prefix'=>'index','namespace'=>'Index','as'=>'index.'],function (){
    //首页
    Route::get('/','IndexController@index')->name('index');
    //文章管理
    Route::resource('article','ArticleController');
    //评论
    Route::resource('comment','CommentController');
    //点赞 取消赞
    Route::get('zan/like','ZanController@like')->name('zan.like');
    //收藏 取消收藏
    Route::get('enshrine/ens','EnshrineController@ens')->name('enshrine.ens');
    //搜索
    Route::get('search','IndexController@search')->name('search');
});

//会员中心
Route::group(['prefix'=>'member','namespace'=>'Member','as'=>'member.'],function (){

    //用户管理
    Route::resource('user','UserController');
    //关注和取消关注
    Route::get('/attention/{user}','UserController@attention')->name('attention');
    //我的粉丝
    Route::get('get_fans/{user}','UserController@myFans')->name('my_fans');
    //我的关注
    Route::get('get_following/{user}','UserController@myFollowing')->name('my_following');
    //我的点赞
    Route::get('get_like/{user}','UserController@myLike')->name('my.like');
    //我的收藏
    Route::get('get_enshrine/{user}','UserController@myEnshrine')->name('my.enshrine');
    //我的消息
    Route::get('notify/{user}','NotifyController@index')->name('notify');
    //标记已读
    Route::get('notify/show/{notify}','NotifyController@show')->name('notify.show');
});

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
Route::group(['prefix'=>'util','namespace'=>'Util','as'=>'util.'],function (){
    //发送验证码
    Route::any('/code/send','CodeController@send')->name('code.send');
    //上传
    Route::any('/upload','UploadController@uploader')->name('upload');
    Route::any('/filesLists','UploadController@filesLists')->name('filesLists');
});


//后台管理
//Route::get('index','Admin\BackstageController@index')->name('admin.index');
Route::group(['middleware'=>['admin.auth'],'prefix'=>'admin','namespace'=>'Admin','as'=>'admin.'],function (){
    Route::get('index','BackstageController@index')->name('index');
    Route::get('category/home','CategoryController@home')->name('category.home');
    //创建模型同时创建迁移文件和工厂
    //artisan make:model --migration --factory Models/Category
    //创建控制器指定模型
    //artisan make:controller --model=Models/Category Admin/CategoryController
    Route::resource('category','CategoryController');
    //配置项管理
    Route::get('config/edit/{name}','ConfigControlloer@edit')->name('config.edit');
    Route::post('config/update/{name}','ConfigControlloer@update')->name('config.update');
});

//微信配置
Route::group(['prefix'=>'wechat','namespace'=>'Wechat','as'=>'wechat.'],function (){
    //菜单管理
    Route::resource('button','ButtonController');
    //推送到微信上去的路由
    Route::get('button/push/{button}','ButtonController@push')->name('button.push');
    //微信通信地址
    Route::any('api/port','ApiController@port')->name('api.port');
    //文本回复
    Route::resource('reply','RepliesController');
    //图文回复
    Route::resource('teletext','TeletextController');
    //基本回复
    Route::resource('focus','FocusController');
});

//轮播图设置
Route::group(['prefix'=>'pager','namespace'=>'Pager','as'=>'pager.'],function (){
    //Img管理
    Route::resource('photo','PhotoController');
});

//管理员权限
Route::group(['prefix'=>'role','namespace'=>'Role','as'=>'role.'],function (){
    //角色管理
    Route::resource('role','RoleController');
    //权限列表
    Route::get('permission/index','PermissionController@index')->name('permission.index');
});