-- Valentina Studio --
-- MySQL dump --
-- ---------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
-- ---------------------------------------------------------


-- DROP TABLE "anggaran_doc" -----------------------------------
DROP TABLE IF EXISTS `anggaran_doc` CASCADE;
-- -------------------------------------------------------------


-- CREATE TABLE "anggaran_doc" ---------------------------------
CREATE TABLE `anggaran_doc` ( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`anggaran_id` Int( 11 ) NOT NULL,
	`doc_0` Text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`doc_50` Text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`doc_100` Text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`doc` Text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`created` Timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`updated` Timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 1;
-- -------------------------------------------------------------


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- ---------------------------------------------------------


