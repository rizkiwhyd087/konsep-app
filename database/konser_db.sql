-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 30, 2023 at 07:20 AM
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
-- Database: `konser_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `konser`
--

CREATE TABLE `konser` (
  `id_konser` bigint UNSIGNED NOT NULL,
  `id_user` int NOT NULL,
  `nama_konser` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_konser` date DEFAULT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga` bigint NOT NULL,
  `tiket` int DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `jenis_bank` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `atas_nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rekening` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `konser`
--

INSERT INTO `konser` (`id_konser`, `id_user`, `nama_konser`, `tanggal_konser`, `lokasi`, `harga`, `tiket`, `image`, `jenis_bank`, `atas_nama`, `rekening`, `created_at`, `updated_at`) VALUES
(1, 4, 'Rock Festival', '2023-12-28', 'Lapangan Depan Gasibu', 200000, 400, 'img1.png', 'BCA', 'Putri', 12345678, '2023-12-28 13:13:21', '2023-12-29 09:17:21'),
(8, 1, 'Freedom of Nggambleh', '2023-12-30', 'Lapang Sabuga', 100000, 300, 'img2.jpeg', 'BJB', 'Admin', 1020304050, '2023-12-29 09:05:01', '2023-12-29 09:05:01'),
(10, 4, 'Electro Music Festival', '2024-01-01', 'Lapang Pussenif', 150000, 200, 'poster1.jpg', 'BCA', 'Putri', 2030102040, '2023-12-29 23:38:50', '2023-12-29 23:38:50');

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
(3, '2023_12_28_094810_konser', 1),
(4, '2023_12_28_094817_transaksi', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` bigint UNSIGNED NOT NULL,
  `id_konser` int NOT NULL,
  `id_user` int NOT NULL,
  `qty` int NOT NULL,
  `total` bigint NOT NULL,
  `tanggal` date DEFAULT NULL,
  `status` enum('Proses','Berhasil','Gagal') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transfer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `qrcode` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_konser`, `id_user`, `qty`, `total`, `tanggal`, `status`, `transfer`, `qrcode`, `created_at`, `updated_at`) VALUES
(1, 1, 6, 1, 200000, '2023-12-28', 'Gagal', '', '', '2023-12-28 15:50:08', '2023-12-29 23:48:57'),
(8, 8, 6, 1, 100000, '2023-12-29', 'Proses', '-', '', '2023-12-29 11:34:49', '2023-12-29 11:34:49'),
(9, 1, 6, 2, 400000, '2023-12-29', 'Berhasil', 'qweasdzxc.jpeg', '', '2023-12-29 11:37:56', '2023-12-30 00:14:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','pembeli','penyelenggara') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$12$pmT3TvVP1HYPbti8jvB3JOHjcxSe5IWMA2yWgSteDTgs0ZbqCojce', 'admin', NULL, NULL),
(2, 'putra', 'putra@gmail.com', '$2y$12$P74igENMsFLVm5CzV1qSsO4Qmoo.V0FEG9p9k.FjMTUVcG2SQ7bpK', 'pembeli', NULL, NULL),
(4, 'putri', 'putri@gmail.com', '$2y$12$mIJnVoNnERCrV1FPA001uOf16GHpYIZIpu2eNtXSPZWZrJ/apqTkG', 'penyelenggara', NULL, NULL),
(6, 'robi', 'obiaha@gmail.com', '$2y$12$lJJkqWdqMI9APaygsVspzu6RV3tFAgcj3KDUdvPHll/CE5Xp8NWSG', 'pembeli', '2023-12-28 05:08:10', '2023-12-28 05:08:10'),
(7, 'handy', 'handy@gmail.com', '$2y$12$oG7b6OS/3Sc8dqCaM.O5f.8j2l9xSw8ddGU6aagadzdK5H6dakwfm', 'pembeli', '2023-12-28 05:21:34', '2023-12-28 05:21:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `konser`
--
ALTER TABLE `konser`
  ADD PRIMARY KEY (`id_konser`),
  ADD UNIQUE KEY `konser_rekening_unique` (`rekening`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `konser`
--
ALTER TABLE `konser`
  MODIFY `id_konser` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
