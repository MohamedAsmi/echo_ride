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


-- Dumping database structure for ecoride
CREATE DATABASE IF NOT EXISTS `ecoride` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `ecoride`;

-- Dumping structure for table ecoride.k2534814_cars
CREATE TABLE IF NOT EXISTS `k2534814_cars` (
  `id` int NOT NULL AUTO_INCREMENT,
  `model` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `category` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `daily_price` decimal(10,2) NOT NULL,
  `free_km` int NOT NULL,
  `extra_km_charge` decimal(10,2) NOT NULL,
  `tax_rate` decimal(5,2) NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Available',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table ecoride.k2534814_cars: ~7 rows (approximately)
INSERT INTO `k2534814_cars` (`id`, `model`, `category`, `daily_price`, `free_km`, `extra_km_charge`, `tax_rate`, `status`) VALUES
	(1, 'Toyota Aqua', 'Compact Petrol', 5000.00, 100, 50.00, 10.00, 'Reserved'),
	(2, 'Toyota Prius', 'Hybrid', 7500.00, 150, 60.00, 12.00, 'Reserved'),
	(3, 'Nissan Leaf', 'Electric', 10000.00, 200, 40.00, 8.00, 'Available'),
	(4, 'BMW X5', 'Luxury SUV', 15000.00, 250, 75.00, 15.00, 'Available'),
	(15, 'Test', 'Test', 50000.00, 300, 50.00, 50.00, 'Available'),
	(16, 'Model', 'Category', 0.00, 0, 0.00, 0.00, 'status'),
	(17, 'Model', 'Category', 0.00, 0, 0.00, 0.00, 'status');

-- Dumping structure for table ecoride.k2534814_categories
CREATE TABLE IF NOT EXISTS `k2534814_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table ecoride.k2534814_categories: ~4 rows (approximately)
INSERT INTO `k2534814_categories` (`id`, `name`) VALUES
	(1, 'Compact Petrol'),
	(2, 'Hybrid'),
	(3, 'Electric'),
	(4, 'Luxury SUV');

-- Dumping structure for table ecoride.k2534814_customers
CREATE TABLE IF NOT EXISTS `k2534814_customers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nic_passport` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table ecoride.k2534814_customers: ~5 rows (approximately)
INSERT INTO `k2534814_customers` (`id`, `nic_passport`, `name`, `phone`, `email`, `created_at`) VALUES
	(1, 'N12345', 'John Doe', '0771234567', 'john@ex.com', '2025-11-17 19:46:38'),
	(2, '961301262V', 'S.M.Asmi', '0789238808', 'shamsudeenasmi96@gmail.com', '2025-11-17 20:15:54'),
	(3, '961301262V', 'mohamed Asmi', '9999999999', 'shamsudeenasmi96@gmail.com', '2025-11-18 02:48:13'),
	(4, 'NIC', 'Name', 'Phone', 'Email', '2025-11-18 04:36:51'),
	(5, 'NIC', 'Name', 'Phone', 'Email', '2025-11-18 13:21:25');

-- Dumping structure for table ecoride.k2534814_invoices
CREATE TABLE IF NOT EXISTS `k2534814_invoices` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reservation_id` int NOT NULL,
  `base_price` decimal(10,2) DEFAULT NULL,
  `extra_km_charge` decimal(10,2) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `tax` decimal(10,2) DEFAULT NULL,
  `deposit` int DEFAULT NULL,
  `total` decimal(12,2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reservation_id` (`reservation_id`),
  CONSTRAINT `k2534814_invoices_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `k2534814_reservations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table ecoride.k2534814_invoices: ~8 rows (approximately)
INSERT INTO `k2534814_invoices` (`id`, `reservation_id`, `base_price`, `extra_km_charge`, `discount`, `tax`, `deposit`, `total`, `created_at`) VALUES
	(6, 10, 15000.00, 0.00, 0.00, 1500.00, 5000, 11500.00, '2025-11-18 03:55:13'),
	(7, 11, 225000.00, 0.00, 22500.00, 24300.00, 5000, 221800.00, '2025-11-18 04:06:44'),
	(8, 11, 225000.00, 0.00, 22500.00, 24300.00, 5000, 221800.00, '2025-11-18 04:07:51'),
	(9, 10, 15000.00, 0.00, 0.00, 1500.00, 5000, 11500.00, '2025-11-18 04:12:18'),
	(10, 11, 225000.00, 0.00, 22500.00, 24300.00, 5000, 221800.00, '2025-11-18 04:12:28'),
	(11, 10, 15000.00, 0.00, 0.00, 1500.00, 5000, 11500.00, '2025-11-18 04:12:33'),
	(12, 10, 15000.00, 0.00, 0.00, 1500.00, 5000, 11500.00, '2025-11-18 04:12:50'),
	(13, 11, 225000.00, 0.00, 22500.00, 24300.00, 5000, 221800.00, '2025-11-18 04:12:53'),
	(14, 10, 15000.00, 0.00, 0.00, 1500.00, 5000, 11500.00, '2025-11-18 04:12:57'),
	(15, 10, 15000.00, 0.00, 0.00, 1500.00, 5000, 11500.00, '2025-11-18 04:13:29'),
	(16, 10, 15000.00, 0.00, 0.00, 1500.00, 5000, 11500.00, '2025-11-18 13:35:14');

-- Dumping structure for table ecoride.k2534814_models
CREATE TABLE IF NOT EXISTS `k2534814_models` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table ecoride.k2534814_models: ~4 rows (approximately)
INSERT INTO `k2534814_models` (`id`, `name`) VALUES
	(1, 'Toyota Aqua'),
	(2, 'Toyota Prius'),
	(3, 'Nissan Leaf'),
	(4, 'BMW X5');

-- Dumping structure for table ecoride.k2534814_reservations
CREATE TABLE IF NOT EXISTS `k2534814_reservations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `booking_id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `customer_id` int NOT NULL,
  `car_id` int NOT NULL,
  `category` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `days` int NOT NULL,
  `total_km` int NOT NULL,
  `deposit` int NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  KEY `car_id` (`car_id`),
  CONSTRAINT `k2534814_reservations_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `k2534814_customers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `k2534814_reservations_ibfk_2` FOREIGN KEY (`car_id`) REFERENCES `k2534814_cars` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table ecoride.k2534814_reservations: ~2 rows (approximately)
INSERT INTO `k2534814_reservations` (`id`, `booking_id`, `customer_id`, `car_id`, `category`, `start_date`, `end_date`, `days`, `total_km`, `deposit`, `status`, `created_at`) VALUES
	(10, 'B1763417663660', 2, 1, 'Compact Petrol', '2025-11-18', '2025-11-20', 3, 50, 5000, 'Confirmed', '2025-11-18 03:44:23'),
	(11, 'B1763417698735', 1, 2, 'Hybrid', '2025-11-05', '2025-12-04', 30, 100, 5000, 'Confirmed', '2025-11-18 03:44:58');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
