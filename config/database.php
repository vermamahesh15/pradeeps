<?php

declare(strict_types=1);

// If database.local.php exists (local environment), use it
if (file_exists(__DIR__ . '/database.local.php')) {
    return require __DIR__ . '/database.local.php';
}

// Live Production Database Configuration (Hostinger / pradeepsarang.in)
return [
    'driver' => 'mysql',
    'host' => 'localhost',
    'port' => 3306,
    'charset' => 'utf8mb4',
    'database' => 'u765559826_EOhyw',
    'username' => 'u765559826_K4VMi',
    'password' => 'U#8sS&D+H0?',
];
