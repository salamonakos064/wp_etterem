-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2022 at 11:13 AM
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
-- Database: `restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `recommendation_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`id`, `name`, `recommendation_date`) VALUES
(1, 'Hamburger', NULL),
(2, 'Salmon', NULL),
(3, 'Tuna', NULL),
(4, 'Roast beef', NULL),
(5, 'Ground Beef', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `res_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`res_id`, `food_id`, `quantity`) VALUES
(44, 2, 14),
(44, 4, 12),
(45, 1, 123);

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `reservation_code` int(11) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `table_number` int(11) NOT NULL,
  `date` datetime DEFAULT NULL,
  `reservation_duration` datetime DEFAULT NULL,
  `notes` text NOT NULL,
  `activated` int(11) NOT NULL,
  `deleted_by_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`reservation_code`, `user_name`, `table_number`, `date`, `reservation_duration`, `notes`, `activated`, `deleted_by_user`) VALUES
(8, 'e', 2, '2022-06-08 21:11:35', '2022-06-08 09:11:35', '', 1, 0),
(9, 'w', 5, '2022-06-17 02:55:00', '2022-06-17 08:55:00', '', 1, 1),
(10, 'w', 3, '2022-06-08 09:11:35', '2022-06-08 09:11:35', '', 1, 1),
(11, 'f', 2, '2022-06-08 23:08:04', '2022-06-08 23:08:04', '', 1, 0),
(15, 'e', 2, '2022-06-08 23:21:25', '2022-06-08 23:21:25', '', 1, 0),
(18, 'w', 5, '2022-06-22 00:14:00', '2022-06-22 06:14:00', '', 0, 1),
(19, 'w', 5, '2022-06-23 02:52:00', '2022-06-23 03:52:00', '', 0, 1),
(20, 'w', 5, '2018-06-06 05:02:00', '2018-06-06 06:02:00', '', 1, 0),
(21, 'w', 5, '0000-00-00 00:00:00', NULL, '', 1, 0),
(22, 'w', 5, '0000-00-00 00:00:00', NULL, '', 1, 0),
(23, 'w', 5, '0000-00-00 00:00:00', NULL, '', 1, 0),
(24, 'w', 5, '2023-05-10 02:16:00', '2023-05-10 07:16:00', '', 1, 0),
(25, 'w', 5, '2023-08-10 23:16:00', '2023-08-11 00:16:00', '', 1, 0),
(26, 'w', 5, '2022-06-20 01:21:00', '2022-06-20 02:21:00', '', 1, 0),
(27, 'w', 5, '2022-06-29 01:22:00', '2022-06-29 02:22:00', '', 1, 0),
(28, 'w', 5, '2022-06-30 12:22:00', '2022-06-30 13:22:00', '', 1, 0),
(29, 'w', 5, '2022-06-20 08:12:00', '2022-06-20 09:12:00', '', 1, 0),
(30, 'weat', 5, '2022-06-27 08:02:00', '2022-06-27 14:02:00', '', 0, 1),
(31, 'weat', 5, '2022-09-14 05:24:00', '2022-09-14 06:24:00', '', 0, 1),
(32, 'weat', 5, '2022-06-14 06:30:00', '2022-06-14 07:30:00', '', 0, 1),
(34, 'w', 14, '2022-06-14 11:03:00', '2022-06-14 16:03:00', '', 1, 0),
(35, 'admin', 5, '2025-08-11 13:02:00', '2025-08-11 14:02:00', '', 1, 0),
(36, 'admin', 5, '2023-07-10 12:05:00', '2023-07-10 13:05:00', '', 1, 0),
(37, 'admin', 5, '2022-09-21 12:05:00', '2022-09-21 13:05:00', '', 1, 0),
(38, 'admin', 5, '2023-06-20 00:06:00', '2023-06-20 01:06:00', '', 1, 0),
(39, 'admin', 5, '2023-07-10 01:07:00', '2023-07-10 02:07:00', '', 1, 0),
(40, 'admin', 5, '2121-03-14 05:24:00', '2121-03-14 06:24:00', '', 1, 0),
(41, 'admin', 5, '2029-07-10 00:08:00', '2029-07-10 03:08:00', '', 1, 0),
(42, 'admin', 5, '2029-07-10 14:10:00', '2029-07-10 19:10:00', '', 1, 0),
(43, 'admin', 1, '2024-07-10 12:10:00', '2024-07-10 13:10:00', '', 1, 0),
(44, 'admin', 5, '2024-08-11 01:12:00', '2024-08-11 02:12:00', '', 1, 0),
(45, 'admin', 5, '2025-07-10 01:13:00', '2025-07-10 02:13:00', '', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `table_number` int(11) NOT NULL,
  `num_of_seats` int(11) NOT NULL,
  `smoking` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`table_number`, `num_of_seats`, `smoking`) VALUES
(1, 4, b'0'),
(2, 4, b'0'),
(3, 4, b'0'),
(4, 8, b'1'),
(5, 2, b'0'),
(6, 4, b'0'),
(7, 4, b'1'),
(8, 2, b'0'),
(9, 4, b'0'),
(10, 2, b'0'),
(11, 6, b'0'),
(12, 6, b'0'),
(13, 6, b'0'),
(14, 4, b'1'),
(15, 4, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `user_type` int(11) NOT NULL,
  `activated` bit(1) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `expiration_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_name`, `email`, `password`, `first_name`, `last_name`, `phone_number`, `user_type`, `activated`, `token`, `expiration_date`) VALUES
('admin', 'admin@example.com', '$2y$10$WWJgS1dttJx1x/fvKDddUuUszJDctgdR984IVa5myrRC95QjCKgse', 'admin', 'admin', NULL, 3, b'1', NULL, NULL),
('e', 'e@e.com', '$2y$10$Zcr.Z209MwFbVJ9Lw9RVou2cOoEMlR1vWehWlUAagAEjMBcVKV57i', 'Rw', 'ag', '', 1, b'1', NULL, NULL),
('f', 'f@v.com', '$2y$10$SyxDbCz6yKZmrBIEee3ME.aTOrh8KdcM78unsT7m93YO85R87RCbm', 'fd', 'sav', '', 1, b'1', NULL, NULL),
('w', 'w@w.com', '$2y$10$4TB8p7WDjtSfUHdSj2UC7O388ulemwvpXqVBAcTAWb.8ezePiRN2e', 'dagh', 'ah', '', 2, b'1', NULL, NULL),
('weat', 'weat@e.com', '$2y$10$OgIX72NIgZ9JJAI8.zeNAOyaClT7lTuxuqNjKTKcIWU3hs74vaVzu', 'da', 'asb', 'ag', 1, b'1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_rights`
--

CREATE TABLE `user_rights` (
  `id` int(11) NOT NULL,
  `user_type` varchar(30) NOT NULL,
  `description` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_rights`
--

INSERT INTO `user_rights` (`id`, `user_type`, `description`) VALUES
(1, 'felhasznalo', NULL),
(2, 'dolgozo', NULL),
(3, 'admin', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD KEY `res_id` (`res_id`),
  ADD KEY `food_id` (`food_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reservation_code`),
  ADD KEY `felhasznalo_nev` (`user_name`),
  ADD KEY `sorszam` (`table_number`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`table_number`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_name`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `token` (`token`),
  ADD KEY `jog_id` (`user_type`);

--
-- Indexes for table `user_rights`
--
ALTER TABLE `user_rights`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reservation_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`res_id`) REFERENCES `reservation` (`reservation_code`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`food_id`) REFERENCES `food` (`id`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`user_name`) REFERENCES `user` (`user_name`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`table_number`) REFERENCES `tables` (`table_number`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`user_type`) REFERENCES `user_rights` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
