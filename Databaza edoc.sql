-- Databaza: `edoc`
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+01:00";

-- Krijimi i tabeles `admin`
DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `aemail` varchar(255) NOT NULL,
  `apassword` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`aemail`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Fus te dhenat per tabelen `admin`
INSERT INTO `admin` (`aemail`, `apassword`) VALUES
('admin@edoc.com', '123');

-- Krijimi i tabeles `appointment`
DROP TABLE IF EXISTS `appointment`;
CREATE TABLE IF NOT EXISTS `appointment` (
  `appoid` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(10) DEFAULT NULL,
  `apponum` int(3) DEFAULT NULL,
  `scheduleid` int(10) DEFAULT NULL,
  `appodate` date DEFAULT NULL,
  PRIMARY KEY (`appoid`),
  KEY `pid` (`pid`),
  KEY `scheduleid` (`scheduleid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Fus te dhena ne tabelen `appointment`
INSERT INTO `appointment` (`appoid`, `pid`, `apponum`, `scheduleid`, `appodate`) VALUES
(1, 1, 1, 1, '2023-06-03');

-- Krijimi i tabeles `doctor`
DROP TABLE IF EXISTS `doctor`;
CREATE TABLE IF NOT EXISTS `doctor` (
  `docid` int(11) NOT NULL AUTO_INCREMENT,
  `docemail` varchar(255) DEFAULT NULL,
  `docname` varchar(255) DEFAULT NULL,
  `docpassword` varchar(255) DEFAULT NULL,
  `docnic` varchar(15) DEFAULT NULL,
  `doctel` varchar(15) DEFAULT NULL,
  `specialties` int(2) DEFAULT NULL,
  PRIMARY KEY (`docid`),
  KEY `specialties` (`specialties`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
Describe table doctor;
SELECT * FROM doctor;

-- Fus te dhena ne tabelen `doctor`
INSERT INTO `doctor` (`docid`, `docemail`, `docname`, `docpassword`, `docnic`, `doctel`, `specialties`) VALUES
(1, 'doktor@gmail.com', 'Ana Bega', '1234', '01010101', '0683612000', 1);

-- Krijimi i tabeles `patient`
DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `pemail` varchar(255) DEFAULT NULL,
  `pname` varchar(255) DEFAULT NULL,
  `ppassword` varchar(255) DEFAULT NULL,
  `paddress` varchar(255) DEFAULT NULL,
  `pnic` varchar(15) DEFAULT NULL,
  `pdob` date DEFAULT NULL,
  `ptel` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Fus te dhenat ne tabelen `patient`
INSERT INTO `patient` (`pid`, `pemail`, `pname`, `ppassword`, `paddress`, `pnic`, `pdob`, `ptel`) VALUES
(1, 'suelahasanaj9@gamil.com', 'Suela Hasanaj', 'Suela2003', 'Rr.Krotoni', 'Suela', '1998-03-01', '0693542134'),
(2, 'pacient@gmail.com', 'Elma Sula', 'Elma213', 'Rr.Asdreni', 'Elma', '2000-06-03', '0685612010');

-- Krijimi i tabeles `schedule`
DROP TABLE IF EXISTS `schedule`;
CREATE TABLE IF NOT EXISTS `schedule` (
  `scheduleid` int(11) NOT NULL AUTO_INCREMENT,
  `docid` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `scheduledate` date DEFAULT NULL,
  `scheduletime` time DEFAULT NULL,
  `nop` int(4) DEFAULT NULL,
  PRIMARY KEY (`scheduleid`),
  KEY `docid` (`docid`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `specialities`;
CREATE TABLE IF NOT EXISTS `specialities`(
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `sname` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
)ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Fus te dhena ne tabelen `schedule`
INSERT INTO `specialities` (`id`, `sname`) VALUES
(1, 'Mjekësi e aksidenteve dhe emergjencave'),
(2, 'Alergologji'),
(3, 'Anesteziologji'),
(4, 'Hematologji biologjike'),
(5, 'Kardiologji'),
(6, 'Psikiatri infantile'),
(7, 'Biologji klinike'),
(8, 'Kimi klinike'),
(9, 'Neurofiziologji klinike'),
(10, 'Radiologji klinike'),
(11, 'Kirurgji dentare, orale dhe maksilofaciale'),
(12, 'Dermatovenerologji'),
(13, 'Dermatologji'),
(14, 'Endokrinologji'),
(15, 'Kirurgji gastro-enterologjike'),
(16, 'Gastroenterologji'),
(17, 'Hematologji e përgjithshme'),
(18, 'Praktika e përgjithshme'),
(19, 'Kirurgji e përgjithshme'),
(20, 'Geriatri'),
(21, 'Imunologji'),
(22, 'Sëmundje infektive'),
(23, 'Mjekësi e përgjithshme'),
(24, 'Mjekësi laboratorike'),
(25, 'Kirurgji dentare, orale dhe maksilofaciale'),
(26, 'Mikrobiologji'),
(27, 'Nefrologji'),
(28, 'Neuro-Psikiatri'),
(29, 'Neurologji'),
(30, 'Neurokirurgji'),
(31, 'Mjekësi nukleare'),
(32, 'Akusheri dhe ginekologji'),
(33, 'Mjekësi e punës'),
(34, 'Oftalmologji'),
(35, 'Ortopedi'),
(36, 'Otorinolaringologji'),
(37, 'Kirurgji pediatrike'),
(38, 'Pediatri'),
(39, 'Patologji'),
(40, 'Farmakologji'),
(41, 'Mjekësi fizike dhe rehabilitim'),
(42, 'Kirurgji plastike'),
(43, 'Mjekësi podiatrike'),
(44, 'Kirurgji podiatrike'),
(45, 'Psikiatri'),
(46, 'Shëndet publik dhe Mjekësi parandaluese'),
(47, 'Radiologji'),
(48, 'Radioterapi'),
(49, 'Mjekësi e frymëmarrjes'),
(50, 'Reumatologji'),
(51, 'Stomatologji'),
(52, 'Kirurgji torakale'),
(53, 'Mjekësi tropikale'),
(54, 'Urologji'),
(55, 'Kirurgji e enëve të gjakut'),
(56, 'Venereologji');


-- Krijimi i tabeles `webuser`
DROP TABLE IF EXISTS `webuser`;
CREATE TABLE IF NOT EXISTS `webuser` (
  `email` varchar(255) NOT NULL,
  `usertype` char(1) DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Fus te dhena ne tabelen `webuser`
INSERT INTO `webuser` (`email`, `usertype`) VALUES
('admin@edoc.com', 'a'),
('doktor@edoc.com', 'd'),
('pacient@edoc.com', 'p'),
('suelahasanaj@gmail.com', 'p');
COMMIT;