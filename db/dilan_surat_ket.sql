SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


DROP TABLE IF EXISTS `dilan_surat_ket`;
CREATE TABLE `dilan_surat_ket` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `keperluan` varchar(255) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `dilan_surat_ket` (`id`, `title`, `keperluan`, `keterangan`) VALUES
(1, 'SURAT KETERANGAN DOMISILI', 'KETERANGAN DOMISILI', 'NAMA TERSEBUT DIATAS  ADALAH BENAR BERDOMISILI DI DESA RONGGO, KECAMATAN JAKEN, KABUPATEN PATI'),
(2, 'SURAT PENGANTAR PEMBUATAN KK', 'SEBAGAI SYARAT UNTUK MEMBUAT KARTU KELUARGA BARU SETELAH MENIKAH', 'NAMA TERSEBUT DIATAS  ADALAH BENAR BERDOMISILI DI DESA RONGGO, KECAMATAN JAKEN, KABUPATEN PATI'),
(3, 'SURAT PENGANTAR PEMBUATAN KTP', 'SEBAGAI SYARAT UNTUK MEMBUAT KARTU TANDA PENDUDUK', 'NAMA TERSEBUT DIATAS  ADALAH BENAR BERDOMISILI DI DESA RONGGO, KECAMATAN JAKEN, KABUPATEN PATI'),
(4, 'SURAT PENGANTAR MELAMAR PEKERJAAN', 'SEBAGAI SYARAT UNTUK MELAMAR PEKERJAAN', 'NAMA TERSEBUT DIATAS  ADALAH BENAR BERDOMISILI DI DESA RONGGO, KECAMATAN JAKEN, KABUPATEN PATI'),
(5, 'SURAT PENGANTAR DOKUMEN PERNIKAHAN', 'PENGURUSAN DOKUMEN PERNIKAHAN', 'NAMA TERSEBUT DIATAS  ADALAH BENAR BERDOMISILI DI DESA RONGGO, KECAMATAN JAKEN, KABUPATEN PATI'),
(6, 'SURAT PENGANTAR MENGAJUKAN PINJAMAN', 'SEBAGAI SYARAT UNTUK MENGAJUKAN PINJAMAN', 'NAMA TERSEBUT DIATAS  ADALAH BENAR BERDOMISILI DI DESA RONGGO, KECAMATAN JAKEN, KABUPATEN PATI'),
(7, 'SURAT KETERANGAN TIDAK MAMPU', 'NAMA TERSEBUT DIATAS ADALAH BENAR – BENAR DARI KELUARGA KURANG MAMPU / TIDAK MAMPU', 'NAMA TERSEBUT DIATAS  ADALAH BENAR BERDOMISILI DI DESA RONGGO, KECAMATAN JAKEN, KABUPATEN PATI'),
(8, 'SURAT KETERANGAN USAHA', 'NAMA TERSEBUT DIATAS ADALAH  BENAR – BENAR  MEILIKI USAHA ………..', 'NAMA TERSEBUT DIATAS  ADALAH BENAR BERDOMISILI DI DESA RONGGO, KECAMATAN JAKEN, KABUPATEN PATI');


ALTER TABLE `dilan_surat_ket`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `dilan_surat_ket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;