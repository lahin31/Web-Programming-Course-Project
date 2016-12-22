-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2016 at 10:30 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `w_programming`
--

-- --------------------------------------------------------

--
-- Table structure for table `animals_table`
--

CREATE TABLE `animals_table` (
  `id` int(11) NOT NULL,
  `Animal_Name` varchar(20) NOT NULL,
  `Animal_Type` varchar(10) NOT NULL,
  `Animal_Image` varchar(200) NOT NULL,
  `Animal_Details` varchar(300) NOT NULL,
  `Animal_Price` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `animals_table`
--

INSERT INTO `animals_table` (`id`, `Animal_Name`, `Animal_Type`, `Animal_Image`, `Animal_Details`, `Animal_Price`) VALUES
(11, 'Dufi', '[object Ob', '588089.', 'very good animal!', '2500'),
(12, 'dufi', 'Cow', '361692.', 'good', '777'),
(13, 'lali', 'Cow', '70205.', 'best', '50000'),
(14, 'Tushu', 'Cow', '663728.', 'good', '444'),
(15, 'cow', 'Goat', '348400.', 'sde', '222'),
(16, 'goT', 'Cow', '110265.', 'LOREMMMMMMMM', '12222'),
(17, 'Herman', 'Cow', '146392.', 'good', '1500'),
(18, 'Dufi', 'Cow', '36791.', 'ghdhdghb', '12222222'),
(19, 'jsiwi', 'Cow', '230110.', 'qqqq', '111111111111'),
(20, 'jsiwi', 'Cow', '741013.', 'qqqq', '111111111111'),
(21, 'Tushu', 'Cow', '478732.', 'kkkkkkkkk', '1000'),
(22, 'ffjeifjj', 'Cow', '429374.', 'jqdjqj', '122222222');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animals_table`
--
ALTER TABLE `animals_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animals_table`
--
ALTER TABLE `animals_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
