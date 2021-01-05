-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2021 at 02:44 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pklabsensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `absen_keluar`
--

CREATE TABLE `absen_keluar` (
  `id_absen_keluar` char(30) NOT NULL,
  `id_karyawan_keluar` char(30) DEFAULT NULL,
  `id_set_waktu_keluar` char(30) DEFAULT NULL,
  `jam_keluar` time DEFAULT NULL,
  `tanggal_keluar` date DEFAULT NULL,
  `latitude_keluar` varchar(50) DEFAULT NULL,
  `longitude_keluar` varchar(50) DEFAULT NULL,
  `foto_keluar` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `absen_masuk`
--

CREATE TABLE `absen_masuk` (
  `id_absen_masuk` char(30) NOT NULL,
  `id_karyawan_masuk` char(30) DEFAULT NULL,
  `id_set_waktu_masuk` char(30) DEFAULT NULL,
  `jam_masuk` time DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `latitude_masuk` varchar(50) DEFAULT NULL,
  `longitude_masuk` varchar(50) DEFAULT NULL,
  `foto_masuk` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` char(10) NOT NULL,
  `nama_karyawan` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `nohp` varchar(15) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `set_lokasi`
--

CREATE TABLE `set_lokasi` (
  `id_set_lokasi` char(30) NOT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `lokasi` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `set_waktu_absen`
--

CREATE TABLE `set_waktu_absen` (
  `id_set_waktu` char(30) NOT NULL,
  `waktu_mulai_masuk` time DEFAULT NULL,
  `waktu_selesai_masuk` time DEFAULT NULL,
  `waktu_mulai_keluar` time DEFAULT NULL,
  `waktu_selesai_keluar` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `surat_izin`
--

CREATE TABLE `surat_izin` (
  `id_surat_izin` char(30) NOT NULL,
  `id_karyawan_izin` char(30) DEFAULT NULL,
  `tanggal_izin` date DEFAULT NULL,
  `keterangan_izin` varchar(100) DEFAULT NULL,
  `surat_izinnya` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `surat_sakit`
--

CREATE TABLE `surat_sakit` (
  `id_surat_sakit` char(30) NOT NULL,
  `id_karyawan_sakit` char(30) DEFAULT NULL,
  `tanggal_sakit` date DEFAULT NULL,
  `keterangan_sakit` varchar(100) DEFAULT NULL,
  `surat_sakitnya` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `kode_user` char(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `level_user` char(1) DEFAULT NULL,
  `status_user` char(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `kode_user`, `email`, `password`, `level_user`, `status_user`, `created_at`) VALUES
(1, '0', 'admin@admin.com', '202cb962ac59075b964b07152d234b70', '1', '0', '2020-03-17 05:49:32'),
(2, '2', 'guru1@email.com', '202cb962ac59075b964b07152d234b70', '2', '0', '2020-03-17 05:49:49'),
(3, '1', 'siswa1@email.com', '202cb962ac59075b964b07152d234b70', '3', '0', '2020-03-17 05:50:37'),
(4, '0', 'admin1@admin.com', '202cb962ac59075b964b07152d234b70', '1', '0', '2020-03-17 06:07:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absen_keluar`
--
ALTER TABLE `absen_keluar`
  ADD PRIMARY KEY (`id_absen_keluar`),
  ADD KEY `id_karyawan_keluar` (`id_karyawan_keluar`),
  ADD KEY `id_set_waktu_keluar` (`id_set_waktu_keluar`);

--
-- Indexes for table `absen_masuk`
--
ALTER TABLE `absen_masuk`
  ADD PRIMARY KEY (`id_absen_masuk`),
  ADD KEY `id_karyawan_masuk` (`id_karyawan_masuk`),
  ADD KEY `id_set_waktu_masuk` (`id_set_waktu_masuk`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `set_lokasi`
--
ALTER TABLE `set_lokasi`
  ADD PRIMARY KEY (`id_set_lokasi`);

--
-- Indexes for table `set_waktu_absen`
--
ALTER TABLE `set_waktu_absen`
  ADD PRIMARY KEY (`id_set_waktu`);

--
-- Indexes for table `surat_izin`
--
ALTER TABLE `surat_izin`
  ADD PRIMARY KEY (`id_surat_izin`),
  ADD KEY `id_karyawan_izin` (`id_karyawan_izin`);

--
-- Indexes for table `surat_sakit`
--
ALTER TABLE `surat_sakit`
  ADD PRIMARY KEY (`id_surat_sakit`),
  ADD KEY `id_karyawan_sakit` (`id_karyawan_sakit`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absen_keluar`
--
ALTER TABLE `absen_keluar`
  ADD CONSTRAINT `absen_keluar_ibfk_1` FOREIGN KEY (`id_karyawan_keluar`) REFERENCES `karyawan` (`id_karyawan`),
  ADD CONSTRAINT `absen_keluar_ibfk_2` FOREIGN KEY (`id_set_waktu_keluar`) REFERENCES `set_waktu_absen` (`id_set_waktu`);

--
-- Constraints for table `absen_masuk`
--
ALTER TABLE `absen_masuk`
  ADD CONSTRAINT `absen_masuk_ibfk_1` FOREIGN KEY (`id_karyawan_masuk`) REFERENCES `karyawan` (`id_karyawan`),
  ADD CONSTRAINT `absen_masuk_ibfk_2` FOREIGN KEY (`id_set_waktu_masuk`) REFERENCES `set_waktu_absen` (`id_set_waktu`);

--
-- Constraints for table `surat_izin`
--
ALTER TABLE `surat_izin`
  ADD CONSTRAINT `surat_izin_ibfk_1` FOREIGN KEY (`id_karyawan_izin`) REFERENCES `karyawan` (`id_karyawan`);

--
-- Constraints for table `surat_sakit`
--
ALTER TABLE `surat_sakit`
  ADD CONSTRAINT `surat_sakit_ibfk_1` FOREIGN KEY (`id_karyawan_sakit`) REFERENCES `karyawan` (`id_karyawan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
