-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Host: blu-ray.student.bth.se
-- Generation Time: Jan 26, 2015 at 03:00 PM
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
-- Table structure for table `oophp_movie`
--

CREATE TABLE IF NOT EXISTS `oophp_movie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `_title` varchar(80) DEFAULT NULL,
  `_year` smallint(6) NOT NULL DEFAULT '2014',
  `_genre` varchar(40) DEFAULT NULL,
  `_content` text,
  `_image` varchar(255) DEFAULT NULL,
  `_imdb` varchar(255) DEFAULT NULL,
  `_price` smallint(4) DEFAULT NULL,
  `_orders` smallint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `oophp_movie`
--

INSERT INTO `oophp_movie` (`id`, `_title`, `_year`, `_genre`, `_content`, `_image`, `_imdb`, `_price`, `_orders`) VALUES
(1, 'Star Wars', 1977, 'Action/Adventure/Fantasy', 'Luke Skywalker joins forces with a Jedi Knight, a cocky pilot, a wookiee and two droids to save the universe from the Empire''s world-destroying battle-station, while also attempting to rescue Princess Leia from the evil Darth Vader.\n', 'img/movies/star_wars.jpg', 'http://www.imdb.com/title/tt0076759/', 89, 3),
(2, 'Fight Club', 1999, 'Drama', 'An insomniac office worker looking for a way to change his life crosses paths with a devil-may-care soap maker and they form an underground fight club that evolves into something much, much more...', 'img/movies/fight_club.jpg', 'http://www.imdb.com/title/tt0137523/', 49, 1),
(3, 'Inception', 2010, 'Action/Sci-Fi/Thriller', 'A thief who steals corporate secrets through use of dream-sharing technology is given the inverse task of planting an idea into the mind of a CEO.', 'img/movies/inception.jpg', 'http://www.imdb.com/title/tt1375666/', 39, NULL),
(4, 'Lost in Translation', 2003, 'Drama', 'A faded movie star and a neglected young woman form an unlikely bond after crossing paths in Tokyo.', 'img/movies/lost_in_translation.jpg', 'http://www.imdb.com/title/tt0335266/', 49, 1),
(5, 'The Matrix', 1999, 'Action/Sci-Fi', 'A computer hacker learns from mysterious rebels about the true nature of his reality and his role in the war against its controllers.', 'img/movies/the_matrix.jpg', 'http://www.imdb.com/title/tt0133093', 79, 5),
(6, 'Constantine', 2005, 'Drama/Fantasy/Horror', 'Constantine tells the story of irreverent supernatural detective John Constantine, who has literally been to hell and back.', 'img/movies/constantine.jpg', 'http://www.imdb.com/title/tt0360486', 89, 4),
(7, 'Django Unchained', 2012, 'Western', 'With the help of a German bounty hunter, a freed slave sets out to rescue his wife from a brutal Mississippi plantation owner.', 'img/movies/django_unchained.jpg', 'http://www.imdb.com/title/tt1853728', 79, 1),
(8, 'Alien', 1979, 'Horror/Sci-Fi', 'The commercial vessel Nostromo receives a distress call from an unexplored planet. After searching for survivors, the crew heads home only to realize that a deadly bioform has joined them.', 'img/movies/alien.jpg', 'http://www.imdb.com/title/tt0078748/', 79, 3),
(9, 'The Chronicles of Riddick', 2004, 'Action/Adventure/Sci-Fi', '5 years after Pitch Black, the wanted criminal Riddick arrives on a planet called Helion Prime, and finds himself up against an invading empire called the Necromongers, an army that plans to convert or kill all humans in the universe.', 'img/movies/the_chronicles_of_riddick.jpg', 'http://www.imdb.com/title/tt0296572', 49, NULL),
(10, 'Serenity', 2005, 'Action/Adventure/Sci-Fi', 'The crew of the ship Serenity tries to evade an assassin sent to recapture one of their number who is telepathic.', 'img/movies/serenity.jpg', 'http://www.imdb.com/title/tt0379786', 49, 1),
(11, 'Pulp Fiction', 1994, 'Crime/Drama/Thriller', 'The lives of two mob hit men, a boxer, a gangster''s wife, and a pair of diner bandits intertwine in four tales of violence and redemption.', 'img/movies/pulp_fiction.jpg', 'http://www.imdb.com/title/tt0110912/?ref_=nv_sr_1', 59, NULL),
(12, '2001: A Space Odyssey', 1968, 'Mystery/Sci-Fi', 'Humanity finds a mysterious, obviously artificial, object buried beneath the Lunar surface and, with the intelligent computer H.A.L. 9000, sets off on a quest.', 'img/movies/2001_a_space_odyssey.jpg', 'http://www.imdb.com/title/tt0062622/?ref_=nv_sr_1', 99, 8),
(13, 'Kill Bill: Vol. 1', 2003, 'Action/Chrime', 'The Bride wakens from a four-year coma. The child she carried in her womb is gone. Now she must wreak vengeance on the team of assassins who betrayed her - a team she was once part of.', 'img/movies/kill_bill_vol_1.jpg', 'http://www.imdb.com/title/tt0266697/?ref_=nv_sr_1', 59, 1),
(14, 'The Lord of the Rings: The Fellowship of the Ring', 2001, 'Adventure/Fantasy', 'A meek hobbit of the Shire and eight companions set out on a journey to Mount Doom to destroy the One Ring and the dark lord Sauron.', 'img/movies/the_lord_of_the_rings_the_fellowship_of_the_ring.jpg', 'http://www.imdb.com/title/tt0120737/?ref_=nv_sr_1', 99, 4),
(15, 'Pokémon: The First Movie - Mewtwo Strikes Back', 1998, 'Animation/Action/Adventure', 'Scientists genetically create a new Pokémon, Mewtwo, but the results are horrific and disastrous.', 'img/movies/pokemon_the_first_movie_mewtwo_strikes_back.jpg', 'http://www.imdb.com/title/tt0190641/?ref_=nv_sr_1', 29, NULL),
(16, 'The Polar Express', 2004, 'Animation/Adventure/Family', 'On Christmas Eve, a doubting boy boards a magical train that''s headed to the North Pole and Santa Claus'' home.', 'img/movies/the_polar_express.jpg', 'http://www.imdb.com/title/tt0338348/?ref_=nv_sr_1', 39, NULL),
(17, 'Eddie Izzard: Dress to Kill', 1999, 'Comedy', 'Executive transvestite Eddie Izzard takes his show to San Francisco to give a brief history of pagan and Christian religions, the building of Stonehenge, the birth of the Church of England ...', 'img/movies/eddie_izzard_dress_to_kill.jpg', 'http://www.imdb.com/title/tt0184424/?ref_=nm_knf_i4', 59, 2),
(18, 'Eddie Izzard: Definite Article', 1996, 'Comedy', '''Definite Article'' marks that thrilling moment when a promising talent moves up several gears into major stardom"--Daily Telegraph, UK', 'img/movies/eddie_izzard_definite_article.jpg', 'http://www.imdb.com/title/tt0116066/?ref_=tt_rec_tti', 59, 3),
(19, 'Brazil', 1985, 'Sci-Fi', 'A bureaucrat in a retro-future world tries to correct an administrative error and himself becomes an enemy of the state.', 'img/movies/brazil.jpg', 'http://www.imdb.com/title/tt0088846/?ref_=nm_knf_i4', 59, 2),
(20, 'Solaris', 1972, 'Sci-Fi/Drama', 'A psychologist is sent to a station orbiting a distant planet in order to discover what has caused the crew to go insane.', 'img/movies/solaris.jpg', 'http://www.imdb.com/title/tt0069293/?ref_=nv_sr_1', 79, 1),
(21, 'Pink Floyd The Wall', 1982, 'Animation/Drama/Musical', 'A confined but troubled rock star descends into madness in the midst of his physical and social isolation from everyone.', 'img/movies/pink_floyd_the_wall.jpg', 'http://www.imdb.com/title/tt0084503/?ref_=nv_sr_4', 49, 4),
(22, 'Hunt vs Lauda: F1:s Greatest Racing Rivals', 2013, 'Documentary/Sport', 'This powerful story captures the heart of the 1970s - told through unseen footage and exclusive interviews with the people who were really there - the team managers, families, journalists.', 'img/movies/hunt_vs_lauda.jpg', 'http://www.imdb.com/title/tt3056202/?ref_=nv_sr_1', 49, NULL),
(23, 'Star Trek (1966-1969)', 1969, 'Sci-Fi/Action/Adventure', 'Captain James T. Kirk and the crew of the Starship Enterprise explore the Galaxy and defend the United Federation of Planets.', 'img/movies/star_trek_1966_1969.jpg', 'http://www.imdb.com/title/tt0060028/?ref_=nv_sr_4', 99, 1),
(24, 'THX 1138', 1971, 'Sci-Fi/Thriller', 'Set in the 25th century, the story centers around a man and a woman who rebel against their rigidly controlled society.', 'img/movies/thx_1138.jpg', 'http://www.imdb.com/title/tt0066434/?ref_=nv_sr_1', 49, 3),
(25, 'Dawn of the Planet of the Apes', 2014, 'Action/Drama/Sci-Fi', 'Ten years after a pandemic disease, apes who have survived it are drawn into battle with a group of human survivors.', 'img/movies/dawn_of_the_planet_of_the_apes.jpg', 'http://www.imdb.com/title/tt2103281/?ref_=nv_sr_1', 69, NULL),
(26, 'BTH: Kursen OOPHP - En Verklighet P&aring; Distans', 2014, 'Documentary/Adventure/Fantasy', 'I v&aring;r DVD-utg&aring;va av kursen utg&aring;r vi ifr&aring;n att du kan programmera i PHP, att du kan HTML och CSS och grunderna i SQL. D&auml;rifr&aring;n bygger kursen vidare p&aring; objektorienterad PHP programmering tillsammans med databasen MySQL. Du bygger en webbmall som du fyller p&aring; med objektorienterade moduler och till slut sammanfogar du allt i ett projekt och visar hur bra din webbmall och dina komponenter h&aring;ller f&ouml;r att bygga webbplatser.', NULL, 'http://dbwebb.se/oophp/', 19, 3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
