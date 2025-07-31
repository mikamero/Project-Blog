<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use App\Models\PostCategory;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            postcategorySeeder::class,
            userSeeder::class,
            postseeder::class,
        ]);
    }
}
