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
        $categories = [
            [
                'name' => 'Elektronik',
                'description' => 'Elektronik ürünler',
                'slug' => 'elektronik',
            ],
            [
                'name' => 'Kitap',
                'description' => 'Kitaplar',
                'slug' => 'kitap',
            ],
            [
                'name' => 'Giyim',
                'description' => 'Giyim ürünleri',
                'slug' => 'giyim',
            ],
            [
                'name' => 'Mobilya',
                'description' => 'Mobilya ürünleri',
                'slug' => 'mobilya',
            ],
        ];

        if (Category::count() > 0) {
            return;
        }

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
