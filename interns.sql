-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2024 at 10:48 AM
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
-- Database: `interns`
--

-- --------------------------------------------------------

--
-- Table structure for table `mss_emergency_reports`
--

CREATE TABLE `mss_emergency_reports` (
  `id` int(11) NOT NULL,
  `informant` varchar(250) NOT NULL,
  `mobile_number` varchar(250) NOT NULL,
  `location_of_the_incident` varchar(250) NOT NULL,
  `type_of_emergency` varchar(250) NOT NULL,
  `individual_name` varchar(250) NOT NULL,
  `request_assistance` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `photo_of_the_incident` varchar(250) NOT NULL,
  `date_time_reported` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mss_emergency_reports`
--

INSERT INTO `mss_emergency_reports` (`id`, `informant`, `mobile_number`, `location_of_the_incident`, `type_of_emergency`, `individual_name`, `request_assistance`, `status`, `photo_of_the_incident`, `date_time_reported`) VALUES
(1, 'Juan Tamad', '0416416', 'Cavite', 'Fire/Explosion', 'Juana Tamad', 'Wheel Chair', 'Resolved', 'uploads/@highviewGirls (1).jpg', '2024-03-06 16:19:56.793196'),
(2, 'Theo Sulit', '4654651615564', 'Bulacan', 'Safety and Security', 'Juana Tamad', 'Wheel Chair, Ambulance, Firetruck', 'Resolved', 'uploads/7a.jpg', '2024-03-06 16:19:56.793196'),
(3, 'Theo Sulit', '4654651615564', 'Bulacan', 'Safety and Security', 'Juana Tamad', 'Wheel Chair, Ambulance, Firetruck', 'Resolved', 'uploads/7a.jpg', '2024-03-06 16:19:56.793196'),
(4, 'Juan Valdez', '4654651615564', 'Cavite', 'Injury/Illness', 'Juana Tamad', 'Wheel Chair, Ambulance, Firetruck, Stretcher, Medical Assistance, First Aid Kit', 'Pending', 'uploads/1b.jpg', '2024-03-06 16:19:56.793196');

-- --------------------------------------------------------

--
-- Table structure for table `mss_users`
--

CREATE TABLE `mss_users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(250) NOT NULL,
  `last_name` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `contact_number` varchar(250) NOT NULL,
  `avatar` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mss_users`
--

INSERT INTO `mss_users` (`id`, `first_name`, `last_name`, `username`, `password`, `email`, `contact_number`, `avatar`) VALUES
(2, 'Ma. Nica Franzceck Ron', 'Suarez', 'franzceck', '2d256518a6e330c758e8833e5e0ea737a977b39d4d639db42bc007affffcbb2e', 'franzceck@gmail.com', '09467894568', ''),
(3, 'Nicole', 'Suarez', 'nicole', 'a0ef31a2983b67511ecaf38415f432e386cc3433cae83f17fd63a1408e50af2e', 'nicolesuarez@gmail.com', '0912232323', ''),
(4, 'Francisca', 'Suarez', 'francisca', 'd56ba5b06c9d22548a31952398de63fd378ffcfa41107d1a0bf5a6c69ed948bc', 'francisca@gmail.com', '09439414561', ''),
(5, 'Abraham', 'Suarez', 'bham', '747c858a01a45121b30d0cd560e27c71b73a1d7c7fa0b69c69c91e2dc3bf3fd9', 'bham@gmail.com', '094546465465', ''),
(6, 'Monica', 'Ocampo', 'monica', 'a84b9e319f6f891afb3279dab46d593a731cafb4ed23bf55ca1c96536fd47ba1', 'monica@gmail.com', '09467894568', ''),
(8, 'Karen Margarett', 'Suarez', 'karen', '5d5233b7e92a5d0c89705e029472d61be4a48bce1dd18599dc1304d44e74f201', 'karen@gmail.com', '09133333456', ''),
(9, 'Jamaila ', 'Munes', 'jamaila', '4cac3a8c20713c8f6e775a159936e754a23c1a29f447a7b42510a6a9abf38ffb', 'jamaila@gmail.com', '094567596', ''),
(10, 'Jairah', 'Magbanua', 'jairah', '1daba3b75a59aab4e187ed4a467b1e4994b22c797d6f2df3838e964af31bc645', 'jairah@gmail.com', '0923456985', ''),
(11, 'Andriana', 'Artiaga', 'andriana', '717bfdf65432f656ebc959fdd6d4bffdf47fa64b4e6ecd731c03a020b2cfc914', 'andriana@gmail.com', '09634596789', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mss_emergency_reports`
--
ALTER TABLE `mss_emergency_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mss_users`
--
ALTER TABLE `mss_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mss_emergency_reports`
--
ALTER TABLE `mss_emergency_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mss_users`
--
ALTER TABLE `mss_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
