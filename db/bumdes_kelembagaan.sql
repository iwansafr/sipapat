SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


DROP TABLE IF EXISTS `bumdes_kelembagaan`;
CREATE TABLE `bumdes_kelembagaan` (
  `id` int(11) NOT NULL,
  `bumdes_id` int(11) NOT NULL,
  `no` int(11) NOT NULL,
  `investor_lk` int(11) NOT NULL,
  `investor_pr` int(11) NOT NULL,
  `jml_investor` int(11) NOT NULL,
  `manajer_lk` int(11) NOT NULL,
  `manajer_pr` int(11) NOT NULL,
  `jml_manajer` int(11) NOT NULL,
  `karyawan_lk` int(11) NOT NULL,
  `karyawan_pr` int(11) NOT NULL,
  `jml_karyawan` int(11) NOT NULL,
  `lpj_terakhir` date NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `bumdes_kelembagaan`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `bumdes_kelembagaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
