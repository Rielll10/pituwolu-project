<?php
require "vendor/autoload.php";
$app = require_once "bootstrap/app.php";
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$user = \App\Models\User::first();
if ($user) {
    echo "User found: " . $user->name . " (ID: " . $user->id . ")" . PHP_EOL;
    echo "Email: " . $user->email . PHP_EOL;
} else {
    echo "No user found in database" . PHP_EOL;
}
