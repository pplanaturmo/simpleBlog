<?php
// PostSeeder.php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        // Seed three posts for each category
        $categories = DB::table('categories')->pluck('id');

        foreach ($categories as $categoryId) {
            for ($i = 1; $i <= 3; $i++) {
                $categoryId = ''.$categoryId;
                DB::table('posts')->insert([
                    'user_id' => rand(1, 3),
                    'category_id' => $categoryId,
                    'image_name' => null,
                    'slug' => Str::slug("Post $i Category $categoryId"),
                    'title' => "Post $i",
                    'content' => "Content for Post $i in Category $categoryId",
                    'is_published' => ($i === 1), // Mark the first post as unpublished
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}

