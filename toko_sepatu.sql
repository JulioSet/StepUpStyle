-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2023 at 03:26 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

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
-- Table structure for table `dtrans_penjualan`
--

DROP TABLE IF EXISTS `dtrans_penjualan`;
CREATE TABLE `dtrans_penjualan` (
  `fk_htrans_penjualan` int(11) NOT NULL,
  `fk_sepatu` int(11) NOT NULL,
  `fk_ukuran_sepatu` int(11) NOT NULL,
  `dtrans_penjualan_content` text NOT NULL,
  `dtrans_penjualan_qty` int(11) NOT NULL,
  `dtrans_penjualan_subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `htrans_penjualan`
--

DROP TABLE IF EXISTS `htrans_penjualan`;
CREATE TABLE `htrans_penjualan` (
  `htrans_penjualan_id` int(11) NOT NULL,
  `fk_customer` int(11) NOT NULL,
  `htrans_penjualan_total` int(11) NOT NULL,
  `htrans_penjualan_status` int(11) NOT NULL DEFAULT 0 COMMENT '-1: cancel | 0: pending | 1: sudah dipickup',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `kategori_nama`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Sport', '2023-12-08 06:13:14', '2023-12-08 06:13:14', NULL),
(2, 'Sneakers', '2023-12-08 06:42:39', '2023-12-29 18:41:21', NULL),
(3, 'Heels', '2023-12-27 05:31:03', '2023-12-29 18:38:12', NULL),
(4, 'Loafers', '2023-12-29 18:40:09', '2023-12-29 18:40:09', NULL),
(5, 'Boots', '2023-12-29 18:40:22', '2023-12-29 18:40:22', NULL),
(6, 'Kids', '2023-12-29 18:40:33', '2023-12-29 18:40:33', NULL),
(7, 'Sandals', '2023-12-29 18:40:44', '2023-12-29 18:40:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

DROP TABLE IF EXISTS `notifikasi`;
CREATE TABLE `notifikasi` (
  `notification_id` int(11) NOT NULL,
  `notifikasi_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `retur`
--

DROP TABLE IF EXISTS `retur`;
CREATE TABLE `retur` (
  `retur_id` int(11) NOT NULL,
  `fk_customer` int(11) NOT NULL,
  `fk_sepatu` int(11) NOT NULL,
  `retur_reason` text NOT NULL,
  `retur_foto` text NOT NULL,
  `retur_price` int(11) NOT NULL,
  `retur_status` int(11) NOT NULL DEFAULT 0 COMMENT '-1: ditolak | 0: pending | 1: diterima | 10: cancel',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sepatu`
--

DROP TABLE IF EXISTS `sepatu`;
CREATE TABLE `sepatu` (
  `sepatu_id` int(11) NOT NULL,
  `sepatu_supplier_id` int(11) NOT NULL,
  `sepatu_kategori_id` int(11) NOT NULL,
  `sepatu_ukuran_id` int(11) NOT NULL,
  `sepatu_pict` text NOT NULL,
  `sepatu_name` text NOT NULL,
  `sepatu_stock` int(11) NOT NULL,
  `sepatu_price` int(11) NOT NULL,
  `sepatu_color` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sepatu`
--

INSERT INTO `sepatu` (`sepatu_id`, `sepatu_supplier_id`, `sepatu_kategori_id`, `sepatu_ukuran_id`, `sepatu_pict`, `sepatu_name`, `sepatu_stock`, `sepatu_price`, `sepatu_color`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 2, 2, 2, '1702043603.PNG', 'Naiki Jompo', 10000, 1000000, 'Merah', '2023-12-08 06:53:23', '2023-12-08 06:53:23', NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_name`, `supplier_contact`, `supplier_office`, `supplier_logo`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Adida', '081371297835', 'Surabaya', '1703903077.jpg', '2023-12-08 06:04:30', '2023-12-29 19:24:38', NULL),
(2, 'Naiki', '081371202341', 'Jakarta', '1703900661.jpg', '2023-12-08 06:41:55', '2023-12-29 18:44:21', NULL),
(3, 'Elbi', '081371202341', 'Jakarta', '1703900693.jpg', '2023-12-08 06:42:25', '2023-12-29 18:44:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ukuran`
--

DROP TABLE IF EXISTS `ukuran`;
CREATE TABLE `ukuran` (
  `ukuran_sepatu_id` int(11) NOT NULL,
  `ukuran_sepatu_nama` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ukuran`
--

INSERT INTO `ukuran` (`ukuran_sepatu_id`, `ukuran_sepatu_nama`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, '29', '2023-12-08 04:49:41', '2023-12-08 04:49:41', NULL),
(3, '20', '2023-12-08 04:50:28', '2023-12-08 04:50:28', NULL);

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_email`, `user_password`, `user_profile`, `user_role`, `user_verification`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'a', 'a@a', 'a', NULL, 'customer', 0, NULL, NULL, NULL),
(2, 'b', 'b@b', 'b', NULL, 'customer', 0, NULL, NULL, NULL),
(3, 'asd', 'asd@gmail.com', '$2y$10$xfIJ3Hg/WblnpxI/kzarze8xlndFccM9dV63jvspyjLPsrcAlEpOG', NULL, 'customer', 0, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dtrans_penjualan`
--
ALTER TABLE `dtrans_penjualan`
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
  ADD PRIMARY KEY (`retur_id`),
  ADD KEY `fk_customer` (`fk_customer`),
  ADD KEY `fk_sepatu` (`fk_sepatu`);

--
-- Indexes for table `sepatu`
--
ALTER TABLE `sepatu`
  ADD PRIMARY KEY (`sepatu_id`),
  ADD KEY `fk_sepatu_brand` (`sepatu_supplier_id`),
  ADD KEY `fk_sepatu_kategori` (`sepatu_kategori_id`),
  ADD KEY `fk_sepatu_ukuran` (`sepatu_ukuran_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `ukuran`
--
ALTER TABLE `ukuran`
  ADD PRIMARY KEY (`ukuran_sepatu_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `htrans_penjualan`
--
ALTER TABLE `htrans_penjualan`
  MODIFY `htrans_penjualan_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `sepatu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ukuran`
--
ALTER TABLE `ukuran`
  MODIFY `ukuran_sepatu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dtrans_penjualan`
--
ALTER TABLE `dtrans_penjualan`
  ADD CONSTRAINT `fk_htrans_penjualan` FOREIGN KEY (`fk_htrans_penjualan`) REFERENCES `htrans_penjualan` (`htrans_penjualan_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sepatu_penjualan` FOREIGN KEY (`fk_sepatu`) REFERENCES `sepatu` (`sepatu_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ukuran_sepatu` FOREIGN KEY (`fk_ukuran_sepatu`) REFERENCES `ukuran` (`ukuran_sepatu_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `htrans_penjualan`
--
ALTER TABLE `htrans_penjualan`
  ADD CONSTRAINT `fk_customer_id` FOREIGN KEY (`fk_customer`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `retur`
--
ALTER TABLE `retur`
  ADD CONSTRAINT `fk_customer` FOREIGN KEY (`fk_customer`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sepatu` FOREIGN KEY (`fk_sepatu`) REFERENCES `sepatu` (`sepatu_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sepatu`
--
ALTER TABLE `sepatu`
  ADD CONSTRAINT `fk_sepatu_brand` FOREIGN KEY (`sepatu_supplier_id`) REFERENCES `supplier` (`supplier_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_sepatu_kategori` FOREIGN KEY (`sepatu_kategori_id`) REFERENCES `kategori` (`kategori_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_sepatu_ukuran` FOREIGN KEY (`sepatu_ukuran_id`) REFERENCES `ukuran` (`ukuran_sepatu_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
