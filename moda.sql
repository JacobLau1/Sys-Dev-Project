-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2023 at 01:32 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moda`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `phone`, `email`) VALUES
(1, 'John Smith', '123456789', 'john@gmail.com'),
(2, 'Julie Jones', '987456123', 'julie@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `position` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `last_seen` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_fired` date DEFAULT NULL,
  `date_hired` date NOT NULL DEFAULT '2000-01-01',
  `working_status` int(11) NOT NULL,
  `termination_reason` varchar(255) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `enabled2fa` tinyint(1) DEFAULT NULL,
  `otpsecretkey` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `position`, `first_name`, `full_name`, `last_seen`, `date_fired`, `date_hired`, `working_status`, `termination_reason`, `username`, `password`, `enabled2fa`, `otpsecretkey`) VALUES
(9, 'waiter', 'bob', 'bobby', '2023-04-28 23:30:51', NULL, '2000-01-01', 0, NULL, 'user1', '$2y$10$g7ZcTre1VvkSIciiXPyIKukrWdhhHxFvR/VABp1dY5S', 1, '6OYAJXM2ULNATRIK'),
(10, 'admin', 'rob', 'robby', '2023-04-28 23:31:01', NULL, '2000-01-01', 0, NULL, 'user2', '$2y$10$XvlFkPkmXG7wUZw/bMXAVOFT2aT0T7UM.TWVfRs50me', 0, NULL),
(11, 'admin', 'sob', 'sobby', '2023-04-28 23:31:11', NULL, '2000-01-01', 0, NULL, 'bob', '$2y$10$hnXAYRar1TENHlkJngdKou8zLFJuPLpAelgkXDkfcHD', 1, 'GXT5BOHUGJKMCECJ'),
(12, 'admin', 'dob', 'dobby', '2023-04-28 23:31:23', NULL, '2000-01-01', 0, NULL, 'user3', '$2y$10$mqPscVoqS0Lx4rPO8Yt6nOpGi.U/TQ1ZVeHXgLozFbi', 0, NULL),
(13, 'waiter', 'walt', 'walter', '2023-04-28 23:31:38', NULL, '2000-01-01', 0, NULL, 'waiter', '$2y$10$IrJ8IiPDTEuSP/oQ6Miz..dQalUPolvMIXr7QxgGfvw', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wine`
--

CREATE TABLE `wine` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `format` varchar(50) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wine`
--

INSERT INTO `wine` (`id`, `type`, `name`, `format`, `price`) VALUES
(1, 'winetype', 'winename', 'wineformat', 9090),
(3, 'fine', 'bird', '22ml', 2147483647);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wine`
--
ALTER TABLE `wine`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `wine`
--
ALTER TABLE `wine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
