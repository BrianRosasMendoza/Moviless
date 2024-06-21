<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Video;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Category;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(5)->create();
        Video::factory(5)->create();
        Comment::factory(5)->create();
        Category::factory(5)->create();
        Post::factory(5)->create();
        
        

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
