/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.4.32-MariaDB : Database - u123975286_laserbygurr
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`u123975286_laserbygurr` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `u123975286_laserbygurr`;

/*Table structure for table `enquiries` */

DROP TABLE IF EXISTS `enquiries`;

CREATE TABLE `enquiries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `looking_for` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `treatment_for` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `enquiries` */

insert  into `enquiries`(`id`,`name`,`date`,`looking_for`,`email`,`treatment_for`,`location`,`created_at`,`updated_at`) values
(1,'avinash','2024-12-21','test','avinash@gmail.com','testing','jalandhar','2024-12-21 13:59:46','2024-12-21 13:59:50'),
(2,'shobit','2024-12-21',NULL,'shobit@gmail.com',NULL,'jalandhar','2024-12-21 09:13:15','2024-12-21 09:13:15'),
(3,'lakhvinder','2024-12-21',NULL,'lakhvinder@gmail.com',NULL,'jalandhar','2024-12-21 09:27:28','2024-12-21 09:27:28'),
(4,'param','2024-12-21',NULL,'param@gmail.com',NULL,'jalandhar','2024-12-21 09:29:51','2024-12-21 09:29:51'),
(5,'ashok','2024-12-21',NULL,'lakhvinder01@gmail.com',NULL,'Canada','2024-12-21 11:59:12','2024-12-21 11:59:12'),
(6,'jatin','2024-12-21',NULL,'jatin@gmail.com',NULL,'maxico','2024-12-21 12:15:20','2024-12-21 12:15:20'),
(7,'ejkjot','2024-12-21',NULL,'ekjot@gmail.com',NULL,'canada','2024-12-21 12:25:41','2024-12-21 12:25:41'),
(8,'kohit','2024-12-21',NULL,'kohit@gmail.com',NULL,'mayami','2024-12-21 13:43:38','2024-12-21 13:43:38'),
(9,'shrishti','2024-12-21',NULL,'srishti@gmail.com',NULL,'main','2024-12-21 13:53:42','2024-12-21 13:53:42'),
(10,'mohit','2025-08-09',NULL,'mohit@gmail.com',NULL,'canada','2024-12-23 08:35:46','2024-12-23 08:35:46'),
(11,'test123','2024-12-23',NULL,'avinash@gmail.com',NULL,'canada','2024-12-23 09:03:54','2024-12-23 09:03:54');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_reset_tokens_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2019_12_14_000001_create_personal_access_tokens_table',1);

/*Table structure for table `password_reset_tokens` */

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_reset_tokens` */

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `services` */

DROP TABLE IF EXISTS `services`;

CREATE TABLE `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_laser_option` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `services` */

insert  into `services`(`id`,`name`,`duration`,`price`,`description`,`image`,`is_laser_option`,`created_at`,`updated_at`) values
(1,'Microneedling','60 minutes',276.00,'Transform your skin with our Microneedling treatment, designed to boost collagen production and improve skin texture. This minimally invasive procedure helps reduce fine lines, acne scars, and discoloration, leaving your skin smoother, firmer, and more youthful','service_1735186623.jpg',0,'2024-12-26 10:37:08','2024-12-26 05:07:08'),
(5,'Hydra facial','45 mins',120.00,'Revitalize your skin with our Hydra Facial, a luxurious treatment that deeply cleanses, exfoliates, and hydrates. Perfect for all skin types, it helps reduce fine lines, unclog pores, and restore your skin\'s natural glow. Pamper yourself and experience a smoother, healthier complexion today....','service_1735185226.jpg',0,'2024-12-26 03:53:46','2024-12-26 03:53:46'),
(6,'Hollywood facial','60 mins',180.00,'Experience the ultimate celebrity glow with our Hollywood Facial. This advanced treatment combines exfoliation, deep cleansing, and rejuvenation to leave your skin radiant, smooth, and flawless. Ideal for special occasions or everyday luxury, it’s your secret to red-carpet-ready skin....','service_1735185272.jpg',0,'2024-12-26 03:54:32','2024-12-26 03:54:32'),
(7,'Full body head to toe','60 minutes',300.00,'Experience the ultimate celebrity glow with our Hollywood Facial. This advanced treatment combines exfoliation, deep cleansing, and rejuvenation to leave your skin radiant, smooth, and flawless. Ideal for special occasions or everyday luxury, it’s your secret to red-carpet-ready skin....','service_1735186158.jpg',1,'2024-12-26 09:39:18','2024-12-26 04:09:18'),
(8,'Full face includes','60 minutes',400.00,'Full face includes Experience the ultimate celebrity glow with our Hollywood Facial. This advanced treatment combines exfoliation, deep cleansing, and rejuvenation to leave your skin radiant, smooth, and flawless. Ideal for special occasions or everyday luxury, it’s your secret to red-carpet-ready skin....','service_1735185339.jpg',1,'2024-12-26 03:55:39','2024-12-26 03:55:39'),
(9,'Cheeks & Chin30','60 minutes',30.00,'Cheeks & Chin30','service_1735188583.jpg',1,'2024-12-26 10:19:43','2024-12-26 04:49:43');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`) values
(1,'Sunny','sunny@gmail.com',NULL,'$2y$10$/xh.Xj9rfkYKZn/JKyj8K.Cai9y7VItC0GviEcMre6gLJpRSQuYjC',NULL,'2024-12-21 07:56:51','2024-12-21 08:24:32');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
