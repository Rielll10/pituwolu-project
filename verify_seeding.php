<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== Database Seeding Verification ===" . PHP_EOL;
echo "Menu count: " . \App\Models\Menu::count() . PHP_EOL;
echo "Gallery count: " . \App\Models\Gallery::count() . PHP_EOL;
echo "Category count: " . \App\Models\Category::count() . PHP_EOL;
echo "User count: " . \App\Models\User::count() . PHP_EOL;
echo "Review count: " . \App\Models\Review::count() . PHP_EOL;
echo "" . PHP_EOL;

echo "=== Menu Items ===" . PHP_EOL;
foreach (\App\Models\Menu::all() as $menu) {
    echo "- " . $menu->nama_menu . " (Rp " . number_format($menu->harga, 0, ',', '.') . ")" . PHP_EOL;
}

echo "" . PHP_EOL;
echo "=== Gallery Count ===" . PHP_EOL;
echo "Total gallery images: " . \App\Models\Gallery::count() . PHP_EOL;
?>
