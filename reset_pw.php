<?php
$pdo = new PDO('mysql:host=127.0.0.1;dbname=pituwolu_db', 'root', '');

// Reset password to "password" with bcrypt hash
$hash = password_hash('password', PASSWORD_BCRYPT, ['cost' => 12]);
$stmt = $pdo->prepare('UPDATE users SET password = ? WHERE email = ?');
$stmt->execute([$hash, 'admin@pituwolu.com']);

echo "Password for admin@pituwolu.com has been reset to 'password'\n";
echo "Hash: " . $hash . "\n";
