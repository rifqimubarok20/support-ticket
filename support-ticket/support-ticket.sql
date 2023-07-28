-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for document-management
CREATE DATABASE IF NOT EXISTS `document-management` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `document-management`;

-- Dumping structure for table document-management.client
CREATE TABLE IF NOT EXISTS `client` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table document-management.client: ~2 rows (approximately)
INSERT INTO `client` (`id`, `name`, `address`, `contact`, `image`, `created_at`, `updated_at`) VALUES
	(1, 'Bank A', 'Bandung', '121323425', NULL, NULL, NULL),
	(2, 'Bank B', 'Jawa Tengah', '122135443', NULL, NULL, NULL);

-- Dumping structure for table document-management.documents
CREATE TABLE IF NOT EXISTS `documents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table document-management.documents: ~5 rows (approximately)
INSERT INTO `documents` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'BPP', NULL, NULL),
	(2, 'FSD', NULL, NULL),
	(3, 'BRD', NULL, NULL),
	(4, 'UAT Script', NULL, NULL),
	(5, 'BAST', NULL, NULL);

-- Dumping structure for table document-management.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table document-management.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table document-management.kategori
CREATE TABLE IF NOT EXISTS `kategori` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table document-management.kategori: ~4 rows (approximately)
INSERT INTO `kategori` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Solutions', NULL, NULL),
	(2, 'Consulting', NULL, NULL),
	(3, 'Training', NULL, NULL),
	(4, 'Research', NULL, NULL);

-- Dumping structure for table document-management.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table document-management.migrations: ~12 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2023_01_13_040751_create_clients_table', 1),
	(6, '2023_01_13_041426_create_products_table', 1),
	(7, '2023_01_13_060215_create_projects_table', 1),
	(8, '2023_01_13_063827_create_documents_table', 1),
	(9, '2023_01_13_063931_create_project_documents_table', 1),
	(10, '2023_01_13_064025_create_kategori_table', 1),
	(11, '2023_01_30_045214_create_tickets_table', 1),
	(12, '2023_02_07_042140_create_ticket_status_table', 1);

-- Dumping structure for table document-management.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table document-management.password_resets: ~0 rows (approximately)

-- Dumping structure for table document-management.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table document-management.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table document-management.product
CREATE TABLE IF NOT EXISTS `product` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kategori` bigint unsigned NOT NULL,
  `client_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table document-management.product: ~3 rows (approximately)
INSERT INTO `product` (`id`, `nama`, `id_kategori`, `client_id`, `created_at`, `updated_at`) VALUES
	(1, 'Aplikasi TKB', 1, 1, NULL, NULL),
	(2, 'Aplikasi PRC', 1, 2, NULL, NULL),
	(3, 'Aplikasi TKB', 1, 2, NULL, NULL);

-- Dumping structure for table document-management.project
CREATE TABLE IF NOT EXISTS `project` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `start_project` date NOT NULL,
  `finish_project` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table document-management.project: ~3 rows (approximately)
INSERT INTO `project` (`id`, `client_id`, `product_id`, `start_project`, `finish_project`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, '2023-02-03', '2023-02-23', NULL, NULL),
	(2, 2, 1, '2023-02-10', '2023-02-25', NULL, NULL),
	(3, 2, 2, '2023-02-15', '2023-02-28', NULL, NULL);

-- Dumping structure for table document-management.projectdocuments
CREATE TABLE IF NOT EXISTS `projectdocuments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `project_id` bigint unsigned NOT NULL,
  `document_id` bigint unsigned NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table document-management.projectdocuments: ~0 rows (approximately)

-- Dumping structure for table document-management.tickets
CREATE TABLE IF NOT EXISTS `tickets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `client_id` bigint unsigned NOT NULL,
  `issue` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expired_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `user_id` bigint unsigned DEFAULT NULL,
  `status_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table document-management.tickets: ~1 rows (approximately)
INSERT INTO `tickets` (`id`, `product_id`, `client_id`, `issue`, `file`, `expired_at`, `user_id`, `status_id`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, '<p>Aplikasi masih terdapat error pada bagian menu product tidak dapat melakukan <b>update</b></p>', 'documents/ta9O7IIAiFchRoooOqUnIcWbUJs3fC5ly2Vsb66o.png', '2023-02-14 06:45:43', 3, 2, '2023-02-13 23:43:42', '2023-02-13 23:45:43');

-- Dumping structure for table document-management.ticket_statuses
CREATE TABLE IF NOT EXISTS `ticket_statuses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `status` enum('to do','on progress','testing','staging','done') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'to do',
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `ticket_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table document-management.ticket_statuses: ~8 rows (approximately)
INSERT INTO `ticket_statuses` (`id`, `status`, `description`, `ticket_id`, `created_at`, `updated_at`) VALUES
	(1, 'to do', NULL, 1, '2023-02-13 23:43:42', '2023-02-13 23:43:42'),
	(2, 'on progress', NULL, 1, '2023-02-13 23:45:43', '2023-02-13 23:45:43'),
	(3, 'on progress', '<p>Menu product pada aplikasi sedang dilakukan perbaikan</p>', 1, '2023-02-13 23:47:16', '2023-02-13 23:47:16'),
	(4, 'testing', '<p>Aplikasi sedang di tes oleh QA</p>', 1, '2023-02-13 23:50:10', '2023-02-13 23:50:10'),
	(5, 'on progress', '<p>Aplikasi masih terdapat bug, jadi kembali di perbaiki</p>', 1, '2023-02-13 23:50:53', '2023-02-13 23:50:53'),
	(6, 'testing', '<p>Aplikasi kembali di tes oleh QA</p>', 1, '2023-02-13 23:53:42', '2023-02-13 23:53:42'),
	(7, 'staging', '<p>Aplikasi sudah selesai, bisa di remote melalui link berikut :&nbsp;<a href="http://contoh-aplikasi.com" target="_blank" style="background-color: rgb(255, 255, 255); font-size: 1rem;"><u>Aplikasi Document Management</u></a></p>', 1, '2023-02-13 23:57:18', '2023-02-13 23:57:18'),
	(8, 'done', '<p>Aplikasi Done</p>', 1, '2023-02-13 23:58:24', '2023-02-13 23:58:24');

-- Dumping structure for table document-management.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_id` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','client','programmer') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'client',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table document-management.users: ~4 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `image`, `client_id`, `deleted_at`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'admin@gmail.com', '2023-02-13 23:40:01', '$2y$10$Ie3jEyzOwRBqoTG8Ko2tTeADLnSJd7xJqMQoXB0O2QznHepSpUNui', NULL, NULL, NULL, 'admin', NULL, NULL, NULL),
	(2, 'Haikal', 'haikal@gmail.com', '2023-02-13 23:40:01', '$2y$10$Tia0Y095it5.7uVy19Aaz.QJ5/UbMLx/w/4LeXwTdFhny5d0ch0jy', NULL, NULL, NULL, 'programmer', NULL, NULL, NULL),
	(3, 'Rifqi', 'rifqi@gmail.com', '2023-02-13 23:40:01', '$2y$10$Hijg5MFEwQPkk1S7MlK2Hu6vl3xISumVCB.gcZPndchb5ce9BqGES', NULL, NULL, NULL, 'programmer', NULL, NULL, NULL),
	(4, 'Arif', 'arif@gmail.com', '2023-02-13 23:40:54', '$2y$10$gpVdrcr2mko6XW4637Kche6Rmp6KI7lxoUIrd66nZ2dObjNDZ89eq', NULL, 1, NULL, 'client', NULL, '2023-02-13 23:40:28', '2023-02-13 23:41:10');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
