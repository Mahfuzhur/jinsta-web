-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2018 at 10:44 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `a2i`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int(10) NOT NULL,
  `name` varchar(191) NOT NULL,
  `phone` varchar(191) NOT NULL,
  `authentication_token` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `address` varchar(191) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `name`, `phone`, `authentication_token`, `password`, `email`, `address`, `deleted_at`, `updated_at`, `created_at`, `status`) VALUES
(39, 'mahfuzh', '0168888888', '$2y$10$AJ3r4im7Im4x.0tppkb5kOkF6rovE2rGHRhrNpa0DmXi.XmKu9O26', '$2y$10$O6K3R8cZ5k/iRgd71BCJieYqyLdHj7APawMMUVckDy0EuqLRkVywC', 'mahfuzhur@gmail.com', 'dhaka', '2018-04-22 09:08:17', '2018-04-22 09:08:17', '2018-04-17 10:20:23', 0),
(44, 'mahfuzh', '016', '$2y$10$E67AVwrU5xTvMKgFrIyuUeGezWU.lsd8nFMTeYk8GjCLjBysXi3rq', '$2y$10$0ssvqzFBOrxp5RMo0A1RoOG.L1acgXDCmc7SSkXxMUXD/whHLSYJi', 'mahfuzhur@gmail.co', 'dhaka', NULL, '2018-05-12 10:39:22', '2018-04-17 11:38:19', 0),
(45, 'mahfuzh', '01688', '$2y$10$nhOtwvmp9iatRE3c2ecNXeYeyyWCzspqqc0uJSsg1Wjrbjgs0Gp7C', '$2y$10$Xq27zdrFaGjTNN41gtpuFutZbpyK4g5ieN5bN1V2kcRpuHxH0eEHG', 'mahfuzhur@gmail.comm', 'dhaka', NULL, '2018-04-19 08:45:38', '2018-04-19 08:21:25', 0),
(51, 'mahfuzh', '01688888888', '$2y$10$qQGBK8zbjFukok7sokD2HuAq4xQdv3quaFsL27W.5Ymlvr.voZ4Cm', '$2y$10$mTrPzIlkP67sbnbJBpv6SekAZebYDGGhKmu/sm7vtnT.CX4.QP.I2', 'mahfuzhur@gmail.commm', 'dhaka', NULL, '2018-04-22 07:37:08', '2018-04-19 11:23:51', 0),
(52, 'mahfuzh', '016888888888', '$2y$10$LJVnPN.bXoYB5Sjf7zs.1OB0BNbH2YgvhkXZQzmbtfHu6c03mdGI2', '$2y$10$bEkbl22FN98LyzuDP.1QReuQ0dsyKFe06f1XHepu4GVmPHyrBUbf.', 'mahfuzhur@gmail.commmm', 'dhaka', NULL, '2018-04-22 07:37:03', '2018-04-19 11:25:12', 0),
(53, 'mahfuzh', '0168888888888', '$2y$10$mkZgO2OEYYysgjT2vjays.3p9r802Xj9Zve/n4xV/q.eve5emYz2S', '$2y$10$fHSSLQJDoCVyIyvUtKJfZOYqjmzpPEJtJ597YMP7FCk8NMOtjwnGC', 'mahfuzhur@gmail.commmmm', 'dhaka', NULL, NULL, '2018-04-19 11:28:47', 0),
(54, 'mahfuzh1', '016888888888888', '$2y$10$wgufUh/rVfAo9QpDDUDadONINHGWPhhoL2oQxeOJdgHNvtKBRmGge', '123456', 'mahfuzhur@gmail.commmmmmm', 'khulna', NULL, '2018-06-20 06:15:41', '2018-05-12 09:48:21', 0);

-- --------------------------------------------------------

--
-- Table structure for table `delivarytransporter`
--

CREATE TABLE `delivarytransporter` (
  `id` int(10) NOT NULL,
  `transporterId` int(10) DEFAULT NULL,
  `serviceId` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `endTime` time DEFAULT NULL,
  `startTime` time DEFAULT NULL,
  `id` int(10) NOT NULL,
  `clientId` int(10) DEFAULT NULL,
  `deliveryTransporterId` int(10) DEFAULT NULL,
  `receiverName` varchar(191) DEFAULT NULL,
  `receiverPhone` varchar(191) DEFAULT NULL,
  `geoStartLatitude` float DEFAULT NULL,
  `geoStartLongitude` float DEFAULT NULL,
  `geoEndLatitude` float DEFAULT NULL,
  `geoEndLongitude` float DEFAULT NULL,
  `weight` varchar(191) DEFAULT NULL,
  `totalPrice` decimal(10,0) DEFAULT NULL,
  `productPrice` decimal(10,0) DEFAULT NULL,
  `payPerson` varchar(191) DEFAULT NULL,
  `otp` varchar(191) DEFAULT NULL,
  `paidAmount` varchar(191) DEFAULT NULL,
  `due` varchar(191) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `status` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`endTime`, `startTime`, `id`, `clientId`, `deliveryTransporterId`, `receiverName`, `receiverPhone`, `geoStartLatitude`, `geoStartLongitude`, `geoEndLatitude`, `geoEndLongitude`, `weight`, `totalPrice`, `productPrice`, `payPerson`, `otp`, `paidAmount`, `due`, `updated_at`, `deleted_at`, `created_at`, `status`) VALUES
('18:18:46', '12:06:06', 1, 1, NULL, 'mahfuzh', '0168', 1, 1, 1, 1, '40', '500', NULL, 'mahfuzh', '123', '500', '000', '2018-07-02 12:18:46', NULL, NULL, 'end'),
('09:06:07', '17:11:12', 2, 0, 0, 'rayan', '016874654', 23.8109, 90.4216, 23.8136, 90.4238, '5', '100', NULL, '1', '123', '100', '0', NULL, NULL, '2018-06-03 03:05:02', '0'),
('05:05:05', '23:15:08', 3, 2, 3, 'asif', '0168', 23.8092, 90.4211, 23.8136, 90.4238, '3', '200', NULL, '1', '123', '200', '0', NULL, NULL, '2018-06-03 04:04:05', '0'),
('05:03:03', '10:03:03', 4, 5, 4, 'kajol', '01777', 23.7832, 90.4258, 23.8136, 90.4238, '2.5', '20', NULL, '1', '123', '20', '0', NULL, NULL, '2018-06-03 01:03:02', '0'),
(NULL, NULL, 5, 100, NULL, 'mohib', '016874562', 30.2222, 31.2222, 15.3333, 14.6666, '29', NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-21 09:43:34', NULL, '2018-06-21 09:43:34', '0'),
(NULL, NULL, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0'),
(NULL, NULL, 7, 1, NULL, 'dfsdf', 'sdfsd', 23.813, 23.813, 23.813, 23.813, '40', '200', NULL, '1', NULL, NULL, NULL, NULL, NULL, '2018-06-21 10:55:05', '0'),
(NULL, NULL, 8, 1, NULL, 'dfsdf', 'sdfsd', 23.813, 23.813, 23.813, 23.813, '40', '200', NULL, '1', NULL, NULL, NULL, NULL, NULL, '2018-06-21 11:08:40', '0'),
(NULL, NULL, 9, 1, NULL, 'dfsdf', 'sdfsd', 23.813, 23.813, 23.813, 23.813, '40', '200', NULL, '1', NULL, NULL, NULL, NULL, NULL, '2018-06-21 11:09:43', '0'),
(NULL, NULL, 10, 1, NULL, 'dfsdf', 'sdfsd', 23.813, 23.813, 23.813, 23.813, '40', '200', NULL, '1', NULL, NULL, NULL, NULL, NULL, '2018-06-21 11:10:19', '0'),
(NULL, NULL, 11, 1, NULL, 'dfsdf', 'sdfsd', 23.813, 23.813, 23.813, 23.813, '40', '200', NULL, '1', NULL, NULL, NULL, NULL, NULL, '2018-06-24 05:14:00', '0'),
(NULL, NULL, 12, 1, 7, 'dfsdf', 'sdfsd', 23.813, 23.813, 23.813, 23.813, '40', '200', NULL, '1', NULL, NULL, NULL, '2018-06-26 08:22:16', NULL, '2018-06-24 05:32:42', 'not found'),
(NULL, '09:02:28', 13, 1, 3, 'dfsdf', 'sdfsd', 23.813, 23.813, 23.813, 23.813, '40', '200', NULL, '1', NULL, NULL, NULL, '2018-06-26 09:02:28', NULL, '2018-06-24 05:34:53', '0'),
(NULL, '16:02:55', 14, 1, 10, 'dfsdf', 'sdfsd', 23.813, 23.813, 23.813, 23.813, '40', '200', NULL, '1', NULL, NULL, NULL, '2018-06-26 10:02:55', NULL, '2018-06-24 05:39:03', '0'),
(NULL, NULL, 15, 1, NULL, 'dfsdf', 'sdfsd', 23.813, 23.813, 23.813, 23.813, '40', '200', NULL, '1', NULL, NULL, NULL, NULL, NULL, '2018-06-24 05:39:56', '0'),
(NULL, NULL, 16, 1, NULL, 'dfsdf', 'sdfsd', 23.813, 23.813, 23.813, 23.813, '40', '200', NULL, '1', NULL, NULL, NULL, NULL, NULL, '2018-06-24 05:41:12', '0'),
(NULL, NULL, 17, 1, NULL, 'dfsdf', 'sdfsd', 23.813, 23.813, 23.813, 23.813, '40', '200', NULL, '1', NULL, NULL, NULL, NULL, NULL, '2018-06-24 05:42:21', '0'),
(NULL, NULL, 18, 1, NULL, 'dfsdf', 'sdfsd', 23.813, 23.813, 23.813, 23.813, '40', '200', NULL, '1', NULL, NULL, NULL, NULL, NULL, '2018-06-24 05:43:21', '0'),
(NULL, NULL, 19, 1, NULL, 'dfsdf', 'sdfsd', 23.813, 23.813, 23.813, 23.813, '40', '200', NULL, '1', NULL, NULL, NULL, NULL, NULL, '2018-06-24 05:43:49', '0'),
(NULL, NULL, 20, 1, NULL, 'dfsdf', 'sdfsd', 23.813, 23.813, 23.813, 23.813, '40', '200', NULL, '1', NULL, NULL, NULL, NULL, NULL, '2018-06-24 05:44:40', '0'),
(NULL, NULL, 21, 1, NULL, 'dfsdf', 'sdfsd', 23.813, 23.813, 23.813, 23.813, '40', '200', NULL, '1', NULL, NULL, NULL, NULL, NULL, '2018-06-24 05:46:10', '0'),
(NULL, NULL, 22, 1, NULL, 'dfsdf', 'sdfsd', 23.813, 23.813, 23.813, 23.813, '40', '200', NULL, '1', NULL, NULL, NULL, NULL, NULL, '2018-06-24 05:46:45', '0'),
(NULL, NULL, 23, 1, NULL, 'dfsdf', 'sdfsd', 23.813, 23.813, 23.813, 23.813, '40', '200', NULL, '1', NULL, NULL, NULL, NULL, NULL, '2018-06-24 05:46:57', '0'),
(NULL, NULL, 24, 1, NULL, 'dfsdf', 'sdfsd', 23.813, 23.813, 23.813, 23.813, '40', '200', NULL, '1', NULL, NULL, NULL, NULL, NULL, '2018-06-24 05:53:11', '0'),
(NULL, NULL, 25, 1, NULL, 'dfsdf', 'sdfsd', 23.813, 23.813, 23.813, 23.813, '40', '200', NULL, '1', NULL, NULL, NULL, NULL, NULL, '2018-06-24 05:54:30', '0'),
(NULL, NULL, 26, 1, NULL, 'dfsdf', 'sdfsd', 23.813, 23.813, 23.813, 23.813, '40', '200', NULL, '1', NULL, NULL, NULL, NULL, NULL, '2018-06-24 05:54:46', '0'),
(NULL, NULL, 27, 1, NULL, 'dfsdf', 'sdfsd', 23.813, 23.813, 23.813, 23.813, '40', '200', NULL, '1', NULL, NULL, NULL, NULL, NULL, '2018-06-24 05:55:34', '0'),
(NULL, NULL, 28, 1, NULL, 'dfsdf', 'sdfsd', 23.813, 23.813, 23.813, 23.813, '40', '200', NULL, '1', NULL, NULL, NULL, NULL, NULL, '2018-06-24 05:56:34', '0'),
(NULL, NULL, 29, 1, NULL, 'dfsdf', 'sdfsd', 23.813, 23.813, 23.813, 23.813, '40', '200', NULL, '1', NULL, NULL, NULL, NULL, NULL, '2018-06-24 05:57:34', '0'),
(NULL, NULL, 30, 1, NULL, 'dfsdf', 'sdfsd', 23.813, 23.813, 23.813, 23.813, '40', '200', NULL, '1', NULL, NULL, NULL, NULL, NULL, '2018-06-24 05:58:34', 'found'),
('15:04:47', NULL, 31, 1, NULL, 'dfsdf', 'sdfsd', 23.813, 23.813, 23.813, 23.813, '40', '200', NULL, '1', NULL, NULL, NULL, '2018-09-23 09:04:47', NULL, '2018-06-24 06:24:10', 'end'),
(NULL, NULL, 32, 100, NULL, 'dfsdf', 'sdfsd', 23.813, 23.813, 23.813, 23.813, '40', '200', NULL, '1', NULL, NULL, NULL, NULL, NULL, '2018-06-24 09:52:29', 'not found'),
(NULL, NULL, 33, 100, NULL, 'dfsdf', 'sdfsd', 23.813, 90.4231, 23.813, 23.813, '40', '200', '100', '1', NULL, NULL, NULL, NULL, NULL, '2018-10-22 06:31:36', 'not found'),
(NULL, NULL, 34, 100, NULL, 'dfsdf', 'sdfsd', 23.813, 90.4231, 23.813, 23.813, '40', '200', '100', '1', NULL, NULL, NULL, NULL, NULL, '2018-10-22 06:33:32', 'not found'),
(NULL, NULL, 35, 100, NULL, 'dfsdf', 'sdfsd', 23.813, 90.4231, 23.813, 23.813, '40', '200', '100', '1', NULL, NULL, NULL, NULL, NULL, '2018-10-22 06:39:28', 'not found');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_request`
--

CREATE TABLE `service_request` (
  `id` int(10) NOT NULL,
  `Tid` int(10) NOT NULL,
  `Sid` int(10) NOT NULL,
  `tableId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service_request`
--

INSERT INTO `service_request` (`id`, `Tid`, `Sid`, `tableId`) VALUES
(46, 1, 15, 0),
(47, 9, 15, 0),
(48, 8, 15, 0),
(54, 1, 16, 0),
(55, 9, 16, 0),
(56, 8, 16, 0),
(62, 1, 17, 0),
(63, 9, 17, 0),
(64, 8, 17, 0),
(70, 1, 18, 0),
(71, 9, 18, 0),
(72, 8, 18, 0),
(78, 1, 19, 0),
(79, 9, 19, 0),
(80, 8, 19, 0),
(86, 1, 20, 0),
(87, 9, 20, 0),
(88, 8, 20, 0),
(94, 1, 21, 0),
(95, 9, 21, 0),
(96, 8, 21, 0),
(102, 1, 22, 0),
(103, 9, 22, 0),
(104, 8, 22, 0),
(110, 1, 23, 0),
(111, 9, 23, 0),
(112, 8, 23, 0),
(118, 1, 24, 0),
(119, 9, 24, 0),
(120, 8, 24, 0),
(126, 1, 25, 0),
(127, 9, 25, 0),
(128, 8, 25, 0),
(134, 1, 26, 0),
(135, 9, 26, 0),
(136, 8, 26, 0),
(142, 1, 27, 0),
(143, 9, 27, 0),
(144, 8, 27, 0),
(150, 1, 28, 0),
(151, 9, 28, 0),
(152, 8, 28, 0),
(158, 1, 29, 0),
(159, 9, 29, 0),
(160, 8, 29, 0),
(166, 1, 30, 0),
(167, 9, 30, 0),
(168, 8, 30, 0),
(174, 1, 31, 0),
(175, 9, 31, 0),
(176, 8, 31, 0),
(182, 1, 32, 0),
(183, 9, 32, 0),
(184, 8, 32, 0),
(185, 1, 35, 1);

-- --------------------------------------------------------

--
-- Table structure for table `transporter`
--

CREATE TABLE `transporter` (
  `id` int(10) NOT NULL,
  `name` varchar(191) NOT NULL,
  `phone` varchar(191) NOT NULL,
  `nid` varchar(191) NOT NULL,
  `address` varchar(191) NOT NULL,
  `pic` varchar(191) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `email` varchar(191) NOT NULL,
  `dtId` int(10) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `authentication_token` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `geoLat` decimal(10,8) DEFAULT NULL,
  `geoLan` decimal(11,8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transporter`
--

INSERT INTO `transporter` (`id`, `name`, `phone`, `nid`, `address`, `pic`, `dob`, `email`, `dtId`, `deleted_at`, `updated_at`, `created_at`, `authentication_token`, `password`, `status`, `geoLat`, `geoLan`) VALUES
(1, 'mahfuzh', '0168888888888', '12345678901234', 'dhaka', 'sadasd', '2018-04-15', 'mahfuzhur@gmail.commmmmmmmmm', NULL, NULL, NULL, '2018-06-28 10:07:20', '$2y$10$niwOmfVyXTN5UA/H92mIUuSD0YNn2izdW2642tUykjEoqHzC6jKn2', '$2y$10$GTDs7NQsymvs0CdLJAfzn.Xb6akYmbzF7XlXNwcBeYHXg/rKgMpx.', 1, '23.81296800', '90.42311700');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mahfuzhur Rahman', 'mahfuzhur@gmail.com', '$2y$10$.sFeKdZqLvBIW1YEQJ3jy.S/cs4eT7RnDNDelW6AymaMJ91DCQ5rm', '0Fv6oBIINb7GOvMS0QXfxCyMmg7fdwtgp0beat4luUlgdGTdWfj6ccFntEzG', '2018-04-14 19:05:06', '2018-07-02 06:22:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `delivarytransporter`
--
ALTER TABLE `delivarytransporter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transporterId` (`transporterId`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`(191));

--
-- Indexes for table `service_request`
--
ALTER TABLE `service_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transporter`
--
ALTER TABLE `transporter`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `nid` (`nid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `delivarytransporter`
--
ALTER TABLE `delivarytransporter`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_request`
--
ALTER TABLE `service_request`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- AUTO_INCREMENT for table `transporter`
--
ALTER TABLE `transporter`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `delivarytransporter`
--
ALTER TABLE `delivarytransporter`
  ADD CONSTRAINT `delivarytransporter_ibfk_1` FOREIGN KEY (`transporterId`) REFERENCES `transporter` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
