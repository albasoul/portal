-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2014 at 11:39 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `drejtimet`
--

INSERT INTO `drejtimet` (`id`, `emri`, `alias`, `f_id`) VALUES
(1, 'Dizajnim i Softuerit', 'DS', 1),
(2, 'Teknologjia e Informacionit dhe e Telekomunikimit', 'TIT', 1),
(3, 'Gjuhe gjermane', 'GER', 2),
(4, 'Administrim Biznesi', 'AB', 4),
(5, 'Juridik', 'JUR', 3),
(6, 'Menaxhment nd&euml;rkomb&euml;tar', 'MND', 4),
(7, 'Gjuh&euml; angleze', 'ANG', 2),
(8, 'Parashkollor', 'PRSH', 2),
(9, 'Fillor', 'FLLR', 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `fakulteti`
--

INSERT INTO `fakulteti` (`id`, `emri`, `alias`, `dekani`) VALUES
(1, 'Fakulteti i shkencave kompjuterike', 'FSHK', 2),
(2, 'Fakulteti i edukimit', 'EDU', 1),
(3, 'Fakulteti juridik', 'JUR', 0),
(4, 'Fakulteti ekonomik', 'EKO', 0);

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
  `body` text NOT NULL,
  `data` datetime NOT NULL,
  `foto` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `lajmet`
--

INSERT INTO `lajmet` (`id`, `titulli`, `body`, `data`, `foto`) VALUES
(22, 'UPZ aksion p&euml;r pastrimin e qytetitUPZ aksion p&euml;r pastrimin e qytetit', '&lt;p style=&quot;\\&quot;color:&quot; rgb(0,=&quot;&quot; 0,=&quot;&quot; 0);=&quot;&quot; list-style-type:=&quot;&quot; none;=&quot;&quot; font-family:=&quot;&quot; arial;=&quot;&quot; margin-bottom:=&quot;&quot; 0px;=&quot;&quot; padding:=&quot;&quot; 0px=&quot;&quot; 10px;=&quot;&quot; border:=&quot;&quot; outline:=&quot;&quot; vertical-align:=&quot;&quot; baseline;=&quot;&quot; background-color:=&quot;&quot; transparent;\\&quot;=&quot;&quot;&gt;Parlamenti Studentor dhe k&euml;shillat studentore t&euml; Universitetit Publik &ldquo;Ukshin Hoti&rdquo; n&euml; Prizren, me mb&euml;shtetje edhe t&euml; menaxhmentit t&euml; universitetit kan&euml; organizuar nj&euml; aktivitet t&euml; pastrimit t&euml; qytetit, n&euml; dit&euml;n e pranver&euml;s.&nbsp;&lt;/p&gt;&lt;p style=&quot;\\&quot;color:&quot; rgb(0,=&quot;&quot; 0,=&quot;&quot; 0);=&quot;&quot; list-style-type:=&quot;&quot; none;=&quot;&quot; font-family:=&quot;&quot; arial;=&quot;&quot; margin-bottom:=&quot;&quot; 0px;=&quot;&quot; padding:=&quot;&quot; 0px=&quot;&quot; 10px;=&quot;&quot; border:=&quot;&quot; outline:=&quot;&quot; vertical-align:=&quot;&quot; baseline;=&quot;&quot; background-color:=&quot;&quot; transparent;\\&quot;=&quot;&quot;&gt;Ky aktivitet ka p&euml;r q&euml;llim vet&euml;dijesimin e t&euml; gjith&euml; qytetar&euml;ve, q&euml; t&euml; p&euml;rkujdesen m&euml; shum&euml; p&euml;r ambientin ku jetojn&euml;.&lt;/p&gt;&lt;p style=&quot;\\&quot;color:&quot; rgb(0,=&quot;&quot; 0,=&quot;&quot; 0);=&quot;&quot; list-style-type:=&quot;&quot; none;=&quot;&quot; font-family:=&quot;&quot; arial;=&quot;&quot; margin-bottom:=&quot;&quot; 0px;=&quot;&quot; padding:=&quot;&quot; 0px=&quot;&quot; 10px;=&quot;&quot; border:=&quot;&quot; outline:=&quot;&quot; vertical-align:=&quot;&quot; baseline;=&quot;&quot; background-color:=&quot;&quot; transparent;\\&quot;=&quot;&quot;&gt;K&euml;t&euml; aktivitet e kan&euml; mb&euml;shtetur dhe u jan&euml; bashkangjitur edhe menaxhmenti, u.d. Rektori Prof. Dr. Zehadin Shemsidini, Sekretari i P&euml;rgjithsh&euml;m i Universitetit z. Adem Sallauka, profesor&euml; dhe zyrtar&euml; t&euml; tjer&euml; t&euml; universitetit.&nbsp;&lt;/p&gt;', '2014-03-28 06:03:19', 'img/fakultet/lajme/lajmi-72853.jpg'),
(23, 'Lejohet afati shtes&euml; i v&euml;rtetimit', '&lt;p style=&quot;\\&quot;color:&quot; rgb(0,=&quot;&quot; 0,=&quot;&quot; 0);=&quot;&quot; list-style-type:=&quot;&quot; none;=&quot;&quot; font-family:=&quot;&quot; arial;=&quot;&quot; margin-bottom:=&quot;&quot; 0px;=&quot;&quot; padding:=&quot;&quot; 0px=&quot;&quot; 10px;=&quot;&quot; border:=&quot;&quot; outline:=&quot;&quot; vertical-align:=&quot;&quot; baseline;=&quot;&quot; background-color:=&quot;&quot; transparent;\\&quot;=&quot;&quot;&gt;Senati i Universitetit t&euml; Prizrenit n&euml; mbledhjen e mbajtur m&euml; dat&euml; 26.03.2014 merr k&euml;t&euml;:&lt;/p&gt;&lt;p style=&quot;\\&quot;color:&quot; rgb(0,=&quot;&quot; 0,=&quot;&quot; 0);=&quot;&quot; list-style-type:=&quot;&quot; none;=&quot;&quot; font-family:=&quot;&quot; arial;=&quot;&quot; margin-bottom:=&quot;&quot; 0px;=&quot;&quot; padding:=&quot;&quot; 0px=&quot;&quot; 10px;=&quot;&quot; border:=&quot;&quot; outline:=&quot;&quot; vertical-align:=&quot;&quot; baseline;=&quot;&quot; background-color:=&quot;&quot; transparent;\\&quot;=&quot;&quot;&gt;V E N D I M&lt;/p&gt;&lt;p style=&quot;\\&quot;color:&quot; rgb(0,=&quot;&quot; 0,=&quot;&quot; 0);=&quot;&quot; list-style-type:=&quot;&quot; none;=&quot;&quot; font-family:=&quot;&quot; arial;=&quot;&quot; margin-bottom:=&quot;&quot; 0px;=&quot;&quot; padding:=&quot;&quot; 0px=&quot;&quot; 10px;=&quot;&quot; border:=&quot;&quot; outline:=&quot;&quot; vertical-align:=&quot;&quot; baseline;=&quot;&quot; background-color:=&quot;&quot; transparent;\\&quot;=&quot;&quot;&gt;1. Lejohet afati shtes&euml; i v&euml;rtetimit t&euml; semestrit dhe regjistrimit t&euml; semestrit t&euml; ri nga ana e student&euml;ve t&euml; cil&euml;t nuk e kan&euml; b&euml;r&euml; me koh&euml; nj&euml; gj&euml; t&euml; till&euml;.&lt;/p&gt;&lt;p style=&quot;\\&quot;color:&quot; rgb(0,=&quot;&quot; 0,=&quot;&quot; 0);=&quot;&quot; list-style-type:=&quot;&quot; none;=&quot;&quot; font-family:=&quot;&quot; arial;=&quot;&quot; margin-bottom:=&quot;&quot; 0px;=&quot;&quot; padding:=&quot;&quot; 0px=&quot;&quot; 10px;=&quot;&quot; border:=&quot;&quot; outline:=&quot;&quot; vertical-align:=&quot;&quot; baseline;=&quot;&quot; background-color:=&quot;&quot; transparent;\\&quot;=&quot;&quot;&gt;2. V&euml;rtetimi dhe regjistrimi i semestrit t&euml; ri, do t&euml; zgjas&euml; vet&euml;m dy (2) dit&euml;, me 27 dhe 28.03.2014&lt;/p&gt;&lt;div class=&quot;\\&quot;text_exposed_show\\&quot;&quot; style=&quot;\\&quot;color:&quot; rgb(0,=&quot;&quot; 0,=&quot;&quot; 0);=&quot;&quot; font-size:=&quot;&quot; 12px;=&quot;&quot; list-style-type:=&quot;&quot; none;=&quot;&quot; font-family:=&quot;&quot; \\''trebuchet=&quot;&quot; ms\\'',=&quot;&quot; sans-serif;=&quot;&quot; margin:=&quot;&quot; 0px;=&quot;&quot; padding:=&quot;&quot; border:=&quot;&quot; outline:=&quot;&quot; vertical-align:=&quot;&quot; baseline;=&quot;&quot; background-color:=&quot;&quot; transparent;=&quot;&quot; line-height:=&quot;&quot; normal;\\&quot;=&quot;&quot;&gt;&lt;p style=&quot;\\&quot;font-size:&quot; 14px;=&quot;&quot; list-style-type:=&quot;&quot; none;=&quot;&quot; font-family:=&quot;&quot; arial;=&quot;&quot; margin-bottom:=&quot;&quot; 0px;=&quot;&quot; padding:=&quot;&quot; 0px=&quot;&quot; 10px;=&quot;&quot; border:=&quot;&quot; outline:=&quot;&quot; vertical-align:=&quot;&quot; baseline;=&quot;&quot; background-color:=&quot;&quot; transparent;=&quot;&quot; line-height:=&quot;&quot; 20px;\\&quot;=&quot;&quot;&gt;3. Pas kalimit t&euml; k&euml;saj periudhe kohore (27 dhe 28.03.2014), student&euml;t nuk do t&euml; ken&euml; mund&euml;si q&euml; ta regjistrojn&euml; semestrin.&lt;/p&gt;&lt;p style=&quot;\\&quot;font-size:&quot; 14px;=&quot;&quot; list-style-type:=&quot;&quot; none;=&quot;&quot; font-family:=&quot;&quot; arial;=&quot;&quot; margin-bottom:=&quot;&quot; 0px;=&quot;&quot; padding:=&quot;&quot; 0px=&quot;&quot; 10px;=&quot;&quot; border:=&quot;&quot; outline:=&quot;&quot; vertical-align:=&quot;&quot; baseline;=&quot;&quot; background-color:=&quot;&quot; transparent;=&quot;&quot; line-height:=&quot;&quot; 20px;\\&quot;=&quot;&quot;&gt;4. Ky vendim hyn&euml; n&euml; fuqi dit&euml;n e n&euml;nshkrimit t&euml; tij.&lt;/p&gt;&lt;p style=&quot;\\&quot;font-size:&quot; 14px;=&quot;&quot; list-style-type:=&quot;&quot; none;=&quot;&quot; font-family:=&quot;&quot; arial;=&quot;&quot; margin-bottom:=&quot;&quot; 0px;=&quot;&quot; padding:=&quot;&quot; 0px=&quot;&quot; 10px;=&quot;&quot; border:=&quot;&quot; outline:=&quot;&quot; vertical-align:=&quot;&quot; baseline;=&quot;&quot; background-color:=&quot;&quot; transparent;=&quot;&quot; line-height:=&quot;&quot; 20px;\\&quot;=&quot;&quot;&gt;&nbsp;&lt;/p&gt;&lt;p style=&quot;\\&quot;font-size:&quot; 14px;=&quot;&quot; list-style-type:=&quot;&quot; none;=&quot;&quot; font-family:=&quot;&quot; arial;=&quot;&quot; margin-bottom:=&quot;&quot; 0px;=&quot;&quot; padding:=&quot;&quot; 0px=&quot;&quot; 10px;=&quot;&quot; border:=&quot;&quot; outline:=&quot;&quot; vertical-align:=&quot;&quot; baseline;=&quot;&quot; background-color:=&quot;&quot; transparent;=&quot;&quot; line-height:=&quot;&quot; 20px;\\&quot;=&quot;&quot;&gt;Kryetari i Senatit t&euml; UPZ-s&euml;&lt;br style=&quot;\\&quot;font-size:&quot; 12px;=&quot;&quot; list-style-type:=&quot;&quot; none;=&quot;&quot; font-family:=&quot;&quot; \\''trebuchet=&quot;&quot; ms\\'',=&quot;&quot; sans-serif;=&quot;&quot; margin:=&quot;&quot; 0px;=&quot;&quot; padding:=&quot;&quot; border:=&quot;&quot; outline:=&quot;&quot; vertical-align:=&quot;&quot; baseline;=&quot;&quot; background-color:=&quot;&quot; transparent;\\&quot;=&quot;&quot;&gt;____________________&lt;br style=&quot;\\&quot;font-size:&quot; 12px;=&quot;&quot; list-style-type:=&quot;&quot; none;=&quot;&quot; font-family:=&quot;&quot; \\''trebuchet=&quot;&quot; ms\\'',=&quot;&quot; sans-serif;=&quot;&quot; margin:=&quot;&quot; 0px;=&quot;&quot; padding:=&quot;&quot; border:=&quot;&quot; outline:=&quot;&quot; vertical-align:=&quot;&quot; baseline;=&quot;&quot; background-color:=&quot;&quot; transparent;\\&quot;=&quot;&quot;&gt;Prof. Dr. Zahadin Shemsidini&lt;/p&gt;&lt;/div&gt;', '2014-03-28 06:03:20', ''),
(24, 'Lejohet afati i PrillitLejohet afati i PrillitLejohet afati i Prillit', '&lt;p&gt;&lt;span style=&quot;\\&quot; color:&quot;=&quot;&quot; rgb(0,=&quot;&quot; 0,=&quot;&quot; 0);=&quot;&quot; font-size:=&quot;&quot; 12px;=&quot;&quot; list-style-type:=&quot;&quot; none;=&quot;&quot; font-family:=&quot;&quot; \\''trebuchet=&quot;&quot; ms\\'',=&quot;&quot; sans-serif;=&quot;&quot; margin:=&quot;&quot; 0px;=&quot;&quot; padding:=&quot;&quot; border:=&quot;&quot; outline:=&quot;&quot; vertical-align:=&quot;&quot; baseline;=&quot;&quot; background-color:=&quot;&quot; transparent;\\&quot;=&quot;&quot;&gt;Senati i Universitetit t&euml; Prizrenit n&euml; mbledhjen e mbajtur m&euml; dat&euml; 26.03.2014 merr k&euml;t&euml;:&nbsp;&lt;/span&gt;&lt;br style=&quot;\\&quot; color:&quot;=&quot;&quot; rgb(0,=&quot;&quot; 0,=&quot;&quot; 0);=&quot;&quot; font-size:=&quot;&quot; 12px;=&quot;&quot; list-style-type:=&quot;&quot; none;=&quot;&quot; font-family:=&quot;&quot; \\''trebuchet=&quot;&quot; ms\\'',=&quot;&quot; sans-serif;=&quot;&quot; margin:=&quot;&quot; 0px;=&quot;&quot; padding:=&quot;&quot; border:=&quot;&quot; outline:=&quot;&quot; vertical-align:=&quot;&quot; baseline;=&quot;&quot; background-color:=&quot;&quot; transparent;\\&quot;=&quot;&quot;&gt;&lt;br style=&quot;\\&quot; color:&quot;=&quot;&quot; rgb(0,=&quot;&quot; 0,=&quot;&quot; 0);=&quot;&quot; font-size:=&quot;&quot; 12px;=&quot;&quot; list-style-type:=&quot;&quot; none;=&quot;&quot; font-family:=&quot;&quot; \\''trebuchet=&quot;&quot; ms\\'',=&quot;&quot; sans-serif;=&quot;&quot; margin:=&quot;&quot; 0px;=&quot;&quot; padding:=&quot;&quot; border:=&quot;&quot; outline:=&quot;&quot; vertical-align:=&quot;&quot; baseline;=&quot;&quot; background-color:=&quot;&quot; transparent;\\&quot;=&quot;&quot;&gt;&lt;span style=&quot;\\&quot; color:&quot;=&quot;&quot; rgb(0,=&quot;&quot; 0,=&quot;&quot; 0);=&quot;&quot; font-size:=&quot;&quot; 12px;=&quot;&quot; list-style-type:=&quot;&quot; none;=&quot;&quot; font-family:=&quot;&quot; \\''trebuchet=&quot;&quot; ms\\'',=&quot;&quot; sans-serif;=&quot;&quot; margin:=&quot;&quot; 0px;=&quot;&quot; padding:=&quot;&quot; border:=&quot;&quot; outline:=&quot;&quot; vertical-align:=&quot;&quot; baseline;=&quot;&quot; background-color:=&quot;&quot; transparent;\\&quot;=&quot;&quot;&gt;V E N D I M&nbsp;&lt;/span&gt;&lt;br style=&quot;\\&quot; color:&quot;=&quot;&quot; rgb(0,=&quot;&quot; 0,=&quot;&quot; 0);=&quot;&quot; font-size:=&quot;&quot; 12px;=&quot;&quot; list-style-type:=&quot;&quot; none;=&quot;&quot; font-family:=&quot;&quot; \\''trebuchet=&quot;&quot; ms\\'',=&quot;&quot; sans-serif;=&quot;&quot; margin:=&quot;&quot; 0px;=&quot;&quot; padding:=&quot;&quot; border:=&quot;&quot; outline:=&quot;&quot; vertical-align:=&quot;&quot; baseline;=&quot;&quot; background-color:=&quot;&quot; transparent;\\&quot;=&quot;&quot;&gt;&lt;br style=&quot;\\&quot; color:&quot;=&quot;&quot; rgb(0,=&quot;&quot; 0,=&quot;&quot; 0);=&quot;&quot; font-size:=&quot;&quot; 12px;=&quot;&quot; list-style-type:=&quot;&quot; none;=&quot;&quot; font-family:=&quot;&quot; \\''trebuchet=&quot;&quot; ms\\'',=&quot;&quot; sans-serif;=&quot;&quot; margin:=&quot;&quot; 0px;=&quot;&quot; padding:=&quot;&quot; border:=&quot;&quot; outline:=&quot;&quot; vertical-align:=&quot;&quot; baseline;=&quot;&quot; background-color:=&quot;&quot; transparent;\\&quot;=&quot;&quot;&gt;&lt;span style=&quot;\\&quot; color:&quot;=&quot;&quot; rgb(0,=&quot;&quot; 0,=&quot;&quot; 0);=&quot;&quot; font-size:=&quot;&quot; 12px;=&quot;&quot; list-style-type:=&quot;&quot; none;=&quot;&quot; font-family:=&quot;&quot; \\''trebuchet=&quot;&quot; ms\\'',=&quot;&quot; sans-serif;=&quot;&quot; margin:=&quot;&quot; 0px;=&quot;&quot; padding:=&quot;&quot; border:=&quot;&quot; outline:=&quot;&quot; vertical-align:=&quot;&quot; baseline;=&quot;&quot; background-color:=&quot;&quot; transparent;\\&quot;=&quot;&quot;&gt;1. Lejohet afati shtes&euml; i Prillit, p&euml;r paraqitjen e provimeve nga ana e student&euml;ve t&euml; Universitetit t&euml; Prizrenit.&lt;/span&gt;&lt;br style=&quot;\\&quot; color:&quot;=&quot;&quot; rgb(0,=&quot;&quot; 0,=&quot;&quot; 0);=&quot;&quot; font-size:=&quot;&quot; 12px;=&quot;&quot; list-style-type:=&quot;&quot; none;=&quot;&quot; font-family:=&quot;&quot; \\''trebuchet=&quot;&quot; ms\\'',=&quot;&quot; sans-serif;=&quot;&quot; margin:=&quot;&quot; 0px;=&quot;&quot; padding:=&quot;&quot; border:=&quot;&quot; outline:=&quot;&quot; vertical-align:=&quot;&quot; baseline;=&quot;&quot; background-color:=&quot;&quot; transparent;\\&quot;=&quot;&quot;&gt;&lt;br style=&quot;\\&quot; color:&quot;=&quot;&quot; rgb(0,=&quot;&quot; 0,=&quot;&quot; 0);=&quot;&quot; font-size:=&quot;&quot; 12px;=&quot;&quot; list-style-type:=&quot;&quot; none;=&quot;&quot; font-family:=&quot;&quot; \\''trebuchet=&quot;&quot; ms\\'',=&quot;&quot; sans-serif;=&quot;&quot; margin:=&quot;&quot; 0px;=&quot;&quot; padding:=&quot;&quot; border:=&quot;&quot; outline:=&quot;&quot; vertical-align:=&quot;&quot; baseline;=&quot;&quot; background-color:=&quot;&quot; transparent;\\&quot;=&quot;&quot;&gt;&lt;span style=&quot;\\&quot; color:&quot;=&quot;&quot; rgb(0,=&quot;&quot; 0,=&quot;&quot; 0);=&quot;&quot; font-size:=&quot;&quot; 12px;=&quot;&quot; list-style-type:=&quot;&quot; none;=&quot;&quot; font-family:=&quot;&quot; \\''trebuchet=&quot;&quot; ms\\'',=&quot;&quot; sans-serif;=&quot;&quot; margin:=&quot;&quot; 0px;=&quot;&quot; padding:=&quot;&quot; border:=&quot;&quot; outline:=&quot;&quot; vertical-align:=&quot;&quot; baseline;=&quot;&quot; background-color:=&quot;&quot; transparent;\\&quot;=&quot;&quot;&gt;2. N&euml; k&euml;t&euml; afat, student&euml;t kan&euml; t&euml; drejt&euml; t&euml; paraqesin m&euml; s&euml; shumti nga dy provime.&lt;/span&gt;&lt;br style=&quot;\\&quot; color:&quot;=&quot;&quot; rgb(0,=&quot;&quot; 0,=&quot;&quot; 0);=&quot;&quot; font-size:=&quot;&quot; 12px;=&quot;&quot; list-style-type:=&quot;&quot; none;=&quot;&quot; font-family:=&quot;&quot; \\''trebuchet=&quot;&quot; ms\\'',=&quot;&quot; sans-serif;=&quot;&quot; margin:=&quot;&quot; 0px;=&quot;&quot; padding:=&quot;&quot; border:=&quot;&quot; outline:=&quot;&quot; vertical-align:=&quot;&quot; baseline;=&quot;&quot; background-color:=&quot;&quot; transparent;\\&quot;=&quot;&quot;&gt;&lt;br style=&quot;\\&quot; color:&quot;=&quot;&quot; rgb(0,=&quot;&quot; 0,=&quot;&quot; 0);=&quot;&quot; font-size:=&quot;&quot; 12px;=&quot;&quot; list-style-type:=&quot;&quot; none;=&quot;&quot; font-family:=&quot;&quot; \\''trebuchet=&quot;&quot; ms\\'',=&quot;&quot; sans-serif;=&quot;&quot; margin:=&quot;&quot; 0px;=&quot;&quot; padding:=&quot;&quot; border:=&quot;&quot; outline:=&quot;&quot; vertical-align:=&quot;&quot; baseline;=&quot;&quot; background-color:=&quot;&quot; transparent;\\&quot;=&quot;&quot;&gt;&lt;span style=&quot;\\&quot; color:&quot;=&quot;&quot; rgb(0,=&quot;&quot; 0,=&quot;&quot; 0);=&quot;&quot; font-size:=&quot;&quot; 12px;=&quot;&quot; list-style-type:=&quot;&quot; none;=&quot;&quot; font-family:=&quot;&quot; \\''trebuchet=&quot;&quot; ms\\'',=&quot;&quot; sans-serif;=&quot;&quot; margin:=&quot;&quot; 0px;=&quot;&quot; padding:=&quot;&quot; border:=&quot;&quot; outline:=&quot;&quot; vertical-align:=&quot;&quot; baseline;=&quot;&quot; background-color:=&quot;&quot; transparent;\\&quot;=&quot;&quot;&gt;3. Paraqitja e provimeve nga ana e student&euml;ve do t&euml; b&euml;h&euml;t nga data&lt;span style=&quot;\\&quot; font-weight:&quot;=&quot;&quot; bold;\\&quot;=&quot;&quot;&gt; &lt;span style=&quot;font-weight: bold;&quot;&gt;27.03.2014&lt;/span&gt;&lt;/span&gt; e deri m&euml; d&lt;/span&gt;&lt;span class=&quot;\\&quot; text_exposed_show\\&quot;&quot;=&quot;&quot; style=&quot;\\&quot; color:&quot;=&quot;&quot; rgb(0,=&quot;&quot; 0,=&quot;&quot; 0);=&quot;&quot; font-size:=&quot;&quot; 12px;=&quot;&quot; list-style-type:=&quot;&quot; none;=&quot;&quot; font-family:=&quot;&quot; \\''trebuchet=&quot;&quot; ms\\'',=&quot;&quot; sans-serif;=&quot;&quot; margin:=&quot;&quot; 0px;=&quot;&quot; padding:=&quot;&quot; border:=&quot;&quot; outline:=&quot;&quot; vertical-align:=&quot;&quot; baseline;=&quot;&quot; background-color:=&quot;&quot; transparent;\\&quot;=&quot;&quot;&gt;at&euml; &lt;span style=&quot;\\&quot; font-weight:&quot;=&quot;&quot; bold;\\&quot;=&quot;&quot;&gt;01.04.2014&lt;/span&gt;&lt;br style=&quot;\\&quot; list-style-type:&quot;=&quot;&quot; none;=&quot;&quot; margin:=&quot;&quot; 0px;=&quot;&quot; padding:=&quot;&quot; border:=&quot;&quot; outline:=&quot;&quot; vertical-align:=&quot;&quot; baseline;=&quot;&quot; background-color:=&quot;&quot; transparent;\\&quot;=&quot;&quot;&gt;&lt;br style=&quot;\\&quot; list-style-type:&quot;=&quot;&quot; none;=&quot;&quot; margin:=&quot;&quot; 0px;=&quot;&quot; padding:=&quot;&quot; border:=&quot;&quot; outline:=&quot;&quot; vertical-align:=&quot;&quot; baseline;=&quot;&quot; background-color:=&quot;&quot; transparent;\\&quot;=&quot;&quot;&gt;4. Provimet do t&euml; mbahen nga data&lt;span style=&quot;\\&quot; font-weight:&quot;=&quot;&quot; bold;\\&quot;=&quot;&quot;&gt; 15 e deri m&euml; 30.04.2014&nbsp;&lt;/span&gt;&lt;br style=&quot;\\&quot; list-style-type:&quot;=&quot;&quot; none;=&quot;&quot; margin:=&quot;&quot; 0px;=&quot;&quot; padding:=&quot;&quot; border:=&quot;&quot; outline:=&quot;&quot; vertical-align:=&quot;&quot; baseline;=&quot;&quot; background-color:=&quot;&quot; transparent;\\&quot;=&quot;&quot;&gt;&lt;br style=&quot;\\&quot; list-style-type:&quot;=&quot;&quot; none;=&quot;&quot; margin:=&quot;&quot; 0px;=&quot;&quot; padding:=&quot;&quot; border:=&quot;&quot; outline:=&quot;&quot; vertical-align:=&quot;&quot; baseline;=&quot;&quot; background-color:=&quot;&quot; transparent;\\&quot;=&quot;&quot;&gt;5. Ky vendim hyn&euml; n&euml; fuqi dit&euml;n e n&euml;nshkrimit t&euml; tij.&lt;br style=&quot;\\&quot; list-style-type:&quot;=&quot;&quot; none;=&quot;&quot; margin:=&quot;&quot; 0px;=&quot;&quot; padding:=&quot;&quot; border:=&quot;&quot; outline:=&quot;&quot; vertical-align:=&quot;&quot; baseline;=&quot;&quot; background-color:=&quot;&quot; transparent;\\&quot;=&quot;&quot;&gt;&lt;br style=&quot;\\&quot; list-style-type:&quot;=&quot;&quot; none;=&quot;&quot; margin:=&quot;&quot; 0px;=&quot;&quot; padding:=&quot;&quot; border:=&quot;&quot; outline:=&quot;&quot; vertical-align:=&quot;&quot; baseline;=&quot;&quot; background-color:=&quot;&quot; transparent;\\&quot;=&quot;&quot;&gt;Kryetari i Senatit t&euml; UPZ-s&euml;&lt;br style=&quot;\\&quot; list-style-type:&quot;=&quot;&quot; none;=&quot;&quot; margin:=&quot;&quot; 0px;=&quot;&quot; padding:=&quot;&quot; border:=&quot;&quot; outline:=&quot;&quot; vertical-align:=&quot;&quot; baseline;=&quot;&quot; background-color:=&quot;&quot; transparent;\\&quot;=&quot;&quot;&gt;____________________&lt;br style=&quot;\\&quot; list-style-type:&quot;=&quot;&quot; none;=&quot;&quot; margin:=&quot;&quot; 0px;=&quot;&quot; padding:=&quot;&quot; border:=&quot;&quot; outline:=&quot;&quot; vertical-align:=&quot;&quot; baseline;=&quot;&quot; background-color:=&quot;&quot; transparent;\\&quot;=&quot;&quot;&gt;Prof. Dr. Zahadin Shemsidini&lt;/span&gt;&lt;br&gt;&lt;/p&gt;', '2014-03-28 06:03:23', ''),
(25, 'N&euml; UPZ u mbajt Tribun&euml; p&euml;r Demonstratat Studentore t&euml; vitit 1981', '&lt;p style=&quot;\\&quot; color:&quot;=&quot;&quot; rgb(0,=&quot;&quot; 0,=&quot;&quot; 0);=&quot;&quot; font-size:=&quot;&quot; 14px;=&quot;&quot; list-style-type:=&quot;&quot; none;=&quot;&quot; font-family:=&quot;&quot; arial;=&quot;&quot; margin-bottom:=&quot;&quot; 0px;=&quot;&quot; padding:=&quot;&quot; 0px=&quot;&quot; 10px;=&quot;&quot; border:=&quot;&quot; outline:=&quot;&quot; vertical-align:=&quot;&quot; baseline;=&quot;&quot; background-color:=&quot;&quot; transparent;=&quot;&quot; line-height:=&quot;&quot; 20px;\\&quot;=&quot;&quot;&gt;Universitetin e Prizrenit &ldquo;Ukshin Hoti&rdquo;, n&euml;n organizimin e organizat&euml;s studentore USPE, t&euml; m&euml;rkur&euml;n &euml;sht&euml; mbajtur Tribun&euml; n&euml; kujtim t&euml; Demonstratave Studentore t&euml; 11-26 mars 1981. N&euml; k&euml;t&euml; tribun&euml; nj&euml; fjal&euml; rasti e mbajti edhe Prof. Dr. Zahadin Shemsidini, u. d. rektor i UPZ-s&euml;. Ai theksoi se k&euml;to demonstrata ishin vazhdim&euml;si e p&euml;rpjekjeve t&euml; popullit shqiptar p&euml;r liri e pavar&euml;si dhe se fal&euml; k&euml;tij kontributi e sakrifice u b&euml; i mundur &nbsp;fillimi i luft&euml;s s&euml; armatosur dhe &ccedil;lirimi i vendit dy dekada m&euml; pas. &ldquo;Ne u jemi mir&euml;njoh&euml;s t&euml; gjith&euml; atyre q&euml; u sakrifikuan p&euml;r lirin&euml; dhe pavar&euml;sin&euml; q&euml; ne e g&euml;zojm&euml; sot. Brezat e rinj, po ashtu dhe ju student&euml; t&euml; dashur nuk duhet ta harroni k&euml;t&euml; sakrific&euml;, por vazhdimisht ta p&euml;rkujtoni sepse &euml;sht&euml; frym&euml;zim p&euml;r pun&euml;n e m&euml;tutjeshme&rdquo;, theksoi Shemsidini. Ai shtoi se krahas shum&euml; t&euml; tjer&euml;ve, ishte edhe intelektuali e politologu i shquar profesor Ukshin Hoti, i cili doli n&euml; mb&euml;shtetje t&euml; hapur t&euml; k&euml;rkes&euml;s s&euml; student&euml;ve p&euml;r Republik&euml;, emrin e t&euml; cilit tani e mban&euml; me krenari Universiteti i Prizrenit.&nbsp;&lt;/p&gt;&lt;p style=&quot;\\&quot; color:&quot;=&quot;&quot; rgb(0,=&quot;&quot; 0,=&quot;&quot; 0);=&quot;&quot; font-size:=&quot;&quot; 14px;=&quot;&quot; list-style-type:=&quot;&quot; none;=&quot;&quot; font-family:=&quot;&quot; arial;=&quot;&quot; margin-bottom:=&quot;&quot; 0px;=&quot;&quot; padding:=&quot;&quot; 0px=&quot;&quot; 10px;=&quot;&quot; border:=&quot;&quot; outline:=&quot;&quot; vertical-align:=&quot;&quot; baseline;=&quot;&quot; background-color:=&quot;&quot; transparent;=&quot;&quot; line-height:=&quot;&quot; 20px;\\&quot;=&quot;&quot;&gt;&lt;img src=&quot;http://uni-prizren.com/repository/images/thumb_590x320/Foto_nr_3_42400.jpg&quot; style=&quot;width: 344px;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;\\&quot; color:&quot;=&quot;&quot; rgb(0,=&quot;&quot; 0,=&quot;&quot; 0);=&quot;&quot; font-size:=&quot;&quot; 14px;=&quot;&quot; list-style-type:=&quot;&quot; none;=&quot;&quot; font-family:=&quot;&quot; arial;=&quot;&quot; margin-bottom:=&quot;&quot; 0px;=&quot;&quot; padding:=&quot;&quot; 0px=&quot;&quot; 10px;=&quot;&quot; border:=&quot;&quot; outline:=&quot;&quot; vertical-align:=&quot;&quot; baseline;=&quot;&quot; background-color:=&quot;&quot; transparent;=&quot;&quot; line-height:=&quot;&quot; 20px;\\&quot;=&quot;&quot;&gt;Prof. Dr. Mejdi Elezi, historian, theksoi se historikisht shum&euml; shkenc&euml;tar kan&euml; pasur t&euml; drejt&euml;, q&euml; &euml;sht&euml; v&euml;rtetuar me rastin e Kosov&euml;s, se universiteti i v&euml;n&euml; themelet e shtetit. &nbsp;&ldquo;Kjo &euml;sht&euml; d&euml;shmi e gjall&euml; q&euml; ka ndodhur n&euml; Kosov&euml;&rdquo;, theksoi ai. Profesor Elelzi tha se n&euml; koh&euml;n e protestave t&euml; vitit 1981 ka qen&euml; profesor n&euml; Shkoll&euml;n e Lart&euml; Pedagogjike &ldquo;Bajram Curri&rdquo; n&euml; Gjakov&euml;. Ai kujtoi se si mediat RTP, Rilindja dhe t&euml; gjitha revistat u munduan t&rsquo;i japin karakter social, dhe jo politik k&euml;tyre k&euml;rkesave mir&euml;po m&euml; von&euml;, filluan t&euml; zhvishen dhe t&euml; dalin k&euml;rkesat reale t&euml; student&euml;ve. &ldquo;K&euml;rkes&euml; shum&euml; reale ishte q&euml; 2 milion shqiptar t&euml; Kosov&euml;s t&euml; ken&euml; republik&euml;n ashtu si edhe shtetet fqinje. Mir&euml;po, jo q&euml; nuk na dhan&euml; por qeveria jugosllave e eliminoi edhe Kushtetut&euml;n e vitit 1974, dhe kjo solli akoma urrejtje te populli shqiptar. K&euml;rkesat e demonstratave t&euml; vitit 1981 kan&euml; qen&euml; shum&euml; reale, por m&euml; von&euml; b&euml;n&euml; jo-reale, sepse erdhi deri te shthurja e Jugosllavis&euml;, dhe k&euml;rkesa doli p&euml;r krijimin e shtetit t&euml; pavarur t&euml; Kosov&euml;s e cila dha shum&euml; viktima por u kuror&euml;zua me sukses&rdquo;, theksoi Elezi.&nbsp;&lt;/p&gt;&lt;p style=&quot;\\&quot; color:&quot;=&quot;&quot; rgb(0,=&quot;&quot; 0,=&quot;&quot; 0);=&quot;&quot; font-size:=&quot;&quot; 14px;=&quot;&quot; list-style-type:=&quot;&quot; none;=&quot;&quot; font-family:=&quot;&quot; arial;=&quot;&quot; margin-bottom:=&quot;&quot; 0px;=&quot;&quot; padding:=&quot;&quot; 0px=&quot;&quot; 10px;=&quot;&quot; border:=&quot;&quot; outline:=&quot;&quot; vertical-align:=&quot;&quot; baseline;=&quot;&quot; background-color:=&quot;&quot; transparent;=&quot;&quot; line-height:=&quot;&quot; 20px;\\&quot;=&quot;&quot;&gt;&lt;img src=&quot;http://uni-prizren.com/repository/images/DSC_0151.JPG&quot; style=&quot;width: 344px;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;\\&quot; color:&quot;=&quot;&quot; rgb(0,=&quot;&quot; 0,=&quot;&quot; 0);=&quot;&quot; font-size:=&quot;&quot; 14px;=&quot;&quot; list-style-type:=&quot;&quot; none;=&quot;&quot; font-family:=&quot;&quot; arial;=&quot;&quot; margin-bottom:=&quot;&quot; 0px;=&quot;&quot; padding:=&quot;&quot; 0px=&quot;&quot; 10px;=&quot;&quot; border:=&quot;&quot; outline:=&quot;&quot; vertical-align:=&quot;&quot; baseline;=&quot;&quot; background-color:=&quot;&quot; transparent;=&quot;&quot; line-height:=&quot;&quot; 20px;\\&quot;=&quot;&quot;&gt;&lt;img src=&quot;http://uni-prizren.com/repository/images/DSC_0145.JPG&quot; style=&quot;width: 344px;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;\\&quot; color:&quot;=&quot;&quot; rgb(0,=&quot;&quot; 0,=&quot;&quot; 0);=&quot;&quot; font-size:=&quot;&quot; 14px;=&quot;&quot; list-style-type:=&quot;&quot; none;=&quot;&quot; font-family:=&quot;&quot; arial;=&quot;&quot; margin-bottom:=&quot;&quot; 0px;=&quot;&quot; padding:=&quot;&quot; 0px=&quot;&quot; 10px;=&quot;&quot; border:=&quot;&quot; outline:=&quot;&quot; vertical-align:=&quot;&quot; baseline;=&quot;&quot; background-color:=&quot;&quot; transparent;=&quot;&quot; line-height:=&quot;&quot; 20px;\\&quot;=&quot;&quot;&gt;&lt;/p&gt;', '2014-03-28 06:03:46', 'img/fakultet/lajme/lajmi-125827.jpg'),
(26, 'Senati i Universitetit t&euml; Prizrenit &quot;UKSHIN HOTI&quot; zgjedhi dekan&euml;t', '&lt;p class=&quot;\\&quot;MsoNormal\\&quot;&quot; style=&quot;\\&quot;color:&quot; rgb(0,=&quot;&quot; 0,=&quot;&quot; 0);=&quot;&quot; font-size:=&quot;&quot; 14px;=&quot;&quot; list-style-type:=&quot;&quot; none;=&quot;&quot; font-family:=&quot;&quot; arial;=&quot;&quot; margin-bottom:=&quot;&quot; 0px;=&quot;&quot; padding:=&quot;&quot; 0px=&quot;&quot; 10px;=&quot;&quot; border:=&quot;&quot; outline:=&quot;&quot; vertical-align:=&quot;&quot; baseline;=&quot;&quot; background-color:=&quot;&quot; transparent;=&quot;&quot; line-height:=&quot;&quot; 20px;\\&quot;=&quot;&quot;&gt;N&euml; mbledhjen e mbajtur t&euml; premten, m&euml; 14.03.2014, Senati i Universitetit t&euml; Prizrenit &ldquo;Ukshin Hoti&rdquo; ka zgjedhur dekan&euml;t e tre fakulteteve, t&euml; Ekonomikut, t&euml; Edukimit dhe t&euml; Shkencave Kompjuterike.&lt;/p&gt;&lt;p class=&quot;\\&quot;MsoNormal\\&quot;&quot; style=&quot;\\&quot;color:&quot; rgb(0,=&quot;&quot; 0,=&quot;&quot; 0);=&quot;&quot; font-size:=&quot;&quot; 14px;=&quot;&quot; list-style-type:=&quot;&quot; none;=&quot;&quot; font-family:=&quot;&quot; arial;=&quot;&quot; margin-bottom:=&quot;&quot; 0px;=&quot;&quot; padding:=&quot;&quot; 0px=&quot;&quot; 10px;=&quot;&quot; border:=&quot;&quot; outline:=&quot;&quot; vertical-align:=&quot;&quot; baseline;=&quot;&quot; background-color:=&quot;&quot; transparent;=&quot;&quot; line-height:=&quot;&quot; 20px;\\&quot;=&quot;&quot;&gt;Dekan i Fakultetit t&euml; Shkencave Kompjuterike u zgjedh Prof. Dr. Artan Dermaku, i Fakultetit Ekonomik &euml;sht&euml; zgjedhur, Prof. Dr. Bekim Berisha, nd&euml;rsa i Fakultetit t&euml; Edukimit, Prof. Dr. Ismet Temaj. &nbsp;Nd&euml;rsa edhe pas dy raundesh votimi, nuk arriti t&euml; zgjidhet dekani i Fakultetit Juridik, ngase rezultati ishte baras. Funksionin e dekanit n&euml; Fakultetin Juridik do t&euml; vazhdoj ta ushtroj kryesuesi i K&euml;shillit t&euml; Fakultetit, Prof. Dr. Enver Buqaj, derisa t&euml; zgjedhet dekani i k&euml;tij fakulteti. Votimi ka qen&euml; i fsheht&euml; dhe procesi &euml;sht&euml; zhvilluar normalisht.&lt;/p&gt;&lt;p class=&quot;\\&quot;MsoNormal\\&quot;&quot; style=&quot;\\&quot;color:&quot; rgb(0,=&quot;&quot; 0,=&quot;&quot; 0);=&quot;&quot; font-size:=&quot;&quot; 14px;=&quot;&quot; list-style-type:=&quot;&quot; none;=&quot;&quot; font-family:=&quot;&quot; arial;=&quot;&quot; margin-bottom:=&quot;&quot; 0px;=&quot;&quot; padding:=&quot;&quot; 0px=&quot;&quot; 10px;=&quot;&quot; border:=&quot;&quot; outline:=&quot;&quot; vertical-align:=&quot;&quot; baseline;=&quot;&quot; background-color:=&quot;&quot; transparent;=&quot;&quot; line-height:=&quot;&quot; 20px;\\&quot;=&quot;&quot;&gt;Rreth zgjedhjeve n&euml; Fakultetin Juridik do t&euml; vendos KQZ-ja e UPZ-s&euml; dhe do t&euml; ju njoftojm&euml; n&euml; nd&euml;rkoh&euml;.&lt;/p&gt;', '2014-03-28 06:03:31', 'img/fakultet/lajme/lajmi-84862.jpg'),
(27, 'Eminemi me Rihan&euml;n performojn&euml; n&euml; kampusin e Universitetit t&euml; Prizrenit', '&lt;p&gt;T&lt;span style=&quot;\\&quot;line-height:&quot; 1.625;\\&quot;=&quot;&quot;&gt;&euml; shtun&lt;/span&gt;&lt;span style=&quot;\\&quot;line-height:&quot; 1.625;\\&quot;=&quot;&quot;&gt;&euml;n n&lt;/span&gt;&lt;span style=&quot;\\&quot;line-height:&quot; 1.625;\\&quot;=&quot;&quot;&gt;&euml; kampusin e Universitetit t&lt;/span&gt;&lt;span style=&quot;\\&quot;line-height:&quot; 1.625;\\&quot;=&quot;&quot;&gt;&euml; Prizrenit do mbahet nj&lt;/span&gt;&lt;span style=&quot;\\&quot;line-height:&quot; 1.625;\\&quot;=&quot;&quot;&gt;&euml; mbr&lt;/span&gt;&lt;span style=&quot;\\&quot;line-height:&quot; 1.625;\\&quot;=&quot;&quot;&gt;&euml;mje festive, t&lt;/span&gt;&lt;span style=&quot;\\&quot;line-height:&quot; 1.625;\\&quot;=&quot;&quot;&gt;&euml; ftuar do jen&lt;/span&gt;&lt;span style=&quot;\\&quot;line-height:&quot; 1.625;\\&quot;=&quot;&quot;&gt;&euml; personalitete t&lt;/span&gt;&lt;span style=&quot;\\&quot;line-height:&quot; 1.625;\\&quot;=&quot;&quot;&gt;&euml; shumta.&lt;br&gt;&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;\\&quot;line-height:&quot; 1.625;\\&quot;=&quot;&quot;&gt;Do t&lt;/span&gt;&lt;span style=&quot;\\&quot;line-height:&quot; 1.625;\\&quot;=&quot;&quot;&gt;&euml; performojn&lt;/span&gt;&lt;span style=&quot;\\&quot;line-height:&quot; 1.625;\\&quot;=&quot;&quot;&gt;&euml; artist&lt;/span&gt;&lt;span style=&quot;\\&quot;line-height:&quot; 1.625;\\&quot;=&quot;&quot;&gt;&euml; t&lt;/span&gt;&lt;span style=&quot;\\&quot;line-height:&quot; 1.625;\\&quot;=&quot;&quot;&gt;&euml; shquar dhe t&lt;/span&gt;&lt;span style=&quot;\\&quot;line-height:&quot; 1.625;\\&quot;=&quot;&quot;&gt;&euml; njohur n&lt;/span&gt;&lt;span style=&quot;\\&quot;line-height:&quot; 1.625;\\&quot;=&quot;&quot;&gt;&euml; trevat shqiptare, Eminemi me Rihon&lt;/span&gt;&lt;span style=&quot;\\&quot;line-height:&quot; 1.625;\\&quot;=&quot;&quot;&gt;&euml;n.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;iframe src=&quot;//www.youtube.com/embed/uelHwf8o7_U&quot; width=&quot;640&quot; height=&quot;360&quot; frameborder=&quot;0&quot;&gt;&lt;/iframe&gt;&lt;br&gt;&lt;/p&gt;', '2014-03-30 09:03:57', 'img/fakultet/lajme/lajmi-105207.jpg');

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
  `lloji` varchar(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `lendet`
--

INSERT INTO `lendet` (`id`, `emri`, `drejtimi`, `semestri`, `kredi`, `p_id`, `lloji`) VALUES
(1, 'Programimi i aplikacioneve p&euml;r server', 1, 4, 6, 1, 'O'),
(2, 'Verifikimi dhe miratimi softuerik', 1, 4, 3, 2, 'Z'),
(3, 'Menaxhimi i kualiteti n&euml; TI', 1, 4, 3, 2, 'Z'),
(4, 'Dizajnimi i softuerit', 1, 3, 6, 3, 'O'),
(5, 'Bazat e t&euml; dh&euml;nave', 1, 2, 6, 4, 'O'),
(6, 'Grafika kompjuterike dhe procesimi i imazheve', 1, 4, 6, 5, 'O'),
(7, 'Matematik&euml; 2', 1, 4, 6, 6, 'O'),
(8, 'Matematik&euml;', 1, 1, 6, 6, 'O');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `ligjeratat`
--

INSERT INTO `ligjeratat` (`id`, `emri`, `alias`, `link`, `id_l`) VALUES
(1, 'Hyrje n&euml; Aplikim', 'L1', 'docs/ligjeratat/DS/Semestri4/L1.pdf', 1),
(2, 'Programimi i servereve', 'L2', 'docs/ligjeratat/DS/Semestri4/L2.pdf', 1),
(3, 'Serveret e programuar', 'L3', 'docs/ligjeratat/DS/Semestri4/L3.pdf', 1),
(4, 'Hyrje ne biznes', 'L1', 'docs/ligjeratat/DS/Semestri4/astrit hulaj.docx', 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `navbar`
--

INSERT INTO `navbar` (`ID`, `emri`, `link`, `enabled`) VALUES
(1, 'Lendet', 'index.php?faqja=lendet', 1),
(2, 'Gazeta', 'gazeta.php', 1),
(3, 'Lajmet', 'index.php?faqja=lajmet', 1),
(4, 'Voto', 'index.php?faqja=voto', 1);

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
  `activated` tinyint(1) NOT NULL,
  `logo` varchar(256) NOT NULL,
  `vleresimi` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page_info`
--

INSERT INTO `page_info` (`title`, `footer`, `activated`, `logo`, `vleresimi`) VALUES
('Universiteti i Prizrenit &quot;Ukshin Hoti&quot;', 'Copyright &copy; 2014', 1, 'img/fakultet/logo.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `perdoruesit`
--

CREATE TABLE IF NOT EXISTS `perdoruesit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(250) NOT NULL,
  `emri` varchar(30) NOT NULL,
  `mbiemri` varchar(30) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` text NOT NULL,
  `tel` varchar(20) NOT NULL,
  `qyteti` varchar(30) NOT NULL,
  `rruga` varchar(60) NOT NULL,
  `niveli` int(2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`,`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `perdoruesit`
--

INSERT INTO `perdoruesit` (`id`, `username`, `emri`, `mbiemri`, `email`, `password`, `tel`, `qyteti`, `rruga`, `niveli`) VALUES
(1, 'bgashi', 'Blendi', 'Gashi', 'blendi.gashi@gmail.com', 'blendos', '+37744625975', 'Prizren', 'Ulqini 4', 1),
(2, 'dmorina', 'Durim', 'Morina', 'duriimm@live.com', 'blendi2', '+123129401293', 'Prizren', 'Kosovo', 2);

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
  `lloji` enum('R','A','L','S') NOT NULL,
  `gjinia` varchar(1) NOT NULL,
  `lokacioni` varchar(250) NOT NULL,
  `tel` varchar(100) NOT NULL,
  `foto` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `profesoret`
--

INSERT INTO `profesoret` (`id`, `emri`, `mbiemri`, `email`, `password`, `lloji`, `gjinia`, `lokacioni`, `tel`, `foto`) VALUES
(1, 'Ilir', 'Byty&ccedil;i', 'ilir.bytyci@gmail.com', 'blendi', 'L', 'M', 'Prizren', '', 'img/fakultet/profesore/profil/default.png'),
(2, 'Shaban', 'Buza', 'shbuza@gmail.com', 'blendi', 'R', 'F', 'Prishtin&euml;', '', 'img/fakultet/profesore/profil/default.png'),
(3, 'Mentor', 'Shala', 'mentor.shala@gmail.com', 'blendi', 'L', 'M', 'Prizren', '', 'img/fakultet/profesore/profil/default.png'),
(4, 'Ermir', 'Rogova', 'erogova@hotmail.com', 'blendi', 'A', 'M', 'Prizren', '', 'img/fakultet/profesore/profil/default.png'),
(5, 'Xhevahir', 'Bajrami', 'xheva@live.com', 'blendi', 'A', 'M', 'Prizren', '', 'img/fakultet/profesore/profil/default.png'),
(6, 'Isak', 'Hoxha', 'isak@live.com', 'blendos', 'R', 'M', 'PrishtinÃ«', '+37745123123', ''),
(7, 'Artan', 'Dermaku', 'artan@live.com', 'prizren', 'S', 'F', 'Prizren', '044 123232', 'img/fakultet/profesore/profil/default.png');

-- --------------------------------------------------------

--
-- Table structure for table `pyetjet`
--

CREATE TABLE IF NOT EXISTS `pyetjet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pyetja` varchar(256) NOT NULL,
  `lloji` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `pyetjet`
--

INSERT INTO `pyetjet` (`id`, `pyetja`, `lloji`) VALUES
(1, 'M&euml;simi n&euml; k&euml;t&euml; l&euml;nd&euml; i ka arritur pritjet e mia.', 0),
(2, 'Objektivat e m&euml;simit p&euml;r secil&euml;n nj&euml;si m&euml;simore jan&euml; identifikuar dhe respektuar.', 0),
(3, 'P&euml;rmbajtja e l&euml;nd&euml;s ka qen&euml; e orgranizuar mir&euml; dhe ka qen&euml; e leht&euml; t&euml; p&euml;rcjell&euml;t.', 0),
(4, 'Materiali i shp&euml;rndar&euml; p&euml;r k&euml;t&euml; l&euml;nd&euml; ishte adekuat dhe i dobish&euml;m.', 0),
(5, 'Ligj&euml;ruesi ka pasur njohuri t&euml; mir&euml;.', 0),
(6, 'Cil&euml;sia e udh&euml;zimeve ka qen&euml; e mir&euml;.', 0),
(7, 'Prezantimet n&euml; klas&euml; kan&euml; qen&euml; interesante dhe praktike.', 0),
(8, 'N&euml; k&euml;t&euml; l&euml;nd&euml; kam m&euml;suar gj&euml;ra t&euml; reja dhe t&euml; dobishme.', 0),
(9, '&Euml;sht&euml; inkurajuar pjes&euml;marrja dhe bashk&euml;veprimi n&euml; klas&euml;.', 0),
(10, '&Euml;sht&euml; ofruar koh&euml; e mjaftueshme p&euml;r pyetjet e student&euml;ve.', 0),
(11, '&Ccedilka ju ka p&euml;lqyer m&euml; s&euml; shumti n&euml; k&euml;t&euml; program studimor?', 1),
(12, '&Ccedil;ka kishit ndryshuar n&euml; k&euml;t&euml; program studimor?', 1);

-- --------------------------------------------------------

--
-- Table structure for table `studentet`
--

CREATE TABLE IF NOT EXISTS `studentet` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `studentet`
--

INSERT INTO `studentet` (`ID`, `SID`, `emri`, `mbiemri`, `email`, `password`, `drejtimi`, `semestri`, `kredi`, `lokacioni`, `foto`) VALUES
(1, 1240023, 'Blendi', 'Gashi', 'blendi.gashi@gmail.com', 'blendos', 1, 4, 2, 'Prizren', 'img/studente/profil/default.png'),
(2, 1240050, 'Besfort', 'Bajrami', 'bess.-@live.com', 'blendi', 3, 3, 8, 'Pirane', 'img/studente/profil/default.png'),
(3, 1240025, 'Din', 'Laqaj', 'din@live.com', 'blendi', 4, 3, 18, 'Prizren', 'img/studente/profil/default.png'),
(4, 1240026, 'Durim', 'Morina', 'duriiim-@live.com', 'blendi', 1, 4, 39, 'Prizren', 'img/studente/profil/default.png'),
(5, 1240122, 'Blend', 'Popaj', 'blend@live.com', 'blendi', 1, 4, 42, 'Fortes&euml;', 'img/studente/profil/default.png'),
(6, 1240141, 'Ardit', 'Morina', 'ardit@live.com', 'blendi', 1, 4, 32, 'RogovÃ«', 'img/studente/profil/default.png');

-- --------------------------------------------------------

--
-- Table structure for table `vleresim_komente`
--

CREATE TABLE IF NOT EXISTS `vleresim_komente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pyetja` varchar(256) NOT NULL,
  `lenda` varchar(256) NOT NULL,
  `profesori` varchar(256) NOT NULL,
  `mendimi` text NOT NULL,
  `data` date NOT NULL,
  `semestri` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `vleresim_komente`
--

INSERT INTO `vleresim_komente` (`id`, `pyetja`, `lenda`, `profesori`, `mendimi`, `data`, `semestri`) VALUES
(4, '&Ccedil;ka ju ka p&euml;lqyer m&euml; s&euml; shumti n&euml; k&euml;t&euml; program studimor?', 'Programimi i aplikacioneve p&euml;r server', 'Ilir Byty&ccedili', 'test1', '2014-03-25', 4),
(5, '&Ccedil;ka ju ka p&euml;lqyer m&euml; s&euml; shumti n&euml; k&euml;t&euml; program studimor?', 'Verifikimi dhe miratimi softuerik', 'Shaban Buza', 'test2', '2014-03-25', 4),
(6, '&Ccedil;ka ju ka p&euml;lqyer m&euml; s&euml; shumti n&euml; k&euml;t&euml; program studimor?', 'Menaxhimi i kualiteti n&euml; TI', 'Shaban Buza', 'test3', '2014-03-25', 4),
(7, '&Ccedil;ka ju ka p&euml;lqyer m&euml; s&euml; shumti n&euml; k&euml;t&euml; program studimor?', 'Programimi i aplikacioneve p&euml;r server', 'Ilir Byty&ccedili', 'box1 komenti1', '2014-03-25', 4),
(8, '&Ccedil;ka kishit ndryshuar n&euml; k&euml;t&euml; program studimor?', 'Programimi i aplikacioneve p&euml;r server', 'Ilir Byty&ccedili', 'box2 komenti 1', '2014-03-25', 4),
(9, '&Ccedil;ka ju ka p&euml;lqyer m&euml; s&euml; shumti n&euml; k&euml;t&euml; program studimor?', 'Verifikimi dhe miratimi softuerik', 'Shaban Buza', 'box 1 komenti 2', '2014-03-25', 4),
(10, '&Ccedil;ka kishit ndryshuar n&euml; k&euml;t&euml; program studimor?', 'Verifikimi dhe miratimi softuerik', 'Shaban Buza', 'box2 komenti 2', '2014-03-25', 4),
(11, '&Ccedil;ka ju ka p&euml;lqyer m&euml; s&euml; shumti n&euml; k&euml;t&euml; program studimor?', 'Menaxhimi i kualiteti n&euml; TI', 'Shaban Buza', 'box1 komenti3', '2014-03-25', 4),
(12, '&Ccedil;ka kishit ndryshuar n&euml; k&euml;t&euml; program studimor?', 'Menaxhimi i kualiteti n&euml; TI', 'Shaban Buza', 'box2 komenti 3', '2014-03-25', 4);

-- --------------------------------------------------------

--
-- Table structure for table `votat`
--

CREATE TABLE IF NOT EXISTS `votat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_id` int(11) NOT NULL,
  `pyetja` varchar(256) NOT NULL,
  `lenda` varchar(256) NOT NULL,
  `profesori` varchar(256) NOT NULL,
  `nota` int(1) NOT NULL DEFAULT '3',
  `data` date NOT NULL,
  `semestri` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=396 ;

--
-- Dumping data for table `votat`
--

INSERT INTO `votat` (`id`, `fk_id`, `pyetja`, `lenda`, `profesori`, `nota`, `data`, `semestri`) VALUES
(346, 1, 'M&euml;simi n&euml; k&euml;t&euml; l&euml;nd&euml; i ka arritur pritjet e mia.', 'Programimi i aplikacioneve p&euml;r server', 'Ilir Byty&ccedil;i', 5, '2014-03-30', 4),
(347, 1, 'Objektivat e m&euml;simit p&euml;r secil&euml;n nj&euml;si m&euml;simore jan&euml; identifikuar dhe respektuar.', 'Programimi i aplikacioneve p&euml;r server', 'Ilir Byty&ccedil;i', 5, '2014-03-30', 4),
(348, 1, 'P&euml;rmbajtja e l&euml;nd&euml;s ka qen&euml; e orgranizuar mir&euml; dhe ka qen&euml; e leht&euml; t&euml; p&euml;rcjell&euml;t.', 'Programimi i aplikacioneve p&euml;r server', 'Ilir Byty&ccedil;i', 5, '2014-03-30', 4),
(349, 1, 'Materiali i shp&euml;rndar&euml; p&euml;r k&euml;t&euml; l&euml;nd&euml; ishte adekuat dhe i dobish&euml;m.', 'Programimi i aplikacioneve p&euml;r server', 'Ilir Byty&ccedil;i', 5, '2014-03-30', 4),
(350, 1, 'Ligj&euml;ruesi ka pasur njohuri t&euml; mir&euml;.', 'Programimi i aplikacioneve p&euml;r server', 'Ilir Byty&ccedil;i', 5, '2014-03-30', 4),
(351, 1, 'Cil&euml;sia e udh&euml;zimeve ka qen&euml; e mir&euml;.', 'Programimi i aplikacioneve p&euml;r server', 'Ilir Byty&ccedil;i', 5, '2014-03-30', 4),
(352, 1, 'Prezantimet n&euml; klas&euml; kan&euml; qen&euml; interesante dhe praktike.', 'Programimi i aplikacioneve p&euml;r server', 'Ilir Byty&ccedil;i', 5, '2014-03-30', 4),
(353, 1, 'N&euml; k&euml;t&euml; l&euml;nd&euml; kam m&euml;suar gj&euml;ra t&euml; reja dhe t&euml; dobishme.', 'Programimi i aplikacioneve p&euml;r server', 'Ilir Byty&ccedil;i', 5, '2014-03-30', 4),
(354, 1, '&Euml;sht&euml; inkurajuar pjes&euml;marrja dhe bashk&euml;veprimi n&euml; klas&euml;.', 'Programimi i aplikacioneve p&euml;r server', 'Ilir Byty&ccedil;i', 5, '2014-03-30', 4),
(355, 1, '&Euml;sht&euml; ofruar koh&euml; e mjaftueshme p&euml;r pyetjet e student&euml;ve.', 'Programimi i aplikacioneve p&euml;r server', 'Ilir Byty&ccedil;i', 5, '2014-03-30', 4),
(356, 1, 'M&euml;simi n&euml; k&euml;t&euml; l&euml;nd&euml; i ka arritur pritjet e mia.', 'Verifikimi dhe miratimi softuerik', 'Shaban Buza', 1, '2014-03-30', 4),
(357, 1, 'Objektivat e m&euml;simit p&euml;r secil&euml;n nj&euml;si m&euml;simore jan&euml; identifikuar dhe respektuar.', 'Verifikimi dhe miratimi softuerik', 'Shaban Buza', 1, '2014-03-30', 4),
(358, 1, 'P&euml;rmbajtja e l&euml;nd&euml;s ka qen&euml; e orgranizuar mir&euml; dhe ka qen&euml; e leht&euml; t&euml; p&euml;rcjell&euml;t.', 'Verifikimi dhe miratimi softuerik', 'Shaban Buza', 1, '2014-03-30', 4),
(359, 1, 'Materiali i shp&euml;rndar&euml; p&euml;r k&euml;t&euml; l&euml;nd&euml; ishte adekuat dhe i dobish&euml;m.', 'Verifikimi dhe miratimi softuerik', 'Shaban Buza', 1, '2014-03-30', 4),
(360, 1, 'Ligj&euml;ruesi ka pasur njohuri t&euml; mir&euml;.', 'Verifikimi dhe miratimi softuerik', 'Shaban Buza', 1, '2014-03-30', 4),
(361, 1, 'Cil&euml;sia e udh&euml;zimeve ka qen&euml; e mir&euml;.', 'Verifikimi dhe miratimi softuerik', 'Shaban Buza', 1, '2014-03-30', 4),
(362, 1, 'Prezantimet n&euml; klas&euml; kan&euml; qen&euml; interesante dhe praktike.', 'Verifikimi dhe miratimi softuerik', 'Shaban Buza', 1, '2014-03-30', 4),
(363, 1, 'N&euml; k&euml;t&euml; l&euml;nd&euml; kam m&euml;suar gj&euml;ra t&euml; reja dhe t&euml; dobishme.', 'Verifikimi dhe miratimi softuerik', 'Shaban Buza', 1, '2014-03-30', 4),
(364, 1, '&Euml;sht&euml; inkurajuar pjes&euml;marrja dhe bashk&euml;veprimi n&euml; klas&euml;.', 'Verifikimi dhe miratimi softuerik', 'Shaban Buza', 1, '2014-03-30', 4),
(365, 1, '&Euml;sht&euml; ofruar koh&euml; e mjaftueshme p&euml;r pyetjet e student&euml;ve.', 'Verifikimi dhe miratimi softuerik', 'Shaban Buza', 1, '2014-03-30', 4),
(366, 1, 'M&euml;simi n&euml; k&euml;t&euml; l&euml;nd&euml; i ka arritur pritjet e mia.', 'Menaxhimi i kualiteti n&euml; TI', 'Shaban Buza', 1, '2014-03-30', 4),
(367, 1, 'Objektivat e m&euml;simit p&euml;r secil&euml;n nj&euml;si m&euml;simore jan&euml; identifikuar dhe respektuar.', 'Menaxhimi i kualiteti n&euml; TI', 'Shaban Buza', 2, '2014-03-30', 4),
(368, 1, 'P&euml;rmbajtja e l&euml;nd&euml;s ka qen&euml; e orgranizuar mir&euml; dhe ka qen&euml; e leht&euml; t&euml; p&euml;rcjell&euml;t.', 'Menaxhimi i kualiteti n&euml; TI', 'Shaban Buza', 3, '2014-03-30', 4),
(369, 1, 'Materiali i shp&euml;rndar&euml; p&euml;r k&euml;t&euml; l&euml;nd&euml; ishte adekuat dhe i dobish&euml;m.', 'Menaxhimi i kualiteti n&euml; TI', 'Shaban Buza', 4, '2014-03-30', 4),
(370, 1, 'Ligj&euml;ruesi ka pasur njohuri t&euml; mir&euml;.', 'Menaxhimi i kualiteti n&euml; TI', 'Shaban Buza', 5, '2014-03-30', 4),
(371, 1, 'Cil&euml;sia e udh&euml;zimeve ka qen&euml; e mir&euml;.', 'Menaxhimi i kualiteti n&euml; TI', 'Shaban Buza', 5, '2014-03-30', 4),
(372, 1, 'Prezantimet n&euml; klas&euml; kan&euml; qen&euml; interesante dhe praktike.', 'Menaxhimi i kualiteti n&euml; TI', 'Shaban Buza', 4, '2014-03-30', 4),
(373, 1, 'N&euml; k&euml;t&euml; l&euml;nd&euml; kam m&euml;suar gj&euml;ra t&euml; reja dhe t&euml; dobishme.', 'Menaxhimi i kualiteti n&euml; TI', 'Shaban Buza', 3, '2014-03-30', 4),
(374, 1, '&Euml;sht&euml; inkurajuar pjes&euml;marrja dhe bashk&euml;veprimi n&euml; klas&euml;.', 'Menaxhimi i kualiteti n&euml; TI', 'Shaban Buza', 2, '2014-03-30', 4),
(375, 1, '&Euml;sht&euml; ofruar koh&euml; e mjaftueshme p&euml;r pyetjet e student&euml;ve.', 'Menaxhimi i kualiteti n&euml; TI', 'Shaban Buza', 1, '2014-03-30', 4),
(376, 1, 'M&euml;simi n&euml; k&euml;t&euml; l&euml;nd&euml; i ka arritur pritjet e mia.', 'Grafika kompjuterike dhe procesimi i imazheve', 'Xhevahir Bajrami', 1, '2014-03-30', 4),
(377, 1, 'Objektivat e m&euml;simit p&euml;r secil&euml;n nj&euml;si m&euml;simore jan&euml; identifikuar dhe respektuar.', 'Grafika kompjuterike dhe procesimi i imazheve', 'Xhevahir Bajrami', 2, '2014-03-30', 4),
(378, 1, 'P&euml;rmbajtja e l&euml;nd&euml;s ka qen&euml; e orgranizuar mir&euml; dhe ka qen&euml; e leht&euml; t&euml; p&euml;rcjell&euml;t.', 'Grafika kompjuterike dhe procesimi i imazheve', 'Xhevahir Bajrami', 3, '2014-03-30', 4),
(379, 1, 'Materiali i shp&euml;rndar&euml; p&euml;r k&euml;t&euml; l&euml;nd&euml; ishte adekuat dhe i dobish&euml;m.', 'Grafika kompjuterike dhe procesimi i imazheve', 'Xhevahir Bajrami', 4, '2014-03-30', 4),
(380, 1, 'Ligj&euml;ruesi ka pasur njohuri t&euml; mir&euml;.', 'Grafika kompjuterike dhe procesimi i imazheve', 'Xhevahir Bajrami', 5, '2014-03-30', 4),
(381, 1, 'Cil&euml;sia e udh&euml;zimeve ka qen&euml; e mir&euml;.', 'Grafika kompjuterike dhe procesimi i imazheve', 'Xhevahir Bajrami', 5, '2014-03-30', 4),
(382, 1, 'Prezantimet n&euml; klas&euml; kan&euml; qen&euml; interesante dhe praktike.', 'Grafika kompjuterike dhe procesimi i imazheve', 'Xhevahir Bajrami', 4, '2014-03-30', 4),
(383, 1, 'N&euml; k&euml;t&euml; l&euml;nd&euml; kam m&euml;suar gj&euml;ra t&euml; reja dhe t&euml; dobishme.', 'Grafika kompjuterike dhe procesimi i imazheve', 'Xhevahir Bajrami', 3, '2014-03-30', 4),
(384, 1, '&Euml;sht&euml; inkurajuar pjes&euml;marrja dhe bashk&euml;veprimi n&euml; klas&euml;.', 'Grafika kompjuterike dhe procesimi i imazheve', 'Xhevahir Bajrami', 2, '2014-03-30', 4),
(385, 1, '&Euml;sht&euml; ofruar koh&euml; e mjaftueshme p&euml;r pyetjet e student&euml;ve.', 'Grafika kompjuterike dhe procesimi i imazheve', 'Xhevahir Bajrami', 1, '2014-03-30', 4),
(386, 1, 'M&euml;simi n&euml; k&euml;t&euml; l&euml;nd&euml; i ka arritur pritjet e mia.', 'Matematik&euml; 2', 'Isak Hoxha', 3, '2014-03-30', 4),
(387, 1, 'Objektivat e m&euml;simit p&euml;r secil&euml;n nj&euml;si m&euml;simore jan&euml; identifikuar dhe respektuar.', 'Matematik&euml; 2', 'Isak Hoxha', 3, '2014-03-30', 4),
(388, 1, 'P&euml;rmbajtja e l&euml;nd&euml;s ka qen&euml; e orgranizuar mir&euml; dhe ka qen&euml; e leht&euml; t&euml; p&euml;rcjell&euml;t.', 'Matematik&euml; 2', 'Isak Hoxha', 3, '2014-03-30', 4),
(389, 1, 'Materiali i shp&euml;rndar&euml; p&euml;r k&euml;t&euml; l&euml;nd&euml; ishte adekuat dhe i dobish&euml;m.', 'Matematik&euml; 2', 'Isak Hoxha', 3, '2014-03-30', 4),
(390, 1, 'Ligj&euml;ruesi ka pasur njohuri t&euml; mir&euml;.', 'Matematik&euml; 2', 'Isak Hoxha', 3, '2014-03-30', 4),
(391, 1, 'Cil&euml;sia e udh&euml;zimeve ka qen&euml; e mir&euml;.', 'Matematik&euml; 2', 'Isak Hoxha', 3, '2014-03-30', 4),
(392, 1, 'Prezantimet n&euml; klas&euml; kan&euml; qen&euml; interesante dhe praktike.', 'Matematik&euml; 2', 'Isak Hoxha', 3, '2014-03-30', 4),
(393, 1, 'N&euml; k&euml;t&euml; l&euml;nd&euml; kam m&euml;suar gj&euml;ra t&euml; reja dhe t&euml; dobishme.', 'Matematik&euml; 2', 'Isak Hoxha', 3, '2014-03-30', 4),
(394, 1, '&Euml;sht&euml; inkurajuar pjes&euml;marrja dhe bashk&euml;veprimi n&euml; klas&euml;.', 'Matematik&euml; 2', 'Isak Hoxha', 3, '2014-03-30', 4),
(395, 1, '&Euml;sht&euml; ofruar koh&euml; e mjaftueshme p&euml;r pyetjet e student&euml;ve.', 'Matematik&euml; 2', 'Isak Hoxha', 3, '2014-03-30', 4);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
