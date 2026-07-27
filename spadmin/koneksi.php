<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$db_host = 'localhost';          // atau 'sqlXXX.infinityfree.com'
$db_user = 'YOUR_DB_USER';       // isi dengan username database Anda
$db_pass = 'YOUR_DB_PASSWORD';   // isi dengan password database Anda
$db_name = 'YOUR_DB_NAME';       // isi dengan nama database Anda
$db_port = 3306;

$koneksi = mysqli_init();

if (!mysqli_real_connect($koneksi, $db_host, $db_user, $db_pass, $db_name, $db_port)) {
    die('Gagal melakukan koneksi ke Database : ' . mysqli_connect_error());
}

mysqli_set_charset($koneksi, 'utf8mb4');
?>
