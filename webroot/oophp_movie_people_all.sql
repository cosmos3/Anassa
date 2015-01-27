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
-- Table structure for table `oophp_movie_people_all`
--

CREATE TABLE IF NOT EXISTS `oophp_movie_people_all` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `_name` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=93 ;

--
-- Dumping data for table `oophp_movie_people_all`
--

INSERT INTO `oophp_movie_people_all` (`id`, `_name`) VALUES
(1, 'George Lucas'),
(2, 'Mark Hamill'),
(3, 'Harrison Ford'),
(4, 'Carrie Fisher'),
(5, 'David Fincher'),
(6, 'Brad Pitt'),
(7, 'Edward Norton'),
(8, 'Helena Bonham Carter'),
(9, 'Andy Wachowski'),
(10, 'Lana Wachowski'),
(11, 'Keanu Reeves'),
(12, 'Laurence Fishburne'),
(13, 'Carrie-Anne Moss'),
(14, 'Stanley Kubrick'),
(15, 'Keir Dullea'),
(16, 'Gary Lockwood'),
(17, 'William Sylvester'),
(18, 'Ed Bye'),
(19, 'Eddie Izzard'),
(20, 'Christopher Nolan'),
(21, 'Leonardo DiCaprio'),
(22, 'Joseph Gordon-Levitt'),
(23, 'Ellen Page'),
(24, 'Sofia Coppola'),
(25, 'Bill Murray'),
(26, 'Scarlett Johansson'),
(27, 'Giovanni Ribisi'),
(28, 'Francis Lawrence'),
(29, 'Rachel Weisz'),
(30, 'Djimon Hounsou'),
(31, 'Quentin Tarantino'),
(32, 'Jamie Foxx'),
(33, 'Christoph Waltz'),
(34, 'Ridley Scott'),
(35, 'Sigourney Weaver'),
(36, 'Tom Skerritt'),
(37, 'John Hurt'),
(38, 'David Twohy'),
(39, 'Vin Diesel'),
(40, 'Judi Dench'),
(41, 'Colm Feore'),
(42, 'Joss Whedon'),
(43, 'Nathan Fillion'),
(44, 'Gina Torres'),
(45, 'Chiwetel Ejiofor'),
(46, 'John Travolta'),
(47, 'Uma Thurman'),
(48, 'Samuel L. Jackson'),
(49, 'David Carradine'),
(50, 'Daryl Hannah'),
(51, 'Peter Jackson'),
(52, 'Elijah Wood'),
(53, 'Ian McKellen'),
(54, 'Orlando Bloom'),
(55, 'Cate Blanchett'),
(56, 'Ian Holm'),
(57, 'Christopher Lee'),
(58, 'Robert Zemeckis'),
(59, 'Tom Hanks'),
(60, 'Chris Coppola'),
(61, 'Michael Jeter'),
(62, 'Lawrence Jordan'),
(63, 'Terry Gilliam'),
(64, 'Jonathan Pryce'),
(65, 'Kim Greist'),
(66, 'Robert de Niro'),
(67, 'Andrei Tarkovsky'),
(68, 'Stanislaw Lem'),
(69, 'Natalya Bondarchuk'),
(70, 'Donatas Banionis'),
(71, 'Alan Parker'),
(72, 'Roger Waters'),
(73, 'Bob Geldof'),
(74, 'Christine Hargreaves'),
(75, 'Bob Hoskins'),
(76, 'Matthew Whiteman'),
(77, 'Ed Stoppard'),
(78, 'Daniel Audetto'),
(79, 'Alastair Caldwell'),
(80, 'William Shatner'),
(81, 'Leonard Nimoy'),
(82, 'DeForest Kelley'),
(83, 'Gene Roddenberry'),
(84, 'Robert Duvall'),
(85, 'Donald Pleasence'),
(86, 'Maggie McOmie'),
(87, 'Matt Reeves'),
(88, 'Gary Oldman'),
(89, 'Keri Russell'),
(90, 'Andy Serkis'),
(91, 'Mikael Tage Harald Roos - MegaMic - Mos'),
(92, 'En massa fattiga studenter');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
