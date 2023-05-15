-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2023 at 05:09 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `modavie`
--

-- --------------------------------------------------------

--
-- Table structure for table `beer`
--

CREATE TABLE `beer` (
  `id` int(11) NOT NULL,
  `saq_code` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `format` varchar(50) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `beer`
--

INSERT INTO `beer` (`id`, `saq_code`, `type`, `name`, `format`, `price`) VALUES
(3, 'a', '123', 'Beer', '12', 1001);

-- --------------------------------------------------------

--
-- Table structure for table `drinks`
--

CREATE TABLE `drinks` (
  `drink_id` int(11) NOT NULL,
  `alcohol_type` varchar(255) NOT NULL,
  `inventory_id` int(11) NOT NULL,
  `current_location` int(11) NOT NULL,
  `last_moved_by` int(11) NOT NULL,
  `last_moved_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `image` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `inventory_id` int(11) NOT NULL,
  `drink_id` int(11) NOT NULL,
  `date_aquired` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_updated` timestamp NULL DEFAULT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `location_id` int(11) NOT NULL,
  `room` varchar(25) NOT NULL,
  `storage_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `spirit`
--

CREATE TABLE `spirit` (
  `id` int(11) NOT NULL,
  `saq_code` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `format` varchar(50) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `spirit`
--

INSERT INTO `spirit` (`id`, `saq_code`, `type`, `name`, `format`, `price`) VALUES
(2, 'a', '123', 'Bea', '12', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `position` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `last_seen` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_fired` date DEFAULT NULL,
  `date_hired` date NOT NULL DEFAULT '2000-01-01',
  `working_status` int(11) NOT NULL,
  `termination_reason` varchar(255) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `enabled2fa` tinyint(1) DEFAULT NULL,
  `otpsecretkey` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `position`, `first_name`, `last_name`, `last_seen`, `date_fired`, `date_hired`, `working_status`, `termination_reason`, `username`, `password`, `enabled2fa`, `otpsecretkey`) VALUES
(19, 'admin', 'Bob', 'Ross', '2023-05-10 02:58:30', NULL, '2023-05-09', 1, NULL, 'ross', '$2y$10$p9m78Tjbv5DlqNLTOWCijOQJSVd76ZITA.CuUS16TS/Qd2xYWwXKy', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wine`
--

CREATE TABLE `wine` (
  `id` int(11) NOT NULL,
  `saq_code` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `format` varchar(50) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wine`
--

INSERT INTO `wine` (`id`, `saq_code`, `type`, `name`, `format`, `price`) VALUES
(7, 'a', 'white', 'bourg', '12', 20);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beer`
--
ALTER TABLE `beer`
  ADD PRIMARY KEY (`saq_code`) USING BTREE;

--
-- Indexes for table `drinks`
--
ALTER TABLE `drinks`
  ADD PRIMARY KEY (`drink_id`),
  ADD UNIQUE KEY `inventory_id` (`inventory_id`),
  ADD UNIQUE KEY `current_location` (`current_location`),
  ADD UNIQUE KEY `last_moved_by` (`last_moved_by`),
  ADD KEY `alcohol_type2` (`alcohol_type`),
  ADD KEY `alcohol_type3` (`alcohol_type`),
  ADD KEY `alcohol_type` (`alcohol_type`) USING BTREE;

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inventory_id`),
  ADD UNIQUE KEY `drink_id` (`drink_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `spirit`
--
ALTER TABLE `spirit`
  ADD PRIMARY KEY (`saq_code`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `wine`
--
ALTER TABLE `wine`
  ADD PRIMARY KEY (`saq_code`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `drinks`
--
ALTER TABLE `drinks`
  MODIFY `drink_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inventory_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `drinks`
--
ALTER TABLE `drinks`
  ADD CONSTRAINT `drinks_ibfk_1` FOREIGN KEY (`inventory_id`) REFERENCES `inventory` (`inventory_id`),
  ADD CONSTRAINT `drinks_ibfk_2` FOREIGN KEY (`current_location`) REFERENCES `location` (`location_id`),
  ADD CONSTRAINT `drinks_ibfk_3` FOREIGN KEY (`last_moved_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `drinks_ibfk_4` FOREIGN KEY (`alcohol_type`) REFERENCES `wine` (`saq_code`),
  ADD CONSTRAINT `drinks_ibfk_5` FOREIGN KEY (`alcohol_type`) REFERENCES `beer` (`saq_code`),
  ADD CONSTRAINT `drinks_ibfk_6` FOREIGN KEY (`alcohol_type`) REFERENCES `spirit` (`saq_code`);

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`drink_id`) REFERENCES `drinks` (`drink_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
