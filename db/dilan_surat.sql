SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


DROP TABLE IF EXISTS `dilan_surat`;
CREATE TABLE `dilan_surat` (
  `id` int(11) NOT NULL,
  `penduduk_id` int(11) NOT NULL,
  `keperluan` varchar(255) NOT NULL,
  `berlaku_mulai` date NOT NULL,
  `berlaku_sampai` date NOT NULL,
  `keterangan` varchar(255) NOT NULL COMMENT 'keterangan lain-lain',
  `nomor` varchar(255) NOT NULL,
  `tgl` date NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `dilan_surat` (`id`, `penduduk_id`, `keperluan`, `berlaku_mulai`, `berlaku_sampai`, `keterangan`, `nomor`, `tgl`, `created`, `updated`) VALUES
(1, 0, 'PEMBUATAN AKTA LAHIR', '2019-01-01', '2019-01-01', '0', '12345', '2019-01-01', '2019-09-09 00:10:39', '2019-09-09 00:10:39');


ALTER TABLE `dilan_surat`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `dilan_surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
