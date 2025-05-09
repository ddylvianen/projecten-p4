<?php
// $dsn = 'mysql:host=db;dbname=fitforfun;charset=utf8mb4';
// $user = 'user';
// $password = 'password';

// try {
//     $pdo = new PDO($dsn, $user, $password);
//     echo "✅ Verbinding gelukt!";
// } catch (PDOException $e) {
//     echo "❌ Fout: " . $e->getMessage();
// }

// echo password_hash('123', PASSWORD_DEFAULT);
// $hash = '$2y$10$1Q


$storedhash = '$2y$10$VEe1.2cLRPLALccGc7/5GOauEGq2Gc/k8wuENc8RT7j/9TskrS6Xm';
echo password_verify('123', $storedhash);