-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2019 at 09:46 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `itsupport`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `departmentName` varchar(45) DEFAULT NULL,
  `floor` int(11) DEFAULT NULL,
  `direction` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `departmentName`, `floor`, `direction`) VALUES
(1, 'ICT', 1, 1),
(2, 'electrical', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `direction`
--

CREATE TABLE `direction` (
  `id` int(11) NOT NULL,
  `direction` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `direction`
--

INSERT INTO `direction` (`id`, `direction`) VALUES
(1, 'Left'),
(6, 'right');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(191) NOT NULL,
  `firstName` varchar(15) NOT NULL,
  `middleName` varchar(15) DEFAULT NULL,
  `department` int(11) DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT '0',
  `team` int(11) DEFAULT NULL,
  `isApproved` enum('0','1') DEFAULT '0',
  `remember_token` varchar(100) DEFAULT NULL,
  `emailToken` varchar(255) DEFAULT NULL,
  `activation` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `email`, `password`, `firstName`, `middleName`, `department`, `role`, `team`, `isApproved`, `remember_token`, `emailToken`, `activation`) VALUES
(9, 'abel@gmail.com', '$2y$10$iwltqfCJ6wyUsOvHFfGfvO/Q/ODWmHBPxShGXGeNO8WSvyj4v7g/e', 'abela', 'tesfaw', 1, 1, NULL, '1', '9j5phBGPdUbWdyjBLZj1jrkDRBatLU7X4uZns0CmzPaJ5NyFChDdm46wOuic', NULL, 1),
(15, 'yohanis@gmail.com', '$2y$10$EH.7nWi23gPaCZoGI8Um3e.kzT72rGwJx57BB6k/MgnMTTW3J0mR6', 'yohanis', 'tesfaw', 1, 3, NULL, '1', 'SMPPx81tFRAAaCnY2Mgj6ff69W8WWtZCD4UKBFSTabsWYs98VFMGgS0KQwXN', NULL, 1),
(20, 'dnber.getahun@gmail.com', '$2y$10$MlcXSxkRvdU/BgaMeDdPnO8R3q8K01G.S7oJiS4FB3K5iqkwKDYSu', 'denber', 'getahun', 1, 2, 1, '1', 'g0k4N3YqUCCPzFt3rgFcILYq9XF2Loz6UFze77w3tHzc9NOsLoGgg7IfStfZ', NULL, 1),
(29, 'getasewtesfaw@gmail.com', '$2y$10$NGytazsWrOldtonQDGVZJuVGLK0c/8xVtZEONUjeP9ZNPF/wF6Y7a', 'Getasew', 'tesfaw', 1, 2, 1, '1', 'cy3gDwLd011SDzTLB2GGcE83pfRm79IKEWyzjRjSo9RqLcOK3vaibAiceflb', 'Z2V0YXNld3Rlc2Zhd0BnbWFpbC5jb20=', 1);

-- --------------------------------------------------------

--
-- Table structure for table `floor`
--

CREATE TABLE `floor` (
  `id` int(11) NOT NULL,
  `floor` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `floor`
--

INSERT INTO `floor` (`id`, `floor`) VALUES
(1, 'Graund'),
(2, 'first(1st) floor');

-- --------------------------------------------------------

--
-- Table structure for table `ictteam`
--

CREATE TABLE `ictteam` (
  `id` int(11) NOT NULL,
  `teamName` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ictteam`
--

INSERT INTO `ictteam` (`id`, `teamName`) VALUES
(1, 'system Adminstrator'),
(2, 'Networking');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_04_30_062328_create_notifications_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` int(10) UNSIGNED NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_id`, `notifiable_type`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('25939791-b923-4376-afe4-d91f22db176a', 'App\\Notifications\\RequestNotification', 20, 'App\\User', '{"firstName":"yohanis","middleName":"tesfaw","senderId":15,"requestTitle":"software","requestMessage":"good","requestId":1,"sendTime":{"date":"2018-05-28 10:50:40.620643","timezone_type":3,"timezone":"UTC"}}', NULL, '2018-05-28 07:50:40', '2018-05-28 07:50:40'),
('163f44f7-592a-4026-a800-4a41330fb8cf', 'App\\Notifications\\RequestNotification', 20, 'App\\User', '{"firstName":"yohanis","middleName":"tesfaw","senderId":15,"requestTitle":"software","requestMessage":"ggg","requestId":1,"sendTime":{"date":"2018-05-28 11:25:34.967558","timezone_type":3,"timezone":"UTC"}}', NULL, '2018-05-28 08:25:34', '2018-05-28 08:25:34'),
('d8744f7e-59a7-422c-99ac-e113fe76b45a', 'App\\Notifications\\RequestNotification', 20, 'App\\User', '{"firstName":"yohanis","middleName":"tesfaw","senderId":15,"requestTitle":"software","requestMessage":"good","requestId":1,"sendTime":{"date":"2018-05-28 10:49:18.737764","timezone_type":3,"timezone":"UTC"}}', NULL, '2018-05-28 07:49:19', '2018-05-28 07:49:19'),
('2fbbcc22-5a97-45e4-9ce9-dd4dda3cde65', 'App\\Notifications\\RequestNotification', 9, 'App\\User', '{"firstName":"yohanis","middleName":"tesfaw","senderId":15,"requestTitle":"software","requestMessage":"what is computer science?","requestId":5,"sendTime":{"date":"2018-06-23 09:06:08.865833","timezone_type":3,"timezone":"UTC"}}', NULL, '2018-06-23 06:06:08', '2018-06-23 06:06:08'),
('40265da6-b3f1-4cf0-80ea-37ed2ae0ba4c', 'App\\Notifications\\RequestNotification', 20, 'App\\User', '{"firstName":"yohanis","middleName":"tesfaw","senderId":15,"requestTitle":"software","requestMessage":"koolsxd","requestId":1,"sendTime":{"date":"2018-05-28 11:21:35.507983","timezone_type":3,"timezone":"UTC"}}', NULL, '2018-05-28 08:21:35', '2018-05-28 08:21:35'),
('8dad7721-9c8a-49b2-a9ad-22cdacd3bb69', 'App\\Notifications\\RequestNotification', 20, 'App\\User', '{"firstName":"yohanis","middleName":"tesfaw","senderId":15,"requestTitle":"software","requestMessage":"what is computer science?","requestId":5,"sendTime":{"date":"2018-06-23 09:08:47.991724","timezone_type":3,"timezone":"UTC"}}', NULL, '2018-06-23 06:08:48', '2018-06-23 06:08:48');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('getasewtesfaw@gmail.com', '$2y$10$bLxbSItbJrRFloH9ATdpHuqPOEia7lfHHcdoEQKIt5P7UxWIujTYq', '2018-05-14 04:43:31');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `title` int(11) NOT NULL,
  `message` varchar(255) DEFAULT NULL,
  `sender` int(11) NOT NULL,
  `admin` int(11) DEFAULT NULL,
  `team` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `sendTime` timestamp NULL DEFAULT NULL,
  `seenTime` timestamp NULL DEFAULT NULL,
  `resolvedTime` timestamp NULL DEFAULT NULL,
  `feedback` varchar(345) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `title`, `message`, `sender`, `admin`, `team`, `status`, `sendTime`, `seenTime`, `resolvedTime`, `feedback`) VALUES
(4, 1, 'what is software?', 15, 29, NULL, 2, '2018-06-23 05:54:17', '2018-06-23 05:55:53', '2018-06-23 06:10:38', NULL),
(5, 1, 'what is computer science?', 15, 29, 1, 2, '2018-06-23 06:06:08', '2018-06-23 06:08:47', '2018-06-25 10:41:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `requestcategory`
--

CREATE TABLE `requestcategory` (
  `id` int(11) NOT NULL,
  `title` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `requestcategory`
--

INSERT INTO `requestcategory` (`id`, `title`) VALUES
(1, 'software'),
(2, 'hardware');

-- --------------------------------------------------------

--
-- Table structure for table `requeststatus`
--

CREATE TABLE `requeststatus` (
  `id` int(11) NOT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `requeststatus`
--

INSERT INTO `requeststatus` (`id`, `status`) VALUES
(0, 'pending'),
(1, 'seen'),
(2, 'resolved');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `roleName` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `roleName`) VALUES
(1, 'Director'),
(2, 'Adminstrator'),
(3, 'Employee');

-- --------------------------------------------------------

--
-- Table structure for table `teamwork`
--

CREATE TABLE `teamwork` (
  `id` int(11) NOT NULL,
  `requestTitle` int(11) DEFAULT NULL,
  `team` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teamwork`
--

INSERT INTO `teamwork` (`id`, `requestTitle`, `team`) VALUES
(1, 1, 1),
(2, 2, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`),
  ADD KEY `floor_dep_idx` (`floor`),
  ADD KEY `dire_dep_idx` (`direction`);

--
-- Indexes for table `direction`
--
ALTER TABLE `direction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD KEY `Role_Emp_idx` (`role`),
  ADD KEY `Dep_Emp_idx` (`department`);

--
-- Indexes for table `floor`
--
ALTER TABLE `floor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ictteam`
--
ALTER TABLE `ictteam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_id_notifiable_type_index` (`notifiable_id`,`notifiable_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Emp_req_idx` (`sender`),
  ADD KEY `Emp_req_Sender_idx` (`admin`),
  ADD KEY `category_req_idx` (`title`),
  ADD KEY `status_req_idx` (`status`),
  ADD KEY `Team_req_idx` (`team`);

--
-- Indexes for table `requestcategory`
--
ALTER TABLE `requestcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requeststatus`
--
ALTER TABLE `requeststatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teamwork`
--
ALTER TABLE `teamwork`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Team_Work_idx` (`team`),
  ADD KEY `Category_Work_idx` (`requestTitle`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `direction`
--
ALTER TABLE `direction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `floor`
--
ALTER TABLE `floor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ictteam`
--
ALTER TABLE `ictteam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `requestcategory`
--
ALTER TABLE `requestcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `dire_dep` FOREIGN KEY (`direction`) REFERENCES `direction` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `floor_dep` FOREIGN KEY (`floor`) REFERENCES `floor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `Dep_Emp` FOREIGN KEY (`department`) REFERENCES `department` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Role_Emp` FOREIGN KEY (`role`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `Emp_req_Admin` FOREIGN KEY (`admin`) REFERENCES `employee` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `Emp_req_Sender` FOREIGN KEY (`sender`) REFERENCES `employee` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Team_req` FOREIGN KEY (`team`) REFERENCES `ictteam` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `category_req` FOREIGN KEY (`title`) REFERENCES `requestcategory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `status_req` FOREIGN KEY (`status`) REFERENCES `requeststatus` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `teamwork`
--
ALTER TABLE `teamwork`
  ADD CONSTRAINT `Category_Work` FOREIGN KEY (`requestTitle`) REFERENCES `requestcategory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Team_work` FOREIGN KEY (`team`) REFERENCES `ictteam` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
