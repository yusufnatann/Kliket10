-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2024 at 06:28 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kliket_satu`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `userID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `kategoriID` int(11) DEFAULT NULL,
  `kata_sandi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`userID`, `username`, `kategoriID`, `kata_sandi`) VALUES
(1, 'admin', 1, 'admin'),
(2, 'anta', 2, 'anta'),
(3, 'enggal', 3, 'haha'),
(12, 'a', 2, 'a'),
(13, 'ademin', 3, 'ademin'),
(15, 'berlian', 3, 'berlian'),
(16, 'nepenthes', 3, 'nep'),
(18, 'MIMA', 3, 'mima'),
(22, 'test', 2, 'test'),
(23, 'jigoku', 3, 'jiji');

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE `bus` (
  `busid` int(11) NOT NULL,
  `total_kursi` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`busid`, `total_kursi`, `nama`) VALUES
(1, 40, 'Eksekutif'),
(2, 50, 'Pariwisata'),
(3, 30, 'ROYAL'),
(4, 5, 'Private');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `kategoriID` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kategoriID`, `nama_kategori`) VALUES
(1, 'Admin'),
(2, 'Petugas'),
(3, 'Penumpang');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `userid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`userid`, `username`, `nama`, `email`) VALUES
(3, 'enggal', 'Enggal bima sakti', 'enggalbim@gmail.com'),
(13, 'ademin', 'ademin', 'ademin@ademin.com'),
(15, 'berlian', 'Berli Anta Atrizki', 'berlian@gmail.com'),
(16, 'nepenthes', 'nepenthes', 'nep@gmail.com'),
(18, 'MIMA', 'MIMA', 'mima@mima.com'),
(23, 'jigoku', 'Jigong Ku Ning', 'jigoku@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `userid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`userid`, `username`, `nama`, `email`) VALUES
(2, 'anta', 'anta', 'anta@gmail.com'),
(12, 'a', 'a', 'a@gmail.com'),
(22, 'test', 'test', 'test@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `rute`
--

CREATE TABLE `rute` (
  `ruteID` int(11) NOT NULL,
  `waktu_berangkat` time NOT NULL,
  `asal` varchar(255) NOT NULL,
  `tanggal_berangkat` date NOT NULL,
  `tujuan` varchar(255) DEFAULT NULL,
  `busID` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rute`
--

INSERT INTO `rute` (`ruteID`, `waktu_berangkat`, `asal`, `tanggal_berangkat`, `tujuan`, `busID`, `harga`) VALUES
(1, '08:00:00', 'Jakarta', '2024-06-01', 'Bandung', 1, 75000),
(2, '11:00:00', 'Jakarta', '2024-06-01', 'Yogyakarta', 2, 240000),
(3, '15:00:00', 'Bandung', '2024-06-02', 'Surabaya', 3, 300000),
(4, '11:00:00', 'Jakarta', '2024-06-01', 'Bandung', 2, 300000),
(5, '11:00:00', 'Jakarta', '2024-06-02', 'Bandung', 2, 300000),
(6, '15:00:00', 'Jakarta', '2024-06-01', 'Bandung', 2, 300000),
(7, '08:00:00', 'Jakarta', '2024-06-02', 'Bandung', 2, 300000),
(8, '11:00:00', 'Jakarta', '2024-06-02', 'Bandung', 2, 300000),
(9, '15:00:00', 'Jakarta', '2024-06-02', 'Bandung', 2, 300000),
(10, '08:00:00', 'Jakarta', '2024-06-03', 'Bandung', 2, 300000),
(11, '08:00:00', 'Bandar Lampung', '2024-06-04', 'Jakarta', 3, 350000),
(12, '11:00:00', 'Bandung', '2024-06-03', 'Surabaya', 2, 180000);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `userid` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `terminal`
--

CREATE TABLE `terminal` (
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `terminal`
--

INSERT INTO `terminal` (`nama`) VALUES
('Yogyakarta'),
('Bandung'),
('Jakarta'),
('Bandar Lampung'),
('Malang'),
('Surabaya');

-- --------------------------------------------------------

--
-- Table structure for table `tiket`
--

CREATE TABLE `tiket` (
  `tiketID` int(11) NOT NULL,
  `ruteID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `pembayaran` int(11) DEFAULT NULL,
  `status_kehadiran` varchar(20) DEFAULT 'Belum Ditentukan',
  `bukti_pembayaran` varchar(255) DEFAULT NULL,
  `kode_unik_bank` varchar(255) DEFAULT NULL,
  `valid` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tiket`
--

INSERT INTO `tiket` (`tiketID`, `ruteID`, `userID`, `pembayaran`, `status_kehadiran`, `bukti_pembayaran`, `kode_unik_bank`, `valid`) VALUES
(1, 1, 12, 1, 'Hadir', NULL, '8668258480', 0),
(2, 1, 12, 1, 'Tidak Hadir', NULL, '8568258480', 0),
(3, 1, 13, 0, 'Belum Ditentukan', NULL, '5668258480', 0),
(4, 2, 15, 1, 'Hadir', NULL, '3506641723', 1),
(5, 2, 16, 0, 'Belum Ditentukan', NULL, '2000771329', 0),
(20, 1, 3, 2, 'Belum Ditentukan', NULL, '9807495154', 0),
(21, 1, 3, 2, 'Belum Ditentukan', NULL, '2381597705', 0),
(22, 1, 3, 1, 'Hadir', NULL, '4299827265', 1),
(23, 1, 3, 2, 'Belum Ditentukan', NULL, '5094065676', 0),
(26, 2, 3, 2, 'Belum Ditentukan', NULL, '1368834801', 0),
(31, 2, 15, 1, 'Belum Ditentukan', NULL, '8433572790', 1),
(33, 2, 15, 1, 'Belum Ditentukan', NULL, '8719015271', 1),
(34, 2, 15, 2, 'Belum Ditentukan', NULL, '4323939295', 0),
(35, 1, 15, 1, 'Hadir', NULL, '8798074951', 1),
(36, 2, 15, 1, 'Belum Ditentukan', NULL, '8192074951', 1),
(37, 2, 15, 2, 'Belum Ditentukan', NULL, '5598055955', 0),
(38, 1, 3, 2, 'Belum Ditentukan', NULL, '6328022931', 0),
(39, 2, 2, 0, 'Belum Ditentukan', NULL, '7980749519', 0),
(40, 2, 3, 1, 'Hadir', NULL, '1244194168', 1),
(41, 2, 3, 1, 'Tidak Hadir', NULL, '9807495154', 1),
(42, 2, 3, 2, 'Belum Ditentukan', NULL, '7778798074', 0),
(43, 1, 15, 1, 'Belum Ditentukan', '../buktiimage_2024-05-29_043701273.png', '6668074666', 1),
(44, 10, 15, 1, 'Belum Ditentukan', '../bukti/bukti_44.png', '8888074888', 1),
(45, 10, 15, 1, 'Belum Ditentukan', '../bukti/bukti_45.png', '9998074999', 1),
(46, 10, 15, 1, 'Belum Ditentukan', '../buktiimage_2024-05-29_043819482.png', '1118074111', 1),
(48, 10, 15, 0, 'Belum Ditentukan', NULL, '2748392255', 0),
(49, 10, 15, 0, 'Belum Ditentukan', NULL, '7508786792', 0),
(50, 12, 23, 1, 'Hadir', '../bukti/bukti_50.png', '4770674839', 1),
(51, 12, 23, 2, 'Belum Ditentukan', NULL, '1672201267', 0),
(52, 12, 23, 1, 'Hadir', '../bukti/bukti_52.png', '3160822234', 1),
(53, 12, 23, 1, 'Belum Ditentukan', '../bukti/bukti_53.png', '1549228297', 0),
(54, 12, 23, 1, 'Belum Ditentukan', '../bukti/bukti_54.png', '1112405470', 0),
(55, 12, 23, 1, 'Belum Ditentukan', '../bukti/bukti_55.png', '7984145260', 0),
(56, 12, 23, 0, 'Belum Ditentukan', NULL, '2179213660', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`userID`,`username`),
  ADD KEY `kategoriID` (`kategoriID`);

--
-- Indexes for table `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`busid`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategoriID`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `rute`
--
ALTER TABLE `rute`
  ADD PRIMARY KEY (`ruteID`),
  ADD KEY `fk_rute_bus` (`busID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `tiket`
--
ALTER TABLE `tiket`
  ADD PRIMARY KEY (`tiketID`,`ruteID`,`userID`),
  ADD KEY `ruteID` (`ruteID`),
  ADD KEY `userID` (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `bus`
--
ALTER TABLE `bus`
  MODIFY `busid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rute`
--
ALTER TABLE `rute`
  MODIFY `ruteID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tiket`
--
ALTER TABLE `tiket`
  MODIFY `tiketID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `akun`
--
ALTER TABLE `akun`
  ADD CONSTRAINT `akun_ibfk_1` FOREIGN KEY (`kategoriID`) REFERENCES `kategori` (`kategoriID`);

--
-- Constraints for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD CONSTRAINT `pengguna_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `akun` (`userID`);

--
-- Constraints for table `petugas`
--
ALTER TABLE `petugas`
  ADD CONSTRAINT `petugas_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `akun` (`userID`);

--
-- Constraints for table `rute`
--
ALTER TABLE `rute`
  ADD CONSTRAINT `fk_rute_bus` FOREIGN KEY (`busID`) REFERENCES `bus` (`busid`);

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `akun` (`userID`);

--
-- Constraints for table `tiket`
--
ALTER TABLE `tiket`
  ADD CONSTRAINT `tiket_ibfk_1` FOREIGN KEY (`ruteID`) REFERENCES `rute` (`ruteID`),
  ADD CONSTRAINT `tiket_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `akun` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
