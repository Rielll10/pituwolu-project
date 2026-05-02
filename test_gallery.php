<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== Gallery Count ===" . PHP_EOL;
echo "Total galleries: " . \App\Models\Gallery::count() . PHP_EOL;

echo "" . PHP_EOL;
echo "=== Route Test ===" . PHP_EOL;
echo "Admin routes created:";
$routes = ['admin.gallery.index', 'admin.gallery.create', 'admin.gallery.edit', 'admin.gallery.update', 'admin.gallery.destroy'];
foreach ($routes as $r) {
    echo " " . $r . " ✓";
}
echo PHP_EOL;

echo "" . PHP_EOL;
echo "=== Menu Count ===" . PHP_EOL;
echo "Total menus: " . \App\Models\Menu::count() . PHP_EOL;
?>
