<?php

namespace App\Observers;

use App\Models\Config;
use Composer\Cache;
use Symfony\Component\HttpKernel\CacheWarmer\CacheWarmerAggregate;

class ConfigObserver
{
    public function created()
    {
        //dd(1);
        $this->ConfigToCache();
    }

    public function updated()
    {
        //dd(2);
        $this->ConfigToCache();
    }

    private function ConfigToCache()
    {
        //缓存永久存储Cacha::forever（'key','value）
        //pluck（'下标'，'值'）获取一列的值
        \Cache::forever('config_cache',Config::pluck('data','name'));
    }
}
