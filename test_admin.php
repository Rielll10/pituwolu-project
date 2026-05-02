<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$admin = \App\Models\User::where('email', 'admin@pituwolu.com')->first();
if ($admin) {
    echo "Admin User Found!" . PHP_EOL;
    echo "Email: " . $admin->email . PHP_EOL;
    echo "Name: " . $admin->name . PHP_EOL;
} else {
    echo "Admin user not found!" . PHP_EOL;
}
?>
