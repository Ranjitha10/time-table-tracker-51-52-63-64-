-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 02, 2015 at 04:18 PM
-- Server version: 5.5.40
-- PHP Version: 5.3.10-1ubuntu3.15

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `timetable`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE IF NOT EXISTS `class` (
  `sem` varchar(5) NOT NULL DEFAULT '0',
  `sub` varchar(30) NOT NULL DEFAULT '',
  `start_time` time NOT NULL DEFAULT '00:00:00',
  `end_time` time NOT NULL DEFAULT '00:00:00',
  `day` char(10) NOT NULL DEFAULT '',
  PRIMARY KEY (`sem`,`sub`,`start_time`,`end_time`,`day`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`sem`, `sub`, `start_time`, `end_time`, `day`) VALUES
('1IT', 'MAD', '10:00:00', '11:00:00', 'MON'),
('1IT', 'WebSer', '09:00:00', '10:00:00', 'MON'),
('1SE', 'ADBMS', '10:00:00', '11:00:00', 'MON'),
('1SE', 'java', '09:00:00', '10:00:00', 'MON'),
('3', 'BrigecourseMathematics', '09:00:00', '11:00:00', 'SAT'),
('3', 'DLD', '12:30:00', '01:30:00', 'FRI'),
('3', 'DLD', '12:30:00', '01:30:00', 'MON'),
('3', 'DLD', '12:30:00', '01:30:00', 'THU'),
('3', 'DMS', '03:15:00', '04:15:00', 'MON'),
('3', 'DMS', '09:00:00', '10:00:00', 'THU'),
('3', 'DMS', '10:00:00', '11:00:00', 'TUE'),
('3', 'DMS', '11:30:00', '12:30:00', 'FRI'),
('3', 'DSC', '02:15:00', '03:15:00', 'FRI'),
('3', 'DSC', '03:15:00', '04:15:00', 'THU'),
('3', 'DSC', '12:30:00', '01:30:00', 'WED'),
('3', 'DSC(B1)', '02:15:00', '04:45:00', 'TUE'),
('3', 'DSC(B2)', '02:15:00', '04:45:00', 'TUE'),
('3', 'DSC(B3)', '02:15:00', '04:45:00', 'TUE'),
('3', 'DSC(B4)', '02:15:00', '04:45:00', 'TUE'),
('3', 'DSC(QEEE)', '09:00:00', '10:00:00', 'FRI'),
('3', 'DSC(QEEE)', '09:00:00', '10:00:00', 'TUE'),
('3', 'EM', '02:15:00', '03:15:00', 'MON'),
('3', 'EM', '10:00:00', '11:00:00', 'THU'),
('3', 'EM', '12:30:00', '01:30:00', 'TUE'),
('3', 'LD(B1)', '09:00:00', '11:30:00', 'MON'),
('3', 'LD(B2)', '09:00:00', '11:30:00', 'MON'),
('3', 'LD(B3)', '09:00:00', '11:30:00', 'WED'),
('3', 'LD(B4)', '09:00:00', '11:30:00', 'WED'),
('3', 'MATHS-3', '10:00:00', '11:00:00', 'FRI'),
('3', 'MATHS-3', '11:30:00', '12:30:00', 'MON'),
('3', 'MATHS-3', '11:30:00', '12:30:00', 'THU'),
('3', 'MATHS-3', '11:30:00', '12:30:00', 'WED'),
('3', 'OOPS', '02:15:00', '03:15:00', 'THU'),
('3', 'OOPS', '03:15:00', '04:15:00', 'FRI'),
('3', 'OOPS', '11:30:00', '12:30:00', 'TUE'),
('3', 'OOPS(B1)', '09:00:00', '11:30:00', 'WED'),
('3', 'OOPS(B2)', '09:00:00', '11:30:00', 'WED'),
('3', 'OOPS(B3)', '09:00:00', '11:30:00', 'MON'),
('3', 'OOPS(B4)', '09:00:00', '11:30:00', 'MON'),
('3', 'SELFSTUDY', '02:15:00', '03:15:00', 'WED'),
('3', 'SELFSTUDY', '02:15:00', '04:15:00', 'WED'),
('3', 'SELFSTUDY', '03:15:00', '04:15:00', 'WED'),
('5', 'AA', '09:00:00', '10:00:00', 'WED'),
('5', 'AA', '11:30:00', '01:30:00', 'FRI'),
('5', 'AA', '12:30:00', '01:30:00', 'MON'),
('5', 'CD', '09:00:00', '10:00:00', 'WED'),
('5', 'CD', '11:30:00', '01:30:00', 'FRI'),
('5', 'CD', '12:30:00', '01:30:00', 'MON'),
('5', 'CN-I', '09:00:00', '10:00:00', 'MON'),
('5', 'CN-I', '09:00:00', '10:00:00', 'TUE'),
('5', 'CN-I', '12:30:00', '01:30:00', 'TUE'),
('5', 'CN-I[T]', '12:30:00', '01:30:00', 'WED'),
('5', 'EIPR', '03:15:00', '04:15:00', 'MON'),
('5', 'EIPR', '10:00:00', '11:00:00', 'TUE'),
('5', 'EIPR', '10:00:00', '11:00:00', 'WED'),
('5', 'GT', '10:00:00', '11:00:00', 'FRI'),
('5', 'GT', '11:30:00', '12:30:00', 'MON'),
('5', 'GT', '11:30:00', '12:30:00', 'WED'),
('5', 'J2EE', '10:00:00', '11:00:00', 'FRI'),
('5', 'J2EE', '11:30:00', '12:30:00', 'MON'),
('5', 'J2EE', '11:30:00', '12:30:00', 'WED'),
('5', 'M-MP', '02:15:00', '03:15:00', 'MON'),
('5', 'M-MP', '09:00:00', '10:00:00', 'THU'),
('5', 'M-MP', '11:30:00', '12:30:00', 'TUE'),
('5', 'M-MP(B1)', '11:30:00', '02:00:00', 'THU'),
('5', 'M-MP(B2)', '11:30:00', '02:00:00', 'THU'),
('5', 'M-MP(B3)', '02:15:00', '04:45:00', 'WED'),
('5', 'M-MP(B4)', '02:15:00', '04:45:00', 'WED'),
('5', 'MIS', '09:00:00', '10:00:00', 'WED'),
('5', 'MIS', '11:30:00', '01:30:00', 'FRI'),
('5', 'MIS', '12:30:00', '01:30:00', 'MON'),
('5', 'NLP', '10:00:00', '11:00:00', 'FRI'),
('5', 'NLP', '11:30:00', '12:30:00', 'MON'),
('5', 'NLP', '11:30:00', '12:30:00', 'WED'),
('5', 'SELFSTUDY', '02:15:00', '04:15:00', 'TUE'),
('5', 'SS', '09:00:00', '10:00:00', 'FRI'),
('5', 'SS', '10:00:00', '11:00:00', 'MON'),
('5', 'SS', '10:00:00', '11:00:00', 'THU'),
('5', 'SS(B1)', '02:15:00', '04:45:00', 'WED'),
('5', 'SS(B2)', '02:15:00', '04:45:00', 'WED'),
('5', 'SS(B3)', '11:30:00', '02:00:00', 'THU'),
('5', 'SS(B4)', '11:30:00', '02:00:00', 'THU'),
('7', 'AA', '02:20:00', '04:00:00', 'TUE'),
('7', 'AA', '11:15:00', '12:05:00', 'THU'),
('7', 'AA', '12:55:00', '01:45:00', 'FRI'),
('7', 'BDM', '02:20:00', '04:00:00', 'TUE'),
('7', 'BDM', '11:15:00', '12:05:00', 'THU'),
('7', 'BDM', '12:55:00', '01:45:00', 'FRI'),
('7', 'C#', '02:20:00', '03:10:00', 'FRI'),
('7', 'C#', '02:20:00', '03:10:00', 'WED'),
('7', 'C#', '12:05:00', '12:55:00', 'FRI'),
('7', 'C#', '12:55:00', '01:45:00', 'TUE'),
('7', 'CC', '02:20:00', '03:10:00', 'FRI'),
('7', 'CC', '02:20:00', '03:10:00', 'WED'),
('7', 'CC', '12:05:00', '12:55:00', 'FRI'),
('7', 'CC', '12:55:00', '01:45:00', 'TUE'),
('7', 'EIPR', '03:10:00', '04:50:00', 'WED'),
('7', 'EIPR', '11:15:00', '12:55:00', 'SAT'),
('7', 'GlobalElective', '03:10:00', '04:50:00', 'FRI'),
('7', 'OOMD', '11:15:00', '12:05:00', 'FRI'),
('7', 'OOMD', '11:15:00', '12:05:00', 'MON'),
('7', 'OOMD', '12:55:00', '01:45:00', 'WED'),
('7', 'SPT', '12:05:00', '12:55:00', 'MON'),
('7', 'SPT', '12:05:00', '12:55:00', 'THU'),
('7', 'SPT', '12:05:00', '12:55:00', 'TUE'),
('7', 'SPT', '12:05:00', '12:55:00', 'WED'),
('7', 'SPT(B1)', '02:20:00', '04:50:00', 'MON'),
('7', 'SPT(B2)', '02:20:00', '04:50:00', 'MON'),
('7', 'SPT(B3)', '02:20:00', '04:50:00', 'THU'),
('7', 'SPT(B4)', '02:20:00', '04:50:00', 'THU'),
('7', 'WP', '11:15:00', '12:05:00', 'TUE'),
('7', 'WP', '11:15:00', '12:05:00', 'WED'),
('7', 'WP', '12:55:00', '01:45:00', 'MON'),
('7', 'WP', '12:55:00', '01:45:00', 'THU'),
('7', 'WP(B1)', '02:20:00', '04:50:00', 'THU'),
('7', 'WP(B2)', '02:20:00', '04:50:00', 'THU'),
('7', 'WP(B3)', '02:20:00', '04:50:00', 'MON'),
('7', 'WP(B4)', '02:20:00', '04:50:00', 'MON');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `d_name` char(30) DEFAULT NULL,
  `d_no` varchar(3) NOT NULL,
  PRIMARY KEY (`d_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`d_name`, `d_no`) VALUES
('Information Science', 'ISE');

-- --------------------------------------------------------

--
-- Table structure for table `handles`
--

CREATE TABLE IF NOT EXISTS `handles` (
  `sub` varchar(30) NOT NULL DEFAULT '',
  `name` char(100) NOT NULL DEFAULT '',
  `sem` varchar(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`sub`,`name`,`sem`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `handles`
--

INSERT INTO `handles` (`sub`, `name`, `sem`) VALUES
('DSC(B3)', 'ABS', '3'),
('OOPS(B2)', 'ABS', '3'),
('LD(B3)', 'BKS', '3'),
('M-MP(B2)', 'BKS', '5'),
('M-MP(B4)', 'BKS', '5'),
('OOMD', 'BKS', '7'),
('AA', 'BMS', '7'),
('M-MP(B3)', 'BMS', '5'),
('NLP', 'BMS', '5'),
('WP(B2)', 'BMS', '7'),
('AA', 'CRM', '5'),
('DSC', 'CRM', '3'),
('DSC(B1)', 'CRM', '3'),
('M-MP(B1)', 'CRM', '5'),
('OOPS(B4)', 'CRM', '3'),
('WP(B1)', 'CRM', '7'),
('WP(B4)', 'CRM', '7'),
('M-MP(B2)', 'DP', '5'),
('M-MP(B4)', 'DP', '5'),
('DSC(B2)', 'GCN', '3'),
('WP', 'GCN', '7'),
('WP(B1)', 'GCN', '7'),
('WP(B3)', 'GCN', '7'),
('MIS', 'GNS', '5'),
('SPT(B4)', 'GNS', '7'),
('ADBMS', 'GRS', '1SE'),
('OOPS(B1)', 'GRS', '3'),
('WebSer', 'GRS', '1IT'),
('DLD', 'GSM', '3'),
('DSC(B3)', 'GSM', '3'),
('LD(B1)', 'GSM', '3'),
('LD(B3)', 'GSM', '3'),
('DSC(B4)', 'GV', '3'),
('LD(B2)', 'GV', '3'),
('SPT(B1)', 'GV', '7'),
('SS(B3)', 'GV', '5'),
('DSC(B1)', 'JM', '3'),
('C#', 'MM', '7'),
('DSC(B4)', 'MM', '3'),
('SPT(B2)', 'MM', '7'),
('SPT(B4)', 'MM', '7'),
('CD', 'NKC', '5'),
('SS(B2)', 'NKC', '5'),
('EIPR', 'OT', '5'),
('EIPR', 'OT', '7'),
('EM', 'OT', '3'),
('Global', 'OT', '7'),
('GT', 'OT', '5'),
('MATHS-3', 'OT', '3'),
('BDM', 'PK', '7'),
('OOPS(B2)', 'PK', '3'),
('OOPS(B4)', 'PK', '3'),
('SS(B1)', 'PK', '5'),
('CC', 'PT', '7'),
('DSC(B2)', 'PT', '3'),
('J2EE', 'PT', '5'),
('java', 'PT', '1SE'),
('MAD', 'PT', '1IT'),
('SS(B4)', 'PT', '5'),
('WP(B2)', 'PT', '7'),
('WP(B4)', 'PT', '7'),
('CN-1', 'RBS', '5'),
('SPT(B3)', 'RBS', '7'),
('WP(B3)', 'RBS', '7'),
('OOPS(B2)', 'RMS', '3'),
('OOPS(B3)', 'RMS', '3'),
('SS', 'RMS', '5'),
('SS(B1)', 'RMS', '5'),
('SS(B3)', 'RMS', '5'),
('OOPS', 'RR', '3'),
('OOPS(B1)', 'RR', '3'),
('OOPS(B3)', 'RR', '3'),
('SS(B2)', 'RR', '5'),
('M-MP', 'SGR', '5'),
('M-MP(B1)', 'SGR', '5'),
('M-MP(B3)', 'SGR', '5'),
('LD(B2)', 'SN', '3'),
('LD(B4)', 'SN', '3'),
('SPT', 'SRN', '7'),
('SPT(B1)', 'SRN', '7'),
('SPT(B3)', 'SRN', '7'),
('SPT(B2)', 'SS', '7'),
('DMS', 'VK', '3'),
('DSC(B3)', 'VK', '3'),
('LD(B1)', 'VK', '3'),
('SS(B2)', 'VK', '5'),
('SS(B4)', 'VK', '5');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `FName` char(100) DEFAULT NULL,
  `LName` char(100) DEFAULT NULL,
  `Short` varchar(10) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `pw` varchar(100) DEFAULT NULL,
  `Email` varchar(50) NOT NULL,
  `Mobile` varchar(20) NOT NULL,
  PRIMARY KEY (`Short`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`FName`, `LName`, `Short`, `username`, `pw`, `Email`, `Mobile`) VALUES
('Anisha', 'BS', 'ABS', NULL, NULL, 'student.rvce.ise@gmail.com', '9743583064'),
('as', 'as', 'asf', 'NULL', '6c3e226b4d4795d518ab341b0824ec29', 'sa@as.co', '214'),
('Srinivas', 'BK', 'BKS', NULL, NULL, 'student.rvce.ise@gmail.com', '9743583064'),
('Sagar', 'BM', 'BMS', NULL, NULL, 'student.rvce.ise@gmail.com', '9743583064'),
('C', 'B', 'CCD', 'NULL', '6c3e226b4d4795d518ab341b0824ec29', 'sddasd@dsd.com', '7212121212'),
('Chetana', 'Murthy', 'CRM', NULL, NULL, 'student.rvce.ise@gmail.com', '9743583064'),
('Priya', 'D', 'DP', NULL, NULL, 'student.rvce.ise@gmail.com', '9743583064'),
('Gany', 'Arkalgud', 'GA', 'gany', '1f78643ddd0d128037df48dbfccccf4e', 'gany.enthused@gmail.com', '9743583064'),
('Nagraj', 'GC', 'GCN', NULL, NULL, 'student.rvce.ise@gmail.com', '9743583064'),
('Srinivasn', 'GN', 'GNS', NULL, NULL, 'student.rvce.ise@gmail.com', '9743583064'),
('Smitha', 'GR', 'GRS', '', '', 'student.rvce.ise@gmail.com', '9743583064'),
('Mamath', 'GS', 'GSM', NULL, NULL, 'student.rvce.ise@gmail.com', '9743583064'),
('Geetha', 'V', 'GV', NULL, NULL, 'student.rvce.ise@gmail.com', '9743583064'),
('Jitendra', 'Mungara', 'JM', NULL, NULL, 'student.rvce.ise@gmail.com', '9743583064'),
('Kavitha', 'SN', 'KSN', NULL, NULL, 'student.rvce.ise@gmail.com', '9743583064'),
('Merin', 'Meleet', 'MM', NULL, NULL, 'student.rvce.ise@gmail.com', '9743583064'),
('Cauvery', 'NK', 'NKC', 'NKC', '0c9026c090b13a22c937ee73d17941ea', 'student.rvce.ise@gmail.com', '9743583064'),
('Other', 'Other', 'OT', NULL, NULL, 'student.rvce.ise@gmail.com', '9743583064'),
('Poornima', 'Kulkarni', 'PK', NULL, NULL, 'student.rvce.ise@gmail.com', '9743583064'),
('Pawan', 'Ravi', 'PRV', NULL, NULL, 'student.rvce.ise@gmail.com', '9743583064'),
('Padmashree', 'T', 'PT', NULL, NULL, 'student.rvce.ise@gmail.com', '9743583064'),
('Rekha', 'BS', 'RBS', NULL, NULL, 'student.rvce.ise@gmail.com', '9743583064'),
('Ramakanth', 'Kumar', 'RMP', NULL, NULL, 'student.rvce.ise@gmail.com', '9743583064'),
('Rajashekhar', 'Murthy', 'RMS', NULL, NULL, 'student.rvce.ise@gmail.com', '9743583064'),
('Rashmi', 'R', 'RR', NULL, NULL, 'student.rvce.ise@gmail.com', '9743583064'),
('sdshdghjsgd', 'sjsjsjdsjkh', 'SAD', 'NULL', '6c3e226b4d4795d518ab341b0824ec29', 'sddasd@dsd.com', '7212121212'),
('Raghvendra', 'Prasad', 'SGR', NULL, NULL, 'student.rvce.ise@gmail.com', '9743583064'),
('Sushmitha', 'N', 'SN', NULL, NULL, 'student.rvce.ise@gmail.com', '9743583064'),
('Shantaram', 'Nayak', 'SRN', NULL, NULL, 'student.rvce.ise@gmail.com', '9743583064'),
('Shwetha', 'SN', 'SS', NULL, NULL, 'student.rvce.ise@gmail.com', '9743583064'),
('KK', 'VIVEK', 'V', 'NULL', '6c3e226b4d4795d518ab341b0824ec29', 'KK', 'NULL'),
('Vanishree', 'K', 'VK', NULL, NULL, 'student.rvce.ise@gmail.com', '9743583064'),
('VIVEK', 'V', 'VV', 'NULL', '6c3e226b4d4795d518ab341b0824ec29', 'a@a.x', '7212121212');

-- --------------------------------------------------------

--
-- Table structure for table `sem`
--

CREATE TABLE IF NOT EXISTS `sem` (
  `name` varchar(5) NOT NULL DEFAULT '',
  `strength` int(5) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sem`
--

INSERT INTO `sem` (`name`, `strength`) VALUES
('1', 75),
('1IT', 18),
('1SE', 18),
('3', 75),
('4', 75),
('5', 75),
('58', 67),
('6', 75),
('7', 75),
('8', 75);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `initials` char(3) NOT NULL DEFAULT '',
  `fname` char(20) DEFAULT NULL,
  `lname` char(20) NOT NULL,
  `designation` char(20) DEFAULT NULL,
  `dep_no` varchar(3) DEFAULT NULL,
  `pw` varchar(100) DEFAULT NULL,
  `workload` char(26) DEFAULT NULL,
  PRIMARY KEY (`initials`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`initials`, `fname`, `lname`, `designation`, `dep_no`, `pw`, `workload`) VALUES
('ABS', 'Anisha', 'BS', NULL, 'ISE', NULL, NULL),
('BKS', 'Srinivas', 'BK', NULL, 'ISE', 'be149a991e196d998e536836e9409729', NULL),
('BMS', 'Sagar', 'BM', NULL, 'ISE', NULL, NULL),
('cd', 'a', 'b', 'e', 'ISE', '6865aeb3a9ed28f9a79ec454b259e5d0', 'acg'),
('CRM', 'Chetana', 'Murthy', NULL, 'ISE', NULL, 'c'),
('DP', 'Priya', 'D', NULL, 'ISE', 'e2fca8135c2fadca093abd79a6b1c0d2', NULL),
('GCN', 'Nagraj', 'GC', NULL, 'ISE', NULL, NULL),
('GNS', 'Srinivasn', 'GN', NULL, 'ISE', NULL, NULL),
('GRS', 'Smitha', 'GR', NULL, 'ISE', '52899a58dee627d98edea18d1c701891', 'cgl'),
('GSM', 'Mamath', 'GS', NULL, 'ISE', NULL, NULL),
('GV', 'Geetha', 'V', NULL, 'ISE', NULL, NULL),
('JM', 'Jitendra', 'Mungara', NULL, 'ISE', NULL, NULL),
('KK', 'VIVEK', 'V', 'NULL', 'NUL', '16e4ef534cec559430e07e05eb71c719', 'NULL'),
('KSN', 'Kavitha', 'SN', NULL, 'ISE', NULL, 'clt'),
('MM', 'Merin', 'Meleet', NULL, 'ISE', NULL, NULL),
('MMA', 'VIVEK', 'V', 'ASSTPROF', 'ISE', '0374745b8aa244784ada619c9948181f', 'clt'),
('OT', 'Other', 'Other', NULL, 'ISE', NULL, NULL),
('PK', 'Poornima', 'Kulkarni', NULL, 'ISE', NULL, NULL),
('PT', 'Padmashree', 'T', NULL, 'ISE', NULL, NULL),
('RBS', 'Rekha', 'BS', NULL, 'ISE', NULL, NULL),
('RMP', 'Ramakanth', 'Kumar', NULL, 'ISE', NULL, NULL),
('RMS', 'Rajashekhar', 'Murthy', NULL, 'ISE', NULL, NULL),
('RR', 'Rashmi', 'R', NULL, 'ISE', NULL, NULL),
('SAD', 'sdshdghjsgd', 'sjsjsjdsjkh', 'dsfsfsdfdf', 'ISE', 'b9f50ca01f59b01d4aaa9cc3c0bad9f1', 'dfgdgfdg'),
('SGR', 'Raghvendra', 'Prasad', NULL, 'ISE', NULL, NULL),
('SN', 'Sushmitha', 'N', NULL, 'ISE', NULL, NULL),
('SRN', 'Shantaram', 'Nayak', NULL, 'ISE', NULL, NULL),
('SS', 'Shwetha', 'SN', NULL, 'ISE', NULL, NULL),
('VK', 'Vanishree', 'K', NULL, 'ISE', NULL, NULL),
('VV', 'VIVEK', 'V', 'NULL', 'NUL', 'c0055fa4cdc19a2690bfee3643413a7d', 'NULL');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `usn` varchar(10) NOT NULL,
  `dept` varchar(3) DEFAULT NULL,
  `name` char(30) DEFAULT NULL,
  `counsellor` char(3) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `phone` text NOT NULL,
  `sem` varchar(5) DEFAULT NULL,
  `pw` varchar(100) NOT NULL,
  PRIMARY KEY (`usn`),
  KEY `student_ibfk_1` (`dept`),
  KEY `student_ibfk_2` (`counsellor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`usn`, `dept`, `name`, `counsellor`, `email`, `phone`, `sem`, `pw`) VALUES
('1RV12IS001', 'ISE', 'A', 'ABS', '', '', '3', 'cad4eb7c3c6666054fdc245ce1df1032'),
('1RV12IS002', 'ISE', 'B', 'BMS', 'vivekv750@gmail.com', '', '7', 'cd881d3a65a7b360f4375b74349f2809'),
('1RV12IS049', 'ISE', 'A', 'ABS', '', '', '3', '94906e867065bbcd774f0753493ce3cf'),
('1RV12IS051', 'ISE', 'Shyam Kumar S', 'DP', 'shyamks111@gmail.com', '2311', '5', '9ad24f1053c392c0e7d488647c427e77'),
('1RV12IS052', 'ISE', 'Sourabh S', 'DP', 'sourabhshirgur@gmail.com', '2311', '7', '3f8a9202789e9ef231a70f80bdc00747'),
('1RV12IS063', 'ISE', 'VIVEK V', 'GRS', 'vivekv573@gmail.com', '', '5', 'f3f2d4f7fc7a5f5a0b2a1265d99e6736'),
('1RV12IS064', 'ISE', 'Gururaj Bhat', 'DP', 'gurubhatta@gmail.com', '', '7', '390a06875bef80524c31675305cf546a'),
('1RV12IS066', 'ISE', 'Gururaj Bhai', 'DP', 'xyz', '995', '6', 'e8ecc7ee9a39c2ed28984a4becca50e1');

-- --------------------------------------------------------

--
-- Table structure for table `wload`
--

CREATE TABLE IF NOT EXISTS `wload` (
  `name` char(3) NOT NULL DEFAULT '',
  `dept` varchar(3) NOT NULL DEFAULT '',
  `MON` float DEFAULT NULL,
  `TUE` float DEFAULT NULL,
  `WED` float DEFAULT NULL,
  `THU` float DEFAULT NULL,
  `FRI` float DEFAULT NULL,
  `SAT` float DEFAULT NULL,
  `other` float DEFAULT NULL,
  `total` float NOT NULL,
  PRIMARY KEY (`name`,`dept`),
  KEY `dept` (`dept`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wload`
--

INSERT INTO `wload` (`name`, `dept`, `MON`, `TUE`, `WED`, `THU`, `FRI`, `SAT`, `other`, `total`) VALUES
('ABS', 'ISE', 0, 3, 3, 0, 0, 0, 0, 6),
('BKS', 'ISE', 2, 0, 8, 3, 2, 0, 0, 15),
('BMS', 'ISE', 4, 2, 7, 5, 6, 0, 0, 24),
('cd', 'ISE', 0, 0, 0, 0, 0, 0, 5.5, 5.5),
('CRM', 'ISE', 8, 5, 4, 10, 6, 0, 2, 35),
('DP', 'ISE', 0, 0, 3, 3, 0, 0, 0, 6),
('GCN', 'ISE', 5, 5, 2, 5, 0, 0, 0, 17),
('GNS', 'ISE', 2, 0, 2, 3, 2, 0, 0, 9),
('GRS', 'ISE', 4, 0, 3, 0, 0, 0, 4.5, 11.5),
('GSM', 'ISE', 5, 3, 3, 2, 2, 0, 0, 15),
('GV', 'ISE', 6, 3, 0, 3, 0, 0, 0, 12),
('JM', 'ISE', 0, 3, 0, 0, 0, 0, 0, 3),
('KSN', 'ISE', 0, 0, 0, 0, 0, 0, 4, 4),
('MM', 'ISE', 3, 5, 2, 3, 4, 0, 0, 17),
('MMA', 'ISE', 0, 0, 0, 0, 0, 0, 4, 4),
('OT', 'ISE', 8, 4, 8, 4, 4, 2, 0, 30),
('PK', 'ISE', 3, 2, 6, 2, 2, 0, 0, 15),
('PT', 'ISE', 9, 5, 4, 6, 6, 0, 0, 30),
('RBS', 'ISE', 3, 0, 0, 3, 0, 0, 0, 6),
('RMP', 'ISE', 0, 0, 0, 0, 0, 0, 0, 0),
('RMS', 'ISE', 5, 0, 6, 5, 2, 0, 0, 18),
('RR', 'ISE', 3, 2, 6, 2, 2, 0, 0, 15),
('SAD', 'ISE', 0, 0, 0, 0, 0, 0, 4.5, 4.5),
('SGR', 'ISE', 2, 2, 3, 5, 0, 0, 0, 12),
('SN', 'ISE', 3, 0, 3, 0, 0, 0, 0, 6),
('SRN', 'ISE', 5, 2, 2, 5, 0, 0, 0, 14),
('SS', 'ISE', 3, 0, 0, 0, 0, 0, 0, 3),
('VK', 'ISE', 5, 5, 3, 5, 2, 0, 0, 20);

-- --------------------------------------------------------

--
-- Table structure for table `workload`
--

CREATE TABLE IF NOT EXISTS `workload` (
  `type` char(1) NOT NULL,
  `desc` varchar(30) NOT NULL,
  `units` float DEFAULT NULL,
  PRIMARY KEY (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workload`
--

INSERT INTO `workload` (`type`, `desc`, `units`) VALUES
('a', 'AICTE', 2),
('c', 'counsellor', 2),
('g', 'project guide', 1.5),
('i', 'time table incharge', 2),
('l', 'lab-in-charge', 1),
('m', 'NACC', 1),
('n', 'NBA', 2),
('o', 'online entry', 1),
('p', 'placement', 1),
('q', 'TEQIP', 1),
('r', 'proposal', 2.5),
('t', 'class teacher', 1),
('u', 'phd gu', 4.5),
('w', 'web entry', 1),
('x', 'test TTO', 2),
('y', 'library', 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `handles`
--
ALTER TABLE `handles`
  ADD CONSTRAINT `handles_ibfk_1` FOREIGN KEY (`name`) REFERENCES `login` (`Short`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`dept`) REFERENCES `department` (`d_no`),
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`counsellor`) REFERENCES `staff` (`initials`) ON DELETE SET NULL;

--
-- Constraints for table `wload`
--
ALTER TABLE `wload`
  ADD CONSTRAINT `wload_ibfk_1` FOREIGN KEY (`name`) REFERENCES `staff` (`initials`) ON DELETE CASCADE,
  ADD CONSTRAINT `wload_ibfk_2` FOREIGN KEY (`dept`) REFERENCES `department` (`d_no`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
