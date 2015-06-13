/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.6.17 : Database - cdorada
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`cdorada` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `cdorada`;

/*Table structure for table `blog_category` */

DROP TABLE IF EXISTS `blog_category`;

CREATE TABLE `blog_category` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `parent` bigint(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `blog_category` */

LOCK TABLES `blog_category` WRITE;

insert  into `blog_category`(`id`,`parent`,`name`) values (1,0,'Categoria'),(2,1,'Categoria'),(3,1,'Categoria Secundaria'),(4,3,'asd'),(5,1,'1');

UNLOCK TABLES;

/*Table structure for table `cms_location` */

DROP TABLE IF EXISTS `cms_location`;

CREATE TABLE `cms_location` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `parent` bigint(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cms_location` */

LOCK TABLES `cms_location` WRITE;

UNLOCK TABLES;

/*Table structure for table `cms_options` */

DROP TABLE IF EXISTS `cms_options`;

CREATE TABLE `cms_options` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `option_name` varchar(255) DEFAULT NULL,
  `option_value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `cms_options` */

LOCK TABLES `cms_options` WRITE;

insert  into `cms_options`(`id`,`option_name`,`option_value`) values (1,'group_min','2'),(2,'group_max','16');

UNLOCK TABLES;

/*Table structure for table `cms_property` */

DROP TABLE IF EXISTS `cms_property`;

CREATE TABLE `cms_property` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL COMMENT 'titulo propiedad',
  `prize` double DEFAULT NULL COMMENT 'precio',
  `room` int(11) DEFAULT NULL COMMENT 'habitaciones',
  `capacity` int(11) DEFAULT NULL COMMENT 'capacidad',
  `tipo` varchar(50) DEFAULT NULL COMMENT 'tipo',
  `modo` varchar(50) DEFAULT NULL COMMENT 'modo',
  `location` varchar(200) DEFAULT NULL COMMENT 'ubicacion',
  `short_desc` text COMMENT 'desc. corta',
  `long_desc` text COMMENT 'desc larga',
  `deal` bigint(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cms_property` */

LOCK TABLES `cms_property` WRITE;

UNLOCK TABLES;

/*Table structure for table `cms_property_deal` */

DROP TABLE IF EXISTS `cms_property_deal`;

CREATE TABLE `cms_property_deal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `new_prize` int(11) DEFAULT NULL,
  `date_ini` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cms_property_deal` */

LOCK TABLES `cms_property_deal` WRITE;

UNLOCK TABLES;

/*Table structure for table `cms_property_exterior` */

DROP TABLE IF EXISTS `cms_property_exterior`;

CREATE TABLE `cms_property_exterior` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) DEFAULT NULL,
  `tipo` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `required` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `cms_property_exterior` */

LOCK TABLES `cms_property_exterior` WRITE;

insert  into `cms_property_exterior`(`id`,`name`,`tipo`,`active`,`required`) values (1,'Calefaccion',0,1,1),(2,'Aire acondicionado',0,1,1),(3,'Wifi',0,1,1),(4,'Television',0,1,1),(5,'Antena parabolica',0,1,1),(6,'Lavadora',0,1,1),(7,'Lavavajillas',0,1,1),(8,'Horno',0,1,1),(9,'Microondas',0,1,1),(10,'Nevera combi',0,1,1),(11,'Cafetera goteo',0,1,1),(12,'Hervidor agua',0,1,1),(13,'Tostadora',0,1,1),(14,'Plancha',0,1,1),(15,'Tabla plancha',0,1,1),(16,'Barbacoa',0,1,1);

UNLOCK TABLES;

/*Table structure for table `cms_property_extra` */

DROP TABLE IF EXISTS `cms_property_extra`;

CREATE TABLE `cms_property_extra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) DEFAULT NULL,
  `tipo` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `required` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `cms_property_extra` */

LOCK TABLES `cms_property_extra` WRITE;

insert  into `cms_property_extra`(`id`,`name`,`tipo`,`active`,`required`) values (1,'Estancia minima',1,1,1),(2,'Depositos y gastos',1,1,1),(3,'Zona',2,1,1),(4,'Distancia de la playa',1,1,1),(5,'Localidad',2,1,1),(6,'Supermercado mas cercano',1,1,1),(7,'Metros construidos',1,1,1),(8,'oxxo',1,1,0);

UNLOCK TABLES;

/*Table structure for table `cms_property_gallery` */

DROP TABLE IF EXISTS `cms_property_gallery`;

CREATE TABLE `cms_property_gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL COMMENT 'Id de propiedad',
  `name` varchar(80) DEFAULT NULL COMMENT 'Nombre imagen',
  `order` int(11) DEFAULT NULL COMMENT 'Orden de Imagen',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cms_property_gallery` */

LOCK TABLES `cms_property_gallery` WRITE;

UNLOCK TABLES;

/*Table structure for table `cms_property_general` */

DROP TABLE IF EXISTS `cms_property_general`;

CREATE TABLE `cms_property_general` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) DEFAULT NULL,
  `tipo` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `required` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

/*Data for the table `cms_property_general` */

LOCK TABLES `cms_property_general` WRITE;

insert  into `cms_property_general`(`id`,`name`,`tipo`,`active`,`required`) values (1,'Parking',0,1,1),(2,'Zonas ajardinadas',0,1,1),(3,'Jardin',0,1,1),(4,'Terraza',0,1,1),(5,'Balcon',0,1,1),(6,'Solarium',0,1,1),(7,'Piscina privada',0,1,1),(8,'De nueva construccion',0,1,1),(9,'Canguro',1,1,1),(10,'Limpiezas extras',1,1,1),(11,'Alquiler de coche',1,1,1),(12,'alquiler de barcos',0,1,1),(13,'Reservas Wellness',0,1,1),(14,'Reservas Golf',0,1,1),(15,'Alquiler de bicis',0,1,1),(16,'Excursiones varias',0,1,1),(24,'Taxi',1,1,1);

UNLOCK TABLES;

/*Table structure for table `cms_property_interior` */

DROP TABLE IF EXISTS `cms_property_interior`;

CREATE TABLE `cms_property_interior` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) CHARACTER SET utf8 DEFAULT NULL,
  `tipo` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `required` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `cms_property_interior` */

LOCK TABLES `cms_property_interior` WRITE;

insert  into `cms_property_interior`(`id`,`name`,`tipo`,`active`,`required`) values (1,'Salon',0,1,1),(2,'Comedor',0,1,1),(3,'Cocina',0,1,1),(4,'Cocina americana',0,1,1),(5,'Vitroceramica',0,1,1),(6,'Banos',1,1,1),(7,'Aseos',1,1,1),(8,'Dormitorios',1,1,1),(9,'Camas individuales',1,1,1),(10,'Camas dobles',1,1,1),(11,'Plegatin',1,1,1),(12,'Mobiliario moderno',0,1,1),(13,'Baneras',1,1,1);

UNLOCK TABLES;

/*Table structure for table `core_user` */

DROP TABLE IF EXISTS `core_user`;

CREATE TABLE `core_user` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `userpass` varchar(255) DEFAULT NULL,
  `lang` varchar(64) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_last_p` varchar(255) DEFAULT NULL,
  `user_last_m` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_user` */

LOCK TABLES `core_user` WRITE;

UNLOCK TABLES;

/*Table structure for table `crm_activities` */

DROP TABLE IF EXISTS `crm_activities`;

CREATE TABLE `crm_activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `idCompanyOrPerson` int(11) NOT NULL,
  `dateActivity` date NOT NULL,
  `timeActivity` time NOT NULL,
  `description` varchar(155) DEFAULT NULL,
  `typeCompanyOrPerson` varchar(20) DEFAULT NULL,
  `activo` varchar(2) DEFAULT NULL COMMENT 'solo acepta SI o NO',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `crm_activities` */

LOCK TABLES `crm_activities` WRITE;

insert  into `crm_activities`(`id`,`title`,`category`,`idCompanyOrPerson`,`dateActivity`,`timeActivity`,`description`,`typeCompanyOrPerson`,`activo`) values (1,' actividad 1','Llamada telefonica',5,'2015-06-03','02:02:00','www','company','SI'),(2,'actividad 1','Oportunidad',1,'2015-06-04','-00:00:01','adfasdfa','contact','NO'),(3,'Actividad 3','Fax',5,'2015-06-04','14:02:00','enviar fax a la compaÃ±ia 4 para xxxxxxx','company','SI');

UNLOCK TABLES;

/*Table structure for table `crm_company` */

DROP TABLE IF EXISTS `crm_company`;

CREATE TABLE `crm_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `contactType` varchar(50) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `telephone` varchar(25) DEFAULT NULL,
  `webSite` varchar(255) DEFAULT NULL,
  `typeWeb` varchar(15) DEFAULT NULL,
  `Address` varchar(200) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `zipCode` varchar(5) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `currency` varchar(100) DEFAULT NULL,
  `commercialDenomination` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `crm_company` */

LOCK TABLES `crm_company` WRITE;

insert  into `crm_company`(`id`,`name`,`contactType`,`email`,`telephone`,`webSite`,`typeWeb`,`Address`,`city`,`state`,`zipCode`,`country`,`description`,`currency`,`commercialDenomination`) values (1,'empresa de pruebas','Cliente','chevuz@hotmail.com','123456','https://www.facebook.com/?ref=tn_tnmn','Facebook','caÃ±ada honda 23','Aguascalientes','Aguascalientes','20200','Mexico','Empresa de pruebas','MNX - Pesos mexicanos',NULL),(2,'empresa de pruebas 2','Proovedor','chevuz@hotmail.com|Trabajo;','12345|Trabajo;','https://www.facebook.com/?ref=tn_tnmn','Twitter','calle de las pruebas 1','Aguascalientes','Aguascalientes','20200','Mexico','empresa de prueba 2','MNX - Pesos mexicanos','empresas de prueba'),(5,'empresa de pruebas 4','Prospecto','chevuz@hotmail.com|Trabajo;;','123456|Trabajo;;','https://www.facebook.com/juan.torres.22','Sitio web','a','Aguascalientes','Aguascalientes','20200','Mexico','ejemplo tipo de empresa 4','MNX - Pesos mexicanos','empresas de prueba'),(6,'empresa de pruebas 3','Prospecto','chevuz@hotmail.com|Trabajo;','123456|Trabajo;','https://www.facebook.com/juan.torres.22','Facebook','abcdefg','Aguascalientes','Aguascalientes','20200','Mexico','abce','MNX - Pesos mexicanos','empresas de prueba');

UNLOCK TABLES;

/*Table structure for table `crm_contact` */

DROP TABLE IF EXISTS `crm_contact`;

CREATE TABLE `crm_contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `contactType` varchar(100) DEFAULT NULL,
  `company` varchar(200) DEFAULT NULL,
  `companyPosition` varchar(200) DEFAULT NULL,
  `telephone` varchar(25) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `webSite` varchar(255) DEFAULT NULL,
  `typeWeb` varchar(15) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `zipCode` varchar(5) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `crm_contact` */

LOCK TABLES `crm_contact` WRITE;

insert  into `crm_contact`(`id`,`name`,`contactType`,`company`,`companyPosition`,`telephone`,`email`,`webSite`,`typeWeb`,`address`,`city`,`state`,`zipCode`,`country`,`description`) values (1,'contacto de prueba','Cliente','Empresa de pruebas','Gerente','4491144040|Trabajo;','chevuz@hotmail.com|Trabajo;','https://www.facebook.com/?ref=tn_tnmn','Facebook','edmndo gamez 122','Aguascalientes','Aguascalientes','20200','Mexico','solo es para ejemplo de insersion de datos'),(14,'Juan Torres Sandoval','Socio','Empresa de pruebas 1','Gerente','4491135566|Trabajo;','j.Torres@gmail.com|Trabajo;','https://www.facebook.com/juan.torres.22','Facebook','Papantla 1680','Guadalajara','Jalisco','44960','Mexico','persona de prueba');

UNLOCK TABLES;

/*Table structure for table `crm_contacts_category` */

DROP TABLE IF EXISTS `crm_contacts_category`;

CREATE TABLE `crm_contacts_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` varchar(20) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `crm_contacts_category` */

LOCK TABLES `crm_contacts_category` WRITE;

insert  into `crm_contacts_category`(`id`,`parent`,`name`) values (1,'0','abcdd'),(2,'1','bbcd');

UNLOCK TABLES;

/*Table structure for table `property_options` */

DROP TABLE IF EXISTS `property_options`;

CREATE TABLE `property_options` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `option_name` varchar(255) DEFAULT NULL,
  `option_value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `property_options` */

LOCK TABLES `property_options` WRITE;

insert  into `property_options`(`id`,`option_name`,`option_value`) values (1,'group_min','2'),(2,'group_max','16');

UNLOCK TABLES;

/*Table structure for table `property_type` */

DROP TABLE IF EXISTS `property_type`;

CREATE TABLE `property_type` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `property_type` */

LOCK TABLES `property_type` WRITE;

insert  into `property_type`(`id`,`name`) values (1,'Casa Adosada'),(2,'Apartamento'),(3,'Duplex'),(4,'Piso'),(5,'Chalet'),(6,'Atico'),(7,'Estudio'),(8,'Casa');

UNLOCK TABLES;

/*Table structure for table `warehouse_store` */

DROP TABLE IF EXISTS `warehouse_store`;

CREATE TABLE `warehouse_store` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `noi` varchar(10) DEFAULT NULL,
  `noe` varchar(15) DEFAULT NULL,
  `colony` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `estado` varchar(30) DEFAULT NULL,
  `ciudad` varchar(40) DEFAULT NULL,
  `cp` varchar(5) DEFAULT NULL,
  `serie` varchar(5) DEFAULT NULL,
  `mode` varchar(50) DEFAULT NULL,
  `owner` varchar(50) DEFAULT NULL,
  `p_list` varchar(50) DEFAULT NULL,
  `doInvoice` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `warehouse_store` */

LOCK TABLES `warehouse_store` WRITE;

insert  into `warehouse_store`(`id`,`name`,`street`,`noi`,`noe`,`colony`,`phone`,`email`,`estado`,`ciudad`,`cp`,`serie`,`mode`,`owner`,`p_list`,`doInvoice`) values (1,'a','a','1','a','a','1','a','a','a','1','a','0','a','a','0');

UNLOCK TABLES;

/*Table structure for table `web_featured` */

DROP TABLE IF EXISTS `web_featured`;

CREATE TABLE `web_featured` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `web_featured` */

LOCK TABLES `web_featured` WRITE;

insert  into `web_featured`(`id`,`title`,`caption`,`url`) values (2,'aa','aa','aa'),(3,'aa','aa','aa'),(4,'aa','aa','aa'),(5,'xxx','xxxx','xxx');

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
