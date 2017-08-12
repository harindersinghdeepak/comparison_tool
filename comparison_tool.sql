-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2017 at 02:51 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `comparison_tool`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` int(11) NOT NULL,
  `image_path` varchar(1024) NOT NULL,
  `status` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `album_items`
--

CREATE TABLE `album_items` (
  `id` int(11) NOT NULL,
  `album_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_type` varchar(50) NOT NULL,
  `dimension_x` double(10,6) NOT NULL,
  `dimension_y` double(10,6) NOT NULL,
  `position_x` double(10,6) NOT NULL,
  `position_y` double(10,6) NOT NULL,
  `position_z` double(10,6) NOT NULL,
  `status` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(512) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'category 1', 1, 0, '2017-08-11 00:00:00', '2017-08-11 00:00:00'),
(2, 'category 2', 1, 0, '2017-08-11 00:00:00', '2017-08-11 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `image_name` varchar(1024) DEFAULT NULL,
  `image_size` double(8,2) NOT NULL COMMENT 'in feets',
  `image_category` int(11) NOT NULL,
  `image_type` varchar(512) NOT NULL COMMENT 'item or background',
  `image_path` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `image_name`, `image_size`, `image_category`, `image_type`, `image_path`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, NULL, 0.00, 0, 'background', '/uploadedFiles/backgrounds/1502381871_af5aac155845e889523d038e29da8684--mens-haircuts--mens-hairstyles-with-beard.jpg', 1, 1, '2017-08-10 16:17:51', '2017-08-10 16:17:51'),
(2, NULL, 0.00, 0, 'background', '/uploadedFiles/backgrounds/1502389234_colorful-logo-design-150x150.jpg', 1, 1, '2017-08-10 16:23:34', '2017-08-10 18:20:34'),
(3, NULL, 0.00, 0, 'background', '/uploadedFiles/backgrounds/1502389248_head-659651_960_720.png', 1, 1, '2017-08-10 16:23:35', '2017-08-10 18:20:48'),
(4, NULL, 0.00, 0, 'background', '/uploadedFiles/backgrounds/1502385007_af5aac155845e889523d038e29da8684--mens-haircuts--mens-hairstyles-with-beard.jpg', 1, 1, '2017-08-10 17:00:36', '2017-08-10 17:10:07'),
(5, NULL, 0.00, 0, 'background', '/uploadedFiles/backgrounds/1502384465_20431724_1808175552531283_3896578854741076766_n.jpg', 1, 1, '2017-08-10 17:01:05', '2017-08-10 17:01:05'),
(6, NULL, 0.00, 0, 'background', '/uploadedFiles/backgrounds/1502389266_portrait_user.png', 1, 1, '2017-08-10 18:21:06', '2017-08-10 18:21:06'),
(7, NULL, 0.00, 0, 'background', '/uploadedFiles/backgrounds/1502389266_flowers-were-made-for-Her.jpg', 1, 1, '2017-08-10 18:21:06', '2017-08-10 18:21:06'),
(8, NULL, 0.00, 0, 'background', '/uploadedFiles/backgrounds/1502389552_1.jpg', 1, 1, '2017-08-10 18:23:54', '2017-08-10 18:25:52'),
(9, NULL, 0.00, 0, 'background', '/uploadedFiles/backgrounds/1502389456_af5aac155845e889523d038e29da8684--mens-haircuts--mens-hairstyles-with-beard.jpg', 1, 1, '2017-08-10 18:24:16', '2017-08-10 18:24:16'),
(10, NULL, 0.00, 0, 'background', '/uploadedFiles/backgrounds/1502389541_colorful-logo-design-150x150.jpg', 1, 1, '2017-08-10 18:25:41', '2017-08-10 18:25:41'),
(11, NULL, 0.00, 0, 'background', '/uploadedFiles/backgrounds/1502389573_x2-28-1501226687.jpg.pagespeed.ic.zeRrRc_iMW.jpg', 1, 1, '2017-08-10 18:26:13', '2017-08-10 18:26:13'),
(12, NULL, 0.00, 0, 'background', '/uploadedFiles/backgrounds/1502389654_x2-28-1501226687.jpg.pagespeed.ic.zeRrRc_iMW.jpg', 1, 1, '2017-08-10 18:27:27', '2017-08-10 18:27:34'),
(13, NULL, 0.00, 0, 'background', '/uploadedFiles/backgrounds/1502390365_colorful-logo-design-150x150.jpg', 1, 1, '2017-08-10 18:39:25', '2017-08-10 18:39:25'),
(15, NULL, 0.00, 0, 'background', '/uploadedFiles/backgrounds/1502524011_golden-floral-vector-frame.svg', 1, 0, '2017-08-12 07:46:51', '2017-08-12 07:46:51'),
(16, NULL, 0.00, 0, 'background', '/uploadedFiles/backgrounds/1502524467_049.wmf', 1, 0, '2017-08-12 07:54:27', '2017-08-12 07:54:27'),
(17, NULL, 0.00, 0, 'background', '/uploadedFiles/backgrounds/1502525532_butterflies2.dxf', 1, 0, '2017-08-12 08:12:12', '2017-08-12 08:12:12'),
(18, '', 123.00, 0, 'item', '/uploadedFiles/library/1502533118_af5aac155845e889523d038e29da8684--mens-haircuts--mens-hairstyles-with-beard.jpg', 1, 0, '2017-08-12 10:19:02', '2017-08-12 10:19:02'),
(19, 'hgg', 36.00, 2, 'item', '/uploadedFiles/library/1502533118_1.jpg', 1, 0, '2017-08-12 10:19:34', '2017-08-12 10:19:34'),
(20, '', 52.00, 1, 'item', '/uploadedFiles/library/1502537045_colorful-logo-design-150x150.jpg', 1, 0, '2017-08-12 11:24:25', '2017-08-12 11:24:25'),
(21, '', 12.00, 0, 'item', '/uploadedFiles/library/1502539129_1.jpg', 1, 0, '2017-08-12 11:58:58', '2017-08-12 11:58:58'),
(22, '', 25.00, 0, 'item', '/uploadedFiles/library/1502539333_head-659651_960_720.png', 1, 0, '2017-08-12 12:02:40', '2017-08-12 12:02:40'),
(23, '', 25.00, 0, 'item', '/uploadedFiles/library/1502539333_portrait_user.png', 1, 0, '2017-08-12 12:02:50', '2017-08-12 12:02:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(75) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'developer', '', 'developer', 'developer@gamil.com', '5f4dcc3b5aa765d61d8327deb882cf99', 1, 0, '2017-08-12 00:00:00', '2017-08-12 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `album_items`
--
ALTER TABLE `album_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album_items`
--
ALTER TABLE `album_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
