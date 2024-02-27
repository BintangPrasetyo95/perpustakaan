<?php
if (isset($_POST['tambah'])) {
    $nama = htmlspecialchars(trim($_POST['kategori']));
    $warna = $_POST['warna'];

    if (empty($nama) || $nama == '') {
        echo "<script>alert('Tolong isi data dengan Benar!');</script>";
    } else {
        $cek_kategori = query("SELECT * FROM kategori WHERE nama_kategori='$nama' ");
    
        if (rows($cek_kategori) > 0) {
            echo "<script>alert('Kategori yang sama sudah ada!');</script>";
        } else {
            $query = query("INSERT INTO kategori SET nama_kategori='$nama', warna='$warna' ");
            if ($query) {
                echo "<script>alert('Tambah Kategori berhasil')</script>";
            }else {
                echo "<script>alert('Tambah Kategori gagal')</script>";
            }
        }
    }
}

if (isset($_POST['edit'])) {
    $id = $_POST['id'];

    $nama = htmlspecialchars(trim($_POST['kategori']));
    $warna = $_POST['warna'];

    if (empty($nama) || $nama == '') {
        echo "<script>alert('Tolong isi data dengan Benar!');</script>";
    } else {
        $cek_kategori = query("SELECT * FROM kategori WHERE id_kategori!='$id' AND nama_kategori='$nama' ");
    
        if (rows($cek_kategori) > 0) {
            echo "<script>alert('Kategori yang sama sudah ada!');</script>";
        } else {
            $query = query("UPDATE kategori SET nama_kategori='$nama', warna='$warna' WHERE id_kategori='$id' ");
            if ($query) {
                echo "<script>alert('Edit Kategori berhasil')</script>";
            }else {
                echo "<script>alert('Edit Kategori gagal')</script>";
            }
        }
    }
}

if (isset($_POST['hapus'])) {
    $id = $_POST['id'];

    $query = query("DELETE FROM kategori WHERE id_kategori='$id' ");
    if ($query) {
        echo "<script>alert('Hapus Kategori berhasil')</script>";
    }else {
        echo "<script>alert('Hapus Kategori gagal')</script>";
    }
}
?>