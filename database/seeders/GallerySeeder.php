<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        $galleries = [
            [
                'title' => 'Cozy Corner',
                'description' => 'Our signature cozy corner with plants',
                'image' => 'https://images.unsplash.com/photo-1497935586351-b67a49e012bf?q=80&w=2071&auto=format&fit=crop',
                'sort_order' => 1,
            ],
            [
                'title' => 'Workspace Setup',
                'description' => 'Perfect workspace for productivity',
                'image' => 'https://images.unsplash.com/photo-1511920170033-f8396924c348?q=80&w=1974&auto=format&fit=crop',
                'sort_order' => 2,
            ],
            [
                'title' => 'Coffee Bar',
                'description' => 'Our professional coffee bar',
                'image' => 'https://images.unsplash.com/photo-1521017419570-f26d2dea710c?q=80&w=2070&auto=format&fit=crop',
                'sort_order' => 3,
            ],
            [
                'title' => 'Ambiance',
                'description' => 'Warm and welcoming ambiance',
                'image' => 'https://images.unsplash.com/photo-1554118811-1e0d58224f24?q=80&w=2047&auto=format&fit=crop',
                'sort_order' => 4,
            ],
            [
                'title' => 'Interior',
                'description' => 'Modern interior design',
                'image' => 'https://images.unsplash.com/photo-1600093463592-8e36ae95ef56?q=80&w=2070&auto=format&fit=crop',
                'sort_order' => 5,
            ],
            [
                'title' => 'Seating Area',
                'description' => 'Comfortable seating arrangements',
                'image' => 'https://images.unsplash.com/photo-1542181961-9590d0c79dab?q=80&w=2070&auto=format&fit=crop',
                'sort_order' => 6,
            ],
            [
                'title' => 'Tea Selection',
                'description' => 'Variety of tea selections',
                'image' => 'https://images.unsplash.com/photo-1504630083234-14187a9df0f5?q=80&w=2070&auto=format&fit=crop',
                'sort_order' => 7,
            ],
            [
                'title' => 'Green Space',
                'description' => 'Natural plants and greenery',
                'image' => 'https://images.unsplash.com/photo-1445116572660-236099ec97a0?q=80&w=2071&auto=format&fit=crop',
                'sort_order' => 8,
            ],
            [
                'title' => 'Pastries Display',
                'description' => 'Fresh pastries display',
                'image' => 'https://images.unsplash.com/photo-1559305616-3f99cd43e353?q=80&w=2026&auto=format&fit=crop',
                'sort_order' => 9,
            ],
            [
                'title' => 'Kitchen Area',
                'description' => 'Our kitchen preparation area',
                'image' => 'https://images.unsplash.com/photo-1461023058943-07fcbe16d735?q=80&w=2069&auto=format&fit=crop',
                'sort_order' => 10,
            ],
            [
                'title' => 'Outdoor Seating',
                'description' => 'Outdoor seating area',
                'image' => 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?q=80&w=2070&auto=format&fit=crop',
                'sort_order' => 11,
            ],
            [
                'title' => 'Evening Vibes',
                'description' => 'Evening atmosphere of the cafe',
                'image' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?q=80&w=1974&auto=format&fit=crop',
                'sort_order' => 12,
            ],
            [
                'title' => 'Table Setting',
                'description' => 'Beautiful table settings',
                'image' => 'https://images.unsplash.com/photo-1453614512568-c4024d13c247?q=80&w=1932&auto=format&fit=crop',
                'sort_order' => 13,
            ],
        ];

        foreach ($galleries as $gallery) {
            Gallery::firstOrCreate(
                ['title' => $gallery['title']],
                $gallery
            );
        }
    }
}
