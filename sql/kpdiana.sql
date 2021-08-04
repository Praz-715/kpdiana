-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Agu 2021 pada 15.50
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Struktur dari tabel `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `kode_trans_masuk` varchar(12) NOT NULL,
  `tgl_trans_masuk` date NOT NULL,
  `time` time NOT NULL,
  `nama_tempat_beli` varchar(30) NOT NULL,
  `isi` longtext DEFAULT NULL,
  `grand_total` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang_masuk`
--

INSERT INTO `barang_masuk` (`kode_trans_masuk`, `tgl_trans_masuk`, `time`, `nama_tempat_beli`, `isi`, `grand_total`) VALUES
('TRBM-1', '2021-07-08', '15:31:19', 'Umum', '[{\"namabarang\":\"Bawang Merah\",\"qtsebelumnya\":\"0\",\"unit\":\"Kg\",\"barang\":\"BR-1\",\"qt\":\"100\",\"subharga\":\"3000\",\"harga\":\"300000\",\"add\":\"\",\"qtsesudahnya\":100},{\"namabarang\":\"sandal\",\"qtsebelumnya\":\"0\",\"unit\":\"Pcs\",\"barang\":\"BR-3\",\"qt\":\"50\",\"subharga\":\"3500\",\"harga\":\"175000\",\"add\":\"\",\"qtsesudahnya\":50},{\"namabarang\":\"jepit rambut\",\"qtsebelumnya\":\"0\",\"unit\":\"Pcs\",\"barang\":\"BR-5\",\"qt\":\"700\",\"subharga\":\"2500\",\"harga\":\"1750000\",\"add\":\"\",\"qtsesudahnya\":700}]', 2225000),
('TRBM-2', '2021-07-08', '15:31:45', 'Umum', '[{\"namabarang\":\"Bawang Putih\",\"qtsebelumnya\":\"0\",\"unit\":\"Kg\",\"barang\":\"BR-2\",\"qt\":\"70\",\"subharga\":\"5000\",\"harga\":\"350000\",\"add\":\"\",\"qtsesudahnya\":70},{\"namabarang\":\"sandal\",\"qtsebelumnya\":\"50\",\"unit\":\"Pcs\",\"barang\":\"BR-3\",\"qt\":\"60\",\"subharga\":\"3500\",\"harga\":\"210000\",\"add\":\"\",\"qtsesudahnya\":110},{\"namabarang\":\"jepit rambut\",\"qtsebelumnya\":\"700\",\"unit\":\"Pcs\",\"barang\":\"BR-5\",\"qt\":\"80\",\"subharga\":\"2500\",\"harga\":\"200000\",\"add\":\"\",\"qtsesudahnya\":780}]', 760000),
('TRBM-3', '2021-07-09', '15:11:41', 'Umum', '[{\"namabarang\":\"Topi\",\"qtsebelumnya\":\"\",\"unit\":\"Pcs\",\"barang\":\"BR-6\",\"qt\":\"10\",\"subharga\":\"45000\",\"harga\":\"450000\",\"add\":\"\",\"qtsesudahnya\":10}]', 450000),
('TRBM-4', '2021-07-13', '10:25:13', 'Umum', '[{\"namabarang\":\"Bawang Putih\",\"qtsebelumnya\":\"70\",\"unit\":\"Kg\",\"barang\":\"BR-2\",\"qt\":\"23\",\"subharga\":\"5000\",\"harga\":\"115000\",\"add\":\"\",\"qtsesudahnya\":93}]', 115000),
('TRBM-5', '2021-07-14', '11:31:31', 'Umum', '[{\"namabarang\":\"sandal\",\"qtsebelumnya\":\"31\",\"unit\":\"Pcs\",\"barang\":\"BR-3\",\"qt\":\"9\",\"subharga\":\"3500\",\"harga\":\"31500\",\"add\":\"\",\"qtsesudahnya\":40}]', 31500),
('TRBM-6', '2021-08-04', '20:41:07', 'Umum', '[{\"namabarang\":\"Bawang Merah\",\"qtsebelumnya\":\"28\",\"unit\":\"Kg\",\"barang\":\"BR-1\",\"qt\":\"4\",\"subharga\":\"3000\",\"harga\":\"12000\",\"add\":\"\",\"qtsesudahnya\":32},{\"namabarang\":\"sandal\",\"qtsebelumnya\":\"40\",\"unit\":\"Pcs\",\"barang\":\"BR-3\",\"qt\":\"2\",\"subharga\":\"3500\",\"harga\":\"7000\",\"add\":\"\",\"qtsesudahnya\":42}]', 19000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_penjualan`
--

CREATE TABLE `data_penjualan` (
  `no_trans_penjualan` varchar(12) NOT NULL,
  `tgl_trans_penjualan` date NOT NULL,
  `time` time NOT NULL,
  `fk_pelanggan` varchar(30) NOT NULL,
  `isi` longtext DEFAULT NULL,
  `total` bigint(20) NOT NULL,
  `biaya_kirim` bigint(20) NOT NULL,
  `grand_total` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_penjualan`
--

INSERT INTO `data_penjualan` (`no_trans_penjualan`, `tgl_trans_penjualan`, `time`, `fk_pelanggan`, `isi`, `total`, `biaya_kirim`, `grand_total`) VALUES
('TRP-1', '2021-07-08', '15:32:15', 'PLG-3', '[{\"namabarang\":\"Bawang Merah\",\"qtsebelumnya\":\"100\",\"unit\":\"Kg\",\"barang\":\"BR-1\",\"stok\":\"100\",\"qt\":\"30\",\"subharga\":\"4000\",\"harga\":\"120000\",\"add\":\"\",\"qtsesudahnya\":70},{\"namabarang\":\"sandal\",\"qtsebelumnya\":\"110\",\"unit\":\"Pcs\",\"barang\":\"BR-3\",\"stok\":\"110\",\"qt\":\"70\",\"subharga\":\"5000\",\"harga\":\"350000\",\"add\":\"\",\"qtsesudahnya\":40},{\"namabarang\":\"jepit rambut\",\"qtsebelumnya\":\"780\",\"unit\":\"Pcs\",\"barang\":\"BR-5\",\"stok\":\"780\",\"qt\":\"55\",\"subharga\":\"4500\",\"harga\":\"247500\",\"add\":\"\",\"qtsesudahnya\":725}]', 717500, 100000, 817500),
('TRP-2', '2021-07-08', '15:32:41', 'PLG-3', '[{\"namabarang\":\"jepit rambut\",\"qtsebelumnya\":\"725\",\"unit\":\"Pcs\",\"barang\":\"BR-5\",\"stok\":\"725\",\"qt\":12,\"subharga\":\"4500\",\"harga\":54000,\"add\":\"\",\"qtsesudahnya\":713},{\"namabarang\":\"Bawang Merah\",\"qtsebelumnya\":\"70\",\"unit\":\"Kg\",\"barang\":\"BR-1\",\"stok\":\"70\",\"qt\":\"9\",\"subharga\":\"4000\",\"harga\":\"36000\",\"add\":\"\",\"qtsesudahnya\":61},{\"namabarang\":\"sandal\",\"qtsebelumnya\":\"40\",\"unit\":\"Pcs\",\"barang\":\"BR-3\",\"stok\":\"40\",\"qt\":\"6\",\"subharga\":\"5000\",\"harga\":\"30000\",\"add\":\"\",\"qtsesudahnya\":34}]', 120000, 100000, 220000),
('TRP-3', '2021-07-09', '09:37:49', 'PLG-3', '[{\"namabarang\":\"sandal\",\"qtsebelumnya\":\"34\",\"unit\":\"Pcs\",\"barang\":\"BR-3\",\"stok\":\"34\",\"qt\":\"3\",\"subharga\":\"5000\",\"harga\":\"15000\",\"add\":\"\",\"qtsesudahnya\":31},{\"namabarang\":\"Bawang Merah\",\"qtsebelumnya\":\"61\",\"unit\":\"Kg\",\"barang\":\"BR-1\",\"stok\":\"61\",\"qt\":\"7\",\"subharga\":\"4000\",\"harga\":\"28000\",\"add\":\"\",\"qtsesudahnya\":54}]', 43000, 100000, 143000),
('TRP-4', '2021-07-09', '15:12:33', 'PLG-3', '[{\"namabarang\":\"Topi\",\"qtsebelumnya\":\"10\",\"unit\":\"Pcs\",\"barang\":\"BR-6\",\"stok\":\"10\",\"qt\":\"10\",\"subharga\":\"55000\",\"harga\":\"550000\",\"add\":\"\",\"qtsesudahnya\":0},{\"namabarang\":\"jepit rambut\",\"qtsebelumnya\":\"713\",\"unit\":\"Pcs\",\"barang\":\"BR-5\",\"stok\":\"713\",\"qt\":\"649\",\"subharga\":\"4500\",\"harga\":\"2920500\",\"add\":\"\",\"qtsesudahnya\":64}]', 3470500, 100000, 3570500),
('TRP-5', '2021-07-13', '10:25:43', 'PLG-3', '[{\"namabarang\":\"Bawang Merah\",\"qtsebelumnya\":\"54\",\"unit\":\"Kg\",\"barang\":\"BR-1\",\"stok\":\"54\",\"qt\":\"26\",\"subharga\":\"4000\",\"harga\":\"104000\",\"add\":\"\",\"qtsesudahnya\":28}]', 104000, 100000, 204000),
('TRP-6', '2021-07-16', '17:10:08', 'PLG-3', '[{\"namabarang\":\"jepit rambut\",\"qtsebelumnya\":\"64\",\"unit\":\"Pcs\",\"barang\":\"BR-5\",\"stok\":\"64\",\"qt\":\"50\",\"subharga\":\"4500\",\"harga\":\"225000\",\"add\":\"\",\"qtsesudahnya\":14}]', 225000, 100000, 325000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `identitas_barang`
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
-- Dumping data untuk tabel `identitas_barang`
--

INSERT INTO `identitas_barang` (`Kode_Barang`, `Nama_Barang`, `Unit`, `Harga_Beli`, `Harga_Jual`, `Quantity`, `Total_Quantity`) VALUES
('BR-1', 'Bawang Merah', 'Kg', 3000, 4000, 32, 12),
('BR-2', 'Bawang Putih', 'Kg', 5000, 5500, 93, 30),
('BR-3', 'sandal', 'Pcs', 3500, 5000, 42, NULL),
('BR-5', 'jepit rambut', 'Pcs', 2500, 4500, 14, NULL),
('BR-6', 'Topi', 'Pcs', 45000, 55000, 0, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `identitas_usaha`
--

CREATE TABLE `identitas_usaha` (
  `Id_Usaha` varchar(12) NOT NULL,
  `Nama_Usaha` varchar(20) NOT NULL,
  `Alamat` varchar(100) NOT NULL,
  `Telpon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `Kode_Pelanggan` varchar(12) NOT NULL,
  `Nama_Pelanggan` varchar(30) NOT NULL,
  `Alamat_Pelanggan` varchar(255) NOT NULL,
  `Kota_Pelanggan` varchar(30) NOT NULL,
  `Email_Pelanggan` varchar(30) DEFAULT NULL,
  `Telp_Pelanggan` varchar(30) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`Kode_Pelanggan`, `Nama_Pelanggan`, `Alamat_Pelanggan`, `Kota_Pelanggan`, `Email_Pelanggan`, `Telp_Pelanggan`, `deleted`) VALUES
('PLG-1', 'Fortuna', 'Jl. Moh. Kahfi 1 No.1, RT.9/RW.4, Cipedak, Jagakar', 'Jakarta Selatan', 'Fortuna_Swalayan@gmail.com', '(021) 78885739', 0),
('PLG-3', 'Devi', 'Jl. Baru kemarin jadi', 'Jakarta Pusat', 'devi@mail.on.com', '085000000', 0),
('PLG-4', 'a', 'a', 'Jakarta Barat', 'a@a.com', '1', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `gambar` varchar(50) NOT NULL DEFAULT 'default.png',
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `nama`, `gambar`, `is_admin`) VALUES
(6, 'admin@admin.com', '$2y$10$LTY/uVqczhDD6chNsqh1kupN5Wgqe5FUp39Av5QCkIvqc7DB23Fsq', 'admin', 'default.png', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`kode_trans_masuk`);

--
-- Indeks untuk tabel `data_penjualan`
--
ALTER TABLE `data_penjualan`
  ADD PRIMARY KEY (`no_trans_penjualan`),
  ADD KEY `Nama_Pelanggan` (`fk_pelanggan`);

--
-- Indeks untuk tabel `identitas_barang`
--
ALTER TABLE `identitas_barang`
  ADD PRIMARY KEY (`Kode_Barang`),
  ADD KEY `Nama_Barang` (`Nama_Barang`);

--
-- Indeks untuk tabel `identitas_usaha`
--
ALTER TABLE `identitas_usaha`
  ADD PRIMARY KEY (`Id_Usaha`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`Kode_Pelanggan`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `data_penjualan`
--
ALTER TABLE `data_penjualan`
  ADD CONSTRAINT `data_penjualan_ibfk_1` FOREIGN KEY (`fk_pelanggan`) REFERENCES `pelanggan` (`Kode_Pelanggan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
