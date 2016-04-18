
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
  (1, 100032131, 10001231, 300, 250, 1, '{"title":"banner 111111","file":"image1111","url":"click1111"}', 1, 6, '2016-04-15 15:01:52'),
  (2, 1500, 101, 300, 250, 1, '{"title":"banner 22","file":"image2","url":"click"}', 2, 6, '2016-04-15 15:01:52'),
  (3, 1200, 101, 300, 250, 1, '{"title":"banner 1","file":"image","url":"click"}', 1, 6, '2016-04-15 15:01:52'),
  (4, 1200, 101, 300, 250, 1, '{"title":"banner 1","file":"image","url":"click"}', 1, 6, '2016-04-15 15:01:52'),
  (5, 1231, 1231, 1123, 123, 123123, '{"title":"12312","file":"123123","url":"123123"}', 1, 6, '2016-04-15 15:01:52'),
  (6, 1200, 101, 300, 250, 1, '{"title":"banner 1","file":"image","url":"click"}', 1, 37, '2016-04-15 15:01:52'),
  (7, 1300, 101, 300, 250, 1, '{"title":"Banner 300x250 testing","file":"//placehold.it/300x250","url":"http://vnexpress.net"}', 2, 1, '2016-04-15 15:01:52'),
  (8, 1300, 202, 480, 270, 2, '{"title":"Banner 300x250 testing","mediaFile":"//static.eclick.vn/uploads/thumb/2016/04/14/1634w757510o8429jo5416l48.mp4","file":"//www.welovemercuri.com/images/coca-cola_cialde.jpg","url":"http://vnexpress.net"}', 2, 1, '2016-04-15 15:01:52');

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
  (1, '2016-04-15 06:07:32', 1300, '7', 7),
  (2, '2016-04-15 06:08:27', 1300, '7', 7),
  (3, '2016-04-15 06:08:30', 1300, '7', 7),
  (4, '2016-04-15 06:09:02', 1300, '7', 7),
  (5, '2016-04-15 06:09:10', 1300, '7', 7),
  (6, '2016-04-15 06:11:54', 1300, '7', 7),
  (7, '2016-04-15 06:13:01', 1300, '7', 7),
  (8, '2016-04-15 06:13:07', 1300, '7', 7),
  (9, '2016-04-15 06:18:30', 1500, '2', 2),
  (10, '2016-04-15 06:19:52', 1500, '2', 2),
  (11, '2016-04-15 06:20:52', 1300, '7', 7),
  (12, '2016-04-15 06:23:26', 1300, '7', 7);

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
  (11, 5, 8, 'http://localhost:63342/spl_adnetwork/static/js/embed/test/test_ad.html', '2016-04-15 10:55:32');

-- --------------------------------------------------------

--
-- Table structure for table `trueview`
--

CREATE TABLE `trueview` (
  `TrueviewId` int(11) NOT NULL,
  `ZoneId` int(11) NOT NULL,
  `BannerId` int(11) NOT NULL,
  `TrueviewUrl` int(11) NOT NULL,
  `TrueviewTimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trueview`
--

INSERT INTO `trueview` (`TrueviewId`, `ZoneId`, `BannerId`, `TrueviewUrl`, `TrueviewTimestamp`) VALUES
  (1, 5, 0, 0, '2016-04-15 09:51:09'),
  (2, 5, 0, 0, '2016-04-15 09:51:25'),
  (3, 5, 0, 0, '2016-04-15 09:51:45'),
  (4, 5, 0, 0, '2016-04-15 10:55:32');

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
  (1, 'Phat', 'phat@yahoo.com', '01231234432', '123', 1, 1, 0),
  (3, 'AdminPhat', 'Admin@yahoo.com', '01231234432', '123', 1, 1, 0),
  (4, 'PubPhat', 'PubPhat@yahoo.com', '01231234432', '123', 2, 1, 0),
  (5, 'PubPhatInactive', 'PubPhatInactive@yahoo.com', '01231234432', '123', 2, 0, 0),
  (6, 'AdvPhat', 'AdvPhat@yahoo.com', '01231234432', '123', 3, 1, 500000),
  (7, 'AdvPhatInactive', 'AdvPhatInactive@yahoo.com', '01231234432', '123', 3, 0, 0),
  (36, 'SuperAdmin', 'SuperAdmin@spl.com', '0909116060', '1234', 11, 1, 10000000),
  (37, 'AdvPhat1', 'AdvPhat1@yahoo.com', '01231234432', '123', 3, 1, 500000);

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
  (5, 480, 270, 'Zone 22', 202, 2, 5, '2016-04-15 14:59:47');

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
MODIFY `BannerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `clickdetail`
--
ALTER TABLE `clickdetail`
MODIFY `ClickId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `impression`
--
ALTER TABLE `impression`
MODIFY `ImpId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `trueview`
--
ALTER TABLE `trueview`
MODIFY `TrueviewId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `zone`
--
ALTER TABLE `zone`
MODIFY `ZoneId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
