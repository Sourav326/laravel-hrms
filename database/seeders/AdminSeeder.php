<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = [
            // ['name'=>'Super admin','email'=>'superadmin@yopmail.com','password'=>'superadmin@123','role'=>1],
            // ['name'=>'Admin','email'=>'admin@yopmail.com','password'=>'admin@123','role'=>2],
            ['name'=>'Kimal','email'=>'kimal@yopmail.com','password'=>'Komal@321','role'=>2],
        ];
        foreach($admins as $admin){
            $user = new User;
            $user->name = $admin['name'];
            $user->email = $admin['email'];
            $user->password = $admin['password'];
            $user->profile_image  = url('/').'/storage/images/employees/admin.png';
            $user->save();
            $user->roles()->attach($admin['role']);
        }
    }
}
