-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2022 at 06:22 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `table_number` int(11) NOT NULL,
  `num_of_seats` int(11) NOT NULL,
  `smoking` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`table_number`, `num_of_seats`, `smoking`) VALUES
(1, 4, 0),
(2, 4, 0),
(3, 4, 0),
(4, 8, 1),
(5, 2, 0),
(6, 2, 0),
(7, 7, 0),
(8, 2, 0),
(9, 2, 0),
(10, 4, 1),
(11, 8, 1),
(12, 6, 0),
(13, 6, 0),
(14, 4, 1),
(15, 8, 1);

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
('twe', 'twe@c.com', '$2y$10$Y1NvB3okbkIdiMO50N3p0eVYgeRWrjeqWXPDRZ./4jo2SrArRRv0W', 'salh;', 'ahr', '12', 2, b'1', NULL, NULL),
('w', 'w@w.com', '$2y$10$G.Sv00Z4iRxO9TAe.Tf4aukqpqMbhgOJpwK07vheTIRJ/UH/k7W0a', 'dagh', 'ah', '', 2, b'1', NULL, NULL),
('wc', 'wc@wc.com', '$2y$10$399qiksZJwMiUeiDXyXgluRwjgP8cMRK0/ux5dZffwn/b5DfsbKWW', 'ewfaw', 'wah', 'awg', 1, b'1', NULL, NULL),
('weat', 'weat@e.com', '$2y$10$OgIX72NIgZ9JJAI8.zeNAOyaClT7lTuxuqNjKTKcIWU3hs74vaVzu', 'da', 'asb', 'ag', 1, b'1', NULL, NULL),
('wefa', 'wefa@c.com', '$2y$10$e5E.EnjHizC0nUsL5pKSAOIbPncKGZaNSCE7vyz5t/grYbh7b7olC', 'rqew', 'agd', '12', 1, b'1', NULL, NULL);

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
  MODIFY `reservation_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

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
