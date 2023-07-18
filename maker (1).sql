-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2020 at 08:21 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `maker`
--

-- --------------------------------------------------------

--
-- Table structure for table `jenis_tanaman`
--

CREATE TABLE `jenis_tanaman` (
  `id` int(5) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `icon` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_tanaman`
--

INSERT INTO `jenis_tanaman` (`id`, `name`, `icon`) VALUES
(1, 'Padi', 'img/padi.png'),
(2, 'Palawija', 'img/tani.png'),
(3, 'Timun', 'img/tani.png'),
(4, 'Bonteng', 'img/tani.png');

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE `lokasi` (
  `id` int(5) NOT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `kordinat_1` varchar(10000) DEFAULT '',
  `alamat` text DEFAULT NULL,
  `pemilik` varchar(100) DEFAULT NULL,
  `kordinat_2` varchar(1000) DEFAULT NULL,
  `file` varchar(200) DEFAULT NULL,
  `jenis_tanaman` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lokasi`
--

INSERT INTO `lokasi` (`id`, `name`, `kordinat_1`, `alamat`, `pemilik`, `kordinat_2`, `file`, `jenis_tanaman`) VALUES
(1, 'Pertanian Citangkil', '-6.018509', 'citangkilssss', 'sendra', '106.1125405', '20201208060411.jpeg', 'Padi'),
(2, 'Pertanian jombang', '-6.0150489', 'jombang', 'bayu', '106.0464123', '20201208060400.jpeg', 'Palawija'),
(3, 'Pertanian Ramanuju', '-6.0073271', 'Ramanuju', 'sabrina', '106.0257202', '20201208060427.jpeg', 'Padi'),
(5, 'dsdadsdv ddddddddd', '-5.956890', 'kp taman baru', 'dsdsdsd', '106.051202', '20201208055917.png', 'Palawija');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `kode`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role_id`) VALUES
(1, '12345678', 'arkan', 'uconbeton@gmail.com', NULL, '$2y$10$UyycqKOuN1uN1O62pDv6SOOElB.XxyTv7QPmaOwLlogwXsOIeUDWe', 'rPjBAvAmHmiC7PDC53iGNfyRbPyB74RpMPFyJORTPjlX0RDHaIx7qS6F4Mmh', '2020-10-13 19:53:59', '2020-10-13 19:53:59', 1),
(2, '1111111111', 'sodik', 'betonucon@gmail.com', NULL, '$2y$10$ZmrNoIt9U4qN3VuP6Sc1RudFHpEdKOtOyGFV1qFOO3AhMDcNR35dW', 'gWgxoxsvlVpIBBBA7jmWZ810c672uCsqzSc7HdU2LrWBOD53uOjEP3OTLRXL', '2020-10-20 04:05:30', '2020-10-20 04:05:30', 3),
(3, '93040520', 'Syahid Muttaqin', 'syahidmuttaqin@gmail.com', NULL, '$2y$10$ZPmOV5oRYnhYFn/ESqvYf.ugrufL9V0IXYskcE7SPk0XQ/JpFj//W', 'Fx620oOW8xG5P37GMozy1Q01b3DwzdrJFRjH5YrQBZAaJKvqdcaGHdLgUfk0', '2020-10-28 04:59:31', '2020-10-28 04:59:31', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jenis_tanaman`
--
ALTER TABLE `jenis_tanaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_kode_unique` (`kode`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis_tanaman`
--
ALTER TABLE `jenis_tanaman`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
