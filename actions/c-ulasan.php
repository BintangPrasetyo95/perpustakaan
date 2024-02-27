<?php
if (isset($_POST['hapus_ulasan'])) {
    $id = $_POST['id'];

    $query = query("DELETE FROM ulasan WHERE id_ulasan='$id' ");
    if ($query) {
        echo "<script>alert('hapus data berhasil')</script>";
    } else {
        echo "<script>alert('hapus data gagal')</script>";
    }
}

if (isset($_POST['tambah_ulasan'])) {
    $id = $_POST['id'];
    $rating = $_POST['rating'] + $_POST['rating'];
    $text = htmlspecialchars(trim($_POST['text_ulasan']));

    $query = query("INSERT INTO ulasan SET id_user='$id_self', id_buku='$id', text_ulasan='$text', rating='$rating' ");
    if ($query) {
        echo "<script>alert('tambah ulasan berhasil')</script>";
    } else {
        echo "<script>alert('tambah ulasan gagal')</script>";
    }
}
?>