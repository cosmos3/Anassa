-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Host: blu-ray.student.bth.se
-- Generation Time: Jan 26, 2015 at 02:58 PM
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
-- Table structure for table `oophp_user`
--

CREATE TABLE IF NOT EXISTS `oophp_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `_acronym` varchar(20) DEFAULT NULL,
  `_password` varchar(255) DEFAULT NULL,
  `_name` varchar(80) DEFAULT NULL,
  `_email` varchar(80) DEFAULT NULL,
  `_level` varchar(16) NOT NULL DEFAULT 'normal',
  `_created` datetime DEFAULT NULL,
  `_deleted` datetime DEFAULT NULL,
  `_logins` int(11) DEFAULT NULL,
  `_logged_in` datetime DEFAULT NULL,
  `_logged_out` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `_ac` (`_acronym`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `oophp_user`
--

INSERT INTO `oophp_user` (`id`, `_acronym`, `_password`, `_name`, `_email`, `_level`, `_created`, `_deleted`, `_logins`, `_logged_in`, `_logged_out`) VALUES
(1, 'anassa', '5bc2ed534dd983b28e8589d6968b2462', 'Anassa', 'cosmos3@telia.com', 'super', '2014-12-10 10:00:00', NULL, 4, '2015-01-23 00:06:03', '2015-01-23 00:06:48'),
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrat&ouml;ren', 'admin@rm.se', 'admin', '2014-11-11 10:00:00', NULL, 198, '2015-01-25 23:46:19', '2015-01-23 00:05:54'),
(3, 'doe', '2829fc16ad8ca5a79da932f910afad1c', 'John/Jane Doe', 'doe@doe.com', 'normal', '2014-11-11 10:00:00', NULL, 20, '2015-01-24 23:07:28', '2015-01-22 06:40:02'),
(4, 'musse', '0621b863a86efe59b44a3095e7003458', 'Musse Pigg', 'musse@pigg.com', 'normal', '2014-11-30 10:00:00', NULL, 4, '2015-01-22 22:45:56', '2015-01-22 23:06:27'),
(5, 'kalle', 'c16e24898200c27d89cd30e9abd51984', 'Kalle Anka', 'kalle@anka.com', 'normal', '2014-12-10 21:39:34', NULL, 3, '2015-01-22 23:38:11', '2015-01-22 23:42:22');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
