-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 20, 2016 at 10:26 PM
-- Server version: 5.5.49-0+deb8u1-log
-- PHP Version: 5.6.22-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `outadev`
--

-- --------------------------------------------------------

--
-- Table structure for table `Category`
--

CREATE TABLE `Category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_name_long` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Download`
--

CREATE TABLE `Download` (
  `project_id` int(11) NOT NULL,
  `platform_id` int(11) NOT NULL DEFAULT '0',
  `download_url` varchar(512) COLLATE utf8mb4_unicode_ci NOT NULL,
  `download_source_url` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `download_price` decimal(10,2) NOT NULL,
  `download_version` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Platform`
--

CREATE TABLE `Platform` (
  `platform_id` int(11) NOT NULL,
  `platform_name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Project`
--

CREATE TABLE `Project` (
  `project_id` int(11) NOT NULL,
  `project_name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_simple_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_description_short` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_description_short_fr` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_description_fr` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_start_year` year(4) DEFAULT NULL,
  `project_end_year` year(4) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `project_featured` tinyint(1) NOT NULL DEFAULT '0',
  `project_visible` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Category`
--
ALTER TABLE `Category`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `Download`
--
ALTER TABLE `Download`
  ADD PRIMARY KEY (`project_id`,`platform_id`),
  ADD KEY `platform_id` (`platform_id`);

--
-- Indexes for table `Platform`
--
ALTER TABLE `Platform`
  ADD PRIMARY KEY (`platform_id`);

--
-- Indexes for table `Project`
--
ALTER TABLE `Project`
  ADD PRIMARY KEY (`project_id`),
  ADD UNIQUE KEY `project_name_normalized` (`project_simple_name`),
  ADD KEY `project_name_normalized_2` (`project_simple_name`),
  ADD KEY `project_simple_name` (`project_simple_name`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Category`
--
ALTER TABLE `Category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `Platform`
--
ALTER TABLE `Platform`
  MODIFY `platform_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `Project`
--
ALTER TABLE `Project`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
