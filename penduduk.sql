# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.7.26)
# Database: sipapat
# Generation Time: 2019-06-13 23:23:14 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table penduduk
# ------------------------------------------------------------

DROP TABLE IF EXISTS `penduduk`;

CREATE TABLE `penduduk` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `no_kk` int(11) DEFAULT NULL,
  `nik` int(11) DEFAULT NULL,
  `no_passpor` int(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `jk` tinyint(1) DEFAULT NULL,
  `tmpt_lhr` varchar(255) DEFAULT NULL,
  `tgl_lhr` date DEFAULT NULL,
  `gdr` char(1) DEFAULT NULL,
  `agama` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `no_akta_kwn` varchar(20) DEFAULT NULL,
  `no_akta_crai` varchar(20) DEFAULT NULL,
  `shdk` tinyint(2) DEFAULT NULL,
  `shdrt` tinyint(2) DEFAULT NULL,
  `pnydg_cct` tinyint(1) DEFAULT NULL,
  `pddk_akhir` tinyint(2) DEFAULT NULL,
  `pekerjaan` tinyint(2) DEFAULT NULL,
  `nama_ibu` varchar(255) DEFAULT NULL,
  `nama_ayah` varchar(255) DEFAULT NULL,
  `nama_kep_kel` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_rt` tinyint(3) DEFAULT NULL,
  `no_rw` tinyint(3) DEFAULT NULL,
  `mati` tinyint(1) DEFAULT '0',
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
