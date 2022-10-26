# ************************************************************
# Sequel Ace SQL dump
# Version 20035
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: localhost (MySQL 8.0.30)
# Database: sipapat
# Generation Time: 2022-10-17 13:47:08 +0000
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
  `laki_laki` int DEFAULT '0',
  `perempuan` int DEFAULT '0',
  `kepala_keluarga` int DEFAULT '0',
  `kepala_keluarga_perempuan` int DEFAULT '0',
  `kepala_keluarga_laki_laki` int DEFAULT '0',
  `islam` int DEFAULT '0',
  `kristen` int DEFAULT '0',
  `katholik` int DEFAULT '0',
  `hindu` int DEFAULT '0',
  `budha` int DEFAULT '0',
  `khonghucu` int DEFAULT '0',
  `penghayat_kepercayaan` int DEFAULT '0',
  `agama_lainnya` int DEFAULT '0',
  `tidak_belum_sekolah` int DEFAULT '0',
  `tidak_tamat_sd` int DEFAULT '0',
  `tamat_sd` int DEFAULT '0',
  `sltp` int DEFAULT '0',
  `slta` int DEFAULT '0',
  `d1_d2` int DEFAULT '0',
  `d3` int DEFAULT '0',
  `s1` int DEFAULT '0',
  `s2` int DEFAULT '0',
  `s3` int DEFAULT '0',
  `faspen_tk` int DEFAULT '0',
  `faspen_sd` int DEFAULT '0',
  `faspen_sltp` int DEFAULT '0',
  `faspen_slta` int DEFAULT '0',
  `faspen_pesantren` int DEFAULT '0',
  `faspen_perguruan_tinggi` int DEFAULT '0',
  `faspem_kantor_desa` int DEFAULT '0',
  `faspem_balai_desa` int DEFAULT '0',
  `faspem_perpus_desa` int DEFAULT '0',
  `fasib_masjid` int DEFAULT '0',
  `fasib_mushola` int DEFAULT '0',
  `fasib_gereja` int DEFAULT '0',
  `fasib_wihara` int DEFAULT '0',
  `fasib_klenteng` int DEFAULT '0',
  `fasek_pasar_desa` int DEFAULT '0',
  `fasek_toko` int DEFAULT '0',
  `fasek_swalayan` int DEFAULT '0',
  `fasek_restoran` int DEFAULT '0',
  `fasek_rumah_makan` int DEFAULT '0',
  `fasek_warung_makan` int DEFAULT '0',
  `faskes_pkd` int DEFAULT '0' COMMENT 'pos kesehatan desa',
  `faskes_puskesmas` int DEFAULT '0',
  `faskes_klinik` int DEFAULT '0',
  `faskes_dokter_praktik` int DEFAULT '0',
  `fasling_tpa` int DEFAULT '0' COMMENT 'bank sampah / TPA',
  `fasling_makam` int DEFAULT '0',
  `fasling_lap_or` int DEFAULT '0' COMMENT 'lapangan olah raga',
  `fasling_pamsimas` int DEFAULT '0',
  `asn` int DEFAULT '0',
  `tni` int DEFAULT '0',
  `polri` int DEFAULT '0',
  `karyawan_swasta` int DEFAULT '0',
  `karyawan_bumn` int DEFAULT '0',
  `petani` int DEFAULT '0',
  `buruh_tani` int DEFAULT '0',
  `nelayan` int DEFAULT '0',
  `wiraswasta` int DEFAULT '0',
  `ibu_rumah_tangga` int DEFAULT '0',
  `belum_bekerja` int DEFAULT '0',
  `pekerjaan_lainnya` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
