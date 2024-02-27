-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2024 at 11:50 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `penulis` varchar(255) DEFAULT NULL,
  `penerbit` varchar(255) DEFAULT NULL,
  `tahun_terbit` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul`, `penulis`, `penerbit`, `tahun_terbit`, `harga`, `tanggal_masuk`, `stok`) VALUES
(1, 'Gile', 'Tri Wanjayani', 'Bintang Pustaka', 20222, 500002, '2024-01-16', 123),
(2, 'Hantu', 'Mr. Horr', 'Bintang Pustaka', 2013, 30000, '2024-01-16', 11),
(3, 'XII Matematika', 'KMDI', 'Pustaka Pelajar', 2023, 75000, '2024-01-16', 75),
(4, 'XI IPA', 'KMDI', 'Pustaka Pelajar', 2022, 75000, '2024-01-16', 79),
(5, 'Zelda', 'Kojima', 'Bintang Pustaka', 2021, 150000, '2024-01-16', 1),
(6, 'Pesawat Dua', 'Ammer', 'Kyotoro', 2005, 45000, '2024-01-16', 12),
(7, 'Loving the SkyScrapers', 'Osama Bin Laden', 'Kyotoro Fake', 2006, 46000, '2024-01-16', 6),
(8, 'WB. Broes', 'Panjayani', 'Bintang Pustaka', 2005, 400000, '2024-01-16', 14),
(11, 'Guru Killer', 'Mr. Horr', 'Bintang Pustaka', 2013, 40000, '2024-01-16', 6);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `warna` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `warna`) VALUES
(1, 'Horror', '#FF0000'),
(3, 'Tragedy', '#653300'),
(4, 'History', '#00FFA2'),
(5, 'Lessons', '#00AAFF'),
(6, 'Fiction', '#C2FF34'),
(7, 'Romance', '#FF41F2'),
(8, 'Comedy', '#FFA200'),
(13, 'Fakta', '#C88CD4');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_relasi`
--

CREATE TABLE `kategori_relasi` (
  `id_kategori_rel` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori_relasi`
--

INSERT INTO `kategori_relasi` (`id_kategori_rel`, `id_buku`, `id_kategori`) VALUES
(78, 1, 3),
(79, 1, 5),
(38, 2, 1),
(41, 3, 5),
(42, 4, 5),
(80, 5, 6),
(44, 6, 3),
(72, 7, 3),
(73, 7, 4),
(33, 8, 1),
(34, 8, 3),
(35, 8, 4),
(36, 8, 5),
(69, 11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `koleksi`
--

CREATE TABLE `koleksi` (
  `id_koleksi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `koleksi`
--

INSERT INTO `koleksi` (`id_koleksi`, `id_user`, `id_buku`) VALUES
(24, 1, 1),
(14, 1, 3),
(13, 1, 8),
(27, 1, 11),
(5, 2, 1),
(4, 2, 2),
(16, 3, 6),
(15, 3, 11),
(33, 4, 11),
(23, 5, 3),
(28, 6, 7),
(35, 6, 11),
(29, 7, 7),
(30, 8, 7),
(20, 12, 2),
(21, 12, 6),
(19, 12, 11),
(26, 15, 11);

-- --------------------------------------------------------

--
-- Table structure for table `log_login`
--

CREATE TABLE `log_login` (
  `id_login` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `waktu_login` date DEFAULT NULL,
  `role_login` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log_login`
--

INSERT INTO `log_login` (`id_login`, `id_user`, `waktu_login`, `role_login`) VALUES
(1, 1, '2022-01-09', 'admin'),
(2, 1, '2022-04-15', 'admin'),
(3, 4, '2022-06-30', 'tamu'),
(4, 1, '2023-10-05', 'admin'),
(5, 1, '2023-11-09', 'admin'),
(6, 1, '2023-12-13', 'admin'),
(7, 1, '2024-01-24', 'admin'),
(8, 1, '2024-01-25', 'admin'),
(9, 1, '2024-01-25', 'admin'),
(10, 1, '2024-01-26', 'admin'),
(11, 4, '2024-01-26', 'tamu'),
(12, 15, '2024-01-26', 'tamu'),
(13, 2, '2024-01-26', 'admin'),
(14, 4, '2024-01-26', 'tamu'),
(15, 1, '2024-01-26', 'admin'),
(16, 3, '2024-01-26', 'petugas'),
(17, 1, '2024-01-26', 'admin'),
(18, 6, '2024-01-26', 'tamu'),
(19, 3, '2024-01-26', 'petugas'),
(20, 6, '2024-01-26', 'tamu'),
(21, 3, '2024-01-26', 'petugas'),
(22, 6, '2024-01-26', 'tamu'),
(23, 1, '2024-01-26', 'admin'),
(24, 3, '2024-01-26', 'petugas'),
(25, 6, '2024-01-26', 'tamu'),
(26, 1, '2024-01-27', 'admin'),
(27, 6, '2024-01-27', 'tamu'),
(28, 1, '2024-01-27', 'admin'),
(29, 6, '2024-01-27', 'tamu'),
(30, 6, '2024-01-27', 'tamu'),
(31, 1, '2024-01-27', 'admin'),
(32, 1, '2024-01-28', 'admin'),
(33, 3, '2024-01-28', 'petugas'),
(34, 6, '2024-01-28', 'tamu'),
(35, 1, '2024-01-28', 'admin'),
(36, 3, '2024-01-28', 'petugas'),
(37, 6, '2024-01-28', 'tamu'),
(38, 1, '2024-01-28', 'admin'),
(39, 1, '2024-01-28', 'admin'),
(40, 6, '2024-01-28', 'tamu'),
(41, 6, '2024-01-28', 'tamu'),
(42, 1, '2024-01-28', 'admin'),
(43, 1, '2024-01-28', 'admin'),
(44, 1, '2024-01-28', 'admin'),
(45, 1, '2024-01-28', 'admin'),
(46, 1, '2024-01-28', 'admin'),
(47, 18, '2024-01-28', 'petugas'),
(48, 6, '2024-01-28', 'tamu'),
(49, 1, '2024-01-28', 'admin'),
(50, 6, '2024-01-28', 'tamu'),
(51, 3, '2024-01-28', 'petugas'),
(52, 3, '2024-01-28', 'petugas'),
(53, 6, '2024-01-28', 'tamu'),
(54, 1, '2024-01-28', 'admin'),
(55, 6, '2024-01-28', 'tamu'),
(56, 3, '2024-01-28', 'petugas'),
(57, 3, '2024-01-28', 'petugas'),
(58, 6, '2024-01-28', 'tamu'),
(59, 1, '2024-01-28', 'admin'),
(60, 1, '2024-01-28', 'admin'),
(61, 1, '2024-01-28', 'admin'),
(62, 1, '2024-01-28', 'admin'),
(63, 1, '2024-01-28', 'admin'),
(64, 1, '2024-01-28', 'admin'),
(65, 1, '2024-01-28', 'admin'),
(66, 6, '2024-01-28', 'tamu'),
(67, 1, '2024-01-28', 'admin'),
(68, 6, '2024-01-28', 'tamu'),
(69, 4, '2024-01-28', 'tamu'),
(70, 1, '2024-01-28', 'admin'),
(71, 6, '2024-01-28', 'tamu'),
(72, 1, '2024-01-28', 'admin'),
(73, 6, '2024-01-28', 'tamu'),
(74, 1, '2024-01-28', 'admin'),
(75, 6, '2024-01-28', 'tamu'),
(76, 6, '2024-01-28', 'tamu'),
(77, 1, '2024-01-28', 'admin'),
(78, 1, '2024-01-28', 'admin'),
(79, 1, '2024-01-28', 'admin'),
(80, 6, '2024-01-28', 'tamu'),
(81, 6, '2024-01-28', 'tamu'),
(82, 1, '2024-01-28', 'admin'),
(83, 1, '2024-01-28', 'admin'),
(84, 1, '2024-01-28', 'admin'),
(85, 1, '2024-01-28', 'admin'),
(86, 1, '2024-01-29', 'admin'),
(87, 1, '2024-01-29', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `log_pinjam`
--

CREATE TABLE `log_pinjam` (
  `id_log_pinjam` int(11) NOT NULL,
  `kejadian` varchar(255) DEFAULT NULL,
  `waktu` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log_pinjam`
--

INSERT INTO `log_pinjam` (`id_log_pinjam`, `kejadian`, `waktu`) VALUES
(1, 'Meminjam Buku', '2024-01-23'),
(2, 'Update Peminjaman Buku', '2024-01-23'),
(3, 'Hapus Data Peminjaman Buku', '2024-01-23'),
(4, 'Meminjam Buku', '2024-01-23'),
(5, 'Meminjam Buku', '2024-01-23'),
(6, 'Update Peminjaman Buku', '2024-01-23'),
(7, 'Update Peminjaman Buku', '2024-01-23'),
(8, 'Update Peminjaman Buku', '2024-01-23'),
(9, 'Update Peminjaman Buku', '2024-01-24'),
(10, 'Meminjam Buku', '2024-01-24'),
(11, 'Meminjam Buku', '2024-01-24'),
(12, 'Meminjam Buku', '2024-01-24'),
(13, 'Update Peminjaman Buku', '2024-01-24'),
(14, 'Update Peminjaman Buku', '2024-01-24'),
(15, 'Update Peminjaman Buku', '2024-01-24'),
(16, 'Update Peminjaman Buku', '2024-01-24'),
(17, 'Update Peminjaman Buku', '2024-01-26'),
(18, 'Meminjam Buku', '2024-01-26'),
(19, 'Meminjam Buku', '2024-01-26'),
(20, 'Meminjam Buku', '2024-01-26'),
(21, 'Meminjam Buku', '2024-01-28'),
(22, 'Update Peminjaman Buku', '2024-01-28'),
(23, 'Update Peminjaman Buku', '2024-01-28'),
(24, 'Update Peminjaman Buku', '2024-01-28'),
(25, 'Update Peminjaman Buku', '2024-01-28'),
(26, 'Update Peminjaman Buku', '2024-01-28'),
(27, 'Update Peminjaman Buku', '2024-01-28'),
(28, 'Update Peminjaman Buku', '2024-01-28'),
(29, 'Update Peminjaman Buku', '2024-01-28'),
(30, 'Update Peminjaman Buku', '2024-01-28'),
(31, 'Update Peminjaman Buku', '2024-01-28'),
(32, 'Update Peminjaman Buku', '2024-01-28'),
(33, 'Update Peminjaman Buku', '2024-01-28'),
(34, 'Update Peminjaman Buku', '2024-01-28'),
(35, 'Update Peminjaman Buku', '2024-01-28'),
(36, 'Update Peminjaman Buku', '2024-01-28'),
(37, 'Update Peminjaman Buku', '2024-01-28'),
(38, 'Update Peminjaman Buku', '2024-01-28'),
(39, 'Update Peminjaman Buku', '2024-01-28'),
(40, 'Update Peminjaman Buku', '2024-01-28'),
(41, 'Update Peminjaman Buku', '2024-01-29'),
(42, 'Update Peminjaman Buku', '2024-01-29');

-- --------------------------------------------------------

--
-- Table structure for table `log_user`
--

CREATE TABLE `log_user` (
  `id_log_user` int(11) NOT NULL,
  `kejadian` varchar(255) DEFAULT NULL,
  `waktu` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log_user`
--

INSERT INTO `log_user` (`id_log_user`, `kejadian`, `waktu`) VALUES
(1, 'Tambah Data', '2024-01-23'),
(2, 'Tambah Data', '2024-01-24'),
(3, 'Tambah Data', '2024-01-24'),
(4, 'Hapus Data', '2024-01-24'),
(5, 'Tambah Data', '2024-01-24'),
(6, 'Tambah Data', '2024-01-24'),
(7, 'Update Data', '2024-01-24'),
(8, 'Update Data', '2024-01-24'),
(9, 'Update Data', '2024-01-24'),
(10, 'Update Data', '2024-01-24'),
(11, 'Update Data', '2024-01-24'),
(12, 'Update Data', '2024-01-24'),
(13, 'Update Data', '2024-01-24'),
(14, 'Tambah Data', '2024-01-24'),
(15, 'Hapus Data', '2024-01-24'),
(16, 'Tambah Data', '2024-01-26'),
(17, 'Tambah Data', '2024-01-28'),
(18, 'Hapus Data', '2024-01-28'),
(19, 'Tambah Data', '2024-01-28'),
(20, 'Hapus Data', '2024-01-28'),
(21, 'Tambah Data', '2024-01-28'),
(22, 'Hapus Data', '2024-01-28'),
(23, 'Update Data', '2024-01-28'),
(24, 'Update Data', '2024-01-28'),
(25, 'Update Data', '2024-01-28'),
(26, 'Update Data', '2024-01-28'),
(27, 'Update Data', '2024-01-28'),
(28, 'Update Data', '2024-01-28'),
(29, 'Update Data', '2024-01-28'),
(30, 'Update Data', '2024-01-28'),
(31, 'Update Data', '2024-01-28'),
(32, 'Update Data', '2024-01-28'),
(33, 'Update Data', '2024-01-28'),
(34, 'Update Data', '2024-01-28'),
(35, 'Update Data', '2024-01-28'),
(36, 'Update Data', '2024-01-28'),
(37, 'Update Data', '2024-01-28'),
(38, 'Tambah Data', '2024-01-28'),
(39, 'Hapus Data', '2024-01-28'),
(40, 'Tambah Data', '2024-01-28'),
(41, 'Hapus Data', '2024-01-28'),
(42, 'Tambah Data', '2024-01-28'),
(43, 'Hapus Data', '2024-01-28'),
(44, 'Tambah Data', '2024-01-28'),
(45, 'Hapus Data', '2024-01-28'),
(46, 'Tambah Data', '2024-01-28'),
(47, 'Hapus Data', '2024-01-28'),
(48, 'Tambah Data', '2024-01-28'),
(49, 'Hapus Data', '2024-01-28'),
(50, 'Update Data', '2024-01-28'),
(51, 'Update Data', '2024-01-28'),
(52, 'Update Data', '2024-01-28'),
(53, 'Update Data', '2024-01-28'),
(54, 'Update Data', '2024-01-28'),
(55, 'Update Data', '2024-01-28'),
(56, 'Update Data', '2024-01-28'),
(57, 'Update Data', '2024-01-28'),
(58, 'Update Data', '2024-01-28'),
(59, 'Update Data', '2024-01-28'),
(60, 'Update Data', '2024-01-28'),
(61, 'Update Data', '2024-01-28'),
(62, 'Update Data', '2024-01-28'),
(63, 'Update Data', '2024-01-28'),
(64, 'Update Data', '2024-01-28'),
(65, 'Update Data', '2024-01-28'),
(66, 'Update Data', '2024-01-28'),
(67, 'Update Data', '2024-01-28'),
(68, 'Update Data', '2024-01-28'),
(69, 'Update Data', '2024-01-28'),
(70, 'Update Data', '2024-01-28'),
(71, 'Update Data', '2024-01-28'),
(72, 'Update Data', '2024-01-28');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_pinjam` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `status` enum('terpinjam','dikembalikan','hilang','terbayar') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_pinjam`, `id_user`, `id_buku`, `tanggal_pinjam`, `tanggal_kembali`, `status`) VALUES
(1, 2, 2, '2023-07-11', '2023-07-18', 'dikembalikan'),
(2, 2, 2, '2023-07-18', '2023-07-25', 'dikembalikan'),
(3, 1, 8, '2020-01-01', '2024-01-23', 'dikembalikan'),
(4, 5, 3, '2023-06-15', '2023-07-24', 'dikembalikan'),
(5, 4, 8, '2020-01-01', NULL, 'hilang'),
(6, 6, 4, '2024-01-22', NULL, 'terpinjam'),
(9, 4, 3, '2024-01-23', '2024-01-26', 'dikembalikan'),
(10, 12, 7, '2024-01-23', NULL, 'terbayar'),
(11, 4, 11, '2024-01-24', NULL, 'terpinjam'),
(12, 1, 2, '2024-01-20', NULL, 'terbayar'),
(13, 1, 5, '2024-01-24', '2024-01-29', 'dikembalikan'),
(15, 6, 2, '2024-01-26', NULL, 'terpinjam'),
(16, 6, 5, '2024-01-26', NULL, 'terpinjam'),
(17, 6, 11, '2024-01-26', NULL, 'terpinjam'),
(18, 5, 5, '2024-01-28', NULL, 'hilang');

--
-- Triggers `peminjaman`
--
DELIMITER $$
CREATE TRIGGER `deletePINJAM` AFTER DELETE ON `peminjaman` FOR EACH ROW INSERT INTO log_pinjam VALUES(null, "Hapus Data Peminjaman Buku", now())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insertPINJAM` AFTER INSERT ON `peminjaman` FOR EACH ROW INSERT INTO log_pinjam VALUES(null, "Meminjam Buku", now())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `updatePINJAM` BEFORE UPDATE ON `peminjaman` FOR EACH ROW INSERT INTO log_pinjam VALUES(null, "Update Peminjaman Buku", now())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ulasan`
--

CREATE TABLE `ulasan` (
  `id_ulasan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `text_ulasan` text NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ulasan`
--

INSERT INTO `ulasan` (`id_ulasan`, `id_user`, `id_buku`, `text_ulasan`, `rating`) VALUES
(1, 2, 2, 'WOOOOW BAGUS BANGETTTTTT AWALNYAAAAAAAAAAA MERINDIIIIING TIBA TIBA SERU TAPI MASIH MERINDIIIIIIIIIIIIIIING WOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOW KUKASIH BINTANG 5', 10),
(2, 2, 1, 'sampah', 3),
(3, 5, 3, 'belum kubaca, tapi judulnya tidak meyakinkan', 2),
(4, 5, 3, 'BAGUS BANGET UNDERRATED INI BUKU YANG HARUS KALIAN lihat selanjutnya...', 9),
(5, 1, 2, 'saya re read ternyata ga sebagus itu tapi lumayan', 8),
(6, 1, 1, 'test', 5),
(8, 6, 3, 'wowowowowow\r\n', 10),
(9, 6, 3, 'wowowow\r\n', 10);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `role` enum('admin','petugas','tamu') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `email`, `nama_lengkap`, `alamat`, `role`) VALUES
(1, 'admin', '$2y$10$T57EZH9VUfdiQkHmQ7ZZuuBx64JWkbi1CT9tHKmBywc0unZ/kdKKe', 'admin@gmail.com', 'Admin Kejora', 'Yosorejo', 'admin'),
(2, 'admindua', '$2a$10$9SWLWBDeJkzHpAWAxS9Nhexhb32Byl.f5evHIgIr4nt7GcFD4xYZS', 'admin2@gmail.com', 'Admin Bukan Kejora', 'Bukan Yosorejo', 'admin'),
(3, 'petugas', '$2a$10$G9nm7A7.lt8TWWFP5LMwIevi7k5pS5Blx40IVWAnhejjmMRhrPS72', 'petugas@gmail.com', 'Petu Gasa Kun', 'Jl. Kreasi', 'petugas'),
(4, 'radit', '$2a$10$O98MljLMFuTeNfdA5yTr8.53C81/BJ8W/Mx1t8qZ6m5wroM2VXkji', 'radit@gmail.com', 'Radit Gaming 123', 'Jl. Kreasi', 'tamu'),
(5, 'gian', '$2a$10$pyQbE6lKbpRLyEr74dkjdOel6PvZoncLoKJ/QsoZIVva/G8k1JMKu', 'gian@gmail.com', 'Pambela Gian', 'Pamungkas', 'tamu'),
(6, 'akira', '$2y$10$cLHGyc9o18LuS8OAam1KNetmpilS8ISutm3t8HDSbLN7FG5tkj6QO', 'akira@gmail.com', 'Akira Hoshizora', 'Nganjuk', 'tamu'),
(7, 'bintang', '$2y$10$tvyuXSAo7YGpXqFAMYNIw.5OILjL519ko/BzI9/mDSthysnBNR.ne', 'bintang@gmail.com', 'Bintang Prasetyo', 'Kwaza', 'admin'),
(8, 'petugasdua', '$2a$10$iMQb/gydU/dpxYnRB/14LOUE.J69XrD3PTfOeeM82i0i.Cc9Obmvq', 'petugasdua@gmail.com', 'petugassss', 'blabla', 'petugas'),
(12, 'dhani', '$2y$10$8jU02kkJl5A7tHscBJ8CD.Z./JQvELPp0pZuctHYoZz8aiZB/CrOe', 'dhani@gmail.com', 'Dhani Santoso', 'Metro', 'admin'),
(13, 'zaky', '$2y$10$cFifs91iJziOwypB.3uWbe85dC.CKenrdxTCUCwrsmvejJxdjIZDS', 'zaky@gmail.com', 'Zaky Mamat', 'BatangHari', 'admin'),
(15, 'katana', '$2y$10$qIEMNOqSnD0yBqq0UGszLO3ZpwG..Gpe.qr.xOO9WDaxA4lWEFC86', 'katana@gmail.com', 'Kira Katana', 'JAPJAPJAP', 'tamu'),
(16, 'woilacik', '$2y$10$eMek6WapkMYtNQ0qdGHY8OPX7UY8SVZX6VM7inemN.CTW1iait3xu', 'woilacik@gmail.com', 'woila wir lolor', 'Lorem ipsum lolor sit amet, consectetur adipisicing elit. Qui nulla repellendus sunt corporis officiis molestias adipisci excepturi eveniet voluptate reiciendis placeat nisi, error nesciunt quae explicabo accusamus illum illo neque?', 'tamu'),
(18, 'petugass', '$2y$10$TjaUE4m4ywjYbvaWCyt0au4hxLVKDsi7jKbjw7WMYhGo61vorIn2y', 'petugass@gmail.com', 'Pecinta Kopi', 'metro', 'petugas');

--
-- Triggers `user`
--
DELIMITER $$
CREATE TRIGGER `deleteUSER` AFTER DELETE ON `user` FOR EACH ROW INSERT INTO log_user VALUES(null, "Hapus Data", now())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insertUSER` AFTER INSERT ON `user` FOR EACH ROW INSERT INTO log_user VALUES(null, "Tambah Data", now())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `updateUSER` AFTER UPDATE ON `user` FOR EACH ROW INSERT INTO log_user VALUES(null, "Update Data", now())
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kategori_relasi`
--
ALTER TABLE `kategori_relasi`
  ADD PRIMARY KEY (`id_kategori_rel`),
  ADD KEY `id_buku` (`id_buku`,`id_kategori`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `koleksi`
--
ALTER TABLE `koleksi`
  ADD PRIMARY KEY (`id_koleksi`),
  ADD KEY `id_user` (`id_user`,`id_buku`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indexes for table `log_login`
--
ALTER TABLE `log_login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indexes for table `log_pinjam`
--
ALTER TABLE `log_pinjam`
  ADD PRIMARY KEY (`id_log_pinjam`);

--
-- Indexes for table `log_user`
--
ALTER TABLE `log_user`
  ADD PRIMARY KEY (`id_log_user`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_pinjam`),
  ADD KEY `id_user` (`id_user`,`id_buku`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indexes for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`id_ulasan`),
  ADD KEY `id_user` (`id_user`,`id_buku`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `kategori_relasi`
--
ALTER TABLE `kategori_relasi`
  MODIFY `id_kategori_rel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `koleksi`
--
ALTER TABLE `koleksi`
  MODIFY `id_koleksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `log_login`
--
ALTER TABLE `log_login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `log_pinjam`
--
ALTER TABLE `log_pinjam`
  MODIFY `id_log_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `log_user`
--
ALTER TABLE `log_user`
  MODIFY `id_log_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id_ulasan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kategori_relasi`
--
ALTER TABLE `kategori_relasi`
  ADD CONSTRAINT `kategori_relasi_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kategori_relasi_ibfk_3` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `koleksi`
--
ALTER TABLE `koleksi`
  ADD CONSTRAINT `koleksi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `koleksi_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD CONSTRAINT `ulasan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ulasan_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
