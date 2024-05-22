-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2024 at 02:10 AM
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
(3, 'enggal', 3, 'enggal'),
(12, 'a', 2, 'a'),
(13, 'ademin', 3, 'ademin'),
(15, 'berlian', 3, 'berlian'),
(16, 'nepenthes', 3, 'nep');

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE `bus` (
  `busID` int(11) NOT NULL,
  `ruteID` int(11) DEFAULT NULL,
  `total_kursi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`busID`, `ruteID`, `total_kursi`) VALUES
(1, 1, 40),
(2, 2, 50),
(3, 3, 30);

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
(12, 'a', 'a', 'a@a.com'),
(13, 'ademin', 'ademin', 'ademin@ademin.com'),
(15, 'berlian', 'berlian', 'berlian@gmail.com'),
(16, 'nepenthes', 'nepenthes', 'nep@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `rute`
--

CREATE TABLE `rute` (
  `ruteID` int(11) NOT NULL,
  `waktu_berangkat` time NOT NULL,
  `asal` varchar(255) NOT NULL,
  `tanggal_berangkat` date NOT NULL,
  `tujuan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rute`
--

INSERT INTO `rute` (`ruteID`, `waktu_berangkat`, `asal`, `tanggal_berangkat`, `tujuan`) VALUES
(1, '08:00:00', 'Jakarta', '2024-06-01', 'Bandung'),
(2, '09:00:00', 'Jakarta', '2024-06-01', 'Yogyakarta'),
(3, '10:00:00', 'Bandung', '2024-06-02', 'Surabaya');

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
-- Table structure for table `tiket`
--

CREATE TABLE `tiket` (
  `tiketID` int(11) NOT NULL,
  `ruteID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `pembayaran` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tiket`
--

INSERT INTO `tiket` (`tiketID`, `ruteID`, `userID`, `pembayaran`) VALUES
(1, 1, 12, 1),
(2, 1, 12, 1),
(3, 1, 13, 0),
(4, 2, 15, 1),
(5, 2, 16, 0),
(20, 1, 3, 0),
(21, 1, 3, 0),
(22, 1, 3, 0),
(23, 1, 3, 0),
(26, 2, 3, 0),
(31, 2, 15, 1),
(33, 2, 15, 1),
(34, 2, 15, 0),
(35, 1, 15, 1),
(36, 2, 15, 1),
(37, 2, 15, 0);

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
  ADD PRIMARY KEY (`busID`),
  ADD KEY `ruteID` (`ruteID`);

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
-- Indexes for table `rute`
--
ALTER TABLE `rute`
  ADD PRIMARY KEY (`ruteID`);

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
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `rute`
--
ALTER TABLE `rute`
  MODIFY `ruteID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tiket`
--
ALTER TABLE `tiket`
  MODIFY `tiketID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `akun`
--
ALTER TABLE `akun`
  ADD CONSTRAINT `akun_ibfk_1` FOREIGN KEY (`kategoriID`) REFERENCES `kategori` (`kategoriID`);

--
-- Constraints for table `bus`
--
ALTER TABLE `bus`
  ADD CONSTRAINT `bus_ibfk_1` FOREIGN KEY (`ruteID`) REFERENCES `rute` (`ruteID`);

--
-- Constraints for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD CONSTRAINT `pengguna_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `akun` (`userID`);

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
