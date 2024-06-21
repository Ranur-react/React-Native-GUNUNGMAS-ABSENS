/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.4.6-MariaDB : Database - db_pklabsensi
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_pklabsensi` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_pklabsensi`;

/*Table structure for table `absen_keluar` */

DROP TABLE IF EXISTS `absen_keluar`;

CREATE TABLE `absen_keluar` (
  `id_absen_keluar` char(30) NOT NULL,
  `id_karyawan_keluar` char(30) DEFAULT NULL,
  `id_set_jadwal_keluar` char(30) DEFAULT NULL,
  `jam_keluar` time DEFAULT NULL,
  `tanggal_keluar` date DEFAULT NULL,
  `latitude_keluar` varchar(50) DEFAULT NULL,
  `longitude_keluar` varchar(50) DEFAULT NULL,
  `foto_keluar` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_absen_keluar`),
  KEY `id_karyawan_keluar` (`id_karyawan_keluar`),
  KEY `id_set_waktu_keluar` (`id_set_jadwal_keluar`),
  CONSTRAINT `absen_keluar_ibfk_2` FOREIGN KEY (`id_set_jadwal_keluar`) REFERENCES `jadwal_absen_karyawan` (`id_jadwal`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `absen_keluar_ibfk_3` FOREIGN KEY (`id_karyawan_keluar`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `absen_keluar` */

insert  into `absen_keluar`(`id_absen_keluar`,`id_karyawan_keluar`,`id_set_jadwal_keluar`,`jam_keluar`,`tanggal_keluar`,`latitude_keluar`,`longitude_keluar`,`foto_keluar`) values 
('ABK-K001-1640271414','K001','J001','09:50:19','2021-02-11','-0.9430161','100.3538245','http://localhost/React-Native-GUNUNGMAS-ABSENS/webabsen/AsetKaryawan_Foto/FotoAbsenPulang/Rizky Triananda/1640271414-Pulang_2021-02-11.jpeg'),
('ABK-K002-1630428630','K002','J002','09:48:37','2021-02-11','-0.9430161','100.3538245','http://localhost/React-Native-GUNUNGMAS-ABSENS/webabsen/AsetKaryawan_Foto/FotoAbsenPulang/Samaik/1630428630-Pulang_2021-02-11.jpeg'),
('ABK-K006-1494292567','K006','J003','09:52:25','2021-02-11','-0.9430161','100.3538245','http://localhost/React-Native-GUNUNGMAS-ABSENS/webabsen/AsetKaryawan_Foto/FotoAbsenPulang/dia/1494292567-Pulang_2021-02-11.jpeg');

/*Table structure for table `absen_masuk` */

DROP TABLE IF EXISTS `absen_masuk`;

CREATE TABLE `absen_masuk` (
  `id_absen_masuk` char(30) NOT NULL,
  `id_karyawan_masuk` char(30) DEFAULT NULL,
  `id_set_jadwal_Masuk` char(30) DEFAULT NULL,
  `jam_masuk` time DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `latitude_masuk` varchar(50) DEFAULT NULL,
  `longitude_masuk` varchar(50) DEFAULT NULL,
  `foto_masuk` varchar(250) DEFAULT NULL,
  `ket` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_absen_masuk`),
  KEY `id_karyawan_masuk` (`id_karyawan_masuk`),
  KEY `id_set_waktu_masuk` (`id_set_jadwal_Masuk`),
  CONSTRAINT `absen_masuk_ibfk_2` FOREIGN KEY (`id_set_jadwal_Masuk`) REFERENCES `jadwal_absen_karyawan` (`id_jadwal`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `absen_masuk_ibfk_3` FOREIGN KEY (`id_karyawan_masuk`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `absen_masuk` */

insert  into `absen_masuk`(`id_absen_masuk`,`id_karyawan_masuk`,`id_set_jadwal_Masuk`,`jam_masuk`,`tanggal_masuk`,`latitude_masuk`,`longitude_masuk`,`foto_masuk`,`ket`) values 
('ABK-K001-1035466085','K001','J001','09:43:54','2021-02-11','-0.9430161','100.3538245','http://localhost/React-Native-GUNUNGMAS-ABSENS/webabsen/AsetKaryawan_Foto/FotoAbsenMasuk/Rizky Triananda/1035466085-Masuk_2021-02-11.jpeg','HADIR'),
('ABK-K002-1575840133','K002','J002','09:45:37','2021-02-11','-0.9430161','100.3538245','http://localhost/React-Native-GUNUNGMAS-ABSENS/webabsen/AsetKaryawan_Foto/FotoAbsenMasuk/Samaik/1575840133-Masuk_2021-02-11.jpeg','HADIR'),
('ABK-K006-922740292','K006','J003','09:41:54','2021-02-11','-0.9430161','100.3538245','http://localhost/React-Native-GUNUNGMAS-ABSENS/webabsen/AsetKaryawan_Foto/FotoAbsenMasuk/dia/922740292-Masuk_2021-02-11.jpeg','HADIR');

/*Table structure for table `detail_jadwal` */

DROP TABLE IF EXISTS `detail_jadwal`;

CREATE TABLE `detail_jadwal` (
  `id_jadwal_detail` char(30) DEFAULT NULL,
  `id_karyawan_detail` char(30) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `status_kehadiran` enum('1','0','i','s','m') DEFAULT NULL,
  `status_displin` enum('0','1') DEFAULT NULL,
  KEY `id_jadwal_detail` (`id_jadwal_detail`),
  KEY `detail_jadwal_ibfk_2` (`id_karyawan_detail`),
  CONSTRAINT `detail_jadwal_ibfk_1` FOREIGN KEY (`id_karyawan_detail`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detail_jadwal_ibfk_2` FOREIGN KEY (`id_jadwal_detail`) REFERENCES `jadwal_absen_karyawan` (`id_jadwal`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `detail_jadwal` */

insert  into `detail_jadwal`(`id_jadwal_detail`,`id_karyawan_detail`,`tanggal`,`status_kehadiran`,`status_displin`) values 
('J001','K001','2021-02-11','1','1'),
('J001','K001','2021-02-12',NULL,NULL),
('J001','K001','2021-02-13',NULL,NULL),
('J002','K002','2021-02-11','1','1'),
('J002','K002','2021-02-12',NULL,NULL),
('J002','K002','2021-02-13',NULL,NULL),
('J003','K006','2021-02-11','1','1'),
('J003','K006','2021-02-12',NULL,NULL),
('J003','K006','2021-02-13',NULL,NULL);

/*Table structure for table `jadwal_absen_karyawan` */

DROP TABLE IF EXISTS `jadwal_absen_karyawan`;

CREATE TABLE `jadwal_absen_karyawan` (
  `id_jadwal` char(30) NOT NULL,
  `rentangSet` varchar(250) DEFAULT NULL,
  `id_shift_absensi` char(30) DEFAULT NULL,
  `id_lokasi_absensi` char(30) DEFAULT NULL,
  PRIMARY KEY (`id_jadwal`),
  KEY `id_lokasi_absensi` (`id_lokasi_absensi`),
  KEY `id_shift_absensi` (`id_shift_absensi`),
  CONSTRAINT `jadwal_absen_karyawan_ibfk_2` FOREIGN KEY (`id_shift_absensi`) REFERENCES `set_waktu_absens` (`id_waktu`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `jadwal_absen_karyawan_ibfk_3` FOREIGN KEY (`id_lokasi_absensi`) REFERENCES `set_lokasi` (`id_set_lokasi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `jadwal_absen_karyawan` */

insert  into `jadwal_absen_karyawan`(`id_jadwal`,`rentangSet`,`id_shift_absensi`,`id_lokasi_absensi`) values 
('J001','02/11/2021 - 02/13/2021','W01','LK04'),
('J002','02/11/2021 - 02/13/2021','W01','LK04'),
('J003','02/11/2021 - 02/13/2021','W01','LK04');

/*Table structure for table `karyawan` */

DROP TABLE IF EXISTS `karyawan`;

CREATE TABLE `karyawan` (
  `id_karyawan` char(30) NOT NULL,
  `nama_karyawan` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `nohp` varchar(15) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_karyawan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `karyawan` */

insert  into `karyawan`(`id_karyawan`,`nama_karyawan`,`email`,`nohp`,`alamat`) values 
('K001','Rizky Triananda','rizky@gmail.com','3433545','Pariaman'),
('K002','Samaik','nur@gmail.com','23456789','Katapiang'),
('K003','Rahmat','rahmat@gmail.com','0987654321','Pariaman'),
('K004','Ade','ade@gmail.com','1235654321','Bunguih'),
('K005','Boaz Salossa','boci89@gmail.com','12887654578','Papua'),
('K006','dia','dia@gmail.com','765567','oi');

/*Table structure for table `set_lokasi` */

DROP TABLE IF EXISTS `set_lokasi`;

CREATE TABLE `set_lokasi` (
  `id_set_lokasi` char(30) NOT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `range` int(11) DEFAULT NULL,
  `lokasi` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_set_lokasi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `set_lokasi` */

insert  into `set_lokasi`(`id_set_lokasi`,`latitude`,`longitude`,`range`,`lokasi`) values 
('LK01','-0.9107057046818334','100.36124872547934',50,'PT. Indonusa Softmedia Teknologi, Gang Mela, Gunung Pangilun, Kota Padang, Sumatera Barat'),
('LK02','-0.9432801064345502','100.35400293897146',50,'STMIK Jayanusa, Jalan Olo Ladang, Olo, Kota Padang, Sumatera Barat'),
('LK03','-0.8685251749023064','100.34384905431514',15,'Gunung MAS Cellular, Jalan Adinegoro, Parupuk Tabing, Kota Padang, Sumatera Barat'),
('LK04','-0.943137633808512','100.35361673897148',30,'Jalan Olo Ladang No.5, Olo, Kota Padang, Sumatera Barat');

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
('W01','Pagi','10:00:00','11:30:00','11:30:00','12:00:00','13:00:00'),
('W02','Siang','12:00:00','13:00:00','13:30:00','21:00:00','23:00:00');

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
  CONSTRAINT `surat_izin_ibfk_1` FOREIGN KEY (`id_karyawan_izin`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE
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
  CONSTRAINT `surat_sakit_ibfk_1` FOREIGN KEY (`id_karyawan_sakit`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `surat_sakit` */

/*Table structure for table `tmp_karyawan` */

DROP TABLE IF EXISTS `tmp_karyawan`;

CREATE TABLE `tmp_karyawan` (
  `id_karyawan_tmp` char(50) NOT NULL,
  `nama_karyawan_tmp` varchar(100) DEFAULT NULL,
  `email_tmp` varchar(100) DEFAULT NULL,
  `nohp_tmp` varchar(13) DEFAULT NULL,
  `alamat_tmp` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_karyawan_tmp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tmp_karyawan` */

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
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`id_user`,`kode_user`,`email`,`password`,`level_user`,`status_user`,`created_at`) values 
(1,'User1','admin@admin.com','202cb962ac59075b964b07152d234b70','1','1','2021-02-09 15:16:49'),
(13,'User2','pemilik@gmail.com','202cb962ac59075b964b07152d234b70','2','1','2021-02-09 15:16:59'),
(16,'User3','kepala@gmail.com','202cb962ac59075b964b07152d234b70','3','1','2021-02-09 15:17:10'),
(34,'K001','rizky@gmail.com','202cb962ac59075b964b07152d234b70','4','1','2021-02-11 00:38:22'),
(35,'K002','nur@gmail.com','202cb962ac59075b964b07152d234b70','4','1','2021-02-11 00:38:35'),
(36,'K003','rahmat@gmail.com','202cb962ac59075b964b07152d234b70','4','1','2021-02-11 00:38:50'),
(37,'K004','ade@gmail.com','202cb962ac59075b964b07152d234b70','4','1','2021-02-11 00:39:11'),
(38,'K005','boci89@gmail.com','202cb962ac59075b964b07152d234b70','4','1','2021-02-11 00:54:07'),
(44,'K006','dia@gmail.com','202cb962ac59075b964b07152d234b70','4','1','2021-02-11 09:37:37');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
