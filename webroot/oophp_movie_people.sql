-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Host: blu-ray.student.bth.se
-- Generation Time: Jan 26, 2015 at 02:59 PM
-- Server version: 5.5.40
-- PHP Version: 5.5.20-1~dotdeb.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gohe14`
--

-- --------------------------------------------------------

--
-- Table structure for table `oophp_movie_people`
--

CREATE TABLE IF NOT EXISTS `oophp_movie_people` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `_movie_id` int(11) NOT NULL,
  `_people_id` int(11) NOT NULL,
  `_function` varchar(16) DEFAULT 'actor',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100 ;

--
-- Dumping data for table `oophp_movie_people`
--

INSERT INTO `oophp_movie_people` (`id`, `_movie_id`, `_people_id`, `_function`) VALUES
(1, 1, 2, 'actor'),
(2, 1, 3, 'actor'),
(3, 1, 4, 'actor'),
(4, 2, 6, 'actor'),
(5, 2, 7, 'actor'),
(6, 2, 8, 'actor'),
(7, 5, 11, 'actor'),
(8, 5, 12, 'actor'),
(9, 5, 13, 'actor'),
(10, 12, 15, 'actor'),
(11, 12, 16, 'actor'),
(12, 12, 17, 'actor'),
(13, 17, 19, 'actor'),
(14, 18, 19, 'actor'),
(15, 3, 21, 'actor'),
(16, 3, 22, 'actor'),
(17, 3, 23, 'actor'),
(18, 4, 25, 'actor'),
(19, 4, 26, 'actor'),
(20, 4, 27, 'actor'),
(21, 6, 11, 'actor'),
(22, 6, 29, 'actor'),
(23, 6, 30, 'actor'),
(24, 7, 32, 'actor'),
(25, 7, 33, 'actor'),
(26, 7, 21, 'actor'),
(27, 8, 35, 'actor'),
(28, 8, 36, 'actor'),
(29, 8, 37, 'actor'),
(30, 9, 39, 'actor'),
(31, 9, 40, 'actor'),
(32, 9, 41, 'actor'),
(33, 10, 43, 'actor'),
(34, 10, 44, 'actor'),
(35, 10, 45, 'actor'),
(36, 11, 46, 'actor'),
(37, 11, 47, 'actor'),
(38, 11, 48, 'actor'),
(39, 13, 47, 'actor'),
(40, 13, 49, 'actor'),
(41, 13, 50, 'actor'),
(42, 14, 52, 'actor'),
(43, 14, 53, 'actor'),
(44, 14, 54, 'actor'),
(45, 14, 55, 'actor'),
(46, 14, 56, 'actor'),
(47, 14, 57, 'actor'),
(48, 16, 59, 'actor'),
(49, 16, 60, 'actor'),
(50, 16, 61, 'actor'),
(51, 1, 1, 'director'),
(52, 2, 5, 'director'),
(53, 3, 20, 'director'),
(54, 4, 24, 'director'),
(55, 5, 9, 'director'),
(56, 5, 10, 'director'),
(57, 6, 28, 'director'),
(58, 7, 31, 'director'),
(59, 8, 34, 'director'),
(60, 9, 38, 'director'),
(61, 10, 42, 'director'),
(62, 11, 31, 'director'),
(63, 12, 14, 'director'),
(64, 13, 31, 'director'),
(65, 14, 51, 'director'),
(66, 16, 58, 'director'),
(67, 17, 62, 'director'),
(68, 18, 18, 'director'),
(69, 19, 63, 'director,writer'),
(70, 19, 64, 'actor'),
(71, 19, 65, 'actor'),
(72, 19, 66, 'actor'),
(73, 20, 67, 'director'),
(74, 20, 68, 'writer'),
(75, 20, 69, 'actor'),
(76, 20, 70, 'actor'),
(77, 21, 71, 'director'),
(78, 21, 72, 'writer'),
(79, 21, 73, 'actor'),
(80, 21, 74, 'actor'),
(81, 21, 75, 'actor'),
(82, 22, 76, 'director'),
(83, 22, 77, 'actor'),
(84, 22, 78, 'actor'),
(85, 22, 79, 'actor'),
(86, 23, 80, 'actor'),
(87, 23, 81, 'actor'),
(88, 23, 82, 'actor'),
(89, 23, 83, 'writer'),
(90, 24, 1, 'director,writer'),
(91, 24, 84, 'actor'),
(92, 24, 85, 'actor'),
(93, 24, 86, 'actor'),
(94, 25, 87, 'director'),
(95, 25, 88, 'actor'),
(96, 25, 89, 'actor'),
(97, 25, 90, 'actor'),
(98, 26, 91, 'director,writer,'),
(99, 26, 92, 'actor');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
