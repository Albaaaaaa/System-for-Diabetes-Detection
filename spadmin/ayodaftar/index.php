
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Daftar Akun User</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- LINEARICONS -->
		<link rel="stylesheet" href="fonts/linearicons/style.css">

		<!-- MATERIAL DESIGN ICONIC FONT -->
		<link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">

		<!-- DATE-PICKER -->
		<link rel="stylesheet" href="vendor/date-picker/css/datepicker.min.css">
		
		<!-- STYLE CSS -->
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body>


		<div class="wrapper">
			<div class="inner">
				<form action="prosesregistrasi.php" method="post">
					<h3>Daftar Akun </h3>

					
				 <?php if (isset($_GET['error'])) {echo 
                  "<div class='alert alert-danger alert-gradient alert-dismissible fade in' role='alert'>
                           
                            <strong style='color:red'>  Maaf data yang di input kurang lengkap sedulur </strong> $_GET[error]


                          </div>";}

                           else { echo "";} ?>
	
                           <br>
					<div class="form-row">
						<div class="form-wrapper">
							<label for="">Id User *</label>
							<input name="id_user" type="text" id="id_user" class="form-control" placeholder="Tidak perlu di isi" value="<?php $a="user"; $b=rand(1000,10000); $c=$a.$b; echo $c; ?>" autofocus="on" readonly="readonly" />
						</div>

						<div class="form-wrapper">
                            <label for="nama">Nama</label>

                            <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukan Nama" autocomplete="off" />
							
						</div>

					</div>
					
					<div class="form-row last">
						<div class="form-wrapper">
<label for="username">Username *</label>
                            
                            <input type="text" name="username" class="form-control" id="username" placeholder="Masukan Username" autocomplete="off" />
							<i class="zmdi zmdi-chevron-down"></i>
						</div>


						
						
					<div class="form-wrapper">

                            <label for="password">Password *</label>
                            
                            <input type="password" name="password" class="form-control" id="password" placeholder="Masukan password" autocomplete="off" />
						</div>
					</div>


					<div class="form-row last">
						<div class="form-wrapper">
<label for="alamat">Alamat *</label>
                            
                            <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Masukan alamat" autocomplete="off" />
						</div>


						
						
				

						
						
					<div class="form-wrapper">

						
							
							
							
						</div>
					</div>


					<div class="checkbox">
						<label>
							<input type="checkbox"> sudah lengkap
							<span class="checkmark"></span>
						</label>
					</div>
					


					<button type="submit" value="" class="submit" id="submit" name="submit" data-text="Kuy Daftar">
						<span>Daftar  </span>
					</button>

						

					<br>

<div style="text-align:right;">

				
					<a href="../index.php" class="">Sudah Punya akun Login disini   </a>

					

				</div>
					
				</form>
			</div>
		</div>
		
		<script src="js/jquery-3.3.1.min.js"></script>

		<!-- DATE-PICKER -->
		<script src="vendor/date-picker/js/datepicker.js"></script>
		<script src="vendor/date-picker/js/datepicker.en.js"></script>

		<script src="js/main.js"></script>

		<script>
    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))
 
        return false;
      return true;
    }
  </script>

	</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>