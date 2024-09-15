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
        // User::factory(10)->create();

        $super_admin = User::create([
            "username" => "super_admin1",
            "email" => "super.admin@gmail.com",
            "password" => bcrypt("123456"),
            "role" => Role::SUPER_ADMIN
        ]);
        $get_user_super_admin = User::where('username', $super_admin->username)->first();

        SuperAdmin::create([
            "user_id" => $get_user_super_admin->id,
            "name" => "Super Admin"
        ]);

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

        $post = Post::create([
            "title" => "Post 1",
            "slug" => "post-1",
            "content" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vel ipsum ac nisi tincidunt feugiat. Sed vel ipsum ac nisi tincidunt feugiat.",
            "user_id" => $get_user_staff->id,
            "status" => PostStatus::PUBLISHED
        ]);

        Tag::create([
            "name" => "Entertainment",
            "slug" => "entertainment"
        ]);
        Tag::create([
            "name" => "Sport",
            "slug" => "sport"
        ]);
        Tag::create([
            "name" => "Academic",
            "slug" => "academic"
        ]);

        $get_tags = Tag::all()->pluck('id');

        $post->tags()->attach($get_tags);
    }
}
