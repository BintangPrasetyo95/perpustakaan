<?php
require './actions/function.php';

if (empty($_SESSION['perpustakaan_bintang']['role'])) {
  header("location: login.php");
}

if (myData('role') == 'tamu') {
?>
  <h1>Akses Ditolak!</h1>
<?php
} else {
?>
  <script>
    window.print();
  </script>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="./assets/img/favicon.png">
    <title>
      Perpustakaan - Print
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
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6>Laporan Peminjaman</h6>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Peminjam</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Buku</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Pinjam</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Kembali</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  if (isset($_GET['caridata'])) {
                    $cari = $_GET['caridata'];

                    $cek_kategori_cari_query = query("SELECT * FROM kategori_relasi INNER JOIN kategori ON kategori_relasi.id_kategori=kategori.id_kategori WHERE nama_kategori LIKE '%$cari%' ");
                    if (rows($cek_kategori_cari_query) != 0) {
                      while ($id_kategori_relasi_up = fetch($cek_kategori_cari_query)) {
                        $id_buku_relasi[] = $id_kategori_relasi_up['id_buku'];
                      }
                      $kumpulan_id_buku = implode(",", $id_buku_relasi);

                      $query = query("SELECT * FROM peminjaman INNER JOIN buku ON peminjaman.id_buku=buku.id_buku INNER JOIN user ON peminjaman.id_user=user.id_user WHERE tanggal_pinjam LIKE '%$cari%' OR tanggal_kembali LIKE '%$cari%' OR status LIKE '%$cari%' OR username LIKE '%$cari%' OR email LIKE '%$cari%' OR nama_lengkap LIKE '%$cari%' OR alamat LIKE '%$cari%' OR role LIKE '%$cari%' OR buku.id_buku IN($kumpulan_id_buku) OR judul LIKE '%$cari%' OR penulis LIKE '%$cari%' OR penerbit LIKE '%$cari%' OR tahun_terbit LIKE '%$cari%' OR harga LIKE '%$cari%' OR tanggal_masuk LIKE '%$cari%' OR stok LIKE '%$cari%' ORDER BY status, tanggal_pinjam DESC ");
                    } elseif (rows($cek_kategori_cari_query) == 0) {
                      $query = query("SELECT * FROM peminjaman INNER JOIN buku ON peminjaman.id_buku=buku.id_buku INNER JOIN user ON peminjaman.id_user=user.id_user WHERE tanggal_pinjam LIKE '%$cari%' OR tanggal_kembali LIKE '%$cari%' OR status LIKE '%$cari%' OR username LIKE '%$cari%' OR email LIKE '%$cari%' OR nama_lengkap LIKE '%$cari%' OR alamat LIKE '%$cari%' OR role LIKE '%$cari%' OR judul LIKE '%$cari%' OR penulis LIKE '%$cari%' OR penerbit LIKE '%$cari%' OR tahun_terbit LIKE '%$cari%' OR harga LIKE '%$cari%' OR tanggal_masuk LIKE '%$cari%' OR stok LIKE '%$cari%' ORDER BY status, tanggal_pinjam DESC ");
                    } else {
                      $query = query("SELECT * FROM peminjaman INNER JOIN buku ON peminjaman.id_buku=buku.id_buku INNER JOIN user ON peminjaman.id_user=user.id_user WHERE stok!='0' ORDER BY judul ");
                    }
                  } else {
                    $query = query("SELECT * FROM peminjaman INNER JOIN buku ON peminjaman.id_buku=buku.id_buku INNER JOIN user ON peminjaman.id_user=user.id_user ORDER BY status, tanggal_pinjam DESC ");
                  }
                  while ($data = fetch($query)) {
                  ?>
                    <tr>
                      <td>
                        <p class="text-xxs font-weight-bold mb-0 ps-3"><?= $no++ ?></p>
                      </td>
                      <td>
                        <div class="d-flex py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 font-weight-bolder text-xs text-dark"><?= $data['nama_lengkap'] ?></h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-xxs"><?= $data['judul'] ?></h6>
                            <p class="text-xxs text-secondary mb-0">RP.<?= number_format($data['harga'], 2, ',', '.') ?></p>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xxs font-weight-bold"><?= $data['tanggal_pinjam'] ?></span>
                      </td>
                      <td class="text-xs">
                        <?php
                        if ($data['status'] == 'dikembalikan') {
                        ?>
                          Dikembalikan
                        <?php
                        } elseif ($data['status'] == 'terpinjam') {
                        ?>
                          Terpinjam
                        <?php
                        } elseif ($data['status'] == 'terbayar') {
                        ?>
                          Hilang <span class="text-xxs">(Terbayar)</span>
                        <?php
                        } else {
                        ?>
                          Hilang
                        <?php
                        }
                        ?>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xxs font-weight-bold"><?= (!empty($data['tanggal_kembali']) ? $data['tanggal_kembali'] : '--') ?></span>
                      </td>
                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php
    if (myData('role') != 'tamu') {
    ?>
      <!-- Modal Tambah -->
      <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pinjam</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post">
              <div class="modal-body">
                <div class="row">
                  <div class="mb-3">
                    <label class="form-label text-xs font-weight-bold mb-0">Peminjam :</label>
                    <select name="user" class="form-select" required>
                      <option value="" hidden>Pilih Peminjam...</option>
                      <?php
                      $peminjam_tambah_query = query("SELECT * FROM user WHERE role!='petugas' ");
                      while ($peminjam_tambah = fetch($peminjam_tambah_query)) {
                      ?>
                        <option value="<?= $peminjam_tambah['id_user'] ?>"><?= $peminjam_tambah['nama_lengkap'] ?> - - - <?= $peminjam_tambah['email'] ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="mb-3">
                    <label class="form-label text-xs font-weight-bold mb-0">Buku :</label>
                    <select name="buku" class="form-select" required>
                      <option value="" hidden>Pilih Buku...</option>
                      <?php
                      $buku_tambah_query = query("SELECT * FROM buku WHERE stok!='0' ");
                      while ($buku_tambah = fetch($buku_tambah_query)) {
                      ?>
                        <option value="<?= $buku_tambah['id_buku'] ?>"><?= $buku_tambah['judul'] ?> - (Stok : <?= $buku_tambah['stok'] ?>)</option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button name="tambah" type="submit" class="btn bg-gradient-success">Tambah</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    <?php
    }
    ?>


    <?php
    include 'footer.php';
    ?>
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

<?php
}
?>