-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2023 at 02:57 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gudang_beras`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id` int(11) NOT NULL,
  `id_transaksi` varchar(100) NOT NULL,
  `nama_petugas` varchar(50) NOT NULL,
  `petugas_edit` varchar(50) NOT NULL,
  `customer` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `kode_barang` varchar(100) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `jumlah` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `satuan` varchar(100) NOT NULL,
  `total` int(11) NOT NULL,
  `ket_bayar` varchar(250) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`id`, `id_transaksi`, `nama_petugas`, `petugas_edit`, `customer`, `tanggal`, `kode_barang`, `nama_barang`, `jumlah`, `status`, `satuan`, `total`, `ket_bayar`, `harga`) VALUES
(1, 'TRK-0922001', '', '', '', '2022-09-04', 'BAR-0922002', 'Contoh 1', '10', 'Terjual', 'Kg', 0, '', 0),
(2, 'TRK-0922002', '', '', '', '2022-09-28', 'BAR-0922006', 'Beras 5 kg', '25', 'terjual', 'Zakk', 0, '', 0),
(7, 'TRK-1022003', '', '', '', '2022-10-24', 'BAR-1022007', 'Koi Merah', '10', 'belum', 'Kg', 0, '', 200000),
(8, 'TRK-1022004', '', '', '', '2022-10-24', 'BAR-1022007', 'Koi Merah', '10', '', 'Bon', 0, '', 200000),
(9, 'TRK-1022005', '', '', '', '2022-10-24', 'BAR-1022007', 'Koi Merah', '5', '', 'Kg', 0, 'Bon', 100000),
(11, 'TRK-1122006', '', '', 'Angga', '2022-11-22', 'BAR-1122012', 'xxxx', '10', '', 'Ton', 200000, 'zzzz', 20000),
(12, 'TRM-1123007', '', '', 'Aku', '2023-11-28', 'BAR-0922003', 'Contoh 2', '10', '', 'Kg', 10000, 'lunas', 1000),
(15, 'TRM-1223009', '', '', 'anda', '2023-12-02', 'BAR-1223015', 'tes', '6', '', 'Ton', 72000, 'lunas', 12000);

--
-- Triggers `barang_keluar`
--
DELIMITER $$
CREATE TRIGGER `barang_keluar` AFTER INSERT ON `barang_keluar` FOR EACH ROW BEGIN
	UPDATE gudang SET jumlah = jumlah-new.jumlah
    WHERE kode_barang=new.kode_barang;
    END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `edit_brg_keluar` AFTER UPDATE ON `barang_keluar` FOR EACH ROW BEGIN
	UPDATE gudang SET jumlah = jumlah+old.jumlah-new.jumlah
    WHERE kode_barang=new.kode_barang;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id` int(11) NOT NULL,
  `id_transaksi` varchar(100) NOT NULL,
  `nama_petugas` varchar(50) NOT NULL,
  `petugas_edit` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `kode_barang` varchar(100) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `jumlahh` varchar(100) NOT NULL,
  `satuan` varchar(100) NOT NULL,
  `harga` varchar(50) NOT NULL,
  `total` int(100) NOT NULL,
  `ket_bayar` varchar(250) NOT NULL,
  `tenaga` varchar(50) NOT NULL,
  `supplier` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`id`, `id_transaksi`, `nama_petugas`, `petugas_edit`, `tanggal`, `kode_barang`, `nama_barang`, `jumlahh`, `satuan`, `harga`, `total`, `ket_bayar`, `tenaga`, `supplier`) VALUES
(6, 'TRM-0922005', '', '', '2022-09-18', 'BAR-0922005', 'Contoh 4', '32', 'Kg', '0', 0, '', '0', ''),
(7, 'TRM-0922006', '', '', '2022-09-26', 'BAR-0922002', 'Contoh 1', '10', 'Kg', '0', 0, '', '0', ''),
(9, 'TRM-1022008', '', '', '2022-10-06', 'BAR-1022007', 'Koi Merah', '100', 'Kg', '0', 0, '', '0', ''),
(27, 'TRM-1022009', '', '', '2022-10-12', 'BAR-1022007', 'Koi Merah', '10', 'Kg', '0', 0, '', '0', ''),
(28, 'TRM-1022010', '', '', '2022-10-12', 'BAR-1022007', 'Koi Merah', '10', 'Kg', '0', 0, 'Lunas', '0', ''),
(29, 'TRM-1022011', '', '', '2022-10-12', 'BAR-1022007', 'Koi Merah', '10', 'Kg', '0', 0, 'lunas', '0', ''),
(30, 'TRM-1022012', '', '', '2022-10-16', 'BAR-1022007', 'Koi Merah', '5', 'Kg', '140000', 0, 'lunas', '0', ''),
(31, 'TRM-1022013', '', '', '2022-10-16', 'BAR-0922006', 'Beras 5 kg', '5', 'Zakk', '20000', 0, 'Lunas', '0', ''),
(37, 'TRM-1022015', '', '', '2022-10-16', 'BAR-0922006', 'Beras 5 kg', '10', 'Zakk', '140000', 0, 'ww', '0', ''),
(39, 'TRM-1022016', '', '', '2022-10-19', 'BAR-1022007', 'Koi Merah', '5', 'Kg', '10000', 0, 'Bon', '0', ''),
(40, 'TRM-1122017', '', '', '2022-11-07', 'BAR-0922006', 'Beras 5 kg', '10', 'Zakk', '100000', 0, 'Lunas', '0', ''),
(43, 'TRM-1122018', '', '', '2022-11-19', 'BAR-1122012', 'xxxx', '15', 'Ton', '100000', 0, 'adssada', '0', 'ada'),
(44, 'TRM-1122019', '', '', '2022-11-19', 'BAR-1122012', 'xxxx', '10', 'Ton', '20000', 0, 'zzfrs', '100000', 'zzzz'),
(47, 'TRM-1223020', '', '', '2023-12-01', 'BAR-1223014', 'Baru', '100', 'Zak', '13000', 1302500, 'Lunas', '2500', 'Angga'),
(49, 'TRM-1223021', '', '', '2023-12-02', 'BAR-1223014', 'Baru', '10', 'Zak', '12000', 119750, 'lns', '250', 'pa'),
(50, 'TRM-1223022', '', '', '2023-12-02', 'BAR-1223015', 'tes', '10', 'Ton', '120000', 1200000, 'lunas', '0', 'pa');

--
-- Triggers `barang_masuk`
--
DELIMITER $$
CREATE TRIGGER `barang_masuk` AFTER INSERT ON `barang_masuk` FOR EACH ROW BEGIN
	UPDATE gudang SET jumlah = jumlah+new.jumlahh
    WHERE kode_barang=new.kode_barang;
    END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `edit_brg_masuk` AFTER UPDATE ON `barang_masuk` FOR EACH ROW BEGIN
	UPDATE gudang SET jumlah = jumlah-old.jumlahh+new.jumlahh
    WHERE kode_barang=new.kode_barang;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `gudang`
--

CREATE TABLE `gudang` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(100) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `jenis_barang` varchar(100) NOT NULL,
  `jumlah` varchar(250) NOT NULL,
  `satuan` varchar(100) NOT NULL,
  `harga` varchar(100) NOT NULL,
  `total` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gudang`
--

INSERT INTO `gudang` (`id`, `kode_barang`, `nama_barang`, `jenis_barang`, `jumlah`, `satuan`, `harga`, `total`) VALUES
(2, 'BAR-0922002 ', 'Contoh 1', 'Bagus', '25', 'Kg', '110000', ''),
(3, 'BAR-0922003 ', 'Contoh 2', 'Bagus', '40', 'Kg', '15,000', ''),
(4, 'BAR-0922004 ', 'Contoh 3', 'Bagus', '32', 'Kg', '14000', ''),
(5, 'BAR-0922005 ', 'Contoh 4', 'Bagus', '32', 'Kg', '10000', ''),
(11, 'BAR-0922006 ', 'Beras 5 kg', 'Bagus', '85', 'Kg', '15,000', ''),
(12, 'BAR-1022007 ', 'Koi Merah', 'IR64', '65', 'Kg', '9800', '5'),
(24, 'BAR-1022009', 'COBA 1', 'IR64', '0', 'Kg', '1200', '0'),
(26, 'BAR-1022010', 'Contoh 2', 'IR64', '0', 'Zak', '20000', ''),
(27, 'BAR-1122011', 'Contoh 4', 'IR64', '0', 'Zak', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `id` int(11) NOT NULL,
  `satuan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`id`, `satuan`) VALUES
(9, 'Kg'),
(11, 'Zak'),
(14, 'Ton');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nik` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `telepon` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(25) NOT NULL DEFAULT 'member',
  `foto` varchar(25) NOT NULL,
  `status_users` enum('nonvalid','valid') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nik`, `nama`, `alamat`, `telepon`, `username`, `password`, `level`, `foto`, `status_users`) VALUES
(27, '10001', 'Ayanokoji', '', '0986660000', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'ayano.png', 'valid'),
(28, '2230010043', 'petugas', 'Kra', '0852437526323', 'Petugas', 'afb91ef692fd08c445e8cb1bab2ccf9c', 'petugas', 'cool.png', 'valid');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gudang`
--
ALTER TABLE `gudang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `gudang`
--
ALTER TABLE `gudang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
