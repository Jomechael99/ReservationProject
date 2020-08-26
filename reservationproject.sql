/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 5.7.24 : Database - reservation_project
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`reservation_project` /*!40100 DEFAULT CHARACTER SET utf32 */;

USE `reservation_project`;

/*Table structure for table `department_libraries` */

DROP TABLE IF EXISTS `department_libraries`;

CREATE TABLE `department_libraries` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf32;

/*Data for the table `department_libraries` */

insert  into `department_libraries`(`id`,`department_name`) values 
(1,'College of Liberal Arts, Criminology and Education'),
(2,'College of Business Administration'),
(3,'College of Computer Studies and Engineering'),
(4,'College of Nursing and Health Sciences'),
(5,'College of Hospitality and Tourism Management'),
(6,'Advocates'),
(7,'Arts');

/*Table structure for table `division_libraries` */

DROP TABLE IF EXISTS `division_libraries`;

CREATE TABLE `division_libraries` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `division_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf32;

/*Data for the table `division_libraries` */

insert  into `division_libraries`(`id`,`division_name`) values 
(1,'GRADUATE SCHOOL DIVISION'),
(2,'LAW SCHOOL DIVISION'),
(3,'SENIOR HIGH SCHOOL DIVISION'),
(4,'JUNIOR HIGH SCHOOL DIVISION'),
(5,'ELEMENTARY SCHOOL DIVISION'),
(6,'COLLEGE SCHOOL DIVISION'),
(7,'OTHERS…');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2019_08_19_000000_create_failed_jobs_table',1),
(3,'2020_07_04_105148_place_libraries',2);

/*Table structure for table `office_libraries` */

DROP TABLE IF EXISTS `office_libraries`;

CREATE TABLE `office_libraries` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `office_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf32;

/*Data for the table `office_libraries` */

insert  into `office_libraries`(`id`,`office_name`) values 
(1,'STUDENT DEVELOPMENT OFFICE'),
(2,'GUIDANCE & TESTING OFFICE'),
(3,'ACCOUNTING OFFICE'),
(4,'MARKETING AND COMMUNICATIONS OFFICE'),
(5,'INFORMATION TECHNOLOGY OFFICE'),
(6,'ADMINISTRATIVE AND HUMAN RESOURCE OFFICE'),
(7,'ENGINEERING & MAINTENANCE OFFICE'),
(8,'BUDGET & PAYROLL OFFICE'),
(9,'NGINEERING & MAINTENANCE OFFICE'),
(10,'TREASURY OFFICE'),
(11,'PURCHASING OFFICE'),
(12,'OTHERS….');

/*Table structure for table `organization_libraries` */

DROP TABLE IF EXISTS `organization_libraries`;

CREATE TABLE `organization_libraries` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `organization_name` varchar(255) NOT NULL,
  `organization_type` int(10) NOT NULL,
  `deparment_fk_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf32;

/*Data for the table `organization_libraries` */

insert  into `organization_libraries`(`id`,`organization_name`,`organization_type`,`deparment_fk_id`) values 
(1,'Association of Students of History (ASH)',1,1),
(2,'Criminal Justice Students Society (CJSS)',1,1),
(3,'Liberal Arts Students Organization (LASO)',1,1),
(4,'Mathematics Society (MATHSOC)',1,1),
(5,'Young, Educators Society (YES)',1,1),
(6,'Junior Finance and Economics Society (JFINECS)',1,2),
(7,'Junior Philippine Institute of Accountants (JPIA)',1,2),
(8,'Management Society (MANSOC)',1,2),
(9,'Supply Management Society (SMS)',1,2),
(10,'Young Marketers Association (YMA)',1,2),
(11,'Institute of Computer Engineers of the Philippines Student Edition National Capital Region José Rizal University Chapter (ICpEP.SE NCR JRU Chapter)',1,3),
(12,'Computer Society (COMSOC)',1,3),
(13,'Electronics Engineering League (ECEL)',1,3),
(14,'Association of Tourism Management Students (ATOMS)',1,4),
(15,'Hospitality, Hotelier and Restaurateur Society (HHRS)',1,4),
(16,'Nursing Society (NURSOC)',1,5),
(17,'José Rizal University Book Buddies',2,6),
(18,'Young Rizalian Servant Leaders (YRSL)',2,6),
(19,'Golden Z Club',2,6),
(20,'International Students Association (ISA)',2,6),
(21,'José Rizal University Chorale',2,7),
(22,'José Rizal University Dance Troupe',2,7),
(23,'Teatro Rizal',2,7),
(24,'Junior Photographic Editors and Graphic Artists (JPEG)',2,7);

/*Table structure for table `place_libraries` */

DROP TABLE IF EXISTS `place_libraries`;

CREATE TABLE `place_libraries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `place_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `place_libraries` */

insert  into `place_libraries`(`id`,`place_name`) values 
(1,'AUDITORIUM'),
(2,'QUADRANGLE'),
(3,'UNIVERSITY GYM'),
(4,'STUDENT LOUNGE'),
(5,'TOWER LOUNGE'),
(6,'REVIEW CENTER (G-36)'),
(7,'OTHERS');

/*Table structure for table `reservation_approver_status` */

DROP TABLE IF EXISTS `reservation_approver_status`;

CREATE TABLE `reservation_approver_status` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `reservation_fk_id` int(10) NOT NULL,
  `approver_status_sdo_higher` int(10) NOT NULL DEFAULT '0',
  `approver_status_division` int(10) NOT NULL DEFAULT '0',
  `approver_status_emo` int(10) NOT NULL DEFAULT '0',
  `approver_status_emo_supervisor` int(10) NOT NULL DEFAULT '0',
  `approver_status_janitor_supervisor` int(10) NOT NULL DEFAULT '0',
  `approver_status_guard` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf32;

/*Data for the table `reservation_approver_status` */

insert  into `reservation_approver_status`(`id`,`reservation_fk_id`,`approver_status_sdo_higher`,`approver_status_division`,`approver_status_emo`,`approver_status_emo_supervisor`,`approver_status_janitor_supervisor`,`approver_status_guard`) values 
(1,1,0,0,0,0,0,0);

/*Table structure for table `reservation_details` */

DROP TABLE IF EXISTS `reservation_details`;

CREATE TABLE `reservation_details` (
  `reservation_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `facility_id` int(10) NOT NULL,
  `reservation_date` date NOT NULL,
  `reservation_start` datetime NOT NULL,
  `reservation_end` datetime NOT NULL,
  `facility_others` varchar(255) DEFAULT NULL,
  `emo_date_update` datetime DEFAULT NULL,
  `reservation_date_applied` date DEFAULT NULL,
  PRIMARY KEY (`reservation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `reservation_details` */

insert  into `reservation_details`(`reservation_id`,`user_id`,`facility_id`,`reservation_date`,`reservation_start`,`reservation_end`,`facility_others`,`emo_date_update`,`reservation_date_applied`) values 
(1,1,1,'2020-07-19','2020-07-19 03:44:00','2020-07-19 04:44:00','',NULL,NULL);

/*Table structure for table `reservation_details_others` */

DROP TABLE IF EXISTS `reservation_details_others`;

CREATE TABLE `reservation_details_others` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `reservation_others_details` varchar(255) NOT NULL,
  `reservation_fk_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `reservation_details_others` */

/*Table structure for table `reservation_emo_status` */

DROP TABLE IF EXISTS `reservation_emo_status`;

CREATE TABLE `reservation_emo_status` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `reservation_fk_id` int(10) NOT NULL,
  `reservation_received_by` varchar(255) CHARACTER SET latin1 NOT NULL,
  `reservation_status` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf32;

/*Data for the table `reservation_emo_status` */

insert  into `reservation_emo_status`(`id`,`reservation_fk_id`,`reservation_received_by`,`reservation_status`) values 
(1,1,'',0);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organization` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `division` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `office` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` int(10) NOT NULL,
  `student_type` int(10) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `approver` int(10) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`firstname`,`lastname`,`organization`,`division`,`office`,`department`,`email_address`,`user_type`,`student_type`,`username`,`password`,`approver`,`remember_token`,`created_at`,`updated_at`) values 
(8,'Jomechael','Alasagas','2','2','1','1','jomechaelalasagas@gmail.com',2,2,'asdasdasd','$2y$10$Rsfc.NIfWJLRRVrRLFIeouasSt1IXT48bGvpexCmnl01uHrkheT12',0,NULL,'2020-08-26 17:50:57','2020-08-26 17:50:57');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
