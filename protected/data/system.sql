-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2015 at 07:48 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `system`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE IF NOT EXISTS `ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `descr` text NOT NULL,
  `img_url` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `user_id`, `title`, `descr`, `img_url`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'icodea', 'Icodea for simple sharing file around the world', 'sch_tc_ads_71716_1.png', '0000-00-00 00:00:00', '2014-05-08 11:02:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `curhats`
--

CREATE TABLE IF NOT EXISTS `curhats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `to_user_id` int(11) DEFAULT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `to_user_id` (`to_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=77 ;

--
-- Dumping data for table `curhats`
--

INSERT INTO `curhats` (`id`, `user_id`, `to_user_id`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, NULL, 'sebuah curahan hati', '2015-01-21 17:33:46', NULL, NULL),
(2, 1, NULL, 'mau curhat', '2015-01-21 17:33:46', NULL, NULL),
(3, 2, 1, 'hi', '2015-01-22 13:04:18', NULL, NULL),
(4, 1, 2, 'hi juga', '2015-01-22 13:04:18', NULL, NULL),
(5, 2, NULL, 'makan apa yah hari ini?', '2015-01-22 13:04:58', NULL, NULL),
(6, 5, NULL, 'mau liburan...', '2015-01-22 13:04:58', NULL, NULL),
(7, 1, NULL, 'test', '2015-02-02 21:57:25', NULL, NULL),
(14, 1, NULL, 'test', '2015-02-02 22:04:00', NULL, NULL),
(15, 1, NULL, 'test', '2015-02-02 22:04:13', NULL, NULL),
(32, 1, NULL, 'test', '2015-02-02 22:16:02', NULL, NULL),
(33, 1, NULL, 'test', '2015-02-02 22:16:05', NULL, NULL),
(34, 1, NULL, 'test', '2015-02-02 22:16:37', NULL, NULL),
(67, 1, NULL, 'mau curhat~', '2015-02-02 22:36:30', NULL, NULL),
(68, 2, NULL, 'mau curhat juga~', '2015-02-02 22:37:56', NULL, NULL),
(69, 1, NULL, 'mau curhat~', '2015-02-07 20:15:21', NULL, NULL),
(70, 1, 2, 'mau curhat~', '2015-02-07 20:21:58', NULL, NULL),
(72, 1, NULL, 'mau curhat~', '2015-02-08 01:21:59', NULL, NULL),
(73, 1, NULL, 'mau curhat~', '2015-02-08 01:22:08', NULL, NULL),
(74, 1, NULL, 'mau curhat~', '2015-02-08 10:14:29', NULL, NULL),
(75, 1, NULL, 'mau curhat~', '2015-02-08 11:17:25', NULL, NULL),
(76, 1, NULL, 'mau curhat~', '2015-02-08 11:43:59', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `curhat_attachment`
--

CREATE TABLE IF NOT EXISTS `curhat_attachment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `curhat_id` int(11) NOT NULL,
  `curhat_image_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `curhat_id` (`curhat_id`),
  KEY `image_id` (`curhat_image_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Table structure for table `curhat_comments`
--

CREATE TABLE IF NOT EXISTS `curhat_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `curhat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `friend_requests`
--

CREATE TABLE IF NOT EXISTS `friend_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `friend_request_status_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `file_name` text NOT NULL,
  `url` text NOT NULL,
  `size` int(11) NOT NULL,
  `mime` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `private_messages`
--

CREATE TABLE IF NOT EXISTS `private_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tiles`
--

CREATE TABLE IF NOT EXISTS `tiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `font_size` varchar(255) NOT NULL,
  `font_color` varchar(255) NOT NULL,
  `background_color` varchar(255) NOT NULL,
  `border_color` varchar(255) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tile_size_presets`
--

CREATE TABLE IF NOT EXISTS `tile_size_presets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `width_ratio` int(11) NOT NULL,
  `height_ratio` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tile_size_presets`
--

INSERT INTO `tile_size_presets` (`id`, `title`, `width`, `height`, `width_ratio`, `height_ratio`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Custom', 0, 0, 0, 0, '0000-00-00 00:00:00', '2014-09-06 16:45:14', NULL),
(2, '1:1', 640, 640, 1, 1, '0000-00-00 00:00:00', '2014-09-06 16:45:16', NULL),
(3, '4:3', 640, 480, 4, 3, '0000-00-00 00:00:00', '2014-09-06 16:45:17', NULL),
(4, '16:9', 640, 360, 16, 9, '0000-00-00 00:00:00', '2014-09-06 16:45:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `place_of_birth` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `address` text NOT NULL,
  `city_id` int(11) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `religion_id` int(11) NOT NULL,
  `marital_status_id` int(11) NOT NULL,
  `nationality_id` int(11) NOT NULL,
  `identification_number` varchar(255) NOT NULL,
  `user_details` text NOT NULL,
  `is_online` int(11) NOT NULL,
  `last_seen` datetime NOT NULL,
  `last_login` datetime NOT NULL,
  `img_url` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `full_name`, `place_of_birth`, `date_of_birth`, `address`, `city_id`, `postal_code`, `phone_number`, `mobile_number`, `religion_id`, `marital_status_id`, `nationality_id`, `identification_number`, `user_details`, `is_online`, `last_seen`, `last_login`, `img_url`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'mf', '0cc175b9c0f1b6a831c399e269772661', 'febri@icodea.com', 'Muhammad Febriansyah', 'jakarta', '1991-02-21', 'Jalan Arimbi', 1, '10540', '02189090112', '08989090112', 1, 2, 2, '10453210219910201', '3;1;4;2;7', 1, '2015-01-18 10:47:59', '2014-05-16 17:58:10', 'fms_sm_member_74694_brown-and-white-cartoon-cow-hi.png', '0000-00-00 00:00:00', '2015-01-18 03:47:59', NULL),
(2, 'inara', '0cc175b9c0f1b6a831c399e269772661', 'a@YAHOO.COM', 'inara risyah', '0', '0000-00-00', '', 0, '', '0', '0', 1, 2, 1, '08080808009', '3;6', 1, '2014-10-10 01:39:02', '0000-00-00 00:00:00', 'fms_sm_member_25817_p21.jpg', '0000-00-00 00:00:00', '2014-10-09 18:39:02', NULL),
(3, 'iesn', '0cc175b9c0f1b6a831c399e269772661', 'info@ies-nusantara.com', 'Ies Nusantara', 'jakarta', '2014-02-08', '', 0, '', '0', '0', 1, 1, 1, '1098785642', '8', 0, '2014-09-14 18:19:00', '0000-00-00 00:00:00', 'fms_sm_member_83071_p11.jpg', '0000-00-00 00:00:00', '2014-09-22 19:09:07', NULL),
(4, 'Saiz', '0cc175b9c0f1b6a831c399e269772661', 'saiz@icodea.com', 'saiz van evanz', 'jakarta', '2014-02-01', '', 0, '', '0', '0', 1, 2, 1, '10453210219910201', '8', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'fms_sm_member_53042_m1.jpg', '0000-00-00 00:00:00', '2014-05-16 10:46:58', NULL),
(5, 'Cruzt', '0cc175b9c0f1b6a831c399e269772661', 'cruzt@icodea.com', 'Cruzt Ryan', 'jakarta', '0000-00-00', '', 0, '', '0', '0', 1, 2, 1, '10453210219910201', '3', 0, '2014-05-22 03:34:16', '0000-00-00 00:00:00', 'fms_sm_member_74005_m3.jpg', '0000-00-00 00:00:00', '2014-09-22 19:09:07', NULL),
(6, 'Fiyina', '0cc175b9c0f1b6a831c399e269772661', 'fiyina@icodea.com', 'Yuna Fiyina', 'jakarta', '2014-02-01', '', 0, '', '0', '0', 1, 2, 1, '10453210219910201', '8', 0, '2014-09-14 05:18:34', '0000-00-00 00:00:00', 'fms_sm_member_73117_p2.jpg', '0000-00-00 00:00:00', '2014-09-22 19:09:07', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `curhats`
--
ALTER TABLE `curhats`
  ADD CONSTRAINT `curhats_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `curhats_ibfk_2` FOREIGN KEY (`to_user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `curhat_attachment`
--
ALTER TABLE `curhat_attachment`
  ADD CONSTRAINT `curhat_attachment_ibfk_2` FOREIGN KEY (`curhat_image_id`) REFERENCES `images` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `curhat_attachment_ibfk_1` FOREIGN KEY (`curhat_id`) REFERENCES `curhats` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
