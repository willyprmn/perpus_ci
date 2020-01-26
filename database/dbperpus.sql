-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2019 at 04:23 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbperpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(5) NOT NULL,
  `nama_admin` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(35) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `username`, `password`) VALUES
(1, 'Nawawi', 'nawawi', 'c0b12d2050673c7c9befb6d44196cde8'),
(2, 'Imam Nawawi', 'imam', '200ceb26807d6bf99fd6f4f0d1ca54d4'),
(3, 'Admin', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nama_anggota` varchar(45) NOT NULL,
  `gender` enum('Laki-Laki','Perempuan') NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(35) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `username`, `nama_anggota`, `gender`, `no_telp`, `alamat`, `email`, `password`) VALUES
(1, 'irfan', 'Irfan Maulana', 'Laki-Laki', '02144445566', 'BSD', 'irfan@gmail.com', '202cb962ac59075b964b07152d234b70'),
(2, 'nur', 'Nur Kumalasari', 'Perempuan', '02133335555', 'Ciledug', 'nur@gmail.com', '202cb962ac59075b964b07152d234b70'),
(3, '', 'Sanjaya Wijaya', 'Laki-Laki', '02111115555', 'Cimone', 'sanjaya@gmail.com', '123'),
(4, '', 'Eva Irfianingsih', 'Perempuan', '02166665555', 'Tangerang', 'eva@gmail.com', '123'),
(5, '', 'Ifqoh Permatasari', 'Perempuan', '02177775555', 'Cengkareng', 'ifqoh@gmail.com', '123'),
(6, '', 'Indah Riana', 'Perempuan', '02188885555', 'Fatmawati', 'indah@gmail.com', '123'),
(7, '', 'Tiwie Andrawati', 'Perempuan', '02199995555', 'Warung Jati', 'tiwie@gmail.com', '123'),
(11, 'imam', 'Imam Nawawi', 'Laki-Laki', '087829398630', 'jl H Isa no 1 Rengas Ciputat Timur', 'imam.imw@bsi.ac.id', '01cfcd4f6b8770febfb40cb906715822'),
(9, '', 'Hisbu Utomo', 'Laki-Laki', '02133336666', 'Salemba', 'hisbu@gmail.com', '123'),
(10, '', 'Zaenal Abidin', 'Laki-Laki', '02133337777', 'Bekasi', 'Zaenal@gmail.com', '123'),
(12, 'maruloh', 'Maruloh', 'Laki-Laki', '081519940383', 'Pedongkelan', 'maruloh.mru@gmail.com', '8d57dfe7398336d6b9164b4d62b6b42b'),
(13, 'willy', 'Willy Permana', 'Laki-Laki', '08987828745', 'Ponorogo', 'willy@gmail.com', 'e7236697824fb37763235980f1061218'),
(14, 'pitri', 'Indah Pitriatna', 'Perempuan', '0898696969', 'Kranji', 'indah@gmail.com', 'c814d1cea996c53f5781e21d1227f658');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(5) NOT NULL,
  `id_kategori` int(5) NOT NULL,
  `judul_buku` varchar(50) NOT NULL,
  `pengarang` varchar(35) NOT NULL,
  `thn_terbit` date NOT NULL,
  `penerbit` varchar(50) NOT NULL,
  `isbn` varchar(25) NOT NULL,
  `jumlah_buku` int(3) NOT NULL,
  `lokasi` enum('Rak 1','Rak 2','Rak 3') NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `tgl_input` date NOT NULL,
  `status_buku` enum('1','0') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `id_kategori`, `judul_buku`, `pengarang`, `thn_terbit`, `penerbit`, `isbn`, `jumlah_buku`, `lokasi`, `gambar`, `tgl_input`, `status_buku`) VALUES
(1, 1, 'Robotika Sederhana Tingkat Fundamental', 'Siswoyo Utomo', '2013-01-01', 'Wacana Ria', '34354422', -6, 'Rak 3', 'gambar1553690383.jpg', '2018-07-24', '1'),
(2, 3, 'Mahir Pemrograman Web Dengan PHP', 'Adri Kusuma Wardana', '2014-03-18', 'Elex Media', '65412345', 10, 'Rak 3', 'gambar1539746444.jpg', '2018-07-24', '1'),
(3, 2, 'Mahir  Berhitung dan Mahir Mewarnai', 'Akhmad Rahmat', '2014-03-03', 'CV.Indo Kreasi', '7623447342', -8, 'Rak 3', 'gambar1539746653.jpg', '2018-07-25', '1'),
(4, 1, 'Dasar Dasar Fisika', 'Kurnia Sandi', '2013-04-04', 'Wacana Ria', '233214414', -7, 'Rak 2', 'gambar1539746772.jpg', '2018-07-24', '1'),
(5, 8, 'Mahir Bahasa Inggris', 'Aliuddin', '2013-05-05', 'CV.Indo Kreasi', '3553234454', 1, 'Rak 1', 'gambar1539746902.jpg', '2018-10-17', '1'),
(6, 4, 'Public Speaking', 'Pambudi Prasetyo', '2015-06-06', 'Aldi Pustaka', '843594759', 1, 'Rak 2', 'gambar1539747050.jpg', '2019-01-24', '1'),
(7, 3, 'Trik SQL', 'Ahdim Makaren', '2014-07-07', 'Wacana Ria', '54234762', 6, 'Rak 1', 'gambar1539747068.jpg', '2018-03-14', '1'),
(8, 6, 'Kemurnian Agama', 'Pambudi Prasetyo', '2014-08-08', 'Aldi Pustaka', '980958607', 6, 'Rak 3', 'gambar1539747079.jpg', '2018-07-24', '1'),
(9, 1, 'Mikrokontroler', 'Ahdim Makaren', '2012-09-09', 'Wacana Ria', '12121314', 6, 'Rak 2', 'gambar1539747096.jpg', '2018-04-11', '1'),
(10, 1, '24 Jam Belajar FrameWork', 'Rudi Hartono', '2017-03-02', 'Unjung Pena', '12345345', 10, 'Rak 2', 'gambar1539747110.jpg', '2018-05-08', '1'),
(11, 2, 'JavaScript uncover', 'Andre Pratama', '2015-03-12', 'Duniailkom', '9087654', 5, 'Rak 1', 'gambar1539747128.jpg', '2018-07-24', '1'),
(12, 3, 'Pemrograman dan Hack Android untuk pemula dan adva', 'Edy Winarno ST, M.eng, Ali Zaki, Sm', '2016-09-23', 'Elex Media Komputindo', '4234252', 4, 'Rak 1', 'gambar1539747149.jpg', '2018-07-25', '1'),
(16, 3, 'VB .Net', 'Azka', '2018-10-01', 'Elex Media', '12345678', 1, 'Rak 1', 'gambar1539747329.png', '2018-10-17', '1');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pinjam`
--

CREATE TABLE `detail_pinjam` (
  `id_pinjam` varchar(5) NOT NULL,
  `id_buku` int(5) NOT NULL,
  `denda` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_pinjam`
--

INSERT INTO `detail_pinjam` (`id_pinjam`, `id_buku`, `denda`) VALUES
('PJ001', 16, 10000),
('PJ001', 6, 10000),
('PJ002', 4, 10000),
('PJ003', 4, 10000),
('PJ003', 3, 10000),
('PJ003', 2, 10000),
('PJ004', 4, 10000),
('PJ004', 1, 10000),
('PJ004', 8, 10000),
('PJ005', 10, 10000),
('PJ006', 2, 10000),
('PJ007', 7, 10000),
('PJ007', 9, 10000),
('PJ007', 1, 10000),
('PJ007', 4, 10000),
('PJ007', 5, 10000),
('PJ008', 12, 10000),
('PJ009', 3, 10000),
('PJ010', 4, 10000);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(5) NOT NULL,
  `nama_kategori` varchar(45) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Sains'),
(2, 'Hobby'),
(3, 'Komputer'),
(4, 'Komunikasi'),
(5, 'Hukum'),
(6, 'Agama'),
(7, 'Populer'),
(8, 'Bahasa'),
(9, 'komik');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_pinjam` varchar(5) NOT NULL,
  `tanggal_input` datetime NOT NULL,
  `id_anggota` int(5) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `tgl_pengembalian` date NOT NULL,
  `totaldenda` double NOT NULL DEFAULT '0',
  `status_peminjaman` enum('Booking','Selesai','Belum Selesai') DEFAULT 'Belum Selesai',
  `status_pengembalian` enum('Kembali','Belum Kembali') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_pinjam`, `tanggal_input`, `id_anggota`, `tgl_pinjam`, `tgl_kembali`, `tgl_pengembalian`, `totaldenda`, `status_peminjaman`, `status_pengembalian`) VALUES
('PJ001', '2019-01-24 12:01:33', 11, '2019-01-24', '2019-01-30', '2019-01-31', 0, 'Selesai', 'Kembali'),
('PJ002', '2019-03-27 16:03:58', 13, '2019-03-27', '2019-04-02', '2019-03-27', 0, 'Selesai', 'Kembali'),
('PJ003', '2019-03-27 20:03:34', 13, '2019-03-27', '2019-04-02', '2019-04-01', 0, 'Selesai', 'Kembali'),
('PJ004', '2019-04-01 18:04:06', 13, '2019-04-01', '2019-04-07', '2019-04-01', 0, 'Selesai', 'Kembali'),
('PJ005', '2019-04-01 20:04:27', 13, '2019-04-01', '2019-04-07', '2019-04-08', 0, 'Selesai', 'Kembali'),
('PJ006', '2019-04-01 20:04:21', 13, '2019-04-01', '2019-04-07', '2019-04-02', 0, 'Selesai', 'Kembali'),
('PJ007', '2019-04-08 15:04:50', 2, '0000-00-00', '0000-00-00', '0000-00-00', 0, 'Booking', 'Belum Kembali'),
('PJ008', '2019-04-08 16:04:35', 1, '0000-00-00', '0000-00-00', '0000-00-00', 0, 'Booking', 'Belum Kembali'),
('PJ009', '2019-04-08 16:04:06', 1, '0000-00-00', '0000-00-00', '0000-00-00', 0, 'Booking', 'Belum Kembali'),
('PJ010', '2019-04-11 19:04:49', 13, '0000-00-00', '0000-00-00', '0000-00-00', 0, 'Booking', 'Belum Kembali');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_pinjam` varchar(5) NOT NULL,
  `tgl_pencatatan` datetime NOT NULL,
  `id_anggota` int(4) NOT NULL,
  `id_buku` int(4) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `denda` double NOT NULL,
  `tgl_pengembalian` date NOT NULL,
  `total_denda` double NOT NULL,
  `status_pengembalian` varchar(15) NOT NULL,
  `status_peminjaman` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`);

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
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_pinjam`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD KEY `id_pinjam` (`id_pinjam`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
