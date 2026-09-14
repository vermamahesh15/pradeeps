<?php
$config = require __DIR__ . '/config/database.php';

$host = $config['host'];
$user = $config['username'];
$pass = $config['password'];
$db   = $config['database'];

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

mysqli_set_charset($conn, $config['charset'] ?? "utf8mb4");

if (!defined('BASE_URL')) {
    $script = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
    $dir = rtrim(dirname($script), '/');
    define('BASE_URL', $dir ? $dir . '/' : '/');
}
?>