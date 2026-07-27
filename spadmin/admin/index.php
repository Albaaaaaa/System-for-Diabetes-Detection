<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username']) || !isset($_SESSION['level']) || $_SESSION['level'] != 'Admin') {
    header('Location: index.php?error=Silakan login terlebih dahulu');
    exit;
}

include '../koneksi.php'; 
include 'template/header.php'; 

include 'template/sidebar.php'; 



?>



 
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-4">
              <div class="card info-card sales-card">



     <?php $tampil2=mysqli_query($koneksi, "select * from gejala ");
                        $total2=mysqli_num_rows($tampil2);
                    ?>


                <div class="card-body">
                  <h5 class="card-title">Total Data gejala <span> </span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-file"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $total2; ?></h6>
                      <span class="text-success small pt-1 fw-bold"></span> <span class="text-muted small pt-2 ps-1">Gejala penyakit diabetes</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->


            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-4">
              <div class="card info-card revenue-card">

               
 <?php $total3=mysqli_query($koneksi, "select * from penyakit ");
                        $total3=mysqli_num_rows($total3);
                    ?>
                <div class="card-body">
                  <h5 class="card-title">Data penyakit <span></span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-file"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $total3; ?></h6>
                      <span class="text-success small pt-1 fw-bold"></span> <span class="text-muted small pt-2 ps-1">Penyakit diabetes</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

              <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-4">
              <div class="card info-card revenue-card">

               
   <?php $total31=mysqli_query($koneksi, "select * from riwayat ");
                        $total31=mysqli_num_rows($total31);
                    ?>
                <div class="card-body">
                  <h5 class="card-title">Data riwayat <span></span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                     <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $total31; ?></h6>
                      <span class="text-success small pt-1 fw-bold"></span> <span class="text-muted small pt-2 ps-1">riwayat pasien diagnosa</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->


            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-16">

              <div class="card info-card customers-card">

                



                <div class="card-body">
                  <h5 class="card-title">Selamat datang <?php echo $_SESSION['username']?> <span></span></h5>

               
                    <div class="ps-3">
                      <h6></h6>
                      <span class="text-danger small pt-1 fw-bold"></span> <span class="text-muted small pt-2 ps-1">Sistem pakar diagnosa penyakit diabetes</span>

                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->

             </div>


            <!-- Recent Sales -->
            

           


          

         
        </div><!-- End Right side columns -->

      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>