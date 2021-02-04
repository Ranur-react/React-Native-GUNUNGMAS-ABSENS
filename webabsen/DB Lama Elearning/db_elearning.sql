-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2020 at 07:23 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `elearning`
--

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE IF NOT EXISTS `guru` (
  `idguru` int(11) NOT NULL AUTO_INCREMENT,
  `nipguru` char(20) DEFAULT NULL,
  `namaguru` varchar(100) DEFAULT NULL,
  `tempatlahirguru` varchar(100) DEFAULT NULL,
  `tanggallahirguru` date DEFAULT NULL,
  `jenkelguru` char(10) DEFAULT NULL,
  `agamaguru` char(10) DEFAULT NULL,
  `alamatguru` varchar(100) DEFAULT NULL,
  `hpguru` char(15) DEFAULT NULL,
  `bidangstudiguru` int(11) DEFAULT NULL,
  PRIMARY KEY (`idguru`),
  KEY `bidangstudiguru` (`bidangstudiguru`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`idguru`, `nipguru`, `namaguru`, `tempatlahirguru`, `tanggallahirguru`, `jenkelguru`, `agamaguru`, `alamatguru`, `hpguru`, `bidangstudiguru`) VALUES
(2, '123', 'Guru1', 'Tempat', '2020-03-17', 'L', 'Islam', 'Alamat', '08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE IF NOT EXISTS `jurusan` (
  `id_jurusan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jurusan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_jurusan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `nama_jurusan`) VALUES
(2, 'IPA'),
(3, 'IPS'),
(4, 'IPB JEPANGG');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE IF NOT EXISTS `kelas` (
  `id_kelas` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kelas` char(10) DEFAULT NULL,
  `tingkatan_kelas` char(5) DEFAULT NULL,
  `jurusan_kelas` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_kelas`),
  KEY `jurusan_kelas` (`jurusan_kelas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `tingkatan_kelas`, `jurusan_kelas`) VALUES
(1, 'X IPA 1', 'X', 2),
(3, 'XIPS2', 'XI', 3);

-- --------------------------------------------------------

--
-- Table structure for table `matapelajaran`
--

CREATE TABLE IF NOT EXISTS `matapelajaran` (
  `idmapel` int(11) NOT NULL AUTO_INCREMENT,
  `namamapel` varchar(100) DEFAULT NULL,
  `singkatanmapel` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idmapel`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `matapelajaran`
--

INSERT INTO `matapelajaran` (`idmapel`, `namamapel`, `singkatanmapel`) VALUES
(1, 'Matematika', 'MTK');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE IF NOT EXISTS `siswa` (
  `id_siswa` int(11) NOT NULL AUTO_INCREMENT,
  `nisn_siswa` char(20) DEFAULT NULL,
  `nama_siswa` varchar(100) DEFAULT NULL,
  `tempatlahir_siswa` varchar(100) DEFAULT NULL,
  `tanggallahir_siswa` date DEFAULT NULL,
  `jenkel_siswa` char(1) DEFAULT NULL,
  `agama_siswa` char(10) DEFAULT NULL,
  `alamat_siswa` varchar(100) DEFAULT NULL,
  `hp_siswa` char(15) DEFAULT NULL,
  `jurusan_siswa` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_siswa`),
  KEY `jurusan_siswa` (`jurusan_siswa`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nisn_siswa`, `nama_siswa`, `tempatlahir_siswa`, `tanggallahir_siswa`, `jenkel_siswa`, `agama_siswa`, `alamat_siswa`, `hp_siswa`, `jurusan_siswa`) VALUES
(1, '123456789', 'Siswa1', 'Tempat', '2020-03-17', 'L', 'Islam', 'Alamat', '08', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tahun_ajaran`
--

CREATE TABLE IF NOT EXISTS `tahun_ajaran` (
  `id_tahun` int(11) NOT NULL AUTO_INCREMENT,
  `nama_tahun` char(15) NOT NULL,
  `status_tahun` char(5) NOT NULL,
  PRIMARY KEY (`id_tahun`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tahun_ajaran`
--

INSERT INTO `tahun_ajaran` (`id_tahun`, `nama_tahun`, `status_tahun`) VALUES
(1, '2028/2019', '1'),
(3, '2020/2021', '0');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `kode_user` int(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `level_user` char(1) DEFAULT NULL,
  `status_user` char(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `kode_user`, `email`, `password`, `level_user`, `status_user`, `created_at`) VALUES
(1, 0, 'admin@admin.com', '202cb962ac59075b964b07152d234b70', '1', '0', '2020-03-17 05:49:32'),
(2, 2, 'guru1@email.com', '202cb962ac59075b964b07152d234b70', '2', '0', '2020-03-17 05:49:49'),
(3, 1, 'siswa1@email.com', '202cb962ac59075b964b07152d234b70', '3', '0', '2020-03-17 05:50:37'),
(4, 0, 'admin1@admin.com', '202cb962ac59075b964b07152d234b70', '1', '0', '2020-03-17 06:07:07');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `guru`
--
ALTER TABLE `guru`
  ADD CONSTRAINT `guru_ibfk_1` FOREIGN KEY (`bidangstudiguru`) REFERENCES `matapelajaran` (`idmapel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`jurusan_kelas`) REFERENCES `jurusan` (`id_jurusan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`jurusan_siswa`) REFERENCES `jurusan` (`id_jurusan`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
