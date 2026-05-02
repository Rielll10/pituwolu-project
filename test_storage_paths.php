<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== Storage Path Test ===" . PHP_EOL;
echo "APP_URL: " . config('app.url') . PHP_EOL;
echo "" . PHP_EOL;

$gallery = \App\Models\Gallery::first();
if ($gallery && $gallery->image) {
    echo "Sample Gallery Image:" . PHP_EOL;
    echo "- DB value: " . $gallery->image . PHP_EOL;
    echo "- Storage::url(): " . \Illuminate\Support\Facades\Storage::url($gallery->image) . PHP_EOL;
    echo "- Full URL: " . config('app.url') . \Illuminate\Support\Facades\Storage::url($gallery->image) . PHP_EOL;
    echo "" . PHP_EOL;
}

$menu = \App\Models\Menu::where('foto', '!=', null)->first();
if ($menu && $menu->foto) {
    echo "Sample Menu Image:" . PHP_EOL;
    echo "- DB value: " . $menu->foto . PHP_EOL;
    echo "- Storage::url(): " . \Illuminate\Support\Facades\Storage::url($menu->foto) . PHP_EOL;
}
?>
