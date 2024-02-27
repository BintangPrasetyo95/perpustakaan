<?php
require './actions/c-kategori.php';

if (myData('role') == 'tamu') {
}
?>

<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6>Table Kategori Buku
          <form method="post">
            <a class="btn btn-danger me-4" title="Reset filter pada table" href="" style="float: right;">
              <i class="fa fa-repeat" aria-hidden="true"></i>
            </a>
            <button type="submit" title="Cari data apapun pada table" class="btn btn-info me-2" style="float: right;">
              <i class="fas fa-search" aria-hidden="true"></i>
            </button>
            <div class="input-group w-20 me-4 mh-50 form-inline" title="Cari data apapun pada table" style="float: right;">
              <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
              <input type="text" class="form-control" name="caridata" pattern="[A-Za-z0-9& .]*" oninvalid="alert('Tolong isi Tab Pencarian dengan Benar')" placeholder="Cari Nama Kategori..." required>
            </div>
          </form>
        </h6>
        <span class="badge btn btn-sm bg-gradient-success ms-0" data-bs-toggle="modal" data-bs-target="#tambah">+ Tambah Kategori</span>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0 table-hover">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">No</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kategori</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jumlah Buku</th>
                <th class="text-secondary opacity-7"></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              if (isset($_POST['caridata'])) {
                $cari = $_POST['caridata'];

                $query = query("SELECT * FROM kategori WHERE nama_kategori LIKE '%$cari%' ORDER BY nama_kategori ");
              } else {
                $query = query("SELECT * FROM kategori ORDER BY nama_kategori ");
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
                        <img style="background-color: <?= $data['warna'] ?>; scale: 60%;" class="avatar avatar-sm me-3">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 ms-3 text-sm"><?= $data['nama_kategori'] ?></h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <h6 class="text-sm text-dark mb-0 ms-4">
                      <?php
                      $kategori = $data['id_kategori'];
                      $rows = query("SELECT * FROM kategori_relasi WHERE id_kategori='$kategori' ");
                      echo rows($rows);
                      ?>
                    </h6>
                  </td>
                  <td class="text-center">
                    <span class="btn btn-sm bg-gradient-info" data-bs-toggle="modal" data-bs-target="#edit<?= $data['id_kategori'] ?>" data-toggle="tooltip" data-original-title="Edit user">
                      Edit
                    </span>
                    <span class="btn btn-sm bg-gradient-secondary" data-bs-toggle="modal" data-bs-target="#lain<?= $data['id_kategori'] ?>" data-toggle="tooltip" data-original-title="Edit user">
                      Lainnya...
                    </span>
                  </td>
                </tr>

                <!-- Modal Edit -->
                <div class="modal fade" id="edit<?= $data['id_kategori'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form method="post">
                        <input type="hidden" name="id" value="<?= $data['id_kategori'] ?>">
                        <div class="modal-body">
                          <div class="row">
                            <div class="mb-3">
                              <label class="form-label text-xs font-weight-bold mb-0">Nama Kategori :</label>
                              <input type="text" title="Masukkan Kategori Baru" name="kategori" class="form-control" maxlength="25" placeholder="Masukkan Kategori Baru" value="<?= $data['nama_kategori'] ?>" required>
                            </div>
                          </div>
                          <div class="row">
                            <div class="mb-3">
                              <label class="form-label text-xs font-weight-bold mb-0">Warna Tampilan :</label>
                              <input data-jscolor="{}" type="text" title="Pilih Warna Tampilan" name="warna" class="form-control" maxlength="25" placeholder="Pilih Warna Tampilan" value="<?= $data['warna'] ?>" required>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button name="edit" class="btn bg-gradient-success">Ubah</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

                <!-- Modal Lain -->
                <div class="modal fade" id="lain<?= $data['id_kategori'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        Apakah anda ingin menghapus data ini? <br>
                        <span class="text-center text-danger font-weight-bolder"><?= $data['nama_kategori'] ?></span>
                      </div>
                      <div class="modal-footer">
                        <form method="post">
                          <input type="hidden" name="id" value="<?= $data['id_kategori'] ?>">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button name="hapus" class="btn btn-danger">Hapus</button>
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

<!-- Modal -->
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post">
        <div class="modal-body">
          <div class="row">
            <div class="mb-3">
              <label class="form-label text-xs font-weight-bold mb-0">Nama Kategori :</label>
              <input type="text" title="Masukkan Kategori Baru" name="kategori" class="form-control" maxlength="25" placeholder="Masukkan Kategori Baru" required>
            </div>
          </div>
          <div class="row">
            <div class="mb-3">
              <label class="form-label text-xs font-weight-bold mb-0">Warna Tampilan :</label>
              <input data-jscolor="{}" type="text" title="Pilih Warna Tampilan" name="warna" class="form-control" maxlength="25" placeholder="Pilih Warna Tampilan" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button name="tambah" class="btn bg-gradient-success">Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>