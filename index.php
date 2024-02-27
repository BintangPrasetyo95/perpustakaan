<?php
require './actions/function.php';

if (empty($_SESSION['perpustakaan_bintang']['role'])) {
  header("location: login.php");
}

$id_self = myData('id_user');

$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <title>
    <?php
    $title_preg = preg_replace('/-/', ' ', $page);
    $title = ucwords($title_preg);
    echo 'Perpustakaan - ' . $title;
    ?>
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
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link href="./assets/css/bintang.css" rel="stylesheet" />

</head>

<body class="g-sidenav-show   bg-gray-100">
  <?php
  if ($page == 'profile') {
  ?>
    <div class="position-absolute w-100 min-height-300 top-0" style="background-image: url('./assets/img/library-student.jpg'); background-position-y: 50%;">
      <span class="mask bg-gradient-info opacity-8"></span>
    </div>
  <?php
  } else {
  ?>
    <div class="min-height-300 bg-gradient-info position-absolute w-100" style="background-image: url('./assets/img/banner-library.jpg'); background-position-y: 50%;">
      <span class="mask bg-primary opacity-7"></span>
    </div>
  <?php
  }
  ?>
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html " target="_blank">
        <img src="./assets/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">Perpustakaan</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main" style="height: 500px;">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link <?= myPageA('dashboard') ?>" href="<?= myPage('dashboard') ?>">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-tv-2 text-dark text-lg opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <?php
        if (myData('role') == 'tamu') {
        ?>
          <li class="nav-item">
            <a class="nav-link <?= myPageA('profile') ?>" href="<?= myPage('profile') ?>">
              <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-circle-08 text-dark text-lg opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">Profile</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= myPageA('buku') ?>" href="<?= myPage('buku') ?>">
              <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-books text-dark text-lg opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">Buku</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= myPageA('pinjaman') ?>" href="<?= myPage('pinjaman') ?>">
              <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-collection text-dark text-lg opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">Peminjaman</span>
            </a>
          </li>

        <?php
        }
        if (myData('role') != 'tamu') {
        ?>
          <li class="nav-item">
            <a class="nav-link <?= myPageA('profile') ?>" href="<?= myPage('profile') ?>">
              <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-circle-08 text-dark text-lg opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">Profile</span>
            </a>
          </li>
          <li class="nav-item mt-3">
            <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Administrator</h6>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= myPageA('buku') ?>" href="<?= myPage('buku') ?>">
              <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-books text-dark text-lg opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">Buku</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= myPageA('pinjaman') ?>" href="<?= myPage('pinjaman') ?>">
              <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-collection text-dark text-lg opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">Peminjaman</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= myPageA('kategori') ?>" href="<?= myPage('kategori') ?>">
              <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-bullet-list-67 text-dark text-lg opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">Kategori Buku</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= myPageA('user') ?>" href="<?= myPage('user') ?>">
              <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-single-02 text-dark text-lg opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">User</span>
            </a>
          </li>
          <?php
          if (myData('role') == 'admin') {
          ?>
            <li class="nav-item">
              <a class="nav-link <?= myPageA('petugas') ?>" href="<?= myPage('petugas') ?>">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="ni ni-single-02 text-dark text-lg opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Petugas</span>
              </a>
            </li>
        <?php
          }
        }
        ?>
      </ul>
    </div>
  </aside>
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb mt-n5">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="<?= myPage('dashboard') ?>">Pages</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page"><?= $title ?></li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0"><?= $title ?></h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-10" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
          </div>
          <ul class="navbar-nav justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a href="?page=profile" class="nav-link text-white font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none"><?= myData('nama_lengkap') ?></span>
              </a>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                </div>
              </a>
            </li>
            <li class="nav-item dropdown px-3 d-flex align-items-center">
              <?php
              $notification_query = query("SELECT * FROM peminjaman INNER JOIN buku ON peminjaman.id_buku=buku.id_buku WHERE id_user='$id_self' AND (status='terpinjam' OR status='hilang') ");
              ?>
              <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="notification-icon">
                  <i class="fa fa-bell cursor-pointer"></i>
                  <span class="notification-count text-white  bg-danger fw-bolder" <?= (rows($notification_query) == 0 ? 'hidden' : '') ?>><?= rows($notification_query) ?></span>
                </span>
              </a>
              <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                <?php
                if (rows($notification_query) == 0) {
                  echo '<span class="text-sm text-secondary">Belum ada notifikasi...</span>';
                }
                while ($notification = fetch($notification_query)) {
                  $tgl_pinjam = $notification['tanggal_pinjam'];
                  $tgl_pinjam_timestamp = strtotime($tgl_pinjam);

                  $three_days_later_timestamp = strtotime('+1 days', $tgl_pinjam_timestamp);
                  $current_timestamp = time();
                ?>
                  <li class="mb-2">
                    <a class="dropdown-item border-radius-md" href="?page=pinjaman">
                      <div class="d-flex py-1">
                        <div class="my-auto">
                          <img src="./assets/img/buku.jpg" class="avatar avatar-sm  me-3 ">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="text-sm font-weight-normal mb-1">
                            <span class="font-weight-bold text-dark">Belum <?= ($notification['status'] == 'terpinjam' ? '<span class="text-warning">Mengembalikan</span>' : '<span class="text-danger fw-bolder">Mengganti Rugi</span>') ?> buku berjudul</span> <span class="text-primary fw-bolder"><?= $notification['judul'] ?></span>
                          </h6>
                          <p class="text-xs text-secondary mb-0">
                            <i class="fa fa-clock me-1"></i>
                            <?php
                            if ($current_timestamp > $three_days_later_timestamp) {
                              $time_difference = $current_timestamp - $tgl_pinjam_timestamp;
                              $days_passed = floor($time_difference / (60 * 60 * 24));
                              echo "$days_passed hari yang lalu.";
                            } else {
                              echo "Hari ini";
                            }
                            ?>
                          </p>
                        </div>
                      </div>
                    </a>
                  </li>
                <?php
                }
                ?>
              </ul>
            </li>
            <li class="nav-item px-3 d-flex align-items-center me-5">
              <a href="logout.php" class="nav-link text-white p-0" title="Logout">
                <i class="fa fa-sign-out fixed-plugin-button-nav cursor-pointer"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->


    <div class="container-fluid py-4">
      <?php
      if (file_exists('./pages/' . $page . '.php')) {
        // Role Tamu
        if (myData('role') == 'tamu' && ($page == 'kategori' || $page == 'user' || $page == 'petugas')) {
      ?>
          <h1 class="text-white">Akses Ditolak!</h1>
        <?php
        } elseif (myData('role') == 'tamu' && ($page == 'dashboard' || $page == 'profile' || $page == 'buku' || $page == 'pinjaman')) {
          include './pages/' . $page . '.php';

          // Role Petugas
        } elseif (myData('role') == 'petugas' && $page == 'petugas') {
        ?>
          <h1 class="text-white">Akses Ditolak!</h1>
        <?php
        } elseif (myData('role') == 'petugas' && $page != 'petugas') {
          include './pages/' . $page . '.php';

          // Role Admin
        } elseif (myData('role') == 'admin') {
          include './pages/' . $page . '.php';
        } else {
        ?>
          <h1 class="text-white">Halaman Tidak Ditemukan</h1>
        <?php
        }
      } else {
        ?>
        <h1 class="text-white">Halaman Tidak Ditemukan</h1>
      <?php
      }
      ?>
    </div>


    <?php
    include 'footer.php';
    ?>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="ni ni-bold-up"></i></a>
    <div id="preloader"></div>

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
    <!-- Bintang js -->
    <script src="./assets/js/jscolor.js"></script>
    <script src="./assets/js/bintang.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</body>

</html>