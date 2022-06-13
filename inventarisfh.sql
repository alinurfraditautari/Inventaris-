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


-- Dumping database structure for inventarisfh
CREATE DATABASE IF NOT EXISTS `inventarisfh` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `inventarisfh`;

-- Dumping structure for table inventarisfh.barangs
CREATE TABLE IF NOT EXISTS `barangs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `merk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` enum('aset','barang_habis_pakai') COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `satuan` enum('Unit','Pcs','Lembar') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_anggaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sumber_dana` enum('apbn','pnpb') COLLATE utf8mb4_unicode_ci NOT NULL,
  `kondisi` enum('baik','rusak','sedang_dipinjam','hilang') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table inventarisfh.barangs: ~4 rows (approximately)
/*!40000 ALTER TABLE `barangs` DISABLE KEYS */;
REPLACE INTO `barangs` (`id`, `kode_barang`, `nama_barang`, `merk`, `kategori`, `jumlah_barang`, `satuan`, `tahun_anggaran`, `sumber_dana`, `kondisi`, `created_at`, `updated_at`) VALUES
	(2, '2022-06-12-143147-737129470d10acdec56b17b5c8134857', 'Kamera Canon', 'Canon', 'aset', 2, 'Unit', '2022', 'pnpb', 'baik', '2022-06-12 14:31:47', '2022-06-12 14:31:47'),
	(3, '2022-06-12-143238-ae55085a5d4c80a33bb121bc466154eb', 'Keras A4', 'Sidu', 'barang_habis_pakai', 12, 'Pcs', '2022', 'pnpb', 'baik', '2022-06-12 14:32:38', '2022-06-13 03:05:13'),
	(4, '2022-06-12-165450-403d46e65ac737e5b10da8e8f91214ff', 'Pensil', 'Merk Pensil', 'barang_habis_pakai', 18, 'Unit', '2022', 'apbn', 'rusak', '2022-06-12 16:54:50', '2022-06-13 03:35:21'),
	(5, '2022-06-13-033630-f7845d1f467c0672fd8faab4681d0922', 'Monitor Besar', 'Politron', 'aset', 2, 'Unit', '2022', 'apbn', 'baik', '2022-06-13 03:36:30', '2022-06-13 03:36:30');
/*!40000 ALTER TABLE `barangs` ENABLE KEYS */;

-- Dumping structure for table inventarisfh.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table inventarisfh.failed_jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table inventarisfh.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table inventarisfh.migrations: ~8 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
REPLACE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2022_02_11_041135_create_barangs_table', 1),
	(6, '2022_06_10_110640_create_transaksi_masuks_table', 1),
	(7, '2022_06_10_110716_create_transaksi_keluars_table', 1),
	(8, '2022_06_13_034346_create_peminjamen_table', 2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table inventarisfh.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table inventarisfh.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table inventarisfh.peminjamen
CREATE TABLE IF NOT EXISTS `peminjamen` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `barang_id` bigint(20) unsigned NOT NULL,
  `jumlah_pinjam` int(11) NOT NULL,
  `nama_peminjam` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `keterangan` enum('sedang_dipinjam','sudah_dikembalikan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table inventarisfh.peminjamen: ~4 rows (approximately)
/*!40000 ALTER TABLE `peminjamen` DISABLE KEYS */;
REPLACE INTO `peminjamen` (`id`, `barang_id`, `jumlah_pinjam`, `nama_peminjam`, `tanggal_kembali`, `tanggal_pinjam`, `keterangan`, `created_at`, `updated_at`) VALUES
	(1, 4, 5, 'fas', '2022-06-13', '2022-06-13', 'sudah_dikembalikan', '2022-06-13 04:04:47', '2022-06-13 04:13:55'),
	(2, 4, 2, 'Agoy', '2022-06-17', '2022-06-13', 'sedang_dipinjam', '2022-06-13 04:15:19', '2022-06-13 04:15:19'),
	(3, 3, 3, 'Agoy', '2022-06-18', '2022-06-12', 'sedang_dipinjam', '2022-06-13 04:23:06', '2022-06-13 04:23:06'),
	(7, 4, 6, 'zcz', '2022-06-16', '2022-06-15', 'sedang_dipinjam', '2022-06-13 04:30:26', '2022-06-13 04:30:26');
/*!40000 ALTER TABLE `peminjamen` ENABLE KEYS */;

-- Dumping structure for table inventarisfh.personal_access_tokens
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

-- Dumping data for table inventarisfh.personal_access_tokens: ~0 rows (approximately)
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Dumping structure for table inventarisfh.transaksi_keluars
CREATE TABLE IF NOT EXISTS `transaksi_keluars` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `jumlah_keluar` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `barang_id` bigint(20) unsigned NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `tujuan_keluar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table inventarisfh.transaksi_keluars: ~3 rows (approximately)
/*!40000 ALTER TABLE `transaksi_keluars` DISABLE KEYS */;
REPLACE INTO `transaksi_keluars` (`id`, `jumlah_keluar`, `barang_id`, `tanggal_keluar`, `tujuan_keluar`, `created_at`, `updated_at`) VALUES
	(1, '6', 3, '2022-06-13', 'Untuk mencetak laporan', '2022-06-13 03:05:13', '2022-06-13 03:31:39'),
	(4, '2', 3, '2022-06-13', 'dadasda', '2022-06-13 04:17:39', '2022-06-13 04:17:39'),
	(6, '8', 4, '2022-06-14', 'asdad', '2022-06-13 04:28:17', '2022-06-13 04:37:27');
/*!40000 ALTER TABLE `transaksi_keluars` ENABLE KEYS */;

-- Dumping structure for table inventarisfh.transaksi_masuks
CREATE TABLE IF NOT EXISTS `transaksi_masuks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `merk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` enum('aset','barang_habis_pakai') COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `satuan` enum('Unit','Pcs','Lembar') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_anggaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sumber_dana` enum('apbn','pnpb') COLLATE utf8mb4_unicode_ci NOT NULL,
  `kondisi` enum('baik','rusak','sedang_dipinjam','hilang') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table inventarisfh.transaksi_masuks: ~1 rows (approximately)
/*!40000 ALTER TABLE `transaksi_masuks` DISABLE KEYS */;
REPLACE INTO `transaksi_masuks` (`id`, `kode_barang`, `nama_barang`, `tanggal_masuk`, `merk`, `kategori`, `jumlah_barang`, `satuan`, `tahun_anggaran`, `sumber_dana`, `kondisi`, `created_at`, `updated_at`) VALUES
	(2, '2022-06-13-033630-f7845d1f467c0672fd8faab4681d0922', 'Monitor Besar', '2022-06-13', 'Politron', 'aset', 2, 'Unit', '2022', 'apbn', 'baik', '2022-06-13 03:36:30', '2022-06-13 03:36:30');
/*!40000 ALTER TABLE `transaksi_masuks` ENABLE KEYS */;

-- Dumping structure for table inventarisfh.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table inventarisfh.users: ~1 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
REPLACE INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Operator', 'operator@mail.com', NULL, '$2y$10$1ODYA8czkNvkonVxCT36D.GxknHU9Wy7HhFxs4WFnMbEBXCkepFNW', NULL, '2022-06-13 05:22:42', '2022-06-13 05:22:42');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
