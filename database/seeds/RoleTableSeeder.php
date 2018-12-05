<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //给个站长的角色
        Role::create([
            'title'=>'站长',
            'name'=>'webmaster',
        ]);
    }
}
