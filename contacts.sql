-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2014 at 07:15 AM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `contacts`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `contact_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `second_name` varchar(50) NOT NULL,
  `email_address` varchar(50) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  PRIMARY KEY (`contact_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`contact_id`, `first_name`, `second_name`, `email_address`, `phone_number`) VALUES
(16, 'gideon', 'kosgei', 'gideonkosgei@yahoo.com', '0727991654'),
(17, 'mark', 'sirma', 'm@yahoo.com', '0743786534'),
(18, 'Judy', 'Wamboi', 'wamboh@gmail.com', '0723897678'),
(19, 'Dennis', 'Tall', 'tall@rocketmail.com', '0723786534'),
(20, 'Steve', 'Miller', 'smiller@skimmer.com', '0734566778'),
(23, 'Jushua', 'Ole', 'ole@yahoo.com', '0988789326'),
(24, 'object', 'oriented', 'oo@yahoo.com', '0756342312'),
(25, 'Special', 'One', 'special@one.com', '0723453432'),
(26, 'stamford', 'bridge', 'chelsea@uefacampions.com', '0765342312');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(50) NOT NULL,
  `group_description` varchar(200) NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`group_id`, `group_name`, `group_description`) VALUES
(10, 'school', 'class members'),
(36, 'Default', 'group used by application'),
(37, 'Family', 'Family Members Only'),
(39, 'Work', 'Work mates'),
(40, 'Home', 'Home contacts'),
(42, 'miscellaneous', 'ungrouped Contacts'),
(43, 'friends', 'my buddies'),
(45, 'Anonymous', 'people I dont know');

-- --------------------------------------------------------

--
-- Table structure for table `group_members`
--

CREATE TABLE IF NOT EXISTS `group_members` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  PRIMARY KEY (`member_id`),
  KEY `group_id` (`group_id`,`contact_id`),
  KEY `contact_id` (`contact_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `group_members`
--

INSERT INTO `group_members` (`member_id`, `group_id`, `contact_id`) VALUES
(35, 10, 16),
(36, 10, 17),
(37, 10, 18),
(38, 10, 19),
(39, 10, 20),
(44, 39, 16),
(45, 39, 20),
(46, 39, 24),
(48, 40, 19),
(49, 40, 23),
(50, 40, 24),
(40, 43, 23),
(41, 43, 24),
(42, 43, 25),
(43, 43, 26),
(47, 45, 26);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `group_members`
--
ALTER TABLE `group_members`
  ADD CONSTRAINT `group_members_ibfk_2` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`contact_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `group_members_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
