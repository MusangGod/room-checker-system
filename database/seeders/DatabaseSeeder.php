<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\PostStatus;
use App\Enums\Role;
use App\Models\Admin;
use App\Models\Author;
use App\Models\Post;
use App\Models\Staff;
use App\Models\SuperAdmin;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::create([
            "username" => "admin1",
            "email" => "admin@gmail.com",
            "password" => bcrypt("123456"),
            "role" => Role::ADMIN
        ]);
        $get_user_admin = User::where('username', $admin->username)->first();

        Admin::create([
            "user_id" => $get_user_admin->id,
            "name" => "Admin 1"
        ]);

        $staff = User::create([
            "username" => "staff1",
            "email" => "staff1@gmail.com",
            "password" => bcrypt("123456"),
            "role" => Role::STAFF
        ]);
        $get_user_staff = User::where('username', $staff->username)->first();

        Staff::create([
            "user_id" => $get_user_staff->id,
            "name" => "Staff 1",
            "staff_number" => "123456"
        ]);
    }
}
