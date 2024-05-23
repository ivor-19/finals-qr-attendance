-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2024 at 07:00 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qr_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `adminName` varchar(200) NOT NULL,
  `adminEmail` varchar(200) NOT NULL,
  `adminPassword` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `adminName`, `adminEmail`, `adminPassword`) VALUES
(1, 'admin1', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `alloteddates`
--

CREATE TABLE `alloteddates` (
  `id` int(11) NOT NULL,
  `date` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alloteddates`
--

INSERT INTO `alloteddates` (`id`, `date`) VALUES
(1, 'All'),
(31, '05-03-2024'),
(33, '05-04-2024'),
(34, '05-05-2024'),
(40, '05-08-2024'),
(41, '05-09-2024'),
(42, '05-10-2024'),
(43, '05-11-2024'),
(44, '05-12-2024'),
(45, '05-13-2024'),
(46, '05-14-2024'),
(47, '05-15-2024'),
(48, '05-16-2024'),
(49, '05-18-2024'),
(50, '05-19-2024'),
(51, '05-21-2024'),
(52, '05-22-2024'),
(53, '05-23-2024'),
(54, '05-24-2024');

-- --------------------------------------------------------

--
-- Table structure for table `archives`
--

CREATE TABLE `archives` (
  `id` int(11) NOT NULL,
  `studentID` varchar(200) NOT NULL,
  `studentName` varchar(200) NOT NULL,
  `studentCS` varchar(200) NOT NULL,
  `qr` varchar(200) NOT NULL,
  `tikmeIN` varchar(122) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `archives`
--

INSERT INTO `archives` (`id`, `studentID`, `studentName`, `studentCS`, `qr`, `tikmeIN`) VALUES
(33, 'ref', '3453464', '23423424', 'doMvKKWj6q', '2024-05-04 04:54:33 PM'),
(39, 'asdqwdqw', '3453464', '23423424', 'kCrKsrGhBv', '2024-05-04 11:10:39 PM'),
(40, 'f', 'd', 'f', 'ES5E4oUEbC', '2024-05-04 11:10:42 PM'),
(41, 'new1', 'new1', 'new1', '6h9M4sfO3H', '2024-05-04 11:34:05 PM'),
(45, '54645', '3453464', '23423424', 'M9Gu2TEbu2', '2024-05-05 04:50:35 PM'),
(46, '686786', '678789', '789789', '0LGUeTV93t', '2024-05-05 04:56:37 PM'),
(47, '23R23R', 'EFWEF', 'WEFWEF', 'zbSKFH2m2s', '2024-05-05 04:56:39 PM'),
(48, 'aaaaaaaaaa', 'revrev', 'WEFWEF', 'z4JZJb4NmG', '2024-05-05 04:56:41 PM'),
(61, 'asdasd', 'wewef', 'wefewf', 'gmav2QvnZm', '2024-05-05 05:12:12 PM'),
(65, '', 'asd', 'qwd', 'jHI5bjC1lA', '2024-05-07 02:58:19 PM'),
(66, 'DENIENEIN', '3434', '3434', 'DNkWDh3osu', '2024-05-07 05:04:59 PM'),
(67, '987654', '', '', 'SIDJjak1la', '2024-05-07 06:20:04 PM'),
(68, 'efwefwfwefergerg', 'ergerg', 'erg', 'lnCk6N4Hrk', '2024-05-07 06:20:11 PM'),
(79, 'Eixisst', 'Eixisst', 'Eixisst', 'ao8J3QLQnb', '2024-05-09 09:24:06 PM'),
(80, 'ma2103e23', 'Ivor Cruz', 'BSIS-3D', 'r7gOYKGrTU', '2024-05-09 09:24:08 PM'),
(81, 'm45n65', 'n56n5', 'n6', 'DwGAoSimX0', '2024-05-09 09:24:10 PM'),
(82, 'iy,ij,uk,', 'u,ui,u', 'ti,ui,', 'f3QspKdJH4', '2024-05-09 09:24:12 PM'),
(83, 'wef', 'wef', 'qefwef3qff', '4OMV650JDt', '2024-05-09 09:24:14 PM'),
(84, 'mmmmmmmmmmmmm', 'mmmmm', 'mmmmmmmmmmmmmmmmmm', 'AnkCwNcX0E', '2024-05-09 09:24:16 PM'),
(85, 'asdeeeeee', 'wethyyhyh', 'qwdef', 'Aq8n2DXju1', '2024-05-09 09:24:19 PM'),
(86, 'trh', 'rth4t', 'wer', 'JGYRJfcSDk', '2024-05-22 12:56:27 AM');

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` int(11) NOT NULL,
  `studentName` varchar(200) NOT NULL,
  `studentCS` varchar(200) NOT NULL,
  `date` varchar(200) NOT NULL,
  `timeIn` varchar(200) NOT NULL,
  `qr` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `studentName`, `studentCS`, `date`, `timeIn`, `qr`) VALUES
(273, 'wqdqwd', 'qwdwqd', '05-03-2024', 'qw', 'wqd'),
(274, 'qwdwq', 'dwqd', '05-03-2024', 'wqd', 'qwd'),
(275, 'wevwe', 'vewv', '05-04-2024', 'qwqwd', 'qwd'),
(276, 'dvwsv', 'wevdsv', '05-04-2024', 'wqd', 'wqd'),
(277, 'qwdqw', 'dwqd', '05-04-2024', 'qwdwqd', 'qwd'),
(278, 'wvev', 'wqdqwd', '05-05-2024', 'qwdqwd', 'qwdwqd'),
(279, 'vwevwev', 'wevev', '05-05-2024', 'qwdevqf', 'qwdqwd'),
(284, 'wefwef', 'wefwef', '05-08-2024', 'qwdq', 'wdqwd'),
(285, 'we', 'wefwef', '05-08-2024', 'qwd', 'qwdwqd'),
(286, '-', '-', '05-21-2024', '-', '-'),
(287, 'Deniel Ivor Cruz', 'BSIS-3D', '05-21-2024', '12:06:10 AM', '3gSWttvKmM'),
(289, 'Adonis Antetokounmpo', 'BSIS-3D', '05-21-2024', '12:07:06 AM', 'H3K6V0xriU'),
(295, '-', '-', '05-22-2024', '-', '-'),
(296, 'Deniel Ivor Cruz', 'BSIS-3D', '05-22-2024', '11:03:26 AM', '3gSWttvKmM'),
(300, 'Lebrown Jeyms', 'NBA-210', '05-22-2024', '12:36:44 PM', 'zhldtYaITi'),
(301, 'Adonis Antetokounmpo', 'BSIS-3D', '05-22-2024', '12:37:06 PM', 'H3K6V0xriU'),
(309, '-', '-', '05-23-2024', '-', '-'),
(310, 'Adonis Antetokounmpo', 'BSIS-3D', '05-23-2024', '01:44:36 PM', 'H3K6V0xriU'),
(312, 'Deniel Ivor Cruz', 'BSIS-3D', '05-23-2024', '02:47:05 PM', '3gSWttvKmM'),
(313, 'James Warren Dela Cruz YE', 'BSIS-3D', '05-23-2024', '10:43:27 PM', '1FEI5fefFQ'),
(317, '-', '-', '05-24-2024', '-', '-');

-- --------------------------------------------------------

--
-- Table structure for table `attendyesterdays`
--

CREATE TABLE `attendyesterdays` (
  `id` int(11) NOT NULL,
  `studentName` varchar(200) NOT NULL,
  `studentCS` varchar(200) NOT NULL,
  `timeIn` varchar(200) NOT NULL,
  `qr` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendyesterdays`
--

INSERT INTO `attendyesterdays` (`id`, `studentName`, `studentCS`, `timeIn`, `qr`) VALUES
(5, '-', '-', '-', '-'),
(6, 'Deniel Ivor Cruz', 'BSIS-3D', '2024-05-12 12:50:13 AM', '3gSWttvKmM'),
(7, 'rth4t', 'wer', '2024-05-12 12:50:05 AM', 'JGYRJfcSDk'),
(8, 'Adonis Antetokounmpo', 'BSIS-3D', '2024-05-12 12:49:55 AM', 'H3K6V0xriU'),
(9, '-', '-', '-', '-'),
(10, 'Deniel Ivor Cruz', 'BSIS-3D', '11:05:24 PM', '3gSWttvKmM'),
(11, 'Adonis Antetokounmpo', 'BSIS-3D', '11:04:34 PM', 'H3K6V0xriU'),
(12, 'Deniel Ivor Cruz', 'BSIS-3D', '11:04:24 PM', '3gSWttvKmM'),
(13, '-', '-', '-', '-'),
(14, 'srgb', 'bfb', 'erv', 'erbsebr'),
(15, '-', '-', '-', '-');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `studentID` varchar(200) NOT NULL,
  `studentName` varchar(70) NOT NULL,
  `studentCS` varchar(70) NOT NULL,
  `qr` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `studentID`, `studentName`, `studentCS`, `qr`) VALUES
(1, 'ma21011504', 'Deniel Ivor Cruz', 'BSIS-3D', '3gSWttvKmM'),
(2, 'ma21121212', 'Adonis Antetokounmpo', 'BSIS-3D', 'H3K6V0xriU'),
(5, 'ma21222332', 'Son Gokusss', 'BSIS-2DA', 'EKF3IGq9Qy'),
(6, 'ma21012111', 'Lebrown Jeyms', 'NBA-210', 'zhldtYaITi'),
(7, 'Test01', 'Test01', 'Test01', 'targh8LXQo'),
(8, 'wrvreverb', 'erberb', 'erberb', '6QfDkpdc4L'),
(9, 'wegewg', 'wefw', 'wefewf', 'eN8c9HDWxU'),
(10, 'wegerg', 'argaerg', 'argar', 'TnWC6R5EG0'),
(11, 'rtntr', 'nrstns', 'srtnsrtn', 'do0TMQp2x1'),
(12, '43b34b', '3b34b', 'erebeb', 'XEHX1w3TMt'),
(13, '34brb', 'abearba', 'earberb', 'HOSobyQNPa'),
(14, 'erger', 'greg', 'rgear', 't2kCEOWJSQ'),
(15, 'e erb', 'erber', 'berb', 'N7n16FI8OH'),
(16, 'hlhu', 'jhkh', 'jhk', 'HiCpGmbso1'),
(19, 'ma21011110', 'James Warren Dela Cruz YE', 'BSIS-3D', '1FEI5fefFQ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alloteddates`
--
ALTER TABLE `alloteddates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `archives`
--
ALTER TABLE `archives`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendyesterdays`
--
ALTER TABLE `attendyesterdays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `alloteddates`
--
ALTER TABLE `alloteddates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `archives`
--
ALTER TABLE `archives`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=318;

--
-- AUTO_INCREMENT for table `attendyesterdays`
--
ALTER TABLE `attendyesterdays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
