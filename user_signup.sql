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
-- Table structure for table `user_signup`
--

CREATE TABLE `user_signup` (
  `id` int(11) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `User_Name` varchar(10) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Confirm_Password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_signup`
--

INSERT INTO `user_signup` (`id`, `Name`, `User_Name`, `Email`, `Password`, `Confirm_Password`) VALUES
(1, 'Lahin Hussain', 'lahin31', 'muhammad.lahin@gmail.com', '$2y$10$.5eA9sd3SVUi5ElbNq0joe.By/zLjb48Zfoh6yOxAkALWU6fQihWm', '$2y$10$.5eA9sd3SVUi5ElbNq0joe.By/zLjb48Zfoh6yOxAkALWU6fQihWm'),
(2, 'Muhammad Ali', 'ali', 'ali@gmail.com', '$2y$10$Z/oq.sEQhVgfn4cnW4zGQ.t77hHrUSMcHmeZLmwgzLGmWXxwU3lbO', '$2y$10$Z/oq.sEQhVgfn4cnW4zGQ.t77hHrUSMcHmeZLmwgzLGmWXxwU3lbO'),
(3, 'shaju', 'shaju4', 'shaju@gmail.com', '$2y$10$0nwDseCD3n4Gc1RBWKQUr.Mv8B.P5loge7nOnDeTvU5MJwu1mqgm.', '$2y$10$0nwDseCD3n4Gc1RBWKQUr.Mv8B.P5loge7nOnDeTvU5MJwu1mqgm.'),
(4, 'Muhammad Hussain', 'hussain', 'hussain@gmail.com', '$2y$10$/L4Hc/Mn2A1ov4tgtQWLdugT/TMEG3CTazEwndTngfJZ6H95oRKF2', '$2y$10$/L4Hc/Mn2A1ov4tgtQWLdugT/TMEG3CTazEwndTngfJZ6H95oRKF2'),
(5, 'N', 'N', 'k@s', '$2y$10$sqO.TBt8UrBUUwq1/BdiuuHDzGz3Ibds37g8/Sx6OPQqH07sofKmq', '$2y$10$sqO.TBt8UrBUUwq1/BdiuuHDzGz3Ibds37g8/Sx6OPQqH07sofKmq');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_signup`
--
ALTER TABLE `user_signup`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_signup`
--
ALTER TABLE `user_signup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
