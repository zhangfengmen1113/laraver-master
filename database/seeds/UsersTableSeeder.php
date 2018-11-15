<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
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
        factory(\App\User::class, 5)->create();
        //修改第一个数据
        $user = \App\User::find(1);

        $user->name = '郭宇鹏';
        $user->email = '2524346947@qq.com';
        $user->password = bcrypt('123');
        $user->is_admin = true;
        $user->save();
    }
}