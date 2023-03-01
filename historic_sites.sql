-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 01, 2023 at 05:40 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tour_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `historic_sites`
--

CREATE TABLE `historic_sites` (
  `id` int(11) NOT NULL,
  `img1_fname` text NOT NULL,
  `img1_altText` text NOT NULL,
  `img1_caption` text NOT NULL,
  `img2_fname` text NOT NULL,
  `img2_altText` text NOT NULL,
  `img2_caption` text NOT NULL,
  `title` text NOT NULL,
  `text1` text NOT NULL,
  `text2` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='table for the templates';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `historic_sites`
--
ALTER TABLE `historic_sites`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
