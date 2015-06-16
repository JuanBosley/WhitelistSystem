-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2015 at 09:37 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `whitelist_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `whitelist`
--

CREATE TABLE IF NOT EXISTS `whitelist` (
`id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `age` int(3) NOT NULL,
  `email` varchar(50) NOT NULL,
  `comment` text NOT NULL,
  `approved` int(2) NOT NULL,
  `reddit` varchar(40) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `whitelist`
--

INSERT INTO `whitelist` (`id`, `username`, `age`, `email`, `comment`, `approved`, `reddit`) VALUES
(10, 'test', 123, 'test@mail.com', 'My application', 0, 'JustAnotherUser_1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `whitelist`
--
ALTER TABLE `whitelist`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `whitelist`
--
ALTER TABLE `whitelist`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
