<?php

namespace Database\Seeders;

use App\Models\Administrator;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(0)->create();
        Category::factory(0)->create();
        Post::factory(0)->create();
        Comment::factory(0)->create();
        Administrator::factory(1)->create();
    }
}
