-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2024 at 10:00 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_sepatu`
--
CREATE DATABASE IF NOT EXISTS `toko_sepatu` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `toko_sepatu`;

-- --------------------------------------------------------

--
-- Table structure for table `detail_sepatu`
--

DROP TABLE IF EXISTS `detail_sepatu`;
CREATE TABLE `detail_sepatu` (
  `detail_sepatu_id` int(11) NOT NULL,
  `fk_sepatu` int(11) NOT NULL,
  `detail_sepatu_pict` text DEFAULT NULL,
  `detail_sepatu_warna` text NOT NULL,
  `detail_sepatu_stok` int(11) NOT NULL,
  `detail_sepatu_ukuran` int(11) NOT NULL,
  `detail_sepatu_harga` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_sepatu`
--

INSERT INTO `detail_sepatu` (`detail_sepatu_id`, `fk_sepatu`, `detail_sepatu_pict`, `detail_sepatu_warna`, `detail_sepatu_stok`, `detail_sepatu_ukuran`, `detail_sepatu_harga`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 5, '1711443242.png', 'Hitam', 20, 38, 799000, '2024-03-26 01:54:02', '2024-03-26 01:54:02', NULL),
(2, 5, '1711443260.png', 'Hitam', 20, 39, 899000, '2024-03-26 01:54:20', '2024-03-26 01:54:20', NULL),
(3, 5, '1711443284.png', 'Putih', 20, 40, 999000, '2024-03-26 01:54:44', '2024-03-26 01:54:44', NULL),
(4, 4, '1711443319.png', 'Hitam', 20, 38, 799000, '2024-03-26 01:55:19', '2024-03-26 01:55:19', NULL),
(5, 4, '1711443343.png', 'Hitam', 20, 39, 899000, '2024-03-26 01:55:43', '2024-03-26 01:55:43', NULL),
(6, 4, '1711443373.png', 'Putih', 20, 40, 999000, '2024-03-26 01:56:13', '2024-03-26 01:56:13', NULL),
(7, 3, '1711443403.png', 'Putih', 20, 38, 799000, '2024-03-26 01:56:43', '2024-03-26 01:56:43', NULL),
(8, 3, '1711443417.png', 'Putih', 20, 39, 899000, '2024-03-26 01:56:57', '2024-03-26 01:56:57', NULL),
(9, 3, '1711443439.png', 'Hitam', 20, 40, 999000, '2024-03-26 01:57:19', '2024-03-26 01:57:19', NULL),
(10, 2, '1711443482.png', 'Putih', 20, 38, 799000, '2024-03-26 01:58:02', '2024-03-26 01:58:02', NULL),
(11, 2, '1711443505.png', 'Putih', 20, 39, 899000, '2024-03-26 01:58:25', '2024-03-26 01:58:25', NULL),
(12, 1, '1711443526.png', 'Hitam', 20, 38, 799000, '2024-03-26 01:58:46', '2024-03-26 01:58:46', NULL),
(13, 1, '1711443540.png', 'Hitam', 20, 39, 899000, '2024-03-26 01:59:00', '2024-03-26 01:59:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dtrans_penjualan`
--

DROP TABLE IF EXISTS `dtrans_penjualan`;
CREATE TABLE `dtrans_penjualan` (
  `dtrans_penjualan_id` int(11) NOT NULL,
  `fk_htrans_penjualan` int(11) NOT NULL,
  `fk_sepatu` int(11) NOT NULL,
  `fk_ukuran_sepatu` int(11) NOT NULL,
  `dtrans_penjualan_qty` int(11) NOT NULL,
  `dtrans_penjualan_price` int(11) NOT NULL,
  `dtrans_penjualan_subtotal` int(11) NOT NULL,
  `dtrans_penjualan_retur` text DEFAULT NULL COMMENT '0: ditolak, 1: diterima, 2:pending '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `htrans_penjualan`
--

DROP TABLE IF EXISTS `htrans_penjualan`;
CREATE TABLE `htrans_penjualan` (
  `htrans_penjualan_id` int(11) NOT NULL,
  `fk_customer` int(11) NOT NULL,
  `htrans_penjualan_total` int(11) DEFAULT NULL,
  `htrans_penjualan_status` int(11) NOT NULL DEFAULT 1 COMMENT '0: cancel | 1: belum dibayar | 2: sudah dibayar | 3: sudah dipickup',
  `snap_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori` (
  `kategori_id` int(11) NOT NULL,
  `kategori_nama` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `kategori_nama`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Sport', '2024-03-26 01:43:04', '2024-03-26 01:43:04', NULL),
(2, 'Casual', '2024-03-26 01:49:54', '2024-03-26 01:49:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

DROP TABLE IF EXISTS `notifikasi`;
CREATE TABLE `notifikasi` (
  `notification_id` int(11) NOT NULL,
  `notifikasi_content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `retur`
--

DROP TABLE IF EXISTS `retur`;
CREATE TABLE `retur` (
  `retur_id` int(11) NOT NULL,
  `fk_dtrans` int(11) NOT NULL,
  `fk_customer` int(11) NOT NULL,
  `fk_sepatu` int(11) NOT NULL,
  `retur_qty` int(11) NOT NULL,
  `retur_reason` text NOT NULL,
  `retur_foto` text NOT NULL,
  `retur_price` int(11) NOT NULL,
  `retur_status` int(11) NOT NULL DEFAULT 2 COMMENT '0: ditolak| 1: diterima | 2: pending | 9:cancel |10:terjual',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sepatu`
--

DROP TABLE IF EXISTS `sepatu`;
CREATE TABLE `sepatu` (
  `sepatu_id` int(11) NOT NULL,
  `sepatu_supplier_id` int(11) NOT NULL,
  `sepatu_kategori_id` int(11) NOT NULL,
  `sepatu_subkategori_id` int(11) NOT NULL,
  `sepatu_name` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sepatu`
--

INSERT INTO `sepatu` (`sepatu_id`, `sepatu_supplier_id`, `sepatu_kategori_id`, `sepatu_subkategori_id`, `sepatu_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 2, 'ADIZERO UBERSONIC 4', '2024-03-26 01:52:27', '2024-03-26 01:52:27', NULL),
(2, 1, 1, 1, 'Adione Ubers 01', '2024-03-26 01:52:40', '2024-03-26 01:52:40', NULL),
(3, 1, 1, 3, 'Superstar Sneakers', '2024-03-26 01:52:56', '2024-03-26 01:52:56', NULL),
(4, 1, 2, 4, 'Adimone Manio 22', '2024-03-26 01:53:07', '2024-03-26 01:53:07', NULL),
(5, 1, 2, 5, 'Campus 00s', '2024-03-26 01:53:19', '2024-03-26 01:53:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subkategori`
--

DROP TABLE IF EXISTS `subkategori`;
CREATE TABLE `subkategori` (
  `subkategori_id` int(11) NOT NULL,
  `fk_kategori` int(11) NOT NULL,
  `subkategori_nama` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subkategori`
--

INSERT INTO `subkategori` (`subkategori_id`, `fk_kategori`, `subkategori_nama`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Sneaker', '2024-03-26 01:49:35', '2024-03-26 01:49:35', NULL),
(2, 1, 'Runner', '2024-03-26 01:49:41', '2024-03-26 01:49:41', NULL),
(3, 1, 'Walker', '2024-03-26 01:49:46', '2024-03-26 01:49:46', NULL),
(4, 2, 'Coachie', '2024-03-26 01:50:04', '2024-03-26 01:50:04', NULL),
(5, 2, 'Loafers', '2024-03-26 01:50:43', '2024-03-26 01:50:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` text NOT NULL,
  `supplier_contact` text NOT NULL,
  `supplier_office` text NOT NULL,
  `supplier_logo` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_name`, `supplier_contact`, `supplier_office`, `supplier_logo`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Adidas', '089762146899', 'Jl Mawar No. 27, Jakarta', '1711442539.png', '2024-03-26 01:42:19', '2024-03-26 01:42:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` text NOT NULL,
  `user_email` text NOT NULL,
  `user_password` text NOT NULL DEFAULT '12345678',
  `user_profile` text DEFAULT NULL,
  `user_role` text NOT NULL DEFAULT 'customer',
  `user_verification` int(11) NOT NULL DEFAULT 0 COMMENT '0 : no | 1: yes',
  `verification` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_email`, `user_password`, `user_profile`, `user_role`, `user_verification`, `verification`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'owner', 'owner', '$2y$10$8gSRF3sfz24bed1upVdoO.dtGjbqFLF5zddDNA7FiZ/qUvJux5GpS', 'basic_profile_picture.jpg', 'owner', 1, '$2y$10$QFlFTRCpCklPUbZbf74.q.dlQuT1QTPbaidghkflFYsvin4miBYOO', NULL, NULL, NULL),
(2, 'admin', 'admin', '$2y$10$yF7fa/7DNeu2YWa.Izbd7ek7JBFuYeNsgP7rtBFlsMVTXNcV1c2M2', NULL, 'admin', 1, 'admin', '2024-03-26 01:41:19', '2024-03-26 01:41:19', NULL),
(3, 'user', 'user@gmail.com', '$2y$10$QmzfX0jA01dHzlVziv2puu9HKexZ1rF9hMMrnHpREP7U8UiibLqJG', 'basic_profile_picture.jpg', 'customer', 1, '$2y$10$5SrXG.osy5oBb44gjJB6gOgUHVH5jCiUqvdxWo.OuATWJhdrGGOli', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_sepatu`
--
ALTER TABLE `detail_sepatu`
  ADD PRIMARY KEY (`detail_sepatu_id`);

--
-- Indexes for table `dtrans_penjualan`
--
ALTER TABLE `dtrans_penjualan`
  ADD PRIMARY KEY (`dtrans_penjualan_id`),
  ADD KEY `fk_htrans_penjualan` (`fk_htrans_penjualan`),
  ADD KEY `fk_sepatu_penjualan` (`fk_sepatu`),
  ADD KEY `fk_ukuran_sepatu` (`fk_ukuran_sepatu`);

--
-- Indexes for table `htrans_penjualan`
--
ALTER TABLE `htrans_penjualan`
  ADD PRIMARY KEY (`htrans_penjualan_id`),
  ADD KEY `fk_customer_id` (`fk_customer`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `retur`
--
ALTER TABLE `retur`
  ADD PRIMARY KEY (`retur_id`);

--
-- Indexes for table `sepatu`
--
ALTER TABLE `sepatu`
  ADD PRIMARY KEY (`sepatu_id`);

--
-- Indexes for table `subkategori`
--
ALTER TABLE `subkategori`
  ADD PRIMARY KEY (`subkategori_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_sepatu`
--
ALTER TABLE `detail_sepatu`
  MODIFY `detail_sepatu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `dtrans_penjualan`
--
ALTER TABLE `dtrans_penjualan`
  MODIFY `dtrans_penjualan_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `retur`
--
ALTER TABLE `retur`
  MODIFY `retur_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sepatu`
--
ALTER TABLE `sepatu`
  MODIFY `sepatu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subkategori`
--
ALTER TABLE `subkategori`
  MODIFY `subkategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
