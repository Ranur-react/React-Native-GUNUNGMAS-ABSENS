/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 5.6.17 : Database - elearning
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`elearning` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `elearning`;

/*Table structure for table `guru` */

DROP TABLE IF EXISTS `guru`;

CREATE TABLE `guru` (
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
  KEY `bidangstudiguru` (`bidangstudiguru`),
  CONSTRAINT `guru_ibfk_1` FOREIGN KEY (`bidangstudiguru`) REFERENCES `matapelajaran` (`idmapel`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `guru` */

insert  into `guru`(`idguru`,`nipguru`,`namaguru`,`tempatlahirguru`,`tanggallahirguru`,`jenkelguru`,`agamaguru`,`alamatguru`,`hpguru`,`bidangstudiguru`) values 
(2,'123','Guru1','Tempat','2020-03-17','L','Islam','Alamat','08',1);

/*Table structure for table `jurusan` */

DROP TABLE IF EXISTS `jurusan`;

CREATE TABLE `jurusan` (
  `id_jurusan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jurusan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_jurusan`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `jurusan` */

insert  into `jurusan`(`id_jurusan`,`nama_jurusan`) values 
(2,'IPA'),
(3,'IPS'),
(4,'IPB JEPANGG');

/*Table structure for table `kelas` */

DROP TABLE IF EXISTS `kelas`;

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kelas` char(10) DEFAULT NULL,
  `tingkatan_kelas` char(5) DEFAULT NULL,
  `jurusan_kelas` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_kelas`),
  KEY `jurusan_kelas` (`jurusan_kelas`),
  CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`jurusan_kelas`) REFERENCES `jurusan` (`id_jurusan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `kelas` */

insert  into `kelas`(`id_kelas`,`nama_kelas`,`tingkatan_kelas`,`jurusan_kelas`) values 
(1,'X IPA 1','X',2),
(3,'XIPS2','XI',3);

/*Table structure for table `matapelajaran` */

DROP TABLE IF EXISTS `matapelajaran`;

CREATE TABLE `matapelajaran` (
  `idmapel` int(11) NOT NULL AUTO_INCREMENT,
  `namamapel` varchar(100) DEFAULT NULL,
  `singkatanmapel` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idmapel`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `matapelajaran` */

insert  into `matapelajaran`(`idmapel`,`namamapel`,`singkatanmapel`) values 
(1,'Matematika','MTK');

/*Table structure for table `siswa` */

DROP TABLE IF EXISTS `siswa`;

CREATE TABLE `siswa` (
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
  KEY `jurusan_siswa` (`jurusan_siswa`),
  CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`jurusan_siswa`) REFERENCES `jurusan` (`id_jurusan`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `siswa` */

insert  into `siswa`(`id_siswa`,`nisn_siswa`,`nama_siswa`,`tempatlahir_siswa`,`tanggallahir_siswa`,`jenkel_siswa`,`agama_siswa`,`alamat_siswa`,`hp_siswa`,`jurusan_siswa`) values 
(1,'123456789','Siswa1','Tempat','2020-03-17','L','Islam','Alamat','08',2);

/*Table structure for table `tahun_ajaran` */

DROP TABLE IF EXISTS `tahun_ajaran`;

CREATE TABLE `tahun_ajaran` (
  `id_tahun` int(11) NOT NULL AUTO_INCREMENT,
  `nama_tahun` char(15) NOT NULL,
  `status_tahun` char(5) NOT NULL,
  PRIMARY KEY (`id_tahun`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tahun_ajaran` */

insert  into `tahun_ajaran`(`id_tahun`,`nama_tahun`,`status_tahun`) values 
(1,'2028/2019','1'),
(3,'2020/2021','0');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `kode_user` int(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `level_user` char(1) DEFAULT NULL,
  `status_user` char(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`id_user`,`kode_user`,`email`,`password`,`level_user`,`status_user`,`created_at`) values 
(1,0,'admin@admin.com','202cb962ac59075b964b07152d234b70','1','0','2020-03-17 12:49:32'),
(2,2,'guru1@email.com','202cb962ac59075b964b07152d234b70','2','0','2020-03-17 12:49:49'),
(3,1,'siswa1@email.com','202cb962ac59075b964b07152d234b70','3','0','2020-03-17 12:50:37'),
(4,0,'admin1@admin.com','202cb962ac59075b964b07152d234b70','1','0','2020-03-17 13:07:07');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
