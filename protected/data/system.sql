-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2015 at 11:45 PM
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
  `parent_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `to_user_id` int(11) DEFAULT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `to_user_id` (`to_user_id`),
  KEY `parent_id` (`parent_id`),
  KEY `parent_id_2` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=116 ;

--
-- Dumping data for table `curhats`
--

INSERT INTO `curhats` (`id`, `parent_id`, `user_id`, `to_user_id`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 1, NULL, 'sebuah curahan hati', '2015-01-21 17:33:46', NULL, NULL),
(2, NULL, 1, NULL, 'mau curhat', '2015-01-21 17:33:46', NULL, NULL),
(3, NULL, 2, 1, 'hi', '2015-01-22 13:04:18', NULL, NULL),
(4, NULL, 1, 2, 'hi juga', '2015-01-22 13:04:18', NULL, NULL),
(5, NULL, 2, NULL, 'makan apa yah hari ini?', '2015-01-22 13:04:58', NULL, NULL),
(6, NULL, 5, NULL, 'mau liburan...', '2015-01-22 13:04:58', NULL, NULL),
(7, NULL, 1, NULL, 'test', '2015-02-02 21:57:25', NULL, NULL),
(64, 1, 1, NULL, 'hasil edit', '2015-02-15 17:58:22', NULL, NULL),
(65, NULL, 1, NULL, 'ini AGP', '2015-02-15 17:58:46', NULL, NULL),
(66, NULL, 1, NULL, 'ini AGP', '2015-02-15 17:59:08', NULL, NULL),
(67, NULL, 1, NULL, 'ini AGP', '2015-02-15 18:00:38', NULL, NULL),
(68, NULL, 1, NULL, 'ini ms girl', '2015-02-17 16:54:30', NULL, NULL),
(69, NULL, 1, NULL, 'ini AGP', '2015-02-18 16:04:45', NULL, NULL),
(70, NULL, 1, NULL, 'ini AGP', '2015-02-18 16:14:56', NULL, NULL),
(92, 1, 1, NULL, '', '2015-02-18 21:38:59', NULL, NULL),
(93, 1, 1, NULL, '', '2015-02-18 21:39:03', NULL, NULL),
(94, NULL, 1, NULL, 'ini AGP', '2015-02-18 21:39:09', NULL, NULL),
(95, 1, 1, NULL, '', '2015-02-18 21:41:13', NULL, NULL),
(96, 1, 1, NULL, '', '2015-02-18 21:41:51', NULL, NULL),
(97, NULL, 1, NULL, 'ini AGP', '2015-02-18 21:42:01', NULL, NULL),
(98, NULL, 1, NULL, 'ini AGP', '2015-02-18 21:42:31', NULL, NULL),
(99, 1, 1, NULL, '', '2015-02-18 21:42:34', NULL, NULL),
(100, 1, 1, NULL, '', '2015-02-18 21:42:44', NULL, NULL),
(101, 1, 1, NULL, '', '2015-02-18 21:42:49', NULL, NULL),
(102, 1, 1, NULL, '', '2015-02-18 21:43:41', NULL, NULL),
(103, 1, 1, NULL, '', '2015-02-18 21:44:16', NULL, NULL),
(104, 1, 1, NULL, '', '2015-02-18 21:44:33', NULL, NULL),
(105, 1, 1, NULL, '', '2015-02-18 21:52:35', NULL, NULL),
(106, 1, 1, NULL, '', '2015-02-18 21:53:40', NULL, NULL),
(107, 1, 1, NULL, 'ini hasil edit', '2015-02-18 22:03:27', NULL, NULL),
(108, 1, 1, NULL, 'ini hasil edit', '2015-02-18 22:03:41', NULL, NULL),
(109, 1, 1, NULL, 'ini hasil edit', '2015-02-18 22:23:16', NULL, NULL),
(110, NULL, 1, NULL, '', '2015-02-19 00:14:51', NULL, NULL),
(111, NULL, 1, NULL, 'ini AGP', '2015-02-19 22:07:38', NULL, NULL),
(112, NULL, 1, NULL, 'ini AGP', '2015-02-19 22:07:56', NULL, NULL),
(113, NULL, 1, NULL, 'ini AGP', '2015-02-19 22:21:56', NULL, NULL),
(114, NULL, 1, NULL, 'ini AGP', '2015-02-19 22:22:35', NULL, NULL),
(115, 1, 1, NULL, 'ini hasil edit', '2015-02-19 22:24:43', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `curhat_attachments`
--

CREATE TABLE IF NOT EXISTS `curhat_attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `curhat_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `curhat_id` (`curhat_id`),
  KEY `image_id` (`image_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `curhat_attachments`
--

INSERT INTO `curhat_attachments` (`id`, `curhat_id`, `image_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 67, 1, '2015-02-15 18:00:38', NULL, NULL),
(2, 68, 2, '2015-02-17 16:54:30', NULL, NULL),
(3, 1, 1, '2015-02-17 16:57:33', NULL, NULL),
(4, 1, 2, '2015-02-17 16:57:33', NULL, NULL),
(5, 69, 3, '2015-02-18 16:04:45', NULL, NULL),
(6, 70, 4, '2015-02-18 16:14:56', NULL, NULL);

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
  PRIMARY KEY (`id`),
  KEY `curhat_id` (`curhat_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `curhat_likes`
--

CREATE TABLE IF NOT EXISTS `curhat_likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `curhat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `curhat_id` (`curhat_id`),
  KEY `image_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- Table structure for table `curhat_pins`
--

CREATE TABLE IF NOT EXISTS `curhat_pins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `curhat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `curhat_id` (`curhat_id`),
  KEY `image_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `curhat_pins`
--

INSERT INTO `curhat_pins` (`id`, `curhat_id`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, '2015-02-19 00:38:58', NULL, NULL),
(2, 2, 1, '2015-02-19 00:39:05', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE IF NOT EXISTS `friends` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `friend_status_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `to_user_id` (`to_user_id`),
  KEY `friend_status_id` (`friend_status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `user_id`, `to_user_id`, `friend_status_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(7, 5, 1, NULL, '2015-02-19 00:53:46', NULL, NULL),
(12, 2, 1, NULL, '2015-02-19 01:48:09', NULL, NULL),
(19, 3, 1, NULL, '2015-02-19 02:06:43', NULL, NULL),
(25, 1, 5, NULL, '2015-02-19 02:08:36', NULL, NULL),
(27, 1, 6, NULL, '2015-02-19 02:32:15', NULL, NULL),
(30, 4, 1, NULL, '2015-02-19 02:44:02', NULL, NULL),
(33, 1, 2, NULL, '2015-02-19 19:18:18', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `friend_statuses`
--

CREATE TABLE IF NOT EXISTS `friend_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `friend_statuses`
--

INSERT INTO `friend_statuses` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'friend', '2015-02-18 23:28:44', NULL, NULL),
(2, 'blocked', '2015-02-18 23:30:24', NULL, NULL),
(3, 'in relationship', '2015-02-18 23:30:24', NULL, NULL),
(4, 'engage', '2015-02-18 23:31:25', NULL, NULL),
(5, 'married', '2015-02-18 23:31:25', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `file_name` text NOT NULL,
  `url` text NOT NULL,
  `size` int(11) NOT NULL,
  `mime` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `title`, `file_name`, `url`, `size`, `mime`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'ok', 'MS%20Girl%20Wing%20Gundam%20Zero.jpg', '6699c88327e3ec3dceb33d7d5d80e6c3.jpg', 117589, 'image/jpeg', '2015-02-15 18:00:38', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'ms girl', 'MS%20Girl%20Wing%20Gundam%20Zero.jpg', 'fe4f4a44fe16609f11924c18ac07a267.jpg', 117589, 'image/jpeg', '2015-02-17 16:54:30', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'AGP', 'MS%20Girl%20Wing%20Gundam%20Zero.jpg', 'f93c483df298abc1017652b70c055f84.jpg', 117589, 'image/jpeg', '2015-02-18 16:04:45', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'AGP', 'MS%20Girl%20Wing%20Gundam%20Zero.jpg', '817ae6b9c535f8eb4c2317e7cfed2ea6.jpg', 117589, 'image/jpeg', '2015-02-18 16:14:56', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, NULL, 'ms%20girl%20wing%20gundam%20ew.jpg', '33247942d0b679cf66752961c37efd6c.jpg', 56957, 'image/jpeg', '2015-02-19 04:23:09', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, NULL, 'ms%20girl%20wing%20gundam%20ew.jpg', 'c43279b1331a947a2e459d247d536263.jpg', 56957, 'image/jpeg', '2015-02-19 04:24:04', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, NULL, 'ms%20girl%20wing%20gundam%20ew.jpg', '06ab9d0b08afed72fa0e894b2718a50d.jpg', 56957, 'image/jpeg', '2015-02-19 04:24:38', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'ok', 'ms%20girl%20wing%20gundam%20ew.jpg', '387a255af42c9214426ac7aafdaed765.jpg', 56957, 'image/jpeg', '2015-02-19 04:25:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'ok', 'ms%20girl%20wing%20gundam%20ew.jpg', '503efaab419b12f51462ae3ef3767a01.jpg', 56957, 'image/jpeg', '2015-02-19 04:26:32', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'ok', 'ms%20girl%20wing%20gundam%20ew.jpg', '7435f20c93d2333b2e751a4bb96a3a17.jpg', 56957, 'image/jpeg', '2015-02-19 04:27:27', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'ok', 'ms%20girl%20wing%20gundam%20ew.jpg', '8a9da092f7e92dc879fc3123e49a639a.jpg', 56957, 'image/jpeg', '2015-02-19 04:27:47', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `log_type_id` int(11) NOT NULL,
  `table_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `log_type_id` (`log_type_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `log_type_id`, `table_id`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 201, 113, 1, '2015-02-19 22:21:56', NULL, NULL),
(2, 201, 114, 1, '2015-02-19 22:22:35', NULL, NULL),
(3, 202, 115, 1, '2015-02-19 22:24:43', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `log_types`
--

CREATE TABLE IF NOT EXISTS `log_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `table_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_types`
--

INSERT INTO `log_types` (`id`, `name`, `table_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(101, 'SIGN_UP', 'users', '2015-02-19 19:03:55', NULL, NULL),
(102, 'SIGN_IN', NULL, '2015-02-19 19:02:48', NULL, NULL),
(103, 'SIGN_OUT', NULL, '2015-02-19 19:02:48', NULL, NULL),
(201, 'SAVE_CURHAT', 'curhats', '2015-02-19 19:05:49', NULL, NULL),
(202, 'UPDATE_CURHAT', 'curhats', '2015-02-19 19:05:49', NULL, NULL),
(203, 'DELETE_CURHAT', 'curhats', '2015-02-19 19:06:07', NULL, NULL),
(301, 'SAVE_CURHAT_COMMENT', 'curhat_comments', '2015-02-19 19:47:12', NULL, NULL),
(302, 'UPDATE_CURHAT_COMMENT', 'curhat_comments', '2015-02-19 19:47:12', NULL, NULL),
(303, 'DELETE_CURHAT_COMMENT', 'curhat_comments', '2015-02-19 19:47:55', NULL, NULL);

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
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `to_user_id` (`to_user_id`)
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
(3, 'luna', '0cc175b9c0f1b6a831c399e269772661', 'info@ies-nusantara.com', 'Ies Nusantara', 'jakarta', '2014-02-08', '', 0, '', '0', '0', 1, 1, 1, '1098785642', '8', 0, '2014-09-14 18:19:00', '0000-00-00 00:00:00', 'fms_sm_member_83071_p11.jpg', '0000-00-00 00:00:00', '2014-09-22 19:09:07', NULL),
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
  ADD CONSTRAINT `curhats_ibfk_3` FOREIGN KEY (`parent_id`) REFERENCES `curhats` (`id`),
  ADD CONSTRAINT `curhats_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `curhats_ibfk_2` FOREIGN KEY (`to_user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `curhat_attachments`
--
ALTER TABLE `curhat_attachments`
  ADD CONSTRAINT `curhat_attachments_ibfk_2` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `curhat_attachments_ibfk_1` FOREIGN KEY (`curhat_id`) REFERENCES `curhats` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `curhat_comments`
--
ALTER TABLE `curhat_comments`
  ADD CONSTRAINT `curhat_comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `curhat_comments_ibfk_1` FOREIGN KEY (`curhat_id`) REFERENCES `curhats` (`id`);

--
-- Constraints for table `curhat_likes`
--
ALTER TABLE `curhat_likes`
  ADD CONSTRAINT `curhat_likes_ibfk_1` FOREIGN KEY (`curhat_id`) REFERENCES `curhats` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `curhat_likes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `curhat_pins`
--
ALTER TABLE `curhat_pins`
  ADD CONSTRAINT `curhat_pins_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `curhat_pins_ibfk_1` FOREIGN KEY (`curhat_id`) REFERENCES `curhats` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friends_ibfk_3` FOREIGN KEY (`friend_status_id`) REFERENCES `friend_statuses` (`id`),
  ADD CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `friends_ibfk_2` FOREIGN KEY (`to_user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_ibfk_5` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `logs_ibfk_4` FOREIGN KEY (`log_type_id`) REFERENCES `log_types` (`id`);

--
-- Constraints for table `private_messages`
--
ALTER TABLE `private_messages`
  ADD CONSTRAINT `private_messages_ibfk_2` FOREIGN KEY (`to_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `private_messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
