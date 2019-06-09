SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


DROP TABLE IF EXISTS `potensi_desa`;
CREATE TABLE `potensi_desa` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `desa_id` int(11) NOT NULL,
  `item` varchar(255) NOT NULL,
  `kategori` tinyint(2) NOT NULL COMMENT '1=perikanan,2=pertanian,3=peternakan,4=perkebunan,5=home indsutri,6=perdagangan,7=wisata,8=jasa',
  `produk_desa` tinyint(1) NOT NULL COMMENT '0=tidak,1=ada',
  `doc` varchar(255) NOT NULL,
  `volume` int(11) NOT NULL COMMENT '0=nihil',
  `satuan` tinyint(2) NOT NULL COMMENT '0=nihil,1=Ton,2=Kg,3=Kw,4=ekor,5=lembar,6=liter',
  `waktu` tinyint(2) NOT NULL COMMENT '1=januari-desember,2=setiap hari,3=setiap minggu',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `potensi_desa`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `potensi_desa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
