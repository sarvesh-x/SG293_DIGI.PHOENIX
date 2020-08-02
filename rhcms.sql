-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 02, 2020 at 12:22 AM
-- Server version: 5.6.48-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rhcms`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(100) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `mobile`, `logo`, `address`, `email`) VALUES
(1, 'RHCMS', '12345690', 'IMG_20200723_194041.jpg', '', 'rhcms@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `n_id` int(100) NOT NULL,
  `t_id` int(100) NOT NULL,
  `date` datetime(5) NOT NULL,
  `message` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `old_project`
--

CREATE TABLE `old_project` (
  `id` int(100) NOT NULL,
  `project` int(50) NOT NULL,
  `year` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `old_project`
--

INSERT INTO `old_project` (`id`, `project`, `year`) VALUES
(1, 100, '2010'),
(2, 150, '2011'),
(3, 250, '2012'),
(4, 220, '2013'),
(5, 118, '2014'),
(6, 140, '2015'),
(7, 100, '2016'),
(8, 90, '2017'),
(9, 250, '2018'),
(10, 260, '2019'),
(11, 50, '2020');

-- --------------------------------------------------------

--
-- Table structure for table `onworksiteimages`
--

CREATE TABLE `onworksiteimages` (
  `ts_id` int(15) NOT NULL,
  `image_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `id` int(100) NOT NULL,
  `lat_long` varchar(75) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=REDUNDANT;

-- --------------------------------------------------------

--
-- Table structure for table `tender_master`
--

CREATE TABLE `tender_master` (
  `t_id` int(100) NOT NULL,
  `t_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `t_issue_date` date NOT NULL,
  `t_due_date` date NOT NULL,
  `t_budget` float NOT NULL,
  `t_details` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `t_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `t_image` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user.png',
  `t_o_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `exp_budget` float NOT NULL,
  `exp_budget_desc` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `approval_exp_budget` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lat_long` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `r` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=REDUNDANT;

--
-- Dumping data for table `tender_master`
--

INSERT INTO `tender_master` (`t_id`, `t_name`, `t_issue_date`, `t_due_date`, `t_budget`, `t_details`, `t_type`, `t_image`, `t_o_name`, `exp_budget`, `exp_budget_desc`, `approval_exp_budget`, `lat_long`, `r`) VALUES
(11, 'ABC Building ', '2020-08-01', '2020-08-01', 250000, 'House Building ', 'Current Tender', 'user.png', 'ABC', 0, '', '', '', '1'),
(15, 'A', '2013-08-01', '2018-08-02', 5000000, 'This is a rural housing scheme.', 'Current Tender', 'user.png', 'Kalyan', 0, '', '', '', '100');

-- --------------------------------------------------------

--
-- Table structure for table `tender_status`
--

CREATE TABLE `tender_status` (
  `ts_id` int(100) NOT NULL,
  `t_id` int(100) NOT NULL,
  `date` date NOT NULL,
  `today_work` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `total_emp` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `emp_present` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `daily_wages` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `daily_expense` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `reson_late` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `other` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `work_completed` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `invoice_file` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lat_long` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=REDUNDANT;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `name` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(80) NOT NULL,
  `t_id` int(100) NOT NULL,
  `dob` varchar(12) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `address` varchar(250) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Active'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `t_id`, `dob`, `mobile`, `address`, `status`) VALUES
(30, 'ABC Building ', 'TestUser', '12345', 11, '', '', '', 'Active'),
(31, 'a', 'jnu123', '123@hnf73452', 0, '', '', '', 'Active'),
(32, 'A', '123', '16616hyish', 15, '', '', '', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE `user_master` (
  `user_id` int(100) NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `cmp_code` int(100) NOT NULL,
  `t_id` int(100) NOT NULL,
  `image` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_master`
--

INSERT INTO `user_master` (`user_id`, `username`, `email`, `password`, `type`, `cmp_code`, `t_id`, `image`) VALUES
(3, 'Deepak Sharma', 'admin@gmail.com', '123', 'Admin', 1, 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`n_id`);

--
-- Indexes for table `old_project`
--
ALTER TABLE `old_project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `onworksiteimages`
--
ALTER TABLE `onworksiteimages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tender_master`
--
ALTER TABLE `tender_master`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `tender_status`
--
ALTER TABLE `tender_status`
  ADD PRIMARY KEY (`ts_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_master`
--
ALTER TABLE `user_master`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `n_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `old_project`
--
ALTER TABLE `old_project`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `onworksiteimages`
--
ALTER TABLE `onworksiteimages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tender_master`
--
ALTER TABLE `tender_master`
  MODIFY `t_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tender_status`
--
ALTER TABLE `tender_status`
  MODIFY `ts_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `user_master`
--
ALTER TABLE `user_master`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
