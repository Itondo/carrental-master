-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 04, 2020 at 03:24 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carrental`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'admin', '5c428d8875d2948607f3e3fe134d71b4', '2017-06-18 12:22:38');

-- --------------------------------------------------------

--
-- Table structure for table `tblbooking`
--

CREATE TABLE `tblbooking` (
  `id` int(11) NOT NULL,
  `userEmail` varchar(100) DEFAULT NULL,
  `VehicleId` int(11) DEFAULT NULL,
  `FromDate` date DEFAULT NULL,
  `ToDate` date DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblbooking`
--

INSERT INTO `tblbooking` (`id`, `userEmail`, `VehicleId`, `FromDate`, `ToDate`, `message`, `Status`, `PostingDate`) VALUES
(3, 'ceejltayco@gmail.com', 38, '2019-11-14', '2019-11-16', 'Rent for business trip.', 3, '2019-11-10 14:48:19'),
(4, 'ceejltayco@gmail.com', 44, '2019-12-04', '2019-12-04', 'For roadtrip.', 3, '2019-12-03 15:39:43'),
(5, 'jbadilles@gmail.com', 38, '2019-12-04', '2019-12-04', 'For business trip.', 3, '2019-12-04 07:48:29'),
(6, 'ceejltayco@gmail.com', 38, '2019-12-23', '2019-12-23', 'For company outing.', 3, '2019-12-21 16:30:10'),
(7, 'ceejltayco@gmail.com', 39, '2019-12-23', '2019-12-25', 'For business trp.', 3, '2019-12-21 19:14:23'),
(11, 'ceejltayco@gmail.com', 37, '2020-01-12', '2020-01-12', 'Test for notification', 2, '2020-01-12 09:14:11'),
(12, 'ceejltayco@gmail.com', 37, '2020-01-26', '2020-01-26', 'Test Only.', 2, '2020-01-26 08:12:27'),
(13, 'ceejltayco@gmail.com', 37, '2020-01-26', '2020-01-26', 'Family use.', 2, '2020-01-26 08:15:19');

-- --------------------------------------------------------

--
-- Table structure for table `tblbrands`
--

CREATE TABLE `tblbrands` (
  `id` int(11) NOT NULL,
  `BrandName` varchar(120) NOT NULL,
  `CreationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblbrands`
--

INSERT INTO `tblbrands` (`id`, `BrandName`, `CreationDate`, `UpdationDate`) VALUES
(4, 'Nissan', '2017-06-18 16:25:13', NULL),
(5, 'Toyota', '2017-06-18 16:25:24', NULL),
(8, 'Mitsubishi', '2019-09-26 06:07:11', NULL),
(9, 'Ford', '2019-09-28 15:41:32', NULL),
(10, 'Honda', '2019-10-20 11:14:36', NULL),
(11, 'Foton', '2019-10-20 12:01:09', NULL),
(12, 'Isuzu', '2019-10-20 12:10:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblconfirmation`
--

CREATE TABLE `tblconfirmation` (
  `id` int(5) NOT NULL,
  `booking_id` int(5) DEFAULT NULL,
  `confirm` tinyint(1) DEFAULT NULL,
  `date_confirmed` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblconfirmation`
--

INSERT INTO `tblconfirmation` (`id`, `booking_id`, `confirm`, `date_confirmed`) VALUES
(1, 4, 0, '2019-12-04'),
(2, 5, 0, '2019-12-04'),
(3, 6, 0, '2019-12-22'),
(4, 7, 0, '2019-12-22'),
(6, 11, 0, '2020-01-19'),
(7, 12, 0, '2020-01-26'),
(8, 13, 0, '2020-01-26');

-- --------------------------------------------------------

--
-- Table structure for table `tblcontactusinfo`
--

CREATE TABLE `tblcontactusinfo` (
  `id` int(11) NOT NULL,
  `Address` tinytext,
  `EmailId` varchar(255) DEFAULT NULL,
  `ContactNo` char(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcontactusinfo`
--

INSERT INTO `tblcontactusinfo` (`id`, `Address`, `EmailId`, `ContactNo`) VALUES
(1, 'Davao City', 'ezrentonline@gmail.com', '09959237974');

-- --------------------------------------------------------

--
-- Table structure for table `tblcontactusquery`
--

CREATE TABLE `tblcontactusquery` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `EmailId` varchar(120) DEFAULT NULL,
  `ContactNumber` char(11) DEFAULT NULL,
  `Message` longtext,
  `PostingDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcontactusquery`
--

INSERT INTO `tblcontactusquery` (`id`, `name`, `EmailId`, `ContactNumber`, `Message`, `PostingDate`, `status`) VALUES
(1, 'Harry Den', 'webhostingamigo@gmail.com', '2147483647', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', '2017-06-18 10:03:07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbllocation`
--

CREATE TABLE `tbllocation` (
  `booking_id` int(11) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbllocation`
--

INSERT INTO `tbllocation` (`booking_id`, `lat`, `lng`) VALUES
(4, 7.0783797999999996, 125.55017950000001),
(5, 7.078397, 125.55013329999997),
(6, 7.078384499999999, 125.55015379999998),
(7, 7.0783869, 125.55015549999996);

-- --------------------------------------------------------

--
-- Table structure for table `tblpages`
--

CREATE TABLE `tblpages` (
  `id` int(11) NOT NULL,
  `PageName` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT '',
  `detail` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpages`
--

INSERT INTO `tblpages` (`id`, `PageName`, `type`, `detail`) VALUES
(1, 'Terms and Conditions', 'terms', '<br>\r\n<p style=\"color: red; font-size: 15px; text-align: left;\"><strong>(1) Reservation Policy</strong></p>\r\n<p style=\"font-size: 14px;text-align: left;\">Upon reservation you must comply the following requirements below:</p>\r\n<ul>\r\n<li style=\"font-size: 14px;text-align: left;\">Renter must be 21 yrs old and above.</li>\r\n<li style=\"font-size: 14px;text-align: left;\">Must have professional driver\'s licence.</li>\r\n<li style=\"font-size: 14px;text-align: left;\">Must have 2 government issued ID\'s.</li>\r\n</ul>\r\n<p style=\"font-size: 14px;text-align: left;\">Reservation must be done one week before vehicle usage. The vehicle owner will confirmed the reservation once the owner confirmed the reservation the renter must pay 40% of the total bill to complete the transaction the payment must be done within 2 days if failure to do so will automatically cancel the reservation. Once a reservation is confirmed the renter must come on the pick-up date failure to do so, there will be a 400 pesos penalty for absence.</p>\r\n\r\n<hr class=\"dashed\">\r\n\r\n<p style=\"color: red; font-size: 15px; text-align: left;\"><strong>(2) Payment Policy</strong></p>\r\n<p style=\"font-size: 14px;text-align: left;\">Payment for reservation can be placed using money transfer/remittance to the account that this provided by the owner.</p>\r\n\r\n<hr class=\"dashed\">\r\n\r\n<p style=\"color: red; font-size: 15px; text-align: left;\"><strong>(3) Return Policy</strong></p>\r\n<p style=\"font-size: 14px;text-align: left;\">The renter must return the vehicle good condition, the fuel of the vehicle must have the same level of fuel from the pick-up date. If the vehicle will have a damaged upon return the customer will be charged depending on the owner. If the vehicle is returned late the renter will be penalized of 500 php.</p>\r\n\r\n<hr class=\"dashed\">\r\n\r\n<p style=\"color: red; font-size: 15px; text-align: left;\"><strong>(4) Destination</strong></p>\r\n<p style=\"font-size: 14px;text-align: left;\">Vehicle can be used within and outside the vicinity of the city except from critical areas.</p>\r\n\r\n<hr class=\"dashed\">\r\n\r\n\r\n<p style=\"color: red; font-size: 15px; text-align: left;\"><strong>(5) Promotions</strong></p>\r\n<p style=\"font-size: 14px;text-align: left;\">EZRent offers promotions. In order to avail and be updated about promotions user must subscribe to EZRent.</p>\r\n\r\n'),
(2, 'Privacy Policy', 'privacy', '<span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat</span>'),
(3, 'About Us ', 'aboutus', '<span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat</span>'),
(11, 'FAQs', 'faqs', '																														<span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Address------Test &nbsp; &nbsp;dsfdsfds</span>');

-- --------------------------------------------------------

--
-- Table structure for table `tblratings`
--

CREATE TABLE `tblratings` (
  `id` int(5) NOT NULL,
  `rental_id` int(5) NOT NULL,
  `renter_id` int(5) NOT NULL,
  `booking_Id` int(5) NOT NULL,
  `rating` int(5) DEFAULT NULL,
  `type` tinyint(1) NOT NULL,
  `date_rated` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblratings`
--

INSERT INTO `tblratings` (`id`, `rental_id`, `renter_id`, `booking_Id`, `rating`, `type`, `date_rated`) VALUES
(1, 93, 94, 3, 5, 1, '2019-12-03'),
(2, 93, 94, 3, 4, 0, '2019-12-04'),
(3, 96, 94, 4, 5, 0, '2019-12-04'),
(4, 96, 94, 4, 4, 1, '2019-12-04'),
(5, 93, 97, 5, 4, 1, '2019-12-05'),
(6, 93, 94, 6, 5, 1, '2019-12-22'),
(7, 95, 94, 7, 5, 1, '2020-01-19');

-- --------------------------------------------------------

--
-- Table structure for table `tblsubscribers`
--

CREATE TABLE `tblsubscribers` (
  `id` int(11) NOT NULL,
  `SubscriberEmail` varchar(120) DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbltestimonial`
--

CREATE TABLE `tbltestimonial` (
  `id` int(11) NOT NULL,
  `UserEmail` varchar(100) NOT NULL,
  `Testimonial` mediumtext NOT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblusage`
--

CREATE TABLE `tblusage` (
  `id` int(5) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `start` tinyint(1) NOT NULL,
  `confirmation` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblusage`
--

INSERT INTO `tblusage` (`id`, `booking_id`, `start`, `confirmation`) VALUES
(1, 4, 0, 0),
(4, 5, 0, 1),
(5, 6, 0, 1),
(6, 7, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `id` int(11) NOT NULL,
  `verified_at` date DEFAULT NULL,
  `UserType` varchar(2) NOT NULL DEFAULT '0',
  `FullName` varchar(120) DEFAULT NULL,
  `EmailId` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `ContactNo` char(11) DEFAULT NULL,
  `LenderLat` double DEFAULT NULL,
  `LenderLng` double DEFAULT NULL,
  `dob` varchar(100) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `City` varchar(100) DEFAULT NULL,
  `Country` varchar(100) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`id`, `verified_at`, `UserType`, `FullName`, `EmailId`, `Password`, `ContactNo`, `LenderLat`, `LenderLng`, `dob`, `Address`, `City`, `Country`, `RegDate`, `UpdationDate`) VALUES
(93, '2019-11-10', '0', 'Lender Demo 1', 'lender1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', 7.0783746, 125.55014419999998, NULL, NULL, NULL, NULL, '2019-11-09 17:43:45', '2019-11-09 17:46:39'),
(94, NULL, '1', 'Ceej Tayco', 'ceejltayco@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', 0, 0, NULL, NULL, NULL, NULL, '2019-11-09 17:44:25', NULL),
(95, '2019-11-10', '0', 'Lender Demo 2', 'lender2@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', 7.014706483897799, 125.49596476718136, NULL, NULL, NULL, NULL, '2019-11-10 06:37:55', '2019-11-10 06:39:31'),
(96, '2019-12-03', '0', 'Lender Demo 3', 'lender3@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', 7.053109999999999, 125.5589463, NULL, NULL, NULL, NULL, '2019-11-10 07:30:50', '2019-12-03 15:36:26'),
(97, NULL, '1', 'Jenny Mae Badilles', 'jbadilles@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', 0, 0, NULL, NULL, NULL, NULL, '2019-12-04 07:47:28', NULL),
(98, '2019-12-22', '0', 'Lender 4', 'lender4@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', 7.049762499541513, 125.58792300292976, NULL, NULL, NULL, NULL, '2019-12-21 16:47:51', '2019-12-21 19:52:20'),
(99, NULL, '1', 'Renter123', 'renter123@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', 0, 0, NULL, NULL, NULL, NULL, '2020-01-18 07:47:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblvehicles`
--

CREATE TABLE `tblvehicles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `VehiclesTitle` varchar(150) DEFAULT NULL,
  `VehiclesBrand` int(11) DEFAULT NULL,
  `VehiclesOverview` longtext,
  `PricePerDay` int(11) DEFAULT NULL,
  `FuelType` varchar(100) DEFAULT NULL,
  `ModelYear` int(6) DEFAULT NULL,
  `SeatingCapacity` int(11) DEFAULT NULL,
  `Vimage1` varchar(120) DEFAULT NULL,
  `Vimage2` varchar(120) DEFAULT NULL,
  `Vimage3` varchar(120) DEFAULT NULL,
  `Vimage4` varchar(120) DEFAULT NULL,
  `Vimage5` varchar(120) DEFAULT NULL,
  `AirConditioner` int(11) DEFAULT NULL,
  `PowerDoorLocks` int(11) DEFAULT NULL,
  `AntiLockBrakingSystem` int(11) DEFAULT NULL,
  `BrakeAssist` int(11) DEFAULT NULL,
  `PowerSteering` int(11) DEFAULT NULL,
  `DriverAirbag` int(11) DEFAULT NULL,
  `PassengerAirbag` int(11) DEFAULT NULL,
  `PowerWindows` int(11) DEFAULT NULL,
  `CDPlayer` int(11) DEFAULT NULL,
  `CentralLocking` int(11) DEFAULT NULL,
  `CrashSensor` int(11) DEFAULT NULL,
  `LeatherSeats` int(11) DEFAULT NULL,
  `RegDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `vehicle_or` varchar(120) DEFAULT NULL,
  `vehicle_cr` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblvehicles`
--

INSERT INTO `tblvehicles` (`id`, `user_id`, `VehiclesTitle`, `VehiclesBrand`, `VehiclesOverview`, `PricePerDay`, `FuelType`, `ModelYear`, `SeatingCapacity`, `Vimage1`, `Vimage2`, `Vimage3`, `Vimage4`, `Vimage5`, `AirConditioner`, `PowerDoorLocks`, `AntiLockBrakingSystem`, `BrakeAssist`, `PowerSteering`, `DriverAirbag`, `PassengerAirbag`, `PowerWindows`, `CDPlayer`, `CentralLocking`, `CrashSensor`, `LeatherSeats`, `RegDate`, `UpdationDate`, `lat`, `lng`, `vehicle_or`, `vehicle_cr`) VALUES
(37, 93, 'Fortuner', 5, 'Toyota Fortuner Brand new (White)', 5000, 'Diesel', 2019, 20, '2015_Toyota_Fortuner_(New_Zealand).jpg', '2018_Toyota_Fortuner_(KUN160R)_Crusade_wagon_(2018-09-28)_01.jpg', '2018_Toyota_Fortuner_(KUN160R)_Crusade_wagon_(2018-09-28)_02.jpg', '1488710.jpg', '', 1, 1, 1, NULL, 1, 1, 1, NULL, 1, 1, 1, 1, '2019-11-10 09:17:40', '2019-11-10 13:25:53', 7.0783746, 125.55014419999998, 'orcr-main-1546929571.jpg', 'registration-certificate-card-haryana-2.jpg'),
(38, 93, 'Rush', 5, 'Toyota Rush Brand New', 2500, 'Diesel', 2019, 10, 'maxresdefault.jpg', 'Toyota Rush Exterior-4.jpg', 'Toyota Rush Exterior-16.jpg', 'toyota_rush-saf-cover.jpeg', 'toyota-rush-front-angle-low-view-721039.jpg', 1, 1, NULL, NULL, 1, 1, 1, 1, 1, 1, 1, NULL, '2019-11-10 09:52:35', NULL, 7.0783746, 125.55014419999998, 'orcr-main-1546929571.jpg', 'registration-certificate-card-haryana-2.jpg'),
(39, 95, 'Xpander', 8, 'Mitsubishi Xpander Brand new 2019', 2500, 'Diesel', 2019, 15, 'xpander1.jpg', 'xpander2.jpg', 'xpander3.jpg', 'xpander4.jpg', '', 1, 1, 1, NULL, 1, 1, 1, 1, 1, 1, 1, NULL, '2019-12-03 15:04:03', '2019-12-03 15:32:07', 7.014706483897799, 125.49596476718136, 'official receipt.jpg', 'certificate of registration.jpg'),
(44, 96, 'Navarra', 4, 'Nissan Navarra 2019 Orange', 2500, 'Diesel', 2019, 20, 'navarra1.jpg', 'navarra2.jpg', 'navarra3.jpg', 'navarra4.jpg', '', 1, 1, 1, NULL, 1, 1, 1, NULL, 1, 1, 1, NULL, '2019-12-03 15:35:23', NULL, 7.053109999999999, 125.5589463, 'official receipt 1.jpg', 'certificate of registration 1.jpg'),
(45, 98, 'Montero Sport', 8, 'Montero Sport 2019 edition white', 5000, 'Diesel', 2019, 20, 'montero 1.jpg', 'montero 2.jpg', 'montero 3.jpeg', 'montero 4.jpg', '', 1, 1, 1, NULL, 1, 1, 1, NULL, 1, 1, 1, 1, '2019-12-21 16:56:48', '2019-12-21 16:58:19', 7.049762499541513, 125.58792300292976, 'car-registration-main.jpg', 'blog-850x420-2-51.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbooking`
--
ALTER TABLE `tblbooking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbrands`
--
ALTER TABLE `tblbrands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblconfirmation`
--
ALTER TABLE `tblconfirmation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `tblcontactusinfo`
--
ALTER TABLE `tblcontactusinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcontactusquery`
--
ALTER TABLE `tblcontactusquery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbllocation`
--
ALTER TABLE `tbllocation`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `tblpages`
--
ALTER TABLE `tblpages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblratings`
--
ALTER TABLE `tblratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_Id` (`booking_Id`),
  ADD KEY `rental_id` (`rental_id`,`renter_id`) USING BTREE,
  ADD KEY `tblratings_ibfk_2` (`renter_id`);

--
-- Indexes for table `tblsubscribers`
--
ALTER TABLE `tblsubscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbltestimonial`
--
ALTER TABLE `tbltestimonial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblusage`
--
ALTER TABLE `tblusage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblvehicles`
--
ALTER TABLE `tblvehicles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblbooking`
--
ALTER TABLE `tblbooking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tblbrands`
--
ALTER TABLE `tblbrands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tblconfirmation`
--
ALTER TABLE `tblconfirmation`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tblcontactusinfo`
--
ALTER TABLE `tblcontactusinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblcontactusquery`
--
ALTER TABLE `tblcontactusquery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbllocation`
--
ALTER TABLE `tbllocation`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblpages`
--
ALTER TABLE `tblpages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tblratings`
--
ALTER TABLE `tblratings`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblsubscribers`
--
ALTER TABLE `tblsubscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbltestimonial`
--
ALTER TABLE `tbltestimonial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblusage`
--
ALTER TABLE `tblusage`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `tblvehicles`
--
ALTER TABLE `tblvehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblconfirmation`
--
ALTER TABLE `tblconfirmation`
  ADD CONSTRAINT `tblconfirmation_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `tblbooking` (`id`);

--
-- Constraints for table `tbllocation`
--
ALTER TABLE `tbllocation`
  ADD CONSTRAINT `fk_booking_id` FOREIGN KEY (`booking_id`) REFERENCES `tblbooking` (`id`);

--
-- Constraints for table `tblratings`
--
ALTER TABLE `tblratings`
  ADD CONSTRAINT `tblratings_ibfk_1` FOREIGN KEY (`rental_id`) REFERENCES `tblusers` (`id`),
  ADD CONSTRAINT `tblratings_ibfk_2` FOREIGN KEY (`renter_id`) REFERENCES `tblusers` (`id`),
  ADD CONSTRAINT `tblratings_ibfk_3` FOREIGN KEY (`booking_Id`) REFERENCES `tblbooking` (`id`);

--
-- Constraints for table `tblusage`
--
ALTER TABLE `tblusage`
  ADD CONSTRAINT `booking_id` FOREIGN KEY (`booking_id`) REFERENCES `tblbooking` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
