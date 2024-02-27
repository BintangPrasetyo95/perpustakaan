<?php
if (isset($_POST['tambah'])) {
    $user = $_POST['user'];
    $buku = $_POST['buku'];
    $tanggal = date("Y-m-d");

    $cek_pinjam = query("SELECT * FROM peminjaman WHERE id_user='$user' AND (status='terpinjam' OR status='hilang') ");

    if (rows($cek_pinjam) >= 4) {
        echo "<script>alert('Peminjaman hanya mengizinkan 4 buku untuk per-orang!');</script>";
    } else {
        $query = query("INSERT INTO peminjaman SET id_user='$user', id_buku='$buku', tanggal_pinjam='$tanggal', status='terpinjam'  ");
    
        if ($query) {
            $buku_kurang = query("UPDATE buku SET stok= stok - 1 WHERE id_buku='$buku' ");
            if ($buku_kurang) {
                echo "<script>alert('Peminjaman Buku berhasil')</script>";
            } else {
                echo "<script>alert('Peminjaman Buku gagal')</script>";
            }
        } else {
            echo "<script>alert('Peminjaman Buku gagal')</script>";
        }
    }
}

if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $old_id = $_POST['old_id'];
    $user = $_POST['user'];
    $buku = $_POST['buku'];
    
    $cek_pinjam = query("SELECT * FROM peminjaman WHERE id_user='$user' AND (status='terpinjam' OR status='hilang') ");

    if ($user != $old_id) {
        if (rows($cek_pinjam) >= 4) {
            echo "<script>alert('Peminjaman hanya mengizinkan 4 buku untuk per-orang!');</script>";
        } else {
            $buku_id_query = query("SELECT id_buku FROM peminjaman WHERE id_pinjam='$id' ");
            $buku_id_fetch = fetch($buku_id_query);
            $buku_id = $buku_id_fetch['id_buku'];
        
            $query_tambah = query("UPDATE buku SET stok= stok + 1 WHERE id_buku='$buku_id' ");
        
            if ($query_tambah) {
                $query = query("UPDATE peminjaman SET id_user='$user', id_buku='$buku' WHERE id_pinjam='$id' ");
        
                if ($query) {
                    $query_kurang = query("UPDATE buku SET stok= stok - 1 WHERE id_buku='$buku' ");
        
                    if ($query_kurang) {
                        echo "<script>alert('Edit data peminjaman buku berhasil')</script>";
                    } else {
                        echo "<script>alert('ERROR ERROR')</script>";
                    }
                } else {
                    echo "<script>alert('ERROR ERROR')</script>";
                }
            } else {
                echo "<script>alert('Edit data peminjaman buku gagal')</script>";
            }
        }
    } else {
        $buku_id_query = query("SELECT id_buku FROM peminjaman WHERE id_pinjam='$id' ");
        $buku_id_fetch = fetch($buku_id_query);
        $buku_id = $buku_id_fetch['id_buku'];
    
        $query_tambah = query("UPDATE buku SET stok= stok + 1 WHERE id_buku='$buku_id' ");
    
        if ($query_tambah) {
            $query = query("UPDATE peminjaman SET id_user='$user', id_buku='$buku' WHERE id_pinjam='$id' ");
    
            if ($query) {
                $query_kurang = query("UPDATE buku SET stok= stok - 1 WHERE id_buku='$buku' ");
    
                if ($query_kurang) {
                    echo "<script>alert('Edit data peminjaman buku berhasil')</script>";
                } else {
                    echo "<script>alert('ERROR ERROR')</script>";
                }
            } else {
                echo "<script>alert('ERROR ERROR')</script>";
            }
        } else {
            echo "<script>alert('Edit data peminjaman buku gagal')</script>";
        }
    }
}

if (isset($_POST['hapus'])) {
    $id = $_POST['id'];
    $id_buku = $_POST['id_buku'];
    $status = $_POST['status'];
    $judul = $_POST['judul'];

    if ($status == 'terpinjam') {
        $query_tambah = query("UPDATE buku SET stok= stok + 1 WHERE id_buku='$id_buku' ");

        if ($query_tambah) {
            $query = query("DELETE FROM peminjaman WHERE id_pinjam='$id' ");

            if ($query) {
                echo "<script>alert('Hapus data peminjaman berhasil, satu stok buku berjudul ".$judul." ditambahkan')</script>";
            } else {
                echo "<script>alert('ERROR ERROR')</script>";
            }
        } else {
            echo "<script>alert('Hapus data peminjaman gagal')</script>";
        }
    } else {
        $query = query("DELETE FROM peminjaman WHERE id_pinjam='$id' ");

        if ($query) {
            echo "<script>alert('Hapus data peminjaman berhasil')</script>";
        } else {
            echo "<script>alert('ERROR ERROR')</script>";
        }
    }
}

if (isset($_POST['hilang'])) {
    $id = $_POST['id'];

    $query_hilang = query("UPDATE peminjaman SET status='hilang' WHERE id_pinjam='$id' ");
    if ($query_hilang) {
        echo "<script>alert('Status terganti menjadi hilang')</script>";
    } else {
        echo "<script>alert('Status gagal terganti')</script>";
    }
}

if (isset($_POST['kembali'])) {
    $id = $_POST['id'];
    $id_buku = $_POST['id_buku'];
    $tanggal = date("Y-m-d");
    $judul = $_POST['judul'];

    $query_tambah = query("UPDATE buku SET stok= stok + 1 WHERE id_buku='$id_buku' ");
    if ($query_tambah) {
        $query = query("UPDATE peminjaman SET status='dikembalikan', tanggal_kembali='$tanggal' WHERE id_pinjam='$id' ");

        if ($query) {
            echo "<script>alert('Pengembalian buku berhasil, satu stok buku berjudul ".$judul." ditambahkan')</script>";
        } else {
            echo "<script>alert('ERROR ERROR')</script>";
        }
    } else {
        echo "<script>alert('Pengembalian buku gagal')</script>";
    }
}

if (isset($_POST['bayar'])) {
    $id = $_POST['id'];

    $query_hilang = query("UPDATE peminjaman SET status='terbayar' WHERE id_pinjam='$id' ");
    if ($query_hilang) {
        echo "<script>alert('Status terganti menjadi terbayar')</script>";
    } else {
        echo "<script>alert('Status gagal terganti')</script>";
    }
}
?>