-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 24, 2020 at 01:49 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `_naik`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `koderekening` varchar(25) NOT NULL,
  `namabank` varchar(15) DEFAULT NULL,
  `atasnama` varchar(50) DEFAULT NULL,
  `aktif` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`koderekening`, `namabank`, `atasnama`, `aktif`) VALUES
('123.123.123.123.1', 'Mandiri', 'Naik', '0'),
('1234.1234.1234.1', 'BRI', 'Naik', '1');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kodebarang` varchar(25) NOT NULL,
  `namabarang` varchar(50) DEFAULT NULL,
  `stokbarang` int(10) DEFAULT NULL,
  `hargabarang` int(15) DEFAULT NULL,
  `fotobarang` varchar(100) DEFAULT NULL,
  `deskripsi` longtext DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kodebarang`, `namabarang`, `stokbarang`, `hargabarang`, `fotobarang`, `deskripsi`, `tanggal`) VALUES
('bk1', 'Naik Kyrie 1', 100, 545000, 'b/bk1.jpg', 'Built on outsole inspired by moon craters, the Naik Kyrie combines sensational traction with responsive Zoom Air cushioning that helps you move seamlessly between offence and defence.', '2019-10-13 21:22:16'),
('bm1', 'Naik Mercurial 1', 100, 575000, 'b/bm1.jpg', 'The Naik Mercurial is built for fast play and adds a versatile multi-ground plate that provides traction on natural and artificial grass surfaces.', '2019-10-13 21:22:16'),
('bz1', 'Naik Zoom 1', 100, 565000, 'b/bz1.jpg', 'The Naik Zoom is designed to help make running feel easier and give your leg a day off. Tiny foam beads underfoot contour to your foot for cushioning that stands up to your mileage.', '2019-10-13 21:22:16'),
('gk1', 'Naik Kyrie 1', 100, 545000, 'g/gk1.jpg', 'Built on outsole inspired by moon craters, the Naik Kyrie combines sensational traction with responsive Zoom Air cushioning that helps you move seamlessly between offence and defence.', '2019-10-13 21:22:23'),
('gm1', 'Naik Mercurial 1', 100, 575000, 'g/gm1.jpg', 'The Naik Mercurial is built for fast play and adds a versatile multi-ground plate that provides traction on natural and artificial grass surfaces.', '2019-10-13 21:22:23'),
('mm1', 'Naik Mercurial 1', 100, 675000, 'm/mm1.jpg', 'The Naik Mercurial is built for fast play and adds a versatile multi-ground plate that provides traction on natural and artificial grass surfaces.', '2019-10-13 21:22:27'),
('mz1', 'Naik Zoom 1', 100, 665000, 'm/mz1.jpg', 'The Naik Zoom is designed to help make running feel easier and give your leg a day off. Tiny foam beads underfoot contour to your foot for cushioning that stands up to your mileage.', '2019-11-11 01:22:58'),
('N4951', 'Naik Kyrie 1', 100, 645000, 'm/N4951.jpg', 'Built on outsole inspired by moon craters, the Naik Kyrie combines sensational traction with responsive Zoom Air cushioning that helps you move seamlessly between offence and defence.', '2020-04-24 06:48:40'),
('N7500', 'Naik Zoom 1', 100, 565000, 'g/N7500.jpg', 'The Naik Zoom is designed to help make running feel easier and give your leg a day off. Tiny foam beads underfoot contour to your foot for cushioning that stands up to your mileage.', '2019-11-11 00:20:27'),
('wk1', 'Naik Kyrie 1', 100, 645000, 'w/wk1.jpg', 'Built on outsole inspired by moon craters, the Naik Kyrie combines sensational traction with responsive Zoom Air cushioning that helps you move seamlessly between offence and defence.', '2019-10-13 21:22:25'),
('wm1', 'Naik Mercurial 1', 100, 675000, 'w/wm1.jpg', 'The Naik Mercurial is built for fast play and adds a versatile multi-ground plate that provides traction on natural and artificial grass surfaces.', '2019-10-13 21:22:25'),
('wz1', 'Naik Zoom 1', 100, 665000, 'w/wz1.jpg', 'The Naik Zoom is designed to help make running feel easier and give your leg a day off. Tiny foam beads underfoot contour to your foot for cushioning that stands up to your mileage.', '2019-11-13 23:38:11');

-- --------------------------------------------------------

--
-- Table structure for table `harapan`
--

CREATE TABLE `harapan` (
  `email` varchar(50) DEFAULT NULL,
  `kodebarang` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `kodekategori` varchar(5) NOT NULL,
  `namakategori` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kodekategori`, `namakategori`) VALUES
('b', 'Boys'),
('g', 'Girls'),
('m', 'Men'),
('w', 'Women');

-- --------------------------------------------------------

--
-- Table structure for table `kategoribarang`
--

CREATE TABLE `kategoribarang` (
  `kodebarang` varchar(25) NOT NULL,
  `kodekategori` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategoribarang`
--

INSERT INTO `kategoribarang` (`kodebarang`, `kodekategori`) VALUES
('bk1', 'b'),
('bm1', 'b'),
('bz1', 'b'),
('gk1', 'g'),
('gm1', 'g'),
('N7500', 'g'),
('mm1', 'm'),
('mz1', 'm'),
('N4951', 'm'),
('wk1', 'w'),
('wm1', 'w'),
('wz1', 'w');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `email` varchar(50) DEFAULT NULL,
  `kodebarang` varchar(25) DEFAULT NULL,
  `jumlahbarang` varchar(5) DEFAULT NULL,
  `ukuran` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `email` varchar(50) NOT NULL,
  `sandi` varchar(100) DEFAULT NULL,
  `hash` varchar(100) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `telepon` varchar(15) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `status` int(5) DEFAULT NULL,
  `provinsi` varchar(100) DEFAULT NULL,
  `kota` varchar(100) DEFAULT NULL,
  `kodepos` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`email`, `sandi`, `hash`, `nama`, `telepon`, `alamat`, `status`, `provinsi`, `kota`, `kodepos`) VALUES
('admin@naik.com', '$2y$10$LcU1paWTU0Xcuj8nrhwcS.wMR/uptqxqzZyqWoYlwSQEnzA9hbyf2', '9308b0d6e5898366a4a986bc33f3d3e7', 'admin', '', '', 2, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `kodepesanan` varchar(20) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telepon` varchar(15) DEFAULT NULL,
  `total` int(15) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `bank` varchar(50) DEFAULT NULL,
  `status` int(5) DEFAULT NULL,
  `tanggaldetail` datetime DEFAULT NULL,
  `namapenerima` varchar(50) DEFAULT NULL,
  `koderesi` varchar(50) NOT NULL DEFAULT '0',
  `provinsi` varchar(100) DEFAULT NULL,
  `kota` varchar(100) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `kodepos` varchar(10) DEFAULT NULL,
  `tanggalselesai` date DEFAULT NULL,
  `tanggalkirim` date DEFAULT NULL,
  `tanggalbatal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pesananbatal`
--

CREATE TABLE `pesananbatal` (
  `kodepesanan` varchar(20) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telepon` varchar(15) DEFAULT NULL,
  `total` int(15) DEFAULT NULL,
  `bank` varchar(15) DEFAULT NULL,
  `tanggalbatal` date DEFAULT NULL,
  `status` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pesanandetail`
--

CREATE TABLE `pesanandetail` (
  `kodepesanan` varchar(20) DEFAULT NULL,
  `kodebarang` varchar(25) DEFAULT NULL,
  `jumlahbarang` varchar(5) DEFAULT NULL,
  `ukuran` varchar(5) DEFAULT NULL,
  `hargabarang` int(15) DEFAULT NULL,
  `namabarang` varchar(50) DEFAULT NULL,
  `kategori` varchar(15) DEFAULT NULL,
  `tipe` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tipe`
--

CREATE TABLE `tipe` (
  `kodetipe` varchar(5) NOT NULL,
  `namatipe` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipe`
--

INSERT INTO `tipe` (`kodetipe`, `namatipe`) VALUES
('k', 'Basketball'),
('m', 'Football'),
('z', 'Running');

-- --------------------------------------------------------

--
-- Table structure for table `tipebarang`
--

CREATE TABLE `tipebarang` (
  `kodebarang` varchar(25) NOT NULL,
  `kodetipe` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipebarang`
--

INSERT INTO `tipebarang` (`kodebarang`, `kodetipe`) VALUES
('bk1', 'k'),
('gk1', 'k'),
('N4951', 'k'),
('wk1', 'k'),
('bm1', 'm'),
('gm1', 'm'),
('mm1', 'm'),
('wm1', 'm'),
('bz1', 'z'),
('mz1', 'z'),
('N7500', 'z'),
('wz1', 'z');

-- --------------------------------------------------------

--
-- Table structure for table `ukuran`
--

CREATE TABLE `ukuran` (
  `ukuran` varchar(5) NOT NULL,
  `noukuran` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ukuran`
--

INSERT INTO `ukuran` (`ukuran`, `noukuran`) VALUES
('l', '38,39,40'),
('xl', '41,42,43');

-- --------------------------------------------------------

--
-- Table structure for table `ukuranbarang`
--

CREATE TABLE `ukuranbarang` (
  `ukuran` varchar(5) NOT NULL,
  `kodebarang` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ukuranbarang`
--

INSERT INTO `ukuranbarang` (`ukuran`, `kodebarang`) VALUES
('l', 'bk1'),
('l', 'bm1'),
('l', 'bz1'),
('l', 'gk1'),
('l', 'gm1'),
('xl', 'mm1'),
('xl', 'mz1'),
('xl', 'N4951'),
('l', 'N7500'),
('xl', 'wk1'),
('xl', 'wm1'),
('xl', 'wz1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`koderekening`),
  ADD UNIQUE KEY `namabank` (`namabank`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kodebarang`);

--
-- Indexes for table `harapan`
--
ALTER TABLE `harapan`
  ADD KEY `kodebarang` (`kodebarang`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kodekategori`),
  ADD UNIQUE KEY `namakategori` (`namakategori`);

--
-- Indexes for table `kategoribarang`
--
ALTER TABLE `kategoribarang`
  ADD PRIMARY KEY (`kodebarang`),
  ADD KEY `kodekategori` (`kodekategori`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD KEY `email` (`email`),
  ADD KEY `kodebarang` (`kodebarang`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`kodepesanan`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `pesananbatal`
--
ALTER TABLE `pesananbatal`
  ADD PRIMARY KEY (`kodepesanan`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `pesanandetail`
--
ALTER TABLE `pesanandetail`
  ADD KEY `kodepesanan` (`kodepesanan`),
  ADD KEY `kodebarang` (`kodebarang`);

--
-- Indexes for table `tipe`
--
ALTER TABLE `tipe`
  ADD PRIMARY KEY (`kodetipe`),
  ADD UNIQUE KEY `namatipe` (`namatipe`);

--
-- Indexes for table `tipebarang`
--
ALTER TABLE `tipebarang`
  ADD PRIMARY KEY (`kodebarang`),
  ADD KEY `kodetipe` (`kodetipe`);

--
-- Indexes for table `ukuran`
--
ALTER TABLE `ukuran`
  ADD PRIMARY KEY (`ukuran`);

--
-- Indexes for table `ukuranbarang`
--
ALTER TABLE `ukuranbarang`
  ADD PRIMARY KEY (`kodebarang`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `harapan`
--
ALTER TABLE `harapan`
  ADD CONSTRAINT `harapan_ibfk_1` FOREIGN KEY (`kodebarang`) REFERENCES `barang` (`kodebarang`),
  ADD CONSTRAINT `harapan_ibfk_2` FOREIGN KEY (`email`) REFERENCES `pengguna` (`email`);

--
-- Constraints for table `kategoribarang`
--
ALTER TABLE `kategoribarang`
  ADD CONSTRAINT `kategoribarang_ibfk_1` FOREIGN KEY (`kodebarang`) REFERENCES `barang` (`kodebarang`),
  ADD CONSTRAINT `kategoribarang_ibfk_2` FOREIGN KEY (`kodekategori`) REFERENCES `kategori` (`kodekategori`);

--
-- Constraints for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`email`) REFERENCES `pengguna` (`email`),
  ADD CONSTRAINT `keranjang_ibfk_2` FOREIGN KEY (`kodebarang`) REFERENCES `barang` (`kodebarang`);

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`email`) REFERENCES `pengguna` (`email`);

--
-- Constraints for table `pesananbatal`
--
ALTER TABLE `pesananbatal`
  ADD CONSTRAINT `pesananbatal_ibfk_1` FOREIGN KEY (`kodepesanan`) REFERENCES `pesanan` (`kodepesanan`),
  ADD CONSTRAINT `pesananbatal_ibfk_2` FOREIGN KEY (`email`) REFERENCES `pengguna` (`email`);

--
-- Constraints for table `pesanandetail`
--
ALTER TABLE `pesanandetail`
  ADD CONSTRAINT `pesanandetail_ibfk_1` FOREIGN KEY (`kodepesanan`) REFERENCES `pesanan` (`kodepesanan`);

--
-- Constraints for table `tipebarang`
--
ALTER TABLE `tipebarang`
  ADD CONSTRAINT `tipebarang_ibfk_1` FOREIGN KEY (`kodebarang`) REFERENCES `barang` (`kodebarang`),
  ADD CONSTRAINT `tipebarang_ibfk_2` FOREIGN KEY (`kodetipe`) REFERENCES `tipe` (`kodetipe`);

--
-- Constraints for table `ukuranbarang`
--
ALTER TABLE `ukuranbarang`
  ADD CONSTRAINT `ukuranbarang_ibfk_1` FOREIGN KEY (`kodebarang`) REFERENCES `barang` (`kodebarang`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
