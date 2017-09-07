-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 07, 2017 at 05:03 PM
-- Server version: 5.7.19-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `weiphp`
--

-- --------------------------------------------------------

--
-- Table structure for table `wx_template`
--

CREATE TABLE `wx_template` (
  `id` int(11) NOT NULL,
  `template_id` varchar(255) NOT NULL,
  `first` varchar(255) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `keyword1` varchar(255) NOT NULL,
  `keyword2` varchar(255) NOT NULL,
  `keyword3` varchar(255) DEFAULT NULL,
  `keyword4` varchar(255) DEFAULT NULL,
  `keyword5` varchar(255) DEFAULT NULL,
  `url` text NOT NULL,
  `project` varchar(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wx_template`
--

INSERT INTO `wx_template` (`id`, `template_id`, `first`, `remark`, `keyword1`, `keyword2`, `keyword3`, `keyword4`, `keyword5`, `url`, `project`) VALUES
(63, 'MvZQDblBptLFcOxcU7i5aqxON0wetP9AZF4UzBRtkZI', 'w16', 'w16', 'w16', 'w16', 'w16', 'w16', 'w16', 'http://www.baidu.com', 'w16'),
(64, 'eeUbDCs-qlGL3Wb3vjWPxA-9Zx3HL8V_q_6Bpfqsm1E', 'w17', 'w17', 'w17', 'w17', 'w17', 'w17', 'w17', 'http://www.baidu.com', 'w17'),
(65, 'YnEoyv7ShB0U6Am3S5mvhHqGN8yNKLW5pQ5If4LL24w', 'w16-2', 'w16-2', 'w16-2', 'w16-2', NULL, NULL, NULL, 'http://www.baidu.com', 'w16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wx_template`
--
ALTER TABLE `wx_template`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wx_template`
--
ALTER TABLE `wx_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
