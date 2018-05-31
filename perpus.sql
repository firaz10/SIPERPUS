-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2018 at 05:32 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id_user` int(11) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(25) NOT NULL,
  `level` varchar(10) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `alamat` text NOT NULL,
  `tgl_lahir` varchar(13) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_user`, `username`, `password`, `level`, `nama`, `alamat`, `tgl_lahir`, `telp`, `foto`) VALUES
(2, 'admin', 'admin', 'admin', 'Admin', 'Cianjur', '05/25/2018', '085866446078', 'file_1494487000.jpg'),
(3, 'firaz', 'firaz', 'anggota', 'M. Firaz Fakhriza Nurjama', 'Nagrak', '05/27/2018', '1044124', 'file_1527436469.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `judul_buku` varchar(50) NOT NULL,
  `jenis_buku` varchar(50) NOT NULL,
  `pengarang` varchar(50) NOT NULL,
  `penerbit` varchar(50) NOT NULL,
  `tahun` varchar(10) NOT NULL,
  `tempat` varchar(50) NOT NULL,
  `sampul` varchar(50) NOT NULL,
  `sinopsis` text NOT NULL,
  `jumlah` int(11) NOT NULL,
  `dipinjam` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul_buku`, `jenis_buku`, `pengarang`, `penerbit`, `tahun`, `tempat`, `sampul`, `sinopsis`, `jumlah`, `dipinjam`) VALUES
(3, 'Samuel Leibowitz', 'Komedi', 'Fred D. Pasley', 'Gramedia', '2010', 'Bandung', 'file_1497401121.jpeg', 'Pengacara Kaum tertindas', 5, 0),
(4, 'Alchemist', 'Novel', 'Al-Sany', 'Erlangga', '2012', 'Bandung', 'file_1497401307.png', 'Kisah perjalanan seorang alkemis', 2, 0),
(5, 'Lagos', 'Fiksi', 'Wa Toby', 'Bazit', '1999', 'Sukabumi', 'file_1527230274.png', 'Seseorang yang tergila gila akan kekuatan', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_pinjaman` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_proses` date NOT NULL,
  `status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_pinjaman`, `id_user`, `id_buku`, `tgl_pinjam`, `tgl_proses`, `status`) VALUES
(1, 7, 3, '2017-08-14', '0000-00-00', '5'),
(2, 7, 3, '2017-08-14', '2017-08-14', '5'),
(4, 7, 3, '2017-08-20', '0000-00-00', '5'),
(5, 7, 3, '2017-08-20', '0000-00-00', '5'),
(6, 7, 3, '2017-08-20', '2017-08-20', '1');

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id_pengembalian` int(11) NOT NULL,
  `id_pinjaman` int(11) NOT NULL,
  `tgl_kembali` date NOT NULL,
  `status_kem` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengembalian`
--

INSERT INTO `pengembalian` (`id_pengembalian`, `id_pinjaman`, `tgl_kembali`, `status_kem`) VALUES
(1, 2, '2017-08-21', '5'),
(2, 6, '2017-08-27', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_pinjaman`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id_pengembalian`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_pinjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
