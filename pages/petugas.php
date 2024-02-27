<?php
require './actions/c-petugas.php';
?>

<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6>Table Petugas
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
        <span class="badge btn btn-sm bg-gradient-success ms-0" data-bs-toggle="modal" data-bs-target="#tambah">+ Tambah Petugas</span>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0 table-hover">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">No</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">User</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Username & Email</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Alamat</th>
                <th class="text-secondary opacity-7"></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              if (isset($_POST['caridata'])) {
                $cari = $_POST['caridata'];
                
                $query = query("SELECT * FROM user WHERE username LIKE '%$cari%' OR email LIKE '%$cari%' OR nama_lengkap LIKE '%$cari%' OR alamat LIKE '%$cari%' AND role='petugas' ORDER BY nama_lengkap ");
              }else {
                $query = query("SELECT * FROM user WHERE role='petugas' ORDER BY nama_lengkap ");
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
                        <h6 class="mb-0 text-sm fw-bolder text-dark"><?= $data['nama_lengkap'] ?></h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="text-sm font-weight-bolder mb-0"><?= $data['username'] ?></p>
                    <p class="text-xs text-secondary mb-0"><?= $data['email'] ?></p>
                  </td>
                  <?php
                  $maxLength = 50;
                  $alamat = $data['alamat'];
                  if (strlen($alamat) > $maxLength) {
                     $truncatedAlamat = substr($alamat, 0, $maxLength) . '<span class="text-primary fw-bolder cursor-pointer" data-bs-toggle="modal" data-bs-target="#alamat'.$data['id_user'].'"> ..Baca Selanjutnya</span>';
                  } else {
                    $truncatedAlamat = $alamat;
                  }
                  ?>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-break text-xs font-weight-bold"><?= $truncatedAlamat ?></span>
                  </td>
                  <td class="text-center">
                    <span class="btn btn-sm bg-gradient-info" data-bs-toggle="modal" data-bs-target="#edit<?= $data['id_user'] ?>" data-toggle="tooltip" data-original-title="Edit user">
                      Edit
                    </span>
                    <span class="btn btn-sm bg-gradient-secondary" data-bs-toggle="modal" data-bs-target="#lain<?= $data['id_user'] ?>" data-toggle="tooltip" data-original-title="Edit user">
                      Lainnya...
                    </span>
                  </td>
                </tr>

                <!-- Modal Edit -->
                <div class="modal fade" id="edit<?= $data['id_user'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Petugas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form method="post">
                        <input type="hidden" name="id" value="<?= $data['id_user'] ?>">
                        <div class="modal-body">
                          <div class="row">
                            <div class="mb-3">
                              <label class="form-label text-xs font-weight-bold mb-0">Nama Lengkap :</label>
                              <input type="text" title="Masukkan Nama Lengkap" name="nama_lengkap" maxlength="40" value="<?= $data['nama_lengkap'] ?>" class="form-control" maxlength="30" placeholder="Masukkan Nama Lengkap" required>
                            </div>
                          </div>
                          <div class="row">
                            <div class="mb-3">
                              <label class="form-label text-xs font-weight-bold mb-0">Username :</label>
                              <input type="text" title="Masukkan Username" name="username" maxlength="30" value="<?= $data['username'] ?>" class="form-control" maxlength="40" placeholder="Masukkan Username" required>
                            </div>
                          </div>
                          <div class="row">
                            <div class="mb-3">
                              <label class="form-label text-xs font-weight-bold mb-0">Email :</label>
                              <input type="email" title="Masukkan Email" name="email" maxlength="30" value="<?= $data['email'] ?>" class="form-control" maxlength="30" placeholder="Masukkan Email" required>
                            </div>
                          </div>
                          <div class="row">
                            <div class="mb-3">
                              <label class="form-label text-xs font-weight-bold mb-0">Alamat :</label>
                              <textarea name="alamat" class="form-control" maxlength="300" placeholder="Masukkan Alamat" required><?= $data['alamat'] ?></textarea>
                            </div>
                          </div>
                          <div class="row">
                            <div class="mb-3">
                              <label class="form-label text-xs font-weight-bold mb-0">Password :</label>
                              <input type="password" title="Masukkan Password (Opsional)" name="pw" maxlength="32" onkeypress="return event.which != 32" class="form-control" maxlength="40" placeholder="Masukkan Password (Opsional)">
                            </div>
                          </div>
                          <div class="row">
                            <div class="mb-3">
                              <label class="form-label text-xs font-weight-bold mb-0">Konfirmasi Password :</label>
                              <input type="password" title="Konfirmasi Password (Opsional)" name="pw_konf" maxlength="32" onkeypress="return event.which != 32" class="form-control" maxlength="40" placeholder="Konfirmasi Password (Opsional)">
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
                <div class="modal fade" id="lain<?= $data['id_user'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Petugas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        Apakah anda ingin menghapus data User ini? <br>
                        <span class="text-center text-danger font-weight-bolder"><?= $data['nama_lengkap'] ?> - <?= $data['email'] ?></span>
                      </div>
                      <div class="modal-footer">
                        <form method="post">
                          <input type="hidden" name="id" value="<?= $data['id_user'] ?>">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button name="hapus" type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Modal Alamat -->
                <div class="modal fade" id="alamat<?= $data['id_user'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Alamat Petugas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <?= $data['alamat'] ?>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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

<!-- Modal Tambah -->
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Petugas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post">
        <div class="modal-body">
          <div class="row">
            <div class="mb-3">
              <label class="form-label text-xs font-weight-bold mb-0">Nama Lengkap :</label>
              <input type="text" title="Masukkan Nama Lengkap" name="nama_lengkap" maxlength="40" class="form-control" maxlength="30" placeholder="Masukkan Nama Lengkap" required>
            </div>
          </div>
          <div class="row">
            <div class="mb-3">
              <label class="form-label text-xs font-weight-bold mb-0">Username :</label>
              <input type="text" title="Masukkan Username" name="username" maxlength="30" class="form-control" maxlength="40" placeholder="Masukkan Username" required>
            </div>
          </div>
          <div class="row">
            <div class="mb-3">
              <label class="form-label text-xs font-weight-bold mb-0">Email :</label>
              <input type="email" title="Masukkan Email" name="email" maxlength="30" class="form-control" maxlength="30" placeholder="Masukkan Email" required>
            </div>
          </div>
          <div class="row">
            <div class="mb-3">
              <label class="form-label text-xs font-weight-bold mb-0">Alamat :</label>
              <textarea name="alamat" class="form-control" maxlength="300" placeholder="Masukkan Alamat" required></textarea>
            </div>
          </div>
          <div class="row">
            <div class="mb-3">
              <label class="form-label text-xs font-weight-bold mb-0">Password :</label>
              <input type="password" title="Masukkan Password" maxlength="32" onkeypress="return event.which != 32" name="pw" class="form-control" maxlength="40" placeholder="Masukkan Password" required>
            </div>
          </div>
          <div class="row">
            <div class="mb-3">
              <label class="form-label text-xs font-weight-bold mb-0">Konfirmasi Password :</label>
              <input type="password" title="Konfirmasi Password" maxlength="32" onkeypress="return event.which != 32" name="pw_konf" class="form-control" maxlength="40" placeholder="Konfirmasi Password" required>
            </div>
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