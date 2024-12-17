-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2024 at 10:57 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ch295301_jewel`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `id` int(11) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `parent_id` int(11) NOT NULL,
  `path` varchar(250) NOT NULL,
  `is_cover_photo` tinyint(4) NOT NULL DEFAULT 0,
  `comments` varchar(3000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookies`
--

CREATE TABLE `bookies` (
  `bid` mediumint(9) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(10) DEFAULT NULL,
  `jdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bookies`
--

INSERT INTO `bookies` (`bid`, `username`, `password`, `role`, `jdate`) VALUES
(1, 'admin', 'welcome', 'admin', '2014-07-10'),
(2, 'saran', 'welcome3ibm', NULL, '2014-11-06');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` mediumint(9) NOT NULL,
  `prefix` varchar(10) DEFAULT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `ort` varchar(25) DEFAULT NULL,
  `pin_code` mediumint(9) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `joined_date` date NOT NULL DEFAULT current_timestamp(),
  `qr_image_path` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `rate` int(11) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `joined_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member_trans`
--

CREATE TABLE `member_trans` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `paid_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `total_amount` float(11,2) NOT NULL,
  `balance` float(11,2) NOT NULL,
  `discount` float NOT NULL,
  `discount_notes` varchar(1000) DEFAULT NULL,
  `delivery_status` varchar(25) NOT NULL,
  `payment_status` varchar(25) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `metal_type` varchar(10) NOT NULL DEFAULT 'gold',
  `purity` smallint(6) NOT NULL DEFAULT 22,
  `weight_in_grams` float(11,2) NOT NULL,
  `size_range` varchar(10) NOT NULL DEFAULT 'short',
  `gender` varchar(7) NOT NULL DEFAULT 'women',
  `collection` varchar(15) NOT NULL DEFAULT 'Fancy',
  `stone_type` varchar(25) NOT NULL DEFAULT 'plain gold',
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `product_type_id` int(11) NOT NULL,
  `today_gold_rate` float(11,2) NOT NULL,
  `purchase_expense` float(11,2) NOT NULL,
  `purchase_amount` float(11,2) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `comments` varchar(3000) DEFAULT NULL,
  `making_charges` float(11,2) DEFAULT NULL,
  `in_stock` varchar(5) DEFAULT NULL,
  `qr_image_path` varchar(100) DEFAULT NULL,
  `total_amount` float(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_types`
--

CREATE TABLE `product_types` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `path` varchar(100) DEFAULT NULL,
  `comments` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_types`
--

INSERT INTO `product_types` (`id`, `name`, `path`, `comments`) VALUES
(2, 'Necklace', './img/product_types/necklace.jpg', NULL),
(3, 'Ear Rings', './img/product_types/ear_rings.jpg', NULL),
(4, 'Rings', './img/product_types/rings.jpg', NULL),
(5, 'Bracelets', './img/product_types/bracelets.jpg', NULL),
(6, 'Bangles', './img/product_types/bangles.jpg', NULL),
(7, 'Pendonts', './img/product_types/pendonts.jpg', NULL),
(8, 'Chains', './img/product_types/chains.jpg', NULL),
(9, 'Dollars', './img/product_types/dollars.jpg', NULL),
(10, 'Gold Biscuits', './img/product_types/biscuits.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `created_date` date DEFAULT NULL,
  `type_of_service` varchar(25) DEFAULT NULL,
  `building_type` varchar(25) DEFAULT NULL,
  `floor` varchar(25) DEFAULT NULL,
  `number_of_rooms` varchar(10) DEFAULT NULL,
  `square_meters` varchar(25) DEFAULT NULL,
  `is_elevator` varchar(5) DEFAULT 'No',
  `prefix` varchar(10) NOT NULL DEFAULT 'Herr',
  `first_name` varchar(40) DEFAULT NULL,
  `last_name` varchar(40) NOT NULL,
  `address` varchar(100) NOT NULL,
  `ort` varchar(100) NOT NULL,
  `pin_code` varchar(10) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(40) NOT NULL,
  `start_date_time` timestamp NULL DEFAULT NULL,
  `end_date_time` timestamp NULL DEFAULT NULL,
  `total_price` float DEFAULT NULL,
  `advance_amount` float DEFAULT NULL,
  `balance` float DEFAULT NULL,
  `comments_1` varchar(500) DEFAULT NULL,
  `comments_2` varchar(500) DEFAULT NULL,
  `comments_3` varchar(500) DEFAULT NULL,
  `ort_nach` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schemes`
--

CREATE TABLE `schemes` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `total_terms` int(11) DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `status` varchar(15) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `pin_code` int(11) NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `today_rates`
--

CREATE TABLE `today_rates` (
  `id` int(11) NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `metal_type` varchar(20) NOT NULL,
  `purity` smallint(10) DEFAULT NULL,
  `rate` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `today_rates`
--

INSERT INTO `today_rates` (`id`, `modified_date`, `metal_type`, `purity`, `rate`) VALUES
(1, '2024-12-10 18:27:20', 'gold', 22, 75.05),
(2, '2024-12-10 18:27:25', 'gold', 24, 82.1),
(3, '2024-12-10 18:25:03', 'silver', NULL, 15.45),
(4, '2024-10-02 10:05:37', 'gold', 22, 72.05),
(5, '2024-10-02 10:05:37', 'gold', 24, 74.05),
(6, '2024-12-14 03:54:41', 'gold', 22, 75.5),
(7, '2024-12-14 03:59:38', 'gold', 22, 75.8),
(8, '2024-12-14 03:59:38', 'gold', 24, 82.9),
(9, '2024-12-14 03:59:38', 'silver', 0, 15.45),
(10, '2024-12-15 19:12:59', 'gold', 22, 76.1),
(11, '2024-12-15 19:12:59', 'gold', 24, 82.9),
(12, '2024-12-15 19:12:59', 'silver', 0, 15.45);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookies`
--
ALTER TABLE `bookies`
  ADD PRIMARY KEY (`bid`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_trans`
--
ALTER TABLE `member_trans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_types`
--
ALTER TABLE `product_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schemes`
--
ALTER TABLE `schemes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `today_rates`
--
ALTER TABLE `today_rates`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `bookies`
--
ALTER TABLE `bookies`
  MODIFY `bid` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `member_trans`
--
ALTER TABLE `member_trans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `product_types`
--
ALTER TABLE `product_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `schemes`
--
ALTER TABLE `schemes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `today_rates`
--
ALTER TABLE `today_rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
