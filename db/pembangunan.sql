SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


DROP TABLE IF EXISTS `pembangunan`;
CREATE TABLE `pembangunan` (
  `id` int(11) NOT NULL,
  `desa_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `jenis` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=non fisik, 1= fisik',
  `item` varchar(255) NOT NULL,
  `sumber_dana` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1=dd,2=add,3=pad,4=bankeu prov',
  `peserta` varchar(255) NOT NULL COMMENT 'jenis = 0 / non fisik',
  `bidang` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1=pengembangan desa, 2=pembangunan desa, 3=pembinaan masyarakat, 4=ekonomi dan TTG',
  `anggaran` int(11) NOT NULL COMMENT 'dana yang digunakan',
  `doc` varchar(255) NOT NULL COMMENT 'dokumentasi kegiatan',
  `doc_0` varchar(255) NOT NULL COMMENT 'dokumentasi pembangunan 0%',
  `doc_50` varchar(255) NOT NULL COMMENT 'dokumentasi pembangunan 50%',
  `doc_100` varchar(255) NOT NULL COMMENT 'dokumentasi pembangunan 100%',
  `tahap` tinyint(2) NOT NULL DEFAULT '0' COMMENT '1=tahap 1, 2 =tahap 2, 3 =tahap 3',
  `th_anggaran` year(4) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `pembangunan`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `pembangunan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
