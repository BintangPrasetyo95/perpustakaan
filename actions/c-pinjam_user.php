<?php
if (isset($_POST['pinjam'])) {
    $id = $_POST['id'];
    $tanggal = date("Y-m-d");

    $query = query("INSERT INTO peminjaman SET id_user='$id_self', id_buku='$id', tanggal_pinjam='$tanggal', status='terpinjam'  ");

    if ($query) {
        $buku_kurang = query("UPDATE buku SET stok= stok - 1 WHERE id_buku='$id' ");
        if ($buku_kurang) {
            echo "<script>alert('Pinjam buku berhasil'); location.href='?page=pinjaman'</script>";
        } else {
            echo "<script>alert('ERROR ERROR')</script>";
        }
    } else {
        echo "<script>alert('Pinjam buku gagal')</script>";
    }
}
?>