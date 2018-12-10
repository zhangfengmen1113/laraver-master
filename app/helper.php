<?php
//dd(1);
//助手函数
if (!function_exists('hd_config')){
     //帮助读取后台配置项的数据
    function hd_config($var)
    {
        //dd($var);//upload.type
        static $cache = [];
        $info = explode('.', $var);
        //dd($info);
        if (!$cache) {

            //获取缓存中config_cache数据,如果数据不存在，它会以第二个参数做为默认值
            $cache = Cache::get('config_cache', function () {
                return \App\Models\Config::pluck('data', 'name');
            });
            //dd($cache);
            //dd(hd_config('upload.type'));
        }
        return $cache[$info[0]][$info[1] ?? ''];

    }
}

//检测当前用户是否为设置的那个角色
function hdHasRole($role){

    if(!auth()->user()->hasRole($role)){

        throw new \App\Exceptions\AuthException('别进来了，兄弟~');
    }
}