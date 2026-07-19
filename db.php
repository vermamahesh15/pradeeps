<?php
$host = 'localhost';
$user = 'root';
$pass = 'MyStrongPassword123!';
$db   = 'pradeep';

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");

define('BASE_URL', '/pradeep/');
?>