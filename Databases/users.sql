-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2023 at 01:19 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `calendar`
--

CREATE TABLE `calendar` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `sleep` tinyint(1) NOT NULL,
  `feed` tinyint(1) NOT NULL,
  `notes` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `child`
--

CREATE TABLE `child` (
  `id` int(11) NOT NULL,
  `id_parent` int(11) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `birthday` date NOT NULL,
  `gender` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `child`
--

INSERT INTO `child` (`id`, `id_parent`, `firstname`, `lastname`, `birthday`, `gender`) VALUES
(1, 6, 'Andreea', 'Tanase', '2023-05-11', 'non-binary'),
(2, 6, 'Damian', 'Tanase', '2023-05-04', 'male');

-- --------------------------------------------------------

--
-- Table structure for table `friend`
--

CREATE TABLE `friend` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `relationship` varchar(200) NOT NULL,
  `photo` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `picture` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medical_report`
--

CREATE TABLE `medical_report` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date` date NOT NULL,
  `doctor` varchar(200) NOT NULL,
  `symptoms` varchar(400) NOT NULL,
  `diagnosis` varchar(400) NOT NULL,
  `medication` varchar(400) NOT NULL,
  `document` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `memory`
--

CREATE TABLE `memory` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_child` int(11) NOT NULL,
  `date` date NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `picture` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `memory`
--

INSERT INTO `memory` (`id`, `id_user`, `id_child`, `date`, `title`, `description`, `picture`) VALUES
(2, 6, 1, '2023-05-20', 'Playing at Kindergarten', 'We have been struggling for a few months to make Andreea feel safe at kindergaten.\r\nEvery day as soon as they would step into the kindergaten, they would start crying.\r\nSince we didn\'t have any way of keeping them at home, we decided to continue to take them to the kindergarten, where they would be safe and would have other children to be around, and hope for the best.\r\nToday, it was the first time they were happy to go there and I managed to take a picture of them playing.\r\nThey are more and more brave every day and I\'m so proud of them!', ''),
(3, 6, 2, '2016-06-07', 'Always a foodie', 'Some parents have a battle with their child every day trying to convince them to eat their meal.\r\nOur Damian has never caused us problems like this.\r\nFrom fruits and vegetables, to yogurt, eggs and cheese, he eats them all.\r\nAlthough he is not a fan of pasta, but maybe when he grows older we will try to give him pasta again.\r\nToday he had rice, and it was finger-licking good!', ''),
(4, 6, 2, '0000-00-00', 'Something', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_registred`
--

CREATE TABLE `user_registred` (
  `id` int(11) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `pronouns` varchar(50) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `address` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_registred`
--

INSERT INTO `user_registred` (`id`, `firstname`, `lastname`, `email`, `username`, `password`, `gender`, `pronouns`, `phone`, `address`) VALUES
(1, 'Elias', 'Wal', 'elias_wal@gmail.com', 'elias', 'elias', 'male', 'he/him', '0758302309', 'Iasi, Jud Iasi'),
(2, 'Gabriela', 'Mereuta', 'mereutagabriela67@yahoo.com', 'Gabriela', 'kidchild', 'female', 'she/her', '0745511551', 'heu'),
(6, 'Maria', 'Tanase', 'mariatanase3802@gmail.com', 'mariatanase6', '12345', 'female', 'She/Her', '0788888888', 'Str. Bisericii'),
(7, 'Luminita', 'Popescu', 'luminita@yahoo.com', 'lumi', 'lumi1990', 'non-binary', 'They/them', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calendar`
--
ALTER TABLE `calendar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `child`
--
ALTER TABLE `child`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friend`
--
ALTER TABLE `friend`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medical_report`
--
ALTER TABLE `medical_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `memory`
--
ALTER TABLE `memory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_registred`
--
ALTER TABLE `user_registred`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calendar`
--
ALTER TABLE `calendar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `child`
--
ALTER TABLE `child`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `friend`
--
ALTER TABLE `friend`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medical_report`
--
ALTER TABLE `medical_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `memory`
--
ALTER TABLE `memory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_registred`
--
ALTER TABLE `user_registred`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
