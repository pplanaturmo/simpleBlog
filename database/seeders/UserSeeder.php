<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Seed three users (authors)
        DB::table('users')->insert([
            [
                'name' => 'Author One',
                'email' => 'author1@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Author Two',
                'email' => 'author2@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Author Three',
                'email' => 'author3@example.com',
                'password' => Hash::make('password'),
            ],
        ]);
    }
}
