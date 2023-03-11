-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;




-- Dumping structure for table my_app.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table my_app.migrations: ~29 rows (approximately)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(3, '2023_02_12_072823_create_roles_table', 2),
	(4, '2023_02_12_075103_create_menus_table', 2),
	(5, '2023_02_13_162312_create_role_user_table', 3),
	(6, '2023_02_14_063321_create_role_meu_table', 4),
	(7, '2023_02_15_080028_update_user_table', 5),
	(8, '2023_02_15_112833_add_user_id_user_table', 6),
	(9, '2023_02_15_113200_upadte__user_id_menu_table', 7),
	(10, '2023_02_15_113824_upadte_user_id_role_table', 8),
	(16, '2023_02_15_114047_upadte_user_add_modul_table', 9),
	(17, '2023_02_16_034027_create_provinsi_table', 10),
	(20, '2023_02_16_034626_create_kab_kota_table', 11),
	(21, '2023_02_16_035052_create_kecamatan_table', 12),
	(22, '2023_02_16_035812_create_kel_desa_table', 13),
	(23, '2023_02_16_055449_update_dekripsi_table', 14),
	(24, '2023_02_18_030204_update_field_name_kecamatan_table', 15),
	(25, '2023_02_18_044737_update_filed_name_kel_desa_table', 16),
	(26, '2023_02_18_044939_add_filed_kode_pos_kel_desa_table', 17),
	(27, '2023_02_18_055746_create_m_bksu_tables', 18),
	(28, '2023_02_18_060448_create_m_bksd_tables', 19),
	(29, '2023_02_18_061707_update_m_bksu_m_bksd_tables', 20),
	(30, '2023_02_18_151407_create_jenis_ks_tables', 21),
	(31, '2023_02_18_151713_create_jenis_mitra_table', 22),
	(32, '2023_02_18_151845_create_mitra_table', 23),
	(34, '2023_02_18_153021_create_unit_table', 24),
	(35, '2023_02_18_153258_create_usulan_unit_table', 25),
	(37, '2023_02_20_124601_create_t_dok_ks_tables', 26),
	(38, '2023_02_20_125804_create_relasi_t_dok_ks_tables', 26),
	(39, '2023_02_20_130935_add_field_user_id_in_m_jns_ks_table', 27),
	(41, '2023_02_22_163842_add_user_id_in_m_jenis_mitra_tables', 28),
	(43, '2023_03_05_091008_add_column_deskpsi_usulan_unit_table', 29),
	(44, '2023_03_05_112449_remove_column_draft_t_dok_table', 30);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table my_app.m_bksd
DROP TABLE IF EXISTS `m_bksd`;
CREATE TABLE IF NOT EXISTS `m_bksd` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_bentuk_kerjasama_umum` bigint(20) unsigned DEFAULT NULL,
  `nama_bentuk_kerjasam_detail` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rincian_bentuk_kerjasam_detail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `m_bksd_id_bentuk_kerjasama_umum_index` (`id_bentuk_kerjasama_umum`),
  CONSTRAINT `m_bksd_id_bentuk_kerjasama_umum_foreign` FOREIGN KEY (`id_bentuk_kerjasama_umum`) REFERENCES `m_bksu` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table my_app.m_bksd: ~1 rows (approximately)
DELETE FROM `m_bksd`;
/*!40000 ALTER TABLE `m_bksd` DISABLE KEYS */;
INSERT INTO `m_bksd` (`id`, `id_bentuk_kerjasama_umum`, `nama_bentuk_kerjasam_detail`, `rincian_bentuk_kerjasam_detail`, `user_id`, `created_at`, `updated_at`) VALUES
	(4, 1, 'qqq', '3333', 1, '2023-02-18 14:59:25', '2023-02-18 15:04:06');
/*!40000 ALTER TABLE `m_bksd` ENABLE KEYS */;

-- Dumping structure for table my_app.m_bksu
DROP TABLE IF EXISTS `m_bksu`;
CREATE TABLE IF NOT EXISTS `m_bksu` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_bentuk_kerjasam_umum` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penjelasan_bentuk_kerjasam_umum` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table my_app.m_bksu: ~2 rows (approximately)
DELETE FROM `m_bksu`;
/*!40000 ALTER TABLE `m_bksu` DISABLE KEYS */;
INSERT INTO `m_bksu` (`id`, `nama_bentuk_kerjasam_umum`, `penjelasan_bentuk_kerjasam_umum`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 'Kerjasama Luar Negeri', 'Kerjasama Luar Negeri', 1, '2023-02-18 14:26:02', '2023-02-18 08:47:25');
/*!40000 ALTER TABLE `m_bksu` ENABLE KEYS */;

-- Dumping structure for table my_app.m_jenis_ks
DROP TABLE IF EXISTS `m_jenis_ks`;
CREATE TABLE IF NOT EXISTS `m_jenis_ks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_jenis_kerjasama` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '-',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table my_app.m_jenis_ks: ~4 rows (approximately)
DELETE FROM `m_jenis_ks`;
/*!40000 ALTER TABLE `m_jenis_ks` DISABLE KEYS */;
INSERT INTO `m_jenis_ks` (`id`, `nama_jenis_kerjasama`, `deskripsi`, `created_at`, `updated_at`, `user_id`) VALUES
	(1, 'MOU', '-', '2023-02-22 23:53:12', NULL, 1),
	(2, 'IA', '-', '2023-02-22 23:53:12', NULL, 3),
	(3, 'sds', 'ee', '2023-02-22 16:58:12', '2023-02-22 16:58:12', 1);
/*!40000 ALTER TABLE `m_jenis_ks` ENABLE KEYS */;

-- Dumping structure for table my_app.m_jenis_mitra
DROP TABLE IF EXISTS `m_jenis_mitra`;
CREATE TABLE IF NOT EXISTS `m_jenis_mitra` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_jenis_mitra` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '-',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table my_app.m_jenis_mitra: ~2 rows (approximately)
DELETE FROM `m_jenis_mitra`;
/*!40000 ALTER TABLE `m_jenis_mitra` DISABLE KEYS */;
INSERT INTO `m_jenis_mitra` (`id`, `nama_jenis_mitra`, `deskripsi`, `created_at`, `updated_at`, `user_id`) VALUES
	(1, 'xsx', 'sxx', '2023-02-23 00:41:14', NULL, 1);
/*!40000 ALTER TABLE `m_jenis_mitra` ENABLE KEYS */;

-- Dumping structure for table my_app.m_kab_kota
DROP TABLE IF EXISTS `m_kab_kota`;
CREATE TABLE IF NOT EXISTS `m_kab_kota` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_provinsi` bigint(20) unsigned DEFAULT NULL,
  `nama_kab_kota` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `m_kab_kota_id_provinsi_index` (`id_provinsi`),
  CONSTRAINT `m_kab_kota_id_provinsi_foreign` FOREIGN KEY (`id_provinsi`) REFERENCES `m_provinsi` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table my_app.m_kab_kota: ~5 rows (approximately)
DELETE FROM `m_kab_kota`;
/*!40000 ALTER TABLE `m_kab_kota` DISABLE KEYS */;
INSERT INTO `m_kab_kota` (`id`, `id_provinsi`, `nama_kab_kota`, `deskripsi`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Aceh', '-', 1, '2023-02-16 16:18:38', NULL),
	(2, 1, 'Bacco', 'd', 1, '2023-02-18 03:54:44', '2023-02-18 03:54:44'),
	(3, 1, 'Becce', '0', 1, '2023-02-18 03:54:52', '2023-02-18 03:54:52'),
	(4, 2, 'Kota Makaassar', '-', 1, '2023-02-18 04:10:06', '2023-02-18 04:10:06'),
	(5, 2, 'Kota Pare - Pare', '-', 1, '2023-02-18 04:10:19', '2023-02-18 04:10:19');
/*!40000 ALTER TABLE `m_kab_kota` ENABLE KEYS */;

-- Dumping structure for table my_app.m_kecamatan
DROP TABLE IF EXISTS `m_kecamatan`;
CREATE TABLE IF NOT EXISTS `m_kecamatan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_provinsi` bigint(20) unsigned DEFAULT NULL,
  `id_kab_kota` bigint(20) unsigned DEFAULT NULL,
  `nama_kecamatan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `m_kecamatan_id_provinsi_index` (`id_provinsi`),
  KEY `m_kecamatan_id_kab_kota_index` (`id_kab_kota`),
  CONSTRAINT `m_kecamatan_id_kab_kota_foreign` FOREIGN KEY (`id_kab_kota`) REFERENCES `m_kab_kota` (`id`) ON DELETE CASCADE,
  CONSTRAINT `m_kecamatan_id_provinsi_foreign` FOREIGN KEY (`id_provinsi`) REFERENCES `m_provinsi` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table my_app.m_kecamatan: ~2 rows (approximately)
DELETE FROM `m_kecamatan`;
/*!40000 ALTER TABLE `m_kecamatan` DISABLE KEYS */;
INSERT INTO `m_kecamatan` (`id`, `id_provinsi`, `id_kab_kota`, `nama_kecamatan`, `deskripsi`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 'Banda', '-', 1, '2023-02-18 11:04:04', NULL),
	(4, 2, 4, 'Maros', 'sxsx', 1, '2023-02-18 04:02:25', '2023-02-18 04:42:04'),
	(5, 2, 4, 'sxsx', 'sxsx', 1, '2023-03-02 15:41:09', '2023-03-02 15:41:09');
/*!40000 ALTER TABLE `m_kecamatan` ENABLE KEYS */;

-- Dumping structure for table my_app.m_kel_desa
DROP TABLE IF EXISTS `m_kel_desa`;
CREATE TABLE IF NOT EXISTS `m_kel_desa` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_provinsi` bigint(20) unsigned DEFAULT NULL,
  `id_kab_kota` bigint(20) unsigned DEFAULT NULL,
  `id_kecamatan` bigint(20) unsigned DEFAULT NULL,
  `nama_kel_desa` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_pos` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `m_kel_desa_id_provinsi_index` (`id_provinsi`),
  KEY `m_kel_desa_id_kab_kota_index` (`id_kab_kota`),
  KEY `m_kel_desa_id_kecamatan_index` (`id_kecamatan`),
  CONSTRAINT `m_kel_desa_id_kab_kota_foreign` FOREIGN KEY (`id_kab_kota`) REFERENCES `m_kab_kota` (`id`) ON DELETE CASCADE,
  CONSTRAINT `m_kel_desa_id_kecamatan_foreign` FOREIGN KEY (`id_kecamatan`) REFERENCES `m_kecamatan` (`id`) ON DELETE CASCADE,
  CONSTRAINT `m_kel_desa_id_provinsi_foreign` FOREIGN KEY (`id_provinsi`) REFERENCES `m_provinsi` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table my_app.m_kel_desa: ~1 rows (approximately)
DELETE FROM `m_kel_desa`;
/*!40000 ALTER TABLE `m_kel_desa` DISABLE KEYS */;
INSERT INTO `m_kel_desa` (`id`, `id_provinsi`, `id_kab_kota`, `id_kecamatan`, `nama_kel_desa`, `kode_pos`, `deskripsi`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 2, 4, 4, 'becce', '001', '-', 1, '2023-02-18 13:03:37', '2023-03-02 15:23:57');
/*!40000 ALTER TABLE `m_kel_desa` ENABLE KEYS */;

-- Dumping structure for table my_app.m_menu
DROP TABLE IF EXISTS `m_menu`;
CREATE TABLE IF NOT EXISTS `m_menu` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_menu` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` char(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `url` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table my_app.m_menu: ~8 rows (approximately)
DELETE FROM `m_menu`;
/*!40000 ALTER TABLE `m_menu` DISABLE KEYS */;
INSERT INTO `m_menu` (`id`, `nama_menu`, `icon`, `parent`, `status`, `url`, `user_id`, `created_at`, `updated_at`) VALUES
	(13, 'Master Data', 'fa fa-archive', 'root', '1', '-', 1, '2023-02-15 12:20:07', '2023-02-16 03:15:10'),
	(14, 'Provinsi', 'fa fa-angle-double-right', '13', '1', 'provinsi', 1, '2023-02-15 12:23:56', '2023-02-16 01:57:13'),
	(15, 'Kabupaten/Kota', 'fa fa-angle-double-right', '13', '1', 'kab-kota', 1, '2023-02-15 12:25:07', '2023-02-16 03:19:05'),
	(16, 'Kecamatan', 'fa fa-angle-double-right', '13', '1', 'kecamatan', 1, '2023-02-15 12:25:24', '2023-02-16 03:19:14'),
	(17, 'Kelurahan/Desa', 'fa fa-angle-double-right', '13', '1', 'kel-desa', 1, '2023-02-15 12:25:45', '2023-02-16 03:19:19'),
	(18, 'Unit', 'fa fa-angle-double-right', '13', '1', 'unit', 1, '2023-02-15 13:16:12', '2023-03-05 07:00:18'),
	(19, 'Kerjasama Umum', 'fa fa-angle-double-right', '20', '1', 'bksu', 1, '2023-02-18 08:23:28', '2023-02-18 09:15:27'),
	(20, 'Bentuk Kerja Sama', 'fa fa-gavel', 'root', '1', '-', 1, '2023-02-18 08:51:49', '2023-02-18 08:51:49'),
	(21, 'Kerjasama Detail', 'fa fa-angle-double-right', '20', '1', 'bksd', 1, '2023-02-18 09:10:42', '2023-02-18 09:15:40'),
	(22, 'Jenins Kerjsama', 'fa fa-angle-double-right', '13', '1', 'jenis-ks', 1, '2023-02-22 16:26:39', '2023-02-22 16:26:39'),
	(23, 'Jenis Mitra', 'fa fa-angle-double-right', '13', '1', 'jenis-mitra', 1, '2023-02-22 17:34:51', '2023-02-22 17:34:51'),
	(24, 'Mitra', 'fa fa-users', 'root', '1', 'mitra', 1, '2023-03-02 14:26:41', '2023-03-02 14:26:41'),
	(25, 'Usulan', 'fa fa-mail-forward', 'root', '1', 'usulan', 1, '2023-03-05 09:04:17', '2023-03-05 09:04:17'),
	(26, 'Dokumen Kerjasama', 'fa fa-file-pdf-o', 'root', '1', 'dokumen-ks', 1, '2023-03-05 11:38:44', '2023-03-05 11:38:44');
/*!40000 ALTER TABLE `m_menu` ENABLE KEYS */;

-- Dumping structure for table my_app.m_provinsi
DROP TABLE IF EXISTS `m_provinsi`;
CREATE TABLE IF NOT EXISTS `m_provinsi` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_provinsi` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table my_app.m_provinsi: ~2 rows (approximately)
DELETE FROM `m_provinsi`;
/*!40000 ALTER TABLE `m_provinsi` DISABLE KEYS */;
INSERT INTO `m_provinsi` (`id`, `nama_provinsi`, `deskripsi`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 'Nanggroe Aceh Darussalam', '-', 1, '2023-02-16 12:10:57', NULL),
	(2, 'Selawesi Selatan', '-', 1, '2023-02-18 04:09:55', '2023-02-18 04:09:55');
/*!40000 ALTER TABLE `m_provinsi` ENABLE KEYS */;

-- Dumping structure for table my_app.m_role
DROP TABLE IF EXISTS `m_role`;
CREATE TABLE IF NOT EXISTS `m_role` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_role` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table my_app.m_role: ~3 rows (approximately)
DELETE FROM `m_role`;
/*!40000 ALTER TABLE `m_role` DISABLE KEYS */;
INSERT INTO `m_role` (`id`, `nama_role`, `deskripsi`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 'Devlopment', '-', '1', 1, '2023-02-13 23:59:29', '2023-02-16 02:49:52'),
	(3, 'Mitra', 'Mitra', '1', 1, '2023-02-13 16:14:09', '2023-02-13 16:20:20'),
	(5, 'Admin', 'Admin', '1', 1, '2023-02-13 16:20:41', '2023-02-13 16:20:41');
/*!40000 ALTER TABLE `m_role` ENABLE KEYS */;

-- Dumping structure for table my_app.m_user
DROP TABLE IF EXISTS `m_user`;
CREATE TABLE IF NOT EXISTS `m_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `level` enum('admin','member') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'member',
  PRIMARY KEY (`id`),
  UNIQUE KEY `m_user_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table my_app.m_user: ~2 rows (approximately)
DELETE FROM `m_user`;
/*!40000 ALTER TABLE `m_user` DISABLE KEYS */;
INSERT INTO `m_user` (`id`, `nama_user`, `username`, `password`, `status`, `user_id`, `created_at`, `updated_at`, `level`) VALUES
	(1, 'Fahmi Idrus', 'fahmi07', '$2y$10$sA5dRE4B8i9Tl8qSI1pLXeoD56.e18yPeHnZGD/r7foF3ibPWe8g2', '1', 1, '2023-02-12 08:42:32', '2023-02-16 02:58:42', 'admin'),
	(3, 'Baconceng', 'baco', '$2y$10$REo1LZEYmADakvhkTuTMe.f9SSgAg.WbnPg9OivwMfOYwkajaLa9y', '1', 1, '2023-02-15 11:02:38', '2023-02-16 03:22:05', 'member');
/*!40000 ALTER TABLE `m_user` ENABLE KEYS */;

-- Dumping structure for table my_app.personal_access_tokens
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table my_app.personal_access_tokens: ~0 rows (approximately)
DELETE FROM `personal_access_tokens`;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Dumping structure for table my_app.t_dok_ks
DROP TABLE IF EXISTS `t_dok_ks`;
CREATE TABLE IF NOT EXISTS `t_dok_ks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_usulan` bigint(20) unsigned DEFAULT NULL,
  `id_unit` bigint(20) unsigned DEFAULT NULL,
  `id_jenis_kerjasama` bigint(20) unsigned DEFAULT NULL,
  `id_bentuk_kerjasama` bigint(20) unsigned DEFAULT NULL,
  `id_mitra` bigint(20) unsigned DEFAULT NULL,
  `nama_dokumen` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '-',
  `tgl_awal` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_publih` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `t_dok_ks_id_usulan_index` (`id_usulan`),
  KEY `t_dok_ks_id_unit_index` (`id_unit`),
  KEY `t_dok_ks_id_jenis_kerjasama_index` (`id_jenis_kerjasama`),
  KEY `t_dok_ks_id_bentuk_kerjasama_index` (`id_bentuk_kerjasama`),
  KEY `t_dok_ks_id_mitra_index` (`id_mitra`),
  CONSTRAINT `t_dok_ks_id_bentuk_kerjasama_foreign` FOREIGN KEY (`id_bentuk_kerjasama`) REFERENCES `m_bksd` (`id`) ON DELETE CASCADE,
  CONSTRAINT `t_dok_ks_id_jenis_kerjasama_foreign` FOREIGN KEY (`id_jenis_kerjasama`) REFERENCES `m_jenis_ks` (`id`) ON DELETE CASCADE,
  CONSTRAINT `t_dok_ks_id_mitra_foreign` FOREIGN KEY (`id_mitra`) REFERENCES `t_mitra` (`id`) ON DELETE CASCADE,
  CONSTRAINT `t_dok_ks_id_unit_foreign` FOREIGN KEY (`id_unit`) REFERENCES `t_unit` (`id`) ON DELETE CASCADE,
  CONSTRAINT `t_dok_ks_id_usulan_foreign` FOREIGN KEY (`id_usulan`) REFERENCES `t_usulan_unit` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table my_app.t_dok_ks: ~2 rows (approximately)
DELETE FROM `t_dok_ks`;
/*!40000 ALTER TABLE `t_dok_ks` DISABLE KEYS */;
INSERT INTO `t_dok_ks` (`id`, `id_usulan`, `id_unit`, `id_jenis_kerjasama`, `id_bentuk_kerjasama`, `id_mitra`, `nama_dokumen`, `tgl_awal`, `tgl_akhir`, `deskripsi`, `file_publih`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 6, 4, 2, 4, 2, 'xsxxx', '2023-03-05', '2023-03-05', 'xsswswsw', '20230305133925_24135660d35f5c5eafc8a05a4.pdf', 1, '2023-03-05 19:41:03', '2023-03-05 13:39:25');
/*!40000 ALTER TABLE `t_dok_ks` ENABLE KEYS */;

-- Dumping structure for table my_app.t_mitra
DROP TABLE IF EXISTS `t_mitra`;
CREATE TABLE IF NOT EXISTS `t_mitra` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_jenis_mitra` bigint(20) unsigned DEFAULT NULL,
  `id_provinsi` bigint(20) unsigned DEFAULT NULL,
  `id_kab_kota` bigint(20) unsigned DEFAULT NULL,
  `id_kecamatan` bigint(20) unsigned DEFAULT NULL,
  `id_kel_desa` bigint(20) unsigned DEFAULT NULL,
  `nama_mitra` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_tlp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `t_mitra_id_jenis_mitra_index` (`id_jenis_mitra`),
  KEY `t_mitra_id_provinsi_index` (`id_provinsi`),
  KEY `t_mitra_id_kab_kota_index` (`id_kab_kota`),
  KEY `t_mitra_id_kecamatan_index` (`id_kecamatan`),
  KEY `t_mitra_id_kel_desa_index` (`id_kel_desa`),
  CONSTRAINT `t_mitra_id_jenis_mitra_foreign` FOREIGN KEY (`id_jenis_mitra`) REFERENCES `m_jenis_mitra` (`id`) ON DELETE CASCADE,
  CONSTRAINT `t_mitra_id_kab_kota_foreign` FOREIGN KEY (`id_kab_kota`) REFERENCES `m_kab_kota` (`id`) ON DELETE CASCADE,
  CONSTRAINT `t_mitra_id_kecamatan_foreign` FOREIGN KEY (`id_kecamatan`) REFERENCES `m_kecamatan` (`id`) ON DELETE CASCADE,
  CONSTRAINT `t_mitra_id_kel_desa_foreign` FOREIGN KEY (`id_kel_desa`) REFERENCES `m_kel_desa` (`id`) ON DELETE CASCADE,
  CONSTRAINT `t_mitra_id_provinsi_foreign` FOREIGN KEY (`id_provinsi`) REFERENCES `m_provinsi` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table my_app.t_mitra: ~2 rows (approximately)
DELETE FROM `t_mitra`;
/*!40000 ALTER TABLE `t_mitra` DISABLE KEYS */;
INSERT INTO `t_mitra` (`id`, `id_jenis_mitra`, `id_provinsi`, `id_kab_kota`, `id_kecamatan`, `id_kel_desa`, `nama_mitra`, `email`, `no_tlp`, `alamat`, `website`, `user_id`, `created_at`, `updated_at`) VALUES
	(2, 1, 2, 4, 4, 1, 'xsx', 'xsx', '3323', '323', '233', 3, '2023-03-02 22:56:26', NULL),
	(3, 1, 2, 4, 4, 1, 's', 'xssx@mail.com', '2345678', 'Sungai Jodoh', '-', 1, '2023-03-02 15:32:47', '2023-03-02 15:32:47');
/*!40000 ALTER TABLE `t_mitra` ENABLE KEYS */;

-- Dumping structure for table my_app.t_role_menu
DROP TABLE IF EXISTS `t_role_menu`;
CREATE TABLE IF NOT EXISTS `t_role_menu` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_role` bigint(20) unsigned DEFAULT NULL,
  `id_menu` bigint(20) unsigned DEFAULT NULL,
  `status_tambah` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status_edit` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status_hapus` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status_tampil` enum('user_id','all') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'all',
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `t_role_menu_id_role_index` (`id_role`),
  KEY `t_role_menu_id_menu_index` (`id_menu`),
  CONSTRAINT `t_role_menu_id_menu_foreign` FOREIGN KEY (`id_menu`) REFERENCES `m_menu` (`id`) ON DELETE CASCADE,
  CONSTRAINT `t_role_menu_id_role_foreign` FOREIGN KEY (`id_role`) REFERENCES `m_role` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table my_app.t_role_menu: ~10 rows (approximately)
DELETE FROM `t_role_menu`;
/*!40000 ALTER TABLE `t_role_menu` DISABLE KEYS */;
INSERT INTO `t_role_menu` (`id`, `id_role`, `id_menu`, `status_tambah`, `status_edit`, `status_hapus`, `status_tampil`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
	(10, 1, 13, '1', '1', '1', 'all', '1', 1, '2023-02-15 12:44:41', '2023-02-15 12:44:41'),
	(11, 1, 14, '1', '1', '1', 'all', '1', 1, '2023-02-15 12:44:48', '2023-02-22 16:27:18'),
	(12, 1, 15, '1', '1', '1', 'all', '1', 1, '2023-02-15 12:44:56', '2023-02-16 08:53:30'),
	(13, 1, 16, '1', '1', '1', 'all', '1', 1, '2023-02-15 12:45:04', '2023-02-18 03:26:27'),
	(14, 1, 17, '1', '1', '1', 'all', '1', 1, '2023-02-15 12:45:12', '2023-02-18 05:11:44'),
	(15, 1, 18, '1', '1', '1', 'all', '1', 1, '2023-02-15 13:16:36', '2023-03-05 08:23:18'),
	(16, 5, 13, '1', '1', '1', 'all', '1', 1, '2023-02-16 03:22:24', '2023-02-22 17:41:30'),
	(17, 5, 14, '1', '1', '1', 'all', '1', 1, '2023-02-16 05:46:57', '2023-02-20 02:05:23'),
	(18, 1, 19, '1', '1', '1', 'all', '1', 1, '2023-02-18 08:24:02', '2023-02-18 08:40:00'),
	(19, 1, 20, '1', '1', '1', 'all', '1', 1, '2023-02-18 08:52:20', '2023-02-18 08:52:20'),
	(20, 1, 21, '1', '1', '1', 'all', '1', 1, '2023-02-18 09:11:13', '2023-02-18 14:56:06'),
	(21, 1, 22, '1', '1', '1', 'all', '1', 1, '2023-02-22 16:27:30', '2023-02-22 16:55:15'),
	(22, 1, 23, '1', '1', '1', 'all', '1', 1, '2023-02-22 17:35:33', '2023-02-22 17:41:57'),
	(23, 1, 24, '1', '1', '1', 'all', '1', 1, '2023-03-02 14:27:05', '2023-03-02 15:08:16'),
	(24, 1, 25, '1', '1', '1', 'all', '1', 1, '2023-03-05 09:04:31', '2023-03-05 11:04:41'),
	(25, 1, 26, '1', '1', '1', 'all', '1', 1, '2023-03-05 11:38:59', '2023-03-05 12:19:22');
/*!40000 ALTER TABLE `t_role_menu` ENABLE KEYS */;

-- Dumping structure for table my_app.t_role_user
DROP TABLE IF EXISTS `t_role_user`;
CREATE TABLE IF NOT EXISTS `t_role_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_role` bigint(20) unsigned DEFAULT NULL,
  `id_user` bigint(20) unsigned DEFAULT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `t_role_user_id_role_index` (`id_role`),
  KEY `t_role_user_id_user_index` (`id_user`),
  CONSTRAINT `t_role_user_id_role_foreign` FOREIGN KEY (`id_role`) REFERENCES `m_role` (`id`) ON DELETE CASCADE,
  CONSTRAINT `t_role_user_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `m_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table my_app.t_role_user: ~2 rows (approximately)
DELETE FROM `t_role_user`;
/*!40000 ALTER TABLE `t_role_user` DISABLE KEYS */;
INSERT INTO `t_role_user` (`id`, `id_role`, `id_user`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, '1', 1, '2023-02-14 00:35:55', '2023-02-16 02:05:13'),
	(2, 5, 3, '1', 1, '2023-02-16 03:21:55', '2023-02-16 03:21:55');
/*!40000 ALTER TABLE `t_role_user` ENABLE KEYS */;

-- Dumping structure for table my_app.t_unit
DROP TABLE IF EXISTS `t_unit`;
CREATE TABLE IF NOT EXISTS `t_unit` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_unit` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pd_unit` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `web` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table my_app.t_unit: ~2 rows (approximately)
DELETE FROM `t_unit`;
/*!40000 ALTER TABLE `t_unit` DISABLE KEYS */;
INSERT INTO `t_unit` (`id`, `nama_unit`, `pd_unit`, `email`, `web`, `no_telp`, `user_id`, `created_at`, `updated_at`) VALUES
	(4, 'Wakil Rektor 3', 'Arafah', 'arafah@gmail.com', 'wertyuiop', '085299947796', 1, '2023-03-05 08:58:59', '2023-03-05 08:58:59');
/*!40000 ALTER TABLE `t_unit` ENABLE KEYS */;

-- Dumping structure for table my_app.t_usulan_unit
DROP TABLE IF EXISTS `t_usulan_unit`;
CREATE TABLE IF NOT EXISTS `t_usulan_unit` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_unit` bigint(20) unsigned DEFAULT NULL,
  `id_jenis_kerjasama` bigint(20) unsigned DEFAULT NULL,
  `id_mitra` bigint(20) unsigned DEFAULT NULL,
  `id_bentuk_kerjasama` bigint(20) unsigned DEFAULT NULL,
  `tanggal_usul` date NOT NULL,
  `deskripsi` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `t_usulan_unit_id_unit_index` (`id_unit`),
  KEY `t_usulan_unit_id_jenis_kerjasama_index` (`id_jenis_kerjasama`),
  KEY `t_usulan_unit_id_mitra_index` (`id_mitra`),
  KEY `t_usulan_unit_id_bentuk_kerjasama_index` (`id_bentuk_kerjasama`),
  CONSTRAINT `t_usulan_unit_id_bentuk_kerjasama_foreign` FOREIGN KEY (`id_bentuk_kerjasama`) REFERENCES `m_bksd` (`id`) ON DELETE CASCADE,
  CONSTRAINT `t_usulan_unit_id_jenis_kerjasama_foreign` FOREIGN KEY (`id_jenis_kerjasama`) REFERENCES `m_jenis_ks` (`id`) ON DELETE CASCADE,
  CONSTRAINT `t_usulan_unit_id_mitra_foreign` FOREIGN KEY (`id_mitra`) REFERENCES `t_mitra` (`id`) ON DELETE CASCADE,
  CONSTRAINT `t_usulan_unit_id_unit_foreign` FOREIGN KEY (`id_unit`) REFERENCES `t_unit` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table my_app.t_usulan_unit: ~1 rows (approximately)
DELETE FROM `t_usulan_unit`;
/*!40000 ALTER TABLE `t_usulan_unit` DISABLE KEYS */;
INSERT INTO `t_usulan_unit` (`id`, `id_unit`, `id_jenis_kerjasama`, `id_mitra`, `id_bentuk_kerjasama`, `tanggal_usul`, `deskripsi`, `user_id`, `created_at`, `updated_at`) VALUES
	(6, 4, 2, 2, 4, '2023-03-05', 'xsx', 1, '2023-03-05 11:17:37', '2023-03-05 11:20:03');
/*!40000 ALTER TABLE `t_usulan_unit` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
