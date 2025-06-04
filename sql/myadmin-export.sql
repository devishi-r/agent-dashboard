-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2025 at 11:25 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agent-management-module`
--

-- --------------------------------------------------------

--
-- Table structure for table `agent-details`
--

CREATE TABLE `agent-details` (
  `id` int(4) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agent-details`
--

INSERT INTO `agent-details` (`id`, `name`, `email`, `username`, `password`, `created_at`, `modified_at`, `status`) VALUES
(6, 'c', 'c@c.com', 'c', '$2y$10$2NqGwk8R45hWf8ieLIPpkuWGc1r0T6MyXBWqS9Ir8gd', '2025-06-04 05:08:13', '2025-06-04 09:03:20', 'Inactive'),
(7, 'devishi', 'devishi0912@gmail.com', 'devishi', '$2y$10$QkcHj47D5QPBSMsxkbsBaOtlVvPHwn8MjQ3Dh1VoDgloeXUVNi5TW', '2025-06-04 05:16:37', '2025-06-04 08:59:23', 'Active'),
(8, 'agent 001', 'agent1@gmail.com', 'agent1', '$2y$10$ouMEr1FMDOcQdWOXNdHf6OH/ErO9/HLg7Fmqs/vugy.1Co/0ybhkS', '2025-06-04 05:25:55', '2025-06-04 08:59:25', 'Inactive'),
(9, 'agent 002', 'agent2@gmail.com', 'agent2', '$2y$10$HFE2lbZy8EfDrLDdDl7lnem2bRVaivICimCVnPnz/CSUOoAVhr8U2', '2025-06-04 05:28:15', '2025-06-04 05:28:15', 'Active'),
(10, 'a', 'a@a.com', 'a', '$2y$10$UeUg0UCUVstkyeOkwtR8t.ecwIoFsEbK78/kKKs9BZgmH8VnJj/GK', '2025-06-04 05:29:15', '2025-06-04 05:29:15', 'Active'),
(11, 'b', 'b@b.com', 'b', '$2y$10$YY394zhj5AsLrc0whdqtVO5z6ASGC0ExdF9RSExray8BSzWYe8QEK', '2025-06-04 05:33:41', '2025-06-04 05:33:41', 'Active'),
(13, 'e', 'e@e.com', 'e', '$2y$10$cnqJ5p7xH6gtWmOgt1.2zu9tfzNiY6cQi/L0JBpL78efFoSckXeGO', '2025-06-04 05:37:35', '2025-06-04 05:37:35', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agent-details`
--
ALTER TABLE `agent-details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agent-details`
--
ALTER TABLE `agent-details`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
