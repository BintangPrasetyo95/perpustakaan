<?php
if (isset($_POST['edit_profile'])) {
    $pw_old = $_POST['pw_old'];
    $pw = $_POST['pw'];
    $pw_konf = $_POST['pw_konf'];

    $cek_user_query = query("SELECT * From user WHERE id_user='$id_self'");
    $cek_user = fetch($cek_user_query);

    $pw_konfirmasi = password_verify($pw_old, $cek_user['password']);

    if ($pw_konfirmasi == true) {
        if ($pw == $pw_konf) {
            $password = password_hash($pw_konf, PASSWORD_DEFAULT);
            
            $query = query("UPDATE user SET password='$password' WHERE id_user='$id_self' ");
    
            if ($query) {
                $refresh = query("SELECT * FROM user WHERE id_user='$id_self'");
                $_SESSION['perpustakaan_bintang'] = fetch($refresh);
                echo "<script>alert('Edit Password berhasil')</script>";
            } else {
                echo "<script>alert('Edit Password gagal')</script>";
            }
        } else {
            echo "<script>alert('Password tidak sama!')</script>";
        }
    } else {
        echo "<script>alert('Password Lama salah!')</script>";
    }
}

if (isset($_POST['edit_admin'])) {
    $nama = htmlspecialchars(trim($_POST['nama']));
    $username = htmlspecialchars(trim($_POST['username']));
    $email = htmlspecialchars(trim($_POST['email']));
    $alamat = htmlspecialchars(trim($_POST['alamat']));
    $pw_old = $_POST['pw_old'];
    $pw = $_POST['pw'];
    $pw_konf = $_POST['pw_konf'];

    if (empty($nama) || $nama == '' || empty($username) || $username == '' || empty($email) || $email == '' || empty($alamat) || $alamat == '' ) {
        echo "<script>alert('Tolong isi data dengan benar!')</script>";
    } elseif (!empty($pw) || $pw != '') {
        $cek_user_query = query("SELECT * From user WHERE id_user='$id_self'");
        $cek_user = fetch($cek_user_query);
    
        $pw_konfirmasi = password_verify($pw_old, $cek_user['password']);
    
        if ($pw_konfirmasi == true) {
            if ($pw == $pw_konf) {
                $password = password_hash($pw_konf, PASSWORD_DEFAULT);
                
                $query = query("UPDATE user SET password='$password', nama_lengkap='$nama', username='$username', email='$email', alamat='$alamat' WHERE id_user='$id_self' ");
        
                if ($query) {
                    $refresh = query("SELECT * FROM user WHERE id_user='$id_self'");
                    $_SESSION['perpustakaan_bintang'] = fetch($refresh);
                    echo "<script>alert('Edit Akun berhasil')</script>";
                } else {
                    echo "<script>alert('Edit Akun gagal')</script>";
                }
            } else {
                echo "<script>alert('Password tidak sama!')</script>";
            }
        } else {
            echo "<script>alert('Password Lama salah!')</script>";
        }
    } else {
        $query = query("UPDATE user SET nama_lengkap='$nama', username='$username', email='$email', alamat='$alamat' WHERE id_user='$id_self' ");

        if ($query) {
            $refresh = query("SELECT * FROM user WHERE id_user='$id_self'");
            $_SESSION['perpustakaan_bintang'] = fetch($refresh);
            echo "<script>alert('Edit Akun berhasil')</script>";
        } else {
            echo "<script>alert('Edit Akun gagal')</script>";
        }
    }
}
?>