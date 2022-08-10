-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2021 at 02:16 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin_login`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`) VALUES
(1, 'test', '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_venues`
--

CREATE TABLE `tbl_add_venues` (
  `id` int(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `contact` bigint(20) NOT NULL,
  `facilities` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `photo` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_add_venues`
--

INSERT INTO `tbl_add_venues` (`id`, `name`, `address`, `contact`, `facilities`, `description`, `photo`) VALUES
(12, 'Sasha Banquet', 'NayaBazar', 9864462168, 'Music System,Parking', '[Morning Start Time: 7am]\r\n[Morning End Time: 3:00pm]\r\n[Evening Start Time: 5pm]\r\n[Evening End Time: 10PM]\r\n[Venue Closing Time:10pm]', 'sasha_banquet.jpg'),
(13, 'Paradise Banquet', 'Khusibu', 4351278, 'Music System,Parking', '[Morning Start Time: 7am]\r\n[Morning End Time: 4:00pm]\r\n[Evening Start Time: 5:30pm]\r\n[Evening End Time: 10PM]\r\n[Venue Closing Time:10pm]', 'paradise_banquet.jpg'),
(14, 'Swayambhu Star Banquet', 'Halchowk', 4672287, 'Music System,Parking', '[Morning Start Time: 7am]\r\n[Morning End Time: 3:30pm]\r\n[Evening Start Time: 5pm]\r\n[Evening End Time: 10PM]\r\n[Venue Closing Time:10pm]', 'swoyambhu_star_banquet.jpg'),
(15, 'Kalimati Banquet', 'Kalimati', 9851070836, 'Music System,Parking', '[Morning Start Time: 8am]\r\n[Morning End Time: 3:00pm]\r\n[Evening Start Time: 5:30pm]\r\n[Evening End Time: 9PM]\r\n[Venue Closing Time:9pm]', 'kalimati_banquet.jpg'),
(16, 'Friends Party Palace', 'Kalimati', 9841030748, 'Parking', '[Morning Start Time: 7am]\r\n[Morning End Time: 3:30pm]\r\n[Evening Start Time: 5pm]\r\n[Evening End Time: 10PM]\r\n[Venue Closing Time:10pm]', 'friends_party_palace.jpg'),
(17, 'Jasmine Party Palace', 'Nayabazar', 9803689903, 'Live Band,Parking', '[Morning Start Time: 8:30am]\r\n[Morning End Time: 4:00pm]\r\n[Evening Start Time: 5pm]\r\n[Evening End Time: 9:30PM]\r\n[Venue Closing Time:10pm]', 'jasmine_party_palace.jpg'),
(20, 'Chetrapati Party Palace', 'Chetrapati', 4215036, 'Music System,Parking', '[Morning Start Time: 7am]\r\n[Morning End Time: 3:30pm]\r\n[Evening Start Time: 5pm]\r\n[Evening End Time: 10PM]\r\n[Venue Closing Time:10pm]', 'chetrapati_party_palace.jpg'),
(34, 'Teku Party Palace', 'Teku,kathmandu', 42803089, 'Live Band,Music System', 'morning: 5:00pm', '1.new_venue.jpg'),
(35, 'Teku Party Palace', 'Teku', 14280308, 'Live Band,Music System', 'Morning: 8:00 am', '1.new_venue.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer_book`
--

CREATE TABLE `tbl_customer_book` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(255) NOT NULL,
  `c_contact` bigint(20) NOT NULL,
  `c_venue_select` varchar(255) NOT NULL,
  `c_shift` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_customer_book`
--

INSERT INTO `tbl_customer_book` (`c_id`, `c_name`, `c_contact`, `c_venue_select`, `c_shift`) VALUES
(2, 'Ram Prashad Chapagain', 9867123456, 'Nepa Banquet', 'morning'),
(3, 'Hari shakya', 9849654132, 'Chetrapati Party Palace', 'Morning'),
(4, 'Ramesh Maharjan', 9813767681, 'Swayambhu Star Banquet', 'morning'),
(5, 'Ramesh Ahdhikari ', 428008, 'Kalimati Banquet', 'Morning'),
(6, 'Rajani', 4675678, 'Paradise Banquet', 'evening'),
(8, 'Aadarsha Shakya', 4280308, 'Swayambhu Star Banquet', 'Evening'),
(10, 'Ram Parasad Pariyar', 9813678789, 'Chetrapati Party Palace', 'Evening'),
(11, 'Rohel Shakya', 9860939360, 'Swayambhu Star Banquet', 'Evening'),
(14, 'Ram Parasad Pariyar', 9813678789, 'Teku Party Palace', 'Evening');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_add_venues`
--
ALTER TABLE `tbl_add_venues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_customer_book`
--
ALTER TABLE `tbl_customer_book`
  ADD PRIMARY KEY (`c_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_add_venues`
--
ALTER TABLE `tbl_add_venues`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tbl_customer_book`
--
ALTER TABLE `tbl_customer_book`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
