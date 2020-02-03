-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2020 at 12:31 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
-- Table structure for table `message_file`
--

CREATE TABLE `message_file` (
  `recipient1` int(255) NOT NULL,
  `recipient1_read` bigint(255) NOT NULL,
  `recipient2` int(255) NOT NULL,
  `recipient2_read` bigint(255) NOT NULL,
  `file_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message_file`
--

INSERT INTO `message_file` (`recipient1`, `recipient1_read`, `recipient2`, `recipient2_read`, `file_name`) VALUES
(3, 5, 4, 878, '1_2.txt'),
(4, 297, 6, 667, '4_6.txt'),
(6, 0, 3, 0, '6_3.txt');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `password` varchar(60) NOT NULL,
  `id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `id`) VALUES
('root', 'root', 1),
('name', '$2y$10$vWiiykjqrMDvYPON5DEG0uWHFXVs1H4mW2UTs2/gWZDhpuPRHcnTG', 3),
('username', '$2y$10$J5mIPm6DvESxpcDWW8Nc/usWk8gCnnjkyyzTg0QjxLGPXM9rOhxQa', 4),
('username1', '$2y$10$F8t13ZzIjnGc95DSr.mfn.pRoNf4ZsSk/ViGqv9zs1JPtVeY.WA2q', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `message_file`
--
ALTER TABLE `message_file`
  ADD PRIMARY KEY (`file_name`),
  ADD KEY `recipient1` (`recipient1`),
  ADD KEY `recipient2` (`recipient2`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `message_file`
--
ALTER TABLE `message_file`
  ADD CONSTRAINT `message_file_ibfk_1` FOREIGN KEY (`recipient1`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `message_file_ibfk_2` FOREIGN KEY (`recipient2`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
