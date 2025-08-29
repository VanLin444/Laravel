<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Post;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $tags = Tag::factory(10)->create();
        Category::factory(10)->create();
        $posts = Post::factory(100)->create();

        foreach ($posts as $post) {
            $tagsIds = $tags->random(3)->pluck('id');
            $post->tags()->attach($tagsIds);
        }
        // User::factory(10)->create();

        /* User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]); */
    }
}
