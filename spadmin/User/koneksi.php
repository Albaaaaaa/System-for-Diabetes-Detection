<?php
require_once __DIR__ . '/../env.php';
$host = getenv('DB_HOST') ?: 'localhost';
$user = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASS') ?: '';
$db = getenv('DB_NAME') ?: 'pakar_diabetes';
$port = getenv('DB_PORT') ?: '3306';

$koneksi = mysqli_init();
$ssl_ca = getenv('DB_SSL_CA');

if (!empty($ssl_ca)) {
    mysqli_ssl_set($koneksi, NULL, NULL, $ssl_ca, NULL, NULL);
    $ssl_flag = MYSQLI_CLIENT_SSL;
} else {
    $ssl_flag = 0;
}

if (!mysqli_real_connect($koneksi, $host, $user, $password, $db, (int)$port, NULL, $ssl_flag)) {
    die('Koneksi gagal: ' . mysqli_connect_error());
}

mysqli_set_charset($koneksi, 'utf8mb4');
?>

