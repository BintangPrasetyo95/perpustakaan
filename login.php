<?php
require './actions/function.php';

if (isset($_POST['name'])) {
  $name = $_POST['name'];
  $cek_q = query("SELECT password FROM user WHERE username='$name' OR email='$name' ");

  if (rows($cek_q) != 0) {
    $cek = fetch($cek_q);
    $password = $_POST['password'];
    $pw = password_verify($_POST['password'], $cek['password']);

    if ($pw == true) {
      $query = query("SELECT * FROM user WHERE username='$name' OR email='$name' ");
      if (rows($query) == 1) {
        $fetch_query = fetch($query);
        $id_user = $fetch_query['id_user'];
        $waktu = date("Y-m-d");
        $role = $fetch_query['role'];

        $query_login = query("INSERT INTO log_login SET id_user='$id_user', waktu_login='$waktu', role_login='$role' ");

        if ($query_login) {
          $_SESSION['perpustakaan_bintang'] = $fetch_query;
          header("location: index.php");

        } else {
          $gagal = '';
        }
      } else {
        $gagal = '';
      }
    } else {
      $gagal = '';
    }
  } else {
    $gagal = '';
  }
}

if (!empty($_SESSION['perpustakaan_bintang']['role'])) {
  header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <title>
    Perpustakaan - Login
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="./assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
</head>

<body class="">
  <main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('./assets/img/perpustakaan-ugm.jpg'); background-position: top;">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5 text-center mx-auto">
            <h1 class="text-white mb-2 mt-5">Selamat Datang!</h1>
            <p class="text-lead text-white">Masuk ke dalam Perpustakaan digital menggunakan akun yang sudah ada, atau buat akun jika belum mempunyai sebuah akun.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
          <div class="card z-index-0">
            <div class="card-header text-center pt-4">
              <h5>Login menggunakan akun anda!</h5>
            </div>
            <?php
            if (isset($gagal)) {
            ?>
              <h6 class="text-danger mb-n4 ms-4">
                Username / Email atau Password Salah!
              </h6>
            <?php
            }
            ?>
            <div class="card-body">
              <form method="post">
                <div class="mb-3 me-3 ms-3">
                  <input type="text" autocomplete="off" name="name" class="form-control" placeholder="Masukkan email / username" aria-label="Name" required>
                </div>
                <div class="mb-3 me-3 ms-3">
                  <input type="password" autocomplete="off" name="password" class="form-control" placeholder="Masukkan Password" aria-label="Password" required>
                </div>
                <div class="text-center">
                  <button class="btn bg-gradient-dark w-100 my-4 mb-2">Login</button>
                </div>
                <p class="text-sm mt-3 mb-0">Tidak mempunyai akun? <a href="./register.php" class="text-dark font-weight-bolder">Register</a></p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <footer class="footer py-5">
    <div class="container">
      <div class="row">
        <div class="col-8 mx-auto text-center mt-1">
          <p class="mb-0 text-secondary">
            Copyright © <script>
              document.write(new Date().getFullYear())
            </script> Soft by Creative Tim & Bintang Prasetyo.
          </p>
        </div>
      </div>
    </div>
  </footer>
  <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <!--   Core JS Files   -->
  <script src="./assets/js/core/popper.min.js"></script>
  <script src="./assets/js/core/bootstrap.min.js"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="./assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="./assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>

</html>