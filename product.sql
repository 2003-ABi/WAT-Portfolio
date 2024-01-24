-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 24, 2024 at 07:38 AM
-- Server version: 5.7.23-23
-- PHP Version: 8.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `abhipoud_77356791`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `cid` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` int(255) NOT NULL,
  `filename` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `cid`, `name`, `description`, `price`, `filename`) VALUES
(18, 'Nike', 'Nike Airforce1 Low Retro', 'Available in all sizes', 300, 'nike-air-force-1-low-retro-shoes-gkT3ck.png'),
(19, 'Nike', 'Nike Alpha Trainer 5', 'Available in all sizes', 150, 'nike-air-max-alpha-trainer-5-workout-shoes.jpg'),
(20, 'Nike', 'Nike Dunk Low Retro', 'Available in all sizes', 220, 'dunk-low-retro-shoe-66RGqF.png'),
(21, 'Nike', 'Nike Revolution7 Easy', 'Available in all sizes', 180, 'nike-revolution-7-easyon-road-running-shoes.png'),
(22, 'Adidas', 'Adidas BYW Select', 'Available in all sizes', 190, 'adidas-BYW_Select_Shoes_Black_IF0006_04_standard.png'),
(23, 'Adidas', 'Adidas Trae Unlimited', 'Available in all sizes', 220, 'adidas-Trae_Unlimited_Basketball_Shoes_Grey_IF5610_04_standard.png'),
(24, 'Adidas', 'Adidas Select Basketball', 'Available in all sizes', 400, 'adidas-BYW_Select_Basketball_Shoes_Green_IG4948_04_standard.png'),
(25, 'Adidas', 'Adidas Basketball Beige', 'Available in all sizes', 290, 'adidas-BYW_Select_Basketball_Shoes_Beige_IE9307_04_standard.png'),
(26, 'NewBalance', 'New Balance BB550 PHD', 'Available in all sizes', 95, 'nb-bb550phd_nb_02_i.png'),
(27, 'NewBalance', 'New Balance Two WXY V4', 'Available in all sizes', 220, 'nb-two-wxy-v4.png'),
(28, 'NewBalance', 'New Balance BB650RX1', 'Available in all sizes', 150, 'nb-bb650rx1_nb_02_i.png'),
(29, 'NewBalance', 'New Balance BB480LBA', 'Available in all sizes', 230, 'bb480lba_nb_02_i.png'),
(30, 'Skechers', 'Skechers Float 253000', 'Available in all sizes', 170, 'sk-float-253000_BKOR.png'),
(31, 'Skechers', 'Skechers Grill Captain 237447', 'Available in all sizes', 245, 'sk-grill-captain-237447_WNV.png'),
(32, 'Skechers', 'Skechers Resagrip 253005', 'Available in all sizes', 235, 'sk-resagrip-253005_WBO.png'),
(33, 'Skechers', 'Skechers Rickter 204911', 'Available in all sizes', 185, 'sk-rickter-204911_GRY.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
