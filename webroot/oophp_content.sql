-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Host: blu-ray.student.bth.se
-- Generation Time: Jan 22, 2015 at 11:16 AM
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
-- Table structure for table `oophp_content`
--

CREATE TABLE IF NOT EXISTS `oophp_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `_title` varchar(80) DEFAULT NULL,
  `_type` char(80) DEFAULT NULL,
  `_url` char(80) DEFAULT NULL,
  `_slug` char(80) DEFAULT NULL,
  `_data` text,
  `_html5` tinyint(1) NOT NULL DEFAULT '0',
  `_filter` char(80) DEFAULT NULL,
  `_published` datetime DEFAULT NULL,
  `_created` datetime DEFAULT NULL,
  `_updated` datetime DEFAULT NULL,
  `_deleted` datetime DEFAULT NULL,
  `_owner_acronym` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `_url` (`_url`),
  UNIQUE KEY `_slug` (`_slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `oophp_content`
--

INSERT INTO `oophp_content` (`id`, `_title`, `_type`, `_url`, `_slug`, `_data`, `_html5`, `_filter`, `_published`, `_created`, `_updated`, `_deleted`, `_owner_acronym`) VALUES
(1, 'Hem', 'page', 'home', 'home', '##En värld - En Drottning - Ett pyttelitet PHP-ramverk...\r\n<code>\r\n*The feminine form of Anax is Anassa, "Queen" (ἄνασσα, ánassa; from wánassa, itself from *wánakt-ja). "Anassa - high Queens who exercise overlordship over other, presumably lesser, Queens."*\r\n</code><br/><br/>\r\n<span style="color:#F00;">En färgglad rad</span><br/>\r\n\r\nDetta är **ANASSA**:s sida. Den är skriven i både <b>HTML5</b> och [Markdown](http://en.wikipedia.org/wiki/Markdown). Markdown innebär att du får bra kontroll över innehållet i din sida, du kan formattera och sätta rubriker, men du behöver inte bry dig om HTML.\r\n\r\nRubrik nivå 2\r\n-------------\r\n\r\nDu skriver enkla styrtecken för att formattera texten som **fetstil** och *kursiv*. Det finns ett speciellt sätt att länka, skapa tabeller och så vidare.\r\n\r\n###Rubrik nivå 3\r\n\r\nNär man skriver i markdown så blir det läsbart även som textfil och det är lite av tanken med markdown.', 1, 'markdown,link', '2014-12-09 10:52:30', '2014-12-09 10:52:30', '2014-12-10 13:51:48', NULL, 'admin'),
(2, 'Borta', 'page', 'gone', NULL, 'Detta är ännu en sida. Den är skriven i [url=http://en.wikipedia.org/wiki/BBCode]bbcode[/url] vilket innebär att man kan formattera texten till [b]bold[/b] och [i]kursiv stil[/i] samt hantera länkar.\r\n\r\nDessutom finns ett filter ''nl2br'' som lägger in <br>-element istället för (enter), det är smidigt, man kan skriva texten precis som man tänker sig att den skall visas, med radbrytningar.\r\n\r\nTvå radbrytningar\r\n\r\n\r\n<h1>TEST</h1>\r\n<span style=''color:#F00;''>Ingen HTML5 här!</span>', 0, 'bbcode,nl2br', '2014-12-09 13:57:47', '2014-12-09 10:52:30', '2014-12-11 12:41:30', NULL, 'doe'),
(3, 'Välkommen till min blogg!', 'post', NULL, 'blogpost-1', 'Detta är en bloggpost.\r\n\r\nNär det finns länkar till andra webbplatser så kommer de länkarna att bli klickbara.\r\n\r\nhttp://dbwebb.se är ett exempel på en länk som blir klickbar.', 0, 'link,nl2br', '2015-01-21 22:13:47', '2014-12-09 10:52:30', '2015-01-21 22:13:47', NULL, 'doe'),
(4, 'Nu har vintern kommit', 'post', NULL, 'blogpost-2', 'Detta är en bloggpost som berättar att vintern har kommit, ett budskap som kräver en bloggpost.', 0, 'markdown', '2014-12-09 10:52:30', '2014-12-09 10:52:30', '2014-12-10 14:08:11', NULL, 'doe'),
(5, 'Nu är julen här!', 'post', NULL, 'nu-ar-julen-har', 'Nåja, snart är julen här - bara två veckor kvar!\r\n\r\n![Jul](img/calendar/calendar_img_12.jpg "Jul")\r\n\r\nI *Ankeborg* förbereds det för fullt och vi är alla så upptagna med att repetera in våra roller för årets  "**Kalle Anka**"-timme!', 0, 'markdown', '2014-12-10 09:21:19', '2014-12-09 10:52:30', '2014-12-11 12:39:47', NULL, 'musse'),
(6, 'hej', 'post', NULL, 'hej', 'head\r\n----\r\nhttp://www.google.se\r\n\r\n[b]bold text[/b]', 1, 'nl2br,link,bbcode', '2015-01-21 23:47:54', '2015-01-20 12:39:23', '2015-01-21 23:49:07', NULL, 'admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
