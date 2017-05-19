/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 5.5.8 : Database - alx_honda
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`alx_honda` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `alx_honda`;

/*Table structure for table `_tools` */

DROP TABLE IF EXISTS `_tools`;

CREATE TABLE `_tools` (
  `scan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `_tools` */

/*Table structure for table `abs_department` */

DROP TABLE IF EXISTS `abs_department`;

CREATE TABLE `abs_department` (
  `DepartmentID` varchar(10) NOT NULL,
  `DepartmentName` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`DepartmentID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `abs_department` */

insert  into `abs_department`(`DepartmentID`,`DepartmentName`) values ('1','DIVISI TES');

/*Table structure for table `abs_employee` */

DROP TABLE IF EXISTS `abs_employee`;

CREATE TABLE `abs_employee` (
  `EmployeeID` varchar(15) NOT NULL,
  `FirstName` varchar(100) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `DepartmentID` varchar(10) DEFAULT NULL,
  `ScheduleID` varchar(10) DEFAULT NULL,
  `StartDate` datetime DEFAULT NULL,
  `Finger1` tinyint(4) DEFAULT NULL,
  `FingerData1` mediumblob,
  `Date1` datetime DEFAULT NULL,
  `Finger2` tinyint(4) DEFAULT NULL,
  `FingerData2` mediumblob,
  `Date2` datetime DEFAULT NULL,
  `PicturePath` varchar(250) DEFAULT NULL,
  `Rest` bit(1) DEFAULT NULL,
  `PIN` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`EmployeeID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `abs_employee` */

insert  into `abs_employee`(`EmployeeID`,`FirstName`,`LastName`,`DepartmentID`,`ScheduleID`,`StartDate`,`Finger1`,`FingerData1`,`Date1`,`Finger2`,`FingerData2`,`Date2`,`PicturePath`,`Rest`,`PIN`) values ('H1-001','ALEX IMC',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
insert  into `abs_employee`(`EmployeeID`,`FirstName`,`LastName`,`DepartmentID`,`ScheduleID`,`StartDate`,`Finger1`,`FingerData1`,`Date1`,`Finger2`,`FingerData2`,`Date2`,`PicturePath`,`Rest`,`PIN`) values ('H1-002','STAF ADMINISTRASI',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
insert  into `abs_employee`(`EmployeeID`,`FirstName`,`LastName`,`DepartmentID`,`ScheduleID`,`StartDate`,`Finger1`,`FingerData1`,`Date1`,`Finger2`,`FingerData2`,`Date2`,`PicturePath`,`Rest`,`PIN`) values ('H1-003','STAF KASIR',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
insert  into `abs_employee`(`EmployeeID`,`FirstName`,`LastName`,`DepartmentID`,`ScheduleID`,`StartDate`,`Finger1`,`FingerData1`,`Date1`,`Finger2`,`FingerData2`,`Date2`,`PicturePath`,`Rest`,`PIN`) values ('H1-004','STAF GUDANG PDI',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
insert  into `abs_employee`(`EmployeeID`,`FirstName`,`LastName`,`DepartmentID`,`ScheduleID`,`StartDate`,`Finger1`,`FingerData1`,`Date1`,`Finger2`,`FingerData2`,`Date2`,`PicturePath`,`Rest`,`PIN`) values ('H1-005','KEPALA TOKO',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
insert  into `abs_employee`(`EmployeeID`,`FirstName`,`LastName`,`DepartmentID`,`ScheduleID`,`StartDate`,`Finger1`,`FingerData1`,`Date1`,`Finger2`,`FingerData2`,`Date2`,`PicturePath`,`Rest`,`PIN`) values ('H1-006','STAF DRIVER',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
insert  into `abs_employee`(`EmployeeID`,`FirstName`,`LastName`,`DepartmentID`,`ScheduleID`,`StartDate`,`Finger1`,`FingerData1`,`Date1`,`Finger2`,`FingerData2`,`Date2`,`PicturePath`,`Rest`,`PIN`) values ('H1-007','STAF SALES',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
insert  into `abs_employee`(`EmployeeID`,`FirstName`,`LastName`,`DepartmentID`,`ScheduleID`,`StartDate`,`Finger1`,`FingerData1`,`Date1`,`Finger2`,`FingerData2`,`Date2`,`PicturePath`,`Rest`,`PIN`) values ('H1-008','STAF SALES COUNTER',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
insert  into `abs_employee`(`EmployeeID`,`FirstName`,`LastName`,`DepartmentID`,`ScheduleID`,`StartDate`,`Finger1`,`FingerData1`,`Date1`,`Finger2`,`FingerData2`,`Date2`,`PicturePath`,`Rest`,`PIN`) values ('H1-010','SALES AJ',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `abs_result` */

DROP TABLE IF EXISTS `abs_result`;

CREATE TABLE `abs_result` (
  `EmployeeID` varchar(15) DEFAULT NULL,
  `Date` datetime NOT NULL,
  `ShiftID` varchar(10) DEFAULT NULL,
  `TimeScan1` datetime DEFAULT NULL,
  `MinComingOverTime` datetime DEFAULT NULL,
  `MaxComingOverTime` datetime DEFAULT NULL,
  `Time1` datetime DEFAULT NULL,
  `StartBreak` datetime DEFAULT NULL,
  `Break` datetime DEFAULT NULL,
  `EndBreak` datetime DEFAULT NULL,
  `Time2` datetime DEFAULT NULL,
  `MinBackOverTime` datetime DEFAULT NULL,
  `MaxBackOverTime` datetime DEFAULT NULL,
  `TimeScan2` datetime DEFAULT NULL,
  `Scan1` datetime DEFAULT NULL,
  `Scan2` datetime DEFAULT NULL,
  `Scan3` datetime DEFAULT NULL,
  `Scan4` datetime DEFAULT NULL,
  `TotalScan` tinyint(4) DEFAULT NULL,
  `Status` varchar(1) DEFAULT NULL,
  `StatusAbsence` varchar(3) DEFAULT NULL,
  `UserUpdateSchedule` varchar(20) DEFAULT NULL,
  `LastUpdateSchedule` datetime DEFAULT NULL,
  `UserUpdateScan` varchar(20) DEFAULT NULL,
  `LastUpdateScan` datetime DEFAULT NULL,
  `Notes` varchar(200) DEFAULT NULL,
  `Late` datetime DEFAULT NULL,
  `BreakDuration` datetime DEFAULT NULL,
  `BreakOver` datetime DEFAULT NULL,
  `TimeOfWork` datetime DEFAULT NULL,
  `ComingOverTime` datetime DEFAULT NULL,
  `BackOverTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `abs_result` */

insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-002','2016-12-01 08:06:51','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-12-01 07:06:54','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-01 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-003','2016-12-01 08:06:52','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-12-01 07:06:54','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-01 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-004','2016-12-01 08:06:53','012072','0000-00-00 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-12-01 07:06:54','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-01 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-005','2016-12-01 07:06:54','012072','0000-00-00 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-12-01 07:06:54','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-02 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-006','2016-12-01 08:06:54','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-12-01 07:06:54','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-01 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-007','2016-12-01 08:06:54','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-12-01 07:06:54','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-01 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-008','2016-12-01 08:06:54','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-12-01 07:06:54','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-01 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-002','2016-12-02 08:06:51','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-05-03 08:06:51','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-02 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-003','2016-12-02 08:06:52','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-05-03 08:06:51','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-02 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-005','2016-12-02 07:06:54','012072','0000-00-00 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-12-02 07:06:54','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-02 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-006','2016-12-02 08:06:54','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-05-03 08:06:51','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-02 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-007','2016-12-02 08:06:54','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-05-03 08:06:51','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-02 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-008','2016-12-02 08:06:54','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-05-03 08:06:51','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-02 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-004','2016-12-02 08:06:53','012072','0000-00-00 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-05-03 08:06:51','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-02 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-002','2016-12-01 08:06:51','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-12-01 07:06:54','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-01 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-003','2016-12-01 08:06:52','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-12-01 07:06:54','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-01 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-004','2016-12-01 08:06:53','012072','0000-00-00 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-12-01 07:06:54','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-01 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-005','2016-12-01 07:06:54','012072','0000-00-00 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-12-01 07:06:54','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-02 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-006','2016-12-01 08:06:54','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-12-01 07:06:54','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-01 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-007','2016-12-01 08:06:54','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-12-01 07:06:54','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-01 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-008','2016-12-01 08:06:54','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-12-01 07:06:54','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-01 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-002','2016-12-02 08:06:51','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-05-03 08:06:51','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-02 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-003','2016-12-02 08:06:52','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-05-03 08:06:51','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-02 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-005','2016-12-02 07:06:54','012072','0000-00-00 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-12-02 07:06:54','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-02 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-006','2016-12-02 08:06:54','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-05-03 08:06:51','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-02 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-007','2016-12-02 08:06:54','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-05-03 08:06:51','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-02 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-008','2016-12-02 08:06:54','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-05-03 08:06:51','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-02 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-004','2016-12-02 08:06:53','012072','0000-00-00 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-05-03 08:06:51','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-02 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-002','2016-12-01 08:06:51','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-12-01 07:06:54','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-01 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-003','2016-12-01 08:06:52','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-12-01 07:06:54','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-01 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-004','2016-12-01 08:06:53','012072','0000-00-00 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-12-01 07:06:54','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-01 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-005','2016-12-01 07:06:54','012072','0000-00-00 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-12-01 07:06:54','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-02 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-006','2016-12-01 08:06:54','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-12-01 07:06:54','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-01 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-007','2016-12-01 08:06:54','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-12-01 07:06:54','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-01 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-008','2016-12-01 08:06:54','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-12-01 07:06:54','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-01 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-002','2016-12-02 08:06:51','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-05-03 08:06:51','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-02 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-003','2016-12-02 08:06:52','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-05-03 08:06:51','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-02 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-005','2016-12-02 07:06:54','012072','0000-00-00 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-12-02 07:06:54','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-02 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-006','2016-12-02 08:06:54','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-05-03 08:06:51','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-02 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-007','2016-12-02 08:06:54','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-05-03 08:06:51','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-02 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-008','2016-12-02 08:06:54','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-05-03 08:06:51','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-02 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-004','2016-12-02 08:06:53','012072','0000-00-00 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-05-03 08:06:51','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-02 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-002','2016-12-01 08:06:51','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-12-01 07:06:54','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-01 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-003','2016-12-01 08:06:52','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-12-01 07:06:54','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-01 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-004','2016-12-01 08:06:53','012072','0000-00-00 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-12-01 07:06:54','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-01 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-005','2016-12-01 07:06:54','012072','0000-00-00 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-12-01 07:06:54','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-02 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-006','2016-12-01 08:06:54','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-12-01 07:06:54','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-01 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-007','2016-12-01 08:06:54','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-12-01 07:06:54','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-01 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-008','2016-12-01 08:06:54','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-12-01 07:06:54','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-01 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-002','2016-12-02 08:06:51','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-05-03 08:06:51','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-02 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-003','2016-12-02 08:06:52','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-05-03 08:06:51','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-02 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-005','2016-12-02 07:06:54','012072','0000-00-00 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-12-02 07:06:54','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-02 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-006','2016-12-02 08:06:54','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-05-03 08:06:51','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-02 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-007','2016-12-02 08:06:54','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-05-03 08:06:51','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-02 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-008','2016-12-02 08:06:54','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-05-03 08:06:51','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-02 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-004','2016-12-02 08:06:53','012072','0000-00-00 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-05-03 08:06:51','0000-00-00 00:00:00','0000-00-00 00:00:00','2016-12-02 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-002','2017-02-27 08:06:53','012072','0000-00-00 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-05-03 08:06:51','0000-00-00 00:00:00','0000-00-00 00:00:00','2017-02-27 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H1-005','2017-02-27 08:06:53','012072','0000-00-00 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-05-03 08:06:51','0000-00-00 00:00:00','0000-00-00 00:00:00','2017-02-27 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');

/*Table structure for table `abs_status` */

DROP TABLE IF EXISTS `abs_status`;

CREATE TABLE `abs_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `EmployeeID` varchar(200) DEFAULT NULL,
  `awal` date DEFAULT NULL,
  `akhir` date DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `keterangan` varchar(20) NOT NULL,
  `updatex` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `abs_status` */

insert  into `abs_status`(`id`,`EmployeeID`,`awal`,`akhir`,`status`,`keterangan`,`updatex`) values (1,'H1-001','2017-01-03','2017-01-03','IZIN','MALAS','');
insert  into `abs_status`(`id`,`EmployeeID`,`awal`,`akhir`,`status`,`keterangan`,`updatex`) values (2,'H1-005','2017-01-04','2017-01-04','IZIN','TT','');
insert  into `abs_status`(`id`,`EmployeeID`,`awal`,`akhir`,`status`,`keterangan`,`updatex`) values (3,'H1-005','2017-01-04','2017-01-04','SAKIT','RERE','');
insert  into `abs_status`(`id`,`EmployeeID`,`awal`,`akhir`,`status`,`keterangan`,`updatex`) values (4,'H1-001','2017-01-04','2017-01-04','SAKIT','T','');
insert  into `abs_status`(`id`,`EmployeeID`,`awal`,`akhir`,`status`,`keterangan`,`updatex`) values (5,'H1-003','2017-01-04','2017-01-04','IZIN','T','');
insert  into `abs_status`(`id`,`EmployeeID`,`awal`,`akhir`,`status`,`keterangan`,`updatex`) values (6,'H1-006','2017-01-04','2017-01-04','SAKIT','Q','');
insert  into `abs_status`(`id`,`EmployeeID`,`awal`,`akhir`,`status`,`keterangan`,`updatex`) values (7,'H1-006','2017-01-02','2017-01-04','SAKIT','4','');
insert  into `abs_status`(`id`,`EmployeeID`,`awal`,`akhir`,`status`,`keterangan`,`updatex`) values (12,'H1-003','2017-01-12','2017-01-14','SAKIT','2','');
insert  into `abs_status`(`id`,`EmployeeID`,`awal`,`akhir`,`status`,`keterangan`,`updatex`) values (14,'H1-003','2017-01-12','2017-01-15','IZIN','1','');
insert  into `abs_status`(`id`,`EmployeeID`,`awal`,`akhir`,`status`,`keterangan`,`updatex`) values (15,'H1-004','2017-01-10','2017-01-13','IZIN','1','');
insert  into `abs_status`(`id`,`EmployeeID`,`awal`,`akhir`,`status`,`keterangan`,`updatex`) values (16,'H1-002','2017-02-20','2017-02-20','IZIN','5656','');

/*Table structure for table `abs_x23_department` */

DROP TABLE IF EXISTS `abs_x23_department`;

CREATE TABLE `abs_x23_department` (
  `DepartmentID` varchar(10) NOT NULL,
  `DepartmentName` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`DepartmentID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `abs_x23_department` */

insert  into `abs_x23_department`(`DepartmentID`,`DepartmentName`) values ('1','DIVISI TES');

/*Table structure for table `abs_x23_employee` */

DROP TABLE IF EXISTS `abs_x23_employee`;

CREATE TABLE `abs_x23_employee` (
  `EmployeeID` varchar(15) NOT NULL,
  `FirstName` varchar(100) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `DepartmentID` varchar(10) DEFAULT NULL,
  `ScheduleID` varchar(10) DEFAULT NULL,
  `StartDate` datetime DEFAULT NULL,
  `Finger1` tinyint(4) DEFAULT NULL,
  `FingerData1` mediumblob,
  `Date1` datetime DEFAULT NULL,
  `Finger2` tinyint(4) DEFAULT NULL,
  `FingerData2` mediumblob,
  `Date2` datetime DEFAULT NULL,
  `PicturePath` varchar(250) DEFAULT NULL,
  `Rest` bit(1) DEFAULT NULL,
  `PIN` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`EmployeeID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `abs_x23_employee` */

insert  into `abs_x23_employee`(`EmployeeID`,`FirstName`,`LastName`,`DepartmentID`,`ScheduleID`,`StartDate`,`Finger1`,`FingerData1`,`Date1`,`Finger2`,`FingerData2`,`Date2`,`PicturePath`,`Rest`,`PIN`) values ('H2H3-001','ALEX IMC','','1','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'7606');
insert  into `abs_x23_employee`(`EmployeeID`,`FirstName`,`LastName`,`DepartmentID`,`ScheduleID`,`StartDate`,`Finger1`,`FingerData1`,`Date1`,`Finger2`,`FingerData2`,`Date2`,`PicturePath`,`Rest`,`PIN`) values ('H2H3-002','MEKANIK DUA',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
insert  into `abs_x23_employee`(`EmployeeID`,`FirstName`,`LastName`,`DepartmentID`,`ScheduleID`,`StartDate`,`Finger1`,`FingerData1`,`Date1`,`Finger2`,`FingerData2`,`Date2`,`PicturePath`,`Rest`,`PIN`) values ('H2H3-008','MEKANIK SATU',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
insert  into `abs_x23_employee`(`EmployeeID`,`FirstName`,`LastName`,`DepartmentID`,`ScheduleID`,`StartDate`,`Finger1`,`FingerData1`,`Date1`,`Finger2`,`FingerData2`,`Date2`,`PicturePath`,`Rest`,`PIN`) values ('H2H3-010','COUNTER PART',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
insert  into `abs_x23_employee`(`EmployeeID`,`FirstName`,`LastName`,`DepartmentID`,`ScheduleID`,`StartDate`,`Finger1`,`FingerData1`,`Date1`,`Finger2`,`FingerData2`,`Date2`,`PicturePath`,`Rest`,`PIN`) values ('H2H3-011','SALES ADVISOR',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
insert  into `abs_x23_employee`(`EmployeeID`,`FirstName`,`LastName`,`DepartmentID`,`ScheduleID`,`StartDate`,`Finger1`,`FingerData1`,`Date1`,`Finger2`,`FingerData2`,`Date2`,`PicturePath`,`Rest`,`PIN`) values ('H2H3-012','KASIR',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
insert  into `abs_x23_employee`(`EmployeeID`,`FirstName`,`LastName`,`DepartmentID`,`ScheduleID`,`StartDate`,`Finger1`,`FingerData1`,`Date1`,`Finger2`,`FingerData2`,`Date2`,`PicturePath`,`Rest`,`PIN`) values ('H2H3-013','MEKANIK TIGA',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
insert  into `abs_x23_employee`(`EmployeeID`,`FirstName`,`LastName`,`DepartmentID`,`ScheduleID`,`StartDate`,`Finger1`,`FingerData1`,`Date1`,`Finger2`,`FingerData2`,`Date2`,`PicturePath`,`Rest`,`PIN`) values ('H2H3-014','KEPALA MEKANIK',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
insert  into `abs_x23_employee`(`EmployeeID`,`FirstName`,`LastName`,`DepartmentID`,`ScheduleID`,`StartDate`,`Finger1`,`FingerData1`,`Date1`,`Finger2`,`FingerData2`,`Date2`,`PicturePath`,`Rest`,`PIN`) values ('H2H3-015','MEKANIK EMPAT',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
insert  into `abs_x23_employee`(`EmployeeID`,`FirstName`,`LastName`,`DepartmentID`,`ScheduleID`,`StartDate`,`Finger1`,`FingerData1`,`Date1`,`Finger2`,`FingerData2`,`Date2`,`PicturePath`,`Rest`,`PIN`) values ('H2H3-017','KEPALA BENGKEL',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `abs_x23_result` */

DROP TABLE IF EXISTS `abs_x23_result`;

CREATE TABLE `abs_x23_result` (
  `EmployeeID` varchar(15) DEFAULT NULL,
  `Date` datetime NOT NULL,
  `ShiftID` varchar(10) DEFAULT NULL,
  `TimeScan1` datetime DEFAULT NULL,
  `MinComingOverTime` datetime DEFAULT NULL,
  `MaxComingOverTime` datetime DEFAULT NULL,
  `Time1` datetime DEFAULT NULL,
  `StartBreak` datetime DEFAULT NULL,
  `Break` datetime DEFAULT NULL,
  `EndBreak` datetime DEFAULT NULL,
  `Time2` datetime DEFAULT NULL,
  `MinBackOverTime` datetime DEFAULT NULL,
  `MaxBackOverTime` datetime DEFAULT NULL,
  `TimeScan2` datetime DEFAULT NULL,
  `Scan1` datetime DEFAULT NULL,
  `Scan2` datetime DEFAULT NULL,
  `Scan3` datetime DEFAULT NULL,
  `Scan4` datetime DEFAULT NULL,
  `TotalScan` tinyint(4) DEFAULT NULL,
  `Status` varchar(1) DEFAULT NULL,
  `StatusAbsence` varchar(3) DEFAULT NULL,
  `UserUpdateSchedule` varchar(20) DEFAULT NULL,
  `LastUpdateSchedule` datetime DEFAULT NULL,
  `UserUpdateScan` varchar(20) DEFAULT NULL,
  `LastUpdateScan` datetime DEFAULT NULL,
  `Notes` varchar(200) DEFAULT NULL,
  `Late` datetime DEFAULT NULL,
  `BreakDuration` datetime DEFAULT NULL,
  `BreakOver` datetime DEFAULT NULL,
  `TimeOfWork` datetime DEFAULT NULL,
  `ComingOverTime` datetime DEFAULT NULL,
  `BackOverTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `abs_x23_result` */

insert  into `abs_x23_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H2H3-001','2017-01-01 08:06:51','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-12-01 07:06:54','0000-00-00 00:00:00','0000-00-00 00:00:00','2017-01-01 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_x23_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H2H3-002','2017-01-01 08:06:52','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-12-01 07:06:54','0000-00-00 00:00:00','0000-00-00 00:00:00','2017-01-01 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_x23_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H2H3-008','2017-01-01 08:06:53','012072','0000-00-00 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-12-01 07:06:54','0000-00-00 00:00:00','0000-00-00 00:00:00','2017-01-01 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_x23_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H2H3-009','2017-01-01 07:06:54','012072','0000-00-00 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-12-01 07:06:54','0000-00-00 00:00:00','0000-00-00 00:00:00','2017-01-02 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_x23_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H2H3-010','2017-01-01 08:06:54','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-12-01 07:06:54','0000-00-00 00:00:00','0000-00-00 00:00:00','2017-01-01 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_x23_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H2H3-011','2017-01-01 08:06:54','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-12-01 07:06:54','0000-00-00 00:00:00','0000-00-00 00:00:00','2017-01-01 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_x23_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H2H3-012','2017-01-01 08:06:54','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-12-01 07:06:54','0000-00-00 00:00:00','0000-00-00 00:00:00','2017-01-01 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_x23_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H2H3-001','2017-01-02 08:06:51','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-05-03 08:06:51','0000-00-00 00:00:00','0000-00-00 00:00:00','2017-01-02 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_x23_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H2H3-002','2017-01-01 08:06:52','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-05-03 08:06:51','0000-00-00 00:00:00','0000-00-00 00:00:00','2017-01-02 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_x23_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H2H3-009','2017-01-02 07:06:54','012072','0000-00-00 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-12-02 07:06:54','0000-00-00 00:00:00','0000-00-00 00:00:00','2017-01-02 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_x23_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H2H3-010','2017-01-02 08:06:54','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-05-03 08:06:51','0000-00-00 00:00:00','0000-00-00 00:00:00','2017-01-02 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_x23_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H2H3-011','2017-01-02 08:06:54','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-05-03 08:06:51','0000-00-00 00:00:00','0000-00-00 00:00:00','2017-01-02 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_x23_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H2H3-012','2017-01-02 08:06:54','012072',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-05-03 08:06:51','0000-00-00 00:00:00','0000-00-00 00:00:00','2017-01-02 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_x23_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H2H3-008','2017-01-02 08:06:53','012072','0000-00-00 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-05-03 08:06:51','0000-00-00 00:00:00','0000-00-00 00:00:00','2017-01-02 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `abs_x23_result`(`EmployeeID`,`Date`,`ShiftID`,`TimeScan1`,`MinComingOverTime`,`MaxComingOverTime`,`Time1`,`StartBreak`,`Break`,`EndBreak`,`Time2`,`MinBackOverTime`,`MaxBackOverTime`,`TimeScan2`,`Scan1`,`Scan2`,`Scan3`,`Scan4`,`TotalScan`,`Status`,`StatusAbsence`,`UserUpdateSchedule`,`LastUpdateSchedule`,`UserUpdateScan`,`LastUpdateScan`,`Notes`,`Late`,`BreakDuration`,`BreakOver`,`TimeOfWork`,`ComingOverTime`,`BackOverTime`) values ('H2H3-017','2017-02-27 08:06:53','012072','0000-00-00 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-05-03 08:06:51','0000-00-00 00:00:00','0000-00-00 00:00:00','2017-02-27 16:30:42',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','1899-12-30 08:24:00','0000-00-00 00:00:00','0000-00-00 00:00:00');

/*Table structure for table `abs_x23_status` */

DROP TABLE IF EXISTS `abs_x23_status`;

CREATE TABLE `abs_x23_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `EmployeeID` varchar(200) DEFAULT NULL,
  `awal` date DEFAULT NULL,
  `akhir` date DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `keterangan` varchar(20) NOT NULL,
  `updatex` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `abs_x23_status` */

insert  into `abs_x23_status`(`id`,`EmployeeID`,`awal`,`akhir`,`status`,`keterangan`,`updatex`) values (2,'H2H3-010','2017-02-03','2017-02-04','IZIN','QWERTY','');

/*Table structure for table `daemons` */

DROP TABLE IF EXISTS `daemons`;

CREATE TABLE `daemons` (
  `Start` text NOT NULL,
  `Info` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `daemons` */

/*Table structure for table `gammu` */

DROP TABLE IF EXISTS `gammu`;

CREATE TABLE `gammu` (
  `Version` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `gammu` */

insert  into `gammu`(`Version`) values (10);

/*Table structure for table `identitas` */

DROP TABLE IF EXISTS `identitas`;

CREATE TABLE `identitas` (
  `nama` text NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `identitas` */

insert  into `identitas`(`nama`,`alamat`) values ('','');

/*Table structure for table `inbox` */

DROP TABLE IF EXISTS `inbox`;

CREATE TABLE `inbox` (
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ReceivingDateTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Text` text NOT NULL,
  `SenderNumber` varchar(20) NOT NULL DEFAULT '',
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text NOT NULL,
  `SMSCNumber` varchar(20) NOT NULL DEFAULT '',
  `Class` int(11) NOT NULL DEFAULT '-1',
  `TextDecoded` varchar(160) NOT NULL DEFAULT '',
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `RecipientID` text NOT NULL,
  `Processed` enum('false','true') NOT NULL DEFAULT 'false',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `inbox` */

insert  into `inbox`(`UpdatedInDB`,`ReceivingDateTime`,`Text`,`SenderNumber`,`Coding`,`UDH`,`SMSCNumber`,`Class`,`TextDecoded`,`ID`,`RecipientID`,`Processed`) values ('2017-03-10 14:01:04','2017-03-10 14:00:49','0038006D006A00670074','+6282186371866','Default_No_Compression','','+6281107908',-1,'8mjgt',1,'MyPhone1','false');

/*Table structure for table `kd_kabupaten` */

DROP TABLE IF EXISTS `kd_kabupaten`;

CREATE TABLE `kd_kabupaten` (
  `kodekab` varchar(20) NOT NULL,
  `namakab` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`kodekab`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `kd_kabupaten` */

insert  into `kd_kabupaten`(`kodekab`,`namakab`) values ('BK','BANGKALAN');
insert  into `kd_kabupaten`(`kodekab`,`namakab`) values ('PM','PAMEKASAN');
insert  into `kd_kabupaten`(`kodekab`,`namakab`) values ('SA','SAMPANG');
insert  into `kd_kabupaten`(`kodekab`,`namakab`) values ('SU','SUMENEP');

/*Table structure for table `kd_kecamatan` */

DROP TABLE IF EXISTS `kd_kecamatan`;

CREATE TABLE `kd_kecamatan` (
  `kodekab` varchar(20) NOT NULL,
  `kodekec` varchar(20) NOT NULL,
  `namakec` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `kd_kecamatan` */

insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('BK','01','AROSBAYA');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('BK','02','BANGKALAN');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('BK','03','BLEGA');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('BK','04','BURNEH');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('BK','05','GALIS');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('BK','06','GEGER');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('BK','07','KAMAL');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('BK','08','KLAMPIS');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('BK','09','KOKOP');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('BK','10','KONANG');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('BK','11','KWANYAR');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('BK','12','LABANG');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('BK','13','MODUNG');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('BK','14','SEPULU');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('BK','15','SOCAH');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('BK','16','TANAH MERAH');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('BK','17','TANJUNGBUMI');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('BK','18','TRAGAH');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('PM','01','BATUMARMAR');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('PM','02','GALIS');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('PM','03','KADUR');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('PM','04','LARANGAN');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('PM','05','PADEMAWU');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('PM','06','PAKONG');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('PM','07','PALENGAAN');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('PM','08','PAMEKASAN');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('PM','09','PASEAN');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('PM','10','PEGANTENAN');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('PM','11','PROPPO');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('PM','12','TLANAKAN');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('PM','13','WARU');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('SA','01','BANYUATES');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('SA','02','CAMPLONG');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('SA','03','JRENGIK');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('SA','04','KARANG PENANG');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('SA','05','KEDUNGDUNG');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('SA','06','KETAPANG');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('SA','07','OMBEN');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('SA','08','PANGARENGAN');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('SA','09','ROBATAL');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('SA','10','SAMPANG');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('SA','11','SOKOBANAH');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('SA','12','SRESEH');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('SA','13','TAMBELANGAN');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('SA','14','TORJUN');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('SU','01','AMBUNTEN');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('SU','02','ARJASA');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('SU','03','BATANG BATANG');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('SU','04','BATUAN');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('SU','05','BATUPUTIH');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('SU','06','BLUTO');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('SU','07','DASUK');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('SU','08','DUNGKEK');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('SU','09','GANDING');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('SU','10','GAPURA');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('SU','11','GAYAM');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('SU','12','GILI GINTING ');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('SU','13','GULUK GULUK');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('SU','14','KALIANGET');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('SU','15','KANGAYAN');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('SU','16','KOTA SUMENEP');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('SU','17','LENTENG');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('SU','18','MANDING');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('SU','19','MASALEMBU');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('SU','20','NONGGUNONG');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('SU','21','PASONGSONGAN');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('SU','22','PRAGAAN');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('SU','23','RAAS');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('SU','24','RUBARU');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('SU','25','SAPEKEN');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('SU','26','SARONGGI');
insert  into `kd_kecamatan`(`kodekab`,`kodekec`,`namakec`) values ('SU','27','TALANGO');

/*Table structure for table `kd_kelurahan` */

DROP TABLE IF EXISTS `kd_kelurahan`;

CREATE TABLE `kd_kelurahan` (
  `kode` varchar(200) NOT NULL,
  `kodekab` varchar(20) NOT NULL,
  `namakab` varchar(200) NOT NULL,
  `kodekec` varchar(20) NOT NULL,
  `namakec` varchar(200) NOT NULL,
  `kodekel` varchar(20) NOT NULL,
  `namakel` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `kd_kelurahan` */

insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.01.01','BK','BANGKALAN','01','AROSBAYA','01','AROSBAYA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.01.02','BK','BANGKALAN','01','AROSBAYA','02','BALUNG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.01.03','BK','BANGKALAN','01','AROSBAYA','03','BATONAONG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.01.04','BK','BANGKALAN','01','AROSBAYA','04','BERBELUK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.01.05','BK','BANGKALAN','01','AROSBAYA','05','BUDURAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.01.06','BK','BANGKALAN','01','AROSBAYA','06','CENDAGAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.01.07','BK','BANGKALAN','01','AROSBAYA','07','DLEMER');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.01.08','BK','BANGKALAN','01','AROSBAYA','08','GLAGAH (GLAGGA)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.01.09','BK','BANGKALAN','01','AROSBAYA','09','KARANG DUWAK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.01.10','BK','BANGKALAN','01','AROSBAYA','10','KARANG PAO');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.01.11','BK','BANGKALAN','01','AROSBAYA','11','LAJING');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.01.12','BK','BANGKALAN','01','AROSBAYA','12','MAKAM AGUNG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.01.13','BK','BANGKALAN','01','AROSBAYA','13','MANGKON');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.01.14','BK','BANGKALAN','01','AROSBAYA','14','OMBUL');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.01.15','BK','BANGKALAN','01','AROSBAYA','15','PANDAN LANJANG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.01.16','BK','BANGKALAN','01','AROSBAYA','16','PLAKARAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.01.17','BK','BANGKALAN','01','AROSBAYA','17','TAMBEGAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.01.18','BK','BANGKALAN','01','AROSBAYA','18','TENGKET');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.02.01','BK','BANGKALAN','02','BANGKALAN','01','BANCARAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.02.02','BK','BANGKALAN','02','BANGKALAN','02','PEJAGAN (PAJAGAN)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.02.03','BK','BANGKALAN','02','BANGKALAN','03','SABIYAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.02.04','BK','BANGKALAN','02','BANGKALAN','04','GEBANG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.02.05','BK','BANGKALAN','02','BANGKALAN','05','DEMANGAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.02.06','BK','BANGKALAN','02','BANGKALAN','06','PANGERANAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.02.07','BK','BANGKALAN','02','BANGKALAN','07','KEMAYORAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.02.08','BK','BANGKALAN','02','BANGKALAN','08','MLAJAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.02.09','BK','BANGKALAN','02','BANGKALAN','09','SEMBILANGAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.02.10','BK','BANGKALAN','02','BANGKALAN','10','UJUNG PIRING');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.02.11','BK','BANGKALAN','02','BANGKALAN','11','KERATON');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.02.12','BK','BANGKALAN','02','BANGKALAN','12','KRAMAT (KERAMAT)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.02.13','BK','BANGKALAN','02','BANGKALAN','13','MERTAJASAH (MARTAJASAH)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.03.01','BK','BANGKALAN','03','BLEGA','01','ALASRAJA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.03.02','BK','BANGKALAN','03','BLEGA','02','BATES');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.03.03','BK','BANGKALAN','03','BLEGA','03','BLEGA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.03.04','BK','BANGKALAN','03','BLEGA','04','BLEGAOLOH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.03.05','BK','BANGKALAN','03','BLEGA','05','GIGIR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.03.06','BK','BANGKALAN','03','BLEGA','06','KAJAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.03.07','BK','BANGKALAN','03','BLEGA','07','KAMPAO');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.03.08','BK','BANGKALAN','03','BLEGA','08','KARANG GAYAM');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.03.09','BK','BANGKALAN','03','BLEGA','09','KARANG PANASAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.03.10','BK','BANGKALAN','03','BLEGA','10','KARANGNANGKA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.03.11','BK','BANGKALAN','03','BLEGA','11','KARPOTE');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.03.12','BK','BANGKALAN','03','BLEGA','12','KOJOLAN (KO\'OLAN)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.03.13','BK','BANGKALAN','03','BLEGA','13','LOMAER');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.03.14','BK','BANGKALAN','03','BLEGA','14','LOMBANG DAYA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.03.15','BK','BANGKALAN','03','BLEGA','15','LOMBANG LAOK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.03.16','BK','BANGKALAN','03','BLEGA','16','NYOR MANIS (NYORMANES)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.03.17','BK','BANGKALAN','03','BLEGA','17','PANGERAN GEDUNGAN (GADUNGAN)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.03.18','BK','BANGKALAN','03','BLEGA','18','PANJALINAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.03.19','BK','BANGKALAN','03','BLEGA','19','ROSEP');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.04.01','BK','BANGKALAN','04','BURNEH','01','ALAS KEMBANG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.04.02','BK','BANGKALAN','04','BURNEH','02','AROK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.04.03','BK','BANGKALAN','04','BURNEH','03','BENANGKAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.04.04','BK','BANGKALAN','04','BURNEH','04','BINOH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.04.05','BK','BANGKALAN','04','BURNEH','05','BURNEH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.04.06','BK','BANGKALAN','04','BURNEH','06','JAMBU');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.04.07','BK','BANGKALAN','04','BURNEH','07','KAPOR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.04.08','BK','BANGKALAN','04','BURNEH','08','LANGKAP');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.04.09','BK','BANGKALAN','04','BURNEH','09','PANGOLANGAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.04.10','BK','BANGKALAN','04','BURNEH','10','PERRENG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.04.11','BK','BANGKALAN','04','BURNEH','11','SOBIH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.04.12','BK','BANGKALAN','04','BURNEH','12','TONJUNG (TUNJUNG)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.05.01','BK','BANGKALAN','05','GALIS','01','BANGPENDAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.05.02','BK','BANGKALAN','05','GALIS','02','BANJAR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.05.03','BK','BANGKALAN','05','GALIS','03','BANYUBUNIH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.05.04','BK','BANGKALAN','05','GALIS','04','BELATERAN (BLATERAN)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.05.05','BK','BANGKALAN','05','GALIS','05','DALEMAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.05.06','BK','BANGKALAN','05','GALIS','06','GALIS');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.05.07','BK','BANGKALAN','05','GALIS','07','KAJUANAK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.05.08','BK','BANGKALAN','05','GALIS','08','KELBUNG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.05.09','BK','BANGKALAN','05','GALIS','09','KRANGGAN TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.05.10','BK','BANGKALAN','05','GALIS','10','LANTEK BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.05.11','BK','BANGKALAN','05','GALIS','11','LANTEK TEMOR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.05.12','BK','BANGKALAN','05','GALIS','12','LONGKEK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.05.13','BK','BANGKALAN','05','GALIS','13','PAKA\'AN LAOK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.05.14','BK','BANGKALAN','05','GALIS','14','PAKAAN DAYA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.05.15','BK','BANGKALAN','05','GALIS','15','PATERONGAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.05.16','BK','BANGKALAN','05','GALIS','16','PEKADAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.05.17','BK','BANGKALAN','05','GALIS','17','SADAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.05.18','BK','BANGKALAN','05','GALIS','18','SEPARAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.05.19','BK','BANGKALAN','05','GALIS','19','SORPA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.05.20','BK','BANGKALAN','05','GALIS','20','TELAGAH (TLAGAH)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.05.21','BK','BANGKALAN','05','GALIS','21','TELLOK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.06.01','BK','BANGKALAN','06','GEGER','01','BANYONENG DAJAH (BAYONENG)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.06.02','BK','BANGKALAN','06','GEGER','02','BANYONENG LAOK (BAYONENG)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.06.03','BK','BANGKALAN','06','GEGER','03','BATOBELLA (BATOBELLE)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.06.04','BK','BANGKALAN','06','GEGER','04','CAMPOR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.06.05','BK','BANGKALAN','06','GEGER','05','DABUNG (DEBUNG)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.06.06','BK','BANGKALAN','06','GEGER','06','GEGER');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.06.07','BK','BANGKALAN','06','GEGER','07','KAMPAK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.06.08','BK','BANGKALAN','06','GEGER','08','KATOL BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.06.09','BK','BANGKALAN','06','GEGER','09','KOMBANGAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.06.10','BK','BANGKALAN','06','GEGER','10','KOMPOL');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.06.11','BK','BANGKALAN','06','GEGER','11','LERPAK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.06.12','BK','BANGKALAN','06','GEGER','12','TAGUBANG (TOGUBANG)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.06.13','BK','BANGKALAN','06','GEGER','13','TEGERPRIYAH (TEGARPRIYAH)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.07.01','BK','BANGKALAN','07','KAMAL','01','BINAJUH (BANYU AJUH)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.07.02','BK','BANGKALAN','07','KAMAL','02','GILI ANYAR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.07.03','BK','BANGKALAN','07','KAMAL','03','GILI BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.07.04','BK','BANGKALAN','07','KAMAL','04','GILI TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.07.05','BK','BANGKALAN','07','KAMAL','05','KAMAL');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.07.06','BK','BANGKALAN','07','KAMAL','06','KEBUN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.07.07','BK','BANGKALAN','07','KAMAL','07','PENDABAH (PENDEBEH)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.07.08','BK','BANGKALAN','07','KAMAL','08','TAJUNGAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.07.09','BK','BANGKALAN','07','KAMAL','09','TANJUNG JATI');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.07.10','BK','BANGKALAN','07','KAMAL','10','TELLANG (TELANG)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.08.01','BK','BANGKALAN','08','KLAMPIS','01','BANTEAN (BANTEYAN)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.08.02','BK','BANGKALAN','08','KLAMPIS','02','BATOR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.08.03','BK','BANGKALAN','08','KLAMPIS','03','BRAGANG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.08.04','BK','BANGKALAN','08','KLAMPIS','04','BULUK AGUNG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.08.05','BK','BANGKALAN','08','KLAMPIS','05','BULUNG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.08.06','BK','BANGKALAN','08','KLAMPIS','06','KARANG ASEM');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.08.07','BK','BANGKALAN','08','KLAMPIS','07','KLAMPIS BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.08.08','BK','BANGKALAN','08','KLAMPIS','08','KLAMPIS TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.08.09','BK','BANGKALAN','08','KLAMPIS','09','KO\'OL');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.08.10','BK','BANGKALAN','08','KLAMPIS','10','LARANGAN GLINTONG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.08.11','BK','BANGKALAN','08','KLAMPIS','11','LARANGAN SORJAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.08.12','BK','BANGKALAN','08','KLAMPIS','12','LERGUNONG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.08.13','BK','BANGKALAN','08','KLAMPIS','13','MANONGGAL');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.08.14','BK','BANGKALAN','08','KLAMPIS','14','MRANDUNG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.08.15','BK','BANGKALAN','08','KLAMPIS','15','MUARAH (MOARAH)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.08.16','BK','BANGKALAN','08','KLAMPIS','16','PANYAKSAGAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.08.17','BK','BANGKALAN','08','KLAMPIS','17','POLONGAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.08.18','BK','BANGKALAN','08','KLAMPIS','18','RA\'AS');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.08.19','BK','BANGKALAN','08','KLAMPIS','19','TENGGUN DAYA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.08.20','BK','BANGKALAN','08','KLAMPIS','20','TOBADDUNG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.08.21','BK','BANGKALAN','08','KLAMPIS','21','TOLBUK (TOLLUK)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.08.22','BK','BANGKALAN','08','KLAMPIS','22','TROGAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.09.01','BK','BANGKALAN','09','KOKOP','01','AMPARAAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.09.02','BK','BANGKALAN','09','KOKOP','02','BANDA SOLEH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.09.03','BK','BANGKALAN','09','KOKOP','03','BANDANG LAOK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.09.04','BK','BANGKALAN','09','KOKOP','04','BATOKOROGAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.09.05','BK','BANGKALAN','09','KOKOP','05','DUPOK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.09.06','BK','BANGKALAN','09','KOKOP','06','DURJAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.09.07','BK','BANGKALAN','09','KOKOP','07','KATOL TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.09.08','BK','BANGKALAN','09','KOKOP','08','KOKOP');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.09.09','BK','BANGKALAN','09','KOKOP','09','LEMBUNG GUNUNG/GUNONG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.09.10','BK','BANGKALAN','09','KOKOP','10','MANDUNG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.09.11','BK','BANGKALAN','09','KOKOP','11','MANO\'AN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.09.12','BK','BANGKALAN','09','KOKOP','12','TLOKOH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.09.13','BK','BANGKALAN','09','KOKOP','13','TRAMOK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.10.01','BK','BANGKALAN','10','KONANG','01','BANDUNG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.10.02','BK','BANGKALAN','10','KONANG','02','BATOKABAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.10.03','BK','BANGKALAN','10','KONANG','03','CAMPOR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.10.04','BK','BANGKALAN','10','KONANG','04','CANGKARMAN (CANGKAREMAN)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.10.05','BK','BANGKALAN','10','KONANG','05','DURIN BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.10.06','BK','BANGKALAN','10','KONANG','06','DURIN TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.10.07','BK','BANGKALAN','10','KONANG','07','GALIS DAYA/DAJAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.10.08','BK','BANGKALAN','10','KONANG','08','GENTENG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.10.09','BK','BANGKALAN','10','KONANG','09','KANEGARAH (KANAGEREH)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.10.10','BK','BANGKALAN','10','KONANG','10','KONANG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.10.11','BK','BANGKALAN','10','KONANG','11','PAKES');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.10.12','BK','BANGKALAN','10','KONANG','12','SAMBIYAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.10.13','BK','BANGKALAN','10','KONANG','13','SEN ASEN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.11.01','BK','BANGKALAN','11','KWANYAR','01','BATAH BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.11.02','BK','BANGKALAN','11','KWANYAR','02','BATAH TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.11.03','BK','BANGKALAN','11','KWANYAR','03','DLEMER');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.11.04','BK','BANGKALAN','11','KWANYAR','04','DUWEK BUTER');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.11.05','BK','BANGKALAN','11','KWANYAR','05','GUNONG/GUNUNG SERENG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.11.06','BK','BANGKALAN','11','KWANYAR','06','JANTEH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.11.07','BK','BANGKALAN','11','KWANYAR','07','KARANG ANYAR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.11.08','BK','BANGKALAN','11','KWANYAR','08','KARANG ENTANG/GENTANG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.11.09','BK','BANGKALAN','11','KWANYAR','09','KETETANG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.11.10','BK','BANGKALAN','11','KWANYAR','10','KWANYAR BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.11.11','BK','BANGKALAN','11','KWANYAR','11','MOROMBUH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.11.12','BK','BANGKALAN','11','KWANYAR','12','PANDANAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.11.13','BK','BANGKALAN','11','KWANYAR','13','PAORAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.11.14','BK','BANGKALAN','11','KWANYAR','14','PASANGGRAHAN (PESANGGRAHAN)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.11.15','BK','BANGKALAN','11','KWANYAR','15','SUMUR KUNING (SOMOR KONENG)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.11.16','BK','BANGKALAN','11','KWANYAR','16','TEBUL');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.12.01','BK','BANGKALAN','12','LABANG','01','BA\'ENGAS');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.12.02','BK','BANGKALAN','12','LABANG','02','BRINGIN (BRINGEN)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.12.03','BK','BANGKALAN','12','LABANG','03','BUNAJIH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.12.04','BK','BANGKALAN','12','LABANG','04','JUKONG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.12.05','BK','BANGKALAN','12','LABANG','05','KESEK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.12.06','BK','BANGKALAN','12','LABANG','06','LABANG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.12.07','BK','BANGKALAN','12','LABANG','07','MORKEPEK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.12.08','BK','BANGKALAN','12','LABANG','08','PANGPONG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.12.09','BK','BANGKALAN','12','LABANG','09','PETAPAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.12.10','BK','BANGKALAN','12','LABANG','10','SENDANG DAYA/DAJAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.12.11','BK','BANGKALAN','12','LABANG','11','SENDANG LAOK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.12.12','BK','BANGKALAN','12','LABANG','12','SUKOLILO BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.12.13','BK','BANGKALAN','12','LABANG','13','SUKOLILO TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.13.01','BK','BANGKALAN','13','MODUNG','01','ALASKOKON');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.13.02','BK','BANGKALAN','13','MODUNG','02','BRAKAS DAJAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.13.03','BK','BANGKALAN','13','MODUNG','03','GLISGIS (GLIGIS)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.13.04','BK','BANGKALAN','13','MODUNG','04','KARANGANYAR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.13.05','BK','BANGKALAN','13','MODUNG','05','KOLLA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.13.06','BK','BANGKALAN','13','MODUNG','06','LANGPANGGANG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.13.07','BK','BANGKALAN','13','MODUNG','07','MANGGAAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.13.08','BK','BANGKALAN','13','MODUNG','08','MODUNG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.13.09','BK','BANGKALAN','13','MODUNG','09','NEROH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.13.10','BK','BANGKALAN','13','MODUNG','10','PAENG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.13.11','BK','BANGKALAN','13','MODUNG','11','PAKONG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.13.12','BK','BANGKALAN','13','MODUNG','12','PANGPAJUNG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.13.13','BK','BANGKALAN','13','MODUNG','13','PATENGTENG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.13.14','BK','BANGKALAN','13','MODUNG','14','PATEREMAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.13.15','BK','BANGKALAN','13','MODUNG','15','SRABI/SERABI BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.13.16','BK','BANGKALAN','13','MODUNG','16','SRABI/SERABI TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.13.17','BK','BANGKALAN','13','MODUNG','17','SUWAAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.14.01','BK','BANGKALAN','14','SEPULU','01','BANGSEREH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.14.02','BK','BANGKALAN','14','SEPULU','02','BANYIOR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.14.03','BK','BANGKALAN','14','SEPULU','03','GANGSEYAN (GENGSEYAN)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.14.04','BK','BANGKALAN','14','SEPULU','04','GUNELAP (GENELAP)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.14.05','BK','BANGKALAN','14','SEPULU','05','KELBUNG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.14.06','BK','BANGKALAN','14','SEPULU','06','KLABETAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.14.07','BK','BANGKALAN','14','SEPULU','07','KLAPAYAN (KLAPAIAN)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.14.08','BK','BANGKALAN','14','SEPULU','08','LABUHAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.14.09','BK','BANGKALAN','14','SEPULU','09','LEMBUNG PASESER');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.14.10','BK','BANGKALAN','14','SEPULU','10','MANERON');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.14.11','BK','BANGKALAN','14','SEPULU','11','PRANCAK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.14.12','BK','BANGKALAN','14','SEPULU','12','SAPLASAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.14.13','BK','BANGKALAN','14','SEPULU','13','SEPULU');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.14.14','BK','BANGKALAN','14','SEPULU','14','TANAH GURAH BARAT (TANAGURA BARAT)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.14.15','BK','BANGKALAN','14','SEPULU','15','TANAH GURAH TEMOR (TANAGURA TIMUR)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.15.01','BK','BANGKALAN','15','SOCAH','01','BILAPORAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.15.02','BK','BANGKALAN','15','SOCAH','02','BULUH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.15.03','BK','BANGKALAN','15','SOCAH','03','DAKIRING');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.15.04','BK','BANGKALAN','15','SOCAH','04','JADDIH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.15.05','BK','BANGKALAN','15','SOCAH','05','JUNGANYAR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.15.06','BK','BANGKALAN','15','SOCAH','06','KELEYAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.15.07','BK','BANGKALAN','15','SOCAH','07','PARSEH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.15.08','BK','BANGKALAN','15','SOCAH','08','PERNAJUH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.15.09','BK','BANGKALAN','15','SOCAH','09','PETAONAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.15.10','BK','BANGKALAN','15','SOCAH','10','SANGGRA/SANGGAR AGUNG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.15.11','BK','BANGKALAN','15','SOCAH','11','SOCAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.16.01','BK','BANGKALAN','16','TANAH MERAH','01','BAIPAJUNG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.16.02','BK','BANGKALAN','16','TANAH MERAH','02','BASANAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.16.03','BK','BANGKALAN','16','TANAH MERAH','03','BATANGAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.16.04','BK','BANGKALAN','16','TANAH MERAH','04','BUDDAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.16.05','BK','BANGKALAN','16','TANAH MERAH','05','DLAMBAH DAJAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.16.06','BK','BANGKALAN','16','TANAH MERAH','06','DLAMBAH LAOK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.16.07','BK','BANGKALAN','16','TANAH MERAH','07','DUMAJAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.16.08','BK','BANGKALAN','16','TANAH MERAH','08','JANGKAR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.16.09','BK','BANGKALAN','16','TANAH MERAH','09','KENDABAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.16.10','BK','BANGKALAN','16','TANAH MERAH','10','KRANGGAN BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.16.11','BK','BANGKALAN','16','TANAH MERAH','11','LANDAK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.16.12','BK','BANGKALAN','16','TANAH MERAH','12','MRECAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.16.13','BK','BANGKALAN','16','TANAH MERAH','13','PACENTAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.16.14','BK','BANGKALAN','16','TANAH MERAH','14','PADURUNGAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.16.15','BK','BANGKALAN','16','TANAH MERAH','15','PANGELEYAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.16.16','BK','BANGKALAN','16','TANAH MERAH','16','PATEMON');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.16.17','BK','BANGKALAN','16','TANAH MERAH','17','PETRAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.16.18','BK','BANGKALAN','16','TANAH MERAH','18','PETTONG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.16.19','BK','BANGKALAN','16','TANAH MERAH','19','POTER');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.16.20','BK','BANGKALAN','16','TANAH MERAH','20','RONGDURIN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.16.21','BK','BANGKALAN','16','TANAH MERAH','21','TANAH MERAH DAJAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.16.22','BK','BANGKALAN','16','TANAH MERAH','22','TANAH MERAH LAOK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.16.23','BK','BANGKALAN','16','TANAH MERAH','23','TLOMAR (TLOMOR)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.17.01','BK','BANGKALAN','17','TANJUNGBUMI','01','AENG TABAR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.17.02','BK','BANGKALAN','17','TANJUNGBUMI','02','BANDANG DAYAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.17.03','BK','BANGKALAN','17','TANJUNGBUMI','03','BANYU SANGKAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.17.04','BK','BANGKALAN','17','TANJUNGBUMI','04','BUMI ANYAR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.17.05','BK','BANGKALAN','17','TANJUNGBUMI','05','BUNGKENG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.17.06','BK','BANGKALAN','17','TANJUNGBUMI','06','LARANGAN TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.17.07','BK','BANGKALAN','17','TANJUNGBUMI','07','MACAJAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.17.08','BK','BANGKALAN','17','TANJUNGBUMI','08','PASESEH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.17.09','BK','BANGKALAN','17','TANJUNGBUMI','09','PLANGGIRAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.17.10','BK','BANGKALAN','17','TANJUNGBUMI','10','TAGUNGGUH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.17.11','BK','BANGKALAN','17','TANJUNGBUMI','11','TAMBAK POCOK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.17.12','BK','BANGKALAN','17','TANJUNGBUMI','12','TANJUNG BUMI');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.17.13','BK','BANGKALAN','17','TANJUNGBUMI','13','TELAGA/TLAGA BIRU');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.17.14','BK','BANGKALAN','17','TANJUNGBUMI','14','TLANGOH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.18.01','BK','BANGKALAN','18','TRAGAH','01','ALANG ALANG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.18.02','BK','BANGKALAN','18','TRAGAH','02','BAJEMAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.18.03','BK','BANGKALAN','18','TRAGAH','03','BANCANG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.18.04','BK','BANGKALAN','18','TRAGAH','04','BANYU BESEH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.18.05','BK','BANGKALAN','18','TRAGAH','05','DUKOTAMBIN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.18.06','BK','BANGKALAN','18','TRAGAH','06','JAAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.18.07','BK','BANGKALAN','18','TRAGAH','07','JADDUNG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.18.08','BK','BANGKALAN','18','TRAGAH','08','KARANG LEMAN/LEMEN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.18.09','BK','BANGKALAN','18','TRAGAH','09','KEMONENG (KEMONING)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.18.10','BK','BANGKALAN','18','TRAGAH','10','KETELENG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.18.11','BK','BANGKALAN','18','TRAGAH','11','MASARAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.18.12','BK','BANGKALAN','18','TRAGAH','12','PACANGAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.18.13','BK','BANGKALAN','18','TRAGAH','13','PAMORAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.18.14','BK','BANGKALAN','18','TRAGAH','14','POCONG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.18.15','BK','BANGKALAN','18','TRAGAH','15','SOKET DAJAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.18.16','BK','BANGKALAN','18','TRAGAH','16','SOKET LAOK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.18.17','BK','BANGKALAN','18','TRAGAH','17','TAMBIN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('BK.18.18','BK','BANGKALAN','18','TRAGAH','18','TRAGAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.13.12','PM','PAMEKASAN','13','WARU','12','WARU TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.13.11','PM','PAMEKASAN','13','WARU','11','WARU BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.13.10','PM','PAMEKASAN','13','WARU','10','TLONTO ARES');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.13.09','PM','PAMEKASAN','13','WARU','09','TEGANGSER LAOK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.13.08','PM','PAMEKASAN','13','WARU','08','TAMPOJUNG TENGGINA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.13.07','PM','PAMEKASAN','13','WARU','07','TAMPOJUNG TENGAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.13.06','PM','PAMEKASAN','13','WARU','06','TAMPOJUNG PREGI');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.13.05','PM','PAMEKASAN','13','WARU','05','TAMPOJUNG GUWA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.13.04','PM','PAMEKASAN','13','WARU','04','SUMBER WARU');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.13.03','PM','PAMEKASAN','13','WARU','03','SANA LAOK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.13.01','PM','PAMEKASAN','13','WARU','01','BAJUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.13.02','PM','PAMEKASAN','13','WARU','02','RAGANG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.12.17','PM','PAMEKASAN','12','TLANAKAN','17','TLESA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.12.16','PM','PAMEKASAN','12','TLANAKAN','16','TLANAKAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.12.15','PM','PAMEKASAN','12','TLANAKAN','15','TERRAK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.12.14','PM','PAMEKASAN','12','TLANAKAN','14','TARO\'AN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.12.13','PM','PAMEKASAN','12','TLANAKAN','13','PANGLEGUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.12.12','PM','PAMEKASAN','12','TLANAKAN','12','MANGAR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.12.11','PM','PAMEKASAN','12','TLANAKAN','11','LARANGAN TOKOL');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.12.10','PM','PAMEKASAN','12','TLANAKAN','10','LARANGAN SLAMPAR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.12.09','PM','PAMEKASAN','12','TLANAKAN','09','KRAMAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.12.08','PM','PAMEKASAN','12','TLANAKAN','08','GUGUL');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.12.06','PM','PAMEKASAN','12','TLANAKAN','06','CEGUK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.12.07','PM','PAMEKASAN','12','TLANAKAN','07','DABUAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.12.05','PM','PAMEKASAN','12','TLANAKAN','05','BUKEK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.12.04','PM','PAMEKASAN','12','TLANAKAN','04','BRANTA TINGGI');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.12.03','PM','PAMEKASAN','12','TLANAKAN','03','BRANTA PASISIR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.12.02','PM','PAMEKASAN','12','TLANAKAN','02','BANDARAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.11.27','PM','PAMEKASAN','11','PROPPO','27','TOKET');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.12.01','PM','PAMEKASAN','12','TLANAKAN','01','AMBAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.11.26','PM','PAMEKASAN','11','PROPPO','26','TLANGOH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.11.25','PM','PAMEKASAN','11','PROPPO','25','TATTANGOH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.11.24','PM','PAMEKASAN','11','PROPPO','24','SRAMBAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.11.23','PM','PAMEKASAN','11','PROPPO','23','SAMIRAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.11.22','PM','PAMEKASAN','11','PROPPO','22','SAMATAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.11.21','PM','PAMEKASAN','11','PROPPO','21','RANG PERANG LAOK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.11.20','PM','PAMEKASAN','11','PROPPO','20','RANG PERANG DAYA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.11.19','PM','PAMEKASAN','11','PROPPO','19','PROPPO');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.11.18','PM','PAMEKASAN','11','PROPPO','18','PANGURAYAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.11.17','PM','PAMEKASAN','11','PROPPO','17','PANGTONGGAL');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.11.16','PM','PAMEKASAN','11','PROPPO','16','PANGLEMAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.11.14','PM','PAMEKASAN','11','PROPPO','14','PANAGUAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.11.15','PM','PAMEKASAN','11','PROPPO','15','PANGBATOK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.11.13','PM','PAMEKASAN','11','PROPPO','13','MAPPER');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.11.12','PM','PAMEKASAN','11','PROPPO','12','LENTENG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.11.11','PM','PAMEKASAN','11','PROPPO','11','KODIK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.11.10','PM','PAMEKASAN','11','PROPPO','10','KLAMPAR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.11.09','PM','PAMEKASAN','11','PROPPO','09','KARANGANYAR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.11.08','PM','PAMEKASAN','11','PROPPO','08','JAMBRINGIN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.11.07','PM','PAMEKASAN','11','PROPPO','07','GRO\'OM');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.11.06','PM','PAMEKASAN','11','PROPPO','06','CANDI BURUNG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.11.05','PM','PAMEKASAN','11','PROPPO','05','CAMPOR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.11.04','PM','PAMEKASAN','11','PROPPO','04','BILLA\'AN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.11.03','PM','PAMEKASAN','11','PROPPO','03','BATU KALANGAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.11.01','PM','PAMEKASAN','11','PROPPO','01','BADUNG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.11.02','PM','PAMEKASAN','11','PROPPO','02','BANYU BULU');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.10.13','PM','PAMEKASAN','10','PEGANTENAN','13','TLAGAH (TALAGAH)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.10.12','PM','PAMEKASAN','10','PEGANTENAN','12','TEBUL TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.10.11','PM','PAMEKASAN','10','PEGANTENAN','11','TEBUL BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.10.10','PM','PAMEKASAN','10','PEGANTENAN','10','TANJUNG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.10.09','PM','PAMEKASAN','10','PEGANTENAN','09','PLAKPAK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.10.08','PM','PAMEKASAN','10','PEGANTENAN','08','PEGANTENAN (PAGANTENAN)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.10.07','PM','PAMEKASAN','10','PEGANTENAN','07','PASANGGAR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.10.06','PM','PAMEKASAN','10','PEGANTENAN','06','PALESANGGAR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.10.05','PM','PAMEKASAN','10','PEGANTENAN','05','BULANGAN TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.10.04','PM','PAMEKASAN','10','PEGANTENAN','04','BULANGAN HAJI');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.10.03','PM','PAMEKASAN','10','PEGANTENAN','03','BULANGAN BRANTA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.10.02','PM','PAMEKASAN','10','PEGANTENAN','02','BULANGAN BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.10.01','PM','PAMEKASAN','10','PEGANTENAN','01','AMBENDER');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.09.09','PM','PAMEKASAN','09','PASEAN','09','TLONTORAJA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.09.08','PM','PAMEKASAN','09','PASEAN','08','TEGANGSER DAYA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.09.07','PM','PAMEKASAN','09','PASEAN','07','SOTOBAR (SOTABAR)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.09.06','PM','PAMEKASAN','09','PASEAN','06','SANA TENGAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.09.05','PM','PAMEKASAN','09','PASEAN','05','SANA DAJA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.09.04','PM','PAMEKASAN','09','PASEAN','04','DEMPO TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.09.03','PM','PAMEKASAN','09','PASEAN','03','DEMPO BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.09.02','PM','PAMEKASAN','09','PASEAN','02','BINDANG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.09.01','PM','PAMEKASAN','09','PASEAN','01','BATUKERBUY');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.08.18','PM','PAMEKASAN','08','PAMEKASAN','18','TORONAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.08.17','PM','PAMEKASAN','08','PAMEKASAN','17','TEJAH/TEJA TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.08.16','PM','PAMEKASAN','08','PAMEKASAN','16','TEJAH/TEJA BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.08.15','PM','PAMEKASAN','08','PAMEKASAN','15','PANEMPAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.08.14','PM','PAMEKASAN','08','PAMEKASAN','14','NYLABU LAOK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.08.13','PM','PAMEKASAN','08','PAMEKASAN','13','NYLABU DAYA/DAJA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.08.12','PM','PAMEKASAN','08','PAMEKASAN','12','LADEN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.08.11','PM','PAMEKASAN','08','PAMEKASAN','11','KOWEL');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.08.10','PM','PAMEKASAN','08','PAMEKASAN','10','KANGENAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.08.09','PM','PAMEKASAN','08','PAMEKASAN','09','JUNGCANGCANG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.08.08','PM','PAMEKASAN','08','PAMEKASAN','08','JALMAK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.08.07','PM','PAMEKASAN','08','PAMEKASAN','07','GLADAK ANYAR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.08.06','PM','PAMEKASAN','08','PAMEKASAN','06','BETTET');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.08.05','PM','PAMEKASAN','08','PAMEKASAN','05','BARURAMBAT KOTA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.08.04','PM','PAMEKASAN','08','PAMEKASAN','04','BUGIH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.08.03','PM','PAMEKASAN','08','PAMEKASAN','03','KOLPAJUNG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.08.02','PM','PAMEKASAN','08','PAMEKASAN','02','PATEMON');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.08.01','PM','PAMEKASAN','08','PAMEKASAN','01','PARTEKER');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.01.01','PM','PAMEKASAN','01','BATUMARMAR','01','BANGSEREH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.01.02','PM','PAMEKASAN','01','BATUMARMAR','02','BATU BINTANG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.01.03','PM','PAMEKASAN','01','BATUMARMAR','03','BLABAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.01.04','PM','PAMEKASAN','01','BATUMARMAR','04','BUJUR BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.01.05','PM','PAMEKASAN','01','BATUMARMAR','05','BUJUR TENGAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.01.06','PM','PAMEKASAN','01','BATUMARMAR','06','BUJUR TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.01.07','PM','PAMEKASAN','01','BATUMARMAR','07','KAPONG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.01.08','PM','PAMEKASAN','01','BATUMARMAR','08','LESONG DAJA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.01.09','PM','PAMEKASAN','01','BATUMARMAR','09','LESONG LAOK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.01.10','PM','PAMEKASAN','01','BATUMARMAR','10','PANGEREMAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.01.11','PM','PAMEKASAN','01','BATUMARMAR','11','PONJANAN BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.01.12','PM','PAMEKASAN','01','BATUMARMAR','12','PONJANAN TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.01.13','PM','PAMEKASAN','01','BATUMARMAR','13','TAMBERU');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.02.01','PM','PAMEKASAN','02','GALIS','01','ARTODUNG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.02.02','PM','PAMEKASAN','02','GALIS','02','BULAY');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.02.03','PM','PAMEKASAN','02','GALIS','03','GALIS');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.02.04','PM','PAMEKASAN','02','GALIS','04','KONANG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.02.05','PM','PAMEKASAN','02','GALIS','05','LEMBUNG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.02.06','PM','PAMEKASAN','02','GALIS','06','PAGENDINGAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.02.07','PM','PAMEKASAN','02','GALIS','07','PANDAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.02.08','PM','PAMEKASAN','02','GALIS','08','POLAGAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.02.09','PM','PAMEKASAN','02','GALIS','09','PONTEH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.02.10','PM','PAMEKASAN','02','GALIS','10','TOBUNGAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.03.01','PM','PAMEKASAN','03','KADUR','01','BANGKES');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.03.02','PM','PAMEKASAN','03','KADUR','02','BUNGBARUH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.03.03','PM','PAMEKASAN','03','KADUR','03','GAGAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.03.04','PM','PAMEKASAN','03','KADUR','04','KADUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.03.05','PM','PAMEKASAN','03','KADUR','05','KERTAGENA DAYA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.03.06','PM','PAMEKASAN','03','KADUR','06','KERTAGENA LAOK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.03.07','PM','PAMEKASAN','03','KADUR','07','KERTAGENA TENGAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.03.08','PM','PAMEKASAN','03','KADUR','08','PAMAROH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.03.09','PM','PAMEKASAN','03','KADUR','09','PAMOROH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.03.10','PM','PAMEKASAN','03','KADUR','10','SOKOLELAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.04.01','PM','PAMEKASAN','04','LARANGAN','01','BLUMBUNGAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.04.02','PM','PAMEKASAN','04','LARANGAN','02','DUKUH/DUKO TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.04.03','PM','PAMEKASAN','04','LARANGAN','03','GRUJUGAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.04.04','PM','PAMEKASAN','04','LARANGAN','04','KADUARA BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.04.05','PM','PAMEKASAN','04','LARANGAN','05','LANCAR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.04.06','PM','PAMEKASAN','04','LARANGAN','06','LARANGAN DALAM');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.04.07','PM','PAMEKASAN','04','LARANGAN','07','LARANGAN LUAR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.04.08','PM','PAMEKASAN','04','LARANGAN','08','MONTOK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.04.09','PM','PAMEKASAN','04','LARANGAN','09','PANAGUAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.04.10','PM','PAMEKASAN','04','LARANGAN','10','PELTONG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.04.11','PM','PAMEKASAN','04','LARANGAN','11','TARABAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.04.12','PM','PAMEKASAN','04','LARANGAN','12','TENTENAN BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.04.13','PM','PAMEKASAN','04','LARANGAN','13','TENTENAN TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.04.14','PM','PAMEKASAN','04','LARANGAN','14','TRASAK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.05.01','PM','PAMEKASAN','05','PADEMAWU','01','BARURAMBAT TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.05.02','PM','PAMEKASAN','05','PADEMAWU','02','BADDURIH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.05.03','PM','PAMEKASAN','05','PADEMAWU','03','BUDAGAN (BUDDAGAN)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.05.04','PM','PAMEKASAN','05','PADEMAWU','04','BUDDIH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.05.05','PM','PAMEKASAN','05','PADEMAWU','05','BUNDER');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.05.06','PM','PAMEKASAN','05','PADEMAWU','06','DASOK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.05.07','PM','PAMEKASAN','05','PADEMAWU','07','DURBUK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.05.08','PM','PAMEKASAN','05','PADEMAWU','08','JARIN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.05.09','PM','PAMEKASAN','05','PADEMAWU','09','LAWANGAN DAYA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.05.10','PM','PAMEKASAN','05','PADEMAWU','10','LEMPER');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.05.11','PM','PAMEKASAN','05','PADEMAWU','11','MAJUNGAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.05.12','PM','PAMEKASAN','05','PADEMAWU','12','MURTAJIH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.05.13','PM','PAMEKASAN','05','PADEMAWU','13','PADELEGAN (PEDELEGAN)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.05.14','PM','PAMEKASAN','05','PADEMAWU','14','PADEMAWU BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.05.15','PM','PAMEKASAN','05','PADEMAWU','15','PADEMAWU TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.05.16','PM','PAMEKASAN','05','PADEMAWU','16','PAGAGAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.05.17','PM','PAMEKASAN','05','PADEMAWU','17','PREKBUN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.05.18','PM','PAMEKASAN','05','PADEMAWU','18','SENTOL');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.05.19','PM','PAMEKASAN','05','PADEMAWU','19','SOPA\'AH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.05.20','PM','PAMEKASAN','05','PADEMAWU','20','SUMEDANGAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.05.21','PM','PAMEKASAN','05','PADEMAWU','21','TAMBUNG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.05.22','PM','PAMEKASAN','05','PADEMAWU','22','TANJUNG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.06.01','PM','PAMEKASAN','06','PAKONG','01','BAJANG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.06.02','PM','PAMEKASAN','06','PAKONG','02','BANBAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.06.03','PM','PAMEKASAN','06','PAKONG','03','BANDUNGAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.06.04','PM','PAMEKASAN','06','PAKONG','04','BICORONG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.06.05','PM','PAMEKASAN','06','PAKONG','05','CENLECEN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.06.06','PM','PAMEKASAN','06','PAKONG','06','KLOMPANG BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.06.07','PM','PAMEKASAN','06','PAKONG','07','KLOMPANG TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.06.08','PM','PAMEKASAN','06','PAKONG','08','LEBBEK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.06.09','PM','PAMEKASAN','06','PAKONG','09','PAKONG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.06.10','PM','PAMEKASAN','06','PAKONG','10','PALALANG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.06.11','PM','PAMEKASAN','06','PAKONG','11','SEDDUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.06.12','PM','PAMEKASAN','06','PAKONG','12','SOMALANG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.07.01','PM','PAMEKASAN','07','PALENGAAN','01','AKKOR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.07.02','PM','PAMEKASAN','07','PALENGAAN','02','ANGSANAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.07.03','PM','PAMEKASAN','07','PALENGAAN','03','BANYUPELLE');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.07.04','PM','PAMEKASAN','07','PALENGAAN','04','KACOK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.07.05','PM','PAMEKASAN','07','PALENGAAN','05','LARANGAN BADUNG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.07.06','PM','PAMEKASAN','07','PALENGAAN','06','PALENGAAN DAJA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.07.07','PM','PAMEKASAN','07','PALENGAAN','07','PALENGAAN LAOK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.07.08','PM','PAMEKASAN','07','PALENGAAN','08','PANAAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.07.09','PM','PAMEKASAN','07','PALENGAAN','09','POTOAN DAJA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.07.10','PM','PAMEKASAN','07','PALENGAAN','10','POTOAN LAOK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.07.11','PM','PAMEKASAN','07','PALENGAAN','11','REK KERREK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('PM.07.12','PM','PAMEKASAN','07','PALENGAAN','12','ROMBUH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.10.15','SA','SAMPANG','10','SAMPANG','15','PULAU MANDANGIN (MANDINGAN)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.10.14','SA','SAMPANG','10','SAMPANG','14','PEKALONGAN (PAKALONGAN)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.10.13','SA','SAMPANG','10','SAMPANG','13','PASEYAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.10.12','SA','SAMPANG','10','SAMPANG','12','PANGGUNG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.10.11','SA','SAMPANG','10','SAMPANG','11','PANGELEN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.10.10','SA','SAMPANG','10','SAMPANG','10','KARANG DALEM');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.10.09','SA','SAMPANG','10','SAMPANG','09','KAMONING');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.10.08','SA','SAMPANG','10','SAMPANG','08','GUNUNG SEKAR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.10.07','SA','SAMPANG','10','SAMPANG','07','GUNUNG MADDAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.10.06','SA','SAMPANG','10','SAMPANG','06','BARUH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.10.05','SA','SAMPANG','10','SAMPANG','05','BANYUMAS');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.10.04','SA','SAMPANG','10','SAMPANG','04','BANYUANYAR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.10.03','SA','SAMPANG','10','SAMPANG','03','AENG SAREH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.10.02','SA','SAMPANG','10','SAMPANG','02','POLAGAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.10.01','SA','SAMPANG','10','SAMPANG','01','DALPENANG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.09.09','SA','SAMPANG','09','ROBATAL','09','TRAGIH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.09.08','SA','SAMPANG','09','ROBATAL','08','TORJUNAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.09.07','SA','SAMPANG','09','ROBATAL','07','SAWAH TENGAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.09.06','SA','SAMPANG','09','ROBATAL','06','ROBATAL');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.09.05','SA','SAMPANG','09','ROBATAL','05','PANDIYANGAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.09.04','SA','SAMPANG','09','ROBATAL','04','LEPELLE');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.09.03','SA','SAMPANG','09','ROBATAL','03','JELGUNG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.09.02','SA','SAMPANG','09','ROBATAL','02','GUNUNG RANCAK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.09.01','SA','SAMPANG','09','ROBATAL','01','BAPELLE');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.08.06','SA','SAMPANG','08','PANGARENGAN','06','RAGUNG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.08.05','SA','SAMPANG','08','PANGARENGAN','05','PANYERANGAN (PANYIRANGAN)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.08.04','SA','SAMPANG','08','PANGARENGAN','04','PANGARENGAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.08.03','SA','SAMPANG','08','PANGARENGAN','03','PACANGGAAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.08.02','SA','SAMPANG','08','PANGARENGAN','02','GULBUNG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.08.01','SA','SAMPANG','08','PANGARENGAN','01','APAAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.07.20','SA','SAMPANG','07','OMBEN','20','TEMORAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.07.19','SA','SAMPANG','07','OMBEN','19','TAMBAK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.07.18','SA','SAMPANG','07','OMBEN','18','SOGIYAN (SOGIAN)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.07.17','SA','SAMPANG','07','OMBEN','17','RONGDALEM (RONGDALAM)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.07.16','SA','SAMPANG','07','OMBEN','16','RAPA LAOK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.07.15','SA','SAMPANG','07','OMBEN','15','RAPA DAYA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.07.14','SA','SAMPANG','07','OMBEN','14','PANDAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.07.13','SA','SAMPANG','07','OMBEN','13','OMBEN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.07.12','SA','SAMPANG','07','OMBEN','12','NAPOLAOK (NAPA LAOK)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.07.11','SA','SAMPANG','07','OMBEN','11','NAPO DAYA (NAPA DAYA)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.07.10','SA','SAMPANG','07','OMBEN','10','METENG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.07.09','SA','SAMPANG','07','OMBEN','09','MADULANG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.07.08','SA','SAMPANG','07','OMBEN','08','KEBUN SAREH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.07.07','SA','SAMPANG','07','OMBEN','07','KARANG NANGGER');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.07.06','SA','SAMPANG','07','OMBEN','06','KARANG GAYAM');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.07.05','SA','SAMPANG','07','OMBEN','05','KAMONDUNG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.07.04','SA','SAMPANG','07','OMBEN','04','JRANGOAN (JRANGUAN)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.07.03','SA','SAMPANG','07','OMBEN','03','GERSEMPAL');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.07.02','SA','SAMPANG','07','OMBEN','02','ASTAPAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.07.01','SA','SAMPANG','07','OMBEN','01','ANGSOKAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.06.14','SA','SAMPANG','06','KETAPANG','14','RABIYAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.06.13','SA','SAMPANG','06','KETAPANG','13','PAOPALELAOK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.06.12','SA','SAMPANG','06','KETAPANG','12','PAOPALE DAYA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.06.11','SA','SAMPANG','06','KETAPANG','11','PANGEREMAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.06.10','SA','SAMPANG','06','KETAPANG','10','PANCOR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.06.09','SA','SAMPANG','06','KETAPANG','09','KETAPANG TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.06.08','SA','SAMPANG','06','KETAPANG','08','KETAPANG LAOK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.06.07','SA','SAMPANG','06','KETAPANG','07','KETAPANG DAYA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.06.06','SA','SAMPANG','06','KETAPANG','06','KETAPANG BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.06.05','SA','SAMPANG','06','KETAPANG','05','KARANG ANYAR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.06.04','SA','SAMPANG','06','KETAPANG','04','BUNTEN TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.06.03','SA','SAMPANG','06','KETAPANG','03','BUNTEN BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.06.02','SA','SAMPANG','06','KETAPANG','02','BIRA BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.06.01','SA','SAMPANG','06','KETAPANG','01','BANYUSOKAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.05.18','SA','SAMPANG','05','KEDUNGDUNG','18','ROHAYU');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.05.17','SA','SAMPANG','05','KEDUNGDUNG','17','RABASAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.05.16','SA','SAMPANG','05','KEDUNGDUNG','16','PASARENAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.05.15','SA','SAMPANG','05','KEDUNGDUNG','15','PALENGGIYAN (PALENGGIAN)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.05.14','SA','SAMPANG','05','KEDUNGDUNG','14','PAJERUAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.05.13','SA','SAMPANG','05','KEDUNGDUNG','13','OMBUL');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.05.12','SA','SAMPANG','05','KEDUNGDUNG','12','NYELOH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.05.11','SA','SAMPANG','05','KEDUNGDUNG','11','MUKTESAREH (MOKTESAREH)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.05.10','SA','SAMPANG','05','KEDUNGDUNG','10','KRAMAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.05.09','SA','SAMPANG','05','KEDUNGDUNG','09','KOMIS');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.05.08','SA','SAMPANG','05','KEDUNGDUNG','08','KEDUNGDUNG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.05.07','SA','SAMPANG','05','KEDUNGDUNG','07','GUNUNG ELEH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.05.06','SA','SAMPANG','05','KEDUNGDUNG','06','DALEMAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.05.05','SA','SAMPANG','05','KEDUNGDUNG','05','BATOPORO TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.05.04','SA','SAMPANG','05','KEDUNGDUNG','04','BATOPORO BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.05.03','SA','SAMPANG','05','KEDUNGDUNG','03','BANYUKAPAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.05.02','SA','SAMPANG','05','KEDUNGDUNG','02','BANJAR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.05.01','SA','SAMPANG','05','KEDUNGDUNG','01','BAJRASOKAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.04.07','SA','SAMPANG','04','KARANG PENANG','07','TLAMBAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.04.06','SA','SAMPANG','04','KARANG PENANG','06','POREH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.04.05','SA','SAMPANG','04','KARANG PENANG','05','KARANG PENANG ONJUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.04.04','SA','SAMPANG','04','KARANG PENANG','04','KARANG PENANG OLOH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.04.03','SA','SAMPANG','04','KARANG PENANG','03','GUNUNG KESAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.04.02','SA','SAMPANG','04','KARANG PENANG','02','BULMATET');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.04.01','SA','SAMPANG','04','KARANG PENANG','01','BLUURAN (BLU URAN)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.03.14','SA','SAMPANG','03','JRENGIK','14','TAMAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.03.13','SA','SAMPANG','03','JRENGIK','13','PLAKARAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.03.12','SA','SAMPANG','03','JRENGIK','12','PANYEPEN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.03.11','SA','SAMPANG','03','JRENGIK','11','MLAKA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.03.10','SA','SAMPANG','03','JRENGIK','10','MARGANTOKO');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.03.09','SA','SAMPANG','03','JRENGIK','09','MAJANGAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.03.08','SA','SAMPANG','03','JRENGIK','08','KOTAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.03.07','SA','SAMPANG','03','JRENGIK','07','KALANGAN PRAO');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.03.06','SA','SAMPANG','03','JRENGIK','06','JUNGKARANG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.03.05','SA','SAMPANG','03','JRENGIK','05','JRENGIK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.03.04','SA','SAMPANG','03','JRENGIK','04','BUKER');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.03.03','SA','SAMPANG','03','JRENGIK','03','BANCELOK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.03.02','SA','SAMPANG','03','JRENGIK','02','ASEM RAJA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.03.01','SA','SAMPANG','03','JRENGIK','01','ASEM NONGGAL');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.02.14','SA','SAMPANG','02','CAMPLONG','14','TAMBAAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.02.13','SA','SAMPANG','02','CAMPLONG','13','TADDAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.02.12','SA','SAMPANG','02','CAMPLONG','12','SEJATI');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.02.11','SA','SAMPANG','02','CAMPLONG','11','RABASAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.02.10','SA','SAMPANG','02','CAMPLONG','10','PRAJJAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.02.09','SA','SAMPANG','02','CAMPLONG','09','PLAMPAAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.02.08','SA','SAMPANG','02','CAMPLONG','08','PAMOLAAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.02.07','SA','SAMPANG','02','CAMPLONG','07','MADUPAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.02.06','SA','SAMPANG','02','CAMPLONG','06','DHARMA TANJUNG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.02.05','SA','SAMPANG','02','CAMPLONG','05','DHARMA CAMPLONG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.02.04','SA','SAMPANG','02','CAMPLONG','04','BATU KARANG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.02.03','SA','SAMPANG','02','CAMPLONG','03','BANJAR TALELA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.02.02','SA','SAMPANG','02','CAMPLONG','02','BANJAR TABULU');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.02.01','SA','SAMPANG','02','CAMPLONG','01','ANGGERSEK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.01.20','SA','SAMPANG','01','BANYUATES','20','TRAPANG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.01.19','SA','SAMPANG','01','BANYUATES','19','TOLANG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.01.18','SA','SAMPANG','01','BANYUATES','18','TLAGAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.01.17','SA','SAMPANG','01','BANYUATES','17','TEROSAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.01.16','SA','SAMPANG','01','BANYUATES','16','TEBANAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.01.15','SA','SAMPANG','01','BANYUATES','15','TAPAAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.01.14','SA','SAMPANG','01','BANYUATES','14','PLANGGARAN TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.01.13','SA','SAMPANG','01','BANYUATES','13','PLANGGARAN BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.01.12','SA','SAMPANG','01','BANYUATES','12','OLOR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.01.11','SA','SAMPANG','01','BANYUATES','11','NEPA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.01.10','SA','SAMPANG','01','BANYUATES','10','NAGASAREH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.01.09','SA','SAMPANG','01','BANYUATES','09','MORBATOH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.01.08','SA','SAMPANG','01','BANYUATES','08','MONTOR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.01.07','SA','SAMPANG','01','BANYUATES','07','MASARAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.01.06','SA','SAMPANG','01','BANYUATES','06','LAR LAR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.01.05','SA','SAMPANG','01','BANYUATES','05','KEMBANG JERUK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.01.04','SA','SAMPANG','01','BANYUATES','04','JATRA TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.01.03','SA','SAMPANG','01','BANYUATES','03','BATIOH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.01.02','SA','SAMPANG','01','BANYUATES','02','BANYUATES');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.01.01','SA','SAMPANG','01','BANYUATES','01','ASEM JARAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.10.16','SA','SAMPANG','10','SAMPANG','16','RONG TENGAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.10.17','SA','SAMPANG','10','SAMPANG','17','TAMAN SAREH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.10.18','SA','SAMPANG','10','SAMPANG','18','TANGGUMONG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.11.01','SA','SAMPANG','11','SOKOBANAH','01','BIRA TENGAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.11.02','SA','SAMPANG','11','SOKOBANAH','02','BIRA TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.11.03','SA','SAMPANG','11','SOKOBANAH','03','SOKOBANAH DAYA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.11.04','SA','SAMPANG','11','SOKOBANAH','04','SOKOBANAH LAOK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.11.05','SA','SAMPANG','11','SOKOBANAH','05','SOKOBANAH TENGAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.11.06','SA','SAMPANG','11','SOKOBANAH','06','TAMBERU BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.11.07','SA','SAMPANG','11','SOKOBANAH','07','TAMBERU DAYA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.11.08','SA','SAMPANG','11','SOKOBANAH','08','TAMBERU LAOK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.11.09','SA','SAMPANG','11','SOKOBANAH','09','TAMBERU TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.11.10','SA','SAMPANG','11','SOKOBANAH','10','TOBAI BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.11.11','SA','SAMPANG','11','SOKOBANAH','11','TOBAI TENGAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.11.12','SA','SAMPANG','11','SOKOBANAH','12','TOBAI TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.12.01','SA','SAMPANG','12','SRESEH','01','BANGSAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.12.02','SA','SAMPANG','12','SRESEH','02','BUNDAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.12.03','SA','SAMPANG','12','SRESEH','03','DISANAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.12.04','SA','SAMPANG','12','SRESEH','04','JUNUK (JUNOK)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.12.05','SA','SAMPANG','12','SRESEH','05','KLOBUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.12.06','SA','SAMPANG','12','SRESEH','06','LABANG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.12.07','SA','SAMPANG','12','SRESEH','07','LABUHAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.12.08','SA','SAMPANG','12','SRESEH','08','MARPARAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.12.09','SA','SAMPANG','12','SRESEH','09','NOREH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.12.10','SA','SAMPANG','12','SRESEH','10','PLASAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.12.11','SA','SAMPANG','12','SRESEH','11','SRESEH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.12.12','SA','SAMPANG','12','SRESEH','12','TAMAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.13.01','SA','SAMPANG','13','TAMBELANGAN','01','BANJAR BILLAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.13.02','SA','SAMPANG','13','TAMBELANGAN','02','BARUNG GAGAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.13.03','SA','SAMPANG','13','TAMBELANGAN','03','BATORASANG (BATURASANG)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.13.04','SA','SAMPANG','13','TAMBELANGAN','04','BERINGIN (BRINGIN)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.13.03','SA','SAMPANG','13','TAMBELANGAN','05','BIREM');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.13.04','SA','SAMPANG','13','TAMBELANGAN','06','KARANG ANYAR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.13.05','SA','SAMPANG','13','TAMBELANGAN','07','MAMBULU BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.13.06','SA','SAMPANG','13','TAMBELANGAN','08','SAMARAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.13.05','SA','SAMPANG','13','TAMBELANGAN','09','SOMBER');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.13.06','SA','SAMPANG','13','TAMBELANGAN','10','TAMBELANGAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.14.01','SA','SAMPANG','14','TORJUN','01','BRINGIN NONGGAL');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.14.02','SA','SAMPANG','14','TORJUN','02','DULANG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.14.03','SA','SAMPANG','14','TORJUN','03','JERUK POROT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.14.04','SA','SAMPANG','14','TORJUN','04','KANJAR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.14.05','SA','SAMPANG','14','TORJUN','05','KARA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.14.06','SA','SAMPANG','14','TORJUN','06','KODAK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.14.07','SA','SAMPANG','14','TORJUN','07','KRAMPON');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.14.08','SA','SAMPANG','14','TORJUN','08','PANGONGSEAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.14.09','SA','SAMPANG','14','TORJUN','09','PATAPAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.14.10','SA','SAMPANG','14','TORJUN','10','PATARONGAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.14.11','SA','SAMPANG','14','TORJUN','11','TANAH MERAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SA.14.12','SA','SAMPANG','14','TORJUN','12','TORJUN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.01.01','SU','SUMENEP','01','AMBUNTEN','01','AMBUNTEN BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.01.02','SU','SUMENEP','01','AMBUNTEN','02','AMBUNTEN TENGAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.01.03','SU','SUMENEP','01','AMBUNTEN','03','AMBUNTEN TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.01.04','SU','SUMENEP','01','AMBUNTEN','04','BELUK ARES');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.01.05','SU','SUMENEP','01','AMBUNTEN','05','BELUK KENEK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.01.06','SU','SUMENEP','01','AMBUNTEN','06','BELUK RAJA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.01.07','SU','SUMENEP','01','AMBUNTEN','07','BUKABU');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.01.08','SU','SUMENEP','01','AMBUNTEN','08','CAMPOR BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.01.09','SU','SUMENEP','01','AMBUNTEN','09','CAMPOR TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.01.10','SU','SUMENEP','01','AMBUNTEN','10','KELES');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.01.11','SU','SUMENEP','01','AMBUNTEN','11','SOGIAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.01.12','SU','SUMENEP','01','AMBUNTEN','12','TAMBAAGUNG ARES');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.01.13','SU','SUMENEP','01','AMBUNTEN','13','TAMBAAGUNG BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.01.14','SU','SUMENEP','01','AMBUNTEN','14','TAMBAAGUNG TENGAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.01.15','SU','SUMENEP','01','AMBUNTEN','15','TAMBAAGUNG TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.02.01','SU','SUMENEP','02','ARJASA','01','ANGKATAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.02.02','SU','SUMENEP','02','ARJASA','02','ANGON ANGON');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.02.03','SU','SUMENEP','02','ARJASA','03','ARJASA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.02.04','SU','SUMENEP','02','ARJASA','04','BATUPUTIH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.02.05','SU','SUMENEP','02','ARJASA','05','BILIS BILIS');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.02.06','SU','SUMENEP','02','ARJASA','06','BUDDI');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.02.07','SU','SUMENEP','02','ARJASA','07','DUKO');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.02.08','SU','SUMENEP','02','ARJASA','08','GELAMAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.02.09','SU','SUMENEP','02','ARJASA','09','KALIKATAK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.02.10','SU','SUMENEP','02','ARJASA','10','KALINGANYAR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.02.11','SU','SUMENEP','02','ARJASA','11','KALISANGKA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.02.12','SU','SUMENEP','02','ARJASA','12','KANGAYAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.02.13','SU','SUMENEP','02','ARJASA','13','KOLO KOLO');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.02.14','SU','SUMENEP','02','ARJASA','14','LAOK JANGJANG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.02.15','SU','SUMENEP','02','ARJASA','15','PABIAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.02.16','SU','SUMENEP','02','ARJASA','16','PAJENANGGER');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.02.17','SU','SUMENEP','02','ARJASA','17','PANDEMAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.02.18','SU','SUMENEP','02','ARJASA','18','PASERAMAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.02.19','SU','SUMENEP','02','ARJASA','19','SAMBAKATI');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.02.20','SU','SUMENEP','02','ARJASA','20','SAWAHSUMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.02.21','SU','SUMENEP','02','ARJASA','21','SUMBERNANGKA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.03.01','SU','SUMENEP','03','BATANG BATANG','01','BANUAJU BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.03.02','SU','SUMENEP','03','BATANG BATANG','02','BANUAJU TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.03.03','SU','SUMENEP','03','BATANG BATANG','03','BATANGBATANG DAYA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.03.04','SU','SUMENEP','03','BATANG BATANG','04','BATANGBATANG LAOK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.03.05','SU','SUMENEP','03','BATANG BATANG','05','BILANGAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.03.06','SU','SUMENEP','03','BATANG BATANG','06','DAPENDA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.03.07','SU','SUMENEP','03','BATANG BATANG','07','JANGKONG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.03.08','SU','SUMENEP','03','BATANG BATANG','08','JENANGGER');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.03.09','SU','SUMENEP','03','BATANG BATANG','09','KOLPO');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.03.10','SU','SUMENEP','03','BATANG BATANG','10','LEGUNG BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.03.11','SU','SUMENEP','03','BATANG BATANG','11','LEGUNG TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.03.12','SU','SUMENEP','03','BATANG BATANG','12','LOMBANG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.03.13','SU','SUMENEP','03','BATANG BATANG','13','NYABAKAN BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.03.14','SU','SUMENEP','03','BATANG BATANG','14','NYABAKAN TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.03.15','SU','SUMENEP','03','BATANG BATANG','15','TAMEDUNG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.03.16','SU','SUMENEP','03','BATANG BATANG','16','TOTOSAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.04.01','SU','SUMENEP','04','BATUAN','01','BABALAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.04.02','SU','SUMENEP','04','BATUAN','02','BATUAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.04.03','SU','SUMENEP','04','BATUAN','03','GEDUNGAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.04.04','SU','SUMENEP','04','BATUAN','04','GELUGUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.04.05','SU','SUMENEP','04','BATUAN','05','GUNGGUNG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.04.06','SU','SUMENEP','04','BATUAN','06','PATEAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.04.07','SU','SUMENEP','04','BATUAN','07','TORBANG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.05.01','SU','SUMENEP','05','BATUPUTIH','01','AENGMERAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.05.02','SU','SUMENEP','05','BATUPUTIH','02','BADUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.05.03','SU','SUMENEP','05','BATUPUTIH','03','BANTELAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.05.04','SU','SUMENEP','05','BATUPUTIH','04','BATUPUTIH DAYA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.05.05','SU','SUMENEP','05','BATUPUTIH','05','BATUPUTIH KENEK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.05.06','SU','SUMENEP','05','BATUPUTIH','06','BATUPUTIH LAOK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.05.07','SU','SUMENEP','05','BATUPUTIH','07','BULAAN (BULLAAN)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.05.08','SU','SUMENEP','05','BATUPUTIH','08','GEDANG GEDANG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.05.09','SU','SUMENEP','05','BATUPUTIH','09','JURUAN DAYA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.05.10','SU','SUMENEP','05','BATUPUTIH','10','JURUAN LAOK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.05.11','SU','SUMENEP','05','BATUPUTIH','11','LARANGAN BARMA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.05.12','SU','SUMENEP','05','BATUPUTIH','12','LARANGAN KERTA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.05.13','SU','SUMENEP','05','BATUPUTIH','13','SERGANG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.05.14','SU','SUMENEP','05','BATUPUTIH','14','TENGEDAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.06.01','SU','SUMENEP','06','BLUTO','01','AENGBAJA KENEK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.06.02','SU','SUMENEP','06','BLUTO','02','AENGBAJA RAJA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.06.03','SU','SUMENEP','06','BLUTO','03','AENGDAKE');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.06.04','SU','SUMENEP','06','BLUTO','04','BLUTO');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.06.05','SU','SUMENEP','06','BLUTO','05','BUNGBUNGAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.06.06','SU','SUMENEP','06','BLUTO','06','ERRABU');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.06.07','SU','SUMENEP','06','BLUTO','07','GILANG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.06.08','SU','SUMENEP','06','BLUTO','08','GING GING');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.06.09','SU','SUMENEP','06','BLUTO','09','GULUKMANJUNG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.06.10','SU','SUMENEP','06','BLUTO','10','KAPEDI');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.06.11','SU','SUMENEP','06','BLUTO','11','KARANG CEMPAKA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.06.12','SU','SUMENEP','06','BLUTO','12','LOBUK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.06.13','SU','SUMENEP','06','BLUTO','13','MASARAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.06.14','SU','SUMENEP','06','BLUTO','14','PAKANDANGAN BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.06.15','SU','SUMENEP','06','BLUTO','15','PAKANDANGAN SANGRA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.06.16','SU','SUMENEP','06','BLUTO','16','PAKANDANGAN TENGAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.06.17','SU','SUMENEP','06','BLUTO','17','PALONGAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.06.18','SU','SUMENEP','06','BLUTO','18','SERA BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.06.19','SU','SUMENEP','06','BLUTO','19','SERA TENGAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.06.20','SU','SUMENEP','06','BLUTO','20','SERA TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.07.01','SU','SUMENEP','07','DASUK','01','BATES');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.07.02','SU','SUMENEP','07','DASUK','02','BATUBELAH BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.07.03','SU','SUMENEP','07','DASUK','03','BATUBELAH TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.07.04','SU','SUMENEP','07','DASUK','04','BRINGIN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.07.05','SU','SUMENEP','07','DASUK','05','DASUK BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.07.06','SU','SUMENEP','07','DASUK','06','DASUK LAOK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.07.07','SU','SUMENEP','07','DASUK','07','DASUK TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.07.08','SU','SUMENEP','07','DASUK','08','JELBUDAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.07.09','SU','SUMENEP','07','DASUK','09','KECER');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.07.10','SU','SUMENEP','07','DASUK','10','KERTA BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.07.11','SU','SUMENEP','07','DASUK','11','KERTA TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.07.12','SU','SUMENEP','07','DASUK','12','MANTAJUN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.07.13','SU','SUMENEP','07','DASUK','13','NYAPAR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.07.14','SU','SUMENEP','07','DASUK','14','SEMAAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.07.15','SU','SUMENEP','07','DASUK','15','SLOPENG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.08.01','SU','SUMENEP','08','DUNGKEK','01','BANCAMARA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.08.02','SU','SUMENEP','08','DUNGKEK','02','BANRAAS');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.08.03','SU','SUMENEP','08','DUNGKEK','03','BICABI');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.08.04','SU','SUMENEP','08','DUNGKEK','04','BUNGIN BUNGIN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.08.05','SU','SUMENEP','08','DUNGKEK','05','BUNPENANG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.08.06','SU','SUMENEP','08','DUNGKEK','06','CANDI');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.08.07','SU','SUMENEP','08','DUNGKEK','07','DUNGKEK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.08.08','SU','SUMENEP','08','DUNGKEK','08','JADUNG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.08.09','SU','SUMENEP','08','DUNGKEK','09','LAPA DAYA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.08.10','SU','SUMENEP','08','DUNGKEK','10','LAPA LAOK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.08.11','SU','SUMENEP','08','DUNGKEK','11','LAPA TAMAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.08.12','SU','SUMENEP','08','DUNGKEK','12','ROMBEN BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.08.13','SU','SUMENEP','08','DUNGKEK','13','ROMBEN GUNA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.08.14','SU','SUMENEP','08','DUNGKEK','14','ROMBEN RANA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.08.15','SU','SUMENEP','08','DUNGKEK','15','TAMANSARE');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.09.01','SU','SUMENEP','09','GANDING','01','BATAAL BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.09.02','SU','SUMENEP','09','GANDING','02','BATAAL TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.09.03','SU','SUMENEP','09','GANDING','03','BILAPORA BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.09.04','SU','SUMENEP','09','GANDING','04','BILAPORA TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.09.05','SU','SUMENEP','09','GANDING','05','GADU BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.09.06','SU','SUMENEP','09','GANDING','06','GADU TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.09.07','SU','SUMENEP','09','GANDING','07','GANDING');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.09.08','SU','SUMENEP','09','GANDING','08','KETAWANG DALEMAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.09.09','SU','SUMENEP','09','GANDING','09','KETAWANG KARAY');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.09.10','SU','SUMENEP','09','GANDING','10','KETAWANG LARANGAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.09.11','SU','SUMENEP','09','GANDING','11','KETAWANG PAREBAAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.09.12','SU','SUMENEP','09','GANDING','12','ROMBIYA BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.09.13','SU','SUMENEP','09','GANDING','13','ROMBIYA TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.09.14','SU','SUMENEP','09','GANDING','14','TALAGA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.10.01','SU','SUMENEP','10','GAPURA','01','ANDULANG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.10.02','SU','SUMENEP','10','GAPURA','02','BABAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.10.03','SU','SUMENEP','10','GAPURA','03','BANJAR BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.10.04','SU','SUMENEP','10','GAPURA','04','BANJAR TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.10.05','SU','SUMENEP','10','GAPURA','05','BATUDINDING');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.10.06','SU','SUMENEP','10','GAPURA','06','BERAJI');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.10.07','SU','SUMENEP','10','GAPURA','07','GAPURA BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.10.08','SU','SUMENEP','10','GAPURA','08','GAPURA TENGAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.10.09','SU','SUMENEP','10','GAPURA','09','GAPURA TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.10.10','SU','SUMENEP','10','GAPURA','10','GERSIK PUTIH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.10.11','SU','SUMENEP','10','GAPURA','11','GRUJUGAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.10.12','SU','SUMENEP','10','GAPURA','12','KARANG BUDI');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.10.13','SU','SUMENEP','10','GAPURA','13','LONGOS');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.10.14','SU','SUMENEP','10','GAPURA','14','MANDALA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.10.15','SU','SUMENEP','10','GAPURA','15','PALOKLOAN (PALOLOAN)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.10.16','SU','SUMENEP','10','GAPURA','16','PANAGAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.10.17','SU','SUMENEP','10','GAPURA','17','POJA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.11.01','SU','SUMENEP','11','GAYAM','01','GAYAM');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.11.02','SU','SUMENEP','11','GAYAM','02','GENDANG BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.11.03','SU','SUMENEP','11','GAYAM','03','GENDANG TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.11.04','SU','SUMENEP','11','GAYAM','04','JAMBUIR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.11.05','SU','SUMENEP','11','GAYAM','05','KALOWANG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.11.06','SU','SUMENEP','11','GAYAM','06','KARANGTENGAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.11.07','SU','SUMENEP','11','GAYAM','07','NYAMPLONG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.11.08','SU','SUMENEP','11','GAYAM','08','PANCOR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.11.09','SU','SUMENEP','11','GAYAM','09','PRAMBANAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.11.10','SU','SUMENEP','11','GAYAM','10','TAREBUNG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.12.01','SU','SUMENEP','12','GILI GINTING ','01','AENGANYAR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.12.02','SU','SUMENEP','12','GILI GINTING ','02','BANBARU');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.12.03','SU','SUMENEP','12','GILI GINTING ','03','BANMALENG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.12.04','SU','SUMENEP','12','GILI GINTING ','04','BRINGSANG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.12.05','SU','SUMENEP','12','GILI GINTING ','05','GALIS');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.12.06','SU','SUMENEP','12','GILI GINTING ','06','GEDUGAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.12.07','SU','SUMENEP','12','GILI GINTING ','07','JATE');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.12.08','SU','SUMENEP','12','GILI GINTING ','08','LOMBANG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.13.01','SU','SUMENEP','13','GULUK GULUK','01','BAKEYONG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.13.02','SU','SUMENEP','13','GULUK GULUK','02','BATUAMPAR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.13.03','SU','SUMENEP','13','GULUK GULUK','03','BRAGUNG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.13.04','SU','SUMENEP','13','GULUK GULUK','04','GULUK GULUK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.13.05','SU','SUMENEP','13','GULUK GULUK','05','KETAWANG LAOK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.13.06','SU','SUMENEP','13','GULUK GULUK','06','PANANGGUNGAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.13.07','SU','SUMENEP','13','GULUK GULUK','07','PAYUDAN DALEMAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.13.08','SU','SUMENEP','13','GULUK GULUK','08','PAYUDAN DUNDANG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.13.09','SU','SUMENEP','13','GULUK GULUK','09','PAYUDAN KARANGSOKON');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.13.10','SU','SUMENEP','13','GULUK GULUK','10','PAYUDAN NANGGER');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.13.11','SU','SUMENEP','13','GULUK GULUK','11','PORDAPOR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.13.12','SU','SUMENEP','13','GULUK GULUK','12','TAMBUKO');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.14.01','SU','SUMENEP','14',' KALIANGET','01','KALIANGET BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.14.02','SU','SUMENEP','14',' KALIANGET','02','KALIANGET TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.14.03','SU','SUMENEP','14',' KALIANGET','03','KALIMO\'OK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.14.04','SU','SUMENEP','14',' KALIANGET','04','KARANG ANYAR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.14.05','SU','SUMENEP','14',' KALIANGET','05','KERTASADA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.14.06','SU','SUMENEP','14',' KALIANGET','06','MARENGAN LAOK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.14.07','SU','SUMENEP','14',' KALIANGET','07','PINGGIRPAPAS');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.15.01','SU','SUMENEP','15','KANGAYAN','01','BATUPUTIH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.15.02','SU','SUMENEP','15','KANGAYAN','02','CANGKRAMAAN (CANGKREMAN)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.15.03','SU','SUMENEP','15','KANGAYAN','03','DAANDUNG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.15.04','SU','SUMENEP','15','KANGAYAN','04','JUKONG JUKONG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.15.05','SU','SUMENEP','15','KANGAYAN','05','KANGAYAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.15.06','SU','SUMENEP','15','KANGAYAN','06','SAOBI');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.15.07','SU','SUMENEP','15','KANGAYAN','07','TEMBAYANGAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.15.08','SU','SUMENEP','15','KANGAYAN','08','TIMUR JANJANG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.15.09','SU','SUMENEP','15','KANGAYAN','09','TOERJEK (TORJEK)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.16.01','SU','SUMENEP','16','KOTA SUMENEP','01','PAMOLOKAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.16.02','SU','SUMENEP','16','KOTA SUMENEP','02','PANGARANGAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.16.03','SU','SUMENEP','16','KOTA SUMENEP','03','KEBONAGUNG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.16.04','SU','SUMENEP','16','KOTA SUMENEP','04','PANDIAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.16.05','SU','SUMENEP','16','KOTA SUMENEP','05','KEPANJIN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.16.06','SU','SUMENEP','16','KOTA SUMENEP','06','BANGSELOK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.16.07','SU','SUMENEP','16','KOTA SUMENEP','07','PAJAGALAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.16.08','SU','SUMENEP','16','KOTA SUMENEP','08','BABALAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.16.09','SU','SUMENEP','16','KOTA SUMENEP','09','BANGKAL');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.16.10','SU','SUMENEP','16','KOTA SUMENEP','10','KACONGAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.16.11','SU','SUMENEP','16','KOTA SUMENEP','11','KARANGDUAK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.16.12','SU','SUMENEP','16','KOTA SUMENEP','12','KEBUNAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.16.13','SU','SUMENEP','16','KOTA SUMENEP','13','KOLOR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.16.14','SU','SUMENEP','16','KOTA SUMENEP','14','MARENGAN DAYA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.16.15','SU','SUMENEP','16','KOTA SUMENEP','15','PABERASAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.16.16','SU','SUMENEP','16','KOTA SUMENEP','16','PABIAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.16.17','SU','SUMENEP','16','KOTA SUMENEP','17','PARSANGA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.17.01','SU','SUMENEP','17','LENTENG','01','BANARESEP BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.17.02','SU','SUMENEP','17','LENTENG','02','BANARESEP TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.17.03','SU','SUMENEP','17','LENTENG','03','BILAPORA REBA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.17.04','SU','SUMENEP','17','LENTENG','04','CANGKRENG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.17.05','SU','SUMENEP','17','LENTENG','05','DARAMESTA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.17.06','SU','SUMENEP','17','LENTENG','06','ELLAK DAYA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.17.07','SU','SUMENEP','17','LENTENG','07','ELLAK LAOK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.17.08','SU','SUMENEP','17','LENTENG','08','JAMBU');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.17.09','SU','SUMENEP','17','LENTENG','09','KAMBINGAN BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.17.10','SU','SUMENEP','17','LENTENG','10','LEMBUNG BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.17.11','SU','SUMENEP','17','LENTENG','11','LEMBUNG TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.17.12','SU','SUMENEP','17','LENTENG','12','LENTENG BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.17.13','SU','SUMENEP','17','LENTENG','13','LENTENG TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.17.14','SU','SUMENEP','17','LENTENG','14','MEDELAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.17.15','SU','SUMENEP','17','LENTENG','15','MONCEK BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.17.16','SU','SUMENEP','17','LENTENG','16','MONCEK TENGAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.17.17','SU','SUMENEP','17','LENTENG','17','MONCEK TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.17.18','SU','SUMENEP','17','LENTENG','18','POREH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.17.19','SU','SUMENEP','17','LENTENG','19','SENDIR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.17.20','SU','SUMENEP','17','LENTENG','20','TAROGAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.18.01','SU','SUMENEP','18','MANDING','01','GADDING');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.18.02','SU','SUMENEP','18','MANDING','02','GIRING');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.18.03','SU','SUMENEP','18','MANDING','03','GUNUNG KEMBAR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.18.04','SU','SUMENEP','18','MANDING','04','JABA\'AN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.18.05','SU','SUMENEP','18','MANDING','05','KASENGAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.18.06','SU','SUMENEP','18','MANDING','06','LALANGON');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.18.07','SU','SUMENEP','18','MANDING','07','LANJUK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.18.08','SU','SUMENEP','18','MANDING','08','MANDING DAYA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.18.09','SU','SUMENEP','18','MANDING','09','MANDING LAOK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.18.10','SU','SUMENEP','18','MANDING','10','MANDING TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.18.11','SU','SUMENEP','18','MANDING','11','TENONAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.19.01','SU','SUMENEP','19','MASALEMBU','01','KARAMIAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.19.02','SU','SUMENEP','19','MASALEMBU','02','MASAKAMBING');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.19.03','SU','SUMENEP','19','MASALEMBU','03','MASSALIMA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.19.04','SU','SUMENEP','19','MASALEMBU','04','SUKAJERUK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.20.01','SU','SUMENEP','20','NONGGUNONG','01','NONGGUNONG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.20.02','SU','SUMENEP','20','NONGGUNONG','02','ROSONG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.20.03','SU','SUMENEP','20','NONGGUNONG','03','SOKARAME PASESER');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.20.04','SU','SUMENEP','20','NONGGUNONG','04','SOKARAME TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.20.05','SU','SUMENEP','20','NONGGUNONG','05','SOMBER');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.20.06','SU','SUMENEP','20','NONGGUNONG','06','SONOK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.20.07','SU','SUMENEP','20','NONGGUNONG','07','TALAGA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.20.08','SU','SUMENEP','20','NONGGUNONG','08','TANAHMERAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.21.01','SU','SUMENEP','21','PASONGSONGAN','01','CAMPAKA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.21.02','SU','SUMENEP','21','PASONGSONGAN','02','LEBENG BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.21.03','SU','SUMENEP','21','PASONGSONGAN','03','LEBENG TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.21.04','SU','SUMENEP','21','PASONGSONGAN','04','MONTORNA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.21.05','SU','SUMENEP','21','PASONGSONGAN','05','PADANGDANGAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.21.06','SU','SUMENEP','21','PASONGSONGAN','06','PANAONGAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.21.07','SU','SUMENEP','21','PASONGSONGAN','07','PASONGSONGAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.21.08','SU','SUMENEP','21','PASONGSONGAN','08','PRANCAK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.21.09','SU','SUMENEP','21','PASONGSONGAN','09','RAJUN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.21.10','SU','SUMENEP','21','PASONGSONGAN','10','SODDARA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.22.01','SU','SUMENEP','22','PRAGAAN','01','AENGPANAS');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.22.02','SU','SUMENEP','22','PRAGAAN','02','JADDUNG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.22.03','SU','SUMENEP','22','PRAGAAN','03','KADUARA TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.22.04','SU','SUMENEP','22','PRAGAAN','04','KARDULUK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.22.05','SU','SUMENEP','22','PRAGAAN','05','LARANGAN PERENG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.22.06','SU','SUMENEP','22','PRAGAAN','06','PAKAMBAN DAYA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.22.07','SU','SUMENEP','22','PRAGAAN','07','PAKAMBAN LAOK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.22.08','SU','SUMENEP','22','PRAGAAN','08','PRAGAAN DAYA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.22.09','SU','SUMENEP','22','PRAGAAN','09','PRAGAAN LAOK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.22.10','SU','SUMENEP','22','PRAGAAN','10','PRENDUAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.22.11','SU','SUMENEP','22','PRAGAAN','11','ROMBASAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.22.12','SU','SUMENEP','22','PRAGAAN','12','SENDANG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.22.13','SU','SUMENEP','22','PRAGAAN','13','SENTOL DAYA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.22.14','SU','SUMENEP','22','PRAGAAN','14','SENTOL LAOK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.23.01','SU','SUMENEP','23','RAAS','01','ALASMALANG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.23.02','SU','SUMENEP','23','RAAS','02','BRAKAS');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.23.03','SU','SUMENEP','23','RAAS','03','GUWA GUWA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.23.04','SU','SUMENEP','23','RAAS','04','JUNGKAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.23.05','SU','SUMENEP','23','RAAS','05','KARANGNANGKA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.23.06','SU','SUMENEP','23','RAAS','06','KAROPOH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.23.07','SU','SUMENEP','23','RAAS','07','KETUPAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.23.08','SU','SUMENEP','23','RAAS','08','POTERAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.23.09','SU','SUMENEP','23','RAAS','09','TONDUK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.24.01','SU','SUMENEP','24','RUBARU','01','BANA SARE');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.24.02','SU','SUMENEP','24','RUBARU','02','BASOKA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.24.03','SU','SUMENEP','24','RUBARU','03','BUNBARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.24.04','SU','SUMENEP','24','RUBARU','04','DUKO');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.24.05','SU','SUMENEP','24','RUBARU','05','KALEBENGAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.24.06','SU','SUMENEP','24','RUBARU','06','KARANGNANGKA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.24.07','SU','SUMENEP','24','RUBARU','07','MANDALA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.24.08','SU','SUMENEP','24','RUBARU','08','MATANAIR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.24.09','SU','SUMENEP','24','RUBARU','09','PAKONDANG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.24.10','SU','SUMENEP','24','RUBARU','10','RUBARU');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.24.11','SU','SUMENEP','24','RUBARU','11','TAMBAKSARI');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.25.01','SU','SUMENEP','25','SAPEKEN','01','PAGERUNGAN BESAR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.25.02','SU','SUMENEP','25','SAPEKEN','02','PAGERUNGAN KECIL');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.25.03','SU','SUMENEP','25','SAPEKEN','03','PALIAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.25.04','SU','SUMENEP','25','SAPEKEN','04','SABUNTAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.25.05','SU','SUMENEP','25','SAPEKEN','05','SAKALA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.25.06','SU','SUMENEP','25','SAPEKEN','06','SAPEKEN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.25.07','SU','SUMENEP','25','SAPEKEN','07','SASIIL (SASEEL)');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.25.08','SU','SUMENEP','25','SAPEKEN','08','SEPANJANG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.25.09','SU','SUMENEP','25','SAPEKEN','09','TANJUNGKIAOK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.26.01','SU','SUMENEP','26','SARONGGI','01','AENGTONGTONG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.26.02','SU','SUMENEP','26','SARONGGI','02','JULUK');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.26.03','SU','SUMENEP','26','SARONGGI','03','KAMBINGAN TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.26.04','SU','SUMENEP','26','SARONGGI','04','KEBUNDADAP BARAT');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.26.05','SU','SUMENEP','26','SARONGGI','05','KEBUNDADAP TIMUR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.26.06','SU','SUMENEP','26','SARONGGI','06','LANGSAR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.26.07','SU','SUMENEP','26','SARONGGI','07','MUANGAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.26.08','SU','SUMENEP','26','SARONGGI','08','NAMBAKOR');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.26.09','SU','SUMENEP','26','SARONGGI','09','PAGARBATU');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.26.10','SU','SUMENEP','26','SARONGGI','10','SAROKA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.26.11','SU','SUMENEP','26','SARONGGI','11','SARONGGI');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.26.12','SU','SUMENEP','26','SARONGGI','12','TALANG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.26.13','SU','SUMENEP','26','SARONGGI','13','TANAH MERAH');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.26.14','SU','SUMENEP','26','SARONGGI','14','TANJUNG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.27.01','SU','SUMENEP','27','TALANGO','01','CABBIYA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.27.02','SU','SUMENEP','27','TALANGO','02','ESSANG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.27.03','SU','SUMENEP','27','TALANGO','03','GAPURANA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.27.04','SU','SUMENEP','27','TALANGO','04','KOMBANG');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.27.05','SU','SUMENEP','27','TALANGO','05','PADIKE');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.27.06','SU','SUMENEP','27','TALANGO','06','PALASA');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.27.07','SU','SUMENEP','27','TALANGO','07','POTERAN');
insert  into `kd_kelurahan`(`kode`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`) values ('SU.27.08','SU','SUMENEP','27','TALANGO','08','TALANGO');

/*Table structure for table `log` */

DROP TABLE IF EXISTS `log`;

CREATE TABLE `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) NOT NULL,
  `login` datetime NOT NULL,
  `ip` varchar(20) NOT NULL,
  `hostname` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=651 DEFAULT CHARSET=latin1;

/*Data for the table `log` */

insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (1,'alex','2016-07-22 15:02:56','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (2,'administrator','2016-07-22 15:46:35','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (3,'alex','2016-07-22 16:17:26','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (4,'alex','2016-07-22 16:17:26','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (5,'alex','2016-07-22 17:31:57','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (6,'riski','2016-07-22 17:35:06','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (7,'alex','2016-07-22 17:35:23','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (8,'sales','2016-07-22 17:37:17','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (9,'alex','2016-07-22 17:53:34','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (10,'lili','2016-07-22 17:54:06','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (11,'sales','2016-07-22 17:54:27','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (12,'alex','2016-07-22 17:54:59','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (13,'lili','2016-07-22 17:55:40','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (14,'alex','2016-07-22 17:58:47','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (15,'salescounter','2016-07-22 18:00:53','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (16,'alex','2016-07-22 18:03:38','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (17,'kasir','2016-07-22 18:05:47','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (18,'alex','2016-07-23 10:08:17','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (19,'administrasi','2016-07-23 10:19:05','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (20,'sandy','2016-07-23 10:26:02','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (21,'alex','2016-07-23 10:39:04','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (22,'gudangpdi','2016-07-23 10:43:21','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (23,'alex','2016-07-23 11:02:32','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (24,'driver','2016-07-23 11:04:54','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (25,'alex','2016-07-23 11:31:30','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (26,'sales','2016-07-23 11:36:45','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (27,'kasir','2016-07-23 11:53:13','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (28,'sales','2016-07-23 12:56:11','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (29,'salescounter','2016-07-23 12:56:23','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (30,'gudangpdi','2016-07-23 13:52:33','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (31,'gudangpdi','2016-07-23 13:52:42','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (32,'alex','2016-07-23 13:54:00','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (33,'kasir','2016-07-23 13:56:35','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (34,'gudangpdi','2016-07-23 14:01:34','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (35,'kasir','2016-07-24 19:11:52','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (36,'alex','2016-07-24 19:21:42','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (37,'kasir','2016-07-24 19:33:02','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (38,'administrasi','2016-07-24 19:34:45','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (39,'driver','2016-07-24 19:37:39','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (40,'sales','2016-07-24 19:38:26','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (41,'alex','2016-07-24 19:48:22','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (42,'alex','2016-07-25 08:50:26','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (43,'alex','2016-07-25 11:42:30','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (44,'alex','2016-07-25 13:16:13','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (45,'alex','2016-07-25 15:25:20','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (46,'alex','2016-07-25 15:25:50','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (47,'alex','2016-07-27 09:33:33','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (48,'alex','2016-07-27 13:37:55','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (49,'alex','2016-07-28 11:48:09','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (50,'alex','2016-07-29 10:25:31','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (51,'alex','2016-07-30 10:34:08','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (52,'alex','2016-08-01 16:47:34','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (53,'alex','2016-08-02 17:33:44','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (54,'alex','2016-08-03 10:05:56','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (55,'alex','2016-08-03 10:16:54','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (56,'alex','2016-08-04 15:35:55','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (57,'alex','2016-08-04 16:09:31','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (58,'alex','2016-08-05 13:18:02','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (59,'alex','2016-08-05 15:41:26','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (60,'alex','2016-08-07 17:37:26','127.0.0.1','ISAS-VAIO');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (61,'alex','2016-08-08 16:43:33','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (62,'alex','2016-08-09 11:24:00','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (63,'alex','2016-08-09 11:25:40','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (64,'alex','2016-08-09 12:21:29','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (65,'alex','2016-08-09 12:26:31','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (66,'alex','2016-08-09 14:01:50','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (67,'alex','2016-08-09 14:09:52','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (68,'alex','2016-08-14 10:45:35','127.0.0.1','ISAS-VAIO');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (69,'alex','2016-08-16 00:02:06','127.0.0.1','ISAS-VAIO');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (70,'alex','2016-08-16 00:12:07','127.0.0.1','ISAS-VAIO');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (71,'alex','2016-08-16 11:00:07','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (72,'alex','2016-08-18 10:19:17','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (73,'alex','2016-08-19 20:16:17','127.0.0.1','ISAS-VAIO');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (74,'alex','2016-08-23 10:29:25','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (75,'alex','2016-08-23 15:47:51','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (76,'alex','2016-08-27 13:15:22','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (77,'alex','2016-08-30 08:59:33','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (78,'alex','2016-08-31 18:11:28','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (79,'alex','2016-09-01 12:17:01','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (80,'alex','2016-09-01 14:19:08','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (81,'alex','2016-09-05 08:54:42','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (82,'sales','2016-09-06 13:40:03','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (83,'alex','2016-09-07 09:11:07','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (84,'alex','2016-09-07 17:32:30','127.0.0.1','EDPARIEF-PC');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (85,'ASRORI','2016-09-08 19:08:14','127.0.0.1','EDPARIEF-PC');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (86,'alex','2016-09-08 19:13:35','127.0.0.1','EDPARIEF-PC');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (87,'CLIFF','2016-09-08 19:14:54','127.0.0.1','EDPARIEF-PC');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (88,'alex','2016-09-08 21:06:25','127.0.0.1','EDPARIEF-PC');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (89,'alex','2016-09-10 16:56:24','127.0.0.1','EDPARIEF-PC');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (90,'alex','2016-09-19 09:22:04','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (91,'administrator','2016-09-19 17:25:51','127.0.0.1','EDPARIEF-PC');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (92,'alex','2016-09-19 17:32:05','127.0.0.1','EDPARIEF-PC');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (93,'gudangpdi','2016-09-20 09:32:50','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (94,'pic','2016-09-20 09:34:35','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (95,'alex','2016-09-20 09:35:10','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (96,'alex','2016-09-27 19:49:53','127.0.0.1','EDPARIEF-PC');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (97,'alex','2016-09-30 13:16:41','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (98,'alex','2016-10-01 15:11:20','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (99,'alex','2016-10-01 15:17:05','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (100,'alex','2016-10-05 09:33:40','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (101,'alex','2016-10-07 19:57:39','127.0.0.1','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (102,'alex','2016-10-07 19:58:22','127.0.0.1','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (103,'alex','2016-10-07 19:59:10','127.0.0.1','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (104,'alex','2016-10-10 18:49:50','127.0.0.1','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (105,'alex','2016-10-10 20:32:35','127.0.0.1','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (106,'salescounter','2016-10-10 20:36:15','127.0.0.1','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (107,'salescounter','2016-10-10 20:37:48','127.0.0.1','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (108,'sales','2016-10-10 20:42:12','127.0.0.1','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (109,'salescounter','2016-10-10 20:43:50','127.0.0.1','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (110,'alex','2016-10-10 20:51:01','127.0.0.1','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (111,'kasir','2016-10-10 20:58:04','127.0.0.1','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (112,'salescounter','2016-10-10 21:05:54','127.0.0.1','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (113,'alex','2016-10-13 18:09:10','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (114,'ALEX','2016-10-14 16:46:41','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (115,'alex','2016-10-17 12:37:51','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (116,'alex','2016-10-20 11:46:22','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (117,'alex','2016-10-25 11:40:27','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (118,'alex','2016-10-25 11:50:43','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (119,'alex','2016-10-25 11:51:30','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (120,'alex','2016-10-26 11:01:52','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (121,'alex','2016-10-27 19:40:19','127.0.0.1','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (122,'alex','2016-10-29 12:23:44','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (123,'alex','2016-10-31 11:10:45','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (124,'administrator','2016-10-31 11:54:18','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (125,'administrator','2016-10-31 12:16:34','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (126,'alex','2016-11-12 09:19:02','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (127,'alex','2016-11-12 09:53:34','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (128,'alex','2016-11-12 09:54:12','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (129,'alex','2016-11-14 11:42:19','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (130,'alex','2016-11-15 09:58:08','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (131,'alex','2016-11-17 10:22:40','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (132,'alex','2016-11-18 11:26:37','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (133,'alex','2016-11-18 16:04:48','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (134,'alex','2016-11-19 08:57:33','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (135,'alex','2016-11-21 15:12:55','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (136,'alex','2016-11-23 09:22:40','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (137,'alex','2016-11-25 09:20:17','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (138,'alex','2016-11-25 09:27:03','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (139,'alex','2016-11-26 12:17:15','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (140,'alex','2016-11-28 09:06:37','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (141,'alex','2016-11-28 09:14:03','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (142,'alex','2016-11-28 13:01:37','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (143,'alex','2016-12-01 11:23:26','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (144,'alex','2016-12-01 11:24:26','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (145,'alex','2016-12-02 15:08:59','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (146,'alex','2016-12-05 19:47:38','127.0.0.1','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (147,'alex','2016-12-07 15:46:17','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (148,'alex','2016-12-07 19:33:43','127.0.0.1','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (149,'alex','2016-12-08 09:36:01','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (150,'alex','2016-12-08 19:44:00','127.0.0.1','ISAS-VAIO');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (151,'alex','2016-12-08 23:02:32','127.0.0.1','ISAS-VAIO');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (152,'alex','2016-12-08 23:02:55','127.0.0.1','ISAS-VAIO');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (153,'alex','2016-12-09 09:29:41','127.0.0.1','ISAS-VAIO');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (154,'alex','2016-12-09 09:38:00','192.168.1.100','192.168.1.100');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (155,'alex','2016-12-09 10:19:41','127.0.0.1','ISAS-VAIO');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (156,'pic','2016-12-09 10:28:37','192.168.1.100','192.168.1.100');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (157,'gudangpdi','2016-12-09 10:29:06','192.168.1.102','192.168.1.102');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (158,'gudangpdi','2016-12-09 10:29:46','192.168.1.100','192.168.1.100');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (159,'pic','2016-12-09 10:30:45','192.168.1.100','192.168.1.100');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (160,'pic','2016-12-09 10:47:43','192.168.1.100','192.168.1.100');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (161,'pic','2016-12-09 10:48:54','192.168.1.102','192.168.1.102');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (162,'pic','2016-12-09 10:55:05','192.168.1.100','192.168.1.100');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (163,'gudangpdi','2016-12-09 11:02:11','192.168.1.102','192.168.1.102');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (164,'pic','2016-12-09 11:03:30','127.0.0.1','ISAS-VAIO');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (165,'pic','2016-12-09 11:04:45','192.168.1.100','192.168.1.100');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (166,'alex','2016-12-09 11:05:48','127.0.0.1','ISAS-VAIO');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (167,'PIC','2016-12-09 11:40:01','127.0.0.1','ISAS-VAIO');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (168,'gudangpdi','2016-12-09 11:41:18','192.168.1.102','192.168.1.102');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (169,'gudangpdi','2016-12-09 11:41:18','192.168.1.102','192.168.1.102');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (170,'alex','2016-12-09 11:43:13','127.0.0.1','ISAS-VAIO');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (171,'pic','2016-12-09 11:58:50','192.168.1.100','192.168.1.100');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (172,'alex','2016-12-09 12:24:34','192.168.1.100','192.168.1.100');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (173,'alex','2016-12-09 13:07:42','192.168.1.100','192.168.1.100');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (174,'pic','2016-12-09 15:45:47','192.168.1.100','192.168.1.100');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (175,'gudangpdi','2016-12-09 15:47:19','192.168.1.102','192.168.1.102');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (176,'kasir','2016-12-09 15:56:18','192.168.1.102','192.168.1.102');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (177,'sales','2016-12-09 15:56:19','192.168.1.100','192.168.1.100');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (178,'gudangpdi','2016-12-09 15:57:03','192.168.1.100','192.168.1.100');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (179,'gudangpdi','2016-12-09 15:57:04','192.168.1.102','192.168.1.102');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (180,'kasir','2016-12-09 15:57:56','192.168.1.102','192.168.1.102');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (181,'pic','2016-12-09 16:02:20','192.168.1.100','192.168.1.100');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (182,'sales','2016-12-09 16:56:32','192.168.1.100','192.168.1.100');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (183,'sales','2016-12-09 16:58:50','192.168.1.100','192.168.1.100');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (184,'SALES','2016-12-09 16:59:38','192.168.1.102','192.168.1.102');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (185,'kasir','2016-12-09 17:01:08','192.168.1.102','192.168.1.102');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (186,'sales','2016-12-09 17:08:07','192.168.1.100','192.168.1.100');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (187,'kasir','2016-12-09 17:08:08','192.168.1.101','192.168.1.101');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (188,'gudangpdi','2016-12-09 17:11:15','192.168.1.100','192.168.1.100');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (189,'administrasi','2016-12-09 17:18:21','192.168.1.100','192.168.1.100');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (190,'administrasi','2016-12-09 17:21:54','192.168.1.100','192.168.1.100');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (191,'gudangpdi','2016-12-09 17:25:34','192.168.1.100','192.168.1.100');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (192,'driver','2016-12-09 17:33:53','192.168.1.101','192.168.1.101');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (193,'kasir','2016-12-09 17:34:35','192.168.1.101','192.168.1.101');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (194,'Driver','2016-12-09 17:36:15','192.168.1.103','192.168.1.103');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (195,'salescounter','2016-12-09 17:40:01','192.168.1.100','192.168.1.100');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (196,'pic','2016-12-09 17:47:16','192.168.1.100','192.168.1.100');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (197,'gudangpdi','2016-12-09 18:11:33','192.168.1.100','192.168.1.100');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (198,'administrasi','2016-12-09 18:29:29','192.168.1.100','192.168.1.100');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (199,'pic','2016-12-09 18:53:40','192.168.1.100','192.168.1.100');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (200,'gudangpdi','2016-12-09 18:55:54','192.168.1.100','192.168.1.100');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (201,'alex','2016-12-10 13:55:39','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (202,'sales','2016-12-10 19:41:02','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (203,'kasir','2016-12-10 19:45:46','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (204,'pic','2016-12-10 20:25:33','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (205,'salescounter','2016-12-10 21:25:27','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (206,'alex','2016-12-10 21:31:07','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (207,'pic','2016-12-10 21:32:49','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (208,'alex','2016-12-10 21:33:14','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (209,'pic','2016-12-10 21:33:52','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (210,'pic','2016-12-10 23:03:37','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (211,'alex','2016-12-10 23:03:59','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (212,'kasir','2016-12-10 23:10:18','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (213,'sales','2016-12-10 23:13:14','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (214,'pic','2016-12-10 23:15:04','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (215,'sales','2016-12-10 23:25:20','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (216,'salescounter','2016-12-10 23:39:02','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (217,'alex','2016-12-10 23:40:42','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (218,'sales','2016-12-12 19:53:25','192.168.1.101','192.168.1.101');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (219,'pic','2016-12-12 19:54:54','192.168.1.101','192.168.1.101');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (220,'alex','2016-12-12 20:09:48','192.168.1.101','192.168.1.101');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (221,'administrasi','2016-12-12 21:06:33','192.168.1.101','192.168.1.101');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (222,'salescounter','2016-12-12 21:15:27','192.168.1.101','192.168.1.101');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (223,'salescounter','2016-12-12 21:41:41','192.168.1.101','192.168.1.101');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (224,'kasir','2016-12-12 21:45:11','192.168.1.101','192.168.1.101');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (225,'pic','2016-12-12 22:06:35','192.168.1.101','192.168.1.101');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (226,'gudangpdi','2016-12-12 22:09:30','192.168.1.101','192.168.1.101');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (227,'sales','2016-12-12 22:15:57','192.168.1.101','192.168.1.101');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (228,'pic','2016-12-12 22:24:25','127.0.0.1','ISAS-VAIO');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (229,'alex','2016-12-12 22:51:50','192.168.1.101','192.168.1.101');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (230,'pic','2016-12-12 23:12:40','127.0.0.1','ISAS-VAIO');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (231,'salescounter','2016-12-12 23:32:41','192.168.1.101','192.168.1.101');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (232,'administrasi','2016-12-12 23:33:00','192.168.1.101','192.168.1.101');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (233,'kasir','2016-12-12 23:33:20','192.168.1.101','192.168.1.101');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (234,'gudangpdi','2016-12-12 23:33:55','192.168.1.101','192.168.1.101');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (235,'administrasi','2016-12-13 13:47:44','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (236,'kasir','2016-12-13 13:49:23','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (237,'alex','2016-12-13 13:54:31','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (238,'gudangpdi','2016-12-13 20:49:42','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (239,'pic','2016-12-13 20:49:48','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (240,'alex','2016-12-13 20:49:59','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (241,'gudangpdi','2016-12-13 21:27:23','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (242,'alex','2016-12-13 21:28:01','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (243,'administrasi','2016-12-13 22:26:30','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (244,'pic','2016-12-13 22:55:41','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (245,'kasir','2016-12-14 19:31:51','127.0.0.1','ISAS-VAIO');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (246,'administrasi','2016-12-14 19:31:56','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (247,'alex','2016-12-14 19:32:07','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (248,'pic','2016-12-14 19:32:16','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (249,'alex','2016-12-14 19:33:37','127.0.0.1','ISAS-VAIO');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (250,'sales','2016-12-14 19:51:53','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (251,'kasir','2016-12-14 19:53:24','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (252,'gudangpdi','2016-12-14 19:54:27','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (253,'administrasi','2016-12-14 19:55:43','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (254,'salescounter','2016-12-14 20:02:19','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (255,'kasir','2016-12-14 20:04:48','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (256,'gudangpdi','2016-12-14 20:06:33','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (257,'Pic','2016-12-14 20:14:13','192.168.43.1','192.168.43.1');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (258,'kasir','2016-12-14 20:19:33','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (259,'kasir','2016-12-14 20:23:32','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (260,'alex','2016-12-14 20:23:54','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (261,'administrasi','2016-12-14 20:25:07','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (262,'salescounter','2016-12-14 20:34:20','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (263,'kasir','2016-12-14 20:46:48','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (264,'kasir','2016-12-14 20:50:39','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (265,'pic','2016-12-14 20:53:07','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (266,'alex','2016-12-15 15:23:15','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (267,'alex','2016-12-16 12:17:57','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (268,'alex','2016-12-16 13:44:48','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (269,'alex','2016-12-16 16:55:06','127.0.0.1','ISAS-VAIO');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (270,'pic','2016-12-16 19:26:30','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (271,'alex','2016-12-16 19:26:38','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (272,'kasir','2016-12-16 19:28:07','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (273,'administrasi','2016-12-16 19:36:35','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (274,'kasir','2016-12-16 19:48:09','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (275,'administrasi','2016-12-16 20:53:42','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (276,'pic','2017-01-16 21:50:04','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (277,'alex','2016-12-18 19:16:36','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (278,'sales','2016-12-18 19:37:30','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (279,'kasir','2016-12-18 19:37:36','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (280,'alex','2016-12-18 20:00:55','127.0.0.1','ISAS-VAIO');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (281,'administrasi','2016-12-18 20:01:46','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (282,'sales','2016-12-18 20:12:32','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (283,'gudangpdi','2016-12-18 20:41:04','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (284,'salescounter','2016-12-18 21:26:26','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (285,'alex','2016-12-18 21:50:45','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (286,'alex','2016-12-18 21:50:55','127.0.0.1','ISAS-VAIO');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (287,'alex','2016-12-18 21:51:28','127.0.0.1','ISAS-VAIO');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (288,'alex','2016-12-18 21:57:08','127.0.0.1','ISAS-VAIO');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (289,'alex','2016-12-18 22:27:03','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (290,'alex','2016-12-19 10:46:11','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (291,'alex','2016-12-19 15:03:17','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (292,'alex','2016-12-20 09:11:50','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (293,'alex','2016-12-20 11:53:56','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (294,'alex','2016-12-21 10:46:36','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (295,'alex','2016-12-21 11:02:13','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (296,'alex','2016-12-21 21:06:54','127.0.0.1','ISAS-VAIO');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (297,'alex','2016-12-21 21:07:48','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (298,'alex','2016-12-22 20:30:33','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (299,'alex','2016-12-23 19:41:39','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (300,'alex','2016-12-24 10:15:36','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (301,'alex','2016-12-24 14:44:57','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (302,'alex','2016-12-27 10:10:25','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (303,'alex','2016-12-27 11:31:57','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (304,'alex','2016-12-27 11:41:38','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (305,'alex','2016-12-28 15:35:01','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (306,'alex','2016-12-29 10:32:29','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (307,'alex','2016-12-29 19:12:52','127.0.0.1','ISAS-VAIO');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (308,'alex','2016-12-29 19:25:13','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (309,'alex','2016-12-30 19:34:39','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (310,'alex','2017-01-02 18:45:59','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (311,'alex','2017-01-03 18:30:20','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (312,'alex','2017-01-03 18:32:44','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (313,'alex','2017-01-04 13:44:13','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (314,'alex','2017-01-04 15:55:42','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (315,'alex','2017-01-04 20:45:28','127.0.0.1','ISAS-VAIO');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (316,'alex','2017-01-04 21:15:19','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (317,'alex','2017-01-04 21:16:59','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (318,'alex','2017-01-04 21:30:57','127.0.0.1','ISAS-VAIO');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (319,'alex','2017-01-04 23:25:56','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (320,'alex','2017-01-05 15:13:48','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (321,'alex','2017-01-11 11:16:48','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (322,'alex','2017-01-11 11:23:12','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (323,'alex','2017-01-11 11:42:32','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (324,'alex','2017-01-11 19:46:27','127.0.0.1','ISAS-VAIO');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (325,'alex','2017-01-11 20:46:21','127.0.0.1','ISAS-VAIO');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (326,'alex','2017-01-11 21:20:25','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (327,'alex','2017-01-11 21:33:16','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (328,'alex','2017-01-11 21:42:33','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (329,'alex','2017-01-11 22:19:55','127.0.0.1','ISAS-VAIO');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (330,'alex','2017-01-12 14:30:39','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (331,'alex','2017-01-13 10:00:54','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (332,'alex','2017-01-13 10:05:29','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (333,'alex','2017-01-13 12:02:14','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (334,'alex','2017-01-13 14:05:51','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (335,'alex','2017-01-13 20:32:53','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (336,'alex','2017-01-13 20:36:23','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (337,'alex','2017-01-13 20:57:12','127.0.0.1','ISAS-VAIO');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (338,'alex','2017-01-13 21:10:58','127.0.0.1','ISAS-VAIO');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (339,'alex','2017-01-13 22:44:04','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (340,'alex','2017-01-13 22:46:26','127.0.0.1','ISAS-VAIO');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (341,'alex','2017-01-14 20:03:57','127.0.0.1','ISAS-VAIO');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (342,'alex','2017-01-14 20:07:27','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (343,'alex','2017-01-14 20:07:42','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (344,'alex','2017-01-14 20:58:29','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (345,'alex','2017-01-14 21:22:03','127.0.0.1','ISAS-VAIO');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (346,'alex','2017-01-14 22:25:16','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (347,'alex','2017-01-16 19:31:50','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (348,'alex','2017-01-16 19:31:58','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (349,'alex','2017-01-16 20:24:42','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (350,'alex','2017-01-16 21:25:45','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (351,'alex','2017-01-17 19:55:52','192.168.1.101','192.168.1.101');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (352,'alex','2017-01-17 19:55:58','192.168.1.101','192.168.1.101');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (353,'alex','2017-01-16 21:56:50','192.168.1.100','192.168.1.100');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (354,'kasir','2017-01-16 22:08:47','192.168.1.100','192.168.1.100');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (355,'kasir','2017-01-16 22:14:00','192.168.1.100','192.168.1.100');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (356,'kasir','2017-01-16 22:15:03','192.168.1.100','192.168.1.100');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (357,'kasir','2017-01-16 22:16:06','192.168.1.100','192.168.1.100');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (358,'alex','2017-01-19 19:24:43','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (359,'alex','2017-01-20 22:33:52','127.0.0.1','ISAS-VAIO');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (360,'alex','2017-01-21 20:57:47','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (361,'alex','2017-01-23 13:14:40','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (362,'alex','2017-01-24 10:33:31','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (363,'alex','2017-01-25 19:49:21','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (364,'alex','2017-01-26 19:38:07','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (365,'alex','2017-01-26 21:42:17','127.0.0.1','ISAS-VAIO');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (366,'alex','2017-01-27 13:31:37','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (367,'alex','2017-01-30 13:32:33','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (368,'alex','2017-01-30 15:10:22','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (369,'alex','2017-01-30 15:12:26','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (370,'alex','2017-01-30 19:44:51','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (371,'alex','2017-01-30 23:08:44','127.0.0.1','ISAS-VAIO');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (372,'alex','2017-02-04 19:39:19','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (373,'alex','2017-02-04 19:44:03','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (374,'alex','2017-02-04 21:29:50','127.0.0.1','ISAS-VAIO');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (375,'alex','2017-02-04 21:36:34','127.0.0.1','ISAS-VAIO');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (376,'alex','2017-02-07 19:40:25','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (377,'alex','2017-02-07 19:43:08','127.0.0.1','ISAS-VAIO');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (378,'alex','2017-02-08 19:11:59','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (379,'alex','2017-02-09 19:20:16','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (380,'alex','2017-02-09 21:25:57','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (381,'alex','2017-02-09 21:26:53','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (382,'alex','2017-02-09 21:26:58','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (383,'ALEX','2017-02-09 22:07:18','127.0.0.1','ISAS-VAIO');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (384,'alex','2017-02-09 22:27:53','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (385,'alex','2017-02-10 15:29:05','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (386,'alex','2017-02-10 15:32:35','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (387,'alex','2017-02-10 18:59:41','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (388,'alex','2017-02-10 19:18:19','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (389,'alex','2017-02-10 19:32:21','127.0.0.1','ISAS-VAIO');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (390,'alex','2017-02-10 20:54:00','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (391,'pic','2017-02-10 21:24:09','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (392,'alex','2017-02-10 21:33:07','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (393,'alex','2017-01-31 21:37:56','127.0.0.1','ISAS-VAIO');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (394,'alex','2017-02-11 10:51:30','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (395,'alex','2017-02-11 11:11:51','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (396,'alex','2017-02-11 21:09:23','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (397,'alex','2017-02-11 21:15:03','127.0.0.1','ISAS-VAIO');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (398,'alex','2017-02-11 21:16:11','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (399,'alex','2017-02-11 21:26:01','127.0.0.1','ISAS-VAIO');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (400,'alex','2017-02-11 22:42:50','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (401,'alex','2017-02-13 21:34:43','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (402,'alex','2017-02-16 10:03:15','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (403,'alex','2017-02-16 11:05:45','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (404,'alex','2017-02-16 11:09:53','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (405,'AJ-AJ','2017-02-17 11:01:09','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (406,'AJ-AJ','2017-02-17 11:03:05','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (407,'ALEX','2017-02-17 14:53:40','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (408,'alex','2017-02-17 19:50:31','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (409,'alex','2017-02-17 19:53:58','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (410,'ALEX','2017-02-17 19:59:40','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (411,'alex','2017-02-17 20:02:52','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (412,'ALEX','2017-02-17 20:03:34','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (413,'ALEX','2017-02-17 20:07:44','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (414,'ALEX','2017-02-17 21:27:39','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (415,'alex','2017-02-17 21:34:05','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (416,'ALEX','2017-02-17 21:38:57','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (417,'alex','2017-02-17 21:39:47','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (418,'ALEX','2017-02-17 21:40:19','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (419,'ALEX','2017-02-17 21:49:04','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (420,'alex','2017-02-17 22:56:15','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (421,'alex','2017-02-20 19:37:31','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (422,'ALEX','2017-02-20 19:41:21','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (423,'alex','2017-02-20 19:43:25','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (424,'ALEX','2017-02-20 19:56:55','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (425,'SALES-AJ','2017-02-20 20:00:41','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (426,'ALEX','2017-02-20 20:01:07','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (427,'SALES','2017-02-20 20:01:19','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (428,'ALEX','2017-02-20 20:01:42','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (429,'AJ-AJ','2017-02-20 20:11:57','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (430,'SALES-AJ','2017-02-20 20:12:52','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (431,'KASIR-AJ','2017-02-20 20:15:16','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (432,'AJ-AJ','2017-02-20 20:19:17','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (433,'AJ-AJ','2017-02-20 20:32:24','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (434,'ALEX','2017-02-20 21:11:34','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (435,'AJ-AJ','2017-02-20 21:27:11','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (436,'ALEX','2017-02-21 21:46:28','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (437,'AJ-AJ','2017-02-21 22:06:06','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (438,'alex','2017-02-20 22:14:42','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (439,'alex','2017-02-20 22:15:07','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (440,'aj-aj','2017-02-20 22:18:13','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (441,'aj-aj','2017-02-20 22:19:41','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (442,'AJ-AJ','2017-02-20 22:24:34','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (443,'AJ-AJ','2017-02-20 22:24:37','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (444,'AJ-AJ','2017-02-20 22:26:05','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (445,'AJ-AJ','2017-02-20 22:26:25','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (446,'ALEX','2017-02-20 22:47:39','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (447,'AJ-AJ','2017-02-20 22:51:28','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (448,'ALEX','2017-02-22 20:05:27','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (449,'ALEX','2017-02-22 20:10:15','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (450,'ALEX','2017-02-22 20:10:51','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (451,'ALEX','2017-02-22 20:11:51','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (452,'KEPALABENGKEL','2017-02-22 20:12:28','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (453,'ALEX','2017-02-22 20:33:37','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (454,'ALEX','2017-02-22 20:36:19','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (455,'COUNTERPART','2017-02-22 20:36:49','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (456,'AJ-AJ','2017-02-22 20:39:38','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (457,'ALEX','2017-02-22 20:39:57','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (458,'ALEX','2017-02-22 21:06:59','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (459,'ALEX','2017-02-22 21:15:22','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (460,'ALEX','2017-02-22 21:15:34','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (461,'ALEX','2017-02-22 21:32:52','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (462,'KEPALABENGKEL','2017-02-22 21:37:10','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (463,'KEPALABENGKEL','2017-02-22 21:39:02','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (464,'ALEX','2017-02-22 21:42:13','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (465,'ALEX','2017-02-22 22:08:51','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (466,'ALEX','2017-02-22 22:10:01','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (467,'SA','2017-02-22 22:37:20','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (468,'KASIR','2017-02-22 22:43:27','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (469,'SA','2017-02-22 22:46:57','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (470,'KEPALABENGKEL','2017-02-22 23:06:11','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (471,'ALEX','2017-02-24 21:01:54','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (472,'ALEX','2017-02-24 21:04:43','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (473,'ALEX','2017-02-24 21:07:21','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (474,'KEPALABENGKEL','2017-02-24 21:07:41','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (475,'ALEX','2017-02-24 21:14:51','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (476,'ALEX','2017-02-24 21:18:11','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (477,'ALEX','2017-02-24 21:58:40','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (478,'ALEX','2017-02-24 22:02:40','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (479,'ALEX','2017-02-24 22:25:58','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (480,'COUNTERPART','2017-02-24 22:26:15','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (481,'ALEX','2017-02-24 22:29:38','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (482,'SA','2017-02-24 22:48:36','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (483,'COUNTERPART','2017-02-24 22:52:03','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (484,'SA','2017-02-24 22:52:50','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (485,'KASIR','2017-02-24 22:56:47','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (486,'COUNTERPART','2017-02-24 23:00:38','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (487,'KEPALABENGKEL','2017-02-24 23:03:10','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (488,'ALEX','2017-02-24 23:24:39','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (489,'ALEX','2017-02-26 08:31:58','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (490,'ALEX','2017-02-26 12:16:32','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (491,'ALEX','2017-02-27 19:30:18','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (492,'ALEX','2017-02-27 19:41:16','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (493,'PIC','2017-02-27 19:46:52','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (494,'ALEX','2017-02-27 19:47:37','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (495,'ALEX','2017-02-27 19:48:17','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (496,'ALEX','2017-02-27 19:54:58','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (497,'ALEX','2017-02-27 19:56:04','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (498,'ALEX','2017-02-27 19:56:21','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (499,'ALEX','2017-02-27 20:01:15','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (500,'ALEX','2017-02-27 20:08:49','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (501,'ALEX','2017-02-27 20:43:09','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (502,'ALEX','2017-02-27 20:46:31','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (503,'ALEX','2017-02-27 20:48:36','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (504,'ALEX','2017-02-27 21:16:01','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (505,'ALEX','2017-02-27 21:16:49','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (506,'ALEX','2017-02-28 15:11:30','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (507,'ALEX','2017-02-28 18:26:28','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (508,'ALEX','2017-02-28 18:26:58','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (509,'ALEX','2017-02-28 18:32:09','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (510,'ALEX','2017-02-28 18:37:42','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (511,'ALEX','2017-03-08 18:38:10','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (512,'ALEX','2017-03-08 18:38:24','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (513,'ALEX','2017-03-08 18:42:08','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (514,'ALEX','2017-03-08 18:42:28','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (515,'ALEX','2017-03-08 18:42:59','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (516,'ALEX','2017-03-08 18:45:08','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (517,'ALEX','2017-03-16 18:47:49','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (518,'ALEX','2017-03-01 10:53:39','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (519,'ALEX','2017-03-01 20:55:45','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (520,'ALEX','2017-03-01 20:56:31','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (521,'KASIR','2017-03-01 21:12:02','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (522,'ALEX','2017-03-20 21:23:20','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (523,'ALEX','2017-03-20 21:25:01','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (524,'ALEX','2017-03-20 21:27:35','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (525,'ALEX','2017-03-20 21:28:49','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (526,'ALEX','2017-03-03 11:13:52','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (527,'ALEX','2017-03-07 11:14:17','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (528,'ALEX','2017-03-08 11:14:34','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (529,'ALEX','2017-03-08 11:14:58','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (530,'ALEX','2017-03-09 11:15:14','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (531,'ALEX','2017-03-09 11:15:28','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (532,'ALEX','2017-03-09 11:16:11','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (533,'ALEX','2017-03-03 11:57:09','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (534,'ALEX','2017-03-23 19:48:39','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (535,'ALEX','2017-03-23 19:49:37','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (536,'ALEX','2017-03-23 21:30:10','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (537,'ALEX','2017-03-23 21:59:01','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (538,'ALEX','2017-03-23 22:07:44','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (539,'ALEX','2017-03-23 22:11:32','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (540,'ALEX','2017-03-07 21:03:36','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (541,'ALEX','2017-03-09 09:28:18','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (542,'ALEX','2017-03-09 13:09:26','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (543,'SALES','2017-03-09 15:26:38','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (544,'ALEX','2017-03-09 15:42:07','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (545,'ALEX','2017-03-10 10:28:34','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (546,'ALEX','2017-03-10 10:31:16','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (547,'ALEX','2017-03-10 10:34:10','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (548,'ALEX','2017-03-10 10:36:24','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (549,'ALEX','2017-03-10 10:40:48','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (550,'ALEX','2017-03-10 10:42:03','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (551,'ALEX','2017-03-10 10:42:25','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (552,'ALEX','2017-03-10 10:54:18','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (553,'ALEX','2017-03-10 10:54:26','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (554,'ALEX','2017-03-10 10:54:56','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (555,'ALEX','2017-03-10 10:56:49','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (556,'ALEX','2017-03-10 10:57:10','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (557,'ALEX','2017-03-10 10:57:30','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (558,'ALEX','2017-03-10 10:57:58','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (559,'ALEX','2017-03-10 10:59:18','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (560,'ALEX','2017-03-10 11:00:00','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (561,'ALEX','2017-03-10 11:01:10','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (562,'ALEX','2017-03-10 11:01:24','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (563,'ALEX','2017-03-10 11:01:36','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (564,'ALEX','2017-03-10 11:01:42','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (565,'ALEX','2017-03-10 11:01:48','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (566,'ALEX','2017-03-10 11:01:53','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (567,'ALEX','2017-03-10 11:01:59','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (568,'ALEX','2017-03-10 11:02:04','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (569,'ALEX','2017-03-10 11:02:10','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (570,'ALEX','2017-03-10 11:02:26','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (571,'ALEX','2017-03-10 11:03:10','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (572,'ALEX','2017-03-10 11:04:20','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (573,'ALEX','2017-03-10 11:04:55','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (574,'ALEX','2017-03-10 11:05:02','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (575,'ALEX','2017-03-10 11:05:09','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (576,'ALEX','2017-03-10 11:05:16','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (577,'ALEX','2017-03-10 11:05:23','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (578,'ALEX','2017-03-10 11:05:32','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (579,'ALEX','2017-03-10 11:14:59','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (580,'ALEX','2017-03-10 11:15:24','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (581,'ALEX','2017-03-10 11:16:41','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (582,'ALEX','2017-03-10 11:20:11','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (583,'PIC','2017-03-10 11:21:23','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (584,'SALES','2017-03-10 11:30:33','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (585,'SALES-AJ','2017-03-10 11:34:35','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (586,'ALEX','2017-03-10 12:06:12','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (587,'ALEX','2017-03-10 12:06:36','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (588,'ADMINISTRATOR','2017-03-10 12:12:46','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (589,'ADMINISTRATOR','2017-03-10 13:43:26','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (590,'ALEX','2017-03-10 14:16:43','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (591,'ADMINISTRATOR','2017-03-10 14:19:05','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (592,'ALEX','2017-03-10 14:24:05','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (593,'ADMINISTRATOR','2017-03-10 14:33:13','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (594,'ALEX','2017-03-10 15:12:33','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (595,'ADMINISTRATOR','2017-03-10 15:26:50','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (596,'ALEX','2017-03-10 20:48:22','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (597,'ALEX','2017-03-10 20:49:44','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (598,'SALES','2017-03-10 21:03:59','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (599,'ALEX','2017-03-10 21:05:39','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (600,'SALES','2017-03-10 21:13:26','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (601,'KASIR','2017-03-10 21:15:07','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (602,'SALES','2017-03-10 21:15:46','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (603,'KASIR','2017-03-10 21:17:45','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (604,'GUDANGPDI','2017-03-10 21:18:31','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (605,'KASIR','2017-03-10 21:19:37','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (606,'ALEX','2017-03-10 21:20:09','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (607,'ADMINISTRASI','2017-03-10 21:20:10','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (608,'ALEX','2017-03-10 21:20:57','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (609,'SALES','2017-03-10 21:49:10','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (610,'KASIR','2017-04-10 22:00:09','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (611,'SALES','2017-04-10 22:00:33','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (612,'KASIR','2017-04-10 22:01:00','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (613,'SALES','2017-04-10 22:01:22','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (614,'SALES','2017-04-10 22:03:30','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (615,'KASIR','2017-04-10 22:04:32','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (616,'GUDANGPDI','2017-04-10 22:05:59','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (617,'KASIR','2017-04-10 22:06:24','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (618,'ADMINISTRASI','2017-04-10 22:06:47','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (619,'SALES','2017-04-10 22:10:00','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (620,'KASIR','2017-04-10 22:13:49','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (621,'SALES','2017-04-10 22:14:58','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (622,'KASIR','2017-04-10 22:15:12','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (623,'ALEX','2017-04-10 22:16:20','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (624,'ADMINISTRASI','2017-04-10 22:19:20','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (625,'SALES','2017-04-10 22:20:38','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (626,'ALEX','2017-04-10 22:23:16','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (627,'ALEX','2017-03-13 19:09:01','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (628,'ALEX','2017-03-13 19:12:38','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (629,'ALEX','2017-03-13 19:34:42','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (630,'ALEX','2017-03-13 19:35:20','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (631,'ALEX','2017-03-13 19:35:39','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (632,'ALEX','2017-03-13 19:38:50','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (633,'ALEX','2017-03-13 19:48:39','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (634,'ALEX','2017-03-13 19:55:56','127.0.0.1','AZIGHA');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (635,'ALEX','2017-03-13 20:01:49','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (636,'ALEX','2017-03-14 11:02:34','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (637,'ALEX','2017-03-14 14:36:05','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (638,'ALEX','2017-03-14 15:03:46','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (639,'ALEX','2017-03-15 17:56:36','127.0.0.1','ISAS');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (640,'ALEX','2017-03-15 18:28:55','127.0.0.1','ISAS');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (641,'ADMINISTRATOR','2017-03-15 18:32:38','127.0.0.1','ISAS');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (642,'ALEX','2017-03-15 20:20:23','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (643,'ALEX','2017-03-15 20:22:44','127.0.0.1','ISAS');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (644,'ALEX','2017-03-15 20:38:59','192.168.43.118','ALEX-RG');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (645,'ALEX','2017-05-04 16:23:02','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (646,'ALEX','2017-05-04 16:41:09','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (647,'ALEX','2017-05-05 14:49:37','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (648,'ALEX','2017-05-08 09:18:54','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (649,'ALEX','2017-05-08 09:20:12','127.0.0.1','ARIEF-LT');
insert  into `log`(`id`,`user`,`login`,`ip`,`hostname`) values (650,'ALEX','2017-05-08 10:31:22','127.0.0.1','ARIEF-LT');

/*Table structure for table `log_act` */

DROP TABLE IF EXISTS `log_act`;

CREATE TABLE `log_act` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tbl` varchar(20) NOT NULL,
  `tgl` date NOT NULL,
  `jam` time NOT NULL,
  `user` varchar(50) NOT NULL,
  `act` varbinary(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1481 DEFAULT CHARSET=latin1;

/*Data for the table `log_act` */

insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1,'x23_notabeli','2016-12-28','15:45:12','alex','TAMBAH NOTA BELI NB2161228-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (2,'x23_stokpart','2016-12-28','15:47:19','alex','TAMBAH STOK NB2161228-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (3,'x23_abis_dkonfirmasi','2016-12-28','15:48:20','alex','MENYETUJUI KONFIRMASI SELISIH QTY TIBA ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (4,'x23_stokpart','2016-12-28','15:51:22','alex','UPDATE HARGA JUAL NB2161228-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (5,'x23_notabeli','2016-12-28','15:54:10','alex','TAMBAH NOTA BELI NB2161228-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (6,'x23_notabeli','2016-12-28','15:55:17','alex','UBAH NOTA BELI ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (7,'x23_stokpart','2016-12-28','15:56:12','alex','TAMBAH STOK NB2161228-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (8,'x23_stokpart','2016-12-28','15:57:03','alex','UPDATE HARGA JUAL NB2161228-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (9,'x23_notabeli','2016-12-28','16:00:11','alex','TAMBAH NOTA BELI NB2161228-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (10,'x23_stokpart','2016-12-28','16:00:36','alex','TAMBAH STOK NB2161228-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (11,'x23_stokpart','2016-12-28','16:01:32','alex','UPDATE HARGA JUAL NB2161228-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (12,'x23_notabeli','2016-12-28','16:03:52','alex','BAYAR NOTA BELI NB2161228-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (13,'x23_notajual','2016-12-28','16:38:48','alex','TAMBAH NOTA JUAL NJ2161228-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (14,'x23_indent','2016-12-28','16:38:49','alex','TAMBAH NOTA INDENT NI161228-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (15,'x23_notajual','2016-12-28','16:40:26','alex','TAMBAH NOTA JUAL NJ2161228-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (16,'x23_indent','2016-12-28','16:40:26','alex','TAMBAH NOTA INDENT NI161228-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (17,'x23_kwitansi','2016-12-28','16:41:14','alex','TAMBAH KWITANSI KPJ161228-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (18,'x23_kwitansi','2016-12-28','16:42:07','alex','TAMBAH KWITANSI KI161228-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (19,'x23_kwitansi','2016-12-28','16:58:32','alex','TAMBAH KWITANSI KI161228-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (20,'x23_notabeli','2016-12-28','17:04:15','alex','TAMBAH NOTA BELI NB2161228-004');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (21,'x23_stokpart','2016-12-28','17:04:39','alex','TAMBAH STOK NB2161228-004');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (22,'x23_stokpart','2016-12-28','17:08:34','alex','UPDATE HARGA JUAL NB2161228-004');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (23,'x23_notabeli','2016-12-28','17:13:43','alex','TAMBAH NOTA BELI NB2161228-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (24,'x23_stokpart','2016-12-28','17:14:27','alex','TAMBAH STOK NB2161228-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (25,'x23_stokpart','2016-12-28','17:14:58','alex','UPDATE HARGA JUAL NB2161228-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (26,'x23_notajual','2016-12-28','17:24:33','alex','TAMBAH NOTA JUAL ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (27,'x23_kwitansi','2016-12-28','17:33:11','alex','TAMBAH KWITANSI KPJ161228-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (28,'x23_notajual','2016-12-28','17:55:56','alex','TAMBAH NOTA JUAL ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (29,'x23_indent','2016-12-28','18:11:06','alex','TAMBAH NOTA INDENT NI161228-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (30,'x23_indent','2016-12-28','18:13:08','alex','TAMBAH NOTA INDENT NI161228-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (31,'x23_indent','2016-12-29','10:37:11','alex','TAMBAH NOTA INDENT NI161229-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (32,'x23_kwitansi','2016-12-29','10:39:54','alex','TAMBAH KWITANSI KI161229-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (33,'x23_notabeli','2016-12-29','10:42:04','alex','TAMBAH NOTA BELI NB2161229-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (34,'x23_stokpart','2016-12-29','10:42:54','alex','TAMBAH STOK NB2161229-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (35,'x23_stokpart','2016-12-29','10:43:28','alex','UPDATE HARGA JUAL NB2161229-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (36,'x23_notajual','2016-12-29','10:46:30','alex','TAMBAH NOTA JUAL NJ2161229-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (37,'x23_notajual','2016-12-29','10:47:59','alex','TAMBAH NOTA JUAL NJ2161229-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (38,'x23_kwitansi','2016-12-29','10:49:21','alex','TAMBAH KWITANSI KPJ161229-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (39,'x23_kwitansi','2016-12-29','16:05:03','alex','TAMBAH KWITANSI KPJ161229-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (40,'x23_notajual','2016-12-29','16:15:46','alex','TAMBAH NOTA JUAL NJ2161229-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (41,'x23_indent','2016-12-29','16:15:46','alex','TAMBAH NOTA INDENT NI161229-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (42,'x23_kwitansi','2016-12-29','16:18:44','alex','TAMBAH KWITANSI KPJ161229-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (43,'x23_notajual','2016-12-29','19:24:46','alex','TAMBAH NOTA JUAL ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (44,'x23_notajual','2016-12-29','19:35:11','alex','TAMBAH NOTA JUAL NJ2161229-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (45,'x23_kwitansi','2016-12-29','19:36:00','alex','TAMBAH KWITANSI KPJ161229-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (46,'x23_notajual','2016-12-29','19:40:26','alex','TAMBAH NOTA JUAL NJ2161229-006');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (47,'x23_notajual','2016-12-29','19:40:58','alex','TAMBAH NOTA JUAL NJ2161229-007');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (48,'x23_kwitansi','2016-12-29','19:42:28','alex','TAMBAH KWITANSI KPJ161229-006');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (49,'x23_kwitansi','2016-12-29','20:05:47','alex','TAMBAH KWITANSI KPJ161229-007');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (50,'x23_notajual','2016-12-29','20:11:41','alex','TAMBAH NOTA JUAL NJ2161229-008');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (51,'x23_notajual','2016-12-29','20:14:14','alex','TAMBAH NOTA JUAL NJ2161229-009');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (52,'x23_kwitansi','2016-12-29','20:14:57','alex','TAMBAH KWITANSI KPJ161229-008');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (53,'x23_notabeli','2016-12-29','20:17:05','alex','TAMBAH NOTA BELI NB2161229-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (54,'x23_stokpart','2016-12-29','20:17:41','alex','TAMBAH STOK NB2161229-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (55,'x23_stokpart','2016-12-29','20:18:07','alex','UPDATE HARGA JUAL NB2161229-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (56,'x23_kwitansi','2016-12-29','20:19:34','alex','TAMBAH KWITANSI KPJ161229-009');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (57,'x23_indent','2016-12-29','20:21:06','alex','TAMBAH NOTA INDENT NI161229-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (58,'x23_kwitansi','2016-12-29','20:22:33','alex','TAMBAH KWITANSI KI161229-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (59,'x23_notabeli','2016-12-29','20:24:38','alex','TAMBAH NOTA BELI NB2161229-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (60,'x23_stokpart','2016-12-29','20:25:12','alex','TAMBAH STOK NB2161229-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (61,'x23_stokpart','2016-12-29','20:25:45','alex','UPDATE HARGA JUAL NB2161229-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (62,'x23_kwitansi','2016-12-29','20:26:51','alex','TAMBAH KWITANSI KI161229-004');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (63,'x23_notajual','2016-12-29','20:31:52','alex','TAMBAH NOTA JUAL ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (64,'x23_kwitansi','2016-12-29','20:38:14','alex','TAMBAH KWITANSI KI161229-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (65,'x23_notajual','2016-12-29','20:41:58','alex','TAMBAH NOTA JUAL ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (66,'x23_kwitansi','2016-12-29','20:53:26','alex','TAMBAH KWITANSI KPJ161229-010');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (67,'x23_notajual','2016-12-29','20:59:40','alex','TAMBAH NOTA JUAL ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (68,'x23_indent','2016-12-29','20:59:40','alex','TAMBAH NOTA INDENT NI161229-004');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (69,'x23_notabeli','2016-12-29','21:00:35','alex','TAMBAH NOTA BELI NB2161229-004');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (70,'x23_stokpart','2016-12-29','21:01:05','alex','TAMBAH STOK NB2161229-004');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (71,'x23_stokpart','2016-12-29','21:01:31','alex','UPDATE HARGA JUAL NB2161229-004');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (72,'x23_kwitansi','2016-12-29','21:03:09','alex','TAMBAH KWITANSI KI161229-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (73,'x23_notajual','2016-12-29','21:05:02','alex','TAMBAH NOTA JUAL ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (74,'x23_indent','2016-12-29','21:08:14','alex','TAMBAH NOTA INDENT NI161229-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (75,'x23_kwitansi','2016-12-29','21:08:50','alex','TAMBAH KWITANSI KI161229-006');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (76,'x23_notabeli','2016-12-29','21:09:32','alex','TAMBAH NOTA BELI NB2161229-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (77,'x23_stokpart','2016-12-29','21:10:39','alex','TAMBAH STOK NB2161229-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (78,'x23_stokpart','2016-12-29','21:14:23','alex','UPDATE HARGA JUAL NB2161229-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (79,'x23_notajual','2016-12-29','21:15:44','alex','TAMBAH NOTA JUAL ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (80,'x23_notajual','2016-12-29','21:19:48','alex','TAMBAH NOTA JUAL ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (81,'x23_kwitansi','2016-12-29','21:25:54','alex','TAMBAH KWITANSI KPJ161229-014');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (82,'x23_notajual','2016-12-29','21:30:40','alex','TAMBAH NOTA JUAL NJ2161229-015');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (83,'x23_kwitansi','2016-12-29','22:11:39','alex','TAMBAH KWITANSI KPJ161229-015');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (84,'x23_notajual','2016-12-29','22:16:35','alex','TAMBAH NOTA JUAL ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (85,'x23_kwitansi','2016-12-29','22:27:30','alex','TAMBAH KWITANSI KPJ161229-016');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (86,'x23_stokpart','2016-12-29','22:39:36','alex','TAMBAH STOK NB2161229-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (87,'x23_abis_dkonfirmasi','2016-12-29','22:40:27','alex','MENYETUJUI KONFIRMASI SELISIH QTY TIBA ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (88,'x23_notajual','2016-12-29','22:52:23','alex','TAMBAH NOTA JUAL ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (89,'x23_indent','2016-12-29','22:52:24','alex','TAMBAH NOTA INDENT NI161229-006');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (90,'x23_notajual','2016-12-29','22:54:39','alex','TAMBAH NOTA JUAL ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (91,'x23_indent','2016-12-29','22:54:40','alex','TAMBAH NOTA INDENT NI161229-007');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (92,'x23_kwitansi','2016-12-29','22:54:59','alex','TAMBAH KWITANSI KI161229-006');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (93,'x23_notajual','2016-12-29','22:55:46','alex','TAMBAH NOTA JUAL ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (94,'x23_indent','2016-12-29','22:55:47','alex','TAMBAH NOTA INDENT NI161229-008');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (95,'x23_notajual','2016-12-29','22:57:39','alex','TAMBAH NOTA JUAL ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (96,'x23_notajual','2016-12-29','22:57:57','alex','TAMBAH NOTA JUAL ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (97,'x23_notajual','2016-12-29','22:59:00','alex','TAMBAH NOTA JUAL ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (98,'x23_notajual','2016-12-29','22:59:22','alex','TAMBAH NOTA JUAL ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (99,'x23_notajual','2016-12-29','23:00:36','alex','TAMBAH NOTA JUAL ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (100,'x23_indent','2016-12-29','23:02:56','alex','TAMBAH NOTA INDENT NI161229-009');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (101,'x23_notajual','2016-12-29','23:03:28','alex','TAMBAH NOTA JUAL NJ2161229-017');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (102,'x23_notajual','2016-12-29','23:04:00','alex','TAMBAH NOTA JUAL NJ2161229-018');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (103,'x23_indent','2016-12-29','23:04:01','alex','TAMBAH NOTA INDENT NI161229-010');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (104,'x23_notabeli','2016-12-30','19:19:49','alex','TAMBAH NOTA BELI NB2161230-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (105,'x23_stokpart','2016-12-30','19:20:28','alex','TAMBAH STOK NB2161230-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (106,'x23_stokpart','2016-12-30','19:21:15','alex','UPDATE HARGA JUAL NB2161230-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (107,'x23_indent','2016-12-30','19:36:02','alex','TAMBAH NOTA INDENT NI161230-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (108,'x23_kwitansi','2016-12-30','19:37:18','alex','TAMBAH KWITANSI KI161230-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (109,'x23_notaservice','2016-12-30','19:37:33','alex','UPDATE NOTA SERVIS NS161230-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (110,'x23_notabeli','2016-12-30','19:39:15','alex','TAMBAH NOTA BELI NB2161230-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (111,'x23_stokpart','2016-12-30','19:39:55','alex','TAMBAH STOK NB2161230-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (112,'x23_stokpart','2016-12-30','19:40:17','alex','UPDATE HARGA JUAL NB2161230-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (113,'x23_notajual','2016-12-30','19:51:17','alex','TAMBAH NOTA JUAL ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (114,'x23_kwitansi','2016-12-30','19:55:41','alex','TAMBAH KWITANSI KPJ161230-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (115,'x23_notajual','2016-12-30','19:58:24','alex','TAMBAH NOTA JUAL NJ2161230-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (116,'x23_kwitansi','2016-12-30','20:03:16','alex','TAMBAH KWITANSI KPJ161230-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (117,'x23_kaskecil','2016-12-30','20:56:37','alex','OUTPUT 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (118,'x23_kaskecil','2016-12-30','20:56:54','alex','OUTPUT 2');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (119,'x23_kaskecil','2016-12-30','20:57:37','alex','INPUT 3');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (120,'x23_kaskecil','2016-12-30','20:57:48','alex','INPUT 4');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (121,'x23_kaskecil','2016-12-30','20:58:21','alex','UBAH');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (122,'x23_kaskecil','2016-12-30','20:58:26','alex','UBAH');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (123,'x23_kaskecil','2016-12-30','20:58:37','alex','UBAH');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (124,'x23_kaskecil','2016-12-30','20:58:41','alex','UBAH');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (125,'x23_kaskecil','2016-12-30','20:58:47','alex','UBAH');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (126,'x23_kaskecil','2016-12-30','20:58:54','alex','HAPUS  ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (127,'x23_kaskecil','2016-12-30','20:58:56','alex','HAPUS  ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (128,'x23_kaskecil','2016-12-30','20:59:01','alex','HAPUS  ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (129,'x23_kaskecil','2016-12-30','20:59:03','alex','HAPUS  ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (130,'x23_notaservice','2016-12-30','21:34:02','alex','UPDATE NOTA SERVIS NS161230-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (131,'x23_kwitansi','2016-12-30','21:35:38','alex','TAMBAH KWITANSI KS161230-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (132,'x23_notabeli','2016-12-30','21:44:59','alex','TAMBAH NOTA BELI NB2161230-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (133,'x23_stokpart','2016-12-30','21:45:30','alex','TAMBAH STOK NB2161230-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (134,'x23_stokpart','2016-12-30','21:46:00','alex','UPDATE HARGA JUAL NB2161230-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (135,'x23_notajual','2016-12-30','21:47:35','alex','TAMBAH NOTA JUAL NJ2161230-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (136,'x23_kwitansi','2016-12-30','21:48:24','alex','TAMBAH KWITANSI KPJ161230-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (137,'x23_abis_dkonfirmasi','2016-12-30','22:11:10','alex','MENYETUJUI KONFIRMASI KASKECIL ID 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (138,'x23_abis_dkonfirmasi','2016-12-30','22:11:33','alex','MENYETUJUI KONFIRMASI KASKECIL ID 4');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (139,'x23_notajual','2016-12-30','22:54:34','alex','TAMBAH NOTA JUAL NJ2161230-004');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (140,'x23_kwitansi','2016-12-30','23:01:51','alex','TAMBAH KWITANSI KPJ161230-004');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (141,'x23_returbeli','2016-12-30','23:06:31','alex','TAMBAH RETUR BELI NB2161230-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (142,'x23_returbeli','2016-12-30','23:07:11','alex','KONFIRMASI RETUR BELI NR2161230-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (143,'x23_abis_dkonfirmasi','2016-12-30','23:08:06','alex','MENYETUJUI KONFIRMASI RETUR BELI ID 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (144,'x23_indent','2016-12-30','12:56:14','alex','TAMBAH NOTA INDENT NI161230-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (145,'x23_kwitansi','2016-12-30','12:58:14','alex','TAMBAH KWITANSI KI161230-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (146,'x23_kwitansi','2016-12-30','15:01:04','alex','TAMBAH KWITANSI KS161230-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (147,'x23_tutupharian','2016-12-30','22:02:10','alex','TAMBAH TUTUP HARIAN HARIAN ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (148,'x23_tutupharian','2016-12-30','22:03:04','alex','HAPUS TUTUP HARIAN HARIAN ID 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (149,'x23_tutupharian','2016-12-30','22:03:10','alex','HAPUS TUTUP HARIAN HARIAN ID 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (150,'x23_tutupharian','2016-12-30','22:03:10','alex','TAMBAH TUTUP HARIAN HARIAN ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (151,'x23_tutupharian','2016-12-30','22:03:44','alex','HAPUS TUTUP HARIAN HARIAN ID 2');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (152,'x23_tutupharian','2016-12-30','22:05:47','alex','HAPUS TUTUP HARIAN HARIAN ID 2');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (153,'x23_tutupharian','2016-12-30','22:05:48','alex','TAMBAH TUTUP HARIAN HARIAN ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (154,'x23_tutupharian','2016-12-30','22:05:57','alex','HAPUS TUTUP HARIAN HARIAN ID 3');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (155,'x23_notaservice','2016-12-30','22:43:59','alex','UPDATE NOTA SERVIS NS161230-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (156,'x23_tutupharian','2016-12-30','22:45:02','alex','HAPUS TUTUP HARIAN HARIAN ID 3');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (157,'x23_kwitansi','2016-12-30','22:45:22','alex','TAMBAH KWITANSI KS161230-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (158,'x23_tutupharian','2016-12-30','22:45:30','alex','HAPUS TUTUP HARIAN HARIAN ID 3');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (159,'x23_tutupharian','2016-12-30','22:48:52','alex','HAPUS TUTUP HARIAN HARIAN ID 3');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (160,'x23_tutupharian','2016-12-30','22:49:22','alex','HAPUS TUTUP HARIAN HARIAN ID 3');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (161,'x23_tutupharian','2016-12-30','22:49:22','alex','TAMBAH TUTUP HARIAN HARIAN ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (162,'x23_tutupharian','2016-12-30','10:04:52','alex','HAPUS TUTUP HARIAN HARIAN ID 4');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (163,'x23_tutupharian','2016-12-30','10:10:22','alex','HAPUS TUTUP HARIAN HARIAN ID 4');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (164,'x23_tutupharian','2016-12-30','10:10:22','alex','TAMBAH TUTUP HARIAN HARIAN ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (165,'x23_notajual','2017-01-02','18:49:23','alex','TAMBAH NOTA JUAL NJ2170102-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (166,'x23_kwitansi','2017-01-02','18:49:54','alex','TAMBAH KWITANSI KPJ170102-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (167,'x23_indent','2017-01-02','18:50:34','alex','TAMBAH NOTA INDENT NI170102-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (168,'x23_kwitansi','2017-01-02','18:51:01','alex','TAMBAH KWITANSI KI170102-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (169,'x23_kwitansi','2017-01-02','18:51:40','alex','TAMBAH KWITANSI KI170102-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (170,'x23_notabeli','2017-01-02','18:52:49','alex','TAMBAH NOTA BELI NB2170102-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (171,'x23_stokpart','2017-01-02','18:53:13','alex','TAMBAH STOK NB2170102-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (172,'x23_stokpart','2017-01-02','18:53:41','alex','UPDATE HARGA JUAL NB2170102-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (173,'x23_notajual','2017-01-02','18:55:30','alex','TAMBAH NOTA JUAL ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (174,'x23_kwitansi','2017-01-02','18:56:36','alex','TAMBAH KWITANSI KPJ170102-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (175,'x23_kaskecil','2017-01-02','19:04:38','alex','OUTPUT 10.000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (176,'x23_abis_dkonfirmasi','2017-01-02','19:05:09','alex','MENYETUJUI KONFIRMASI KASKECIL ID 5');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (177,'x23_notajual','2017-01-02','19:06:47','alex','TAMBAH NOTA JUAL NJ2170102-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (178,'x23_kwitansi','2017-01-02','19:07:23','alex','TAMBAH KWITANSI KPJ170102-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (179,'x23_indent','2017-01-02','19:08:49','alex','TAMBAH NOTA INDENT NI170102-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (180,'x23_kwitansi','2017-01-02','19:09:27','alex','TAMBAH KWITANSI KI170102-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (181,'x23_notabeli','2017-01-02','19:11:56','alex','TAMBAH NOTA BELI NB2170102-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (182,'x23_stokpart','2017-01-02','19:12:57','alex','TAMBAH STOK NB2170102-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (183,'x23_stokpart','2017-01-02','19:13:22','alex','UPDATE HARGA JUAL NB2170102-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (184,'x23_notajual','2017-01-02','19:14:49','alex','TAMBAH NOTA JUAL ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (185,'x23_kwitansi','2017-01-02','19:16:10','alex','TAMBAH KWITANSI KPJ170102-004');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (186,'x23_kwitansi','2017-01-02','19:27:51','alex','TAMBAH KWITANSI KPJ170102-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (187,'x23_kwitansi','2017-01-02','19:28:31','alex','TAMBAH KWITANSI KPJ170102-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (188,'x23_kwitansi','2017-01-02','19:30:22','alex','TAMBAH KWITANSI KI170102-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (189,'x23_kwitansi','2017-01-02','19:30:44','alex','TAMBAH KWITANSI KI170102-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (190,'x23_kwitansi','2017-01-02','19:31:09','alex','TAMBAH KWITANSI KI170102-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (191,'x23_pindah','2017-01-02','20:00:52','alex','TAMBAH PINDAH STOK 2017-01-02 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (192,'x23_abis_dkonfirmasi','2017-01-02','20:05:04','alex','MENYETUJUI KONFIRMASI PEMINDAHAN STOK ID 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (193,'x23_opname','2017-01-02','20:29:30','alex','TAMBAH STOCK OPNAME 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (194,'x23_abis_dkonfirmasi','2017-01-02','20:32:12','alex','MENYETUJUI KONFIRMASI STOCK OPNAME ID 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (195,'x23_stokmin','2017-01-02','20:49:09','alex','TAMBAH STOK MINIMUM 5');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (196,'x23_notabeli','2017-01-03','18:51:29','alex','TAMBAH NOTA BELI NB2170103-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (197,'x23_stokpart','2017-01-03','18:51:50','alex','TAMBAH STOK NB2170103-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (198,'x23_stokpart','2017-01-03','18:52:16','alex','UPDATE HARGA JUAL NB2170103-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (199,'x23_notabeli','2017-01-03','18:54:02','alex','TAMBAH NOTA BELI NB2170103-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (200,'x23_stokpart','2017-01-03','19:01:13','alex','TAMBAH STOK NB2170103-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (201,'x23_stokpart','2017-01-03','20:03:13','alex','UPDATE HARGA JUAL NB2170103-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (202,'x23_notajual','2017-01-03','20:08:20','alex','TAMBAH NOTA JUAL NJ2170103-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (203,'x23_kwitansi','2017-01-03','20:09:24','alex','TAMBAH KWITANSI KPJ170103-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (204,'x23_notajual','2017-01-03','20:12:54','alex','TAMBAH NOTA JUAL NJ2170103-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (205,'x23_indent','2017-01-03','20:12:55','alex','TAMBAH NOTA INDENT NI170103-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (206,'x23_kwitansi','2017-01-03','20:14:21','alex','TAMBAH KWITANSI KPJ170103-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (207,'x23_kwitansi','2017-01-03','20:15:49','alex','TAMBAH KWITANSI KI170103-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (208,'x23_returbeli','2017-01-03','20:29:48','alex','TAMBAH RETUR BELI NB2170103-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (209,'x23_returbeli','2017-01-03','20:53:56','alex','TAMBAH RETUR BELI NB2161230-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (210,'x23_returbeli','2017-01-03','20:55:32','alex','TAMBAH RETUR BELI NB2161230-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (211,'x23_returbeli','2017-01-03','21:02:39','alex','KONFIRMASI RETUR BELI NR2170103-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (212,'x23_returbeli','2017-01-03','21:04:00','alex','KONFIRMASI RETUR BELI NR2170103-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (213,'x23_abis_dkonfirmasi','2017-01-03','21:07:51','alex','MENYETUJUI KONFIRMASI RETUR BELI ID 4');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (214,'x23_abis_dkonfirmasi','2017-01-03','21:08:07','alex','MENOLAK KONFIRMASI RETUR BELI ID 3');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (215,'x23_returbeli','2017-01-03','21:20:30','alex','TAMBAH RETUR BELI NB2161230-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (216,'x23_returbeli','2017-01-03','21:21:10','alex','KONFIRMASI RETUR BELI NR2170103-004');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (217,'x23_abis_dkonfirmasi','2017-01-03','21:21:47','alex','MENYETUJUI KONFIRMASI RETUR BELI ID 5');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (218,'x23_returbeli','2017-01-03','21:26:44','alex','TAMBAH RETUR BELI NB2161230-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (219,'x23_returbeli','2017-01-03','21:27:40','alex','KONFIRMASI RETUR BELI NR2170103-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (220,'x23_notabeli','2017-01-03','21:29:37','alex','BAYAR NOTA BELI NB2170103-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (221,'x23_notabeli','2017-01-03','21:40:19','alex','BAYAR NOTA BELI NB2170103-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (222,'x23_abis_dkonfirmasi','2017-01-03','21:43:54','alex','MENYETUJUI KONFIRMASI RETUR BELI ID 6');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (223,'x23_notabeli','2017-01-03','21:59:58','alex','BAYAR NOTA BELI NB2161230-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (224,'x23_notabeli','2017-01-03','22:15:35','alex','BAYAR NOTA BELI NB2161230-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (225,'x23_notabeli','2017-01-03','22:21:31','alex','BAYAR NOTA BELI NB2161230-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (226,'x23_notabeli','2017-01-03','22:25:09','alex','BAYAR NOTA BELI NB2170103-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (227,'x23_notabeli','2017-01-03','22:27:45','alex','BAYAR NOTA BELI NB2170103-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (228,'x23_notabeli','2017-01-03','22:29:25','alex','BAYAR NOTA BELI NB2170103-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (229,'x23_notabeli','2017-01-03','22:30:40','alex','BAYAR NOTA BELI NB2161230-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (230,'x23_notabeli','2017-01-03','22:31:53','alex','BAYAR NOTA BELI NB2161230-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (231,'x23_notabeli','2017-01-03','22:33:24','alex','BAYAR NOTA BELI NB2161230-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (232,'x23_notabeli','2017-01-03','22:39:47','alex','BAYAR NOTA BELI NB2161230-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (233,'x23_returbeli','2017-01-04','13:49:57','alex','TAMBAH RETUR BELI NB2170102-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (234,'x23_returbeli','2017-01-04','14:12:41','alex','TAMBAH RETUR BELI NB2161230-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (235,'x23_returbeli','2017-01-04','14:14:24','alex','KONFIRMASI RETUR BELI NR2170104-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (236,'x23_abis_dkonfirmasi','2017-01-04','14:16:54','alex','MENYETUJUI KONFIRMASI RETUR BELI ID 7');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (237,'x23_returbeli','2017-01-04','14:52:19','alex','TAMBAH RETUR BELI NB2161230-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (238,'x23_notajual','2017-01-04','14:54:46','alex','TAMBAH NOTA JUAL NJ2170104-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (239,'x23_returbeli','2017-01-04','15:14:10','alex','KONFIRMASI RETUR BELI NR2170104-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (240,'x23_kwitansi','2017-01-04','15:15:17','alex','TAMBAH KWITANSI KPJ170104-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (241,'x23_abis_dkonfirmasi','2017-01-04','15:22:25','alex','MENOLAK KONFIRMASI RETUR BELI ID 9');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (242,'x23_karyawan','2017-01-04','15:46:51','alex','UBAH KARYAWAN KEPALA BENGKEL');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (243,'x23_piutang','2017-01-04','15:47:48','alex','TAMBAH PIUTANG COUNTER PART 12345');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (244,'x23_piutang','2017-01-04','15:54:51','alex','TAMBAH PIUTANG COUNTER PART 121212');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (245,'tbl_piutang','2017-01-04','15:56:52','alex','TAMBAH PIUTANG STAF ADMINISTRASI 123');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (246,'tbl_piutang','2017-01-04','16:00:29','alex','TAMBAH PEMBAYARAN STAF GUDANG PDI 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (247,'tbl_piutang','2017-01-04','16:01:00','alex','TAMBAH PEMBAYARAN STAF SALES 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (248,'tbl_piutang','2017-01-04','16:02:33','alex','TAMBAH PIUTANG STAF GUDANG PDI 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (249,'x23_piutang','2017-01-04','16:12:04','alex','TAMBAH PIUTANG COUNTER PART 12345');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (250,'x23_abis_dkonfirmasi','2017-01-04','16:22:56','alex','MENYETUJUI KONFIRMASI PIUTANG KARYAWAN ID 3');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (251,'tbl_abis_dkonfirmasi','2017-01-04','16:23:03','alex','MENYETUJUI KONFIRMASI PIUTANG KARYAWAN ID 38');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (252,'x23_piutang','2017-01-04','16:29:29','alex','TAMBAH PIUTANG KASIR 123');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (253,'x23_piutang','2017-01-04','16:29:50','alex','TAMBAH PIUTANG MEKANIK DUA 123');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (254,'x23_piutang','2017-01-04','16:30:15','alex','TAMBAH PIUTANG MEKANIK DUA 123');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (255,'x23_abis_dkonfirmasi','2017-01-04','16:31:01','alex','MENYETUJUI KONFIRMASI PIUTANG KARYAWAN ID 4');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (256,'x23_abis_dkonfirmasi','2017-01-04','16:31:51','alex','MENOLAK KONFIRMASI PIUTANG KARYAWAN ID 5');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (257,'tbl_abis_dkonfirmasi','2017-01-04','16:44:01','alex','MENYETUJUI KONFIRMASI PIUTANG KARYAWAN ID 35');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (258,'x23_piutang','2017-01-04','16:45:18','alex','TAMBAH PEMBAYARAN COUNTER PART 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (259,'x23_piutang','2017-01-04','16:45:57','alex','TAMBAH PEMBAYARAN COUNTER PART 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (260,'x23_abis_dkonfirmasi','2017-01-04','16:47:35','alex','MENYETUJUI KONFIRMASI PEMBAYARAN PIUTANG KARYAWAN ID 7');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (261,'x23_abis_dkonfirmasi','2017-01-04','16:47:47','alex','MENYETUJUI KONFIRMASI PEMBAYARAN PIUTANG KARYAWAN ID 8');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (262,'x23_piutang','2017-01-04','19:50:02','alex','TAMBAH PEMBAYARAN COUNTER PART 123');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (263,'x23_abis_dkonfirmasi','2017-01-04','19:58:16','alex','MENYETUJUI KONFIRMASI PEMBAYARAN PIUTANG KARYAWAN ID 9');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (264,'x23_piutang','2017-01-04','20:00:19','alex','TAMBAH PEMBAYARAN COUNTER PART 12');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (265,'x23_abis_dkonfirmasi','2017-01-04','20:01:31','alex','MENOLAK KONFIRMASI PEMBAYARAN PIUTANG KARYAWAN ID 10');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (266,'x23_piutang','2017-01-04','20:08:10','alex','TAMBAH PEMBAYARAN COUNTER PART 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (267,'x23_abis_dkonfirmasi','2017-01-04','20:08:46','alex','MENYETUJUI KONFIRMASI PEMBAYARAN PIUTANG KARYAWAN ID 11');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (268,'abs_x23_status','2017-01-04','21:05:29','alex','TAMBAH DISPENSASI H2H3-011 IZIN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (269,'abs_x23_status','2017-01-04','21:05:51','alex','TAMBAH DISPENSASI H2H3-008 SAKIT');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (270,'abs_x23_status','2017-01-04','21:06:21','alex','TAMBAH DISPENSASI H2H3-011 IZIN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (271,'abs_x23_status','2017-01-04','21:07:41','alex','TAMBAH DISPENSASI H2H3-011 IZIN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (272,'abs_x23_status','2017-01-04','21:07:42','alex','TAMBAH DISPENSASI H2H3-011 IZIN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (273,'abs_x23_status','2017-01-04','21:07:44','alex','TAMBAH DISPENSASI H2H3-011 IZIN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (274,'abs_x23_status','2017-01-04','21:07:46','alex','TAMBAH DISPENSASI H2H3-011 IZIN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (275,'abs_status','2017-01-04','21:08:08','alex','TAMBAH DISPENSASI H1-001 IZIN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (276,'abs_status','2017-01-04','21:08:30','alex','TAMBAH DISPENSASI H1-005 IZIN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (277,'abs_status','2017-01-04','21:09:11','alex','TAMBAH DISPENSASI H1-005 SAKIT');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (278,'abs_status','2017-01-04','21:09:36','alex','TAMBAH DISPENSASI H1-001 SAKIT');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (279,'abs_x23_status','2017-01-04','21:09:58','alex','TAMBAH DISPENSASI H2H3-011 IZIN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (280,'abs_x23_status','2017-01-04','21:10:13','alex','TAMBAH DISPENSASI H2H3-011 IZIN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (281,'abs_x23_status','2017-01-04','21:10:20','alex','TAMBAH DISPENSASI H2H3-011 IZIN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (282,'abs_x23_status','2017-01-04','21:10:56','alex','TAMBAH DISPENSASI H2H3-011 IZIN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (283,'abs_x23_status','2017-01-04','21:11:01','alex','TAMBAH DISPENSASI H2H3-011 IZIN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (284,'abs_x23_status','2017-01-04','21:12:32','alex','TAMBAH DISPENSASI H2H3-011 IZIN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (285,'abs_x23_status','2017-01-04','21:12:37','alex','TAMBAH DISPENSASI H2H3-011 IZIN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (286,'abs_status','2017-01-04','21:15:48','alex','TAMBAH DISPENSASI H1-003 IZIN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (287,'abs_status','2017-01-04','21:16:06','alex','TAMBAH DISPENSASI H1-006 SAKIT');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (288,'abs_status','2017-01-04','21:16:34','alex','TAMBAH DISPENSASI H1-006 SAKIT');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (289,'abs_x23_status','2017-01-04','21:17:48','alex','TAMBAH DISPENSASI H2H3-001 IZIN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (290,'abs_x23_status','2017-01-04','21:18:24','alex','TAMBAH DISPENSASI H2H3-012 IZIN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (291,'abs_x23_status','2017-01-04','21:19:06','alex','TAMBAH DISPENSASI H2H3-014 SAKIT');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (292,'abs_x23_status','2017-01-04','21:19:35','alex','HAPUS DISPENSASI H2H3-012 IZIN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (293,'abs_x23_status','2017-01-04','21:19:40','alex','HAPUS DISPENSASI H2H3-012 IZIN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (294,'abs_x23_status','2017-01-04','21:19:44','alex','HAPUS DISPENSASI H2H3-012 IZIN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (295,'abs_x23_status','2017-01-04','21:19:50','alex','HAPUS DISPENSASI H2H3-014 SAKIT');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (296,'abs_x23_status','2017-01-04','21:19:55','alex','HAPUS DISPENSASI H2H3-014 SAKIT');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (297,'abs_x23_status','2017-01-04','21:19:59','alex','HAPUS DISPENSASI H2H3-014 SAKIT');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (298,'abs_x23_status','2017-01-04','21:20:25','alex','TAMBAH DISPENSASI H2H3-002 IZIN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (299,'abs_x23_status','2017-01-04','21:23:05','alex','TAMBAH DISPENSASI H2H3-012 SAKIT');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (300,'tbl_kaskecil','2017-01-04','21:35:23','alex','OUTPUT 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (301,'x23_kaskecil','2017-01-04','21:35:37','alex','INPUT 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (302,'x23_potkompensasi','2017-01-04','22:22:24','alex','TAMBAH POTONGAN KOMPENSASI SALES ADVISOR 12345');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (303,'x23_potkompensasi','2017-01-04','22:27:26','alex','TAMBAH POTONGAN KOMPENSASI SALES ADVISOR 100000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (304,'x23_potkompensasi','2017-01-04','22:32:41','alex','TAMBAH POTONGAN KOMPENSASI COUNTER PART 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (305,'x23_potkompensasi','2017-01-04','22:32:48','alex','TAMBAH POTONGAN KOMPENSASI COUNTER PART 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (306,'x23_potkompensasi','2017-01-04','22:33:09','alex','TAMBAH POTONGAN KOMPENSASI COUNTER PART 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (307,'x23_potkompensasi','2017-01-04','22:36:53','alex','TAMBAH POTONGAN KOMPENSASI COUNTER PART 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (308,'x23_potkompensasi','2017-01-04','22:37:13','alex','TAMBAH POTONGAN KOMPENSASI COUNTER PART 2');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (309,'x23_potkompensasi','2017-01-04','22:37:40','alex','TAMBAH POTONGAN KOMPENSASI KASIR 3');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (310,'x23_potkompensasi','2017-01-04','22:39:00','alex','TAMBAH POTONGAN KOMPENSASI KEPALA MEKANIK 4');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (311,'x23_potkompensasi','2017-01-04','22:40:24','alex','TAMBAH POTONGAN KOMPENSASI KEPALA BENGKEL 3333');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (312,'x23_potkompensasi','2017-01-04','22:41:05','alex','TAMBAH POTONGAN KOMPENSASI SALES ADVISOR 123123');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (313,'x23_potkompensasi','2017-01-04','22:41:35','alex','TAMBAH POTONGAN KOMPENSASI MEKANIK TIGA 5');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (314,'x23_potkompensasi','2017-01-04','22:41:50','alex','TAMBAH POTONGAN KOMPENSASI KEPALA BENGKEL 12');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (315,'x23_potkompensasi','2017-01-04','22:42:57','alex','TAMBAH POTONGAN KOMPENSASI COUNTER PART 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (316,'x23_potkompensasi','2017-01-04','22:43:17','alex','TAMBAH POTONGAN KOMPENSASI COUNTER PART 2');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (317,'x23_potkompensasi','2017-01-04','22:43:44','alex','TAMBAH POTONGAN KOMPENSASI KEPALA MEKANIK 3');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (318,'x23_potkompensasi','2017-01-04','22:48:48','alex','TAMBAH POTONGAN KOMPENSASI COUNTER PART 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (319,'x23_potkompensasi','2017-01-04','22:49:09','alex','TAMBAH POTONGAN KOMPENSASI KASIR 2');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (320,'x23_potkompensasi','2017-01-04','22:49:29','alex','TAMBAH POTONGAN KOMPENSASI KEPALA BENGKEL 3');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (321,'x23_potkompensasi','2017-01-04','22:49:55','alex','TAMBAH POTONGAN KOMPENSASI KEPALA MEKANIK 4');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (322,'x23_potkompensasi','2017-01-04','22:50:14','alex','TAMBAH POTONGAN KOMPENSASI MEKANIK SATU 5');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (323,'x23_potkompensasi','2017-01-04','22:50:38','alex','TAMBAH POTONGAN KOMPENSASI MEKANIK TIGA 6');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (324,'x23_potkompensasi','2017-01-04','22:50:54','alex','TAMBAH POTONGAN KOMPENSASI SALES ADVISOR 7');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (325,'x23_potkompensasi','2017-01-04','22:55:51','alex','TAMBAH POTONGAN KOMPENSASI KEPALA MEKANIK 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (326,'x23_potkompensasi','2017-01-04','22:56:19','alex','TAMBAH POTONGAN KOMPENSASI COUNTER PART 2');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (327,'x23_potkompensasi','2017-01-04','22:56:35','alex','TAMBAH POTONGAN KOMPENSASI SALES ADVISOR 7');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (328,'x23_potkompensasi','2017-01-04','22:59:40','alex','TAMBAH POTONGAN KOMPENSASI COUNTER PART 2');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (329,'x23_potkompensasi','2017-01-04','23:00:25','alex','TAMBAH POTONGAN KOMPENSASI COUNTER PART 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (330,'x23_potkompensasi','2017-01-04','23:01:39','alex','TAMBAH POTONGAN KOMPENSASI COUNTER PART 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (331,'x23_potkompensasi','2017-01-04','23:01:51','alex','TAMBAH POTONGAN KOMPENSASI COUNTER PART 2');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (332,'x23_potkompensasi','2017-01-04','23:02:14','alex','TAMBAH POTONGAN KOMPENSASI KASIR 3');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (333,'x23_potkompensasi','2017-01-04','23:02:30','alex','TAMBAH POTONGAN KOMPENSASI KEPALA BENGKEL 4');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (334,'x23_potkompensasi','2017-01-04','23:02:56','alex','TAMBAH POTONGAN KOMPENSASI KEPALA BENGKEL 5');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (335,'x23_potkompensasi','2017-01-04','23:03:13','alex','TAMBAH POTONGAN KOMPENSASI KEPALA MEKANIK 6');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (336,'x23_karyawan','2017-01-04','23:04:12','alex','UBAH KARYAWAN MEKANIK DUA');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (337,'x23_potkompensasi','2017-01-04','23:04:28','alex','TAMBAH POTONGAN KOMPENSASI MEKANIK DUA 7');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (338,'x23_potkompensasi','2017-01-04','23:05:03','alex','TAMBAH POTONGAN KOMPENSASI MEKANIK SATU 6');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (339,'x23_potkompensasi','2017-01-04','23:05:26','alex','TAMBAH POTONGAN KOMPENSASI SALES ADVISOR 9');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (340,'x23_potkompensasi','2017-01-04','23:05:57','alex','TAMBAH POTONGAN KOMPENSASI MEKANIK SATU 10');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (341,'x23_abis_dkonfirmasi','2017-01-04','23:08:26','alex','MENYETUJUI KONFIRMASI POTONGAN KOMPENSASI ID 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (342,'x23_abis_dkonfirmasi','2017-01-04','23:09:24','alex','MENYETUJUI KONFIRMASI POTONGAN KOMPENSASI ID 2');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (343,'x23_potkompensasi','2017-01-04','23:15:53','alex','TAMBAH POTONGAN KOMPENSASI COUNTER PART 2');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (344,'x23_potkompensasi','2017-01-04','23:22:57','alex','TAMBAH POTONGAN KOMPENSASI COUNTER PART 1000000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (345,'x23_karyawan','2017-01-04','23:23:32','alex','UBAH KARYAWAN COUNTER PART');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (346,'x23_potkompensasi','2017-01-11','16:13:26','alex','TAMBAH POTONGAN KOMPENSASI COUNTER PART 20000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (347,'x23_potkompensasi','2017-01-11','16:13:48','alex','TAMBAH POTONGAN KOMPENSASI KEPALA BENGKEL 30000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (348,'x23_potkompensasi','2017-01-11','16:14:47','alex','TAMBAH POTONGAN KOMPENSASI MEKANIK TIGA 40000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (349,'tbl_potkompensasi','2017-01-11','16:23:02','alex','TAMBAH POTONGAN KOMPENSASI STAF ADMINISTRASI 10000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (350,'tbl_potkompensasi','2017-01-11','16:23:24','alex','TAMBAH POTONGAN KOMPENSASI STAF GUDANG PDI 20000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (351,'tbl_abis_dkonfirmasi','2017-01-11','19:49:20','alex','MENYETUJUI KONFIRMASI SURAT PESANANTONGAN KOMPENSASI ID 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (352,'x23_abis_dkonfirmasi','2017-01-11','19:54:56','alex','MENYETUJUI KONFIRMASI POTONGAN KOMPENSASI ID 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (353,'x23_abis_dkonfirmasi','2017-01-11','20:37:01','alex','MENYETUJUI KONFIRMASI POTONGAN KOMPENSASI ID 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (354,'x23_abis_dkonfirmasi','2017-01-11','20:42:15','alex','MENYETUJUI KONFIRMASI POTONGAN KOMPENSASI ID 2');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (355,'x23_abis_dkonfirmasi','2017-01-11','20:44:40','alex','MENOLAK KONFIRMASI POTONGAN KOMPENSASI ID 3');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (356,'tbl_abis_dkonfirmasi','2017-01-11','20:46:32','alex','MENOLAK KONFIRMASI SURAT PESANANTONGAN KOMPENSASI ID 2');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (357,'x23_abis_dkonfirmasi','2017-01-11','20:49:01','alex','MENOLAK KONFIRMASI POTONGAN KOMPENSASI ID 3');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (358,'tbl_abis_dkonfirmasi','2017-01-11','20:49:23','alex','MENYETUJUI KONFIRMASI SURAT PESANANTONGAN KOMPENSASI ID 2');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (359,'tbl_abis_dkonfirmasi','2017-01-11','20:49:41','alex','MENOLAK KONFIRMASI SURAT PESANANTONGAN KOMPENSASI ID 2');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (360,'x23_abis_dkonfirmasi','2017-01-11','20:57:52','alex','MENOLAK KONFIRMASI POTONGAN KOMPENSASI ID 3');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (361,'x23_potkompensasi','2017-01-11','20:58:55','alex','TAMBAH POTONGAN KOMPENSASI SALES ADVISOR 50000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (362,'x23_abis_dkonfirmasi','2017-01-11','20:59:10','alex','MENYETUJUI KONFIRMASI POTONGAN KOMPENSASI ID 4');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (363,'tbl_potkompensasi','2017-01-11','20:59:55','alex','TAMBAH POTONGAN KOMPENSASI STAF ADMINISTRASI 333');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (364,'tbl_abis_dkonfirmasi','2017-01-11','21:00:17','alex','MENYETUJUI KONFIRMASI SURAT PESANANTONGAN KOMPENSASI ID 3');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (365,'x23_potkompensasi','2017-01-11','21:03:14','alex','TAMBAH POTONGAN KOMPENSASI KASIR 60000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (366,'x23_abis_dkonfirmasi','2017-01-11','21:04:37','alex','MENYETUJUI KONFIRMASI POTONGAN KOMPENSASI ID 5');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (367,'x23_abis_dkonfirmasi','2017-01-11','21:11:58','alex','MENYETUJUI KONFIRMASI POTONGAN KOMPENSASI ID 4');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (368,'x23_abis_dkonfirmasi','2017-01-11','21:12:54','alex','MENYETUJUI KONFIRMASI POTONGAN KOMPENSASI ID 5');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (369,'abs_status','2017-01-11','21:23:19','alex','TAMBAH DISPENSASI H1-003 IZIN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (370,'abs_status','2017-01-11','21:23:46','alex','TAMBAH DISPENSASI H1-003 SAKIT');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (371,'abs_status','2017-01-11','21:24:14','alex','TAMBAH DISPENSASI H1-003 SAKIT');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (372,'abs_status','2017-01-11','21:28:00','alex','TAMBAH DISPENSASI H1-003 IZIN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (373,'abs_status','2017-01-11','21:28:18','alex','TAMBAH DISPENSASI H1-003 SAKIT');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (374,'abs_status','2017-01-11','21:29:07','alex','TAMBAH DISPENSASI H1-003 IZIN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (375,'abs_status','2017-01-11','21:30:23','alex','TAMBAH DISPENSASI H1-003 IZIN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (376,'x23_potkompensasi','2017-01-11','21:35:46','alex','TAMBAH POTONGAN KOMPENSASI COUNTER PART 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (377,'x23_abis_dkonfirmasi','2017-01-11','21:39:52','alex','MENOLAK KONFIRMASI POTONGAN KOMPENSASI ID 6');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (378,'x23_potkompensasi','2017-01-11','21:40:39','alex','TAMBAH POTONGAN KOMPENSASI COUNTER PART 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (379,'x23_abis_dkonfirmasi','2017-01-11','21:41:20','alex','MENYETUJUI KONFIRMASI POTONGAN KOMPENSASI ID 7');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (380,'x23_potkompensasi','2017-01-11','21:54:10','alex','TAMBAH POTONGAN KOMPENSASI COUNTER PART 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (381,'x23_potkompensasi','2017-01-11','21:54:28','alex','TAMBAH POTONGAN KOMPENSASI COUNTER PART 2');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (382,'x23_potkompensasi','2017-01-11','21:54:43','alex','TAMBAH POTONGAN KOMPENSASI COUNTER PART 3');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (383,'x23_abis_dkonfirmasi','2017-01-11','21:55:27','alex','MENOLAK KONFIRMASI POTONGAN KOMPENSASI ID 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (384,'x23_abis_dkonfirmasi','2017-01-11','22:00:16','alex','MENYETUJUI KONFIRMASI POTONGAN KOMPENSASI ID 2');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (385,'x23_abis_dkonfirmasi','2017-01-11','22:00:58','alex','MENYETUJUI KONFIRMASI POTONGAN KOMPENSASI ID 3');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (386,'x23_potkompensasi','2017-01-11','22:05:01','alex','TAMBAH POTONGAN KOMPENSASI KEPALA BENGKEL 4');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (387,'x23_abis_dkonfirmasi','2017-01-11','22:05:40','alex','MENYETUJUI KONFIRMASI POTONGAN KOMPENSASI ID 4');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (388,'x23_potkompensasi','2017-01-11','22:12:14','alex','HAPUS POTONGAN KOMPENSASI 4 KEPALA BENGKEL');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (389,'x23_potkompensasi','2017-01-11','22:12:47','alex','HAPUS POTONGAN KOMPENSASI 4 KEPALA BENGKEL');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (390,'x23_potkompensasi','2017-01-11','22:12:54','alex','HAPUS POTONGAN KOMPENSASI 4 KEPALA BENGKEL');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (391,'tbl_potkompensasi','2017-01-11','22:15:10','alex','TAMBAH POTONGAN KOMPENSASI KEPALA TOKO 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (392,'tbl_potkompensasi','2017-01-11','22:16:36','alex','TAMBAH POTONGAN KOMPENSASI KEPALA TOKO 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (393,'tbl_potkompensasi','2017-01-11','22:16:55','alex','TAMBAH POTONGAN KOMPENSASI KEPALA TOKO 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (394,'tbl_potkompensasi','2017-01-11','22:17:24','alex','HAPUS POTONGAN KOMPENSASI 6 KEPALA TOKO');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (395,'x23_potkompensasi','2017-01-11','22:18:06','alex','HAPUS POTONGAN KOMPENSASI 4 KEPALA BENGKEL');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (396,'tbl_potkompensasi','2017-01-11','22:18:40','alex','TAMBAH POTONGAN KOMPENSASI KEPALA TOKO 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (397,'tbl_potkompensasi','2017-01-11','22:18:52','alex','HAPUS POTONGAN KOMPENSASI 7 KEPALA TOKO');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (398,'tbl_potkompensasi','2017-01-11','22:19:52','alex','HAPUS POTONGAN KOMPENSASI 7 KEPALA TOKO');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (399,'tbl_potkompensasi','2017-01-11','22:19:56','alex','HAPUS POTONGAN KOMPENSASI 7 KEPALA TOKO');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (400,'tbl_potkompensasi','2017-01-11','22:20:21','alex','TAMBAH POTONGAN KOMPENSASI KEPALA TOKO 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (401,'tbl_potkompensasi','2017-01-11','22:22:04','alex','TAMBAH POTONGAN KOMPENSASI KEPALA TOKO 2');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (402,'tbl_abis_dkonfirmasi','2017-01-11','22:22:42','alex','MENYETUJUI KONFIRMASI SURAT PESANANTONGAN KOMPENSASI ID 5');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (403,'tbl_abis_dkonfirmasi','2017-01-11','22:22:58','alex','MENYETUJUI KONFIRMASI SURAT PESANANTONGAN KOMPENSASI ID 9');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (404,'tbl_abis_dkonfirmasi','2017-01-11','22:23:46','alex','MENOLAK KONFIRMASI SURAT PESANANTONGAN KOMPENSASI ID 4');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (405,'tbl_abis_dkonfirmasi','2017-01-11','22:24:32','alex','MENYETUJUI KONFIRMASI SURAT PESANANTONGAN KOMPENSASI ID 8');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (406,'x23_piutang','2017-01-11','22:36:42','alex','TAMBAH PIUTANG COUNTER PART 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (407,'x23_abis_dkonfirmasi','2017-01-11','22:37:10','alex','MENYETUJUI KONFIRMASI PIUTANG KARYAWAN ID 12');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (408,'x23_piutang','2017-01-11','22:42:30','alex','TAMBAH PIUTANG KEPALA BENGKEL 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (409,'x23_abis_dkonfirmasi','2017-01-11','22:43:32','alex','MENYETUJUI KONFIRMASI PIUTANG KARYAWAN ID 13');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (410,'x23_piutang','2017-01-11','22:47:04','alex','TAMBAH PEMBAYARAN KEPALA BENGKEL 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (411,'x23_abis_dkonfirmasi','2017-01-11','22:47:36','alex','MENYETUJUI KONFIRMASI PEMBAYARAN PIUTANG KARYAWAN ID 14');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (412,'x23_piutang','2017-01-11','22:50:06','alex','TAMBAH PEMBAYARAN KEPALA BENGKEL 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (413,'x23_piutang','2017-01-11','22:50:19','alex','TAMBAH PEMBAYARAN KEPALA BENGKEL 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (414,'x23_piutang','2017-01-11','22:50:32','alex','TAMBAH PEMBAYARAN KEPALA BENGKEL 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (415,'x23_potkompensasi','2017-01-12','13:31:02','alex','TAMBAH POTONGAN KOMPENSASI COUNTER PART 500000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (416,'x23_potkompensasi','2017-01-12','13:31:20','alex','TAMBAH POTONGAN KOMPENSASI COUNTER PART 500000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (417,'x23_abis_dkonfirmasi','2017-01-12','14:19:52','alex','MENYETUJUI KONFIRMASI POTONGAN KOMPENSASI ID 5');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (418,'tbl_potkompensasi','2017-01-12','14:37:59','alex','TAMBAH POTONGAN KOMPENSASI STAF DRIVER 500000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (419,'tbl_potkompensasi','2017-01-12','14:39:51','alex','TAMBAH POTONGAN KOMPENSASI STAF DRIVER 500000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (420,'tbl_abis_dkonfirmasi','2017-01-12','14:40:11','alex','MENYETUJUI KONFIRMASI SURAT PESANANTONGAN KOMPENSASI ID 10');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (421,'abs_x23_status','2017-01-13','11:38:58','alex','TAMBAH DISPENSASI H2H3-002 SAKIT');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (422,'abs_x23_status','2017-01-13','11:39:10','alex','HAPUS DISPENSASI H2H3-002 SAKIT');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (423,'abs_x23_status','2017-01-13','11:39:54','alex','HAPUS DISPENSASI H2H3-002 SAKIT');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (424,'abs_x23_status','2017-01-13','11:40:21','alex','TAMBAH DISPENSASI H2H3-002 IZIN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (425,'abs_x23_status','2017-01-13','11:40:29','alex','HAPUS DISPENSASI H2H3-002 IZIN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (426,'abs_x23_status','2017-01-13','11:42:17','alex','TAMBAH DISPENSASI H2H3-002 IZIN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (427,'abs_x23_status','2017-01-13','11:42:26','alex','HAPUS DISPENSASI H2H3-002 IZIN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (428,'abs_x23_status','2017-01-13','11:44:50','alex','TAMBAH DISPENSASI H2H3-002 IZIN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (429,'abs_x23_status','2017-01-13','11:46:02','alex','HAPUS DISPENSASI H2H3-002 IZIN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (430,'abs_x23_status','2017-01-13','11:46:11','alex','TAMBAH DISPENSASI H2H3-002 SAKIT');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (431,'abs_x23_status','2017-01-13','11:46:18','alex','HAPUS DISPENSASI H2H3-002 SAKIT');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (432,'abs_x23_status','2017-01-13','11:54:40','alex','HAPUS DISPENSASI H2H3-002 SAKIT');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (433,'abs_x23_status','2017-01-13','11:55:37','alex','TAMBAH DISPENSASI H2H3-002 SAKIT');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (434,'abs_x23_status','2017-01-13','11:55:46','alex','HAPUS DISPENSASI H2H3-002 SAKIT');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (435,'abs_x23_status','2017-01-13','11:56:23','alex','TAMBAH DISPENSASI H2H3-002 IZIN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (436,'abs_x23_status','2017-01-13','11:56:29','alex','HAPUS DISPENSASI H2H3-002 IZIN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (437,'abs_x23_status','2017-01-13','11:56:49','alex','HAPUS DISPENSASI H2H3-002 IZIN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (438,'abs_x23_status','2017-01-13','12:19:12','alex','TAMBAH DISPENSASI H2H3-008 IZIN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (439,'abs_x23_status','2017-01-13','12:19:23','alex','HAPUS DISPENSASI H2H3-008 IZIN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (440,'abs_x23_status','2017-01-13','12:19:35','alex','TAMBAH DISPENSASI H2H3-008 SAKIT');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (441,'abs_x23_status','2017-01-13','12:19:41','alex','HAPUS DISPENSASI H2H3-008 SAKIT');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (442,'abs_x23_status','2017-01-13','12:20:01','alex','TAMBAH DISPENSASI H2H3-002 IZIN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (443,'abs_x23_status','2017-01-13','12:20:07','alex','HAPUS DISPENSASI H2H3-002 IZIN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (444,'abs_x23_status','2017-01-13','12:21:27','alex','TAMBAH DISPENSASI H2H3-002 IZIN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (445,'abs_x23_status','2017-01-13','12:21:55','alex','HAPUS DISPENSASI H2H3-002 IZIN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (446,'abs_x23_status','2017-01-13','12:23:17','alex','TAMBAH DISPENSASI H2H3-002 SAKIT');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (447,'abs_x23_status','2017-01-13','12:23:24','alex','HAPUS DISPENSASI H2H3-002 SAKIT');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (448,'x23_piutang','2017-01-13','14:54:42','alex','TAMBAH PEMBAYARAN COUNTER PART 7000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (449,'x23_piutang','2017-01-13','14:54:56','alex','TAMBAH PEMBAYARAN COUNTER PART 7000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (450,'x23_abis_dkonfirmasi','2017-01-13','15:24:40','alex','MENYETUJUI KONFIRMASI PEMBAYARAN PIUTANG KARYAWAN ID 18');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (451,'x23_potkompensasi','2017-01-13','20:37:49','alex','TAMBAH POTONGAN KOMPENSASI COUNTER PART 500000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (452,'x23_potkompensasi','2017-01-13','20:38:42','alex','TAMBAH POTONGAN KOMPENSASI COUNTER PART 401000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (453,'x23_abis_dkonfirmasi','2017-01-13','20:39:43','alex','MENYETUJUI KONFIRMASI POTONGAN KOMPENSASI ID 2');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (454,'x23_abis_dkonfirmasi','2017-01-13','20:41:01','alex','MENOLAK KONFIRMASI POTONGAN KOMPENSASI ID 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (455,'x23_potkompensasi','2017-01-13','20:42:00','alex','HAPUS POTONGAN KOMPENSASI 2 COUNTER PART');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (456,'x23_potkompensasi','2017-01-13','20:42:05','alex','HAPUS POTONGAN KOMPENSASI 1 COUNTER PART');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (457,'x23_potkompensasi','2017-01-13','20:42:08','alex','HAPUS POTONGAN KOMPENSASI 1 COUNTER PART');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (458,'x23_potkompensasi','2017-01-13','20:43:13','alex','TAMBAH POTONGAN KOMPENSASI COUNTER PART 400000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (459,'x23_potkompensasi','2017-01-13','20:43:32','alex','TAMBAH POTONGAN KOMPENSASI COUNTER PART 500000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (460,'x23_karyawan','2017-01-13','20:44:39','alex','UBAH KARYAWAN COUNTER PART');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (461,'x23_abis_dkonfirmasi','2017-01-13','20:45:04','alex','MENYETUJUI KONFIRMASI POTONGAN KOMPENSASI ID 4');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (462,'x23_karyawan','2017-01-13','20:45:25','alex','UBAH KARYAWAN COUNTER PART');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (463,'x23_abis_dkonfirmasi','2017-01-13','20:46:27','alex','MENYETUJUI KONFIRMASI POTONGAN KOMPENSASI ID 3');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (464,'tbl_potkompensasi','2017-01-13','20:49:33','alex','TAMBAH POTONGAN KOMPENSASI KEPALA TOKO 1200000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (465,'tbl_potkompensasi','2017-01-13','20:50:28','alex','HAPUS POTONGAN KOMPENSASI 12 KEPALA TOKO');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (466,'x23_karyawan','2017-01-13','20:52:43','alex','UBAH KARYAWAN COUNTER PART');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (467,'tbl_potkompensasi','2017-01-13','20:53:03','alex','HAPUS POTONGAN KOMPENSASI 12 KEPALA TOKO');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (468,'tbl_potkompensasi','2017-01-13','20:53:58','alex','TAMBAH POTONGAN KOMPENSASI KEPALA TOKO 1200000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (469,'tbl_potkompensasi','2017-01-13','20:54:38','alex','HAPUS POTONGAN KOMPENSASI 13 KEPALA TOKO');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (470,'tbl_potkompensasi','2017-01-13','20:55:38','alex','TAMBAH POTONGAN KOMPENSASI KEPALA TOKO 1000000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (471,'tbl_karyawan','2017-01-13','20:56:07','alex','UBAH KARYAWAN KEPALA TOKO');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (472,'tbl_karyawan','2017-01-13','20:56:24','alex','UBAH KARYAWAN KEPALA TOKO');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (473,'tbl_abis_dkonfirmasi','2017-01-13','20:59:47','alex','MENYETUJUI KONFIRMASI SURAT PESANANTONGAN KOMPENSASI ID 14');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (474,'tbl_karyawan','2017-01-13','21:00:29','alex','UBAH KARYAWAN KEPALA TOKO');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (475,'abs_x23_status','2017-01-13','21:02:23','alex','TAMBAH DISPENSASI H2H3-010 IZIN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (476,'abs_status','2017-01-13','21:06:25','alex','TAMBAH DISPENSASI H1-004 IZIN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (477,'x23_piutang','2017-01-13','21:15:05','alex','TAMBAH PIUTANG COUNTER PART 1000000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (478,'x23_abis_dkonfirmasi','2017-01-13','21:16:30','alex','MENYETUJUI KONFIRMASI PIUTANG KARYAWAN ID 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (479,'x23_piutang','2017-01-13','21:21:16','alex','TAMBAH PEMBAYARAN COUNTER PART 500000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (480,'x23_piutang','2017-01-13','21:21:46','alex','TAMBAH PIUTANG COUNTER PART 10000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (481,'x23_abis_dkonfirmasi','2017-01-13','21:22:17','alex','MENYETUJUI KONFIRMASI PIUTANG KARYAWAN ID 3');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (482,'x23_piutang','2017-01-13','21:23:51','alex','TAMBAH PEMBAYARAN COUNTER PART 500001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (483,'x23_piutang','2017-01-13','21:29:04','alex','TAMBAH PEMBAYARAN COUNTER PART 401001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (484,'x23_potkompensasi','2017-01-13','21:37:25','alex','HAPUS POTONGAN KOMPENSASI 4 COUNTER PART');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (485,'x23_abis_dkonfirmasi','2017-01-13','21:37:44','alex','MENYETUJUI KONFIRMASI PEMBAYARAN PIUTANG KARYAWAN ID 2');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (486,'x23_potkompensasi','2017-01-13','21:38:14','alex','HAPUS POTONGAN KOMPENSASI 4 COUNTER PART');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (487,'x23_potkompensasi','2017-01-13','21:43:01','alex','HAPUS POTONGAN KOMPENSASI 4 COUNTER PART');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (488,'x23_piutang','2017-01-13','21:49:20','alex','TAMBAH PIUTANG COUNTER PART 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (489,'x23_abis_dkonfirmasi','2017-01-13','21:49:39','alex','MENYETUJUI KONFIRMASI PIUTANG KARYAWAN ID 6');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (490,'x23_karyawan','2017-01-13','21:52:29','alex','UBAH KARYAWAN COUNTER PART');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (491,'x23_karyawan','2017-01-13','21:54:51','alex','UBAH KARYAWAN COUNTER PART');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (492,'x23_abis_dkonfirmasi','2017-01-13','21:55:19','alex','MENYETUJUI KONFIRMASI PEMBAYARAN PIUTANG KARYAWAN ID 4');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (493,'x23_piutang','2017-01-13','22:00:38','alex','TAMBAH PEMBAYARAN COUNTER PART 500001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (494,'x23_abis_dkonfirmasi','2017-01-13','22:01:19','alex','MENYETUJUI KONFIRMASI PEMBAYARAN PIUTANG KARYAWAN ID 7');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (495,'x23_piutang','2017-01-13','22:04:23','alex','TAMBAH PEMBAYARAN COUNTER PART 500001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (496,'x23_abis_dkonfirmasi','2017-01-13','22:05:01','alex','MENYETUJUI KONFIRMASI PEMBAYARAN PIUTANG KARYAWAN ID 8');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (497,'x23_abis_dkonfirmasi','2017-01-13','22:05:51','alex','MENYETUJUI KONFIRMASI PEMBAYARAN PIUTANG KARYAWAN ID 5');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (498,'x23_piutang','2017-01-13','22:34:10','alex','TAMBAH PEMBAYARAN COUNTER PART 500001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (499,'x23_abis_dkonfirmasi','2017-01-13','22:34:48','alex','MENYETUJUI KONFIRMASI PEMBAYARAN PIUTANG KARYAWAN ID 9');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (500,'x23_abis_dkonfirmasi','2017-01-13','22:36:35','alex','MENYETUJUI KONFIRMASI PEMBAYARAN PIUTANG KARYAWAN ID 5');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (501,'x23_potkompensasi','2017-01-13','22:40:39','alex','HAPUS POTONGAN KOMPENSASI 4 COUNTER PART');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (502,'tbl_karyawan','2017-01-13','22:44:45','alex','UBAH KARYAWAN STAF DRIVER');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (503,'tbl_piutang','2017-01-13','22:45:06','alex','TAMBAH PIUTANG STAF DRIVER 1000001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (504,'tbl_abis_dkonfirmasi','2017-01-13','22:46:12','alex','MENOLAK KONFIRMASI PIUTANG KARYAWAN ID 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (505,'tbl_piutang','2017-01-13','22:46:23','alex','TAMBAH PIUTANG STAF DRIVER 1000000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (506,'tbl_abis_dkonfirmasi','2017-01-13','22:46:46','alex','MENYETUJUI KONFIRMASI PIUTANG KARYAWAN ID 2');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (507,'tbl_piutang','2017-01-13','22:57:21','alex','TAMBAH PEMBAYARAN STAF DRIVER 500000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (508,'tbl_piutang','2017-01-13','22:57:57','alex','TAMBAH PEMBAYARAN STAF DRIVER 500001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (509,'tbl_piutang','2017-01-13','23:02:00','alex','TAMBAH PEMBAYARAN STAF DRIVER 500001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (510,'tbl_abis_dkonfirmasi','2017-01-13','23:02:44','alex','MENYETUJUI KONFIRMASI PEMBAYARAN PIUTANG KARYAWAN ID 3');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (511,'tbl_abis_dkonfirmasi','2017-01-13','23:05:50','alex','MENYETUJUI KONFIRMASI PEMBAYARAN PIUTANG KARYAWAN ID 3');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (512,'tbl_potkompensasi','2017-01-13','23:06:47','alex','HAPUS POTONGAN KOMPENSASI 10 STAF DRIVER');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (513,'tbl_karyawan','2017-01-13','23:08:30','alex','UBAH KARYAWAN STAF DRIVER');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (514,'tbl_karyawan','2017-01-13','23:16:14','alex','UBAH KARYAWAN STAF DRIVER');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (515,'tbl_kompensasi','2017-01-13','23:19:07','alex','BATAL BAYAR UANG HARIAN 249');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (516,'tbl_karyawan','2017-01-13','23:21:25','alex','UBAH KARYAWAN STAF DRIVER');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (517,'tbl_abis_dkonfirmasi','2017-01-13','23:21:37','alex','MENOLAK KONFIRMASI PEMBAYARAN PIUTANG KARYAWAN ID 4');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (518,'tbl_piutang','2017-01-13','23:21:59','alex','TAMBAH PEMBAYARAN STAF DRIVER 400000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (519,'tbl_abis_dkonfirmasi','2017-01-13','23:22:32','alex','MENOLAK KONFIRMASI PEMBAYARAN PIUTANG KARYAWAN ID 5');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (520,'tbl_piutang','2017-01-13','23:23:13','alex','TAMBAH PEMBAYARAN STAF DRIVER 450000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (521,'tbl_abis_dkonfirmasi','2017-01-13','23:23:41','alex','MENYETUJUI KONFIRMASI PEMBAYARAN PIUTANG KARYAWAN ID 7');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (522,'tbl_abis_dkonfirmasi','2017-01-13','23:29:31','alex','MENYETUJUI KONFIRMASI PEMBAYARAN PIUTANG KARYAWAN ID 6');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (523,'tbl_abis_dkonfirmasi','2017-01-13','23:40:33','alex','MENYETUJUI KONFIRMASI PEMBAYARAN PIUTANG KARYAWAN ID 6');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (524,'tbl_abis_dkonfirmasi','2017-01-13','23:43:26','alex','MENYETUJUI KONFIRMASI PEMBAYARAN PIUTANG KARYAWAN ID 6');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (525,'tbl_abis_dkonfirmasi','2017-01-14','20:10:34','alex','MENYETUJUI KONFIRMASI PEMBAYARAN PIUTANG KARYAWAN ID 6');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (526,'tbl_karyawan','2017-01-14','20:31:51','alex','UBAH KARYAWAN STAF KASIR');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (527,'tbl_piutang','2017-01-14','20:32:15','alex','TAMBAH PIUTANG STAF KASIR 1000000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (528,'tbl_abis_dkonfirmasi','2017-01-14','20:32:43','alex','MENYETUJUI KONFIRMASI PIUTANG KARYAWAN ID 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (529,'tbl_piutang','2017-01-14','20:36:02','alex','TAMBAH PEMBAYARAN STAF KASIR 600000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (530,'tbl_piutang','2017-01-14','20:36:27','alex','TAMBAH PEMBAYARAN STAF KASIR 410000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (531,'tbl_abis_dkonfirmasi','2017-01-14','20:37:47','alex','MENYETUJUI KONFIRMASI PEMBAYARAN PIUTANG KARYAWAN ID 2');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (532,'tbl_abis_dkonfirmasi','2017-01-14','20:41:35','alex','MENYETUJUI KONFIRMASI PEMBAYARAN PIUTANG KARYAWAN ID 3');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (533,'tbl_piutang','2017-01-14','20:44:50','alex','TAMBAH PIUTANG STAF KASIR 1000000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (534,'tbl_abis_dkonfirmasi','2017-01-14','20:45:10','alex','MENYETUJUI KONFIRMASI PIUTANG KARYAWAN ID 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (535,'tbl_piutang','2017-01-14','20:46:09','alex','TAMBAH PEMBAYARAN STAF KASIR 610000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (536,'tbl_piutang','2017-01-14','20:46:26','alex','TAMBAH PEMBAYARAN STAF KASIR 400000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (537,'tbl_abis_dkonfirmasi','2017-01-14','20:46:47','alex','MENYETUJUI KONFIRMASI PEMBAYARAN PIUTANG KARYAWAN ID 2');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (538,'tbl_abis_dkonfirmasi','2017-01-14','20:47:29','alex','MENYETUJUI KONFIRMASI PEMBAYARAN PIUTANG KARYAWAN ID 3');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (539,'tbl_piutang','2017-01-14','20:48:43','alex','TAMBAH PIUTANG STAF KASIR 10000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (540,'tbl_abis_dkonfirmasi','2017-01-14','20:48:54','alex','MENYETUJUI KONFIRMASI PIUTANG KARYAWAN ID 4');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (541,'tbl_piutang','2017-01-14','20:53:19','alex','TAMBAH PIUTANG STAF KASIR 1000000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (542,'tbl_abis_dkonfirmasi','2017-01-14','20:53:28','alex','MENYETUJUI KONFIRMASI PIUTANG KARYAWAN ID 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (543,'tbl_piutang','2017-01-14','20:54:05','alex','TAMBAH PEMBAYARAN STAF KASIR 410000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (544,'tbl_piutang','2017-01-14','20:54:20','alex','TAMBAH PEMBAYARAN STAF KASIR 600000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (545,'tbl_abis_dkonfirmasi','2017-01-14','20:54:39','alex','MENYETUJUI KONFIRMASI PEMBAYARAN PIUTANG KARYAWAN ID 3');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (546,'tbl_abis_dkonfirmasi','2017-01-14','20:55:08','alex','MENYETUJUI KONFIRMASI PEMBAYARAN PIUTANG KARYAWAN ID 2');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (547,'x23_karyawan','2017-01-14','20:59:51','alex','UBAH KARYAWAN KASIR');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (548,'x23_piutang','2017-01-14','21:00:04','alex','TAMBAH PIUTANG KASIR 1000000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (549,'x23_abis_dkonfirmasi','2017-01-14','21:00:26','alex','MENYETUJUI KONFIRMASI PIUTANG KARYAWAN ID 10');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (550,'x23_piutang','2017-01-14','21:01:41','alex','TAMBAH PEMBAYARAN KASIR 600000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (551,'x23_piutang','2017-01-14','21:02:00','alex','TAMBAH PEMBAYARAN KASIR 410000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (552,'x23_abis_dkonfirmasi','2017-01-14','21:02:23','alex','MENYETUJUI KONFIRMASI PEMBAYARAN PIUTANG KARYAWAN ID 11');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (553,'x23_abis_dkonfirmasi','2017-01-14','21:04:17','alex','MENYETUJUI KONFIRMASI PEMBAYARAN PIUTANG KARYAWAN ID 12');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (554,'x23_abis_dkonfirmasi','2017-01-14','21:24:31','alex','MENYETUJUI KONFIRMASI PEMBAYARAN PIUTANG KARYAWAN ID 12');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (555,'x23_piutang','2017-01-14','21:25:22','alex','TAMBAH PIUTANG KASIR 10000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (556,'x23_abis_dkonfirmasi','2017-01-14','21:25:32','alex','MENYETUJUI KONFIRMASI PIUTANG KARYAWAN ID 13');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (557,'x23_piutang','2017-01-14','21:28:10','alex','TAMBAH PIUTANG KASIR 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (558,'x23_abis_dkonfirmasi','2017-01-14','21:28:21','alex','MENYETUJUI KONFIRMASI PIUTANG KARYAWAN ID 14');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (559,'x23_uangharian','2017-01-14','21:42:00','alex','BAYAR UANG HARIAN 200000 200.000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (560,'x23_uangharian','2017-01-14','21:42:05','alex','BAYAR UANG HARIAN 20000 20.000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (561,'x23_uangharian','2017-01-14','21:43:55','alex','BAYAR UANG HARIAN 250000 250.000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (562,'x23_karyawan','2017-01-14','21:50:43','alex','UBAH KARYAWAN KEPALA BENGKEL');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (563,'x23_karyawan','2017-01-14','21:51:22','alex','UBAH KARYAWAN KEPALA BENGKEL');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (564,'x23_karyawan','2017-01-14','21:51:55','alex','UBAH KARYAWAN KEPALA BENGKEL');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (565,'x23_karyawan','2017-01-14','21:52:12','alex','UBAH KARYAWAN KEPALA BENGKEL');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (566,'tbl_karyawan','2017-01-14','21:52:56','alex','UBAH KARYAWAN STAF ADMINISTRASI');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (567,'tbl_karyawan','2017-01-14','21:53:13','alex','UBAH KARYAWAN STAF ADMINISTRASI');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (568,'x23_karyawan','2017-01-14','22:07:03','alex','UBAH KARYAWAN COUNTER PART');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (569,'x23_karyawan','2017-01-14','22:07:22','alex','UBAH KARYAWAN COUNTER PART');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (570,'x23_karyawan','2017-01-14','22:07:48','alex','UBAH KARYAWAN COUNTER PART');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (571,'x23_karyawan','2017-01-14','22:08:13','alex','UBAH KARYAWAN COUNTER PART');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (572,'tbl_karyawan','2017-01-14','22:09:31','alex','UBAH KARYAWAN STAF GUDANG PDI');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (573,'tbl_karyawan','2017-01-14','22:09:46','alex','UBAH KARYAWAN STAF GUDANG PDI');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (574,'x23_karyawan','2017-01-14','22:11:03','alex','UBAH KARYAWAN COUNTER PART');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (575,'x23_karyawan','2017-01-14','22:11:28','alex','UBAH KARYAWAN COUNTER PART');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (576,'tbl_karyawan','2017-01-14','22:12:01','alex','UBAH KARYAWAN STAF ADMINISTRASI');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (577,'tbl_karyawan','2017-01-14','22:12:22','alex','UBAH KARYAWAN STAF ADMINISTRASI');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (578,'x23_karyawan','2017-01-14','22:13:23','alex','UBAH KARYAWAN COUNTER PART');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (579,'x23_karyawan','2017-01-14','22:17:30','alex','UBAH KARYAWAN COUNTER PART');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (580,'tbl_karyawan','2017-01-14','22:18:01','alex','UBAH KARYAWAN STAF ADMINISTRASI');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (581,'tbl_karyawan','2017-01-14','22:20:23','alex','UBAH KARYAWAN STAF ADMINISTRASI');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (582,'tbl_karyawan','2017-01-14','22:20:24','alex','UBAH KARYAWAN STAF ADMINISTRASI');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (583,'tbl_karyawan','2017-01-14','22:32:00','alex','UBAH KARYAWAN STAF SALES');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (584,'x23_potkompensasi','2017-01-14','22:34:34','alex','HAPUS POTONGAN KOMPENSASI 3 COUNTER PART');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (585,'abs_x23_status','2017-01-14','22:34:45','alex','HAPUS DISPENSASI H2H3-010 IZIN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (586,'tbl_potkompensasi','2017-01-14','22:35:52','alex','HAPUS POTONGAN KOMPENSASI 4 KEPALA TOKO');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (587,'x23_kompensasi','2017-01-14','22:36:43','alex','BATAL BAYAR UANG HARIAN 131');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (588,'x23_kompensasi','2017-01-14','22:36:47','alex','BATAL BAYAR UANG HARIAN 131');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (589,'x23_kompensasi','2017-01-14','22:36:49','alex','BATAL BAYAR UANG HARIAN 131');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (590,'x23_notabeli','2017-01-16','20:06:31','alex','TAMBAH NOTA BELI NB2170116-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (591,'x23_stokpart','2017-01-16','20:07:29','alex','TAMBAH STOK NB2170116-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (592,'x23_notabeli','2017-01-16','20:07:40','alex','TAMBAH NOTA BELI NB2170116-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (593,'x23_stokpart','2017-01-16','20:08:17','alex','UPDATE HARGA JUAL NB2170116-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (594,'x23_notabeli','2017-01-16','20:08:28','alex','TAMBAH NOTA BELI NB2170116-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (595,'x23_stokpart','2017-01-16','20:08:40','alex','TAMBAH STOK NB2170116-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (596,'x23_stokpart','2017-01-16','20:09:22','alex','TAMBAH STOK NB2170116-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (597,'x23_stokpart','2017-01-16','20:09:26','alex','UPDATE HARGA JUAL NB2170116-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (598,'x23_stokpart','2017-01-16','20:10:18','alex','UPDATE HARGA JUAL NB2170116-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (599,'x23_notabeli','2017-01-16','20:16:05','alex','TAMBAH NOTA BELI NB2170116-004');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (600,'x23_notabeli','2017-01-16','20:34:45','alex','TAMBAH NOTA BELI NB2170116-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (601,'x23_notabeli','2017-01-16','20:41:37','alex','TAMBAH NOTA BELI NB2170116-006');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (602,'x23_stokpart','2017-01-16','20:43:00','alex','TAMBAH STOK NB2170116-004');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (603,'x23_stokpart','2017-01-16','20:43:22','alex','TAMBAH STOK NB2170116-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (604,'x23_stokpart','2017-01-16','20:44:07','alex','TAMBAH STOK NB2170116-006');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (605,'x23_stokpart','2017-01-16','20:45:29','alex','UPDATE HARGA JUAL NB2170116-004');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (606,'x23_stokpart','2017-01-16','20:45:40','alex','UPDATE HARGA JUAL NB2170116-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (607,'x23_notaservice','2017-01-16','20:49:33','alex','UPDATE NOTA SERVIS NS170116-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (608,'x23_kwitansi','2017-01-16','21:09:45','alex','TAMBAH KWITANSI KS170116-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (609,'x23_notajual','2017-01-16','22:18:49','alex','TAMBAH NOTA JUAL NJ2170116-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (610,'x23_karyawan','2017-01-17','20:07:55','alex','UBAH KARYAWAN MEKANIK SATU A');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (611,'x23_tutupharian','2017-01-16','20:56:25','alex','TAMBAH TUTUP HARIAN HARIAN ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (612,'x23_tutupharian','2017-01-16','20:58:12','alex','HAPUS TUTUP HARIAN HARIAN ID 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (613,'x23_tutupharian','2017-01-16','20:58:18','alex','HAPUS TUTUP HARIAN HARIAN ID 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (614,'x23_tutupharian','2017-01-16','20:58:18','alex','TAMBAH TUTUP HARIAN HARIAN ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (615,'x23_tutupharian','2017-01-16','21:00:18','alex','HAPUS TUTUP HARIAN HARIAN ID 2');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (616,'x23_tutupharian','2017-01-16','21:00:50','alex','HAPUS TUTUP HARIAN HARIAN ID 2');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (617,'x23_tutupharian','2017-01-16','21:00:50','alex','TAMBAH TUTUP HARIAN HARIAN ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (618,'x23_tutupharian','2017-01-16','21:06:09','alex','HAPUS TUTUP HARIAN HARIAN ID 2');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (619,'x23_tutupharian','2017-01-16','21:06:18','alex','HAPUS TUTUP HARIAN HARIAN ID 3');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (620,'x23_tutupharian','2017-01-16','21:19:08','alex','HAPUS TUTUP HARIAN HARIAN ID 3');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (621,'x23_tutupharian','2017-01-16','21:19:13','alex','HAPUS TUTUP HARIAN HARIAN ID 3');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (622,'x23_tutupharian','2017-01-16','21:19:13','alex','TAMBAH TUTUP HARIAN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (623,'x23_tutupharian','2017-01-16','21:33:15','alex','TAMBAH TUTUP HARIAN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (624,'x23_tutupharian','2017-01-16','21:33:25','alex','HAPUS TUTUP HARIAN HARIAN ID 5');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (625,'x23_tutupharian','2017-01-16','21:34:08','alex','HAPUS TUTUP HARIAN HARIAN ID 5');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (626,'x23_tutupharian','2017-01-16','21:34:17','alex','HAPUS TUTUP HARIAN HARIAN ID 5');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (627,'x23_tutupharian','2017-01-16','21:34:17','alex','TAMBAH TUTUP HARIAN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (628,'x23_tutupharian','2017-01-16','21:34:38','alex','HAPUS TUTUP HARIAN HARIAN ID 6');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (629,'x23_tutupharian','2017-01-16','21:35:10','alex','HAPUS TUTUP HARIAN HARIAN ID 6');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (630,'x23_tutupharian','2017-01-16','21:35:10','alex','TAMBAH TUTUP HARIAN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (631,'x23_tutupharian','2017-01-16','21:38:55','alex','TAMBAH TUTUP HARIAN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (632,'x23_tutupharian','2017-01-16','21:40:26','alex','TAMBAH TUTUP HARIAN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (633,'x23_user','2017-01-16','21:53:40','alex','HAPUS USER MEKANIK SATU A');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (634,'x23_user','2017-01-16','21:53:46','alex','HAPUS USER MEKANIK DUA');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (635,'x23_user','2017-01-16','21:55:46','alex','TAMBAH USER kasir');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (636,'x23_karyawan','2017-01-16','21:58:04','alex','UBAH KARYAWAN MEKANIK SATU A');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (637,'x23_karyawan','2017-01-16','22:08:41','alex','TAMBAH KARYAWAN MEKANIK EMPAT');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (638,'x23_karyawan','2017-01-16','22:09:36','alex','TAMBAH KARYAWAN MEKANIK LIMA');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (639,'x23_tutupharian','2017-01-16','22:12:54','kasir','TAMBAH TUTUP HARIAN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (640,'x23_tutupharian','2017-01-16','22:14:13','kasir','TAMBAH TUTUP HARIAN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (641,'x23_tutupharian','2017-01-16','22:18:16','alex','TAMBAH TUTUP HARIAN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (642,'x23_karyawan','2017-01-16','22:44:54','alex','UBAH KARYAWAN MEKANIK DUA');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (643,'x23_karyawan','2017-01-16','22:47:01','alex','UBAH KARYAWAN MEKANIK DUA');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (644,'x23_karyawan','2017-01-16','22:50:04','alex','UBAH KARYAWAN MEKANIK DUA');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (645,'x23_notabeli','2017-01-19','21:02:20','alex','BAYAR NOTA BELI NB2170116-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (646,'x23_pindah','2017-01-19','21:22:00','alex','TAMBAH PINDAH STOK 2017-01-19 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (647,'x23_abis_dkonfirmasi','2017-01-19','21:36:16','alex','MENYETUJUI KONFIRMASI PEMINDAHAN STOK ID 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (648,'x23_tarifjasa','2017-01-20','22:11:45','alex','TAMBAH TARIF JASA KONSUMEN ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (649,'x23_notaservice','2017-01-20','22:26:35','alex','UPDATE NOTA SERVIS NS170120-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (650,'x23_kwitansi','2017-01-20','22:31:49','alex','TAMBAH KWITANSI KS170120-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (651,'x23_notaservice','2017-01-20','22:52:31','alex','UPDATE NOTA SERVIS NS170120-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (652,'x23_kwitansi','2017-01-20','23:06:06','alex','TAMBAH KWITANSI KS170120-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (653,'x23_notaservice','2017-01-21','21:52:26','alex','UPDATE NOTA SERVIS NS170121-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (654,'x23_notaservice','2017-01-21','21:55:25','alex','UPDATE NOTA SERVIS NS170121-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (655,'x23_pindah','2017-01-21','22:04:08','alex','TAMBAH PINDAH STOK 2017-01-21 2');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (656,'x23_notajual','2017-01-21','22:10:17','alex','TAMBAH NOTA JUAL NJ2170121-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (657,'x23_kelompokjasa','2017-01-23','10:33:42','alex','TAMBAH PENGELOMPOKAN JASA KJ1701-001 CBR 250 - 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (658,'x23_kelompokjasa','2017-01-23','10:48:24','alex','TAMBAH PENGELOMPOKAN JASA KJ1701-002 CBR 250 - 2');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (659,'x23_notaservice','2017-01-23','12:29:12','alex','UPDATE NOTA SERVIS NS170123-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (660,'x23_notabeli','2017-01-24','10:34:27','alex','TAMBAH NOTA BELI NB2170124-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (661,'x23_stokpart','2017-01-24','10:43:28','alex','TAMBAH STOK NB2170124-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (662,'x23_kelompokjasa','2017-01-25','19:58:15','alex','TAMBAH PENGELOMPOKAN JASA KJ1701-003 KPB TEST 4');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (663,'x23_kelompokjasa','2017-01-25','20:02:47','alex','UBAH PENGELOMPOKAN JASA 12');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (664,'x23_kelompokjasa','2017-01-25','20:27:14','alex','UBAH PENGELOMPOKAN JASA 12');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (665,'x23_kelompokjasa','2017-01-25','20:28:28','alex','UBAH PENGELOMPOKAN JASA 12');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (666,'x23_notabeli','2017-01-25','20:34:26','alex','TAMBAH NOTA BELI NB2170125-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (667,'x23_stokpart','2017-01-25','20:35:02','alex','TAMBAH STOK NB2170125-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (668,'x23_stokpart','2017-01-25','20:35:34','alex','UPDATE HARGA JUAL NB2170125-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (669,'x23_notaservice','2017-01-25','20:38:03','alex','UPDATE NOTA SERVIS NS170125-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (670,'x23_kwitansi','2017-01-25','20:42:32','alex','TAMBAH KWITANSI KS170125-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (671,'x23_notaservice','2017-01-25','21:26:00','alex','UPDATE NOTA SERVIS NS170125-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (672,'x23_kwitansi','2017-01-25','21:28:31','alex','TAMBAH KWITANSI KS170125-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (673,'x23_notaservice','2017-01-26','20:00:01','alex','UPDATE NOTA SERVIS NS170126-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (674,'x23_kwitansi','2017-01-26','20:00:48','alex','TAMBAH KWITANSI KS170126-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (675,'x23_stokmin','2017-01-26','20:12:17','alex','TAMBAH STOK MINIMUM 13');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (676,'x23_notabeli','2017-01-26','20:25:39','alex','TAMBAH NOTA BELI NC170126-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (677,'x23_notabeli','2017-01-26','20:38:10','alex','HAPUS NOTA BELI NC170126-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (678,'x23_notabeli','2017-01-26','20:38:58','alex','TAMBAH NOTA BELI NC170126-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (679,'x23_stokpart','2017-01-26','20:54:42','alex','TAMBAH STOK NC170126-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (680,'x23_stokpart','2017-01-26','21:01:59','alex','UPDATE HARGA JUAL NC170126-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (681,'x23_notabeli','2017-01-26','21:05:11','alex','TAMBAH NOTA BELI NC170126-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (682,'x23_stokpart','2017-01-26','21:06:19','alex','TAMBAH STOK NC170126-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (683,'x23_stokpart','2017-01-26','21:17:09','alex','UPDATE HARGA JUAL NC170126-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (684,'x23_notabeli','2017-01-26','21:18:47','alex','TAMBAH NOTA BELI NC170126-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (685,'x23_stokpart','2017-01-26','21:19:17','alex','TAMBAH STOK NC170126-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (686,'x23_stokpart','2017-01-26','21:26:04','alex','TAMBAH STOK NC170126-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (687,'x23_notabeli','2017-01-26','21:27:12','alex','TAMBAH NOTA BELI NC170126-004');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (688,'x23_stokpart','2017-01-26','21:28:00','alex','TAMBAH STOK NC170126-004');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (689,'x23_notabeli','2017-01-26','21:29:17','alex','TAMBAH NOTA BELI NC170126-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (690,'x23_stokpart','2017-01-26','21:29:50','alex','TAMBAH STOK NC170126-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (691,'x23_notabeli','2017-01-26','21:38:48','alex','TAMBAH NOTA BELI NC170126-006');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (692,'x23_stokpart','2017-01-26','21:39:46','alex','TAMBAH STOK NC170126-006');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (693,'x23_penagihankpb','2017-01-26','22:58:34','alex','BAYAR SERVIS KPB DARI MPM NS170123-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (694,'x23_penagihankpb','2017-01-26','23:02:00','alex','BAYAR SERVIS KPB DARI MPM NS170123-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (695,'x23_penagihankpb','2017-01-26','23:07:10','alex','BAYAR SERVIS KPB DARI MPM NS170123-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (696,'x23_penagihankpb','2017-01-26','23:07:17','alex','BAYAR SERVIS KPB DARI MPM NS170123-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (697,'x23_penagihankpb','2017-01-26','23:09:22','alex','BAYAR SERVIS KPB DARI MPM NS170123-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (698,'x23_penagihankpb','2017-01-26','23:10:58','alex','BAYAR SERVIS KPB DARI MPM NS170123-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (699,'x23_penagihankpb','2017-01-27','12:09:06','alex','BAYAR SERVIS KPB DARI MPM NS170120-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (700,'x23_penagihankpb','2017-01-27','12:46:41','alex','BAYAR SERVIS KPB DARI MPM NS170121-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (701,'x23_kaskecil','2017-01-30','15:10:00','alex','OUTPUT 123');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (702,'x23_kaskecil','2017-01-30','15:12:42','alex','HAPUS  ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (703,'x23_kaskecil','2017-01-30','15:14:32','alex','HAPUS  ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (704,'x23_kaskecil','2017-01-30','15:14:44','alex','HAPUS  ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (705,'x23_notaservice','2017-01-30','20:16:16','alex','UPDATE NOTA SERVIS NS170130-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (706,'x23_kwitansi','2017-01-30','20:29:59','alex','TAMBAH KWITANSI KS170130-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (707,'x23_notaservice','2017-01-30','20:33:37','alex','UPDATE NOTA SERVIS NS170130-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (708,'x23_kwitansi','2017-01-30','20:35:19','alex','TAMBAH KWITANSI KS170130-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (709,'x23_notaservice','2017-01-30','20:47:30','alex','UPDATE NOTA SERVIS NS170130-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (710,'x23_kwitansi','2017-01-30','20:47:51','alex','TAMBAH KWITANSI KS170130-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (711,'x23_penagihankpb','2017-01-30','20:52:56','alex','BAYAR SERVIS KPB DARI MPM NS170130-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (712,'x23_penagihankpb','2017-01-30','21:05:55','alex','BAYAR SERVIS KPB DARI MPM NS170130-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (713,'x23_penagihankpb','2017-01-30','21:06:23','alex','BAYAR SERVIS KPB DARI MPM NS170130-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (714,'x23_penagihankpb','2017-01-30','21:09:17','alex','BAYAR SERVIS KPB DARI MPM NS170130-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (715,'x23_penagihankpb','2017-01-30','21:19:59','alex','BAYAR SERVIS KPB DARI MPM NS170130-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (716,'x23_notajual','2017-01-30','22:12:31','alex','TAMBAH NOTA JUAL NJ2170130-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (717,'x23_indent','2017-01-30','22:12:31','alex','TAMBAH NOTA INDENT NI170130-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (718,'x23_notajual','2017-01-30','22:13:06','alex','TAMBAH NOTA JUAL NJ2170130-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (719,'x23_indent','2017-01-30','22:13:06','alex','TAMBAH NOTA INDENT NI170130-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (720,'x23_kwitansi','2017-01-30','22:15:46','alex','TAMBAH KWITANSI KPJ170130-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (721,'x23_kwitansi','2017-01-30','22:16:00','alex','TAMBAH KWITANSI KPJ170130-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (722,'x23_kwitansi','2017-01-30','22:17:43','alex','TAMBAH KWITANSI KI170130-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (723,'x23_kwitansi','2017-01-30','22:19:48','alex','TAMBAH KWITANSI KI170130-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (724,'x23_notajual','2017-01-30','23:32:31','alex','TAMBAH NOTA JUAL NJ2170130-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (725,'x23_indent','2017-01-30','23:32:31','alex','TAMBAH NOTA INDENT NI170130-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (726,'x23_kwitansi','2017-01-30','23:33:30','alex','TAMBAH KWITANSI KPJ170130-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (727,'x23_kwitansi','2017-01-30','23:33:52','alex','TAMBAH KWITANSI KI170130-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (728,'x23_kaskecil','2017-02-04','20:51:15','alex','OUTPUT 43');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (729,'tbl_kaskecil','2017-02-04','21:02:19','alex','OUTPUT 5');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (730,'x23_abis_dkonfirmasi','2017-02-04','21:05:49','alex','MENYETUJUI KONFIRMASI KASKECIL ID 2');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (731,'x23_opname','2017-02-04','21:25:02','alex','TAMBAH STOCK OPNAME 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (732,'x23_returbeli','2017-02-04','21:33:03','alex','TAMBAH RETUR BELI NB2170116-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (733,'x23_returbeli','2017-02-04','21:38:23','alex','KONFIRMASI RETUR BELI NR2170204-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (734,'x23_abis_dkonfirmasi','2017-02-04','21:39:12','alex','MENYETUJUI KONFIRMASI RETUR BELI ID 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (735,'x23_notabeli','2017-02-04','21:54:21','alex','TAMBAH NOTA BELI NC170204-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (736,'abs_x23_status','2017-02-04','22:06:21','alex','TAMBAH DISPENSASI H2H3-010 IZIN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (737,'tbl_notabeli','2017-02-07','19:44:03','alex','TAMBAH NOTA BELI NB1170207-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (738,'tbl_stokunit','2017-02-07','19:45:22','alex','TAMBAH STOK NB1170207-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (739,'tbl_notabeli','2017-02-07','19:47:58','alex','TAMBAH NOTA BELI NB1170207-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (740,'tbl_stokunit','2017-02-07','19:48:50','alex','TAMBAH STOK NB1170207-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (741,'tbl_pesanan','2017-02-07','19:52:00','alex','TAMBAH PESANAN NP170207-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (742,'tbl_pesanan','2017-02-07','19:52:55','alex','TAMBAH PESANAN NP170207-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (743,'tbl_pesanan','2017-02-07','19:53:35','alex','TAMBAH PESANAN NP170207-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (744,'tbl_kwitansi','2017-02-07','19:54:34','alex','TAMBAH KWITANSI KT170207-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (745,'tbl_notajual','2017-02-07','19:55:36','alex','TAMBAH NOTA JUAL NJ1170207-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (746,'tbl_kwitansi','2017-02-07','19:56:24','alex','TAMBAH KWITANSI KT170207-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (747,'tbl_notajual','2017-02-07','19:58:18','alex','TAMBAH NOTA JUAL NJ1170207-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (748,'tbl_kwitansi','2017-02-07','19:58:52','alex','TAMBAH KWITANSI KT170207-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (749,'tbl_notajual','2017-02-07','19:59:48','alex','TAMBAH NOTA JUAL NJ1170207-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (750,'tbl_pesanan','2017-02-07','20:01:28','alex','TAMBAH PESANAN NP170207-004');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (751,'tbl_pesanan','2017-02-07','20:03:48','alex','TAMBAH PESANAN NP170207-004');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (752,'tbl_pesanan','2017-02-07','20:14:46','alex','TAMBAH PESANAN NP170207-004');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (753,'tbl_kwitansi','2017-02-07','20:16:26','alex','TAMBAH KWITANSI KT170207-004');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (754,'tbl_notajual','2017-02-07','20:21:41','alex','TAMBAH NOTA JUAL NJ1170207-004');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (755,'tbl_kaskecil','2017-02-07','20:35:36','alex','OUTPUT 324');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (756,'tbl_cekfisik','2017-02-07','20:41:19','alex','TAMBAH CEK FISIK NJ1170207-004');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (757,'tbl_pesanan','2017-02-07','20:58:09','alex','TAMBAH PESANAN NP170207-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (758,'tbl_kwitansi','2017-02-07','21:00:44','alex','TAMBAH KWITANSI KT170207-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (759,'tbl_notajual','2017-02-07','21:19:55','alex','TAMBAH NOTA JUAL NJ1170207-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (760,'tbl_cekfisik','2017-02-07','21:25:29','alex','TAMBAH CEK FISIK NJ1170207-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (761,'tbl_notajual','2017-02-07','21:30:35','alex','UPDATE SETUJUI NJ1170207-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (762,'tbl_stokunit','2017-02-07','22:03:26','alex','TAMBAH STOK NB1161221-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (763,'tbl_pindah','2017-02-07','22:16:10','alex','TAMBAH PINDAH STOK 2017-02-07');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (764,'tbl_transfer','2017-02-07','22:28:58','alex','TAMBAH MUTASI KELUAR NT170207-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (765,'tbl_notabeli','2017-02-07','22:35:13','alex','TAMBAH NOTA BELI ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (766,'tbl_abis_dkonfirmasi','2017-02-07','22:53:43','alex','MENOLAK KONFIRMASI PEMINDAHAN STOK ID 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (767,'tbl_opname','2017-02-07','23:00:40','alex','TAMBAH STOCK OPNAME 2017-02-07');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (768,'tbl_bensin','2017-02-07','23:04:54','alex','OPNAME 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (769,'tbl_abis_dkonfirmasi','2017-02-07','23:08:10','alex','MENOLAK KONFIRMASI OPNAME BENSIN ID 0');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (770,'tbl_abis_dkonfirmasi','2017-02-07','23:09:14','alex','MENOLAK KONFIRMASI SELISIH STOCK OPNAME ID 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (771,'tbl_bensin','2017-02-07','23:10:27','alex','OUTPUT 2');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (772,'tbl_pengeluaranunit','2017-02-07','23:14:09','alex','TAMBAH PENGELUARAN UNIT NJ1170207-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (773,'tbl_returbeli','2017-02-07','23:21:55','alex','TAMBAH RETUR BELI 8');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (774,'tbl_pengeluaranunit','2017-02-08','19:30:22','alex','UBAH PENGIRIMAN UNIT UNIT 11 NJ1170207-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (775,'tbl_notajual_det','2017-02-08','19:56:09','alex','BAYAR GROSS 1.000 NJ1170207-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (776,'tbl_notajual_det','2017-02-08','20:02:20','alex','BAYAR GROSS 1.000 NJ1170207-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (777,'tbl_notabeli','2017-02-08','20:08:17','alex','UBAH NOTA BELI NB1161221-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (778,'tbl_notabeli','2017-02-08','20:08:41','alex','UBAH NOTA BELI NB1161221-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (779,'tbl_notabeli','2017-02-08','20:10:03','alex','UBAH NOTA BELI NB1161221-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (780,'tbl_notabeli','2017-02-08','20:10:24','alex','UBAH NOTA BELI NB1170207-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (781,'tbl_notabeli','2017-02-08','20:13:15','alex','UBAH NOTA BELI NB1170207-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (782,'tbl_notabeli','2017-02-08','20:18:48','alex','TAMBAH NOTA BELI NB1170208-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (783,'tbl_notabeli','2017-02-08','20:30:00','alex','UBAH NOTA BELI NB1170208-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (784,'tbl_notabeli','2017-02-08','20:41:18','alex','BAYAR NOTA BELI NB1170207-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (785,'tbl_notajual_det','2017-02-09','19:21:44','alex','RESET SCPAHM  NJ1170207-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (786,'tbl_notajual_det','2017-02-09','19:22:08','alex','BAYAR SCPAHM 1.000 NJ1170207-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (787,'tbl_notajual_det','2017-02-09','19:22:41','alex','RESET SCPAHM  NJ1170207-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (788,'tbl_notajual_det','2017-02-09','19:23:23','alex','BAYAR SCPMD 1.000 NJ1170207-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (789,'tbl_notajual_det','2017-02-09','19:23:43','alex','RESET SCPMD  NJ1170207-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (790,'tbl_notajual_det','2017-02-09','19:40:02','alex','BAYAR SCPAHM 1.000 NJ1170207-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (791,'tbl_notajual_det','2017-02-09','19:40:34','alex','RESET SCPAHM  NJ1170207-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (792,'tbl_notajual_det','2017-02-09','19:40:58','alex','RESET SCPAHM  NJ1170207-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (793,'tbl_notabeli','2017-02-09','19:42:36','alex','BAYAR NOTA BELI NB1170207-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (794,'tbl_notabeli','2017-02-09','19:43:57','alex','BAYAR NOTA BELI NB1170207-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (795,'tbl_notabeli','2017-02-09','19:43:57','alex','BAYAR NOTA BELI NB1170207-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (796,'tbl_piutang','2017-02-09','19:51:11','alex','TAMBAH PIUTANG STAF DRIVER 100000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (797,'tbl_abis_dkonfirmasi','2017-02-09','19:51:55','alex','MENYETUJUI KONFIRMASI PIUTANG KARYAWAN ID 3');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (798,'tbl_pesanan','2017-02-09','21:08:13','alex','TAMBAH PESANAN NP170209-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (799,'tbl_kwitansi','2017-02-09','21:10:26','alex','TAMBAH KWITANSI KUM170209-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (800,'tbl_pesanan','2017-02-09','21:12:34','alex','TAMBAH PESANAN NP170209-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (801,'x23_potkompensasi','2017-02-09','21:32:57','alex','TAMBAH POTONGAN KOMPENSASI KEPALA BENGKEL 435345');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (802,'x23_potkompensasi','2017-02-09','21:34:31','alex','HAPUS POTONGAN KOMPENSASI 1 KEPALA BENGKEL');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (803,'x23_potkompensasi','2017-02-09','21:34:50','alex','TAMBAH POTONGAN KOMPENSASI MEKANIK DUA 453');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (804,'x23_potkompensasi','2017-02-09','21:35:06','alex','HAPUS POTONGAN KOMPENSASI 2 MEKANIK DUA');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (805,'x23_potkompensasi','2017-02-09','21:46:54','alex','TAMBAH POTONGAN KOMPENSASI COUNTER PART 1000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (806,'x23_notabeli','2017-02-10','19:25:11','alex','TAMBAH NOTA BELI NB2170210-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (807,'x23_stokpart','2017-02-10','19:25:37','alex','TAMBAH STOK NB2170210-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (808,'x23_stokpart','2017-02-10','19:25:59','alex','UPDATE HARGA JUAL NB2170210-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (809,'tbl_notajual_det','2017-02-10','20:41:10','alex','BAYAR TAMBAH LAIN 5 NJ1170207-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (810,'tbl_notajual_det','2017-02-10','20:44:54','alex','BAYAR TAMBAH LAIN 5 NJ1170207-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (811,'tbl_notajual_det','2017-02-10','20:45:51','alex','BAYAR TAMBAH LAIN 5 NJ1170207-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (812,'tbl_notajual_det','2017-02-10','20:47:04','alex','BAYAR TAMBAH LAIN 5 NJ1170207-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (813,'tbl_notajual_det','2017-02-10','20:48:16','alex','BAYAR TAMBAH LAIN 5 NJ1170207-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (814,'tbl_notajual_det','2017-02-10','20:48:33','alex','BAYAR TAMBAH LAIN 5 NJ1170207-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (815,'tbl_notajual_det','2017-02-10','20:51:54','alex','BAYAR TAMBAH LAIN 5 NJ1170207-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (816,'tbl_notajual_det','2017-02-10','20:53:08','alex','BAYAR TAMBAH LAIN 5 NJ1170207-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (817,'tbl_notajual_det','2017-02-10','20:53:17','alex','RESET TAMBAH LAIN 5 NJ1170207-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (818,'tbl_notajual_det','2017-02-10','20:55:06','alex','RESET TAMBAH LAIN 5 NJ1170207-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (819,'tbl_notajual_det','2017-02-10','20:57:16','alex','BAYAR TAMBAH LAIN 5 NJ1170207-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (820,'tbl_notajual_det','2017-02-10','20:57:48','alex','RESET TAMBAH LAIN 5 NJ1170207-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (821,'tbl_notajual_det','2017-02-10','20:58:02','alex','BAYAR TAMBAH LAIN 5 NJ1170207-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (822,'tbl_notajual_det','2017-02-10','20:59:35','alex','BAYAR SCPMD 1.000 NJ1170207-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (823,'tbl_notajual_det','2017-02-10','20:59:47','alex','RESET SCPMD  NJ1170207-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (824,'tbl_notajual_det','2017-02-10','21:03:41','alex','RESET TAMBAH LAIN 5 NJ1170207-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (825,'tbl_notajual_det','2017-02-10','21:03:48','alex','BAYAR SCPAHM 1.000 NJ1170207-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (826,'tbl_notajual_det','2017-02-10','21:04:44','alex','BAYAR TAMBAH LAIN 5 NJ1170207-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (827,'tbl_notajual_det','2017-02-10','21:06:05','alex','BAYAR TAMBAH LAIN 5 NJ1170207-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (828,'tbl_notajual_det','2017-02-10','21:06:56','alex','BAYAR TAMBAH LAIN 5 NJ1170207-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (829,'tbl_notajual_det','2017-02-10','21:07:30','alex','BAYAR TAMBAH LAIN 5 NJ1170207-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (830,'tbl_notajual_det','2017-02-10','21:08:34','alex','BAYAR KURANG LAIN 5 NJ1170207-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (831,'tbl_notajual_det','2017-02-10','21:08:47','alex','RESET KURANG LAIN 5 NJ1170207-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (832,'tbl_notajual_det','2017-02-10','21:09:01','alex','BAYAR KURANG LAIN 5 NJ1170207-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (833,'tbl_notajual_det','2017-02-10','21:17:16','alex','RESET KURANG LAIN 5 NJ1170207-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (834,'tbl_notajual_det','2017-02-10','21:17:48','alex','BAYAR KURANG LAIN 5 NJ1170207-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (835,'tbl_notajual_det','2017-02-10','21:18:49','alex','BAYAR KURANG LAIN 5 NJ1170207-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (836,'tbl_notajual_det','2017-02-10','21:21:53','alex','RESET SCPMD  NJ1170207-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (837,'tbl_notajual_det','2017-02-10','21:30:19','alex','BAYAR KURANG LAIN 5 NJ1170207-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (838,'tbl_notajual_det','2017-02-10','21:31:06','pic','BAYAR SCPMD 1.000 NJ1170207-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (839,'tbl_notajual_det','2017-02-10','21:32:24','pic','BAYAR SCPMD 1.000 NJ1170207-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (840,'tbl_notajual_det','2017-02-10','21:33:47','alex','RESET SCPAHM  NJ1170207-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (841,'x23_kaskecil','2017-01-31','21:47:33','alex','OUTPUT 2.000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (842,'x23_abis_dkonfirmasi','2017-01-31','21:47:57','alex','MENYETUJUI KONFIRMASI KASKECIL ID 3');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (843,'x23_gudang','2017-02-11','11:50:58','alex','TAMBAH OMSETBRUTO 1000000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (844,'x23_gudang','2017-02-11','11:56:59','alex','HAPUS KOMISI OMSET BRUTO ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (845,'x23_komsetbruto','2017-02-11','11:57:09','alex','TAMBAH KOMISI OMSET BRUTO 1000000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (846,'x23_gudang','2017-02-11','11:57:09','alex','HAPUS KOMISI OMSET BRUTO 1000000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (847,'x23_gudang','2017-02-11','12:27:20','alex','UBAH GUDANG ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (848,'x23_komsetbruto','2017-02-11','12:32:24','alex','UBAH KOMISI OMSET BRUTO 1200000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (849,'x23_komsetbruto','2017-02-11','12:33:08','alex','UBAH KOMISI OMSET BRUTO 1000000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (850,'x23_komsetbruto','2017-02-11','12:33:20','alex','TAMBAH KOMISI OMSET BRUTO 2000000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (851,'x23_komsetbruto','2017-02-11','12:33:35','alex','TAMBAH KOMISI OMSET BRUTO 3000000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (852,'x23_komsetbruto','2017-02-11','12:33:46','alex','TAMBAH KOMISI OMSET BRUTO 4000000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (853,'x23_komsetbruto','2017-02-11','12:33:53','alex','TAMBAH KOMISI OMSET BRUTO 5000000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (854,'x23_komsetbruto','2017-02-11','12:34:04','alex','TAMBAH KOMISI OMSET BRUTO 6000000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (855,'x23_komsetbruto','2017-02-11','12:34:13','alex','TAMBAH KOMISI OMSET BRUTO 7000000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (856,'x23_kjasa','2017-02-11','13:58:46','alex','UBAH KOMISI JASA');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (857,'x23_kjasa','2017-02-11','13:58:57','alex','UBAH KOMISI JASA');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (858,'x23_kjasa','2017-02-11','14:00:01','alex','UBAH KOMISI JASA');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (859,'x23_komsetbruto','2017-02-11','21:14:11','alex','TAMBAH KOMISI OMSET BRUTO 0');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (860,'x23_kompensasi','2017-02-11','22:25:33','alex','BATAL BAYAR UANG HARIAN 193');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (861,'x23_kompensasi','2017-02-11','22:25:47','alex','BATAL BAYAR UANG HARIAN 193');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (862,'x23_kompensasi','2017-02-11','22:25:53','alex','BATAL BAYAR UANG HARIAN 198');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (863,'x23_kompensasi','2017-02-11','22:25:57','alex','BATAL BAYAR UANG HARIAN 198');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (864,'x23_kompensasi','2017-02-11','22:26:02','alex','BATAL BAYAR UANG HARIAN 195');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (865,'x23_kompensasi','2017-02-11','22:26:09','alex','BATAL BAYAR UANG HARIAN 195');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (866,'x23_kjasa','2017-02-11','22:34:39','alex','TAMBAH KOMISI JASA 2017-02-11');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (867,'x23_kjasa','2017-02-11','22:35:11','alex','TAMBAH KOMISI JASA 2017-02-11');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (868,'x23_kjasa','2017-02-11','22:37:47','alex','TAMBAH KOMISI JASA 2017-02-11');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (869,'x23_kjasa','2017-02-11','22:40:03','alex','HAPUS PAJAK');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (870,'x23_kjasa','2017-02-11','22:40:18','alex','AKTIF PAJAK');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (871,'x23_kjasa','2017-02-11','22:40:27','alex','HAPUS PAJAK');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (872,'x23_kjasa','2017-02-11','22:41:03','alex','TAMBAH KOMISI JASA 2017-02-11');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (873,'x23_kjasa','2017-02-11','22:41:48','alex','HAPUS PAJAK');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (874,'x23_kjasa','2017-02-11','22:42:11','alex','AKTIF PAJAK');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (875,'tbl_grossubsidi','2017-02-11','22:43:07','alex','HAPUS PAJAK');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (876,'tbl_grossubsidi','2017-02-11','22:43:12','alex','AKTIF PAJAK');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (877,'x23_kjasa','2017-02-11','22:43:49','alex','TAMBAH KOMISI JASA 2017-02-11');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (878,'x23_kjasa','2017-02-11','22:45:28','alex','TAMBAH KOMISI JASA 2017-02-11');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (879,'x23_kjasa','2017-02-11','22:46:09','alex','AKTIF PAJAK');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (880,'x23_kjasa','2017-02-11','22:46:18','alex','HAPUS PAJAK');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (881,'x23_kjasa','2017-02-11','22:46:26','alex','HAPUS PAJAK');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (882,'x23_kjasa','2017-02-11','22:46:43','alex','TAMBAH KOMISI JASA 2017-02-11');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (883,'x23_kjasa','2017-02-13','21:28:14','alex','HAPUS PAJAK');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (884,'x23_kjasa','2017-02-13','21:56:00','alex','HAPUS PAJAK');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (885,'x23_komsetbruto','2017-02-13','22:02:57','alex','HAPUS KOMISI OMSET BRUTO ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (886,'x23_komsetbruto','2017-02-13','22:03:47','alex','HAPUS KOMISI OMSET BRUTO ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (887,'x23_komsetbruto','2017-02-13','22:03:51','alex','HAPUS KOMISI OMSET BRUTO ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (888,'x23_komsetbruto','2017-02-13','22:03:55','alex','HAPUS KOMISI OMSET BRUTO ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (889,'x23_komsetbruto','2017-02-13','22:03:59','alex','HAPUS KOMISI OMSET BRUTO ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (890,'x23_komsetbruto','2017-02-13','22:04:03','alex','HAPUS KOMISI OMSET BRUTO ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (891,'x23_komsetbruto','2017-02-13','22:04:06','alex','HAPUS KOMISI OMSET BRUTO ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (892,'x23_komsetbruto','2017-02-13','22:04:08','alex','HAPUS KOMISI OMSET BRUTO ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (893,'x23_komsetbruto','2017-02-13','22:04:13','alex','HAPUS KOMISI OMSET BRUTO ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (894,'x23_komsetbruto','2017-02-13','22:07:45','alex','TAMBAH KOMISI OMSET BRUTO 0');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (895,'x23_komsetbruto','2017-02-13','22:07:45','alex','HAPUS KOMISI OMSET BRUTO 0');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (896,'x23_komsetbruto','2017-02-13','22:25:15','alex','HAPUS KOMISI OMSET BRUTO ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (897,'x23_komsetbruto','2017-02-13','22:26:17','alex','TAMBAH KOMISI OMSET BRUTO 0');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (898,'x23_komsetbruto','2017-02-13','22:26:17','alex','HAPUS KOMISI OMSET BRUTO 0');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (899,'x23_komsetbruto','2017-02-13','22:26:36','alex','HAPUS KOMISI OMSET BRUTO ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (900,'x23_komsetbruto','2017-02-13','22:26:44','alex','TAMBAH KOMISI OMSET BRUTO 0');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (901,'x23_komsetbruto','2017-02-13','22:26:44','alex','HAPUS KOMISI OMSET BRUTO 0');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (902,'x23_karyawan','2017-02-16','09:58:23','alex','TAMBAH KARYAWAN RADF');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (903,'x23_karyawan','2017-02-16','09:58:47','alex','TAMBAH KARYAWAN ERWER');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (904,'x23_karyawan','2017-02-16','10:02:06','alex','TAMBAH KARYAWAN AA');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (905,'tbl_karyawan','2017-02-16','10:06:07','alex','TAMBAH KARYAWAN AA');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (906,'tbl_masterbarang','2017-02-16','10:33:16','alex','UBAH MASTERBARANG H4212-316-MPH-MT');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (907,'tbl_masterbarang','2017-02-16','10:36:41','alex','TAMBAH MASTERBARANG NF12A1CF M/T');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (908,'tbl_masterbarang','2017-02-16','10:37:34','alex','UBAH MASTERBARANG NF12A1CF M/T');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (909,'tbl_masterbarang','2017-02-16','10:38:21','alex','TAMBAH MASTERBARANG NF11B2D1 M/T');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (910,'tbl_masterbarang','2017-02-16','10:39:11','alex','UBAH MASTERBARANG NF11B2D1 M/T');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (911,'tbl_masterbarang','2017-02-16','10:39:42','alex','TAMBAH MASTERBARANG NF11C1CD M/T');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (912,'','2017-02-16','10:41:24','alex','HAPUS DATABASE 1 ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (913,'tbl_notabeli','2017-02-16','10:50:50','alex','TAMBAH NOTA BELI NB1170216-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (914,'tbl_stokunit','2017-02-16','10:58:37','alex','TAMBAH STOK NB1170216-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (915,'tbl_pesanan','2017-02-16','11:11:30','alex','TAMBAH PESANAN NP170216-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (916,'tbl_kwitansi','2017-02-16','11:16:28','alex','TAMBAH KWITANSI KUM170216-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (917,'tbl_notajual','2017-02-16','11:39:51','alex','TAMBAH NOTA JUAL NJ1170216-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (918,'tbl_cekfisik','2017-02-16','12:36:09','alex','TAMBAH CEK FISIK NJ1170216-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (919,'tbl_notajual','2017-02-16','12:48:01','alex','UPDATE SETUJUI NJ1170216-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (920,'tbl_pengeluaranunit','2017-02-16','12:49:31','alex','TAMBAH PENGELUARAN UNIT NJ1170216-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (921,'tbl_pengeluaranunit','2017-02-16','12:51:29','alex','UBAH PENGIRIMAN UNIT UNIT 1 NJ1170216-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (922,'tbl_pesanan','2017-02-16','13:00:44','alex','TAMBAH PESANAN NP170216-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (923,'tbl_kwitansi','2017-02-16','13:01:31','alex','TAMBAH KWITANSI KUM170216-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (924,'tbl_notajual','2017-02-16','13:02:28','alex','TAMBAH NOTA JUAL NJ1170216-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (925,'tbl_cekfisik','2017-02-16','13:04:31','alex','TAMBAH CEK FISIK NJ1170216-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (926,'tbl_notajual','2017-02-16','13:05:44','alex','UPDATE SETUJUI NJ1170216-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (927,'','2017-02-16','13:06:22','alex','HAPUS DATABASE 1 ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (928,'tbl_notabeli','2017-02-16','13:07:52','alex','TAMBAH NOTA BELI NB1170216-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (929,'tbl_stokunit','2017-02-16','13:08:19','alex','TAMBAH STOK NB1170216-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (930,'tbl_pesanan','2017-02-16','13:16:23','alex','TAMBAH PESANAN NP170216-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (931,'tbl_kwitansi','2017-02-16','13:37:09','alex','TAMBAH KWITANSI KUM170216-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (932,'tbl_notajual','2017-02-16','13:44:39','alex','TAMBAH NOTA JUAL NJ1170216-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (933,'tbl_notajual','2017-02-16','13:55:18','alex','TAMBAH NOTA JUAL NJ1170216-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (934,'tbl_cekfisik','2017-02-16','13:57:00','alex','TAMBAH CEK FISIK NJ1170216-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (935,'tbl_notajual','2017-02-16','14:03:31','alex','UPDATE SETUJUI NJ1170216-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (936,'tbl_pengeluaranunit','2017-02-16','14:10:00','alex','TAMBAH PENGELUARAN UNIT NJ1170216-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (937,'tbl_pengeluaranunit','2017-02-16','14:14:13','alex','UBAH PENGIRIMAN UNIT UNIT 1 NJ1170216-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (938,'tbl_notabeli','2017-02-16','16:35:40','alex','TAMBAH NOTA BELI NB1170216-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (939,'tbl_stokunit','2017-02-16','16:36:08','alex','TAMBAH STOK NB1170216-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (940,'tbl_pesanan','2017-02-16','16:37:06','alex','TAMBAH PESANAN NP170216-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (941,'tbl_kwitansi','2017-02-16','16:38:10','alex','TAMBAH KWITANSI KUM170216-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (942,'tbl_notajual','2017-02-16','16:43:52','alex','TAMBAH NOTA JUAL NJ1170216-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (943,'tbl_cekfisik','2017-02-16','16:44:29','alex','TAMBAH CEK FISIK NJ1170216-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (944,'tbl_notajual','2017-02-16','16:52:30','alex','UPDATE SETUJUI NJ1170216-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (945,'tbl_pengeluaranunit','2017-02-16','16:53:33','alex','TAMBAH PENGELUARAN UNIT NJ1170216-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (946,'tbl_pengeluaranunit','2017-02-16','16:54:02','alex','UBAH PENGIRIMAN UNIT UNIT 2 NJ1170216-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (947,'tbl_karyawan','2017-02-17','10:49:09','alex','TAMBAH KARYAWAN ANUGRAH JAYA');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (948,'tbl_user','2017-02-17','10:49:42','alex','TAMBAH USER aj-aj');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (949,'tbl_notabeli','2017-02-17','11:17:16','AJ-AJ','TAMBAH NOTA BELI NB1170217-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (950,'tbl_pesanan','2017-02-17','14:54:44','ALEX','TAMBAH PESANAN NP170217-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (951,'tbl_kwitansi','2017-02-17','14:57:42','ALEX','TAMBAH KWITANSI KT170217-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (952,'tbl_stokunit','2017-02-17','14:58:34','ALEX','TAMBAH STOK NB1170217-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (953,'tbl_notajual','2017-02-17','14:59:38','ALEX','TAMBAH NOTA JUAL NJ1170217-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (954,'tbl_kwitansi','2017-02-17','15:01:11','ALEX','TAMBAH KWITANSI KPL170217-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (955,'tbl_cekfisik','2017-02-17','15:01:52','ALEX','TAMBAH CEK FISIK NJ1170217-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (956,'tbl_notajual','2017-02-17','15:04:22','ALEX','UPDATE SETUJUI NJ1170217-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (957,'','2017-02-17','20:04:30','ALEX','HAPUS DATABASE 1 ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (958,'tbl_notabeli','2017-02-17','20:05:37','ALEX','TAMBAH NOTA BELI NB1170217-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (959,'tbl_notabeli','2017-02-17','20:05:53','ALEX','UBAH NOTA BELI NB1170217-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (960,'tbl_stokunit','2017-02-17','20:08:26','ALEX','TAMBAH STOK NB1170217-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (961,'tbl_notabeli','2017-02-17','20:08:52','ALEX','BAYAR NOTA BELI NB1170217-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (962,'tbl_pesanan','2017-02-17','20:24:28','ALEX','TAMBAH PESANAN NP170217-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (963,'tbl_kwitansi','2017-02-17','20:25:18','ALEX','TAMBAH KWITANSI KT170217-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (964,'tbl_notajual','2017-02-17','20:26:24','ALEX','TAMBAH NOTA JUAL NJ1170217-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (965,'tbl_kwitansi','2017-02-17','20:27:16','ALEX','TAMBAH KWITANSI KPL170217-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (966,'tbl_cekfisik','2017-02-17','20:27:53','ALEX','TAMBAH CEK FISIK NJ1170217-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (967,'tbl_notajual','2017-02-17','20:28:33','ALEX','UPDATE SETUJUI NJ1170217-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (968,'tbl_pengeluaranunit','2017-02-17','20:29:39','ALEX','TAMBAH PENGELUARAN UNIT NJ1170217-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (969,'tbl_notabeli','2017-02-17','20:44:19','ALEX','TAMBAH NOTA BELI NB1170217-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (970,'tbl_stokunit','2017-02-17','20:44:43','ALEX','TAMBAH STOK NB1170217-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (971,'tbl_notabeli','2017-02-17','20:45:43','ALEX','BAYAR NOTA BELI NB1170217-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (972,'tbl_notabeli','2017-02-17','20:47:20','ALEX','BAYAR NOTA BELI NB1170217-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (973,'tbl_notabeli','2017-02-17','20:47:20','ALEX','BAYAR NOTA BELI NB1170217-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (974,'tbl_notabeli','2017-02-17','20:47:52','ALEX','BAYAR NOTA BELI NB1170217-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (975,'tbl_notabeli','2017-02-17','20:48:00','ALEX','BAYAR NOTA BELI NB1170217-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (976,'tbl_notabeli','2017-02-17','20:48:00','ALEX','BAYAR NOTA BELI NB1170217-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (977,'tbl_notabeli','2017-02-17','20:48:49','ALEX','TAMBAH NOTA BELI NB1170217-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (978,'tbl_stokunit','2017-02-17','20:49:08','ALEX','TAMBAH STOK NB1170217-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (979,'tbl_notabeli','2017-02-17','20:49:32','ALEX','BAYAR NOTA BELI NB1170217-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (980,'tbl_notabeli','2017-02-17','20:50:21','ALEX','BAYAR NOTA BELI NB1170217-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (981,'tbl_notabeli','2017-02-17','20:50:21','ALEX','BAYAR NOTA BELI NB1170217-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (982,'tbl_notabeli','2017-02-17','20:50:56','ALEX','BAYAR NOTA BELI NB1170217-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (983,'tbl_notabeli','2017-02-17','20:50:56','ALEX','BAYAR NOTA BELI NB1170217-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (984,'tbl_notabeli','2017-02-17','20:51:16','ALEX','BAYAR NOTA BELI NB1170217-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (985,'tbl_notabeli','2017-02-17','20:51:16','ALEX','BAYAR NOTA BELI NB1170217-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (986,'tbl_notabeli','2017-02-17','20:54:55','ALEX','TAMBAH NOTA BELI NB1170217-004');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (987,'tbl_stokunit','2017-02-17','20:55:13','ALEX','TAMBAH STOK NB1170217-004');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (988,'tbl_notabeli','2017-02-17','20:55:36','ALEX','BAYAR NOTA BELI NB1170217-004');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (989,'','2017-02-17','20:56:12','ALEX','HAPUS DATABASE 1 ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (990,'tbl_notabeli','2017-02-17','20:56:47','ALEX','TAMBAH NOTA BELI NB1170217-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (991,'tbl_stokunit','2017-02-17','20:57:10','ALEX','TAMBAH STOK NB1170217-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (992,'tbl_notabeli','2017-02-17','20:57:24','ALEX','BAYAR NOTA BELI NB1170217-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (993,'tbl_masterbarang','2017-02-17','20:59:18','ALEX','UBAH MASTERBARANG H4212-316-MPH-MT');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (994,'tbl_pesanan','2017-02-17','20:59:38','ALEX','TAMBAH PESANAN NP170217-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (995,'tbl_kwitansi','2017-02-17','21:00:16','ALEX','TAMBAH KWITANSI KUM170217-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (996,'tbl_notajual','2017-02-17','21:01:39','ALEX','TAMBAH NOTA JUAL NJ1170217-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (997,'tbl_cekfisik','2017-02-17','21:02:07','ALEX','TAMBAH CEK FISIK NJ1170217-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (998,'tbl_notajual','2017-02-17','21:05:17','ALEX','UPDATE SETUJUI NJ1170217-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (999,'tbl_pengeluaranunit','2017-02-17','21:07:07','ALEX','TAMBAH PENGELUARAN UNIT NJ1170217-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1000,'tbl_notabeli','2017-02-17','21:11:37','ALEX','TAMBAH NOTA BELI NB1170217-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1001,'tbl_stokunit','2017-02-17','21:11:55','ALEX','TAMBAH STOK NB1170217-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1002,'tbl_notabeli','2017-02-17','21:12:09','ALEX','BAYAR NOTA BELI NB1170217-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1003,'tbl_pesanan','2017-02-17','21:12:59','ALEX','TAMBAH PESANAN NP170217-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1004,'tbl_kwitansi','2017-02-17','21:13:37','ALEX','TAMBAH KWITANSI KUM170217-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1005,'tbl_notajual','2017-02-17','21:14:17','ALEX','TAMBAH NOTA JUAL NJ1170217-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1006,'tbl_cekfisik','2017-02-17','21:14:39','ALEX','TAMBAH CEK FISIK NJ1170217-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1007,'tbl_notajual','2017-02-17','21:17:11','ALEX','UPDATE SETUJUI NJ1170217-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1008,'tbl_pengeluaranunit','2017-02-17','21:22:46','ALEX','TAMBAH PENGELUARAN UNIT NJ1170217-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1009,'tbl_masterbarang','2017-02-17','21:24:31','ALEX','UBAH MASTERBARANG H453A-566-CBR-MT');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1010,'tbl_notabeli','2017-02-17','21:40:45','ALEX','TAMBAH NOTA BELI NB1170217-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1011,'tbl_stokunit','2017-02-17','21:42:07','ALEX','TAMBAH STOK NB1170217-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1012,'tbl_notabeli','2017-02-17','21:42:21','ALEX','BAYAR NOTA BELI NB1170217-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1013,'tbl_pesanan','2017-02-17','21:42:53','ALEX','TAMBAH PESANAN NP170217-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1014,'tbl_kwitansi','2017-02-17','21:43:26','ALEX','TAMBAH KWITANSI KUM170217-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1015,'tbl_notabeli','2017-02-17','22:08:09','ALEX','TAMBAH NOTA BELI NB1170217-004');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1016,'tbl_stokunit','2017-02-17','22:08:29','ALEX','TAMBAH STOK NB1170217-004');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1017,'tbl_pesanan','2017-02-17','22:09:03','ALEX','TAMBAH PESANAN NP170217-004');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1018,'tbl_kwitansi','2017-02-17','22:09:32','ALEX','TAMBAH KWITANSI KT170217-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1019,'tbl_notajual','2017-02-17','22:10:18','ALEX','TAMBAH NOTA JUAL NJ1170217-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1020,'tbl_kwitansi','2017-02-17','22:10:55','ALEX','TAMBAH KWITANSI KPL170217-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1021,'tbl_cekfisik','2017-02-17','22:11:19','ALEX','TAMBAH CEK FISIK NJ1170217-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1022,'tbl_notajual','2017-02-17','22:11:53','ALEX','UPDATE SETUJUI NJ1170217-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1023,'tbl_pengeluaranunit','2017-02-17','22:12:53','ALEX','TAMBAH PENGELUARAN UNIT NJ1170217-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1024,'tbl_stnkbpkb','2017-02-17','22:14:13','ALEX','UBAH STNK BPKB 4 ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1025,'tbl_stnkbpkb','2017-02-17','22:14:22','ALEX','UBAH STNK BPKB 4 ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1026,'tbl_stnkbpkb','2017-02-17','22:18:08','ALEX','UBAH STNK BPKB 4 ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1027,'tbl_stnkbpkb','2017-02-17','22:41:37','ALEX','UBAH STNK BPKB 2 NJ1170217-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1028,'x23_abis_dkonfirmasi','2017-02-20','19:55:02','alex','MENOLAK KONFIRMASI POTONGAN KOMPENSASI ID 3');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1029,'tbl_kaskecil','2017-02-20','19:55:26','ALEX','OUTPUT 43');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1030,'tbl_abis_dkonfirmasi','2017-02-20','19:55:38','ALEX','MENYETUJUI KONFIRMASI KASKECIL ID 5');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1031,'tbl_karyawan','2017-02-20','19:58:04','ALEX','TAMBAH KARYAWAN SALES AJ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1032,'tbl_karyawan','2017-02-20','19:58:45','ALEX','TAMBAH KARYAWAN KASIR AJ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1033,'tbl_user','2017-02-20','20:00:03','ALEX','TAMBAH USER sales-aj');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1034,'tbl_user','2017-02-20','20:00:20','ALEX','TAMBAH USER kasir-aj');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1035,'tbl_notabeli','2017-02-20','20:02:36','ALEX','TAMBAH NOTA BELI NB1170220-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1036,'tbl_notabeli','2017-02-20','20:03:07','ALEX','TAMBAH NOTA BELI NB1170220-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1037,'tbl_notabeli','2017-02-20','20:03:50','ALEX','TAMBAH NOTA BELI NB1170220-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1038,'tbl_stokunit','2017-02-20','20:04:12','ALEX','TAMBAH STOK NB1170220-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1039,'tbl_stokunit','2017-02-20','20:04:28','ALEX','TAMBAH STOK NB1170220-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1040,'tbl_stokunit','2017-02-20','20:04:41','ALEX','TAMBAH STOK NB1170220-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1041,'tbl_notabeli','2017-02-20','20:05:10','ALEX','BAYAR NOTA BELI NB1170220-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1042,'tbl_notabeli','2017-02-20','20:05:19','ALEX','BAYAR NOTA BELI NB1170220-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1043,'tbl_notabeli','2017-02-20','20:05:27','ALEX','BAYAR NOTA BELI NB1170220-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1044,'tbl_pesanan','2017-02-20','20:08:21','SALES-AJ','TAMBAH PESANAN NP170220-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1045,'tbl_pesanan','2017-02-20','20:09:07','SALES-AJ','TAMBAH PESANAN NP170220-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1046,'tbl_pesanan','2017-02-20','20:09:50','SALES-AJ','TAMBAH PESANAN NP170220-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1047,'tbl_piutang','2017-02-20','20:29:47','KASIR-AJ','TAMBAH PIUTANG SALES AJ 56');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1048,'tbl_kaskecil','2017-02-20','20:37:34','AJ-AJ','OUTPUT 54');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1049,'tbl_kaskecil','2017-02-20','20:37:41','AJ-AJ','INPUT 5.454');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1050,'tbl_kaskecil','2017-02-20','20:37:51','AJ-AJ','INPUT 4.554');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1051,'tbl_kaskecil','2017-02-20','20:37:57','AJ-AJ','OUTPUT 5.445');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1052,'tbl_pindah','2017-02-20','20:45:49','ALEX','TAMBAH PINDAH STOK 2017-02-20');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1053,'tbl_pindah','2017-02-20','20:46:05','ALEX','TAMBAH PINDAH STOK 2017-02-20');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1054,'tbl_pindah','2017-02-20','20:46:48','ALEX','TAMBAH PINDAH STOK 2017-02-20');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1055,'tbl_transfer','2017-02-20','20:47:15','ALEX','TAMBAH MUTASI KELUAR NT170220-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1056,'tbl_notabeli','2017-02-20','20:47:46','ALEX','TAMBAH NOTA BELI ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1057,'tbl_transfer','2017-02-20','20:48:38','ALEX','TAMBAH MUTASI KELUAR NT170220-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1058,'tbl_transfer','2017-02-20','20:50:20','ALEX','TAMBAH MUTASI KELUAR NT170220-004');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1059,'tbl_notabeli','2017-02-20','20:51:28','ALEX','TAMBAH NOTA BELI ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1060,'tbl_abis_dkonfirmasi','2017-02-20','20:52:19','ALEX','MENOLAK KONFIRMASI PEMINDAHAN STOK ID 3');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1061,'tbl_abis_dkonfirmasi','2017-02-20','20:52:23','ALEX','MENOLAK KONFIRMASI PEMINDAHAN STOK ID 2');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1062,'tbl_abis_dkonfirmasi','2017-02-20','20:52:27','ALEX','MENOLAK KONFIRMASI PEMINDAHAN STOK ID 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1063,'tbl_stnkbpkb','2017-02-20','21:07:05','ALEX','UBAH STNK BPKB 4');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1064,'tbl_stnkbpkb','2017-02-20','21:07:19','ALEX','UBAH STNK BPKB 4 NJ1170217-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1065,'tbl_pesanan','2017-02-20','21:11:50','ALEX','TAMBAH PESANAN NP170220-004');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1066,'tbl_pengeluaranunit','2017-02-20','21:13:51','ALEX','UBAH PENGIRIMAN UNIT UNIT 1 NJ1170217-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1067,'tbl_pengeluaranunit','2017-02-20','21:14:48','ALEX','UBAH PENGIRIMAN UNIT UNIT 2 NJ1170217-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1068,'tbl_pengeluaranunit','2017-02-20','21:14:50','ALEX','UBAH PENGIRIMAN UNIT UNIT 4 NJ1170217-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1069,'tbl_notabeli','2017-02-20','21:18:47','ALEX','TAMBAH NOTA BELI NB1170220-006');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1070,'tbl_stokunit','2017-02-20','21:19:03','ALEX','TAMBAH STOK NB1170220-006');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1071,'tbl_notabeli','2017-02-20','21:19:51','ALEX','TAMBAH NOTA BELI NB1170220-007');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1072,'tbl_stokunit','2017-02-20','21:20:05','ALEX','TAMBAH STOK NB1170220-007');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1073,'tbl_notabeli','2017-02-20','21:20:34','ALEX','BAYAR NOTA BELI NB1170220-007');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1074,'tbl_notabeli','2017-02-20','21:20:49','ALEX','BAYAR NOTA BELI NB1170220-006');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1075,'tbl_piutang','2017-02-20','21:21:49','ALEX','TAMBAH PIUTANG KASIR AJ 324');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1076,'tbl_piutang','2017-02-20','21:22:01','ALEX','TAMBAH PIUTANG KEPALA TOKO 324423');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1077,'tbl_abis_dkonfirmasi','2017-02-20','21:22:21','ALEX','MENYETUJUI KONFIRMASI PIUTANG KARYAWAN ID 3');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1078,'tbl_abis_dkonfirmasi','2017-02-20','21:22:25','ALEX','MENYETUJUI KONFIRMASI PIUTANG KARYAWAN ID 2');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1079,'abs_status','2017-02-20','21:24:36','ALEX','TAMBAH DISPENSASI H1-002 IZIN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1080,'tbl_transfer','2017-02-21','21:45:13','ALEX','TAMBAH MUTASI KELUAR NT170221-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1081,'x23_notabeli','2017-02-20','22:17:20','alex','TAMBAH NOTA BELI NB2170220-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1082,'x23_stokpart','2017-02-20','22:17:36','alex','TAMBAH STOK NB2170220-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1083,'x23_user','2017-02-20','22:17:49','alex','TAMBAH USER aj-aj');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1084,'x23_notabeli','2017-02-20','22:17:58','alex','TAMBAH NOTA BELI NB2170220-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1085,'x23_notabeli','2017-02-20','22:20:59','alex','TAMBAH NOTA BELI NB2170220-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1086,'x23_stokpart','2017-02-20','22:21:12','alex','TAMBAH STOK NB2170220-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1087,'x23_notabeli','2017-02-20','22:22:25','alex','TAMBAH NOTA BELI NB2170220-004');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1088,'x23_stokpart','2017-02-20','22:22:40','alex','TAMBAH STOK NB2170220-004');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1089,'x23_notaservice','2017-02-20','22:48:33','alex','UPDATE NOTA SERVIS NS170220-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1090,'x23_notaservice','2017-02-20','22:49:52','alex','UPDATE NOTA SERVIS NS170220-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1091,'x23_kaskecil','2017-02-20','22:58:06','alex','OUTPUT 2.343');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1092,'x23_kaskecil','2017-02-20','22:58:12','alex','INPUT 23.423');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1093,'x23_user','2017-02-22','20:10:33','ALEX','TAMBAH USER kepalabengkel');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1094,'x23_tutupharian','2017-02-22','20:12:00','ALEX','TAMBAH TUTUP HARIAN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1095,'x23_kompensasi','2017-02-22','20:31:38','KEPALABENGKEL','BATAL BAYAR UANG HARIAN 235');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1096,'x23_user','2017-02-22','20:36:40','ALEX','TAMBAH USER counterpart');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1097,'x23_user','2017-02-22','21:07:18','ALEX','TAMBAH USER sa');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1098,'tbl_notajual_det','2017-02-22','21:25:56','ALEX','BAYAR TAMBAH LAIN 1 NJ1170217-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1099,'tbl_notajual_det','2017-02-22','21:26:38','ALEX','BAYAR KURANG LAIN 1 NJ1170217-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1100,'tbl_notajual_det','2017-02-22','21:27:09','ALEX','RESET KURANG LAIN 1 NJ1170217-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1101,'tbl_notajual_det','2017-02-22','21:27:17','ALEX','RESET TAMBAH LAIN 1 NJ1170217-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1102,'x23_karyawan','2017-02-22','21:40:15','KEPALABENGKEL','UBAH KARYAWAN KASIR');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1103,'tbl_lainbbn','2017-02-22','21:45:30','ALEX','TAMBAH BIAYA LAIN-LAIN BBN 2017-02-22');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1104,'tbl_lainbbn','2017-02-22','21:45:40','ALEX','TAMBAH BIAYA LAIN-LAIN BBN 2017-02-22');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1105,'tbl_lainbbn','2017-02-22','21:45:45','ALEX','HAPUS PAJAK');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1106,'tbl_lainbbn','2017-02-22','21:45:47','ALEX','AKTIF PAJAK');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1107,'tbl_notajual_det','2017-02-22','22:10:24','ALEX','KIRIM TAGIHAN LEASING NJ1170217-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1108,'tbl_notajual_det','2017-02-22','22:10:30','ALEX','BAYAR OTR 2.000.000 NJ1170217-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1109,'tbl_notajual_det','2017-02-22','22:10:36','ALEX','BAYAR GROSS 100.000 NJ1170217-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1110,'tbl_notajual_det','2017-02-22','22:10:45','ALEX','BAYAR SUBSIDI 99.800 NJ1170217-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1111,'tbl_notajual_det','2017-02-22','22:10:51','ALEX','BAYAR MATRIX 91.818 NJ1170217-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1112,'tbl_notajual_det','2017-02-22','22:18:33','ALEX','RESET MATRIX  NJ1170217-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1113,'x23_kaskecil','2017-02-22','22:36:18','KEPALABENGKEL','OUTPUT 78');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1114,'x23_notabeli','2017-02-22','22:54:42','KEPALABENGKEL','UBAH NOTA BELI ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1115,'x23_notabeli','2017-02-22','22:55:34','KEPALABENGKEL','UBAH NOTA BELI ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1116,'x23_notabeli','2017-02-22','22:56:48','KEPALABENGKEL','UBAH NOTA BELI ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1117,'x23_kompensasi','2017-02-22','23:13:12','ALEX','BATAL BAYAR UANG HARIAN 241');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1118,'','2017-02-24','21:02:14','ALEX','HAPUS DATABASE 1 ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1119,'tbl_notabeli','2017-02-24','21:02:52','ALEX','TAMBAH NOTA BELI NB1170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1120,'tbl_stokunit','2017-02-24','21:03:54','ALEX','TAMBAH STOK NB1170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1121,'x23_notabeli','2017-02-24','21:08:25','KEPALABENGKEL','UBAH NOTA BELI ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1122,'tbl_notabeli','2017-02-24','21:10:29','ALEX','BAYAR NOTA BELI NB1170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1123,'tbl_pesanan','2017-02-24','21:11:43','ALEX','TAMBAH PESANAN NP170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1124,'tbl_kwitansi','2017-02-24','21:12:12','ALEX','TAMBAH KWITANSI KUM170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1125,'tbl_notajual','2017-02-24','21:14:40','ALEX','TAMBAH NOTA JUAL NJ1170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1126,'x23_kwitansi','2017-02-24','21:16:05','KEPALABENGKEL','TAMBAH KWITANSI KI170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1127,'tbl_cekfisik','2017-02-24','21:19:06','ALEX','TAMBAH CEK FISIK NJ1170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1128,'tbl_notajual','2017-02-24','21:20:13','ALEX','UPDATE SETUJUI NJ1170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1129,'tbl_pengeluaranunit','2017-02-24','21:20:44','ALEX','TAMBAH PENGELUARAN UNIT NJ1170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1130,'tbl_pengeluaranunit','2017-02-24','21:21:31','ALEX','UBAH PENGIRIMAN UNIT UNIT 1 NJ1170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1131,'tbl_notajual_det','2017-02-24','21:21:44','ALEX','KIRIM TAGIHAN LEASING NJ1170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1132,'tbl_notajual_det','2017-02-24','21:21:50','ALEX','BAYAR OTR 30.000.000 NJ1170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1133,'tbl_notajual_det','2017-02-24','21:21:55','ALEX','BAYAR GROSS 2.000.000 NJ1170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1134,'tbl_notajual_det','2017-02-24','21:22:01','ALEX','BAYAR MATRIX 459.091 NJ1170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1135,'tbl_notajual_det','2017-02-24','21:22:07','ALEX','BAYAR SUBSIDI 498.501 NJ1170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1136,'x23_notajual','2017-02-24','21:40:23','KEPALABENGKEL','TAMBAH NOTA JUAL NJ2170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1137,'x23_pindah','2017-02-24','21:51:41','KEPALABENGKEL','TAMBAH PINDAH STOK 2017-02-24 3');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1138,'x23_abis_dkonfirmasi','2017-02-24','21:52:04','KEPALABENGKEL','MENYETUJUI KONFIRMASI PEMINDAHAN STOK ID 3');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1139,'x23_notabeli','2017-02-24','21:56:22','KEPALABENGKEL','TAMBAH NOTA BELI NC170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1140,'tbl_notabeli','2017-02-24','22:04:09','ALEX','TAMBAH NOTA BELI NB1170224-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1141,'tbl_stokunit','2017-02-24','22:04:32','ALEX','TAMBAH STOK NB1170224-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1142,'tbl_notabeli','2017-02-24','22:05:11','ALEX','BAYAR NOTA BELI NB1170224-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1143,'tbl_pesanan','2017-02-24','22:06:12','ALEX','TAMBAH PESANAN NP170224-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1144,'x23_notabeli','2017-02-24','22:06:29','KEPALABENGKEL','TAMBAH NOTA BELI NB2170224-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1145,'tbl_kwitansi','2017-02-24','22:06:47','ALEX','TAMBAH KWITANSI KUM170224-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1146,'x23_stokpart','2017-02-24','22:06:55','KEPALABENGKEL','TAMBAH STOK NB2170224-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1147,'x23_stokpart','2017-02-24','22:07:12','KEPALABENGKEL','UPDATE HARGA JUAL NB2170224-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1148,'tbl_notajual','2017-02-24','22:07:19','ALEX','TAMBAH NOTA JUAL NJ1170224-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1149,'x23_notaservice','2017-02-24','22:07:35','KEPALABENGKEL','UPDATE NOTA SERVIS NS170224-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1150,'tbl_cekfisik','2017-02-24','22:07:41','ALEX','TAMBAH CEK FISIK NJ1170224-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1151,'tbl_notajual','2017-02-24','22:09:40','ALEX','UPDATE SETUJUI NJ1170224-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1152,'tbl_pengeluaranunit','2017-02-24','22:10:11','ALEX','TAMBAH PENGELUARAN UNIT NJ1170224-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1153,'tbl_pengeluaranunit','2017-02-24','22:10:18','ALEX','UBAH PENGIRIMAN UNIT UNIT 2 NJ1170224-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1154,'x23_notabeli','2017-02-24','22:10:48','KEPALABENGKEL','UBAH NOTA BELI ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1155,'x23_piutang','2017-02-24','22:11:34','KEPALABENGKEL','TAMBAH PIUTANG KEPALA MEKANIK 3223');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1156,'x23_abis_dkonfirmasi','2017-02-24','22:11:45','KEPALABENGKEL','MENYETUJUI KONFIRMASI PIUTANG KARYAWAN ID 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1157,'tbl_notajual_det','2017-02-24','22:12:49','ALEX','KIRIM TAGIHAN LEASING NJ1170224-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1158,'x23_potkompensasi','2017-02-24','22:13:06','KEPALABENGKEL','TAMBAH POTONGAN KOMPENSASI COUNTER PART 334');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1159,'tbl_notajual_det','2017-02-24','22:15:36','ALEX','KIRIM TAGIHAN LEASING NJ1170224-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1160,'tbl_notajual_det','2017-02-24','22:15:41','ALEX','BAYAR OTR 32.000.000 NJ1170224-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1161,'tbl_notajual_det','2017-02-24','22:15:45','ALEX','BAYAR GROSS 2.500.000 NJ1170224-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1162,'tbl_notajual_det','2017-02-24','22:15:50','ALEX','BAYAR SUBSIDI 697.902 NJ1170224-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1163,'tbl_notajual_det','2017-02-24','22:15:54','ALEX','BAYAR MATRIX 550.909 NJ1170224-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1164,'x23_notaservice','2017-02-24','22:38:42','COUNTERPART','UPDATE NOTA SERVIS NS170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1165,'x23_returbeli','2017-02-24','22:42:57','COUNTERPART','TAMBAH RETUR BELI NB2170116-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1166,'x23_returbeli','2017-02-24','22:44:36','COUNTERPART','KONFIRMASI RETUR BELI NR2170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1167,'','2017-02-24','22:56:39','ALEX','HAPUS DATABASE 1 ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1168,'tbl_notabeli','2017-02-24','22:57:06','ALEX','TAMBAH NOTA BELI NB1170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1169,'tbl_stokunit','2017-02-24','22:57:24','ALEX','TAMBAH STOK NB1170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1170,'tbl_notabeli','2017-02-24','22:58:05','ALEX','BAYAR NOTA BELI NB1170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1171,'tbl_pesanan','2017-02-24','22:58:36','ALEX','TAMBAH PESANAN NP170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1172,'tbl_kwitansi','2017-02-24','22:58:54','ALEX','TAMBAH KWITANSI KUM170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1173,'tbl_notajual','2017-02-24','22:59:23','ALEX','TAMBAH NOTA JUAL NJ1170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1174,'tbl_cekfisik','2017-02-24','22:59:45','ALEX','TAMBAH CEK FISIK NJ1170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1175,'tbl_notajual','2017-02-24','23:01:06','ALEX','UPDATE SETUJUI NJ1170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1176,'tbl_pengeluaranunit','2017-02-24','23:01:24','ALEX','TAMBAH PENGELUARAN UNIT NJ1170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1177,'tbl_pengeluaranunit','2017-02-24','23:01:28','ALEX','UBAH PENGIRIMAN UNIT UNIT 1 NJ1170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1178,'tbl_notajual_det','2017-02-24','23:01:43','ALEX','KIRIM TAGIHAN LEASING NJ1170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1179,'tbl_notajual_det','2017-02-24','23:01:47','ALEX','BAYAR OTR 30.000.000 NJ1170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1180,'tbl_notajual_det','2017-02-24','23:01:50','ALEX','BAYAR GROSS 2.000.000 NJ1170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1181,'tbl_notajual_det','2017-02-24','23:01:55','ALEX','BAYAR SUBSIDI 498.501 NJ1170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1182,'tbl_notajual_det','2017-02-24','23:02:01','ALEX','BAYAR MATRIX 918.182 NJ1170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1183,'','2017-02-24','23:29:22','ALEX','HAPUS DATABASE 1 ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1184,'tbl_notabeli','2017-02-24','23:53:04','ALEX','TAMBAH NOTA BELI NB1170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1185,'tbl_stokunit','2017-02-24','23:53:20','ALEX','TAMBAH STOK NB1170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1186,'tbl_notabeli','2017-02-24','23:53:32','ALEX','BAYAR NOTA BELI NB1170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1187,'tbl_pesanan','2017-02-24','23:53:51','ALEX','TAMBAH PESANAN NP170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1188,'tbl_kwitansi','2017-02-24','23:54:16','ALEX','TAMBAH KWITANSI KUM170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1189,'tbl_notajual','2017-02-24','23:55:23','ALEX','TAMBAH NOTA JUAL NJ1170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1190,'tbl_cekfisik','2017-02-24','23:56:21','ALEX','TAMBAH CEK FISIK NJ1170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1191,'tbl_notajual','2017-02-24','23:56:57','ALEX','UPDATE SETUJUI NJ1170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1192,'tbl_pengeluaranunit','2017-02-24','23:57:09','ALEX','TAMBAH PENGELUARAN UNIT NJ1170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1193,'tbl_pengeluaranunit','2017-02-24','23:57:18','ALEX','UBAH PENGIRIMAN UNIT UNIT 1 NJ1170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1194,'tbl_notajual_det','2017-02-24','23:57:25','ALEX','KIRIM TAGIHAN LEASING NJ1170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1195,'tbl_notajual_det','2017-02-24','23:57:32','ALEX','BAYAR OTR 30.000.000 NJ1170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1196,'tbl_notajual_det','2017-02-24','23:57:36','ALEX','BAYAR GROSS 3.000.000 NJ1170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1197,'tbl_notajual_det','2017-02-24','23:57:41','ALEX','BAYAR SUBSIDI 299.101 NJ1170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1198,'tbl_notajual_det','2017-02-24','23:57:46','ALEX','BAYAR MATRIX 183.636 NJ1170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1199,'x23_kwitansi','2017-02-26','10:52:35','ALEX','TAMBAH KWITANSI KPJ170116-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1200,'x23_kwitansi','2017-02-26','10:54:02','ALEX','TAMBAH KWITANSI KPJ170121-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1201,'x23_kwitansi','2017-02-26','10:55:07','ALEX','TAMBAH KWITANSI KPJ170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1202,'x23_kwitansi','2017-02-27','20:02:36','ALEX','TAMBAH KWITANSI KS170121-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1203,'x23_notajual','2017-02-27','20:05:13','ALEX','TAMBAH NOTA JUAL NJ2170227-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1204,'x23_kwitansi','2017-02-27','20:06:32','ALEX','TAMBAH KWITANSI KI170224-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1205,'x23_piutang','2017-02-27','20:23:51','ALEX','TAMBAH PIUTANG COUNTER PART 111');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1206,'x23_abis_dkonfirmasi','2017-02-27','20:24:08','ALEX','MENYETUJUI KONFIRMASI PIUTANG KARYAWAN ID 2');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1207,'x23_piutang','2017-02-27','20:39:37','ALEX','TAMBAH PEMBAYARAN COUNTER PART 1');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1208,'x23_abis_dkonfirmasi','2017-02-27','20:39:48','ALEX','MENYETUJUI KONFIRMASI PEMBAYARAN PIUTANG KARYAWAN ID 3');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1209,'x23_piutang','2017-02-27','20:43:02','ALEX','TAMBAH PIUTANG MEKANIK EMPAT 111');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1210,'x23_abis_dkonfirmasi','2017-02-27','20:43:14','ALEX','MENYETUJUI KONFIRMASI PIUTANG KARYAWAN ID 4');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1211,'tbl_notajual_det','2017-02-27','20:44:22','ALEX','BAYAR SUBSIDI 299.101 NJ1170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1212,'tbl_notajual_det','2017-02-27','20:44:33','ALEX','BAYAR MATRIX 183.636 NJ1170224-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1213,'tbl_notabeli','2017-02-27','20:53:59','ALEX','TAMBAH NOTA BELI NB1170227-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1214,'tbl_stokunit','2017-02-27','20:54:35','ALEX','TAMBAH STOK NB1170227-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1215,'x23_kwitansi','2017-02-27','21:12:51','ALEX','TAMBAH KWITANSI KPJ170227-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1216,'x23_kwitansi','2017-02-27','21:13:29','ALEX','TAMBAH KWITANSI KI170224-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1217,'x23_kwitansi','2017-02-27','21:13:35','ALEX','TAMBAH KWITANSI KI170224-004');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1218,'x23_tutupharian','2017-02-27','21:14:14','ALEX','TAMBAH TUTUP HARIAN');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1219,'','2017-03-01','10:55:27','ALEX','HAPUS DATABASE 1 ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1220,'tbl_notabeli','2017-03-01','10:57:36','ALEX','TAMBAH NOTA BELI NB1170301-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1221,'tbl_stokunit','2017-03-01','10:58:23','ALEX','TAMBAH STOK NB1170301-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1222,'tbl_notabeli','2017-03-01','10:58:51','ALEX','BAYAR NOTA BELI NB1170301-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1223,'','2017-03-01','11:05:43','ALEX','HAPUS DATABASE 1 ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1224,'tbl_notabeli','2017-03-01','11:06:48','ALEX','TAMBAH NOTA BELI NB1170301-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1225,'tbl_stokunit','2017-03-01','11:09:09','ALEX','TAMBAH STOK NB1170301-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1226,'tbl_notabeli','2017-03-01','11:09:41','ALEX','BAYAR NOTA BELI NB1170301-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1227,'tbl_pesanan','2017-03-01','11:24:38','ALEX','TAMBAH PESANAN NP170301-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1228,'tbl_kwitansi','2017-03-01','11:29:03','ALEX','TAMBAH KWITANSI KUM170301-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1229,'tbl_notajual','2017-03-01','11:35:22','ALEX','TAMBAH NOTA JUAL NJ1170301-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1230,'tbl_cekfisik','2017-03-01','11:35:58','ALEX','TAMBAH CEK FISIK NJ1170301-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1231,'tbl_notajual','2017-03-01','11:38:12','ALEX','UPDATE SETUJUI NJ1170301-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1232,'tbl_pengeluaranunit','2017-03-01','11:40:03','ALEX','TAMBAH PENGELUARAN UNIT NJ1170301-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1233,'tbl_pengeluaranunit','2017-03-01','11:40:18','ALEX','UBAH PENGIRIMAN UNIT UNIT 1 NJ1170301-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1234,'tbl_notajual_det','2017-03-01','11:40:38','ALEX','KIRIM TAGIHAN LEASING NJ1170301-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1235,'tbl_notajual_det','2017-03-01','11:41:10','ALEX','KIRIM TAGIHAN LEASING NJ1170301-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1236,'tbl_notajual_det','2017-03-01','11:41:16','ALEX','BAYAR OTR 25.000.000 NJ1170301-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1237,'tbl_notajual_det','2017-03-01','11:41:32','ALEX','BAYAR GROSS 1.750.000 NJ1170301-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1238,'tbl_notajual_det','2017-03-01','11:41:50','ALEX','BAYAR SUBSIDI 498.501 NJ1170301-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1239,'tbl_notajual_det','2017-03-01','11:41:54','ALEX','BAYAR MATRIX 550.909 NJ1170301-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1240,'tbl_notabeli','2017-03-01','14:07:05','ALEX','BAYAR NOTA BELI NB1170301-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1241,'tbl_notabeli','2017-03-01','14:07:05','ALEX','BAYAR NOTA BELI NB1170301-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1242,'','2017-03-01','14:13:53','ALEX','HAPUS DATABASE 1 ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1243,'tbl_notabeli','2017-03-01','14:14:50','ALEX','TAMBAH NOTA BELI NB1170301-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1244,'tbl_stokunit','2017-03-01','14:15:25','ALEX','TAMBAH STOK NB1170301-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1245,'tbl_pesanan','2017-03-01','14:17:29','ALEX','TAMBAH PESANAN NP170301-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1246,'tbl_kwitansi','2017-03-01','14:18:19','ALEX','TAMBAH KWITANSI KUM170301-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1247,'tbl_notajual','2017-03-01','14:19:03','ALEX','TAMBAH NOTA JUAL NJ1170301-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1248,'tbl_cekfisik','2017-03-01','14:19:30','ALEX','TAMBAH CEK FISIK NJ1170301-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1249,'tbl_notajual','2017-03-01','14:20:11','ALEX','UPDATE SETUJUI NJ1170301-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1250,'tbl_pengeluaranunit','2017-03-01','14:20:38','ALEX','TAMBAH PENGELUARAN UNIT NJ1170301-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1251,'tbl_pengeluaranunit','2017-03-01','14:23:14','ALEX','UBAH PENGIRIMAN UNIT UNIT 1 NJ1170301-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1252,'tbl_notajual_det','2017-03-01','14:23:31','ALEX','KIRIM TAGIHAN LEASING NJ1170301-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1253,'tbl_notajual_det','2017-03-01','14:24:07','ALEX','BAYAR OTR 25.000.000 NJ1170301-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1254,'tbl_notajual_det','2017-03-01','14:24:14','ALEX','BAYAR GROSS 1.750.000 NJ1170301-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1255,'tbl_notajual_det','2017-03-01','14:24:21','ALEX','BAYAR SUBSIDI 499.000 NJ1170301-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1256,'tbl_notajual_det','2017-03-01','14:24:27','ALEX','BAYAR MATRIX 550.909 NJ1170301-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1257,'tbl_notabeli','2017-03-01','14:56:38','ALEX','BAYAR NOTA BELI NB1170301-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1258,'tbl_notabeli','2017-03-01','15:06:02','ALEX','BAYAR NOTA BELI NB1170301-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1259,'tbl_notabeli','2017-03-01','15:06:02','ALEX','BAYAR NOTA BELI NB1170301-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1260,'tbl_notabeli','2017-03-01','15:10:43','ALEX','BAYAR NOTA BELI NB1170301-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1261,'tbl_notabeli','2017-03-01','15:17:34','ALEX','BAYAR NOTA BELI NB1170301-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1262,'tbl_notabeli','2017-03-01','15:22:47','ALEX','BAYAR NOTA BELI NB1170301-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1263,'tbl_notabeli','2017-03-01','15:32:11','ALEX','BAYAR NOTA BELI NB1170301-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1264,'tbl_notabeli','2017-03-01','15:33:57','ALEX','BAYAR NOTA BELI NB1170301-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1265,'tbl_notabeli','2017-03-20','21:34:52','ALEX','BAYAR NOTA BELI NB1170301-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1266,'tbl_notabeli','2017-03-20','21:36:29','ALEX','BAYAR NOTA BELI NB1170301-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1267,'tbl_notabeli','2017-03-20','21:36:29','ALEX','BAYAR NOTA BELI NB1170301-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1268,'','2017-03-20','21:37:58','ALEX','HAPUS DATABASE 1 ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1269,'tbl_notabeli','2017-03-20','21:38:54','ALEX','TAMBAH NOTA BELI NB1170320-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1270,'tbl_stokunit','2017-03-20','21:41:16','ALEX','TAMBAH STOK NB1170320-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1271,'tbl_pesanan','2017-03-20','21:42:45','ALEX','TAMBAH PESANAN NP170320-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1272,'tbl_kwitansi','2017-03-20','21:43:42','ALEX','TAMBAH KWITANSI KUM170320-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1273,'tbl_notajual','2017-03-20','21:45:00','ALEX','TAMBAH NOTA JUAL NJ1170320-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1274,'tbl_cekfisik','2017-03-20','21:45:26','ALEX','TAMBAH CEK FISIK NJ1170320-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1275,'tbl_notajual','2017-03-20','21:53:55','ALEX','UPDATE SETUJUI NJ1170320-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1276,'tbl_pengeluaranunit','2017-03-20','21:55:40','ALEX','TAMBAH PENGELUARAN UNIT NJ1170320-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1277,'tbl_pengeluaranunit','2017-03-20','21:56:49','ALEX','UBAH PENGIRIMAN UNIT UNIT 8 NJ1170320-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1278,'tbl_notajual_det','2017-03-20','21:57:04','ALEX','KIRIM TAGIHAN LEASING NJ1170320-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1279,'tbl_notajual_det','2017-03-20','21:57:12','ALEX','BAYAR OTR 15.000.000 NJ1170320-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1280,'tbl_notajual_det','2017-03-20','21:57:20','ALEX','BAYAR GROSS 200.000 NJ1170320-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1281,'tbl_notajual_det','2017-03-20','21:57:26','ALEX','BAYAR SUBSIDI 199.600 NJ1170320-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1282,'tbl_notajual_det','2017-03-20','21:57:33','ALEX','BAYAR MATRIX 137.727 NJ1170320-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1283,'tbl_notajual_det','2017-03-20','21:57:39','ALEX','BAYAR SCPAHM 250.000 NJ1170320-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1284,'tbl_notajual_det','2017-03-20','21:57:46','ALEX','BAYAR SCPMD 250.000 NJ1170320-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1285,'tbl_notabeli','2017-03-20','22:13:20','ALEX','BAYAR NOTA BELI NB1170320-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1286,'tbl_notabeli','2017-03-20','22:13:52','ALEX','BAYAR NOTA BELI NB1170320-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1287,'tbl_notabeli','2017-03-20','22:13:52','ALEX','BAYAR NOTA BELI NB1170320-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1288,'tbl_pesanan','2017-03-20','22:17:28','ALEX','TAMBAH PESANAN NP170320-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1289,'tbl_kwitansi','2017-03-20','22:17:57','ALEX','TAMBAH KWITANSI KUM170320-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1290,'tbl_notajual','2017-03-20','22:18:44','ALEX','TAMBAH NOTA JUAL NJ1170320-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1291,'tbl_cekfisik','2017-03-20','22:19:52','ALEX','TAMBAH CEK FISIK NJ1170320-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1292,'tbl_notajual','2017-03-20','22:26:27','ALEX','UPDATE SETUJUI NJ1170320-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1293,'tbl_pengeluaranunit','2017-03-20','22:27:10','ALEX','TAMBAH PENGELUARAN UNIT NJ1170320-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1294,'tbl_pengeluaranunit','2017-03-20','22:27:19','ALEX','UBAH PENGIRIMAN UNIT UNIT 9 NJ1170320-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1295,'tbl_notajual_det','2017-03-20','22:27:36','ALEX','KIRIM TAGIHAN LEASING NJ1170320-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1296,'tbl_notajual_det','2017-03-20','22:27:42','ALEX','BAYAR OTR 20.000.000 NJ1170320-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1297,'tbl_notajual_det','2017-03-20','22:27:47','ALEX','BAYAR GROSS 150.000 NJ1170320-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1298,'tbl_notajual_det','2017-03-20','22:27:55','ALEX','BAYAR SUBSIDI 199.202 NJ1170320-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1299,'tbl_notajual_det','2017-03-20','22:28:03','ALEX','BAYAR MATRIX 137.727 NJ1170320-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1300,'tbl_notabeli','2017-03-20','22:36:15','ALEX','TAMBAH NOTA BELI NB1170320-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1301,'tbl_stokunit','2017-03-20','22:36:36','ALEX','TAMBAH STOK NB1170320-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1302,'tbl_notabeli','2017-03-20','22:36:59','ALEX','BAYAR NOTA BELI NB1170320-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1303,'tbl_pesanan','2017-03-20','22:37:47','ALEX','TAMBAH PESANAN NP170320-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1304,'tbl_kwitansi','2017-03-20','22:38:20','ALEX','TAMBAH KWITANSI KT170320-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1305,'tbl_hutitipan','2017-03-20','22:39:09','ALEX','TAMBAH RIWAYAT UANG TITIPAN JUAL NP170320-003 1500000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1306,'tbl_hutitipan','2017-03-20','22:50:22','ALEX','TAMBAH RIWAYAT UANG TITIPAN JUAL NP170320-003 2000000');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1307,'tbl_notajual','2017-03-20','22:52:16','ALEX','TAMBAH NOTA JUAL NJ1170320-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1308,'tbl_kwitansi','2017-03-20','22:53:20','ALEX','TAMBAH KWITANSI KPL170320-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1309,'tbl_cekfisik','2017-03-20','22:53:42','ALEX','TAMBAH CEK FISIK NJ1170320-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1310,'tbl_notajual','2017-03-20','22:54:23','ALEX','UPDATE SETUJUI NJ1170320-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1311,'tbl_pengeluaranunit','2017-03-20','22:54:43','ALEX','TAMBAH PENGELUARAN UNIT NJ1170320-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1312,'tbl_pengeluaranunit','2017-03-20','22:54:52','ALEX','UBAH PENGIRIMAN UNIT UNIT 88 NJ1170320-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1313,'tbl_notabeli','2017-03-03','12:34:28','ALEX','TAMBAH NOTA BELI NB1170303-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1314,'tbl_stokunit','2017-03-03','12:34:54','ALEX','TAMBAH STOK NB1170303-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1315,'tbl_pesanan','2017-03-03','12:35:26','ALEX','TAMBAH PESANAN NP170303-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1316,'tbl_kwitansi','2017-03-03','12:35:55','ALEX','TAMBAH KWITANSI KUM170303-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1317,'tbl_kwitansi','2017-03-03','12:39:39','ALEX','TAMBAH KWITANSI KUM170303-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1318,'tbl_notajual','2017-03-03','12:40:05','ALEX','TAMBAH NOTA JUAL NJ1170303-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1319,'tbl_cekfisik','2017-03-03','12:41:50','ALEX','TAMBAH CEK FISIK NJ1170303-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1320,'tbl_notajual','2017-03-03','12:42:30','ALEX','UPDATE SETUJUI NJ1170303-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1321,'tbl_pengeluaranunit','2017-03-03','12:42:53','ALEX','TAMBAH PENGELUARAN UNIT NJ1170303-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1322,'tbl_pengeluaranunit','2017-03-03','12:43:03','ALEX','UBAH PENGIRIMAN UNIT UNIT 1 NJ1170303-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1323,'tbl_notajual_det','2017-03-03','12:43:16','ALEX','KIRIM TAGIHAN LEASING NJ1170303-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1324,'tbl_notajual_det','2017-03-03','12:43:21','ALEX','BAYAR OTR 25.000.000 NJ1170303-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1325,'tbl_notajual_det','2017-03-03','12:43:28','ALEX','BAYAR GROSS 2.000.000 NJ1170303-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1326,'tbl_notajual_det','2017-03-03','12:43:35','ALEX','BAYAR SUBSIDI 748.502 NJ1170303-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1327,'tbl_notajual_det','2017-03-03','12:43:40','ALEX','BAYAR MATRIX 550.909 NJ1170303-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1328,'tbl_notabeli','2017-03-03','12:46:43','ALEX','BAYAR NOTA BELI NB1170303-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1329,'','2017-03-23','19:49:55','ALEX','HAPUS DATABASE 1 ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1330,'tbl_notabeli','2017-03-23','19:50:39','ALEX','TAMBAH NOTA BELI NB1170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1331,'tbl_stokunit','2017-03-23','19:51:04','ALEX','TAMBAH STOK NB1170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1332,'tbl_notabeli','2017-03-23','19:53:36','ALEX','BAYAR NOTA BELI NB1170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1333,'tbl_pesanan','2017-03-23','19:54:05','ALEX','TAMBAH PESANAN NP170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1334,'tbl_kwitansi','2017-03-23','19:54:55','ALEX','TAMBAH KWITANSI KT170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1335,'tbl_notajual','2017-03-23','20:00:15','ALEX','TAMBAH NOTA JUAL NJ1170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1336,'tbl_notajual','2017-03-23','20:03:03','ALEX','TAMBAH NOTA JUAL NJ1170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1337,'tbl_kwitansi','2017-03-23','20:03:44','ALEX','TAMBAH KWITANSI KPL170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1338,'tbl_cekfisik','2017-03-23','20:04:12','ALEX','TAMBAH CEK FISIK NJ1170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1339,'tbl_notajual','2017-03-23','20:05:26','ALEX','UPDATE SETUJUI NJ1170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1340,'tbl_pengeluaranunit','2017-03-23','20:05:49','ALEX','TAMBAH PENGELUARAN UNIT NJ1170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1341,'tbl_pengeluaranunit','2017-03-23','20:05:58','ALEX','UBAH PENGIRIMAN UNIT UNIT 1 NJ1170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1342,'tbl_notabeli','2017-03-23','20:08:17','ALEX','TAMBAH NOTA BELI NB1170323-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1343,'tbl_stokunit','2017-03-23','20:08:45','ALEX','TAMBAH STOK NB1170323-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1344,'tbl_notabeli','2017-03-23','20:09:00','ALEX','BAYAR NOTA BELI NB1170323-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1345,'tbl_pesanan','2017-03-23','20:09:30','ALEX','TAMBAH PESANAN NP170323-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1346,'tbl_kwitansi','2017-03-23','20:11:48','ALEX','TAMBAH KWITANSI KUM170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1347,'tbl_notajual','2017-03-23','20:13:11','ALEX','TAMBAH NOTA JUAL NJ1170323-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1348,'tbl_cekfisik','2017-03-23','20:14:30','ALEX','TAMBAH CEK FISIK NJ1170323-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1349,'tbl_notajual','2017-03-23','20:15:21','ALEX','UPDATE SETUJUI NJ1170323-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1350,'tbl_pengeluaranunit','2017-03-23','20:15:43','ALEX','TAMBAH PENGELUARAN UNIT NJ1170323-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1351,'tbl_pengeluaranunit','2017-03-23','20:15:49','ALEX','UBAH PENGIRIMAN UNIT UNIT 2 NJ1170323-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1352,'tbl_notajual_det','2017-03-23','20:16:57','ALEX','KIRIM TAGIHAN LEASING NJ1170323-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1353,'tbl_notajual_det','2017-03-23','20:17:02','ALEX','BAYAR OTR 25.000.000 NJ1170323-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1354,'tbl_notajual_det','2017-03-23','20:17:07','ALEX','BAYAR GROSS 400.000 NJ1170323-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1355,'tbl_notajual_det','2017-03-23','20:17:12','ALEX','BAYAR SUBSIDI 399.200 NJ1170323-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1356,'tbl_notajual_det','2017-03-23','20:17:16','ALEX','BAYAR MATRIX 367.273 NJ1170323-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1357,'','2017-03-23','20:29:43','ALEX','HAPUS DATABASE 1 ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1358,'tbl_notabeli','2017-03-23','20:34:11','ALEX','TAMBAH NOTA BELI NB1170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1359,'tbl_stokunit','2017-03-23','20:34:31','ALEX','TAMBAH STOK NB1170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1360,'tbl_notabeli','2017-03-23','20:34:48','ALEX','BAYAR NOTA BELI NB1170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1361,'tbl_pesanan','2017-03-23','20:35:32','ALEX','TAMBAH PESANAN NP170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1362,'tbl_kwitansi','2017-03-23','20:36:53','ALEX','TAMBAH KWITANSI KUM170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1363,'tbl_notajual','2017-03-23','20:38:29','ALEX','TAMBAH NOTA JUAL NJ1170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1364,'tbl_cekfisik','2017-03-23','20:38:48','ALEX','TAMBAH CEK FISIK NJ1170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1365,'tbl_notajual','2017-03-23','20:39:31','ALEX','UPDATE SETUJUI NJ1170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1366,'tbl_pengeluaranunit','2017-03-23','20:40:00','ALEX','TAMBAH PENGELUARAN UNIT NJ1170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1367,'tbl_pengeluaranunit','2017-03-23','20:40:21','ALEX','UBAH PENGIRIMAN UNIT UNIT 1 NJ1170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1368,'tbl_notajual_det','2017-03-23','20:40:41','ALEX','KIRIM TAGIHAN LEASING NJ1170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1369,'tbl_notajual_det','2017-03-23','20:40:45','ALEX','BAYAR OTR 20.500.000 NJ1170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1370,'tbl_notajual_det','2017-03-23','20:40:49','ALEX','BAYAR GROSS 400.000 NJ1170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1371,'tbl_notajual_det','2017-03-23','20:40:54','ALEX','BAYAR SUBSIDI 348.951 NJ1170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1372,'tbl_notajual_det','2017-03-23','20:41:00','ALEX','BAYAR MATRIX 367.273 NJ1170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1373,'tbl_pesanan','2017-03-23','20:53:08','ALEX','TAMBAH PESANAN NP170323-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1374,'tbl_kwitansi','2017-03-23','20:53:33','ALEX','TAMBAH KWITANSI KT170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1375,'tbl_notajual','2017-03-23','20:54:54','ALEX','TAMBAH NOTA JUAL NJ1170323-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1376,'tbl_kwitansi','2017-03-23','20:55:57','ALEX','TAMBAH KWITANSI KPL170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1377,'tbl_cekfisik','2017-03-23','20:56:16','ALEX','TAMBAH CEK FISIK NJ1170323-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1378,'tbl_notajual','2017-03-23','20:57:43','ALEX','UPDATE SETUJUI NJ1170323-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1379,'tbl_pengeluaranunit','2017-03-23','20:58:03','ALEX','TAMBAH PENGELUARAN UNIT NJ1170323-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1380,'tbl_pengeluaranunit','2017-03-23','20:58:10','ALEX','UBAH PENGIRIMAN UNIT UNIT 2 NJ1170323-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1381,'','2017-03-23','21:10:14','ALEX','HAPUS DATABASE 1 ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1382,'tbl_notabeli','2017-03-23','21:16:12','ALEX','TAMBAH NOTA BELI NB1170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1383,'tbl_notabeli','2017-03-23','21:17:02','ALEX','TAMBAH NOTA BELI NB1170323-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1384,'tbl_stokunit','2017-03-23','21:17:20','ALEX','TAMBAH STOK NB1170323-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1385,'tbl_stokunit','2017-03-23','21:17:59','ALEX','TAMBAH STOK NB1170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1386,'tbl_notabeli','2017-03-23','21:18:29','ALEX','BAYAR NOTA BELI NB1170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1387,'tbl_notabeli','2017-03-23','21:18:44','ALEX','BAYAR NOTA BELI NB1170323-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1388,'tbl_pesanan','2017-03-23','21:19:14','ALEX','TAMBAH PESANAN NP170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1389,'tbl_kwitansi','2017-03-23','21:19:40','ALEX','TAMBAH KWITANSI KUM170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1390,'tbl_notajual','2017-03-23','21:20:10','ALEX','TAMBAH NOTA JUAL NJ1170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1391,'tbl_pesanan','2017-03-23','21:22:09','ALEX','TAMBAH PESANAN NP170323-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1392,'tbl_kwitansi','2017-03-23','21:23:41','ALEX','TAMBAH KWITANSI KUM170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1393,'tbl_notajual','2017-03-23','21:24:11','ALEX','TAMBAH NOTA JUAL NJ1170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1394,'tbl_cekfisik','2017-03-23','21:24:30','ALEX','TAMBAH CEK FISIK NJ1170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1395,'tbl_notajual','2017-03-23','21:25:12','ALEX','UPDATE SETUJUI NJ1170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1396,'tbl_pengeluaranunit','2017-03-23','21:25:33','ALEX','TAMBAH PENGELUARAN UNIT NJ1170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1397,'tbl_pengeluaranunit','2017-03-23','21:25:40','ALEX','UBAH PENGIRIMAN UNIT UNIT 1 NJ1170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1398,'tbl_pesanan','2017-03-23','21:26:07','ALEX','TAMBAH PESANAN NP170323-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1399,'tbl_kwitansi','2017-03-23','21:26:26','ALEX','TAMBAH KWITANSI KT170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1400,'tbl_notajual','2017-03-23','21:26:59','ALEX','TAMBAH NOTA JUAL NJ1170323-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1401,'tbl_kwitansi','2017-03-23','21:27:36','ALEX','TAMBAH KWITANSI KPL170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1402,'tbl_cekfisik','2017-03-23','21:27:59','ALEX','TAMBAH CEK FISIK NJ1170323-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1403,'tbl_notajual','2017-03-23','21:28:21','ALEX','UPDATE SETUJUI NJ1170323-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1404,'tbl_pengeluaranunit','2017-03-23','21:28:36','ALEX','TAMBAH PENGELUARAN UNIT NJ1170323-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1405,'tbl_pengeluaranunit','2017-03-23','21:28:42','ALEX','UBAH PENGIRIMAN UNIT UNIT 2 NJ1170323-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1406,'tbl_pesanan','2017-03-23','21:29:29','ALEX','TAMBAH PESANAN NP170323-004');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1407,'tbl_kwitansi','2017-03-23','21:29:50','ALEX','TAMBAH KWITANSI KT170323-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1408,'tbl_pesanan','2017-03-23','21:30:43','ALEX','TAMBAH PESANAN NP170323-005');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1409,'tbl_notajual','2017-03-23','21:30:48','ALEX','TAMBAH NOTA JUAL NJ1170323-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1410,'tbl_kwitansi','2017-03-23','21:31:05','ALEX','TAMBAH KWITANSI KUM170323-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1411,'tbl_cekfisik','2017-03-23','21:31:07','ALEX','TAMBAH CEK FISIK NJ1170323-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1412,'tbl_notajual','2017-03-23','21:31:31','ALEX','UPDATE SETUJUI NJ1170323-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1413,'tbl_notajual','2017-03-23','21:31:33','ALEX','TAMBAH NOTA JUAL NJ1170323-004');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1414,'tbl_pengeluaranunit','2017-03-23','21:31:51','ALEX','TAMBAH PENGELUARAN UNIT NJ1170323-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1415,'tbl_cekfisik','2017-03-23','21:31:52','ALEX','TAMBAH CEK FISIK NJ1170323-004');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1416,'tbl_pengeluaranunit','2017-03-23','21:31:57','ALEX','UBAH PENGIRIMAN UNIT UNIT 3 NJ1170323-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1417,'tbl_notajual','2017-03-23','21:32:16','ALEX','UPDATE SETUJUI NJ1170323-004');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1418,'tbl_pengeluaranunit','2017-03-23','21:32:44','ALEX','TAMBAH PENGELUARAN UNIT NJ1170323-004');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1419,'tbl_pengeluaranunit','2017-03-23','21:32:48','ALEX','UBAH PENGIRIMAN UNIT UNIT 5 NJ1170323-004');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1420,'tbl_notajual_det','2017-03-23','21:33:19','ALEX','KIRIM TAGIHAN LEASING NJ1170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1421,'tbl_notajual_det','2017-03-23','21:33:23','ALEX','KIRIM TAGIHAN LEASING NJ1170323-004');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1422,'tbl_notajual_det','2017-03-23','21:33:27','ALEX','BAYAR OTR 27.000.000 NJ1170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1423,'tbl_notajual_det','2017-03-23','21:33:31','ALEX','BAYAR OTR 25.000.000 NJ1170323-004');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1424,'tbl_notajual_det','2017-03-23','21:33:36','ALEX','BAYAR GROSS 400.000 NJ1170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1425,'tbl_notajual_det','2017-03-23','21:33:40','ALEX','BAYAR SUBSIDI 349.300 NJ1170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1426,'tbl_notajual_det','2017-03-23','21:33:45','ALEX','BAYAR MATRIX 367.273 NJ1170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1427,'tbl_notajual_det','2017-03-23','21:33:50','ALEX','BAYAR MATRIX 2 NJ1170323-004');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1428,'tbl_kwitansi','2017-03-23','21:51:02','ALEX','TAMBAH KWITANSI KCT170323-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1429,'tbl_notabeli','2017-03-10','15:17:14','ALEX','TAMBAH NOTA BELI NB1170310-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1430,'tbl_notabeli','2017-03-10','15:18:41','ALEX','TAMBAH NOTA BELI NB1170310-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1431,'tbl_notabeli','2017-03-10','15:23:10','ALEX','TAMBAH NOTA BELI NB1170310-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1432,'tbl_pesanan','2017-03-10','21:14:49','SALES','TAMBAH PESANAN NP170310-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1433,'tbl_kwitansi','2017-03-10','21:15:22','KASIR','TAMBAH KWITANSI KT170310-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1434,'tbl_notajual','2017-03-10','21:17:19','SALES','TAMBAH NOTA JUAL NJ1170310-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1435,'tbl_kwitansi','2017-03-10','21:18:19','KASIR','TAMBAH KWITANSI KPL170310-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1436,'tbl_cekfisik','2017-03-10','21:19:12','GUDANGPDI','TAMBAH CEK FISIK NJ1170310-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1437,'tbl_notajual','2017-03-10','21:19:55','KASIR','UPDATE SETUJUI NJ1170310-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1438,'tbl_pengeluaranunit','2017-03-10','21:20:39','ADMINISTRASI','TAMBAH PENGELUARAN UNIT NJ1170310-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1439,'tbl_pengeluaranunit','2017-03-10','21:22:22','ADMINISTRASI','UBAH PENGIRIMAN UNIT UNIT Q NJ1170310-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1440,'tbl_pesanan','2017-04-10','21:59:50','SALES','TAMBAH PESANAN NP170410-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1441,'tbl_kwitansi','2017-04-10','22:00:23','KASIR','TAMBAH KWITANSI KT170410-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1442,'tbl_kwitansi','2017-04-10','22:01:13','KASIR','TAMBAH KWITANSI KT170410-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1443,'tbl_notajual','2017-04-10','22:04:14','SALES','TAMBAH NOTA JUAL NJ1170410-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1444,'tbl_kwitansi','2017-04-10','22:05:40','KASIR','TAMBAH KWITANSI KPL170410-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1445,'tbl_cekfisik','2017-04-10','22:06:14','GUDANGPDI','TAMBAH CEK FISIK NJ1170410-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1446,'tbl_notajual','2017-04-10','22:06:36','KASIR','UPDATE SETUJUI NJ1170410-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1447,'tbl_pengeluaranunit','2017-04-10','22:06:59','ADMINISTRASI','TAMBAH PENGELUARAN UNIT NJ1170410-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1448,'tbl_pengeluaranunit','2017-04-10','22:09:21','ADMINISTRASI','UBAH PENGIRIMAN UNIT UNIT 4 NJ1170410-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1449,'tbl_pesanan','2017-04-10','22:13:11','SALES','TAMBAH PESANAN NP170410-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1450,'tbl_kwitansi','2017-04-10','22:14:17','KASIR','TAMBAH KWITANSI KT170410-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1451,'tbl_kwitansi','2017-04-10','22:15:25','KASIR','TAMBAH KWITANSI KT170410-004');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1452,'tbl_notajual','2017-04-10','22:16:44','ALEX','TAMBAH NOTA JUAL NJ1170410-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1453,'tbl_kwitansi','2017-04-10','22:17:51','ALEX','TAMBAH KWITANSI KPL170410-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1454,'tbl_cekfisik','2017-04-10','22:18:10','ALEX','TAMBAH CEK FISIK NJ1170410-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1455,'tbl_notajual','2017-04-10','22:18:28','ALEX','UPDATE SETUJUI NJ1170410-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1456,'tbl_pengeluaranunit','2017-04-10','22:18:42','ALEX','TAMBAH PENGELUARAN UNIT NJ1170410-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1457,'tbl_pengeluaranunit','2017-04-10','22:19:30','ADMINISTRASI','UBAH PENGIRIMAN UNIT UNIT 6 NJ1170410-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1458,'tbl_pengeluaranunit','2017-04-10','22:19:46','ALEX','UBAH PENGIRIMAN UNIT UNIT 6 NJ1170410-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1459,'tbl_pesanan','2017-04-10','22:20:58','SALES','TAMBAH PESANAN NP170410-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1460,'x23_notaservice','2017-03-13','19:57:37','ALEX','UPDATE NOTA SERVIS NS170313-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1461,'x23_notaservice','2017-03-13','19:59:08','ALEX','UPDATE NOTA SERVIS NS170313-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1462,'x23_notaservice','2017-03-13','19:59:29','ALEX','UPDATE NOTA SERVIS NS170313-003');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1463,'x23_kwitansi','2017-03-13','19:59:35','ALEX','TAMBAH KWITANSI KS170313-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1464,'tbl_pesanan','2017-03-15','20:23:15','ALEX','TAMBAH PESANAN NP170315-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1465,'tbl_notajual','2017-03-15','20:24:31','ALEX','TAMBAH NOTA JUAL NJ1170315-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1466,'tbl_kwitansi','2017-03-15','20:24:59','ALEX','TAMBAH KWITANSI KPL170315-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1467,'tbl_cekfisik','2017-03-15','20:25:19','ALEX','TAMBAH CEK FISIK NJ1170315-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1468,'tbl_notajual','2017-03-15','20:25:38','ALEX','UPDATE SETUJUI NJ1170315-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1469,'tbl_pengeluaranunit','2017-03-15','20:26:18','ALEX','TAMBAH PENGELUARAN UNIT NJ1170315-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1470,'tbl_pengeluaranunit','2017-03-15','20:26:43','ALEX','UBAH PENGIRIMAN UNIT UNIT 9 NJ1170315-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1471,'tbl_pelanggan','2017-03-15','20:39:48','ALEX','UBAH PELANGGAN AGUNG HERCULES');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1472,'x23_notaservice','2017-03-15','20:43:16','ALEX','UPDATE NOTA SERVIS NS170315-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1473,'x23_notaservice','2017-03-15','20:45:49','ALEX','UPDATE NOTA SERVIS NS170315-002');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1474,'','2017-05-08','09:19:11','ALEX','HAPUS DATABASE 1 ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1475,'','2017-05-08','09:19:22','ALEX','HAPUS DATABASE 3 ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1476,'','2017-05-08','09:19:27','ALEX','HAPUS DATABASE 4 ');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1477,'tbl_notabeli','2017-05-08','11:41:09','ALEX','TAMBAH NOTA BELI NB1170508-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1478,'tbl_stokunit','2017-05-08','12:29:18','ALEX','TAMBAH STOK NB1170508-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1479,'tbl_notabeli','2017-05-08','13:56:28','ALEX','BAYAR NOTA BELI NB1170508-001');
insert  into `log_act`(`id`,`tbl`,`tgl`,`jam`,`user`,`act`) values (1480,'tbl_pesanan','2017-05-08','15:47:29','ALEX','TAMBAH PESANAN NP170508-001');

/*Table structure for table `log_error` */

DROP TABLE IF EXISTS `log_error`;

CREATE TABLE `log_error` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `error` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `log_error` */

/*Table structure for table `login` */

DROP TABLE IF EXISTS `login`;

CREATE TABLE `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(200) NOT NULL,
  `jabatan` varchar(200) NOT NULL,
  `session` int(11) NOT NULL,
  `user` varchar(200) DEFAULT NULL,
  `pass` varchar(200) DEFAULT NULL,
  `lvl` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `login` */

insert  into `login`(`id`,`nama`,`jabatan`,`session`,`user`,`pass`,`lvl`) values (1,'Administrator','Administrator',1,'administrator','21232f297a57a5a743894a0e4a801fc3','staf');
insert  into `login`(`id`,`nama`,`jabatan`,`session`,`user`,`pass`,`lvl`) values (2,'Pimpinan','Pimpinan',1,'pimpinan','21232f297a57a5a743894a0e4a801fc3','pimpinan');

/*Table structure for table `outbox` */

DROP TABLE IF EXISTS `outbox`;

CREATE TABLE `outbox` (
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `InsertIntoDB` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `SendingDateTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Text` text,
  `DestinationNumber` varchar(20) NOT NULL DEFAULT '',
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text,
  `Class` int(11) DEFAULT '-1',
  `TextDecoded` varchar(160) NOT NULL DEFAULT '',
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `MultiPart` enum('false','true') DEFAULT 'false',
  `RelativeValidity` int(11) DEFAULT '-1',
  `SenderID` varchar(255) DEFAULT NULL,
  `SendingTimeOut` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `DeliveryReport` enum('default','yes','no') DEFAULT 'default',
  `CreatorID` text NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `outbox_date` (`SendingDateTime`,`SendingTimeOut`),
  KEY `outbox_sender` (`SenderID`)
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;

/*Data for the table `outbox` */

insert  into `outbox`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`Class`,`TextDecoded`,`ID`,`MultiPart`,`RelativeValidity`,`SenderID`,`SendingTimeOut`,`DeliveryReport`,`CreatorID`) values ('2017-03-10 20:48:22','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'085768933371','Default_No_Compression',NULL,-1,'10-03-2017 20:48:22 ALEX 192.168.43.118 ALEX-RG',20,'false',-1,NULL,'0000-00-00 00:00:00','default','sigerit.com');
insert  into `outbox`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`Class`,`TextDecoded`,`ID`,`MultiPart`,`RelativeValidity`,`SenderID`,`SendingTimeOut`,`DeliveryReport`,`CreatorID`) values ('2017-03-10 20:49:44','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'085768933371','Default_No_Compression',NULL,-1,'10-03-2017 20:49:44 ALEX 192.168.43.118 ALEX-RG',21,'false',-1,NULL,'0000-00-00 00:00:00','default','sigerit.com');
insert  into `outbox`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`Class`,`TextDecoded`,`ID`,`MultiPart`,`RelativeValidity`,`SenderID`,`SendingTimeOut`,`DeliveryReport`,`CreatorID`) values ('2017-03-10 21:03:59','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'085768933371','Default_No_Compression',NULL,-1,'10-03-2017 21:03:59 SALES 192.168.43.118 ALEX-RG',22,'false',-1,NULL,'0000-00-00 00:00:00','default','sigerit.com');
insert  into `outbox`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`Class`,`TextDecoded`,`ID`,`MultiPart`,`RelativeValidity`,`SenderID`,`SendingTimeOut`,`DeliveryReport`,`CreatorID`) values ('2017-03-10 21:05:39','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'085768933371','Default_No_Compression',NULL,-1,'10-03-2017 21:05:39 ALEX 192.168.43.118 ALEX-RG',23,'false',-1,NULL,'0000-00-00 00:00:00','default','sigerit.com');
insert  into `outbox`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`Class`,`TextDecoded`,`ID`,`MultiPart`,`RelativeValidity`,`SenderID`,`SendingTimeOut`,`DeliveryReport`,`CreatorID`) values ('2017-03-10 21:13:26','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'085768933371','Default_No_Compression',NULL,-1,'10-03-2017 21:13:26 SALES 192.168.43.118 ALEX-RG',24,'false',-1,NULL,'0000-00-00 00:00:00','default','sigerit.com');
insert  into `outbox`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`Class`,`TextDecoded`,`ID`,`MultiPart`,`RelativeValidity`,`SenderID`,`SendingTimeOut`,`DeliveryReport`,`CreatorID`) values ('2017-03-10 21:15:07','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'085768933371','Default_No_Compression',NULL,-1,'10-03-2017 21:15:07 KASIR 192.168.43.118 ALEX-RG',25,'false',-1,NULL,'0000-00-00 00:00:00','default','sigerit.com');
insert  into `outbox`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`Class`,`TextDecoded`,`ID`,`MultiPart`,`RelativeValidity`,`SenderID`,`SendingTimeOut`,`DeliveryReport`,`CreatorID`) values ('2017-03-10 21:15:46','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'085768933371','Default_No_Compression',NULL,-1,'10-03-2017 21:15:46 SALES 192.168.43.118 ALEX-RG',26,'false',-1,NULL,'0000-00-00 00:00:00','default','sigerit.com');
insert  into `outbox`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`Class`,`TextDecoded`,`ID`,`MultiPart`,`RelativeValidity`,`SenderID`,`SendingTimeOut`,`DeliveryReport`,`CreatorID`) values ('2017-03-10 21:17:45','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'085768933371','Default_No_Compression',NULL,-1,'10-03-2017 21:17:45 KASIR 192.168.43.118 ALEX-RG',27,'false',-1,NULL,'0000-00-00 00:00:00','default','sigerit.com');
insert  into `outbox`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`Class`,`TextDecoded`,`ID`,`MultiPart`,`RelativeValidity`,`SenderID`,`SendingTimeOut`,`DeliveryReport`,`CreatorID`) values ('2017-03-10 21:18:31','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'085768933371','Default_No_Compression',NULL,-1,'10-03-2017 21:18:31 GUDANGPDI 192.168.43.118 ALEX-RG',28,'false',-1,NULL,'0000-00-00 00:00:00','default','sigerit.com');
insert  into `outbox`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`Class`,`TextDecoded`,`ID`,`MultiPart`,`RelativeValidity`,`SenderID`,`SendingTimeOut`,`DeliveryReport`,`CreatorID`) values ('2017-03-10 21:19:37','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'085768933371','Default_No_Compression',NULL,-1,'10-03-2017 21:19:37 KASIR 192.168.43.118 ALEX-RG',29,'false',-1,NULL,'0000-00-00 00:00:00','default','sigerit.com');
insert  into `outbox`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`Class`,`TextDecoded`,`ID`,`MultiPart`,`RelativeValidity`,`SenderID`,`SendingTimeOut`,`DeliveryReport`,`CreatorID`) values ('2017-03-10 21:20:09','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'085768933371','Default_No_Compression',NULL,-1,'10-03-2017 21:20:09 ALEX 127.0.0.1 AZIGHA',30,'false',-1,NULL,'0000-00-00 00:00:00','default','sigerit.com');
insert  into `outbox`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`Class`,`TextDecoded`,`ID`,`MultiPart`,`RelativeValidity`,`SenderID`,`SendingTimeOut`,`DeliveryReport`,`CreatorID`) values ('2017-03-10 21:20:10','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'085768933371','Default_No_Compression',NULL,-1,'10-03-2017 21:20:10 ADMINISTRASI 192.168.43.118 ALEX-RG',31,'false',-1,NULL,'0000-00-00 00:00:00','default','sigerit.com');
insert  into `outbox`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`Class`,`TextDecoded`,`ID`,`MultiPart`,`RelativeValidity`,`SenderID`,`SendingTimeOut`,`DeliveryReport`,`CreatorID`) values ('2017-03-10 21:20:57','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'085768933371','Default_No_Compression',NULL,-1,'10-03-2017 21:20:57 ALEX 192.168.43.118 ALEX-RG',32,'false',-1,NULL,'0000-00-00 00:00:00','default','sigerit.com');
insert  into `outbox`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`Class`,`TextDecoded`,`ID`,`MultiPart`,`RelativeValidity`,`SenderID`,`SendingTimeOut`,`DeliveryReport`,`CreatorID`) values ('2017-03-10 21:49:10','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'085768933371','Default_No_Compression',NULL,-1,'10-03-2017 21:49:10 SALES 192.168.43.118 ALEX-RG',33,'false',-1,NULL,'0000-00-00 00:00:00','default','sigerit.com');
insert  into `outbox`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`Class`,`TextDecoded`,`ID`,`MultiPart`,`RelativeValidity`,`SenderID`,`SendingTimeOut`,`DeliveryReport`,`CreatorID`) values ('2017-04-10 22:00:09','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'085768933371','Default_No_Compression',NULL,-1,'10-04-2017 22:00:09 KASIR 192.168.43.118 ALEX-RG',34,'false',-1,NULL,'0000-00-00 00:00:00','default','sigerit.com');
insert  into `outbox`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`Class`,`TextDecoded`,`ID`,`MultiPart`,`RelativeValidity`,`SenderID`,`SendingTimeOut`,`DeliveryReport`,`CreatorID`) values ('2017-04-10 22:00:33','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'085768933371','Default_No_Compression',NULL,-1,'10-04-2017 22:00:33 SALES 192.168.43.118 ALEX-RG',35,'false',-1,NULL,'0000-00-00 00:00:00','default','sigerit.com');
insert  into `outbox`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`Class`,`TextDecoded`,`ID`,`MultiPart`,`RelativeValidity`,`SenderID`,`SendingTimeOut`,`DeliveryReport`,`CreatorID`) values ('2017-04-10 22:01:00','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'085768933371','Default_No_Compression',NULL,-1,'10-04-2017 22:01:00 KASIR 192.168.43.118 ALEX-RG',36,'false',-1,NULL,'0000-00-00 00:00:00','default','sigerit.com');
insert  into `outbox`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`Class`,`TextDecoded`,`ID`,`MultiPart`,`RelativeValidity`,`SenderID`,`SendingTimeOut`,`DeliveryReport`,`CreatorID`) values ('2017-04-10 22:01:22','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'085768933371','Default_No_Compression',NULL,-1,'10-04-2017 22:01:22 SALES 192.168.43.118 ALEX-RG',37,'false',-1,NULL,'0000-00-00 00:00:00','default','sigerit.com');
insert  into `outbox`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`Class`,`TextDecoded`,`ID`,`MultiPart`,`RelativeValidity`,`SenderID`,`SendingTimeOut`,`DeliveryReport`,`CreatorID`) values ('2017-04-10 22:03:30','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'085768933371','Default_No_Compression',NULL,-1,'10-04-2017 22:03:30 SALES 192.168.43.118 ALEX-RG',38,'false',-1,NULL,'0000-00-00 00:00:00','default','sigerit.com');
insert  into `outbox`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`Class`,`TextDecoded`,`ID`,`MultiPart`,`RelativeValidity`,`SenderID`,`SendingTimeOut`,`DeliveryReport`,`CreatorID`) values ('2017-04-10 22:04:32','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'085768933371','Default_No_Compression',NULL,-1,'10-04-2017 22:04:32 KASIR 192.168.43.118 ALEX-RG',39,'false',-1,NULL,'0000-00-00 00:00:00','default','sigerit.com');
insert  into `outbox`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`Class`,`TextDecoded`,`ID`,`MultiPart`,`RelativeValidity`,`SenderID`,`SendingTimeOut`,`DeliveryReport`,`CreatorID`) values ('2017-04-10 22:05:59','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'085768933371','Default_No_Compression',NULL,-1,'10-04-2017 22:05:59 GUDANGPDI 192.168.43.118 ALEX-RG',40,'false',-1,NULL,'0000-00-00 00:00:00','default','sigerit.com');
insert  into `outbox`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`Class`,`TextDecoded`,`ID`,`MultiPart`,`RelativeValidity`,`SenderID`,`SendingTimeOut`,`DeliveryReport`,`CreatorID`) values ('2017-04-10 22:06:24','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'085768933371','Default_No_Compression',NULL,-1,'10-04-2017 22:06:24 KASIR 192.168.43.118 ALEX-RG',41,'false',-1,NULL,'0000-00-00 00:00:00','default','sigerit.com');
insert  into `outbox`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`Class`,`TextDecoded`,`ID`,`MultiPart`,`RelativeValidity`,`SenderID`,`SendingTimeOut`,`DeliveryReport`,`CreatorID`) values ('2017-04-10 22:06:47','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'085768933371','Default_No_Compression',NULL,-1,'10-04-2017 22:06:47 ADMINISTRASI 192.168.43.118 ALEX-RG',42,'false',-1,NULL,'0000-00-00 00:00:00','default','sigerit.com');
insert  into `outbox`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`Class`,`TextDecoded`,`ID`,`MultiPart`,`RelativeValidity`,`SenderID`,`SendingTimeOut`,`DeliveryReport`,`CreatorID`) values ('2017-04-10 22:10:00','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'085768933371','Default_No_Compression',NULL,-1,'10-04-2017 22:10:00 SALES 192.168.43.118 ALEX-RG',43,'false',-1,NULL,'0000-00-00 00:00:00','default','sigerit.com');
insert  into `outbox`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`Class`,`TextDecoded`,`ID`,`MultiPart`,`RelativeValidity`,`SenderID`,`SendingTimeOut`,`DeliveryReport`,`CreatorID`) values ('2017-04-10 22:13:49','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'085768933371','Default_No_Compression',NULL,-1,'10-04-2017 22:13:49 KASIR 192.168.43.118 ALEX-RG',44,'false',-1,NULL,'0000-00-00 00:00:00','default','sigerit.com');
insert  into `outbox`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`Class`,`TextDecoded`,`ID`,`MultiPart`,`RelativeValidity`,`SenderID`,`SendingTimeOut`,`DeliveryReport`,`CreatorID`) values ('2017-04-10 22:14:58','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'085768933371','Default_No_Compression',NULL,-1,'10-04-2017 22:14:58 SALES 192.168.43.118 ALEX-RG',45,'false',-1,NULL,'0000-00-00 00:00:00','default','sigerit.com');
insert  into `outbox`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`Class`,`TextDecoded`,`ID`,`MultiPart`,`RelativeValidity`,`SenderID`,`SendingTimeOut`,`DeliveryReport`,`CreatorID`) values ('2017-04-10 22:15:12','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'085768933371','Default_No_Compression',NULL,-1,'10-04-2017 22:15:12 KASIR 192.168.43.118 ALEX-RG',46,'false',-1,NULL,'0000-00-00 00:00:00','default','sigerit.com');
insert  into `outbox`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`Class`,`TextDecoded`,`ID`,`MultiPart`,`RelativeValidity`,`SenderID`,`SendingTimeOut`,`DeliveryReport`,`CreatorID`) values ('2017-04-10 22:16:20','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'085768933371','Default_No_Compression',NULL,-1,'10-04-2017 22:16:20 ALEX 192.168.43.118 ALEX-RG',47,'false',-1,NULL,'0000-00-00 00:00:00','default','sigerit.com');
insert  into `outbox`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`Class`,`TextDecoded`,`ID`,`MultiPart`,`RelativeValidity`,`SenderID`,`SendingTimeOut`,`DeliveryReport`,`CreatorID`) values ('2017-04-10 22:19:20','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'085768933371','Default_No_Compression',NULL,-1,'10-04-2017 22:19:20 ADMINISTRASI 192.168.43.118 ALEX-RG',48,'false',-1,NULL,'0000-00-00 00:00:00','default','sigerit.com');
insert  into `outbox`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`Class`,`TextDecoded`,`ID`,`MultiPart`,`RelativeValidity`,`SenderID`,`SendingTimeOut`,`DeliveryReport`,`CreatorID`) values ('2017-04-10 22:20:38','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'085768933371','Default_No_Compression',NULL,-1,'10-04-2017 22:20:38 SALES 192.168.43.118 ALEX-RG',49,'false',-1,NULL,'0000-00-00 00:00:00','default','sigerit.com');
insert  into `outbox`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`Class`,`TextDecoded`,`ID`,`MultiPart`,`RelativeValidity`,`SenderID`,`SendingTimeOut`,`DeliveryReport`,`CreatorID`) values ('2017-03-13 19:09:01','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'085768933371','Default_No_Compression',NULL,-1,'13-03-2017 19:09:01 ALEX 127.0.0.1 AZIGHA',50,'false',-1,NULL,'0000-00-00 00:00:00','default','sigerit.com');
insert  into `outbox`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`Class`,`TextDecoded`,`ID`,`MultiPart`,`RelativeValidity`,`SenderID`,`SendingTimeOut`,`DeliveryReport`,`CreatorID`) values ('2017-03-13 19:35:20','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'085768933371','Default_No_Compression',NULL,-1,'13-03-2017 19:35:20 ALEX 192.168.43.118 ALEX-RG',51,'false',-1,NULL,'0000-00-00 00:00:00','default','sigerit.com');
insert  into `outbox`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`Class`,`TextDecoded`,`ID`,`MultiPart`,`RelativeValidity`,`SenderID`,`SendingTimeOut`,`DeliveryReport`,`CreatorID`) values ('2017-03-13 19:38:50','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'085768933371','Default_No_Compression',NULL,-1,'13-03-2017 19:38:50 ALEX 127.0.0.1 AZIGHA',52,'false',-1,NULL,'0000-00-00 00:00:00','default','sigerit.com');
insert  into `outbox`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`Class`,`TextDecoded`,`ID`,`MultiPart`,`RelativeValidity`,`SenderID`,`SendingTimeOut`,`DeliveryReport`,`CreatorID`) values ('2017-03-13 20:01:49','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'085768933371','Default_No_Compression',NULL,-1,'13-03-2017 20:01:49 ALEX 192.168.43.118 ALEX-RG',53,'false',-1,NULL,'0000-00-00 00:00:00','default','sigerit.com');
insert  into `outbox`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`Class`,`TextDecoded`,`ID`,`MultiPart`,`RelativeValidity`,`SenderID`,`SendingTimeOut`,`DeliveryReport`,`CreatorID`) values ('2017-03-14 11:02:34','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'085768933371','Default_No_Compression',NULL,-1,'14-03-2017 11:02:34 ALEX 127.0.0.1 ARIEF-LT',54,'false',-1,NULL,'0000-00-00 00:00:00','default','sigerit.com');
insert  into `outbox`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`Class`,`TextDecoded`,`ID`,`MultiPart`,`RelativeValidity`,`SenderID`,`SendingTimeOut`,`DeliveryReport`,`CreatorID`) values ('2017-03-14 14:36:05','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'085768933371','Default_No_Compression',NULL,-1,'14-03-2017 14:36:05 ALEX 127.0.0.1 ARIEF-LT',55,'false',-1,NULL,'0000-00-00 00:00:00','default','sigerit.com');
insert  into `outbox`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`Class`,`TextDecoded`,`ID`,`MultiPart`,`RelativeValidity`,`SenderID`,`SendingTimeOut`,`DeliveryReport`,`CreatorID`) values ('2017-03-15 17:56:36','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'085768933371','Default_No_Compression',NULL,-1,'15-03-2017 17:56:36 ALEX 127.0.0.1 ISAS',56,'false',-1,NULL,'0000-00-00 00:00:00','default','sigerit.com');
insert  into `outbox`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`Class`,`TextDecoded`,`ID`,`MultiPart`,`RelativeValidity`,`SenderID`,`SendingTimeOut`,`DeliveryReport`,`CreatorID`) values ('2017-03-15 18:32:38','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'085768933371','Default_No_Compression',NULL,-1,'15-03-2017 18:32:38 ADMINISTRATOR 127.0.0.1 ISAS',57,'false',-1,NULL,'0000-00-00 00:00:00','default','sigerit.com');
insert  into `outbox`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`Class`,`TextDecoded`,`ID`,`MultiPart`,`RelativeValidity`,`SenderID`,`SendingTimeOut`,`DeliveryReport`,`CreatorID`) values ('2017-03-15 20:20:23','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'085768933371','Default_No_Compression',NULL,-1,'15-03-2017 20:20:23 ALEX 192.168.43.118 ALEX-RG',58,'false',-1,NULL,'0000-00-00 00:00:00','default','sigerit.com');
insert  into `outbox`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`Class`,`TextDecoded`,`ID`,`MultiPart`,`RelativeValidity`,`SenderID`,`SendingTimeOut`,`DeliveryReport`,`CreatorID`) values ('2017-03-15 20:22:44','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'085768933371','Default_No_Compression',NULL,-1,'15-03-2017 20:22:44 ALEX 127.0.0.1 ISAS',59,'false',-1,NULL,'0000-00-00 00:00:00','default','sigerit.com');
insert  into `outbox`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`Class`,`TextDecoded`,`ID`,`MultiPart`,`RelativeValidity`,`SenderID`,`SendingTimeOut`,`DeliveryReport`,`CreatorID`) values ('2017-05-04 16:23:02','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'085768933371','Default_No_Compression',NULL,-1,'04-05-2017 16:23:02 ALEX 127.0.0.1 ARIEF-LT',60,'false',-1,NULL,'0000-00-00 00:00:00','default','sigerit.com');
insert  into `outbox`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`Class`,`TextDecoded`,`ID`,`MultiPart`,`RelativeValidity`,`SenderID`,`SendingTimeOut`,`DeliveryReport`,`CreatorID`) values ('2017-05-05 14:49:37','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'085768933371','Default_No_Compression',NULL,-1,'05-05-2017 14:49:37 ALEX 127.0.0.1 ARIEF-LT',61,'false',-1,NULL,'0000-00-00 00:00:00','default','sigerit.com');
insert  into `outbox`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`Class`,`TextDecoded`,`ID`,`MultiPart`,`RelativeValidity`,`SenderID`,`SendingTimeOut`,`DeliveryReport`,`CreatorID`) values ('2017-05-08 09:18:54','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'085768933371','Default_No_Compression',NULL,-1,'08-05-2017 09:18:54 ALEX 127.0.0.1 ARIEF-LT',62,'false',-1,NULL,'0000-00-00 00:00:00','default','sigerit.com');
insert  into `outbox`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`Class`,`TextDecoded`,`ID`,`MultiPart`,`RelativeValidity`,`SenderID`,`SendingTimeOut`,`DeliveryReport`,`CreatorID`) values ('2017-05-08 10:31:22','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'085768933371','Default_No_Compression',NULL,-1,'08-05-2017 10:31:22 ALEX 127.0.0.1 ARIEF-LT',63,'false',-1,NULL,'0000-00-00 00:00:00','default','sigerit.com');

/*Table structure for table `outbox_multipart` */

DROP TABLE IF EXISTS `outbox_multipart`;

CREATE TABLE `outbox_multipart` (
  `Text` text,
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text,
  `Class` int(11) DEFAULT '-1',
  `TextDecoded` varchar(160) DEFAULT NULL,
  `ID` int(10) unsigned NOT NULL DEFAULT '0',
  `SequencePosition` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`,`SequencePosition`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `outbox_multipart` */

/*Table structure for table `pbk` */

DROP TABLE IF EXISTS `pbk`;

CREATE TABLE `pbk` (
  `GroupID` int(11) NOT NULL DEFAULT '-1',
  `Name` text NOT NULL,
  `Number` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `pbk` */

/*Table structure for table `pbk_groups` */

DROP TABLE IF EXISTS `pbk_groups`;

CREATE TABLE `pbk_groups` (
  `Name` text NOT NULL,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `pbk_groups` */

/*Table structure for table `phones` */

DROP TABLE IF EXISTS `phones`;

CREATE TABLE `phones` (
  `ID` text NOT NULL,
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `InsertIntoDB` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `TimeOut` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Send` enum('yes','no') NOT NULL DEFAULT 'no',
  `Receive` enum('yes','no') NOT NULL DEFAULT 'no',
  `IMEI` varchar(35) NOT NULL,
  `Client` text NOT NULL,
  `Battery` int(11) NOT NULL DEFAULT '0',
  `Signal` int(11) NOT NULL DEFAULT '0',
  `Sent` int(11) NOT NULL DEFAULT '0',
  `Received` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`IMEI`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `phones` */

insert  into `phones`(`ID`,`UpdatedInDB`,`InsertIntoDB`,`TimeOut`,`Send`,`Receive`,`IMEI`,`Client`,`Battery`,`Signal`,`Sent`,`Received`) values ('MyPhone1','2017-03-10 15:27:25','2017-03-10 15:09:47','2017-03-10 15:27:35','yes','yes','354056300808040','Gammu 1.25.0, Windows Server 2007, GCC 4.3, MinGW 3.15',0,0,4,0);

/*Table structure for table `sentitems` */

DROP TABLE IF EXISTS `sentitems`;

CREATE TABLE `sentitems` (
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `InsertIntoDB` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `SendingDateTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `DeliveryDateTime` timestamp NULL DEFAULT NULL,
  `Text` text NOT NULL,
  `DestinationNumber` varchar(20) NOT NULL DEFAULT '',
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text NOT NULL,
  `SMSCNumber` varchar(20) NOT NULL DEFAULT '',
  `Class` int(11) NOT NULL DEFAULT '-1',
  `TextDecoded` varchar(160) NOT NULL DEFAULT '',
  `ID` int(10) unsigned NOT NULL DEFAULT '0',
  `SenderID` varchar(255) NOT NULL,
  `SequencePosition` int(11) NOT NULL DEFAULT '1',
  `Status` enum('SendingOK','SendingOKNoReport','SendingError','DeliveryOK','DeliveryFailed','DeliveryPending','DeliveryUnknown','Error') NOT NULL DEFAULT 'SendingOK',
  `StatusError` int(11) NOT NULL DEFAULT '-1',
  `TPMR` int(11) NOT NULL DEFAULT '-1',
  `RelativeValidity` int(11) NOT NULL DEFAULT '-1',
  `CreatorID` text NOT NULL,
  PRIMARY KEY (`ID`,`SequencePosition`),
  KEY `sentitems_date` (`DeliveryDateTime`),
  KEY `sentitems_tpmr` (`TPMR`),
  KEY `sentitems_dest` (`DestinationNumber`),
  KEY `sentitems_sender` (`SenderID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `sentitems` */

insert  into `sentitems`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`DeliveryDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`SMSCNumber`,`Class`,`TextDecoded`,`ID`,`SenderID`,`SequencePosition`,`Status`,`StatusError`,`TPMR`,`RelativeValidity`,`CreatorID`) values ('2017-03-10 10:23:33','2017-03-10 10:23:12','2017-03-10 10:23:33',NULL,'00740065007300200075006A006900200063006F006200610020006B006F00740061006B00200073006100720061006E','085768933371','Default_No_Compression','','+6281100000',-1,'tes uji coba kotak saran',1,'MyPhone1',1,'SendingOKNoReport',-1,27,255,'Gammu 1.25.0');
insert  into `sentitems`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`DeliveryDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`SMSCNumber`,`Class`,`TextDecoded`,`ID`,`SenderID`,`SequencePosition`,`Status`,`StatusError`,`TPMR`,`RelativeValidity`,`CreatorID`) values ('2017-03-10 10:39:19','2017-03-10 10:38:46','2017-03-10 10:39:19',NULL,'0070006500720063006F006200610061006E002000700065006E0067006900720069006D0061006E00200073006D0073002000640061007200690020006B006F00740061006B00200073006100720061006E','085768933371','Default_No_Compression','','+6281100000',-1,'percobaan pengiriman sms dari kotak saran',2,'MyPhone1',1,'SendingOKNoReport',-1,28,255,'Gammu 1.25.0');
insert  into `sentitems`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`DeliveryDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`SMSCNumber`,`Class`,`TextDecoded`,`ID`,`SenderID`,`SequencePosition`,`Status`,`StatusError`,`TPMR`,`RelativeValidity`,`CreatorID`) values ('2017-03-10 10:51:26','2017-03-10 10:51:12','2017-03-10 10:51:26',NULL,'0070006500720063006F006200610061006E002000700065006E0067006900720069006D0061006E00200073006D0073002000640061007200690020006B006F00740061006B00200073006100720061006E','085768933371','Default_No_Compression','','+6281100000',-1,'percobaan pengiriman sms dari kotak saran',3,'MyPhone1',1,'SendingOKNoReport',-1,29,255,'Gammu 1.25.0');
insert  into `sentitems`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`DeliveryDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`SMSCNumber`,`Class`,`TextDecoded`,`ID`,`SenderID`,`SequencePosition`,`Status`,`StatusError`,`TPMR`,`RelativeValidity`,`CreatorID`) values ('2017-03-10 10:55:10','2017-03-10 10:54:56','2017-03-10 10:55:10',NULL,'0070006500720063006F0062006100610061006E0020007400650073007400650072','085768933371','Default_No_Compression','','+6281100000',-1,'percobaaan tester',4,'MyPhone1',1,'SendingOKNoReport',-1,30,255,'Gammu 1.25.0');
insert  into `sentitems`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`DeliveryDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`SMSCNumber`,`Class`,`TextDecoded`,`ID`,`SenderID`,`SequencePosition`,`Status`,`StatusError`,`TPMR`,`RelativeValidity`,`CreatorID`) values ('2017-03-10 10:58:12','2017-03-10 10:57:58','2017-03-10 10:58:12',NULL,'0070006500720063006F0062006100610061006E0020007400650073007400650072','085768933371','Default_No_Compression','','+6281100000',-1,'percobaaan tester',5,'MyPhone1',1,'SendingOKNoReport',-1,31,255,'Gammu 1.25.0');
insert  into `sentitems`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`DeliveryDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`SMSCNumber`,`Class`,`TextDecoded`,`ID`,`SenderID`,`SequencePosition`,`Status`,`StatusError`,`TPMR`,`RelativeValidity`,`CreatorID`) values ('2017-03-10 11:00:32','2017-03-10 11:00:00','2017-03-10 11:00:32',NULL,'00310030002D00300033002D0032003000310037002000310031003A00300030003A0030003000200041004C004500580020003100320037002E0030002E0030002E0031002000410052004900450046002D004C0054','085768933371','Default_No_Compression','','+6281100000',-1,'10-03-2017 11:00:00 ALEX 127.0.0.1 ARIEF-LT',6,'MyPhone1',1,'SendingOKNoReport',-1,32,255,'Gammu 1.25.0');
insert  into `sentitems`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`DeliveryDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`SMSCNumber`,`Class`,`TextDecoded`,`ID`,`SenderID`,`SequencePosition`,`Status`,`StatusError`,`TPMR`,`RelativeValidity`,`CreatorID`) values ('2017-03-10 11:02:31','2017-03-10 11:02:10','2017-03-10 11:02:31',NULL,'00310030002D00300033002D0032003000310037002000310031003A00300032003A0031003000200041004C004500580020003100320037002E0030002E0030002E0031002000410052004900450046002D004C0054','085768933371','Default_No_Compression','','+6281100000',-1,'10-03-2017 11:02:10 ALEX 127.0.0.1 ARIEF-LT',7,'MyPhone1',1,'SendingOKNoReport',-1,33,255,'Gammu 1.25.0');
insert  into `sentitems`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`DeliveryDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`SMSCNumber`,`Class`,`TextDecoded`,`ID`,`SenderID`,`SequencePosition`,`Status`,`StatusError`,`TPMR`,`RelativeValidity`,`CreatorID`) values ('2017-03-10 11:02:44','2017-03-10 11:02:26','2017-03-10 11:02:44',NULL,'00310030002D00300033002D0032003000310037002000310031003A00300032003A0032003600200041004C004500580020003100320037002E0030002E0030002E0031002000410052004900450046002D004C0054','085768933371','Default_No_Compression','','+6281100000',-1,'10-03-2017 11:02:26 ALEX 127.0.0.1 ARIEF-LT',8,'MyPhone1',1,'SendingOKNoReport',-1,34,255,'Gammu 1.25.0');
insert  into `sentitems`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`DeliveryDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`SMSCNumber`,`Class`,`TextDecoded`,`ID`,`SenderID`,`SequencePosition`,`Status`,`StatusError`,`TPMR`,`RelativeValidity`,`CreatorID`) values ('2017-03-10 11:03:40','2017-03-10 11:03:10','2017-03-10 11:03:40',NULL,'00310030002D00300033002D0032003000310037002000310031003A00300033003A0031003000200041004C004500580020003100320037002E0030002E0030002E0031002000410052004900450046002D004C0054','085768933371','Default_No_Compression','','+6281100000',-1,'10-03-2017 11:03:10 ALEX 127.0.0.1 ARIEF-LT',9,'MyPhone1',1,'SendingOKNoReport',-1,35,255,'Gammu 1.25.0');
insert  into `sentitems`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`DeliveryDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`SMSCNumber`,`Class`,`TextDecoded`,`ID`,`SenderID`,`SequencePosition`,`Status`,`StatusError`,`TPMR`,`RelativeValidity`,`CreatorID`) values ('2017-03-10 11:04:36','2017-03-10 11:04:20','2017-03-10 11:04:36',NULL,'00310030002D00300033002D0032003000310037002000310031003A00300034003A0031003900200041004C004500580020003100320037002E0030002E0030002E0031002000410052004900450046002D004C0054','085768933371','Default_No_Compression','','+6281100000',-1,'10-03-2017 11:04:19 ALEX 127.0.0.1 ARIEF-LT',10,'MyPhone1',1,'SendingOKNoReport',-1,36,255,'Gammu 1.25.0');
insert  into `sentitems`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`DeliveryDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`SMSCNumber`,`Class`,`TextDecoded`,`ID`,`SenderID`,`SequencePosition`,`Status`,`StatusError`,`TPMR`,`RelativeValidity`,`CreatorID`) values ('2017-03-10 11:05:53','2017-03-10 11:05:32','2017-03-10 11:05:53',NULL,'00310030002D00300033002D0032003000310037002000310031003A00300035003A0033003200200041004C004500580020003100320037002E0030002E0030002E0031002000410052004900450046002D004C0054','085768933371','Default_No_Compression','','+6281100000',-1,'10-03-2017 11:05:32 ALEX 127.0.0.1 ARIEF-LT',11,'MyPhone1',1,'SendingOKNoReport',-1,37,255,'Gammu 1.25.0');
insert  into `sentitems`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`DeliveryDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`SMSCNumber`,`Class`,`TextDecoded`,`ID`,`SenderID`,`SequencePosition`,`Status`,`StatusError`,`TPMR`,`RelativeValidity`,`CreatorID`) values ('2017-03-10 12:26:03','2017-03-10 11:14:59','2017-03-10 12:26:03',NULL,'00310030002D00300033002D0032003000310037002000310031003A00310034003A0035003900200041004C004500580020003100320037002E0030002E0030002E0031002000410052004900450046002D004C0054','085768933371','Default_No_Compression','','+6281100000',-1,'10-03-2017 11:14:59 ALEX 127.0.0.1 ARIEF-LT',12,'MyPhone1',1,'SendingOKNoReport',-1,38,255,'Gammu 1.25.0');
insert  into `sentitems`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`DeliveryDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`SMSCNumber`,`Class`,`TextDecoded`,`ID`,`SenderID`,`SequencePosition`,`Status`,`StatusError`,`TPMR`,`RelativeValidity`,`CreatorID`) values ('2017-03-10 13:57:12','2017-03-10 13:56:40','2017-03-10 13:57:12',NULL,'0074006500730020006C00610067006900200064006F006E0067','085768933371','Default_No_Compression','','+6281100000',-1,'tes lagi dong',14,'MyPhone1',1,'SendingOKNoReport',-1,39,255,'Gammu 1.25.0');
insert  into `sentitems`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`DeliveryDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`SMSCNumber`,`Class`,`TextDecoded`,`ID`,`SenderID`,`SequencePosition`,`Status`,`StatusError`,`TPMR`,`RelativeValidity`,`CreatorID`) values ('2017-03-10 14:54:58','2017-03-10 14:54:33','2017-03-10 14:54:58',NULL,'0061007700650072006100200061007700650072006100770065','085768933371','Default_No_Compression','','+6281100000',-1,'awera awerawe',15,'MyPhone1',1,'SendingOKNoReport',-1,40,255,'Gammu 1.25.0');
insert  into `sentitems`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`DeliveryDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`SMSCNumber`,`Class`,`TextDecoded`,`ID`,`SenderID`,`SequencePosition`,`Status`,`StatusError`,`TPMR`,`RelativeValidity`,`CreatorID`) values ('2017-03-10 15:12:48','2017-03-10 15:12:33','2017-03-10 15:12:48',NULL,'00310030002D00300033002D0032003000310037002000310035003A00310032003A0033003300200041004C004500580020003100320037002E0030002E0030002E0031002000410052004900450046002D004C0054','085768933371','Default_No_Compression','','+6281100000',-1,'10-03-2017 15:12:33 ALEX 127.0.0.1 ARIEF-LT',16,'MyPhone1',1,'SendingOKNoReport',-1,41,255,'Gammu 1.25.0');
insert  into `sentitems`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`DeliveryDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`SMSCNumber`,`Class`,`TextDecoded`,`ID`,`SenderID`,`SequencePosition`,`Status`,`StatusError`,`TPMR`,`RelativeValidity`,`CreatorID`) values ('2017-03-10 15:18:58','2017-03-10 15:18:41','2017-03-10 15:18:58',NULL,'004E00420031003100370030003300310030002D003000300032002C0032003000310037002C','085768933371','Default_No_Compression','','+6281100000',-1,'NB1170310-002,2017,',17,'MyPhone1',1,'SendingOKNoReport',-1,42,255,'Gammu 1.25.0');
insert  into `sentitems`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`DeliveryDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`SMSCNumber`,`Class`,`TextDecoded`,`ID`,`SenderID`,`SequencePosition`,`Status`,`StatusError`,`TPMR`,`RelativeValidity`,`CreatorID`) values ('2017-03-10 15:23:24','0000-00-00 00:00:00','2017-03-10 15:23:24',NULL,'004E00420031003100370030003300310030002D0030003000330020002500300061002000320030003100370020002500300061002000300033002C0032003000310037002D00300033002D00310030002C004100530044002C0032003000310037002D00300033002D00310030002C004600470048002C0032003000310037002D00300033002D00310030002C0031002C00310030003000300030003000300030002C0031003000300030003000300030','085768933371','Default_No_Compression','','+6281100000',-1,'NB1170310-003 %0a 2017 %0a 03,2017-03-10,ASD,2017-03-10,FGH,2017-03-10,1,10000000,1000000',18,'MyPhone1',1,'SendingOKNoReport',-1,43,255,'Gammu');
insert  into `sentitems`(`UpdatedInDB`,`InsertIntoDB`,`SendingDateTime`,`DeliveryDateTime`,`Text`,`DestinationNumber`,`Coding`,`UDH`,`SMSCNumber`,`Class`,`TextDecoded`,`ID`,`SenderID`,`SequencePosition`,`Status`,`StatusError`,`TPMR`,`RelativeValidity`,`CreatorID`) values ('2017-03-10 15:27:08','0000-00-00 00:00:00','2017-03-10 15:27:08',NULL,'00310030002D00300033002D0032003000310037002000310035003A00320036003A00350030002000410044004D0049004E004900530054005200410054004F00520020003100320037002E0030002E0030002E0031002000410052004900450046002D004C0054','085768933371','Default_No_Compression','','+6281100000',-1,'10-03-2017 15:26:50 ADMINISTRATOR 127.0.0.1 ARIEF-LT',19,'MyPhone1',1,'SendingOKNoReport',-1,44,255,'sigerit.com');

/*Table structure for table `stok_accu` */

DROP TABLE IF EXISTS `stok_accu`;

CREATE TABLE `stok_accu` (
  `nonota` varchar(20) NOT NULL,
  `accu` int(11) NOT NULL,
  `jual` int(11) NOT NULL,
  PRIMARY KEY (`nonota`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `stok_accu` */

insert  into `stok_accu`(`nonota`,`accu`,`jual`) values ('NB1170508-001',3,0);

/*Table structure for table `stok_alaskaki` */

DROP TABLE IF EXISTS `stok_alaskaki`;

CREATE TABLE `stok_alaskaki` (
  `nonota` varchar(20) NOT NULL,
  `alaskaki` int(11) NOT NULL,
  `jual` int(11) NOT NULL,
  PRIMARY KEY (`nonota`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `stok_alaskaki` */

insert  into `stok_alaskaki`(`nonota`,`alaskaki`,`jual`) values ('NB1170508-001',0,0);

/*Table structure for table `stok_anakkunci` */

DROP TABLE IF EXISTS `stok_anakkunci`;

CREATE TABLE `stok_anakkunci` (
  `nonota` varchar(20) NOT NULL,
  `anakkunci` int(11) NOT NULL,
  `jual` int(11) NOT NULL,
  PRIMARY KEY (`nonota`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `stok_anakkunci` */

insert  into `stok_anakkunci`(`nonota`,`anakkunci`,`jual`) values ('NB1170508-001',3,0);

/*Table structure for table `stok_bukuservis` */

DROP TABLE IF EXISTS `stok_bukuservis`;

CREATE TABLE `stok_bukuservis` (
  `nonota` varchar(20) NOT NULL,
  `bukuservis` int(11) NOT NULL,
  `jual` int(11) NOT NULL,
  PRIMARY KEY (`nonota`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `stok_bukuservis` */

insert  into `stok_bukuservis`(`nonota`,`bukuservis`,`jual`) values ('NB1170508-001',3,0);

/*Table structure for table `stok_helm` */

DROP TABLE IF EXISTS `stok_helm`;

CREATE TABLE `stok_helm` (
  `nonota` varchar(20) NOT NULL,
  `helm` int(11) NOT NULL,
  `jual` int(11) NOT NULL,
  PRIMARY KEY (`nonota`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `stok_helm` */

insert  into `stok_helm`(`nonota`,`helm`,`jual`) values ('NB1170508-001',3,0);

/*Table structure for table `stok_jaket` */

DROP TABLE IF EXISTS `stok_jaket`;

CREATE TABLE `stok_jaket` (
  `nonota` varchar(20) NOT NULL,
  `jaket` int(11) NOT NULL,
  `jual` int(11) NOT NULL,
  PRIMARY KEY (`nonota`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `stok_jaket` */

insert  into `stok_jaket`(`nonota`,`jaket`,`jual`) values ('NB1170508-001',0,0);

/*Table structure for table `stok_spion` */

DROP TABLE IF EXISTS `stok_spion`;

CREATE TABLE `stok_spion` (
  `nonota` varchar(20) NOT NULL,
  `spion` int(11) NOT NULL,
  `jual` int(11) NOT NULL,
  PRIMARY KEY (`nonota`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `stok_spion` */

insert  into `stok_spion`(`nonota`,`spion`,`jual`) values ('NB1170508-001',6,0);

/*Table structure for table `stok_toolkit` */

DROP TABLE IF EXISTS `stok_toolkit`;

CREATE TABLE `stok_toolkit` (
  `nonota` varchar(20) NOT NULL,
  `toolkit` int(11) NOT NULL,
  `jual` int(11) NOT NULL,
  PRIMARY KEY (`nonota`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `stok_toolkit` */

insert  into `stok_toolkit`(`nonota`,`toolkit`,`jual`) values ('NB1170508-001',3,0);

/*Table structure for table `tbl_abis_dkonfirmasi` */

DROP TABLE IF EXISTS `tbl_abis_dkonfirmasi`;

CREATE TABLE `tbl_abis_dkonfirmasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idopname` int(11) NOT NULL,
  `idpesanan` int(11) NOT NULL,
  `idkwitansi` int(11) NOT NULL,
  `idpindah` int(11) NOT NULL,
  `idpiutang` int(11) NOT NULL,
  `idbyrpiutang` int(11) NOT NULL,
  `idpotkompensasi` int(11) NOT NULL,
  `idreturbeli` int(11) NOT NULL,
  `idkaskecil` int(11) NOT NULL,
  `idbensin` int(11) NOT NULL,
  `tahun` year(4) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `tanggal` date NOT NULL,
  `kasus` varchar(200) NOT NULL,
  `tbl` varchar(40) NOT NULL,
  `status` int(1) NOT NULL,
  `inputx` datetime NOT NULL,
  `updatex` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_abis_dkonfirmasi` */

/*Table structure for table `tbl_bayarsup_history` */

DROP TABLE IF EXISTS `tbl_bayarsup_history`;

CREATE TABLE `tbl_bayarsup_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nonota` varchar(20) NOT NULL,
  `jumlah` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `iduser` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_bayarsup_history` */

insert  into `tbl_bayarsup_history`(`id`,`nonota`,`jumlah`,`tanggal`,`iduser`) values (1,'NB1170508-001','37200000','2017-05-08',39);

/*Table structure for table `tbl_bensin` */

DROP TABLE IF EXISTS `tbl_bensin`;

CREATE TABLE `tbl_bensin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jenis` varchar(11) NOT NULL,
  `keterangan` varchar(1000) NOT NULL,
  `jumlah` varchar(20) NOT NULL,
  `opname` varchar(20) NOT NULL,
  `status` int(1) NOT NULL,
  `iduser` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_bensin` */

/*Table structure for table `tbl_bpkb` */

DROP TABLE IF EXISTS `tbl_bpkb`;

CREATE TABLE `tbl_bpkb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nopesan` varchar(20) NOT NULL,
  `notajual` varchar(20) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `noktp` varchar(20) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `rt` varchar(4) NOT NULL,
  `rw` varchar(4) NOT NULL,
  `kodekab` varchar(2) NOT NULL,
  `namakab` varchar(20) NOT NULL,
  `kodekec` varchar(2) NOT NULL,
  `namakec` varchar(20) NOT NULL,
  `kodekel` varchar(2) NOT NULL,
  `namakel` varchar(20) NOT NULL,
  `kodealamat` varchar(10) NOT NULL,
  `pnopol` varchar(100) NOT NULL,
  `utitipannopol` varchar(20) NOT NULL,
  `harganopol` varchar(20) NOT NULL,
  `sisabayar` varchar(20) NOT NULL,
  `status` int(1) NOT NULL,
  `updatex` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_bpkb` */

insert  into `tbl_bpkb`(`id`,`nopesan`,`notajual`,`nama`,`noktp`,`alamat`,`rt`,`rw`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`,`kodealamat`,`pnopol`,`utitipannopol`,`harganopol`,`sisabayar`,`status`,`updatex`) values (1,'NP170508-001','','TRI ANDAYANI','01','JALI JALI','1','2','BK','BANGKALAN','02','BANGKALAN','05','DEMANGAN','BK.02.05','BE 888 B','500000','','',0,'');

/*Table structure for table `tbl_bulan` */

DROP TABLE IF EXISTS `tbl_bulan`;

CREATE TABLE `tbl_bulan` (
  `id` int(2) DEFAULT NULL,
  `angkabln` varchar(2) DEFAULT NULL,
  `namabln` varchar(9) DEFAULT NULL,
  `sktbln` varchar(3) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `tbl_bulan` */

insert  into `tbl_bulan`(`id`,`angkabln`,`namabln`,`sktbln`) values (1,'01','JANUARI','JAN');
insert  into `tbl_bulan`(`id`,`angkabln`,`namabln`,`sktbln`) values (2,'02','FEBRUARI','FEB');
insert  into `tbl_bulan`(`id`,`angkabln`,`namabln`,`sktbln`) values (3,'03','MARET','MAR');
insert  into `tbl_bulan`(`id`,`angkabln`,`namabln`,`sktbln`) values (4,'04','APRIL','APR');
insert  into `tbl_bulan`(`id`,`angkabln`,`namabln`,`sktbln`) values (5,'05','MEI','MAY');
insert  into `tbl_bulan`(`id`,`angkabln`,`namabln`,`sktbln`) values (6,'06','JUNI','JUN');
insert  into `tbl_bulan`(`id`,`angkabln`,`namabln`,`sktbln`) values (7,'07','JULI','JUL');
insert  into `tbl_bulan`(`id`,`angkabln`,`namabln`,`sktbln`) values (8,'08','AGUSTUS','AUG');
insert  into `tbl_bulan`(`id`,`angkabln`,`namabln`,`sktbln`) values (9,'09','SEPTEMBER','SEP');
insert  into `tbl_bulan`(`id`,`angkabln`,`namabln`,`sktbln`) values (10,'10','OKTOBER','OCT');
insert  into `tbl_bulan`(`id`,`angkabln`,`namabln`,`sktbln`) values (11,'11','NOVEMBER','NOV');
insert  into `tbl_bulan`(`id`,`angkabln`,`namabln`,`sktbln`) values (12,'12','DESEMBER','DEC');

/*Table structure for table `tbl_bup` */

DROP TABLE IF EXISTS `tbl_bup`;

CREATE TABLE `tbl_bup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(20) NOT NULL,
  `tgl` datetime NOT NULL,
  `input` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_bup` */

insert  into `tbl_bup`(`id`,`kode`,`tgl`,`input`) values (1,'170210-081846','2017-02-10 20:18:46','alex 2017-02-10 20:18:46 127.0.0.1 ISAS-VAIO');
insert  into `tbl_bup`(`id`,`kode`,`tgl`,`input`) values (2,'170210-081914','2017-02-10 20:19:37','alex 2017-02-10 20:19:14 127.0.0.1 ISAS-VAIO');
insert  into `tbl_bup`(`id`,`kode`,`tgl`,`input`) values (3,'170210-083005','2017-02-10 20:30:05','alex 2017-02-10 20:30:05 192.168.43.118 ALEX-RG');
insert  into `tbl_bup`(`id`,`kode`,`tgl`,`input`) values (4,'170210-083302','2017-02-10 20:33:22','alex 2017-02-10 20:33:02 192.168.43.118 ALEX-RG');
insert  into `tbl_bup`(`id`,`kode`,`tgl`,`input`) values (5,'170210-083355','2017-02-10 20:34:15','alex 2017-02-10 20:33:55 192.168.43.118 ALEX-RG');
insert  into `tbl_bup`(`id`,`kode`,`tgl`,`input`) values (6,'170210-083546','2017-02-10 20:36:07','alex 2017-02-10 20:35:46 192.168.43.118 ALEX-RG');
insert  into `tbl_bup`(`id`,`kode`,`tgl`,`input`) values (7,'170210-093445','2017-02-10 21:34:46','alex 2017-02-10 21:34:45 192.168.43.118 ALEX-RG');
insert  into `tbl_bup`(`id`,`kode`,`tgl`,`input`) values (8,'170210-093512','2017-02-10 21:35:33','alex 2017-02-10 21:35:12 192.168.43.118 ALEX-RG');

/*Table structure for table `tbl_cekfisik` */

DROP TABLE IF EXISTS `tbl_cekfisik`;

CREATE TABLE `tbl_cekfisik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nonota` varchar(20) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `norangka` varchar(40) NOT NULL,
  `nomesin` varchar(20) NOT NULL,
  `tahun` year(4) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `user` int(11) NOT NULL,
  `accu` int(11) NOT NULL,
  `alaskaki` int(11) NOT NULL,
  `anakkunci` int(11) NOT NULL,
  `helm` int(11) NOT NULL,
  `spion` int(11) NOT NULL,
  `toolkit` int(11) NOT NULL,
  `jaket` int(11) NOT NULL,
  `bukuservis` int(11) NOT NULL,
  `cekfisik` int(11) NOT NULL,
  `bensinawal` int(11) NOT NULL,
  `kondisimotor` int(11) NOT NULL,
  `lihat` int(1) NOT NULL,
  `ikesalahan` int(1) NOT NULL,
  `inputx` datetime NOT NULL,
  `updatex` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_cekfisik` */

/*Table structure for table `tbl_grossubsidi` */

DROP TABLE IF EXISTS `tbl_grossubsidi`;

CREATE TABLE `tbl_grossubsidi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl1` date NOT NULL,
  `tgl2` date NOT NULL,
  `matrix1` varchar(11) NOT NULL,
  `matrix2` varchar(11) NOT NULL,
  `subsidi1` varchar(11) NOT NULL,
  `subsidi2` varchar(11) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_grossubsidi` */

insert  into `tbl_grossubsidi`(`id`,`tgl1`,`tgl2`,`matrix1`,`matrix2`,`subsidi1`,`subsidi2`,`status`) values (1,'2016-07-15','0000-00-00','2','1','1','2',1);

/*Table structure for table `tbl_gudang` */

DROP TABLE IF EXISTS `tbl_gudang`;

CREATE TABLE `tbl_gudang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gudang` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_gudang` */

insert  into `tbl_gudang`(`id`,`gudang`) values (2,'GUDANG A');
insert  into `tbl_gudang`(`id`,`gudang`) values (4,'GUDANG B');
insert  into `tbl_gudang`(`id`,`gudang`) values (5,'GUDANG C');
insert  into `tbl_gudang`(`id`,`gudang`) values (6,'GUDANG D');

/*Table structure for table `tbl_hakakses` */

DROP TABLE IF EXISTS `tbl_hakakses`;

CREATE TABLE `tbl_hakakses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hakakses` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_hakakses` */

insert  into `tbl_hakakses`(`id`,`hakakses`) values (4,'ALL');
insert  into `tbl_hakakses`(`id`,`hakakses`) values (5,'USER');

/*Table structure for table `tbl_history_bcashtempo` */

DROP TABLE IF EXISTS `tbl_history_bcashtempo`;

CREATE TABLE `tbl_history_bcashtempo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nonota` varchar(20) NOT NULL,
  `tahun` year(4) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_history_bcashtempo` */

/*Table structure for table `tbl_hlaba` */

DROP TABLE IF EXISTS `tbl_hlaba`;

CREATE TABLE `tbl_hlaba` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nonota` varchar(50) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `tahun` year(4) NOT NULL,
  `bunga` varchar(22) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_hlaba` */

/*Table structure for table `tbl_hleasing` */

DROP TABLE IF EXISTS `tbl_hleasing`;

CREATE TABLE `tbl_hleasing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pelanggan` int(11) NOT NULL,
  `kodeleasing` varchar(20) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `termin` varchar(10) NOT NULL,
  `tanggal` date NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_hleasing` */

insert  into `tbl_hleasing`(`id`,`id_pelanggan`,`kodeleasing`,`unit`,`termin`,`tanggal`,`status`) values (1,7,'ADIRA','HONDA TIGER','5T','2015-05-31',0);
insert  into `tbl_hleasing`(`id`,`id_pelanggan`,`kodeleasing`,`unit`,`termin`,`tanggal`,`status`) values (2,7,'FIF','HONDA MEGA PRO','3T','2015-06-05',1);
insert  into `tbl_hleasing`(`id`,`id_pelanggan`,`kodeleasing`,`unit`,`termin`,`tanggal`,`status`) values (3,5,'MMF','YAMAHA VEGA R','1T','2015-12-31',1);
insert  into `tbl_hleasing`(`id`,`id_pelanggan`,`kodeleasing`,`unit`,`termin`,`tanggal`,`status`) values (5,10,'ADIRA','YAMAHA VEGA','24','2012-02-25',1);
insert  into `tbl_hleasing`(`id`,`id_pelanggan`,`kodeleasing`,`unit`,`termin`,`tanggal`,`status`) values (6,10,'FIF','HONDA VARIO','12','2014-05-15',1);
insert  into `tbl_hleasing`(`id`,`id_pelanggan`,`kodeleasing`,`unit`,`termin`,`tanggal`,`status`) values (7,8,'MMF','HONDA REVO','12','2016-11-18',0);
insert  into `tbl_hleasing`(`id`,`id_pelanggan`,`kodeleasing`,`unit`,`termin`,`tanggal`,`status`) values (8,9,'MMF','HONDA TIGER','24','2012-12-31',1);
insert  into `tbl_hleasing`(`id`,`id_pelanggan`,`kodeleasing`,`unit`,`termin`,`tanggal`,`status`) values (19,9,'BAF','EWR','1','2016-10-20',0);
insert  into `tbl_hleasing`(`id`,`id_pelanggan`,`kodeleasing`,`unit`,`termin`,`tanggal`,`status`) values (21,4,'MF','HONDA CB 150 R','12','2016-12-15',0);
insert  into `tbl_hleasing`(`id`,`id_pelanggan`,`kodeleasing`,`unit`,`termin`,`tanggal`,`status`) values (22,9,'ADIRA','HONDA MEGA PRO','22','2016-12-15',1);
insert  into `tbl_hleasing`(`id`,`id_pelanggan`,`kodeleasing`,`unit`,`termin`,`tanggal`,`status`) values (24,24,'TES','HONDA MEGA PRO','12','2016-12-18',0);
insert  into `tbl_hleasing`(`id`,`id_pelanggan`,`kodeleasing`,`unit`,`termin`,`tanggal`,`status`) values (26,24,'TES','HONDA MEGA PRO','21','2016-12-18',1);
insert  into `tbl_hleasing`(`id`,`id_pelanggan`,`kodeleasing`,`unit`,`termin`,`tanggal`,`status`) values (27,24,'TES','HONDA CB 150 R','20','2016-12-18',0);
insert  into `tbl_hleasing`(`id`,`id_pelanggan`,`kodeleasing`,`unit`,`termin`,`tanggal`,`status`) values (28,17,'FIF','SUPRA X ','24','2017-02-16',1);
insert  into `tbl_hleasing`(`id`,`id_pelanggan`,`kodeleasing`,`unit`,`termin`,`tanggal`,`status`) values (29,11,'FIF','HONDA MEGA PRO','12','2017-02-16',1);
insert  into `tbl_hleasing`(`id`,`id_pelanggan`,`kodeleasing`,`unit`,`termin`,`tanggal`,`status`) values (30,9,'FIF','HONDA CBR 250 CC','12','2017-02-16',1);
insert  into `tbl_hleasing`(`id`,`id_pelanggan`,`kodeleasing`,`unit`,`termin`,`tanggal`,`status`) values (31,27,'ADIRA','HONDA MEGA PRO','12','2017-02-17',1);
insert  into `tbl_hleasing`(`id`,`id_pelanggan`,`kodeleasing`,`unit`,`termin`,`tanggal`,`status`) values (32,26,'BAF','HONDA CBR 250 CC','12','2017-02-17',1);
insert  into `tbl_hleasing`(`id`,`id_pelanggan`,`kodeleasing`,`unit`,`termin`,`tanggal`,`status`) values (33,16,'BAF','HONDA MEGA PRO','22','2017-02-24',1);
insert  into `tbl_hleasing`(`id`,`id_pelanggan`,`kodeleasing`,`unit`,`termin`,`tanggal`,`status`) values (34,23,'MF','HONDA MEGA PRO','33','2017-02-24',1);
insert  into `tbl_hleasing`(`id`,`id_pelanggan`,`kodeleasing`,`unit`,`termin`,`tanggal`,`status`) values (35,27,'ADIRA','HONDA MEGA PRO','11','2017-02-24',1);
insert  into `tbl_hleasing`(`id`,`id_pelanggan`,`kodeleasing`,`unit`,`termin`,`tanggal`,`status`) values (36,27,'ADIRA','HONDA MEGA PRO','11','2017-02-24',1);
insert  into `tbl_hleasing`(`id`,`id_pelanggan`,`kodeleasing`,`unit`,`termin`,`tanggal`,`status`) values (37,27,'ADIRA','HONDA MEGA PRO','11','2017-03-01',1);
insert  into `tbl_hleasing`(`id`,`id_pelanggan`,`kodeleasing`,`unit`,`termin`,`tanggal`,`status`) values (38,27,'ADIRA','HONDA MEGA PRO','12','2017-03-01',1);
insert  into `tbl_hleasing`(`id`,`id_pelanggan`,`kodeleasing`,`unit`,`termin`,`tanggal`,`status`) values (39,27,'ADIRA','HONDA MEGA PRO','10','2017-03-20',1);
insert  into `tbl_hleasing`(`id`,`id_pelanggan`,`kodeleasing`,`unit`,`termin`,`tanggal`,`status`) values (40,26,'BAF','HONDA CBR 250 CC','10','2017-03-20',1);
insert  into `tbl_hleasing`(`id`,`id_pelanggan`,`kodeleasing`,`unit`,`termin`,`tanggal`,`status`) values (41,27,'ADIRA','HONDA MEGA PRO','12','2017-03-03',1);
insert  into `tbl_hleasing`(`id`,`id_pelanggan`,`kodeleasing`,`unit`,`termin`,`tanggal`,`status`) values (42,26,'MF','HONDA CBR 250 CC','42','2017-03-23',1);
insert  into `tbl_hleasing`(`id`,`id_pelanggan`,`kodeleasing`,`unit`,`termin`,`tanggal`,`status`) values (43,27,'ADIRA','HONDA MEGA PRO','15','2017-03-23',1);
insert  into `tbl_hleasing`(`id`,`id_pelanggan`,`kodeleasing`,`unit`,`termin`,`tanggal`,`status`) values (44,27,'ADIRA','HONDA MEGA PRO','10','2017-03-23',1);
insert  into `tbl_hleasing`(`id`,`id_pelanggan`,`kodeleasing`,`unit`,`termin`,`tanggal`,`status`) values (45,10,'BAF','BEAT POP','12','2017-03-23',1);

/*Table structure for table `tbl_hohc` */

DROP TABLE IF EXISTS `tbl_hohc`;

CREATE TABLE `tbl_hohc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idpelanggan` int(11) NOT NULL,
  `ohc` varchar(20) NOT NULL,
  `kadaluarsaohc` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_hohc` */

insert  into `tbl_hohc`(`id`,`idpelanggan`,`ohc`,`kadaluarsaohc`) values (2,3,'H85645221','2017-01-01');
insert  into `tbl_hohc`(`id`,`idpelanggan`,`ohc`,`kadaluarsaohc`) values (3,6,'H85645216','2018-03-12');
insert  into `tbl_hohc`(`id`,`idpelanggan`,`ohc`,`kadaluarsaohc`) values (4,9,'H85645214','2016-10-28');
insert  into `tbl_hohc`(`id`,`idpelanggan`,`ohc`,`kadaluarsaohc`) values (5,9,'H85645214','2016-10-28');
insert  into `tbl_hohc`(`id`,`idpelanggan`,`ohc`,`kadaluarsaohc`) values (6,5,'H324813','2016-10-28');
insert  into `tbl_hohc`(`id`,`idpelanggan`,`ohc`,`kadaluarsaohc`) values (7,5,'H324813','2016-10-28');
insert  into `tbl_hohc`(`id`,`idpelanggan`,`ohc`,`kadaluarsaohc`) values (8,9,'231231','2017-12-05');
insert  into `tbl_hohc`(`id`,`idpelanggan`,`ohc`,`kadaluarsaohc`) values (9,9,'231231','2017-12-05');

/*Table structure for table `tbl_hutitipan` */

DROP TABLE IF EXISTS `tbl_hutitipan`;

CREATE TABLE `tbl_hutitipan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nopesan` varchar(20) NOT NULL,
  `idpelanggan` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `jumlah` varchar(20) NOT NULL,
  `ket` varchar(100) NOT NULL,
  `input` datetime NOT NULL,
  `status` int(1) NOT NULL,
  `updatex` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_hutitipan` */

/*Table structure for table `tbl_insentif_grup` */

DROP TABLE IF EXISTS `tbl_insentif_grup`;

CREATE TABLE `tbl_insentif_grup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grup` int(11) NOT NULL,
  `target` varchar(11) NOT NULL,
  `cash` varchar(11) NOT NULL,
  `kredit` varchar(11) NOT NULL,
  `flat` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_insentif_grup` */

/*Table structure for table `tbl_insentif_inc` */

DROP TABLE IF EXISTS `tbl_insentif_inc`;

CREATE TABLE `tbl_insentif_inc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_insentif_inc` */

/*Table structure for table `tbl_insentif_karyawan` */

DROP TABLE IF EXISTS `tbl_insentif_karyawan`;

CREATE TABLE `tbl_insentif_karyawan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(11) NOT NULL,
  `target` int(11) NOT NULL,
  `cash` varchar(11) NOT NULL,
  `kredit` varchar(11) NOT NULL,
  `flat` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_insentif_karyawan` */

insert  into `tbl_insentif_karyawan`(`id`,`id_karyawan`,`target`,`cash`,`kredit`,`flat`) values (1,57,10,'10000','20000','');
insert  into `tbl_insentif_karyawan`(`id`,`id_karyawan`,`target`,`cash`,`kredit`,`flat`) values (2,57,20,'20000','30000','');
insert  into `tbl_insentif_karyawan`(`id`,`id_karyawan`,`target`,`cash`,`kredit`,`flat`) values (3,61,10,'10000','20000','');
insert  into `tbl_insentif_karyawan`(`id`,`id_karyawan`,`target`,`cash`,`kredit`,`flat`) values (4,61,20,'20000','30000','');
insert  into `tbl_insentif_karyawan`(`id`,`id_karyawan`,`target`,`cash`,`kredit`,`flat`) values (7,64,10,'10000','20000','');
insert  into `tbl_insentif_karyawan`(`id`,`id_karyawan`,`target`,`cash`,`kredit`,`flat`) values (8,64,20,'20000','30000','');
insert  into `tbl_insentif_karyawan`(`id`,`id_karyawan`,`target`,`cash`,`kredit`,`flat`) values (10,60,0,'','','500');
insert  into `tbl_insentif_karyawan`(`id`,`id_karyawan`,`target`,`cash`,`kredit`,`flat`) values (11,59,0,'','','15000');
insert  into `tbl_insentif_karyawan`(`id`,`id_karyawan`,`target`,`cash`,`kredit`,`flat`) values (14,64,0,'5000','10000','');
insert  into `tbl_insentif_karyawan`(`id`,`id_karyawan`,`target`,`cash`,`kredit`,`flat`) values (16,58,0,'','','150020');
insert  into `tbl_insentif_karyawan`(`id`,`id_karyawan`,`target`,`cash`,`kredit`,`flat`) values (17,62,0,'','','500');
insert  into `tbl_insentif_karyawan`(`id`,`id_karyawan`,`target`,`cash`,`kredit`,`flat`) values (18,63,0,'1000','2000','');
insert  into `tbl_insentif_karyawan`(`id`,`id_karyawan`,`target`,`cash`,`kredit`,`flat`) values (19,63,5,'2000','3000','');

/*Table structure for table `tbl_karyawan` */

DROP TABLE IF EXISTS `tbl_karyawan`;

CREATE TABLE `tbl_karyawan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(20) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `posisi` int(1) NOT NULL,
  `tmplahir` varchar(20) NOT NULL,
  `tgllahir` date NOT NULL,
  `noktp` varchar(20) NOT NULL,
  `notelepon` varchar(20) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `tglmulaikerja` date NOT NULL,
  `ugapok` varchar(17) NOT NULL,
  `uharian` varchar(17) NOT NULL,
  `ukomisi` varchar(17) NOT NULL,
  `ulembur` varchar(17) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `pic_user` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'AKTIF',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_karyawan` */

insert  into `tbl_karyawan`(`id`,`nik`,`nama`,`posisi`,`tmplahir`,`tgllahir`,`noktp`,`notelepon`,`alamat`,`tglmulaikerja`,`ugapok`,`uharian`,`ukomisi`,`ulembur`,`photo`,`pic_user`,`status`) values (1,'000','ADMINISTRATOR',1,'','0000-00-00','','','','0000-00-00','','','','','','','AKTIF');
insert  into `tbl_karyawan`(`id`,`nik`,`nama`,`posisi`,`tmplahir`,`tgllahir`,`noktp`,`notelepon`,`alamat`,`tglmulaikerja`,`ugapok`,`uharian`,`ukomisi`,`ulembur`,`photo`,`pic_user`,`status`) values (57,'H1-001','ALEX IMC',6,'JAKARTA','1983-11-11','123456789','123456789','JAKARTA','2011-11-11','1500000','20000','','50000','','alex','AKTIF');
insert  into `tbl_karyawan`(`id`,`nik`,`nama`,`posisi`,`tmplahir`,`tgllahir`,`noktp`,`notelepon`,`alamat`,`tglmulaikerja`,`ugapok`,`uharian`,`ukomisi`,`ulembur`,`photo`,`pic_user`,`status`) values (58,'H1-002','STAF ADMINISTRASI',4,'ADMINISTRASI','2011-11-11','123456789','123456789','ADMINISTRASI','2011-11-11','1200000','20000','','20000','','alex','AKTIF');
insert  into `tbl_karyawan`(`id`,`nik`,`nama`,`posisi`,`tmplahir`,`tgllahir`,`noktp`,`notelepon`,`alamat`,`tglmulaikerja`,`ugapok`,`uharian`,`ukomisi`,`ulembur`,`photo`,`pic_user`,`status`) values (59,'H1-003','STAF KASIR',3,'KASIR','2011-11-11','123456789','123456789','KASIR','2011-11-11','1000000','20000','','20000','','alex','AKTIF');
insert  into `tbl_karyawan`(`id`,`nik`,`nama`,`posisi`,`tmplahir`,`tgllahir`,`noktp`,`notelepon`,`alamat`,`tglmulaikerja`,`ugapok`,`uharian`,`ukomisi`,`ulembur`,`photo`,`pic_user`,`status`) values (60,'H1-004','STAF GUDANG PDI',5,'GUDANG PDI','2011-11-11','123456789','123456789','GUDANG PDI','2011-11-11','1200000','20000','','20000','','alex','AKTIF');
insert  into `tbl_karyawan`(`id`,`nik`,`nama`,`posisi`,`tmplahir`,`tgllahir`,`noktp`,`notelepon`,`alamat`,`tglmulaikerja`,`ugapok`,`uharian`,`ukomisi`,`ulembur`,`photo`,`pic_user`,`status`) values (61,'H1-005','KEPALA TOKO',9,'KEPALA TOKOQQ','2011-11-11','123456789','123456789','KEPALA TOKO','2011-11-11','1200001','20000','','20000','34Tes Honda.jpg','alex','AKTIF');
insert  into `tbl_karyawan`(`id`,`nik`,`nama`,`posisi`,`tmplahir`,`tgllahir`,`noktp`,`notelepon`,`alamat`,`tglmulaikerja`,`ugapok`,`uharian`,`ukomisi`,`ulembur`,`photo`,`pic_user`,`status`) values (62,'H1-006','STAF DRIVER',8,'QWEQEW','2011-11-11','wqewe','123123','QEQWE','2011-11-11','1000001','20000','','50000','','alex','AKTIF');
insert  into `tbl_karyawan`(`id`,`nik`,`nama`,`posisi`,`tmplahir`,`tgllahir`,`noktp`,`notelepon`,`alamat`,`tglmulaikerja`,`ugapok`,`uharian`,`ukomisi`,`ulembur`,`photo`,`pic_user`,`status`) values (63,'H1-007','STAF SALES',7,'SALES','2011-11-11','123456789','1','1','2011-11-11','1500000','20000','','0','411_542057529m.jpg','alex','AKTIF');
insert  into `tbl_karyawan`(`id`,`nik`,`nama`,`posisi`,`tmplahir`,`tgllahir`,`noktp`,`notelepon`,`alamat`,`tglmulaikerja`,`ugapok`,`uharian`,`ukomisi`,`ulembur`,`photo`,`pic_user`,`status`) values (64,'H1-008','STAF SALES COUNTER',2,'STAF SALES COUNTER','2011-11-11','11','1','1','2011-11-11','1500000','20000','','50000','','alex','AKTIF');
insert  into `tbl_karyawan`(`id`,`nik`,`nama`,`posisi`,`tmplahir`,`tgllahir`,`noktp`,`notelepon`,`alamat`,`tglmulaikerja`,`ugapok`,`uharian`,`ukomisi`,`ulembur`,`photo`,`pic_user`,`status`) values (65,'H1-009','ANUGRAH JAYA',6,'AJ','2011-11-11','1','1','ANUGRAH JAYA DIREKSI','2011-11-11','1','1','','1','','alex','AKTIF');
insert  into `tbl_karyawan`(`id`,`nik`,`nama`,`posisi`,`tmplahir`,`tgllahir`,`noktp`,`notelepon`,`alamat`,`tglmulaikerja`,`ugapok`,`uharian`,`ukomisi`,`ulembur`,`photo`,`pic_user`,`status`) values (66,'H1-010','SALES AJ',7,'WERWER','2011-01-01','34234','3242','324234','2016-01-01','1000000','100000','','100000','','ALEX','AKTIF');
insert  into `tbl_karyawan`(`id`,`nik`,`nama`,`posisi`,`tmplahir`,`tgllahir`,`noktp`,`notelepon`,`alamat`,`tglmulaikerja`,`ugapok`,`uharian`,`ukomisi`,`ulembur`,`photo`,`pic_user`,`status`) values (67,'H1-011','KASIR AJ',3,'DFSFS','2005-01-01','ewr','4343','43543543','2016-01-01','1000000','100000','','10000','','ALEX','AKTIF');

/*Table structure for table `tbl_kaskecil` */

DROP TABLE IF EXISTS `tbl_kaskecil`;

CREATE TABLE `tbl_kaskecil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jenis` varchar(11) NOT NULL,
  `keterangan` varchar(1000) NOT NULL,
  `jumlah` varchar(20) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_kaskecil` */

/*Table structure for table `tbl_kompensasi` */

DROP TABLE IF EXISTS `tbl_kompensasi`;

CREATE TABLE `tbl_kompensasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bulan` varchar(2) NOT NULL,
  `tahun` year(4) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `idkaryawan` int(11) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `posisi` varchar(20) NOT NULL,
  `ugapok` varchar(20) NOT NULL,
  `uharian` varchar(20) NOT NULL,
  `ukomisi` varchar(20) NOT NULL,
  `ulembur` varchar(20) NOT NULL,
  `uinsentif` varchar(20) NOT NULL,
  `utambahan` varchar(20) NOT NULL,
  `upotongan` varchar(20) NOT NULL,
  `total` varchar(20) NOT NULL,
  `tglbayar` date NOT NULL,
  `status` int(1) NOT NULL,
  `inputx` datetime NOT NULL,
  `updatex` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=356 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_kompensasi` */

insert  into `tbl_kompensasi`(`id`,`bulan`,`tahun`,`nik`,`idkaryawan`,`nama`,`posisi`,`ugapok`,`uharian`,`ukomisi`,`ulembur`,`uinsentif`,`utambahan`,`upotongan`,`total`,`tglbayar`,`status`,`inputx`,`updatex`) values (188,'12',2016,'H1-001',57,'ALEX IMC ','DIREKSI','1500000','0','','','0','0','0','1500000','0000-00-00',0,'2016-12-16 21:39:21','');
insert  into `tbl_kompensasi`(`id`,`bulan`,`tahun`,`nik`,`idkaryawan`,`nama`,`posisi`,`ugapok`,`uharian`,`ukomisi`,`ulembur`,`uinsentif`,`utambahan`,`upotongan`,`total`,`tglbayar`,`status`,`inputx`,`updatex`) values (189,'12',2016,'H1-002',58,'STAF ADMINISTRASI ','ADMINISTRASI','1200000','40000','','','300040','1000','20000','1481040','2016-12-16',1,'2016-12-16 21:39:21','alex 2016-12-16 21:41:58 192.168.43.118 ALEX-RG');
insert  into `tbl_kompensasi`(`id`,`bulan`,`tahun`,`nik`,`idkaryawan`,`nama`,`posisi`,`ugapok`,`uharian`,`ukomisi`,`ulembur`,`uinsentif`,`utambahan`,`upotongan`,`total`,`tglbayar`,`status`,`inputx`,`updatex`) values (190,'12',2016,'H1-003',59,'STAF KASIR ','KASIR','1200000','40000','','','30000','0','0','1230000','0000-00-00',0,'2016-12-16 21:39:21','');
insert  into `tbl_kompensasi`(`id`,`bulan`,`tahun`,`nik`,`idkaryawan`,`nama`,`posisi`,`ugapok`,`uharian`,`ukomisi`,`ulembur`,`uinsentif`,`utambahan`,`upotongan`,`total`,`tglbayar`,`status`,`inputx`,`updatex`) values (191,'12',2016,'H1-004',60,'STAF GUDANG PDI ','GUDANG & PDI','1200000','40000','','','1000','0','0','1201000','0000-00-00',0,'2016-12-16 21:39:21','');
insert  into `tbl_kompensasi`(`id`,`bulan`,`tahun`,`nik`,`idkaryawan`,`nama`,`posisi`,`ugapok`,`uharian`,`ukomisi`,`ulembur`,`uinsentif`,`utambahan`,`upotongan`,`total`,`tglbayar`,`status`,`inputx`,`updatex`) values (192,'12',2016,'H1-005',61,'KEPALA TOKO ','PIC','1200000','40000','','','0','0','0','1200000','0000-00-00',0,'2016-12-16 21:39:22','');
insert  into `tbl_kompensasi`(`id`,`bulan`,`tahun`,`nik`,`idkaryawan`,`nama`,`posisi`,`ugapok`,`uharian`,`ukomisi`,`ulembur`,`uinsentif`,`utambahan`,`upotongan`,`total`,`tglbayar`,`status`,`inputx`,`updatex`) values (193,'12',2016,'H1-006',62,'STAF DRIVER ','DRIVER','1500000','40000','','50000','1000','0','123123','1501000','0000-00-00',0,'2016-12-16 21:39:22','');
insert  into `tbl_kompensasi`(`id`,`bulan`,`tahun`,`nik`,`idkaryawan`,`nama`,`posisi`,`ugapok`,`uharian`,`ukomisi`,`ulembur`,`uinsentif`,`utambahan`,`upotongan`,`total`,`tglbayar`,`status`,`inputx`,`updatex`) values (194,'12',2016,'H1-007',63,'STAF SALES ','SALES','1500000','40000','','','0','0','55','1500000','0000-00-00',0,'2016-12-16 21:39:22','');
insert  into `tbl_kompensasi`(`id`,`bulan`,`tahun`,`nik`,`idkaryawan`,`nama`,`posisi`,`ugapok`,`uharian`,`ukomisi`,`ulembur`,`uinsentif`,`utambahan`,`upotongan`,`total`,`tglbayar`,`status`,`inputx`,`updatex`) values (195,'12',2016,'H1-008',64,'STAF SALES COUNTER ','SALES COUNTER','1500000','40000','','','10000','0','0','1510000','0000-00-00',0,'2016-12-16 21:39:22','');
insert  into `tbl_kompensasi`(`id`,`bulan`,`tahun`,`nik`,`idkaryawan`,`nama`,`posisi`,`ugapok`,`uharian`,`ukomisi`,`ulembur`,`uinsentif`,`utambahan`,`upotongan`,`total`,`tglbayar`,`status`,`inputx`,`updatex`) values (340,'01',2017,'H1-001',57,'ALEX IMC ','DIREKSI','1500000','0','','','0','0','0','1500000','0000-00-00',0,'2017-01-14 22:12:30','');
insert  into `tbl_kompensasi`(`id`,`bulan`,`tahun`,`nik`,`idkaryawan`,`nama`,`posisi`,`ugapok`,`uharian`,`ukomisi`,`ulembur`,`uinsentif`,`utambahan`,`upotongan`,`total`,`tglbayar`,`status`,`inputx`,`updatex`) values (341,'01',2017,'H1-002',58,'STAF ADMINISTRASI ','ADMINISTRASI','1200000','0','','','0','0','333','1200000','0000-00-00',0,'2017-01-14 22:12:30','');
insert  into `tbl_kompensasi`(`id`,`bulan`,`tahun`,`nik`,`idkaryawan`,`nama`,`posisi`,`ugapok`,`uharian`,`ukomisi`,`ulembur`,`uinsentif`,`utambahan`,`upotongan`,`total`,`tglbayar`,`status`,`inputx`,`updatex`) values (342,'01',2017,'H1-003',59,'STAF KASIR ','KASIR','1000000','0','','','0','0','410000','1000000','0000-00-00',0,'2017-01-14 22:12:31','');
insert  into `tbl_kompensasi`(`id`,`bulan`,`tahun`,`nik`,`idkaryawan`,`nama`,`posisi`,`ugapok`,`uharian`,`ukomisi`,`ulembur`,`uinsentif`,`utambahan`,`upotongan`,`total`,`tglbayar`,`status`,`inputx`,`updatex`) values (343,'01',2017,'H1-004',60,'STAF GUDANG PDI ','GUDANG & PDI','1200000','0','','','0','0','0','1200000','0000-00-00',0,'2017-01-14 22:12:31','');
insert  into `tbl_kompensasi`(`id`,`bulan`,`tahun`,`nik`,`idkaryawan`,`nama`,`posisi`,`ugapok`,`uharian`,`ukomisi`,`ulembur`,`uinsentif`,`utambahan`,`upotongan`,`total`,`tglbayar`,`status`,`inputx`,`updatex`) values (344,'01',2017,'H1-005',61,'KEPALA TOKO ','PIC','1200001','0','','','0','0','1000003','1200001','0000-00-00',0,'2017-01-14 22:12:31','');
insert  into `tbl_kompensasi`(`id`,`bulan`,`tahun`,`nik`,`idkaryawan`,`nama`,`posisi`,`ugapok`,`uharian`,`ukomisi`,`ulembur`,`uinsentif`,`utambahan`,`upotongan`,`total`,`tglbayar`,`status`,`inputx`,`updatex`) values (345,'01',2017,'H1-006',62,'STAF DRIVER ','DRIVER','1000001','0','','','0','0','0','1000001','0000-00-00',0,'2017-01-14 22:12:31','');
insert  into `tbl_kompensasi`(`id`,`bulan`,`tahun`,`nik`,`idkaryawan`,`nama`,`posisi`,`ugapok`,`uharian`,`ukomisi`,`ulembur`,`uinsentif`,`utambahan`,`upotongan`,`total`,`tglbayar`,`status`,`inputx`,`updatex`) values (346,'01',2017,'H1-007',63,'STAF SALES ','SALES','1500000','0','','','0','0','0','1500000','0000-00-00',0,'2017-01-14 22:12:31','');
insert  into `tbl_kompensasi`(`id`,`bulan`,`tahun`,`nik`,`idkaryawan`,`nama`,`posisi`,`ugapok`,`uharian`,`ukomisi`,`ulembur`,`uinsentif`,`utambahan`,`upotongan`,`total`,`tglbayar`,`status`,`inputx`,`updatex`) values (347,'01',2017,'H1-008',64,'STAF SALES COUNTER ','SALES COUNTER','1500000','0','','','0','0','0','1500000','0000-00-00',0,'2017-01-14 22:12:31','');
insert  into `tbl_kompensasi`(`id`,`bulan`,`tahun`,`nik`,`idkaryawan`,`nama`,`posisi`,`ugapok`,`uharian`,`ukomisi`,`ulembur`,`uinsentif`,`utambahan`,`upotongan`,`total`,`tglbayar`,`status`,`inputx`,`updatex`) values (348,'02',2017,'H1-001',57,'ALEX IMC ','DIREKSI','1500000','0','','','0','0','0','1500000','0000-00-00',0,'2017-02-09 20:40:33','');
insert  into `tbl_kompensasi`(`id`,`bulan`,`tahun`,`nik`,`idkaryawan`,`nama`,`posisi`,`ugapok`,`uharian`,`ukomisi`,`ulembur`,`uinsentif`,`utambahan`,`upotongan`,`total`,`tglbayar`,`status`,`inputx`,`updatex`) values (349,'02',2017,'H1-002',58,'STAF ADMINISTRASI ','ADMINISTRASI','1200000','0','','','300040','0','0','1500040','0000-00-00',0,'2017-02-09 20:40:33','');
insert  into `tbl_kompensasi`(`id`,`bulan`,`tahun`,`nik`,`idkaryawan`,`nama`,`posisi`,`ugapok`,`uharian`,`ukomisi`,`ulembur`,`uinsentif`,`utambahan`,`upotongan`,`total`,`tglbayar`,`status`,`inputx`,`updatex`) values (350,'02',2017,'H1-003',59,'STAF KASIR ','KASIR','1000000','0','','','30000','0','0','1030000','0000-00-00',0,'2017-02-09 20:40:33','');
insert  into `tbl_kompensasi`(`id`,`bulan`,`tahun`,`nik`,`idkaryawan`,`nama`,`posisi`,`ugapok`,`uharian`,`ukomisi`,`ulembur`,`uinsentif`,`utambahan`,`upotongan`,`total`,`tglbayar`,`status`,`inputx`,`updatex`) values (351,'02',2017,'H1-004',60,'STAF GUDANG PDI ','GUDANG & PDI','1200000','0','','','1000','0','0','1201000','0000-00-00',0,'2017-02-09 20:40:33','');
insert  into `tbl_kompensasi`(`id`,`bulan`,`tahun`,`nik`,`idkaryawan`,`nama`,`posisi`,`ugapok`,`uharian`,`ukomisi`,`ulembur`,`uinsentif`,`utambahan`,`upotongan`,`total`,`tglbayar`,`status`,`inputx`,`updatex`) values (352,'02',2017,'H1-005',61,'KEPALA TOKO ','PIC','1200001','0','','','0','0','0','1200001','0000-00-00',0,'2017-02-09 20:40:33','');
insert  into `tbl_kompensasi`(`id`,`bulan`,`tahun`,`nik`,`idkaryawan`,`nama`,`posisi`,`ugapok`,`uharian`,`ukomisi`,`ulembur`,`uinsentif`,`utambahan`,`upotongan`,`total`,`tglbayar`,`status`,`inputx`,`updatex`) values (353,'02',2017,'H1-006',62,'STAF DRIVER ','DRIVER','1000001','0','','','1000','0','0','1001001','0000-00-00',0,'2017-02-09 20:40:33','');
insert  into `tbl_kompensasi`(`id`,`bulan`,`tahun`,`nik`,`idkaryawan`,`nama`,`posisi`,`ugapok`,`uharian`,`ukomisi`,`ulembur`,`uinsentif`,`utambahan`,`upotongan`,`total`,`tglbayar`,`status`,`inputx`,`updatex`) values (354,'02',2017,'H1-007',63,'STAF SALES ','SALES','1500000','0','','','0','0','0','1500000','0000-00-00',0,'2017-02-09 20:40:33','');
insert  into `tbl_kompensasi`(`id`,`bulan`,`tahun`,`nik`,`idkaryawan`,`nama`,`posisi`,`ugapok`,`uharian`,`ukomisi`,`ulembur`,`uinsentif`,`utambahan`,`upotongan`,`total`,`tglbayar`,`status`,`inputx`,`updatex`) values (355,'02',2017,'H1-008',64,'STAF SALES COUNTER ','SALES COUNTER','1500000','0','','','0','0','0','1500000','0000-00-00',0,'2017-02-09 20:40:33','');

/*Table structure for table `tbl_kwitansi` */

DROP TABLE IF EXISTS `tbl_kwitansi`;

CREATE TABLE `tbl_kwitansi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jnskwitansi` varchar(20) NOT NULL,
  `nokwitansi` varchar(20) NOT NULL,
  `tahun` year(4) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `tanggal` date NOT NULL,
  `nomor` varchar(20) NOT NULL,
  `idpotkom` int(11) NOT NULL,
  `idpelanggan` int(11) NOT NULL,
  `jaket` varchar(10) NOT NULL,
  `bukuservice` varchar(10) NOT NULL,
  `jumlah` varchar(20) NOT NULL,
  `jumlah2` varchar(20) NOT NULL,
  `user` int(11) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `cetak` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  `inputx` datetime NOT NULL,
  `updatex` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_kwitansi` */

insert  into `tbl_kwitansi`(`id`,`jnskwitansi`,`nokwitansi`,`tahun`,`bulan`,`tanggal`,`nomor`,`idpotkom`,`idpelanggan`,`jaket`,`bukuservice`,`jumlah`,`jumlah2`,`user`,`keterangan`,`cetak`,`status`,`inputx`,`updatex`) values (1,'nopol','KNP170508-001',2017,'05','2017-05-08','NP170508-001',0,12,'','','500000','',39,'BE 888 B',0,0,'2017-05-08 15:47:29','');

/*Table structure for table `tbl_lainbbn` */

DROP TABLE IF EXISTS `tbl_lainbbn`;

CREATE TABLE `tbl_lainbbn` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl1` date NOT NULL,
  `tgl2` date NOT NULL,
  `lainbbn` varchar(11) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_lainbbn` */

insert  into `tbl_lainbbn`(`id`,`tgl1`,`tgl2`,`lainbbn`,`status`) values (1,'2017-02-22','0000-00-00','1500000',1);

/*Table structure for table `tbl_leasing` */

DROP TABLE IF EXISTS `tbl_leasing`;

CREATE TABLE `tbl_leasing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kodeleasing` varchar(20) NOT NULL,
  `namaleasing` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_leasing` */

insert  into `tbl_leasing`(`id`,`kodeleasing`,`namaleasing`) values (1,'FIF','FEDERAL INTERNATIONAL FINANCE');
insert  into `tbl_leasing`(`id`,`kodeleasing`,`namaleasing`) values (2,'ADIRA','ADIRA FINANCEE');
insert  into `tbl_leasing`(`id`,`kodeleasing`,`namaleasing`) values (3,'MF','MEGA FINANCE');
insert  into `tbl_leasing`(`id`,`kodeleasing`,`namaleasing`) values (6,'BAF','BUSAN AUTO FINANCE');
insert  into `tbl_leasing`(`id`,`kodeleasing`,`namaleasing`) values (7,'TES','TES');

/*Table structure for table `tbl_lembur` */

DROP TABLE IF EXISTS `tbl_lembur`;

CREATE TABLE `tbl_lembur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idkaryawan` int(11) NOT NULL,
  `tahun` year(4) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `tanggal` date NOT NULL,
  `updatex` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_lembur` */

insert  into `tbl_lembur`(`id`,`idkaryawan`,`tahun`,`bulan`,`tanggal`,`updatex`) values (1,62,2016,'12','2016-12-16','kasir 2016-12-16 20:24:19 192.168.43.118 ALEX-RG');
insert  into `tbl_lembur`(`id`,`idkaryawan`,`tahun`,`bulan`,`tanggal`,`updatex`) values (2,60,2017,'01','2017-01-16','kasir 2016-12-16 20:24:45 192.168.43.118 ALEX-RG');
insert  into `tbl_lembur`(`id`,`idkaryawan`,`tahun`,`bulan`,`tanggal`,`updatex`) values (3,58,2016,'12','2016-12-15','pic 2016-12-16 20:43:56 192.168.43.118 ALEX-RG');
insert  into `tbl_lembur`(`id`,`idkaryawan`,`tahun`,`bulan`,`tanggal`,`updatex`) values (4,60,2017,'01','2017-01-01','alex 2017-01-13 21:07:30 192.168.43.118 ALEX-RG');
insert  into `tbl_lembur`(`id`,`idkaryawan`,`tahun`,`bulan`,`tanggal`,`updatex`) values (7,63,2017,'01','2017-01-09','alex 2017-02-09 20:35:59 192.168.43.118 ALEX-RG');
insert  into `tbl_lembur`(`id`,`idkaryawan`,`tahun`,`bulan`,`tanggal`,`updatex`) values (8,58,2017,'01','2017-01-27','ALEX 2017-02-27 19:30:54 192.168.43.118 ALEX-RG');

/*Table structure for table `tbl_masterbarang` */

DROP TABLE IF EXISTS `tbl_masterbarang`;

CREATE TABLE `tbl_masterbarang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kodebarang` varchar(20) NOT NULL,
  `namabarang` varchar(50) NOT NULL,
  `varian` varchar(50) NOT NULL,
  `warna` varchar(20) NOT NULL,
  `thnproduksi` int(4) NOT NULL,
  `noticehitam` double NOT NULL,
  `noticemerah` double NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `literawal` int(1) NOT NULL,
  `pic_user` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_masterbarang` */

insert  into `tbl_masterbarang`(`id`,`kodebarang`,`namabarang`,`varian`,`warna`,`thnproduksi`,`noticehitam`,`noticemerah`,`satuan`,`literawal`,`pic_user`) values (3,'H5436-344-KD-AT','HONDA VARIO','LIMITED EDITION','PUTIH',2015,1555000,1252000,'UNIT',1,'alex');
insert  into `tbl_masterbarang`(`id`,`kodebarang`,`namabarang`,`varian`,`warna`,`thnproduksi`,`noticehitam`,`noticemerah`,`satuan`,`literawal`,`pic_user`) values (4,'H5WX-332-FT-AT','HONDA REVO','REVO RACING','MERAH MAROON',2015,1555000,1252000,'UNIT',1,'alex');
insert  into `tbl_masterbarang`(`id`,`kodebarang`,`namabarang`,`varian`,`warna`,`thnproduksi`,`noticehitam`,`noticemerah`,`satuan`,`literawal`,`pic_user`) values (6,'H5012-1111-KD-MT','HONDA CB 150 R','REPSOL SERIES','ORANGE',2016,1555000,1252000,'UNIT',2,'alex');
insert  into `tbl_masterbarang`(`id`,`kodebarang`,`namabarang`,`varian`,`warna`,`thnproduksi`,`noticehitam`,`noticemerah`,`satuan`,`literawal`,`pic_user`) values (7,'H5436-344-BTH-AT','BEAT POP','POP ART','HITAM',2016,1555000,1252000,'UNIT',1,'alex');
insert  into `tbl_masterbarang`(`id`,`kodebarang`,`namabarang`,`varian`,`warna`,`thnproduksi`,`noticehitam`,`noticemerah`,`satuan`,`literawal`,`pic_user`) values (8,'H5436-344-BTP-AT','BEAT POP','POP ART','PUTIH',2016,1555000,1252000,'UNIT',1,'alex');
insert  into `tbl_masterbarang`(`id`,`kodebarang`,`namabarang`,`varian`,`warna`,`thnproduksi`,`noticehitam`,`noticemerah`,`satuan`,`literawal`,`pic_user`) values (9,'H4212-316-MPH-MT','HONDA MEGA PRO','SPECIAL EDITION','HITAM',2016,1555000,1252000,'UNIT',2,'ALEX');
insert  into `tbl_masterbarang`(`id`,`kodebarang`,`namabarang`,`varian`,`warna`,`thnproduksi`,`noticehitam`,`noticemerah`,`satuan`,`literawal`,`pic_user`) values (10,'QQ','QQ','QQ','QQ',2017,1555000,1252000,'UNIT',1,'pic');
insert  into `tbl_masterbarang`(`id`,`kodebarang`,`namabarang`,`varian`,`warna`,`thnproduksi`,`noticehitam`,`noticemerah`,`satuan`,`literawal`,`pic_user`) values (11,'H453A-566-CBR-MT','HONDA CBR 250 CC','REPSOL SERIES','ORANGE',2017,1555000,1252000,'UNIT',2,'ALEX');
insert  into `tbl_masterbarang`(`id`,`kodebarang`,`namabarang`,`varian`,`warna`,`thnproduksi`,`noticehitam`,`noticemerah`,`satuan`,`literawal`,`pic_user`) values (12,'NF12A1CF M/T','SUPRA X ','HELM IN','HITAM',2017,1555000,1252000,'UNIT',1,'alex');
insert  into `tbl_masterbarang`(`id`,`kodebarang`,`namabarang`,`varian`,`warna`,`thnproduksi`,`noticehitam`,`noticemerah`,`satuan`,`literawal`,`pic_user`) values (13,'NF11B2D1 M/T','REVI FIT','-','HITAM',2017,1555000,1252000,'UNIT',1,'alex');
insert  into `tbl_masterbarang`(`id`,`kodebarang`,`namabarang`,`varian`,`warna`,`thnproduksi`,`noticehitam`,`noticemerah`,`satuan`,`literawal`,`pic_user`) values (14,'NF11C1CD M/T','NEW BLADE','S','PUTIH',2017,1153000,1252000,'UNIT',1,'alex');

/*Table structure for table `tbl_notabeli` */

DROP TABLE IF EXISTS `tbl_notabeli`;

CREATE TABLE `tbl_notabeli` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nonota` varchar(20) NOT NULL,
  `tahun` year(4) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `tglnota` date NOT NULL,
  `nodo` varchar(20) NOT NULL,
  `tgldo` date NOT NULL,
  `nopo` varchar(20) NOT NULL,
  `tglpo` date NOT NULL,
  `memo` varchar(255) NOT NULL,
  `qty` varchar(20) NOT NULL,
  `grandtotal` varchar(20) NOT NULL,
  `grandtotalppn` varchar(20) NOT NULL,
  `gtbayar` varchar(20) NOT NULL,
  `gtbayarppn` varchar(20) NOT NULL,
  `bayar` varchar(20) NOT NULL,
  `tglbayar` date NOT NULL,
  `status` int(1) NOT NULL,
  `scan` int(1) NOT NULL,
  `iduser` int(11) NOT NULL,
  `ikesalahanacc` int(1) NOT NULL,
  `inputx` datetime NOT NULL,
  `updatex` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_notabeli` */

insert  into `tbl_notabeli`(`id`,`nonota`,`tahun`,`bulan`,`tglnota`,`nodo`,`tgldo`,`nopo`,`tglpo`,`memo`,`qty`,`grandtotal`,`grandtotalppn`,`gtbayar`,`gtbayarppn`,`bayar`,`tglbayar`,`status`,`scan`,`iduser`,`ikesalahanacc`,`inputx`,`updatex`) values (1,'NB1170508-001',2017,'05','2017-05-08','DO201705080121','2017-05-08','NS00213','2017-05-08','','3','33765000','3376500','33765000','3376500','37200000','2017-05-08',1,1,39,0,'2017-05-08 11:41:09','ALEX 2017-05-08 13:56:28 127.0.0.1 ARIEF-LT');

/*Table structure for table `tbl_notabeli_det` */

DROP TABLE IF EXISTS `tbl_notabeli_det`;

CREATE TABLE `tbl_notabeli_det` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nonota` varchar(20) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `norangka` varchar(50) NOT NULL,
  `nomesin` varchar(20) NOT NULL,
  `hargabelibersih` varchar(20) NOT NULL,
  `qty` varchar(4) NOT NULL,
  `total` varchar(20) NOT NULL,
  `ppn` varchar(20) NOT NULL,
  `status` int(1) NOT NULL,
  `tgltiba` date NOT NULL,
  `idgudang` int(11) NOT NULL,
  `ikesalahan` int(1) NOT NULL,
  PRIMARY KEY (`id`,`norangka`,`nomesin`),
  UNIQUE KEY `id` (`id`,`norangka`,`nomesin`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_notabeli_det` */

insert  into `tbl_notabeli_det`(`id`,`nonota`,`idbarang`,`norangka`,`nomesin`,`hargabelibersih`,`qty`,`total`,`ppn`,`status`,`tgltiba`,`idgudang`,`ikesalahan`) values (1,'NB1170508-001',7,'RANGKA001','MESIN001','11255000','1','','1125500',1,'2017-05-08',2,0);
insert  into `tbl_notabeli_det`(`id`,`nonota`,`idbarang`,`norangka`,`nomesin`,`hargabelibersih`,`qty`,`total`,`ppn`,`status`,`tgltiba`,`idgudang`,`ikesalahan`) values (2,'NB1170508-001',7,'RANGKA002','MESIN002','11255000','1','','1125500',1,'2017-05-08',2,0);
insert  into `tbl_notabeli_det`(`id`,`nonota`,`idbarang`,`norangka`,`nomesin`,`hargabelibersih`,`qty`,`total`,`ppn`,`status`,`tgltiba`,`idgudang`,`ikesalahan`) values (3,'NB1170508-001',7,'RANGKA003','MESIN003','11255000','1','','1125500',1,'2017-05-08',2,0);

/*Table structure for table `tbl_notajual` */

DROP TABLE IF EXISTS `tbl_notajual`;

CREATE TABLE `tbl_notajual` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nonota` varchar(20) NOT NULL,
  `nopdi` varchar(20) NOT NULL,
  `nopesan` varchar(20) NOT NULL,
  `idsales` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `iduserpdi` int(11) NOT NULL,
  `iduseradm` int(11) NOT NULL,
  `idpelanggan` int(11) NOT NULL,
  `jnstransaksi` varchar(20) NOT NULL,
  `jnscashtempo` varchar(20) NOT NULL,
  `tnkb` varchar(20) NOT NULL,
  `tglpelunasan` date NOT NULL,
  `idleasing` int(11) NOT NULL,
  `angsuran` varchar(20) NOT NULL,
  `termin` varchar(11) NOT NULL,
  `tahun` year(4) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `tglnota` date NOT NULL,
  `hargabelibersih` varchar(22) NOT NULL,
  `totr` varchar(22) NOT NULL,
  `tdisc` varchar(22) NOT NULL,
  `utitipan` varchar(22) NOT NULL,
  `ppn` varchar(22) NOT NULL,
  `sisabayar` varchar(22) NOT NULL,
  `bayar` varchar(22) NOT NULL,
  `laba` varchar(22) NOT NULL,
  `tjual_plus_ppnbeli` varchar(22) NOT NULL,
  `tppnjual_min_ppnbeli` varchar(22) NOT NULL,
  `status` int(1) NOT NULL,
  `cekfisik` int(1) NOT NULL,
  `adm` int(1) NOT NULL,
  `ketreject` varchar(100) NOT NULL,
  `inputx` datetime NOT NULL,
  `updatex` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_notajual` */

/*Table structure for table `tbl_notajual_det` */

DROP TABLE IF EXISTS `tbl_notajual_det`;

CREATE TABLE `tbl_notajual_det` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nonota` varchar(20) NOT NULL,
  `nopesan` varchar(20) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `norangka` varchar(20) NOT NULL,
  `otr` varchar(22) NOT NULL,
  `disc` varchar(22) NOT NULL,
  `ppnjual` varchar(22) NOT NULL,
  `hargabeli` varchar(22) NOT NULL,
  `ppnbeli` varchar(22) NOT NULL,
  `jual_plus_ppnbeli` varchar(22) NOT NULL,
  `ppnjual_min_ppnbeli` varchar(22) NOT NULL,
  `jumlah1` varchar(22) NOT NULL,
  `otrsetelahpajak` varchar(22) NOT NULL,
  `bbn` varchar(22) NOT NULL,
  `offtheroad` varchar(22) NOT NULL,
  `gross` varchar(22) NOT NULL,
  `matrix` varchar(22) NOT NULL,
  `matrix1` varchar(22) NOT NULL,
  `matrix2` varchar(22) NOT NULL,
  `matrixpajak` varchar(22) NOT NULL,
  `subsidi` varchar(22) NOT NULL,
  `subsidi1` varchar(22) NOT NULL,
  `subsidi2` varchar(22) NOT NULL,
  `subsidipajak` varchar(22) NOT NULL,
  `scpahm` varchar(22) NOT NULL,
  `scpmd` varchar(22) NOT NULL,
  `komisi` varchar(22) NOT NULL,
  `ref` varchar(40) NOT NULL,
  `notelpref` varchar(20) NOT NULL,
  `statuskomisi` int(1) NOT NULL,
  `kwitansicb` varchar(20) NOT NULL,
  `tglbayarkomisi` date NOT NULL,
  `jumlah` varchar(22) NOT NULL,
  `jaket` varchar(10) NOT NULL,
  `bukuservice` varchar(10) NOT NULL,
  `statusleasing` varchar(20) NOT NULL,
  `statusbbn` varchar(20) NOT NULL,
  `bayarotr` varchar(22) NOT NULL,
  `tglotr` date NOT NULL,
  `statusotr` int(1) NOT NULL,
  `bayargross` varchar(22) NOT NULL,
  `tglgross` date NOT NULL,
  `statusgross` int(1) NOT NULL,
  `bayarsubsidi` varchar(22) NOT NULL,
  `tglsubsidi` date NOT NULL,
  `statussubsidi` int(1) NOT NULL,
  `bayarmatrix` varchar(22) NOT NULL,
  `tglmatrix` date NOT NULL,
  `statusmatrix` int(1) NOT NULL,
  `bayarscpahm` varchar(22) NOT NULL,
  `tglscpahm` date NOT NULL,
  `statusscpahm` int(1) NOT NULL,
  `bayarscpmd` varchar(22) NOT NULL,
  `tglscpmd` date NOT NULL,
  `statusscpmd` int(1) NOT NULL,
  `tgltagihanls` date NOT NULL,
  `statustagihanls` int(1) NOT NULL,
  `tambahlain` varchar(20) NOT NULL,
  `kuranglain` varchar(22) NOT NULL,
  `tgltambahlain` date NOT NULL,
  `tglkuranglain` date NOT NULL,
  `kettambahlain` varchar(400) NOT NULL,
  `ketkuranglain` varchar(400) NOT NULL,
  `tglsampai` date NOT NULL,
  `jamsampai` time NOT NULL,
  `photo` varchar(100) NOT NULL,
  `ikesalahan` int(1) NOT NULL,
  `updatex` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_notajual_det` */

/*Table structure for table `tbl_opname` */

DROP TABLE IF EXISTS `tbl_opname`;

CREATE TABLE `tbl_opname` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` year(4) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `tanggal` date NOT NULL,
  `idgudang` int(11) NOT NULL,
  `stok` varchar(11) NOT NULL,
  `scan` varchar(11) NOT NULL,
  `sisa` varchar(11) NOT NULL,
  `totjumselisih` varchar(24) NOT NULL,
  `iduser` int(11) NOT NULL,
  `user` varchar(20) NOT NULL,
  `status` int(1) NOT NULL,
  `inputx` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_opname` */

/*Table structure for table `tbl_opname_det` */

DROP TABLE IF EXISTS `tbl_opname_det`;

CREATE TABLE `tbl_opname_det` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idopname` varchar(20) NOT NULL,
  `norangka` varchar(30) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_opname_det` */

/*Table structure for table `tbl_pelanggan` */

DROP TABLE IF EXISTS `tbl_pelanggan`;

CREATE TABLE `tbl_pelanggan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(200) NOT NULL,
  `ohc` varchar(20) NOT NULL,
  `kadaluarsaohc` date NOT NULL,
  `notelepon` varchar(15) NOT NULL,
  `noktp` varchar(20) NOT NULL,
  `alamat` varchar(400) NOT NULL,
  `rt` varchar(4) NOT NULL,
  `rw` varchar(4) NOT NULL,
  `kodekab` varchar(2) NOT NULL,
  `namakab` varchar(40) NOT NULL,
  `kodekec` varchar(2) NOT NULL,
  `namakec` varchar(40) NOT NULL,
  `kodekel` varchar(2) NOT NULL,
  `namakel` varchar(40) NOT NULL,
  `kodealamat` varchar(10) NOT NULL,
  `email` varchar(40) NOT NULL,
  `pekerjaan` varchar(40) NOT NULL,
  `grup` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pelanggan` */

insert  into `tbl_pelanggan`(`id`,`nama`,`ohc`,`kadaluarsaohc`,`notelepon`,`noktp`,`alamat`,`rt`,`rw`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`,`kodealamat`,`email`,`pekerjaan`,`grup`) values (3,'AZIGHA FATHYUKI SASTA','H85645212','2017-01-01','08123544511','8812134452200002','JL. PRAMUKA NO.23','04','01','BK','BANGKALAN','10','KONANG','10','KONANG','BK.10.10','azigha@ymail.com','MAHASISWA',0);
insert  into `tbl_pelanggan`(`id`,`nama`,`ohc`,`kadaluarsaohc`,`notelepon`,`noktp`,`alamat`,`rt`,`rw`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`,`kodealamat`,`email`,`pekerjaan`,`grup`) values (4,'SRI MULYANI','','0000-00-00','08569874541','22155412100001','JL. IKAN TENGGIRI','02','01','BK','BANGKALAN','17','TANJUNGBUMI','02','BANDANG DAYAH','BK.17.02','sri@yahoo.com','IBU RUMAH TANGGA',0);
insert  into `tbl_pelanggan`(`id`,`nama`,`ohc`,`kadaluarsaohc`,`notelepon`,`noktp`,`alamat`,`rt`,`rw`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`,`kodealamat`,`email`,`pekerjaan`,`grup`) values (5,'IKHTIAR RIZKI','123123','2016-10-28','085454441221','0211321000210001','JL. IKAN MAS NO.23','01','01','BK','BANGKALAN','14','SEPULU','02','BANYIOR','BK.14.02','didikkjpp@gmail.com','KARYAWAN SWASTA',0);
insert  into `tbl_pelanggan`(`id`,`nama`,`ohc`,`kadaluarsaohc`,`notelepon`,`noktp`,`alamat`,`rt`,`rw`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`,`kodealamat`,`email`,`pekerjaan`,`grup`) values (6,'RATNAWATI GUNAWAN','H85645211','2018-03-12','081278955423','8812134452200001','JL BELUT SUNGAI NO. 123','01','01','BK','BANGKALAN','03','BLEGA','17','PANGERAN GEDUNGAN (GADUNGAN)','BK.03.17','ratnacute@gmail.com','IRT',0);
insert  into `tbl_pelanggan`(`id`,`nama`,`ohc`,`kadaluarsaohc`,`notelepon`,`noktp`,`alamat`,`rt`,`rw`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`,`kodealamat`,`email`,`pekerjaan`,`grup`) values (7,'ALWI SUNKONO','H85645213','2017-12-01','081278955422','8812134452200003','DESA SUKA KEMANA SAJA','04','01','BK','BANGKALAN','04','BURNEH','02','AROK','BK.04.','alwiganteng@ymail.com','GURU',0);
insert  into `tbl_pelanggan`(`id`,`nama`,`ohc`,`kadaluarsaohc`,`notelepon`,`noktp`,`alamat`,`rt`,`rw`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`,`kodealamat`,`email`,`pekerjaan`,`grup`) values (9,'AGUNG HERCULES','H399999','2017-12-05','081235445115','8812134452200007','FDGD','04','01','BK','BANGKALAN','02','BANGKALAN','05','DEMANGAN','BK.02.05','agung1231@yahoo.com','PETANI',0);
insert  into `tbl_pelanggan`(`id`,`nama`,`ohc`,`kadaluarsaohc`,`notelepon`,`noktp`,`alamat`,`rt`,`rw`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`,`kodealamat`,`email`,`pekerjaan`,`grup`) values (10,'CHARLES HITAGALUNG','','0000-00-00','085751112121','8812134452740002','DESA KARIMUN JAWA','02','02','BK','BANGKALAN','02','BANGKALAN','01','BANCARAN','BK.02.01','charles@gmail.com','GURU',0);
insert  into `tbl_pelanggan`(`id`,`nama`,`ohc`,`kadaluarsaohc`,`notelepon`,`noktp`,`alamat`,`rt`,`rw`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`,`kodealamat`,`email`,`pekerjaan`,`grup`) values (11,'HENDRO SUROTOMO','H85645220','0000-00-00','081235451110','88121312312200002','JL. SEKALI SEUMUR HIDUP','02','02','BK','BANGKALAN','04','BURNEH','02','AROK','BK.04.02','','PEGAWAI NEGRI',0);
insert  into `tbl_pelanggan`(`id`,`nama`,`ohc`,`kadaluarsaohc`,`notelepon`,`noktp`,`alamat`,`rt`,`rw`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`,`kodealamat`,`email`,`pekerjaan`,`grup`) values (12,'TRI ANDAYANI','','0000-00-00','01','01','JALI JALI','1','2','BK','BANGKALAN','02','BANGKALAN','05','DEMANGAN','BK.02.05','jali@jali.jali','IBU RUMAH TANGGA',0);
insert  into `tbl_pelanggan`(`id`,`nama`,`ohc`,`kadaluarsaohc`,`notelepon`,`noktp`,`alamat`,`rt`,`rw`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`,`kodealamat`,`email`,`pekerjaan`,`grup`) values (13,'SUHAIMI','H85645215','2017-12-12','087812312382','02348723438380002','JL. DIHATIKU','01','01','BK','BANGKALAN','08','KLAMPIS','06','KARANG ASEM','BK.08.06','','KARYAWAN SWASRA',0);
insert  into `tbl_pelanggan`(`id`,`nama`,`ohc`,`kadaluarsaohc`,`notelepon`,`noktp`,`alamat`,`rt`,`rw`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`,`kodealamat`,`email`,`pekerjaan`,`grup`) values (14,'SUPRAN HELMI','','0000-00-00','0815123212111','8812134455200004','JL. UIKAN PAUS NO. 42','03','01','BK','BANGKALAN','12','LABANG','11','SENDANG LAOK','BK.12.11','helmi@lautanindah.co.id','KARYAWAN SWASTA',0);
insert  into `tbl_pelanggan`(`id`,`nama`,`ohc`,`kadaluarsaohc`,`notelepon`,`noktp`,`alamat`,`rt`,`rw`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`,`kodealamat`,`email`,`pekerjaan`,`grup`) values (15,'SURYA SAPUTRA','','2015-01-01','0578787742112','0213542121212100001','JL. RAWA SUBUR NO. 25 BELAKANG RUMAH SAKIT IBU DAN ANAK ANUGRAH MEDIKA ','001','001','PM','PAMEKASAN','3','KADUR','3','GAGAH','PM.3.3','cutlist@gmail.com','KARYAWAN SWASTA + WIRASWASTA',0);
insert  into `tbl_pelanggan`(`id`,`nama`,`ohc`,`kadaluarsaohc`,`notelepon`,`noktp`,`alamat`,`rt`,`rw`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`,`kodealamat`,`email`,`pekerjaan`,`grup`) values (16,'ASEP IRAMA','','0000-00-00','0854542211121','0213542121212100002','BELAKAN SDN 1 SUKARAME, PAGAR HITAM GENTENG MERAH CET TEMBOK PUTIH ADA KUNINGNYA SEDIKIT DI BAGIAN SAMPING KIRI DEKET JENDELA','001','','BK','BANGKALAN','16','TANAH MERAH','17','PETRAH','BK.16.17','','PEDANGANG MUSIMAN AJA',0);
insert  into `tbl_pelanggan`(`id`,`nama`,`ohc`,`kadaluarsaohc`,`notelepon`,`noktp`,`alamat`,`rt`,`rw`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`,`kodealamat`,`email`,`pekerjaan`,`grup`) values (17,'SAPTO MANUNGGAL','','0000-00-00','085685112154','0211321000220001','JL. KAPAL TERBANG F11','001','001','BK','BANGKALAN','16','TANAH MERAH','16','PATEMON','BK.16.16','','MAHASISWA',0);
insert  into `tbl_pelanggan`(`id`,`nama`,`ohc`,`kadaluarsaohc`,`notelepon`,`noktp`,`alamat`,`rt`,`rw`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`,`kodealamat`,`email`,`pekerjaan`,`grup`) values (18,'WERAWER','','0000-00-00','2312513234123','231231241231','ADAD FASDFAERWE AWER','','','SU','SUMENEP','16','KOTA SUMENEP','17','PARSANGA','SU.16.17','adaer@wddf.dfs','ER223R3R3R',0);
insert  into `tbl_pelanggan`(`id`,`nama`,`ohc`,`kadaluarsaohc`,`notelepon`,`noktp`,`alamat`,`rt`,`rw`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`,`kodealamat`,`email`,`pekerjaan`,`grup`) values (19,'SUMENEP','','0000-00-00','','','JL. SANTAI KETIKA SORE HARI','001','001','SU','SUMENEP','16','KOTA SUMENEP','17','PARSANGA','SU.16.17','','',1);
insert  into `tbl_pelanggan`(`id`,`nama`,`ohc`,`kadaluarsaohc`,`notelepon`,`noktp`,`alamat`,`rt`,`rw`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`,`kodealamat`,`email`,`pekerjaan`,`grup`) values (20,'BANGKALAN','','0000-00-00','','','JL. DIHATIKU','01','01','BK','BANGKALAN','08','KLAMPIS','06','KARANG ASEM','BK.08.06','','',1);
insert  into `tbl_pelanggan`(`id`,`nama`,`ohc`,`kadaluarsaohc`,`notelepon`,`noktp`,`alamat`,`rt`,`rw`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`,`kodealamat`,`email`,`pekerjaan`,`grup`) values (23,'TESTTES','','0000-00-00','123132','123131','123132','','','PM','PAMEKASAN','02','GALIS','02','BULAY','PM.02.02','','12313',0);
insert  into `tbl_pelanggan`(`id`,`nama`,`ohc`,`kadaluarsaohc`,`notelepon`,`noktp`,`alamat`,`rt`,`rw`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`,`kodealamat`,`email`,`pekerjaan`,`grup`) values (24,'TESSS','12313232','2022-03-12','1232323','12313','12323','','','PM','PAMEKASAN','03','KADUR','04','KADUR','PM.03.04','','43434344',0);
insert  into `tbl_pelanggan`(`id`,`nama`,`ohc`,`kadaluarsaohc`,`notelepon`,`noktp`,`alamat`,`rt`,`rw`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`,`kodealamat`,`email`,`pekerjaan`,`grup`) values (25,'AXSAXAS','','0000-00-00','2131','213','QWDQW','','','BK','BANGKALAN','16','TANAH MERAH','14','PADURUNGAN','BK.16.14','','DSAD',0);
insert  into `tbl_pelanggan`(`id`,`nama`,`ohc`,`kadaluarsaohc`,`notelepon`,`noktp`,`alamat`,`rt`,`rw`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`,`kodealamat`,`email`,`pekerjaan`,`grup`) values (26,'QWERTY','','1988-12-12','12312312313','13123321312','DSFASDFASDF','','','PM','PAMEKASAN','04','LARANGAN','06','LARANGAN DALAM','PM.04.06','','POLISI',0);
insert  into `tbl_pelanggan`(`id`,`nama`,`ohc`,`kadaluarsaohc`,`notelepon`,`noktp`,`alamat`,`rt`,`rw`,`kodekab`,`namakab`,`kodekec`,`namakec`,`kodekel`,`namakel`,`kodealamat`,`email`,`pekerjaan`,`grup`) values (27,'WITONI','','0000-00-00','123','123','123','001','002','SU','SUMENEP','16','KOTA SUMENEP','01','PAMOLOKAN','SU.16.01','','TANI',0);

/*Table structure for table `tbl_pengeluaranunit` */

DROP TABLE IF EXISTS `tbl_pengeluaranunit`;

CREATE TABLE `tbl_pengeluaranunit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` year(4) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `tanggal` date NOT NULL,
  `nonota` varchar(20) NOT NULL,
  `nosj` varchar(20) NOT NULL,
  `user` int(11) NOT NULL,
  `namaambilstkn1` varchar(40) NOT NULL,
  `tlpambilstkn1` varchar(20) NOT NULL,
  `namaambilstkn2` varchar(40) NOT NULL,
  `tlpambilstkn2` varchar(20) NOT NULL,
  `namaambilbpkb` varchar(40) NOT NULL,
  `tlpambilbpkb` varchar(20) NOT NULL,
  `namaambilbpkb2` varchar(20) NOT NULL,
  `tlpambilbpkb2` varchar(20) NOT NULL,
  `penyerahan` varchar(20) NOT NULL,
  `angsuran` varchar(20) NOT NULL,
  `termin` varchar(10) NOT NULL,
  `tglsampai` date NOT NULL,
  `jamsampai` time NOT NULL,
  `status` int(1) NOT NULL,
  `inputx` datetime NOT NULL,
  `updatex` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengeluaranunit` */

/*Table structure for table `tbl_perusahaan` */

DROP TABLE IF EXISTS `tbl_perusahaan`;

CREATE TABLE `tbl_perusahaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `perusahaan` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamatperusahaan` varchar(200) NOT NULL,
  `kotaperusahaan` varchar(20) NOT NULL,
  `namacabang` varchar(100) NOT NULL,
  `kodedealer` varchar(20) NOT NULL,
  `kepalacabang` varchar(50) NOT NULL,
  `npwp` varchar(30) NOT NULL,
  `ppkp` varchar(30) NOT NULL,
  `alamatnpwp` varchar(200) NOT NULL,
  `kotanpwp` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_perusahaan` */

insert  into `tbl_perusahaan`(`id`,`perusahaan`,`nama`,`alamatperusahaan`,`kotaperusahaan`,`namacabang`,`kodedealer`,`kepalacabang`,`npwp`,`ppkp`,`alamatnpwp`,`kotanpwp`) values (1,'CV ANUGRAH JAYA','ANUGRAH JAYA','JL. IKAN TENGGIRI NO. 27','BANGKALAN','BANGKALAN','UHUA002A','ERI IMRON','1.2331.123.6774.2.61','-','JL. IKAN TENGGIRI NO. 27','BANGKALAN');

/*Table structure for table `tbl_pesanan` */

DROP TABLE IF EXISTS `tbl_pesanan`;

CREATE TABLE `tbl_pesanan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nopesan` varchar(20) NOT NULL,
  `tahun` year(4) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `tglpesan` date NOT NULL,
  `idsales` int(11) NOT NULL,
  `idpelanggan` int(11) NOT NULL,
  `jnstransaksi` varchar(20) NOT NULL,
  `jnscashtempo` varchar(20) NOT NULL,
  `tnkb` varchar(20) NOT NULL,
  `tglpelunasan` date NOT NULL DEFAULT '0000-00-00',
  `idleasing` int(11) NOT NULL,
  `termin` varchar(20) NOT NULL,
  `utitipan` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT '0',
  `batal` varchar(20) NOT NULL,
  `indent` int(1) NOT NULL,
  `inputx` datetime NOT NULL,
  `updatex` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pesanan` */

insert  into `tbl_pesanan`(`id`,`nopesan`,`tahun`,`bulan`,`tglpesan`,`idsales`,`idpelanggan`,`jnstransaksi`,`jnscashtempo`,`tnkb`,`tglpelunasan`,`idleasing`,`termin`,`utitipan`,`status`,`batal`,`indent`,`inputx`,`updatex`) values (1,'NP170508-001',2017,'05','2017-05-08',39,12,'CASH','','PLAT HITAM','0000-00-00',0,'','0','0','',0,'2017-05-08 15:47:29','ALEX 2017-05-08 15:47:29 127.0.0.1 ARIEF-LT');

/*Table structure for table `tbl_pesanan_det` */

DROP TABLE IF EXISTS `tbl_pesanan_det`;

CREATE TABLE `tbl_pesanan_det` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nopesan` varchar(20) NOT NULL,
  `idpelanggan` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `norangka` varchar(40) NOT NULL,
  `otr` varchar(22) NOT NULL,
  `disc` varchar(22) NOT NULL,
  `ppnjual` varchar(22) NOT NULL,
  `hargabeli` varchar(22) NOT NULL,
  `ppnbeli` varchar(22) NOT NULL,
  `jual_plus_ppnbeli` varchar(22) NOT NULL,
  `ppnjual_min_ppnbeli` varchar(22) NOT NULL,
  `jumlah1` varchar(22) NOT NULL,
  `otrsetelahpajak` varchar(22) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pesanan_det` */

insert  into `tbl_pesanan_det`(`id`,`nopesan`,`idpelanggan`,`idbarang`,`norangka`,`otr`,`disc`,`ppnjual`,`hargabeli`,`ppnbeli`,`jual_plus_ppnbeli`,`ppnjual_min_ppnbeli`,`jumlah1`,`otrsetelahpajak`) values (1,'NP170508-001',12,7,'','','','','','','','','','');

/*Table structure for table `tbl_pindah` */

DROP TABLE IF EXISTS `tbl_pindah`;

CREATE TABLE `tbl_pindah` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` year(4) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `tanggal` date NOT NULL,
  `idgudang1` int(11) NOT NULL,
  `idgudang2` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `iduser` int(11) NOT NULL,
  `user` varchar(20) NOT NULL,
  `inputx` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pindah` */

/*Table structure for table `tbl_pindah_det` */

DROP TABLE IF EXISTS `tbl_pindah_det`;

CREATE TABLE `tbl_pindah_det` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idpindah` int(11) NOT NULL,
  `norangka` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pindah_det` */

/*Table structure for table `tbl_piutang` */

DROP TABLE IF EXISTS `tbl_piutang`;

CREATE TABLE `tbl_piutang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis` varchar(20) NOT NULL,
  `idkaryawan` int(11) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `tgl` date NOT NULL,
  `jumlah` varchar(20) NOT NULL,
  `ket` varchar(100) NOT NULL,
  `metodebayar` varchar(20) NOT NULL,
  `status` int(1) NOT NULL,
  `potkompensasi` int(1) NOT NULL,
  `iduser` int(11) NOT NULL,
  `inputx` datetime NOT NULL,
  `updatex` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_piutang` */

/*Table structure for table `tbl_posisi` */

DROP TABLE IF EXISTS `tbl_posisi`;

CREATE TABLE `tbl_posisi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `posisi` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_posisi` */

insert  into `tbl_posisi`(`id`,`posisi`) values (1,'ADMINISTRATOR');
insert  into `tbl_posisi`(`id`,`posisi`) values (2,'SALES COUNTER');
insert  into `tbl_posisi`(`id`,`posisi`) values (3,'KASIR');
insert  into `tbl_posisi`(`id`,`posisi`) values (4,'ADMINISTRASI');
insert  into `tbl_posisi`(`id`,`posisi`) values (5,'GUDANG & PDI');
insert  into `tbl_posisi`(`id`,`posisi`) values (6,'DIREKSI');
insert  into `tbl_posisi`(`id`,`posisi`) values (7,'SALES');
insert  into `tbl_posisi`(`id`,`posisi`) values (8,'DRIVER');
insert  into `tbl_posisi`(`id`,`posisi`) values (9,'PIC');

/*Table structure for table `tbl_potkompensasi` */

DROP TABLE IF EXISTS `tbl_potkompensasi`;

CREATE TABLE `tbl_potkompensasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idkaryawan` int(11) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `tgl` date NOT NULL,
  `jumlah` varchar(20) NOT NULL,
  `ket` varchar(100) NOT NULL,
  `metodebayar` varchar(20) NOT NULL,
  `iduser` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `potkompensasi` int(1) NOT NULL,
  `inputx` datetime NOT NULL,
  `updatex` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_potkompensasi` */

insert  into `tbl_potkompensasi`(`id`,`idkaryawan`,`nama`,`tgl`,`jumlah`,`ket`,`metodebayar`,`iduser`,`status`,`potkompensasi`,`inputx`,`updatex`) values (1,58,'STAF ADMINISTRASI','2017-01-11','10000','1','TUNAI',39,1,0,'2017-01-11 16:23:02','alex 2017-01-14 20:53:39 192.168.43.118 ALEX-RG');
insert  into `tbl_potkompensasi`(`id`,`idkaryawan`,`nama`,`tgl`,`jumlah`,`ket`,`metodebayar`,`iduser`,`status`,`potkompensasi`,`inputx`,`updatex`) values (2,60,'STAF GUDANG PDI','2017-01-05','20000','2','TUNAI',39,1,0,'2017-01-11 16:23:24','ALEX 2017-02-20 21:22:50 192.168.43.118 ALEX-RG');
insert  into `tbl_potkompensasi`(`id`,`idkaryawan`,`nama`,`tgl`,`jumlah`,`ket`,`metodebayar`,`iduser`,`status`,`potkompensasi`,`inputx`,`updatex`) values (3,58,'STAF ADMINISTRASI','2017-01-11','333','3','GAJI',39,1,0,'2017-01-11 20:59:54','ALEX 2017-02-20 21:22:57 192.168.43.118 ALEX-RG');
insert  into `tbl_potkompensasi`(`id`,`idkaryawan`,`nama`,`tgl`,`jumlah`,`ket`,`metodebayar`,`iduser`,`status`,`potkompensasi`,`inputx`,`updatex`) values (5,61,'KEPALA TOKO','2017-01-11','1','1','GAJI',39,1,0,'2017-01-11 22:16:36','alex 2017-01-11 22:22:42 192.168.43.118 ALEX-RG');
insert  into `tbl_potkompensasi`(`id`,`idkaryawan`,`nama`,`tgl`,`jumlah`,`ket`,`metodebayar`,`iduser`,`status`,`potkompensasi`,`inputx`,`updatex`) values (8,61,'KEPALA TOKO','2017-01-11','1','2','TUNAI',39,1,0,'2017-01-11 22:20:21','alex 2017-01-11 22:25:42 192.168.43.118 ALEX-RG');
insert  into `tbl_potkompensasi`(`id`,`idkaryawan`,`nama`,`tgl`,`jumlah`,`ket`,`metodebayar`,`iduser`,`status`,`potkompensasi`,`inputx`,`updatex`) values (9,61,'KEPALA TOKO','2017-01-11','2','2','GAJI',39,1,0,'2017-01-11 22:22:04','alex 2017-01-11 22:22:58 192.168.43.118 ALEX-RG');
insert  into `tbl_potkompensasi`(`id`,`idkaryawan`,`nama`,`tgl`,`jumlah`,`ket`,`metodebayar`,`iduser`,`status`,`potkompensasi`,`inputx`,`updatex`) values (11,62,'STAF DRIVER','2017-01-12','500000','2','GAJI',39,0,0,'2017-01-12 14:39:51','alex 2017-01-12 14:39:51 127.0.0.1 ARIEF-LT');
insert  into `tbl_potkompensasi`(`id`,`idkaryawan`,`nama`,`tgl`,`jumlah`,`ket`,`metodebayar`,`iduser`,`status`,`potkompensasi`,`inputx`,`updatex`) values (14,61,'KEPALA TOKO','2017-01-13','1000000','TES','GAJI',39,1,0,'2017-01-13 20:55:38','alex 2017-01-13 20:59:47 192.168.43.118 ALEX-RG');

/*Table structure for table `tbl_prospek` */

DROP TABLE IF EXISTS `tbl_prospek`;

CREATE TABLE `tbl_prospek` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bulan` varchar(2) NOT NULL,
  `tahun` year(4) NOT NULL,
  `idpelanggan` int(11) NOT NULL,
  `idsales` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `inputx` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_prospek` */

insert  into `tbl_prospek`(`id`,`bulan`,`tahun`,`idpelanggan`,`idsales`,`status`,`inputx`) values (14,'03',2017,25,44,0,'ALEX 2017-03-10 20:58:49 192.168.43.118 ALEX-RG');
insert  into `tbl_prospek`(`id`,`bulan`,`tahun`,`idpelanggan`,`idsales`,`status`,`inputx`) values (15,'03',2017,26,45,0,'ALEX 2017-03-10 20:58:58 192.168.43.118 ALEX-RG');
insert  into `tbl_prospek`(`id`,`bulan`,`tahun`,`idpelanggan`,`idsales`,`status`,`inputx`) values (16,'03',2017,10,44,0,'ALEX 2017-03-10 20:59:29 192.168.43.118 ALEX-RG');
insert  into `tbl_prospek`(`id`,`bulan`,`tahun`,`idpelanggan`,`idsales`,`status`,`inputx`) values (19,'03',2017,3,44,0,'ALEX 2017-03-10 21:49:52 192.168.43.118 ALEX-RG');
insert  into `tbl_prospek`(`id`,`bulan`,`tahun`,`idpelanggan`,`idsales`,`status`,`inputx`) values (20,'03',2017,27,44,0,'ALEX 2017-03-10 21:57:40 192.168.43.118 ALEX-RG');
insert  into `tbl_prospek`(`id`,`bulan`,`tahun`,`idpelanggan`,`idsales`,`status`,`inputx`) values (21,'04',2017,27,44,0,'ALEX 2017-04-10 21:58:22 192.168.43.118 ALEX-RG');
insert  into `tbl_prospek`(`id`,`bulan`,`tahun`,`idpelanggan`,`idsales`,`status`,`inputx`) values (23,'04',2017,26,44,0,'ALEX 2017-04-10 22:11:54 192.168.43.118 ALEX-RG');

/*Table structure for table `tbl_returbeli` */

DROP TABLE IF EXISTS `tbl_returbeli`;

CREATE TABLE `tbl_returbeli` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `noretur` varchar(20) NOT NULL,
  `nodo` varchar(20) NOT NULL,
  `tahun` year(4) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `tanggal` date NOT NULL,
  `helm` varchar(11) NOT NULL,
  `spion` varchar(11) NOT NULL,
  `accu` varchar(11) NOT NULL,
  `toolkit` varchar(11) NOT NULL,
  `alaskaki` varchar(11) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `iduser` int(11) NOT NULL,
  `user` varchar(20) NOT NULL,
  `status` int(1) NOT NULL,
  `inputx` datetime NOT NULL,
  `updatex` varchar(100) NOT NULL,
  PRIMARY KEY (`id`,`noretur`),
  UNIQUE KEY `UNIQUE` (`noretur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_returbeli` */

/*Table structure for table `tbl_satuan` */

DROP TABLE IF EXISTS `tbl_satuan`;

CREATE TABLE `tbl_satuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `satuan` varchar(20) NOT NULL,
  `sub` varchar(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_satuan` */

insert  into `tbl_satuan`(`id`,`satuan`,`sub`) values (1,'Pasang','h2h3');
insert  into `tbl_satuan`(`id`,`satuan`,`sub`) values (2,'Pcs','h1');
insert  into `tbl_satuan`(`id`,`satuan`,`sub`) values (3,'Unit','h1');
insert  into `tbl_satuan`(`id`,`satuan`,`sub`) values (4,'Pcs','h2h3');

/*Table structure for table `tbl_stnkbpkb` */

DROP TABLE IF EXISTS `tbl_stnkbpkb`;

CREATE TABLE `tbl_stnkbpkb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nonota` varchar(20) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `norangka` varchar(40) NOT NULL,
  `stckselesai` date NOT NULL,
  `stckdiambil` date NOT NULL,
  `stckpengambil` varchar(40) NOT NULL,
  `krmstnkesmsat` date NOT NULL,
  `noticeselesai` date NOT NULL,
  `nopol` varchar(20) NOT NULL,
  `nostnk` varchar(20) NOT NULL,
  `stnkselesai` date NOT NULL,
  `stnkdiambil` date NOT NULL,
  `stnkpengambil` varchar(40) NOT NULL,
  `bpkbselesai` date NOT NULL,
  `nobpkb` varchar(20) NOT NULL,
  `bpkbdiambil` date NOT NULL,
  `bpkbpengambil` varchar(40) NOT NULL,
  `updatex` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_stnkbpkb` */

/*Table structure for table `tbl_stokunit` */

DROP TABLE IF EXISTS `tbl_stokunit`;

CREATE TABLE `tbl_stokunit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` varchar(4) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `tgltiba` date NOT NULL,
  `idgudang` int(11) NOT NULL,
  `nonota` varchar(20) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `norangka` varchar(20) NOT NULL,
  `nomesin` varchar(20) NOT NULL,
  `hargabelibersih` varchar(20) NOT NULL,
  `ppn` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `inputx` datetime NOT NULL,
  `iduser` int(11) NOT NULL,
  `updatex` varchar(100) NOT NULL,
  PRIMARY KEY (`id`,`norangka`,`nomesin`),
  UNIQUE KEY `id` (`id`,`norangka`,`nomesin`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_stokunit` */

insert  into `tbl_stokunit`(`id`,`tahun`,`bulan`,`tgltiba`,`idgudang`,`nonota`,`idbarang`,`norangka`,`nomesin`,`hargabelibersih`,`ppn`,`status`,`inputx`,`iduser`,`updatex`) values (1,'2017','05','2017-05-08',2,'NB1170508-001',7,'RANGKA001','MESIN001','11255000','1125500','STOK','2017-05-08 12:29:18',39,'ALEX 2017-05-08 12:29:18 127.0.0.1 ARIEF-LT');
insert  into `tbl_stokunit`(`id`,`tahun`,`bulan`,`tgltiba`,`idgudang`,`nonota`,`idbarang`,`norangka`,`nomesin`,`hargabelibersih`,`ppn`,`status`,`inputx`,`iduser`,`updatex`) values (2,'2017','05','2017-05-08',2,'NB1170508-001',7,'RANGKA002','MESIN002','11255000','1125500','STOK','2017-05-08 12:29:18',39,'ALEX 2017-05-08 12:29:18 127.0.0.1 ARIEF-LT');
insert  into `tbl_stokunit`(`id`,`tahun`,`bulan`,`tgltiba`,`idgudang`,`nonota`,`idbarang`,`norangka`,`nomesin`,`hargabelibersih`,`ppn`,`status`,`inputx`,`iduser`,`updatex`) values (3,'2017','05','2017-05-08',2,'NB1170508-001',7,'RANGKA003','MESIN003','11255000','1125500','STOK','2017-05-08 12:29:18',39,'ALEX 2017-05-08 12:29:18 127.0.0.1 ARIEF-LT');

/*Table structure for table `tbl_tahun` */

DROP TABLE IF EXISTS `tbl_tahun`;

CREATE TABLE `tbl_tahun` (
  `tahun` varchar(4) NOT NULL,
  PRIMARY KEY (`tahun`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_tahun` */

insert  into `tbl_tahun`(`tahun`) values ('2000');
insert  into `tbl_tahun`(`tahun`) values ('2001');
insert  into `tbl_tahun`(`tahun`) values ('2002');
insert  into `tbl_tahun`(`tahun`) values ('2003');
insert  into `tbl_tahun`(`tahun`) values ('2004');
insert  into `tbl_tahun`(`tahun`) values ('2005');
insert  into `tbl_tahun`(`tahun`) values ('2006');
insert  into `tbl_tahun`(`tahun`) values ('2007');
insert  into `tbl_tahun`(`tahun`) values ('2008');
insert  into `tbl_tahun`(`tahun`) values ('2009');
insert  into `tbl_tahun`(`tahun`) values ('2010');
insert  into `tbl_tahun`(`tahun`) values ('2011');
insert  into `tbl_tahun`(`tahun`) values ('2012');
insert  into `tbl_tahun`(`tahun`) values ('2013');
insert  into `tbl_tahun`(`tahun`) values ('2014');
insert  into `tbl_tahun`(`tahun`) values ('2015');
insert  into `tbl_tahun`(`tahun`) values ('2016');
insert  into `tbl_tahun`(`tahun`) values ('2017');
insert  into `tbl_tahun`(`tahun`) values ('2018');
insert  into `tbl_tahun`(`tahun`) values ('2019');
insert  into `tbl_tahun`(`tahun`) values ('2020');
insert  into `tbl_tahun`(`tahun`) values ('2021');
insert  into `tbl_tahun`(`tahun`) values ('2022');
insert  into `tbl_tahun`(`tahun`) values ('2023');
insert  into `tbl_tahun`(`tahun`) values ('2024');
insert  into `tbl_tahun`(`tahun`) values ('2025');
insert  into `tbl_tahun`(`tahun`) values ('2026');
insert  into `tbl_tahun`(`tahun`) values ('2027');
insert  into `tbl_tahun`(`tahun`) values ('2028');
insert  into `tbl_tahun`(`tahun`) values ('2029');
insert  into `tbl_tahun`(`tahun`) values ('2030');
insert  into `tbl_tahun`(`tahun`) values ('2031');
insert  into `tbl_tahun`(`tahun`) values ('2032');
insert  into `tbl_tahun`(`tahun`) values ('2033');
insert  into `tbl_tahun`(`tahun`) values ('2034');
insert  into `tbl_tahun`(`tahun`) values ('2035');
insert  into `tbl_tahun`(`tahun`) values ('2036');
insert  into `tbl_tahun`(`tahun`) values ('2037');
insert  into `tbl_tahun`(`tahun`) values ('2038');
insert  into `tbl_tahun`(`tahun`) values ('2039');
insert  into `tbl_tahun`(`tahun`) values ('2040');
insert  into `tbl_tahun`(`tahun`) values ('2041');
insert  into `tbl_tahun`(`tahun`) values ('2042');
insert  into `tbl_tahun`(`tahun`) values ('2043');
insert  into `tbl_tahun`(`tahun`) values ('2044');
insert  into `tbl_tahun`(`tahun`) values ('2045');
insert  into `tbl_tahun`(`tahun`) values ('2046');
insert  into `tbl_tahun`(`tahun`) values ('2047');
insert  into `tbl_tahun`(`tahun`) values ('2048');
insert  into `tbl_tahun`(`tahun`) values ('2049');
insert  into `tbl_tahun`(`tahun`) values ('2050');
insert  into `tbl_tahun`(`tahun`) values ('2051');
insert  into `tbl_tahun`(`tahun`) values ('2052');
insert  into `tbl_tahun`(`tahun`) values ('2053');
insert  into `tbl_tahun`(`tahun`) values ('2054');
insert  into `tbl_tahun`(`tahun`) values ('2055');
insert  into `tbl_tahun`(`tahun`) values ('2056');
insert  into `tbl_tahun`(`tahun`) values ('2057');
insert  into `tbl_tahun`(`tahun`) values ('2058');
insert  into `tbl_tahun`(`tahun`) values ('2059');
insert  into `tbl_tahun`(`tahun`) values ('2060');
insert  into `tbl_tahun`(`tahun`) values ('2061');
insert  into `tbl_tahun`(`tahun`) values ('2062');
insert  into `tbl_tahun`(`tahun`) values ('2063');
insert  into `tbl_tahun`(`tahun`) values ('2064');
insert  into `tbl_tahun`(`tahun`) values ('2065');
insert  into `tbl_tahun`(`tahun`) values ('2066');
insert  into `tbl_tahun`(`tahun`) values ('2067');
insert  into `tbl_tahun`(`tahun`) values ('2068');
insert  into `tbl_tahun`(`tahun`) values ('2069');
insert  into `tbl_tahun`(`tahun`) values ('2070');
insert  into `tbl_tahun`(`tahun`) values ('2071');
insert  into `tbl_tahun`(`tahun`) values ('2072');
insert  into `tbl_tahun`(`tahun`) values ('2073');
insert  into `tbl_tahun`(`tahun`) values ('2074');
insert  into `tbl_tahun`(`tahun`) values ('2075');
insert  into `tbl_tahun`(`tahun`) values ('2076');
insert  into `tbl_tahun`(`tahun`) values ('2078');
insert  into `tbl_tahun`(`tahun`) values ('2079');
insert  into `tbl_tahun`(`tahun`) values ('2080');
insert  into `tbl_tahun`(`tahun`) values ('2081');
insert  into `tbl_tahun`(`tahun`) values ('2082');
insert  into `tbl_tahun`(`tahun`) values ('2083');
insert  into `tbl_tahun`(`tahun`) values ('2084');
insert  into `tbl_tahun`(`tahun`) values ('2085');
insert  into `tbl_tahun`(`tahun`) values ('2086');
insert  into `tbl_tahun`(`tahun`) values ('2087');
insert  into `tbl_tahun`(`tahun`) values ('2088');
insert  into `tbl_tahun`(`tahun`) values ('2089');
insert  into `tbl_tahun`(`tahun`) values ('2090');
insert  into `tbl_tahun`(`tahun`) values ('2091');
insert  into `tbl_tahun`(`tahun`) values ('2092');
insert  into `tbl_tahun`(`tahun`) values ('2093');
insert  into `tbl_tahun`(`tahun`) values ('2094');
insert  into `tbl_tahun`(`tahun`) values ('2095');
insert  into `tbl_tahun`(`tahun`) values ('2096');
insert  into `tbl_tahun`(`tahun`) values ('2097');
insert  into `tbl_tahun`(`tahun`) values ('2098');
insert  into `tbl_tahun`(`tahun`) values ('2099');
insert  into `tbl_tahun`(`tahun`) values ('2100');

/*Table structure for table `tbl_target` */

DROP TABLE IF EXISTS `tbl_target`;

CREATE TABLE `tbl_target` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` year(4) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `target` varchar(11) NOT NULL,
  `realisasi` varchar(11) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_target` */

insert  into `tbl_target`(`id`,`tahun`,`bulan`,`target`,`realisasi`,`status`) values (10,2017,'05','450','',0);

/*Table structure for table `tbl_temp_qtytiba` */

DROP TABLE IF EXISTS `tbl_temp_qtytiba`;

CREATE TABLE `tbl_temp_qtytiba` (
  `id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_temp_qtytiba` */

/*Table structure for table `tbl_transaksiakhir` */

DROP TABLE IF EXISTS `tbl_transaksiakhir`;

CREATE TABLE `tbl_transaksiakhir` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idpelanggan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `idbarang` int(11) NOT NULL,
  `inputx` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_transaksiakhir` */

insert  into `tbl_transaksiakhir`(`id`,`idpelanggan`,`tanggal`,`idbarang`,`inputx`) values (1,9,'2013-01-01',9,'ALEX 2017-03-14 11:59:24 127.0.0.1 ARIEF-LT');
insert  into `tbl_transaksiakhir`(`id`,`idpelanggan`,`tanggal`,`idbarang`,`inputx`) values (2,9,'2014-01-01',11,'ALEX 2017-03-14 12:55:24 127.0.0.1 ARIEF-LT');
insert  into `tbl_transaksiakhir`(`id`,`idpelanggan`,`tanggal`,`idbarang`,`inputx`) values (3,9,'2015-01-01',6,'ALEX 2017-03-14 12:57:13 127.0.0.1 ARIEF-LT');
insert  into `tbl_transaksiakhir`(`id`,`idpelanggan`,`tanggal`,`idbarang`,`inputx`) values (4,9,'2017-03-13',8,'ALEX 2017-03-15 20:21:36 192.168.43.118 ALEX-RG');
insert  into `tbl_transaksiakhir`(`id`,`idpelanggan`,`tanggal`,`idbarang`,`inputx`) values (5,7,'2017-03-15',10,'ALEX 2017-03-15 20:26:43 192.168.43.118 ALEX-RG');
insert  into `tbl_transaksiakhir`(`id`,`idpelanggan`,`tanggal`,`idbarang`,`inputx`) values (6,9,'2017-03-14',9,'ALEX 2017-03-15 20:39:43 192.168.43.118 ALEX-RG');

/*Table structure for table `tbl_transfer` */

DROP TABLE IF EXISTS `tbl_transfer`;

CREATE TABLE `tbl_transfer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis` varchar(20) NOT NULL,
  `notransfer` varchar(20) NOT NULL,
  `tgltransfer` date NOT NULL,
  `idtujuan` int(11) NOT NULL,
  `idasal` int(11) NOT NULL,
  `idgudangtujuan` int(11) NOT NULL,
  `qty` varchar(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `norangka` varchar(20) NOT NULL,
  `nomesin` varchar(20) NOT NULL,
  `harga` varchar(20) NOT NULL,
  `ppn` varchar(20) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_transfer` */

/*Table structure for table `tbl_uangharian` */

DROP TABLE IF EXISTS `tbl_uangharian`;

CREATE TABLE `tbl_uangharian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(20) NOT NULL,
  `idkaryawan` int(11) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `dari` date NOT NULL,
  `sampai` date NOT NULL,
  `hadir` varchar(4) NOT NULL,
  `uharian` varchar(12) NOT NULL,
  `totuharian` varchar(20) NOT NULL,
  `status` int(1) NOT NULL,
  `tglbayar` date NOT NULL,
  `inputx` datetime NOT NULL,
  `updatex` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_uangharian` */

insert  into `tbl_uangharian`(`id`,`nik`,`idkaryawan`,`nama`,`dari`,`sampai`,`hadir`,`uharian`,`totuharian`,`status`,`tglbayar`,`inputx`,`updatex`) values (9,'H1-001',57,'ALEX IMC ','2016-12-01','2016-12-16','','20000','0',0,'0000-00-00','2016-12-16 20:14:10','');
insert  into `tbl_uangharian`(`id`,`nik`,`idkaryawan`,`nama`,`dari`,`sampai`,`hadir`,`uharian`,`totuharian`,`status`,`tglbayar`,`inputx`,`updatex`) values (10,'H1-002',58,'STAF ADMINISTRASI ','2016-12-01','2016-12-16','2','20000','40000',1,'2016-12-16','2016-12-16 20:14:10','pic 2016-12-16 20:59:05 192.168.43.118 ALEX-RG');
insert  into `tbl_uangharian`(`id`,`nik`,`idkaryawan`,`nama`,`dari`,`sampai`,`hadir`,`uharian`,`totuharian`,`status`,`tglbayar`,`inputx`,`updatex`) values (11,'H1-003',59,'STAF KASIR ','2016-12-01','2016-12-16','2','20000','40000',0,'0000-00-00','2016-12-16 20:14:10','');
insert  into `tbl_uangharian`(`id`,`nik`,`idkaryawan`,`nama`,`dari`,`sampai`,`hadir`,`uharian`,`totuharian`,`status`,`tglbayar`,`inputx`,`updatex`) values (12,'H1-004',60,'STAF GUDANG PDI ','2016-12-01','2016-12-16','2','20000','40000',0,'0000-00-00','2016-12-16 20:14:10','');
insert  into `tbl_uangharian`(`id`,`nik`,`idkaryawan`,`nama`,`dari`,`sampai`,`hadir`,`uharian`,`totuharian`,`status`,`tglbayar`,`inputx`,`updatex`) values (13,'H1-005',61,'KEPALA TOKO ','2016-12-01','2016-12-16','2','20000','40000',1,'2016-12-16','2016-12-16 20:14:10','kasir 2016-12-16 20:14:45 192.168.43.118 ALEX-RG');
insert  into `tbl_uangharian`(`id`,`nik`,`idkaryawan`,`nama`,`dari`,`sampai`,`hadir`,`uharian`,`totuharian`,`status`,`tglbayar`,`inputx`,`updatex`) values (14,'H1-006',62,'STAF DRIVER ','2016-12-01','2016-12-16','2','20000','40000',0,'0000-00-00','2016-12-16 20:14:10','');
insert  into `tbl_uangharian`(`id`,`nik`,`idkaryawan`,`nama`,`dari`,`sampai`,`hadir`,`uharian`,`totuharian`,`status`,`tglbayar`,`inputx`,`updatex`) values (15,'H1-007',63,'STAF SALES ','2016-12-01','2016-12-16','2','20000','40000',0,'0000-00-00','2016-12-16 20:14:10','');
insert  into `tbl_uangharian`(`id`,`nik`,`idkaryawan`,`nama`,`dari`,`sampai`,`hadir`,`uharian`,`totuharian`,`status`,`tglbayar`,`inputx`,`updatex`) values (16,'H1-008',64,'STAF SALES COUNTER ','2016-12-01','2016-12-16','2','20000','40000',0,'0000-00-00','2016-12-16 20:14:10','');
insert  into `tbl_uangharian`(`id`,`nik`,`idkaryawan`,`nama`,`dari`,`sampai`,`hadir`,`uharian`,`totuharian`,`status`,`tglbayar`,`inputx`,`updatex`) values (17,'H1-001',57,'ALEX IMC ','2017-02-05','2017-02-09','','20000','0',0,'0000-00-00','2017-02-09 20:28:25','');
insert  into `tbl_uangharian`(`id`,`nik`,`idkaryawan`,`nama`,`dari`,`sampai`,`hadir`,`uharian`,`totuharian`,`status`,`tglbayar`,`inputx`,`updatex`) values (18,'H1-002',58,'STAF ADMINISTRASI ','2017-02-05','2017-02-09','','20000','0',0,'0000-00-00','2017-02-09 20:28:25','');
insert  into `tbl_uangharian`(`id`,`nik`,`idkaryawan`,`nama`,`dari`,`sampai`,`hadir`,`uharian`,`totuharian`,`status`,`tglbayar`,`inputx`,`updatex`) values (19,'H1-003',59,'STAF KASIR ','2017-02-05','2017-02-09','','20000','0',0,'0000-00-00','2017-02-09 20:28:25','');
insert  into `tbl_uangharian`(`id`,`nik`,`idkaryawan`,`nama`,`dari`,`sampai`,`hadir`,`uharian`,`totuharian`,`status`,`tglbayar`,`inputx`,`updatex`) values (20,'H1-004',60,'STAF GUDANG PDI ','2017-02-05','2017-02-09','','20000','0',0,'0000-00-00','2017-02-09 20:28:25','');
insert  into `tbl_uangharian`(`id`,`nik`,`idkaryawan`,`nama`,`dari`,`sampai`,`hadir`,`uharian`,`totuharian`,`status`,`tglbayar`,`inputx`,`updatex`) values (21,'H1-005',61,'KEPALA TOKO ','2017-02-05','2017-02-09','','20000','0',0,'0000-00-00','2017-02-09 20:28:25','');
insert  into `tbl_uangharian`(`id`,`nik`,`idkaryawan`,`nama`,`dari`,`sampai`,`hadir`,`uharian`,`totuharian`,`status`,`tglbayar`,`inputx`,`updatex`) values (22,'H1-006',62,'STAF DRIVER ','2017-02-05','2017-02-09','','20000','0',0,'0000-00-00','2017-02-09 20:28:26','');
insert  into `tbl_uangharian`(`id`,`nik`,`idkaryawan`,`nama`,`dari`,`sampai`,`hadir`,`uharian`,`totuharian`,`status`,`tglbayar`,`inputx`,`updatex`) values (23,'H1-007',63,'STAF SALES ','2017-02-05','2017-02-09','','20000','0',0,'0000-00-00','2017-02-09 20:28:26','');
insert  into `tbl_uangharian`(`id`,`nik`,`idkaryawan`,`nama`,`dari`,`sampai`,`hadir`,`uharian`,`totuharian`,`status`,`tglbayar`,`inputx`,`updatex`) values (24,'H1-008',64,'STAF SALES COUNTER ','2017-02-05','2017-02-09','','20000','0',0,'0000-00-00','2017-02-09 20:28:26','');

/*Table structure for table `tbl_uanglembur` */

DROP TABLE IF EXISTS `tbl_uanglembur`;

CREATE TABLE `tbl_uanglembur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idkaryawan` int(11) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `posisi` varchar(20) NOT NULL,
  `tahun` year(4) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `tanggal` date NOT NULL,
  `ulembur` varchar(12) NOT NULL,
  `tglbayar` date NOT NULL,
  `updatex` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_uanglembur` */

insert  into `tbl_uanglembur`(`id`,`idkaryawan`,`nama`,`posisi`,`tahun`,`bulan`,`tanggal`,`ulembur`,`tglbayar`,`updatex`) values (2,62,'STAF DRIVER','DRIVER',2016,'12','2016-12-16','50000','2016-12-16','alex 2016-12-16 20:37:17 127.0.0.1 ISAS-VAIO');
insert  into `tbl_uanglembur`(`id`,`idkaryawan`,`nama`,`posisi`,`tahun`,`bulan`,`tanggal`,`ulembur`,`tglbayar`,`updatex`) values (3,58,'STAF ADMINISTRASI','ADMINISTRASI',2016,'12','2016-12-15','20000','2016-12-16','kasir 2016-12-16 20:44:25 192.168.43.118 ALEX-RG');

/*Table structure for table `tbl_user` */

DROP TABLE IF EXISTS `tbl_user`;

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `hakakses` varchar(20) NOT NULL,
  `pic_user` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_user` */

insert  into `tbl_user`(`id`,`id_karyawan`,`user`,`pass`,`hakakses`,`pic_user`) values (1,1,'administrator','c4abe222c3d7a1df7159a49fc42fe38c','ALL','');
insert  into `tbl_user`(`id`,`id_karyawan`,`user`,`pass`,`hakakses`,`pic_user`) values (39,57,'alex','534b44a19bf18d20b71ecc4eb77c572f','USER','administrator');
insert  into `tbl_user`(`id`,`id_karyawan`,`user`,`pass`,`hakakses`,`pic_user`) values (40,61,'pic','ed09636a6ea24a292460866afdd7a89a','USER','alex');
insert  into `tbl_user`(`id`,`id_karyawan`,`user`,`pass`,`hakakses`,`pic_user`) values (41,58,'administrasi','15ff3c0a0310a2e3de3e95c8aeb328d0','USER','alex');
insert  into `tbl_user`(`id`,`id_karyawan`,`user`,`pass`,`hakakses`,`pic_user`) values (42,60,'gudangpdi','466667c2410917a9e11948c12e6027f3','USER','alex');
insert  into `tbl_user`(`id`,`id_karyawan`,`user`,`pass`,`hakakses`,`pic_user`) values (43,59,'kasir','c7911af3adbd12a035b289556d96470a','USER','alex');
insert  into `tbl_user`(`id`,`id_karyawan`,`user`,`pass`,`hakakses`,`pic_user`) values (44,63,'sales','9ed083b1436e5f40ef984b28255eef18','USER','alex');
insert  into `tbl_user`(`id`,`id_karyawan`,`user`,`pass`,`hakakses`,`pic_user`) values (45,64,'salescounter','cef9a5f586aecb3f6669ce7322e31452','USER','alex');
insert  into `tbl_user`(`id`,`id_karyawan`,`user`,`pass`,`hakakses`,`pic_user`) values (46,62,'driver','e2d45d57c7e2941b65c6ccd64af4223e','USER','alex');
insert  into `tbl_user`(`id`,`id_karyawan`,`user`,`pass`,`hakakses`,`pic_user`) values (47,65,'aj-aj','e9593e58d01a0edd4041c56a41047f55','USER','alex');
insert  into `tbl_user`(`id`,`id_karyawan`,`user`,`pass`,`hakakses`,`pic_user`) values (48,66,'sales-aj','812bf10b3edd73eff1f85f1ca8a752f5','USER','ALEX');
insert  into `tbl_user`(`id`,`id_karyawan`,`user`,`pass`,`hakakses`,`pic_user`) values (49,67,'kasir-aj','f316d9ff5d5007dbaffd1ade1977b3b7','USER','ALEX');

/*Table structure for table `temp_abs_overbreak` */

DROP TABLE IF EXISTS `temp_abs_overbreak`;

CREATE TABLE `temp_abs_overbreak` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `EmployeeID` varchar(200) NOT NULL,
  `tgl` date NOT NULL,
  `total` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `temp_abs_overbreak` */

/*Table structure for table `temp_abs_overtime` */

DROP TABLE IF EXISTS `temp_abs_overtime`;

CREATE TABLE `temp_abs_overtime` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `EmployeeID` varchar(200) NOT NULL,
  `tgl` date NOT NULL,
  `total` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `temp_abs_overtime` */

/*Table structure for table `temp_abs_ox23_verbreak` */

DROP TABLE IF EXISTS `temp_abs_ox23_verbreak`;

CREATE TABLE `temp_abs_ox23_verbreak` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `EmployeeID` varchar(200) NOT NULL,
  `tgl` date NOT NULL,
  `total` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `temp_abs_ox23_verbreak` */

/*Table structure for table `temp_abs_status` */

DROP TABLE IF EXISTS `temp_abs_status`;

CREATE TABLE `temp_abs_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `EmployeeID` varchar(200) NOT NULL,
  `tgl` date NOT NULL,
  `status` varchar(200) NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `temp_abs_status` */

/*Table structure for table `temp_abs_terlambat` */

DROP TABLE IF EXISTS `temp_abs_terlambat`;

CREATE TABLE `temp_abs_terlambat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `EmployeeID` varchar(200) NOT NULL,
  `tgl` date NOT NULL,
  `total` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `temp_abs_terlambat` */

/*Table structure for table `temp_abs_x23_overtime` */

DROP TABLE IF EXISTS `temp_abs_x23_overtime`;

CREATE TABLE `temp_abs_x23_overtime` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `EmployeeID` varchar(200) NOT NULL,
  `tgl` date NOT NULL,
  `total` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `temp_abs_x23_overtime` */

/*Table structure for table `temp_abs_x23_status` */

DROP TABLE IF EXISTS `temp_abs_x23_status`;

CREATE TABLE `temp_abs_x23_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `EmployeeID` varchar(200) NOT NULL,
  `tgl` date NOT NULL,
  `status` varchar(200) NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `temp_abs_x23_status` */

/*Table structure for table `temp_abs_x23_terlambat` */

DROP TABLE IF EXISTS `temp_abs_x23_terlambat`;

CREATE TABLE `temp_abs_x23_terlambat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `EmployeeID` varchar(200) NOT NULL,
  `tgl` date NOT NULL,
  `total` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `temp_abs_x23_terlambat` */

/*Table structure for table `temp_ksefektivitas` */

DROP TABLE IF EXISTS `temp_ksefektivitas`;

CREATE TABLE `temp_ksefektivitas` (
  `jps` int(11) NOT NULL,
  `jtl` int(11) NOT NULL,
  `jpl` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `temp_ksefektivitas` */

insert  into `temp_ksefektivitas`(`jps`,`jtl`,`jpl`) values (0,0,0);
insert  into `temp_ksefektivitas`(`jps`,`jtl`,`jpl`) values (2,2,2);
insert  into `temp_ksefektivitas`(`jps`,`jtl`,`jpl`) values (0,0,0);

/*Table structure for table `temp_opname_det` */

DROP TABLE IF EXISTS `temp_opname_det`;

CREATE TABLE `temp_opname_det` (
  `norangka` varchar(30) NOT NULL,
  `idgudang` int(11) NOT NULL,
  `user` varchar(20) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`norangka`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `temp_opname_det` */

insert  into `temp_opname_det`(`norangka`,`idgudang`,`user`,`status`) values ('9',0,'gudangpdi',0);
insert  into `temp_opname_det`(`norangka`,`idgudang`,`user`,`status`) values ('O',0,'gudangpdi',0);

/*Table structure for table `temp_pesanan_det` */

DROP TABLE IF EXISTS `temp_pesanan_det`;

CREATE TABLE `temp_pesanan_det` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nopesan` varchar(40) NOT NULL,
  `idbarang` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `temp_pesanan_det` */

/*Table structure for table `temp_pindah_det` */

DROP TABLE IF EXISTS `temp_pindah_det`;

CREATE TABLE `temp_pindah_det` (
  `norangka` varchar(30) NOT NULL,
  `user` varchar(20) NOT NULL,
  PRIMARY KEY (`norangka`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `temp_pindah_det` */

/*Table structure for table `temp_tools` */

DROP TABLE IF EXISTS `temp_tools`;

CREATE TABLE `temp_tools` (
  `id` varchar(255) NOT NULL,
  `ed` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `temp_tools` */

insert  into `temp_tools`(`id`,`ed`) values ('6e41a62e524f27717a3b2d8226599493',1);
insert  into `temp_tools`(`id`,`ed`) values ('842aa9d3d29c15ea34be50f74d8455d1',1);
insert  into `temp_tools`(`id`,`ed`) values ('fc949bfa1ab025827c202d28566a52d2',1);
insert  into `temp_tools`(`id`,`ed`) values ('78e2a2222d8e32dc537cbb54de3577c7',1);

/*Table structure for table `temp_toolss` */

DROP TABLE IF EXISTS `temp_toolss`;

CREATE TABLE `temp_toolss` (
  `id` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `temp_toolss` */

insert  into `temp_toolss`(`id`) values ('2017-02-28');

/*Table structure for table `temp_x23_abispenjualan` */

DROP TABLE IF EXISTS `temp_x23_abispenjualan`;

CREATE TABLE `temp_x23_abispenjualan` (
  `qty` varchar(20) NOT NULL,
  `tjpcash` varchar(20) NOT NULL,
  `tjpindent` varchar(20) NOT NULL,
  `tjpcashjual` varchar(20) NOT NULL,
  `tjpkpb` varchar(20) NOT NULL,
  `tjpnonkpb` varchar(20) NOT NULL,
  `tjpkpb2` varchar(20) NOT NULL,
  `tjpnonkpb2` varchar(20) NOT NULL,
  `diskon` varchar(20) NOT NULL,
  `dp` varchar(20) NOT NULL,
  `sisabayar` varchar(20) NOT NULL,
  `notajual` int(1) NOT NULL,
  `notaservis` int(1) NOT NULL,
  `notaindent` int(1) NOT NULL,
  `kwindent` int(1) NOT NULL,
  `kwindent2` int(1) NOT NULL,
  `kwlunas` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `temp_x23_abispenjualan` */

/*Table structure for table `temp_x23_abisservis` */

DROP TABLE IF EXISTS `temp_x23_abisservis`;

CREATE TABLE `temp_x23_abisservis` (
  `tjsemua1A` varchar(20) NOT NULL,
  `tjsemua1B` varchar(20) NOT NULL,
  `tjsemua2A` varchar(20) NOT NULL,
  `tjsemua2B` varchar(20) NOT NULL,
  `diskon1` varchar(20) NOT NULL,
  `diskon2` varchar(20) NOT NULL,
  `qty` varchar(20) NOT NULL,
  `qtykwitansi` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `temp_x23_abisservis` */

/*Table structure for table `temp_x23_bayarsup_notaretur` */

DROP TABLE IF EXISTS `temp_x23_bayarsup_notaretur`;

CREATE TABLE `temp_x23_bayarsup_notaretur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `noretur` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `temp_x23_bayarsup_notaretur` */

/*Table structure for table `temp_x23_claimoli_det` */

DROP TABLE IF EXISTS `temp_x23_claimoli_det`;

CREATE TABLE `temp_x23_claimoli_det` (
  `nonotabeli` varchar(20) NOT NULL,
  `noservis` varchar(20) NOT NULL,
  `idservisdet` int(11) NOT NULL,
  `kodepaket` varchar(20) NOT NULL,
  `kpbke` varchar(10) NOT NULL,
  `namakpb` varchar(40) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `kodebarang` varchar(20) NOT NULL,
  `namabarang` varchar(40) NOT NULL,
  `varian` varchar(20) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `temp_x23_claimoli_det` */

/*Table structure for table `temp_x23_kmindividu_wktsvc` */

DROP TABLE IF EXISTS `temp_x23_kmindividu_wktsvc`;

CREATE TABLE `temp_x23_kmindividu_wktsvc` (
  `idmekanik` varchar(20) NOT NULL,
  `wktsvc` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `temp_x23_kmindividu_wktsvc` */

/*Table structure for table `temp_x23_konfclaim_det` */

DROP TABLE IF EXISTS `temp_x23_konfclaim_det`;

CREATE TABLE `temp_x23_konfclaim_det` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notabeli` varchar(20) NOT NULL,
  `idnotabelidet` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `qtyclaim` varchar(6) NOT NULL,
  `qtytiba` varchar(6) NOT NULL,
  `idgudang` int(11) NOT NULL,
  `rak` varchar(20) NOT NULL,
  `id_claimoli_det` int(11) NOT NULL,
  `statusclaim` varchar(20) NOT NULL,
  `tagihkembali` varchar(20) NOT NULL,
  `kettolak` varchar(400) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `temp_x23_konfclaim_det` */

/*Table structure for table `temp_x23_opname_det` */

DROP TABLE IF EXISTS `temp_x23_opname_det`;

CREATE TABLE `temp_x23_opname_det` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idstok` int(11) NOT NULL,
  `idopname` int(11) NOT NULL,
  `idgudang` int(11) NOT NULL,
  `rak` varchar(20) NOT NULL,
  `nonota` varchar(20) NOT NULL,
  `tglnota` date NOT NULL,
  `idbarang` int(11) NOT NULL,
  `stok` varchar(20) NOT NULL,
  `opname` varchar(20) NOT NULL,
  `hargabeli` varchar(20) NOT NULL,
  `selisih` varchar(20) NOT NULL,
  `totalselisih` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `temp_x23_opname_det` */

/*Table structure for table `temp_x23_pndharian` */

DROP TABLE IF EXISTS `temp_x23_pndharian`;

CREATE TABLE `temp_x23_pndharian` (
  `a` varchar(20) NOT NULL,
  `b` varchar(20) NOT NULL,
  `c` varchar(20) NOT NULL,
  `d` varchar(20) NOT NULL,
  `e` varchar(20) NOT NULL,
  `f` varchar(20) NOT NULL,
  `g` varchar(20) NOT NULL,
  `h` varchar(20) NOT NULL,
  `i` varchar(20) NOT NULL,
  `j` varchar(20) NOT NULL,
  `k` varchar(20) NOT NULL,
  `x` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `temp_x23_pndharian` */

/*Table structure for table `x23_abis_dkonfirmasi` */

DROP TABLE IF EXISTS `x23_abis_dkonfirmasi`;

CREATE TABLE `x23_abis_dkonfirmasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idnotabeli` int(11) NOT NULL,
  `idnotabeli2` int(11) NOT NULL,
  `idstokpart` int(11) NOT NULL,
  `idopname` int(11) NOT NULL,
  `idpesanan` int(11) NOT NULL,
  `idkwitansi` int(11) NOT NULL,
  `idpindah` int(11) NOT NULL,
  `idpiutang` int(11) NOT NULL,
  `idbyrpiutang` int(11) NOT NULL,
  `idpotkompensasi` int(11) NOT NULL,
  `idreturbeli` int(11) NOT NULL,
  `idtutupservis` int(11) NOT NULL,
  `idkaskecil` int(11) NOT NULL,
  `idtutupharian` int(11) NOT NULL,
  `tahun` year(4) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `tanggal` date NOT NULL,
  `kasus` varchar(200) NOT NULL,
  `tbl` varchar(40) NOT NULL,
  `status` int(1) NOT NULL,
  `inputx` datetime NOT NULL,
  `updatex` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `x23_abis_dkonfirmasi` */

/*Table structure for table `x23_abis_ikesalahan` */

DROP TABLE IF EXISTS `x23_abis_ikesalahan`;

CREATE TABLE `x23_abis_ikesalahan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idtutupservis1` int(11) NOT NULL,
  `idtutupservis2` int(11) NOT NULL,
  `idtutupservis3` int(11) NOT NULL,
  `idtutupservis4` int(11) NOT NULL,
  `idnotajualdet` int(11) NOT NULL,
  `idnotaservicedet` int(11) NOT NULL,
  `idpenagihankpb` int(11) NOT NULL,
  `idpenagihanoli` int(11) NOT NULL,
  `idnotaindent` int(11) NOT NULL,
  `idbarangindent` int(11) NOT NULL,
  `notajual` varchar(20) NOT NULL,
  `tahun` year(4) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `tanggal` date NOT NULL,
  `kasus` varchar(200) NOT NULL,
  `tbl` varchar(40) NOT NULL,
  `status` int(1) NOT NULL,
  `inputx` datetime NOT NULL,
  `updatex` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `x23_abis_ikesalahan` */

/*Table structure for table `x23_antrian` */

DROP TABLE IF EXISTS `x23_antrian`;

CREATE TABLE `x23_antrian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idpelanggan` int(11) NOT NULL,
  `nopol` varchar(10) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `jammulai` time NOT NULL,
  `noantrian` varchar(4) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `x23_antrian` */

/*Table structure for table `x23_bayarsup_history` */

DROP TABLE IF EXISTS `x23_bayarsup_history`;

CREATE TABLE `x23_bayarsup_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nonota` varchar(20) NOT NULL,
  `jumlah` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `iduser` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `x23_bayarsup_history` */

/*Table structure for table `x23_claimoli_det` */

DROP TABLE IF EXISTS `x23_claimoli_det`;

CREATE TABLE `x23_claimoli_det` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nonota` varchar(20) NOT NULL,
  `id_notajual_det` int(11) NOT NULL,
  `nonotaservis` varchar(20) NOT NULL,
  `tglservis` date NOT NULL,
  `kodepaket` varchar(20) NOT NULL,
  `kpbke` varchar(10) NOT NULL,
  `namakpb` varchar(40) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `kodebarang` varchar(20) NOT NULL,
  `varian` varchar(20) NOT NULL,
  `namabarang` varchar(40) NOT NULL,
  `hargaoli` varchar(20) NOT NULL,
  `statusclaim` varchar(20) NOT NULL,
  `tagihkembali` varchar(20) NOT NULL,
  `kettolak` varchar(400) NOT NULL,
  `statuscek` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `x23_claimoli_det` */

/*Table structure for table `x23_gudang` */

DROP TABLE IF EXISTS `x23_gudang`;

CREATE TABLE `x23_gudang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gudang` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `x23_gudang` */

insert  into `x23_gudang`(`id`,`gudang`) values (1,'GUDANG 1');

/*Table structure for table `x23_indent` */

DROP TABLE IF EXISTS `x23_indent`;

CREATE TABLE `x23_indent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `noindent` varchar(20) NOT NULL,
  `notajual` varchar(20) NOT NULL,
  `idpelanggan` int(11) NOT NULL,
  `tahun` year(4) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `tglindent` date NOT NULL,
  `totalqty` varchar(20) NOT NULL,
  `status` int(1) NOT NULL,
  `iduser` int(11) NOT NULL,
  `inputx` datetime NOT NULL,
  `updatex` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `x23_indent` */

/*Table structure for table `x23_indent_det` */

DROP TABLE IF EXISTS `x23_indent_det`;

CREATE TABLE `x23_indent_det` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `noindent` varchar(20) NOT NULL,
  `tahun` year(4) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `tglindent` date NOT NULL,
  `idbarang` int(11) NOT NULL,
  `qty` varchar(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `x23_indent_det` */

/*Table structure for table `x23_insentif_inc` */

DROP TABLE IF EXISTS `x23_insentif_inc`;

CREATE TABLE `x23_insentif_inc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `x23_insentif_inc` */

/*Table structure for table `x23_insentif_karyawan` */

DROP TABLE IF EXISTS `x23_insentif_karyawan`;

CREATE TABLE `x23_insentif_karyawan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(11) NOT NULL,
  `target` int(11) NOT NULL,
  `cash` varchar(11) NOT NULL,
  `kredit` varchar(11) NOT NULL,
  `flat` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `x23_insentif_karyawan` */

/*Table structure for table `x23_interval` */

DROP TABLE IF EXISTS `x23_interval`;

CREATE TABLE `x23_interval` (
  `milisecond` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `x23_interval` */

/*Table structure for table `x23_karyawan` */

DROP TABLE IF EXISTS `x23_karyawan`;

CREATE TABLE `x23_karyawan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(20) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `posisi` int(1) NOT NULL,
  `pangkat` varchar(20) NOT NULL,
  `tmplahir` varchar(20) NOT NULL,
  `tgllahir` date NOT NULL,
  `noktp` varchar(20) NOT NULL,
  `notelepon` varchar(20) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `tglmulaikerja` date NOT NULL,
  `ugapok` varchar(17) NOT NULL,
  `uharian` varchar(17) NOT NULL,
  `ukomisi` varchar(17) NOT NULL,
  `ulembur` varchar(17) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'AKTIF',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

/*Data for the table `x23_karyawan` */

insert  into `x23_karyawan`(`id`,`nik`,`nama`,`posisi`,`pangkat`,`tmplahir`,`tgllahir`,`noktp`,`notelepon`,`alamat`,`tglmulaikerja`,`ugapok`,`uharian`,`ukomisi`,`ulembur`,`photo`,`status`) values (1,'','ADMINISTRATOR',1,'','','0000-00-00','','','','0000-00-00','','','','','','AKTIF');
insert  into `x23_karyawan`(`id`,`nik`,`nama`,`posisi`,`pangkat`,`tmplahir`,`tgllahir`,`noktp`,`notelepon`,`alamat`,`tglmulaikerja`,`ugapok`,`uharian`,`ukomisi`,`ulembur`,`photo`,`status`) values (2,'H2H3-002','MEKANIK DUA',4,'PMT2','BANGKA BELITUNG','1985-05-05','02348723438380001','0819283723888','JL. KARIMUN JAWA NO. 231','2012-01-01','100000','0','','0','6SAM_0361.JPG','AKTIF');
insert  into `x23_karyawan`(`id`,`nik`,`nama`,`posisi`,`pangkat`,`tmplahir`,`tgllahir`,`noktp`,`notelepon`,`alamat`,`tglmulaikerja`,`ugapok`,`uharian`,`ukomisi`,`ulembur`,`photo`,`status`) values (3,'H2H3-001','ALEX IMC',6,'','1','2011-11-11','3','1','1','2011-11-11','1','1','','1','','AKTIF');
insert  into `x23_karyawan`(`id`,`nik`,`nama`,`posisi`,`pangkat`,`tmplahir`,`tgllahir`,`noktp`,`notelepon`,`alamat`,`tglmulaikerja`,`ugapok`,`uharian`,`ukomisi`,`ulembur`,`photo`,`status`) values (11,'H2H3-008','MEKANIK SATU A',4,'PMT1','11111111','2011-11-11','21312312','12312313','12312313','2011-11-11','1000000','20000','','20000','','AKTIF');
insert  into `x23_karyawan`(`id`,`nik`,`nama`,`posisi`,`pangkat`,`tmplahir`,`tgllahir`,`noktp`,`notelepon`,`alamat`,`tglmulaikerja`,`ugapok`,`uharian`,`ukomisi`,`ulembur`,`photo`,`status`) values (15,'H2H3-017','KEPALA BENGKEL',7,'','11111','2011-11-11','11','11','11','2011-11-11','2500000','10000','','10000','','AKTIF');
insert  into `x23_karyawan`(`id`,`nik`,`nama`,`posisi`,`pangkat`,`tmplahir`,`tgllahir`,`noktp`,`notelepon`,`alamat`,`tglmulaikerja`,`ugapok`,`uharian`,`ukomisi`,`ulembur`,`photo`,`status`) values (18,'H2H3-010','COUNTER PART',5,'','DFSDFSD','2002-02-22','44234234','324','FSD SD SDFSDFRGRG RGREFEGREGRGRG REGREG ERGERGERG','2015-12-18','1301001','100000','','10000','52Tes Honda.jpg','AKTIF');
insert  into `x23_karyawan`(`id`,`nik`,`nama`,`posisi`,`pangkat`,`tmplahir`,`tgllahir`,`noktp`,`notelepon`,`alamat`,`tglmulaikerja`,`ugapok`,`uharian`,`ukomisi`,`ulembur`,`photo`,`status`) values (19,'H2H3-011','SALES ADVISOR',3,'','123123123','2012-03-12','123123','123213','123213','2012-03-12','800000','12000','','12000','38SAM_0352.JPG','AKTIF');
insert  into `x23_karyawan`(`id`,`nik`,`nama`,`posisi`,`pangkat`,`tmplahir`,`tgllahir`,`noktp`,`notelepon`,`alamat`,`tglmulaikerja`,`ugapok`,`uharian`,`ukomisi`,`ulembur`,`photo`,`status`) values (20,'H2H3-012','KASIR',2,'','QQQQQQQQQQQQQQQQQQQQ','1982-10-22','44444444444444444444','444444444444','DDDDDDDDDD DDDDD DDDDDDD DDDDD DDDDDD','2000-10-22','1000000','125000','','10000','1Tes Honda.jpg','AKTIF');
insert  into `x23_karyawan`(`id`,`nik`,`nama`,`posisi`,`pangkat`,`tmplahir`,`tgllahir`,`noktp`,`notelepon`,`alamat`,`tglmulaikerja`,`ugapok`,`uharian`,`ukomisi`,`ulembur`,`photo`,`status`) values (21,'H2H3-013','MEKANIK TIGA',4,'PMT3','DSFSDFSDFSDF','1988-12-31','344234324','234234','23432423','1988-12-31','1000000','12300','','12200','55Tes Honda.jpg','AKTIF');
insert  into `x23_karyawan`(`id`,`nik`,`nama`,`posisi`,`pangkat`,`tmplahir`,`tgllahir`,`noktp`,`notelepon`,`alamat`,`tglmulaikerja`,`ugapok`,`uharian`,`ukomisi`,`ulembur`,`photo`,`status`) values (22,'H2H3-014','KEPALA MEKANIK',4,'KEPALA MEKANIK','DFSDFSDF','2012-12-12','1212','123123','123123','2012-12-12','1122121','121212','','121212','','AKTIF');
insert  into `x23_karyawan`(`id`,`nik`,`nama`,`posisi`,`pangkat`,`tmplahir`,`tgllahir`,`noktp`,`notelepon`,`alamat`,`tglmulaikerja`,`ugapok`,`uharian`,`ukomisi`,`ulembur`,`photo`,`status`) values (23,'H2H3-015','MEKANIK EMPAT',4,'PMT3','32','2011-01-01','12','12','12','2011-01-01','1000000','10000','','10000','','AKTIF');
insert  into `x23_karyawan`(`id`,`nik`,`nama`,`posisi`,`pangkat`,`tmplahir`,`tgllahir`,`noktp`,`notelepon`,`alamat`,`tglmulaikerja`,`ugapok`,`uharian`,`ukomisi`,`ulembur`,`photo`,`status`) values (24,'H2H3-016','MEKANIK LIMA',4,'PMT2','WERT','2011-01-01','123','123','123','2011-01-01','0','0','','0','','AKTIF');
insert  into `x23_karyawan`(`id`,`nik`,`nama`,`posisi`,`pangkat`,`tmplahir`,`tgllahir`,`noktp`,`notelepon`,`alamat`,`tglmulaikerja`,`ugapok`,`uharian`,`ukomisi`,`ulembur`,`photo`,`status`) values (25,'H2H3-018','ANUGRAH JAYA',6,'','WERT','2011-01-01','123','123','123','2011-01-01','0','0','','0','','AKTIF');

/*Table structure for table `x23_kaskecil` */

DROP TABLE IF EXISTS `x23_kaskecil`;

CREATE TABLE `x23_kaskecil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `jenis` varchar(11) NOT NULL,
  `keterangan` varchar(1000) NOT NULL,
  `jumlah` varchar(20) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `x23_kaskecil` */

/*Table structure for table `x23_kelompokjasa` */

DROP TABLE IF EXISTS `x23_kelompokjasa`;

CREATE TABLE `x23_kelompokjasa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jnskj` varchar(20) NOT NULL,
  `kode` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `harga` varchar(20) NOT NULL,
  `hargampm` varchar(20) NOT NULL,
  `kpbke` varchar(1) NOT NULL,
  `oli` varchar(6) NOT NULL,
  `qtyoli` varchar(6) NOT NULL,
  `bataskm` varchar(6) NOT NULL,
  `batashari` varchar(6) NOT NULL,
  `hargaoli` varchar(20) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `inputx` datetime NOT NULL,
  `updatex` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `x23_kelompokjasa` */

insert  into `x23_kelompokjasa`(`id`,`jnskj`,`kode`,`nama`,`harga`,`hargampm`,`kpbke`,`oli`,`qtyoli`,`bataskm`,`batashari`,`hargaoli`,`status`,`inputx`,`updatex`) values (1,'KPB','KJ1608-001','PCX 150 - 1','0','38800','1','YA','1','1000','60','30000',0,'2016-08-25 15:30:34','alex 2016-12-08 23:29:00 127.0.0.1 ISAS-VAIO');
insert  into `x23_kelompokjasa`(`id`,`jnskj`,`kode`,`nama`,`harga`,`hargampm`,`kpbke`,`oli`,`qtyoli`,`bataskm`,`batashari`,`hargaoli`,`status`,`inputx`,`updatex`) values (2,'LAINNYA','KJ1610-001','HUT RI KE 71','17000','','','','','','','',1,'2016-10-08 10:15:03','');
insert  into `x23_kelompokjasa`(`id`,`jnskj`,`kode`,`nama`,`harga`,`hargampm`,`kpbke`,`oli`,`qtyoli`,`bataskm`,`batashari`,`hargaoli`,`status`,`inputx`,`updatex`) values (3,'KPB','KJ1611-001','PCX 150 - 2','0','40000','2','YA','1','2000','90','30000',1,'2016-11-17 16:03:07','alex 2016-11-17 16:07:16 127.0.0.1 ARIEF-LT');
insert  into `x23_kelompokjasa`(`id`,`jnskj`,`kode`,`nama`,`harga`,`hargampm`,`kpbke`,`oli`,`qtyoli`,`bataskm`,`batashari`,`hargaoli`,`status`,`inputx`,`updatex`) values (4,'KPB','KJ1611-002','PCX 150 - 3','0','40000','3','YA','1','4000','120','30000',1,'2016-11-17 16:08:04','');
insert  into `x23_kelompokjasa`(`id`,`jnskj`,`kode`,`nama`,`harga`,`hargampm`,`kpbke`,`oli`,`qtyoli`,`bataskm`,`batashari`,`hargaoli`,`status`,`inputx`,`updatex`) values (5,'KPB','KJ1612-001','BEAT','0','20000','1','YA','1','500','30','20000',1,'2016-12-05 20:51:56','alex 2016-12-05 20:58:52 127.0.0.1 ALEX-RG');
insert  into `x23_kelompokjasa`(`id`,`jnskj`,`kode`,`nama`,`harga`,`hargampm`,`kpbke`,`oli`,`qtyoli`,`bataskm`,`batashari`,`hargaoli`,`status`,`inputx`,`updatex`) values (6,'LAINNYA','KJ1612-002','TAHUN BARU','15000','','','YA','','','','',0,'2016-12-05 21:00:12','alex 2016-12-08 23:35:44 127.0.0.1 ISAS-VAIO');
insert  into `x23_kelompokjasa`(`id`,`jnskj`,`kode`,`nama`,`harga`,`hargampm`,`kpbke`,`oli`,`qtyoli`,`bataskm`,`batashari`,`hargaoli`,`status`,`inputx`,`updatex`) values (7,'KPB','KJ1612-003','BEAT','0','30000','2','YA','1','1000','60','20000',0,'2016-12-09 09:55:15','alex 2016-12-09 09:59:28 127.0.0.1 ISAS-VAIO');
insert  into `x23_kelompokjasa`(`id`,`jnskj`,`kode`,`nama`,`harga`,`hargampm`,`kpbke`,`oli`,`qtyoli`,`bataskm`,`batashari`,`hargaoli`,`status`,`inputx`,`updatex`) values (8,'KPB','KJ1612-004','TEST','1','1','1','YA','1','1000','1','1',1,'2016-12-22 21:02:43','');
insert  into `x23_kelompokjasa`(`id`,`jnskj`,`kode`,`nama`,`harga`,`hargampm`,`kpbke`,`oli`,`qtyoli`,`bataskm`,`batashari`,`hargaoli`,`status`,`inputx`,`updatex`) values (9,'LAINNYA','KJ1612-005','TESS','1','','','TIDAK','','','','',1,'2016-12-22 21:10:50','');
insert  into `x23_kelompokjasa`(`id`,`jnskj`,`kode`,`nama`,`harga`,`hargampm`,`kpbke`,`oli`,`qtyoli`,`bataskm`,`batashari`,`hargaoli`,`status`,`inputx`,`updatex`) values (10,'KPB','KJ1701-001','CBR 250 - 1','0','80000','1','YA','2','500','30','50000',1,'2017-01-23 10:33:42','');
insert  into `x23_kelompokjasa`(`id`,`jnskj`,`kode`,`nama`,`harga`,`hargampm`,`kpbke`,`oli`,`qtyoli`,`bataskm`,`batashari`,`hargaoli`,`status`,`inputx`,`updatex`) values (11,'KPB','KJ1701-002','CBR 250 - 2','0','80000','2','YA','2','3000','90','50000',1,'2017-01-23 10:48:24','');
insert  into `x23_kelompokjasa`(`id`,`jnskj`,`kode`,`nama`,`harga`,`hargampm`,`kpbke`,`oli`,`qtyoli`,`bataskm`,`batashari`,`hargaoli`,`status`,`inputx`,`updatex`) values (12,'KPB','KJ1701-003','KPB TEST 4','20000','18000','4','YA','2','2000','7','10000',1,'2017-01-25 19:58:15','alex 2017-01-25 20:28:28 192.168.43.118 ALEX-RG');

/*Table structure for table `x23_kelompokjasa_det` */

DROP TABLE IF EXISTS `x23_kelompokjasa_det`;

CREATE TABLE `x23_kelompokjasa_det` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(20) NOT NULL,
  `idtarifjasa` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

/*Data for the table `x23_kelompokjasa_det` */

insert  into `x23_kelompokjasa_det`(`id`,`kode`,`idtarifjasa`) values (1,'KJ1608-001',1);
insert  into `x23_kelompokjasa_det`(`id`,`kode`,`idtarifjasa`) values (2,'KJ1608-001',2);
insert  into `x23_kelompokjasa_det`(`id`,`kode`,`idtarifjasa`) values (3,'KJ1610-001',8);
insert  into `x23_kelompokjasa_det`(`id`,`kode`,`idtarifjasa`) values (4,'KJ1612-001',8);
insert  into `x23_kelompokjasa_det`(`id`,`kode`,`idtarifjasa`) values (6,'KJ1612-001',9);
insert  into `x23_kelompokjasa_det`(`id`,`kode`,`idtarifjasa`) values (8,'KJ1612-002',1);
insert  into `x23_kelompokjasa_det`(`id`,`kode`,`idtarifjasa`) values (9,'KJ1612-003',8);
insert  into `x23_kelompokjasa_det`(`id`,`kode`,`idtarifjasa`) values (15,'KJ1612-004',8);
insert  into `x23_kelompokjasa_det`(`id`,`kode`,`idtarifjasa`) values (18,'KJ1612-005',8);
insert  into `x23_kelompokjasa_det`(`id`,`kode`,`idtarifjasa`) values (19,'KJ1701-001',1);
insert  into `x23_kelompokjasa_det`(`id`,`kode`,`idtarifjasa`) values (20,'KJ1701-001',2);
insert  into `x23_kelompokjasa_det`(`id`,`kode`,`idtarifjasa`) values (21,'KJ1701-002',1);
insert  into `x23_kelompokjasa_det`(`id`,`kode`,`idtarifjasa`) values (22,'KJ1701-002',2);
insert  into `x23_kelompokjasa_det`(`id`,`kode`,`idtarifjasa`) values (23,'KJ1701-003',2);
insert  into `x23_kelompokjasa_det`(`id`,`kode`,`idtarifjasa`) values (24,'KJ1701-003',9);

/*Table structure for table `x23_kelompokjasa_oli` */

DROP TABLE IF EXISTS `x23_kelompokjasa_oli`;

CREATE TABLE `x23_kelompokjasa_oli` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(20) NOT NULL,
  `idoli` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

/*Data for the table `x23_kelompokjasa_oli` */

insert  into `x23_kelompokjasa_oli`(`id`,`kode`,`idoli`) values (2,'KJ1608-001',6);
insert  into `x23_kelompokjasa_oli`(`id`,`kode`,`idoli`) values (3,'KJ1608-001',7);
insert  into `x23_kelompokjasa_oli`(`id`,`kode`,`idoli`) values (4,'KJ1608-001',8);
insert  into `x23_kelompokjasa_oli`(`id`,`kode`,`idoli`) values (5,'KJ1611-001',6);
insert  into `x23_kelompokjasa_oli`(`id`,`kode`,`idoli`) values (6,'KJ1611-001',7);
insert  into `x23_kelompokjasa_oli`(`id`,`kode`,`idoli`) values (7,'KJ1611-001',8);
insert  into `x23_kelompokjasa_oli`(`id`,`kode`,`idoli`) values (8,'KJ1611-001',9);
insert  into `x23_kelompokjasa_oli`(`id`,`kode`,`idoli`) values (9,'KJ1611-002',6);
insert  into `x23_kelompokjasa_oli`(`id`,`kode`,`idoli`) values (10,'KJ1612-001',6);
insert  into `x23_kelompokjasa_oli`(`id`,`kode`,`idoli`) values (11,'KJ1612-003',6);
insert  into `x23_kelompokjasa_oli`(`id`,`kode`,`idoli`) values (12,'KJ1612-003',7);
insert  into `x23_kelompokjasa_oli`(`id`,`kode`,`idoli`) values (21,'KJ1612-004',8);
insert  into `x23_kelompokjasa_oli`(`id`,`kode`,`idoli`) values (23,'KJ1701-001',6);
insert  into `x23_kelompokjasa_oli`(`id`,`kode`,`idoli`) values (24,'KJ1701-002',6);
insert  into `x23_kelompokjasa_oli`(`id`,`kode`,`idoli`) values (25,'KJ1701-003',6);
insert  into `x23_kelompokjasa_oli`(`id`,`kode`,`idoli`) values (26,'KJ1701-003',12);
insert  into `x23_kelompokjasa_oli`(`id`,`kode`,`idoli`) values (27,'KJ1701-003',10);
insert  into `x23_kelompokjasa_oli`(`id`,`kode`,`idoli`) values (28,'KJ1701-003',9);
insert  into `x23_kelompokjasa_oli`(`id`,`kode`,`idoli`) values (29,'KJ1701-003',7);

/*Table structure for table `x23_kjasa` */

DROP TABLE IF EXISTS `x23_kjasa`;

CREATE TABLE `x23_kjasa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl1` date NOT NULL,
  `tgl2` date NOT NULL,
  `kepalamekanik` varchar(22) NOT NULL,
  `sa` varchar(22) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `x23_kjasa` */

insert  into `x23_kjasa`(`id`,`tgl1`,`tgl2`,`kepalamekanik`,`sa`,`status`) values (5,'2017-02-11','2017-02-11','10','10',0);
insert  into `x23_kjasa`(`id`,`tgl1`,`tgl2`,`kepalamekanik`,`sa`,`status`) values (6,'2017-02-11','2017-02-11','10','20',0);
insert  into `x23_kjasa`(`id`,`tgl1`,`tgl2`,`kepalamekanik`,`sa`,`status`) values (7,'2017-02-11','0000-00-00','10','20',1);

/*Table structure for table `x23_kompensasi` */

DROP TABLE IF EXISTS `x23_kompensasi`;

CREATE TABLE `x23_kompensasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bulan` varchar(2) NOT NULL,
  `tahun` year(4) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `idkaryawan` int(11) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `posisi` varchar(20) NOT NULL,
  `ugapok` varchar(20) NOT NULL,
  `uharian` varchar(20) NOT NULL,
  `ulembur` varchar(20) NOT NULL,
  `kservis` varchar(20) NOT NULL,
  `kjasa` varchar(20) NOT NULL,
  `kkplbengkel` varchar(20) NOT NULL,
  `utambahan` varchar(20) NOT NULL,
  `upotongan` varchar(20) NOT NULL,
  `total` varchar(20) NOT NULL,
  `tglbayar` date NOT NULL,
  `status` int(1) NOT NULL,
  `inputx` datetime NOT NULL,
  `updatex` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `x23_kompensasi` */

/*Table structure for table `x23_komsetbruto` */

DROP TABLE IF EXISTS `x23_komsetbruto`;

CREATE TABLE `x23_komsetbruto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `omsetbruto` varchar(22) NOT NULL,
  `persenkomisi` varchar(22) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `x23_komsetbruto` */

insert  into `x23_komsetbruto`(`id`,`omsetbruto`,`persenkomisi`) values (12,'0','5');

/*Table structure for table `x23_kwitansi` */

DROP TABLE IF EXISTS `x23_kwitansi`;

CREATE TABLE `x23_kwitansi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jnskwitansi` varchar(20) NOT NULL,
  `nokwitansi` varchar(20) NOT NULL,
  `tahun` year(4) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `tanggal` date NOT NULL,
  `nomor` varchar(20) NOT NULL,
  `noindent` varchar(20) NOT NULL,
  `idpotkom` int(11) NOT NULL,
  `idpelanggan` int(11) NOT NULL,
  `noantrian` varchar(3) NOT NULL,
  `nopol` varchar(20) NOT NULL,
  `waktuselesai` time NOT NULL,
  `jumlah` varchar(20) NOT NULL,
  `jumlahho` varchar(20) NOT NULL,
  `pembulatan` varchar(20) NOT NULL,
  `user` int(11) NOT NULL,
  `keterangan` varchar(30) NOT NULL,
  `tambahdp` int(1) NOT NULL,
  `cetak` int(1) NOT NULL,
  `status` int(11) NOT NULL,
  `inputx` datetime NOT NULL,
  `updatex` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `x23_kwitansi` */

/*Table structure for table `x23_kwitansikpb` */

DROP TABLE IF EXISTS `x23_kwitansikpb`;

CREATE TABLE `x23_kwitansikpb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nokwitansi` varchar(20) NOT NULL,
  `tglkpb` date NOT NULL,
  `nopkb` varchar(30) NOT NULL,
  `nonotaservis` varchar(30) NOT NULL,
  `kodepaket` varchar(30) NOT NULL,
  `tglpenagihan` date NOT NULL,
  `jumlahtagih` varchar(20) NOT NULL,
  `jumlahtagih2` varchar(20) NOT NULL,
  `iduser` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `x23_kwitansikpb` */

/*Table structure for table `x23_lembur` */

DROP TABLE IF EXISTS `x23_lembur`;

CREATE TABLE `x23_lembur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idkaryawan` int(11) NOT NULL,
  `tahun` year(4) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `tanggal` date NOT NULL,
  `updatex` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `x23_lembur` */

/*Table structure for table `x23_masterbarang` */

DROP TABLE IF EXISTS `x23_masterbarang`;

CREATE TABLE `x23_masterbarang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jns` varchar(20) NOT NULL,
  `kodebarang` varchar(20) NOT NULL,
  `namabarang` varchar(50) NOT NULL,
  `varian` varchar(50) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `idsupplier` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `x23_masterbarang` */

insert  into `x23_masterbarang`(`id`,`jns`,`kodebarang`,`namabarang`,`varian`,`satuan`,`idsupplier`) values (1,'SPARE PART','BD-VR-MM-R-002','BODY VARIO KANAN','MERAH','Pcs',1);
insert  into `x23_masterbarang`(`id`,`jns`,`kodebarang`,`namabarang`,`varian`,`satuan`,`idsupplier`) values (2,'SPARE PART','BD-VR-MM-L-002','BODY VARIO KIRI','MERAH','Pcs',1);
insert  into `x23_masterbarang`(`id`,`jns`,`kodebarang`,`namabarang`,`varian`,`satuan`,`idsupplier`) values (3,'SPARE PART','SP-BT-MM-01L','SPION KIRI HONDA BEAT','KIRI HITAM','Pcs',1);
insert  into `x23_masterbarang`(`id`,`jns`,`kodebarang`,`namabarang`,`varian`,`satuan`,`idsupplier`) values (4,'SPARE PART','SP-BT-MM-01R','SPION KANAN HONDA BEAT','KANAN HITAM','',1);
insert  into `x23_masterbarang`(`id`,`jns`,`kodebarang`,`namabarang`,`varian`,`satuan`,`idsupplier`) values (5,'SPARE PART','Q2EQEQ 122','ERWER','AWERAE AEWR','',1);
insert  into `x23_masterbarang`(`id`,`jns`,`kodebarang`,`namabarang`,`varian`,`satuan`,`idsupplier`) values (6,'OLI','MPX001','MPX 123','AWERAE AEWR','',1);
insert  into `x23_masterbarang`(`id`,`jns`,`kodebarang`,`namabarang`,`varian`,`satuan`,`idsupplier`) values (7,'OLI','MPX002','MPX 234','WAER234 23','',1);
insert  into `x23_masterbarang`(`id`,`jns`,`kodebarang`,`namabarang`,`varian`,`satuan`,`idsupplier`) values (8,'OLI','MPX003','MPX 345','233342341','',1);
insert  into `x23_masterbarang`(`id`,`jns`,`kodebarang`,`namabarang`,`varian`,`satuan`,`idsupplier`) values (9,'OLI','MPX004','MPX 456','1AEWR123','',1);
insert  into `x23_masterbarang`(`id`,`jns`,`kodebarang`,`namabarang`,`varian`,`satuan`,`idsupplier`) values (10,'OLI','ER1123','VBRTFQWE','WER21ER','',1);
insert  into `x23_masterbarang`(`id`,`jns`,`kodebarang`,`namabarang`,`varian`,`satuan`,`idsupplier`) values (11,'SPARE PART','1231223','111111232','112312','',2);
insert  into `x23_masterbarang`(`id`,`jns`,`kodebarang`,`namabarang`,`varian`,`satuan`,`idsupplier`) values (12,'OLI','33333','123112312','222222','',2);
insert  into `x23_masterbarang`(`id`,`jns`,`kodebarang`,`namabarang`,`varian`,`satuan`,`idsupplier`) values (13,'SPARE PART','BSK231','BUSI','BUSI','',3);
insert  into `x23_masterbarang`(`id`,`jns`,`kodebarang`,`namabarang`,`varian`,`satuan`,`idsupplier`) values (14,'SPARE PART','SG00324545','LAMPU SIGN MIO','KIRI','',2);

/*Table structure for table `x23_masterjasa` */

DROP TABLE IF EXISTS `x23_masterjasa`;

CREATE TABLE `x23_masterjasa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kodejasa` varchar(20) NOT NULL,
  `namajasa` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `x23_masterjasa` */

insert  into `x23_masterjasa`(`id`,`kodejasa`,`namajasa`) values (3,'SR-A-001','GANTI BUSI');
insert  into `x23_masterjasa`(`id`,`kodejasa`,`namajasa`) values (4,'SR-A-002','GANTI OLI');
insert  into `x23_masterjasa`(`id`,`kodejasa`,`namajasa`) values (5,'J003','TES JASA');
insert  into `x23_masterjasa`(`id`,`kodejasa`,`namajasa`) values (6,'J004','TESTING LAGI');

/*Table structure for table `x23_masteroli` */

DROP TABLE IF EXISTS `x23_masteroli`;

CREATE TABLE `x23_masteroli` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kodeoli` varchar(20) NOT NULL,
  `namaoli` varchar(50) NOT NULL,
  `varian` varchar(50) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `idsupplier` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `x23_masteroli` */

/*Table structure for table `x23_notabeli` */

DROP TABLE IF EXISTS `x23_notabeli`;

CREATE TABLE `x23_notabeli` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jns` varchar(10) NOT NULL,
  `nokwitansi` varchar(20) NOT NULL,
  `nonota` varchar(30) NOT NULL,
  `idsupplier` int(11) NOT NULL,
  `tahun` year(4) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `tglnota` date NOT NULL,
  `nopo` varchar(30) NOT NULL,
  `tglpo` date NOT NULL,
  `totalqty` varchar(20) NOT NULL,
  `grandtotal` varchar(20) NOT NULL,
  `grandtotalppn` varchar(20) NOT NULL,
  `gtbayar` varchar(20) NOT NULL,
  `bayar` varchar(20) NOT NULL,
  `tglbayar` date NOT NULL,
  `status` int(1) NOT NULL,
  `konf` int(1) NOT NULL,
  `scan` int(1) NOT NULL,
  `dk` int(1) NOT NULL,
  `harga` int(1) NOT NULL,
  `iduserbeli` int(11) NOT NULL,
  `iduserkonf` int(11) NOT NULL,
  `iduserbyr` int(11) NOT NULL,
  `inputx` datetime NOT NULL,
  `updatex` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `x23_notabeli` */

/*Table structure for table `x23_notabeli_det` */

DROP TABLE IF EXISTS `x23_notabeli_det`;

CREATE TABLE `x23_notabeli_det` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nonota` varchar(20) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `hargabelibersih` varchar(20) NOT NULL,
  `qty` varchar(4) NOT NULL,
  `total` varchar(20) NOT NULL,
  `status` int(1) NOT NULL,
  `tgltiba` date NOT NULL,
  `idgudang` int(11) NOT NULL,
  `rak` varchar(20) NOT NULL,
  `id_claimoli_det` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `x23_notabeli_det` */

/*Table structure for table `x23_notajual` */

DROP TABLE IF EXISTS `x23_notajual`;

CREATE TABLE `x23_notajual` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nonota` varchar(20) NOT NULL,
  `notaindent` varchar(20) NOT NULL,
  `idpelanggan` int(11) NOT NULL,
  `tahun` year(4) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `tglnota` date NOT NULL,
  `totalqty` varchar(20) NOT NULL,
  `totdiskon` varchar(20) NOT NULL,
  `tothargabelibersih` varchar(20) NOT NULL,
  `grandtotal` varchar(20) NOT NULL,
  `status` int(1) NOT NULL,
  `iduser` int(11) NOT NULL,
  `inputx` datetime NOT NULL,
  `updatex` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `x23_notajual` */

/*Table structure for table `x23_notajual_det` */

DROP TABLE IF EXISTS `x23_notajual_det`;

CREATE TABLE `x23_notajual_det` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notabeli` varchar(20) NOT NULL,
  `nonota` varchar(20) NOT NULL,
  `notaindent` varchar(20) NOT NULL,
  `tahun` year(4) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `tglnota` date NOT NULL,
  `idbarang` int(11) NOT NULL,
  `hargabelibersih` varchar(20) NOT NULL,
  `hargajual` varchar(20) NOT NULL,
  `diskon` varchar(20) NOT NULL,
  `hargajualbersih` varchar(20) NOT NULL,
  `qtyindent` varchar(20) NOT NULL,
  `qtyindentsisa` varchar(20) NOT NULL,
  `qty` varchar(4) NOT NULL,
  `tothargabelibersih` varchar(20) NOT NULL,
  `totdiskon` varchar(20) NOT NULL,
  `total` varchar(20) NOT NULL,
  `idgudang` int(11) NOT NULL,
  `rak` varchar(20) NOT NULL,
  `tgltagihan` date NOT NULL,
  `idtagihan` int(11) NOT NULL,
  `tglbayarkpb` date NOT NULL,
  `jumlahbayarkpb` varchar(20) NOT NULL,
  `idbayar` int(11) NOT NULL,
  `statusbayar` int(1) NOT NULL,
  `statusulang` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `x23_notajual_det` */

/*Table structure for table `x23_notaretur` */

DROP TABLE IF EXISTS `x23_notaretur`;

CREATE TABLE `x23_notaretur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `noretur` varchar(20) NOT NULL,
  `idsupplier` int(11) NOT NULL,
  `nonota` varchar(20) NOT NULL,
  `jumlah` varchar(20) NOT NULL,
  `potong` varchar(20) NOT NULL,
  `sisa` varchar(20) NOT NULL,
  `nonota2` varchar(20) NOT NULL,
  `iduser` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `x23_notaretur` */

/*Table structure for table `x23_notaretur_use` */

DROP TABLE IF EXISTS `x23_notaretur_use`;

CREATE TABLE `x23_notaretur_use` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `noretur` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `tahun` year(4) NOT NULL,
  `idsupplier` int(11) NOT NULL,
  `jumlah` varchar(20) NOT NULL,
  `nonota2` varchar(20) NOT NULL,
  `iduser` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `x23_notaretur_use` */

/*Table structure for table `x23_notaservice` */

DROP TABLE IF EXISTS `x23_notaservice`;

CREATE TABLE `x23_notaservice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jns` varchar(20) NOT NULL,
  `noclaim` varchar(20) NOT NULL,
  `noservis` varchar(20) NOT NULL,
  `nonota` varchar(20) NOT NULL,
  `noantrian` varchar(4) NOT NULL,
  `nopkb` varchar(20) NOT NULL,
  `idpelanggan` int(11) NOT NULL,
  `tahun` year(4) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `tglnota` date NOT NULL,
  `jammulai` time NOT NULL,
  `tglselesai` date NOT NULL,
  `jamselesai` time NOT NULL,
  `nopol` varchar(10) NOT NULL,
  `nomesin` varchar(40) NOT NULL,
  `norangka` varchar(40) NOT NULL,
  `kodemotor` varchar(50) NOT NULL,
  `tipemotor` varchar(40) NOT NULL,
  `varianmotor` varchar(40) NOT NULL,
  `warnamotor` varchar(20) NOT NULL,
  `tahunmotor` varchar(4) NOT NULL,
  `km` varchar(8) NOT NULL,
  `tglbelimotor` date NOT NULL,
  `idmekanik` int(11) NOT NULL,
  `tottarifaslisvc` varchar(20) NOT NULL,
  `totdiskonsvc` varchar(20) NOT NULL,
  `totservice` varchar(20) NOT NULL,
  `tothargabelisp` varchar(20) NOT NULL,
  `totdiskonsp` varchar(20) NOT NULL,
  `totsparepart` varchar(20) NOT NULL,
  `grandtotal` varchar(20) NOT NULL,
  `status` int(1) NOT NULL,
  `statuskwitansi` int(1) NOT NULL,
  `iduser` int(11) NOT NULL,
  `inputx` datetime NOT NULL,
  `updatex` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `x23_notaservice` */

/*Table structure for table `x23_notaservice_det` */

DROP TABLE IF EXISTS `x23_notaservice_det`;

CREATE TABLE `x23_notaservice_det` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nonota` varchar(20) NOT NULL,
  `nopkb` varchar(20) NOT NULL,
  `tahun` year(4) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `tglnota` date NOT NULL,
  `kodepaket` varchar(20) NOT NULL,
  `idjasa` int(11) NOT NULL,
  `tarifasli` varchar(20) NOT NULL DEFAULT '0',
  `diskon` varchar(20) NOT NULL DEFAULT '0',
  `tarif` varchar(20) NOT NULL DEFAULT '0',
  `tarifkpb` varchar(20) NOT NULL DEFAULT '0',
  `tgltagihan` date NOT NULL,
  `idtagihan` int(11) NOT NULL,
  `tglbayarkpb` date NOT NULL,
  `jumlahbayarkpb` varchar(20) NOT NULL DEFAULT '0',
  `idbayar` int(11) NOT NULL,
  `statusbayar` int(1) NOT NULL,
  `statusclaim` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `x23_notaservice_det` */

/*Table structure for table `x23_opname` */

DROP TABLE IF EXISTS `x23_opname`;

CREATE TABLE `x23_opname` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` year(4) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `tanggal` date NOT NULL,
  `idgudang` int(11) NOT NULL,
  `totselisih` varchar(20) NOT NULL,
  `totjumselisih` varchar(20) NOT NULL,
  `user` varbinary(20) NOT NULL,
  `status` int(1) NOT NULL,
  `inputx` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `x23_opname` */

/*Table structure for table `x23_opname_det` */

DROP TABLE IF EXISTS `x23_opname_det`;

CREATE TABLE `x23_opname_det` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idstok` int(11) NOT NULL,
  `idopname` int(11) NOT NULL,
  `idgudang` int(11) NOT NULL,
  `rak` varchar(20) NOT NULL,
  `nonota` varchar(20) NOT NULL,
  `tglnota` date NOT NULL,
  `idbarang` int(11) NOT NULL,
  `stok` varchar(20) NOT NULL,
  `opname` varchar(20) NOT NULL,
  `hargabeli` varchar(20) NOT NULL,
  `selisih` varchar(20) NOT NULL,
  `totalselisih` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `x23_opname_det` */

/*Table structure for table `x23_pangkat` */

DROP TABLE IF EXISTS `x23_pangkat`;

CREATE TABLE `x23_pangkat` (
  `pangkat` varchar(20) NOT NULL,
  PRIMARY KEY (`pangkat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `x23_pangkat` */

insert  into `x23_pangkat`(`pangkat`) values ('KEPALA MEKANIK');
insert  into `x23_pangkat`(`pangkat`) values ('PMT1');
insert  into `x23_pangkat`(`pangkat`) values ('PMT2');
insert  into `x23_pangkat`(`pangkat`) values ('PMT3');

/*Table structure for table `x23_penagihankpb` */

DROP TABLE IF EXISTS `x23_penagihankpb`;

CREATE TABLE `x23_penagihankpb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tglkpb` date NOT NULL,
  `nopkb` varchar(30) NOT NULL,
  `nonotaservis` varchar(30) NOT NULL,
  `kodepaket` varchar(250) NOT NULL,
  `idpelanggan` int(11) NOT NULL,
  `idmekanik` int(11) NOT NULL,
  `statuspenagihan` int(11) NOT NULL,
  `tglpenagihan` date NOT NULL,
  `ketpenagihan` varchar(100) NOT NULL,
  `jumlahtagih` varchar(20) NOT NULL,
  `jumlahtagih2` varchar(20) NOT NULL,
  `statuspembayaran` varchar(20) NOT NULL,
  `tagihkembali` varchar(20) NOT NULL,
  `kettolak` varchar(400) NOT NULL,
  `tglpembayaran` date NOT NULL,
  `jumlahbayar` varchar(20) NOT NULL,
  `idbayar` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `x23_penagihankpb` */

/*Table structure for table `x23_pindah` */

DROP TABLE IF EXISTS `x23_pindah`;

CREATE TABLE `x23_pindah` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` year(4) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `tanggal` date NOT NULL,
  `dealer1` varchar(20) NOT NULL,
  `dealer2` varchar(20) NOT NULL,
  `idgudang1` int(11) NOT NULL,
  `idgudang2` int(11) NOT NULL,
  `rak1` varchar(20) NOT NULL,
  `rak2` varchar(20) NOT NULL,
  `user` varchar(20) NOT NULL,
  `status` int(1) NOT NULL,
  `inputx` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `x23_pindah` */

/*Table structure for table `x23_pindah_det` */

DROP TABLE IF EXISTS `x23_pindah_det`;

CREATE TABLE `x23_pindah_det` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idpindah` int(11) NOT NULL,
  `nonota` varchar(20) NOT NULL,
  `dealer1` varchar(20) NOT NULL,
  `dealer2` varchar(20) NOT NULL,
  `idgudang1` int(11) NOT NULL,
  `idgudang2` int(11) NOT NULL,
  `rak1` varchar(20) NOT NULL,
  `rak2` varchar(20) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `qty` varchar(20) NOT NULL,
  `hargabelibersih` varchar(20) NOT NULL,
  `hargajual` varchar(20) NOT NULL,
  `hargajual2` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `x23_pindah_det` */

/*Table structure for table `x23_piutang` */

DROP TABLE IF EXISTS `x23_piutang`;

CREATE TABLE `x23_piutang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis` varchar(20) NOT NULL,
  `idkaryawan` int(11) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `tgl` date NOT NULL,
  `jumlah` varchar(20) NOT NULL,
  `ket` varchar(100) NOT NULL,
  `metodebayar` varchar(20) NOT NULL,
  `status` int(1) NOT NULL,
  `potkompensasi` int(1) NOT NULL,
  `iduser` int(11) NOT NULL,
  `inputx` datetime NOT NULL,
  `updatex` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `x23_piutang` */

/*Table structure for table `x23_posisi` */

DROP TABLE IF EXISTS `x23_posisi`;

CREATE TABLE `x23_posisi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `posisi` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `x23_posisi` */

insert  into `x23_posisi`(`id`,`posisi`) values (1,'ADMINISTRATOR');
insert  into `x23_posisi`(`id`,`posisi`) values (2,'KASIR');
insert  into `x23_posisi`(`id`,`posisi`) values (3,'SALES ADVISOR');
insert  into `x23_posisi`(`id`,`posisi`) values (4,'MEKANIK');
insert  into `x23_posisi`(`id`,`posisi`) values (5,'COUNTER PART');
insert  into `x23_posisi`(`id`,`posisi`) values (6,'DIREKSI');
insert  into `x23_posisi`(`id`,`posisi`) values (7,'KEPALA BENGKEL');

/*Table structure for table `x23_potkompensasi` */

DROP TABLE IF EXISTS `x23_potkompensasi`;

CREATE TABLE `x23_potkompensasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idkaryawan` int(11) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `tgl` date NOT NULL,
  `jumlah` varchar(20) NOT NULL,
  `ket` varchar(100) NOT NULL,
  `metodebayar` varchar(20) NOT NULL,
  `iduser` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `potkompensasi` int(1) NOT NULL,
  `inputx` datetime NOT NULL,
  `updatex` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `x23_potkompensasi` */

/*Table structure for table `x23_rak` */

DROP TABLE IF EXISTS `x23_rak`;

CREATE TABLE `x23_rak` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rak` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `x23_rak` */

insert  into `x23_rak`(`id`,`rak`) values (1,'A1.03.1.1');
insert  into `x23_rak`(`id`,`rak`) values (2,'A1.03.1.2');
insert  into `x23_rak`(`id`,`rak`) values (3,'A1.03.1.3');
insert  into `x23_rak`(`id`,`rak`) values (4,'A1.03.1.4');
insert  into `x23_rak`(`id`,`rak`) values (5,'A1.03.1.5');
insert  into `x23_rak`(`id`,`rak`) values (6,'A1.03.1.6');
insert  into `x23_rak`(`id`,`rak`) values (7,'A1.03.1.7');
insert  into `x23_rak`(`id`,`rak`) values (8,'A1.03.1.8');
insert  into `x23_rak`(`id`,`rak`) values (9,'A1.03.1.9');

/*Table structure for table `x23_returbeli` */

DROP TABLE IF EXISTS `x23_returbeli`;

CREATE TABLE `x23_returbeli` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `noretur` varchar(20) NOT NULL,
  `nonota` varchar(20) NOT NULL,
  `nopo` varchar(20) NOT NULL,
  `tahun` year(4) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `tanggal` date NOT NULL,
  `user` int(11) NOT NULL,
  `idgdg` int(11) NOT NULL,
  `idsupplier` int(11) NOT NULL,
  `qtykeluar` varchar(20) NOT NULL,
  `totalkeluar` varchar(20) NOT NULL,
  `status` int(1) NOT NULL,
  `inputx` datetime NOT NULL,
  `updatex` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `x23_returbeli` */

/*Table structure for table `x23_returbeli_det` */

DROP TABLE IF EXISTS `x23_returbeli_det`;

CREATE TABLE `x23_returbeli_det` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `noretur` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `nonota` varchar(20) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `hargabelibersih` varchar(20) NOT NULL,
  `qtykeluar` varchar(4) NOT NULL,
  `totalkeluar` varchar(20) NOT NULL,
  `qty` varchar(4) NOT NULL,
  `total` varchar(20) NOT NULL,
  `status` int(1) NOT NULL,
  `tglretur` date NOT NULL,
  `ket` varchar(20) NOT NULL,
  `idgudang` int(11) NOT NULL,
  `rak` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `x23_returbeli_det` */

/*Table structure for table `x23_returjual` */

DROP TABLE IF EXISTS `x23_returjual`;

CREATE TABLE `x23_returjual` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` year(4) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `tanggal` date NOT NULL,
  `noreturjual` varchar(20) NOT NULL,
  `nonotajual` varchar(20) NOT NULL,
  `qtyretur` varchar(20) NOT NULL,
  `jumlah` varchar(20) NOT NULL,
  `iduser` int(11) NOT NULL,
  `inputx` datetime NOT NULL,
  `updatex` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `x23_returjual` */

/*Table structure for table `x23_returjual_det` */

DROP TABLE IF EXISTS `x23_returjual_det`;

CREATE TABLE `x23_returjual_det` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notabeli` varchar(20) NOT NULL,
  `noreturjual` varchar(20) NOT NULL,
  `nonotajual` varchar(20) NOT NULL,
  `tahun` year(4) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `tglnota` date NOT NULL,
  `idbarang` int(11) NOT NULL,
  `hargabelibersih` varchar(20) NOT NULL,
  `hargajual` varchar(20) NOT NULL,
  `diskon` varchar(20) NOT NULL,
  `hargajualbersih` varchar(20) NOT NULL,
  `qty` varchar(4) NOT NULL,
  `tothargabelibersih` varchar(20) NOT NULL,
  `totdiskon` varchar(20) NOT NULL,
  `total` varchar(20) NOT NULL,
  `idgudang` int(11) NOT NULL,
  `rak` varchar(20) NOT NULL,
  `tgltagihan` date NOT NULL,
  `idtagihan` int(11) NOT NULL,
  `tglbayarkpb` date NOT NULL,
  `jumlahbayarkpb` varchar(20) NOT NULL,
  `idbayar` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `x23_returjual_det` */

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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Data for the table `x23_scanhistory` */

insert  into `x23_scanhistory`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`aksi`,`status`) values (1,2016,'08','2016-08-18','00:00:00','startup',0);
insert  into `x23_scanhistory`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`aksi`,`status`) values (2,2016,'08','2016-08-18','00:00:00','start',0);
insert  into `x23_scanhistory`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`aksi`,`status`) values (3,2016,'08','2016-08-18','00:00:00','stop',0);
insert  into `x23_scanhistory`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`aksi`,`status`) values (4,2016,'08','2016-08-18','00:00:00','start',0);
insert  into `x23_scanhistory`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`aksi`,`status`) values (5,2016,'08','2016-08-19','00:00:00','start',0);
insert  into `x23_scanhistory`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`aksi`,`status`) values (6,2016,'08','2016-08-20','06:50:26','startup',0);
insert  into `x23_scanhistory`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`aksi`,`status`) values (7,2016,'08','2016-08-20','06:51:30','stop',0);
insert  into `x23_scanhistory`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`aksi`,`status`) values (8,2016,'08','2016-08-20','06:51:38','start',0);
insert  into `x23_scanhistory`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`aksi`,`status`) values (9,2016,'08','2016-08-20','06:54:02','stop',0);
insert  into `x23_scanhistory`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`aksi`,`status`) values (10,2016,'08','2016-08-20','06:54:12','start',0);
insert  into `x23_scanhistory`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`aksi`,`status`) values (11,2016,'08','2016-08-20','06:56:22','stop',0);
insert  into `x23_scanhistory`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`aksi`,`status`) values (12,2016,'08','2016-08-20','06:56:31','start',0);
insert  into `x23_scanhistory`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`aksi`,`status`) values (13,2016,'08','2016-08-20','06:57:23','startup',0);
insert  into `x23_scanhistory`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`aksi`,`status`) values (14,2016,'08','2016-08-20','06:57:56','startup',0);
insert  into `x23_scanhistory`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`aksi`,`status`) values (15,2016,'08','2016-08-20','06:59:11','stop',0);
insert  into `x23_scanhistory`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`aksi`,`status`) values (16,2016,'09','2016-09-01','06:59:11','start',0);
insert  into `x23_scanhistory`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`aksi`,`status`) values (17,2016,'09','2016-09-02','06:59:11','start',0);
insert  into `x23_scanhistory`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`aksi`,`status`) values (18,2016,'12','2016-12-09','06:59:11','start',0);
insert  into `x23_scanhistory`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`aksi`,`status`) values (19,2016,'12','2016-12-30','06:59:11','start',0);
insert  into `x23_scanhistory`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`aksi`,`status`) values (20,2017,'02','2017-03-15','06:59:11','start',0);

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
) ENGINE=InnoDB AUTO_INCREMENT=195 DEFAULT CHARSET=latin1;

/*Data for the table `x23_scankeluar` */

insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (1,2016,'08','2016-08-01','15:02:05',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (2,2016,'08','2016-08-01','15:02:05',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (3,2016,'08','2016-08-02','15:02:05',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (4,2016,'08','2016-08-03','15:02:05',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (5,2016,'08','2016-08-04','15:02:05',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (6,2016,'08','2016-08-04','15:02:05',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (7,2016,'08','2016-08-04','15:02:05',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (8,2016,'08','2016-08-05','15:02:05',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (9,2016,'08','2016-08-05','15:02:05',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (10,2016,'08','2016-08-05','15:02:05',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (11,2016,'08','2016-08-05','15:02:05',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (12,2016,'08','2016-08-06','15:02:05',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (13,2016,'08','2016-08-07','15:02:05',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (14,2016,'08','2016-08-10','15:02:05',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (15,2016,'08','2016-08-10','15:02:05',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (16,2016,'08','2016-08-10','15:02:05',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (17,2016,'08','2016-08-10','15:02:05',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (18,2016,'08','2016-08-10','15:02:05',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (19,2016,'08','2016-08-10','15:02:05',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (20,2016,'08','2016-08-10','15:02:05',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (21,2016,'08','2016-08-10','15:02:05',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (22,2016,'08','2016-08-13','19:35:45',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (23,2016,'08','2016-08-13','19:35:51',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (24,2016,'08','2016-08-13','19:36:00',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (25,2016,'08','2016-08-13','19:36:09',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (26,2016,'08','2016-08-13','19:36:16',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (27,2016,'08','2016-08-13','19:36:21',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (28,2016,'08','2016-08-13','19:37:25',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (29,2016,'08','2016-08-13','19:38:21',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (30,2016,'08','2016-08-13','19:46:13',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (31,2016,'08','2016-08-13','19:46:27',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (32,2016,'08','2016-08-13','19:46:38',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (33,2016,'08','2016-08-13','19:46:50',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (34,2016,'08','2016-08-13','19:50:14',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (35,2016,'08','2016-08-13','19:50:51',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (36,2016,'08','2016-08-13','19:58:41',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (37,2016,'08','2016-08-13','19:58:49',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (38,2016,'08','2016-08-13','19:59:00',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (39,2016,'08','2016-08-13','19:59:06',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (40,2016,'08','2016-08-13','19:59:14',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (41,2016,'08','2016-08-13','19:59:21',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (42,2016,'08','2016-08-13','19:59:30',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (43,2016,'08','2016-08-13','19:59:35',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (44,2016,'08','2016-08-13','19:59:40',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (45,2016,'08','2016-08-13','19:59:47',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (46,2016,'08','2016-08-13','20:00:10',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (47,2016,'08','2016-08-13','20:00:26',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (48,2016,'08','2016-08-13','20:00:32',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (49,2016,'08','2016-08-13','20:04:58',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (50,2016,'08','2016-08-13','20:05:07',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (51,2016,'08','2016-08-13','20:05:19',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (52,2016,'08','2016-08-13','20:05:46',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (53,2016,'08','2016-08-13','20:05:51',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (54,2016,'08','2016-08-13','20:12:57',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (55,2016,'08','2016-08-13','20:13:06',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (56,2016,'08','2016-08-13','20:13:48',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (57,2016,'08','2016-08-13','20:13:53',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (58,2016,'08','2016-08-13','20:14:00',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (59,2016,'08','2016-08-13','20:14:06',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (60,2016,'08','2016-08-13','20:14:18',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (61,2016,'08','2016-08-13','20:14:39',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (62,2016,'08','2016-08-13','20:15:02',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (63,2016,'08','2016-08-13','20:15:15',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (64,2016,'08','2016-08-13','20:15:25',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (65,2016,'08','2016-08-13','20:15:34',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (66,2016,'08','2016-08-13','20:15:46',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (67,2016,'08','2016-08-13','20:15:56',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (68,2016,'08','2016-08-13','20:16:06',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (69,2016,'08','2016-08-13','20:16:12',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (70,2016,'08','2016-08-13','20:16:17',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (71,2016,'08','2016-08-13','20:16:28',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (72,2016,'08','2016-08-13','20:16:37',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (73,2016,'08','2016-08-13','20:16:42',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (74,2016,'08','2016-08-13','20:17:00',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (75,2016,'08','2016-08-13','20:17:10',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (76,2016,'08','2016-08-13','20:17:20',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (77,2016,'08','2016-08-13','20:17:30',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (78,2016,'08','2016-08-13','20:17:36',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (79,2016,'08','2016-08-13','20:17:42',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (80,2016,'08','2016-08-13','20:17:47',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (81,2016,'08','2016-08-13','20:17:54',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (82,2016,'08','2016-08-13','20:18:01',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (83,2016,'08','2016-08-13','20:18:12',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (84,2016,'08','2016-08-13','20:18:21',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (85,2016,'08','2016-08-13','20:18:27',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (86,2016,'08','2016-08-13','20:18:33',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (87,2016,'08','2016-08-13','20:18:38',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (88,2016,'08','2016-08-13','20:18:45',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (89,2016,'08','2016-08-13','20:19:03',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (90,2016,'08','2016-08-13','20:19:14',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (91,2016,'08','2016-08-13','20:19:19',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (92,2016,'08','2016-08-13','20:19:26',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (93,2016,'08','2016-08-13','20:19:33',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (94,2016,'08','2016-08-13','20:19:43',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (95,2016,'08','2016-08-13','20:19:57',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (96,2016,'08','2016-08-13','20:20:05',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (97,2016,'08','2016-08-13','20:20:15',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (98,2016,'08','2016-08-13','20:20:26',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (99,2016,'08','2016-08-13','20:20:35',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (100,2016,'08','2016-08-13','20:20:40',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (101,2016,'08','2016-08-13','20:20:54',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (102,2016,'08','2016-08-13','20:21:05',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (103,2016,'08','2016-08-13','20:21:05',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (104,2016,'08','2016-08-18','00:00:00',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (105,2016,'08','2016-08-18','00:00:00',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (106,2016,'08','2016-08-18','00:00:00',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (107,2016,'08','2016-08-18','00:00:00',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (108,2016,'08','2016-08-18','00:00:00',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (109,2016,'08','2016-08-18','00:00:00',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (110,2016,'08','2016-08-18','00:00:00',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (148,2016,'08','2016-08-18','00:00:00',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (149,2016,'08','2016-08-19','15:02:05',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (150,2016,'08','2016-08-19','15:02:05',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (151,2016,'08','2016-08-19','15:02:05',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (152,2016,'08','2016-08-19','15:02:05',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (153,2016,'08','2016-08-19','15:02:05',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (154,2016,'08','2016-08-19','15:02:05',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (155,2016,'08','2016-08-19','15:02:05',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (156,2016,'08','2016-08-19','15:02:05',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (157,2016,'08','2016-08-19','15:02:05',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (158,2016,'08','2016-08-19','15:02:05',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (159,2016,'08','2016-08-19','15:02:05',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (160,2016,'08','2016-08-19','15:02:05',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (161,2016,'08','2016-08-19','15:02:05',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (162,2016,'08','2016-08-19','15:02:05',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (163,2016,'08','2016-08-19','15:02:05',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (164,2016,'08','2016-08-19','15:02:05',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (165,2016,'08','2016-08-19','15:02:05',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (166,2016,'08','2016-08-20','06:50:31',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (167,2016,'08','2016-08-20','06:50:36',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (168,2016,'08','2016-08-20','06:51:26',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (169,2016,'08','2016-08-20','06:51:32',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (170,2016,'08','2016-08-20','06:51:42',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (171,2016,'08','2016-08-20','06:52:26',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (172,2016,'08','2016-08-20','06:52:32',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (173,2016,'08','2016-08-20','06:52:43',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (174,2016,'08','2016-08-20','06:52:49',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (175,2016,'08','2016-08-20','06:53:02',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (176,2016,'08','2016-08-20','06:53:08',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (177,2016,'08','2016-08-20','06:53:21',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (178,2016,'08','2016-08-20','06:53:26',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (179,2016,'08','2016-08-20','06:53:53',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (180,2016,'08','2016-08-20','06:54:16',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (181,2016,'08','2016-08-20','06:54:26',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (182,2016,'08','2016-08-20','06:54:32',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (183,2016,'08','2016-08-20','06:54:39',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (184,2016,'08','2016-08-20','06:54:45',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (185,2016,'08','2016-08-20','06:54:50',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (186,2016,'08','2016-08-20','06:54:58',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (187,2016,'08','2016-08-20','06:55:06',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (188,2016,'08','2016-08-20','06:55:11',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (189,2016,'08','2016-08-20','06:55:41',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (190,2016,'08','2016-08-20','06:56:00',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (191,2016,'08','2016-08-20','06:56:05',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (192,2016,'08','2016-08-20','06:56:11',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (193,2016,'08','2016-08-20','06:56:17',0);
insert  into `x23_scankeluar`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (194,2016,'08','2016-08-20','06:56:23',0);

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
) ENGINE=InnoDB AUTO_INCREMENT=146 DEFAULT CHARSET=latin1;

/*Data for the table `x23_scanmasuk` */

insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (1,2016,'08','2016-08-01','15:02:05',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (2,2016,'08','2016-08-01','15:02:05',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (3,2016,'08','2016-08-02','15:02:05',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (4,2016,'08','2016-08-03','15:02:05',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (5,2016,'08','2016-08-04','15:02:05',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (6,2016,'08','2016-08-04','15:02:05',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (7,2016,'08','2016-08-04','15:02:05',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (8,2016,'08','2016-08-05','15:02:05',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (9,2016,'08','2016-08-05','15:02:05',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (10,2016,'08','2016-08-05','15:02:05',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (11,2016,'08','2016-08-05','15:02:05',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (12,2016,'08','2016-08-06','15:02:05',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (13,2016,'08','2016-08-07','15:02:05',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (14,2016,'08','2016-08-10','15:02:05',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (15,2016,'08','2016-08-10','15:02:05',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (16,2016,'08','2016-08-10','15:02:05',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (17,2016,'08','2016-08-10','15:02:05',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (18,2016,'08','2016-08-10','15:02:05',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (19,2016,'08','2016-08-10','15:02:05',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (20,2016,'08','2016-08-10','15:02:05',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (21,2016,'08','2016-08-10','15:02:05',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (22,2016,'08','2016-08-13','19:35:52',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (23,2016,'08','2016-08-13','19:35:57',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (24,2016,'08','2016-08-13','19:36:10',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (25,2016,'08','2016-08-13','19:36:16',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (26,2016,'08','2016-08-13','19:36:22',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (27,2016,'08','2016-08-13','19:36:27',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (28,2016,'08','2016-08-13','19:37:25',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (29,2016,'08','2016-08-13','19:38:21',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (30,2016,'08','2016-08-13','19:45:45',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (31,2016,'08','2016-08-13','19:45:58',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (32,2016,'08','2016-08-13','19:46:36',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (33,2016,'08','2016-08-13','19:50:14',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (34,2016,'08','2016-08-13','19:58:40',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (35,2016,'08','2016-08-13','19:58:49',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (36,2016,'08','2016-08-13','19:58:56',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (37,2016,'08','2016-08-13','19:59:07',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (38,2016,'08','2016-08-13','19:59:14',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (39,2016,'08','2016-08-13','19:59:21',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (40,2016,'08','2016-08-13','19:59:28',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (41,2016,'08','2016-08-13','19:59:40',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (42,2016,'08','2016-08-13','20:00:10',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (43,2016,'08','2016-08-13','20:00:26',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (44,2016,'08','2016-08-13','20:05:01',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (45,2016,'08','2016-08-13','20:05:09',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (46,2016,'08','2016-08-13','20:05:24',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (47,2016,'08','2016-08-13','20:05:47',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (48,2016,'08','2016-08-13','20:05:53',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (49,2016,'08','2016-08-13','20:05:58',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (50,2016,'08','2016-08-13','20:06:03',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (51,2016,'08','2016-08-13','20:12:57',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (52,2016,'08','2016-08-13','20:13:06',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (53,2016,'08','2016-08-13','20:13:48',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (54,2016,'08','2016-08-13','20:13:54',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (55,2016,'08','2016-08-13','20:13:59',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (56,2016,'08','2016-08-13','20:14:06',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (57,2016,'08','2016-08-13','20:14:18',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (58,2016,'08','2016-08-13','20:14:40',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (59,2016,'08','2016-08-13','20:14:49',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (60,2016,'08','2016-08-13','20:14:56',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (61,2016,'08','2016-08-13','20:15:07',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (62,2016,'08','2016-08-13','20:15:19',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (63,2016,'08','2016-08-13','20:15:28',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (64,2016,'08','2016-08-13','20:15:40',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (65,2016,'08','2016-08-13','20:15:45',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (66,2016,'08','2016-08-13','20:15:54',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (67,2016,'08','2016-08-13','20:16:00',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (68,2016,'08','2016-08-13','20:16:12',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (69,2016,'08','2016-08-13','20:16:22',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (70,2016,'08','2016-08-13','20:16:33',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (71,2016,'08','2016-08-13','20:16:43',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (72,2016,'08','2016-08-13','20:16:56',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (73,2016,'08','2016-08-13','20:17:06',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (74,2016,'08','2016-08-13','20:17:14',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (75,2016,'08','2016-08-13','20:17:26',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (76,2016,'08','2016-08-13','20:17:36',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (77,2016,'08','2016-08-13','20:17:45',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (78,2016,'08','2016-08-13','20:18:06',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (79,2016,'08','2016-08-13','20:18:18',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (80,2016,'08','2016-08-13','20:18:38',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (81,2016,'08','2016-08-13','20:18:43',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (82,2016,'08','2016-08-13','20:18:57',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (83,2016,'08','2016-08-13','20:19:08',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (84,2016,'08','2016-08-13','20:19:20',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (85,2016,'08','2016-08-13','20:19:29',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (86,2016,'08','2016-08-13','20:19:39',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (87,2016,'08','2016-08-13','20:19:48',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (88,2016,'08','2016-08-13','20:19:53',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (89,2016,'08','2016-08-13','20:19:59',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (90,2016,'08','2016-08-13','20:20:09',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (91,2016,'08','2016-08-13','20:20:20',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (92,2016,'08','2016-08-13','20:20:29',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (93,2016,'08','2016-08-13','20:20:34',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (94,2016,'08','2016-08-13','20:20:40',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (95,2016,'08','2016-08-13','20:20:45',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (96,2016,'08','2016-08-13','20:20:53',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (97,2016,'08','2016-08-18','00:00:00',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (98,2016,'08','2016-08-18','00:00:00',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (99,2016,'08','2016-08-18','00:00:00',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (100,2016,'08','2016-08-18','00:00:00',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (101,2016,'08','2016-08-18','00:00:00',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (102,2016,'08','2016-08-18','00:00:00',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (103,2016,'08','2016-08-19','00:00:00',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (104,2016,'08','2016-08-19','00:00:00',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (105,2016,'08','2016-08-19','00:00:00',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (106,2016,'08','2016-08-19','00:00:00',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (107,2016,'08','2016-08-19','00:00:00',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (108,2016,'08','2016-08-19','00:00:00',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (109,2016,'08','2016-08-19','00:00:00',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (110,2016,'08','2016-08-19','00:00:00',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (111,2016,'08','2016-08-19','00:00:00',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (112,2016,'08','2016-08-19','00:00:00',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (113,2016,'08','2016-08-19','00:00:00',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (114,2016,'08','2016-08-19','00:00:00',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (115,2016,'08','2016-08-20','06:50:31',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (116,2016,'08','2016-08-20','06:50:39',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (117,2016,'08','2016-08-20','06:50:45',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (118,2016,'08','2016-08-20','06:50:59',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (119,2016,'08','2016-08-20','06:51:28',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (120,2016,'08','2016-08-20','06:51:55',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (121,2016,'08','2016-08-20','06:52:01',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (122,2016,'08','2016-08-20','06:52:06',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (123,2016,'08','2016-08-20','06:52:26',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (124,2016,'08','2016-08-20','06:52:54',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (125,2016,'08','2016-08-20','06:53:04',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (126,2016,'08','2016-08-20','06:53:13',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (127,2016,'08','2016-08-20','06:53:22',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (128,2016,'08','2016-08-20','06:53:32',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (129,2016,'08','2016-08-20','06:53:40',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (130,2016,'08','2016-08-20','06:53:46',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (131,2016,'08','2016-08-20','06:53:52',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (132,2016,'08','2016-08-20','06:54:16',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (133,2016,'08','2016-08-20','06:54:31',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (134,2016,'08','2016-08-20','06:54:39',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (135,2016,'08','2016-08-20','06:54:49',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (136,2016,'08','2016-08-20','06:54:59',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (137,2016,'08','2016-08-20','06:55:06',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (138,2016,'08','2016-08-20','06:55:11',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (139,2016,'08','2016-08-20','06:55:26',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (140,2016,'08','2016-08-20','06:55:42',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (141,2016,'08','2016-08-20','06:55:50',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (142,2016,'08','2016-08-20','06:56:07',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (143,2016,'08','2016-08-20','06:56:12',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (144,2016,'08','2016-08-20','06:56:17',0);
insert  into `x23_scanmasuk`(`id`,`tahun`,`bulan`,`tanggal`,`jam`,`status`) values (145,2016,'08','2016-08-20','06:56:24',0);

/*Table structure for table `x23_stokmin` */

DROP TABLE IF EXISTS `x23_stokmin`;

CREATE TABLE `x23_stokmin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idbarang` int(11) NOT NULL,
  `stokmin` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `x23_stokmin` */

/*Table structure for table `x23_stokpart` */

DROP TABLE IF EXISTS `x23_stokpart`;

CREATE TABLE `x23_stokpart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idgudang` int(11) NOT NULL,
  `rak` varchar(20) NOT NULL,
  `nonota` varchar(20) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `hargabelibersih` varchar(20) NOT NULL,
  `hargajual` varchar(20) NOT NULL,
  `hargajual2` varchar(20) NOT NULL,
  `stok` varchar(20) NOT NULL,
  `status` int(1) NOT NULL,
  `dk` int(1) NOT NULL,
  `inputx` datetime NOT NULL,
  `updatex` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `x23_stokpart` */

/*Table structure for table `x23_supplier` */

DROP TABLE IF EXISTS `x23_supplier`;

CREATE TABLE `x23_supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(40) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telp` varchar(20) NOT NULL,
  `fax` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `grup` int(1) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `x23_supplier` */

insert  into `x23_supplier`(`id`,`nama`,`alamat`,`telp`,`fax`,`email`,`grup`,`status`) values (1,'MPM','-','-','-','-',0,1);
insert  into `x23_supplier`(`id`,`nama`,`alamat`,`telp`,`fax`,`email`,`grup`,`status`) values (2,'SUMA','-','-','-','-',0,1);
insert  into `x23_supplier`(`id`,`nama`,`alamat`,`telp`,`fax`,`email`,`grup`,`status`) values (3,'GEMBIRA RIA','-','-','-','-',0,1);
insert  into `x23_supplier`(`id`,`nama`,`alamat`,`telp`,`fax`,`email`,`grup`,`status`) values (4,'H2H3 SUMENEP','-','-','-','-',1,1);
insert  into `x23_supplier`(`id`,`nama`,`alamat`,`telp`,`fax`,`email`,`grup`,`status`) values (5,'H2H3 BANGKALAN','-','-','-','-',1,1);
insert  into `x23_supplier`(`id`,`nama`,`alamat`,`telp`,`fax`,`email`,`grup`,`status`) values (10,'TOKO BAHAGIA','-','-','-','-',0,1);

/*Table structure for table `x23_tarifjasa` */

DROP TABLE IF EXISTS `x23_tarifjasa`;

CREATE TABLE `x23_tarifjasa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idjasa` int(11) NOT NULL,
  `pangkat` varchar(20) NOT NULL,
  `tarif` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `x23_tarifjasa` */

insert  into `x23_tarifjasa`(`id`,`idjasa`,`pangkat`,`tarif`) values (1,3,'PMT1','12000');
insert  into `x23_tarifjasa`(`id`,`idjasa`,`pangkat`,`tarif`) values (2,4,'PMT1','15000');
insert  into `x23_tarifjasa`(`id`,`idjasa`,`pangkat`,`tarif`) values (8,3,'PMT2','15500');
insert  into `x23_tarifjasa`(`id`,`idjasa`,`pangkat`,`tarif`) values (9,5,'KEPALA MEKANIK','0');
insert  into `x23_tarifjasa`(`id`,`idjasa`,`pangkat`,`tarif`) values (10,6,'KEPALA MEKANIK','10000');

/*Table structure for table `x23_tarifjasa2` */

DROP TABLE IF EXISTS `x23_tarifjasa2`;

CREATE TABLE `x23_tarifjasa2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idmekanik` int(11) NOT NULL,
  `jnsjasa` varchar(11) NOT NULL,
  `idjasa` int(11) NOT NULL,
  `kodepaket` varchar(11) NOT NULL,
  `tarif` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `x23_tarifjasa2` */

insert  into `x23_tarifjasa2`(`id`,`idmekanik`,`jnsjasa`,`idjasa`,`kodepaket`,`tarif`) values (7,5,'RETAIL',3,'',8000);
insert  into `x23_tarifjasa2`(`id`,`idmekanik`,`jnsjasa`,`idjasa`,`kodepaket`,`tarif`) values (8,6,'RETAIL',3,'',10000);
insert  into `x23_tarifjasa2`(`id`,`idmekanik`,`jnsjasa`,`idjasa`,`kodepaket`,`tarif`) values (11,6,'RETAIL',4,'',12000);
insert  into `x23_tarifjasa2`(`id`,`idmekanik`,`jnsjasa`,`idjasa`,`kodepaket`,`tarif`) values (12,7,'RETAIL',3,'',12000);
insert  into `x23_tarifjasa2`(`id`,`idmekanik`,`jnsjasa`,`idjasa`,`kodepaket`,`tarif`) values (16,5,'PAKET',0,'KJ1608-001',10000);
insert  into `x23_tarifjasa2`(`id`,`idmekanik`,`jnsjasa`,`idjasa`,`kodepaket`,`tarif`) values (17,7,'RETAIL',4,'',0);
insert  into `x23_tarifjasa2`(`id`,`idmekanik`,`jnsjasa`,`idjasa`,`kodepaket`,`tarif`) values (18,14,'RETAIL',3,'',0);

/*Table structure for table `x23_temp_hargajual` */

DROP TABLE IF EXISTS `x23_temp_hargajual`;

CREATE TABLE `x23_temp_hargajual` (
  `id` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `x23_temp_hargajual` */

/*Table structure for table `x23_temp_pindah_det` */

DROP TABLE IF EXISTS `x23_temp_pindah_det`;

CREATE TABLE `x23_temp_pindah_det` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nonota` varchar(20) NOT NULL,
  `dealer1` varchar(20) NOT NULL,
  `dealer2` varchar(20) NOT NULL,
  `idgudang1` int(11) NOT NULL,
  `idgudang2` int(11) NOT NULL,
  `rak1` varchar(20) NOT NULL,
  `rak2` varchar(20) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `qty` varchar(20) NOT NULL,
  `hargabelibersih` varchar(20) NOT NULL,
  `hargajual` varchar(20) NOT NULL,
  `hargajual2` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `x23_temp_pindah_det` */

/*Table structure for table `x23_temp_qtytiba` */

DROP TABLE IF EXISTS `x23_temp_qtytiba`;

CREATE TABLE `x23_temp_qtytiba` (
  `id` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `x23_temp_qtytiba` */

/*Table structure for table `x23_tutupharian` */

DROP TABLE IF EXISTS `x23_tutupharian`;

CREATE TABLE `x23_tutupharian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` year(4) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `tanggal` date NOT NULL,
  `penerimaan` varchar(20) NOT NULL,
  `kpb` varchar(20) NOT NULL,
  `pengeluaran` varchar(20) NOT NULL,
  `notakecil` varchar(20) NOT NULL,
  `pjs` varchar(20) NOT NULL,
  `pjmpm` varchar(20) NOT NULL,
  `ho` varchar(20) NOT NULL,
  `pembulatan` varchar(20) NOT NULL,
  `um` varchar(20) NOT NULL,
  `pelunasan` varchar(20) NOT NULL,
  `pengembalian` varchar(20) NOT NULL,
  `jumlah` varchar(20) NOT NULL,
  `iduser` int(11) NOT NULL,
  `inputx` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `x23_tutupharian` */

/*Table structure for table `x23_tutupservis` */

DROP TABLE IF EXISTS `x23_tutupservis`;

CREATE TABLE `x23_tutupservis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` year(4) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `tanggal` date NOT NULL,
  `asmulaiservis` varchar(20) NOT NULL,
  `asmasukbengkel` varchar(20) NOT NULL,
  `askeluarbengkel` varchar(20) NOT NULL,
  `asselesaiservis` varchar(20) NOT NULL,
  `askwitansiservis` varchar(20) NOT NULL,
  `asnginap` varchar(20) NOT NULL,
  `nginap` varchar(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `inputx` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `x23_tutupservis` */

/*Table structure for table `x23_uangharian` */

DROP TABLE IF EXISTS `x23_uangharian`;

CREATE TABLE `x23_uangharian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(20) NOT NULL,
  `idkaryawan` int(11) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `dari` date NOT NULL,
  `sampai` date NOT NULL,
  `hadir` varchar(4) NOT NULL,
  `uharian` varchar(12) NOT NULL,
  `totuharian` varchar(20) NOT NULL,
  `status` int(1) NOT NULL,
  `tglbayar` date NOT NULL,
  `inputx` datetime NOT NULL,
  `updatex` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `x23_uangharian` */

/*Table structure for table `x23_uanglembur` */

DROP TABLE IF EXISTS `x23_uanglembur`;

CREATE TABLE `x23_uanglembur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idkaryawan` int(11) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `posisi` varchar(20) NOT NULL,
  `tahun` year(4) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `tanggal` date NOT NULL,
  `ulembur` varchar(12) NOT NULL,
  `tglbayar` date NOT NULL,
  `updatex` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `x23_uanglembur` */

/*Table structure for table `x23_user` */

DROP TABLE IF EXISTS `x23_user`;

CREATE TABLE `x23_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `hakakses` varchar(20) NOT NULL,
  `pic_user` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `x23_user` */

insert  into `x23_user`(`id`,`id_karyawan`,`user`,`pass`,`hakakses`,`pic_user`) values (1,1,'administrator','c4abe222c3d7a1df7159a49fc42fe38c','ALL','');
insert  into `x23_user`(`id`,`id_karyawan`,`user`,`pass`,`hakakses`,`pic_user`) values (3,3,'alex','534b44a19bf18d20b71ecc4eb77c572f','USER','sandy');
insert  into `x23_user`(`id`,`id_karyawan`,`user`,`pass`,`hakakses`,`pic_user`) values (5,5,'andri','6bd3108684ccc9dfd40b126877f850b0','USER','alex');
insert  into `x23_user`(`id`,`id_karyawan`,`user`,`pass`,`hakakses`,`pic_user`) values (6,20,'kasir','c7911af3adbd12a035b289556d96470a','USER','alex');
insert  into `x23_user`(`id`,`id_karyawan`,`user`,`pass`,`hakakses`,`pic_user`) values (7,25,'aj-aj','e9593e58d01a0edd4041c56a41047f55','USER','alex');
insert  into `x23_user`(`id`,`id_karyawan`,`user`,`pass`,`hakakses`,`pic_user`) values (8,15,'kepalabengkel','b609cbd172f0ccff0e6f53a3c20a9903','USER','ALEX');
insert  into `x23_user`(`id`,`id_karyawan`,`user`,`pass`,`hakakses`,`pic_user`) values (9,18,'counterpart','94ba2f131d2123c74c1b72a82ecefbc5','USER','ALEX');
insert  into `x23_user`(`id`,`id_karyawan`,`user`,`pass`,`hakakses`,`pic_user`) values (10,19,'sa','c12e01f2a13ff5587e1e9e4aedb8242d','USER','ALEX');

/*Table structure for table `abs_employee_vw` */

DROP TABLE IF EXISTS `abs_employee_vw`;

/*!50001 DROP VIEW IF EXISTS `abs_employee_vw` */;
/*!50001 DROP TABLE IF EXISTS `abs_employee_vw` */;

/*!50001 CREATE TABLE  `abs_employee_vw`(
 `EmployeeID` varchar(15) ,
 `FirstName` varchar(100) ,
 `LastName` varchar(50) ,
 `DepartmentID` varchar(10) ,
 `DepartmentName` varchar(100) ,
 `status` varchar(20) 
)*/;

/*Table structure for table `abs_result_vw` */

DROP TABLE IF EXISTS `abs_result_vw`;

/*!50001 DROP VIEW IF EXISTS `abs_result_vw` */;
/*!50001 DROP TABLE IF EXISTS `abs_result_vw` */;

/*!50001 CREATE TABLE  `abs_result_vw`(
 `EmployeeID` varchar(15) ,
 `FirstName` varchar(100) ,
 `LastName` varchar(50) ,
 `DepartmentID` varchar(10) ,
 `DepartmentName` varchar(100) ,
 `Date` datetime ,
 `Scan1` datetime ,
 `Scan2` datetime ,
 `Scan3` datetime ,
 `Scan4` datetime ,
 `TotalScan` tinyint(4) ,
 `Late` datetime ,
 `BreakDuration` datetime ,
 `BreakOver` datetime ,
 `TimeOfWork` datetime ,
 `ComingOverTime` datetime ,
 `BackOverTime` datetime 
)*/;

/*Table structure for table `abs_status_vw` */

DROP TABLE IF EXISTS `abs_status_vw`;

/*!50001 DROP VIEW IF EXISTS `abs_status_vw` */;
/*!50001 DROP TABLE IF EXISTS `abs_status_vw` */;

/*!50001 CREATE TABLE  `abs_status_vw`(
 `id` int(11) ,
 `EmployeeID` varchar(200) ,
 `awal` date ,
 `akhir` date ,
 `status` varchar(20) ,
 `keterangan` varchar(20) ,
 `FirstName` varchar(100) ,
 `LastName` varchar(50) ,
 `DepartmentID` varchar(10) ,
 `DepartmentName` varchar(100) 
)*/;

/*Table structure for table `abs_x23_employee_vw` */

DROP TABLE IF EXISTS `abs_x23_employee_vw`;

/*!50001 DROP VIEW IF EXISTS `abs_x23_employee_vw` */;
/*!50001 DROP TABLE IF EXISTS `abs_x23_employee_vw` */;

/*!50001 CREATE TABLE  `abs_x23_employee_vw`(
 `EmployeeID` varchar(15) ,
 `FirstName` varchar(100) ,
 `LastName` varchar(50) ,
 `DepartmentID` varchar(10) ,
 `DepartmentName` varchar(100) ,
 `posisi` int(1) ,
 `status` varchar(20) 
)*/;

/*Table structure for table `abs_x23_result_vw` */

DROP TABLE IF EXISTS `abs_x23_result_vw`;

/*!50001 DROP VIEW IF EXISTS `abs_x23_result_vw` */;
/*!50001 DROP TABLE IF EXISTS `abs_x23_result_vw` */;

/*!50001 CREATE TABLE  `abs_x23_result_vw`(
 `EmployeeID` varchar(15) ,
 `FirstName` varchar(100) ,
 `LastName` varchar(50) ,
 `DepartmentID` varchar(10) ,
 `DepartmentName` varchar(100) ,
 `Date` datetime ,
 `Scan1` datetime ,
 `Scan2` datetime ,
 `Scan3` datetime ,
 `Scan4` datetime ,
 `TotalScan` tinyint(4) ,
 `Late` datetime ,
 `BreakDuration` datetime ,
 `BreakOver` datetime ,
 `TimeOfWork` datetime ,
 `ComingOverTime` datetime ,
 `BackOverTime` datetime 
)*/;

/*Table structure for table `abs_x23_status_vw` */

DROP TABLE IF EXISTS `abs_x23_status_vw`;

/*!50001 DROP VIEW IF EXISTS `abs_x23_status_vw` */;
/*!50001 DROP TABLE IF EXISTS `abs_x23_status_vw` */;

/*!50001 CREATE TABLE  `abs_x23_status_vw`(
 `id` int(11) ,
 `EmployeeID` varchar(200) ,
 `awal` date ,
 `akhir` date ,
 `status` varchar(20) ,
 `keterangan` varchar(20) ,
 `FirstName` varchar(100) ,
 `LastName` varchar(50) ,
 `DepartmentID` varchar(10) ,
 `DepartmentName` varchar(100) 
)*/;

/*Table structure for table `tbl_abis_arusunit1` */

DROP TABLE IF EXISTS `tbl_abis_arusunit1`;

/*!50001 DROP VIEW IF EXISTS `tbl_abis_arusunit1` */;
/*!50001 DROP TABLE IF EXISTS `tbl_abis_arusunit1` */;

/*!50001 CREATE TABLE  `tbl_abis_arusunit1`(
 `nonota` varchar(20) ,
 `nopesan` varchar(20) ,
 `idbarang` int(11) ,
 `norangka` varchar(20) ,
 `tahun` year(4) ,
 `bulan` varchar(2) ,
 `tglnota` date ,
 `kodebarang` varchar(20) ,
 `namabarang` varchar(50) ,
 `varian` varchar(50) ,
 `warna` varchar(20) ,
 `gudang` varchar(40) 
)*/;

/*Table structure for table `tbl_abis_arusunit2` */

DROP TABLE IF EXISTS `tbl_abis_arusunit2`;

/*!50001 DROP VIEW IF EXISTS `tbl_abis_arusunit2` */;
/*!50001 DROP TABLE IF EXISTS `tbl_abis_arusunit2` */;

/*!50001 CREATE TABLE  `tbl_abis_arusunit2`(
 `id` int(11) ,
 `idpindah` int(11) ,
 `norangka` varchar(30) ,
 `tahun` year(4) ,
 `bulan` varchar(2) ,
 `tanggal` date ,
 `idgudang1` int(11) ,
 `idgudang2` int(11) ,
 `kodebarang` varchar(20) ,
 `namabarang` varchar(50) ,
 `warna` varchar(20) ,
 `varian` varchar(50) 
)*/;

/*Table structure for table `tbl_cekfisik_vw` */

DROP TABLE IF EXISTS `tbl_cekfisik_vw`;

/*!50001 DROP VIEW IF EXISTS `tbl_cekfisik_vw` */;
/*!50001 DROP TABLE IF EXISTS `tbl_cekfisik_vw` */;

/*!50001 CREATE TABLE  `tbl_cekfisik_vw`(
 `id` int(11) ,
 `nonota` varchar(20) ,
 `idbarang` int(11) ,
 `norangka` varchar(40) ,
 `nomesin` varchar(20) ,
 `tahun` year(4) ,
 `bulan` varchar(2) ,
 `tanggal` date ,
 `user` int(11) ,
 `accu` int(11) ,
 `alaskaki` int(11) ,
 `anakkunci` int(11) ,
 `helm` int(11) ,
 `spion` int(11) ,
 `toolkit` int(11) ,
 `cekfisik` int(11) ,
 `kondisimotor` int(11) ,
 `inputx` datetime ,
 `bensinawal` int(11) ,
 `lihat` int(1) ,
 `ikesalahan` int(1) ,
 `literawal` int(1) ,
 `nama` varchar(40) ,
 `kodebarang` varchar(20) ,
 `namabarang` varchar(50) ,
 `varian` varchar(50) ,
 `warna` varchar(20) ,
 `thnproduksi` int(4) ,
 `satuan` varchar(20) 
)*/;

/*Table structure for table `tbl_hleasing_vw` */

DROP TABLE IF EXISTS `tbl_hleasing_vw`;

/*!50001 DROP VIEW IF EXISTS `tbl_hleasing_vw` */;
/*!50001 DROP TABLE IF EXISTS `tbl_hleasing_vw` */;

/*!50001 CREATE TABLE  `tbl_hleasing_vw`(
 `id` int(11) ,
 `id_pelanggan` int(11) ,
 `kodeleasing` varchar(20) ,
 `unit` varchar(50) ,
 `termin` varchar(10) ,
 `tanggal` date ,
 `status` int(2) ,
 `namaleasing` varchar(40) ,
 `ketstatus` varchar(9) 
)*/;

/*Table structure for table `tbl_insentif_karyawan_vw` */

DROP TABLE IF EXISTS `tbl_insentif_karyawan_vw`;

/*!50001 DROP VIEW IF EXISTS `tbl_insentif_karyawan_vw` */;
/*!50001 DROP TABLE IF EXISTS `tbl_insentif_karyawan_vw` */;

/*!50001 CREATE TABLE  `tbl_insentif_karyawan_vw`(
 `id` int(11) ,
 `id_karyawan` int(11) ,
 `target` int(11) ,
 `cash` varchar(11) ,
 `kredit` varchar(11) ,
 `flat` varchar(11) ,
 `nama` varchar(40) ,
 `posisi` varchar(20) ,
 `id_posisi` int(11) 
)*/;

/*Table structure for table `tbl_karyawan_vw` */

DROP TABLE IF EXISTS `tbl_karyawan_vw`;

/*!50001 DROP VIEW IF EXISTS `tbl_karyawan_vw` */;
/*!50001 DROP TABLE IF EXISTS `tbl_karyawan_vw` */;

/*!50001 CREATE TABLE  `tbl_karyawan_vw`(
 `id` int(11) ,
 `nik` varchar(20) ,
 `nama` varchar(40) ,
 `tmplahir` varchar(20) ,
 `tgllahir` date ,
 `noktp` varchar(20) ,
 `notelepon` varchar(20) ,
 `alamat` varchar(100) ,
 `tglmulaikerja` date ,
 `ugapok` varchar(17) ,
 `uharian` varchar(17) ,
 `ukomisi` varchar(17) ,
 `ulembur` varchar(17) ,
 `photo` varchar(200) ,
 `status` varchar(20) ,
 `pic_user` varchar(20) ,
 `posisi` varchar(20) ,
 `id_posisi` int(11) ,
 `usia` double 
)*/;

/*Table structure for table `tbl_ksindividu_vw` */

DROP TABLE IF EXISTS `tbl_ksindividu_vw`;

/*!50001 DROP VIEW IF EXISTS `tbl_ksindividu_vw` */;
/*!50001 DROP TABLE IF EXISTS `tbl_ksindividu_vw` */;

/*!50001 CREATE TABLE  `tbl_ksindividu_vw`(
 `id` int(11) ,
 `nonota` varchar(20) ,
 `idbarang` int(11) ,
 `tahun` year(4) ,
 `bulan` varchar(2) ,
 `tanggal` date ,
 `nopesan` varchar(20) ,
 `idsales` int(11) ,
 `idleasing` int(11) ,
 `jnstransaksi` varchar(20) ,
 `jnscashtempo` varchar(20) ,
 `kodebarang` varchar(20) ,
 `namabarang` varchar(50) ,
 `varian` varchar(50) ,
 `warna` varchar(20) ,
 `thnproduksi` int(4) ,
 `tglnota` date ,
 `idpelanggan` int(11) 
)*/;

/*Table structure for table `tbl_kwitansi_vw` */

DROP TABLE IF EXISTS `tbl_kwitansi_vw`;

/*!50001 DROP VIEW IF EXISTS `tbl_kwitansi_vw` */;
/*!50001 DROP TABLE IF EXISTS `tbl_kwitansi_vw` */;

/*!50001 CREATE TABLE  `tbl_kwitansi_vw`(
 `id` int(11) ,
 `jnskwitansi` varchar(20) ,
 `nokwitansi` varchar(20) ,
 `tahun` year(4) ,
 `bulan` varchar(2) ,
 `tanggal` date ,
 `nomor` varchar(20) ,
 `idpelanggan` int(11) ,
 `jaket` varchar(10) ,
 `bukuservice` varchar(10) ,
 `jumlah` varchar(20) ,
 `user` int(11) ,
 `keterangan` varchar(50) ,
 `status` int(1) ,
 `cetak` int(1) ,
 `inputx` datetime ,
 `updatex` varchar(100) ,
 `nama` varchar(200) ,
 `ohc` varchar(20) ,
 `namapic` varchar(40) 
)*/;

/*Table structure for table `tbl_labacash1_vw` */

DROP TABLE IF EXISTS `tbl_labacash1_vw`;

/*!50001 DROP VIEW IF EXISTS `tbl_labacash1_vw` */;
/*!50001 DROP TABLE IF EXISTS `tbl_labacash1_vw` */;

/*!50001 CREATE TABLE  `tbl_labacash1_vw`(
 `id` int(11) ,
 `nonota` varchar(20) ,
 `tglnota` date ,
 `bulan` varchar(2) ,
 `tahun` year(4) ,
 `idpelanggan` int(11) ,
 `nopesan` varchar(20) ,
 `idbarang` int(11) ,
 `norangka` varchar(20) ,
 `ppnjual` varchar(22) ,
 `hargabeli` varchar(22) ,
 `ppnbeli` varchar(22) ,
 `jual_plus_ppnbeli` varchar(22) ,
 `ppnjual_min_ppnbeli` varchar(22) ,
 `jumlah1` varchar(22) ,
 `otrsetelahpajak` varchar(22) ,
 `bbn` varchar(22) ,
 `offtheroad` varchar(22) ,
 `matrix1` varchar(22) ,
 `matrix2` varchar(22) ,
 `matrixpajak` varchar(22) ,
 `subsidi1` varchar(22) ,
 `subsidi2` varchar(22) ,
 `subsidipajak` varchar(22) ,
 `ref` varchar(40) ,
 `notelpref` varchar(20) ,
 `statuskomisi` int(1) ,
 `jumlah` varchar(22) ,
 `statusleasing` varchar(20) ,
 `statusbbn` varchar(20) ,
 `bayarotr` varchar(22) ,
 `tglotr` date ,
 `statusotr` int(1) ,
 `gross` varchar(22) ,
 `tglgross` date ,
 `statusgross` int(1) ,
 `subsidi` varchar(22) ,
 `tglsubsidi` date ,
 `statussubsidi` int(1) ,
 `matrix` varchar(22) ,
 `tglmatrix` date ,
 `statusmatrix` int(1) ,
 `tnkb` varchar(20) ,
 `noticehitam` double ,
 `noticemerah` double ,
 `jnstransaksi` varchar(20) ,
 `jnscashtempo` varchar(20) ,
 `status` int(1) ,
 `mis` varchar(11) ,
 `C` double ,
 `D` double ,
 `notice` double ,
 `F` double ,
 `otr` varchar(22) ,
 `disc` varchar(22) ,
 `komisi` varchar(22) ,
 `G` double ,
 `bayargross` varchar(22) ,
 `bayarsubsidi` varchar(22) ,
 `bayarmatrix` varchar(22) 
)*/;

/*Table structure for table `tbl_labakredit1_vw` */

DROP TABLE IF EXISTS `tbl_labakredit1_vw`;

/*!50001 DROP VIEW IF EXISTS `tbl_labakredit1_vw` */;
/*!50001 DROP TABLE IF EXISTS `tbl_labakredit1_vw` */;

/*!50001 CREATE TABLE  `tbl_labakredit1_vw`(
 `id` int(11) ,
 `nonota` varchar(20) ,
 `tglnota` date ,
 `bulan` varchar(2) ,
 `tahun` year(4) ,
 `idpelanggan` int(11) ,
 `nopesan` varchar(20) ,
 `idbarang` int(11) ,
 `norangka` varchar(20) ,
 `ppnjual` varchar(22) ,
 `hargabeli` varchar(22) ,
 `ppnbeli` varchar(22) ,
 `jual_plus_ppnbeli` varchar(22) ,
 `ppnjual_min_ppnbeli` varchar(22) ,
 `jumlah1` varchar(22) ,
 `otrsetelahpajak` varchar(22) ,
 `bbn` varchar(22) ,
 `offtheroad` varchar(22) ,
 `matrix1` varchar(22) ,
 `matrix2` varchar(22) ,
 `matrixpajak` varchar(22) ,
 `subsidi1` varchar(22) ,
 `subsidi2` varchar(22) ,
 `subsidipajak` varchar(22) ,
 `ref` varchar(40) ,
 `notelpref` varchar(20) ,
 `statuskomisi` int(1) ,
 `jumlah` varchar(22) ,
 `statusleasing` varchar(20) ,
 `statusbbn` varchar(20) ,
 `bayarotr` varchar(22) ,
 `tglotr` date ,
 `statusotr` int(1) ,
 `gross` varchar(22) ,
 `tglgross` date ,
 `statusgross` int(1) ,
 `subsidi` varchar(22) ,
 `tglsubsidi` date ,
 `statussubsidi` int(1) ,
 `matrix` varchar(22) ,
 `tglmatrix` date ,
 `statusmatrix` int(1) ,
 `tnkb` varchar(20) ,
 `noticehitam` double ,
 `noticemerah` double ,
 `jnstransaksi` varchar(20) ,
 `jnscashtempo` varchar(20) ,
 `status` int(1) ,
 `mis` varchar(11) ,
 `C` double ,
 `D` double ,
 `notice` double ,
 `F` double ,
 `otr` varchar(22) ,
 `disc` varchar(22) ,
 `komisi` varchar(22) ,
 `G` double ,
 `bayargross` varchar(22) ,
 `bayarsubsidi` varchar(22) ,
 `bayarmatrix` varchar(22) 
)*/;

/*Table structure for table `tbl_labakredit2_vw` */

DROP TABLE IF EXISTS `tbl_labakredit2_vw`;

/*!50001 DROP VIEW IF EXISTS `tbl_labakredit2_vw` */;
/*!50001 DROP TABLE IF EXISTS `tbl_labakredit2_vw` */;

/*!50001 CREATE TABLE  `tbl_labakredit2_vw`(
 `id` int(11) ,
 `nonota` varchar(20) ,
 `tglnota` date ,
 `bulan` varchar(2) ,
 `tahun` year(4) ,
 `nopesan` varchar(20) ,
 `idpelanggan` int(11) ,
 `idbarang` int(11) ,
 `norangka` varchar(20) ,
 `jumlah` varchar(20) ,
 `tnkb` varchar(20) ,
 `C` double ,
 `D` double ,
 `notice` double ,
 `F` double ,
 `otr` varchar(22) ,
 `G` double ,
 `bayargross` varchar(22) ,
 `bayarsubsidi` varchar(22) ,
 `bayarmatrix` varchar(22) ,
 `UM` double ,
 `L` double ,
 `M` double 
)*/;

/*Table structure for table `tbl_lembur_vw` */

DROP TABLE IF EXISTS `tbl_lembur_vw`;

/*!50001 DROP VIEW IF EXISTS `tbl_lembur_vw` */;
/*!50001 DROP TABLE IF EXISTS `tbl_lembur_vw` */;

/*!50001 CREATE TABLE  `tbl_lembur_vw`(
 `id` int(11) ,
 `idkaryawan` int(11) ,
 `tahun` year(4) ,
 `bulan` varchar(2) ,
 `tanggal` date ,
 `nik` varchar(20) ,
 `nama` varchar(40) ,
 `ulembur` varchar(17) ,
 `posisi` varchar(20) 
)*/;

/*Table structure for table `tbl_notabeli_det2_vw` */

DROP TABLE IF EXISTS `tbl_notabeli_det2_vw`;

/*!50001 DROP VIEW IF EXISTS `tbl_notabeli_det2_vw` */;
/*!50001 DROP TABLE IF EXISTS `tbl_notabeli_det2_vw` */;

/*!50001 CREATE TABLE  `tbl_notabeli_det2_vw`(
 `id` int(11) ,
 `nonota` varchar(20) ,
 `idbarang` int(11) ,
 `norangka` varchar(50) ,
 `nomesin` varchar(20) ,
 `hargabelibersih` varchar(20) ,
 `qty` varchar(4) ,
 `total` varchar(20) ,
 `ppn` varchar(20) ,
 `status` int(1) ,
 `tgltiba` date ,
 `idgudang` int(11) ,
 `kodebarang` varchar(20) ,
 `namabarang` varchar(50) ,
 `varian` varchar(50) ,
 `warna` varchar(20) ,
 `thnproduksi` int(4) ,
 `satuan` varchar(20) 
)*/;

/*Table structure for table `tbl_notabeli_det3_vw` */

DROP TABLE IF EXISTS `tbl_notabeli_det3_vw`;

/*!50001 DROP VIEW IF EXISTS `tbl_notabeli_det3_vw` */;
/*!50001 DROP TABLE IF EXISTS `tbl_notabeli_det3_vw` */;

/*!50001 CREATE TABLE  `tbl_notabeli_det3_vw`(
 `id` int(11) ,
 `nonota` varchar(20) ,
 `idbarang` int(11) ,
 `norangka` varchar(50) ,
 `nomesin` varchar(20) ,
 `hargabelibersih` varchar(20) ,
 `qty` varchar(4) ,
 `total` varchar(20) ,
 `status` int(1) ,
 `ikesalahan` int(1) ,
 `tgltiba` date ,
 `idgudang` int(11) ,
 `tahun` year(4) ,
 `bulan` varchar(2) ,
 `tglnota` date ,
 `nodo` varchar(20) ,
 `tgldo` date ,
 `nopo` varchar(20) ,
 `tglpo` date ,
 `memo` varchar(255) ,
 `qtytotal` varchar(20) ,
 `grandtotal` varchar(20) ,
 `bayar` varchar(20) ,
 `tglbayar` date ,
 `scan` int(1) ,
 `kodebarang` varchar(20) ,
 `namabarang` varchar(50) ,
 `varian` varchar(50) ,
 `warna` varchar(20) ,
 `thnproduksi` int(4) ,
 `satuan` varchar(20) 
)*/;

/*Table structure for table `tbl_notabeli_det_vw` */

DROP TABLE IF EXISTS `tbl_notabeli_det_vw`;

/*!50001 DROP VIEW IF EXISTS `tbl_notabeli_det_vw` */;
/*!50001 DROP TABLE IF EXISTS `tbl_notabeli_det_vw` */;

/*!50001 CREATE TABLE  `tbl_notabeli_det_vw`(
 `id` int(11) ,
 `nonota` varchar(20) ,
 `idbarang` int(11) ,
 `norangka` varchar(50) ,
 `nomesin` varchar(20) ,
 `hargabelibersih` varchar(20) ,
 `qty` varchar(4) ,
 `total` varchar(20) ,
 `status` int(1) ,
 `ikesalahan` int(1) ,
 `tgltiba` date ,
 `idgudang` int(11) ,
 `tahun` year(4) ,
 `bulan` varchar(2) ,
 `tglnota` date ,
 `nodo` varchar(20) ,
 `tgldo` date ,
 `nopo` varchar(20) ,
 `tglpo` date ,
 `memo` varchar(255) ,
 `qtytotal` varchar(20) ,
 `grandtotal` varchar(20) ,
 `bayar` varchar(20) ,
 `tglbayar` date ,
 `scan` int(1) ,
 `kodebarang` varchar(20) ,
 `namabarang` varchar(50) ,
 `varian` varchar(50) ,
 `warna` varchar(20) ,
 `thnproduksi` int(4) ,
 `satuan` varchar(20) ,
 `gudang` varchar(40) 
)*/;

/*Table structure for table `tbl_notajual_det_pesanan_vw` */

DROP TABLE IF EXISTS `tbl_notajual_det_pesanan_vw`;

/*!50001 DROP VIEW IF EXISTS `tbl_notajual_det_pesanan_vw` */;
/*!50001 DROP TABLE IF EXISTS `tbl_notajual_det_pesanan_vw` */;

/*!50001 CREATE TABLE  `tbl_notajual_det_pesanan_vw`(
 `id` int(11) ,
 `nonota` varchar(20) ,
 `nopesan` varchar(20) ,
 `idbarang` int(11) ,
 `norangka` varchar(20) ,
 `idsales` int(11) ,
 `idpelanggan` int(11) ,
 `jnstransaksi` varchar(20) ,
 `idleasing` int(11) ,
 `kodebarang` varchar(20) ,
 `namabarang` varchar(50) ,
 `varian` varchar(50) ,
 `warna` varchar(20) ,
 `nopdi` varchar(20) ,
 `tahun` year(4) ,
 `bulan` varchar(2) ,
 `tglnota` date 
)*/;

/*Table structure for table `tbl_notajual_det_qty` */

DROP TABLE IF EXISTS `tbl_notajual_det_qty`;

/*!50001 DROP VIEW IF EXISTS `tbl_notajual_det_qty` */;
/*!50001 DROP TABLE IF EXISTS `tbl_notajual_det_qty` */;

/*!50001 CREATE TABLE  `tbl_notajual_det_qty`(
 `nonota` varchar(20) ,
 `qty` bigint(21) 
)*/;

/*Table structure for table `tbl_notajual_det_vw` */

DROP TABLE IF EXISTS `tbl_notajual_det_vw`;

/*!50001 DROP VIEW IF EXISTS `tbl_notajual_det_vw` */;
/*!50001 DROP TABLE IF EXISTS `tbl_notajual_det_vw` */;

/*!50001 CREATE TABLE  `tbl_notajual_det_vw`(
 `id` int(11) ,
 `nonota` varchar(20) ,
 `nopesan` varchar(20) ,
 `idbarang` int(11) ,
 `norangka` varchar(20) ,
 `otr` varchar(22) ,
 `disc` varchar(22) ,
 `gross` varchar(22) ,
 `matrix` varchar(22) ,
 `matrix1` varchar(22) ,
 `matrix2` varchar(22) ,
 `matrixpajak` varchar(22) ,
 `subsidi` varchar(22) ,
 `subsidi1` varchar(22) ,
 `subsidi2` varchar(22) ,
 `subsidipajak` varchar(22) ,
 `scpahm` varchar(22) ,
 `scpmd` varchar(22) ,
 `komisi` varchar(22) ,
 `ref` varchar(40) ,
 `notelpref` varchar(20) ,
 `statuskomisi` int(1) ,
 `tglbayarkomisi` date ,
 `jumlah` varchar(22) ,
 `statusleasing` varchar(20) ,
 `statusbbn` varchar(20) ,
 `statusotr` int(1) ,
 `statusgross` int(1) ,
 `statussubsidi` int(1) ,
 `statusmatrix` int(1) ,
 `statusscpahm` int(1) ,
 `statusscpmd` int(1) ,
 `statustagihanls` int(1) ,
 `bayarotr` varchar(22) ,
 `bayargross` varchar(22) ,
 `bayarsubsidi` varchar(22) ,
 `bayarmatrix` varchar(22) ,
 `bayarscpahm` varchar(22) ,
 `bayarscpmd` varchar(22) ,
 `tglotr` date ,
 `tglgross` date ,
 `tglsubsidi` date ,
 `tglmatrix` date ,
 `tglscpahm` date ,
 `tglscpmd` date ,
 `tgltagihanls` date ,
 `tglsampai` date ,
 `jamsampai` time ,
 `tambahlain` varchar(20) ,
 `kuranglain` varchar(22) ,
 `tgltambahlain` date ,
 `tglkuranglain` date ,
 `kettambahlain` varchar(400) ,
 `ketkuranglain` varchar(400) ,
 `updatex` varchar(100) ,
 `tahun` year(4) ,
 `bulan` varchar(2) ,
 `tglnota` date ,
 `iduser` int(11) ,
 `iduserpdi` int(11) ,
 `iduseradm` int(11) ,
 `idpelanggan` int(11) ,
 `jnstransaksi` varchar(20) ,
 `jnscashtempo` varchar(20) ,
 `tglpelunasan` date ,
 `idleasing` int(11) ,
 `angsuran` varchar(20) ,
 `termin` varchar(11) ,
 `hargabelibersih` varchar(22) ,
 `totr` varchar(22) ,
 `tdisc` varchar(22) ,
 `utitipan` varchar(22) ,
 `sisabayar` varchar(22) ,
 `bayar` varchar(22) ,
 `laba` varchar(22) ,
 `status` int(1) ,
 `cekfisik` int(1) ,
 `adm` int(1) ,
 `ketreject` varchar(100) ,
 `idsales` int(11) 
)*/;

/*Table structure for table `tbl_notajual_qty` */

DROP TABLE IF EXISTS `tbl_notajual_qty`;

/*!50001 DROP VIEW IF EXISTS `tbl_notajual_qty` */;
/*!50001 DROP TABLE IF EXISTS `tbl_notajual_qty` */;

/*!50001 CREATE TABLE  `tbl_notajual_qty`(
 `id` int(11) ,
 `nonota` varchar(20) ,
 `nopesan` varchar(20) ,
 `iduser` int(11) ,
 `iduserpdi` int(11) ,
 `iduseradm` int(11) ,
 `idpelanggan` int(11) ,
 `jnstransaksi` varchar(20) ,
 `idleasing` int(11) ,
 `termin` varchar(11) ,
 `tahun` year(4) ,
 `bulan` varchar(2) ,
 `tglnota` date ,
 `hargabelibersih` varchar(22) ,
 `utitipan` varchar(22) ,
 `sisabayar` varchar(22) ,
 `bayar` varchar(22) ,
 `laba` varchar(22) ,
 `status` int(1) ,
 `cekfisik` int(1) ,
 `adm` int(1) ,
 `inputx` datetime ,
 `updatex` varchar(200) ,
 `qty` bigint(21) 
)*/;

/*Table structure for table `tbl_notajual_vw` */

DROP TABLE IF EXISTS `tbl_notajual_vw`;

/*!50001 DROP VIEW IF EXISTS `tbl_notajual_vw` */;
/*!50001 DROP TABLE IF EXISTS `tbl_notajual_vw` */;

/*!50001 CREATE TABLE  `tbl_notajual_vw`(
 `id` int(11) ,
 `nonota` varchar(20) ,
 `nopdi` varchar(20) ,
 `nopesan` varchar(20) ,
 `idsales` int(11) ,
 `iduser` int(11) ,
 `iduserpdi` int(11) ,
 `iduseradm` int(11) ,
 `idpelanggan` int(11) ,
 `jnstransaksi` varchar(20) ,
 `jnscashtempo` varchar(20) ,
 `tglpelunasan` date ,
 `idleasing` int(11) ,
 `angsuran` varchar(20) ,
 `termin` varchar(11) ,
 `tahun` year(4) ,
 `bulan` varchar(2) ,
 `tglnota` date ,
 `hargabelibersih` varchar(22) ,
 `totr` varchar(22) ,
 `tdisc` varchar(22) ,
 `utitipan` varchar(22) ,
 `sisabayar` varchar(22) ,
 `bayar` varchar(22) ,
 `laba` varchar(22) ,
 `status` int(1) ,
 `cekfisik` int(1) ,
 `adm` int(1) ,
 `ketreject` varchar(100) ,
 `inputx` datetime ,
 `updatex` varchar(200) ,
 `nama` varchar(200) ,
 `notelepon` varchar(15) ,
 `ohc` varchar(20) 
)*/;

/*Table structure for table `tbl_opname_det_vw` */

DROP TABLE IF EXISTS `tbl_opname_det_vw`;

/*!50001 DROP VIEW IF EXISTS `tbl_opname_det_vw` */;
/*!50001 DROP TABLE IF EXISTS `tbl_opname_det_vw` */;

/*!50001 CREATE TABLE  `tbl_opname_det_vw`(
 `id` int(11) ,
 `idopname` varchar(20) ,
 `norangka` varchar(30) ,
 `keterangan` varchar(200) ,
 `hargabeli` varchar(20) ,
 `nomesin` varchar(20) ,
 `kodebarang` varchar(20) ,
 `namabarang` varchar(50) ,
 `varian` varchar(50) ,
 `warna` varchar(20) ,
 `thnproduksi` int(4) 
)*/;

/*Table structure for table `tbl_opname_vw` */

DROP TABLE IF EXISTS `tbl_opname_vw`;

/*!50001 DROP VIEW IF EXISTS `tbl_opname_vw` */;
/*!50001 DROP TABLE IF EXISTS `tbl_opname_vw` */;

/*!50001 CREATE TABLE  `tbl_opname_vw`(
 `id` int(11) ,
 `tahun` year(4) ,
 `bulan` varchar(2) ,
 `tanggal` date ,
 `idgudang` int(11) ,
 `gudang` varchar(40) ,
 `stok` varchar(11) ,
 `scan` varchar(11) ,
 `sisa` varchar(11) ,
 `totjumselisih` varchar(24) ,
 `status` int(1) ,
 `iduser` int(11) ,
 `nama` varchar(40) ,
 `user` varchar(20) ,
 `inputx` datetime 
)*/;

/*Table structure for table `tbl_pelanganpotensial` */

DROP TABLE IF EXISTS `tbl_pelanganpotensial`;

/*!50001 DROP VIEW IF EXISTS `tbl_pelanganpotensial` */;
/*!50001 DROP TABLE IF EXISTS `tbl_pelanganpotensial` */;

/*!50001 CREATE TABLE  `tbl_pelanganpotensial`(
 `id` int(11) ,
 `nonota` varchar(20) ,
 `nopesan` varchar(20) ,
 `tglnota` date ,
 `idpelanggan` int(11) ,
 `nama` varchar(200) ,
 `notelepon` varchar(15) ,
 `ohc` varchar(20) ,
 `kadaluarsaohc` date ,
 `noktp` varchar(20) ,
 `alamat` varchar(400) ,
 `rt` varchar(4) ,
 `rw` varchar(4) ,
 `kodekab` varchar(2) ,
 `namakab` varchar(40) ,
 `kodekec` varchar(2) ,
 `namakec` varchar(40) ,
 `kodekel` varchar(2) ,
 `namakel` varchar(40) ,
 `kodealamat` varchar(10) ,
 `email` varchar(40) ,
 `pekerjaan` varchar(40) ,
 `grup` int(1) ,
 `idbarang` int(11) 
)*/;

/*Table structure for table `tbl_pengeluaranunit_vw` */

DROP TABLE IF EXISTS `tbl_pengeluaranunit_vw`;

/*!50001 DROP VIEW IF EXISTS `tbl_pengeluaranunit_vw` */;
/*!50001 DROP TABLE IF EXISTS `tbl_pengeluaranunit_vw` */;

/*!50001 CREATE TABLE  `tbl_pengeluaranunit_vw`(
 `id` int(11) ,
 `tahun` year(4) ,
 `bulan` varchar(2) ,
 `tanggal` date ,
 `nonota` varchar(20) ,
 `nama` varchar(40) ,
 `tglsampai` date ,
 `tglsampai2` date ,
 `jamsampai` time ,
 `ikesalahan` int(1) ,
 `norangka` varchar(20) 
)*/;

/*Table structure for table `tbl_pesanan_det_vw` */

DROP TABLE IF EXISTS `tbl_pesanan_det_vw`;

/*!50001 DROP VIEW IF EXISTS `tbl_pesanan_det_vw` */;
/*!50001 DROP TABLE IF EXISTS `tbl_pesanan_det_vw` */;

/*!50001 CREATE TABLE  `tbl_pesanan_det_vw`(
 `id` int(11) ,
 `nopesan` varchar(20) ,
 `idpelanggan` int(11) ,
 `idbarang` int(11) ,
 `norangka` varchar(40) ,
 `otr` varchar(22) ,
 `disc` varchar(22) ,
 `kodebarang` varchar(20) ,
 `namabarang` varchar(50) ,
 `varian` varchar(50) ,
 `warna` varchar(20) ,
 `thnproduksi` int(4) ,
 `satuan` varchar(20) ,
 `literawal` int(1) 
)*/;

/*Table structure for table `tbl_pesanan_vw` */

DROP TABLE IF EXISTS `tbl_pesanan_vw`;

/*!50001 DROP VIEW IF EXISTS `tbl_pesanan_vw` */;
/*!50001 DROP TABLE IF EXISTS `tbl_pesanan_vw` */;

/*!50001 CREATE TABLE  `tbl_pesanan_vw`(
 `id` int(11) ,
 `nopesan` varchar(20) ,
 `idpelanggan` int(11) ,
 `idbarang` int(11) ,
 `norangka` varchar(40) ,
 `tahun` year(4) ,
 `bulan` varchar(2) ,
 `tglpesan` date ,
 `idsales` int(11) ,
 `jnstransaksi` varchar(20) ,
 `jnscashtempo` varchar(20) ,
 `tnkb` varchar(20) ,
 `tglpelunasan` date ,
 `idleasing` int(11) ,
 `termin` varchar(20) ,
 `utitipan` varchar(20) ,
 `status` varchar(20) ,
 `indent` int(1) ,
 `batal` varchar(20) ,
 `inputx` datetime ,
 `updatex` varchar(200) ,
 `nama` varchar(200) ,
 `ohc` varchar(20) ,
 `kadaluarsaohc` date ,
 `notelepon` varchar(15) ,
 `noktp` varchar(20) ,
 `alamat` varchar(400) ,
 `rt` varchar(4) ,
 `rw` varchar(4) ,
 `kodekab` varchar(2) ,
 `namakab` varchar(40) ,
 `kodekec` varchar(2) ,
 `namakec` varchar(40) ,
 `kodekel` varchar(2) ,
 `namakel` varchar(40) ,
 `kodealamat` varchar(10) ,
 `email` varchar(40) ,
 `pekerjaan` varchar(40) ,
 `kodebarang` varchar(20) ,
 `namabarang` varchar(50) ,
 `varian` varchar(50) ,
 `warna` varchar(20) ,
 `thnproduksi` int(4) ,
 `satuan` varchar(20) ,
 `namasales` varchar(40) 
)*/;

/*Table structure for table `tbl_pindah_det_vw` */

DROP TABLE IF EXISTS `tbl_pindah_det_vw`;

/*!50001 DROP VIEW IF EXISTS `tbl_pindah_det_vw` */;
/*!50001 DROP TABLE IF EXISTS `tbl_pindah_det_vw` */;

/*!50001 CREATE TABLE  `tbl_pindah_det_vw`(
 `id` int(11) ,
 `idpindah` int(11) ,
 `norangka` varchar(30) ,
 `tahun` year(4) ,
 `bulan` varchar(2) ,
 `tanggal` date ,
 `idgudang1` int(11) ,
 `idgudang2` int(11) ,
 `status` int(1) ,
 `iduser` int(11) ,
 `user` varchar(20) ,
 `inputx` datetime 
)*/;

/*Table structure for table `tbl_pindah_vw` */

DROP TABLE IF EXISTS `tbl_pindah_vw`;

/*!50001 DROP VIEW IF EXISTS `tbl_pindah_vw` */;
/*!50001 DROP TABLE IF EXISTS `tbl_pindah_vw` */;

/*!50001 CREATE TABLE  `tbl_pindah_vw`(
 `id` int(11) ,
 `tahun` year(4) ,
 `bulan` varchar(2) ,
 `tanggal` date ,
 `idgudang1` int(11) ,
 `gudang1` varchar(40) ,
 `idgudang2` int(11) ,
 `gudang2` varchar(40) ,
 `nama` varchar(40) ,
 `user` varchar(20) ,
 `status` int(1) ,
 `inputx` datetime 
)*/;

/*Table structure for table `tbl_piutang_vw` */

DROP TABLE IF EXISTS `tbl_piutang_vw`;

/*!50001 DROP VIEW IF EXISTS `tbl_piutang_vw` */;
/*!50001 DROP TABLE IF EXISTS `tbl_piutang_vw` */;

/*!50001 CREATE TABLE  `tbl_piutang_vw`(
 `id` int(11) ,
 `jenis` varchar(20) ,
 `idkaryawan` int(11) ,
 `nama` varchar(40) ,
 `tgl` date ,
 `jumlah` varchar(20) ,
 `ket` varchar(100) ,
 `metodebayar` varchar(20) ,
 `status` int(1) ,
 `iduser` int(11) ,
 `namapic` varchar(40) ,
 `inputx` datetime ,
 `updatex` varchar(50) 
)*/;

/*Table structure for table `tbl_potkompensasi_vw` */

DROP TABLE IF EXISTS `tbl_potkompensasi_vw`;

/*!50001 DROP VIEW IF EXISTS `tbl_potkompensasi_vw` */;
/*!50001 DROP TABLE IF EXISTS `tbl_potkompensasi_vw` */;

/*!50001 CREATE TABLE  `tbl_potkompensasi_vw`(
 `id` int(11) ,
 `idkaryawan` int(11) ,
 `nama` varchar(40) ,
 `tgl` date ,
 `jumlah` varchar(20) ,
 `ket` varchar(100) ,
 `metodebayar` varchar(20) ,
 `iduser` int(11) ,
 `status` int(1) ,
 `potkompensasi` int(1) ,
 `inputx` datetime ,
 `updatex` varchar(50) ,
 `namapic` varchar(40) 
)*/;

/*Table structure for table `tbl_stok_global_vw` */

DROP TABLE IF EXISTS `tbl_stok_global_vw`;

/*!50001 DROP VIEW IF EXISTS `tbl_stok_global_vw` */;
/*!50001 DROP TABLE IF EXISTS `tbl_stok_global_vw` */;

/*!50001 CREATE TABLE  `tbl_stok_global_vw`(
 `idbarang` int(11) ,
 `stok` bigint(21) 
)*/;

/*Table structure for table `tbl_stokunit_vw` */

DROP TABLE IF EXISTS `tbl_stokunit_vw`;

/*!50001 DROP VIEW IF EXISTS `tbl_stokunit_vw` */;
/*!50001 DROP TABLE IF EXISTS `tbl_stokunit_vw` */;

/*!50001 CREATE TABLE  `tbl_stokunit_vw`(
 `id` int(11) ,
 `tahun` varchar(4) ,
 `bulan` varchar(2) ,
 `tgltiba` date ,
 `idgudang` int(11) ,
 `nonota` varchar(20) ,
 `idbarang` int(11) ,
 `norangka` varchar(20) ,
 `nomesin` varchar(20) ,
 `hargabelibersih` varchar(20) ,
 `ppn` varchar(20) ,
 `status` varchar(20) ,
 `inputx` datetime ,
 `updatex` varchar(100) ,
 `kodebarang` varchar(20) ,
 `namabarang` varchar(50) ,
 `varian` varchar(50) ,
 `warna` varchar(20) ,
 `thnproduksi` int(4) ,
 `satuan` varchar(20) ,
 `nama` varchar(40) ,
 `gudang` varchar(40) 
)*/;

/*Table structure for table `tbl_user_vw` */

DROP TABLE IF EXISTS `tbl_user_vw`;

/*!50001 DROP VIEW IF EXISTS `tbl_user_vw` */;
/*!50001 DROP TABLE IF EXISTS `tbl_user_vw` */;

/*!50001 CREATE TABLE  `tbl_user_vw`(
 `id` int(11) ,
 `id_karyawan` int(11) ,
 `user` varchar(50) ,
 `pass` varchar(50) ,
 `hakakses` varchar(20) ,
 `nama` varchar(40) ,
 `status` varchar(20) ,
 `nik` varchar(20) ,
 `id_posisi` int(11) ,
 `posisi` varchar(20) 
)*/;

/*Table structure for table `temp_x23_opname_det_vw` */

DROP TABLE IF EXISTS `temp_x23_opname_det_vw`;

/*!50001 DROP VIEW IF EXISTS `temp_x23_opname_det_vw` */;
/*!50001 DROP TABLE IF EXISTS `temp_x23_opname_det_vw` */;

/*!50001 CREATE TABLE  `temp_x23_opname_det_vw`(
 `id` int(11) ,
 `idstok` int(11) ,
 `idopname` int(11) ,
 `idgudang` int(11) ,
 `gudang` varchar(40) ,
 `rak` varchar(20) ,
 `nonota` varchar(20) ,
 `tglnota` date ,
 `idbarang` int(11) ,
 `kodebarang` varchar(20) ,
 `namabarang` varchar(50) ,
 `varian` varchar(50) ,
 `stok` varchar(20) ,
 `opname` varchar(20) ,
 `hargabeli` varchar(20) ,
 `selisih` varchar(20) ,
 `totalselisih` varchar(20) 
)*/;

/*Table structure for table `x23_indent_det_vw` */

DROP TABLE IF EXISTS `x23_indent_det_vw`;

/*!50001 DROP VIEW IF EXISTS `x23_indent_det_vw` */;
/*!50001 DROP TABLE IF EXISTS `x23_indent_det_vw` */;

/*!50001 CREATE TABLE  `x23_indent_det_vw`(
 `id` int(11) ,
 `noindent` varchar(20) ,
 `tahun` year(4) ,
 `bulan` varchar(2) ,
 `tglindent` date ,
 `idbarang` int(11) ,
 `qty` varchar(4) ,
 `status` int(1) ,
 `kodebarang` varchar(20) ,
 `namabarang` varchar(50) ,
 `varian` varchar(50) ,
 `satuan` varchar(20) ,
 `idsupplier` int(11) 
)*/;

/*Table structure for table `x23_indent_vw` */

DROP TABLE IF EXISTS `x23_indent_vw`;

/*!50001 DROP VIEW IF EXISTS `x23_indent_vw` */;
/*!50001 DROP TABLE IF EXISTS `x23_indent_vw` */;

/*!50001 CREATE TABLE  `x23_indent_vw`(
 `id` int(11) ,
 `noindent` varchar(20) ,
 `notajual` varchar(20) ,
 `idpelanggan` int(11) ,
 `tahun` year(4) ,
 `bulan` varchar(2) ,
 `tglindent` date ,
 `totalqty` varchar(20) ,
 `status` int(1) ,
 `iduser` int(11) ,
 `inputx` datetime ,
 `updatex` varchar(200) ,
 `nama` varchar(200) ,
 `ohc` varchar(20) ,
 `kadaluarsaohc` date ,
 `notelepon` varchar(15) ,
 `noktp` varchar(20) ,
 `alamat` varchar(400) ,
 `rt` varchar(4) ,
 `rw` varchar(4) ,
 `kodekab` varchar(2) ,
 `namakab` varchar(40) ,
 `kodekec` varchar(2) ,
 `namakec` varchar(40) ,
 `kodekel` varchar(2) ,
 `namakel` varchar(40) ,
 `kodealamat` varchar(10) ,
 `email` varchar(40) ,
 `pekerjaan` varchar(40) 
)*/;

/*Table structure for table `x23_insentif_karyawan_vw` */

DROP TABLE IF EXISTS `x23_insentif_karyawan_vw`;

/*!50001 DROP VIEW IF EXISTS `x23_insentif_karyawan_vw` */;
/*!50001 DROP TABLE IF EXISTS `x23_insentif_karyawan_vw` */;

/*!50001 CREATE TABLE  `x23_insentif_karyawan_vw`(
 `id` int(11) ,
 `id_karyawan` int(11) ,
 `target` int(11) ,
 `cash` varchar(11) ,
 `kredit` varchar(11) ,
 `flat` varchar(11) ,
 `nama` varchar(40) ,
 `posisi` varchar(20) ,
 `id_posisi` int(11) 
)*/;

/*Table structure for table `x23_karyawan_vw` */

DROP TABLE IF EXISTS `x23_karyawan_vw`;

/*!50001 DROP VIEW IF EXISTS `x23_karyawan_vw` */;
/*!50001 DROP TABLE IF EXISTS `x23_karyawan_vw` */;

/*!50001 CREATE TABLE  `x23_karyawan_vw`(
 `id` int(11) ,
 `nik` varchar(20) ,
 `nama` varchar(40) ,
 `tmplahir` varchar(20) ,
 `tgllahir` date ,
 `noktp` varchar(20) ,
 `notelepon` varchar(20) ,
 `alamat` varchar(100) ,
 `tglmulaikerja` date ,
 `ugapok` varchar(17) ,
 `uharian` varchar(17) ,
 `ukomisi` varchar(17) ,
 `ulembur` varchar(17) ,
 `pangkat` varchar(20) ,
 `photo` varchar(200) ,
 `status` varchar(20) ,
 `posisi` varchar(20) ,
 `id_posisi` int(11) ,
 `usia` double 
)*/;

/*Table structure for table `x23_kelompokjasa_det_vw` */

DROP TABLE IF EXISTS `x23_kelompokjasa_det_vw`;

/*!50001 DROP VIEW IF EXISTS `x23_kelompokjasa_det_vw` */;
/*!50001 DROP TABLE IF EXISTS `x23_kelompokjasa_det_vw` */;

/*!50001 CREATE TABLE  `x23_kelompokjasa_det_vw`(
 `id` int(11) ,
 `kode` varchar(20) ,
 `idtarifjasa` int(11) ,
 `idjasa` int(11) ,
 `pangkat` varchar(20) ,
 `tarif` varchar(20) ,
 `kodejasa` varchar(20) ,
 `namajasa` varchar(50) 
)*/;

/*Table structure for table `x23_kelompokjasa_oli_vw` */

DROP TABLE IF EXISTS `x23_kelompokjasa_oli_vw`;

/*!50001 DROP VIEW IF EXISTS `x23_kelompokjasa_oli_vw` */;
/*!50001 DROP TABLE IF EXISTS `x23_kelompokjasa_oli_vw` */;

/*!50001 CREATE TABLE  `x23_kelompokjasa_oli_vw`(
 `id` int(11) ,
 `kode` varchar(20) ,
 `idoli` int(11) ,
 `kodebarang` varchar(20) ,
 `namabarang` varchar(50) ,
 `varian` varchar(50) 
)*/;

/*Table structure for table `x23_kwitansi_piutang_vw` */

DROP TABLE IF EXISTS `x23_kwitansi_piutang_vw`;

/*!50001 DROP VIEW IF EXISTS `x23_kwitansi_piutang_vw` */;
/*!50001 DROP TABLE IF EXISTS `x23_kwitansi_piutang_vw` */;

/*!50001 CREATE TABLE  `x23_kwitansi_piutang_vw`(
 `id` int(11) ,
 `jnskwitansi` varchar(20) ,
 `nokwitansi` varchar(20) ,
 `tahun` year(4) ,
 `bulan` varchar(2) ,
 `tanggal` date ,
 `nomor` varchar(20) ,
 `idpotkom` int(11) ,
 `noindent` varchar(20) ,
 `idpelanggan` int(11) ,
 `noantrian` varchar(3) ,
 `nopol` varchar(20) ,
 `waktuselesai` time ,
 `jumlah` varchar(20) ,
 `jumlahho` varchar(20) ,
 `pembulatan` varchar(20) ,
 `user` int(11) ,
 `keterangan` varchar(30) ,
 `tambahdp` int(1) ,
 `status` int(11) ,
 `inputx` datetime ,
 `updatex` varchar(100) ,
 `ket` varchar(11) ,
 `nama` varchar(40) 
)*/;

/*Table structure for table `x23_kwitansi_tunai_vw` */

DROP TABLE IF EXISTS `x23_kwitansi_tunai_vw`;

/*!50001 DROP VIEW IF EXISTS `x23_kwitansi_tunai_vw` */;
/*!50001 DROP TABLE IF EXISTS `x23_kwitansi_tunai_vw` */;

/*!50001 CREATE TABLE  `x23_kwitansi_tunai_vw`(
 `id` int(11) ,
 `jnskwitansi` varchar(20) ,
 `nokwitansi` varchar(20) ,
 `tahun` year(4) ,
 `bulan` varchar(2) ,
 `tanggal` date ,
 `nomor` varchar(20) ,
 `idpelanggan` int(11) ,
 `jumlah` varchar(20) ,
 `status` int(11) ,
 `cetak` int(1) ,
 `ket` varchar(11) ,
 `nama` varchar(40) 
)*/;

/*Table structure for table `x23_kwitansi_vw` */

DROP TABLE IF EXISTS `x23_kwitansi_vw`;

/*!50001 DROP VIEW IF EXISTS `x23_kwitansi_vw` */;
/*!50001 DROP TABLE IF EXISTS `x23_kwitansi_vw` */;

/*!50001 CREATE TABLE  `x23_kwitansi_vw`(
 `id` int(11) ,
 `jnskwitansi` varchar(20) ,
 `nokwitansi` varchar(20) ,
 `tahun` year(4) ,
 `bulan` varchar(2) ,
 `tanggal` date ,
 `waktuselesai` time ,
 `nomor` varchar(20) ,
 `noindent` varchar(20) ,
 `idpelanggan` int(11) ,
 `noantrian` varchar(3) ,
 `nopol` varchar(20) ,
 `jumlah` varchar(20) ,
 `jumlahho` varchar(20) ,
 `pembulatan` varchar(20) ,
 `user` int(11) ,
 `keterangan` varchar(30) ,
 `status` int(11) ,
 `inputx` datetime ,
 `tambahdp` int(1) ,
 `updatex` varchar(100) ,
 `nama` varchar(200) ,
 `ohc` varchar(20) ,
 `ket` varchar(11) 
)*/;

/*Table structure for table `x23_kwitansikpb_vw` */

DROP TABLE IF EXISTS `x23_kwitansikpb_vw`;

/*!50001 DROP VIEW IF EXISTS `x23_kwitansikpb_vw` */;
/*!50001 DROP TABLE IF EXISTS `x23_kwitansikpb_vw` */;

/*!50001 CREATE TABLE  `x23_kwitansikpb_vw`(
 `id` int(11) ,
 `nokwitansi` varchar(20) ,
 `tglkpb` date ,
 `nopkb` varchar(30) ,
 `nonotaservis` varchar(30) ,
 `kodepaket` varchar(30) ,
 `kpbke` varchar(1) ,
 `tglpenagihan` date ,
 `jumlahtagih` varchar(20) ,
 `jumlahtagih2` varchar(20) 
)*/;

/*Table structure for table `x23_lembur_vw` */

DROP TABLE IF EXISTS `x23_lembur_vw`;

/*!50001 DROP VIEW IF EXISTS `x23_lembur_vw` */;
/*!50001 DROP TABLE IF EXISTS `x23_lembur_vw` */;

/*!50001 CREATE TABLE  `x23_lembur_vw`(
 `id` int(11) ,
 `idkaryawan` int(11) ,
 `tahun` year(4) ,
 `bulan` varchar(2) ,
 `tanggal` date ,
 `nik` varchar(20) ,
 `nama` varchar(40) ,
 `noktp` varchar(20) ,
 `ulembur` varchar(17) ,
 `posisi` varchar(20) 
)*/;

/*Table structure for table `x23_masterbarang_vw` */

DROP TABLE IF EXISTS `x23_masterbarang_vw`;

/*!50001 DROP VIEW IF EXISTS `x23_masterbarang_vw` */;
/*!50001 DROP TABLE IF EXISTS `x23_masterbarang_vw` */;

/*!50001 CREATE TABLE  `x23_masterbarang_vw`(
 `id` int(11) ,
 `jns` varchar(20) ,
 `kodebarang` varchar(20) ,
 `namabarang` varchar(50) ,
 `varian` varchar(50) ,
 `idsupplier` int(11) ,
 `nama` varchar(40) 
)*/;

/*Table structure for table `x23_notabeli_claim_det` */

DROP TABLE IF EXISTS `x23_notabeli_claim_det`;

/*!50001 DROP VIEW IF EXISTS `x23_notabeli_claim_det` */;
/*!50001 DROP TABLE IF EXISTS `x23_notabeli_claim_det` */;

/*!50001 CREATE TABLE  `x23_notabeli_claim_det`(
 `id` int(11) ,
 `nonota` varchar(20) ,
 `hargabelibersih` varchar(20) ,
 `qty` varchar(4) ,
 `total` varchar(20) ,
 `status` int(1) ,
 `tgltiba` date ,
 `idgudang` int(11) ,
 `rak` varchar(20) ,
 `id_claimoli_det` int(11) ,
 `kodepaket` varchar(20) ,
 `kpbke` varchar(10) ,
 `namakpb` varchar(40) ,
 `idbarang` int(11) ,
 `kodebarang` varchar(20) ,
 `varian` varchar(20) ,
 `namabarang` varchar(40) ,
 `hargaoli` varchar(20) ,
 `statusclaim` varchar(20) ,
 `tagihkembali` varchar(20) ,
 `kettolak` varchar(400) ,
 `statuscek` int(1) 
)*/;

/*Table structure for table `x23_notabeli_det2_vw` */

DROP TABLE IF EXISTS `x23_notabeli_det2_vw`;

/*!50001 DROP VIEW IF EXISTS `x23_notabeli_det2_vw` */;
/*!50001 DROP TABLE IF EXISTS `x23_notabeli_det2_vw` */;

/*!50001 CREATE TABLE  `x23_notabeli_det2_vw`(
 `id` int(11) ,
 `jns` varchar(10) ,
 `tglnota` date ,
 `nonota` varchar(20) ,
 `idbarang` int(11) ,
 `hargabelibersih` varchar(20) ,
 `qty` varchar(4) ,
 `total` varchar(20) ,
 `status` int(1) ,
 `tgltiba` date ,
 `idgudang` int(11) ,
 `rak` varchar(20) ,
 `kodebarang` varchar(20) ,
 `namabarang` varchar(50) ,
 `varian` varchar(50) ,
 `satuan` varchar(20) ,
 `idsupplier` int(11) ,
 `gudang` varchar(40) 
)*/;

/*Table structure for table `x23_notabeli_det_vw` */

DROP TABLE IF EXISTS `x23_notabeli_det_vw`;

/*!50001 DROP VIEW IF EXISTS `x23_notabeli_det_vw` */;
/*!50001 DROP TABLE IF EXISTS `x23_notabeli_det_vw` */;

/*!50001 CREATE TABLE  `x23_notabeli_det_vw`(
 `id` int(11) ,
 `nonota` varchar(20) ,
 `idsupplier` int(11) ,
 `tahun` year(4) ,
 `bulan` varchar(2) ,
 `tglnota` date ,
 `totalqty` varchar(20) ,
 `grandtotal` varchar(20) ,
 `harga` int(1) ,
 `idbarang` int(11) ,
 `hargabelibersih` varchar(20) ,
 `qty` varchar(4) ,
 `total` varchar(20) ,
 `status` int(1) ,
 `idgudang` int(11) ,
 `tgltiba` date ,
 `gudang` varchar(40) ,
 `rak` varchar(20) ,
 `kodebarang` varchar(20) ,
 `namabarang` varchar(50) ,
 `varian` varchar(50) ,
 `satuan` varchar(20) ,
 `hargajual` varchar(20) ,
 `hargajual2` varchar(20) ,
 `stok` varchar(20) 
)*/;

/*Table structure for table `x23_notabeli_vw` */

DROP TABLE IF EXISTS `x23_notabeli_vw`;

/*!50001 DROP VIEW IF EXISTS `x23_notabeli_vw` */;
/*!50001 DROP TABLE IF EXISTS `x23_notabeli_vw` */;

/*!50001 CREATE TABLE  `x23_notabeli_vw`(
 `id` int(11) ,
 `jns` varchar(10) ,
 `nonota` varchar(30) ,
 `idsupplier` int(11) ,
 `tahun` year(4) ,
 `bulan` varchar(2) ,
 `tglnota` date ,
 `nopo` varchar(30) ,
 `tglpo` date ,
 `totalqty` varchar(20) ,
 `grandtotal` varchar(20) ,
 `grandtotalppn` varchar(20) ,
 `gtbayar` varchar(20) ,
 `bayar` varchar(20) ,
 `tglbayar` date ,
 `status` int(1) ,
 `konf` int(1) ,
 `scan` int(1) ,
 `dk` int(1) ,
 `harga` int(1) ,
 `iduserbeli` int(11) ,
 `iduserkonf` int(11) ,
 `iduserbyr` int(11) ,
 `inputx` datetime ,
 `updatex` varchar(200) ,
 `nama` varchar(40) 
)*/;

/*Table structure for table `x23_notaindent_det_nonmpm` */

DROP TABLE IF EXISTS `x23_notaindent_det_nonmpm`;

/*!50001 DROP VIEW IF EXISTS `x23_notaindent_det_nonmpm` */;
/*!50001 DROP TABLE IF EXISTS `x23_notaindent_det_nonmpm` */;

/*!50001 CREATE TABLE  `x23_notaindent_det_nonmpm`(
 `id` int(11) ,
 `noindent` varchar(20) ,
 `tahun` year(4) ,
 `bulan` varchar(2) ,
 `tglindent` date ,
 `idbarang` int(11) ,
 `qty` varchar(4) ,
 `jns` varchar(20) ,
 `kodebarang` varchar(20) ,
 `namabarang` varchar(50) ,
 `varian` varchar(50) ,
 `satuan` varchar(20) ,
 `idsupplier` int(11) ,
 `nama` varchar(40) 
)*/;

/*Table structure for table `x23_notajual_det2_vw` */

DROP TABLE IF EXISTS `x23_notajual_det2_vw`;

/*!50001 DROP VIEW IF EXISTS `x23_notajual_det2_vw` */;
/*!50001 DROP TABLE IF EXISTS `x23_notajual_det2_vw` */;

/*!50001 CREATE TABLE  `x23_notajual_det2_vw`(
 `id` int(11) ,
 `tahun` year(4) ,
 `bulan` varchar(2) ,
 `tglnota` date ,
 `nonota` varchar(20) ,
 `idbarang` int(11) ,
 `kodebarang` varchar(20) ,
 `namabarang` varchar(50) ,
 `varian` varchar(50) ,
 `qtyindent` varchar(20) ,
 `qtyindentsisa` varchar(20) ,
 `qty` varchar(4) 
)*/;

/*Table structure for table `x23_notajual_det_vw` */

DROP TABLE IF EXISTS `x23_notajual_det_vw`;

/*!50001 DROP VIEW IF EXISTS `x23_notajual_det_vw` */;
/*!50001 DROP TABLE IF EXISTS `x23_notajual_det_vw` */;

/*!50001 CREATE TABLE  `x23_notajual_det_vw`(
 `id` int(11) ,
 `notabeli` varchar(20) ,
 `nonota` varchar(20) ,
 `tglnota` date ,
 `idbarang` int(11) ,
 `hargabelibersih` varchar(20) ,
 `hargajual` varchar(20) ,
 `diskon` varchar(20) ,
 `hargajualbersih` varchar(20) ,
 `qtyindent` varchar(20) ,
 `qtyindentsisa` varchar(20) ,
 `qty` varchar(4) ,
 `totdiskon` varchar(20) ,
 `tothargabelibersih` varchar(20) ,
 `total` varchar(20) ,
 `idgudang` int(11) ,
 `rak` varchar(20) ,
 `tgltagihan` date ,
 `idtagihan` int(11) ,
 `tglbayarkpb` date ,
 `jumlahbayarkpb` varchar(20) ,
 `idbayar` int(11) ,
 `statusbayar` int(1) ,
 `kodebarang` varchar(20) ,
 `namabarang` varchar(50) ,
 `varian` varchar(50) ,
 `gudang` varchar(40) 
)*/;

/*Table structure for table `x23_notajual_det_ws1a` */

DROP TABLE IF EXISTS `x23_notajual_det_ws1a`;

/*!50001 DROP VIEW IF EXISTS `x23_notajual_det_ws1a` */;
/*!50001 DROP TABLE IF EXISTS `x23_notajual_det_ws1a` */;

/*!50001 CREATE TABLE  `x23_notajual_det_ws1a`(
 `id` int(11) ,
 `notabeli` varchar(20) ,
 `nonota` varchar(20) ,
 `notaindent` varchar(20) ,
 `tahun` year(4) ,
 `bulan` varchar(2) ,
 `tglnota` date ,
 `idbarang` int(11) ,
 `hargabelibersih` varchar(20) ,
 `hargajual` varchar(20) ,
 `diskon` varchar(20) ,
 `hargajualbersih` varchar(20) ,
 `qty` varchar(4) ,
 `tothargabelibersih` varchar(20) ,
 `totdiskon` varchar(20) ,
 `total` varchar(20) ,
 `idgudang` int(11) ,
 `rak` varchar(20) ,
 `tgltagihan` date ,
 `idtagihan` int(11) ,
 `tglbayarkpb` date ,
 `jumlahbayarkpb` varchar(20) ,
 `idbayar` int(11) ,
 `statusbayar` int(1) ,
 `statusulang` int(1) ,
 `jns` varchar(20) ,
 `kodebarang` varchar(20) ,
 `namabarang` varchar(50) ,
 `varian` varchar(50) ,
 `satuan` varchar(20) ,
 `idsupplier` int(11) ,
 `jnskwitansi` varchar(20) ,
 `status` int(11) 
)*/;

/*Table structure for table `x23_notajual_det_ws1b` */

DROP TABLE IF EXISTS `x23_notajual_det_ws1b`;

/*!50001 DROP VIEW IF EXISTS `x23_notajual_det_ws1b` */;
/*!50001 DROP TABLE IF EXISTS `x23_notajual_det_ws1b` */;

/*!50001 CREATE TABLE  `x23_notajual_det_ws1b`(
 `id` int(11) ,
 `notabeli` varchar(20) ,
 `nonota` varchar(20) ,
 `notaindent` varchar(20) ,
 `tahun` year(4) ,
 `bulan` varchar(2) ,
 `tglnota` date ,
 `idbarang` int(11) ,
 `hargabelibersih` varchar(20) ,
 `hargajual` varchar(20) ,
 `diskon` varchar(20) ,
 `hargajualbersih` varchar(20) ,
 `qty` varchar(4) ,
 `tothargabelibersih` varchar(20) ,
 `totdiskon` varchar(20) ,
 `total` varchar(20) ,
 `idgudang` int(11) ,
 `rak` varchar(20) ,
 `tgltagihan` date ,
 `idtagihan` int(11) ,
 `tglbayarkpb` date ,
 `jumlahbayarkpb` varchar(20) ,
 `idbayar` int(11) ,
 `statusbayar` int(1) ,
 `statusulang` int(1) ,
 `jns` varchar(20) ,
 `kodebarang` varchar(20) ,
 `namabarang` varchar(50) ,
 `varian` varchar(50) ,
 `satuan` varchar(20) ,
 `idsupplier` int(11) 
)*/;

/*Table structure for table `x23_notajual_det_ws1c` */

DROP TABLE IF EXISTS `x23_notajual_det_ws1c`;

/*!50001 DROP VIEW IF EXISTS `x23_notajual_det_ws1c` */;
/*!50001 DROP TABLE IF EXISTS `x23_notajual_det_ws1c` */;

/*!50001 CREATE TABLE  `x23_notajual_det_ws1c`(
 `id` int(11) ,
 `notabeli` varchar(20) ,
 `nonota` varchar(20) ,
 `notaindent` varchar(20) ,
 `tahun` year(4) ,
 `bulan` varchar(2) ,
 `tglnota` date ,
 `idbarang` int(11) ,
 `hargabelibersih` varchar(20) ,
 `hargajual` varchar(20) ,
 `diskon` varchar(20) ,
 `hargajualbersih` varchar(20) ,
 `qty` varchar(4) ,
 `tothargabelibersih` varchar(20) ,
 `totdiskon` varchar(20) ,
 `total` varchar(20) ,
 `idgudang` int(11) ,
 `rak` varchar(20) ,
 `tgltagihan` date ,
 `idtagihan` int(11) ,
 `tglbayarkpb` date ,
 `jumlahbayarkpb` varchar(20) ,
 `idbayar` int(11) ,
 `statusbayar` int(1) ,
 `statusulang` int(1) ,
 `jns` varchar(20) ,
 `kodebarang` varchar(20) ,
 `namabarang` varchar(50) ,
 `varian` varchar(50) ,
 `satuan` varchar(20) ,
 `idsupplier` int(11) ,
 `jnskwitansi` varchar(20) ,
 `status` int(11) 
)*/;

/*Table structure for table `x23_notajual_det_ws1d` */

DROP TABLE IF EXISTS `x23_notajual_det_ws1d`;

/*!50001 DROP VIEW IF EXISTS `x23_notajual_det_ws1d` */;
/*!50001 DROP TABLE IF EXISTS `x23_notajual_det_ws1d` */;

/*!50001 CREATE TABLE  `x23_notajual_det_ws1d`(
 `id` int(11) ,
 `notabeli` varchar(20) ,
 `nonota` varchar(20) ,
 `notaindent` varchar(20) ,
 `tahun` year(4) ,
 `bulan` varchar(2) ,
 `tglnota` date ,
 `idbarang` int(11) ,
 `hargabelibersih` varchar(20) ,
 `hargajual` varchar(20) ,
 `diskon` varchar(20) ,
 `hargajualbersih` varchar(20) ,
 `qty` varchar(4) ,
 `tothargabelibersih` varchar(20) ,
 `totdiskon` varchar(20) ,
 `total` varchar(20) ,
 `idgudang` int(11) ,
 `rak` varchar(20) ,
 `tgltagihan` date ,
 `idtagihan` int(11) ,
 `tglbayarkpb` date ,
 `jumlahbayarkpb` varchar(20) ,
 `idbayar` int(11) ,
 `statusbayar` int(1) ,
 `statusulang` int(1) ,
 `jns` varchar(20) ,
 `kodebarang` varchar(20) ,
 `namabarang` varchar(50) ,
 `varian` varchar(50) ,
 `satuan` varchar(20) ,
 `idsupplier` int(11) ,
 `jnskwitansi` varchar(20) ,
 `status` int(11) 
)*/;

/*Table structure for table `x23_notajual_det_ws2` */

DROP TABLE IF EXISTS `x23_notajual_det_ws2`;

/*!50001 DROP VIEW IF EXISTS `x23_notajual_det_ws2` */;
/*!50001 DROP TABLE IF EXISTS `x23_notajual_det_ws2` */;

/*!50001 CREATE TABLE  `x23_notajual_det_ws2`(
 `id` int(11) ,
 `notabeli` varchar(20) ,
 `nonota` varchar(20) ,
 `tahun` year(4) ,
 `bulan` varchar(2) ,
 `tglnota` date ,
 `idbarang` int(11) ,
 `hargabelibersih` varchar(20) ,
 `hargajual` varchar(20) ,
 `diskon` varchar(20) ,
 `hargajualbersih` varchar(20) ,
 `qty` varchar(4) ,
 `tothargabelibersih` varchar(20) ,
 `totdiskon` varchar(20) ,
 `total` varchar(20) ,
 `idgudang` int(11) ,
 `rak` varchar(20) ,
 `tgltagihan` date ,
 `idtagihan` int(11) ,
 `tglbayarkpb` date ,
 `jumlahbayarkpb` varchar(20) ,
 `idbayar` int(11) ,
 `statusbayar` int(1) ,
 `statusulang` int(1) ,
 `jns` varchar(20) ,
 `kodebarang` varchar(20) ,
 `namabarang` varchar(50) ,
 `varian` varchar(50) ,
 `satuan` varchar(20) ,
 `idsupplier` int(11) 
)*/;

/*Table structure for table `x23_notajual_det_ws3` */

DROP TABLE IF EXISTS `x23_notajual_det_ws3`;

/*!50001 DROP VIEW IF EXISTS `x23_notajual_det_ws3` */;
/*!50001 DROP TABLE IF EXISTS `x23_notajual_det_ws3` */;

/*!50001 CREATE TABLE  `x23_notajual_det_ws3`(
 `id` int(11) ,
 `notabeli` varchar(20) ,
 `nonota` varchar(20) ,
 `tahun` year(4) ,
 `bulan` varchar(2) ,
 `tglnota` date ,
 `idbarang` int(11) ,
 `hargabelibersih` varchar(20) ,
 `hargajual` varchar(20) ,
 `diskon` varchar(20) ,
 `hargajualbersih` varchar(20) ,
 `qty` varchar(4) ,
 `tothargabelibersih` varchar(20) ,
 `totdiskon` varchar(20) ,
 `total` varchar(20) ,
 `idgudang` int(11) ,
 `rak` varchar(20) ,
 `tgltagihan` date ,
 `idtagihan` int(11) ,
 `tglbayarkpb` date ,
 `jumlahbayarkpb` varchar(20) ,
 `idbayar` int(11) ,
 `statusbayar` int(1) ,
 `statusulang` int(1) ,
 `jns` varchar(20) ,
 `kodebarang` varchar(20) ,
 `namabarang` varchar(50) ,
 `varian` varchar(50) ,
 `satuan` varchar(20) ,
 `idsupplier` int(11) 
)*/;

/*Table structure for table `x23_notajual_det_ws4` */

DROP TABLE IF EXISTS `x23_notajual_det_ws4`;

/*!50001 DROP VIEW IF EXISTS `x23_notajual_det_ws4` */;
/*!50001 DROP TABLE IF EXISTS `x23_notajual_det_ws4` */;

/*!50001 CREATE TABLE  `x23_notajual_det_ws4`(
 `id` int(11) ,
 `notabeli` varchar(20) ,
 `nonota` varchar(20) ,
 `tahun` year(4) ,
 `bulan` varchar(2) ,
 `tglnota` date ,
 `idbarang` int(11) ,
 `hargabelibersih` varchar(20) ,
 `hargajual` varchar(20) ,
 `diskon` varchar(20) ,
 `hargajualbersih` varchar(20) ,
 `qty` varchar(4) ,
 `tothargabelibersih` varchar(20) ,
 `totdiskon` varchar(20) ,
 `total` varchar(20) ,
 `idgudang` int(11) ,
 `rak` varchar(20) ,
 `tgltagihan` date ,
 `idtagihan` int(11) ,
 `tglbayarkpb` date ,
 `jumlahbayarkpb` varchar(20) ,
 `idbayar` int(11) ,
 `statusbayar` int(1) ,
 `statusulang` int(1) ,
 `jns` varchar(20) ,
 `kodebarang` varchar(20) ,
 `namabarang` varchar(50) ,
 `varian` varchar(50) ,
 `satuan` varchar(20) ,
 `idsupplier` int(11) 
)*/;

/*Table structure for table `x23_notajual_det_ws5a` */

DROP TABLE IF EXISTS `x23_notajual_det_ws5a`;

/*!50001 DROP VIEW IF EXISTS `x23_notajual_det_ws5a` */;
/*!50001 DROP TABLE IF EXISTS `x23_notajual_det_ws5a` */;

/*!50001 CREATE TABLE  `x23_notajual_det_ws5a`(
 `id` int(11) ,
 `notabeli` varchar(20) ,
 `nonota` varchar(20) ,
 `notaindent` varchar(20) ,
 `tahun` year(4) ,
 `bulan` varchar(2) ,
 `tglnota` date ,
 `idbarang` int(11) ,
 `hargabelibersih` varchar(20) ,
 `hargajual` varchar(20) ,
 `diskon` varchar(20) ,
 `hargajualbersih` varchar(20) ,
 `qty` varchar(4) ,
 `tothargabelibersih` varchar(20) ,
 `totdiskon` varchar(20) ,
 `total` varchar(20) ,
 `idgudang` int(11) ,
 `rak` varchar(20) ,
 `tgltagihan` date ,
 `idtagihan` int(11) ,
 `tglbayarkpb` date ,
 `jumlahbayarkpb` varchar(20) ,
 `idbayar` int(11) ,
 `statusbayar` int(1) ,
 `statusulang` int(1) ,
 `jns` varchar(20) ,
 `kodebarang` varchar(20) ,
 `namabarang` varchar(50) ,
 `varian` varchar(50) ,
 `satuan` varchar(20) ,
 `idsupplier` int(11) 
)*/;

/*Table structure for table `x23_notajual_det_ws5b` */

DROP TABLE IF EXISTS `x23_notajual_det_ws5b`;

/*!50001 DROP VIEW IF EXISTS `x23_notajual_det_ws5b` */;
/*!50001 DROP TABLE IF EXISTS `x23_notajual_det_ws5b` */;

/*!50001 CREATE TABLE  `x23_notajual_det_ws5b`(
 `id` int(11) ,
 `notabeli` varchar(20) ,
 `nonota` varchar(20) ,
 `notaindent` varchar(20) ,
 `tahun` year(4) ,
 `bulan` varchar(2) ,
 `tglnota` date ,
 `idbarang` int(11) ,
 `hargabelibersih` varchar(20) ,
 `hargajual` varchar(20) ,
 `diskon` varchar(20) ,
 `hargajualbersih` varchar(20) ,
 `qty` varchar(4) ,
 `tothargabelibersih` varchar(20) ,
 `totdiskon` varchar(20) ,
 `total` varchar(20) ,
 `idgudang` int(11) ,
 `rak` varchar(20) ,
 `tgltagihan` date ,
 `idtagihan` int(11) ,
 `tglbayarkpb` date ,
 `jumlahbayarkpb` varchar(20) ,
 `idbayar` int(11) ,
 `statusbayar` int(1) ,
 `statusulang` int(1) ,
 `jns` varchar(20) ,
 `kodebarang` varchar(20) ,
 `namabarang` varchar(50) ,
 `varian` varchar(50) ,
 `satuan` varchar(20) ,
 `idsupplier` int(11) 
)*/;

/*Table structure for table `x23_notajual_det_ws_pjmpm` */

DROP TABLE IF EXISTS `x23_notajual_det_ws_pjmpm`;

/*!50001 DROP VIEW IF EXISTS `x23_notajual_det_ws_pjmpm` */;
/*!50001 DROP TABLE IF EXISTS `x23_notajual_det_ws_pjmpm` */;

/*!50001 CREATE TABLE  `x23_notajual_det_ws_pjmpm`(
 `id` int(11) ,
 `notabeli` varchar(20) ,
 `nonota` varchar(20) ,
 `tahun` year(4) ,
 `bulan` varchar(2) ,
 `tglnota` date ,
 `idbarang` int(11) ,
 `hargabelibersih` varchar(20) ,
 `hargajual` varchar(20) ,
 `diskon` varchar(20) ,
 `hargajualbersih` varchar(20) ,
 `qty` varchar(4) ,
 `tothargabelibersih` varchar(20) ,
 `totdiskon` varchar(20) ,
 `total` varchar(20) ,
 `idgudang` int(11) ,
 `rak` varchar(20) ,
 `tgltagihan` date ,
 `idtagihan` int(11) ,
 `tglbayarkpb` date ,
 `jumlahbayarkpb` varchar(20) ,
 `idbayar` int(11) ,
 `statusbayar` int(1) ,
 `statusulang` int(1) ,
 `jns` varchar(20) ,
 `kodebarang` varchar(20) ,
 `namabarang` varchar(50) ,
 `varian` varchar(50) ,
 `satuan` varchar(20) ,
 `idsupplier` int(11) ,
 `nomor` varchar(20) ,
 `status` int(11) ,
 `jnskwitansi` varchar(20) 
)*/;

/*Table structure for table `x23_notajual_vw` */

DROP TABLE IF EXISTS `x23_notajual_vw`;

/*!50001 DROP VIEW IF EXISTS `x23_notajual_vw` */;
/*!50001 DROP TABLE IF EXISTS `x23_notajual_vw` */;

/*!50001 CREATE TABLE  `x23_notajual_vw`(
 `id` int(11) ,
 `nonota` varchar(20) ,
 `idpelanggan` int(11) ,
 `tahun` year(4) ,
 `bulan` varchar(2) ,
 `tglnota` date ,
 `totalqty` varchar(20) ,
 `totdiskon` varchar(20) ,
 `tothargabelibersih` varchar(20) ,
 `grandtotal` varchar(20) ,
 `status` int(1) ,
 `ket` varchar(11) ,
 `iduser` int(11) ,
 `inputx` datetime ,
 `updatex` varchar(200) ,
 `nama` varchar(200) ,
 `ohc` varchar(20) ,
 `kadaluarsaohc` date ,
 `notelepon` varchar(15) ,
 `noktp` varchar(20) ,
 `alamat` varchar(400) ,
 `rt` varchar(4) ,
 `rw` varchar(4) ,
 `kodekab` varchar(2) ,
 `namakab` varchar(40) ,
 `kodekec` varchar(2) ,
 `namakec` varchar(40) ,
 `kodekel` varchar(2) ,
 `namakel` varchar(40) ,
 `kodealamat` varchar(10) ,
 `email` varchar(40) ,
 `grup` int(1) ,
 `pekerjaan` varchar(40) 
)*/;

/*Table structure for table `x23_notaretur_vw` */

DROP TABLE IF EXISTS `x23_notaretur_vw`;

/*!50001 DROP VIEW IF EXISTS `x23_notaretur_vw` */;
/*!50001 DROP TABLE IF EXISTS `x23_notaretur_vw` */;

/*!50001 CREATE TABLE  `x23_notaretur_vw`(
 `id` int(11) ,
 `noretur` varchar(20) ,
 `idsupplier` int(11) ,
 `nama` varchar(40) ,
 `nonota` varchar(20) ,
 `jumlah` varchar(20) ,
 `potong` varchar(20) ,
 `sisa` varchar(20) ,
 `iduser` int(11) ,
 `status` int(1) ,
 `tahun` year(4) ,
 `bulan` varchar(2) ,
 `tanggal` date 
)*/;

/*Table structure for table `x23_notaservice_det1_vw` */

DROP TABLE IF EXISTS `x23_notaservice_det1_vw`;

/*!50001 DROP VIEW IF EXISTS `x23_notaservice_det1_vw` */;
/*!50001 DROP TABLE IF EXISTS `x23_notaservice_det1_vw` */;

/*!50001 CREATE TABLE  `x23_notaservice_det1_vw`(
 `id` int(11) ,
 `nonota` varchar(20) ,
 `tahun` year(4) ,
 `bulan` varchar(2) ,
 `tglnota` date ,
 `kodepaket` varchar(20) ,
 `idjasa` int(11) ,
 `tarifasli` varchar(20) ,
 `diskon` varchar(20) ,
 `tarif` varchar(20) ,
 `tarifkpb` varchar(20) ,
 `tgltagihan` date ,
 `idtagihan` int(11) ,
 `tglbayarkpb` date ,
 `jumlahbayarkpb` varchar(20) ,
 `idbayar` int(11) ,
 `statusbayar` int(1) ,
 `statusclaim` int(1) ,
 `jnskj` varchar(20) ,
 `nama` varchar(50) ,
 `harga` varchar(20) ,
 `kpbke` varchar(1) ,
 `oli` varchar(6) ,
 `hargampm` varchar(20) ,
 `inputx` datetime 
)*/;

/*Table structure for table `x23_notaservice_vw` */

DROP TABLE IF EXISTS `x23_notaservice_vw`;

/*!50001 DROP VIEW IF EXISTS `x23_notaservice_vw` */;
/*!50001 DROP TABLE IF EXISTS `x23_notaservice_vw` */;

/*!50001 CREATE TABLE  `x23_notaservice_vw`(
 `id` int(11) ,
 `jns` varchar(20) ,
 `noclaim` varchar(20) ,
 `noservis` varchar(20) ,
 `nonota` varchar(20) ,
 `noantrian` varchar(4) ,
 `nopkb` varchar(20) ,
 `idpelanggan` int(11) ,
 `tahun` year(4) ,
 `bulan` varchar(2) ,
 `tglnota` date ,
 `jammulai` time ,
 `jamselesai` time ,
 `nopol` varchar(10) ,
 `nomesin` varchar(40) ,
 `norangka` varchar(40) ,
 `kodemotor` varchar(50) ,
 `tipemotor` varchar(40) ,
 `varianmotor` varchar(40) ,
 `warnamotor` varchar(20) ,
 `tahunmotor` varchar(4) ,
 `km` varchar(8) ,
 `tglbelimotor` date ,
 `idmekanik` int(11) ,
 `grandtotal` varchar(20) ,
 `status` int(1) ,
 `ket` varchar(11) ,
 `iduser` int(11) ,
 `inputx` datetime ,
 `updatex` varchar(200) ,
 `nama` varchar(200) ,
 `ohc` varchar(20) ,
 `kadaluarsaohc` date ,
 `notelepon` varchar(15) ,
 `noktp` varchar(20) ,
 `alamat` varchar(400) ,
 `rt` varchar(4) ,
 `rw` varchar(4) ,
 `kodekab` varchar(2) ,
 `namakab` varchar(40) ,
 `kodekec` varchar(2) ,
 `namakec` varchar(40) ,
 `kodekel` varchar(2) ,
 `namakel` varchar(40) ,
 `kodealamat` varchar(10) ,
 `email` varchar(40) ,
 `pekerjaan` varchar(40) 
)*/;

/*Table structure for table `x23_opname_det_vw` */

DROP TABLE IF EXISTS `x23_opname_det_vw`;

/*!50001 DROP VIEW IF EXISTS `x23_opname_det_vw` */;
/*!50001 DROP TABLE IF EXISTS `x23_opname_det_vw` */;

/*!50001 CREATE TABLE  `x23_opname_det_vw`(
 `id` int(11) ,
 `idstok` int(11) ,
 `idopname` int(11) ,
 `idgudang` int(11) ,
 `gudang` varchar(40) ,
 `rak` varchar(20) ,
 `nonota` varchar(20) ,
 `tglnota` date ,
 `idbarang` int(11) ,
 `kodebarang` varchar(20) ,
 `namabarang` varchar(50) ,
 `varian` varchar(50) ,
 `stok` varchar(20) ,
 `opname` varchar(20) ,
 `hargabeli` varchar(20) ,
 `selisih` varchar(20) ,
 `totalselisih` varchar(20) 
)*/;

/*Table structure for table `x23_opname_vw` */

DROP TABLE IF EXISTS `x23_opname_vw`;

/*!50001 DROP VIEW IF EXISTS `x23_opname_vw` */;
/*!50001 DROP TABLE IF EXISTS `x23_opname_vw` */;

/*!50001 CREATE TABLE  `x23_opname_vw`(
 `id` int(11) ,
 `tahun` year(4) ,
 `bulan` varchar(2) ,
 `tanggal` date ,
 `idgudang` int(11) ,
 `gudang` varchar(40) ,
 `totselisih` varchar(20) ,
 `totjumselisih` varchar(20) ,
 `user` varbinary(20) ,
 `status` int(1) ,
 `inputx` datetime ,
 `nama` varchar(40) 
)*/;

/*Table structure for table `x23_pindah_det_vw` */

DROP TABLE IF EXISTS `x23_pindah_det_vw`;

/*!50001 DROP VIEW IF EXISTS `x23_pindah_det_vw` */;
/*!50001 DROP TABLE IF EXISTS `x23_pindah_det_vw` */;

/*!50001 CREATE TABLE  `x23_pindah_det_vw`(
 `id` int(11) ,
 `tanggal` date ,
 `idpindah` int(11) ,
 `nonota` varchar(20) ,
 `dealer1` varchar(20) ,
 `dealer2` varchar(20) ,
 `idgudang1` int(11) ,
 `gudang` varchar(40) ,
 `idgudang2` int(11) ,
 `rak1` varchar(20) ,
 `rak2` varchar(20) ,
 `idbarang` int(11) ,
 `hargabelibersih` varchar(20) ,
 `qty` varchar(20) ,
 `kodebarang` varchar(20) ,
 `namabarang` varchar(50) ,
 `varian` varchar(50) ,
 `satuan` varchar(20) ,
 `idsupplier` int(11) ,
 `stok` varchar(20) ,
 `inputx` datetime ,
 `updatex` varchar(100) 
)*/;

/*Table structure for table `x23_piutang_vw` */

DROP TABLE IF EXISTS `x23_piutang_vw`;

/*!50001 DROP VIEW IF EXISTS `x23_piutang_vw` */;
/*!50001 DROP TABLE IF EXISTS `x23_piutang_vw` */;

/*!50001 CREATE TABLE  `x23_piutang_vw`(
 `id` int(11) ,
 `jenis` varchar(20) ,
 `idkaryawan` int(11) ,
 `nama` varchar(40) ,
 `tgl` date ,
 `jumlah` varchar(20) ,
 `ket` varchar(100) ,
 `metodebayar` varchar(20) ,
 `status` int(1) ,
 `iduser` int(11) ,
 `namapic` varchar(40) ,
 `inputx` datetime ,
 `updatex` varchar(50) 
)*/;

/*Table structure for table `x23_potkompensasi_vw` */

DROP TABLE IF EXISTS `x23_potkompensasi_vw`;

/*!50001 DROP VIEW IF EXISTS `x23_potkompensasi_vw` */;
/*!50001 DROP TABLE IF EXISTS `x23_potkompensasi_vw` */;

/*!50001 CREATE TABLE  `x23_potkompensasi_vw`(
 `id` int(11) ,
 `idkaryawan` int(11) ,
 `nama` varchar(40) ,
 `tgl` date ,
 `jumlah` varchar(20) ,
 `ket` varchar(100) ,
 `metodebayar` varchar(20) ,
 `iduser` int(11) ,
 `status` int(1) ,
 `potkompensasi` int(1) ,
 `inputx` datetime ,
 `updatex` varchar(50) ,
 `namapic` varchar(40) 
)*/;

/*Table structure for table `x23_returbeli_det_vw` */

DROP TABLE IF EXISTS `x23_returbeli_det_vw`;

/*!50001 DROP VIEW IF EXISTS `x23_returbeli_det_vw` */;
/*!50001 DROP TABLE IF EXISTS `x23_returbeli_det_vw` */;

/*!50001 CREATE TABLE  `x23_returbeli_det_vw`(
 `id` int(11) ,
 `noretur` varchar(20) ,
 `tanggal` date ,
 `nonota` varchar(20) ,
 `idbarang` int(11) ,
 `kodebarang` varchar(20) ,
 `namabarang` varchar(50) ,
 `varian` varchar(50) ,
 `satuan` varchar(20) ,
 `idsupplier` int(11) ,
 `hargabelibersih` varchar(20) ,
 `qtykeluar` varchar(4) ,
 `totalkeluar` varchar(20) ,
 `qty` varchar(4) ,
 `total` varchar(20) ,
 `status` int(1) ,
 `tglretur` date ,
 `ket` varchar(20) ,
 `idgudang` int(11) ,
 `gudang` varchar(40) ,
 `rak` varchar(20) 
)*/;

/*Table structure for table `x23_returbeli_vw` */

DROP TABLE IF EXISTS `x23_returbeli_vw`;

/*!50001 DROP VIEW IF EXISTS `x23_returbeli_vw` */;
/*!50001 DROP TABLE IF EXISTS `x23_returbeli_vw` */;

/*!50001 CREATE TABLE  `x23_returbeli_vw`(
 `id` int(11) ,
 `noretur` varchar(20) ,
 `nonota` varchar(20) ,
 `nopo` varchar(20) ,
 `tahun` year(4) ,
 `bulan` varchar(2) ,
 `tanggal` date ,
 `user` int(11) ,
 `idgdg` int(11) ,
 `idsupplier` int(11) ,
 `status` int(1) ,
 `inputx` datetime ,
 `updatex` varchar(100) ,
 `tglnota` date ,
 `tglpo` date ,
 `totalqty` varchar(20) ,
 `gtbayar` varchar(20) ,
 `nama` varchar(40) 
)*/;

/*Table structure for table `x23_returjual_det_vw` */

DROP TABLE IF EXISTS `x23_returjual_det_vw`;

/*!50001 DROP VIEW IF EXISTS `x23_returjual_det_vw` */;
/*!50001 DROP TABLE IF EXISTS `x23_returjual_det_vw` */;

/*!50001 CREATE TABLE  `x23_returjual_det_vw`(
 `id` int(11) ,
 `notabeli` varchar(20) ,
 `noreturjual` varchar(20) ,
 `nonotajual` varchar(20) ,
 `tglnota` date ,
 `idbarang` int(11) ,
 `hargabelibersih` varchar(20) ,
 `hargajual` varchar(20) ,
 `diskon` varchar(20) ,
 `hargajualbersih` varchar(20) ,
 `qty` varchar(4) ,
 `totdiskon` varchar(20) ,
 `tothargabelibersih` varchar(20) ,
 `total` varchar(20) ,
 `idgudang` int(11) ,
 `rak` varchar(20) ,
 `tgltagihan` date ,
 `idtagihan` int(11) ,
 `tglbayarkpb` date ,
 `jumlahbayarkpb` varchar(20) ,
 `idbayar` int(11) ,
 `kodebarang` varchar(20) ,
 `namabarang` varchar(50) ,
 `varian` varchar(50) ,
 `gudang` varchar(40) 
)*/;

/*Table structure for table `x23_returjual_vw` */

DROP TABLE IF EXISTS `x23_returjual_vw`;

/*!50001 DROP VIEW IF EXISTS `x23_returjual_vw` */;
/*!50001 DROP TABLE IF EXISTS `x23_returjual_vw` */;

/*!50001 CREATE TABLE  `x23_returjual_vw`(
 `id` int(11) ,
 `tahun` year(4) ,
 `bulan` varchar(2) ,
 `tanggal` date ,
 `noreturjual` varchar(20) ,
 `nonotajual` varchar(20) ,
 `qtyretur` varchar(20) ,
 `jumlah` varchar(20) ,
 `iduser` int(11) ,
 `inputx` datetime ,
 `updatex` varchar(50) ,
 `idpelanggan` int(11) ,
 `tglnota` date ,
 `nama` varchar(200) ,
 `ohc` varchar(20) 
)*/;

/*Table structure for table `x23_servis_th` */

DROP TABLE IF EXISTS `x23_servis_th`;

/*!50001 DROP VIEW IF EXISTS `x23_servis_th` */;
/*!50001 DROP TABLE IF EXISTS `x23_servis_th` */;

/*!50001 CREATE TABLE  `x23_servis_th`(
 `id` int(11) ,
 `nonota` varchar(20) ,
 `nopkb` varchar(20) ,
 `tahun` year(4) ,
 `bulan` varchar(2) ,
 `tglnota` date ,
 `kodepaket` varchar(20) ,
 `idjasa` int(11) ,
 `tarifasli` varchar(20) ,
 `diskon` varchar(20) ,
 `tarif` varchar(20) ,
 `tarifppn` double ,
 `tarifkpb` varchar(20) ,
 `tgltagihan` date ,
 `idtagihan` int(11) ,
 `tglbayarkpb` date ,
 `jumlahbayarkpb` varchar(20) ,
 `idbayar` int(11) ,
 `statusbayar` int(1) ,
 `statusclaim` int(1) ,
 `jnskwitansi` varchar(20) ,
 `nomor` varchar(20) ,
 `tanggal` date ,
 `status` int(11) 
)*/;

/*Table structure for table `x23_stokpart_group_vw` */

DROP TABLE IF EXISTS `x23_stokpart_group_vw`;

/*!50001 DROP VIEW IF EXISTS `x23_stokpart_group_vw` */;
/*!50001 DROP TABLE IF EXISTS `x23_stokpart_group_vw` */;

/*!50001 CREATE TABLE  `x23_stokpart_group_vw`(
 `id` int(11) ,
 `idgudang` int(11) ,
 `gudang` varchar(40) ,
 `rak` varchar(20) ,
 `nonota` varchar(20) ,
 `idbarang` int(11) ,
 `kodebarang` varchar(20) ,
 `namabarang` varchar(50) ,
 `varian` varchar(50) ,
 `satuan` varchar(20) ,
 `idsupplier` int(11) ,
 `hargabelibersih` varchar(20) ,
 `hargajual` varchar(20) ,
 `hargajual2` varchar(20) ,
 `inputx` datetime ,
 `updatex` varchar(100) ,
 `totalstok` double 
)*/;

/*Table structure for table `x23_stokpart_group_vw2` */

DROP TABLE IF EXISTS `x23_stokpart_group_vw2`;

/*!50001 DROP VIEW IF EXISTS `x23_stokpart_group_vw2` */;
/*!50001 DROP TABLE IF EXISTS `x23_stokpart_group_vw2` */;

/*!50001 CREATE TABLE  `x23_stokpart_group_vw2`(
 `id` int(11) ,
 `idgudang` int(11) ,
 `gudang` varchar(40) ,
 `rak` varchar(20) ,
 `nonota` varchar(20) ,
 `idbarang` int(11) ,
 `kodebarang` varchar(20) ,
 `namabarang` varchar(50) ,
 `varian` varchar(50) ,
 `satuan` varchar(20) ,
 `idsupplier` int(11) ,
 `hargabelibersih` varchar(20) ,
 `hargajual` varchar(20) ,
 `hargajual2` varchar(20) ,
 `inputx` datetime ,
 `updatex` varchar(100) ,
 `totalstok` double 
)*/;

/*Table structure for table `x23_stokpart_gt_vw` */

DROP TABLE IF EXISTS `x23_stokpart_gt_vw`;

/*!50001 DROP VIEW IF EXISTS `x23_stokpart_gt_vw` */;
/*!50001 DROP TABLE IF EXISTS `x23_stokpart_gt_vw` */;

/*!50001 CREATE TABLE  `x23_stokpart_gt_vw`(
 `nonota` varchar(20) ,
 `hargabelibersih` varchar(20) ,
 `stok` varchar(20) ,
 `tot` double ,
 `status` int(1) 
)*/;

/*Table structure for table `x23_stokpart_opname_vw` */

DROP TABLE IF EXISTS `x23_stokpart_opname_vw`;

/*!50001 DROP VIEW IF EXISTS `x23_stokpart_opname_vw` */;
/*!50001 DROP TABLE IF EXISTS `x23_stokpart_opname_vw` */;

/*!50001 CREATE TABLE  `x23_stokpart_opname_vw`(
 `id` int(11) ,
 `idgudang` int(11) ,
 `gudang` varchar(40) ,
 `rak` varchar(20) ,
 `nonota` varchar(20) ,
 `tglnota` date ,
 `idbarang` int(11) ,
 `kodebarang` varchar(20) ,
 `namabarang` varchar(50) ,
 `varian` varchar(50) ,
 `satuan` varchar(20) ,
 `idsupplier` int(11) ,
 `hargabelibersih` varchar(20) ,
 `hargajual` varchar(20) ,
 `hargajual2` varchar(20) ,
 `inputx` datetime ,
 `updatex` varchar(100) ,
 `totalstok` varchar(20) 
)*/;

/*Table structure for table `x23_stokpart_vw` */

DROP TABLE IF EXISTS `x23_stokpart_vw`;

/*!50001 DROP VIEW IF EXISTS `x23_stokpart_vw` */;
/*!50001 DROP TABLE IF EXISTS `x23_stokpart_vw` */;

/*!50001 CREATE TABLE  `x23_stokpart_vw`(
 `id` int(11) ,
 `idgudang` int(11) ,
 `gudang` varchar(40) ,
 `rak` varchar(20) ,
 `nonota` varchar(20) ,
 `idbarang` int(11) ,
 `kodebarang` varchar(20) ,
 `namabarang` varchar(50) ,
 `varian` varchar(50) ,
 `satuan` varchar(20) ,
 `idsupplier` int(11) ,
 `tglnota` date ,
 `hargabelibersih` varchar(20) ,
 `hargajual` varchar(20) ,
 `hargajual2` varchar(20) ,
 `stok` varchar(20) ,
 `status` int(1) ,
 `dk` int(1) ,
 `inputx` datetime ,
 `updatex` varchar(100) 
)*/;

/*Table structure for table `x23_tarifjasa2_vw` */

DROP TABLE IF EXISTS `x23_tarifjasa2_vw`;

/*!50001 DROP VIEW IF EXISTS `x23_tarifjasa2_vw` */;
/*!50001 DROP TABLE IF EXISTS `x23_tarifjasa2_vw` */;

/*!50001 CREATE TABLE  `x23_tarifjasa2_vw`(
 `id` int(11) ,
 `idmekanik` int(11) ,
 `jnsjasa` varchar(11) ,
 `idjasa` int(11) ,
 `kodepaket` varchar(11) ,
 `tarif` int(20) ,
 `nik` varchar(20) ,
 `nama` varchar(40) ,
 `posisi` int(1) ,
 `pangkat` varchar(20) 
)*/;

/*Table structure for table `x23_tarifjasa_vw` */

DROP TABLE IF EXISTS `x23_tarifjasa_vw`;

/*!50001 DROP VIEW IF EXISTS `x23_tarifjasa_vw` */;
/*!50001 DROP TABLE IF EXISTS `x23_tarifjasa_vw` */;

/*!50001 CREATE TABLE  `x23_tarifjasa_vw`(
 `id` int(11) ,
 `idjasa` int(11) ,
 `pangkat` varchar(20) ,
 `tarif` varchar(20) ,
 `kodejasa` varchar(20) ,
 `namajasa` varchar(50) 
)*/;

/*Table structure for table `x23_temp_pindah_det_vw` */

DROP TABLE IF EXISTS `x23_temp_pindah_det_vw`;

/*!50001 DROP VIEW IF EXISTS `x23_temp_pindah_det_vw` */;
/*!50001 DROP TABLE IF EXISTS `x23_temp_pindah_det_vw` */;

/*!50001 CREATE TABLE  `x23_temp_pindah_det_vw`(
 `id` int(11) ,
 `dealer1` varchar(20) ,
 `dealer2` varchar(20) ,
 `idgudang1` int(11) ,
 `idgudang2` int(11) ,
 `rak1` varchar(20) ,
 `rak2` varchar(20) ,
 `idbarang` int(11) ,
 `qty` varchar(20) ,
 `gudang` varchar(40) ,
 `nonota` varchar(20) ,
 `tglnota` date ,
 `kodebarang` varchar(20) ,
 `namabarang` varchar(50) ,
 `varian` varchar(50) ,
 `satuan` varchar(20) ,
 `idsupplier` int(11) ,
 `hargabelibersih` varchar(20) ,
 `stok` varchar(20) ,
 `inputx` datetime ,
 `updatex` varchar(100) 
)*/;

/*Table structure for table `x23_user_vw` */

DROP TABLE IF EXISTS `x23_user_vw`;

/*!50001 DROP VIEW IF EXISTS `x23_user_vw` */;
/*!50001 DROP TABLE IF EXISTS `x23_user_vw` */;

/*!50001 CREATE TABLE  `x23_user_vw`(
 `id` int(11) ,
 `id_karyawan` int(11) ,
 `user` varchar(50) ,
 `pass` varchar(50) ,
 `hakakses` varchar(20) ,
 `nama` varchar(40) ,
 `status` varchar(20) ,
 `nik` varchar(20) ,
 `id_posisi` int(11) ,
 `posisi` varchar(20) 
)*/;

/*View structure for view abs_employee_vw */

/*!50001 DROP TABLE IF EXISTS `abs_employee_vw` */;
/*!50001 DROP VIEW IF EXISTS `abs_employee_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `abs_employee_vw` AS select `abs_employee`.`EmployeeID` AS `EmployeeID`,`abs_employee`.`FirstName` AS `FirstName`,`abs_employee`.`LastName` AS `LastName`,`abs_employee`.`DepartmentID` AS `DepartmentID`,`abs_department`.`DepartmentName` AS `DepartmentName`,`tbl_karyawan`.`status` AS `status` from ((`abs_employee` join `tbl_karyawan` on((`abs_employee`.`EmployeeID` = `tbl_karyawan`.`nik`))) join `abs_department` on((`abs_employee`.`DepartmentID` = `abs_department`.`DepartmentID`))) */;

/*View structure for view abs_result_vw */

/*!50001 DROP TABLE IF EXISTS `abs_result_vw` */;
/*!50001 DROP VIEW IF EXISTS `abs_result_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `abs_result_vw` AS select `abs_result`.`EmployeeID` AS `EmployeeID`,`abs_employee`.`FirstName` AS `FirstName`,`abs_employee`.`LastName` AS `LastName`,`abs_employee`.`DepartmentID` AS `DepartmentID`,`abs_department`.`DepartmentName` AS `DepartmentName`,`abs_result`.`Date` AS `Date`,`abs_result`.`Scan1` AS `Scan1`,`abs_result`.`Scan2` AS `Scan2`,`abs_result`.`Scan3` AS `Scan3`,`abs_result`.`Scan4` AS `Scan4`,`abs_result`.`TotalScan` AS `TotalScan`,`abs_result`.`Late` AS `Late`,`abs_result`.`BreakDuration` AS `BreakDuration`,`abs_result`.`BreakOver` AS `BreakOver`,`abs_result`.`TimeOfWork` AS `TimeOfWork`,`abs_result`.`ComingOverTime` AS `ComingOverTime`,`abs_result`.`BackOverTime` AS `BackOverTime` from ((`abs_employee` join `abs_department` on((`abs_employee`.`DepartmentID` = `abs_department`.`DepartmentID`))) join `abs_result` on((`abs_employee`.`EmployeeID` = `abs_result`.`EmployeeID`))) */;

/*View structure for view abs_status_vw */

/*!50001 DROP TABLE IF EXISTS `abs_status_vw` */;
/*!50001 DROP VIEW IF EXISTS `abs_status_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `abs_status_vw` AS select `abs_status`.`id` AS `id`,`abs_status`.`EmployeeID` AS `EmployeeID`,`abs_status`.`awal` AS `awal`,`abs_status`.`akhir` AS `akhir`,`abs_status`.`status` AS `status`,`abs_status`.`keterangan` AS `keterangan`,`abs_employee`.`FirstName` AS `FirstName`,`abs_employee`.`LastName` AS `LastName`,`abs_employee`.`DepartmentID` AS `DepartmentID`,`abs_department`.`DepartmentName` AS `DepartmentName` from ((`abs_status` join `abs_employee` on((`abs_status`.`EmployeeID` = `abs_employee`.`EmployeeID`))) join `abs_department` on((`abs_employee`.`DepartmentID` = `abs_department`.`DepartmentID`))) */;

/*View structure for view abs_x23_employee_vw */

/*!50001 DROP TABLE IF EXISTS `abs_x23_employee_vw` */;
/*!50001 DROP VIEW IF EXISTS `abs_x23_employee_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `abs_x23_employee_vw` AS select `abs_x23_employee`.`EmployeeID` AS `EmployeeID`,`abs_x23_employee`.`FirstName` AS `FirstName`,`abs_x23_employee`.`LastName` AS `LastName`,`abs_x23_employee`.`DepartmentID` AS `DepartmentID`,`abs_x23_department`.`DepartmentName` AS `DepartmentName`,`x23_karyawan`.`posisi` AS `posisi`,`x23_karyawan`.`status` AS `status` from ((`abs_x23_employee` join `abs_x23_department` on((`abs_x23_employee`.`DepartmentID` = `abs_x23_department`.`DepartmentID`))) join `x23_karyawan` on((`abs_x23_employee`.`EmployeeID` = `x23_karyawan`.`nik`))) */;

/*View structure for view abs_x23_result_vw */

/*!50001 DROP TABLE IF EXISTS `abs_x23_result_vw` */;
/*!50001 DROP VIEW IF EXISTS `abs_x23_result_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `abs_x23_result_vw` AS select `abs_x23_result`.`EmployeeID` AS `EmployeeID`,`abs_x23_employee`.`FirstName` AS `FirstName`,`abs_x23_employee`.`LastName` AS `LastName`,`abs_x23_employee`.`DepartmentID` AS `DepartmentID`,`abs_x23_department`.`DepartmentName` AS `DepartmentName`,`abs_x23_result`.`Date` AS `Date`,`abs_x23_result`.`Scan1` AS `Scan1`,`abs_x23_result`.`Scan2` AS `Scan2`,`abs_x23_result`.`Scan3` AS `Scan3`,`abs_x23_result`.`Scan4` AS `Scan4`,`abs_x23_result`.`TotalScan` AS `TotalScan`,`abs_x23_result`.`Late` AS `Late`,`abs_x23_result`.`BreakDuration` AS `BreakDuration`,`abs_x23_result`.`BreakOver` AS `BreakOver`,`abs_x23_result`.`TimeOfWork` AS `TimeOfWork`,`abs_x23_result`.`ComingOverTime` AS `ComingOverTime`,`abs_x23_result`.`BackOverTime` AS `BackOverTime` from ((`abs_x23_employee` join `abs_x23_department` on((`abs_x23_employee`.`DepartmentID` = `abs_x23_department`.`DepartmentID`))) join `abs_x23_result` on((`abs_x23_employee`.`EmployeeID` = `abs_x23_result`.`EmployeeID`))) */;

/*View structure for view abs_x23_status_vw */

/*!50001 DROP TABLE IF EXISTS `abs_x23_status_vw` */;
/*!50001 DROP VIEW IF EXISTS `abs_x23_status_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `abs_x23_status_vw` AS select `abs_x23_status`.`id` AS `id`,`abs_x23_status`.`EmployeeID` AS `EmployeeID`,`abs_x23_status`.`awal` AS `awal`,`abs_x23_status`.`akhir` AS `akhir`,`abs_x23_status`.`status` AS `status`,`abs_x23_status`.`keterangan` AS `keterangan`,`abs_x23_employee`.`FirstName` AS `FirstName`,`abs_x23_employee`.`LastName` AS `LastName`,`abs_x23_employee`.`DepartmentID` AS `DepartmentID`,`abs_x23_department`.`DepartmentName` AS `DepartmentName` from ((`abs_x23_status` join `abs_x23_employee` on((`abs_x23_status`.`EmployeeID` = `abs_x23_employee`.`EmployeeID`))) join `abs_x23_department` on((`abs_x23_employee`.`DepartmentID` = `abs_x23_department`.`DepartmentID`))) */;

/*View structure for view tbl_abis_arusunit1 */

/*!50001 DROP TABLE IF EXISTS `tbl_abis_arusunit1` */;
/*!50001 DROP VIEW IF EXISTS `tbl_abis_arusunit1` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_abis_arusunit1` AS select `tbl_notajual_det`.`nonota` AS `nonota`,`tbl_notajual_det`.`nopesan` AS `nopesan`,`tbl_notajual_det`.`idbarang` AS `idbarang`,`tbl_notajual_det`.`norangka` AS `norangka`,`tbl_notajual`.`tahun` AS `tahun`,`tbl_notajual`.`bulan` AS `bulan`,`tbl_notajual`.`tglnota` AS `tglnota`,`tbl_stokunit_vw`.`kodebarang` AS `kodebarang`,`tbl_stokunit_vw`.`namabarang` AS `namabarang`,`tbl_stokunit_vw`.`varian` AS `varian`,`tbl_stokunit_vw`.`warna` AS `warna`,`tbl_stokunit_vw`.`gudang` AS `gudang` from ((`tbl_notajual_det` join `tbl_notajual` on((`tbl_notajual_det`.`nonota` = `tbl_notajual`.`nonota`))) join `tbl_stokunit_vw` on((`tbl_notajual_det`.`norangka` = `tbl_stokunit_vw`.`norangka`))) */;

/*View structure for view tbl_abis_arusunit2 */

/*!50001 DROP TABLE IF EXISTS `tbl_abis_arusunit2` */;
/*!50001 DROP VIEW IF EXISTS `tbl_abis_arusunit2` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_abis_arusunit2` AS select `tbl_pindah_det`.`id` AS `id`,`tbl_pindah_det`.`idpindah` AS `idpindah`,`tbl_pindah_det`.`norangka` AS `norangka`,`tbl_pindah`.`tahun` AS `tahun`,`tbl_pindah`.`bulan` AS `bulan`,`tbl_pindah`.`tanggal` AS `tanggal`,`tbl_pindah`.`idgudang1` AS `idgudang1`,`tbl_pindah`.`idgudang2` AS `idgudang2`,`tbl_stokunit_vw`.`kodebarang` AS `kodebarang`,`tbl_stokunit_vw`.`namabarang` AS `namabarang`,`tbl_stokunit_vw`.`warna` AS `warna`,`tbl_stokunit_vw`.`varian` AS `varian` from ((`tbl_pindah_det` join `tbl_pindah` on((`tbl_pindah_det`.`idpindah` = `tbl_pindah`.`id`))) join `tbl_stokunit_vw` on((`tbl_pindah_det`.`norangka` = `tbl_stokunit_vw`.`norangka`))) */;

/*View structure for view tbl_cekfisik_vw */

/*!50001 DROP TABLE IF EXISTS `tbl_cekfisik_vw` */;
/*!50001 DROP VIEW IF EXISTS `tbl_cekfisik_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_cekfisik_vw` AS select `tbl_cekfisik`.`id` AS `id`,`tbl_cekfisik`.`nonota` AS `nonota`,`tbl_cekfisik`.`idbarang` AS `idbarang`,`tbl_cekfisik`.`norangka` AS `norangka`,`tbl_cekfisik`.`nomesin` AS `nomesin`,`tbl_cekfisik`.`tahun` AS `tahun`,`tbl_cekfisik`.`bulan` AS `bulan`,`tbl_cekfisik`.`tanggal` AS `tanggal`,`tbl_cekfisik`.`user` AS `user`,`tbl_cekfisik`.`accu` AS `accu`,`tbl_cekfisik`.`alaskaki` AS `alaskaki`,`tbl_cekfisik`.`anakkunci` AS `anakkunci`,`tbl_cekfisik`.`helm` AS `helm`,`tbl_cekfisik`.`spion` AS `spion`,`tbl_cekfisik`.`toolkit` AS `toolkit`,`tbl_cekfisik`.`cekfisik` AS `cekfisik`,`tbl_cekfisik`.`kondisimotor` AS `kondisimotor`,`tbl_cekfisik`.`inputx` AS `inputx`,`tbl_cekfisik`.`bensinawal` AS `bensinawal`,`tbl_cekfisik`.`lihat` AS `lihat`,`tbl_cekfisik`.`ikesalahan` AS `ikesalahan`,`tbl_masterbarang`.`literawal` AS `literawal`,`tbl_user_vw`.`nama` AS `nama`,`tbl_masterbarang`.`kodebarang` AS `kodebarang`,`tbl_masterbarang`.`namabarang` AS `namabarang`,`tbl_masterbarang`.`varian` AS `varian`,`tbl_masterbarang`.`warna` AS `warna`,`tbl_masterbarang`.`thnproduksi` AS `thnproduksi`,`tbl_masterbarang`.`satuan` AS `satuan` from ((`tbl_cekfisik` join `tbl_masterbarang` on((`tbl_cekfisik`.`idbarang` = `tbl_masterbarang`.`id`))) join `tbl_user_vw` on((`tbl_cekfisik`.`user` = `tbl_user_vw`.`id`))) */;

/*View structure for view tbl_hleasing_vw */

/*!50001 DROP TABLE IF EXISTS `tbl_hleasing_vw` */;
/*!50001 DROP VIEW IF EXISTS `tbl_hleasing_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_hleasing_vw` AS select `tbl_hleasing`.`id` AS `id`,`tbl_hleasing`.`id_pelanggan` AS `id_pelanggan`,`tbl_hleasing`.`kodeleasing` AS `kodeleasing`,`tbl_hleasing`.`unit` AS `unit`,`tbl_hleasing`.`termin` AS `termin`,`tbl_hleasing`.`tanggal` AS `tanggal`,`tbl_hleasing`.`status` AS `status`,`tbl_leasing`.`namaleasing` AS `namaleasing`,if((`tbl_hleasing`.`status` = '0'),'DITOLAK','DISETUJUI') AS `ketstatus` from (`tbl_hleasing` join `tbl_leasing` on((`tbl_hleasing`.`kodeleasing` = `tbl_leasing`.`kodeleasing`))) */;

/*View structure for view tbl_insentif_karyawan_vw */

/*!50001 DROP TABLE IF EXISTS `tbl_insentif_karyawan_vw` */;
/*!50001 DROP VIEW IF EXISTS `tbl_insentif_karyawan_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_insentif_karyawan_vw` AS select `tbl_insentif_karyawan`.`id` AS `id`,`tbl_insentif_karyawan`.`id_karyawan` AS `id_karyawan`,`tbl_insentif_karyawan`.`target` AS `target`,`tbl_insentif_karyawan`.`cash` AS `cash`,`tbl_insentif_karyawan`.`kredit` AS `kredit`,`tbl_insentif_karyawan`.`flat` AS `flat`,`tbl_karyawan_vw`.`nama` AS `nama`,`tbl_karyawan_vw`.`posisi` AS `posisi`,`tbl_karyawan_vw`.`id_posisi` AS `id_posisi` from (`tbl_insentif_karyawan` join `tbl_karyawan_vw` on((`tbl_insentif_karyawan`.`id_karyawan` = `tbl_karyawan_vw`.`id`))) */;

/*View structure for view tbl_karyawan_vw */

/*!50001 DROP TABLE IF EXISTS `tbl_karyawan_vw` */;
/*!50001 DROP VIEW IF EXISTS `tbl_karyawan_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_karyawan_vw` AS select `tbl_karyawan`.`id` AS `id`,`tbl_karyawan`.`nik` AS `nik`,`tbl_karyawan`.`nama` AS `nama`,`tbl_karyawan`.`tmplahir` AS `tmplahir`,`tbl_karyawan`.`tgllahir` AS `tgllahir`,`tbl_karyawan`.`noktp` AS `noktp`,`tbl_karyawan`.`notelepon` AS `notelepon`,`tbl_karyawan`.`alamat` AS `alamat`,`tbl_karyawan`.`tglmulaikerja` AS `tglmulaikerja`,`tbl_karyawan`.`ugapok` AS `ugapok`,`tbl_karyawan`.`uharian` AS `uharian`,`tbl_karyawan`.`ukomisi` AS `ukomisi`,`tbl_karyawan`.`ulembur` AS `ulembur`,`tbl_karyawan`.`photo` AS `photo`,`tbl_karyawan`.`status` AS `status`,`tbl_karyawan`.`pic_user` AS `pic_user`,`tbl_posisi`.`posisi` AS `posisi`,`tbl_posisi`.`id` AS `id_posisi`,(substr(curdate(),1,4) - substr(`tbl_karyawan`.`tgllahir`,1,4)) AS `usia` from (`tbl_karyawan` join `tbl_posisi` on((`tbl_karyawan`.`posisi` = `tbl_posisi`.`id`))) */;

/*View structure for view tbl_ksindividu_vw */

/*!50001 DROP TABLE IF EXISTS `tbl_ksindividu_vw` */;
/*!50001 DROP VIEW IF EXISTS `tbl_ksindividu_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_ksindividu_vw` AS select `tbl_cekfisik`.`id` AS `id`,`tbl_cekfisik`.`nonota` AS `nonota`,`tbl_cekfisik`.`idbarang` AS `idbarang`,`tbl_cekfisik`.`tahun` AS `tahun`,`tbl_cekfisik`.`bulan` AS `bulan`,`tbl_cekfisik`.`tanggal` AS `tanggal`,`tbl_pesanan`.`nopesan` AS `nopesan`,`tbl_pesanan`.`idsales` AS `idsales`,`tbl_pesanan`.`idleasing` AS `idleasing`,`tbl_pesanan`.`jnstransaksi` AS `jnstransaksi`,`tbl_pesanan`.`jnscashtempo` AS `jnscashtempo`,`tbl_masterbarang`.`kodebarang` AS `kodebarang`,`tbl_masterbarang`.`namabarang` AS `namabarang`,`tbl_masterbarang`.`varian` AS `varian`,`tbl_masterbarang`.`warna` AS `warna`,`tbl_masterbarang`.`thnproduksi` AS `thnproduksi`,`tbl_notajual`.`tglnota` AS `tglnota`,`tbl_notajual`.`idpelanggan` AS `idpelanggan` from (((`tbl_cekfisik` join `tbl_notajual` on((`tbl_cekfisik`.`nonota` = `tbl_notajual`.`nonota`))) join `tbl_masterbarang` on((`tbl_cekfisik`.`idbarang` = `tbl_masterbarang`.`id`))) join `tbl_pesanan` on((`tbl_notajual`.`nopesan` = `tbl_pesanan`.`nopesan`))) */;

/*View structure for view tbl_kwitansi_vw */

/*!50001 DROP TABLE IF EXISTS `tbl_kwitansi_vw` */;
/*!50001 DROP VIEW IF EXISTS `tbl_kwitansi_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_kwitansi_vw` AS select `tbl_kwitansi`.`id` AS `id`,`tbl_kwitansi`.`jnskwitansi` AS `jnskwitansi`,`tbl_kwitansi`.`nokwitansi` AS `nokwitansi`,`tbl_kwitansi`.`tahun` AS `tahun`,`tbl_kwitansi`.`bulan` AS `bulan`,`tbl_kwitansi`.`tanggal` AS `tanggal`,`tbl_kwitansi`.`nomor` AS `nomor`,`tbl_kwitansi`.`idpelanggan` AS `idpelanggan`,`tbl_kwitansi`.`jaket` AS `jaket`,`tbl_kwitansi`.`bukuservice` AS `bukuservice`,`tbl_kwitansi`.`jumlah` AS `jumlah`,`tbl_kwitansi`.`user` AS `user`,`tbl_kwitansi`.`keterangan` AS `keterangan`,`tbl_kwitansi`.`status` AS `status`,`tbl_kwitansi`.`cetak` AS `cetak`,`tbl_kwitansi`.`inputx` AS `inputx`,`tbl_kwitansi`.`updatex` AS `updatex`,`tbl_pelanggan`.`nama` AS `nama`,`tbl_pelanggan`.`ohc` AS `ohc`,`tbl_user_vw`.`nama` AS `namapic` from ((`tbl_kwitansi` join `tbl_pelanggan` on((`tbl_kwitansi`.`idpelanggan` = `tbl_pelanggan`.`id`))) join `tbl_user_vw` on((`tbl_kwitansi`.`user` = `tbl_user_vw`.`id`))) */;

/*View structure for view tbl_labacash1_vw */

/*!50001 DROP TABLE IF EXISTS `tbl_labacash1_vw` */;
/*!50001 DROP VIEW IF EXISTS `tbl_labacash1_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_labacash1_vw` AS select `tbl_notajual_det`.`id` AS `id`,`tbl_notajual_det`.`nonota` AS `nonota`,`tbl_notajual`.`tglnota` AS `tglnota`,`tbl_notajual`.`bulan` AS `bulan`,`tbl_notajual`.`tahun` AS `tahun`,`tbl_notajual`.`idpelanggan` AS `idpelanggan`,`tbl_notajual_det`.`nopesan` AS `nopesan`,`tbl_notajual_det`.`idbarang` AS `idbarang`,`tbl_notajual_det`.`norangka` AS `norangka`,`tbl_notajual_det`.`ppnjual` AS `ppnjual`,`tbl_notajual_det`.`hargabeli` AS `hargabeli`,`tbl_notajual_det`.`ppnbeli` AS `ppnbeli`,`tbl_notajual_det`.`jual_plus_ppnbeli` AS `jual_plus_ppnbeli`,`tbl_notajual_det`.`ppnjual_min_ppnbeli` AS `ppnjual_min_ppnbeli`,`tbl_notajual_det`.`jumlah1` AS `jumlah1`,`tbl_notajual_det`.`otrsetelahpajak` AS `otrsetelahpajak`,`tbl_notajual_det`.`bbn` AS `bbn`,`tbl_notajual_det`.`offtheroad` AS `offtheroad`,`tbl_notajual_det`.`matrix1` AS `matrix1`,`tbl_notajual_det`.`matrix2` AS `matrix2`,`tbl_notajual_det`.`matrixpajak` AS `matrixpajak`,`tbl_notajual_det`.`subsidi1` AS `subsidi1`,`tbl_notajual_det`.`subsidi2` AS `subsidi2`,`tbl_notajual_det`.`subsidipajak` AS `subsidipajak`,`tbl_notajual_det`.`ref` AS `ref`,`tbl_notajual_det`.`notelpref` AS `notelpref`,`tbl_notajual_det`.`statuskomisi` AS `statuskomisi`,`tbl_notajual_det`.`jumlah` AS `jumlah`,`tbl_notajual_det`.`statusleasing` AS `statusleasing`,`tbl_notajual_det`.`statusbbn` AS `statusbbn`,`tbl_notajual_det`.`bayarotr` AS `bayarotr`,`tbl_notajual_det`.`tglotr` AS `tglotr`,`tbl_notajual_det`.`statusotr` AS `statusotr`,`tbl_notajual_det`.`gross` AS `gross`,`tbl_notajual_det`.`tglgross` AS `tglgross`,`tbl_notajual_det`.`statusgross` AS `statusgross`,`tbl_notajual_det`.`subsidi` AS `subsidi`,`tbl_notajual_det`.`tglsubsidi` AS `tglsubsidi`,`tbl_notajual_det`.`statussubsidi` AS `statussubsidi`,`tbl_notajual_det`.`matrix` AS `matrix`,`tbl_notajual_det`.`tglmatrix` AS `tglmatrix`,`tbl_notajual_det`.`statusmatrix` AS `statusmatrix`,`tbl_notajual`.`tnkb` AS `tnkb`,`tbl_masterbarang`.`noticehitam` AS `noticehitam`,`tbl_masterbarang`.`noticemerah` AS `noticemerah`,`tbl_notajual`.`jnstransaksi` AS `jnstransaksi`,`tbl_notajual`.`jnscashtempo` AS `jnscashtempo`,`tbl_notajual`.`status` AS `status`,(select `tbl_lainbbn`.`lainbbn` from `tbl_lainbbn` where (`tbl_lainbbn`.`status` = '1')) AS `mis`,(`tbl_notajual_det`.`hargabeli` + `tbl_notajual_det`.`ppnbeli`) AS `C`,((`tbl_notajual_det`.`hargabeli` + `tbl_notajual_det`.`ppnbeli`) + 1141500) AS `D`,if((`tbl_notajual`.`tnkb` = 'PLAT HITAM'),`tbl_masterbarang`.`noticehitam`,`tbl_masterbarang`.`noticemerah`) AS `notice`,(((if((`tbl_notajual`.`tnkb` = 'PLAT HITAM'),`tbl_masterbarang`.`noticehitam`,`tbl_masterbarang`.`noticemerah`) + `tbl_notajual_det`.`hargabeli`) + `tbl_notajual_det`.`ppnbeli`) + (select `tbl_lainbbn`.`lainbbn` from `tbl_lainbbn` where (`tbl_lainbbn`.`status` = '1'))) AS `F`,`tbl_notajual_det`.`otr` AS `otr`,`tbl_notajual_det`.`disc` AS `disc`,`tbl_notajual_det`.`komisi` AS `komisi`,((`tbl_notajual_det`.`otr` - `tbl_notajual_det`.`disc`) - (((if((`tbl_notajual`.`tnkb` = 'PLAT HITAM'),`tbl_masterbarang`.`noticehitam`,`tbl_masterbarang`.`noticemerah`) + `tbl_notajual_det`.`hargabeli`) + `tbl_notajual_det`.`ppnbeli`) + 1500000)) AS `G`,`tbl_notajual_det`.`bayargross` AS `bayargross`,`tbl_notajual_det`.`bayarsubsidi` AS `bayarsubsidi`,`tbl_notajual_det`.`bayarmatrix` AS `bayarmatrix` from ((`tbl_notajual_det` join `tbl_masterbarang` on((`tbl_notajual_det`.`idbarang` = `tbl_masterbarang`.`id`))) join `tbl_notajual` on((`tbl_notajual_det`.`nonota` = `tbl_notajual`.`nonota`))) where ((`tbl_notajual`.`jnstransaksi` = 'CASH') or ((`tbl_notajual`.`jnstransaksi` = 'CASH TEMPO') and (`tbl_notajual`.`jnscashtempo` = 'DEALER'))) */;

/*View structure for view tbl_labakredit1_vw */

/*!50001 DROP TABLE IF EXISTS `tbl_labakredit1_vw` */;
/*!50001 DROP VIEW IF EXISTS `tbl_labakredit1_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_labakredit1_vw` AS select `tbl_notajual_det`.`id` AS `id`,`tbl_notajual_det`.`nonota` AS `nonota`,`tbl_notajual`.`tglnota` AS `tglnota`,`tbl_notajual`.`bulan` AS `bulan`,`tbl_notajual`.`tahun` AS `tahun`,`tbl_notajual`.`idpelanggan` AS `idpelanggan`,`tbl_notajual_det`.`nopesan` AS `nopesan`,`tbl_notajual_det`.`idbarang` AS `idbarang`,`tbl_notajual_det`.`norangka` AS `norangka`,`tbl_notajual_det`.`ppnjual` AS `ppnjual`,`tbl_notajual_det`.`hargabeli` AS `hargabeli`,`tbl_notajual_det`.`ppnbeli` AS `ppnbeli`,`tbl_notajual_det`.`jual_plus_ppnbeli` AS `jual_plus_ppnbeli`,`tbl_notajual_det`.`ppnjual_min_ppnbeli` AS `ppnjual_min_ppnbeli`,`tbl_notajual_det`.`jumlah1` AS `jumlah1`,`tbl_notajual_det`.`otrsetelahpajak` AS `otrsetelahpajak`,`tbl_notajual_det`.`bbn` AS `bbn`,`tbl_notajual_det`.`offtheroad` AS `offtheroad`,`tbl_notajual_det`.`matrix1` AS `matrix1`,`tbl_notajual_det`.`matrix2` AS `matrix2`,`tbl_notajual_det`.`matrixpajak` AS `matrixpajak`,`tbl_notajual_det`.`subsidi1` AS `subsidi1`,`tbl_notajual_det`.`subsidi2` AS `subsidi2`,`tbl_notajual_det`.`subsidipajak` AS `subsidipajak`,`tbl_notajual_det`.`ref` AS `ref`,`tbl_notajual_det`.`notelpref` AS `notelpref`,`tbl_notajual_det`.`statuskomisi` AS `statuskomisi`,`tbl_notajual_det`.`jumlah` AS `jumlah`,`tbl_notajual_det`.`statusleasing` AS `statusleasing`,`tbl_notajual_det`.`statusbbn` AS `statusbbn`,`tbl_notajual_det`.`bayarotr` AS `bayarotr`,`tbl_notajual_det`.`tglotr` AS `tglotr`,`tbl_notajual_det`.`statusotr` AS `statusotr`,`tbl_notajual_det`.`gross` AS `gross`,`tbl_notajual_det`.`tglgross` AS `tglgross`,`tbl_notajual_det`.`statusgross` AS `statusgross`,`tbl_notajual_det`.`subsidi` AS `subsidi`,`tbl_notajual_det`.`tglsubsidi` AS `tglsubsidi`,`tbl_notajual_det`.`statussubsidi` AS `statussubsidi`,`tbl_notajual_det`.`matrix` AS `matrix`,`tbl_notajual_det`.`tglmatrix` AS `tglmatrix`,`tbl_notajual_det`.`statusmatrix` AS `statusmatrix`,`tbl_notajual`.`tnkb` AS `tnkb`,`tbl_masterbarang`.`noticehitam` AS `noticehitam`,`tbl_masterbarang`.`noticemerah` AS `noticemerah`,`tbl_notajual`.`jnstransaksi` AS `jnstransaksi`,`tbl_notajual`.`jnscashtempo` AS `jnscashtempo`,`tbl_notajual`.`status` AS `status`,(select `tbl_lainbbn`.`lainbbn` from `tbl_lainbbn` where (`tbl_lainbbn`.`status` = '1')) AS `mis`,(`tbl_notajual_det`.`hargabeli` + `tbl_notajual_det`.`ppnbeli`) AS `C`,((`tbl_notajual_det`.`hargabeli` + `tbl_notajual_det`.`ppnbeli`) + (select `tbl_lainbbn`.`lainbbn` from `tbl_lainbbn` where (`tbl_lainbbn`.`status` = '1'))) AS `D`,if((`tbl_notajual`.`tnkb` = 'PLAT HITAM'),`tbl_masterbarang`.`noticehitam`,`tbl_masterbarang`.`noticemerah`) AS `notice`,(((if((`tbl_notajual`.`tnkb` = 'PLAT HITAM'),`tbl_masterbarang`.`noticehitam`,`tbl_masterbarang`.`noticemerah`) + `tbl_notajual_det`.`hargabeli`) + `tbl_notajual_det`.`ppnbeli`) + (select `tbl_lainbbn`.`lainbbn` from `tbl_lainbbn` where (`tbl_lainbbn`.`status` = '1'))) AS `F`,`tbl_notajual_det`.`otr` AS `otr`,`tbl_notajual_det`.`disc` AS `disc`,`tbl_notajual_det`.`komisi` AS `komisi`,((`tbl_notajual_det`.`otr` - `tbl_notajual_det`.`disc`) - (((if((`tbl_notajual`.`tnkb` = 'PLAT HITAM'),`tbl_masterbarang`.`noticehitam`,`tbl_masterbarang`.`noticemerah`) + `tbl_notajual_det`.`hargabeli`) + `tbl_notajual_det`.`ppnbeli`) + (select `tbl_lainbbn`.`lainbbn` from `tbl_lainbbn` where (`tbl_lainbbn`.`status` = '1')))) AS `G`,`tbl_notajual_det`.`bayargross` AS `bayargross`,`tbl_notajual_det`.`bayarsubsidi` AS `bayarsubsidi`,`tbl_notajual_det`.`bayarmatrix` AS `bayarmatrix` from ((`tbl_notajual_det` join `tbl_masterbarang` on((`tbl_notajual_det`.`idbarang` = `tbl_masterbarang`.`id`))) join `tbl_notajual` on((`tbl_notajual_det`.`nonota` = `tbl_notajual`.`nonota`))) where (((`tbl_notajual`.`jnstransaksi` = 'KREDIT') or ((`tbl_notajual`.`jnstransaksi` = 'CASH TEMPO') and (`tbl_notajual`.`jnscashtempo` = 'LEASING'))) and (`tbl_notajual`.`status` = '1') and (`tbl_notajual_det`.`statusmatrix` = '1')) */;

/*View structure for view tbl_labakredit2_vw */

/*!50001 DROP TABLE IF EXISTS `tbl_labakredit2_vw` */;
/*!50001 DROP VIEW IF EXISTS `tbl_labakredit2_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_labakredit2_vw` AS select `tbl_labakredit1_vw`.`id` AS `id`,`tbl_labakredit1_vw`.`nonota` AS `nonota`,`tbl_labakredit1_vw`.`tglnota` AS `tglnota`,`tbl_labakredit1_vw`.`bulan` AS `bulan`,`tbl_labakredit1_vw`.`tahun` AS `tahun`,`tbl_labakredit1_vw`.`nopesan` AS `nopesan`,`tbl_labakredit1_vw`.`idpelanggan` AS `idpelanggan`,`tbl_labakredit1_vw`.`idbarang` AS `idbarang`,`tbl_labakredit1_vw`.`norangka` AS `norangka`,`tbl_hutitipan`.`jumlah` AS `jumlah`,`tbl_labakredit1_vw`.`tnkb` AS `tnkb`,`tbl_labakredit1_vw`.`C` AS `C`,`tbl_labakredit1_vw`.`D` AS `D`,`tbl_labakredit1_vw`.`notice` AS `notice`,`tbl_labakredit1_vw`.`F` AS `F`,`tbl_labakredit1_vw`.`otr` AS `otr`,`tbl_labakredit1_vw`.`G` AS `G`,`tbl_labakredit1_vw`.`bayargross` AS `bayargross`,`tbl_labakredit1_vw`.`bayarsubsidi` AS `bayarsubsidi`,`tbl_labakredit1_vw`.`bayarmatrix` AS `bayarmatrix`,sum(`tbl_hutitipan`.`jumlah`) AS `UM`,(((`tbl_labakredit1_vw`.`bayargross` - `tbl_labakredit1_vw`.`bayarsubsidi`) - `tbl_labakredit1_vw`.`bayarmatrix`) - sum(`tbl_hutitipan`.`jumlah`)) AS `L`,(`tbl_labakredit1_vw`.`G` - (((`tbl_labakredit1_vw`.`bayargross` - `tbl_labakredit1_vw`.`bayarsubsidi`) - `tbl_labakredit1_vw`.`bayarmatrix`) - sum(`tbl_hutitipan`.`jumlah`))) AS `M` from (`tbl_labakredit1_vw` join `tbl_hutitipan` on((`tbl_labakredit1_vw`.`nopesan` = `tbl_hutitipan`.`nopesan`))) group by `tbl_hutitipan`.`nopesan` */;

/*View structure for view tbl_lembur_vw */

/*!50001 DROP TABLE IF EXISTS `tbl_lembur_vw` */;
/*!50001 DROP VIEW IF EXISTS `tbl_lembur_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_lembur_vw` AS select `tbl_lembur`.`id` AS `id`,`tbl_lembur`.`idkaryawan` AS `idkaryawan`,`tbl_lembur`.`tahun` AS `tahun`,`tbl_lembur`.`bulan` AS `bulan`,`tbl_lembur`.`tanggal` AS `tanggal`,`tbl_karyawan_vw`.`nik` AS `nik`,`tbl_karyawan_vw`.`nama` AS `nama`,`tbl_karyawan_vw`.`ulembur` AS `ulembur`,`tbl_karyawan_vw`.`posisi` AS `posisi` from (`tbl_lembur` join `tbl_karyawan_vw` on((`tbl_lembur`.`idkaryawan` = `tbl_karyawan_vw`.`id`))) */;

/*View structure for view tbl_notabeli_det2_vw */

/*!50001 DROP TABLE IF EXISTS `tbl_notabeli_det2_vw` */;
/*!50001 DROP VIEW IF EXISTS `tbl_notabeli_det2_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_notabeli_det2_vw` AS select `tbl_notabeli_det`.`id` AS `id`,`tbl_notabeli_det`.`nonota` AS `nonota`,`tbl_notabeli_det`.`idbarang` AS `idbarang`,`tbl_notabeli_det`.`norangka` AS `norangka`,`tbl_notabeli_det`.`nomesin` AS `nomesin`,`tbl_notabeli_det`.`hargabelibersih` AS `hargabelibersih`,`tbl_notabeli_det`.`qty` AS `qty`,`tbl_notabeli_det`.`total` AS `total`,`tbl_notabeli_det`.`ppn` AS `ppn`,`tbl_notabeli_det`.`status` AS `status`,`tbl_notabeli_det`.`tgltiba` AS `tgltiba`,`tbl_notabeli_det`.`idgudang` AS `idgudang`,`tbl_masterbarang`.`kodebarang` AS `kodebarang`,`tbl_masterbarang`.`namabarang` AS `namabarang`,`tbl_masterbarang`.`varian` AS `varian`,`tbl_masterbarang`.`warna` AS `warna`,`tbl_masterbarang`.`thnproduksi` AS `thnproduksi`,`tbl_masterbarang`.`satuan` AS `satuan` from (`tbl_notabeli_det` join `tbl_masterbarang` on((`tbl_notabeli_det`.`idbarang` = `tbl_masterbarang`.`id`))) */;

/*View structure for view tbl_notabeli_det3_vw */

/*!50001 DROP TABLE IF EXISTS `tbl_notabeli_det3_vw` */;
/*!50001 DROP VIEW IF EXISTS `tbl_notabeli_det3_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_notabeli_det3_vw` AS select `tbl_notabeli_det`.`id` AS `id`,`tbl_notabeli_det`.`nonota` AS `nonota`,`tbl_notabeli_det`.`idbarang` AS `idbarang`,`tbl_notabeli_det`.`norangka` AS `norangka`,`tbl_notabeli_det`.`nomesin` AS `nomesin`,`tbl_notabeli_det`.`hargabelibersih` AS `hargabelibersih`,`tbl_notabeli_det`.`qty` AS `qty`,`tbl_notabeli_det`.`total` AS `total`,`tbl_notabeli_det`.`status` AS `status`,`tbl_notabeli_det`.`ikesalahan` AS `ikesalahan`,`tbl_notabeli_det`.`tgltiba` AS `tgltiba`,`tbl_notabeli_det`.`idgudang` AS `idgudang`,`tbl_notabeli`.`tahun` AS `tahun`,`tbl_notabeli`.`bulan` AS `bulan`,`tbl_notabeli`.`tglnota` AS `tglnota`,`tbl_notabeli`.`nodo` AS `nodo`,`tbl_notabeli`.`tgldo` AS `tgldo`,`tbl_notabeli`.`nopo` AS `nopo`,`tbl_notabeli`.`tglpo` AS `tglpo`,`tbl_notabeli`.`memo` AS `memo`,`tbl_notabeli`.`qty` AS `qtytotal`,`tbl_notabeli`.`grandtotal` AS `grandtotal`,`tbl_notabeli`.`bayar` AS `bayar`,`tbl_notabeli`.`tglbayar` AS `tglbayar`,`tbl_notabeli`.`scan` AS `scan`,`tbl_masterbarang`.`kodebarang` AS `kodebarang`,`tbl_masterbarang`.`namabarang` AS `namabarang`,`tbl_masterbarang`.`varian` AS `varian`,`tbl_masterbarang`.`warna` AS `warna`,`tbl_masterbarang`.`thnproduksi` AS `thnproduksi`,`tbl_masterbarang`.`satuan` AS `satuan` from ((`tbl_notabeli_det` join `tbl_notabeli` on((`tbl_notabeli_det`.`nonota` = `tbl_notabeli`.`nonota`))) join `tbl_masterbarang` on((`tbl_notabeli_det`.`idbarang` = `tbl_masterbarang`.`id`))) */;

/*View structure for view tbl_notabeli_det_vw */

/*!50001 DROP TABLE IF EXISTS `tbl_notabeli_det_vw` */;
/*!50001 DROP VIEW IF EXISTS `tbl_notabeli_det_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_notabeli_det_vw` AS select `tbl_notabeli_det`.`id` AS `id`,`tbl_notabeli_det`.`nonota` AS `nonota`,`tbl_notabeli_det`.`idbarang` AS `idbarang`,`tbl_notabeli_det`.`norangka` AS `norangka`,`tbl_notabeli_det`.`nomesin` AS `nomesin`,`tbl_notabeli_det`.`hargabelibersih` AS `hargabelibersih`,`tbl_notabeli_det`.`qty` AS `qty`,`tbl_notabeli_det`.`total` AS `total`,`tbl_notabeli_det`.`status` AS `status`,`tbl_notabeli_det`.`ikesalahan` AS `ikesalahan`,`tbl_notabeli_det`.`tgltiba` AS `tgltiba`,`tbl_notabeli_det`.`idgudang` AS `idgudang`,`tbl_notabeli`.`tahun` AS `tahun`,`tbl_notabeli`.`bulan` AS `bulan`,`tbl_notabeli`.`tglnota` AS `tglnota`,`tbl_notabeli`.`nodo` AS `nodo`,`tbl_notabeli`.`tgldo` AS `tgldo`,`tbl_notabeli`.`nopo` AS `nopo`,`tbl_notabeli`.`tglpo` AS `tglpo`,`tbl_notabeli`.`memo` AS `memo`,`tbl_notabeli`.`qty` AS `qtytotal`,`tbl_notabeli`.`grandtotal` AS `grandtotal`,`tbl_notabeli`.`bayar` AS `bayar`,`tbl_notabeli`.`tglbayar` AS `tglbayar`,`tbl_notabeli`.`scan` AS `scan`,`tbl_masterbarang`.`kodebarang` AS `kodebarang`,`tbl_masterbarang`.`namabarang` AS `namabarang`,`tbl_masterbarang`.`varian` AS `varian`,`tbl_masterbarang`.`warna` AS `warna`,`tbl_masterbarang`.`thnproduksi` AS `thnproduksi`,`tbl_masterbarang`.`satuan` AS `satuan`,`tbl_gudang`.`gudang` AS `gudang` from (((`tbl_notabeli_det` join `tbl_notabeli` on((`tbl_notabeli_det`.`nonota` = `tbl_notabeli`.`nonota`))) join `tbl_masterbarang` on((`tbl_notabeli_det`.`idbarang` = `tbl_masterbarang`.`id`))) join `tbl_gudang` on((`tbl_notabeli_det`.`idgudang` = `tbl_gudang`.`id`))) */;

/*View structure for view tbl_notajual_det_pesanan_vw */

/*!50001 DROP TABLE IF EXISTS `tbl_notajual_det_pesanan_vw` */;
/*!50001 DROP VIEW IF EXISTS `tbl_notajual_det_pesanan_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_notajual_det_pesanan_vw` AS select `tbl_notajual_det`.`id` AS `id`,`tbl_notajual_det`.`nonota` AS `nonota`,`tbl_notajual_det`.`nopesan` AS `nopesan`,`tbl_notajual_det`.`idbarang` AS `idbarang`,`tbl_notajual_det`.`norangka` AS `norangka`,`tbl_pesanan`.`idsales` AS `idsales`,`tbl_pesanan`.`idpelanggan` AS `idpelanggan`,`tbl_pesanan`.`jnstransaksi` AS `jnstransaksi`,`tbl_pesanan`.`idleasing` AS `idleasing`,`tbl_masterbarang`.`kodebarang` AS `kodebarang`,`tbl_masterbarang`.`namabarang` AS `namabarang`,`tbl_masterbarang`.`varian` AS `varian`,`tbl_masterbarang`.`warna` AS `warna`,`tbl_notajual`.`nopdi` AS `nopdi`,`tbl_notajual`.`tahun` AS `tahun`,`tbl_notajual`.`bulan` AS `bulan`,`tbl_notajual`.`tglnota` AS `tglnota` from (((`tbl_notajual_det` join `tbl_pesanan` on((`tbl_notajual_det`.`nopesan` = `tbl_pesanan`.`nopesan`))) join `tbl_masterbarang` on((`tbl_notajual_det`.`idbarang` = `tbl_masterbarang`.`id`))) join `tbl_notajual` on((`tbl_notajual_det`.`nonota` = `tbl_notajual`.`nonota`))) */;

/*View structure for view tbl_notajual_det_qty */

/*!50001 DROP TABLE IF EXISTS `tbl_notajual_det_qty` */;
/*!50001 DROP VIEW IF EXISTS `tbl_notajual_det_qty` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_notajual_det_qty` AS select `tbl_cekfisik`.`nonota` AS `nonota`,count(`tbl_cekfisik`.`id`) AS `qty` from `tbl_cekfisik` group by `tbl_cekfisik`.`nonota` */;

/*View structure for view tbl_notajual_det_vw */

/*!50001 DROP TABLE IF EXISTS `tbl_notajual_det_vw` */;
/*!50001 DROP VIEW IF EXISTS `tbl_notajual_det_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_notajual_det_vw` AS select `tbl_notajual_det`.`id` AS `id`,`tbl_notajual_det`.`nonota` AS `nonota`,`tbl_notajual_det`.`nopesan` AS `nopesan`,`tbl_notajual_det`.`idbarang` AS `idbarang`,`tbl_notajual_det`.`norangka` AS `norangka`,`tbl_notajual_det`.`otr` AS `otr`,`tbl_notajual_det`.`disc` AS `disc`,`tbl_notajual_det`.`gross` AS `gross`,`tbl_notajual_det`.`matrix` AS `matrix`,`tbl_notajual_det`.`matrix1` AS `matrix1`,`tbl_notajual_det`.`matrix2` AS `matrix2`,`tbl_notajual_det`.`matrixpajak` AS `matrixpajak`,`tbl_notajual_det`.`subsidi` AS `subsidi`,`tbl_notajual_det`.`subsidi1` AS `subsidi1`,`tbl_notajual_det`.`subsidi2` AS `subsidi2`,`tbl_notajual_det`.`subsidipajak` AS `subsidipajak`,`tbl_notajual_det`.`scpahm` AS `scpahm`,`tbl_notajual_det`.`scpmd` AS `scpmd`,`tbl_notajual_det`.`komisi` AS `komisi`,`tbl_notajual_det`.`ref` AS `ref`,`tbl_notajual_det`.`notelpref` AS `notelpref`,`tbl_notajual_det`.`statuskomisi` AS `statuskomisi`,`tbl_notajual_det`.`tglbayarkomisi` AS `tglbayarkomisi`,`tbl_notajual_det`.`jumlah` AS `jumlah`,`tbl_notajual_det`.`statusleasing` AS `statusleasing`,`tbl_notajual_det`.`statusbbn` AS `statusbbn`,`tbl_notajual_det`.`statusotr` AS `statusotr`,`tbl_notajual_det`.`statusgross` AS `statusgross`,`tbl_notajual_det`.`statussubsidi` AS `statussubsidi`,`tbl_notajual_det`.`statusmatrix` AS `statusmatrix`,`tbl_notajual_det`.`statusscpahm` AS `statusscpahm`,`tbl_notajual_det`.`statusscpmd` AS `statusscpmd`,`tbl_notajual_det`.`statustagihanls` AS `statustagihanls`,`tbl_notajual_det`.`bayarotr` AS `bayarotr`,`tbl_notajual_det`.`bayargross` AS `bayargross`,`tbl_notajual_det`.`bayarsubsidi` AS `bayarsubsidi`,`tbl_notajual_det`.`bayarmatrix` AS `bayarmatrix`,`tbl_notajual_det`.`bayarscpahm` AS `bayarscpahm`,`tbl_notajual_det`.`bayarscpmd` AS `bayarscpmd`,`tbl_notajual_det`.`tglotr` AS `tglotr`,`tbl_notajual_det`.`tglgross` AS `tglgross`,`tbl_notajual_det`.`tglsubsidi` AS `tglsubsidi`,`tbl_notajual_det`.`tglmatrix` AS `tglmatrix`,`tbl_notajual_det`.`tglscpahm` AS `tglscpahm`,`tbl_notajual_det`.`tglscpmd` AS `tglscpmd`,`tbl_notajual_det`.`tgltagihanls` AS `tgltagihanls`,`tbl_notajual_det`.`tglsampai` AS `tglsampai`,`tbl_notajual_det`.`jamsampai` AS `jamsampai`,`tbl_notajual_det`.`tambahlain` AS `tambahlain`,`tbl_notajual_det`.`kuranglain` AS `kuranglain`,`tbl_notajual_det`.`tgltambahlain` AS `tgltambahlain`,`tbl_notajual_det`.`tglkuranglain` AS `tglkuranglain`,`tbl_notajual_det`.`kettambahlain` AS `kettambahlain`,`tbl_notajual_det`.`ketkuranglain` AS `ketkuranglain`,`tbl_notajual_det`.`updatex` AS `updatex`,`tbl_notajual`.`tahun` AS `tahun`,`tbl_notajual`.`bulan` AS `bulan`,`tbl_notajual`.`tglnota` AS `tglnota`,`tbl_notajual`.`iduser` AS `iduser`,`tbl_notajual`.`iduserpdi` AS `iduserpdi`,`tbl_notajual`.`iduseradm` AS `iduseradm`,`tbl_notajual`.`idpelanggan` AS `idpelanggan`,`tbl_notajual`.`jnstransaksi` AS `jnstransaksi`,`tbl_notajual`.`jnscashtempo` AS `jnscashtempo`,`tbl_notajual`.`tglpelunasan` AS `tglpelunasan`,`tbl_notajual`.`idleasing` AS `idleasing`,`tbl_notajual`.`angsuran` AS `angsuran`,`tbl_notajual`.`termin` AS `termin`,`tbl_notajual`.`hargabelibersih` AS `hargabelibersih`,`tbl_notajual`.`totr` AS `totr`,`tbl_notajual`.`tdisc` AS `tdisc`,`tbl_notajual`.`utitipan` AS `utitipan`,`tbl_notajual`.`sisabayar` AS `sisabayar`,`tbl_notajual`.`bayar` AS `bayar`,`tbl_notajual`.`laba` AS `laba`,`tbl_notajual`.`status` AS `status`,`tbl_notajual`.`cekfisik` AS `cekfisik`,`tbl_notajual`.`adm` AS `adm`,`tbl_notajual`.`ketreject` AS `ketreject`,`tbl_pesanan`.`idsales` AS `idsales` from ((`tbl_notajual_det` join `tbl_notajual` on((`tbl_notajual_det`.`nonota` = `tbl_notajual`.`nonota`))) join `tbl_pesanan` on((`tbl_notajual`.`nopesan` = `tbl_pesanan`.`nopesan`))) */;

/*View structure for view tbl_notajual_qty */

/*!50001 DROP TABLE IF EXISTS `tbl_notajual_qty` */;
/*!50001 DROP VIEW IF EXISTS `tbl_notajual_qty` */;

/*!50001 CREATE ALGORITHM=TEMPTABLE DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_notajual_qty` AS select `tbl_notajual`.`id` AS `id`,`tbl_notajual`.`nonota` AS `nonota`,`tbl_notajual`.`nopesan` AS `nopesan`,`tbl_notajual`.`iduser` AS `iduser`,`tbl_notajual`.`iduserpdi` AS `iduserpdi`,`tbl_notajual`.`iduseradm` AS `iduseradm`,`tbl_notajual`.`idpelanggan` AS `idpelanggan`,`tbl_notajual`.`jnstransaksi` AS `jnstransaksi`,`tbl_notajual`.`idleasing` AS `idleasing`,`tbl_notajual`.`termin` AS `termin`,`tbl_notajual`.`tahun` AS `tahun`,`tbl_notajual`.`bulan` AS `bulan`,`tbl_notajual`.`tglnota` AS `tglnota`,`tbl_notajual`.`hargabelibersih` AS `hargabelibersih`,`tbl_notajual`.`utitipan` AS `utitipan`,`tbl_notajual`.`sisabayar` AS `sisabayar`,`tbl_notajual`.`bayar` AS `bayar`,`tbl_notajual`.`laba` AS `laba`,`tbl_notajual`.`status` AS `status`,`tbl_notajual`.`cekfisik` AS `cekfisik`,`tbl_notajual`.`adm` AS `adm`,`tbl_notajual`.`inputx` AS `inputx`,`tbl_notajual`.`updatex` AS `updatex`,`tbl_notajual_det_qty`.`qty` AS `qty` from (`tbl_notajual` join `tbl_notajual_det_qty` on((`tbl_notajual`.`nonota` = `tbl_notajual_det_qty`.`nonota`))) */;

/*View structure for view tbl_notajual_vw */

/*!50001 DROP TABLE IF EXISTS `tbl_notajual_vw` */;
/*!50001 DROP VIEW IF EXISTS `tbl_notajual_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_notajual_vw` AS select `tbl_notajual`.`id` AS `id`,`tbl_notajual`.`nonota` AS `nonota`,`tbl_notajual`.`nopdi` AS `nopdi`,`tbl_notajual`.`nopesan` AS `nopesan`,`tbl_notajual`.`idsales` AS `idsales`,`tbl_notajual`.`iduser` AS `iduser`,`tbl_notajual`.`iduserpdi` AS `iduserpdi`,`tbl_notajual`.`iduseradm` AS `iduseradm`,`tbl_notajual`.`idpelanggan` AS `idpelanggan`,`tbl_notajual`.`jnstransaksi` AS `jnstransaksi`,`tbl_notajual`.`jnscashtempo` AS `jnscashtempo`,`tbl_notajual`.`tglpelunasan` AS `tglpelunasan`,`tbl_notajual`.`idleasing` AS `idleasing`,`tbl_notajual`.`angsuran` AS `angsuran`,`tbl_notajual`.`termin` AS `termin`,`tbl_notajual`.`tahun` AS `tahun`,`tbl_notajual`.`bulan` AS `bulan`,`tbl_notajual`.`tglnota` AS `tglnota`,`tbl_notajual`.`hargabelibersih` AS `hargabelibersih`,`tbl_notajual`.`totr` AS `totr`,`tbl_notajual`.`tdisc` AS `tdisc`,`tbl_notajual`.`utitipan` AS `utitipan`,`tbl_notajual`.`sisabayar` AS `sisabayar`,`tbl_notajual`.`bayar` AS `bayar`,`tbl_notajual`.`laba` AS `laba`,`tbl_notajual`.`status` AS `status`,`tbl_notajual`.`cekfisik` AS `cekfisik`,`tbl_notajual`.`adm` AS `adm`,`tbl_notajual`.`ketreject` AS `ketreject`,`tbl_notajual`.`inputx` AS `inputx`,`tbl_notajual`.`updatex` AS `updatex`,`tbl_pelanggan`.`nama` AS `nama`,`tbl_pelanggan`.`notelepon` AS `notelepon`,`tbl_pelanggan`.`ohc` AS `ohc` from (`tbl_notajual` join `tbl_pelanggan` on((`tbl_notajual`.`idpelanggan` = `tbl_pelanggan`.`id`))) */;

/*View structure for view tbl_opname_det_vw */

/*!50001 DROP TABLE IF EXISTS `tbl_opname_det_vw` */;
/*!50001 DROP VIEW IF EXISTS `tbl_opname_det_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_opname_det_vw` AS select `tbl_opname_det`.`id` AS `id`,`tbl_opname_det`.`idopname` AS `idopname`,`tbl_opname_det`.`norangka` AS `norangka`,`tbl_opname_det`.`keterangan` AS `keterangan`,`tbl_stokunit`.`hargabelibersih` AS `hargabeli`,`tbl_stokunit`.`nomesin` AS `nomesin`,`tbl_masterbarang`.`kodebarang` AS `kodebarang`,`tbl_masterbarang`.`namabarang` AS `namabarang`,`tbl_masterbarang`.`varian` AS `varian`,`tbl_masterbarang`.`warna` AS `warna`,`tbl_masterbarang`.`thnproduksi` AS `thnproduksi` from ((`tbl_opname_det` join `tbl_stokunit` on((`tbl_opname_det`.`norangka` = `tbl_stokunit`.`norangka`))) join `tbl_masterbarang` on((`tbl_stokunit`.`idbarang` = `tbl_masterbarang`.`id`))) */;

/*View structure for view tbl_opname_vw */

/*!50001 DROP TABLE IF EXISTS `tbl_opname_vw` */;
/*!50001 DROP VIEW IF EXISTS `tbl_opname_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_opname_vw` AS select `tbl_opname`.`id` AS `id`,`tbl_opname`.`tahun` AS `tahun`,`tbl_opname`.`bulan` AS `bulan`,`tbl_opname`.`tanggal` AS `tanggal`,`tbl_opname`.`idgudang` AS `idgudang`,`tbl_gudang`.`gudang` AS `gudang`,`tbl_opname`.`stok` AS `stok`,`tbl_opname`.`scan` AS `scan`,`tbl_opname`.`sisa` AS `sisa`,`tbl_opname`.`totjumselisih` AS `totjumselisih`,`tbl_opname`.`status` AS `status`,`tbl_opname`.`iduser` AS `iduser`,`tbl_user_vw`.`nama` AS `nama`,`tbl_opname`.`user` AS `user`,`tbl_opname`.`inputx` AS `inputx` from ((`tbl_opname` join `tbl_user_vw` on((`tbl_opname`.`iduser` = `tbl_user_vw`.`id`))) join `tbl_gudang` on((`tbl_opname`.`idgudang` = `tbl_gudang`.`id`))) */;

/*View structure for view tbl_pelanganpotensial */

/*!50001 DROP TABLE IF EXISTS `tbl_pelanganpotensial` */;
/*!50001 DROP VIEW IF EXISTS `tbl_pelanganpotensial` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_pelanganpotensial` AS select `tbl_notajual_det_vw`.`id` AS `id`,`tbl_notajual_det_vw`.`nonota` AS `nonota`,`tbl_notajual_det_vw`.`nopesan` AS `nopesan`,`tbl_notajual_det_vw`.`tglnota` AS `tglnota`,`tbl_notajual_det_vw`.`idpelanggan` AS `idpelanggan`,`tbl_pelanggan`.`nama` AS `nama`,`tbl_pelanggan`.`notelepon` AS `notelepon`,`tbl_pelanggan`.`ohc` AS `ohc`,`tbl_pelanggan`.`kadaluarsaohc` AS `kadaluarsaohc`,`tbl_pelanggan`.`noktp` AS `noktp`,`tbl_pelanggan`.`alamat` AS `alamat`,`tbl_pelanggan`.`rt` AS `rt`,`tbl_pelanggan`.`rw` AS `rw`,`tbl_pelanggan`.`kodekab` AS `kodekab`,`tbl_pelanggan`.`namakab` AS `namakab`,`tbl_pelanggan`.`kodekec` AS `kodekec`,`tbl_pelanggan`.`namakec` AS `namakec`,`tbl_pelanggan`.`kodekel` AS `kodekel`,`tbl_pelanggan`.`namakel` AS `namakel`,`tbl_pelanggan`.`kodealamat` AS `kodealamat`,`tbl_pelanggan`.`email` AS `email`,`tbl_pelanggan`.`pekerjaan` AS `pekerjaan`,`tbl_pelanggan`.`grup` AS `grup`,`tbl_notajual_det_vw`.`idbarang` AS `idbarang` from (`tbl_notajual_det_vw` join `tbl_pelanggan` on((`tbl_notajual_det_vw`.`idpelanggan` = `tbl_pelanggan`.`id`))) where (`tbl_notajual_det_vw`.`tglsampai` <> '0000-00-00') */;

/*View structure for view tbl_pengeluaranunit_vw */

/*!50001 DROP TABLE IF EXISTS `tbl_pengeluaranunit_vw` */;
/*!50001 DROP VIEW IF EXISTS `tbl_pengeluaranunit_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_pengeluaranunit_vw` AS select `tbl_pengeluaranunit`.`id` AS `id`,`tbl_pengeluaranunit`.`tahun` AS `tahun`,`tbl_pengeluaranunit`.`bulan` AS `bulan`,`tbl_pengeluaranunit`.`tanggal` AS `tanggal`,`tbl_pengeluaranunit`.`nonota` AS `nonota`,`tbl_user_vw`.`nama` AS `nama`,curdate() AS `tglsampai`,`tbl_notajual_det`.`tglsampai` AS `tglsampai2`,`tbl_notajual_det`.`jamsampai` AS `jamsampai`,`tbl_notajual_det`.`ikesalahan` AS `ikesalahan`,`tbl_notajual_det`.`norangka` AS `norangka` from ((`tbl_pengeluaranunit` join `tbl_user_vw` on((`tbl_pengeluaranunit`.`user` = `tbl_user_vw`.`id`))) join `tbl_notajual_det` on((`tbl_pengeluaranunit`.`nonota` = `tbl_notajual_det`.`nonota`))) */;

/*View structure for view tbl_pesanan_det_vw */

/*!50001 DROP TABLE IF EXISTS `tbl_pesanan_det_vw` */;
/*!50001 DROP VIEW IF EXISTS `tbl_pesanan_det_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_pesanan_det_vw` AS select `tbl_pesanan_det`.`id` AS `id`,`tbl_pesanan_det`.`nopesan` AS `nopesan`,`tbl_pesanan_det`.`idpelanggan` AS `idpelanggan`,`tbl_pesanan_det`.`idbarang` AS `idbarang`,`tbl_pesanan_det`.`norangka` AS `norangka`,`tbl_pesanan_det`.`otr` AS `otr`,`tbl_pesanan_det`.`disc` AS `disc`,`tbl_masterbarang`.`kodebarang` AS `kodebarang`,`tbl_masterbarang`.`namabarang` AS `namabarang`,`tbl_masterbarang`.`varian` AS `varian`,`tbl_masterbarang`.`warna` AS `warna`,`tbl_masterbarang`.`thnproduksi` AS `thnproduksi`,`tbl_masterbarang`.`satuan` AS `satuan`,`tbl_masterbarang`.`literawal` AS `literawal` from (`tbl_pesanan_det` join `tbl_masterbarang` on((`tbl_pesanan_det`.`idbarang` = `tbl_masterbarang`.`id`))) */;

/*View structure for view tbl_pesanan_vw */

/*!50001 DROP TABLE IF EXISTS `tbl_pesanan_vw` */;
/*!50001 DROP VIEW IF EXISTS `tbl_pesanan_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_pesanan_vw` AS select `tbl_pesanan_det`.`id` AS `id`,`tbl_pesanan_det`.`nopesan` AS `nopesan`,`tbl_pesanan_det`.`idpelanggan` AS `idpelanggan`,`tbl_pesanan_det`.`idbarang` AS `idbarang`,`tbl_pesanan_det`.`norangka` AS `norangka`,`tbl_pesanan`.`tahun` AS `tahun`,`tbl_pesanan`.`bulan` AS `bulan`,`tbl_pesanan`.`tglpesan` AS `tglpesan`,`tbl_pesanan`.`idsales` AS `idsales`,`tbl_pesanan`.`jnstransaksi` AS `jnstransaksi`,`tbl_pesanan`.`jnscashtempo` AS `jnscashtempo`,`tbl_pesanan`.`tnkb` AS `tnkb`,`tbl_pesanan`.`tglpelunasan` AS `tglpelunasan`,`tbl_pesanan`.`idleasing` AS `idleasing`,`tbl_pesanan`.`termin` AS `termin`,`tbl_pesanan`.`utitipan` AS `utitipan`,`tbl_pesanan`.`status` AS `status`,`tbl_pesanan`.`indent` AS `indent`,`tbl_pesanan`.`batal` AS `batal`,`tbl_pesanan`.`inputx` AS `inputx`,`tbl_pesanan`.`updatex` AS `updatex`,`tbl_pelanggan`.`nama` AS `nama`,`tbl_pelanggan`.`ohc` AS `ohc`,`tbl_pelanggan`.`kadaluarsaohc` AS `kadaluarsaohc`,`tbl_pelanggan`.`notelepon` AS `notelepon`,`tbl_pelanggan`.`noktp` AS `noktp`,`tbl_pelanggan`.`alamat` AS `alamat`,`tbl_pelanggan`.`rt` AS `rt`,`tbl_pelanggan`.`rw` AS `rw`,`tbl_pelanggan`.`kodekab` AS `kodekab`,`tbl_pelanggan`.`namakab` AS `namakab`,`tbl_pelanggan`.`kodekec` AS `kodekec`,`tbl_pelanggan`.`namakec` AS `namakec`,`tbl_pelanggan`.`kodekel` AS `kodekel`,`tbl_pelanggan`.`namakel` AS `namakel`,`tbl_pelanggan`.`kodealamat` AS `kodealamat`,`tbl_pelanggan`.`email` AS `email`,`tbl_pelanggan`.`pekerjaan` AS `pekerjaan`,`tbl_masterbarang`.`kodebarang` AS `kodebarang`,`tbl_masterbarang`.`namabarang` AS `namabarang`,`tbl_masterbarang`.`varian` AS `varian`,`tbl_masterbarang`.`warna` AS `warna`,`tbl_masterbarang`.`thnproduksi` AS `thnproduksi`,`tbl_masterbarang`.`satuan` AS `satuan`,`tbl_user_vw`.`nama` AS `namasales` from ((((`tbl_pesanan_det` join `tbl_pesanan` on((`tbl_pesanan_det`.`nopesan` = `tbl_pesanan`.`nopesan`))) join `tbl_masterbarang` on((`tbl_pesanan_det`.`idbarang` = `tbl_masterbarang`.`id`))) join `tbl_pelanggan` on((`tbl_pesanan_det`.`idpelanggan` = `tbl_pelanggan`.`id`))) join `tbl_user_vw` on((`tbl_user_vw`.`id` = `tbl_pesanan`.`idsales`))) */;

/*View structure for view tbl_pindah_det_vw */

/*!50001 DROP TABLE IF EXISTS `tbl_pindah_det_vw` */;
/*!50001 DROP VIEW IF EXISTS `tbl_pindah_det_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_pindah_det_vw` AS select `tbl_pindah_det`.`id` AS `id`,`tbl_pindah_det`.`idpindah` AS `idpindah`,`tbl_pindah_det`.`norangka` AS `norangka`,`tbl_pindah`.`tahun` AS `tahun`,`tbl_pindah`.`bulan` AS `bulan`,`tbl_pindah`.`tanggal` AS `tanggal`,`tbl_pindah`.`idgudang1` AS `idgudang1`,`tbl_pindah`.`idgudang2` AS `idgudang2`,`tbl_pindah`.`status` AS `status`,`tbl_pindah`.`iduser` AS `iduser`,`tbl_pindah`.`user` AS `user`,`tbl_pindah`.`inputx` AS `inputx` from (`tbl_pindah_det` join `tbl_pindah` on((`tbl_pindah_det`.`idpindah` = `tbl_pindah`.`id`))) */;

/*View structure for view tbl_pindah_vw */

/*!50001 DROP TABLE IF EXISTS `tbl_pindah_vw` */;
/*!50001 DROP VIEW IF EXISTS `tbl_pindah_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_pindah_vw` AS select `tbl_pindah`.`id` AS `id`,`tbl_pindah`.`tahun` AS `tahun`,`tbl_pindah`.`bulan` AS `bulan`,`tbl_pindah`.`tanggal` AS `tanggal`,`tbl_pindah`.`idgudang1` AS `idgudang1`,`tbl_gudang`.`gudang` AS `gudang1`,`tbl_pindah`.`idgudang2` AS `idgudang2`,`tbl_gudang_1`.`gudang` AS `gudang2`,`tbl_user_vw`.`nama` AS `nama`,`tbl_pindah`.`user` AS `user`,`tbl_pindah`.`status` AS `status`,`tbl_pindah`.`inputx` AS `inputx` from (((`tbl_pindah` join `tbl_user_vw` on((`tbl_pindah`.`iduser` = `tbl_user_vw`.`id`))) join `tbl_gudang` on((`tbl_pindah`.`idgudang1` = `tbl_gudang`.`id`))) join `tbl_gudang` `tbl_gudang_1` on((`tbl_pindah`.`idgudang2` = `tbl_gudang_1`.`id`))) */;

/*View structure for view tbl_piutang_vw */

/*!50001 DROP TABLE IF EXISTS `tbl_piutang_vw` */;
/*!50001 DROP VIEW IF EXISTS `tbl_piutang_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_piutang_vw` AS select `tbl_piutang`.`id` AS `id`,`tbl_piutang`.`jenis` AS `jenis`,`tbl_piutang`.`idkaryawan` AS `idkaryawan`,`tbl_piutang`.`nama` AS `nama`,`tbl_piutang`.`tgl` AS `tgl`,`tbl_piutang`.`jumlah` AS `jumlah`,`tbl_piutang`.`ket` AS `ket`,`tbl_piutang`.`metodebayar` AS `metodebayar`,`tbl_piutang`.`status` AS `status`,`tbl_piutang`.`iduser` AS `iduser`,`tbl_user_vw`.`nama` AS `namapic`,`tbl_piutang`.`inputx` AS `inputx`,`tbl_piutang`.`updatex` AS `updatex` from (`tbl_piutang` join `tbl_user_vw` on((`tbl_piutang`.`iduser` = `tbl_user_vw`.`id`))) */;

/*View structure for view tbl_potkompensasi_vw */

/*!50001 DROP TABLE IF EXISTS `tbl_potkompensasi_vw` */;
/*!50001 DROP VIEW IF EXISTS `tbl_potkompensasi_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_potkompensasi_vw` AS select `tbl_potkompensasi`.`id` AS `id`,`tbl_potkompensasi`.`idkaryawan` AS `idkaryawan`,`tbl_potkompensasi`.`nama` AS `nama`,`tbl_potkompensasi`.`tgl` AS `tgl`,`tbl_potkompensasi`.`jumlah` AS `jumlah`,`tbl_potkompensasi`.`ket` AS `ket`,`tbl_potkompensasi`.`metodebayar` AS `metodebayar`,`tbl_potkompensasi`.`iduser` AS `iduser`,`tbl_potkompensasi`.`status` AS `status`,`tbl_potkompensasi`.`potkompensasi` AS `potkompensasi`,`tbl_potkompensasi`.`inputx` AS `inputx`,`tbl_potkompensasi`.`updatex` AS `updatex`,`tbl_user_vw`.`nama` AS `namapic` from (`tbl_potkompensasi` join `tbl_user_vw` on((`tbl_potkompensasi`.`iduser` = `tbl_user_vw`.`id`))) */;

/*View structure for view tbl_stok_global_vw */

/*!50001 DROP TABLE IF EXISTS `tbl_stok_global_vw` */;
/*!50001 DROP VIEW IF EXISTS `tbl_stok_global_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_stok_global_vw` AS select `tbl_stokunit`.`idbarang` AS `idbarang`,count(`tbl_stokunit`.`id`) AS `stok` from `tbl_stokunit` where (`tbl_stokunit`.`status` = 'STOK') group by `tbl_stokunit`.`idbarang` */;

/*View structure for view tbl_stokunit_vw */

/*!50001 DROP TABLE IF EXISTS `tbl_stokunit_vw` */;
/*!50001 DROP VIEW IF EXISTS `tbl_stokunit_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_stokunit_vw` AS select `tbl_stokunit`.`id` AS `id`,`tbl_stokunit`.`tahun` AS `tahun`,`tbl_stokunit`.`bulan` AS `bulan`,`tbl_stokunit`.`tgltiba` AS `tgltiba`,`tbl_stokunit`.`idgudang` AS `idgudang`,`tbl_stokunit`.`nonota` AS `nonota`,`tbl_stokunit`.`idbarang` AS `idbarang`,`tbl_stokunit`.`norangka` AS `norangka`,`tbl_stokunit`.`nomesin` AS `nomesin`,`tbl_stokunit`.`hargabelibersih` AS `hargabelibersih`,`tbl_stokunit`.`ppn` AS `ppn`,`tbl_stokunit`.`status` AS `status`,`tbl_stokunit`.`inputx` AS `inputx`,`tbl_stokunit`.`updatex` AS `updatex`,`tbl_masterbarang`.`kodebarang` AS `kodebarang`,`tbl_masterbarang`.`namabarang` AS `namabarang`,`tbl_masterbarang`.`varian` AS `varian`,`tbl_masterbarang`.`warna` AS `warna`,`tbl_masterbarang`.`thnproduksi` AS `thnproduksi`,`tbl_masterbarang`.`satuan` AS `satuan`,`tbl_user_vw`.`nama` AS `nama`,`tbl_gudang`.`gudang` AS `gudang` from (((`tbl_stokunit` join `tbl_masterbarang` on((`tbl_stokunit`.`idbarang` = `tbl_masterbarang`.`id`))) join `tbl_gudang` on((`tbl_stokunit`.`idgudang` = `tbl_gudang`.`id`))) join `tbl_user_vw` on((`tbl_stokunit`.`iduser` = `tbl_user_vw`.`id`))) */;

/*View structure for view tbl_user_vw */

/*!50001 DROP TABLE IF EXISTS `tbl_user_vw` */;
/*!50001 DROP VIEW IF EXISTS `tbl_user_vw` */;

/*!50001 CREATE ALGORITHM=TEMPTABLE DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_user_vw` AS select `tbl_user`.`id` AS `id`,`tbl_user`.`id_karyawan` AS `id_karyawan`,`tbl_user`.`user` AS `user`,`tbl_user`.`pass` AS `pass`,`tbl_user`.`hakakses` AS `hakakses`,`tbl_karyawan_vw`.`nama` AS `nama`,`tbl_karyawan_vw`.`status` AS `status`,`tbl_karyawan_vw`.`nik` AS `nik`,`tbl_karyawan_vw`.`id_posisi` AS `id_posisi`,`tbl_karyawan_vw`.`posisi` AS `posisi` from (`tbl_user` join `tbl_karyawan_vw` on((`tbl_user`.`id_karyawan` = `tbl_karyawan_vw`.`id`))) */;

/*View structure for view temp_x23_opname_det_vw */

/*!50001 DROP TABLE IF EXISTS `temp_x23_opname_det_vw` */;
/*!50001 DROP VIEW IF EXISTS `temp_x23_opname_det_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `temp_x23_opname_det_vw` AS select `temp_x23_opname_det`.`id` AS `id`,`temp_x23_opname_det`.`idstok` AS `idstok`,`temp_x23_opname_det`.`idopname` AS `idopname`,`temp_x23_opname_det`.`idgudang` AS `idgudang`,`x23_gudang`.`gudang` AS `gudang`,`temp_x23_opname_det`.`rak` AS `rak`,`temp_x23_opname_det`.`nonota` AS `nonota`,`temp_x23_opname_det`.`tglnota` AS `tglnota`,`temp_x23_opname_det`.`idbarang` AS `idbarang`,`x23_masterbarang`.`kodebarang` AS `kodebarang`,`x23_masterbarang`.`namabarang` AS `namabarang`,`x23_masterbarang`.`varian` AS `varian`,`temp_x23_opname_det`.`stok` AS `stok`,`temp_x23_opname_det`.`opname` AS `opname`,`temp_x23_opname_det`.`hargabeli` AS `hargabeli`,`temp_x23_opname_det`.`selisih` AS `selisih`,`temp_x23_opname_det`.`totalselisih` AS `totalselisih` from ((`temp_x23_opname_det` join `x23_masterbarang` on((`temp_x23_opname_det`.`idbarang` = `x23_masterbarang`.`id`))) join `x23_gudang` on((`temp_x23_opname_det`.`idgudang` = `x23_gudang`.`id`))) */;

/*View structure for view x23_indent_det_vw */

/*!50001 DROP TABLE IF EXISTS `x23_indent_det_vw` */;
/*!50001 DROP VIEW IF EXISTS `x23_indent_det_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_indent_det_vw` AS select `x23_indent_det`.`id` AS `id`,`x23_indent_det`.`noindent` AS `noindent`,`x23_indent_det`.`tahun` AS `tahun`,`x23_indent_det`.`bulan` AS `bulan`,`x23_indent_det`.`tglindent` AS `tglindent`,`x23_indent_det`.`idbarang` AS `idbarang`,`x23_indent_det`.`qty` AS `qty`,`x23_indent`.`status` AS `status`,`x23_masterbarang`.`kodebarang` AS `kodebarang`,`x23_masterbarang`.`namabarang` AS `namabarang`,`x23_masterbarang`.`varian` AS `varian`,`x23_masterbarang`.`satuan` AS `satuan`,`x23_masterbarang`.`idsupplier` AS `idsupplier` from ((`x23_indent_det` join `x23_masterbarang` on((`x23_indent_det`.`idbarang` = `x23_masterbarang`.`id`))) join `x23_indent` on((`x23_indent`.`noindent` = `x23_indent_det`.`noindent`))) */;

/*View structure for view x23_indent_vw */

/*!50001 DROP TABLE IF EXISTS `x23_indent_vw` */;
/*!50001 DROP VIEW IF EXISTS `x23_indent_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_indent_vw` AS select `x23_indent`.`id` AS `id`,`x23_indent`.`noindent` AS `noindent`,`x23_indent`.`notajual` AS `notajual`,`x23_indent`.`idpelanggan` AS `idpelanggan`,`x23_indent`.`tahun` AS `tahun`,`x23_indent`.`bulan` AS `bulan`,`x23_indent`.`tglindent` AS `tglindent`,`x23_indent`.`totalqty` AS `totalqty`,`x23_indent`.`status` AS `status`,`x23_indent`.`iduser` AS `iduser`,`x23_indent`.`inputx` AS `inputx`,`x23_indent`.`updatex` AS `updatex`,`tbl_pelanggan`.`nama` AS `nama`,`tbl_pelanggan`.`ohc` AS `ohc`,`tbl_pelanggan`.`kadaluarsaohc` AS `kadaluarsaohc`,`tbl_pelanggan`.`notelepon` AS `notelepon`,`tbl_pelanggan`.`noktp` AS `noktp`,`tbl_pelanggan`.`alamat` AS `alamat`,`tbl_pelanggan`.`rt` AS `rt`,`tbl_pelanggan`.`rw` AS `rw`,`tbl_pelanggan`.`kodekab` AS `kodekab`,`tbl_pelanggan`.`namakab` AS `namakab`,`tbl_pelanggan`.`kodekec` AS `kodekec`,`tbl_pelanggan`.`namakec` AS `namakec`,`tbl_pelanggan`.`kodekel` AS `kodekel`,`tbl_pelanggan`.`namakel` AS `namakel`,`tbl_pelanggan`.`kodealamat` AS `kodealamat`,`tbl_pelanggan`.`email` AS `email`,`tbl_pelanggan`.`pekerjaan` AS `pekerjaan` from (`x23_indent` join `tbl_pelanggan` on((`x23_indent`.`idpelanggan` = `tbl_pelanggan`.`id`))) */;

/*View structure for view x23_insentif_karyawan_vw */

/*!50001 DROP TABLE IF EXISTS `x23_insentif_karyawan_vw` */;
/*!50001 DROP VIEW IF EXISTS `x23_insentif_karyawan_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_insentif_karyawan_vw` AS select `x23_insentif_karyawan`.`id` AS `id`,`x23_insentif_karyawan`.`id_karyawan` AS `id_karyawan`,`x23_insentif_karyawan`.`target` AS `target`,`x23_insentif_karyawan`.`cash` AS `cash`,`x23_insentif_karyawan`.`kredit` AS `kredit`,`x23_insentif_karyawan`.`flat` AS `flat`,`tbl_karyawan_vw`.`nama` AS `nama`,`tbl_karyawan_vw`.`posisi` AS `posisi`,`tbl_karyawan_vw`.`id_posisi` AS `id_posisi` from (`x23_insentif_karyawan` join `tbl_karyawan_vw` on((`x23_insentif_karyawan`.`id_karyawan` = `tbl_karyawan_vw`.`id`))) */;

/*View structure for view x23_karyawan_vw */

/*!50001 DROP TABLE IF EXISTS `x23_karyawan_vw` */;
/*!50001 DROP VIEW IF EXISTS `x23_karyawan_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_karyawan_vw` AS select `x23_karyawan`.`id` AS `id`,`x23_karyawan`.`nik` AS `nik`,`x23_karyawan`.`nama` AS `nama`,`x23_karyawan`.`tmplahir` AS `tmplahir`,`x23_karyawan`.`tgllahir` AS `tgllahir`,`x23_karyawan`.`noktp` AS `noktp`,`x23_karyawan`.`notelepon` AS `notelepon`,`x23_karyawan`.`alamat` AS `alamat`,`x23_karyawan`.`tglmulaikerja` AS `tglmulaikerja`,`x23_karyawan`.`ugapok` AS `ugapok`,`x23_karyawan`.`uharian` AS `uharian`,`x23_karyawan`.`ukomisi` AS `ukomisi`,`x23_karyawan`.`ulembur` AS `ulembur`,`x23_karyawan`.`pangkat` AS `pangkat`,`x23_karyawan`.`photo` AS `photo`,`x23_karyawan`.`status` AS `status`,`x23_posisi`.`posisi` AS `posisi`,`x23_posisi`.`id` AS `id_posisi`,(substr(curdate(),1,4) - substr(`x23_karyawan`.`tgllahir`,1,4)) AS `usia` from (`x23_karyawan` join `x23_posisi` on((`x23_karyawan`.`posisi` = `x23_posisi`.`id`))) */;

/*View structure for view x23_kelompokjasa_det_vw */

/*!50001 DROP TABLE IF EXISTS `x23_kelompokjasa_det_vw` */;
/*!50001 DROP VIEW IF EXISTS `x23_kelompokjasa_det_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_kelompokjasa_det_vw` AS select `x23_kelompokjasa_det`.`id` AS `id`,`x23_kelompokjasa_det`.`kode` AS `kode`,`x23_kelompokjasa_det`.`idtarifjasa` AS `idtarifjasa`,`x23_tarifjasa_vw`.`idjasa` AS `idjasa`,`x23_tarifjasa_vw`.`pangkat` AS `pangkat`,`x23_tarifjasa_vw`.`tarif` AS `tarif`,`x23_tarifjasa_vw`.`kodejasa` AS `kodejasa`,`x23_tarifjasa_vw`.`namajasa` AS `namajasa` from (`x23_kelompokjasa_det` join `x23_tarifjasa_vw` on((`x23_kelompokjasa_det`.`idtarifjasa` = `x23_tarifjasa_vw`.`id`))) */;

/*View structure for view x23_kelompokjasa_oli_vw */

/*!50001 DROP TABLE IF EXISTS `x23_kelompokjasa_oli_vw` */;
/*!50001 DROP VIEW IF EXISTS `x23_kelompokjasa_oli_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_kelompokjasa_oli_vw` AS select `x23_kelompokjasa_oli`.`id` AS `id`,`x23_kelompokjasa_oli`.`kode` AS `kode`,`x23_kelompokjasa_oli`.`idoli` AS `idoli`,`x23_masterbarang`.`kodebarang` AS `kodebarang`,`x23_masterbarang`.`namabarang` AS `namabarang`,`x23_masterbarang`.`varian` AS `varian` from (`x23_kelompokjasa_oli` join `x23_masterbarang` on((`x23_kelompokjasa_oli`.`idoli` = `x23_masterbarang`.`id`))) */;

/*View structure for view x23_kwitansi_piutang_vw */

/*!50001 DROP TABLE IF EXISTS `x23_kwitansi_piutang_vw` */;
/*!50001 DROP VIEW IF EXISTS `x23_kwitansi_piutang_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_kwitansi_piutang_vw` AS select `x23_kwitansi`.`id` AS `id`,`x23_kwitansi`.`jnskwitansi` AS `jnskwitansi`,`x23_kwitansi`.`nokwitansi` AS `nokwitansi`,`x23_kwitansi`.`tahun` AS `tahun`,`x23_kwitansi`.`bulan` AS `bulan`,`x23_kwitansi`.`tanggal` AS `tanggal`,`x23_kwitansi`.`nomor` AS `nomor`,`x23_kwitansi`.`idpotkom` AS `idpotkom`,`x23_kwitansi`.`noindent` AS `noindent`,`x23_kwitansi`.`idpelanggan` AS `idpelanggan`,`x23_kwitansi`.`noantrian` AS `noantrian`,`x23_kwitansi`.`nopol` AS `nopol`,`x23_kwitansi`.`waktuselesai` AS `waktuselesai`,`x23_kwitansi`.`jumlah` AS `jumlah`,`x23_kwitansi`.`jumlahho` AS `jumlahho`,`x23_kwitansi`.`pembulatan` AS `pembulatan`,`x23_kwitansi`.`user` AS `user`,`x23_kwitansi`.`keterangan` AS `keterangan`,`x23_kwitansi`.`tambahdp` AS `tambahdp`,`x23_kwitansi`.`status` AS `status`,`x23_kwitansi`.`inputx` AS `inputx`,`x23_kwitansi`.`updatex` AS `updatex`,if((`x23_piutang`.`status` = '0'),'belum cetak','sudah cetak') AS `ket`,`x23_karyawan`.`nama` AS `nama` from ((`x23_kwitansi` join `x23_karyawan` on((`x23_kwitansi`.`idpelanggan` = `x23_karyawan`.`id`))) join `x23_piutang` on((`x23_piutang`.`id` = `x23_kwitansi`.`nomor`))) where (`x23_kwitansi`.`jnskwitansi` in ('piutang','tunai')) */;

/*View structure for view x23_kwitansi_tunai_vw */

/*!50001 DROP TABLE IF EXISTS `x23_kwitansi_tunai_vw` */;
/*!50001 DROP VIEW IF EXISTS `x23_kwitansi_tunai_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_kwitansi_tunai_vw` AS select `x23_kwitansi`.`id` AS `id`,`x23_kwitansi`.`jnskwitansi` AS `jnskwitansi`,`x23_kwitansi`.`nokwitansi` AS `nokwitansi`,`x23_kwitansi`.`tahun` AS `tahun`,`x23_kwitansi`.`bulan` AS `bulan`,`x23_kwitansi`.`tanggal` AS `tanggal`,`x23_kwitansi`.`nomor` AS `nomor`,`x23_kwitansi`.`idpelanggan` AS `idpelanggan`,`x23_kwitansi`.`jumlah` AS `jumlah`,`x23_kwitansi`.`status` AS `status`,`x23_kwitansi`.`cetak` AS `cetak`,if((`x23_kwitansi`.`cetak` = '0'),'belum cetak','sudah cetak') AS `ket`,`x23_karyawan`.`nama` AS `nama` from (`x23_kwitansi` join `x23_karyawan` on((`x23_kwitansi`.`idpelanggan` = `x23_karyawan`.`id`))) */;

/*View structure for view x23_kwitansi_vw */

/*!50001 DROP TABLE IF EXISTS `x23_kwitansi_vw` */;
/*!50001 DROP VIEW IF EXISTS `x23_kwitansi_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_kwitansi_vw` AS select `x23_kwitansi`.`id` AS `id`,`x23_kwitansi`.`jnskwitansi` AS `jnskwitansi`,`x23_kwitansi`.`nokwitansi` AS `nokwitansi`,`x23_kwitansi`.`tahun` AS `tahun`,`x23_kwitansi`.`bulan` AS `bulan`,`x23_kwitansi`.`tanggal` AS `tanggal`,`x23_kwitansi`.`waktuselesai` AS `waktuselesai`,`x23_kwitansi`.`nomor` AS `nomor`,`x23_kwitansi`.`noindent` AS `noindent`,`x23_kwitansi`.`idpelanggan` AS `idpelanggan`,`x23_kwitansi`.`noantrian` AS `noantrian`,`x23_kwitansi`.`nopol` AS `nopol`,`x23_kwitansi`.`jumlah` AS `jumlah`,`x23_kwitansi`.`jumlahho` AS `jumlahho`,`x23_kwitansi`.`pembulatan` AS `pembulatan`,`x23_kwitansi`.`user` AS `user`,`x23_kwitansi`.`keterangan` AS `keterangan`,`x23_kwitansi`.`status` AS `status`,`x23_kwitansi`.`inputx` AS `inputx`,`x23_kwitansi`.`tambahdp` AS `tambahdp`,`x23_kwitansi`.`updatex` AS `updatex`,`tbl_pelanggan`.`nama` AS `nama`,`tbl_pelanggan`.`ohc` AS `ohc`,if((`x23_kwitansi`.`status` = '0'),'belum cetak','sudah cetak') AS `ket` from (`x23_kwitansi` join `tbl_pelanggan` on((`x23_kwitansi`.`idpelanggan` = `tbl_pelanggan`.`id`))) */;

/*View structure for view x23_kwitansikpb_vw */

/*!50001 DROP TABLE IF EXISTS `x23_kwitansikpb_vw` */;
/*!50001 DROP VIEW IF EXISTS `x23_kwitansikpb_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_kwitansikpb_vw` AS select `x23_kwitansikpb`.`id` AS `id`,`x23_kwitansikpb`.`nokwitansi` AS `nokwitansi`,`x23_kwitansikpb`.`tglkpb` AS `tglkpb`,`x23_kwitansikpb`.`nopkb` AS `nopkb`,`x23_kwitansikpb`.`nonotaservis` AS `nonotaservis`,`x23_kwitansikpb`.`kodepaket` AS `kodepaket`,`x23_kelompokjasa`.`kpbke` AS `kpbke`,`x23_kwitansikpb`.`tglpenagihan` AS `tglpenagihan`,`x23_kwitansikpb`.`jumlahtagih` AS `jumlahtagih`,`x23_kwitansikpb`.`jumlahtagih2` AS `jumlahtagih2` from (`x23_kelompokjasa` join `x23_kwitansikpb` on((`x23_kelompokjasa`.`kode` = `x23_kwitansikpb`.`kodepaket`))) */;

/*View structure for view x23_lembur_vw */

/*!50001 DROP TABLE IF EXISTS `x23_lembur_vw` */;
/*!50001 DROP VIEW IF EXISTS `x23_lembur_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_lembur_vw` AS select `x23_lembur`.`id` AS `id`,`x23_lembur`.`idkaryawan` AS `idkaryawan`,`x23_lembur`.`tahun` AS `tahun`,`x23_lembur`.`bulan` AS `bulan`,`x23_lembur`.`tanggal` AS `tanggal`,`x23_karyawan_vw`.`nik` AS `nik`,`x23_karyawan_vw`.`nama` AS `nama`,`x23_karyawan_vw`.`noktp` AS `noktp`,`x23_karyawan_vw`.`ulembur` AS `ulembur`,`x23_karyawan_vw`.`posisi` AS `posisi` from (`x23_lembur` join `x23_karyawan_vw` on((`x23_lembur`.`idkaryawan` = `x23_karyawan_vw`.`id`))) */;

/*View structure for view x23_masterbarang_vw */

/*!50001 DROP TABLE IF EXISTS `x23_masterbarang_vw` */;
/*!50001 DROP VIEW IF EXISTS `x23_masterbarang_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_masterbarang_vw` AS select `x23_masterbarang`.`id` AS `id`,`x23_masterbarang`.`jns` AS `jns`,`x23_masterbarang`.`kodebarang` AS `kodebarang`,`x23_masterbarang`.`namabarang` AS `namabarang`,`x23_masterbarang`.`varian` AS `varian`,`x23_masterbarang`.`idsupplier` AS `idsupplier`,`x23_supplier`.`nama` AS `nama` from (`x23_masterbarang` join `x23_supplier` on((`x23_masterbarang`.`idsupplier` = `x23_supplier`.`id`))) */;

/*View structure for view x23_notabeli_claim_det */

/*!50001 DROP TABLE IF EXISTS `x23_notabeli_claim_det` */;
/*!50001 DROP VIEW IF EXISTS `x23_notabeli_claim_det` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_notabeli_claim_det` AS select `x23_notabeli_det`.`id` AS `id`,`x23_notabeli_det`.`nonota` AS `nonota`,`x23_notabeli_det`.`hargabelibersih` AS `hargabelibersih`,`x23_notabeli_det`.`qty` AS `qty`,`x23_notabeli_det`.`total` AS `total`,`x23_notabeli_det`.`status` AS `status`,`x23_notabeli_det`.`tgltiba` AS `tgltiba`,`x23_notabeli_det`.`idgudang` AS `idgudang`,`x23_notabeli_det`.`rak` AS `rak`,`x23_notabeli_det`.`id_claimoli_det` AS `id_claimoli_det`,`x23_claimoli_det`.`kodepaket` AS `kodepaket`,`x23_claimoli_det`.`kpbke` AS `kpbke`,`x23_claimoli_det`.`namakpb` AS `namakpb`,`x23_claimoli_det`.`idbarang` AS `idbarang`,`x23_claimoli_det`.`kodebarang` AS `kodebarang`,`x23_claimoli_det`.`varian` AS `varian`,`x23_claimoli_det`.`namabarang` AS `namabarang`,`x23_claimoli_det`.`hargaoli` AS `hargaoli`,`x23_claimoli_det`.`statusclaim` AS `statusclaim`,`x23_claimoli_det`.`tagihkembali` AS `tagihkembali`,`x23_claimoli_det`.`kettolak` AS `kettolak`,`x23_claimoli_det`.`statuscek` AS `statuscek` from (`x23_notabeli_det` join `x23_claimoli_det` on((`x23_notabeli_det`.`id_claimoli_det` = `x23_claimoli_det`.`id`))) */;

/*View structure for view x23_notabeli_det2_vw */

/*!50001 DROP TABLE IF EXISTS `x23_notabeli_det2_vw` */;
/*!50001 DROP VIEW IF EXISTS `x23_notabeli_det2_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_notabeli_det2_vw` AS select `x23_notabeli_det`.`id` AS `id`,`x23_notabeli`.`jns` AS `jns`,`x23_notabeli`.`tglnota` AS `tglnota`,`x23_notabeli_det`.`nonota` AS `nonota`,`x23_notabeli_det`.`idbarang` AS `idbarang`,`x23_notabeli_det`.`hargabelibersih` AS `hargabelibersih`,`x23_notabeli_det`.`qty` AS `qty`,`x23_notabeli_det`.`total` AS `total`,`x23_notabeli_det`.`status` AS `status`,`x23_notabeli_det`.`tgltiba` AS `tgltiba`,`x23_notabeli_det`.`idgudang` AS `idgudang`,`x23_notabeli_det`.`rak` AS `rak`,`x23_masterbarang`.`kodebarang` AS `kodebarang`,`x23_masterbarang`.`namabarang` AS `namabarang`,`x23_masterbarang`.`varian` AS `varian`,`x23_masterbarang`.`satuan` AS `satuan`,`x23_masterbarang`.`idsupplier` AS `idsupplier`,`x23_gudang`.`gudang` AS `gudang` from (((`x23_notabeli_det` join `x23_masterbarang` on((`x23_notabeli_det`.`idbarang` = `x23_masterbarang`.`id`))) join `x23_gudang` on((`x23_notabeli_det`.`idgudang` = `x23_gudang`.`id`))) join `x23_notabeli` on((`x23_notabeli`.`nonota` = `x23_notabeli_det`.`nonota`))) */;

/*View structure for view x23_notabeli_det_vw */

/*!50001 DROP TABLE IF EXISTS `x23_notabeli_det_vw` */;
/*!50001 DROP VIEW IF EXISTS `x23_notabeli_det_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_notabeli_det_vw` AS select `x23_notabeli_det`.`id` AS `id`,`x23_notabeli_det`.`nonota` AS `nonota`,`x23_notabeli`.`idsupplier` AS `idsupplier`,`x23_notabeli`.`tahun` AS `tahun`,`x23_notabeli`.`bulan` AS `bulan`,`x23_notabeli`.`tglnota` AS `tglnota`,`x23_notabeli`.`totalqty` AS `totalqty`,`x23_notabeli`.`grandtotal` AS `grandtotal`,`x23_notabeli`.`harga` AS `harga`,`x23_notabeli_det`.`idbarang` AS `idbarang`,`x23_notabeli_det`.`hargabelibersih` AS `hargabelibersih`,`x23_notabeli_det`.`qty` AS `qty`,`x23_notabeli_det`.`total` AS `total`,`x23_notabeli_det`.`status` AS `status`,`x23_notabeli_det`.`idgudang` AS `idgudang`,`x23_notabeli_det`.`tgltiba` AS `tgltiba`,`x23_gudang`.`gudang` AS `gudang`,`x23_notabeli_det`.`rak` AS `rak`,`x23_masterbarang`.`kodebarang` AS `kodebarang`,`x23_masterbarang`.`namabarang` AS `namabarang`,`x23_masterbarang`.`varian` AS `varian`,`x23_masterbarang`.`satuan` AS `satuan`,`x23_stokpart`.`hargajual` AS `hargajual`,`x23_stokpart`.`hargajual2` AS `hargajual2`,`x23_stokpart`.`stok` AS `stok` from ((((`x23_notabeli_det` join `x23_notabeli` on((`x23_notabeli_det`.`nonota` = `x23_notabeli`.`nonota`))) join `x23_gudang` on((`x23_notabeli_det`.`idgudang` = `x23_gudang`.`id`))) join `x23_masterbarang` on((`x23_notabeli_det`.`idbarang` = `x23_masterbarang`.`id`))) join `x23_stokpart` on((`x23_notabeli_det`.`nonota` = `x23_stokpart`.`nonota`))) group by `x23_notabeli_det`.`id` */;

/*View structure for view x23_notabeli_vw */

/*!50001 DROP TABLE IF EXISTS `x23_notabeli_vw` */;
/*!50001 DROP VIEW IF EXISTS `x23_notabeli_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_notabeli_vw` AS select `x23_notabeli`.`id` AS `id`,`x23_notabeli`.`jns` AS `jns`,`x23_notabeli`.`nonota` AS `nonota`,`x23_notabeli`.`idsupplier` AS `idsupplier`,`x23_notabeli`.`tahun` AS `tahun`,`x23_notabeli`.`bulan` AS `bulan`,`x23_notabeli`.`tglnota` AS `tglnota`,`x23_notabeli`.`nopo` AS `nopo`,`x23_notabeli`.`tglpo` AS `tglpo`,`x23_notabeli`.`totalqty` AS `totalqty`,`x23_notabeli`.`grandtotal` AS `grandtotal`,`x23_notabeli`.`grandtotalppn` AS `grandtotalppn`,`x23_notabeli`.`gtbayar` AS `gtbayar`,`x23_notabeli`.`bayar` AS `bayar`,`x23_notabeli`.`tglbayar` AS `tglbayar`,`x23_notabeli`.`status` AS `status`,`x23_notabeli`.`konf` AS `konf`,`x23_notabeli`.`scan` AS `scan`,`x23_notabeli`.`dk` AS `dk`,`x23_notabeli`.`harga` AS `harga`,`x23_notabeli`.`iduserbeli` AS `iduserbeli`,`x23_notabeli`.`iduserkonf` AS `iduserkonf`,`x23_notabeli`.`iduserbyr` AS `iduserbyr`,`x23_notabeli`.`inputx` AS `inputx`,`x23_notabeli`.`updatex` AS `updatex`,`x23_supplier`.`nama` AS `nama` from (`x23_notabeli` join `x23_supplier` on((`x23_notabeli`.`idsupplier` = `x23_supplier`.`id`))) */;

/*View structure for view x23_notaindent_det_nonmpm */

/*!50001 DROP TABLE IF EXISTS `x23_notaindent_det_nonmpm` */;
/*!50001 DROP VIEW IF EXISTS `x23_notaindent_det_nonmpm` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_notaindent_det_nonmpm` AS select `x23_indent_det`.`id` AS `id`,`x23_indent_det`.`noindent` AS `noindent`,`x23_indent_det`.`tahun` AS `tahun`,`x23_indent_det`.`bulan` AS `bulan`,`x23_indent_det`.`tglindent` AS `tglindent`,`x23_indent_det`.`idbarang` AS `idbarang`,`x23_indent_det`.`qty` AS `qty`,`x23_masterbarang`.`jns` AS `jns`,`x23_masterbarang`.`kodebarang` AS `kodebarang`,`x23_masterbarang`.`namabarang` AS `namabarang`,`x23_masterbarang`.`varian` AS `varian`,`x23_masterbarang`.`satuan` AS `satuan`,`x23_masterbarang`.`idsupplier` AS `idsupplier`,`x23_supplier`.`nama` AS `nama` from ((`x23_indent_det` join `x23_masterbarang` on((`x23_indent_det`.`idbarang` = `x23_masterbarang`.`id`))) join `x23_supplier` on((`x23_masterbarang`.`idsupplier` = `x23_supplier`.`id`))) where (`x23_supplier`.`nama` <> 'MPM') */;

/*View structure for view x23_notajual_det2_vw */

/*!50001 DROP TABLE IF EXISTS `x23_notajual_det2_vw` */;
/*!50001 DROP VIEW IF EXISTS `x23_notajual_det2_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_notajual_det2_vw` AS select `x23_notajual_det`.`id` AS `id`,`x23_notajual_det`.`tahun` AS `tahun`,`x23_notajual_det`.`bulan` AS `bulan`,`x23_notajual_det`.`tglnota` AS `tglnota`,`x23_notajual_det`.`nonota` AS `nonota`,`x23_notajual_det`.`idbarang` AS `idbarang`,`x23_masterbarang`.`kodebarang` AS `kodebarang`,`x23_masterbarang`.`namabarang` AS `namabarang`,`x23_masterbarang`.`varian` AS `varian`,`x23_notajual_det`.`qtyindent` AS `qtyindent`,`x23_notajual_det`.`qtyindentsisa` AS `qtyindentsisa`,`x23_notajual_det`.`qty` AS `qty` from (`x23_notajual_det` join `x23_masterbarang` on((`x23_notajual_det`.`idbarang` = `x23_masterbarang`.`id`))) */;

/*View structure for view x23_notajual_det_vw */

/*!50001 DROP TABLE IF EXISTS `x23_notajual_det_vw` */;
/*!50001 DROP VIEW IF EXISTS `x23_notajual_det_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_notajual_det_vw` AS select `x23_notajual_det`.`id` AS `id`,`x23_notajual_det`.`notabeli` AS `notabeli`,`x23_notajual_det`.`nonota` AS `nonota`,`x23_notajual_det`.`tglnota` AS `tglnota`,`x23_notajual_det`.`idbarang` AS `idbarang`,`x23_notajual_det`.`hargabelibersih` AS `hargabelibersih`,`x23_notajual_det`.`hargajual` AS `hargajual`,`x23_notajual_det`.`diskon` AS `diskon`,`x23_notajual_det`.`hargajualbersih` AS `hargajualbersih`,`x23_notajual_det`.`qtyindent` AS `qtyindent`,`x23_notajual_det`.`qtyindentsisa` AS `qtyindentsisa`,`x23_notajual_det`.`qty` AS `qty`,`x23_notajual_det`.`totdiskon` AS `totdiskon`,`x23_notajual_det`.`tothargabelibersih` AS `tothargabelibersih`,`x23_notajual_det`.`total` AS `total`,`x23_notajual_det`.`idgudang` AS `idgudang`,`x23_notajual_det`.`rak` AS `rak`,`x23_notajual_det`.`tgltagihan` AS `tgltagihan`,`x23_notajual_det`.`idtagihan` AS `idtagihan`,`x23_notajual_det`.`tglbayarkpb` AS `tglbayarkpb`,`x23_notajual_det`.`jumlahbayarkpb` AS `jumlahbayarkpb`,`x23_notajual_det`.`idbayar` AS `idbayar`,`x23_notajual_det`.`statusbayar` AS `statusbayar`,`x23_masterbarang`.`kodebarang` AS `kodebarang`,`x23_masterbarang`.`namabarang` AS `namabarang`,`x23_masterbarang`.`varian` AS `varian`,`x23_gudang`.`gudang` AS `gudang` from ((`x23_notajual_det` join `x23_masterbarang` on((`x23_notajual_det`.`idbarang` = `x23_masterbarang`.`id`))) join `x23_gudang` on((`x23_notajual_det`.`idgudang` = `x23_gudang`.`id`))) */;

/*View structure for view x23_notajual_det_ws1a */

/*!50001 DROP TABLE IF EXISTS `x23_notajual_det_ws1a` */;
/*!50001 DROP VIEW IF EXISTS `x23_notajual_det_ws1a` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_notajual_det_ws1a` AS select `x23_notajual_det`.`id` AS `id`,`x23_notajual_det`.`notabeli` AS `notabeli`,`x23_notajual_det`.`nonota` AS `nonota`,`x23_notajual_det`.`notaindent` AS `notaindent`,`x23_notajual_det`.`tahun` AS `tahun`,`x23_notajual_det`.`bulan` AS `bulan`,`x23_notajual_det`.`tglnota` AS `tglnota`,`x23_notajual_det`.`idbarang` AS `idbarang`,`x23_notajual_det`.`hargabelibersih` AS `hargabelibersih`,`x23_notajual_det`.`hargajual` AS `hargajual`,`x23_notajual_det`.`diskon` AS `diskon`,`x23_notajual_det`.`hargajualbersih` AS `hargajualbersih`,`x23_notajual_det`.`qty` AS `qty`,`x23_notajual_det`.`tothargabelibersih` AS `tothargabelibersih`,`x23_notajual_det`.`totdiskon` AS `totdiskon`,`x23_notajual_det`.`total` AS `total`,`x23_notajual_det`.`idgudang` AS `idgudang`,`x23_notajual_det`.`rak` AS `rak`,`x23_notajual_det`.`tgltagihan` AS `tgltagihan`,`x23_notajual_det`.`idtagihan` AS `idtagihan`,`x23_notajual_det`.`tglbayarkpb` AS `tglbayarkpb`,`x23_notajual_det`.`jumlahbayarkpb` AS `jumlahbayarkpb`,`x23_notajual_det`.`idbayar` AS `idbayar`,`x23_notajual_det`.`statusbayar` AS `statusbayar`,`x23_notajual_det`.`statusulang` AS `statusulang`,`x23_masterbarang`.`jns` AS `jns`,`x23_masterbarang`.`kodebarang` AS `kodebarang`,`x23_masterbarang`.`namabarang` AS `namabarang`,`x23_masterbarang`.`varian` AS `varian`,`x23_masterbarang`.`satuan` AS `satuan`,`x23_notabeli`.`idsupplier` AS `idsupplier`,`x23_kwitansi`.`jnskwitansi` AS `jnskwitansi`,`x23_kwitansi`.`status` AS `status` from (((`x23_notajual_det` join `x23_masterbarang` on((`x23_notajual_det`.`idbarang` = `x23_masterbarang`.`id`))) join `x23_notabeli` on((`x23_notajual_det`.`notabeli` = `x23_notabeli`.`nonota`))) join `x23_kwitansi` on((`x23_notajual_det`.`nonota` = `x23_kwitansi`.`nomor`))) where ((`x23_notabeli`.`idsupplier` = '2') and (`x23_kwitansi`.`status` = '1') and (`x23_kwitansi`.`jnskwitansi` in ('servis','penjualan'))) */;

/*View structure for view x23_notajual_det_ws1b */

/*!50001 DROP TABLE IF EXISTS `x23_notajual_det_ws1b` */;
/*!50001 DROP VIEW IF EXISTS `x23_notajual_det_ws1b` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_notajual_det_ws1b` AS select `x23_notajual_det`.`id` AS `id`,`x23_notajual_det`.`notabeli` AS `notabeli`,`x23_notajual_det`.`nonota` AS `nonota`,`x23_notajual_det`.`notaindent` AS `notaindent`,`x23_notajual_det`.`tahun` AS `tahun`,`x23_notajual_det`.`bulan` AS `bulan`,`x23_notajual_det`.`tglnota` AS `tglnota`,`x23_notajual_det`.`idbarang` AS `idbarang`,`x23_notajual_det`.`hargabelibersih` AS `hargabelibersih`,`x23_notajual_det`.`hargajual` AS `hargajual`,`x23_notajual_det`.`diskon` AS `diskon`,`x23_notajual_det`.`hargajualbersih` AS `hargajualbersih`,`x23_notajual_det`.`qty` AS `qty`,`x23_notajual_det`.`tothargabelibersih` AS `tothargabelibersih`,`x23_notajual_det`.`totdiskon` AS `totdiskon`,`x23_notajual_det`.`total` AS `total`,`x23_notajual_det`.`idgudang` AS `idgudang`,`x23_notajual_det`.`rak` AS `rak`,`x23_notajual_det`.`tgltagihan` AS `tgltagihan`,`x23_notajual_det`.`idtagihan` AS `idtagihan`,`x23_notajual_det`.`tglbayarkpb` AS `tglbayarkpb`,`x23_notajual_det`.`jumlahbayarkpb` AS `jumlahbayarkpb`,`x23_notajual_det`.`idbayar` AS `idbayar`,`x23_notajual_det`.`statusbayar` AS `statusbayar`,`x23_notajual_det`.`statusulang` AS `statusulang`,`x23_masterbarang`.`jns` AS `jns`,`x23_masterbarang`.`kodebarang` AS `kodebarang`,`x23_masterbarang`.`namabarang` AS `namabarang`,`x23_masterbarang`.`varian` AS `varian`,`x23_masterbarang`.`satuan` AS `satuan`,`x23_notabeli`.`idsupplier` AS `idsupplier` from (((`x23_notajual_det` join `x23_masterbarang` on((`x23_notajual_det`.`idbarang` = `x23_masterbarang`.`id`))) join `x23_notabeli` on((`x23_notajual_det`.`notabeli` = `x23_notabeli`.`nonota`))) join `x23_kwitansi` on((`x23_notajual_det`.`notaindent` = `x23_kwitansi`.`nomor`))) where ((`x23_notabeli`.`idsupplier` = '2') and (`x23_kwitansi`.`status` = '1')) */;

/*View structure for view x23_notajual_det_ws1c */

/*!50001 DROP TABLE IF EXISTS `x23_notajual_det_ws1c` */;
/*!50001 DROP VIEW IF EXISTS `x23_notajual_det_ws1c` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_notajual_det_ws1c` AS select `x23_notajual_det`.`id` AS `id`,`x23_notajual_det`.`notabeli` AS `notabeli`,`x23_notajual_det`.`nonota` AS `nonota`,`x23_notajual_det`.`notaindent` AS `notaindent`,`x23_notajual_det`.`tahun` AS `tahun`,`x23_notajual_det`.`bulan` AS `bulan`,`x23_notajual_det`.`tglnota` AS `tglnota`,`x23_notajual_det`.`idbarang` AS `idbarang`,`x23_notajual_det`.`hargabelibersih` AS `hargabelibersih`,`x23_notajual_det`.`hargajual` AS `hargajual`,`x23_notajual_det`.`diskon` AS `diskon`,`x23_notajual_det`.`hargajualbersih` AS `hargajualbersih`,`x23_notajual_det`.`qty` AS `qty`,`x23_notajual_det`.`tothargabelibersih` AS `tothargabelibersih`,`x23_notajual_det`.`totdiskon` AS `totdiskon`,`x23_notajual_det`.`total` AS `total`,`x23_notajual_det`.`idgudang` AS `idgudang`,`x23_notajual_det`.`rak` AS `rak`,`x23_notajual_det`.`tgltagihan` AS `tgltagihan`,`x23_notajual_det`.`idtagihan` AS `idtagihan`,`x23_notajual_det`.`tglbayarkpb` AS `tglbayarkpb`,`x23_notajual_det`.`jumlahbayarkpb` AS `jumlahbayarkpb`,`x23_notajual_det`.`idbayar` AS `idbayar`,`x23_notajual_det`.`statusbayar` AS `statusbayar`,`x23_notajual_det`.`statusulang` AS `statusulang`,`x23_masterbarang`.`jns` AS `jns`,`x23_masterbarang`.`kodebarang` AS `kodebarang`,`x23_masterbarang`.`namabarang` AS `namabarang`,`x23_masterbarang`.`varian` AS `varian`,`x23_masterbarang`.`satuan` AS `satuan`,`x23_notabeli`.`idsupplier` AS `idsupplier`,`x23_kwitansi`.`jnskwitansi` AS `jnskwitansi`,`x23_kwitansi`.`status` AS `status` from (((`x23_notajual_det` join `x23_masterbarang` on((`x23_notajual_det`.`idbarang` = `x23_masterbarang`.`id`))) join `x23_notabeli` on((`x23_notajual_det`.`notabeli` = `x23_notabeli`.`nonota`))) join `x23_kwitansi` on((`x23_notajual_det`.`nonota` = `x23_kwitansi`.`nomor`))) where ((`x23_notabeli`.`idsupplier` = '3') and (`x23_kwitansi`.`status` = '1') and (`x23_kwitansi`.`jnskwitansi` in ('servis','penjualan'))) */;

/*View structure for view x23_notajual_det_ws1d */

/*!50001 DROP TABLE IF EXISTS `x23_notajual_det_ws1d` */;
/*!50001 DROP VIEW IF EXISTS `x23_notajual_det_ws1d` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_notajual_det_ws1d` AS select `x23_notajual_det`.`id` AS `id`,`x23_notajual_det`.`notabeli` AS `notabeli`,`x23_notajual_det`.`nonota` AS `nonota`,`x23_notajual_det`.`notaindent` AS `notaindent`,`x23_notajual_det`.`tahun` AS `tahun`,`x23_notajual_det`.`bulan` AS `bulan`,`x23_notajual_det`.`tglnota` AS `tglnota`,`x23_notajual_det`.`idbarang` AS `idbarang`,`x23_notajual_det`.`hargabelibersih` AS `hargabelibersih`,`x23_notajual_det`.`hargajual` AS `hargajual`,`x23_notajual_det`.`diskon` AS `diskon`,`x23_notajual_det`.`hargajualbersih` AS `hargajualbersih`,`x23_notajual_det`.`qty` AS `qty`,`x23_notajual_det`.`tothargabelibersih` AS `tothargabelibersih`,`x23_notajual_det`.`totdiskon` AS `totdiskon`,`x23_notajual_det`.`total` AS `total`,`x23_notajual_det`.`idgudang` AS `idgudang`,`x23_notajual_det`.`rak` AS `rak`,`x23_notajual_det`.`tgltagihan` AS `tgltagihan`,`x23_notajual_det`.`idtagihan` AS `idtagihan`,`x23_notajual_det`.`tglbayarkpb` AS `tglbayarkpb`,`x23_notajual_det`.`jumlahbayarkpb` AS `jumlahbayarkpb`,`x23_notajual_det`.`idbayar` AS `idbayar`,`x23_notajual_det`.`statusbayar` AS `statusbayar`,`x23_notajual_det`.`statusulang` AS `statusulang`,`x23_masterbarang`.`jns` AS `jns`,`x23_masterbarang`.`kodebarang` AS `kodebarang`,`x23_masterbarang`.`namabarang` AS `namabarang`,`x23_masterbarang`.`varian` AS `varian`,`x23_masterbarang`.`satuan` AS `satuan`,`x23_notabeli`.`idsupplier` AS `idsupplier`,`x23_kwitansi`.`jnskwitansi` AS `jnskwitansi`,`x23_kwitansi`.`status` AS `status` from (((`x23_notajual_det` join `x23_masterbarang` on((`x23_notajual_det`.`idbarang` = `x23_masterbarang`.`id`))) join `x23_notabeli` on((`x23_notajual_det`.`notabeli` = `x23_notabeli`.`nonota`))) join `x23_kwitansi` on((`x23_notajual_det`.`nonota` = `x23_kwitansi`.`nomor`))) where ((`x23_notabeli`.`idsupplier` = '1') and (`x23_notajual_det`.`hargajual` > '0') and (`x23_kwitansi`.`status` = '1') and (`x23_kwitansi`.`jnskwitansi` in ('servis','penjualan'))) */;

/*View structure for view x23_notajual_det_ws2 */

/*!50001 DROP TABLE IF EXISTS `x23_notajual_det_ws2` */;
/*!50001 DROP VIEW IF EXISTS `x23_notajual_det_ws2` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_notajual_det_ws2` AS select `x23_notajual_det`.`id` AS `id`,`x23_notajual_det`.`notabeli` AS `notabeli`,`x23_notajual_det`.`nonota` AS `nonota`,`x23_notajual_det`.`tahun` AS `tahun`,`x23_notajual_det`.`bulan` AS `bulan`,`x23_notajual_det`.`tglnota` AS `tglnota`,`x23_notajual_det`.`idbarang` AS `idbarang`,`x23_notajual_det`.`hargabelibersih` AS `hargabelibersih`,`x23_notajual_det`.`hargajual` AS `hargajual`,`x23_notajual_det`.`diskon` AS `diskon`,`x23_notajual_det`.`hargajualbersih` AS `hargajualbersih`,`x23_notajual_det`.`qty` AS `qty`,`x23_notajual_det`.`tothargabelibersih` AS `tothargabelibersih`,`x23_notajual_det`.`totdiskon` AS `totdiskon`,`x23_notajual_det`.`total` AS `total`,`x23_notajual_det`.`idgudang` AS `idgudang`,`x23_notajual_det`.`rak` AS `rak`,`x23_notajual_det`.`tgltagihan` AS `tgltagihan`,`x23_notajual_det`.`idtagihan` AS `idtagihan`,`x23_notajual_det`.`tglbayarkpb` AS `tglbayarkpb`,`x23_notajual_det`.`jumlahbayarkpb` AS `jumlahbayarkpb`,`x23_notajual_det`.`idbayar` AS `idbayar`,`x23_notajual_det`.`statusbayar` AS `statusbayar`,`x23_notajual_det`.`statusulang` AS `statusulang`,`x23_masterbarang`.`jns` AS `jns`,`x23_masterbarang`.`kodebarang` AS `kodebarang`,`x23_masterbarang`.`namabarang` AS `namabarang`,`x23_masterbarang`.`varian` AS `varian`,`x23_masterbarang`.`satuan` AS `satuan`,`x23_notabeli`.`idsupplier` AS `idsupplier` from (((`x23_notajual_det` join `x23_masterbarang` on((`x23_notajual_det`.`idbarang` = `x23_masterbarang`.`id`))) join `x23_supplier`) join `x23_notabeli` on((`x23_notajual_det`.`notabeli` = `x23_notabeli`.`nonota`))) where ((`x23_notabeli`.`idsupplier` not in ('1','2','3','4','5')) and (substr(`x23_notajual_det`.`nonota`,1,2) = 'NJ')) */;

/*View structure for view x23_notajual_det_ws3 */

/*!50001 DROP TABLE IF EXISTS `x23_notajual_det_ws3` */;
/*!50001 DROP VIEW IF EXISTS `x23_notajual_det_ws3` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_notajual_det_ws3` AS select `x23_notajual_det`.`id` AS `id`,`x23_notajual_det`.`notabeli` AS `notabeli`,`x23_notajual_det`.`nonota` AS `nonota`,`x23_notajual_det`.`tahun` AS `tahun`,`x23_notajual_det`.`bulan` AS `bulan`,`x23_notajual_det`.`tglnota` AS `tglnota`,`x23_notajual_det`.`idbarang` AS `idbarang`,`x23_notajual_det`.`hargabelibersih` AS `hargabelibersih`,`x23_notajual_det`.`hargajual` AS `hargajual`,`x23_notajual_det`.`diskon` AS `diskon`,`x23_notajual_det`.`hargajualbersih` AS `hargajualbersih`,`x23_notajual_det`.`qty` AS `qty`,`x23_notajual_det`.`tothargabelibersih` AS `tothargabelibersih`,`x23_notajual_det`.`totdiskon` AS `totdiskon`,`x23_notajual_det`.`total` AS `total`,`x23_notajual_det`.`idgudang` AS `idgudang`,`x23_notajual_det`.`rak` AS `rak`,`x23_notajual_det`.`tgltagihan` AS `tgltagihan`,`x23_notajual_det`.`idtagihan` AS `idtagihan`,`x23_notajual_det`.`tglbayarkpb` AS `tglbayarkpb`,`x23_notajual_det`.`jumlahbayarkpb` AS `jumlahbayarkpb`,`x23_notajual_det`.`idbayar` AS `idbayar`,`x23_notajual_det`.`statusbayar` AS `statusbayar`,`x23_notajual_det`.`statusulang` AS `statusulang`,`x23_masterbarang`.`jns` AS `jns`,`x23_masterbarang`.`kodebarang` AS `kodebarang`,`x23_masterbarang`.`namabarang` AS `namabarang`,`x23_masterbarang`.`varian` AS `varian`,`x23_masterbarang`.`satuan` AS `satuan`,`x23_notabeli`.`idsupplier` AS `idsupplier` from ((`x23_notajual_det` join `x23_masterbarang` on((`x23_notajual_det`.`idbarang` = `x23_masterbarang`.`id`))) join `x23_notabeli` on((`x23_notajual_det`.`notabeli` = `x23_notabeli`.`nonota`))) where ((`x23_notabeli`.`idsupplier` = '3') and (substr(`x23_notajual_det`.`nonota`,1,2) = 'NJ')) */;

/*View structure for view x23_notajual_det_ws4 */

/*!50001 DROP TABLE IF EXISTS `x23_notajual_det_ws4` */;
/*!50001 DROP VIEW IF EXISTS `x23_notajual_det_ws4` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_notajual_det_ws4` AS select `x23_notajual_det`.`id` AS `id`,`x23_notajual_det`.`notabeli` AS `notabeli`,`x23_notajual_det`.`nonota` AS `nonota`,`x23_notajual_det`.`tahun` AS `tahun`,`x23_notajual_det`.`bulan` AS `bulan`,`x23_notajual_det`.`tglnota` AS `tglnota`,`x23_notajual_det`.`idbarang` AS `idbarang`,`x23_notajual_det`.`hargabelibersih` AS `hargabelibersih`,`x23_notajual_det`.`hargajual` AS `hargajual`,`x23_notajual_det`.`diskon` AS `diskon`,`x23_notajual_det`.`hargajualbersih` AS `hargajualbersih`,`x23_notajual_det`.`qty` AS `qty`,`x23_notajual_det`.`tothargabelibersih` AS `tothargabelibersih`,`x23_notajual_det`.`totdiskon` AS `totdiskon`,`x23_notajual_det`.`total` AS `total`,`x23_notajual_det`.`idgudang` AS `idgudang`,`x23_notajual_det`.`rak` AS `rak`,`x23_notajual_det`.`tgltagihan` AS `tgltagihan`,`x23_notajual_det`.`idtagihan` AS `idtagihan`,`x23_notajual_det`.`tglbayarkpb` AS `tglbayarkpb`,`x23_notajual_det`.`jumlahbayarkpb` AS `jumlahbayarkpb`,`x23_notajual_det`.`idbayar` AS `idbayar`,`x23_notajual_det`.`statusbayar` AS `statusbayar`,`x23_notajual_det`.`statusulang` AS `statusulang`,`x23_masterbarang`.`jns` AS `jns`,`x23_masterbarang`.`kodebarang` AS `kodebarang`,`x23_masterbarang`.`namabarang` AS `namabarang`,`x23_masterbarang`.`varian` AS `varian`,`x23_masterbarang`.`satuan` AS `satuan`,`x23_notabeli`.`idsupplier` AS `idsupplier` from ((`x23_notajual_det` join `x23_masterbarang` on((`x23_notajual_det`.`idbarang` = `x23_masterbarang`.`id`))) join `x23_notabeli` on((`x23_notajual_det`.`notabeli` = `x23_notabeli`.`nonota`))) where ((`x23_notabeli`.`idsupplier` = '1') and (substr(`x23_notajual_det`.`nonota`,1,2) = 'NJ')) */;

/*View structure for view x23_notajual_det_ws5a */

/*!50001 DROP TABLE IF EXISTS `x23_notajual_det_ws5a` */;
/*!50001 DROP VIEW IF EXISTS `x23_notajual_det_ws5a` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_notajual_det_ws5a` AS select `x23_notajual_det`.`id` AS `id`,`x23_notajual_det`.`notabeli` AS `notabeli`,`x23_notajual_det`.`nonota` AS `nonota`,`x23_notajual_det`.`notaindent` AS `notaindent`,`x23_notajual_det`.`tahun` AS `tahun`,`x23_notajual_det`.`bulan` AS `bulan`,`x23_notajual_det`.`tglnota` AS `tglnota`,`x23_notajual_det`.`idbarang` AS `idbarang`,`x23_notajual_det`.`hargabelibersih` AS `hargabelibersih`,`x23_notajual_det`.`hargajual` AS `hargajual`,`x23_notajual_det`.`diskon` AS `diskon`,`x23_notajual_det`.`hargajualbersih` AS `hargajualbersih`,`x23_notajual_det`.`qty` AS `qty`,`x23_notajual_det`.`tothargabelibersih` AS `tothargabelibersih`,`x23_notajual_det`.`totdiskon` AS `totdiskon`,`x23_notajual_det`.`total` AS `total`,`x23_notajual_det`.`idgudang` AS `idgudang`,`x23_notajual_det`.`rak` AS `rak`,`x23_notajual_det`.`tgltagihan` AS `tgltagihan`,`x23_notajual_det`.`idtagihan` AS `idtagihan`,`x23_notajual_det`.`tglbayarkpb` AS `tglbayarkpb`,`x23_notajual_det`.`jumlahbayarkpb` AS `jumlahbayarkpb`,`x23_notajual_det`.`idbayar` AS `idbayar`,`x23_notajual_det`.`statusbayar` AS `statusbayar`,`x23_notajual_det`.`statusulang` AS `statusulang`,`x23_masterbarang`.`jns` AS `jns`,`x23_masterbarang`.`kodebarang` AS `kodebarang`,`x23_masterbarang`.`namabarang` AS `namabarang`,`x23_masterbarang`.`varian` AS `varian`,`x23_masterbarang`.`satuan` AS `satuan`,`x23_notabeli`.`idsupplier` AS `idsupplier` from (((`x23_notajual_det` join `x23_masterbarang` on((`x23_notajual_det`.`idbarang` = `x23_masterbarang`.`id`))) join `x23_notabeli` on((`x23_notajual_det`.`notabeli` = `x23_notabeli`.`nonota`))) join `x23_kwitansi` on((`x23_notajual_det`.`nonota` = `x23_kwitansi`.`nomor`))) where ((`x23_notabeli`.`idsupplier` not in ('2','1')) and (`x23_kwitansi`.`status` = '1') and (`x23_kwitansi`.`jnskwitansi` in ('servis','penjualan'))) */;

/*View structure for view x23_notajual_det_ws5b */

/*!50001 DROP TABLE IF EXISTS `x23_notajual_det_ws5b` */;
/*!50001 DROP VIEW IF EXISTS `x23_notajual_det_ws5b` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_notajual_det_ws5b` AS select `x23_notajual_det`.`id` AS `id`,`x23_notajual_det`.`notabeli` AS `notabeli`,`x23_notajual_det`.`nonota` AS `nonota`,`x23_notajual_det`.`notaindent` AS `notaindent`,`x23_notajual_det`.`tahun` AS `tahun`,`x23_notajual_det`.`bulan` AS `bulan`,`x23_notajual_det`.`tglnota` AS `tglnota`,`x23_notajual_det`.`idbarang` AS `idbarang`,`x23_notajual_det`.`hargabelibersih` AS `hargabelibersih`,`x23_notajual_det`.`hargajual` AS `hargajual`,`x23_notajual_det`.`diskon` AS `diskon`,`x23_notajual_det`.`hargajualbersih` AS `hargajualbersih`,`x23_notajual_det`.`qty` AS `qty`,`x23_notajual_det`.`tothargabelibersih` AS `tothargabelibersih`,`x23_notajual_det`.`totdiskon` AS `totdiskon`,`x23_notajual_det`.`total` AS `total`,`x23_notajual_det`.`idgudang` AS `idgudang`,`x23_notajual_det`.`rak` AS `rak`,`x23_notajual_det`.`tgltagihan` AS `tgltagihan`,`x23_notajual_det`.`idtagihan` AS `idtagihan`,`x23_notajual_det`.`tglbayarkpb` AS `tglbayarkpb`,`x23_notajual_det`.`jumlahbayarkpb` AS `jumlahbayarkpb`,`x23_notajual_det`.`idbayar` AS `idbayar`,`x23_notajual_det`.`statusbayar` AS `statusbayar`,`x23_notajual_det`.`statusulang` AS `statusulang`,`x23_masterbarang`.`jns` AS `jns`,`x23_masterbarang`.`kodebarang` AS `kodebarang`,`x23_masterbarang`.`namabarang` AS `namabarang`,`x23_masterbarang`.`varian` AS `varian`,`x23_masterbarang`.`satuan` AS `satuan`,`x23_notabeli`.`idsupplier` AS `idsupplier` from (((`x23_notajual_det` join `x23_masterbarang` on((`x23_notajual_det`.`idbarang` = `x23_masterbarang`.`id`))) join `x23_notabeli` on((`x23_notajual_det`.`notabeli` = `x23_notabeli`.`nonota`))) join `x23_kwitansi` on((`x23_notajual_det`.`notaindent` = `x23_kwitansi`.`nomor`))) where ((`x23_notabeli`.`idsupplier` not in ('2','1')) and (`x23_kwitansi`.`status` = '1')) */;

/*View structure for view x23_notajual_det_ws_pjmpm */

/*!50001 DROP TABLE IF EXISTS `x23_notajual_det_ws_pjmpm` */;
/*!50001 DROP VIEW IF EXISTS `x23_notajual_det_ws_pjmpm` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_notajual_det_ws_pjmpm` AS select `x23_notajual_det`.`id` AS `id`,`x23_notajual_det`.`notabeli` AS `notabeli`,`x23_notajual_det`.`nonota` AS `nonota`,`x23_notajual_det`.`tahun` AS `tahun`,`x23_notajual_det`.`bulan` AS `bulan`,`x23_notajual_det`.`tglnota` AS `tglnota`,`x23_notajual_det`.`idbarang` AS `idbarang`,`x23_notajual_det`.`hargabelibersih` AS `hargabelibersih`,`x23_notajual_det`.`hargajual` AS `hargajual`,`x23_notajual_det`.`diskon` AS `diskon`,`x23_notajual_det`.`hargajualbersih` AS `hargajualbersih`,`x23_notajual_det`.`qty` AS `qty`,`x23_notajual_det`.`tothargabelibersih` AS `tothargabelibersih`,`x23_notajual_det`.`totdiskon` AS `totdiskon`,`x23_notajual_det`.`total` AS `total`,`x23_notajual_det`.`idgudang` AS `idgudang`,`x23_notajual_det`.`rak` AS `rak`,`x23_notajual_det`.`tgltagihan` AS `tgltagihan`,`x23_notajual_det`.`idtagihan` AS `idtagihan`,`x23_notajual_det`.`tglbayarkpb` AS `tglbayarkpb`,`x23_notajual_det`.`jumlahbayarkpb` AS `jumlahbayarkpb`,`x23_notajual_det`.`idbayar` AS `idbayar`,`x23_notajual_det`.`statusbayar` AS `statusbayar`,`x23_notajual_det`.`statusulang` AS `statusulang`,`x23_masterbarang`.`jns` AS `jns`,`x23_masterbarang`.`kodebarang` AS `kodebarang`,`x23_masterbarang`.`namabarang` AS `namabarang`,`x23_masterbarang`.`varian` AS `varian`,`x23_masterbarang`.`satuan` AS `satuan`,`x23_notabeli`.`idsupplier` AS `idsupplier`,`x23_kwitansi`.`nomor` AS `nomor`,`x23_kwitansi`.`status` AS `status`,`x23_kwitansi`.`jnskwitansi` AS `jnskwitansi` from (((`x23_notajual_det` join `x23_masterbarang` on((`x23_notajual_det`.`idbarang` = `x23_masterbarang`.`id`))) join `x23_notabeli` on((`x23_notajual_det`.`notabeli` = `x23_notabeli`.`nonota`))) join `x23_kwitansi` on((`x23_kwitansi`.`nomor` = `x23_notajual_det`.`nonota`))) where ((`x23_notabeli`.`idsupplier` = '1') and (`x23_kwitansi`.`status` = '1') and (`x23_kwitansi`.`jnskwitansi` = 'penjualan')) */;

/*View structure for view x23_notajual_vw */

/*!50001 DROP TABLE IF EXISTS `x23_notajual_vw` */;
/*!50001 DROP VIEW IF EXISTS `x23_notajual_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_notajual_vw` AS select `x23_notajual`.`id` AS `id`,`x23_notajual`.`nonota` AS `nonota`,`x23_notajual`.`idpelanggan` AS `idpelanggan`,`x23_notajual`.`tahun` AS `tahun`,`x23_notajual`.`bulan` AS `bulan`,`x23_notajual`.`tglnota` AS `tglnota`,`x23_notajual`.`totalqty` AS `totalqty`,`x23_notajual`.`totdiskon` AS `totdiskon`,`x23_notajual`.`tothargabelibersih` AS `tothargabelibersih`,`x23_notajual`.`grandtotal` AS `grandtotal`,`x23_notajual`.`status` AS `status`,if((`x23_notajual`.`status` = '0'),'belum lunas','sudah lunas') AS `ket`,`x23_notajual`.`iduser` AS `iduser`,`x23_notajual`.`inputx` AS `inputx`,`x23_notajual`.`updatex` AS `updatex`,`tbl_pelanggan`.`nama` AS `nama`,`tbl_pelanggan`.`ohc` AS `ohc`,`tbl_pelanggan`.`kadaluarsaohc` AS `kadaluarsaohc`,`tbl_pelanggan`.`notelepon` AS `notelepon`,`tbl_pelanggan`.`noktp` AS `noktp`,`tbl_pelanggan`.`alamat` AS `alamat`,`tbl_pelanggan`.`rt` AS `rt`,`tbl_pelanggan`.`rw` AS `rw`,`tbl_pelanggan`.`kodekab` AS `kodekab`,`tbl_pelanggan`.`namakab` AS `namakab`,`tbl_pelanggan`.`kodekec` AS `kodekec`,`tbl_pelanggan`.`namakec` AS `namakec`,`tbl_pelanggan`.`kodekel` AS `kodekel`,`tbl_pelanggan`.`namakel` AS `namakel`,`tbl_pelanggan`.`kodealamat` AS `kodealamat`,`tbl_pelanggan`.`email` AS `email`,`tbl_pelanggan`.`grup` AS `grup`,`tbl_pelanggan`.`pekerjaan` AS `pekerjaan` from (`x23_notajual` join `tbl_pelanggan` on((`x23_notajual`.`idpelanggan` = `tbl_pelanggan`.`id`))) */;

/*View structure for view x23_notaretur_vw */

/*!50001 DROP TABLE IF EXISTS `x23_notaretur_vw` */;
/*!50001 DROP VIEW IF EXISTS `x23_notaretur_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_notaretur_vw` AS select `x23_notaretur`.`id` AS `id`,`x23_notaretur`.`noretur` AS `noretur`,`x23_notaretur`.`idsupplier` AS `idsupplier`,`x23_supplier`.`nama` AS `nama`,`x23_notaretur`.`nonota` AS `nonota`,`x23_notaretur`.`jumlah` AS `jumlah`,`x23_notaretur`.`potong` AS `potong`,`x23_notaretur`.`sisa` AS `sisa`,`x23_notaretur`.`iduser` AS `iduser`,`x23_notaretur`.`status` AS `status`,`x23_returbeli`.`tahun` AS `tahun`,`x23_returbeli`.`bulan` AS `bulan`,`x23_returbeli`.`tanggal` AS `tanggal` from ((`x23_notaretur` join `x23_supplier` on((`x23_notaretur`.`idsupplier` = `x23_supplier`.`id`))) join `x23_returbeli` on((`x23_notaretur`.`noretur` = `x23_returbeli`.`noretur`))) */;

/*View structure for view x23_notaservice_det1_vw */

/*!50001 DROP TABLE IF EXISTS `x23_notaservice_det1_vw` */;
/*!50001 DROP VIEW IF EXISTS `x23_notaservice_det1_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_notaservice_det1_vw` AS select `x23_notaservice_det`.`id` AS `id`,`x23_notaservice_det`.`nonota` AS `nonota`,`x23_notaservice_det`.`tahun` AS `tahun`,`x23_notaservice_det`.`bulan` AS `bulan`,`x23_notaservice_det`.`tglnota` AS `tglnota`,`x23_notaservice_det`.`kodepaket` AS `kodepaket`,`x23_notaservice_det`.`idjasa` AS `idjasa`,`x23_notaservice_det`.`tarifasli` AS `tarifasli`,`x23_notaservice_det`.`diskon` AS `diskon`,`x23_notaservice_det`.`tarif` AS `tarif`,`x23_notaservice_det`.`tarifkpb` AS `tarifkpb`,`x23_notaservice_det`.`tgltagihan` AS `tgltagihan`,`x23_notaservice_det`.`idtagihan` AS `idtagihan`,`x23_notaservice_det`.`tglbayarkpb` AS `tglbayarkpb`,`x23_notaservice_det`.`jumlahbayarkpb` AS `jumlahbayarkpb`,`x23_notaservice_det`.`idbayar` AS `idbayar`,`x23_notaservice_det`.`statusbayar` AS `statusbayar`,`x23_notaservice_det`.`statusclaim` AS `statusclaim`,`x23_kelompokjasa`.`jnskj` AS `jnskj`,`x23_kelompokjasa`.`nama` AS `nama`,`x23_kelompokjasa`.`harga` AS `harga`,`x23_kelompokjasa`.`kpbke` AS `kpbke`,`x23_kelompokjasa`.`oli` AS `oli`,`x23_kelompokjasa`.`hargampm` AS `hargampm`,`x23_kelompokjasa`.`inputx` AS `inputx` from (`x23_notaservice_det` join `x23_kelompokjasa` on((`x23_notaservice_det`.`kodepaket` = `x23_kelompokjasa`.`kode`))) */;

/*View structure for view x23_notaservice_vw */

/*!50001 DROP TABLE IF EXISTS `x23_notaservice_vw` */;
/*!50001 DROP VIEW IF EXISTS `x23_notaservice_vw` */;

/*!50001 CREATE ALGORITHM=TEMPTABLE DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_notaservice_vw` AS select `x23_notaservice`.`id` AS `id`,`x23_notaservice`.`jns` AS `jns`,`x23_notaservice`.`noclaim` AS `noclaim`,`x23_notaservice`.`noservis` AS `noservis`,`x23_notaservice`.`nonota` AS `nonota`,`x23_notaservice`.`noantrian` AS `noantrian`,`x23_notaservice`.`nopkb` AS `nopkb`,`x23_notaservice`.`idpelanggan` AS `idpelanggan`,`x23_notaservice`.`tahun` AS `tahun`,`x23_notaservice`.`bulan` AS `bulan`,`x23_notaservice`.`tglnota` AS `tglnota`,`x23_notaservice`.`jammulai` AS `jammulai`,`x23_notaservice`.`jamselesai` AS `jamselesai`,`x23_notaservice`.`nopol` AS `nopol`,`x23_notaservice`.`nomesin` AS `nomesin`,`x23_notaservice`.`norangka` AS `norangka`,`x23_notaservice`.`kodemotor` AS `kodemotor`,`x23_notaservice`.`tipemotor` AS `tipemotor`,`x23_notaservice`.`varianmotor` AS `varianmotor`,`x23_notaservice`.`warnamotor` AS `warnamotor`,`x23_notaservice`.`tahunmotor` AS `tahunmotor`,`x23_notaservice`.`km` AS `km`,`x23_notaservice`.`tglbelimotor` AS `tglbelimotor`,`x23_notaservice`.`idmekanik` AS `idmekanik`,`x23_notaservice`.`grandtotal` AS `grandtotal`,`x23_notaservice`.`status` AS `status`,if((`x23_notaservice`.`status` = '1'),'belum lunas','sudah lunas') AS `ket`,`x23_notaservice`.`iduser` AS `iduser`,`x23_notaservice`.`inputx` AS `inputx`,`x23_notaservice`.`updatex` AS `updatex`,`tbl_pelanggan`.`nama` AS `nama`,`tbl_pelanggan`.`ohc` AS `ohc`,`tbl_pelanggan`.`kadaluarsaohc` AS `kadaluarsaohc`,`tbl_pelanggan`.`notelepon` AS `notelepon`,`tbl_pelanggan`.`noktp` AS `noktp`,`tbl_pelanggan`.`alamat` AS `alamat`,`tbl_pelanggan`.`rt` AS `rt`,`tbl_pelanggan`.`rw` AS `rw`,`tbl_pelanggan`.`kodekab` AS `kodekab`,`tbl_pelanggan`.`namakab` AS `namakab`,`tbl_pelanggan`.`kodekec` AS `kodekec`,`tbl_pelanggan`.`namakec` AS `namakec`,`tbl_pelanggan`.`kodekel` AS `kodekel`,`tbl_pelanggan`.`namakel` AS `namakel`,`tbl_pelanggan`.`kodealamat` AS `kodealamat`,`tbl_pelanggan`.`email` AS `email`,`tbl_pelanggan`.`pekerjaan` AS `pekerjaan` from (`x23_notaservice` join `tbl_pelanggan` on((`x23_notaservice`.`idpelanggan` = `tbl_pelanggan`.`id`))) */;

/*View structure for view x23_opname_det_vw */

/*!50001 DROP TABLE IF EXISTS `x23_opname_det_vw` */;
/*!50001 DROP VIEW IF EXISTS `x23_opname_det_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_opname_det_vw` AS select `x23_opname_det`.`id` AS `id`,`x23_opname_det`.`idstok` AS `idstok`,`x23_opname_det`.`idopname` AS `idopname`,`x23_opname_det`.`idgudang` AS `idgudang`,`x23_gudang`.`gudang` AS `gudang`,`x23_opname_det`.`rak` AS `rak`,`x23_opname_det`.`nonota` AS `nonota`,`x23_opname_det`.`tglnota` AS `tglnota`,`x23_opname_det`.`idbarang` AS `idbarang`,`x23_masterbarang`.`kodebarang` AS `kodebarang`,`x23_masterbarang`.`namabarang` AS `namabarang`,`x23_masterbarang`.`varian` AS `varian`,`x23_opname_det`.`stok` AS `stok`,`x23_opname_det`.`opname` AS `opname`,`x23_opname_det`.`hargabeli` AS `hargabeli`,`x23_opname_det`.`selisih` AS `selisih`,`x23_opname_det`.`totalselisih` AS `totalselisih` from (((`x23_opname_det` join `x23_masterbarang` on((`x23_opname_det`.`idbarang` = `x23_masterbarang`.`id`))) join `x23_opname` on((`x23_opname_det`.`idopname` = `x23_opname`.`id`))) join `x23_gudang` on((`x23_opname_det`.`idgudang` = `x23_gudang`.`id`))) */;

/*View structure for view x23_opname_vw */

/*!50001 DROP TABLE IF EXISTS `x23_opname_vw` */;
/*!50001 DROP VIEW IF EXISTS `x23_opname_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_opname_vw` AS select `x23_opname`.`id` AS `id`,`x23_opname`.`tahun` AS `tahun`,`x23_opname`.`bulan` AS `bulan`,`x23_opname`.`tanggal` AS `tanggal`,`x23_opname`.`idgudang` AS `idgudang`,`x23_gudang`.`gudang` AS `gudang`,`x23_opname`.`totselisih` AS `totselisih`,`x23_opname`.`totjumselisih` AS `totjumselisih`,`x23_opname`.`user` AS `user`,`x23_opname`.`status` AS `status`,`x23_opname`.`inputx` AS `inputx`,`x23_user_vw`.`nama` AS `nama` from ((`x23_opname` join `x23_user_vw` on((`x23_opname`.`user` = `x23_user_vw`.`id`))) join `x23_gudang` on((`x23_opname`.`idgudang` = `x23_gudang`.`id`))) */;

/*View structure for view x23_pindah_det_vw */

/*!50001 DROP TABLE IF EXISTS `x23_pindah_det_vw` */;
/*!50001 DROP VIEW IF EXISTS `x23_pindah_det_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_pindah_det_vw` AS select `x23_pindah_det`.`id` AS `id`,`x23_pindah`.`tanggal` AS `tanggal`,`x23_pindah_det`.`idpindah` AS `idpindah`,`x23_pindah_det`.`nonota` AS `nonota`,`x23_pindah_det`.`dealer1` AS `dealer1`,`x23_pindah_det`.`dealer2` AS `dealer2`,`x23_pindah_det`.`idgudang1` AS `idgudang1`,`x23_stokpart_vw`.`gudang` AS `gudang`,`x23_pindah_det`.`idgudang2` AS `idgudang2`,`x23_pindah_det`.`rak1` AS `rak1`,`x23_pindah_det`.`rak2` AS `rak2`,`x23_pindah_det`.`idbarang` AS `idbarang`,`x23_pindah_det`.`hargabelibersih` AS `hargabelibersih`,`x23_pindah_det`.`qty` AS `qty`,`x23_stokpart_vw`.`kodebarang` AS `kodebarang`,`x23_stokpart_vw`.`namabarang` AS `namabarang`,`x23_stokpart_vw`.`varian` AS `varian`,`x23_stokpart_vw`.`satuan` AS `satuan`,`x23_stokpart_vw`.`idsupplier` AS `idsupplier`,`x23_stokpart_vw`.`stok` AS `stok`,`x23_stokpart_vw`.`inputx` AS `inputx`,`x23_stokpart_vw`.`updatex` AS `updatex` from ((`x23_pindah_det` join `x23_stokpart_vw` on(((`x23_pindah_det`.`idgudang1` = `x23_stokpart_vw`.`idgudang`) and (`x23_pindah_det`.`rak1` = `x23_stokpart_vw`.`rak`) and (`x23_pindah_det`.`nonota` = `x23_stokpart_vw`.`nonota`) and (`x23_pindah_det`.`idbarang` = `x23_stokpart_vw`.`idbarang`)))) join `x23_pindah` on((`x23_pindah_det`.`idpindah` = `x23_pindah`.`id`))) */;

/*View structure for view x23_piutang_vw */

/*!50001 DROP TABLE IF EXISTS `x23_piutang_vw` */;
/*!50001 DROP VIEW IF EXISTS `x23_piutang_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_piutang_vw` AS select `x23_piutang`.`id` AS `id`,`x23_piutang`.`jenis` AS `jenis`,`x23_piutang`.`idkaryawan` AS `idkaryawan`,`x23_piutang`.`nama` AS `nama`,`x23_piutang`.`tgl` AS `tgl`,`x23_piutang`.`jumlah` AS `jumlah`,`x23_piutang`.`ket` AS `ket`,`x23_piutang`.`metodebayar` AS `metodebayar`,`x23_piutang`.`status` AS `status`,`x23_piutang`.`iduser` AS `iduser`,`x23_user_vw`.`nama` AS `namapic`,`x23_piutang`.`inputx` AS `inputx`,`x23_piutang`.`updatex` AS `updatex` from (`x23_piutang` join `x23_user_vw` on((`x23_piutang`.`iduser` = `x23_user_vw`.`id`))) */;

/*View structure for view x23_potkompensasi_vw */

/*!50001 DROP TABLE IF EXISTS `x23_potkompensasi_vw` */;
/*!50001 DROP VIEW IF EXISTS `x23_potkompensasi_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_potkompensasi_vw` AS select `x23_potkompensasi`.`id` AS `id`,`x23_potkompensasi`.`idkaryawan` AS `idkaryawan`,`x23_potkompensasi`.`nama` AS `nama`,`x23_potkompensasi`.`tgl` AS `tgl`,`x23_potkompensasi`.`jumlah` AS `jumlah`,`x23_potkompensasi`.`ket` AS `ket`,`x23_potkompensasi`.`metodebayar` AS `metodebayar`,`x23_potkompensasi`.`iduser` AS `iduser`,`x23_potkompensasi`.`status` AS `status`,`x23_potkompensasi`.`potkompensasi` AS `potkompensasi`,`x23_potkompensasi`.`inputx` AS `inputx`,`x23_potkompensasi`.`updatex` AS `updatex`,`x23_user_vw`.`nama` AS `namapic` from (`x23_potkompensasi` join `x23_user_vw` on((`x23_potkompensasi`.`iduser` = `x23_user_vw`.`id`))) */;

/*View structure for view x23_returbeli_det_vw */

/*!50001 DROP TABLE IF EXISTS `x23_returbeli_det_vw` */;
/*!50001 DROP VIEW IF EXISTS `x23_returbeli_det_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_returbeli_det_vw` AS select `x23_returbeli_det`.`id` AS `id`,`x23_returbeli_det`.`noretur` AS `noretur`,`x23_returbeli_det`.`tanggal` AS `tanggal`,`x23_returbeli_det`.`nonota` AS `nonota`,`x23_returbeli_det`.`idbarang` AS `idbarang`,`x23_masterbarang`.`kodebarang` AS `kodebarang`,`x23_masterbarang`.`namabarang` AS `namabarang`,`x23_masterbarang`.`varian` AS `varian`,`x23_masterbarang`.`satuan` AS `satuan`,`x23_masterbarang`.`idsupplier` AS `idsupplier`,`x23_returbeli_det`.`hargabelibersih` AS `hargabelibersih`,`x23_returbeli_det`.`qtykeluar` AS `qtykeluar`,`x23_returbeli_det`.`totalkeluar` AS `totalkeluar`,`x23_returbeli_det`.`qty` AS `qty`,`x23_returbeli_det`.`total` AS `total`,`x23_returbeli_det`.`status` AS `status`,`x23_returbeli_det`.`tglretur` AS `tglretur`,`x23_returbeli_det`.`ket` AS `ket`,`x23_returbeli_det`.`idgudang` AS `idgudang`,`x23_gudang`.`gudang` AS `gudang`,`x23_returbeli_det`.`rak` AS `rak` from ((`x23_returbeli_det` join `x23_masterbarang` on((`x23_returbeli_det`.`idbarang` = `x23_masterbarang`.`id`))) join `x23_gudang` on((`x23_returbeli_det`.`idgudang` = `x23_gudang`.`id`))) */;

/*View structure for view x23_returbeli_vw */

/*!50001 DROP TABLE IF EXISTS `x23_returbeli_vw` */;
/*!50001 DROP VIEW IF EXISTS `x23_returbeli_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_returbeli_vw` AS select `x23_returbeli`.`id` AS `id`,`x23_returbeli`.`noretur` AS `noretur`,`x23_returbeli`.`nonota` AS `nonota`,`x23_returbeli`.`nopo` AS `nopo`,`x23_returbeli`.`tahun` AS `tahun`,`x23_returbeli`.`bulan` AS `bulan`,`x23_returbeli`.`tanggal` AS `tanggal`,`x23_returbeli`.`user` AS `user`,`x23_returbeli`.`idgdg` AS `idgdg`,`x23_returbeli`.`idsupplier` AS `idsupplier`,`x23_returbeli`.`status` AS `status`,`x23_returbeli`.`inputx` AS `inputx`,`x23_returbeli`.`updatex` AS `updatex`,`x23_notabeli`.`tglnota` AS `tglnota`,`x23_notabeli`.`tglpo` AS `tglpo`,`x23_notabeli`.`totalqty` AS `totalqty`,`x23_notabeli`.`gtbayar` AS `gtbayar`,`x23_supplier`.`nama` AS `nama` from ((`x23_notabeli` join `x23_returbeli` on((`x23_notabeli`.`nopo` = `x23_returbeli`.`nopo`))) join `x23_supplier` on((`x23_returbeli`.`idsupplier` = `x23_supplier`.`id`))) */;

/*View structure for view x23_returjual_det_vw */

/*!50001 DROP TABLE IF EXISTS `x23_returjual_det_vw` */;
/*!50001 DROP VIEW IF EXISTS `x23_returjual_det_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_returjual_det_vw` AS select `x23_returjual_det`.`id` AS `id`,`x23_returjual_det`.`notabeli` AS `notabeli`,`x23_returjual_det`.`noreturjual` AS `noreturjual`,`x23_returjual_det`.`nonotajual` AS `nonotajual`,`x23_returjual_det`.`tglnota` AS `tglnota`,`x23_returjual_det`.`idbarang` AS `idbarang`,`x23_returjual_det`.`hargabelibersih` AS `hargabelibersih`,`x23_returjual_det`.`hargajual` AS `hargajual`,`x23_returjual_det`.`diskon` AS `diskon`,`x23_returjual_det`.`hargajualbersih` AS `hargajualbersih`,`x23_returjual_det`.`qty` AS `qty`,`x23_returjual_det`.`totdiskon` AS `totdiskon`,`x23_returjual_det`.`tothargabelibersih` AS `tothargabelibersih`,`x23_returjual_det`.`total` AS `total`,`x23_returjual_det`.`idgudang` AS `idgudang`,`x23_returjual_det`.`rak` AS `rak`,`x23_returjual_det`.`tgltagihan` AS `tgltagihan`,`x23_returjual_det`.`idtagihan` AS `idtagihan`,`x23_returjual_det`.`tglbayarkpb` AS `tglbayarkpb`,`x23_returjual_det`.`jumlahbayarkpb` AS `jumlahbayarkpb`,`x23_returjual_det`.`idbayar` AS `idbayar`,`x23_masterbarang`.`kodebarang` AS `kodebarang`,`x23_masterbarang`.`namabarang` AS `namabarang`,`x23_masterbarang`.`varian` AS `varian`,`x23_gudang`.`gudang` AS `gudang` from ((`x23_returjual_det` join `x23_masterbarang` on((`x23_returjual_det`.`idbarang` = `x23_masterbarang`.`id`))) join `x23_gudang` on((`x23_returjual_det`.`idgudang` = `x23_gudang`.`id`))) */;

/*View structure for view x23_returjual_vw */

/*!50001 DROP TABLE IF EXISTS `x23_returjual_vw` */;
/*!50001 DROP VIEW IF EXISTS `x23_returjual_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_returjual_vw` AS select `x23_returjual`.`id` AS `id`,`x23_returjual`.`tahun` AS `tahun`,`x23_returjual`.`bulan` AS `bulan`,`x23_returjual`.`tanggal` AS `tanggal`,`x23_returjual`.`noreturjual` AS `noreturjual`,`x23_returjual`.`nonotajual` AS `nonotajual`,`x23_returjual`.`qtyretur` AS `qtyretur`,`x23_returjual`.`jumlah` AS `jumlah`,`x23_returjual`.`iduser` AS `iduser`,`x23_returjual`.`inputx` AS `inputx`,`x23_returjual`.`updatex` AS `updatex`,`x23_notajual_vw`.`idpelanggan` AS `idpelanggan`,`x23_notajual_vw`.`tglnota` AS `tglnota`,`x23_notajual_vw`.`nama` AS `nama`,`x23_notajual_vw`.`ohc` AS `ohc` from (`x23_returjual` join `x23_notajual_vw` on((`x23_returjual`.`nonotajual` = `x23_notajual_vw`.`nonota`))) */;

/*View structure for view x23_servis_th */

/*!50001 DROP TABLE IF EXISTS `x23_servis_th` */;
/*!50001 DROP VIEW IF EXISTS `x23_servis_th` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_servis_th` AS select `x23_notaservice_det`.`id` AS `id`,`x23_notaservice_det`.`nonota` AS `nonota`,`x23_notaservice_det`.`nopkb` AS `nopkb`,`x23_notaservice_det`.`tahun` AS `tahun`,`x23_notaservice_det`.`bulan` AS `bulan`,`x23_notaservice_det`.`tglnota` AS `tglnota`,`x23_notaservice_det`.`kodepaket` AS `kodepaket`,`x23_notaservice_det`.`idjasa` AS `idjasa`,`x23_notaservice_det`.`tarifasli` AS `tarifasli`,`x23_notaservice_det`.`diskon` AS `diskon`,`x23_notaservice_det`.`tarif` AS `tarif`,(`x23_notaservice_det`.`tarif` + (`x23_notaservice_det`.`tarif` * 0.1)) AS `tarifppn`,`x23_notaservice_det`.`tarifkpb` AS `tarifkpb`,`x23_notaservice_det`.`tgltagihan` AS `tgltagihan`,`x23_notaservice_det`.`idtagihan` AS `idtagihan`,`x23_notaservice_det`.`tglbayarkpb` AS `tglbayarkpb`,`x23_notaservice_det`.`jumlahbayarkpb` AS `jumlahbayarkpb`,`x23_notaservice_det`.`idbayar` AS `idbayar`,`x23_notaservice_det`.`statusbayar` AS `statusbayar`,`x23_notaservice_det`.`statusclaim` AS `statusclaim`,`x23_kwitansi`.`jnskwitansi` AS `jnskwitansi`,`x23_kwitansi`.`nomor` AS `nomor`,`x23_kwitansi`.`tanggal` AS `tanggal`,`x23_kwitansi`.`status` AS `status` from (`x23_notaservice_det` join `x23_kwitansi` on((`x23_notaservice_det`.`nonota` = `x23_kwitansi`.`nomor`))) where ((`x23_kwitansi`.`status` = '1') and (`x23_kwitansi`.`jnskwitansi` = 'servis')) */;

/*View structure for view x23_stokpart_group_vw */

/*!50001 DROP TABLE IF EXISTS `x23_stokpart_group_vw` */;
/*!50001 DROP VIEW IF EXISTS `x23_stokpart_group_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_stokpart_group_vw` AS select `x23_stokpart`.`id` AS `id`,`x23_stokpart`.`idgudang` AS `idgudang`,`x23_gudang`.`gudang` AS `gudang`,`x23_stokpart`.`rak` AS `rak`,`x23_stokpart`.`nonota` AS `nonota`,`x23_stokpart`.`idbarang` AS `idbarang`,`x23_masterbarang`.`kodebarang` AS `kodebarang`,`x23_masterbarang`.`namabarang` AS `namabarang`,`x23_masterbarang`.`varian` AS `varian`,`x23_masterbarang`.`satuan` AS `satuan`,`x23_masterbarang`.`idsupplier` AS `idsupplier`,`x23_stokpart`.`hargabelibersih` AS `hargabelibersih`,`x23_stokpart`.`hargajual` AS `hargajual`,`x23_stokpart`.`hargajual2` AS `hargajual2`,`x23_stokpart`.`inputx` AS `inputx`,`x23_stokpart`.`updatex` AS `updatex`,sum(`x23_stokpart`.`stok`) AS `totalstok` from ((`x23_stokpart` join `x23_masterbarang` on((`x23_stokpart`.`idbarang` = `x23_masterbarang`.`id`))) join `x23_gudang` on((`x23_stokpart`.`idgudang` = `x23_gudang`.`id`))) where ((`x23_stokpart`.`hargajual` <> '') and (`x23_stokpart`.`status` = '1') and (`x23_stokpart`.`dk` = '0')) group by `x23_stokpart`.`idgudang`,`x23_stokpart`.`rak`,`x23_stokpart`.`idbarang`,`x23_stokpart`.`nonota` */;

/*View structure for view x23_stokpart_group_vw2 */

/*!50001 DROP TABLE IF EXISTS `x23_stokpart_group_vw2` */;
/*!50001 DROP VIEW IF EXISTS `x23_stokpart_group_vw2` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_stokpart_group_vw2` AS select `x23_stokpart`.`id` AS `id`,`x23_stokpart`.`idgudang` AS `idgudang`,`x23_gudang`.`gudang` AS `gudang`,`x23_stokpart`.`rak` AS `rak`,`x23_stokpart`.`nonota` AS `nonota`,`x23_stokpart`.`idbarang` AS `idbarang`,`x23_masterbarang`.`kodebarang` AS `kodebarang`,`x23_masterbarang`.`namabarang` AS `namabarang`,`x23_masterbarang`.`varian` AS `varian`,`x23_masterbarang`.`satuan` AS `satuan`,`x23_masterbarang`.`idsupplier` AS `idsupplier`,`x23_stokpart`.`hargabelibersih` AS `hargabelibersih`,`x23_stokpart`.`hargajual` AS `hargajual`,`x23_stokpart`.`hargajual2` AS `hargajual2`,`x23_stokpart`.`inputx` AS `inputx`,`x23_stokpart`.`updatex` AS `updatex`,sum(`x23_stokpart`.`stok`) AS `totalstok` from ((`x23_stokpart` join `x23_masterbarang` on((`x23_stokpart`.`idbarang` = `x23_masterbarang`.`id`))) join `x23_gudang` on((`x23_stokpart`.`idgudang` = `x23_gudang`.`id`))) where (((`x23_stokpart`.`hargajual` <> '') and (substr(`x23_stokpart`.`nonota`,1,2) = 'NB') and (`x23_stokpart`.`status` = '1') and (`x23_stokpart`.`dk` = '0')) or ((`x23_stokpart`.`hargajual` <> '') and (substr(`x23_stokpart`.`nonota`,1,2) = 'NC') and (`x23_stokpart`.`status` = '1') and (`x23_stokpart`.`dk` = '0') and (`x23_stokpart`.`hargajual` <> '0'))) group by `x23_stokpart`.`idgudang`,`x23_stokpart`.`rak`,`x23_stokpart`.`idbarang`,`x23_stokpart`.`hargajual` */;

/*View structure for view x23_stokpart_gt_vw */

/*!50001 DROP TABLE IF EXISTS `x23_stokpart_gt_vw` */;
/*!50001 DROP VIEW IF EXISTS `x23_stokpart_gt_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_stokpart_gt_vw` AS select `x23_stokpart`.`nonota` AS `nonota`,`x23_stokpart`.`hargabelibersih` AS `hargabelibersih`,`x23_stokpart`.`stok` AS `stok`,(`x23_stokpart`.`hargabelibersih` * `x23_stokpart`.`stok`) AS `tot`,`x23_stokpart`.`status` AS `status` from `x23_stokpart` */;

/*View structure for view x23_stokpart_opname_vw */

/*!50001 DROP TABLE IF EXISTS `x23_stokpart_opname_vw` */;
/*!50001 DROP VIEW IF EXISTS `x23_stokpart_opname_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_stokpart_opname_vw` AS select `x23_stokpart`.`id` AS `id`,`x23_stokpart`.`idgudang` AS `idgudang`,`x23_gudang`.`gudang` AS `gudang`,`x23_stokpart`.`rak` AS `rak`,`x23_stokpart`.`nonota` AS `nonota`,`x23_notabeli`.`tglnota` AS `tglnota`,`x23_stokpart`.`idbarang` AS `idbarang`,`x23_masterbarang`.`kodebarang` AS `kodebarang`,`x23_masterbarang`.`namabarang` AS `namabarang`,`x23_masterbarang`.`varian` AS `varian`,`x23_masterbarang`.`satuan` AS `satuan`,`x23_masterbarang`.`idsupplier` AS `idsupplier`,`x23_stokpart`.`hargabelibersih` AS `hargabelibersih`,`x23_stokpart`.`hargajual` AS `hargajual`,`x23_stokpart`.`hargajual2` AS `hargajual2`,`x23_stokpart`.`inputx` AS `inputx`,`x23_stokpart`.`updatex` AS `updatex`,`x23_stokpart`.`stok` AS `totalstok` from (((`x23_stokpart` join `x23_masterbarang` on((`x23_stokpart`.`idbarang` = `x23_masterbarang`.`id`))) join `x23_notabeli` on((`x23_stokpart`.`nonota` = `x23_notabeli`.`nonota`))) join `x23_gudang` on((`x23_stokpart`.`idgudang` = `x23_gudang`.`id`))) where ((`x23_stokpart`.`hargajual` <> '') and (`x23_stokpart`.`status` = '1') and (`x23_stokpart`.`dk` = '0')) */;

/*View structure for view x23_stokpart_vw */

/*!50001 DROP TABLE IF EXISTS `x23_stokpart_vw` */;
/*!50001 DROP VIEW IF EXISTS `x23_stokpart_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_stokpart_vw` AS select `x23_stokpart`.`id` AS `id`,`x23_stokpart`.`idgudang` AS `idgudang`,`x23_gudang`.`gudang` AS `gudang`,`x23_stokpart`.`rak` AS `rak`,`x23_stokpart`.`nonota` AS `nonota`,`x23_stokpart`.`idbarang` AS `idbarang`,`x23_masterbarang`.`kodebarang` AS `kodebarang`,`x23_masterbarang`.`namabarang` AS `namabarang`,`x23_masterbarang`.`varian` AS `varian`,`x23_masterbarang`.`satuan` AS `satuan`,`x23_masterbarang`.`idsupplier` AS `idsupplier`,`x23_notabeli`.`tglnota` AS `tglnota`,`x23_stokpart`.`hargabelibersih` AS `hargabelibersih`,`x23_stokpart`.`hargajual` AS `hargajual`,`x23_stokpart`.`hargajual2` AS `hargajual2`,`x23_stokpart`.`stok` AS `stok`,`x23_stokpart`.`status` AS `status`,`x23_stokpart`.`dk` AS `dk`,`x23_stokpart`.`inputx` AS `inputx`,`x23_stokpart`.`updatex` AS `updatex` from (((`x23_stokpart` join `x23_masterbarang` on((`x23_stokpart`.`idbarang` = `x23_masterbarang`.`id`))) join `x23_gudang` on((`x23_stokpart`.`idgudang` = `x23_gudang`.`id`))) join `x23_notabeli` on((`x23_stokpart`.`nonota` = `x23_notabeli`.`nonota`))) */;

/*View structure for view x23_tarifjasa2_vw */

/*!50001 DROP TABLE IF EXISTS `x23_tarifjasa2_vw` */;
/*!50001 DROP VIEW IF EXISTS `x23_tarifjasa2_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_tarifjasa2_vw` AS select `x23_tarifjasa2`.`id` AS `id`,`x23_tarifjasa2`.`idmekanik` AS `idmekanik`,`x23_tarifjasa2`.`jnsjasa` AS `jnsjasa`,`x23_tarifjasa2`.`idjasa` AS `idjasa`,`x23_tarifjasa2`.`kodepaket` AS `kodepaket`,`x23_tarifjasa2`.`tarif` AS `tarif`,`x23_karyawan`.`nik` AS `nik`,`x23_karyawan`.`nama` AS `nama`,`x23_karyawan`.`posisi` AS `posisi`,`x23_karyawan`.`pangkat` AS `pangkat` from (`x23_tarifjasa2` join `x23_karyawan` on((`x23_tarifjasa2`.`idmekanik` = `x23_karyawan`.`id`))) */;

/*View structure for view x23_tarifjasa_vw */

/*!50001 DROP TABLE IF EXISTS `x23_tarifjasa_vw` */;
/*!50001 DROP VIEW IF EXISTS `x23_tarifjasa_vw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_tarifjasa_vw` AS select `x23_tarifjasa`.`id` AS `id`,`x23_tarifjasa`.`idjasa` AS `idjasa`,`x23_tarifjasa`.`pangkat` AS `pangkat`,`x23_tarifjasa`.`tarif` AS `tarif`,`x23_masterjasa`.`kodejasa` AS `kodejasa`,`x23_masterjasa`.`namajasa` AS `namajasa` from (`x23_tarifjasa` join `x23_masterjasa` on((`x23_tarifjasa`.`idjasa` = `x23_masterjasa`.`id`))) */;

/*View structure for view x23_temp_pindah_det_vw */

/*!50001 DROP TABLE IF EXISTS `x23_temp_pindah_det_vw` */;
/*!50001 DROP VIEW IF EXISTS `x23_temp_pindah_det_vw` */;

/*!50001 CREATE ALGORITHM=TEMPTABLE DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_temp_pindah_det_vw` AS select `x23_temp_pindah_det`.`id` AS `id`,`x23_temp_pindah_det`.`dealer1` AS `dealer1`,`x23_temp_pindah_det`.`dealer2` AS `dealer2`,`x23_temp_pindah_det`.`idgudang1` AS `idgudang1`,`x23_temp_pindah_det`.`idgudang2` AS `idgudang2`,`x23_temp_pindah_det`.`rak1` AS `rak1`,`x23_temp_pindah_det`.`rak2` AS `rak2`,`x23_temp_pindah_det`.`idbarang` AS `idbarang`,`x23_temp_pindah_det`.`qty` AS `qty`,`x23_stokpart_vw`.`gudang` AS `gudang`,`x23_stokpart_vw`.`nonota` AS `nonota`,`x23_stokpart_vw`.`tglnota` AS `tglnota`,`x23_stokpart_vw`.`kodebarang` AS `kodebarang`,`x23_stokpart_vw`.`namabarang` AS `namabarang`,`x23_stokpart_vw`.`varian` AS `varian`,`x23_stokpart_vw`.`satuan` AS `satuan`,`x23_stokpart_vw`.`idsupplier` AS `idsupplier`,`x23_stokpart_vw`.`hargabelibersih` AS `hargabelibersih`,`x23_stokpart_vw`.`stok` AS `stok`,`x23_stokpart_vw`.`inputx` AS `inputx`,`x23_stokpart_vw`.`updatex` AS `updatex` from (`x23_temp_pindah_det` join `x23_stokpart_vw` on(((`x23_temp_pindah_det`.`idgudang1` = `x23_stokpart_vw`.`idgudang`) and (`x23_temp_pindah_det`.`nonota` = `x23_stokpart_vw`.`nonota`) and (`x23_temp_pindah_det`.`rak1` = `x23_stokpart_vw`.`rak`) and (`x23_temp_pindah_det`.`idbarang` = `x23_stokpart_vw`.`idbarang`)))) */;

/*View structure for view x23_user_vw */

/*!50001 DROP TABLE IF EXISTS `x23_user_vw` */;
/*!50001 DROP VIEW IF EXISTS `x23_user_vw` */;

/*!50001 CREATE ALGORITHM=TEMPTABLE DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `x23_user_vw` AS select `x23_user`.`id` AS `id`,`x23_user`.`id_karyawan` AS `id_karyawan`,`x23_user`.`user` AS `user`,`x23_user`.`pass` AS `pass`,`x23_user`.`hakakses` AS `hakakses`,`x23_karyawan_vw`.`nama` AS `nama`,`x23_karyawan_vw`.`status` AS `status`,`x23_karyawan_vw`.`nik` AS `nik`,`x23_karyawan_vw`.`id_posisi` AS `id_posisi`,`x23_karyawan_vw`.`posisi` AS `posisi` from (`x23_user` join `x23_karyawan_vw` on((`x23_user`.`id_karyawan` = `x23_karyawan_vw`.`id`))) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;