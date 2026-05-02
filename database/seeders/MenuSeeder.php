<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        // Create categories
        $coffeeCategory = Category::firstOrCreate(
            ['nama_kategori' => 'Coffee'],
            ['nama_kategori' => 'Coffee']
        );

        $snacksCategory = Category::firstOrCreate(
            ['nama_kategori' => 'Snacks'],
            ['nama_kategori' => 'Snacks']
        );

        // Create menu items
        Menu::firstOrCreate(
            ['nama_menu' => 'Forest Latte'],
            [
                'category_id' => $coffeeCategory->id,
                'nama_menu' => 'Forest Latte',
                'deskripsi' => 'House-made matcha with botanical infusions',
                'harga' => 38000,
                'is_active' => true,
            ]
        );

        Menu::firstOrCreate(
            ['nama_menu' => 'Almond Croissant'],
            [
                'category_id' => $snacksCategory->id,
                'nama_menu' => 'Almond Croissant',
                'deskripsi' => 'Double-baked with artisanal almond cream',
                'harga' => 32000,
                'is_active' => true,
            ]
        );

        Menu::firstOrCreate(
            ['nama_menu' => 'Signature Black'],
            [
                'category_id' => $coffeeCategory->id,
                'nama_menu' => 'Signature Black',
                'deskripsi' => 'Lightly roasted beans from the 72nd mountain',
                'harga' => 28000,
                'is_active' => true,
            ]
        );

        Menu::firstOrCreate(
            ['nama_menu' => 'Berry Tart'],
            [
                'category_id' => $snacksCategory->id,
                'nama_menu' => 'Berry Tart',
                'deskripsi' => 'Seasonal berries with honey glaze',
                'harga' => 35000,
                'is_active' => true,
            ]
        );
    }
}
