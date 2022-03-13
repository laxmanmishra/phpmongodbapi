-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2022 at 06:01 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `visualez`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`) VALUES
(1, 'Atul Sharama'),
(2, 'Rajesh'),
(3, 'Raghav'),
(4, 'shivaya'),
(5, 'Minto'),
(6, 'Minto'),
(7, 'Minto'),
(8, 'Minto'),
(9, 'Minto'),
(10, 'Minto'),
(11, 'Minto'),
(12, 'Minto'),
(13, 'Minto'),
(14, 'Minto'),
(15, 'Minto'),
(16, 'Minto'),
(17, 'Minto'),
(18, 'Minto'),
(19, 'Minto'),
(20, 'Minto'),
(21, 'Minto'),
(22, 'Minto'),
(23, 'Minto'),
(24, 'Aman Bhai'),
(25, 'Aman Bhai'),
(26, 'Aman Bhai');

-- --------------------------------------------------------

--
-- Table structure for table `customer_details`
--

CREATE TABLE `customer_details` (
  `id` int(11) NOT NULL,
  `custid` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `phone` varchar(55) DEFAULT NULL,
  `address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_details`
--

INSERT INTO `customer_details` (`id`, `custid`, `name`, `phone`, `address`) VALUES
(1, 22, 'Minto', '213131313131', 'HCL Technologies Ltd. Technology Hub, SEZ Plot No. 3A, Sector 126. Noida – 201304, India'),
(2, 23, 'Minto', '213131313131', 'HCL Technologies Ltd. Technology Hub, SEZ Plot No. 3A, Sector 126. Noida – 201304, India'),
(3, 24, 'Aman Bhai', '213131313131', 'HCL Technologies Ltd. Technology Hub, SEZ Plot No. 3A, Sector 126. Noida – 201304, India'),
(4, 25, 'Aman Bhai', '213131313131', 'HCL Technologies Ltd. Technology Hub, SEZ Plot No. 3A, Sector 126. Noida – 201304, India'),
(5, 26, 'Aman Bhai', '213131313131', 'HCL Technologies Ltd. Technology Hub, SEZ Plot No. 3A, Sector 126. Noida – 201304, India');

-- --------------------------------------------------------

--
-- Table structure for table `customer_phone`
--

CREATE TABLE `customer_phone` (
  `id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `phone` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_phone`
--

INSERT INTO `customer_phone` (`id`, `cust_id`, `phone`) VALUES
(1, 1, '9454045599'),
(2, 1, '9454045510'),
(3, 2, '9454045999'),
(4, 7, ''),
(5, 8, ''),
(6, 12, ''),
(7, 13, ''),
(8, 14, ''),
(9, 15, ''),
(10, 16, ''),
(11, 17, ''),
(12, 18, ''),
(13, 19, ''),
(14, 20, ''),
(15, 21, ''),
(16, 22, ''),
(17, 23, ''),
(18, 24, ''),
(19, 25, ''),
(20, 26, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_details`
--
ALTER TABLE `customer_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_phone`
--
ALTER TABLE `customer_phone`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`cust_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `customer_details`
--
ALTER TABLE `customer_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer_phone`
--
ALTER TABLE `customer_phone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_phone`
--
ALTER TABLE `customer_phone`
  ADD CONSTRAINT `customer_id` FOREIGN KEY (`cust_id`) REFERENCES `customer` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
