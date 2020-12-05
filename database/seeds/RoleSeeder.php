<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Role::create([
            'name'=>'admin',
            'display_name'=>'مدير',
            'description'=>''
        ]);

        \App\Role::create([
            'name'=>'student',
            'display_name'=>'طالب',
            'description'=>''
        ]);
    }
}
