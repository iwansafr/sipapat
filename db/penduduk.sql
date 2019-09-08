SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


DROP TABLE IF EXISTS `penduduk`;
CREATE TABLE `penduduk` (
  `id` int(11) UNSIGNED NOT NULL,
  `desa_id` int(11) NOT NULL,
  `no_kk` bigint(20) DEFAULT NULL,
  `nik` bigint(20) NOT NULL,
  `no_paspor` varchar(100) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `jk` char(1) DEFAULT NULL,
  `tmpt_lhr` varchar(255) DEFAULT NULL,
  `tgl_lhr` date DEFAULT NULL,
  `gdr` char(1) DEFAULT NULL,
  `agama` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `no_akta_kwn` varchar(20) DEFAULT NULL,
  `no_akta_crai` varchar(20) DEFAULT NULL,
  `shdk` tinyint(2) DEFAULT NULL,
  `shdrt` tinyint(2) DEFAULT NULL,
  `pnydng_cct` tinyint(1) DEFAULT NULL,
  `pddk_akhir` varchar(255) DEFAULT NULL,
  `pekerjaan` varchar(255) DEFAULT NULL,
  `nama_ibu` varchar(255) DEFAULT NULL,
  `nama_ayah` varchar(255) DEFAULT NULL,
  `nama_kep_kel` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_rt` tinyint(3) DEFAULT NULL,
  `no_rw` tinyint(3) DEFAULT NULL,
  `mati` tinyint(1) DEFAULT '0',
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `penduduk`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nik` (`nik`);


ALTER TABLE `penduduk`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
