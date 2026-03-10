<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Article::factory(10)->create();

        User::create([
            'name' => 'Модератор',
            'email' => 'moder@moder.com',
            'password' => Hash::make('password'),
            'role' => 'moderator',
        ]);
    }
}