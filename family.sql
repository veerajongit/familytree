-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2016 at 03:02 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gsbfamily`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `room_no` varchar(1500) NOT NULL,
  `wing` varchar(1500) NOT NULL,
  `building_name` varchar(1500) NOT NULL,
  `street_name` varchar(1500) NOT NULL,
  `area_name` varchar(1500) NOT NULL,
  `city_name` varchar(1500) NOT NULL DEFAULT 'Virar',
  `west_east` varchar(1500) NOT NULL,
  `taluka` varchar(1500) NOT NULL DEFAULT 'Vasai',
  `district` varchar(1500) NOT NULL DEFAULT 'Palghar',
  `state` varchar(1500) NOT NULL DEFAULT 'Mahrashtra',
  `member_id` int(11) NOT NULL,
  `is_delete` int(11) DEFAULT NULL COMMENT '1 means delete',
  `home_office` int(11) NOT NULL COMMENT '1-home 2-office'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `family`
--

CREATE TABLE `family` (
  `id` int(11) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_delete` int(11) DEFAULT NULL COMMENT '1 means delete'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `member_id` int(11) NOT NULL,
  `Name` varchar(1500) NOT NULL,
  `fathers_name` varchar(1500) NOT NULL,
  `mothers_name` varchar(1500) NOT NULL,
  `gender` varchar(150) NOT NULL COMMENT 'M or F',
  `Profession` varchar(1500) NOT NULL,
  `Math` varchar(1500) NOT NULL,
  `Studying` varchar(1500) NOT NULL,
  `College/School Name` varchar(1500) NOT NULL,
  `Gotra` varchar(1500) NOT NULL,
  `Date of birth` varchar(1500) NOT NULL,
  `Nakshatra` varchar(1500) NOT NULL,
  `family_id` varchar(1500) NOT NULL,
  `bloodgroup` varchar(1500) NOT NULL,
  `other_details` varchar(15000) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updation_date` varchar(150) NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_delete` int(11) DEFAULT NULL COMMENT '1 means deleted',
  `fathers_id` int(11) DEFAULT NULL,
  `mothers_id` int(11) DEFAULT NULL,
  `husbands_id` int(11) DEFAULT NULL,
  `wifes_id` int(11) DEFAULT NULL,
  `brothers_id` int(11) DEFAULT NULL,
  `sisters_id` int(11) DEFAULT NULL,
  `sons_id` int(11) DEFAULT NULL,
  `daughters_id` int(11) DEFAULT NULL,
  `others_id` int(11) DEFAULT NULL,
  `kuldev` varchar(1500) NOT NULL,
  `membership_id` varchar(1500) DEFAULT NULL,
  `nativeplace` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `phone`
--

CREATE TABLE `phone` (
  `id` int(11) NOT NULL,
  `phone_no` varchar(1500) NOT NULL,
  `member_id` int(11) NOT NULL,
  `home_office` int(11) NOT NULL COMMENT '1-personal 2-professional'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `family`
--
ALTER TABLE `family`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `phone`
--
ALTER TABLE `phone`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;
--
-- AUTO_INCREMENT for table `family`
--
ALTER TABLE `family`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=217;
--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=833;
--
-- AUTO_INCREMENT for table `phone`
--
ALTER TABLE `phone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=579;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
