SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


DROP TABLE IF EXISTS `bumdes`;
CREATE TABLE `bumdes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `desa_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tgl_berdiri` date NOT NULL,
  `no_perdes` varchar(50) NOT NULL,
  `no_perkades` varchar(50) NOT NULL,
  `no_bdn_hkm` varchar(50) NOT NULL,
  `notaris_bdn_hkm` varchar(100) NOT NULL,
  `no_rek_bumdes` varchar(50) NOT NULL,
  `jangka_waktu` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `pengurus` text NOT NULL,
  `penasehat` text NOT NULL,
  `pengawas` text NOT NULL,
  `jenis_usaha` varchar(255) NOT NULL,
  `kategori_usaha` tinyint(1) NOT NULL,
  `tingkat_pemeringkatan` tinyint(1) NOT NULL,
  `tahun` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `bumdes`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `bumdes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
