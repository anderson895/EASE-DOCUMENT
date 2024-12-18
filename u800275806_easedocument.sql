-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 09, 2024 at 12:34 PM
-- Server version: 10.11.10-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u800275806_easedocument`
--

-- --------------------------------------------------------

--
-- Table structure for table `centralize_request`
--

CREATE TABLE `centralize_request` (
  `cr_id` int(11) NOT NULL,
  `cr_code` varchar(60) NOT NULL,
  `cr_1X1_pic` varchar(255) DEFAULT NULL,
  `cr_Signature` varchar(255) DEFAULT NULL,
  `cr_purpose` text NOT NULL,
  `cr_price` decimal(10,2) NOT NULL,
  `cr_shipping_fee` decimal(10,3) NOT NULL,
  `cr_total` decimal(10,3) NOT NULL,
  `cr_address` varchar(255) NOT NULL,
  `cr_payment` varchar(60) NOT NULL,
  `cr_validId` varchar(255) NOT NULL,
  `cr_proofResidency` varchar(255) DEFAULT NULL,
  `cr_r_id` int(11) NOT NULL,
  `cr_formtype` varchar(60) NOT NULL,
  `cr_request_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `cr_status` varchar(60) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `centralize_request`
--

INSERT INTO `centralize_request` (`cr_id`, `cr_code`, `cr_1X1_pic`, `cr_Signature`, `cr_purpose`, `cr_price`, `cr_shipping_fee`, `cr_total`, `cr_address`, `cr_payment`, `cr_validId`, `cr_proofResidency`, `cr_r_id`, `cr_formtype`, `cr_request_date`, `cr_status`) VALUES
(18, 'CR-674acedc76f6e0.95656341', 'pic_674acedc76902.jpg', 'signature_674acedc76903.png', 'for my id', 50.00, 0.000, 50.000, '634 marilao bulacan', 'Cash on Delivery', 'validId_674acedc768fd.png', 'proofResidency_674acedc76901.jpeg', 17, 'Barangay ID', '2024-11-30 08:40:21', 'Shipped'),
(19, 'CR-674acf3b0a69c4.84370270', NULL, NULL, 'for work', 50.00, 0.000, 50.000, 'Region III (Central Luzon) Bulacan Marilao Santa Rosa II tibagan', 'Cash on Delivery', 'validId_674acf3b0a34d.jpg', 'proofResidency_674acf3b0a354.jpeg', 17, 'Barangay Clearance', '2024-11-30 08:40:48', 'Delivered'),
(20, 'CR-674acfb6adc856.06902754', NULL, NULL, 'awdaw', 50.00, 0.000, 50.000, 'Region III (Central Luzon) Bulacan Marilao Santa Rosa II tibagan', 'Cash on Delivery', 'validId_674acfb6ada0f.jpg', NULL, 17, 'Barangay Residency', '2024-11-30 08:41:53', 'Rejected'),
(21, 'CR-674acfc71d3538.11932289', NULL, NULL, 'sfse', 50.00, 0.000, 50.000, 'Region III (Central Luzon) Bulacan Marilao Santa Rosa II tibagan', 'Cash on Delivery', 'validId_674acfc71d1a0.jpeg', NULL, 17, 'Barangay Indigency', '2024-12-09 06:22:53', 'Delivered');

-- --------------------------------------------------------

--
-- Table structure for table `resident`
--

CREATE TABLE `resident` (
  `r_id` int(11) NOT NULL,
  `r_fname` varchar(60) NOT NULL,
  `r_mname` varchar(60) DEFAULT NULL,
  `r_lname` varchar(60) NOT NULL,
  `r_profile` varchar(255) NOT NULL,
  `r_valid_ids` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `r_suffix` varchar(20) DEFAULT NULL,
  `r_gender` varchar(20) NOT NULL,
  `r_civil_status` varchar(20) NOT NULL,
  `r_citizenship` varchar(20) NOT NULL,
  `r_bday` date NOT NULL,
  `r_street` varchar(60) NOT NULL,
  `r_region` varchar(60) NOT NULL,
  `r_province` varchar(60) NOT NULL,
  `r_municipality` varchar(60) NOT NULL,
  `r_barangay` varchar(60) NOT NULL,
  `r_contact_number` varchar(60) NOT NULL,
  `r_email` varchar(60) NOT NULL,
  `r_password` varchar(255) NOT NULL,
  `r_status` int(10) NOT NULL DEFAULT 1 COMMENT '0=archive,1=Verified,2=NotVerified'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resident`
--

INSERT INTO `resident` (`r_id`, `r_fname`, `r_mname`, `r_lname`, `r_profile`, `r_valid_ids`, `r_suffix`, `r_gender`, `r_civil_status`, `r_citizenship`, `r_bday`, `r_street`, `r_region`, `r_province`, `r_municipality`, `r_barangay`, `r_contact_number`, `r_email`, `r_password`, `r_status`) VALUES
(17, 'joshua', 'raymundoss', 'padilla', 'file_674e8b622d31f6.81216367.jpg', 'file_674d7a0225c6e9.10522715.png', '', 'Female', 'Widowed', '', '2000-11-21', 'tibagans', 'Region III (Central Luzon)', 'Bulacans', 'marilao', 'Santa Rosa II', '09454454744', 'andersonandyResident@gmail.com', '4f5c8899c1752211dd331cc5a956903c2b77f517f5f4d704d164e35ab70fe0dd', 1),
(18, 'Mary sss', 'loi', 'Ricalde', 'file_674d79049d7f37.77014032.jpg', 'file_674d79ba0cdeb6.40318555.jpg', 'jr', 'Male', 'Married', '', '1991-11-06', 'eeeeeee', 'Region III (Central Luzon)', 'Bulacan', 'marilao', 'Santa Rosa II', '09454454744', 'apriljane@gmail.com', '81e9bb67d35131a8f3c8cc9b4fcea365241e9a236b9863253961717ebca2888d', 1),
(19, 'Denise', '', 'Esteban', 'file_674d7c3e2144d7.56967961.jpg', 'file_674d7c3e2160b1.60933829.jpeg', 'jr', 'Female', 'Single', '', '2000-12-02', 'awwadawdaw', 'Region III (Central Luzon)', 'Bulacan', 'Hagonoy', 'San Agustin', '09454445484', 'denise@gmail.com', '62f8132ed5903ec5ffb90973317cfe6fc15fbfa4e4729d28e92758c46e47ec08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_fname` varchar(60) NOT NULL,
  `user_mname` varchar(60) DEFAULT NULL,
  `user_lname` varchar(60) NOT NULL,
  `user_email` varchar(60) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_type` varchar(60) NOT NULL,
  `user_status` varchar(60) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_fname`, `user_mname`, `user_lname`, `user_email`, `user_password`, `user_type`, `user_status`) VALUES
(1, 'Joshua Andersonss', 'Raymundo', 'Padilla', 'admin@gmail.com', '7932b2e116b076a54f452848eaabd5857f61bd957fe8a218faf216f24c9885bb', 'admin', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `centralize_request`
--
ALTER TABLE `centralize_request`
  ADD PRIMARY KEY (`cr_id`),
  ADD KEY `rcl_r_id` (`cr_r_id`);

--
-- Indexes for table `resident`
--
ALTER TABLE `resident`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `centralize_request`
--
ALTER TABLE `centralize_request`
  MODIFY `cr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `resident`
--
ALTER TABLE `resident`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `centralize_request`
--
ALTER TABLE `centralize_request`
  ADD CONSTRAINT `centralize_request_ibfk_1` FOREIGN KEY (`cr_r_id`) REFERENCES `resident` (`r_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
