<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== IMAGE DIAGNOSTIC ===" . PHP_EOL;
echo "" . PHP_EOL;

// Check storage directories
echo "Storage Directories:" . PHP_EOL;
$dirs = [
    'storage/app/public/menu' => 'Menu images',
    'storage/app/public/gallery' => 'Gallery images',
    'public/storage' => 'Public symlink',
];

foreach ($dirs as $path => $label) {
    $full = base_path($path);
    if (is_dir($full)) {
        $files = glob($full . '/*.*');
        echo "✓ $label: " . count($files) . " files" . PHP_EOL;
        if (!empty($files)) {
            echo "  Sample: " . basename($files[0]) . PHP_EOL;
        }
    } else {
        echo "✗ $label: Directory not found" . PHP_EOL;
    }
}

echo "" . PHP_EOL;
echo "Menu Images in Database:" . PHP_EOL;
$menus = \App\Models\Menu::where('foto', '!=', null)->take(3)->get();
foreach ($menus as $menu) {
    $url = \Illuminate\Support\Facades\Storage::url($menu->foto);
    $file_path = base_path('storage/app/public/' . $menu->foto);
    $exists = file_exists($file_path) ? "✓" : "✗";
    echo "$exists {$menu->nama_menu}: {$menu->foto}" . PHP_EOL;
    echo "   URL: $url" . PHP_EOL;
}

echo "" . PHP_EOL;
echo "Gallery Images in Database:" . PHP_EOL;
$galleries = \App\Models\Gallery::take(3)->get();
foreach ($galleries as $gal) {
    echo "- {$gal->title}: {$gal->image}" . PHP_EOL;
}
?>
