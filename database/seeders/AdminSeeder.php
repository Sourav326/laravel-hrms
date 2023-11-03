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
        $user = new User;
        $user->name = 'admin';
        $user->email = 'admin@yopmail.com';
        $user->role  = 'admin';
        $user->password  = bcrypt('admin@123');
        $user->profile_image  = url('/').'/storage/images/employees/admin.png';
        $user->save();
    }
}
