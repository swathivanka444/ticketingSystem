-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 09, 2022 at 11:05 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ticketingSystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `movieBookings`
--

CREATE TABLE `movieBookings` (
  `sno` int(255) NOT NULL,
  `ticketID` varchar(255) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `movieName` varchar(255) NOT NULL,
  `movieParticulars` varchar(255) NOT NULL,
  `seatPattern` varchar(255) NOT NULL,
  `isEntered` int(255) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movieBookings`
--

INSERT INTO `movieBookings` (`sno`, `ticketID`, `userName`, `movieName`, `movieParticulars`, `seatPattern`, `isEntered`) VALUES
(1, 'VK001', 'jagadeesh4308@gmail.com', 'VIKRAM', '15-07-2022_11:00PM', 'D-8, D-9', 1),
(2, 'VK002', 'n170142@rguktn.ac.in', 'VIKRAM', '15-07-2022_11:00PM', 'C-17, C-18, C-19', 1),
(3, 'DON001', 'jagadeesh4308@gmail.com', 'DON', '20-07-2022_8:00PM', 'C-4, C-5, C-6', 0),
(4, 'DON002', 'jagadeesh4308@gmail.com', 'DON', '20-07-2022_8:00PM', 'E-16, E-17, E-18', 0),
(5, 'VK003', 'jagadeesh4308@gmail.com', 'Vikram', '15-07-2022_11:00PM', 'C-8, C-9, C-10', 1),
(6, 'DON003', 'jagadeesh4308@gmail.com', 'DON', '15-07-2022_2:00PM', 'D-6, D-7, E-7', 0),
(7, 'RRR001', 'jagadeesh4308@gmail.com', 'RRR', '20-07-2022_3:00PM', 'E-10, E-11, E-12, E-13', 0),
(8, 'RRR002', 'n170142@rguktn.ac.in', 'RRR', '20-07-2022_3:00PM', 'O-5, O-6, O-7', 0);

-- --------------------------------------------------------

--
-- Table structure for table `movieSeatPattern`
--

CREATE TABLE `movieSeatPattern` (
  `sno` int(255) NOT NULL,
  `movieName` varchar(255) NOT NULL,
  `movieCode` varchar(255) NOT NULL,
  `movieDate` varchar(255) NOT NULL,
  `movieDescription` text NOT NULL,
  `ticketCost` int(255) NOT NULL,
  `moviePoster` varchar(1000) NOT NULL,
  `movieTrailer` varchar(1000) DEFAULT NULL,
  `slot1` text DEFAULT NULL,
  `slot2` text DEFAULT NULL,
  `slot3` text DEFAULT NULL,
  `slot4` text DEFAULT NULL,
  `isRegistrationsOpened` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movieSeatPattern`
--

INSERT INTO `movieSeatPattern` (`sno`, `movieName`, `movieCode`, `movieDate`, `movieDescription`, `ticketCost`, `moviePoster`, `movieTrailer`, `slot1`, `slot2`, `slot3`, `slot4`, `isRegistrationsOpened`) VALUES
(3, 'DON', 'DON', '15-07-2022', 'Starring Shiva Kartikeyan\r\nMusic: Anirudh Ravichander', 0, 'don.jpeg', 'https://www.youtube.com/embed/s5ak-NY6OC8', '2:00PM#0000000000_0000000000_0000000000_0000011000_0000001000_0000000000_0000000000_0000000000_0000000000_0000000000_0000000000_0000000000_0000000000_0000000000_0000000000', '', '', '', 0),
(4, 'RRR', 'RRR', '20-07-2022', 'Starring NTR, Ram Charan, Alia Bhatt\r\n\r\nDirected by SS Rajamouli', 0, 'rrr.jpg', 'https://www.youtube.com/embed/NgBoMJy386M?controls=0', '3:00PM#000000000000000_000000000000000_000000000000000_000000000000000_000000000111100_000000000000000_000000000000000_000000000000000_000000000000000_000000000000000_000000000000000_000000000000000_000000000000000_000000000000000_000011100000000', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `sno` int(255) NOT NULL,
  `usrEmail` varchar(255) NOT NULL,
  `usrID` varchar(255) NOT NULL,
  `usrContact` varchar(255) NOT NULL,
  `usrPwd` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`sno`, `usrEmail`, `usrID`, `usrContact`, `usrPwd`) VALUES
(1, 'jagadeesh4308@gmail.com', 'admin@src', '9177813632', '202cb962ac59075b964b07152d234b70'),
(2, 'n170142@rguktn.ac.in', 'N170142', '8897501029', '202cb962ac59075b964b07152d234b70');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `movieBookings`
--
ALTER TABLE `movieBookings`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `movieSeatPattern`
--
ALTER TABLE `movieSeatPattern`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`sno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `movieBookings`
--
ALTER TABLE `movieBookings`
  MODIFY `sno` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `movieSeatPattern`
--
ALTER TABLE `movieSeatPattern`
  MODIFY `sno` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `sno` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
