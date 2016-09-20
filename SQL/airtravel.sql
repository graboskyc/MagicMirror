-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2016 at 05:25 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `airtravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `airports`
--

CREATE TABLE `airports` (
  `oid` int(4) DEFAULT NULL,
  `name` varchar(70) DEFAULT NULL,
  `alias` varchar(39) DEFAULT NULL,
  `country` varchar(32) DEFAULT NULL,
  `iata` varchar(3) DEFAULT NULL,
  `icao` varchar(4) DEFAULT NULL,
  `lat` decimal(31,12) DEFAULT NULL,
  `longi` decimal(33,14) DEFAULT NULL,
  `COL 9` int(5) DEFAULT NULL,
  `COL 10` decimal(5,2) DEFAULT NULL,
  `active` varchar(1) DEFAULT NULL,
  `tz` varchar(22) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

CREATE TABLE `flights` (
  `dt` varchar(19) DEFAULT NULL,
  `fromap` varchar(4) DEFAULT NULL,
  `toap` varchar(3) DEFAULT NULL,
  `flightnum` varchar(13) DEFAULT NULL,
  `arline` varchar(17) DEFAULT NULL,
  `distance` int(8) DEFAULT NULL,
  `duration` varchar(8) DEFAULT NULL,
  `seat` varchar(4) DEFAULT NULL,
  `seattype` varchar(9) DEFAULT NULL,
  `class` varchar(5) DEFAULT NULL,
  `reason` varchar(6) DEFAULT NULL,
  `plane` varchar(37) DEFAULT NULL,
  `registration` varchar(12) DEFAULT NULL,
  `trip` varchar(4) DEFAULT NULL,
  `note` varchar(13) DEFAULT NULL,
  `From_OID` varchar(8) DEFAULT NULL,
  `To_OID` varchar(6) DEFAULT NULL,
  `Airline_OID` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
