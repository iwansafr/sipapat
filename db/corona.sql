SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


DROP TABLE IF EXISTS `corona`;
CREATE TABLE `corona` (
  `id` int(11) NOT NULL,
  `desa_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `umur` tinyint(2) NOT NULL,
  `jk` tinyint(1) NOT NULL,
  `rt` tinyint(2) NOT NULL,
  `rw` tinyint(2) NOT NULL,
  `dari` varchar(255) NOT NULL,
  `tgl` date NOT NULL,
  `hp` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1=odp,2=pdp,3=positive',
  `demam` tinyint(1) NOT NULL,
  `bpst` tinyint(1) NOT NULL COMMENT 'batuk pilek sakit tenggorokan',
  `sesak_nafas` tinyint(1) NOT NULL,
  `no_keluhan` tinyint(1) NOT NULL,
  `pkdpc` int(11) NOT NULL COMMENT 'pernah kontak dengan penderita covid',
  `tatalaksana` text NOT NULL,
  `keterangan` text NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `corona`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `corona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
