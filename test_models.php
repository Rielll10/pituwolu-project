<?php
require '\''vendor/autoload.php'\'';
$app = require_once '\''bootstrap/app.php'\'';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== DATABASE RECORDS COUNT ===" . PHP_EOL;
echo "Menu count: " . \App\Models\Menu::count() . PHP_EOL;
echo "Gallery count: " . \App\Models\Gallery::count() . PHP_EOL;
echo "Category count: " . \App\Models\Category::count() . PHP_EOL;
echo "Event count: " . \App\Models\Event::count() . PHP_EOL;
echo "Reservation count: " . \App\Models\Reservation::count() . PHP_EOL;
echo "Review count: " . \App\Models\Review::count() . PHP_EOL;
echo "User count: " . \App\Models\User::count() . PHP_EOL;
