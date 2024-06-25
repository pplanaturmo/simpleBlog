<?php
// CategorySeeder.php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Seed two categories
        DB::table('categories')->insert([
            [
                'name' => 'Category One',
                'slug' => Str::slug('Category One'),
            ],
            [
                'name' => 'Category Two',
                'slug' => Str::slug('Category Two'),
            ],
        ]);
    }
}
