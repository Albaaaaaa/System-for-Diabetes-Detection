<?php
// Include file koneksi ke database
include "koneksi.php";

// menerima nilai dari kiriman form pendaftaran
$id_user = trim($_POST["id_user"] ?? '');
$nama = trim($_POST["nama"] ?? '');
$username = trim($_POST["username"] ?? '');
$password = trim($_POST["password"] ?? '');
$alamat = trim($_POST["alamat"] ?? '');
$level = "User";

if ($id_user === '' || $nama === '' || $username === '' || $password === '' || $alamat === '') {
    header('Location: index.php?error=Semua field harus diisi.');
    exit;
}

$nama_esc = mysqli_real_escape_string($koneksi, $nama);
$username_esc = mysqli_real_escape_string($koneksi, $username);
$password_esc = mysqli_real_escape_string($koneksi, $password);
$alamat_esc = mysqli_real_escape_string($koneksi, $alamat);
$id_user_esc = mysqli_real_escape_string($koneksi, $id_user);

$cek_query = "SELECT * FROM admin WHERE nama='$nama_esc' OR username='$username_esc'";
$cek = mysqli_num_rows(mysqli_query($koneksi, $cek_query));
if ($cek > 0) {
    header('Location: index.php?error=Nama atau username sudah ada, cek ulang');
    exit;
}

$sql = "INSERT INTO admin (id_user,nama,username,password,alamat,level) VALUES ('$id_user_esc','$nama_esc','$username_esc','$password_esc','$alamat_esc','$level')";
$hasil = mysqli_query($koneksi, $sql);
if ($hasil) {
    header('Location: ../index.php?success=1');
    exit;
}

header('Location: index.php?error=Gagal membuat akun. Silakan coba lagi.');
exit;
?>
