<?php
if (myData('role') != 'tamu') {
  require './actions/c-pinjam.php';
}
?>

<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6>Table Peminjaman <?= (myData('role') == 'tamu' ? 'Buku anda' : '') ?>
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
            <?php
            if (myData('role') != 'tamu') {
            ?>
              <a href="print.php<?= (isset($_POST['caridata']) ? '?caridata=' . $_POST['caridata'] : '') ?>" target="_blank" style="float: right;" class="badge btn btn-sm bg-gradient-primary me-4 mt-1"><i class="ni ni-single-copy-04"> </i> Generate Laporan</a>
            <?php
            }
            ?>
          </form>
        </h6>
        <a class="badge btn btn-sm bg-gradient-success ms-0" <?= (myData('role') != 'tamu' ? 'data-bs-toggle="modal" data-bs-target="#tambah"' : 'href="?page=buku"') ?>>+ Tambah Data Pinjam</a>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0 table-hover">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">No</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Peminjam</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Buku</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Pinjam</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Kembali</th>
                <?php
                if (myData('role') != 'tamu') {
                ?>
                  <th class="text-secondary opacity-7"></th>
                <?php
                }
                ?>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              if (myData('role') != 'tamu') {
                if (isset($_POST['caridata'])) {
                  $cari = $_POST['caridata'];

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
              } else {
                if (isset($_POST['caridata'])) {
                  $cari = $_POST['caridata'];

                  $cek_kategori_cari_query = query("SELECT * FROM kategori_relasi INNER JOIN kategori ON kategori_relasi.id_kategori=kategori.id_kategori WHERE nama_kategori LIKE '%$cari%' ");
                  if (rows($cek_kategori_cari_query) != 0) {
                    while ($id_kategori_relasi_up = fetch($cek_kategori_cari_query)) {
                      $id_buku_relasi[] = $id_kategori_relasi_up['id_buku'];
                    }
                    $kumpulan_id_buku = implode(",", $id_buku_relasi);

                    $query = query("SELECT * FROM peminjaman INNER JOIN buku ON peminjaman.id_buku=buku.id_buku INNER JOIN user ON peminjaman.id_user=user.id_user WHERE user.id_user='$id_self' AND (tanggal_pinjam LIKE '%$cari%' OR tanggal_kembali LIKE '%$cari%' OR status LIKE '%$cari%' OR username LIKE '%$cari%' OR email LIKE '%$cari%' OR nama_lengkap LIKE '%$cari%' OR alamat LIKE '%$cari%' OR role LIKE '%$cari%' OR buku.id_buku IN($kumpulan_id_buku) OR judul LIKE '%$cari%' OR penulis LIKE '%$cari%' OR penerbit LIKE '%$cari%' OR tahun_terbit LIKE '%$cari%' OR harga LIKE '%$cari%' OR tanggal_masuk LIKE '%$cari%' OR stok LIKE '%$cari%') ORDER BY status, tanggal_pinjam DESC ");
                  } elseif (rows($cek_kategori_cari_query) == 0) {
                    $query = query("SELECT * FROM peminjaman INNER JOIN buku ON peminjaman.id_buku=buku.id_buku INNER JOIN user ON peminjaman.id_user=user.id_user WHERE user.id_user='$id_self' AND (tanggal_pinjam LIKE '%$cari%' OR tanggal_kembali LIKE '%$cari%' OR status LIKE '%$cari%' OR username LIKE '%$cari%' OR email LIKE '%$cari%' OR nama_lengkap LIKE '%$cari%' OR alamat LIKE '%$cari%' OR role LIKE '%$cari%' OR judul LIKE '%$cari%' OR penulis LIKE '%$cari%' OR penerbit LIKE '%$cari%' OR tahun_terbit LIKE '%$cari%' OR harga LIKE '%$cari%' OR tanggal_masuk LIKE '%$cari%' OR stok LIKE '%$cari%') ORDER BY status, tanggal_pinjam DESC ");
                  } else {
                    $query = query("SELECT * FROM peminjaman INNER JOIN buku ON peminjaman.id_buku=buku.id_buku INNER JOIN user ON peminjaman.id_user=user.id_user WHERE stok!='0' AND user.id_user='$id_self' ORDER BY judul ");
                  }
                } else {
                  $query = query("SELECT * FROM peminjaman INNER JOIN buku ON peminjaman.id_buku=buku.id_buku INNER JOIN user ON peminjaman.id_user=user.id_user WHERE user.id_user='$id_self' ORDER BY status, tanggal_pinjam DESC ");
                }
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
                        <img src="./assets/img/pngegg.png" style="scale: 120%;" class="avatar avatar-sm me-3" alt="user1">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 font-weight-bolder text-sm text-dark"><?= $data['nama_lengkap'] ?></h6>
                      </div>
                    </div>
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
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold"><?= $data['tanggal_pinjam'] ?></span>
                  </td>
                  <td class="align-middle text-center">
                    <?php
                    if ($data['status'] == 'dikembalikan') {
                    ?>
                      <span class="badge bg-gradient-success text-center ms-2 px-5">Dikembalikan</span>
                    <?php
                    } elseif ($data['status'] == 'terpinjam') {
                    ?>
                      <span class="badge bg-gradient-warning text-center ms-2 px-5">Terpinjam</span>
                    <?php
                    } elseif ($data['status'] == 'terbayar') {
                    ?>
                      <span class="badge bg-gradient-primary text-center ms-2 px-5">Hilang <span class="text-sm">(Terbayar)</span></span>
                    <?php
                    } else {
                    ?>
                      <span class="badge bg-danger text-center ms-2 px-5">Hilang</span>
                    <?php
                    }
                    ?>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold"><?= (!empty($data['tanggal_kembali']) ? $data['tanggal_kembali'] : '--') ?></span>
                  </td>
                  <?php
                  if (myData('role') != 'tamu') {
                  ?>
                    <td class="text-end pe-4">
                      <?php
                      if ($data['status'] == 'terpinjam') {
                      ?>
                        <span class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#kembali<?= $data['id_pinjam'] ?>" data-toggle="tooltip" data-original-title="Edit user">
                          Kembali
                        </span>
                      <?php
                      } elseif ($data['status'] == 'hilang') {
                      ?>
                        <span class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#bayar<?= $data['id_pinjam'] ?>" data-toggle="tooltip" data-original-title="Edit user">
                          Bayar
                        </span>
                      <?php
                      }
                      ?>
                      <span class="btn btn-sm bg-gradient-info" data-bs-toggle="modal" data-bs-target="#edit<?= $data['id_pinjam'] ?>" data-toggle="tooltip" data-original-title="Edit user">
                        Edit
                      </span>
                      <span class="btn btn-sm bg-gradient-secondary" data-bs-toggle="modal" data-bs-target="#lain<?= $data['id_pinjam'] ?>" data-toggle="tooltip" data-original-title="Edit user">
                        Lainnya...
                      </span>
                    </td>
                  <?php
                  }
                  ?>
                </tr>

                <?php
                if (myData('role') != 'tamu') {
                ?>
                  <!-- Modal Lain -->
                  <div class="modal fade" id="lain<?= $data['id_pinjam'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Hapus Buku</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          Apakah anda ingin menghapus data ini? <br>
                          <?php
                          if ($data['status'] == 'terpinjam') {
                          ?>
                            atau <br> menyatakan bahwa buku ini hilang? <br>
                          <?php
                          }
                          ?>
                          <span class="text-center text-danger font-weight-bolder"><?= $data['nama_lengkap'] ?> - <?= $data['judul'] ?></span>
                        </div>
                        <div class="modal-footer">
                          <form method="post">
                            <input type="hidden" name="id" value="<?= $data['id_pinjam'] ?>">
                            <input type="hidden" name="id_buku" value="<?= $data['id_buku'] ?>">
                            <input type="hidden" name="status" value="<?= $data['status'] ?>">
                            <input type="hidden" name="judul" value="<?= $data['judul'] ?>">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <?php
                            if ($data['status'] == 'terpinjam') {
                            ?>
                              <button name="hilang" type="submit" title="mengganti status menjadi hilang" class="btn btn-primary me-3 ms-3">Hilang</button>
                            <?php
                            }
                            ?>
                            <button name="hapus" type="submit" title="
                            <?php
                            if ($data['status'] == 'terpinjam') {
                              echo 'menambahkan satu buku dalam stok dan menghapus data pinjaman';
                            } else {
                              echo 'menghapus data pinjaman';
                            }
                            ?>
                            " class="btn btn-danger">Hapus</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Modal kembali -->
                  <div class="modal fade" id="kembali<?= $data['id_pinjam'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Pengembalian Buku</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          Apakah user dengan nama <span class="text-success fw-bolder"><?= $data['nama_lengkap'] ?></span> sudah mengembalikan buku dengan judul <span class="text-primary fw-bolder"><?= $data['judul'] ?></span>?
                        </div>
                        <div class="modal-footer">
                          <form method="post">
                            <input type="hidden" name="id" value="<?= $data['id_pinjam'] ?>">
                            <input type="hidden" name="id_buku" value="<?= $data['id_buku'] ?>">
                            <input type="hidden" name="judul" value="<?= $data['judul'] ?>">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button name="kembali" type="submit" class="btn btn-success">Benar</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Modal bayar -->
                  <div class="modal fade" id="bayar<?= $data['id_pinjam'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Pembayaran Ganti Rugi Buku</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <?php
                        $nominal = $data['harga'] + ($data['harga'] * (15 / 100));
                        ?>
                        <div class="modal-body">
                          Apakah user dengan nama <span class="text-success fw-bolder"><?= $data['nama_lengkap'] ?></span> ingin membayar ganti rugi buku dengan judul <span class="text-primary fw-bolder"><?= $data['judul'] ?> </span>dengan nominal <span class="text-primary fw-bolder">RP.<?= number_format($nominal, 2, ',', '.') ?></span> <span class="text-secondary text-sm">(Ganti rugi, nominal ditambahkan 15%)</span>?
                        </div>
                        <div class="modal-footer">
                          <form method="post">
                            <input type="hidden" name="id" value="<?= $data['id_pinjam'] ?>">
                            <input type="hidden" name="id_buku" value="<?= $data['id_buku'] ?>">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button name="bayar" type="submit" class="btn btn-success">Benar</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Modal Edit -->
                  <div class="modal fade" id="edit<?= $data['id_pinjam'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pinjam</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post">
                          <input type="hidden" name="id" value="<?= $data['id_pinjam'] ?>">
                          <input type="hidden" name="old_id" value="<?= $data['id_user'] ?>">
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
                                    <option value="<?= $peminjam_tambah['id_user'] ?>" <?= ($data['id_user'] == $peminjam_tambah['id_user'] ? 'selected' : '') ?>><?= $peminjam_tambah['nama_lengkap'] ?> - - - <?= $peminjam_tambah['email'] ?></option>
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
                                  $buku_tambah_query = query("SELECT * FROM buku WHERE stok!='0' OR id_buku='".$data['id_buku']."' ");
                                  while ($buku_tambah = fetch($buku_tambah_query)) {
                                  ?>
                                    <option value="<?= $buku_tambah['id_buku'] ?>" <?= ($data['id_buku'] == $buku_tambah['id_buku'] ? 'selected' : '') ?>><?= $buku_tambah['judul'] ?> - (Stok : <?= $buku_tambah['stok'] ?>)</option>
                                  <?php
                                  }
                                  ?>
                                </select>
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
              <?php
                }
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