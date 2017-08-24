-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2017 at 01:58 AM
-- Server version: 10.1.24-MariaDB
-- PHP Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `klinik`
--

-- --------------------------------------------------------

--
-- Table structure for table `berobat`
--

CREATE TABLE `berobat` (
  `notransaksi` varchar(10) NOT NULL,
  `pasienid` varchar(10) NOT NULL,
  `tanggal_berobat` date NOT NULL,
  `dokterid` varchar(10) NOT NULL,
  `keluhan` varchar(50) NOT NULL,
  `biaya_administrasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `berobat`
--

INSERT INTO `berobat` (`notransaksi`, `pasienid`, `tanggal_berobat`, `dokterid`, `keluhan`, `biaya_administrasi`) VALUES
('N01', 'PS03', '2017-08-22', 'D01', 'sakit', 500);

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `dokterid` varchar(10) NOT NULL,
  `namadokter` varchar(20) NOT NULL,
  `kodepoli` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`dokterid`, `namadokter`, `kodepoli`) VALUES
('D01', 'dr. Erna', 'P01'),
('D02', 'dr. Willy', 'P02'),
('D03', 'dr. Noo', 'P03');

-- --------------------------------------------------------

--
-- Stand-in structure for view `listberobat`
-- (See below for the actual view)
--
CREATE TABLE `listberobat` (
`notransaksi` varchar(10)
,`tanggal_berobat` date
,`namapasien` varchar(20)
,`usia` int(5)
,`jeniskelamin` varchar(10)
,`namapoli` varchar(20)
,`namadokter` varchar(20)
,`biaya_administrasi` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `pasienid` varchar(10) NOT NULL,
  `namapasien` varchar(20) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jeniskelamin` varchar(10) NOT NULL,
  `alamat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`pasienid`, `namapasien`, `tanggal_lahir`, `jeniskelamin`, `alamat`) VALUES
('PS01', 'Beni', '1990-10-10', 'Laki-Laki', 'Jakarta'),
('PS02', 'Yenn', '1995-08-10', 'Perempuan', 'Bandung'),
('PS03', 'Lola', '1990-08-08', 'Perempuan', 'Jakarta');

-- --------------------------------------------------------

--
-- Table structure for table `poli`
--

CREATE TABLE `poli` (
  `kodepoli` varchar(10) NOT NULL,
  `namapoli` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `poli`
--

INSERT INTO `poli` (`kodepoli`, `namapoli`) VALUES
('P01', 'Gigi'),
('P02', 'Umum'),
('P03', 'Kardiologi');

-- --------------------------------------------------------

--
-- Structure for view `listberobat`
--
DROP TABLE IF EXISTS `listberobat`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `listberobat`  AS  select `berobat`.`notransaksi` AS `notransaksi`,`berobat`.`tanggal_berobat` AS `tanggal_berobat`,`pasien`.`namapasien` AS `namapasien`,(year(curdate()) - year(`pasien`.`tanggal_lahir`)) AS `usia`,`pasien`.`jeniskelamin` AS `jeniskelamin`,`poli`.`namapoli` AS `namapoli`,`dokter`.`namadokter` AS `namadokter`,`berobat`.`biaya_administrasi` AS `biaya_administrasi` from (((`pasien` join `berobat` on((`pasien`.`pasienid` = `berobat`.`pasienid`))) join `dokter` on((`dokter`.`dokterid` = `berobat`.`dokterid`))) join `poli` on((`dokter`.`kodepoli` = `poli`.`kodepoli`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berobat`
--
ALTER TABLE `berobat`
  ADD PRIMARY KEY (`notransaksi`),
  ADD KEY `pasienid` (`pasienid`),
  ADD KEY `dokterid` (`dokterid`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`dokterid`),
  ADD KEY `kodepoli` (`kodepoli`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`pasienid`);

--
-- Indexes for table `poli`
--
ALTER TABLE `poli`
  ADD PRIMARY KEY (`kodepoli`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `berobat`
--
ALTER TABLE `berobat`
  ADD CONSTRAINT `berobat_ibfk_1` FOREIGN KEY (`dokterid`) REFERENCES `dokter` (`dokterid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `berobat_ibfk_2` FOREIGN KEY (`pasienid`) REFERENCES `pasien` (`pasienid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dokter`
--
ALTER TABLE `dokter`
  ADD CONSTRAINT `dokter_ibfk_1` FOREIGN KEY (`kodepoli`) REFERENCES `poli` (`kodepoli`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
