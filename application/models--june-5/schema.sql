-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Jan 14, 2022 at 02:16 PM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `cargo`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

DROP TABLE IF EXISTS `administrator`;
CREATE TABLE IF NOT EXISTS `administrator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `branch` int(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` int(11) NOT NULL COMMENT 'status is equal to 0 is active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`id`, `name`, `username`, `password`, `email`, `branch`, `created_at`, `updated_at`, `status`) VALUES
(1, 'admin', 'admin', 'admin', 'admin@india.com', 1, '2021-12-09 00:00:00', '2021-12-23 00:00:00', 1),
(2, 'branch2', 'branch2', 'branch2', 'branch@gmail.com', 2, '2022-01-29 00:00:00', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cargo`
--

DROP TABLE IF EXISTS `cargo`;
CREATE TABLE IF NOT EXISTS `cargo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cargo_name` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `contactnumber` varchar(15) NOT NULL,
  `auth_person` varchar(70) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0=active,1=inactive',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `goods_details`
--

DROP TABLE IF EXISTS `goods_details`;
CREATE TABLE IF NOT EXISTS `goods_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoiceno` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL,
  `district` varchar(25) NOT NULL,
  `company` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `weight` varchar(50) NOT NULL,
  `pcs` varchar(50) NOT NULL,
  `shipmentname` varchar(200) NOT NULL,
  `sendingdate` varchar(200) NOT NULL,
  `recievingdate` varchar(200) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0=active,1=inactive',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `manifesto`
--

DROP TABLE IF EXISTS `manifesto`;
CREATE TABLE IF NOT EXISTS `manifesto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `send_branch` int(10) NOT NULL,
  `recieve_branch` int(10) NOT NULL,
  `send_date` timestamp NOT NULL,
  `recieve_date` timestamp NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manifesto_data`
--

DROP TABLE IF EXISTS `manifesto_data`;
CREATE TABLE IF NOT EXISTS `manifesto_data` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `parent` int(15) NOT NULL,
  `box_no` int(4) NOT NULL,
  `invoice_no` int(4) NOT NULL,
  `psc` int(4) NOT NULL,
  `kg` float NOT NULL,
  `consignee_address` text NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `state` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `consigner_address` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=637 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trip_sheet`
--

DROP TABLE IF EXISTS `trip_sheet`;
CREATE TABLE IF NOT EXISTS `trip_sheet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trip_date` varchar(50) NOT NULL,
  `trip_time` varchar(50) NOT NULL,
  `vehicle_id` varchar(50) NOT NULL,
  `vehicle_number` varchar(50) NOT NULL,
  `vehicle_drivername` varchar(50) NOT NULL,
  `vehicle_drivermobilenumber` varchar(50) NOT NULL,
  `helper_name` varchar(50) NOT NULL,
  `helper_mobilenumber` varchar(50) NOT NULL,
  `start_km` varchar(50) NOT NULL DEFAULT '0',
  `stop_km` varchar(50) NOT NULL DEFAULT '0',
  `total_km` varchar(70) NOT NULL DEFAULT '0',
  `total_rent` varchar(50) NOT NULL DEFAULT '0',
  `exp_diesel` varchar(50) NOT NULL DEFAULT '0',
  `exp_batha` varchar(50) NOT NULL DEFAULT '0',
  `exp_phone` varchar(50) NOT NULL DEFAULT '0',
  `exp_toll` varchar(50) NOT NULL DEFAULT '0',
  `exp_food` varchar(50) NOT NULL DEFAULT '0',
  `exp_other` varchar(50) NOT NULL DEFAULT '0',
  `exp_total` varchar(50) NOT NULL DEFAULT '0',
  `exp_advance` varchar(50) NOT NULL DEFAULT '0',
  `balance_amt` varchar(70) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL COMMENT '0=active,1=inactive',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trip_sheet_cargos`
--

DROP TABLE IF EXISTS `trip_sheet_cargos`;
CREATE TABLE IF NOT EXISTS `trip_sheet_cargos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trip_sheet_id` int(11) NOT NULL,
  `invoice_number` varchar(50) NOT NULL,
  `cargo_id` varchar(70) NOT NULL,
  `cargo_name` varchar(70) NOT NULL,
  `place` varchar(150) NOT NULL,
  `mobilenumber` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `weight` varchar(50) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0=active,1=inactive',
  `message` varchar(2555) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

DROP TABLE IF EXISTS `vehicles`;
CREATE TABLE IF NOT EXISTS `vehicles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_number` varchar(50) NOT NULL,
  `vehicle_type` varchar(70) NOT NULL,
  `driver_name` varchar(70) NOT NULL,
  `contactnumber` varchar(15) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0=active,1=inactive',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;
