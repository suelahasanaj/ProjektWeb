-- Databaza doktorionline.sql
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+01:00";

-- Krijimi i tabeles 'admin'
DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) DEFAULT NULL, 
  PRIMARY KEY (`admin_email`)
); -- ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Marrja e te dhenave per tabelen 'admin' 
INSERT INTO `admin` (`admin_email`, `admin_password`) VALUES
('admin@gamil.com', '2003!');

-- Krijimi i tabeles 'appointment'
DROP TABLE IF EXISTS `appointment`;
CREATE TABLE IF NOT EXISTS `appointment` (
  `appointment_id` int(11) NOT NULL AUTO_INCREMENT,
  `pacient_id` int(10) DEFAULT NULL,
  `appointment_number` int(3) DEFAULT NULL,
  `schedule_id` int(10) DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  PRIMARY KEY (`appointment_id`),
  KEY `patient_id` (`pacient_id`),
  KEY `schedule_id` (`schedule_id`)
); -- ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Marrja e te dhenave per tabelen 'appointment'
INSERT INTO `appointment` (`appointment_id`, `pacient_id`, `appointment_number`, `schedule_id`, `appointment_date`) VALUES
(1, 1, 1, 1, '2024-01-03');

-- Krijimi i tabeles 'doctor'
DROP TABLE IF EXISTS `doctor`;
CREATE TABLE IF NOT EXISTS `doctor` (
  `doctor_id` int(11) NOT NULL AUTO_INCREMENT,
  `doctor_email` varchar(255) DEFAULT NULL,
  `doctor_name` varchar(255) DEFAULT NULL,
  `doctor_password` varchar(255) DEFAULT NULL,
  `doctor_nic` varchar(15) DEFAULT NULL,
  `doctor_phonenumber` varchar(15) DEFAULT NULL,
  `specialty` int(2) DEFAULT NULL,
  PRIMARY KEY (`doctor_id`),
  KEY `specialty` (`specialty`)
); -- ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Marrja e te dhenave per tabelen 'doctor'
INSERT INTO `doctor` (`doctor_id`, `doctor_email`, `doctor_name`, `doctor_password`, `doctor_nic`, `doctor_phonenumber`, `specialty`) VALUES
(1, 'doctor@gmail.com', 'Test Doctor', '2000!', '000000010', '+355683612000', 1),
(2, 'fredtomson@gmail.com', 'Fred Tomson', 'Fred1980!', '000000011', '+355683612445', 7),
(3, 'almirazeka@gmail.com', 'Almira Zeka', 'Almiraa123', '000000112', '+355685612010', 3),
(4, 'mentorpetrela@gmail.com', 'Mentor Petrela', 'Mentormentor12', '000000013', '+355690325431', 11),
(5, 'zamirshefqetndroqi@gmail.com', 'Zamir Shefqet Ndroqi', 'Zamir1979!', '000000114', '+355683612004', 5),
(6, 'eglantinabega@gmail.com', 'Eglantina Bega', 'Eglantina1991?', '000000015', '+355683612510', 21);

-- Krijimi i tabeles 'patient'
DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `patient_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_email` varchar(255) DEFAULT NULL,
  `patient_name` varchar(255) DEFAULT NULL,
  `patient_password` varchar(255) DEFAULT NULL,
  `patient_address` varchar(255) DEFAULT NULL,
  `patient_nic` varchar(15) DEFAULT NULL,
  `patient_birthdate` date DEFAULT NULL,
  `patient_phonenumber` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`patient_id`)
); -- ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Marrja e te dhenave per tabelen 'patient'
INSERT INTO `patient` (`patient_id`, `patient_email`, `patient_name`, `patient_password`, `patient_address`, `patient_nic`, `patient_birthdate`, `patient_phonenumber`) VALUES
(1, 'patient@gmail.com', 'Test Patient', '123', 'Tirana 1050', '0100000010', '2000-01-01', '+355693512311'),
(2, 'suelahasanaj9@gmail.com', 'Suela Hasanaj', 'Suela2003', 'Tirana 1010', '0110000000', '2003-03-25', '+3553612010');

-- Krijimi i tabeles 'schedule'
DROP TABLE IF EXISTS `schedule`;
CREATE TABLE IF NOT EXISTS `schedule` (
  `schedule_id` int(11) NOT NULL AUTO_INCREMENT,
  `doctor_id` varchar(255) DEFAULT NULL,
  `title_of_schedule` varchar(255) DEFAULT NULL,
  `schedule_date` date DEFAULT NULL,
  `schedule_time` time DEFAULT NULL,
  `number_of_patients` int(4) DEFAULT NULL,
  PRIMARY KEY (`schedule_id`),
  KEY `doctor_id` (`doctor_id`)
); -- ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Marrja e te dhenave per tabelen 'schedule'
INSERT INTO `schedule` (`schedule_id`, `doctor_id`, `title_of_schedule`, `schedule_date`, `schedule_time`, `number_of_patients`) VALUES
(1, '1', 'Seanca Test', '2024-01-01', '18:00:00', 3),
(2, '2', '1', '2024-01-10', '20:36:00', 1),
(3, '1', '12', '2024-01-10', '20:33:00', 1),
(4, '2', '1', '2024-01-12', '12:32:00', 2),
(5, '2', '1', '2024-01-15', '20:35:00', 5),
(6, '3', '12', '2024-01-15', '20:35:00', 8),
(7, '1', '1', '2024-01-19', '20:36:00', 8),
(8, '1', '12', '2024-01-23', '13:33:00', 1);

-- Krijimi i tabeles 'specialties'
DROP TABLE IF EXISTS `specialties`;
CREATE TABLE IF NOT EXISTS `specialties` (
  `id` int(2) NOT NULL,
  `specialty_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
);-- ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Marrja e te dhenave per tabelen 'specialties'
INSERT INTO `specialties` (`id`, `specialty_name`) VALUES
(1, 'Mjekësi e aksidenteve dhe emergjencave'),
(2, 'Alergologji'),
(3, 'Anesteziologji'),
(4, 'Hematologji biologjike'),
(5, 'Kardiologji'),
(6, 'Psihiatri infantile'),
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
(30, 'Neurokirurgji');

-- Krijimi i tabeles 'webuser'
DROP TABLE IF EXISTS `webuser`;
CREATE TABLE IF NOT EXISTS `webuser` (
  `email` varchar(255) NOT NULL,
  `usertype` char(1) DEFAULT NULL,
  PRIMARY KEY (`email`)
); -- ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Marrja e te dhenave per tabelen 'webuser'
INSERT INTO `webuser` (`email`, `usertype`) VALUES
('admin@gmail.com', 'admin'),
('doctor@gmail.com', 'doctor'),
('patient@gmail.com', 'patient'),
('suelahasanaj@gmail.com', 'patient');
COMMIT;