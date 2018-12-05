<?php

namespace App\Console\Commands;

use App\Models\Module;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class HdModule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hd_module';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //users 用户表
        //一个用户可以有多个角色，一个角色也可以有多个用户，所以是多对多的关系
        //因此需要一张中间表 model_has_roles
        //roles 角色表
        //一个角色可以有多个权限，一个权限也可以有多个角色，所以也是多对多的关系
        //因此需要一张中间表 role_has_permissions
        //permissions 权限表

        //扫描出app/Http/Controllers里面所有的文件
        $modules = glob('app/Http/Controllers/*');
        //dd($module);
        //开始创目录
        foreach ($modules as $module){
            //目录
            //dump($module);
            if(is_dir($module . '/System')){
                 //dump($module);
                 //获取整个目录最后的一部分 获取模块英文标识
                 $system = basename($module);
                 //dump($system);
                 //获取模块中文名称
                 $config = include $module . '/System/config.php';
                 //dump($config);
                 //获取模块所有权限
                 $permissions = include $module . '/System/permission.php';
                 //dump($permission);
                 //执行这句代码，把数据传入数据库里面 modules:name title permission
                 Module::firstOrNew(['name'=>$system])->fill([
                      'title'=>$config['app'],
                      'permissions'=>$permissions,
                 ])->save();
                 //dump($permission);
                 //将所有的权限写入数据库
                 //执行这句代码，把数据传入数据库里面 modules:name title permission
                foreach($permissions as $permission){
                    Permission::firstOrNew(['name'=>$system . '~' . $permission['name']])->fill([
                        'title'=>$permission['title'],
                        'module'=>$system
                    ])->save();
                }
            }
        }

        //===================================//
        //给指定一个用户设置成为站长角色，可以拥有所有的权限
        //设置站长角色前，需要填充下角色文件，然后将所有权限设置给站长
        //找到站长这个角色
        $role = Role::where('name','webmaster')->first();
        //dd($role);
        //获取所有的权限
        $permissions = Permission::pluck('name');
        //dd($permissions);
        //给角色同步拥有权限
        //执行完这代码，role_has_permissions 里面就会有数据
        $role->syncPermissions($permissions);
        //获得设置成为站长的那个用户
        $user = User::find(1);
        //dd($user);
        //给用户同步权限
        //执行完这代码，model_has_roles 里面就会有数据
        $user->assignRole('webmaster');
        //现在就清楚缓存数据
        app()['cache']->forget('spatie.permission.cache');
        //提示成功的消息
        $this->info('permission init successfully');
        //===================================//
    }
}
