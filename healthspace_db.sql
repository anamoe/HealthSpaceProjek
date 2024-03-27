-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 27, 2024 at 12:16 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `healthspace_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` bigint UNSIGNED NOT NULL,
  `konsul_id` bigint UNSIGNED NOT NULL,
  `pasien_id` bigint UNSIGNED NOT NULL,
  `dokter_id` bigint UNSIGNED NOT NULL,
  `isi_chat` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dokters`
--

CREATE TABLE `dokters` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `poli_id` bigint UNSIGNED NOT NULL,
  `spesialis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dokters`
--

INSERT INTO `dokters` (`id`, `user_id`, `poli_id`, `spesialis`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 'Jantung Hati', '2024-03-23 10:08:00', '2024-03-23 10:28:19');

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
-- Table structure for table `jadwal_praktik_dokters`
--

CREATE TABLE `jadwal_praktik_dokters` (
  `id` bigint UNSIGNED NOT NULL,
  `dokter_id` bigint UNSIGNED NOT NULL,
  `hari_praktik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_praktik_awal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_praktik_akhir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jadwal_praktik_dokters`
--

INSERT INTO `jadwal_praktik_dokters` (`id`, `dokter_id`, `hari_praktik`, `jam_praktik_awal`, `jam_praktik_akhir`, `created_at`, `updated_at`) VALUES
(1, 1, 'jumat', '15:00', '21:00', '2024-03-23 10:15:47', '2024-03-23 10:38:34');

-- --------------------------------------------------------

--
-- Table structure for table `konsuls`
--

CREATE TABLE `konsuls` (
  `id` bigint UNSIGNED NOT NULL,
  `konsultasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_konsultasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pasien_id` bigint UNSIGNED NOT NULL,
  `dokter_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `konsuls`
--

INSERT INTO `konsuls` (`id`, `konsultasi`, `tgl_konsultasi`, `pasien_id`, `dokter_id`, `created_at`, `updated_at`) VALUES
(1, 'mata', '2024-03-23', 1, 1, '2024-03-23 10:08:00', '2024-03-23 10:08:00');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_03_18_023001_create_polis_table', 1),
(6, '2024_03_18_023006_create_dokters_table', 1),
(7, '2024_03_18_023106_create_pasiens_table', 1),
(8, '2024_03_18_030407_create_konsuls_table', 1),
(9, '2024_03_18_030704_create_pembayarans_table', 1),
(10, '2024_03_18_031139_create_chats_table', 1),
(11, '2024_03_23_160214_create_jadwal_praktik_dokters_table', 1),
(12, '2024_03_27_051027_add_google_columns_to_users_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pasiens`
--

CREATE TABLE `pasiens` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_telp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `berat_badan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tinggi_badan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pasiens`
--

INSERT INTO `pasiens` (`id`, `user_id`, `jenis_kelamin`, `no_telp`, `tanggal_lahir`, `alamat`, `berat_badan`, `tinggi_badan`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-23 10:08:00', '2024-03-23 10:08:00'),
(2, 6, NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-26 22:48:06', '2024-03-26 22:48:06');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembayarans`
--

CREATE TABLE `pembayarans` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `konsul_id` bigint UNSIGNED NOT NULL,
  `jumlah_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metode_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `polis`
--

CREATE TABLE `polis` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_poli` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `polis`
--

INSERT INTO `polis` (`id`, `nama_poli`, `created_at`, `updated_at`) VALUES
(1, 'Poli Umum', '2024-03-23 10:08:00', '2024-03-23 10:08:00'),
(2, 'Poli Gigi', '2024-03-23 10:08:00', '2024-03-23 10:08:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gauth_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gauth_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `role`, `email`, `password`, `profil`, `remember_token`, `created_at`, `updated_at`, `google_id`, `gauth_id`, `gauth_type`) VALUES
(1, 'Admin', 'admin', 'admin@gmail.com', '$2y$10$GspWDQzzHU6B813z9b5G0usRAa9Hd/v48SrVHc57H1TgjyhRYcdru', 'profil.jpg', NULL, '2024-03-23 10:08:00', '2024-03-23 10:08:00', NULL, NULL, NULL),
(2, 'Pasien Elen', 'pasien', 'pasien@gmail.com', '$2y$10$EfOiCVKyPoQ9fSa63IZxa.dpIROhmKASWT/Ir0OQpZfA5TY5AluNe', 'profil.jpg', NULL, '2024-03-23 10:08:00', '2024-03-23 10:08:00', NULL, NULL, NULL),
(3, 'Dokter Anam', 'dokter', 'dokter@gmail.com', '$2y$10$z9WsojkMZLHcHmarK0AJ.uNQ7z0KkCV9YFTJluYvXKIephRXhlLfK', 'doctor.png', NULL, '2024-03-23 10:08:00', '2024-03-23 10:28:19', NULL, NULL, NULL),
(6, 'Kahfi Islamic', 'pasien', 'islamickahfi@gmail.com', '$2y$10$BSAMbWUI/XLLVHeaqlzGoecHFyJ1S5cStMgh3VH8LtaMUJktxKgEa', NULL, NULL, '2024-03-26 22:48:06', '2024-03-26 22:48:06', NULL, '105421174325298597844', 'google');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chats_konsul_id_foreign` (`konsul_id`),
  ADD KEY `chats_pasien_id_foreign` (`pasien_id`),
  ADD KEY `chats_dokter_id_foreign` (`dokter_id`);

--
-- Indexes for table `dokters`
--
ALTER TABLE `dokters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dokters_user_id_foreign` (`user_id`),
  ADD KEY `dokters_poli_id_foreign` (`poli_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jadwal_praktik_dokters`
--
ALTER TABLE `jadwal_praktik_dokters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwal_praktik_dokters_dokter_id_foreign` (`dokter_id`);

--
-- Indexes for table `konsuls`
--
ALTER TABLE `konsuls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `konsuls_pasien_id_foreign` (`pasien_id`),
  ADD KEY `konsuls_dokter_id_foreign` (`dokter_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pasiens`
--
ALTER TABLE `pasiens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pasiens_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pembayarans`
--
ALTER TABLE `pembayarans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembayarans_konsul_id_foreign` (`konsul_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `polis`
--
ALTER TABLE `polis`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dokters`
--
ALTER TABLE `dokters`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwal_praktik_dokters`
--
ALTER TABLE `jadwal_praktik_dokters`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `konsuls`
--
ALTER TABLE `konsuls`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pasiens`
--
ALTER TABLE `pasiens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pembayarans`
--
ALTER TABLE `pembayarans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `polis`
--
ALTER TABLE `polis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chats`
--
ALTER TABLE `chats`
  ADD CONSTRAINT `chats_dokter_id_foreign` FOREIGN KEY (`dokter_id`) REFERENCES `dokters` (`id`),
  ADD CONSTRAINT `chats_konsul_id_foreign` FOREIGN KEY (`konsul_id`) REFERENCES `konsuls` (`id`),
  ADD CONSTRAINT `chats_pasien_id_foreign` FOREIGN KEY (`pasien_id`) REFERENCES `pasiens` (`id`);

--
-- Constraints for table `dokters`
--
ALTER TABLE `dokters`
  ADD CONSTRAINT `dokters_poli_id_foreign` FOREIGN KEY (`poli_id`) REFERENCES `polis` (`id`),
  ADD CONSTRAINT `dokters_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `jadwal_praktik_dokters`
--
ALTER TABLE `jadwal_praktik_dokters`
  ADD CONSTRAINT `jadwal_praktik_dokters_dokter_id_foreign` FOREIGN KEY (`dokter_id`) REFERENCES `dokters` (`id`);

--
-- Constraints for table `konsuls`
--
ALTER TABLE `konsuls`
  ADD CONSTRAINT `konsuls_dokter_id_foreign` FOREIGN KEY (`dokter_id`) REFERENCES `dokters` (`id`),
  ADD CONSTRAINT `konsuls_pasien_id_foreign` FOREIGN KEY (`pasien_id`) REFERENCES `pasiens` (`id`);

--
-- Constraints for table `pasiens`
--
ALTER TABLE `pasiens`
  ADD CONSTRAINT `pasiens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `pembayarans`
--
ALTER TABLE `pembayarans`
  ADD CONSTRAINT `pembayarans_konsul_id_foreign` FOREIGN KEY (`konsul_id`) REFERENCES `konsuls` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
