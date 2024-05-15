-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2024 at 12:01 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbfinalproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblaccount`
--

CREATE TABLE `tblaccount` (
  `id` int(11) NOT NULL,
  `fldlastname` varchar(200) DEFAULT NULL,
  `fldgivenname` varchar(200) DEFAULT NULL,
  `fldemail` varchar(200) DEFAULT NULL,
  `fldcontact` varchar(200) DEFAULT NULL,
  `fldaddress` varchar(200) DEFAULT NULL,
  `fldbday` varchar(200) DEFAULT NULL,
  `flduser` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `fldposition` varchar(200) DEFAULT NULL,
  `fldprofilepic` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblaccount`
--

INSERT INTO `tblaccount` (`id`, `fldlastname`, `fldgivenname`, `fldemail`, `fldcontact`, `fldaddress`, `fldbday`, `flduser`, `password`, `fldposition`, `fldprofilepic`) VALUES
(1, 'hshs', 'Aki', 'Mark@yahoo.com', '09937006750', 'Tangob, Padre Garcia Batangas', '1111-11-11', 'Admin', '1234', 'Admin', '66445f2893613.png'),
(2, 'Carubuio', 'Ma. Bridget Faye', 'Faye@gmail.com', '12345678910', 'Arawan, San Antonio Quezon', '1111-11-11', 'Cashier', '1234', 'Cashier', '66445f555a47b.jpg'),
(3, 'Ramos', 'Nathaniel Patrick', 'Nath@gmail.com', '0123456789', 'Alupay, Rosario Batangas', '2311-12-31', 'Purchasing officer', '1234', 'Purchasing Officer', '66445f780c506.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tblproduct`
--

CREATE TABLE `tblproduct` (
  `fldproduct` varchar(200) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `flddate` varchar(200) DEFAULT NULL,
  `fldquantity` varchar(200) DEFAULT NULL,
  `fldunitprice` varchar(200) DEFAULT NULL,
  `fldtotalprice` varchar(200) DEFAULT NULL,
  `fldtype` varchar(200) DEFAULT NULL,
  `fldvariance` varchar(200) DEFAULT NULL,
  `fldreason` varchar(200) DEFAULT NULL,
  `fldcurrentStock` varchar(200) DEFAULT NULL,
  `flddestination` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblrequest`
--

CREATE TABLE `tblrequest` (
  `id` int(11) NOT NULL,
  `fldrequestor` varchar(200) DEFAULT NULL,
  `flddate` varchar(200) DEFAULT NULL,
  `flddatereq` varchar(200) DEFAULT NULL,
  `fldpurpose` varchar(200) DEFAULT NULL,
  `fldproduct` varchar(200) DEFAULT NULL,
  `fldquantity` varchar(200) DEFAULT NULL,
  `flddesc` varchar(200) DEFAULT NULL,
  `flduprice` varchar(200) DEFAULT NULL,
  `fldtprice` varchar(200) DEFAULT NULL,
  `fldsupplier` varchar(200) DEFAULT NULL,
  `fldstatus` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblstock`
--

CREATE TABLE `tblstock` (
  `id` int(11) NOT NULL,
  `fldproduct` varchar(200) DEFAULT NULL,
  `fldquantity` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblstock`
--

INSERT INTO `tblstock` (`id`, `fldproduct`, `fldquantity`) VALUES
(1, 'Burger', '100'),
(2, 'Spaghetti', '99');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblaccount`
--
ALTER TABLE `tblaccount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblproduct`
--
ALTER TABLE `tblproduct`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblrequest`
--
ALTER TABLE `tblrequest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblstock`
--
ALTER TABLE `tblstock`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblaccount`
--
ALTER TABLE `tblaccount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblproduct`
--
ALTER TABLE `tblproduct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblrequest`
--
ALTER TABLE `tblrequest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblstock`
--
ALTER TABLE `tblstock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
