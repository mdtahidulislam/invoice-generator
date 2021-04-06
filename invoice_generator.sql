-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2021 at 02:56 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `invoice_generator`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl`
--

CREATE TABLE `tbl` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl`
--

INSERT INTO `tbl` (`id`, `name`) VALUES
(1, 'md. tahidul islam'),
(2, 'md. tahidul islam'),
(3, 'md. tahidul islam'),
(4, 'md. tahidul islam'),
(5, 'md. tahidul islam'),
(6, 'md. tahidul islam'),
(7, 'md. tahidul islam'),
(8, 'md. tahidul islam'),
(9, 'md. tahidul islam'),
(10, 'md. tahidul islam'),
(11, 'md. tahidul islam'),
(12, 'md. tahidul islam'),
(13, 'Sss'),
(14, 'r'),
(15, 'tt7675646446');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_info`
--

CREATE TABLE `tbl_info` (
  `iid` int(11) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `fromto` varchar(255) NOT NULL,
  `billto` varchar(255) NOT NULL,
  `shipto` varchar(255) NOT NULL,
  `invdate` date NOT NULL,
  `payterms` varchar(255) NOT NULL,
  `duedate` date NOT NULL,
  `notes` varchar(255) NOT NULL,
  `terms` varchar(255) NOT NULL,
  `tax` decimal(6,2) NOT NULL,
  `discount` decimal(6,2) NOT NULL,
  `shipping` decimal(6,2) NOT NULL,
  `paidamount` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_info`
--

INSERT INTO `tbl_info` (`iid`, `logo`, `fromto`, `billto`, `shipto`, `invdate`, `payterms`, `duedate`, `notes`, `terms`, `tax`, `discount`, `shipping`, `paidamount`) VALUES
(1, '', 'sdasda', '', '', '0000-00-00', 'adasd', '0000-00-00', '', '', '0.00', '0.00', '0.00', '0.00'),
(2, '', 'dasd', '', '', '0000-00-00', 'asdasd', '0000-00-00', '', '', '0.00', '0.00', '0.00', '0.00'),
(3, '', 'sadasd', '', '', '0000-00-00', 'adsasd', '0000-00-00', '', '', '0.00', '0.00', '0.00', '0.00'),
(4, '', 'sdasd', '', '', '0000-00-00', 'adasd', '0000-00-00', '', '', '0.00', '0.00', '0.00', '0.00'),
(5, '', 'dasd', '', '', '0000-00-00', 'adasd', '0000-00-00', '', '', '0.00', '0.00', '0.00', '0.00'),
(6, '', '', '', '', '0000-00-00', 'dasd', '0000-00-00', '', '', '0.00', '0.00', '0.00', '0.00'),
(7, '', '', '', '', '0000-00-00', 'dasdads', '0000-00-00', '', '', '0.00', '0.00', '0.00', '0.00'),
(8, '', '', '', '', '0000-00-00', 'dadsa', '0000-00-00', '', '', '0.00', '0.00', '0.00', '0.00'),
(9, '', '', '', '', '2021-04-01', 'adasd', '0000-00-00', '', '', '0.00', '0.00', '0.00', '0.00'),
(10, '', '', '', '', '0000-00-00', 'da', '0000-00-00', '', '', '0.00', '0.00', '0.00', '0.00'),
(11, '', 'zeropoint', 'agfjgsjfgj', 'sadfsadf', '2021-04-04', 'sdfsadf', '2021-04-05', 'sfdfdsf', '', '2.00', '0.00', '0.00', '12.00'),
(12, '', 'adasd', 'asda', 'das', '2021-04-04', 'dasd', '2021-04-05', '', '', '3.00', '0.00', '0.00', '12.00'),
(13, '', 'asasfdasf', 'dsfsadf', 'sdfasf', '2021-04-04', 'asfdasf', '2021-04-05', '', '', '32.00', '0.00', '0.00', '123.00'),
(14, 'assets/images/uploads/0f01f2956e.', 'asdfasdf', 'sfdsdfsfd', 'sdfsadfsadf', '2021-04-04', 'dfsdfsdf', '2021-04-05', '', '', '5.00', '0.00', '0.00', '45.00'),
(15, 'uploads/37f7d1dede.', '', '', '', '2021-04-04', 'asdasd', '2021-04-05', '', '', '0.00', '0.00', '0.00', '0.00'),
(16, 'uploads/916bf4bc64.', '', '', '', '2021-04-04', 'asdasd', '2021-04-05', '', '', '0.00', '0.00', '0.00', '0.00'),
(17, 'uploads/12237567b4.', '', '', '', '2021-04-04', 'asdasd', '2021-04-05', '', '', '0.00', '0.00', '0.00', '0.00'),
(18, 'uploads/0ae9345ca2.', '', '', '', '2021-04-04', 'asdasfsdfd', '2021-04-05', '', '', '0.00', '0.00', '0.00', '0.00'),
(19, 'uploads/a935b073c4.', '', '', '', '2021-04-04', 'asdasfsdfd', '2021-04-05', '', '', '0.00', '0.00', '0.00', '0.00'),
(20, 'uploads/b72c8d6f1d.', '', '', '', '2021-04-04', 'fzsdfsf', '2021-04-05', '', '', '0.00', '0.00', '0.00', '0.00'),
(21, 'uploads/bf48483248.', '', '', '', '2021-04-04', 'fzsdfsf', '2021-04-05', '', '', '0.00', '0.00', '0.00', '0.00'),
(22, 'uploads/a5961c743c.', '', '', '', '2021-04-04', 'fzsdfsf', '2021-04-05', '', '', '0.00', '0.00', '0.00', '0.00'),
(23, 'uploads/a6a1075149.', '', '', '', '2021-04-04', 'fzsdfsf', '2021-04-05', '', '', '0.00', '0.00', '0.00', '0.00'),
(24, 'uploads/31e00fb42a.', '', '', '', '2021-04-04', 'fzsdfsf', '2021-04-05', '', '', '0.00', '0.00', '0.00', '0.00'),
(25, 'uploads/95f8b73d18.', '', '', '', '2021-04-04', 'fzsdfsf', '2021-04-05', '', '', '0.00', '0.00', '0.00', '0.00'),
(26, 'uploads/a42fa57f14.', '', '', '', '2021-04-04', 'adasd', '2021-04-05', '', '', '0.00', '0.00', '0.00', '0.00'),
(27, 'uploads/e3f69a2044.', '', '', '', '2021-04-04', 'adasd', '2021-04-05', '', '', '0.00', '0.00', '0.00', '0.00'),
(28, 'uploads/c0c3d7879d.', '', '', '', '2021-04-04', 'adasd', '2021-04-05', '', '', '0.00', '0.00', '0.00', '0.00'),
(29, '', '', '', '', '2021-04-04', 'adasd', '2021-04-05', '', '', '0.00', '0.00', '0.00', '0.00'),
(30, 'uploads/451e770c42.', '', '', '', '2021-04-04', 'adasd', '2021-04-05', '', '', '0.00', '0.00', '0.00', '0.00'),
(31, 'uploads/ca63d60839.', '', '', '', '2021-04-04', 'adasd', '2021-04-05', '', '', '0.00', '0.00', '0.00', '0.00'),
(32, 'uploads/956def0809.', '', '', '', '2021-04-04', 'adasd', '2021-04-05', '', '', '0.00', '0.00', '0.00', '0.00'),
(33, 'uploads/233a702b4f.', '', '', '', '2021-04-04', 'adasd', '2021-04-05', '', '', '0.00', '0.00', '0.00', '0.00'),
(34, 'uploads/d5dcbef4ae.', '', '', '', '2021-04-04', 'adasd', '2021-04-05', '', '', '0.00', '0.00', '0.00', '0.00'),
(35, 'uploads/8958384001.png', '', '', '', '2021-04-04', 'adasd', '2021-04-05', '', '', '0.00', '0.00', '0.00', '0.00'),
(36, 'assets/images/uploads/98416b24eb.png', '', '', '', '2021-04-04', 'adasd', '2021-04-05', '', '', '0.00', '0.00', '0.00', '0.00'),
(37, 'assets/images/uploads/151295a2d6.png', '', '', '', '2021-04-04', 'adasd', '2021-04-05', '', '', '0.00', '0.00', '0.00', '0.00'),
(38, 'assets/images/uploads/a1ee5a6944.png', '', '', '', '2021-04-04', 'adasd', '2021-04-05', '', '', '0.00', '0.00', '0.00', '0.00'),
(39, 'assets/images/uploads/826994fce6.png', '', '', '', '2021-04-04', 'adasd', '2021-04-06', '', '', '0.00', '0.00', '0.00', '0.00'),
(40, 'assets/images/uploads/5bb96d14a7.', '', '', '', '2021-04-06', 'adasd', '2021-04-07', '', '', '0.00', '0.00', '0.00', '0.00'),
(41, 'assets/images/uploads/d193ff9e14.', '', '', '', '2021-04-06', 'adasd', '2021-04-07', '', '', '0.00', '0.00', '0.00', '0.00'),
(42, 'assets/images/uploads/b6003736e7.', '', '', '', '2021-04-06', 'adasd', '2021-04-07', '', '', '0.00', '0.00', '0.00', '0.00'),
(43, 'assets/images/uploads/bdbaa6d7e6.', '', '', '', '2021-04-06', 'adasd', '2021-04-07', '', '', '0.00', '0.00', '0.00', '0.00'),
(44, 'assets/images/uploads/185ded75a7.', '', '', '', '2021-04-06', 'adasd', '2021-04-07', '', '', '0.00', '0.00', '0.00', '0.00'),
(45, 'assets/images/uploads/4b9c4d17c3.', 'zeropoint', 'titu', 'rajshahi', '2021-04-06', 'demo', '2021-04-07', 'demo notes', 'demo terms', '2.00', '0.00', '0.00', '12.00'),
(46, 'assets/images/uploads/be56a34824.', 'zeropoint', 'titu', 'rajshahi', '2021-04-06', 'demo', '2021-04-07', 'demo notes', 'demo terms', '2.00', '0.00', '0.00', '12.00'),
(47, 'assets/images/uploads/be56a34824.', 'zeropoint', 'titu', 'rajshahi', '2021-04-06', 'demo', '2021-04-07', 'demo notes', 'demo terms', '2.00', '0.00', '0.00', '12.00'),
(48, 'assets/images/uploads/be56a34824.', 'zeropoint', 'titu', 'rajshahi', '2021-04-06', 'demo', '2021-04-07', 'demo notes', 'demo terms', '2.00', '0.00', '0.00', '12.00'),
(49, 'assets/images/uploads/93eed54f5f.', '', '', '', '2021-04-06', 'adasd', '2021-04-07', '', '', '0.00', '0.00', '0.00', '0.00'),
(50, 'assets/images/uploads/93eed54f5f.', '', '', '', '2021-04-06', 'adasd', '2021-04-07', '', '', '0.00', '0.00', '0.00', '0.00'),
(51, 'assets/images/uploads/fa5273f3cb.', 'zeropoint', 'titu', 'raj', '2021-04-06', 'adasd', '2021-04-07', 'asda', 'dasd', '9.00', '0.00', '0.00', '12.00'),
(52, 'assets/images/uploads/244881ddbc.', 'fasf', 'sfdsd', 'sdfs', '2021-04-06', 'sdfsadf', '2021-04-07', 'rwer', 'werwer', '45.00', '0.00', '0.00', '4.00'),
(53, 'assets/images/uploads/94359f370c.', '', '', '', '2021-04-06', 'adasd', '2021-04-07', '', '', '0.00', '0.00', '0.00', '0.00'),
(54, 'assets/images/uploads/05cd4c863f.', '', '', '', '2021-04-06', 'adasd', '2021-04-07', '', '', '0.00', '0.00', '0.00', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item`
--

CREATE TABLE `tbl_item` (
  `id` int(11) NOT NULL,
  `item` varchar(255) NOT NULL,
  `quantity` int(50) NOT NULL,
  `rate` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_item`
--

INSERT INTO `tbl_item` (`id`, `item`, `quantity`, `rate`) VALUES
(1, 'item2', 22, '1.00'),
(2, 'item1', 1, '11.00'),
(3, 'dsf', 2, '2.00'),
(4, '', 0, '0.00'),
(5, '', 0, '0.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl`
--
ALTER TABLE `tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_info`
--
ALTER TABLE `tbl_info`
  ADD PRIMARY KEY (`iid`);

--
-- Indexes for table `tbl_item`
--
ALTER TABLE `tbl_item`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl`
--
ALTER TABLE `tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_info`
--
ALTER TABLE `tbl_info`
  MODIFY `iid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `tbl_item`
--
ALTER TABLE `tbl_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;