-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2021 at 06:55 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblproduct`
--

CREATE TABLE `tblproduct` (
  `id` int(8) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `price` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblproduct`
--

INSERT INTO `tblproduct` (`id`, `name`, `code`, `image`, `price`) VALUES
(1, 'Muffins', 'Muf01', 'product-images/muffins.jpeg', 2.50),
(2, 'Cookies', 'COK01', 'product-images/cookies.jpeg', 5.00),
(3, 'Cake', 'CAK01', 'product-images/cakes.jpeg', 10.00),
(4, 'Bread', 'BRD01', 'product-images/breads.jpeg', 3.50),
(5, 'Brownies', 'BRW01', 'product-images/brownies.jpeg', 2.00),
(6, 'Croissants', 'CRO01', 'product-images/croissants.jpeg', 6.00),
(7, 'Eclairs', 'ECR01', 'product-images/Eclairs.jpeg', 5.00),
(8, 'Fruit Tarts and Pies', 'FTP01', 'product-images/fruit.jpeg', 10.00),
(9, 'Lamingtons', 'LAM01', 'product-images/lamingtons.jpeg', 4.00),
(10, 'Macaroons', 'MAC01', 'product-images/macaroons.jpeg', 10.00),
(11, 'Savoury Pies', 'SAP01', 'product-images/savoury pies.jpeg', 5.00),
(12, 'Pie roll', 'PRL01', 'product-images/roll.jpg', 4.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblproduct`
--
ALTER TABLE `tblproduct`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_code` (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblproduct`
--
ALTER TABLE `tblproduct`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
