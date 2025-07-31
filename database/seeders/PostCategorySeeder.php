<?php

namespace Database\Seeders;

use App\Models\PostCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PostCategory::create([
            'name' => 'Web Programming',
            'slug' => 'web-programming',
            'color' => 'bg-red-100'
        ]);

        PostCategory::create([
            'name' => 'Web Design',
            'slug' => 'web-design',
            'color' => 'bg-green-100'
        ]);

        PostCategory::create([
            'name' => 'Artificial Intelligence',
            'slug' => 'ai',
            'color' => 'bg-blue-100'
        ]);
    }
}
