<?php
include './actions/function.php';

if (isset($_POST['username'])) {
  if ($_POST['password'] == $_POST['password_konf']) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $nama = trim($_POST['nama']);
    $alamat = trim($_POST['alamat']);
    $password = password_hash($_POST['password_konf'], PASSWORD_DEFAULT);

    if (empty($username) || $username = '' || empty($email) || $email = '' || empty($nama) || $nama = '' || empty($alamat) || $alamat = '') {
      echo "<script>alert('Tolong isi data dengan Benar!');</script>";
    } else {
      $cek_username = query("SELECT * FROM user WHERE username='$username' ");
      $cek_email = query("SELECT * FROM user WHERE email='$email' ");
      $cek_nama = query("SELECT * FROM user WHERE nama_lengkap='$nama' ");

      if (rows($cek_username) > 0 || rows($cek_email) > 0 || rows($cek_nama) > 0) {
        echo "<script>alert('Salah satu Data (Nama Lengkap / Email / Nama Lengkap) sudah terpakai di akun lain!');</script>";
      } else {
        $query = query("INSERT INTO user SET username='$username', email='$email', nama_lengkap='$nama', alamat='$alamat', password='$password', role='tamu' ");

        if ($query) {
          echo "<script>alert('Berhasil Membuat Akun'); location.href='login.php';</script>";
        } else {
          echo "<script>alert('Gagal Register');</script>";
        }
      }
    }
  } else {
    echo "<script>alert('Password Tidak Sama!');</script>";
  }
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
    Perpustakaan - Register
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
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
              <div class="card card-plain">
                <div class="card-header pb-0 text-start">
                  <h4 class="font-weight-bolder">Register</h4>
                  <p class="mb-0">Isi form register untuk Membuat akun</p>
                </div>
                <div class="card-body">
                  <form method="post">
                    <div class="mb-3">
                      <input type="text" class="form-control form-control-lg" name="nama" maxlength="40" placeholder="Masukkan Nama Lengkap Anda" aria-label="Nama Lengkap" required>
                    </div>
                    <div class="mb-3">
                      <input type="text" class="form-control form-control-lg" name="username" maxlength="30" placeholder="Masukkan Username Anda" aria-label="Username" required>
                    </div>
                    <div class="mb-3">
                      <input type="email" class="form-control form-control-lg" name="email" maxlength="30" placeholder="Masukkan Email Anda" aria-label="Email" required>
                    </div>
                    <div class="mb-3">
                      <textarea name="alamat" placeholder="Masukkan Alamat Anda" maxlength="300" class="form-control form-control-lg" required></textarea>
                    </div>
                    <div class="mb-3">
                      <input type="password" class="form-control form-control-lg" maxlength="32" name="password" onkeypress="return event.which != 32" placeholder="Masukkan Password Anda" aria-label="Password" required>
                    </div>
                    <div class="mb-3">
                      <input type="password" class="form-control form-control-lg" maxlength="32" name="password_konf" onkeypress="return event.which != 32" placeholder="Konfirmasi Password Anda" aria-label="Password" required>
                    </div>
                    <div class="text-center">
                      <button class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Register</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-4 text-sm mx-auto">
                    Sudah Mempunyai Akun?
                    <a href="./login.php" class="text-primary text-gradient font-weight-bold">Login</a>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('./assets/img/arsip-dinamis-2.jpg');
          background-size: cover;">
                <span class="mask bg-gradient-primary opacity-6"></span>
                <h4 class="mt-5 text-white font-weight-bolder position-relative">"Attention is the new currency"</h4>
                <p class="text-white position-relative">The more effortless the writing looks, the more effort the writer actually put into the process.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
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