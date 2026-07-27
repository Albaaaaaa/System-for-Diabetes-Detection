<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

ob_start();
include ("conn.php");
date_default_timezone_set('Asia/Jakarta');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$username = mysqli_real_escape_string($koneksi, trim($_POST['username'] ?? ''));
$password = mysqli_real_escape_string($koneksi, trim($_POST['password'] ?? ''));

if ($username === '' && $password === '') {
    header('location:index.php?error=Username dan Password Kosong!');
    exit;
} else if ($username === '') {
    header('location:index.php?error=Username Kosong!');
    exit;
} else if ($password === '') {
    header('location:index.php?error=Password Kosong!');
    exit;
}

$q = mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
if (!$q) {
    die('Query error: ' . mysqli_error($koneksi));
}

$row = mysqli_fetch_array($q);

if (mysqli_num_rows($q) == 1) {
    $_SESSION['id_user'] = $row['id_user'];
    $_SESSION['username'] = $username;
    $_SESSION['nama'] = $row['nama'];
    $_SESSION['alamat'] = $row['alamat'];
    $_SESSION['level'] = $row['level'];
    $_SESSION['gambar'] = $row['gambar'];

    if ($row['level'] == "Admin") {
        $_SESSION['username'] = $username;
        $_SESSION['level'] = "Admin";
        header("location:admin/index.php");
        exit;
    } else if ($row['level'] == "User") {
        $_SESSION['username'] = $username;
        $_SESSION['level'] = "User";
        header("location:User/index.php");
        exit;
    } else if ($row['level'] == "Dokter") {
        $_SESSION['username'] = $username;
        $_SESSION['level'] = "Dokter";
        header("location:Dokter/index.php");
        exit;
    }

    header('location:index.php?error=Level pengguna tidak dikenali.');
    exit;
} else {
    header('location:index.php?error=Anda Belum Terdaftar!');
    exit;
}
?>