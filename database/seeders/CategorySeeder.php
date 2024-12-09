<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['name' => 'Technology']);
        Category::create(['name' => 'Health']);
        Category::create(['name' => 'Lifestyle']);
        Category::create(['name' => 'Travel']);
        Category::create(['name' => 'Food']);
        Category::create(['name' => 'Finance']);
        Category::create(['name' => 'Education']);
        Category::create(['name' => 'Entertainment']);
    }
}
