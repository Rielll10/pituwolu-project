<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Menu;

class PituwoluMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define Categories
        $categories = [
            'Coffee' => Category::firstOrCreate(['nama_kategori' => 'Coffee']),
            'Tea Based' => Category::firstOrCreate(['nama_kategori' => 'Tea Based']),
            'Mocktail' => Category::firstOrCreate(['nama_kategori' => 'Mocktail']),
            'Non Coffee' => Category::firstOrCreate(['nama_kategori' => 'Non Coffee']),
            'Main Course' => Category::firstOrCreate(['nama_kategori' => 'Main Course']),
            'Snacks' => Category::firstOrCreate(['nama_kategori' => 'Snacks']),

        ];

        // Wipe existing menus if needed, or just insert new ones
        // Menu::truncate();

        $menus = [
            // == COFFEE ==
            ['cat' => 'Coffee', 'nama' => 'PW Coffee', 'desc' => 'Signature Basic Coffee', 'harga' => 20000, 'ice' => true, 'ice_price' => 2000],
            ['cat' => 'Coffee', 'nama' => 'Americano', 'desc' => 'Classic Americano', 'harga' => 22000, 'ice' => true, 'ice_price' => 2000],
            ['cat' => 'Coffee', 'nama' => 'Cappuccino', 'desc' => 'Hot or Iced Cappuccino', 'harga' => 22000, 'ice' => true, 'ice_price' => 2000],
            ['cat' => 'Coffee', 'nama' => 'Coffee Latte', 'desc' => 'Smooth Coffee Latte', 'harga' => 22000, 'ice' => true, 'ice_price' => 2000],
            ['cat' => 'Coffee', 'nama' => 'Magic', 'desc' => 'Magic Coffee (Hot Only)', 'harga' => 27000, 'ice' => false, 'ice_price' => 0],
            ['cat' => 'Coffee', 'nama' => 'Espresso', 'desc' => 'Single shot espresso (Hot Only)', 'harga' => 15000, 'ice' => false, 'ice_price' => 0],
            // Flavour Coffee (Put under Coffee)
            ['cat' => 'Coffee', 'nama' => 'Vanilla Coffee', 'desc' => 'Flavour Coffee', 'harga' => 23000, 'ice' => true, 'ice_price' => 2000],
            ['cat' => 'Coffee', 'nama' => 'Caramel Coffee', 'desc' => 'Flavour Coffee', 'harga' => 23000, 'ice' => true, 'ice_price' => 2000],
            ['cat' => 'Coffee', 'nama' => 'Hazelnut Coffee', 'desc' => 'Flavour Coffee', 'harga' => 23000, 'ice' => true, 'ice_price' => 2000],
            ['cat' => 'Coffee', 'nama' => 'Butterscotch Coffee', 'desc' => 'Flavour Coffee', 'harga' => 23000, 'ice' => true, 'ice_price' => 2000],
            ['cat' => 'Coffee', 'nama' => 'Mochaccino', 'desc' => 'Flavour Coffee', 'harga' => 25000, 'ice' => true, 'ice_price' => 2000],
            ['cat' => 'Coffee', 'nama' => 'Caramel Macchiato', 'desc' => 'Flavour Coffee', 'harga' => 25000, 'ice' => true, 'ice_price' => 2000],
            // Manual Brew / Filter Coffee
            ['cat' => 'Coffee', 'nama' => 'Manual Brew', 'desc' => 'Harga mulai dari base, sesuai beans opsi', 'harga' => 25000, 'ice' => false, 'ice_price' => 0],
            ['cat' => 'Coffee', 'nama' => 'Vietnam Drip', 'desc' => 'Classic Vietnam Drip', 'harga' => 20000, 'ice' => false, 'ice_price' => 0],

            // == TEA BASED ==
            ['cat' => 'Tea Based', 'nama' => 'Lemon Tea', 'desc' => 'Fresh Lemon Tea', 'harga' => 20000, 'ice' => true, 'ice_price' => 2000],
            ['cat' => 'Tea Based', 'nama' => 'Lychee Tea', 'desc' => 'Ice Lychee Tea', 'harga' => 22000, 'ice' => false, 'ice_price' => 0],
            ['cat' => 'Tea Based', 'nama' => 'Peach Tea', 'desc' => 'Fresh Peach Tea', 'harga' => 20000, 'ice' => true, 'ice_price' => 2000],
            ['cat' => 'Tea Based', 'nama' => 'Yogurt Tea', 'desc' => 'Ice Yogurt Tea', 'harga' => 22000, 'ice' => false, 'ice_price' => 0],
            ['cat' => 'Tea Based', 'nama' => 'Artisan Tea', 'desc' => 'Special Artisan Tea', 'harga' => 20000, 'ice' => true, 'ice_price' => 2000],

            // == MOCKTAIL ==
            ['cat' => 'Mocktail', 'nama' => 'Chocoberry', 'desc' => 'Ice Mocktail', 'harga' => 30000, 'ice' => false, 'ice_price' => 0],
            ['cat' => 'Mocktail', 'nama' => 'Merah Merona', 'desc' => 'Ice Mocktail', 'harga' => 30000, 'ice' => false, 'ice_price' => 0],
            ['cat' => 'Mocktail', 'nama' => 'Abracadabra', 'desc' => 'Ice Mocktail', 'harga' => 30000, 'ice' => false, 'ice_price' => 0],
            ['cat' => 'Mocktail', 'nama' => 'Ireng n’ Orange', 'desc' => 'Ice Mocktail', 'harga' => 30000, 'ice' => false, 'ice_price' => 0],

            // == NON COFFEE ==
            ['cat' => 'Non Coffee', 'nama' => 'Vanilla Milk', 'desc' => 'Milk Based', 'harga' => 20000, 'ice' => true, 'ice_price' => 2000],
            ['cat' => 'Non Coffee', 'nama' => 'Strawberry Milk', 'desc' => 'Ice Milk Based', 'harga' => 23000, 'ice' => false, 'ice_price' => 0],
            ['cat' => 'Non Coffee', 'nama' => 'Blueberry Milk', 'desc' => 'Ice Milk Based', 'harga' => 23000, 'ice' => false, 'ice_price' => 0],
            ['cat' => 'Non Coffee', 'nama' => 'Oreo Milk', 'desc' => 'Ice Milk Based', 'harga' => 23000, 'ice' => false, 'ice_price' => 0],
            ['cat' => 'Non Coffee', 'nama' => 'Chocolate', 'desc' => 'Other Drinks', 'harga' => 23000, 'ice' => true, 'ice_price' => 2000],
            ['cat' => 'Non Coffee', 'nama' => 'Matcha', 'desc' => 'Other Drinks', 'harga' => 23000, 'ice' => true, 'ice_price' => 2000],
            ['cat' => 'Non Coffee', 'nama' => 'Red Velvet', 'desc' => 'Other Drinks', 'harga' => 23000, 'ice' => true, 'ice_price' => 2000],
            // Sparkling & Fresh
            ['cat' => 'Non Coffee', 'nama' => 'Sparkling Lemon', 'desc' => 'Sparkling & Fresh', 'harga' => 22000, 'ice' => false, 'ice_price' => 0],
            ['cat' => 'Non Coffee', 'nama' => 'Sparkling Melon', 'desc' => 'Sparkling & Fresh', 'harga' => 22000, 'ice' => false, 'ice_price' => 0],
            ['cat' => 'Non Coffee', 'nama' => 'Berry Punch', 'desc' => 'Sparkling & Fresh', 'harga' => 23000, 'ice' => false, 'ice_price' => 0],
            ['cat' => 'Non Coffee', 'nama' => 'Blue Summer', 'desc' => 'Sparkling & Fresh', 'harga' => 25000, 'ice' => false, 'ice_price' => 0],
            ['cat' => 'Non Coffee', 'nama' => 'Barberry', 'desc' => 'Ice Sparkling & Fresh', 'harga' => 23000, 'ice' => false, 'ice_price' => 0],
            ['cat' => 'Non Coffee', 'nama' => 'Mango Yakult', 'desc' => 'Ice Sparkling & Fresh', 'harga' => 25000, 'ice' => false, 'ice_price' => 0],


            // == MAIN COURSE ==
            // Ayam
            ['cat' => 'Main Course', 'nama' => 'Ayam Katsu Sambal Matah', 'desc' => 'Paket Ayam', 'harga' => 30000, 'ice' => false, 'ice_price' => 0],
            ['cat' => 'Main Course', 'nama' => 'Ayam Panggang Sambal Matah', 'desc' => 'Paket Ayam', 'harga' => 30000, 'ice' => false, 'ice_price' => 0],
            ['cat' => 'Main Course', 'nama' => 'Ayam Katsu Barbeque', 'desc' => 'Paket Ayam', 'harga' => 30000, 'ice' => false, 'ice_price' => 0],
            ['cat' => 'Main Course', 'nama' => 'Ayam Panggang Barbeque', 'desc' => 'Paket Ayam', 'harga' => 30000, 'ice' => false, 'ice_price' => 0],
            // Makanan Berat
            ['cat' => 'Main Course', 'nama' => 'Tekwan', 'desc' => 'Makanan Berat', 'harga' => 30000, 'ice' => false, 'ice_price' => 0],
            ['cat' => 'Main Course', 'nama' => 'Nasi Goreng Special', 'desc' => 'Makanan Berat', 'harga' => 25000, 'ice' => false, 'ice_price' => 0],
            ['cat' => 'Main Course', 'nama' => 'Nasi Goreng Katsu', 'desc' => 'Makanan Berat', 'harga' => 33000, 'ice' => false, 'ice_price' => 0],
            // Pasta
            ['cat' => 'Main Course', 'nama' => 'Spaghetti Bolognaise', 'desc' => 'Pasta', 'harga' => 25000, 'ice' => false, 'ice_price' => 0],
            ['cat' => 'Main Course', 'nama' => 'Spaghetti Aglio Olio', 'desc' => 'Pasta', 'harga' => 25000, 'ice' => false, 'ice_price' => 0],

            // == SNACKS ==
            // Gorengan & Cemilan
            ['cat' => 'Snacks', 'nama' => 'Mix Platter', 'desc' => 'Gorengan & Cemilan', 'harga' => 28000, 'ice' => false, 'ice_price' => 0],
            ['cat' => 'Snacks', 'nama' => 'Shihlin', 'desc' => 'Gorengan & Cemilan', 'harga' => 25000, 'ice' => false, 'ice_price' => 0],
            ['cat' => 'Snacks', 'nama' => 'Kentang Goreng', 'desc' => 'Mulai 20k / 22k', 'harga' => 20000, 'ice' => false, 'ice_price' => 0],
            ['cat' => 'Snacks', 'nama' => 'Onion Ring', 'desc' => 'Gorengan & Cemilan', 'harga' => 20000, 'ice' => false, 'ice_price' => 0],
            ['cat' => 'Snacks', 'nama' => 'Otak-Otak', 'desc' => 'Gorengan & Cemilan', 'harga' => 20000, 'ice' => false, 'ice_price' => 0],
            ['cat' => 'Snacks', 'nama' => 'Kentang Sosis', 'desc' => 'Gorengan & Cemilan', 'harga' => 25000, 'ice' => false, 'ice_price' => 0],
            ['cat' => 'Snacks', 'nama' => 'Cireng Rujak', 'desc' => 'Gorengan & Cemilan', 'harga' => 20000, 'ice' => false, 'ice_price' => 0],
            ['cat' => 'Snacks', 'nama' => 'Dimsum Mentai', 'desc' => 'Gorengan & Cemilan', 'harga' => 23000, 'ice' => false, 'ice_price' => 0],
            // Snack Lain
            ['cat' => 'Snacks', 'nama' => 'Lumpia', 'desc' => 'Snack Lain', 'harga' => 20000, 'ice' => false, 'ice_price' => 0],
            ['cat' => 'Snacks', 'nama' => 'Roti Panggang', 'desc' => 'Snack Lain', 'harga' => 20000, 'ice' => false, 'ice_price' => 0],
            ['cat' => 'Snacks', 'nama' => 'Pisang Aspal', 'desc' => 'Snack Lain', 'harga' => 23000, 'ice' => false, 'ice_price' => 0],
            ['cat' => 'Snacks', 'nama' => 'Paw Paw', 'desc' => 'Snack Lain', 'harga' => 20000, 'ice' => false, 'ice_price' => 0],
        ];

        // Specific placeholder mapping by category roughly
        $placeholders = [
            'Coffee' => 'https://images.unsplash.com/photo-1497935586351-b67a49e012bf?w=800&q=80',
            'Tea Based' => 'https://images.unsplash.com/photo-1556679343-c7306c1976bc?w=800&q=80', // Tea
            'Mocktail' => 'https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?w=800&q=80', // Mocktail
            'Non Coffee' => 'https://images.unsplash.com/photo-1515823662972-da6a2e4d3002?w=800&q=80', // Sweet drink

            'Main Course' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=800&q=80', // Food
            'Snacks' => 'https://images.unsplash.com/photo-1623653387945-2fd25214f8fc?w=800&q=80', // Fries
        ];

        foreach ($menus as $m) {
            Menu::firstOrCreate(
                [
                    'category_id' => $categories[$m['cat']]->id,
                    'nama_menu' => $m['nama'],
                ],
                [
                    'deskripsi' => $m['desc'],
                    'harga' => $m['harga'],
                    'is_ice_available' => $m['ice'],
                    'ice_extra_price' => $m['ice_price'],
                    'foto' => $placeholders[$m['cat']] ?? 'https://images.unsplash.com/photo-1554118811-1e0d58224f24?w=800&q=80',
                    'is_active' => true,
                    'is_best_seller' => false,
                ]
            );
        }

        $this->command->info('Menus have been seeded with placeholders!');
    }
}
