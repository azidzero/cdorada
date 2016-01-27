/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;

USE `cdorada`;

/* Create table in target */
CREATE TABLE `crs_offer`(
	`id` int(11) NOT NULL  auto_increment , 
	`name` varchar(100) COLLATE utf8_general_ci NULL  , 
	`cant` int(11) NULL  , 
	`date_ini` date NULL  , 
	`date_end` date NULL  , 
	`tipo` tinyint(1) NULL  , 
	`date_create` timestamp NULL  , 
	`date_update` timestamp NULL  , 
	`ishome` int(11) NULL  , 
	PRIMARY KEY (`id`) 
) ENGINE=InnoDB DEFAULT CHARSET='utf8' COLLATE='utf8_general_ci';


/* Create table in target */
CREATE TABLE `crs_offer_use`(
	`id` int(11) NOT NULL  auto_increment , 
	`pid` int(11) NULL  , 
	`idof` int(11) NULL  , 
	PRIMARY KEY (`id`) 
) ENGINE=InnoDB DEFAULT CHARSET='utf8' COLLATE='utf8_general_ci';

