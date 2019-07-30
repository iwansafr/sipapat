SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


DROP TABLE IF EXISTS `bumdes_pengurus`;
CREATE TABLE `bumdes_pengurus` (
  `id` int(11) NOT NULL,
  `bumdes_id` int(11) NOT NULL,
  `ketua` varchar(255) NOT NULL,
  `hp_ketua` varchar(20) NOT NULL,
  `sekretaris` varchar(255) NOT NULL,
  `hp_sekretaris` varchar(20) NOT NULL,
  `bendahara` varchar(255) NOT NULL,
  `hp_bendahara` varchar(20) NOT NULL,
  `penasehat` varchar(255) NOT NULL,
  `pengawas` text NOT NULL,
  `jenis_usaha` varchar(255) NOT NULL,
  `kategori_usaha` tinyint(2) NOT NULL,
  `tingkat_pemeringkatan` tinyint(2) NOT NULL,
  `tahun` int(4) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `bumdes_pengurus`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `bumdes_pengurus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
