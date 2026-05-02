<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== Creating Test Review ===" . PHP_EOL;
$review = \App\Models\Review::create([
    'nama_pengulas' => 'Test User',
    'ulasan' => 'Ini adalah test review untuk memverifikasi sistem ulasan bekerja dengan baik.',
    'rating' => 5,
    'status' => 'pending',
]);

echo "Review created successfully!" . PHP_EOL;
echo "Review ID: " . $review->id . PHP_EOL;
echo "Status: " . $review->status . PHP_EOL;
echo "" . PHP_EOL;

echo "=== Total Reviews ===" . PHP_EOL;
echo "Pending: " . \App\Models\Review::where('status', 'pending')->count() . PHP_EOL;
echo "Approved: " . \App\Models\Review::where('status', 'approved')->count() . PHP_EOL;
echo "Total: " . \App\Models\Review::count() . PHP_EOL;
?>
