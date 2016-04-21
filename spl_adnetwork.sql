
-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2016 at 11:13 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.5.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adnetwork`
--

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE DATABASE IF NOT EXISTS adnetwork;
USE adnetwork;


CREATE TABLE `banner` (
  `BannerId` int(11) NOT NULL,
  `BannerPrice` int(11) NOT NULL,
  `BannerFormat` int(11) NOT NULL,
  `BannerWidth` int(11) NOT NULL,
  `BannerHeight` int(11) NOT NULL,
  `BannerMethod` int(11) NOT NULL,
  `BannerInfo` varchar(500) NOT NULL,
  `BannerStatus` int(11) NOT NULL DEFAULT '1',
  `UserId` int(11) NOT NULL,
  `BannerCreateTimestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`BannerId`, `BannerPrice`, `BannerFormat`, `BannerWidth`, `BannerHeight`, `BannerMethod`, `BannerInfo`, `BannerStatus`, `UserId`, `BannerCreateTimestamp`) VALUES
  (2, 1500, 101, 300, 250, 1, '{"title":"Banner 300x250 testing","file":"//placehold.it/300x250","url":"http://vnexpress.net"}', 2, 6, '2016-04-15 15:01:52'),
  (3, 1200, 101, 300, 250, 1, '{"title":"Banner 300x250 testing","mediaFile":"//static.eclick.vn/uploads/thumb/2016/04/14/1634w757510o8429jo5416l48.mp4","file":"//placehold.it/300x250","url":"http://vnexpress.net"}', 2, 6, '2016-04-15 15:01:52'),
  (4, 1200, 101, 300, 250, 1, '{"title":"Banner 300x250 testing","mediaFile":"//static.eclick.vn/uploads/thumb/2016/04/14/1634w757510o8429jo5416l48.mp4","file":"//placehold.it/300x250","url":"http://vnexpress.net"}', 2, 6, '2016-04-15 15:01:52'),
  (6, 1200, 101, 300, 250, 1, '{"title":"Banner 300x250 testing","file":"//placehold.it/300x250","url":"http://vnexpress.net"}', 2, 37, '2016-04-15 15:01:52'),
  (7, 1300, 101, 300, 250, 1, '{"title":"Banner 300x250 testing","file":"//placehold.it/300x250","url":"http://vnexpress.net"}', 2, 1, '2016-04-15 15:01:52'),
  (8, 1300, 202, 480, 270, 2, '{"title":"Banner 480x270 testing","mediaFile":"//static.eclick.vn/uploads/thumb/2016/04/14/1634w757510o8429jo5416l48.mp4","file":"//www.welovemercuri.com/images/coca-cola_cialde.jpg","url":"http://vnexpress.net"}', 2, 1, '2016-04-15 15:01:52'),
  (9, 1000, 202, 480, 270, 2, '{"title":"Banner Video","file":"\\/\\/placehold.it\\/480x270","url":"http://vnexpress.net","mediaFile":"\\/\\/static.eclick.vn\\/uploads\\/thumb\\/2016\\/04\\/14\\/1634w757510o8429jo5416l48.mp4"}', 2, 6, '2016-04-20 14:12:29');

-- --------------------------------------------------------

--
-- Table structure for table `clickdetail`
--

CREATE TABLE `clickdetail` (
  `ClickId` int(11) NOT NULL,
  `ClickTimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ClickPrice` int(11) NOT NULL,
  `ClickUrl` varchar(100) NOT NULL,
  `BannerId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clickdetail`
--

INSERT INTO `clickdetail` (`ClickId`, `ClickTimestamp`, `ClickPrice`, `ClickUrl`, `BannerId`) VALUES
  (13, '2016-04-21 07:14:04', 1300, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', 7),
  (14, '2016-04-21 07:14:53', 1300, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', 7),
  (15, '2016-04-21 07:17:17', 1300, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', 8),
  (16, '2016-04-21 09:35:20', 1500, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', 2),
  (17, '2016-04-21 09:35:28', 1200, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', 4),
  (18, '2016-04-21 10:20:17', 1200, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', 4),
  (19, '2016-04-21 10:20:20', 1300, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', 8),
  (20, '2016-04-21 10:20:27', 1300, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', 7),
  (21, '2016-04-21 10:20:29', 1300, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', 8),
  (22, '2016-04-21 10:20:37', 1200, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', 6),
  (23, '2016-04-21 10:20:41', 1000, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', 9),
  (24, '2016-04-21 10:20:46', 1000, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', 9),
  (25, '2016-04-21 10:21:23', 1000, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', 9),
  (26, '2016-04-21 10:32:08', 1000, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', 9),
  (27, '2016-04-21 10:32:19', 1000, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', 9),
  (28, '2016-04-21 10:32:22', 1500, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', 2);

-- --------------------------------------------------------

--
-- Table structure for table `impression`
--

CREATE TABLE `impression` (
  `ImpId` int(11) NOT NULL,
  `ZoneId` int(11) NOT NULL,
  `BannerId` int(11) NOT NULL,
  `ImpUrl` varchar(100) NOT NULL,
  `ImpTimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `impression`
--

INSERT INTO `impression` (`ImpId`, `ZoneId`, `BannerId`, `ImpUrl`, `ImpTimestamp`) VALUES
  (2, 5, 8, 'http://localhost:63342/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-15 09:46:25'),
  (3, 5, 8, 'http://localhost:63342/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-15 09:46:34'),
  (4, 5, 8, 'http://localhost:63342/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-15 09:47:23'),
  (5, 5, 8, 'http://localhost:63342/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-15 09:48:14'),
  (6, 5, 8, 'http://localhost:63342/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-15 09:48:47'),
  (7, 5, 8, 'http://localhost:63342/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-15 09:49:30'),
  (8, 5, 8, 'http://localhost:63342/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-15 09:51:09'),
  (9, 5, 8, 'http://localhost:63342/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-15 09:51:25'),
  (10, 5, 8, 'http://localhost:63342/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-15 09:51:40'),
  (11, 5, 8, 'http://localhost:63342/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-15 10:55:32'),
  (12, 5, 9, 'http://localhost:63342/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:20:54'),
  (13, 5, 8, 'http://localhost:63342/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:22:34'),
  (14, 5, 9, 'http://localhost:63342/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:22:41'),
  (15, 5, 8, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:24:14'),
  (16, 5, 8, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:25:18'),
  (17, 5, 9, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:25:39'),
  (18, 5, 9, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:25:40'),
  (19, 5, 9, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:26:08'),
  (20, 5, 8, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:27:16'),
  (21, 5, 9, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:27:45'),
  (22, 5, 8, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:30:32'),
  (23, 6, 7, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:30:33'),
  (24, 5, 9, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:33:08'),
  (25, 6, 7, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:33:08'),
  (26, 6, 2, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:33:41'),
  (27, 5, 8, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:33:41'),
  (28, 6, 7, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:34:02'),
  (29, 5, 9, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:34:02'),
  (30, 5, 9, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:36:11'),
  (31, 6, 7, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:36:12'),
  (32, 6, 7, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:36:15'),
  (33, 6, 7, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:36:16'),
  (34, 5, 9, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:36:16'),
  (35, 6, 7, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:38:40'),
  (36, 5, 9, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:38:40'),
  (37, 6, 7, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:48:28'),
  (38, 5, 9, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:48:28'),
  (39, 6, 2, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:48:55'),
  (40, 5, 8, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:48:55'),
  (41, 5, 8, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:50:50'),
  (42, 6, 2, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:50:50'),
  (43, 5, 8, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:50:59'),
  (44, 6, 7, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:50:59'),
  (45, 5, 8, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:53:05'),
  (46, 6, 7, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:53:05'),
  (47, 5, 9, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 10:51:35'),
  (48, 6, 7, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 10:51:35'),
  (49, 5, 9, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 10:51:43'),
  (50, 6, 7, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 11:20:07'),
  (51, 5, 9, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 11:20:14'),
  (52, 6, 2, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 11:20:14'),
  (53, 5, 9, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 11:20:18'),
  (54, 6, 2, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 11:20:22'),
  (55, 5, 8, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 11:20:22'),
  (56, 6, 7, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-21 07:13:14'),
  (57, 5, 8, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-21 07:13:14'),
  (58, 5, 8, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-21 07:16:56'),
  (59, 6, 3, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-21 07:16:57'),
  (60, 5, 8, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-21 09:35:05'),
  (61, 6, 4, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-21 09:35:05'),
  (62, 5, 8, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-21 09:35:12'),
  (63, 6, 4, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-21 09:35:13'),
  (64, 6, 2, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-21 09:35:16'),
  (65, 5, 8, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-21 09:35:16'),
  (66, 5, 8, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-21 09:35:25'),
  (67, 6, 4, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-21 09:35:25'),
  (68, 6, 7, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-21 10:20:24'),
  (69, 5, 8, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-21 10:20:24'),
  (70, 6, 6, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-21 10:20:35'),
  (71, 5, 9, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-21 10:20:35'),
  (72, 5, 8, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-21 10:26:47'),
  (73, 6, 2, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-21 10:26:47'),
  (74, 6, 2, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-21 10:27:02'),
  (75, 5, 8, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-21 10:27:05'),
  (76, 5, 8, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-21 10:27:09'),
  (77, 5, 8, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-21 10:27:28'),
  (78, 6, 3, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-21 10:27:28'),
  (79, 5, 9, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-21 10:27:43'),
  (80, 6, 3, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-21 10:27:43'),
  (81, 5, 9, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-21 10:32:06'),
  (82, 6, 2, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-21 10:32:06');

-- --------------------------------------------------------

--
-- Table structure for table `trueview`
--

CREATE TABLE `trueview` (
  `TrueviewId` int(11) NOT NULL,
  `ZoneId` int(11) NOT NULL,
  `BannerId` int(11) NOT NULL,
  `TrueviewUrl` varchar(100) NOT NULL,
  `TrueviewTimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trueview`
--

INSERT INTO `trueview` (`TrueviewId`, `ZoneId`, `BannerId`, `TrueviewUrl`, `TrueviewTimestamp`) VALUES
  (1, 5, 0, 'http://localhost:63342/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-15 09:51:09'),
  (2, 5, 0, 'http://localhost:63342/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-15 09:51:25'),
  (3, 5, 0, 'http://localhost:63342/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-15 09:51:45'),
  (4, 5, 0, 'http://localhost:63342/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-15 10:55:32'),
  (5, 5, 0, 'http://localhost:63342/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:20:54'),
  (6, 5, 0, 'http://localhost:63342/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:22:34'),
  (7, 5, 0, 'http://localhost:63342/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:22:41'),
  (8, 5, 0, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:24:14'),
  (9, 5, 0, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:25:18'),
  (10, 5, 0, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:25:39'),
  (11, 5, 0, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:25:40'),
  (12, 5, 0, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:26:08'),
  (13, 5, 0, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:27:16'),
  (14, 5, 0, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:27:45'),
  (15, 5, 0, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:30:32'),
  (16, 6, 0, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:30:33'),
  (17, 5, 0, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:33:09'),
  (18, 5, 0, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:33:41'),
  (19, 5, 0, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:34:02'),
  (20, 5, 0, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:38:40'),
  (21, 6, 0, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:38:43'),
  (22, 5, 0, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:48:29'),
  (23, 6, 0, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:48:29'),
  (24, 6, 0, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:48:55'),
  (25, 6, 0, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:50:50'),
  (26, 5, 0, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:50:51'),
  (27, 5, 0, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:50:59'),
  (28, 6, 0, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:51:04'),
  (29, 5, 0, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:53:05'),
  (30, 6, 0, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 08:53:09'),
  (31, 5, 0, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 10:51:38'),
  (32, 6, 0, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 10:51:41'),
  (33, 5, 0, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 11:19:23'),
  (34, 6, 0, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 11:19:23'),
  (35, 6, 2, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 11:20:14'),
  (36, 5, 9, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 11:20:14'),
  (37, 5, 9, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 11:20:18'),
  (38, 5, 8, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 11:20:22'),
  (39, 6, 2, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-20 11:20:22'),
  (40, 5, 8, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-21 07:13:14'),
  (41, 6, 7, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-21 07:13:16'),
  (42, 6, 3, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-21 07:16:56'),
  (43, 5, 8, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-21 07:16:58'),
  (44, 6, 4, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-21 09:35:05'),
  (45, 6, 4, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-21 09:35:13'),
  (46, 6, 2, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-21 09:35:16'),
  (47, 6, 4, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-21 09:35:25'),
  (48, 6, 7, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-21 10:20:24'),
  (49, 6, 6, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-21 10:20:35'),
  (50, 5, 9, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-21 10:21:22'),
  (51, 5, 8, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-21 10:26:47'),
  (52, 5, 8, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-21 10:27:05'),
  (53, 5, 8, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-21 10:27:09'),
  (54, 5, 8, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-21 10:27:28'),
  (55, 5, 9, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-21 10:27:43'),
  (56, 5, 9, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-21 10:32:06'),
  (57, 6, 2, 'http://localhost/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-21 10:32:21');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserId` int(11) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `UserEmail` varchar(50) NOT NULL,
  `UserPhone` varchar(15) DEFAULT NULL,
  `UserPassword` varchar(50) NOT NULL,
  `UserRole` int(11) NOT NULL,
  `UserStatus` int(11) NOT NULL DEFAULT '1',
  `UserBalance` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserId`, `UserName`, `UserEmail`, `UserPhone`, `UserPassword`, `UserRole`, `UserStatus`, `UserBalance`) VALUES
  (1, 'Phat', 'phat@yahoo.com', '01231234432', '123', 1, 1, -7800),
  (3, 'AdminPhat', 'Admin@yahoo.com', '01231234432', '123', 1, 1, 0),
  (4, 'PubPhat', 'PubPhat@yahoo.com', '01231234432', '123', 2, 1, 150),
  (5, 'PubPhatInactive', 'PubPhatInactive@yahoo.com', '01231234432', '123', 2, 0, 200),
  (6, 'AdvPhat', 'AdvPhat@yahoo.com', '01231234432', '123', 3, 1, 589600),
  (7, 'AdvPhatInactive', 'AdvPhatInactive@yahoo.com', '01231234432', '123', 3, 0, 0),
  (36, 'SuperAdmin', 'SuperAdmin@spl.com', '0909116060', '1234', 11, 1, 10000000),
  (37, 'AdvPhat1', 'AdvPhat1@yahoo.com', '01231234432', '123', 3, 1, 498800);

-- --------------------------------------------------------

--
-- Table structure for table `zone`
--

CREATE TABLE `zone` (
  `ZoneId` int(11) NOT NULL,
  `ZoneWidth` int(11) NOT NULL,
  `ZoneHeight` int(11) NOT NULL,
  `ZoneName` varchar(50) NOT NULL,
  `ZoneFormat` int(11) NOT NULL,
  `ZoneStatus` int(11) NOT NULL DEFAULT '1',
  `UserId` int(11) NOT NULL,
  `ZoneCreateTimestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zone`
--

INSERT INTO `zone` (`ZoneId`, `ZoneWidth`, `ZoneHeight`, `ZoneName`, `ZoneFormat`, `ZoneStatus`, `UserId`, `ZoneCreateTimestamp`) VALUES
  (1, 480, 270, 'Name1123', 202, 1, 4, '2016-04-15 14:59:47'),
  (2, 300, 250, '1234', 101, 1, 4, '2016-04-15 14:59:47'),
  (3, 480, 270, 'Zone 3', 101, 1, 4, '2016-04-15 14:59:47'),
  (4, 300, 250, 'Zone 22', 101, 2, 1, '2016-04-15 14:59:47'),
  (5, 480, 270, 'Zone 22', 202, 2, 5, '2016-04-15 14:59:47'),
  (6, 300, 250, 'Zone test 300x250', 101, 2, 4, '2016-04-20 15:28:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
ADD PRIMARY KEY (`BannerId`);

--
-- Indexes for table `clickdetail`
--
ALTER TABLE `clickdetail`
ADD PRIMARY KEY (`ClickId`);

--
-- Indexes for table `impression`
--
ALTER TABLE `impression`
ADD PRIMARY KEY (`ImpId`);

--
-- Indexes for table `trueview`
--
ALTER TABLE `trueview`
ADD PRIMARY KEY (`TrueviewId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
ADD PRIMARY KEY (`UserId`),
ADD UNIQUE KEY `UserEmail` (`UserEmail`);

--
-- Indexes for table `zone`
--
ALTER TABLE `zone`
ADD PRIMARY KEY (`ZoneId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
MODIFY `BannerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `clickdetail`
--
ALTER TABLE `clickdetail`
MODIFY `ClickId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `impression`
--
ALTER TABLE `impression`
MODIFY `ImpId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
--
-- AUTO_INCREMENT for table `trueview`
--
ALTER TABLE `trueview`
MODIFY `TrueviewId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `zone`
--
ALTER TABLE `zone`
MODIFY `ZoneId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

