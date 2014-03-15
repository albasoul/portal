-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2014 at 08:47 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `drejtimet`
--

CREATE TABLE IF NOT EXISTS `drejtimet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emri` varchar(250) NOT NULL,
  `alias` varchar(10) NOT NULL,
  `f_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `drejtimet`
--

INSERT INTO `drejtimet` (`id`, `emri`, `alias`, `f_id`) VALUES
(1, 'Dizajnim i Softuerit', 'DS', 1),
(2, 'Teknologjia e Informacionit dhe e Telekomunikimit', 'TIT', 1);

-- --------------------------------------------------------

--
-- Table structure for table `fakulteti`
--

CREATE TABLE IF NOT EXISTS `fakulteti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emri` varchar(250) NOT NULL,
  `alias` varchar(10) NOT NULL,
  `dekani` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `fakulteti`
--

INSERT INTO `fakulteti` (`id`, `emri`, `alias`, `dekani`) VALUES
(1, 'Fakulteti i shkencave kompjuterike', 'FSHK', 1),
(2, 'Fakulteti i edukimit', 'EDU', 2);

-- --------------------------------------------------------

--
-- Table structure for table `footer`
--

CREATE TABLE IF NOT EXISTS `footer` (
  `1` int(11) NOT NULL AUTO_INCREMENT,
  `emri` varchar(250) NOT NULL,
  `link` varchar(250) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  PRIMARY KEY (`1`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `footer`
--

INSERT INTO `footer` (`1`, `emri`, `link`, `enabled`) VALUES
(1, 'Administrata', 'administrata.php', 1),
(2, 'Kontakti', 'kontakti.php', 1),
(3, 'Ndihm&euml;', 'help.php', 1),
(4, 'dil', 'loggout.php', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lajmet`
--

CREATE TABLE IF NOT EXISTS `lajmet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulli` varchar(256) NOT NULL,
  `pershkrimi` varchar(256) NOT NULL,
  `body` text NOT NULL,
  `data` date NOT NULL,
  `foto` varchar(256) NOT NULL,
  `link` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `lajmet`
--

INSERT INTO `lajmet` (`id`, `titulli`, `pershkrimi`, `body`, `data`, `foto`, `link`) VALUES
(1, 'Lajmi 1', 'Pershkrimi i lajmit ne lidhje me qka ka me ndodh ? WTF', 'Ky eshte komplet lajmi i zgjeruar dhe i pazgjeruar ne forma te ndryshme te artikulara vetem shkruj o blendi shkruj mos ta nin111111111111111111111......................... ', '2014-03-01', 'img/fakultet/lajme/default.png', ''),
(2, 'Lajmi 2', 'Pershkrimi i lajmit ne lidhje me qka ka me ndodh ? WTF', 'Ky eshte komplet lajmi i zgjeruar dhe i pazgjeruar ne forma te ndryshme te artikulara vetem shkruj o blendi shkruj mos ta nin111111111111111111111......................... ', '2014-03-02', 'img/fakultet/lajme/default.png', ''),
(3, 'Lajmi 3', 'Pershkrimi i lajmit ne lidhje me qka ka me ndodh ? WTF', 'Ky eshte komplet lajmi i zgjeruar dhe i pazgjeruar ne forma te ndryshme te artikulara vetem shkruj o blendi shkruj mos ta nin111111111111111111111......................... ', '2014-03-03', 'img/fakultet/lajme/default.png', ''),
(4, 'Lajmi 4', 'Pershkrimi i lajmit ne lidhje me qka ka me ndodh ? WTF', 'Ky eshte komplet lajmi i zgjeruar dhe i pazgjeruar ne forma te ndryshme te artikulara vetem shkruj o blendi shkruj mos ta nin111111111111111111111......................... ', '2014-03-04', 'img/fakultet/lajme/default.png', ''),
(5, 'Lajmi 5', 'Pershkrimi i lajmit ne lidhje me qka ka me ndodh ? WTF', 'Ky eshte komplet lajmi i zgjeruar dhe i pazgjeruar ne forma te ndryshme te artikulara vetem shkruj o blendi shkruj mos ta nin111111111111111111111......................... ', '2014-03-05', 'img/fakultet/lajme/default.png', '');

-- --------------------------------------------------------

--
-- Table structure for table `lendet`
--

CREATE TABLE IF NOT EXISTS `lendet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emri` varchar(256) NOT NULL,
  `drejtimi` int(11) NOT NULL,
  `semestri` int(2) NOT NULL,
  `kredi` int(2) NOT NULL,
  `p_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `lendet`
--

INSERT INTO `lendet` (`id`, `emri`, `drejtimi`, `semestri`, `kredi`, `p_id`) VALUES
(1, 'Programimi i aplikacioneve per server', 1, 4, 6, 1),
(2, 'Verifikimi dhe miratimi softuerik', 1, 4, 3, 2),
(3, 'Menaxhimi i kualiteti n&euml; TI', 1, 4, 3, 2),
(4, 'Dizajnim i softuerit', 1, 3, 6, 3),
(5, 'Bazat e te dhenave', 1, 2, 6, 4);

-- --------------------------------------------------------

--
-- Table structure for table `ligjeratat`
--

CREATE TABLE IF NOT EXISTS `ligjeratat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emri` varchar(256) NOT NULL,
  `alias` varchar(20) NOT NULL,
  `link` text NOT NULL,
  `id_l` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ligjeratat`
--

INSERT INTO `ligjeratat` (`id`, `emri`, `alias`, `link`, `id_l`) VALUES
(1, 'Hyrje ne Aplikim', 'L1', 'http://research.google.com/archive/bigtable-osdi06.pdf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `navbar`
--

CREATE TABLE IF NOT EXISTS `navbar` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `emri` varchar(250) NOT NULL,
  `link` varchar(250) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `navbar`
--

INSERT INTO `navbar` (`ID`, `emri`, `link`, `enabled`) VALUES
(1, 'Lendet', 'index.php?faqja=lendet', 1),
(2, 'Gazeta', 'gazeta.php', 1),
(3, 'Lajmet', 'lajmet.php', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notat`
--

CREATE TABLE IF NOT EXISTS `notat` (
  `sid` int(11) NOT NULL,
  `lid` int(11) NOT NULL,
  `nota` int(2) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notat`
--

INSERT INTO `notat` (`sid`, `lid`, `nota`, `data`) VALUES
(1240023, 1, 6, '2014-03-14'),
(1240023, 2, 9, '2014-03-12');

-- --------------------------------------------------------

--
-- Table structure for table `page_info`
--

CREATE TABLE IF NOT EXISTS `page_info` (
  `title` varchar(256) NOT NULL,
  `footer` varchar(256) NOT NULL,
  `activated` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page_info`
--

INSERT INTO `page_info` (`title`, `footer`, `activated`) VALUES
('Portal 1.0', 'Copyright &copy; 2014', 1);

-- --------------------------------------------------------

--
-- Table structure for table `profesoret`
--

CREATE TABLE IF NOT EXISTS `profesoret` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emri` varchar(30) NOT NULL,
  `mbiemri` varchar(30) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` text NOT NULL,
  `lokacioni` varchar(250) NOT NULL,
  `foto` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `profesoret`
--

INSERT INTO `profesoret` (`id`, `emri`, `mbiemri`, `email`, `password`, `lokacioni`, `foto`) VALUES
(1, 'Ilir', 'Byty&ccedili', 'ilir.bytyci@gmail.com', 'blendi', 'Prizren', 'img/fakultet/profesore/profil/default.png'),
(2, 'Shaban', 'Buza', 'shbuza@gmail.com', 'blendi', 'Prishtin&euml;', 'img/fakultet/profesore/profil/default.png'),
(3, 'Mentor', 'Shala', 'mentor.shala@gmail.com', 'blendi', 'Prizren', 'img/fakultet/profesore/profil/default.png'),
(4, 'Ermir', 'Rogova', 'erogova@hotmail.com', 'blendi', 'Prizren', 'img/fakultet/profesore/profil/default.png');

-- --------------------------------------------------------

--
-- Table structure for table `studentet`
--

CREATE TABLE IF NOT EXISTS `studentet` (
  `ID` int(11) NOT NULL,
  `SID` int(11) NOT NULL,
  `emri` varchar(25) NOT NULL,
  `mbiemri` varchar(25) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` text NOT NULL,
  `drejtimi` int(11) NOT NULL,
  `semestri` int(2) NOT NULL,
  `kredi` int(3) NOT NULL,
  `lokacioni` varchar(50) NOT NULL,
  `foto` varchar(256) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentet`
--

INSERT INTO `studentet` (`ID`, `SID`, `emri`, `mbiemri`, `email`, `password`, `drejtimi`, `semestri`, `kredi`, `lokacioni`, `foto`) VALUES
(1, 1240023, 'Blendi', 'Gashi', 'blendi.gashi@gmail.com', 'blendi', 1, 4, 99, 'Prizren', 'img/studente/profil/default.png');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
