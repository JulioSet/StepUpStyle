-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2024 at 09:02 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `dtrans_penjualan`
--

DROP TABLE IF EXISTS `dtrans_penjualan`;
CREATE TABLE `dtrans_penjualan` (
  `dtrans_penjualan_id` int(11) NOT NULL,
  `fk_htrans_penjualan` int(11) NOT NULL,
  `fk_detail_sepatu` int(11) NOT NULL,
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
  `service` text NOT NULL,
  `eta` int(11) NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

DROP TABLE IF EXISTS `notifikasi`;
CREATE TABLE `notifikasi` (
  `notifikasi_id` int(11) NOT NULL,
  `notifikasi_type` int(11) NOT NULL COMMENT '1 = order | 2 = retur',
  `notifikasi_content` text NOT NULL,
  `notifikasi_status` int(11) NOT NULL DEFAULT 0 COMMENT '0 = unread | 1 = read',
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
(3, 'users', 'user@gmail.com', '$2y$10$QmzfX0jA01dHzlVziv2puu9HKexZ1rF9hMMrnHpREP7U8UiibLqJG', '1713948627.png', 'customer', 1, '$2y$10$5SrXG.osy5oBb44gjJB6gOgUHVH5jCiUqvdxWo.OuATWJhdrGGOli', NULL, '2024-04-24 01:50:27', NULL),
(4, 'abe', 'bernadette.g21@mhs.istts.ac.id', '$2y$10$f7.drZPWG5uMBYFH/FSctuhqE7sltRgoSpFcLjmOQl1DrGbtpp98a', 'basic_profile_picture.jpg', 'customer', 1, '$2y$10$eVsH9psowUIfOKJ1WcY2LuuygTP.JVl593QVyPV9FDiNimPFiHzC2', NULL, '2024-04-01 00:38:47', NULL),
(5, 'tes', 'tes@gmail.com', 'test', '1713948472.png', 'customer', 0, 'special', '2024-04-24 01:47:52', '2024-04-24 01:47:52', NULL),
(8, 'a', 'juliotiono94@gmail.com', '$2y$10$O0n3mecJ/4p8eSqQ10R.Ce2Ll2NCGL.v9wGMPMmszLrZmgjCBTILq', 'basic_profile_picture.jpg', 'customer', 1, '$2y$10$UlPXNH8yZuN6n1sYbAJlwOileth.y46ntOJ9blwMHp9nU6IBdS7la', NULL, '2024-06-11 11:55:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE `wishlist` (
  `wishlist_id` int(11) NOT NULL,
  `fk_customer` int(11) NOT NULL,
  `fk_sepatu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  ADD KEY `fk_sepatu_penjualan` (`fk_detail_sepatu`);

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
  ADD PRIMARY KEY (`notifikasi_id`);

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
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlist_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_sepatu`
--
ALTER TABLE `detail_sepatu`
  MODIFY `detail_sepatu_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dtrans_penjualan`
--
ALTER TABLE `dtrans_penjualan`
  MODIFY `dtrans_penjualan_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `notifikasi_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `retur`
--
ALTER TABLE `retur`
  MODIFY `retur_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sepatu`
--
ALTER TABLE `sepatu`
  MODIFY `sepatu_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subkategori`
--
ALTER TABLE `subkategori`
  MODIFY `subkategori_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
