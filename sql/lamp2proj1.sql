-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2017 at 04:19 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lamp2proj1`
--

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` bigint(20) NOT NULL,
  `description` text,
  `priority` int(11) DEFAULT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `dateCompleted` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `description`, `priority`, `dateCreated`, `completed`, `dateCompleted`) VALUES
(17, 'hey go to the school', 3, '2017-02-16 01:38:18', 1, '2017-02-16 16:23:51'),
(18, 'lets go to the dinner', 4, '2017-02-16 02:25:41', 1, '2017-02-21 19:48:23'),
(19, 'fix the problem', 5, '2017-02-16 02:26:05', 1, '2017-02-21 20:00:05'),
(22, 'go to the work', 4, '2017-02-16 16:36:43', 0, NULL),
(23, 'visit a friend', 4, '2017-02-21 19:45:19', 0, NULL),
(27, 'send email to my customer', 4, '2017-02-24 17:14:50', 0, NULL),
(33, 'submit the project files', 5, '2017-02-26 16:15:40', 1, '2017-02-26 16:15:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
