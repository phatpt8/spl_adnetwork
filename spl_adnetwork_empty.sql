-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2016 at 11:18 AM
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

CREATE DATABASE IF NOT EXISTS adnetwork;
USE adnetwork;

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

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
  (1, 'SuperAdmin', 'SuperAdmin@spl.com', '0909116060', '123456', 1, 1, 1000000),
  (2, 'Admin Phat', 'Admin@spl.com', '0909116060', '123456', 1, 1, 0),
  (3, 'Publisher Phat', 'Publisher@gmail.com', '0909116060', '123456', 2, 1, 0),
  (4, 'Pub Inactive', 'PubPhatInactive@gmail.com', '0909116060', '123456', 2, 0, 0),
  (5, 'Advertiser Phat', 'Advertiser@gmail.com', '0909116060', '123456', 3, 1, 0),
  (6, 'Adv Inactive', 'AdvertiserInactive@gmail.com', '0909116060', '123456', 3, 0, 0);
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
  MODIFY `BannerId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `clickdetail`
--
ALTER TABLE `clickdetail`
  MODIFY `ClickId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `impression`
--
ALTER TABLE `impression`
  MODIFY `ImpId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `trueview`
--
ALTER TABLE `trueview`
  MODIFY `TrueviewId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `zone`
--
ALTER TABLE `zone`
  MODIFY `ZoneId` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
