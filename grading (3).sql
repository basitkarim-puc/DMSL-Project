-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Dec 17, 2021 at 03:27 PM
-- Server version: 10.6.5-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grading`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'tanzimibnpatowarybd@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE IF NOT EXISTS `course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `code` varchar(10) NOT NULL,
  `semester` int(11) NOT NULL,
  `avail` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `name`, `code`, `semester`, `avail`) VALUES
(3, 'Digital Electronics', 'DE(202)', 2, 1),
(4, 'Algorithm Design And Analysis', 'ADA(405)', 4, 1),
(7, 'System Design', 'SD(502)', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `enrolled_course`
--

DROP TABLE IF EXISTS `enrolled_course`;
CREATE TABLE IF NOT EXISTS `enrolled_course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enrolled_course`
--

INSERT INTO `enrolled_course` (`id`, `course_id`, `student_id`, `status`) VALUES
(1, 3, 1, 1),
(3, 4, 2, 1),
(4, 1, 2, 0),
(5, 3, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `marks_distribution`
--

DROP TABLE IF EXISTS `marks_distribution`;
CREATE TABLE IF NOT EXISTS `marks_distribution` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `class_attendacne` int(11) NOT NULL DEFAULT 0,
  `home_work` int(11) NOT NULL DEFAULT 0,
  `class_test` int(11) NOT NULL DEFAULT 0,
  `mid_term` int(11) NOT NULL DEFAULT 0,
  `final` int(11) NOT NULL DEFAULT 0,
  `published` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `marks_distribution`
--

INSERT INTO `marks_distribution` (`id`, `student_id`, `course_id`, `class_attendacne`, `home_work`, `class_test`, `mid_term`, `final`, `published`) VALUES
(1, 1, 3, 8, 10, 7, 18, 38, 1),
(2, 2, 4, 10, 9, 10, 19, 10, 1),
(3, 2, 3, 5, 6, 9, 20, 48, 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_info`
--

DROP TABLE IF EXISTS `student_info`;
CREATE TABLE IF NOT EXISTS `student_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `student_id` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_info`
--

INSERT INTO `student_info` (`id`, `name`, `student_id`, `email`, `password`) VALUES
(1, 'Basit Karim', '1903610201788', 'basit.bk@gmail.com', '5d41402abc4b2a76b9719d911017c592'),
(2, 'Tanzim Ibn Patowary', '1903610201764', 'tanzimibnpatowarybd@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055'),
(3, 'MD Hossain', '1903610201776', 'hossain@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
