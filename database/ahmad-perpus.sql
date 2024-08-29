-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 29, 2024 at 04:18 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ahmad-perpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

DROP TABLE IF EXISTS `buku`;
CREATE TABLE IF NOT EXISTS `buku` (
  `id_buku` int NOT NULL AUTO_INCREMENT,
  `judul` varchar(50) NOT NULL,
  `penulis` varchar(50) NOT NULL,
  `penerbit` varchar(50) NOT NULL,
  `id_kategori` int NOT NULL,
  `tahun_terbit` year NOT NULL,
  `jumlah` int NOT NULL,
  PRIMARY KEY (`id_buku`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul`, `penulis`, `penerbit`, `id_kategori`, `tahun_terbit`, `jumlah`) VALUES
(8, 'ppkn', 'kurikulum merdeka', 'erlangga', 6, 2024, 10),
(9, 'agama islam', 'kurikulum merdeka', 'erlangga', 4, 2024, 9),
(10, 'penjas', 'kurikulum merdeka', 'erlangga', 3, 2024, 9);

-- --------------------------------------------------------

--
-- Table structure for table `denda`
--

DROP TABLE IF EXISTS `denda`;
CREATE TABLE IF NOT EXISTS `denda` (
  `id_denda` int NOT NULL AUTO_INCREMENT,
  `harga_denda` int NOT NULL,
  `status` varchar(15) NOT NULL,
  PRIMARY KEY (`id_denda`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `denda`
--

INSERT INTO `denda` (`id_denda`, `harga_denda`, `status`) VALUES
(4, 4000, 'TIDAK AKTIF'),
(3, 3000, 'TIDAK AKTIF'),
(6, 5000, 'AKTIF');

-- --------------------------------------------------------

--
-- Table structure for table `denda_peminjaman`
--

DROP TABLE IF EXISTS `denda_peminjaman`;
CREATE TABLE IF NOT EXISTS `denda_peminjaman` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode_peminjaman` int NOT NULL,
  `denda` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `denda_peminjaman`
--

INSERT INTO `denda_peminjaman` (`id`, `kode_peminjaman`, `denda`) VALUES
(22, 6935, 0),
(21, 3789, 40000),
(19, 6567, 0),
(18, 8089, 0),
(17, 1456, 40000),
(20, 4440, 0),
(23, 4158, 0);

-- --------------------------------------------------------

--
-- Table structure for table `detail`
--

DROP TABLE IF EXISTS `detail`;
CREATE TABLE IF NOT EXISTS `detail` (
  `id_detail` int NOT NULL AUTO_INCREMENT,
  `kode_peminjaman` int NOT NULL,
  `id_buku` int NOT NULL,
  PRIMARY KEY (`id_detail`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `detail`
--

INSERT INTO `detail` (`id_detail`, `kode_peminjaman`, `id_buku`) VALUES
(53, 4581, 10),
(52, 4581, 9),
(48, 8089, 8),
(41, 6567, 8),
(47, 8089, 9),
(46, 1456, 8),
(45, 1456, 10),
(51, 3789, 10),
(50, 3789, 9),
(49, 4440, 8),
(54, 6935, 13),
(58, 4158, 9),
(59, 4158, 10),
(60, 4158, 8);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

DROP TABLE IF EXISTS `kategori`;
CREATE TABLE IF NOT EXISTS `kategori` (
  `id_kategori` int NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(30) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'romance'),
(3, 'action'),
(4, 'horror'),
(5, 'comedy'),
(6, 'adventure');

-- --------------------------------------------------------

--
-- Table structure for table `koleksi`
--

DROP TABLE IF EXISTS `koleksi`;
CREATE TABLE IF NOT EXISTS `koleksi` (
  `id_koleksi` int NOT NULL AUTO_INCREMENT,
  `id_buku` int NOT NULL,
  `id_user` int NOT NULL,
  PRIMARY KEY (`id_koleksi`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `koleksi`
--

INSERT INTO `koleksi` (`id_koleksi`, `id_buku`, `id_user`) VALUES
(14, 8, 19),
(11, 8, 13);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`) VALUES
(3, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

DROP TABLE IF EXISTS `peminjaman`;
CREATE TABLE IF NOT EXISTS `peminjaman` (
  `id_peminjaman` int NOT NULL AUTO_INCREMENT,
  `kode_peminjaman` int NOT NULL,
  `tanggal_peminjaman` date NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `status` varchar(15) NOT NULL,
  `id_user` int NOT NULL,
  PRIMARY KEY (`id_peminjaman`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `kode_peminjaman`, `tanggal_peminjaman`, `tanggal_pengembalian`, `tanggal_kembali`, `status`, `id_user`) VALUES
(41, 8089, '2024-08-08', '2024-08-11', '2024-08-08', 'DIKEMBALIKAN', 5),
(40, 1456, '2024-08-08', '2024-08-11', '2024-08-15', 'DIKEMBALIKAN', 5),
(42, 4440, '2024-08-09', '2024-08-12', '2024-08-09', 'DIKEMBALIKAN', 13),
(38, 6567, '2024-08-07', '2024-08-10', '2024-08-08', 'DIKEMBALIKAN', 5),
(43, 3789, '2024-08-09', '2024-08-12', '2024-08-16', 'DIKEMBALIKAN', 13),
(44, 4581, '2024-08-09', '2024-08-12', '0000-00-00', 'DIPINJAM', 5),
(45, 6935, '2024-08-15', '2024-08-18', '2024-08-15', 'DIKEMBALIKAN', 14),
(49, 4158, '2024-08-22', '2024-08-25', '2024-08-22', 'DIKEMBALIKAN', 18);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE IF NOT EXISTS `profile` (
  `id_profile` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  PRIMARY KEY (`id_profile`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id_profile`, `nama`, `alamat`) VALUES
(1, 'perpus', 'suka suka');

-- --------------------------------------------------------

--
-- Table structure for table `temp`
--

DROP TABLE IF EXISTS `temp`;
CREATE TABLE IF NOT EXISTS `temp` (
  `id_temp` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_buku` int NOT NULL,
  PRIMARY KEY (`id_temp`)
) ENGINE=MyISAM AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `temp`
--

INSERT INTO `temp` (`id_temp`, `id_user`, `id_buku`) VALUES
(78, 5, 10),
(76, 5, 8),
(77, 5, 9);

-- --------------------------------------------------------

--
-- Table structure for table `ulasan_buku`
--

DROP TABLE IF EXISTS `ulasan_buku`;
CREATE TABLE IF NOT EXISTS `ulasan_buku` (
  `id_ulasan` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_buku` int NOT NULL,
  `ulasan` text NOT NULL,
  `rating` int NOT NULL,
  PRIMARY KEY (`id_ulasan`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ulasan_buku`
--

INSERT INTO `ulasan_buku` (`id_ulasan`, `id_user`, `id_buku`, `ulasan`, `rating`) VALUES
(1, 13, 9, 'bagus', 3),
(8, 14, 8, 'saya jadi tau tentang politik', 5),
(3, 5, 9, 'adminnya ramah', 4),
(4, 5, 8, 'buku nya nyaman buat belajar :)', 4),
(5, 13, 10, 'bagus', 5),
(6, 13, 8, 'good', 5),
(9, 14, 9, 'saya jadi sering ke gereja', 5),
(10, 14, 10, 'saya jadi sering olahraga dan jarang terkena penyakitt', 5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(40) NOT NULL,
  `username` varchar(40) NOT NULL,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(40) NOT NULL,
  `level` varchar(40) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `email`, `password`, `level`) VALUES
(7, 'ahmad', 'admin', 'Ahmad@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'ADMIN'),
(5, 'andi ganteng✅', 'andi', 'andi@gmail.com', 'ce0e5bf55e4f71749eade7a8b95c4e46', 'MEMBER'),
(6, 'kak ros', 'kak ros', 'kakros@gmail.com', '8dd48d6a2e2cad213179a3992c0be53c', 'PETUGAS'),
(13, 'bagas', 'bagas', 'bagas@gmail.com', 'ee776a18253721efe8a62e4abd29dc47', 'MEMBER'),
(14, 'yohanes sigma', 'yohanes', 'yohanest@gmail.com', '493331a7321bf622460493a8cda5e4c4', 'MEMBER'),
(17, 'huda 354', 'huda', '354@gmail.com', '0075a4e7a2e71083262da135ecdbdd14', 'PETUGAS'),
(18, 'default', 'ivan', 'ivan@gmail.com', '2c42e5cf1cdbafea04ed267018ef1511', 'MEMBER'),
(19, 'isman alim', 'isman', 'isman@gmail.com', '0200cb38f8ae5547650a8d106ec4939f', 'MEMBER');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
