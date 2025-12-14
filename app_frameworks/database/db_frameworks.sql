-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 11, 2022 at 09:23 AM
-- Server version: 10.3.29-MariaDB-0+deb10u1
-- PHP Version: 7.3.19-1+eagle

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_frameworks`
--

-- --------------------------------------------------------

--
-- Table structure for table `frameworks`
--

CREATE TABLE `frameworks` (
  `no` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `bahasa` varchar(50) NOT NULL,
  `tahun` int(11) NOT NULL,
  `pengguna` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `frameworks`
--

INSERT INTO `frameworks` (`no`, `nama`, `bahasa`, `tahun`, `pengguna`) VALUES
(1, 'Pengsil', 'a', 122, 'abdi'),
(2, 'RUBY ON RAILS', 'RUBY', 2004, 'BUKALAPAK'),
(4, 'GIN', 'GOLANG', 2017, 'TOKOPEDIA'),
(5, 'NEXT JS', 'JAVASCRIPT', 2018, 'NIKE'),
(6, 'SPRING FRAMEWORK', 'JAVA', 2012, 'BLIBLI'),
(7, 'DJANGO', 'PYTHON', 2004, 'INSTAGRAM');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `no` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`no`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `frameworks`
--
ALTER TABLE `frameworks`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `frameworks`
--
ALTER TABLE `frameworks`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
