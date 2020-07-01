-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 18, 2020 at 12:28 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_topsis_ruko`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_alternatif`
--

CREATE TABLE `tb_alternatif` (
  `id` int(11) NOT NULL,
  `alternatif` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_alternatif`
--

INSERT INTO `tb_alternatif` (`id`, `alternatif`) VALUES
(1, 'ruko no 12 simpang empat'),
(2, 'ruko no 33 samping rumah sakit'),
(3, 'ruko jalan ramai no 208'),
(4, 'ruko no 294 samping suzuya'),
(13, 'no 987');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kriteria`
--

CREATE TABLE `tb_kriteria` (
  `id` int(11) NOT NULL,
  `kriteria` varchar(300) NOT NULL,
  `bobot` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kriteria`
--

INSERT INTO `tb_kriteria` (`id`, `kriteria`, `bobot`) VALUES
(1, 'harga sewa/tahun', 30),
(2, 'jarak dengan pasar', 16.6667),
(3, 'kondisi ruko', 20),
(4, 'luas bangunan ruko', 16.6667),
(5, 'luas tanah', 16.6667);

-- --------------------------------------------------------

--
-- Table structure for table `tb_nilai`
--

CREATE TABLE `tb_nilai` (
  `id` int(11) NOT NULL,
  `id_alternatif` int(20) NOT NULL,
  `id_kriteria` int(20) NOT NULL,
  `nilai_kriteria` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_nilai`
--

INSERT INTO `tb_nilai` (`id`, `id_alternatif`, `id_kriteria`, `nilai_kriteria`) VALUES
(1, 1, 1, '5000000'),
(2, 1, 2, '590'),
(3, 1, 3, '4'),
(4, 1, 4, '300'),
(5, 1, 5, '330'),
(6, 2, 1, '7500000'),
(7, 2, 2, '300'),
(8, 2, 3, '5'),
(9, 2, 4, '180'),
(10, 2, 5, '200'),
(11, 3, 1, '4500000'),
(12, 3, 2, '500'),
(13, 3, 3, '4'),
(14, 3, 4, '170'),
(15, 3, 5, '200'),
(16, 4, 1, '5500000'),
(17, 4, 2, '580'),
(18, 4, 3, '5'),
(19, 4, 4, '150'),
(20, 4, 5, '170'),
(31, 13, 1, '7000000'),
(32, 13, 2, '1000'),
(33, 13, 3, '5'),
(34, 13, 4, '180'),
(35, 13, 5, '210');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_alternatif`
--
ALTER TABLE `tb_alternatif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_nilai`
--
ALTER TABLE `tb_nilai`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_alternatif`
--
ALTER TABLE `tb_alternatif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_nilai`
--
ALTER TABLE `tb_nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
