-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2020 at 06:24 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `current_patient`
--

CREATE TABLE `current_patient` (
  `PAT_ID` int(11) NOT NULL,
  `PAT_NAME` varchar(50) NOT NULL,
  `PAT_ILLNESS` text NOT NULL,
  `PAT_INTIME` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `current_patient`
--

INSERT INTO `current_patient` (`PAT_ID`, `PAT_NAME`, `PAT_ILLNESS`, `PAT_INTIME`) VALUES
(1, 'sai', 'cough', '21:16:00'),
(2, 'penta', 'cough', '11:18:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `current_patient`
--
ALTER TABLE `current_patient`
  ADD PRIMARY KEY (`PAT_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `current_patient`
--
ALTER TABLE `current_patient`
  MODIFY `PAT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
