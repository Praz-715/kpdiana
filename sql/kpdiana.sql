-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2021 at 11:13 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kpdiana`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `kode_trans_masuk` varchar(12) NOT NULL,
  `tgl_trans_masuk` date NOT NULL,
  `time` time NOT NULL,
  `nama_tempat_beli` varchar(30) NOT NULL,
  `isi` longtext,
  `grand_total` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `data_penjualan`
--

CREATE TABLE `data_penjualan` (
  `no_trans_penjualan` varchar(12) NOT NULL,
  `tgl_trans_penjualan` date NOT NULL,
  `time` time NOT NULL,
  `fk_pelanggan` varchar(30) NOT NULL,
  `isi` longtext,
  `total` bigint(20) NOT NULL,
  `biaya_kirim` bigint(20) NOT NULL,
  `grand_total` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `identitas_barang`
--

CREATE TABLE `identitas_barang` (
  `Kode_Barang` varchar(12) NOT NULL,
  `Nama_Barang` varchar(30) NOT NULL,
  `Unit` enum('Kg','Pcs') NOT NULL,
  `Harga_Beli` bigint(20) NOT NULL,
  `Harga_Jual` bigint(20) NOT NULL,
  `Quantity` bigint(20) DEFAULT NULL,
  `Total_Quantity` bigint(20) DEFAULT NULL,
  `uploaded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `identitas_usaha`
--

CREATE TABLE `identitas_usaha` (
  `Id_Usaha` varchar(12) NOT NULL,
  `Nama_Usaha` varchar(20) NOT NULL,
  `Alamat` varchar(100) NOT NULL,
  `Telpon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `Kode_Pelanggan` varchar(12) NOT NULL,
  `Nama_Pelanggan` varchar(30) NOT NULL,
  `Alamat_Pelanggan` varchar(255) NOT NULL,
  `Kota_Pelanggan` varchar(30) NOT NULL,
  `Email_Pelanggan` varchar(30) DEFAULT NULL,
  `Telp_Pelanggan` varchar(30) DEFAULT NULL,
  `uploaded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `gambar` varchar(50) NOT NULL DEFAULT 'default.png',
  `is_admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `nama`, `gambar`, `is_admin`) VALUES
(6, 'admin@admin.com', '$2y$10$LTY/uVqczhDD6chNsqh1kupN5Wgqe5FUp39Av5QCkIvqc7DB23Fsq', 'admin', 'default.png', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`kode_trans_masuk`);

--
-- Indexes for table `data_penjualan`
--
ALTER TABLE `data_penjualan`
  ADD PRIMARY KEY (`no_trans_penjualan`),
  ADD KEY `Nama_Pelanggan` (`fk_pelanggan`);

--
-- Indexes for table `identitas_barang`
--
ALTER TABLE `identitas_barang`
  ADD PRIMARY KEY (`Kode_Barang`),
  ADD KEY `Nama_Barang` (`Nama_Barang`);

--
-- Indexes for table `identitas_usaha`
--
ALTER TABLE `identitas_usaha`
  ADD PRIMARY KEY (`Id_Usaha`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`Kode_Pelanggan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_penjualan`
--
ALTER TABLE `data_penjualan`
  ADD CONSTRAINT `data_penjualan_ibfk_1` FOREIGN KEY (`fk_pelanggan`) REFERENCES `pelanggan` (`Kode_Pelanggan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
