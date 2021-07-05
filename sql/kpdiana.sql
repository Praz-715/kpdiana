-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2021 at 12:13 PM
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
  `nama_tempat_beli` varchar(30) NOT NULL,
  `isi` longtext,
  `grand_total` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`kode_trans_masuk`, `tgl_trans_masuk`, `nama_tempat_beli`, `isi`, `grand_total`) VALUES
('TRBM-1', '2021-06-30', 'Aang suderajat', '[{\"namabarang\":\"Bawang Merah\",\"barang\":\"BR-1\",\"qt\":\"3\",\"subharga\":\"3000\",\"harga\":\"9000\",\"add\":\"\"},{\"namabarang\":\"Bawang Putih\",\"barang\":\"BR-2\",\"qt\":\"4\",\"subharga\":\"5000\",\"harga\":\"20000\",\"add\":\"\"},{\"namabarang\":\"jepit rambut\",\"barang\":\"BR-5\",\"qt\":\"5\",\"subharga\":\"2500\",\"harga\":\"12500\",\"add\":\"\"}]', 5000000),
('TRBM-2', '2021-07-05', 'ad', '[{\"namabarang\":\"Bawang Merah\",\"barang\":\"BR-1\",\"qt\":\"3\",\"subharga\":\"3000\",\"harga\":\"9000\",\"add\":\"\"},{\"namabarang\":\"Bawang Putih\",\"barang\":\"BR-2\",\"qt\":\"4\",\"subharga\":\"5000\",\"harga\":\"20000\",\"add\":\"\"},{\"namabarang\":\"jepit rambut\",\"barang\":\"BR-5\",\"qt\":\"5\",\"subharga\":\"2500\",\"harga\":\"12500\",\"add\":\"\"}]', 41500),
('TRBM-3', '2021-07-05', 'Pasar', '[{\"namabarang\":\"sandal\",\"barang\":\"BR-3\",\"qt\":\"100\",\"subharga\":\"3500\",\"harga\":\"350000\",\"add\":\"\"},{\"namabarang\":\"Bawang Putih\",\"barang\":\"BR-2\",\"qt\":\"200\",\"subharga\":\"5000\",\"harga\":\"1000000\",\"add\":\"\"},{\"namabarang\":\"jepit rambut\",\"barang\":\"BR-5\",\"qt\":\"300\",\"subharga\":\"2500\",\"harga\":\"750000\",\"add\":\"\"}]', 2100000),
('TRBM-4', '2021-07-05', 'Umum', '[{\"namabarang\":\"sandal\",\"barang\":\"BR-3\",\"qt\":\"500\",\"subharga\":\"3500\",\"harga\":\"1750000\",\"add\":\"\"}]', 1750000);

-- --------------------------------------------------------

--
-- Table structure for table `data_penjualan`
--

CREATE TABLE `data_penjualan` (
  `No_Trans_Penjualan` varchar(12) NOT NULL,
  `Tgl_Trans_Penjualan` date NOT NULL,
  `Kode_Barang` varchar(12) NOT NULL,
  `Nama_Pelanggan` varchar(30) NOT NULL,
  `Total_Harga` bigint(20) NOT NULL,
  `Biaya_Kirim` bigint(20) NOT NULL,
  `Grand_Total` bigint(20) NOT NULL,
  `Total` bigint(20) NOT NULL
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
  `Total_Quantity` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `identitas_barang`
--

INSERT INTO `identitas_barang` (`Kode_Barang`, `Nama_Barang`, `Unit`, `Harga_Beli`, `Harga_Jual`, `Quantity`, `Total_Quantity`) VALUES
('BR-1', 'Bawang Merah', 'Kg', 3000, 4000, 12, 12),
('BR-2', 'Bawang Putih', 'Kg', 5000, 5500, 30, 30),
('BR-3', 'sandal', 'Pcs', 3500, 5000, NULL, NULL),
('BR-5', 'jepit rambut', 'Pcs', 2500, 4500, NULL, NULL);

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
  `Telp_Pelanggan` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`Kode_Pelanggan`, `Nama_Pelanggan`, `Alamat_Pelanggan`, `Kota_Pelanggan`, `Email_Pelanggan`, `Telp_Pelanggan`) VALUES
('PLG-1', 'Fortuna', 'Jl. Moh. Kahfi 1 No.1, RT.9/RW.4, Cipedak, Jagakar', 'Jakarta Selatan', 'Fortuna_Swalayan@gmail.com', '(021) 78885739'),
('PLG-2', 'Aneka Bu', 'Jl. Moh. Kahfi 1 No.1, RT.9/RW.4, Cipedak, Jagakar', 'Jakarta Selatan', 'Aneka_Bu@gmail.com', '(021) 78885739'),
('PLG-3', 'Devi', 'Jl. Baru kemarin jadi', 'Jakarta Pusat', 'devi@mail.on.com', '085000000');

-- --------------------------------------------------------

--
-- Table structure for table `user_/_admin`
--

CREATE TABLE `user_/_admin` (
  `Id_Admin` varchar(20) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `Nama` varchar(30) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  ADD PRIMARY KEY (`No_Trans_Penjualan`),
  ADD KEY `Kode_Barang` (`Kode_Barang`),
  ADD KEY `Nama_Pelanggan` (`Nama_Pelanggan`);

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
-- Indexes for table `user_/_admin`
--
ALTER TABLE `user_/_admin`
  ADD PRIMARY KEY (`Id_Admin`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_penjualan`
--
ALTER TABLE `data_penjualan`
  ADD CONSTRAINT `Kode_Barang` FOREIGN KEY (`Kode_Barang`) REFERENCES `identitas_barang` (`Kode_Barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Nama_Pelanggan` FOREIGN KEY (`Nama_Pelanggan`) REFERENCES `pelanggan` (`Kode_Pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
