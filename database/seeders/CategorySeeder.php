<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Coffee',
            'Non-Coffee',
            'Tea-Based',
            'Mocktail',
            'Main Course',
            'Snacks',
        ];

        foreach ($categories as $name) {
            Category::updateOrCreate(
                ['nama_kategori' => $name],
                ['nama_kategori' => $name]
            );
        }
    }
}
