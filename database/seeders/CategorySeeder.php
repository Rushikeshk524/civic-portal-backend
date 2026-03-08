<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = [
            ['category_name' => 'Pothole'],
            ['category_name' => 'Garbage'],
            ['category_name' => 'Water Leakage'],
            ['category_name' => 'Broken Streetlight'],
            ['category_name' => 'Sewage Problem'],
            ['category_name' => 'Encroachment'],
        ];

        foreach ($categories as $category){
            Category::create($category);
        }
    }
}
