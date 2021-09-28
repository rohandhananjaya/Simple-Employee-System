-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2021 at 12:15 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sys_db`
--
CREATE DATABASE IF NOT EXISTS `sys_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sys_db`;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `timest` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `fname`, `lname`, `phone`, `email`, `timest`) VALUES
(1, 'Ruwan', 'Chamara', '0713662458', 'abc@123.com', '2021-09-27 21:11:08'),
(2, 'Jahan', 'Macrove', '0716525627', 'deloleci@coin-one.com', '2021-09-27 21:11:10'),
(3, 'Janaki', 'Perera', '0725648898', 'janaki78@gmail.com', '2021-09-27 21:12:56'),
(4, 'Binura', 'Maleesha', '0758947584', 'binuramal@wer.com', '2021-09-27 21:15:35'),
(5, 'Mihiri', 'Ekanayaka', '0716525627', 'mihiri@rt.com', '2021-09-27 17:48:09'),
(6, 'Sudath', 'Jananayaka', '0789587454', 'sudath@er.com', '2021-09-27 18:12:30'),
(7, 'Janith', 'Perera', '0457896321', 'janith45@gmail.com', '2021-09-28 03:41:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fname` varchar(50) DEFAULT '(Not Set)',
  `lname` varchar(50) DEFAULT '(Not Set)',
  `phone` varchar(12) DEFAULT '(Not Set)',
  `email` varchar(50) DEFAULT '(Not Set)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='System Users';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `fname`, `lname`, `phone`, `email`) VALUES
('admin', '123', '(Not Set)', '(Not Set)', '(Not Set)', '(Not Set)'),
('admin_2', '456', 'Sudath', 'Madusanka', '0726547894', 'sudath@er.com'),
('invismic', '456', 'Rohan', 'Dhananjaya', '+94716625729', 'rohandhananjaya@gmail.com'),
('pertrade', '789', 'Sherrie', 'Hedrick', '+94716525627', 'deloleci@coin-one.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
