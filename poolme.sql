-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2016 at 03:50 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `poolme`
--
CREATE DATABASE IF NOT EXISTS `poolme` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `poolme`;

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

DROP TABLE IF EXISTS `cars`;
CREATE TABLE IF NOT EXISTS `cars` (
  `car_id` int(6) NOT NULL AUTO_INCREMENT,
  `car_brand` varchar(30) NOT NULL,
  `car_model` varchar(30) NOT NULL,
  `car_color` varchar(30) NOT NULL,
  `plate_num` varchar(10) NOT NULL,
  `license_num` varchar(10) NOT NULL,
  PRIMARY KEY (`car_id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`car_id`, `car_brand`, `car_model`, `car_color`, `plate_num`, `license_num`) VALUES
(2, 'Nissan', 'Altima', 'Green', '2GDO234', 'F1315121'),
(3, 'Toyota', 'Prius', 'Blacl', '6JNE593', 'F1234591'),
(4, 'Subaru', 'Outback', 'Red', '1CAR129', 'B3343987'),
(5, 'Toyota', 'Corolla', 'Pink', '1AFX332', 'I0985733'),
(8, 'Kia', 'Sephia', 'Blue', '1NDLT100', 'B1290031'),
(47, 'Tesla', 'Model S', 'Red', '5UMH719', 'I1299332');

-- --------------------------------------------------------

--
-- Table structure for table `drivers-cars`
--

DROP TABLE IF EXISTS `drivers-cars`;
CREATE TABLE IF NOT EXISTS `drivers-cars` (
  `driver_id` int(6) UNSIGNED NOT NULL,
  `car_id` int(6) NOT NULL,
  KEY `driver_id` (`driver_id`),
  KEY `car_id` (`car_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drivers-cars`
--

INSERT INTO `drivers-cars` (`driver_id`, `car_id`) VALUES
(11, 2),
(13, 3),
(14, 4),
(17, 5),
(51, 8),
(47, 47);

-- --------------------------------------------------------

--
-- Table structure for table `drivers-routes`
--

DROP TABLE IF EXISTS `drivers-routes`;
CREATE TABLE IF NOT EXISTS `drivers-routes` (
  `driver_id` int(6) UNSIGNED NOT NULL,
  `routes_id` int(6) UNSIGNED NOT NULL,
  KEY `driver_id` (`driver_id`),
  KEY `routes_id` (`routes_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drivers-routes`
--

INSERT INTO `drivers-routes` (`driver_id`, `routes_id`) VALUES
(13, 42),
(11, 45),
(14, 47),
(51, 48),
(17, 50),
(14, 99),
(51, 103),
(47, 106);

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

DROP TABLE IF EXISTS `routes`;
CREATE TABLE IF NOT EXISTS `routes` (
  `route_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `region` int(1) UNSIGNED NOT NULL,
  `direction` int(1) UNSIGNED NOT NULL,
  `max_people` int(1) UNSIGNED NOT NULL,
  `cost` decimal(2,2) NOT NULL,
  `stop_0` time DEFAULT NULL,
  `stop_1` time DEFAULT NULL,
  `stop_2` time DEFAULT NULL,
  `stop_3` time DEFAULT NULL,
  `stop_4` time DEFAULT NULL,
  `stop_5` time DEFAULT NULL,
  `stop_6` time DEFAULT NULL,
  `stop_7` time DEFAULT NULL,
  `stop_8` time DEFAULT NULL,
  `stop_9` time DEFAULT NULL,
  `depart` varchar(20) NOT NULL,
  `dest` varchar(20) NOT NULL,
  PRIMARY KEY (`route_id`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`route_id`, `region`, `direction`, `max_people`, `cost`, `stop_0`, `stop_1`, `stop_2`, `stop_3`, `stop_4`, `stop_5`, `stop_6`, `stop_7`, `stop_8`, `stop_9`, `depart`, `dest`) VALUES
(42, 0, 1, 5, '0.50', NULL, '09:00:00', NULL, '09:30:00', NULL, NULL, '10:00:00', NULL, NULL, '10:00:00', 'SJSU', 'Daly City'),
(45, 0, 1, 5, '0.60', NULL, '08:40:00', NULL, '09:00:00', NULL, '09:20:00', NULL, '09:40:00', NULL, '10:00:00', 'SJSU', 'San Francisco'),
(47, 0, 0, 0, '0.70', '08:30:00', '08:40:00', NULL, '09:00:00', NULL, '09:20:00', NULL, '09:40:00', NULL, '10:00:00', 'San Francisco', 'SJSU'),
(48, 0, 1, 2, '0.45', '11:30:00', '11:20:00', NULL, '11:00:00', NULL, '10:40:00', NULL, '10:20:00', NULL, '10:00:00', 'SJSU', 'San Francisco'),
(50, 1, 0, 2, '0.11', '10:00:00', '10:10:00', NULL, NULL, '10:40:00', NULL, NULL, '11:10:00', NULL, '11:30:00', 'Gilroy', 'SJSU'),
(99, 0, 0, 2, '0.00', NULL, NULL, NULL, NULL, '01:00:00', NULL, '01:20:00', NULL, NULL, '01:50:00', 'Redwood City', 'SJSU'),
(103, 0, 0, 3, '0.00', NULL, NULL, NULL, '11:00:00', NULL, NULL, NULL, '11:40:00', NULL, '12:00:00', 'San Mateo', 'SJSU'),
(106, 0, 1, 2, '0.33', '12:52:00', NULL, NULL, NULL, NULL, NULL, NULL, '11:42:00', NULL, '11:22:00', 'SJSU', 'San Francisco');

-- --------------------------------------------------------

--
-- Table structure for table `stops`
--

DROP TABLE IF EXISTS `stops`;
CREATE TABLE IF NOT EXISTS `stops` (
  `stop_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `stop_name` varchar(20) NOT NULL,
  `area` int(1) UNSIGNED NOT NULL,
  `sub_index` int(1) UNSIGNED NOT NULL,
  PRIMARY KEY (`stop_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stops`
--

INSERT INTO `stops` (`stop_id`, `stop_name`, `area`, `sub_index`) VALUES
(1, 'San Francisco', 0, 0),
(2, 'Daly City', 0, 1),
(3, 'Millbrae', 0, 2),
(4, 'San Mateo', 0, 3),
(5, 'Redwood City', 0, 4),
(6, 'Palo Alto', 0, 5),
(7, 'Mountain View', 0, 6),
(8, 'Sunnyvale', 0, 7),
(9, 'Santa Clara', 0, 8),
(10, 'SJSU', 0, 9),
(11, 'Gilroy', 1, 0),
(12, 'San Martin', 1, 1),
(13, 'Morgan Hill', 1, 2),
(14, 'Coyote', 1, 3),
(15, 'Westfield Oakridge', 1, 4),
(16, 'Los Gatos', 1, 5),
(17, 'Campbell', 1, 6),
(18, 'Fruitdale', 1, 7),
(19, 'Westfield Valley Fai', 1, 8),
(20, 'SJSU', 1, 9),
(21, 'Oakland', 2, 0),
(22, 'Alameda', 2, 1),
(23, 'San Leandro', 2, 2),
(24, 'Hayward', 2, 3),
(25, 'Union City', 2, 4),
(26, 'Fremont', 2, 5),
(27, 'Newark', 2, 6),
(28, 'Milpitas', 2, 7),
(29, 'San Jose', 2, 8),
(30, 'SJSU', 2, 9);

-- --------------------------------------------------------

--
-- Table structure for table `user-routes`
--

DROP TABLE IF EXISTS `user-routes`;
CREATE TABLE IF NOT EXISTS `user-routes` (
  `user_id` int(6) UNSIGNED NOT NULL,
  `routes_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  KEY `driver_id` (`user_id`),
  KEY `routes_id` (`routes_id`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user-routes`
--

INSERT INTO `user-routes` (`user_id`, `routes_id`) VALUES
(11, 42),
(9, 45),
(12, 47),
(24, 48),
(16, 50),
(12, 99),
(24, 103),
(25, 106);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `email` varchar(50) NOT NULL,
  `psw` varchar(50) NOT NULL,
  `is_driver` int(6) UNSIGNED DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `is_driver` (`is_driver`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `phone`, `email`, `psw`, `is_driver`, `reg_date`) VALUES
(9, 'Jimmy', 'Smith', '6500001234', 'jimmysmith@mail.com', 'Pass1234', 11, '2016-05-02 23:15:18'),
(11, 'Test', 'Test', '1111111111', 'tester@maill.com', 'Pass1234', 13, '2016-05-02 23:15:35'),
(12, 'Sussie', 'Sue', '6502134567', 'sussie@mail.com', 'Test1234', 14, '2016-05-02 23:15:41'),
(14, 'Demo', 'Liu', '650876543', 'demo@mail.com', 'Test1234', NULL, '2016-05-04 21:41:43'),
(16, 'John', 'Doe', '4051236565', 'johndoe@mail.com', 'Test1234', 17, '2016-04-28 06:36:53'),
(24, 'Hai', 'Hello', '1234561111', 'haihello@mail.com', 'Test1234', 51, '2016-05-02 23:15:54'),
(25, 'Test', 'Doer', '1231234123', 'doer@mail.com', 'Pass1234', 47, '2016-05-05 01:09:46');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `drivers-cars`
--
ALTER TABLE `drivers-cars`
  ADD CONSTRAINT `cars` FOREIGN KEY (`car_id`) REFERENCES `cars` (`car_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `driver` FOREIGN KEY (`driver_id`) REFERENCES `users` (`is_driver`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `drivers-routes`
--
ALTER TABLE `drivers-routes`
  ADD CONSTRAINT `drivers` FOREIGN KEY (`driver_id`) REFERENCES `users` (`is_driver`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `routes` FOREIGN KEY (`routes_id`) REFERENCES `routes` (`route_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user-routes`
--
ALTER TABLE `user-routes`
  ADD CONSTRAINT `route` FOREIGN KEY (`routes_id`) REFERENCES `routes` (`route_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
