-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2021 at 09:05 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'Fruit Punches', '1622124913_fruit-punches.png', '2021-05-27 14:15:13', '2021-05-27 14:15:13'),
(2, 'Yogurt', '1622124937_yogurt.png', '2021-05-27 14:15:37', '2021-05-27 14:15:37'),
(3, 'Fresh Juices', '1622124955_fresh-juice.png', '2021-05-27 14:15:55', '2021-05-27 14:15:55'),
(4, 'Smoothies', '1622124968_smoothies.png', '2021-05-27 14:16:08', '2021-05-27 14:16:08'),
(5, 'Milk Shakes', '1622124984_milkshake.png', '2021-05-27 14:16:24', '2021-05-27 14:16:24'),
(6, 'Fruit Coffees', '1622124997_coffee.png', '2021-05-27 14:16:37', '2021-05-27 14:16:37'),
(7, 'Special Menu', '1622125010_special.png', '2021-05-27 14:16:50', '2021-05-27 14:16:50');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2021_03_15_141238_create_pemilik_table', 1),
(2, '2021_03_15_141315_create_pegawai_table', 1),
(3, '2021_03_15_141345_create_supplier_table', 1),
(4, '2021_03_15_141404_create_kategori_table', 1),
(5, '2021_03_15_141426_create_produk_table', 1),
(6, '2021_03_15_141506_create_transaksi_table', 1),
(7, '2021_03_15_141533_create_transaksi_detail_table', 1),
(8, '2016_06_01_000001_create_oauth_auth_codes_table', 2),
(9, '2016_06_01_000002_create_oauth_access_tokens_table', 2),
(10, '2016_06_01_000003_create_oauth_refresh_tokens_table', 2),
(11, '2016_06_01_000004_create_oauth_clients_table', 2),
(12, '2016_06_01_000005_create_oauth_personal_access_clients_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'Zvewd78Pmpot81Wok6RoVxkVLMAsRl7uV9Nox74l', NULL, 'http://localhost', 1, 0, 0, '2021-04-18 15:29:38', '2021-04-18 15:29:38'),
(2, NULL, 'Laravel Password Grant Client', 'rFGzX7wykHWt1OuOK1n5mzzvdnhyXXSs0ICIqX87', 'pemilik', 'http://localhost', 0, 1, 0, '2021-04-18 15:29:57', '2021-04-18 15:29:57');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2021-04-18 15:29:38', '2021-04-18 15:29:38');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id`, `nama`, `email`, `email_verified_at`, `password`, `alamat`, `no_hp`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Triana Dyah Pangestuti', 'triana@gmail.com', NULL, '$2y$10$9NS.NTkE6dog4e4r531ryuqmCBoArN3.tg1vu.tXpyN6kULPY1iMS', 'Indramayu', '087777733322', NULL, '2021-03-21 04:28:25', '2021-05-31 13:09:27'),
(2, 'Ayunda Riyanti', 'ayunda@gmail.com', NULL, '$2y$10$nkFJZz0dbyHXDvLnjIpR3.YxcDhOyRwNyfGfgu8We9hfRYVIAT5/S', 'Indramayu', '08742131312', NULL, '2021-03-21 04:28:47', '2021-05-31 13:10:15'),
(3, 'Pegawai Shervie Juice', 'pegawai@gmail.com', NULL, '$2y$10$FmL5k4d5Pse6l6clE1CAlO3w3jVFOvitk6IV8WDMlQB9aUcMSR1pK', 'Indramayu', '08923123123', NULL, '2021-03-21 04:29:18', '2021-05-31 13:11:09'),
(8, 'Pegawai Satu', 'pegawaidua@gmail.com', NULL, '$2y$10$mOQIPefX/.waVb5/H.iUuOL2MuaUVtHAfapTyWpLRgRVP0t30ZDka', 'Indramayu', '089123123131', NULL, '2021-04-13 03:11:50', '2021-04-13 03:11:50'),
(14, 'Pegawai Testing', 'pegawaitesting@gmail.com', NULL, '$2y$10$BQRZTyoDm10mARCqb6PcUe.4vTQ5Vh3fn0O4VC3cbaQulX/4aMk8q', 'Indramayu', '089123131231', NULL, '2021-05-31 09:50:59', '2021-06-02 11:31:44'),
(24, 'Mizza', 'mizza@gmail.com', NULL, '$2y$10$n8/l24en4WqzaC1cqMugy.s4oPBqBEmewMyS6Qf/QBZDr2zTsLRy2', 'Indramayu', '089123123', NULL, '2021-06-05 06:52:20', '2021-06-05 06:52:20');

-- --------------------------------------------------------

--
-- Table structure for table `pemilik`
--

CREATE TABLE `pemilik` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemilik`
--

INSERT INTO `pemilik` (`id`, `nama`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Dimas Addriansyah', 'dimas@gmail.com', NULL, '$2y$10$MDxo10Ztqixu.3/vc1sIT.aPAfijvCWjlF5CFarebfJbWCKGIw2yK', NULL, '2021-03-15 07:27:24', '2021-03-15 07:27:24'),
(2, 'pemilik', 'pemilik@gmail.com', NULL, '$2y$10$2Qt1NetvltlW7HFx/Ibqy.xOiEqFvmoPgG.CA7LfdcyFF947cj726', NULL, '2021-03-15 07:27:24', '2021-03-15 07:27:24');

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id` int(11) NOT NULL,
  `keterangan` varchar(225) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengaturan`
--

INSERT INTO `pengaturan` (`id`, `keterangan`, `stok`) VALUES
(1, 'Habis', 0),
(3, 'Kritis', 5);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_id` bigint(20) UNSIGNED NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `stok_masuk` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `supplier_id`, `nama`, `kategori_id`, `harga`, `stok`, `stok_masuk`, `created_at`, `updated_at`) VALUES
(1, 5, 'Alpukat', 7, 8500, 0, 20, '2021-04-22 08:58:55', '2021-04-22 09:47:17'),
(2, 5, 'Anggur', 7, 9500, 15, 20, '2021-04-22 08:59:23', '2021-05-31 12:48:06'),
(3, 5, 'Apel', 7, 9500, 15, 20, '2021-04-22 08:59:51', '2021-06-05 06:55:12'),
(4, 6, 'Blackberry', 5, 11500, 0, 20, '2021-04-22 09:00:30', '2021-04-22 09:00:30'),
(5, 6, 'Buah Naga', 5, 10500, 7, 20, '2021-04-22 09:00:52', '2021-06-05 06:53:58'),
(6, 6, 'Durian', 5, 16000, 18, 20, '2021-04-22 09:01:10', '2021-05-05 09:05:13'),
(7, 2, 'Jambu', 2, 8500, 13, 20, '2021-04-22 09:02:23', '2021-05-28 07:38:33'),
(8, 2, 'Sirsak', 2, 8500, 18, 20, '2021-04-22 09:02:47', '2021-05-07 08:27:55'),
(9, 2, 'Strawberry', 2, 9500, 10, 20, '2021-04-22 09:03:19', '2021-05-31 12:30:47'),
(10, 1, 'Cappuccino', 6, 10000, 8, 10, '2021-04-22 09:04:24', '2021-04-22 09:47:17'),
(11, 1, 'Dark Chocolate', 6, 10000, 4, 6, '2021-04-22 09:04:48', '2021-06-05 06:55:12'),
(12, 1, 'Milo', 6, 10000, 9, 9, '2021-04-22 09:05:07', '2021-04-22 09:05:07');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `alamat`, `no_hp`, `created_at`, `updated_at`) VALUES
(1, 'Gudang Rabat', 'Pasar Baru Indramayu', '089467231231', '2021-03-21 04:31:02', '2021-03-21 04:31:02'),
(2, 'Toko Makmur', 'Pasar Mambo Indramayu', '0895231321', '2021-04-10 15:06:47', '2021-04-10 15:06:47'),
(3, 'Strawberry Ciwidey', 'Bandung, Jawa Barat', '089888777666', '2021-04-11 07:33:14', '2021-04-11 07:33:14'),
(5, 'Supllier Satu', 'Indramayu', '089213123', '2021-04-13 03:12:19', '2021-04-13 03:12:19'),
(6, 'Supplier Dua', 'Indramayu', '08988877762', '2021-04-22 08:56:50', '2021-04-22 08:56:50');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pegawai_id` bigint(20) UNSIGNED NOT NULL,
  `nama_pembeli` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah_harga` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uang_bayar` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `pegawai_id`, `nama_pembeli`, `jumlah_harga`, `status`, `uang_bayar`, `created_at`, `updated_at`) VALUES
(1, 1, 'Dimas Addriansyah Pamungkas', 19000, '1', 20000, '2021-05-28 08:10:48', '2021-05-31 12:30:22'),
(2, 2, 'Zulfa Khoerul Mar\'ah', 95000, '1', 100000, '2021-05-31 12:29:54', '2021-05-31 12:30:47'),
(3, 2, 'Zulfa Khoerul Mar\'ah', 19000, '1', 20000, '2021-05-31 12:34:47', '2021-05-31 12:48:06'),
(4, 24, 'Metha', 71000, '1', 80000, '2021-06-05 06:52:45', '2021-06-05 06:53:58'),
(5, 24, 'Acong', 29000, '1', 30000, '2021-06-05 06:54:51', '2021-06-05 06:55:12');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaksi_id` bigint(20) UNSIGNED NOT NULL,
  `produk_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah_beli` int(11) NOT NULL,
  `jumlah_harga` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`id`, `transaksi_id`, `produk_id`, `jumlah_beli`, `jumlah_harga`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 2, 19000, '2021-05-28 08:10:48', '2021-05-28 08:10:56'),
(2, 2, 9, 10, 95000, '2021-05-31 12:29:54', '2021-05-31 12:29:54'),
(3, 3, 2, 2, 19000, '2021-05-31 12:34:48', '2021-05-31 12:34:48'),
(4, 4, 5, 4, 42000, '2021-06-05 06:52:46', '2021-06-05 06:53:18'),
(5, 4, 3, 2, 19000, '2021-06-05 06:52:57', '2021-06-05 06:52:57'),
(6, 4, 11, 1, 10000, '2021-06-05 06:53:09', '2021-06-05 06:53:09'),
(7, 5, 11, 1, 10000, '2021-06-05 06:54:51', '2021-06-05 06:54:51'),
(8, 5, 3, 2, 19000, '2021-06-05 06:54:59', '2021-06-05 06:54:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pegawai_email_unique` (`email`);

--
-- Indexes for table `pemilik`
--
ALTER TABLE `pemilik`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pemilik_email_unique` (`email`);

--
-- Indexes for table `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produk_supplier_id_foreign` (`supplier_id`),
  ADD KEY `produk_kategori_id_foreign` (`kategori_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_pegawai_id_foreign` (`pegawai_id`);

--
-- Indexes for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_detail_transaksi_id_foreign` (`transaksi_id`),
  ADD KEY `transaksi_detail_produk_id_foreign` (`produk_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `pemilik`
--
ALTER TABLE `pemilik`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`),
  ADD CONSTRAINT `produk_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_pegawai_id_foreign` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`id`);

--
-- Constraints for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `transaksi_detail_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`),
  ADD CONSTRAINT `transaksi_detail_transaksi_id_foreign` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
