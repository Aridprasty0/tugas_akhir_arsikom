-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2019 at 02:37 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_reza`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `idadmin` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idadmin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`idadmin`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `gempa`
--

CREATE TABLE IF NOT EXISTS `gempa` (
  `idgempa` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date DEFAULT NULL,
  `jam` time DEFAULT NULL,
  `detail` text,
  `lat` double(10,2) DEFAULT NULL,
  `longi` double(10,2) DEFAULT NULL,
  `kedalaman` int(11) DEFAULT NULL,
  `kekuatan` double(10,2) DEFAULT NULL,
  `idkabupaten` int(11) DEFAULT NULL,
  PRIMARY KEY (`idgempa`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `gempa`
--

INSERT INTO `gempa` (`idgempa`, `tanggal`, `jam`, `detail`, `lat`, `longi`, `kedalaman`, `kekuatan`, `idkabupaten`) VALUES
(1, '2018-01-02', '23:01:00', '-', -8.73, 117.43, 2, 10.00, 1),
(2, '2018-01-02', '13:23:44', '-', -8.60, 118.44, 121, 1.90, 1),
(3, '2018-01-02', '23:01:00', NULL, -8.13, 117.88, 10, 2.20, 1),
(4, '2018-01-02', '03:43:01', NULL, -8.24, 115.47, 29, 2.30, 1),
(5, '2018-01-02', '15:33:09', NULL, -8.63, 118.42, 128, 2.50, 1),
(6, '2018-02-02', '13:44:37', NULL, -8.21, 115.56, 17, 2.70, 1),
(7, '2018-03-02', '01:40:52', NULL, -9.15, 115.53, 15, 2.80, 1),
(8, '2018-03-02', '12:11:45', NULL, -8.24, 115.59, 12, 3.00, 1),
(9, '2018-03-02', '22:47:04', NULL, -11.34, 118.51, 70, 3.10, 1),
(10, '2018-03-02', '02:21:30', NULL, -8.26, 120.01, 150, 3.80, 1),
(11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Stand-in structure for view `infokedalaman`
--
CREATE TABLE IF NOT EXISTS `infokedalaman` (
`info` varchar(8)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `infokekuatan`
--
CREATE TABLE IF NOT EXISTS `infokekuatan` (
`info` varchar(21)
);
-- --------------------------------------------------------

--
-- Table structure for table `kabupaten`
--

CREATE TABLE IF NOT EXISTS `kabupaten` (
  `idkabupaten` int(11) NOT NULL AUTO_INCREMENT,
  `namakabupaten` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idkabupaten`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `kabupaten`
--

INSERT INTO `kabupaten` (`idkabupaten`, `namakabupaten`) VALUES
(1, 'Lainnya'),
(2, 'Kabupaten Bima'),
(3, 'Kabupaten Dompu'),
(4, 'Kabupaten Lombok Barat'),
(5, 'Kabupaten Lombok Tengah'),
(6, 'Kabupaten Lombok Timur'),
(7, 'Kabupaten Lombok Utara'),
(8, 'Kabupaten Sumbawa'),
(9, 'Kabupaten Sumbawa Barat'),
(10, 'Kota Bima'),
(11, 'Kota Mataram');

-- --------------------------------------------------------

--
-- Table structure for table `kontak`
--

CREATE TABLE IF NOT EXISTS `kontak` (
  `idkontak` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `pesan` text,
  `tanggal` date DEFAULT NULL,
  PRIMARY KEY (`idkontak`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `kontak`
--

INSERT INTO `kontak` (`idkontak`, `nama`, `email`, `pesan`, `tanggal`) VALUES
(1, 'tukiman', 'tumanjo@email.com', 'oke bro', '2019-08-07');

-- --------------------------------------------------------

--
-- Structure for view `infokedalaman`
--
DROP TABLE IF EXISTS `infokedalaman`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `infokedalaman` AS select (case when (`gempa`.`kedalaman` >= 300) then 'Dalam' when ((`gempa`.`kedalaman` >= 60) and (`gempa`.`kedalaman` < 300)) then 'Menengah' else 'Dangkal' end) AS `info` from `gempa`;

-- --------------------------------------------------------

--
-- Structure for view `infokekuatan`
--
DROP TABLE IF EXISTS `infokekuatan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `infokekuatan` AS select (case when (`gempa`.`kekuatan` < 3) then 'Tidak Terasa' when ((`gempa`.`kekuatan` >= 3) and (`gempa`.`kekuatan` < 5)) then 'Kerusakan Kecil' when ((`gempa`.`kekuatan` >= 5) and (`gempa`.`kekuatan` < 7)) then 'Kerusakan Cukup Besar' else 'Kerusakan Serius' end) AS `info` from `gempa`;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
