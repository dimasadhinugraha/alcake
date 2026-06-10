-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 08, 2026 at 11:41 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alvacake`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Lapis Legit', '2026-05-23 22:53:58', '2026-05-23 22:53:58'),
(2, 'Black Forest', '2026-05-23 22:53:58', '2026-05-23 22:53:58'),
(3, 'Brownies', '2026-05-23 22:53:58', '2026-05-23 22:53:58'),
(4, 'Bolu Jadoel', '2026-05-23 22:53:58', '2026-05-23 22:53:58'),
(5, 'Dessert Box', '2026-05-23 22:53:58', '2026-05-23 22:53:58');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` decimal(10,2) NOT NULL DEFAULT '0.00',
  `min_stock` decimal(10,2) NOT NULL DEFAULT '10.00',
  `max_stock` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`id`, `name`, `unit`, `stock`, `min_stock`, `max_stock`, `created_at`, `updated_at`) VALUES
(1, 'Tepung Terigu', 'kg', 100.00, 10.00, NULL, '2026-05-23 22:53:58', '2026-05-23 22:53:58'),
(2, 'Gula Pasir', 'kg', 50.00, 5.00, NULL, '2026-05-23 22:53:58', '2026-05-23 22:53:58'),
(3, 'Coklat Bubuk', 'gram', 10000.00, 1000.00, NULL, '2026-05-23 22:53:58', '2026-05-23 22:53:58'),
(4, 'Mentega Butter', 'kg', 40.00, 4.00, NULL, '2026-05-23 22:53:58', '2026-05-23 22:53:58'),
(5, 'Telur Ayam', 'butir', 500.00, 50.00, NULL, '2026-05-23 22:53:58', '2026-05-23 22:53:58'),
(6, 'Susu Cair', 'liter', 30.00, 5.00, NULL, '2026-05-23 22:53:58', '2026-05-23 22:53:58'),
(7, 'Keju Cheddar', 'kg', 15.00, 2.00, NULL, '2026-05-23 22:53:58', '2026-05-23 22:53:58'),
(8, 'Pandan Paste', 'botol', 10.00, 1.00, NULL, '2026-05-23 22:53:58', '2026-05-23 22:53:58'),
(9, 'Whip Cream', 'liter', 20.00, 3.00, NULL, '2026-05-23 22:53:58', '2026-05-23 22:53:58');

-- --------------------------------------------------------

--
-- Table structure for table `material_histories`
--

CREATE TABLE `material_histories` (
  `id` bigint UNSIGNED NOT NULL,
  `material_id` bigint UNSIGNED NOT NULL,
  `material_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('inbound','outbound') COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` decimal(10,2) NOT NULL,
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `material_histories`
--

INSERT INTO `material_histories` (`id`, `material_id`, `material_name`, `type`, `qty`, `notes`, `product_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Tepung Terigu', 'inbound', 50.00, 'Pengadaan awal bahan baku tepung terigu premium', NULL, '2026-05-23 22:53:59', '2026-05-23 22:53:59'),
(2, 2, 'Gula Pasir', 'inbound', 30.00, 'Pembelian gula pasir bermerek di agen', NULL, '2026-05-23 22:53:59', '2026-05-23 22:53:59'),
(3, 4, 'Mentega Butter', 'inbound', 20.00, 'Restock mentega butter wisman impor', NULL, '2026-05-23 22:53:59', '2026-05-23 22:53:59'),
(4, 1, 'Tepung Terigu', 'outbound', 2.50, 'Produksi 5 unit kue pesanan', 'Lapis Legit Original', '2026-05-23 22:53:59', '2026-05-23 22:53:59'),
(5, 3, 'Coklat Bubuk', 'outbound', 450.00, 'Produksi 3 unit brownies coklat lumer', 'Brownies Coklat Lumer', '2026-05-23 22:53:59', '2026-05-23 22:53:59');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_04_10_153548_create_materials_table', 1),
(5, '2026_04_10_153550_create_products_table', 1),
(6, '2026_04_12_132609_add_stock_and_category_to_products_table', 1),
(7, '2026_04_12_133120_add_description_to_products_table', 1),
(8, '2026_04_25_185411_add_min_stock_to_materials_table', 1),
(9, '2026_04_26_163450_create_material_histories_table', 1),
(10, '2026_04_26_173300_create_recipes_table', 1),
(11, '2026_04_26_173310_create_recipe_ingredients_table', 1),
(12, '2026_04_26_185355_create_transactions_table', 1),
(13, '2026_04_26_190831_create_orders_table', 1),
(14, '2026_05_20_000000_create_categories_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `customer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_date` date NOT NULL,
  `finish_date` date DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `total` decimal(12,2) NOT NULL DEFAULT '0.00',
  `products` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer`, `phone`, `status`, `order_date`, `finish_date`, `notes`, `total`, `products`, `created_at`, `updated_at`) VALUES
(1, 'Budi Santoso', '081234567890', 'Pending', '2026-05-24', '2026-05-26', 'Minta topping coklat ganache-nya agak tebal ya kak. Terima kasih!', 225000.00, '[{\"id\": 10, \"qty\": 3, \"name\": \"Brownies Coklat Lumer\", \"price\": 75000, \"subtotal\": 225000}]', '2026-05-23 22:53:59', '2026-05-23 22:53:59'),
(2, 'Siti Rahma', '082345678901', 'Diproses', '2026-05-23', '2026-05-26', 'Untuk arisan keluarga besar hari minggu sore.', 500000.00, '[{\"id\": 1, \"qty\": 2, \"name\": \"Lapis Legit Original\", \"price\": 250000, \"subtotal\": 500000}]', '2026-05-23 22:53:59', '2026-05-23 22:53:59'),
(3, 'Rian Hidayat', '083456789012', 'Selesai', '2026-05-19', '2026-05-21', 'Tulis ucapan \"Happy Birthday Ayah\" warna merah muda di atas kue.', 275000.00, '[{\"id\": 6, \"qty\": 1, \"name\": \"Black Forest Classic\", \"price\": 180000, \"subtotal\": 180000}, {\"id\": 9, \"qty\": 1, \"name\": \"Black Forest Roll\", \"price\": 95000, \"subtotal\": 95000}]', '2026-05-23 22:53:59', '2026-05-23 22:53:59'),
(4, 'Dewi Lestari', '084567890123', 'Dibatalkan', '2026-05-22', '2026-05-24', 'Batal dipesan karena acara mendadak diundur.', 96000.00, '[{\"id\": 21, \"qty\": 2, \"name\": \"Dessert Box Red Velvet Cheese\", \"price\": 48000, \"subtotal\": 96000}]', '2026-05-23 22:53:59', '2026-05-23 22:53:59'),
(5, 'Agus Pratama', '085678901234', 'Diproses', '2026-05-24', '2026-05-26', 'Tolong di-packing per kotak rapi untuk oleh-oleh.', 220000.00, '[{\"id\": 22, \"qty\": 2, \"name\": \"Dessert Box Lotus Biscoff\", \"price\": 50000, \"subtotal\": 100000}, {\"id\": 17, \"qty\": 2, \"name\": \"Bolu Chiffon Pandan Santan\", \"price\": 60000, \"subtotal\": 120000}]', '2026-05-23 22:53:59', '2026-05-23 22:53:59');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `price` decimal(15,2) NOT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `description` text COLLATE utf8mb4_unicode_ci,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pcs',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_id`, `name`, `category`, `category_id`, `price`, `stock`, `status`, `description`, `unit`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'Lapis Legit Original', 'Lapis Legit', 1, 250000.00, 15, 'aktif', 'Lapis Legit klasik premium dengan aroma bumbu spekuk yang harum dan tekstur super lembut.', 'pcs', NULL, '2026-05-23 22:53:58', '2026-05-23 22:53:58'),
(2, 1, 'Lapis Legit Keju', 'Lapis Legit', 1, 280000.00, 10, 'aktif', 'Lapis Legit premium dengan parutan keju cheddar berkualitas di setiap lapisannya.', 'pcs', NULL, '2026-05-23 22:53:58', '2026-05-23 22:53:58'),
(3, 1, 'Lapis Legit Prunes', 'Lapis Legit', 1, 320000.00, 8, 'aktif', 'Lapis Legit premium dengan potongan buah prunes (plum kering) asam-manis segar.', 'pcs', NULL, '2026-05-23 22:53:58', '2026-05-23 22:53:58'),
(4, 1, 'Lapis Legit Pandan', 'Lapis Legit', 1, 260000.00, 12, 'aktif', 'Lapis Legit dengan aroma pandan segar alami dari perasan daun suji dan pandan asli.', 'pcs', NULL, '2026-05-23 22:53:58', '2026-05-23 22:53:58'),
(5, 1, 'Lapis Legit Almond', 'Lapis Legit', 1, 290000.00, 7, 'aktif', 'Lapis Legit premium yang ditaburi irisan kacang almond renyah di bagian atasnya.', 'pcs', NULL, '2026-05-23 22:53:58', '2026-05-23 22:53:58'),
(6, 1, 'Black Forest Classic', 'Black Forest', 2, 180000.00, 20, 'aktif', 'Kue coklat spons lembut khas Jerman dengan lapisan krim kocok, buah ceri hitam, dan parutan coklat melimpah.', 'pcs', NULL, '2026-05-23 22:53:58', '2026-05-23 22:53:58'),
(7, 1, 'Premium Black Forest Fudge', 'Black Forest', 2, 240000.00, 10, 'aktif', 'Kombinasi brownies fudge coklat pekat dengan dark cherry premium dan chocolate ganache.', 'pcs', NULL, '2026-05-23 22:53:58', '2026-05-23 22:53:58'),
(8, 1, 'White Forest Cake', 'Black Forest', 2, 175000.00, 12, 'aktif', 'Kue bolu vanila lembut dengan krim segar, buah ceri merah manis, dan taburan coklat putih serut.', 'pcs', NULL, '2026-05-23 22:53:58', '2026-05-23 22:53:58'),
(9, 1, 'Black Forest Roll', 'Black Forest', 2, 95000.00, 15, 'aktif', 'Bolu gulung coklat dengan krim mentega ceri hitam, dibalut coklat serut melimpah.', 'pcs', NULL, '2026-05-23 22:53:58', '2026-05-23 22:53:58'),
(10, 1, 'Brownies Coklat Lumer', 'Brownies', 3, 75000.00, 25, 'aktif', 'Brownies panggang super fudgy dengan siraman coklat ganache premium yang lumer di mulut.', 'pcs', NULL, '2026-05-23 22:53:58', '2026-05-23 22:53:58'),
(11, 1, 'Brownies Panggang Almond', 'Brownies', 3, 68000.00, 30, 'aktif', 'Brownies panggang renyah di luar, chewy di dalam, dengan taburan kacang almond panggang melimpah.', 'pcs', NULL, '2026-05-23 22:53:58', '2026-05-23 22:53:58'),
(12, 1, 'Brownies Kukus Keju', 'Brownies', 3, 65000.00, 18, 'aktif', 'Brownies kukus coklat lembut berpadu dengan lapisan cream cheese gurih di tengahnya.', 'pcs', NULL, '2026-05-23 22:53:58', '2026-05-23 22:53:58'),
(13, 1, 'Matcha Almond Brownies', 'Brownies', 3, 80000.00, 15, 'aktif', 'Brownies premium dengan bubuk Uji Matcha Jepang asli dan white chocolate chips.', 'pcs', NULL, '2026-05-23 22:53:58', '2026-05-23 22:53:58'),
(14, 1, 'Brownies Sekat Premium', 'Brownies', 3, 85000.00, 22, 'aktif', 'Brownies sekat isi 25 potong dengan 5 macam topping: Keju, Almond, Chocochips, Oreo, & Beng-Beng.', 'pcs', NULL, '2026-05-23 22:53:58', '2026-05-23 22:53:58'),
(15, 1, 'Bolu Tape Keju Singkong', 'Bolu Jadoel', 4, 55000.00, 20, 'aktif', 'Bolu tape singkong tradisional yang wangi, lembut, bertabur keju parut melimpah.', 'pcs', NULL, '2026-05-23 22:53:58', '2026-05-23 22:53:58'),
(16, 1, 'Bolu Macan Bangka', 'Bolu Jadoel', 4, 70000.00, 15, 'aktif', 'Butter cake premium dengan motif marmer macan khas Bangka yang super lembut dan wangi mentega.', 'pcs', NULL, '2026-05-23 22:53:59', '2026-05-23 22:53:59'),
(17, 1, 'Bolu Chiffon Pandan Santan', 'Bolu Jadoel', 4, 60000.00, 18, 'aktif', 'Chiffon cake super membal dan lembut dengan aroma perasan daun pandan murni dan santan segar.', 'pcs', NULL, '2026-05-23 22:53:59', '2026-05-23 22:53:59'),
(18, 1, 'Bolu Gulung Selai Nanas', 'Bolu Jadoel', 4, 50000.00, 25, 'aktif', 'Bolu gulung lembut tradisional dengan isian selai nanas buatan sendiri yang asam manis segar.', 'pcs', NULL, '2026-05-23 22:53:59', '2026-05-23 22:53:59'),
(19, 1, 'Bolu Gulung Keju Meses', 'Bolu Jadoel', 4, 58000.00, 20, 'aktif', 'Bolu gulung klasik dengan buttercream premium, keju cheddar parut, dan meses coklat.', 'pcs', NULL, '2026-05-23 22:53:59', '2026-05-23 22:53:59'),
(20, 1, 'Dessert Box Turkish Choco', 'Dessert Box', 5, 45000.00, 35, 'aktif', 'Dessert box premium dengan lapisan cake coklat, mousse belgian chocolate, dan siraman chocolate ganache kental.', 'pcs', NULL, '2026-05-23 22:53:59', '2026-05-23 22:53:59'),
(21, 1, 'Dessert Box Red Velvet Cheese', 'Dessert Box', 5, 48000.00, 30, 'aktif', 'Dessert box dengan remah red velvet gurih manis berpadu krim keju mascarpone yang lumer.', 'pcs', NULL, '2026-05-23 22:53:59', '2026-05-23 22:53:59'),
(22, 1, 'Dessert Box Lotus Biscoff', 'Dessert Box', 5, 50000.00, 25, 'aktif', 'Dessert box kekinian dengan biskuit Lotus renyah, selai Lotus Biscoff melimpah, dan krim lembut.', 'pcs', NULL, '2026-05-23 22:53:59', '2026-05-23 22:53:59'),
(23, 1, 'Dessert Box Classic Tiramisu', 'Dessert Box', 5, 46000.00, 28, 'aktif', 'Dessert box ala Italia dengan ladyfinger yang direndam espresso premium dan krim mascarpone gurih.', 'pcs', NULL, '2026-05-23 22:53:59', '2026-05-23 22:53:59'),
(24, 1, 'Dessert Box Cadbury Oreo', 'Dessert Box', 5, 47000.00, 32, 'aktif', 'Perpaduan renyah remah biskuit Oreo, mousse putih susu, dan potongan coklat Cadbury premium.', 'pcs', NULL, '2026-05-23 22:53:59', '2026-05-23 22:53:59');

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `id` bigint UNSIGNED NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`id`, `product_name`, `created_at`, `updated_at`) VALUES
(1, 'Brownies Coklat Lumer', '2026-05-23 22:53:59', '2026-05-23 22:53:59'),
(2, 'Lapis Legit Original', '2026-05-23 22:53:59', '2026-05-23 22:53:59'),
(3, 'Black Forest Classic', '2026-05-23 22:53:59', '2026-05-23 22:53:59');

-- --------------------------------------------------------

--
-- Table structure for table `recipe_ingredients`
--

CREATE TABLE `recipe_ingredients` (
  `id` bigint UNSIGNED NOT NULL,
  `recipe_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` decimal(10,2) NOT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recipe_ingredients`
--

INSERT INTO `recipe_ingredients` (`id`, `recipe_id`, `name`, `qty`, `unit`, `created_at`, `updated_at`) VALUES
(1, 1, 'Tepung Terigu', 0.40, 'kg', '2026-05-23 22:53:59', '2026-05-23 22:53:59'),
(2, 1, 'Gula Pasir', 0.25, 'kg', '2026-05-23 22:53:59', '2026-05-23 22:53:59'),
(3, 1, 'Coklat Bubuk', 150.00, 'gram', '2026-05-23 22:53:59', '2026-05-23 22:53:59'),
(4, 1, 'Mentega Butter', 0.20, 'kg', '2026-05-23 22:53:59', '2026-05-23 22:53:59'),
(5, 1, 'Telur Ayam', 4.00, 'butir', '2026-05-23 22:53:59', '2026-05-23 22:53:59'),
(6, 2, 'Mentega Butter', 0.50, 'kg', '2026-05-23 22:53:59', '2026-05-23 22:53:59'),
(7, 2, 'Gula Pasir', 0.30, 'kg', '2026-05-23 22:53:59', '2026-05-23 22:53:59'),
(8, 2, 'Telur Ayam', 30.00, 'butir', '2026-05-23 22:53:59', '2026-05-23 22:53:59'),
(9, 2, 'Tepung Terigu', 0.10, 'kg', '2026-05-23 22:53:59', '2026-05-23 22:53:59'),
(10, 3, 'Tepung Terigu', 0.20, 'kg', '2026-05-23 22:53:59', '2026-05-23 22:53:59'),
(11, 3, 'Gula Pasir', 0.20, 'kg', '2026-05-23 22:53:59', '2026-05-23 22:53:59'),
(12, 3, 'Telur Ayam', 8.00, 'butir', '2026-05-23 22:53:59', '2026-05-23 22:53:59'),
(13, 3, 'Coklat Bubuk', 50.00, 'gram', '2026-05-23 22:53:59', '2026-05-23 22:53:59'),
(14, 3, 'Whip Cream', 0.50, 'liter', '2026-05-23 22:53:59', '2026-05-23 22:53:59');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('iJaEk14yhNU09faf8NM2f1x4OHDK1b8vN50EZUeP', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'eyJfdG9rZW4iOiJHaXJVTVJFUE05alloTGpKMkxCcmFEVFRoRENGNVBraXB3THFlYXMwIiwidXJsIjpbXSwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9yZWNpcGVzIiwicm91dGUiOiJyZWNpcGVzLmluZGV4In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjF9', 1780937063);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `customer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Admin Alva Cake',
  `type` enum('Lunas','DP') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Lunas','Belum Lunas') COLLATE utf8mb4_unicode_ci NOT NULL,
  `paid` decimal(12,2) NOT NULL,
  `total` decimal(12,2) NOT NULL,
  `payment_date` date NOT NULL,
  `dp_nota` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `settlement_nota` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `products` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `order_id`, `customer`, `admin`, `type`, `status`, `paid`, `total`, `payment_date`, `dp_nota`, `settlement_nota`, `notes`, `products`, `created_at`, `updated_at`) VALUES
(1, 3, 'Rian Hidayat', 'Admin Alva Cake', 'Lunas', 'Lunas', 275000.00, 275000.00, '2026-05-19', NULL, NULL, 'Tulis ucapan \"Happy Birthday Ayah\" warna merah muda di atas kue.', '[{\"id\": 6, \"qty\": 1, \"name\": \"Black Forest Classic\", \"price\": 180000, \"subtotal\": 180000}, {\"id\": 9, \"qty\": 1, \"name\": \"Black Forest Roll\", \"price\": 95000, \"subtotal\": 95000}]', '2026-05-23 22:53:59', '2026-05-23 22:53:59'),
(2, 2, 'Siti Rahma', 'Admin Alva Cake', 'DP', 'Belum Lunas', 200000.00, 500000.00, '2026-05-23', 'DP-001', NULL, 'Untuk arisan keluarga besar hari minggu sore.', '[{\"id\": 1, \"qty\": 2, \"name\": \"Lapis Legit Original\", \"price\": 250000, \"subtotal\": 500000}]', '2026-05-23 22:53:59', '2026-05-23 22:53:59'),
(3, 5, 'Agus Pratama', 'Admin Alva Cake', 'Lunas', 'Lunas', 220000.00, 220000.00, '2026-05-24', NULL, NULL, 'Tolong di-packing per kotak rapi untuk oleh-oleh.', '[{\"id\": 22, \"qty\": 2, \"name\": \"Dessert Box Lotus Biscoff\", \"price\": 50000, \"subtotal\": 100000}, {\"id\": 17, \"qty\": 2, \"name\": \"Bolu Chiffon Pandan Santan\", \"price\": 60000, \"subtotal\": 120000}]', '2026-05-23 22:53:59', '2026-05-23 22:53:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Alva Cake', 'admin@admin.com', NULL, '$2y$12$qyq0TZA5M.JzmLkPPPMeBu2QPTHLnOHf4p1IJRIk7jBo8h1EPIqq6', NULL, '2026-05-23 22:53:58', '2026-05-23 22:53:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `materials_name_unique` (`name`);

--
-- Indexes for table `material_histories`
--
ALTER TABLE `material_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `material_histories_material_id_foreign` (`material_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_user_id_foreign` (`user_id`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `recipes_product_name_unique` (`product_name`);

--
-- Indexes for table `recipe_ingredients`
--
ALTER TABLE `recipe_ingredients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recipe_ingredients_recipe_id_foreign` (`recipe_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_order_id_foreign` (`order_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `material_histories`
--
ALTER TABLE `material_histories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `recipe_ingredients`
--
ALTER TABLE `recipe_ingredients`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `material_histories`
--
ALTER TABLE `material_histories`
  ADD CONSTRAINT `material_histories_material_id_foreign` FOREIGN KEY (`material_id`) REFERENCES `materials` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `recipe_ingredients`
--
ALTER TABLE `recipe_ingredients`
  ADD CONSTRAINT `recipe_ingredients_recipe_id_foreign` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
