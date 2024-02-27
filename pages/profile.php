<?php
require './actions/c-favorit.php';
require './actions/c-ulasan.php';
require './actions/c-profile.php';

$koleksi_query = query("SELECT count(*) as bruh FROM koleksi WHERE id_user='$id_self' ");
$koleksi = fetch($koleksi_query);

$ulasan_query = query("SELECT count(*) as bruh FROM ulasan WHERE id_user='$id_self' ");
$ulasan = fetch($ulasan_query);

?>

<div class="card shadow-lg mx-4 card-profile-bottom ">
  <div class="card-body p-3">
    <div class="row gx-4">
      <div class="col-auto">
        <div class="avatar avatar-xl position-relative">
          <img src="./assets/img/pngegg.png" alt="profile_image" class="w-100 border-radius-lg">
        </div>
      </div>
      <div class="col-auto my-auto">
        <div class="h-100">
          <h5 class="mb-1">
            <?= myData('nama_lengkap') ?>
          </h5>
          <p class="mb-0 font-weight-bold text-sm">
            <?= myData('email') ?>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid py-4">
  <div class="row mb-5">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header pb-0">
          <div class="d-flex align-items-center">
            <p class="mb-0">Informasi User</p>
          </div>
        </div>
        <form method="post">
          <div class="card-body">
            <div class="row">
              <?php
              if (myData('role') == 'admin') {
                ?>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Nama Lengkap :</label>
                    <input class="form-control" name="nama" type="text" maxlength="40" value="<?= myData('nama_lengkap') ?>" required>
                  </div>
                </div>
                <?php
              }
              ?>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Username :</label>
                  <input class="form-control" name="username" type="text" maxlength="30" value="<?= myData('username') ?>" <?= (myData('role') == 'admin' ? 'required' : 'disabled') ?>>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Email address :</label>
                  <input class="form-control" name="email" type="email" maxlength="30" value="<?= myData('email') ?>" <?= (myData('role') == 'admin' ? 'required' : 'disabled') ?>>
                </div>
              </div>
              <div class="col-md-<?= (myData('role') == 'admin' ? '6' : '12') ?>">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Alamat</label>
                  <input class="form-control" name="alamat" type="text" maxlength="300" value="<?= myData('alamat') ?>" <?= (myData('role') == 'admin' ? 'required' : 'disabled') ?>>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Password Lama :</label>
                  <input class="form-control" name="pw_old" type="password" maxlength="32" placeholder="Password Lama" <?= (myData('role') == 'admin' ? '' : 'required') ?>>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Password :</label>
                  <input class="form-control" name="pw" type="password" maxlength="32" placeholder="Ganti Password" <?= (myData('role') == 'admin' ? '' : 'required') ?>>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Konfirmasi Password :</label>
                  <input class="form-control" name="pw_konf" type="password" maxlength="32" placeholder="Konfirmasi Password" <?= (myData('role') == 'admin' ? '' : 'required') ?>>
                </div>
                <button class="btn btn-sm bg-gradient-primary me-3" name="<?= (myData('role') == 'admin' ? 'edit_admin' : 'edit_profile') ?>" style="float: right;">Edit <?= (myData('role') == 'admin' ? 'Profile' : 'Password') ?></button>
              </div>
            </div>
          </div>
        </form>
        <hr class="horizontal dark" style="height: 3px;">
        <div class="card-header pb-0">
          <div class="d-flex align-items-center">
            <p class="mb-0">Informasi User</p>
          </div>
        </div>
        <div class="card-body">
          <div class="card-body p-3 ">
            <ul class="list-group">
              <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex align-items-center">
                  <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                    <i class="ni ni-mobile-button text-white opacity-10"></i>
                  </div>
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark text-sm">Koleksi</h6>
                    <span class="text-xs"><span class="font-weight-bolder"><?= $koleksi['bruh'] ?></span> Buku Favorit</span>
                  </div>
                </div>
                <div class="d-flex">
                  <a class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto" href="#table_bawah"><i class="ni ni-bold-right" aria-hidden="true"></i></a>
                </div>
              </li>
              <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex align-items-center">
                  <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                    <i class="ni ni-tag text-white opacity-10"></i>
                  </div>
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark text-sm">Ulasan</h6>
                    <span class="text-xs"><span class="font-weight-bolder"><?= $ulasan['bruh'] ?></span> Komentar anda</span>
                  </div>
                </div>
                <div class="d-flex">
                  <a class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto" href="?page=buku"><i class="ni ni-bold-right" aria-hidden="true"></i></a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card card-profile">
        <img src="./assets/img/library-student.jpg" alt="Image placeholder" class="card-img-top bg-gradient-danger">
        <div class="row justify-content-center">
          <div class="col-4 col-lg-4 order-lg-2">
            <div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0">
              <img src="./assets/img/pngegg.png" class="rounded-circle img-fluid border border-2 border-white">
            </div>
          </div>
        </div>
        <div class="card-body pt-0 mt-3">
          <div class="row">
            <div class="col">
              <div class="d-flex justify-content-center">
                <div class="d-grid text-center me-2">
                  <span class="text-lg font-weight-bolder">
                    <?php
                    echo $koleksi['bruh'];
                    ?>
                  </span>
                  <span class="text-sm opacity-8">Koleksi</span>
                </div>
                <div class="d-grid text-center ms-2">
                  <span class="text-lg font-weight-bolder">
                    <?php
                    echo $ulasan['bruh'];
                    ?>
                  </span>
                  <span class="text-sm opacity-8">Ulasan</span>
                </div>
              </div>
            </div>
          </div>
          <div class="text-center mt-4">
            <h5 title="Nama Lengkap">
              <?= myData('nama_lengkap') ?>
            </h5>
            <div class="h6 font-weight-300" title="Username">
              <i class="ni ni-badge mr-2"></i> <?= myData('username') ?>
            </div>
            <div class="h6 mb-4" title="Email">
              <i class="ni ni-settings-gear-65 mr-2"> </i> <?= myData('email') ?>
            </div>
            <div title="Alamat">
              <i class="ni ni-square-pin mr-2"></i> <?= myData('alamat') ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row" id="table_bawah">
    <div class="col-md-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6>Buku Favorit Anda
            <form method="post">
              <a class="btn btn-danger me-4" title="Reset filter pada table" href="" style="float: right;">
                <i class="fa fa-repeat" aria-hidden="true"></i>
              </a>
              <button type="submit" title="Cari data apapun pada table" class="btn btn-info me-2" style="float: right;">
                <i class="fas fa-search" aria-hidden="true"></i>
              </button>
              <div class="input-group w-20 me-4 mh-50 form-inline" title="Cari data apapun pada table" style="float: right;">
                <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                <input type="text" class="form-control" name="caridata" pattern="[A-Za-z0-9& .]*" oninvalid="alert('Tolong isi Tab Pencarian dengan Benar')" placeholder="Cari..." required>
              </div>
            </form>
          </h6>
          <a class="badge btn btn-sm bg-gradient-success ms-0" href="?page=buku">+ Tambah Buku Favorit</a>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0 table-hover">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">No</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Buku</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Penulis</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Terbit</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kategori</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Rating Anda</th>
                  <th class="text-secondary opacity-7">Favorit</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                if (isset($_POST['caridata'])) {
                  $cari = $_POST['caridata'];

                  $cek_kategori_cari_query = query("SELECT * FROM kategori_relasi INNER JOIN kategori ON kategori_relasi.id_kategori=kategori.id_kategori WHERE nama_kategori LIKE '%$cari%' ");
                  if (rows($cek_kategori_cari_query) != 0) {
                    while ($id_kategori_relasi_up = fetch($cek_kategori_cari_query)) {
                      $id_buku_relasi[] = $id_kategori_relasi_up['id_buku'];
                    }
                    $kumpulan_id_buku = implode(",", $id_buku_relasi);

                    $query = query("SELECT * FROM koleksi INNER JOIN buku ON koleksi.id_buku=buku.id_buku WHERE id_user='$id_self' AND buku.id_buku IN($kumpulan_id_buku) OR judul LIKE '%$cari%' OR penulis LIKE '%$cari%' OR penerbit LIKE '%$cari%' OR tahun_terbit LIKE '%$cari%' OR harga LIKE '%$cari%' OR tanggal_masuk LIKE '%$cari%' OR stok LIKE '%$cari%' ");
                  } elseif (rows($cek_kategori_cari_query) == 0) {
                    $query = query("SELECT * FROM koleksi INNER JOIN buku ON koleksi.id_buku=buku.id_buku WHERE id_user='$id_self' AND judul LIKE '%$cari%' OR penulis LIKE '%$cari%' OR penerbit LIKE '%$cari%' OR tahun_terbit LIKE '%$cari%' OR harga LIKE '%$cari%' OR tanggal_masuk LIKE '%$cari%' OR stok LIKE '%$cari%' ");
                  } else {
                    $query = query("SELECT * FROM koleksi INNER JOIN buku ON koleksi.id_buku=buku.id_buku WHERE id_user='$id_self' AND stok!='0' ORDER BY judul ");
                  }
                } else {
                  $query = query("SELECT * FROM koleksi INNER JOIN buku ON koleksi.id_buku=buku.id_buku WHERE id_user='$id_self' AND stok!='0' ORDER BY judul ");
                }
                while ($data = fetch($query)) {
                ?>
                  <tr>
                    <td>
                      <p class="text-xs font-weight-bold mb-0 ps-3"><?= $no++ ?></p>
                    </td>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div>
                          <img src="./assets/img/buku.png" style="scale: 120%;" class="avatar avatar-sm me-3" alt="user1">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm"><?= $data['judul'] ?></h6>
                          <p class="text-xs text-secondary mb-0">Nilai per Buku : RP.<?= number_format($data['harga'], 2, ',', '.') ?></p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <h6 class="font-weight-bolder text-sm text-primary mb-0"><?= $data['penulis'] ?></h6>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bolder mb-0"><?= $data['penerbit'] ?></p>
                      <p class="text-xs text-secondary mb-0"><?= $data['tahun_terbit'] ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <?php
                      $i = 0;
                      $buku = $data['id_buku'];

                      $kategori_q = query("SELECT * FROM kategori_relasi INNER JOIN kategori ON kategori_relasi.id_kategori=kategori.id_kategori WHERE id_buku='$buku' ");
                      while ($kategori = fetch($kategori_q)) {
                        $hitung = count($kategori);
                        $i++;
                      ?>
                        <span class="badge badge-sm" style="background-color: <?= $kategori['warna'] ?>; color: <?= isLight($kategori['warna']) ? 'black' : 'white' ?>;"><?= $kategori['nama_kategori'] ?></span>
                      <?php
                        if ($i % 2 === 0 && $i < $hitung) {
                          echo '<br>';
                        }
                      }
                      ?>
                    </td>
                    <td class="align-middle text-center">
                      <div class="d-flex align-items-center justify-content-center">
                        <u>
                          <span class="me-2 text-xs font-weight-bold">
                            <?php
                            $ulasan_q = query("SELECT count(rating) as user, SUM(rating) as rating_total FROM ulasan INNER JOIN user ON ulasan.id_user=user.id_user WHERE id_buku='$buku' AND ulasan.id_user='$id_self' ");
                            $ulasan = fetch($ulasan_q);
                            if (intval($ulasan['user']) != 0) {
                              $ulasan_row = $ulasan['user'];
                              $rating_line = intval($ulasan['rating_total']) / $ulasan_row * 10;

                              echo intval($ulasan['rating_total']) / $ulasan_row / 2;
                            } else {
                              $rating_line = 0;

                              echo $rating_line;
                            }
                            ?> / 5
                          </span>
                        </u>
                        <div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-warning" role="progressbar" aria-valuenow="<?= $rating_line ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $rating_line ?>%;"></div>
                          </div>
                        </div>
                      </div>
                      <span class="btn badge bg-gradient-success text-center ms-2 px-5" data-bs-toggle="modal" data-bs-target="#ulasan<?= $data['id_buku'] ?>">Ulasan Anda...</span>
                    </td>
                    <td class="text-center">
                      <div class="d-flex px-2 py-1">
                        <form method='post'>
                          <input type="hidden" name="id" value="<?= $data['id_buku'] ?>">
                          <button type='submit' class='border-0' style='background-color: transparent;' name='un_favorite'>
                            <div class="imageBox">
                              <div class="imageInn">
                                <img src="./assets/img/star-active.png" class="avatar" alt="Default Image">
                              </div>
                              <div class="hoverImg">
                                <img src="./assets/img/star.png" class="avatar" alt="Profile Image">
                              </div>
                            </div>
                          </button>
                        </form>
                      </div>
                    </td>
                  </tr>

                  <!-- Modal Ulasan -->
                  <div class="modal fade" id="ulasan<?= $data['id_buku'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-xl">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Rating Buku</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <?php
                          $ulasan_no = 1;
                          $ulasan_list_query = query("SELECT * FROM ulasan INNER JOIN user ON ulasan.id_user=user.id_user WHERE id_buku='$buku' AND ulasan.id_user='$id_self' ");
                          $ulasan_total = rows($ulasan_list_query);
                          while ($ulasan_list = fetch($ulasan_list_query)) {
                          ?>
                            <div class="row mb-3 ms-3">
                              <h6> Ulasan dari <span class="text-primary fw-bolder"><?= $ulasan_list['nama_lengkap'] ?></span></h6> <br>
                              <h6>
                                <span class="text-warning fw-bolder ms-2">
                                  <?php
                                  $ulasan_no++;
                                  echo intval($ulasan_list['rating']) / 2;
                                  ?> / 5
                                </span>
                              </h6> <br>
                              <span class="text-secondary text-break text-sm ms-n2"><?= $ulasan_list['text_ulasan'] ?></span>
                            </div>
                            <div class="text-end">
                              <form method="post">
                                <input type="hidden" name="id" value="<?= $ulasan_list['id_ulasan'] ?>">
                                <button name="hapus_ulasan" class="btn btn-sm btn-danger mt-n8">Hapus</button>
                              </form>
                            </div>
                            <?php
                            if ($ulasan_no == $ulasan_total) {
                            ?>
                              <hr class="horizontal dark" style="height: 3px;">
                            <?php
                            }
                            ?>
                          <?php
                          }

                          if (rows($ulasan_list_query) == 0) {
                            echo '<span class="text-secondary text-break text-sm text-center">Belum ada ulasan di buku ini...</span>';
                          }
                          ?>
                        </div>
                        <div class="modal-footer">
                          <span data-bs-toggle="modal" data-bs-target="#ulasan_tambah<?= $data['id_buku'] ?>" class="btn btn-warning me-5" data-bs-dismiss="modal">Tambah Ulasan</span>
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Modal Tambah Ulasan -->
                  <div class="modal fade" id="ulasan_tambah<?= $data['id_buku'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Tambah Ulasan</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post">
                          <div class="modal-body">
                            <div class="row">
                              <div class="mb-3">
                                <label class="form-label text-xs font-weight-bold mb-0">Rating :</label>
                                <div class="input-group me-4 mh-50 form-inline w-20" title="Masukkan Input Nominal">
                                  <input type="number" name="rating" class="form-control" onkeydown="return false" max="5" min="0.5" step="0.5" onKeyPress="if(this.value.length==3) return false" placeholder="0.0" required>
                                  <span class="input-group-text text-body">/ 5</span>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="mb-3">
                                <label class="form-label text-xs font-weight-bold mb-0">Ulasan :</label>
                                <textarea name="text_ulasan" placeholder="Masukkan Ulasan Anda" maxlength="300" class="form-control form-control-lg" required></textarea>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <input type="hidden" name="id" value="<?= $data['id_buku'] ?>">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button name="tambah_ulasan" type="submit" class="btn bg-gradient-success">Tambah</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>

                  <!-- Modal Edit -->
                  <div class="modal fade" id="edit<?= $data['id_buku'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Edit Buku</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post">
                          <input type="hidden" name='id' value="<?= $data['id_buku'] ?>">
                          <div class="modal-body">
                            <div class="row">
                              <div class="mb-3">
                                <label class="form-label text-xs font-weight-bold mb-0">Judul :</label>
                                <input type="text" title="Masukkan Judul Buku" name="judul" class="form-control" maxlength="30" placeholder="Masukkan Judul Buku" value="<?= $data['judul'] ?>" required>
                              </div>
                            </div>
                            <div class="row">
                              <div class="mb-3">
                                <label class="form-label text-xs font-weight-bold mb-0">Penulis :</label>
                                <input type="text" title="Masukkan Penulis Buku" name="penulis" class="form-control" maxlength="40" placeholder="Masukkan Penulis Buku" value="<?= $data['penulis'] ?>" required>
                              </div>
                            </div>
                            <div class="row">
                              <div class="mb-3">
                                <label class="form-label text-xs font-weight-bold mb-0">Penerbit :</label>
                                <input type="text" title="Masukkan Penerbit Buku" name="penerbit" class="form-control" maxlength="30" placeholder="Masukkan Penerbit Buku" value="<?= $data['penerbit'] ?>" required>
                              </div>
                            </div>
                            <div class="row">
                              <div class="mb-3">
                                <label class="form-label text-xs font-weight-bold mb-0">Tahun Terbit :</label>
                                <input type="number" title="Masukkan Tahun Terbit Buku" name="tahun" class="form-control" maxlength="4" placeholder="Masukkan Tahun Terbit Buku" value="<?= $data['tahun_terbit'] ?>" required>
                              </div>
                            </div>
                            <div class="row">
                              <div class="mb-3">
                                <label class="form-label text-xs font-weight-bold mb-0">Select2</label><br>
                                <select class="select2 form-control" name="kategori[]" multiple="" required>

                                  <?php
                                  $kateg_p = query("SELECT * FROM kategori ");
                                  while ($kateg = fetch($kateg_p)) {
                                    $kategori_deteksi_id = $kateg['id_kategori'];
                                    $kategori_deteksi = query("SELECT * FROM kategori_relasi WHERE id_kategori='$kategori_deteksi_id' AND id_buku='$buku' ");
                                  ?>
                                    <option value="<?= $kateg['id_kategori'] ?>" <?= (rows($kategori_deteksi) == 1 ? 'selected' : '') ?>><?= $kateg['nama_kategori'] ?></option>
                                  <?php
                                  }
                                  ?>
                                </select>
                              </div>
                            </div>
                            <div class="row">
                              <div class="mb-3">
                                <label class="form-label text-xs font-weight-bold mb-0">Nilai :</label>
                                <div class="input-group me-4 mh-50 form-inline" title="Masukkan Input Nominal">
                                  <span class="input-group-text text-body">RP.</span>
                                  <input type="number" name="nilai" class="form-control" onKeyPress="if(this.value.length==9) return false" placeholder="Masukkan Nominal Membayar SPP" value="<?= $data['harga'] ?>" required>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="mb-3">
                                <label class="form-label text-xs font-weight-bold mb-0">Stok :</label>
                                <input type="number" title="Stok Buku" name="stok" class="form-control" onKeyPress="if(this.value.length==6) return false" maxlength="40" placeholder="Stok Buku" value="<?= $data['stok'] ?>" required>
                              </div>
                            </div>
                            <div class="row">
                              <div class="mb-3">
                                <label class="form-label text-xs font-weight-bold mb-0">Tanggal Masuk :</label>
                                <input type="date" title="Stok Buku" name="tanggal" class="form-control" maxlength="40" placeholder="Stok Buku" value="<?= $data['tanggal_masuk'] ?>" required>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button name="edit" type="submit" class="btn bg-gradient-success">Edit</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>

                  <!-- Modal Lain -->
                  <div class="modal fade" id="lain<?= $data['id_buku'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Hapus Buku</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          Apakah anda ingin menghapus data ini? <br>
                          <span class="text-center text-danger font-weight-bolder"><?= $data['judul'] ?> - <?= $data['penulis'] ?></span>
                        </div>
                        <div class="modal-footer">
                          <form method="post">
                            <input type="hidden" name="id" value="<?= $data['id_buku'] ?>">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button name="hapus" type="submit" class="btn btn-danger">Hapus</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
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
</div>