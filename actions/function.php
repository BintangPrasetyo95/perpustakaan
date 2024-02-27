<?php  
session_start();
$connect = mysqli_connect("localhost","root","","perpustakaan");

date_default_timezone_set("Asia/Jakarta");

function query($sql) {
    global $connect;
    return mysqli_query($connect, $sql);
}

function fetch($query) {
    return mysqli_fetch_array($query);
}

function rows($query) {
    return mysqli_num_rows($query);
}

function myData($data) {
    return $_SESSION['perpustakaan_bintang'][$data];
}

function myPage($page) {
    return "?page=" . $page;
}

function myPageA($page) {
    if (isset($_GET['page'])) {
        if ($_GET['page'] == $page) {
            return 'active';
        }
    }else {
        if ($page == 'dashboard') {
            return 'active';
        }
    }
}

function isLight($color) {
    $hex = str_replace('#', '', $color);
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));

    $brightness = (($r * 299) + ($g * 587) + ($b * 114)) / 1000;

    return $brightness > 130;
}
?>