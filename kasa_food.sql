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


-- Dumping database structure for kasa_food
CREATE DATABASE IF NOT EXISTS `kasa_food` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `kasa_food`;

-- Dumping structure for table kasa_food.barcodes
CREATE TABLE IF NOT EXISTS `barcodes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `table_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qr_value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `barcodes_users_id_foreign` (`users_id`),
  CONSTRAINT `barcodes_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kasa_food.barcodes: ~2 rows (approximately)
INSERT INTO `barcodes` (`id`, `table_number`, `image`, `qr_value`, `users_id`, `created_at`, `updated_at`) VALUES
	(1, 'V5981', 'qr_codes/V5981.svg', '5cbe0a81d7f2.ngrok-free.app/V5981', 1, '2025-08-01 04:29:16', '2025-08-01 04:29:16'),
	(2, 'B7971', 'qr_codes/B7971.svg', '5cbe0a81d7f2.ngrok-free.app/B7971', 1, '2025-08-01 04:29:27', '2025-08-01 04:29:27'),
	(3, 'X2438', 'qr_codes/X2438.svg', '5cbe0a81d7f2.ngrok-free.app/X2438', 1, '2025-08-01 04:29:32', '2025-08-01 04:29:32');

-- Dumping structure for table kasa_food.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kasa_food.cache: ~30 rows (approximately)
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
	('0360aca66af243f16b7a62ad5d2eb32c3c5557ec', 'i:1;', 1754464446),
	('0360aca66af243f16b7a62ad5d2eb32c3c5557ec:timer', 'i:1754464446;', 1754464446),
	('2918c26e6239d4af5a778adcb6a6d90b211de686', 'i:1;', 1754330431),
	('2918c26e6239d4af5a778adcb6a6d90b211de686:timer', 'i:1754330431;', 1754330431),
	('292a9fc2e7a5649fa0e60d5bcc49156aaafea254', 'i:1;', 1754325491),
	('292a9fc2e7a5649fa0e60d5bcc49156aaafea254:timer', 'i:1754325491;', 1754325491),
	('356a192b7913b04c54574d18c28d46e6395428ab', 'i:1;', 1754678587),
	('356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1754678587;', 1754678587),
	('576d853d8f86f0e38974444c9b02c556b21d1c7a', 'i:1;', 1754394148),
	('576d853d8f86f0e38974444c9b02c556b21d1c7a:timer', 'i:1754394148;', 1754394148),
	('5c785c036466adea360111aa28563bfd556b5fba', 'i:1;', 1754324902),
	('5c785c036466adea360111aa28563bfd556b5fba:timer', 'i:1754324902;', 1754324902),
	('6509c8b59c6d83835786510903f41b9821dc0008', 'i:1;', 1754465528),
	('6509c8b59c6d83835786510903f41b9821dc0008:timer', 'i:1754465528;', 1754465528),
	('6624baa051a85ed875d03111b73e47dd4d9e249f', 'i:1;', 1754331165),
	('6624baa051a85ed875d03111b73e47dd4d9e249f:timer', 'i:1754331165;', 1754331165),
	('711c2b0610c5d255ce212fd66f98d353490f19b3', 'i:1;', 1754233026),
	('711c2b0610c5d255ce212fd66f98d353490f19b3:timer', 'i:1754233026;', 1754233026),
	('7e1f79b73d442c356790e886e3e89d134f367919', 'i:2;', 1754679514),
	('7e1f79b73d442c356790e886e3e89d134f367919:timer', 'i:1754679514;', 1754679514),
	('96c29a0f53f6bde93edb11dc87819a83ab343b85', 'i:1;', 1754460522),
	('96c29a0f53f6bde93edb11dc87819a83ab343b85:timer', 'i:1754460522;', 1754460522),
	('livewire-rate-limiter:2bd7caa2705ee0b8765c0ee06c046e81a7df46f7', 'i:1;', 1754898602),
	('livewire-rate-limiter:2bd7caa2705ee0b8765c0ee06c046e81a7df46f7:timer', 'i:1754898602;', 1754898602),
	('livewire-rate-limiter:93ff6a3df129c5049fc19eb94505454d28241e52', 'i:1;', 1754325176),
	('livewire-rate-limiter:93ff6a3df129c5049fc19eb94505454d28241e52:timer', 'i:1754325176;', 1754325176),
	('livewire-rate-limiter:a17961fa74e9275d529f489537f179c05d50c2f3', 'i:1;', 1754980230),
	('livewire-rate-limiter:a17961fa74e9275d529f489537f179c05d50c2f3:timer', 'i:1754980230;', 1754980230),
	('livewire-rate-limiter:e95555e328915508b469e037419842bda3d3dc04', 'i:1;', 1754458943),
	('livewire-rate-limiter:e95555e328915508b469e037419842bda3d3dc04:timer', 'i:1754458943;', 1754458943);

-- Dumping structure for table kasa_food.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kasa_food.cache_locks: ~0 rows (approximately)

-- Dumping structure for table kasa_food.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kasa_food.categories: ~2 rows (approximately)
INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Makanan', '2025-08-01 04:29:47', '2025-08-01 04:29:47'),
	(2, 'Minuman', '2025-08-01 04:29:51', '2025-08-01 04:29:51');

-- Dumping structure for table kasa_food.failed_jobs
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

-- Dumping data for table kasa_food.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table kasa_food.foods
CREATE TABLE IF NOT EXISTS `foods` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `price_afterdiscount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `percent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_promo` tinyint(1) DEFAULT NULL,
  `categories_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `foods_categories_id_foreign` (`categories_id`),
  FULLTEXT KEY `foods_name_description_fulltext` (`name`,`description`),
  CONSTRAINT `foods_categories_id_foreign` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kasa_food.foods: ~16 rows (approximately)
INSERT INTO `foods` (`id`, `name`, `description`, `image`, `price`, `price_afterdiscount`, `percent`, `is_promo`, `categories_id`, `created_at`, `updated_at`) VALUES
	(1, 'Hazelnut', '<p>Hazelnut Enak</p>', 'foods/01K1JPDWMNZBJXDCNRB8GKS3Q0.jpg', 25000, NULL, NULL, 0, 2, '2025-08-01 04:31:42', '2025-08-01 04:31:42'),
	(2, 'Kentang Spiral', '<p>Enakkkkkkk</p>', 'foods/01K1JZT2B3S3ZMGEXYX3VR0AD6.jpg', 30000, '27000', '10', 0, 1, '2025-08-01 04:33:00', '2025-08-08 11:43:59'),
	(3, 'Nasi Goreng', '<p>p</p>', 'foods/01K1V3RDJFJRMWVHD316WKEBKN.jpg', 10000, '7500', '25', 0, 1, '2025-08-04 10:58:34', '2025-08-08 11:44:22'),
	(4, 'Sea Salt', '<p>Cita rasa yang ditawarkan sangat unik, di mana rasa pahit dan aroma khas dari kopi berpadu sempurna dengan rasa <em>creamy</em>, gurih, dan sedikit asin dari krim <em>sea salt</em>.&nbsp;</p>', 'foods/01K25BR8M8RPFQMTHPPT4XY85T.jpeg', 27000, NULL, NULL, 0, 2, '2025-08-08 10:30:42', '2025-08-08 11:03:35'),
	(5, 'rose late', '<p>&nbsp;Minuman ini sangat populer di kalangan pencinta kopi yang ingin mencoba varian rasa baru yang tidak biasa, serta bagi mereka yang menyukai aroma dan rasa floral. Rose Latte bisa disajikan dalam keadaan panas maupun dingin (<em>Iced Rose Latte</em>).&nbsp;</p>', 'foods/01K25C1G1GF2DPQT5KDFCH0YH1.jpg', 28000, NULL, NULL, 0, 2, '2025-08-08 10:35:44', '2025-08-08 10:35:44'),
	(6, 'Creamy Palm Sugar', '<p>&nbsp;Minuman Creamy Palm Sugar pada dasarnya adalah versi yang lebih kaya dan mewah dari Kopi Susu Gula Aren yang sangat populer di Indonesia.&nbsp;</p>', 'foods/01K25C51374KDWAY12XTC0WD3X.jpg', 25000, NULL, NULL, 0, 2, '2025-08-08 10:37:40', '2025-08-08 10:37:40'),
	(7, 'Kasa Koffee', '<p>Minuman kopi yang kreatif dan kekinian, dengan fokus pada perpaduan rasa yang unik dan seimbang.&nbsp;</p>', 'foods/01K25C8PBAR55WB0V13DSBG8X6.jpeg', 25000, NULL, NULL, 0, 2, '2025-08-08 10:39:40', '2025-08-08 11:02:39'),
	(8, 'Creamy Kasa', '<p>&nbsp;Ini adalah pilihan yang paling utama dan sesuai dengan namanya. Minuman ini pada dasarnya adalah Kopi Susu Gula Aren yang dibuat lebih mewah dan nikmat. Teksturnya sangat <strong>kental dan lembut</strong> karena menggunakan tambahan krim, sehingga rasanya lebih kaya dibandingkan kopi susu biasa.&nbsp;</p>', 'foods/01K25CJFM27MN78SEQRKBETRJ5.jpeg', 23000, NULL, NULL, 0, 2, '2025-08-08 10:45:01', '2025-08-08 10:45:01'),
	(9, 'Salted Caramel', '<p>salted caramel adalah perpaduan rasa yang sangat populer, menggabungkan manisnya karamel dengan sentuhan rasa asin dari garam. Kontras rasa ini menciptakan profil rasa yang kaya, gurih, dan tidak membuat enak.&nbsp;</p>', 'foods/01K25D8H3YPH32S7VJ5HGCEB8P.jpeg', 25000, NULL, NULL, 0, 2, '2025-08-08 10:57:03', '2025-08-08 10:57:03'),
	(10, 'Cold Berry Lime', '<p><strong>Cold Berry Lime</strong> adalah nama untuk jenis minuman segar non-kopi yang memadukan rasa manis dari aneka buah beri dengan kesegaran asam dari jeruk nipis (<em>lime</em>).&nbsp;</p>', 'foods/01K25DDEY90VAKMDYSGSA3AEWE.jpeg', 27000, NULL, NULL, 0, 2, '2025-08-08 10:59:45', '2025-08-08 10:59:45'),
	(11, 'Creamy Berry', '<p>&nbsp;Creamy Berry, <strong>sirup vanila</strong> atau <strong>madu</strong> seringkali menjadi pilihan terbaik karena dapat menyatu dengan baik tanpa menutupi rasa asli buahnya.&nbsp;</p>', 'foods/01K25E9M55S76VBFP5303B2XV7.jpeg', 25000, NULL, NULL, 0, 2, '2025-08-08 11:15:08', '2025-08-08 11:15:08'),
	(12, 'Hawaiian Burger', '<p>Perpaduan klasik yang tak terduga! <strong>Patty daging sapi tebal</strong> dan <em>juicy</em>, bertemu dengan manisnya <strong>irisan nanas panggang</strong> yang eksotis. Dilumuri saus teriyaki gurih dan lelehan keju, burger ini menawarkan sensasi rasa tropis yang menyegarkan di setiap gigitan.&nbsp;</p>', 'foods/01K25F8Z3CDQ2DMDQYFMD87TKR.jpeg', 45000, NULL, NULL, 0, 1, '2025-08-08 11:32:15', '2025-08-08 11:32:15'),
	(13, 'Mix Platter', '<p>&nbsp;Pilihan paling pas untuk kumpul bareng! Satu piring penuh berisi aneka camilan favorit: <strong>sosis goreng gurih</strong>, <strong>kentang renyah</strong>, <strong>nugget ayam </strong><strong><em>juicy</em></strong>, dan <strong><em>onion ring</em></strong> yang <em>crunchy</em>. Disajikan hangat lengkap dengan saus cocol spesial. Dijamin semua kebagian&nbsp;</p>', 'foods/01K25FCW3MEW1JJSQ80WXTEFWV.jpeg', 35000, NULL, NULL, 0, 1, '2025-08-08 11:34:23', '2025-08-08 11:34:23'),
	(14, 'French Fries', '<p>&nbsp;Camilan klasik yang tak pernah salah! Potongan kentang pilihan yang digoreng sempurna hingga kuning keemasan. Nikmati sensasi <strong>renyah di luar namun tetap lembut di dalam</strong> pada setiap gigitannya. Disajikan hangat dengan saus cocol favoritmu.&nbsp;</p>', 'foods/01K25FH4S609AHC5KECCEXEN10.jpeg', 23000, NULL, NULL, 0, 1, '2025-08-08 11:36:43', '2025-08-08 11:36:43'),
	(15, 'Mentai Deluxe', '<p>&nbsp;Camilan klasik yang tak pernah salah! Potongan kentang pilihan yang digoreng sempurna hingga kuning keemasan. Nikmati sensasi <strong>renyah di luar namun tetap lembut di dalam</strong> pada setiap gigitannya. Disajikan hangat dengan saus cocol favoritmu.&nbsp;</p>', 'foods/01K25FMDRDCP7SA9NPEM6PVNQG.jpeg', 38000, NULL, NULL, 0, 1, '2025-08-08 11:38:30', '2025-08-08 11:38:52'),
	(16, 'Kasadila', '<p>&nbsp;Nikmati cita rasa Meksiko dalam setiap potongan. Kasadila kami dibuat dari tortilla garing yang membungkus isian daging gurih dan lelehan keju yang lumer di mulut. Sempurna untuk dibagikan, atau dinikmati sendiri sampai potongan terakhir!&nbsp;</p>', 'foods/01K25FV2J225STSC0Q8TPWQJRJ.jpeg', 27000, NULL, NULL, 0, 1, '2025-08-08 11:42:08', '2025-08-08 11:42:08');

-- Dumping structure for table kasa_food.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kasa_food.jobs: ~0 rows (approximately)

-- Dumping structure for table kasa_food.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kasa_food.job_batches: ~0 rows (approximately)

-- Dumping structure for table kasa_food.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kasa_food.migrations: ~0 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2025_01_22_181811_create_barcodes_table', 1),
	(5, '2025_08_01_112440_categories', 1),
	(6, '2025_08_01_112551_food', 1),
	(7, '2025_08_01_112659_transactions', 1),
	(8, '2025_08_01_112714_transaction_items', 1),
	(9, '2025_08_01_114336_add_fulltext_index_to_foods_table', 2);

-- Dumping structure for table kasa_food.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kasa_food.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table kasa_food.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kasa_food.sessions: ~7 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('00kxYcUAFjkpJK9YNi97LLsFjUQEkXQVHTVAZJn4', 1, '114.4.214.208', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoibW9aZ0lqTXhyOEVNaGxZWGdYUVlMTjNEblVsc3Y0U1VxaFZYTGJYYiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjUwOiJodHRwczovLzcyZmNhODY0YzExOC5uZ3Jvay1mcmVlLmFwcC9hZG1pbi9sYXBvcmFucyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMiRPNklObDlNTC5iTjFwbzFiUFF5Yy4udVB4bGhKZlRGU1Ruemw2aDY2OUZjbDBCZUk3dk5tTyI7fQ==', 1754902288),
	('6bmyCQa5NB0d3nmOKN592KbgsVcaTryuZW76ldQZ', NULL, '2404:8000:10a5:704:44c9:815a:e615:1c2b', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiQnNvS0czekdNVW8xVmF1SWlYMWxWTktibFIyQmYxOFBnM2NZcXVWNyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1754910034),
	('hfN7DIveM8SKbRUrwQ8QcuWdteVUcmyq4GfNL7E4', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiZUF5OXZEM1FtanNCU2s5UnN5MThSUGc0ZTVHRkprZk5PVVJyQ3ZOMyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM2OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4vbGFwb3JhbnMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTIkTzZJTmw5TUwuYk4xcG8xYlBReWMuLnVQeGxoSmZURlNUbnpsNmg2NjlGY2wwQmVJN3ZObU8iO30=', 1754981218),
	('HlQXeAW4Tfx7LldMxrI4nJckYF1gwfHsi8t1hTF7', NULL, '2404:8000:10a5:704:c03c:1f2f:f860:8a1a', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRUpURGtDMlQyc3FJYXdhcWFVeFVCT1pMRlhSMTBEck5tOVlMOVFyUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHBzOi8vNzJmY2E4NjRjMTE4Lm5ncm9rLWZyZWUuYXBwL3NjYW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1754896065),
	('KoiNJBVPOGr2gpCgzVdgEqpjNfmVKq77XUyBQjYu', NULL, '114.4.214.208', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiM3J2ZnlOWVBvRDg0WGVEa2NPNGxVd096R0kwbFl6UDhiOUJDaEFCNCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vNzJmY2E4NjRjMTE4Lm5ncm9rLWZyZWUuYXBwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoxMjoidGFibGVfbnVtYmVyIjtzOjU6IlgyNDM4IjtzOjQ6Im5hbWUiO3M6MDoiIjtzOjU6InBob25lIjtzOjA6IiI7fQ==', 1754901844),
	('RTIrbV7a1ksEIrUBO7VHV6k6GK54gGU0MjoGKPP9', NULL, '118.99.80.4', 'WhatsApp/2.23.20.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaGVKeWpZRktKaTJpNG1RUzVkSHJ2QmMyNTlMUUI4V2loRTRibkU3biI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vNzJmY2E4NjRjMTE4Lm5ncm9rLWZyZWUuYXBwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1754896058),
	('VLBJvpm7ZOKSTDhz72VnWc6wgnJOSOpIz7xZp6GK', NULL, '114.4.214.208', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiTUVqeWZHa3FNamFUYWFoOGdWZGo4Q2NoZm0xOE1ZUXFEOGUzYW5JdyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHBzOi8vNzJmY2E4NjRjMTE4Lm5ncm9rLWZyZWUuYXBwL3NjYW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjEyOiJ0YWJsZV9udW1iZXIiO3M6NToiWDI0MzgiO3M6NDoibmFtZSI7czo0OiJmZXIgIjtzOjU6InBob25lIjtzOjA6IiI7fQ==', 1754902070);

-- Dumping structure for table kasa_food.transactions
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `external_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `checkout_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barcodes_id` bigint unsigned NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtotal` int NOT NULL,
  `ppn` int NOT NULL,
  `total` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transactions_barcodes_id_foreign` (`barcodes_id`),
  CONSTRAINT `transactions_barcodes_id_foreign` FOREIGN KEY (`barcodes_id`) REFERENCES `barcodes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kasa_food.transactions: ~11 rows (approximately)
INSERT INTO `transactions` (`id`, `code`, `name`, `phone`, `external_id`, `checkout_link`, `barcodes_id`, `payment_method`, `payment_status`, `subtotal`, `ppn`, `total`, `created_at`, `updated_at`) VALUES
	(2, 'TRX_417612', 'Feri Ardiansyah', '6282233444888', 'a57af77d-656e-4961-bbff-ca126b4bedaa', 'https://checkout-staging.xendit.co/web/688caadbb7aa506fdff85aea', 1, 'BANK_TRANSFER', 'PAID', 179000, 19690, 198690, '2025-07-30 04:54:03', '2025-08-01 04:54:12'),
	(3, 'TRX_689287', 'Feri Ardiansyah', '6282233444888', '3ca4d801-1d25-4afe-b71e-47c6051e07be', 'https://checkout-staging.xendit.co/web/688caca09a5fcbb0e6654cc5', 1, 'BANK_TRANSFER', 'PAID', 104000, 11440, 115440, '2025-08-01 05:01:37', '2025-08-01 05:12:01'),
	(10, 'TRX_270739', 'Sufa', '628777321871', '85950e8e-3d19-4919-8334-71c43f29a218', 'https://checkout-staging.xendit.co/web/6890e1b74412903db2ed0e56', 1, 'BANK_TRANSFER', 'PAID', 27000, 2970, 29970, '2025-08-04 09:37:12', '2025-08-04 09:38:28'),
	(11, 'TRX_320433', 'Sufa', '6289676195640', 'd6372543-c885-4e9b-914d-40b3e25348aa', 'https://checkout-staging.xendit.co/web/6890f5034412903db2ed2d93', 3, 'BANK_TRANSFER', 'PAID', 27000, 2970, 29970, '2025-08-04 10:59:33', '2025-08-04 10:59:59'),
	(12, 'TRX_895797', 'Dimsz', '07887878787', '852bc3be-1798-48f3-84b9-d5d97c9da011', 'https://checkout-staging.xendit.co/web/6890f7714412903db2ed31c7', 3, 'BANK_TRANSFER', 'PAID', 102000, 11220, 113220, '2025-08-04 11:09:54', '2025-08-04 11:10:02'),
	(15, 'TRX_266543', 'Feri Ardiansyah', '6287879763456', 'd44c0f6d-9a4e-48f3-af6d-6c1addf5a9db', 'https://checkout-staging.xendit.co/web/6892f1311a081b4657bac225', 3, 'EWALLET', 'PAID', 75000, 8250, 83250, '2025-08-05 23:07:46', '2025-08-05 23:08:49'),
	(16, 'TRX_227963', 'Feri Ardiansyah', '6287879763456', '94ca2482-47ee-4a3f-80ee-ae00512523da', 'https://checkout-staging.xendit.co/web/6892fbcf42bcc146471e66c7', 3, 'PENDING', 'PENDING', 54000, 5940, 59940, '2025-08-05 23:53:05', '2025-08-05 23:53:05'),
	(17, 'TRX_205818', 'Feri Ardiansyah', '6287879763456', 'c389722e-f399-4d4b-a9ad-593dc6f936c7', 'https://checkout-staging.xendit.co/web/6892fbd21a081b4657bad4fc', 3, 'BANK_TRANSFER', 'PAID', 54000, 5940, 59940, '2025-08-05 23:53:07', '2025-08-05 23:53:34'),
	(18, 'TRX_300282', 'Feri Ardiansyah', '6287879763456', '56c2a8dc-f172-4552-ab01-092efec9ef96', 'https://checkout-staging.xendit.co/web/6892fbd41a081b4657bad4ff', 3, 'PENDING', 'PENDING', 54000, 5940, 59940, '2025-08-05 23:53:08', '2025-08-05 23:53:08'),
	(19, 'TRX_776257', 'Feri Ardiansyah', '6287879763456', '8279acf2-35dd-47bf-a654-a5cee552fac4', 'https://checkout-staging.xendit.co/web/6892fbd542bcc146471e66d2', 3, 'PENDING', 'PENDING', 54000, 5940, 59940, '2025-08-05 23:53:10', '2025-08-05 23:53:10'),
	(20, 'TRX_383883', 'Feri Ardiansyah', '6287879763456', 'd9bd2262-d309-495b-bc87-03be0681c45c', 'https://checkout-staging.xendit.co/web/689300841a081b4657badb8e', 3, 'BANK_TRANSFER', 'PAID', 105000, 11550, 116550, '2025-08-06 00:13:07', '2025-08-06 00:13:30'),
	(21, 'TRX_337329', 'Feri Ardiansyah', '6287879763456', '6227e2cd-d524-44a5-bd96-f36374536438', 'https://checkout-staging.xendit.co/web/6893030f1a081b4657bade51', 3, 'BANK_TRANSFER', 'PAID', 7500, 825, 8325, '2025-08-06 00:23:59', '2025-08-06 00:24:56'),
	(22, 'TRX_937875', 'Feri Ardiansyah', '6287879763456', 'be2723ab-1474-4cd1-8b9d-453d5cb9b66f', 'https://checkout-staging.xendit.co/web/689304be1a081b4657bae0e8', 3, 'BANK_TRANSFER', 'PAID', 130000, 14300, 144300, '2025-08-06 00:31:09', '2025-08-06 00:31:22'),
	(23, 'TRX_473505', 'adimas', '628791513164', '5925297b-fb68-40da-8906-70327ab2a9f4', 'https://checkout-staging.xendit.co/web/689648a01a081b4657c02e47', 3, 'BANK_TRANSFER', 'PAID', 161000, 17710, 178710, '2025-08-08 11:57:39', '2025-08-08 11:58:17');

-- Dumping structure for table kasa_food.transaction_items
CREATE TABLE IF NOT EXISTS `transaction_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `transaction_id` bigint unsigned NOT NULL,
  `foods_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL,
  `price` int NOT NULL,
  `subtotal` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `transaction_items_transaction_id_foreign` (`transaction_id`),
  KEY `transaction_items_foods_id_foreign` (`foods_id`),
  CONSTRAINT `transaction_items_foods_id_foreign` FOREIGN KEY (`foods_id`) REFERENCES `foods` (`id`) ON DELETE CASCADE,
  CONSTRAINT `transaction_items_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kasa_food.transaction_items: ~22 rows (approximately)
INSERT INTO `transaction_items` (`id`, `created_at`, `updated_at`, `transaction_id`, `foods_id`, `quantity`, `price`, `subtotal`) VALUES
	(3, '2025-08-01 04:54:03', '2025-08-01 04:54:03', 2, 1, 5, 25000, 125000),
	(4, '2025-08-01 04:54:03', '2025-08-01 04:54:03', 2, 2, 2, 27000, 54000),
	(5, '2025-08-01 05:01:37', '2025-08-01 05:01:37', 3, 2, 2, 27000, 54000),
	(6, '2025-08-01 05:01:37', '2025-08-01 05:01:37', 3, 1, 2, 25000, 50000),
	(14, '2025-08-04 09:37:12', '2025-08-04 09:37:12', 10, 2, 1, 27000, 27000),
	(15, '2025-08-04 10:59:33', '2025-08-04 10:59:33', 11, 2, 1, 27000, 27000),
	(16, '2025-08-04 11:09:54', '2025-08-04 11:09:54', 12, 1, 3, 25000, 75000),
	(17, '2025-08-04 11:09:54', '2025-08-04 11:09:54', 12, 2, 1, 27000, 27000),
	(20, '2025-08-05 23:07:46', '2025-08-05 23:07:46', 15, 1, 3, 25000, 75000),
	(21, '2025-08-05 23:53:05', '2025-08-05 23:53:05', 16, 2, 2, 27000, 54000),
	(22, '2025-08-05 23:53:07', '2025-08-05 23:53:07', 17, 2, 2, 27000, 54000),
	(23, '2025-08-05 23:53:08', '2025-08-05 23:53:08', 18, 2, 2, 27000, 54000),
	(24, '2025-08-05 23:53:10', '2025-08-05 23:53:10', 19, 2, 2, 27000, 54000),
	(25, '2025-08-06 00:13:07', '2025-08-06 00:13:07', 20, 3, 4, 7500, 30000),
	(26, '2025-08-06 00:13:07', '2025-08-06 00:13:07', 20, 1, 3, 25000, 75000),
	(27, '2025-08-06 00:23:59', '2025-08-06 00:23:59', 21, 3, 1, 7500, 7500),
	(28, '2025-08-06 00:31:09', '2025-08-06 00:31:09', 22, 3, 4, 7500, 30000),
	(29, '2025-08-06 00:31:09', '2025-08-06 00:31:09', 22, 1, 4, 25000, 100000),
	(30, '2025-08-08 11:57:39', '2025-08-08 11:57:39', 23, 8, 2, 23000, 46000),
	(31, '2025-08-08 11:57:39', '2025-08-08 11:57:39', 23, 3, 2, 7500, 15000),
	(32, '2025-08-08 11:57:39', '2025-08-08 11:57:39', 23, 14, 2, 23000, 46000),
	(33, '2025-08-08 11:57:39', '2025-08-08 11:57:39', 23, 16, 2, 27000, 54000);

-- Dumping structure for table kasa_food.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
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

-- Dumping data for table kasa_food.users: ~0 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Admin Kasa', 'adminkasa@gmail.com', NULL, '$2y$12$O6INl9ML.bN1po1bPQyc..uPxlhJfTFSTnzl6h669Fcl0BeI7vNmO', NULL, '2025-08-01 04:28:53', '2025-08-01 04:28:53');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
