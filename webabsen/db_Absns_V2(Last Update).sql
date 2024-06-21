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
('ABK-K001-1388226949','K001','J001','21:03:48','2021-02-17','-0.9108934','100.3612336','http://localhost/React-Native-GUNUNGMAS-ABSENS/webabsen/AsetKaryawan_Foto/FotoAbsenPulang/RIzky Triananda/1388226949-Pulang_2021-02-17.jpeg'),
('ABK-K002-831547098','K002','J003','10:08:15','2021-02-22','-0.9427235','100.3534736','http://localhost/React-Native-GUNUNGMAS-ABSENS/webabsen/AsetKaryawan_Foto/FotoAbsenPulang/Rahmat/831547098-Pulang_2021-02-22.jpeg');

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
('ABK-K001-329224064','K001','J001','20:53:01','2021-02-17','-0.9108956','100.3612278','http://localhost/React-Native-GUNUNGMAS-ABSENS/webabsen/AsetKaryawan_Foto/FotoAbsenMasuk/RIzky Triananda/329224064-Masuk_2021-02-17.jpeg','HADIR'),
('ABK-K001-555576493','K001','J004','16:35:18','2021-03-01','-0.8702696','100.3443511','http://localhost/React-Native-GUNUNGMAS-ABSENS/webabsen/AsetKaryawan_Foto/FotoAbsenMasuk/RIzky Triananda/555576493-Masuk_2021-03-01.jpeg','HADIR'),
('ABK-K002-1698857394','K002','J003','10:06:37','2021-02-22','-0.9427235','100.3534736','http://localhost/React-Native-GUNUNGMAS-ABSENS/webabsen/AsetKaryawan_Foto/FotoAbsenMasuk/Rahmat/1698857394-Masuk_2021-02-22.jpeg','HADIR');

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
('J001','K001','2021-02-17','1','1'),
('J001','K001','2021-02-18',NULL,NULL),
('J001','K001','2021-02-19',NULL,NULL),
('J002','K003','2021-02-17','s',NULL),
('J002','K003','2021-02-18',NULL,NULL),
('J002','K003','2021-02-19',NULL,NULL),
('J003','K002','2021-02-22','1','1'),
('J003','K002','2021-02-23',NULL,NULL),
('J003','K002','2021-02-24',NULL,NULL),
('J004','K001','2021-03-01','m','1'),
('J004','K001','2021-03-02',NULL,NULL),
('J004','K001','2021-03-03',NULL,NULL);

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
('J001','02/17/2021 - 02/19/2021','W002','LK01'),
('J002','02/17/2021 - 02/19/2021','W001','LK02'),
('J003','02/22/2021 - 02/24/2021','W001','LK03'),
('J004','03/01/2021 - 03/03/2021','W002','LK02');

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
('K001','RIzky Triananda','rizky@gmail.com','0875658745','Pariaman'),
('K002','Rahmat','rahmat@gmail.com','887846668','Pariaman'),
('K003','Ade','ade@gmail.com','7466576744','Padang'),
('K004','rahmat nur','nur@gmail.com','765433655','padang');

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
('LK01','-0.9108680296075077','100.36123065084784',50,'PT. Indonusa Softmedia Teknologi, Gang Mela, Gunung Pangilun, Kota Padang, Sumatera Barat'),
('LK02','-0.8687172597305709','100.34382708897714',50,'Gunung MAS Cellular, Jalan Adinegoro, Parupuk Tabing, Padang City, Sumatera Barat'),
('LK03','-0.9436339554900689','100.35364642428748',30,'Jalan Olo Ladang No.5, Olo, Kota Padang, Sumatera Barat');

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
('W001','Pagi','08:00:00','09:00:00','09:30:00','10:00:00','14:00:00'),
('W002','Siang','13:00:00','17:15:00','18:15:00','20:00:00','22:00:00');

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

insert  into `surat_sakit`(`id_surat_sakit`,`id_karyawan_sakit`,`tanggal_sakit`,`keterangan_sakit`,`surat_sakitnya`) values 
('DOC-K003-1397475524','K003','2021-02-17','Sakit','http://localhost/React-Native-GUNUNGMAS-ABSENS/webabsen/AsetKaryawan_DOKUMEN/SuratAbsenSakit/Ade/1397475524-Sakit_2021-02-17.pdf');

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
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`id_user`,`kode_user`,`email`,`password`,`level_user`,`status_user`,`created_at`) values 
(1,'User1','admin@admin.com','202cb962ac59075b964b07152d234b70','1','1','2021-02-09 15:16:49'),
(13,'User2','pemilik@gmail.com','202cb962ac59075b964b07152d234b70','2','1','2021-02-09 15:16:59'),
(16,'User3','kepala@gmail.com','202cb962ac59075b964b07152d234b70','3','1','2021-02-09 15:17:10'),
(46,'K001','rizky@gmail.com','202cb962ac59075b964b07152d234b70','4','1','2021-02-17 20:32:38'),
(47,'K002','rahmat@gmail.com','202cb962ac59075b964b07152d234b70','4','1','2021-02-17 20:32:59'),
(48,'K003','ade@gmail.com','202cb962ac59075b964b07152d234b70','4','1','2021-02-17 20:33:17'),
(49,'K004','nur@gmail.com','202cb962ac59075b964b07152d234b70','4','1','2021-03-01 16:51:35');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
