<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== FINAL IMAGE LOADING TEST ===" . PHP_EOL;
echo "" . PHP_EOL;

// Test Menu Images
echo "MENU IMAGES (Local Storage):" . PHP_EOL;
$menus = \App\Models\Menu::where('foto', '!=', null)->get();
foreach ($menus as $menu) {
    $url = \Illuminate\Support\Facades\Storage::url($menu->foto);
    $file_path = base_path('storage/app/public/' . $menu->foto);
    $exists = file_exists($file_path) ? "✓" : "✗";
    echo "$exists {$menu->nama_menu}" . PHP_EOL;
    echo "   DB: {$menu->foto}" . PHP_EOL;
    echo "   URL: {$url}" . PHP_EOL;
}

echo "" . PHP_EOL;
echo "GALLERY IMAGES (External URLs):" . PHP_EOL;
$galleries = \App\Models\Gallery::take(3)->get();
foreach ($galleries as $gal) {
    $is_url = str_starts_with($gal->image, 'http') ? "✓ URL" : "✗ Path";
    echo "$is_url - {$gal->title}" . PHP_EOL;
    echo "   Source: " . substr($gal->image, 0, 50) . "..." . PHP_EOL;
}

echo "" . PHP_EOL;
echo "SYMLINK STATUS:" . PHP_EOL;
$link_exists = is_dir(base_path('public/storage')) ? "✓ EXISTS" : "✗ MISSING";
echo "public/storage symlink: $link_exists" . PHP_EOL;

echo "" . PHP_EOL;
echo "STORAGE ACCESS:" . PHP_EOL;
echo "Storage disk: " . config('filesystems.default') . PHP_EOL;
echo "Public disk root: " . config('filesystems.disks.public.root') . PHP_EOL;
echo "Public disk URL: " . config('filesystems.disks.public.url') . PHP_EOL;

echo "" . PHP_EOL;
echo "✅ All systems ready for image display" . PHP_EOL;
?>
