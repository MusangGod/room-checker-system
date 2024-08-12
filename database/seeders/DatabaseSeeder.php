<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use App\Models\Author;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        User::create([
            "username" => "admin1",
            "email" => "admin@gmail.com",
            "password" => bcrypt("admin123"),
            "role" => "admin"
        ]);
        $get_user_admin = User::latest()->first();

        Admin::create([
            "user_id" => $get_user_admin->id, 
            "name" => "Admin 1"
        ]);

        User::create([
            "username" => "author1",
            "email" => "author1@gmail.com",
            "password" => bcrypt("author123"),
            "role" => "author"
        ]);
        $get_user_author = User::latest()->first();

        Author::create([
            "user_id" => $get_user_author->id,
            "name" => "Author 1"
        ]);

        $post = Post::create([
            "title" => "Post 1",
            "slug" => "post-1",
            "content" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vel ipsum ac nisi tincidunt feugiat. Sed vel ipsum ac nisi tincidunt feugiat.",
            "user_id" => 1,
            "status" => "published"
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
        
        $post->tags()->attach([1, 2]);
    }
}
