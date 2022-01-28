-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 27, 2022 at 01:49 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quantox_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `dashboard`
--

DROP TABLE IF EXISTS `dashboard`;
CREATE TABLE IF NOT EXISTS `dashboard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dashboard` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dashboard`
--

INSERT INTO `dashboard` (`id`, `dashboard`) VALUES
(1, 'CSM'),
(2, 'CSMB');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

DROP TABLE IF EXISTS `grades`;
CREATE TABLE IF NOT EXISTS `grades` (
  `student_id` int(11) NOT NULL,
  `grade` int(11) NOT NULL,
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`student_id`, `grade`) VALUES
(1, 7),
(1, 6),
(1, 8),
(2, 7),
(2, 8),
(2, 6),
(2, 5),
(3, 6),
(3, 9),
(4, 7),
(4, 9),
(4, 4),
(5, 6),
(5, 9),
(6, 8),
(6, 6),
(6, 7),
(7, 8),
(7, 8),
(7, 9);

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

DROP TABLE IF EXISTS `school`;
CREATE TABLE IF NOT EXISTS `school` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `school_name` varchar(150) NOT NULL,
  `dashboard_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`id`, `school_name`, `dashboard_id`) VALUES
(1, 'Skola 1', 1),
(2, 'Skola 2', 2),
(3, 'Skola 3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `surname` varchar(150) NOT NULL,
  `school_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `school_id` (`school_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`, `surname`, `school_id`) VALUES
(1, 'Elliott', 'Vaughan', 1),
(2, 'Diego', 'Strong', 1),
(3, 'Eve', 'Ibarra', 2),
(4, 'Alfred', 'Cortez', 2),
(5, 'Cassie', 'Davidson', 2),
(6, 'Urijah', 'White', 3),
(7, 'Brylee', 'Yates', 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
