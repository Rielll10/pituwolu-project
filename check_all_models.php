<?php
require "vendor/autoload.php";
$app = require_once "bootstrap/app.php";
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== Database Model Record Counts ===" . PHP_EOL;
echo "Users: " . \App\Models\User::count() . PHP_EOL;
echo "Menus: " . \App\Models\Menu::count() . PHP_EOL;
echo "Events: " . \App\Models\Event::count() . PHP_EOL;
echo "Categories: " . \App\Models\Category::count() . PHP_EOL;
echo "Reservations: " . \App\Models\Reservation::count() . PHP_EOL;
echo "Reviews: " . \App\Models\Review::count() . PHP_EOL;
echo "Galleries: " . \App\Models\Gallery::count() . PHP_EOL;
echo "Promos: " . \App\Models\Promo::count() . PHP_EOL;
