<?php
if (isset($_POST['favorite'])) {
    $id = $_POST['id'];

    $query = query("INSERT INTO koleksi SET id_buku='$id', id_user='$id_self' ");
    if (!$query) {
        echo "<script>alert('Favorit buku gagal')</script>";
    }
}

if (isset($_POST['un_favorite'])) {
    $id = $_POST['id'];

    $query = query("DELETE FROM koleksi WHERE id_buku='$id' AND id_user='$id_self' ");
    if (!$query) {
        echo "<script>alert('Menghilangkan buku Favorit gagal')</script>";
    }
}
?>