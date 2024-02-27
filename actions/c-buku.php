<?php
if (isset($_POST['tambah'])) {
    $judul = htmlspecialchars(trim($_POST['judul']));
    $penulis = htmlspecialchars(trim($_POST['penulis']));
    $penerbit = htmlspecialchars(trim($_POST['penerbit']));
    $tahun = $_POST['tahun'];
    $kategori = $_POST['kategori'];
    $nilai = $_POST['nilai'];
    $stok = $_POST['stok'];
    $tanggal = date("Y-m-d");

    if (empty($judul) || $judul == '' || empty($penulis) || $penulis == '' || empty($tahun) || $tahun == '' || empty($penerbit) || $penerbit == '' || empty($nilai) || $nilai == '' || empty($stok) || $stok == '' || empty($tanggal) || $tanggal == '' ) {
        echo "<script>alert('Tolong isi data dengan Benar!');</script>";
    } else {
        $cek_judul = query("SELECT * FROM buku WHERE judul='$judul' ");
    
        if (rows($cek_judul) > 0) {
            echo "<script>alert('Buku dengan judul yang sama sudah ada!');</script>";
        } else {
            $query = query("INSERT INTO buku SET judul='$judul', penulis='$penulis', penerbit='$penerbit', tahun_terbit='$tahun', harga='$nilai', stok='$stok', tanggal_masuk='$tanggal' ");
        
            if ($query) {
                $buku_q = query("SELECT id_buku FROM buku WHERE judul='$judul' AND penulis='$penulis' ");
                $buku_f = fetch($buku_q);
                $buku = $buku_f['id_buku'];
        
                foreach ($kategori as $kat) {
                    $kategori_relasi = query("INSERT INTO kategori_relasi SET id_buku='$buku', id_kategori='$kat' ");
                    
                    if (!$kategori_relasi) {
                        echo "<script>alert('Tambah Buku Data Gagal')</script>";
                    }
                }
        
                echo "<script>alert('Tambah Buku Berhasil')</script>";
        
            } else {
                echo "<script>alert('Tambah Buku Gagal')</script>";
            }
        }
    }
}

if (isset($_POST['edit'])) {
    $id = $_POST['id'];

    $judul = htmlspecialchars(trim($_POST['judul']));
    $penulis = htmlspecialchars(trim($_POST['penulis']));
    $penerbit = htmlspecialchars(trim($_POST['penerbit']));
    $tahun = $_POST['tahun'];
    $kategori = $_POST['kategori'];
    $nilai = $_POST['nilai'];
    $stok = $_POST['stok'];
    $tanggal = $_POST['tanggal'];

    if (empty($judul) || $judul == '' || empty($penulis) || $penulis == '' || empty($tahun) || $tahun == '' || empty($penerbit) || $penerbit == '' || empty($nilai) || $nilai == '' || empty($stok) || $stok == '' || empty($tanggal) || $tanggal == '' ) {
        echo "<script>alert('Tolong isi data dengan Benar!');</script>";
    } else {
        $cek_judul = query("SELECT * FROM buku WHERE id_buku!='$id' AND judul='$judul' ");
    
        if (rows($cek_judul) > 0) {
            echo "<script>alert('Buku dengan judul yang sama sudah ada!');</script>";
        } else {
            $query = query("UPDATE buku SET judul='$judul', penulis='$penulis', penerbit='$penerbit', tahun_terbit='$tahun', harga='$nilai', stok='$stok', tanggal_masuk='$tanggal' WHERE id_buku='$id' ");
        
            if ($query) {
                $kategori_delete = query("DELETE FROM kategori_relasi WHERE id_buku='$id' ");
                if ($kategori_delete) {
                    foreach ($kategori as $kat) {
                        $kategori_relasi = query("INSERT INTO kategori_relasi SET id_buku='$id', id_kategori='$kat' ");
            
                        if (!$kategori_relasi) {
                            echo "<script>alert('Edit Data Gagal')</script>";
                        }
                    }
                    echo "<script>alert('Edit Buku Berhasil')</script>";
                }else {
                    echo "<script>alert('Edit Buku Gagal')</script>";
                }
            } else {
                echo "<script>alert('Edit Buku Gagal')</script>";
            }
        }
    }
}

if (isset($_POST['hapus'])) {
    $id = $_POST['id'];

    $query = query("DELETE FROM buku WHERE id_buku='$id' ");
    if ($query) {
        echo "<script>alert('Hapus Buku berhasil')</script>";
    }else {
        echo "<script>alert('Hapus Buku gagal')</script>";
    }
}

?>