-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2014 at 08:25 PM
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
  `body` text NOT NULL,
  `data` date NOT NULL,
  `foto` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `lajmet`
--

INSERT INTO `lajmet` (`id`, `titulli`, `body`, `data`, `foto`) VALUES
(1, 'Profesor&euml;t e UPZ-s&euml; do t&euml; b&euml;jn&euml; vizita studimore n&euml; universitetet evropiane', 'Prof. Dr. Zahadin Shemsidini, u. d. Rektor i Universitetit t&euml; Prizrenit "Ukshin Hoti" ka marr&euml; pjes&euml; n&euml; nj&euml; takim t&euml; disa universiteteve evropiane organizuar n&euml; selin&euml; e Asociacionit t&euml; Universiteteve Evropiane n&euml; Bruksel. Tem&euml; bosht n&euml; k&euml;t&euml; takim ishte sigurimi i cil&euml;sis&euml;, t&euml; brendshme dhe t&euml; jashtme. N&euml; k&euml;t&euml; takim &euml;sht&euml; marr&euml; vendim p&euml;r mbajtjen e nj&euml; s&euml;r&euml; workshop-esh dhe vizitave studimore gjat&euml; vitit n&euml; qytetet evropiane. Profesor&euml;t e Universitetit t&euml; Prizrenit “Ukshin Hot” do t&euml; merrin pjes&euml; n&euml; k&euml;to vizita studimore, si n&euml; Dublin-Irland&euml;, n&euml; Porto t&euml; Portugalis&euml; dhe n&euml; Banjalluk&euml; t&euml; Bosnj&euml;s dhe Hercegovin&euml;s. Të gjitha k&euml;to vizita studimore do t&euml; financohen nga Bashkimi Evropian, t&euml; cilat do t&euml; ken&euml; nj&euml; kontribut t&euml; vlefsh&euml;m p&euml;r UPZ-n&euml; n&euml; aspektin e marrjes s&euml; praktikave m&euml; t&euml; mira dhe n&euml; ngritjen e cil&euml;sis&euml; n&euml; universitet. Gjat&euml; pjes&euml;marrjes n&euml; k&euml;t&euml; takim n&euml; Bruksel, u. d. Rektori i UPZ-s&euml; ka nisur bisedat p&euml;r fillimin e bashk&euml;punimit me nj&euml; s&euml;r&euml; universitetesh evropiane, si nga Portugalia, Austria, Kroacia dhe Sllovenia. N&euml; k&euml;t&euml; takim &euml;sht&euml; diskutuar po ashtu edhe p&euml;r an&euml;tar&euml;simin e Parlamentit Studentor t&euml; UPZ-s&euml; n&euml; Unionin e Student&euml;ve Evropian. Gjithashtu n&euml; k&euml;t&euml; takim &euml;sht&euml; diskutuar edhe p&euml;r njohjen e diplomave të UPZ-s&euml; nga universitetet evropiane.', '2014-03-16', ''),
(2, 'Senati i Universitetit t&euml; Prizrenit "Ukshin Hoti" zgjedhi dekan&euml;t e Fakultetit Ekonomik, Edukimit dhe Shkencave Kompjuterike', 'Në mbledhjen e mbajtur t&euml; premten, m&euml; 14.03.2014, Senati i Universitetit t&euml; Prizrenit "Ukshin Hoti" ka zgjedhur dekan&euml;t e tre fakulteteve, t&euml; Ekonomikut, t&euml; Edukimit dhe t&euml; Shkencave Kompjuterike.\nDekan i Fakultetit t&euml; Shkencave Kompjuterike u zgjedh Prof. Dr. Artan Dermaku, i Fakultetit Ekonomik &euml;sht&euml; zgjedhur, Prof. Dr. Bekim Berisha, nd&euml;rsa i Fakultetit t&euml; Edukimit, Prof. Dr. Ismet Temaj.  Nd&euml;rsa edhe pas dy raundesh votimi, nuk arriti t&euml; zgjidhet dekani i Fakultetit Juridik, ngase rezultati ishte baras. Funksionin e dekanit n&euml; Fakultetin Juridik do t&euml; vazhdoj ta ushtroj kryesuesi i K&euml;shillit t&euml; Fakultetit, Prof. Dr. Enver Buqaj, derisa t&euml; zgjedhet dekani i k&euml;tij fakulteti. Votimi ka qen&euml; i fsheht&euml; dhe procesi &euml;sht&euml; zhvilluar normalisht.\nRreth zgjedhjeve n&euml; Fakultetin Juridik do t&euml; vendos KQZ-ja e UPZ-s&euml; dhe do t&euml; ju njoftojm&euml; n&euml; ndërkoh&euml;.', '2014-02-07', 'http://uni-prizren.com/repository/images/zgjedhjetupz.jpg'),
(3, 'U konstituua Senati i Universitetit t&euml; Prizrenit "Ukshin Hoti"', 'Senati i Universitetit t&euml; Prizrenit "Ukshin Hoti" i dal&euml; pas Zgjedhjeve t&euml; Para t&euml; P&euml;rgjithshme mbajtur n&euml; universitet, t&euml; m&euml;rkur&euml;n ka mbajtur mbledhjen e par&euml; inaugurues. N&euml; k&euml;t&euml; mbledhje &euml;sht&euml; zgjedhur Kryesues i përkohsh&euml;m i Senatit, Prof. Dr.  Sabaudin Cena, si an&euml;tar m&euml; i moshuar i senatit. Gjithashtu n&euml; k&euml;t&euml; mbledhje u formua Komisioni add-hock p&euml;r udh&euml;heqjen e procedur&euml;s p&euml;r zgjedhjeve e dekan&euml;ve. Mbledhja e Dyt&euml; e Senatit u  caktua p&euml;r t&euml; premten, n&euml; or&euml;n 11:00, ku pritet t&euml; zgjedh&euml;n dekan&euml;t e fakulteteve t&euml; UPZ-s&euml;.\nProf. Dr. Zahadin Shemsidini, u. d. rektor, n&euml; hapje t&euml; mbledhjes u  uroi t&euml; gjith&euml; senator&euml;ve t&euml; rinj t&euml; UPZ-s&euml;, pun&euml; t&euml; mbar&euml;. Ai ka theksuar se &euml;sht&euml; nder&euml; t&euml; qenit n&euml; k&euml;t&euml; pozit&euml;. Shemsidini e vler&euml;soi si dit&euml; historike p&euml;r UPZ-n&euml;, mbajtjen e k&euml;saj mbledhje, duke b&euml;r&euml; thirrje t&euml; gjith&euml; q&euml; angazhohen q&euml; t&euml; qohet p&euml;rpara universiteti.', '2014-03-12', ''),
(4, 'Lajmi 4', '', '2014-03-04', 'img/fakultet/lajme/default.png'),
(5, 'Lajmi 5', 'Ky eshte komplet lajmi i zgjeruar dhe i pazgjeruar ne forma te ndryshme te artikulara vetem shkruj o blendi shkruj mos ta nin111111111111111111111......................... ', '2013-09-10', 'img/fakultet/lajme/default.png'),
(6, 'Nehat Gashi po keqpërdor pozitën në interes të individëve e jo të studentëve', 'Menaxhmenti i Universitetit të Prizrenit “Ukshin Hoti” konsideron se Senati i UPZ-së ka organizuar takimin e dytë të radhës, më datë 14.03.2014 në orën 11:00, me rend të ditës: Zgjedhjen e dekanëve të njësive akademike. Duke ju referuar Nenit 45, 46, 47, 48, 49 dhe 50 të Statutit,  Senati ka thirrur senatorët e rinj për t’i zgjedhur dekanët e njësive akademike, andaj bashkarish me KQZ-në kanë organizuar zgjedhjet akademike me transparencë të plotë dhe demokratike. Për Fakultetin e Edukimit me shumicë votash është zgjedhur dekan Prof. Ass. Dr. Ismet Temaj, për Fakultetin e Ekonomisë, Prof. Ass. Dr. Bekim Berisha, ndërsa për Fakultetin e Shkencave Kompjuterike, është zgjedhur Prof. Ass. Dr. Artan Dermaku. Në Fakultetin Juridik kishim dy kandidatë të cilët në raundin e parë nuk fituan 2/3 e votave, ndërsa në raundin e dytë kandidatët morën votat e barabarta.  Duke ju referuar Nenit 68 të Statutit të UPZ-së, KQZ-ja rekomandoi që çështja të kthehet në fillim në Këshillin e Fakultetit Juridik.\r\nKomisioni për Mbarëvajtje, Numërim dhe Verifikim i emëruar nga Senati ishin në përbërje,  Prof. Ass. Dr. Shkelqim Millaku, kryesues; Sekretari i Përgjithshëm, z. Adem Sallauka, anëtar; Prof. Ass. Dr. Naim Baftiu, anëtar; Prof. Ass. Dr. Mimoza Dugolli, anëtare dhe nga radhët e studentëve z. Nehat Gashi, anëtar, i cili komision ka dorëzuar raportin përfundimtar që konstaton se zgjedhjet ishim komfor rregulltat juridik që ka universiteti.\r\nMenaxhmenti ka pranuar dhe shqyrtuar një shkresë publike nga studenti z. Nehat Gashi, ku theksohet se zgjedhjet në Fakultetin Juridik, sipas tij, janë përcjell me parregullsi. Ky konstatim nga ana e tij, nuk qëndron, edhe për faktin se ai ishte anëtar i Komisionit dhe i ka firmosur të gjitha proceset si të rregullta.(Shih dokumentin e nënshkruar nga anëtarët e komisionit)\r\nAi i referohet gabimisht, sepse Neni 18 i Rregullores së Zgjedhjeve, flet për Zgjedhjet në Këshillin e Fakultetit, e jo në Senat për zgjedhjen e dekanëve.\r\nGjithashtu, pohimet e tij sa i përket zgjedhjes së Kryesuesit të Këshillit të Fakultetit Juridik, i cili do të ushtron detyrën e dekanit derisa Senati i UPZ-së të zgjedhë dekanin e këtij fakulteti, nuk qëndrojnë ngase vetë Këshilli i Fakultetit Juridik e ka zgjedhur Prof. Dr. Enver Buqajn, Kryesues.\r\nMenaxhmenti i UPZ-së njofton opinionin e gjerë se z. Nehat Gashi është i instrumentalizuar prej individëve të caktuar, të cilët kanë synim të bëhen dekan në këtë fakultet përmes metodave të presionit dhe të shantazhit, dhe ndaj të njëjtit është duke shqyrtuar mundësinë e marrjes së masave disiplinore komfor Statutit dhe Kodit të Etikës së Studentëve, dhe u bënë thirrje të gjithë studentëve të mos manipulohen nga ai, ngase është në funksion të agjendave të individëve e jo të studentëve.', '2013-06-11', '');

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
  `logo` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page_info`
--

INSERT INTO `page_info` (`title`, `footer`, `activated`, `logo`) VALUES
('Universiteti i Prizrenit "Ukshin Hoti"', 'Copyright &copy; 2014', 1, 'img/fakultet/logo.png');

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
-- Table structure for table `pyetjet`
--

CREATE TABLE IF NOT EXISTS `pyetjet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pyetja` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `pyetjet`
--

INSERT INTO `pyetjet` (`id`, `pyetja`) VALUES
(1, 'M&euml;simi n&euml; k&euml;t&euml; l&euml;nd&euml; i ka arritur pritjet e mia.'),
(2, 'Objektivat e m&euml;simit p&euml;r secil&euml;n nj&euml;si m&euml;simore jan&euml; identifikuar dhe respektuar.'),
(3, 'P&euml;rmbajtja e l&euml;nd&euml;s ka qen&euml; e orgranizuar mir&euml; dhe ka qen&euml; e leht&euml; t&euml; p&euml;rcjell&euml;t.'),
(4, 'Materiali i shp&euml;rndar&euml; p&euml;r k&euml;t&euml; l&euml;nd&euml; ishte adekuat dhe i dobish&euml;m.'),
(5, 'Ligj&euml;ruesi ka pasur njohuri t&euml; mir&euml;.'),
(6, 'Cil&euml;sia e udh&euml;zimeve ka qen&euml; e mir&euml;.'),
(7, 'Prezantimet n&euml; klas&euml; kan&euml; qen&euml; interesante dhe praktike.'),
(8, 'N&euml; k&euml;t&euml; l&euml;nd&euml; kam m&euml;suar gj&euml;ra t&euml; reja dhe t&euml; dobishme.'),
(9, '&Euml;sht&euml; inkurajuar pjes&euml;marrja dhe bashk&euml;veprimi n&euml; klas&euml;.'),
(10, '&Euml;sht&euml; ofruar koh&euml; e mjaftueshme p&euml;r pyetjet e student&euml;ve.');

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

-- --------------------------------------------------------

--
-- Table structure for table `votat`
--

CREATE TABLE IF NOT EXISTS `votat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pyetja` varchar(256) NOT NULL,
  `lenda` varchar(256) NOT NULL,
  `profesori` varchar(256) NOT NULL,
  `nota` int(1) NOT NULL DEFAULT '3',
  `data` date NOT NULL,
  `semestri` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
