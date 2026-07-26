<?php
//Include file koneksi ke database


include "koneksi.php";

//menerima nilai dari kiriman form pendaftaran

$id_user = $_POST["id_user"] ?? '';
$nama = $_POST["nama"] ?? '';

$username=$_POST["username"];

$password = $_POST["password"];
$alamat=$_POST["alamat"];



$level = "User";



	




// referensi https://stackoverflow.com/questions/15723221/php-login-ifemptypassword-doesnt-work-in-my-code-why
 if(empty($username)) {

     header('location:index.php?error= mber !');
} {

 if(empty($password)) {
     header('location:index.php?error= mber !');

} {

 if(empty($nama)) {
     header('location:index.php?error= mber !');

} {



 if(empty($alamat)) {
     header('location:index.php?error= mber !');



 
      } else {




// VALIDASI 







 $cek = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM admin WHERE nama='$nama' or username='$username'"));

  if ($cek > 0){
    echo "<script>window.alert('nama atau username sudah ada brader cek ulang')
    window.location='prosesregistrasi.php'</script>";
    }else {

// referensi malasngoding.com/cara-membuat-form-validasi-dengan-php/
  $sql="insert into admin (id_user,nama,username,password,alamat,level) values
		('$id_user','$nama','$username','$password','$alamat','$level')";

//Mengeksekusi/menjalankan query diatas	
  $hasil=mysqli_query($kon,$sql);

//Kondisi apakah berhasil atau tidak
  if ($hasil) {
	
	echo "<script>alert('Akun Berhasil Dibuat Silahkan Login Untuk lebih lanjut!'); window.location = '../index.php'</script>";
	
                  
                           

	exit;
  }



} 
}  
}
}
}  


?>