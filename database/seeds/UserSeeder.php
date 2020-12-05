<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin=\App\User::create([
            'name'=>'admin',
            'username'=>'admin',
            'email'=>'admin@admin.com',
            'password'=>bcrypt('admin123')
        ]);
        $adminRole=\App\Role::where('name','admin')->first();
        $admin->roles()->attach($adminRole);

        $student=\App\User::create([
            'name'=>'student',
            'username'=>'student',
            'email'=>'student@student.com',
            'password'=>bcrypt('admin123')
        ]);
        $studentRole=\App\Role::where('name','student')->first();
        $student->roles()->attach($studentRole);
    }
}
