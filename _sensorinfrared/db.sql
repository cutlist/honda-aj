/*
SQLyog Ultimate v11.11 (32 bit)
MySQL - 5.5.8 : Database - db_project25
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_project25` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_project25`;

/*Table structure for table `x23_interval` */

DROP TABLE IF EXISTS `x23_interval`;

CREATE TABLE `x23_interval` (
  `milisecond` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `x23_interval` */

insert  into `x23_interval`(`milisecond`) values (5000);

/*Table structure for table `x23_scanhistory` */

DROP TABLE IF EXISTS `x23_scanhistory`;

CREATE TABLE `x23_scanhistory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` year(4) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `aksi` varchar(10) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `x23_scanhistory` */

/*Table structure for table `x23_scankeluar` */

DROP TABLE IF EXISTS `x23_scankeluar`;

CREATE TABLE `x23_scankeluar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` year(4) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `x23_scankeluar` */

/*Table structure for table `x23_scanmasuk` */

DROP TABLE IF EXISTS `x23_scanmasuk`;

CREATE TABLE `x23_scanmasuk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` year(4) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `x23_scanmasuk` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
