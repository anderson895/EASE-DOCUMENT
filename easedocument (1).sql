-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2024 at 04:50 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `easedocument`
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
(7, 'CR-674a8525bc30e4.49240979', NULL, NULL, 'for work', 150.00, 50.000, 200.000, 'Region III (Central Luzon) Bulacan Marilao Santa Rosa II tibagan', 'Cash on Delivery', 'validId_674a8525bbfdf.png', 'proofResidency_674a8525bbfe4.jpeg', 17, 'Barangay Clearance', '2024-11-30 03:23:17', 'Pending');

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
(17, 'Joshua', 'Raymundo', 'Padilla', 'file_6749527f8c75e5.99803827.jpg', 'file_6749527f8caf87.76039446.png', '', 'Male', 'Married', '', '2000-11-21', 'tibagan', 'Region III (Central Luzon)', 'Bulacan', 'Marilao', 'Santa Rosa II', '09454454744', 'andersonandyResident@gmail.com', '4f5c8899c1752211dd331cc5a956903c2b77f517f5f4d704d164e35ab70fe0dd', 1);

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
(1, 'Joshua Anderson', 'Raymundo', 'Padilla', 'andersonandy046@gmail.com', '61e36b4d463fcf248af31898805050d4b137bb54e74c4e7e9b95b35ccb0f9753', 'admin', 'Active');

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
  MODIFY `cr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `resident`
--
ALTER TABLE `resident`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
