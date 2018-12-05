<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //dd(1);
        //手册：数据填充里面使用模型工厂
        factory(\App\User::class, 10)->create();
        //修改第一个数据
        $user = \App\User::find(1);

        $user->name = '猪猪男孩';
        $user->email = '962306215@qq.com';
        $user->password = bcrypt('123');
        $user->is_admin = true;
        $user->save();
    }
}