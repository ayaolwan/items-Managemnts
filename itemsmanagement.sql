-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 26, 2018 at 08:12 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `itemsmanagement`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `GetAllItems`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllItems` ()  BEGIN
   SELECT *  FROM items;
   END$$

DROP PROCEDURE IF EXISTS `items_add`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `items_add` (IN `in_name` VARCHAR(50) CHARSET utf8, IN `in_descrption` TEXT CHARSET utf8, IN `in_picture` VARCHAR(250) CHARSET utf8, IN `in_tags` VARCHAR(100) CHARSET utf8)  NO SQL
BEGIN
INSERT into `items`(Name,Description,Picture,Tags)
values(in_name,in_descrption,in_picture,in_tags);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Picture` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Tags` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`Id`, `Name`, `Description`, `Picture`, `Tags`) VALUES
(1, 'item one', 'item one item one item one', 'uploadsPictures\\2018\\03\\26/Items_e84424c3877fac4ed6fdc9355f9d00.jpeg', 'item');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
