-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 09 jun 2014 kl 10:32
-- Serverversion: 5.6.16
-- PHP-version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `summary`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(1000) NOT NULL,
  `postdate` datetime NOT NULL,
  `SUMMARY_ID` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellstruktur `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `U_ID` int(11) NOT NULL,
  `SUBJECT_NAME` varchar(32) NOT NULL,
  `description` text NOT NULL,
  `ip_address` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumpning av Data i tabell `subjects`
--

INSERT INTO `subjects` (`id`, `U_ID`, `SUBJECT_NAME`, `description`, `ip_address`) VALUES
(10, 24, 'testniklas', 'testniklas', '::1'),
(11, 25, 'teasdasd', 'asdsadasd', '::1'),
(12, 25, 'asdasda', 'asdasda', '::1'),
(13, 25, 'asd', 'adsad', '::1');

-- --------------------------------------------------------

--
-- Tabellstruktur `summaries`
--

CREATE TABLE IF NOT EXISTS `summaries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(32) NOT NULL,
  `content` text NOT NULL,
  `subject_id` int(11) NOT NULL,
  `U_ID` int(11) NOT NULL,
  `ip_address` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumpning av Data i tabell `summaries`
--

INSERT INTO `summaries` (`id`, `title`, `content`, `subject_id`, `U_ID`, `ip_address`) VALUES
(7, 'testniklas', 'testniklas', 0, 24, '::1'),
(8, 'testniklas2', 'asdsadsada', 0, 24, '::1'),
(9, 'asdasd', 'adssad', 1, 25, '::1'),
(10, 'asda', 'dasdsad', 1, 24, '::1');

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(32) NOT NULL,
  `lname` varchar(32) NOT NULL,
  `uname` varchar(32) NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `confirmed_email` tinyint(1) NOT NULL,
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ip_address` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `uname`, `password`, `email`, `confirmed_email`, `banned`, `ip_address`) VALUES
(24, 'testniklas', 'testniklas', 'testniklas', '$2y$10$SPHLc0GsxQn2O9ETszTosutBS0Cg2K/VEoyys2lidNPxIDN9O6eIO', 'testniklas@testniklas.testniklas', 0, 0, '::1'),
(25, 'testniklas1', 'testniklas1', 'testniklas1', '$2y$10$mpMiZPiWHUKTtBwdhfz2le1nH3CF6jnjsgxzGtmpf7Nhwa5gW6yqS', 'testniklas1@testniklas1.com', 0, 0, '::1'),
(26, 'testniklas2', 'testniklas2', 'testniklas2', '$2y$10$b4yRUwTs1Cyj.vckfSCfee5pDAuPy7WAa.Ie2hvk4u7glzyJoyUsi', 'testniklas2@testniklas2.testniklas2', 0, 0, '::1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
