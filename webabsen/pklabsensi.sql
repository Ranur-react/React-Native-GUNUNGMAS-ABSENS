/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.4.6-MariaDB : Database - pklabsensi
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`pklabsensi` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `pklabsensi`;

/*Table structure for table `absen_keluar` */

DROP TABLE IF EXISTS `absen_keluar`;

CREATE TABLE `absen_keluar` (
  `id_absen_keluar` char(30) NOT NULL,
  `id_karyawan_keluar` char(30) DEFAULT NULL,
  `id_set_waktu_keluar` char(30) DEFAULT NULL,
  `jam_keluar` time DEFAULT NULL,
  `tanggal_keluar` date DEFAULT NULL,
  `latitude_keluar` varchar(50) DEFAULT NULL,
  `longitude_keluar` varchar(50) DEFAULT NULL,
  `foto_keluar` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_absen_keluar`),
  KEY `id_karyawan_keluar` (`id_karyawan_keluar`),
  KEY `id_set_waktu_keluar` (`id_set_waktu_keluar`),
  CONSTRAINT `absen_keluar_ibfk_1` FOREIGN KEY (`id_karyawan_keluar`) REFERENCES `karyawan` (`id_karyawan`),
  CONSTRAINT `absen_keluar_ibfk_2` FOREIGN KEY (`id_set_waktu_keluar`) REFERENCES `set_waktu_absen` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `absen_keluar` */

/*Table structure for table `absen_masuk` */

DROP TABLE IF EXISTS `absen_masuk`;

CREATE TABLE `absen_masuk` (
  `id_absen_masuk` char(30) NOT NULL,
  `id_karyawan_masuk` char(30) DEFAULT NULL,
  `id_set_waktu_masuk` char(30) DEFAULT NULL,
  `jam_masuk` time DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `latitude_masuk` varchar(50) DEFAULT NULL,
  `longitude_masuk` varchar(50) DEFAULT NULL,
  `foto_masuk` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_absen_masuk`),
  KEY `id_karyawan_masuk` (`id_karyawan_masuk`),
  KEY `id_set_waktu_masuk` (`id_set_waktu_masuk`),
  CONSTRAINT `absen_masuk_ibfk_1` FOREIGN KEY (`id_karyawan_masuk`) REFERENCES `karyawan` (`id_karyawan`),
  CONSTRAINT `absen_masuk_ibfk_2` FOREIGN KEY (`id_set_waktu_masuk`) REFERENCES `set_waktu_absen` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `absen_masuk` */

/*Table structure for table `jadwal_absen_karyawan` */

DROP TABLE IF EXISTS `jadwal_absen_karyawan`;

CREATE TABLE `jadwal_absen_karyawan` (
  `id_jadwal` char(30) NOT NULL,
  `rentang_tanggal` date DEFAULT NULL,
  `id_shift_absensi` char(30) DEFAULT NULL,
  `id_lokasi_absensi` varchar(250) DEFAULT NULL,
  `id_karyawan_absensi` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_jadwal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `jadwal_absen_karyawan` */

/*Table structure for table `karyawan` */

DROP TABLE IF EXISTS `karyawan`;

CREATE TABLE `karyawan` (
  `id_karyawan` char(10) NOT NULL,
  `nama_karyawan` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `nohp` varchar(15) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_karyawan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `karyawan` */

insert  into `karyawan`(`id_karyawan`,`nama_karyawan`,`email`,`nohp`,`alamat`) values 
('K001','Rizky Triananda','rizkytriananda88@gmail.com','0822121212','Sungai Sariak'),
('K002','Samaik','nur@gmail.com','082263547662','Katapiang'),
('K003','Akiruddin','akir@gmail.com','0855667735612','Indaruang Belok Kiri');

/*Table structure for table `set_lokasi` */

DROP TABLE IF EXISTS `set_lokasi`;

CREATE TABLE `set_lokasi` (
  `id_set_lokasi` char(30) NOT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `lokasi` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_set_lokasi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `set_lokasi` */

insert  into `set_lokasi`(`id_set_lokasi`,`latitude`,`longitude`,`lokasi`) values 
('LK01','96htpgl49u--l','ei7frf.e;r049','Jl. Adinegoro, Kota Padang'),
('LK02','fhvd[.r4-5fle-=','d233f,.;0yu','Sungai Sariak, Kabupaten Padang Pariaman'),
('LK03','fhvd[.r4-5fle-=','d233f,.;0yu','Parupuk Tabing, Kota Padang');

/*Table structure for table `set_waktu_absens` */

DROP TABLE IF EXISTS `set_waktu_absens`;

CREATE TABLE `set_waktu_absens` (
  `id_waktu` char(30) NOT NULL,
  `ket_waktu` varchar(50) DEFAULT NULL,
  `waktu_mulai_masuk` time DEFAULT NULL,
  `waktu_selesai_masuk` time DEFAULT NULL,
  `toleransi` time DEFAULT NULL,
  `waktu_mulai_keluar` time DEFAULT NULL,
  `waktu_selesai_keluar` time DEFAULT NULL,
  PRIMARY KEY (`id_waktu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `set_waktu_absens` */

insert  into `set_waktu_absens`(`id_waktu`,`ket_waktu`,`waktu_mulai_masuk`,`waktu_selesai_masuk`,`toleransi`,`waktu_mulai_keluar`,`waktu_selesai_keluar`) values 
('W01','Lembur Pagi','13:00:00','13:30:00','14:00:00','17:00:00','17:30:00'),
('W02','Lembur Siang','21:00:00','21:30:00','22:00:00','02:00:00','02:30:00'),
('W03','Pagi','08:00:00','08:30:00','09:00:00','13:00:00','13:30:00'),
('W04','Siang','13:00:00','13:30:00','14:00:00','17:00:00','17:30:00');

/*Table structure for table `surat_izin` */

DROP TABLE IF EXISTS `surat_izin`;

CREATE TABLE `surat_izin` (
  `id_surat_izin` char(30) NOT NULL,
  `id_karyawan_izin` char(30) DEFAULT NULL,
  `tanggal_izin` date DEFAULT NULL,
  `keterangan_izin` varchar(100) DEFAULT NULL,
  `surat_izinnya` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_surat_izin`),
  KEY `id_karyawan_izin` (`id_karyawan_izin`),
  CONSTRAINT `surat_izin_ibfk_1` FOREIGN KEY (`id_karyawan_izin`) REFERENCES `karyawan` (`id_karyawan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `surat_izin` */

/*Table structure for table `surat_sakit` */

DROP TABLE IF EXISTS `surat_sakit`;

CREATE TABLE `surat_sakit` (
  `id_surat_sakit` char(30) NOT NULL,
  `id_karyawan_sakit` char(30) DEFAULT NULL,
  `tanggal_sakit` date DEFAULT NULL,
  `keterangan_sakit` varchar(100) DEFAULT NULL,
  `surat_sakitnya` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_surat_sakit`),
  KEY `id_karyawan_sakit` (`id_karyawan_sakit`),
  CONSTRAINT `surat_sakit_ibfk_1` FOREIGN KEY (`id_karyawan_sakit`) REFERENCES `karyawan` (`id_karyawan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `surat_sakit` */

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `kode_user` char(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `level_user` char(1) DEFAULT NULL,
  `status_user` char(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`id_user`,`kode_user`,`email`,`password`,`level_user`,`status_user`,`created_at`) values 
(1,'0','admin@admin.com','202cb962ac59075b964b07152d234b70','1','0','2020-03-17 12:49:32'),
(2,'2','guru1@email.com','202cb962ac59075b964b07152d234b70','2','0','2020-03-17 12:49:49'),
(3,'1','siswa1@email.com','202cb962ac59075b964b07152d234b70','3','0','2020-03-17 12:50:37'),
(4,'0','admin1@admin.com','202cb962ac59075b964b07152d234b70','1','0','2020-03-17 13:07:07');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
