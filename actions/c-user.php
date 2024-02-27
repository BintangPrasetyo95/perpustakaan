<?php
if (isset($_POST['tambah'])) {
    $nama_lengkap = htmlspecialchars(trim($_POST['nama_lengkap']));
    $username = htmlspecialchars(trim($_POST['username']));
    $email = htmlspecialchars(trim($_POST['email']));
    $alamat = htmlspecialchars(trim($_POST['alamat']));
    $pw = $_POST['pw'];
    $pw_konf = $_POST['pw_konf'];

    if (empty($username) || $username == '' || empty($email) || $email == '' || empty($nama_lengkap) || $nama_lengkap == '' || empty($alamat) || $alamat == '') {
        echo "<script>alert('Tolong isi data dengan Benar!');</script>";
    } else {
        if ($pw == $pw_konf) {
            $password = password_hash($pw_konf, PASSWORD_DEFAULT);
    
            $cek_username = query("SELECT * FROM user WHERE username='$username' ");
            $cek_email = query("SELECT * FROM user WHERE email='$email' ");
            $cek_nama = query("SELECT * FROM user WHERE nama_lengkap='$nama_lengkap' ");
    
            if (rows($cek_username) > 0 || rows($cek_email) > 0 || rows($cek_nama) > 0) {
                echo "<script>alert('Salah satu Data (Nama Lengkap / Email / Nama Lengkap) sudah terpakai di akun lain!');</script>";
            } else {
                $query = query("INSERT INTO user SET nama_lengkap='$nama_lengkap', username='$username', email='$email', alamat='$alamat', password='$password', role='tamu' ");
    
                if ($query) {
                    echo "<script>alert('Tambah User berhasil')</script>";
                } else {
                    echo "<script>alert('Tambah User gagal')</script>";
                }
            }
        } else {
            echo "<script>alert('Password tidak sama!')</script>";
        }
    }
}

if (isset($_POST['edit'])) {
    $id = $_POST['id'];

    $nama_lengkap = htmlspecialchars(trim($_POST['nama_lengkap']));
    $username = htmlspecialchars(trim($_POST['username']));
    $email = htmlspecialchars(trim($_POST['email']));
    $alamat = htmlspecialchars(trim($_POST['alamat']));

    if (empty($username) || $username == '' || empty($email) || $email == '' || empty($nama_lengkap) || $nama_lengkap == '' || empty($alamat) || $alamat == '') {
        echo "<script>alert('Tolong isi data dengan Benar!');</script>";
    } else {
        if (!empty($_POST['pw']) || !empty($_POST['pw_konf'])) {
            $pw = $_POST['pw'];
            $pw_konf = $_POST['pw_konf'];
    
            if ($pw == $pw_konf) {
                $password = password_hash($pw_konf, PASSWORD_DEFAULT);
    
                $cek_username = query("SELECT * FROM user WHERE id_user!='$id' AND username='$username' ");
                $cek_email = query("SELECT * FROM user WHERE id_user!='$id' AND email='$email' ");
                $cek_nama = query("SELECT * FROM user WHERE id_user!='$id' AND nama_lengkap='$nama_lengkap' ");
    
                if (rows($cek_username) > 0 || rows($cek_email) > 0 || rows($cek_nama) > 0) {
                    echo "<script>alert('Salah satu Data (Nama Lengkap / Email / Nama Lengkap) sudah terpakai di akun lain!');</script>";
                } else {
                    $query = query("UPDATE user SET nama_lengkap='$nama_lengkap', username='$username', email='$email', alamat='$alamat', password='$password' WHERE id_user='$id'  ");
    
                    if ($query) {
                        echo "<script>alert('Edit User berhasil')</script>";
                    } else {
                        echo "<script>alert('Edit User gagal')</script>";
                    }
                }
            } else {
                echo "<script>alert('Password tidak sama!')</script>";
            }
        } else {
            $cek_username = query("SELECT * FROM user WHERE id_user!='$id' AND username='$username' ");
            $cek_email = query("SELECT * FROM user WHERE id_user!='$id' AND email='$email' ");
            $cek_nama = query("SELECT * FROM user WHERE id_user!='$id' AND nama_lengkap='$nama_lengkap' ");
    
            if (rows($cek_username) > 0 || rows($cek_email) > 0 || rows($cek_nama) > 0) {
                echo "<script>alert('Salah satu Data (Nama Lengkap / Email / Nama Lengkap) sudah terpakai di akun lain!');</script>";
            } else {
                $query = query("UPDATE user SET nama_lengkap='$nama_lengkap', username='$username', email='$email', alamat='$alamat' WHERE id_user='$id'  ");
        
                if ($query) {
                    echo "<script>alert('Edit User berhasil')</script>";
                } else {
                    echo "<script>alert('Edit User gagal')</script>";
                }
            }
        }
    }
}

if (isset($_POST['hapus'])) {
    $id = $_POST['id'];

    $query = query("DELETE FROM user WHERE id_user='$id' ");
    if ($query) {
        echo "<script>alert('Hapus User berhasil')</script>";
    } else {
        echo "<script>alert('Hapus User gagal')</script>";
    }
}
