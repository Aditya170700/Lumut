<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        \App\Models\User::create([
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'name' => 'Admin',
            'role' => 'admin',
        ]);

        \App\Models\User::create([
            'username' => 'author',
            'password' => bcrypt('author'),
            'name' => 'Author',
            'role' => 'author',
        ]);
    }
}
