# ************************************************************
# Sequel Ace SQL dump
# Version 20035
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: localhost (MySQL 8.0.30)
# Database: sipapat
# Generation Time: 2022-10-14 23:23:07 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table statistik_penduduk
# ------------------------------------------------------------

DROP TABLE IF EXISTS `statistik_penduduk`;

CREATE TABLE `statistik_penduduk` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `desa_id` int DEFAULT NULL,
  `laki_laki` int DEFAULT NULL,
  `perempuan` int DEFAULT NULL,
  `kepala_keluarga` int DEFAULT NULL,
  `kepala_keluarga_perempuan` int DEFAULT NULL,
  `kepala_keluarga_laki_laki` int DEFAULT NULL,
  `islam` int DEFAULT NULL,
  `kristen` int DEFAULT NULL,
  `katholik` int DEFAULT NULL,
  `hindu` int DEFAULT NULL,
  `budha` int DEFAULT NULL,
  `khonghucu` int DEFAULT NULL,
  `penghayat_kepercayaan` int DEFAULT NULL,
  `agama_lainnya` int DEFAULT NULL,
  `tidak_belum_sekolah` int DEFAULT NULL,
  `tidak_tamat_sd` int DEFAULT NULL,
  `tamat_sd` int DEFAULT NULL,
  `sltp` int DEFAULT NULL,
  `slta` int DEFAULT NULL,
  `d1_d2` int DEFAULT NULL,
  `d3` int DEFAULT NULL,
  `s1` int DEFAULT NULL,
  `s2` int DEFAULT NULL,
  `s3` int DEFAULT NULL,
  `faspen_tk` int DEFAULT NULL,
  `faspen_sd` int DEFAULT NULL,
  `faspen_sltp` int DEFAULT NULL,
  `faspen_slta` int DEFAULT NULL,
  `faspen_pesantren` int DEFAULT NULL,
  `faspen_perguruan_tinggi` int DEFAULT NULL,
  `faspem_kantor_desa` int DEFAULT NULL,
  `faspem_balai_desa` int DEFAULT NULL,
  `faspem_perpus_desa` int DEFAULT NULL,
  `fasib_masjid` int DEFAULT NULL,
  `fasib_mushola` int DEFAULT NULL,
  `fasib_gereja` int DEFAULT NULL,
  `fasib_wihara` int DEFAULT NULL,
  `fasib_klenteng` int DEFAULT NULL,
  `fasek_pasar_desa` int DEFAULT NULL,
  `fasek_toko` int DEFAULT NULL,
  `fasek_swalayan` int DEFAULT NULL,
  `fasek_restoran` int DEFAULT NULL,
  `fasek_rumah_makan` int DEFAULT NULL,
  `fasek_warung_makan` int DEFAULT NULL,
  `faskes_pkd` int DEFAULT NULL COMMENT 'pos kesehatan desa',
  `faskes_puskesmas` int DEFAULT NULL,
  `faskes_klinik` int DEFAULT NULL,
  `faskes_dokter_praktik` int DEFAULT NULL,
  `fasling_tpa` int DEFAULT NULL COMMENT 'bank sampah / TPA',
  `fasling_makam` int DEFAULT NULL,
  `fasling_lap_or` int DEFAULT NULL COMMENT 'lapangan olah raga',
  `fasling_pamsimas` int DEFAULT NULL,
  `asn` int DEFAULT NULL,
  `tni` int DEFAULT NULL,
  `polri` int DEFAULT NULL,
  `karyawan_swasta` int DEFAULT NULL,
  `karyawan_bumn` int DEFAULT NULL,
  `petani` int DEFAULT NULL,
  `buruh_tani` int DEFAULT NULL,
  `nelayan` int DEFAULT NULL,
  `wiraswasta` int DEFAULT NULL,
  `ibu_rumah_tangga` int DEFAULT NULL,
  `belum_bekerja` int DEFAULT NULL,
  `pekerjaan_lainnya` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
