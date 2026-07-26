<?php
require_once __DIR__ . '/env.php';
$db_host = getenv('DB_HOST') ?: 'localhost';
$db_user = getenv('DB_USER') ?: 'root';
$db_pass = getenv('DB_PASS') ?: '';
$db_name = getenv('DB_NAME') ?: 'pakar_diabetes';
$db_port = getenv('DB_PORT') ?: '3306';

$koneksi = mysqli_init();
$ssl_ca = getenv('DB_SSL_CA');

if (!empty($ssl_ca)) {
    mysqli_ssl_set($koneksi, NULL, NULL, $ssl_ca, NULL, NULL);
    $ssl_flag = MYSQLI_CLIENT_SSL;
} else {
    $ssl_flag = 0;
}

if (!mysqli_real_connect($koneksi, $db_host, $db_user, $db_pass, $db_name, (int)$db_port, NULL, $ssl_flag)) {
    die('Gagal melakukan koneksi ke Database : ' . mysqli_connect_error());
}

mysqli_set_charset($koneksi, 'utf8mb4');
?>