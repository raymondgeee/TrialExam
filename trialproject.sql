-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 30, 2021 at 04:33 AM
-- Server version: 5.7.28
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trialproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `sales_data`
--

DROP TABLE IF EXISTS `sales_data`;
CREATE TABLE IF NOT EXISTS `sales_data` (
  `productId` int(11) NOT NULL AUTO_INCREMENT,
  `product` varchar(200) NOT NULL,
  `stock` int(11) NOT NULL,
  `price` double(12,2) NOT NULL,
  PRIMARY KEY (`productId`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_data`
--

INSERT INTO `sales_data` (`productId`, `product`, `stock`, `price`) VALUES
(1, 'Product A', 10, 100.00),
(2, 'Product B', 13, 50.00),
(3, 'Product C', 4, 200.00);

-- --------------------------------------------------------

--
-- Table structure for table `sales_product`
--

DROP TABLE IF EXISTS `sales_product`;
CREATE TABLE IF NOT EXISTS `sales_product` (
  `salesId` int(11) NOT NULL AUTO_INCREMENT,
  `productId` int(11) NOT NULL,
  `price` double(12,2) NOT NULL,
  `qty` int(11) NOT NULL,
  PRIMARY KEY (`salesId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
