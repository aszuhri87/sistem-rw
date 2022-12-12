-- phpMyAdmin SQL Dump
-- version 4.9.10
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 12, 2022 at 01:21 PM
-- Server version: 10.6.11-MariaDB-0ubuntu0.22.04.1
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kependudukan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rt` varchar(255) DEFAULT NULL,
  `rw` varchar(255) DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `email`, `password`, `rt`, `rw`, `level`) VALUES
(1, 'ferdy', 'ferdy@gmail.com', '$2y$10$9GgAznuRMwTNHYTaFVPXP.MDN8971ibK3Ic397EBWCE3f0U3eiO3m', '25', NULL, 'penjimpit'),
(2, 'zuhri', 'zuhri@varx.id', '$2y$10$KNPiag84ZXgA8TNTU1PzJOhquN5/79TAzQ1PXOJnkpkuOfBD4dXgG', NULL, NULL, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `jimpitan`
--

CREATE TABLE `jimpitan` (
  `id` int(11) NOT NULL,
  `id_warga` int(11) NOT NULL,
  `nominal` bigint(20) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jimpitan`
--

INSERT INTO `jimpitan` (`id`, `id_warga`, `nominal`, `id_admin`, `tanggal`) VALUES
(1, 2, 500, 2, '2022-08-30 01:46:57'),
(2, 2, 1500, 1, '2022-08-30 01:57:45'),
(3, 3, 2500, 1, '2022-08-30 01:57:53'),
(4, 2, 5000, 2, '2022-12-05 08:44:42'),
(5, 2, 1000, 2, '2022-12-07 03:39:47'),
(6, 2, 500, 2, '2022-12-07 03:40:24'),
(7, 2, 500, 2, '2022-12-07 03:43:01'),
(8, 2, 500, 2, '2022-12-07 08:54:08'),
(9, 4, 500, 2, '2022-12-09 08:08:11');

-- --------------------------------------------------------

--
-- Table structure for table `kas_warga`
--

CREATE TABLE `kas_warga` (
  `id` int(11) NOT NULL,
  `nominal` int(11) DEFAULT NULL,
  `rt` int(11) DEFAULT NULL,
  `rw` int(11) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `tipe` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kas_warga`
--

INSERT INTO `kas_warga` (`id`, `nominal`, `rt`, `rw`, `tanggal`, `tipe`) VALUES
(1, 5001, 25, NULL, '2022-12-05', 'masuk'),
(2, 500, NULL, NULL, '2022-12-05', 'keluar'),
(3, 3222, NULL, NULL, '2022-12-06', 'keluar'),
(5, 100, NULL, NULL, '2022-12-06', 'masuk'),
(6, 30, NULL, NULL, '2022-12-06', 'masuk'),
(7, 500, NULL, NULL, '2022-12-06', 'keluar'),
(8, 100, NULL, NULL, '2022-12-27', 'keluar'),
(9, 100, NULL, NULL, '2022-12-27', 'keluar'),
(10, 3222, NULL, NULL, '2022-12-06', 'masuk'),
(12, 3222, NULL, NULL, '2022-12-13', 'masuk'),
(13, 243423, NULL, NULL, '2022-12-07', 'keluar'),
(14, 5000, NULL, NULL, '2022-12-07', 'masuk'),
(15, 5000, NULL, NULL, '2022-12-07', 'masuk');

-- --------------------------------------------------------

--
-- Table structure for table `warga`
--

CREATE TABLE `warga` (
  `id` int(11) NOT NULL,
  `no_kk` varchar(255) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `agama` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `rt` int(11) NOT NULL,
  `rw` int(11) NOT NULL,
  `pendidikan` varchar(255) NOT NULL,
  `pekerjaan` varchar(255) NOT NULL,
  `kewarganegaraan` varchar(255) NOT NULL,
  `status_perkawinan` varchar(255) NOT NULL,
  `status_dalam_keluarga` varchar(255) NOT NULL,
  `nama_ayah` varchar(255) NOT NULL,
  `nama_ibu` varchar(255) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `warga`
--

INSERT INTO `warga` (`id`, `no_kk`, `nik`, `nama_lengkap`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `alamat`, `rt`, `rw`, `pendidikan`, `pekerjaan`, `kewarganegaraan`, `status_perkawinan`, `status_dalam_keluarga`, `nama_ayah`, `nama_ibu`, `keterangan`) VALUES
(2, '1231231224', '12345', 'Ferdy YP', 'SLEMAN', '2001-11-24', 'L', 'islam', 'bugisan', 27, 5, 'SMA', 'MAHASISWA', 'indonesia', 'belum kawin', 'lengkap', 'riswan', 'yuli', 'lengkap'),
(3, '782354235512', '12345', 'Risky', 'jogja', '2007-06-12', 'L', 'katolik', 'bugisan', 28, 5, 'SMA', 'ojol', 'indonesia', 'belum kawin', 'lengkap', 'uknown', 'unkown', 'lengkap');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jimpitan`
--
ALTER TABLE `jimpitan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kas_warga`
--
ALTER TABLE `kas_warga`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warga`
--
ALTER TABLE `warga`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jimpitan`
--
ALTER TABLE `jimpitan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kas_warga`
--
ALTER TABLE `kas_warga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `warga`
--
ALTER TABLE `warga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
