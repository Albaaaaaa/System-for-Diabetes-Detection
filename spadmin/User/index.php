<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username']) || !isset($_SESSION['level']) || $_SESSION['level'] != 'User') {
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
          
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Sales Card -->
            


            <!-- Revenue Card -->
           

         


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