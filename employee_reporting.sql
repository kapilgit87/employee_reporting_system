-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2026 at 02:57 PM
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
-- Database: `employee_reporting`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(200) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `role` enum('management','employee') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `email`, `password`, `department`, `role`) VALUES
(2, 'Admin', 'admin@gmail.com', '123456', 'IT', 'management'),
(3, 'kapil', 'kapil@gmail.com', '123456', 'IT', 'employee'),
(4, 'mohit', 'mohit@gmail.com', '12345', 'IT', 'employee'),
(5, 'vikash', 'vikash@gmail.com', '123456', 'IT', 'employee');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `task_id` int(200) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `assign_date` date DEFAULT NULL,
  `tentative_date` date DEFAULT NULL,
  `deadline` date NOT NULL,
  `status` enum('Pending','In Progress','Completed') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`task_id`, `employee_id`, `task_name`, `assign_date`, `tentative_date`, `deadline`, `status`) VALUES
(1, 1, 'testing Form', NULL, NULL, '2026-05-30', 'Pending'),
(4, 3, 'testing Form', '2026-05-21', '2026-06-02', '2026-05-30', 'Completed'),
(7, 5, 'website logo create', '2026-05-21', '2026-05-28', '2026-05-29', 'In Progress');

-- --------------------------------------------------------

--
-- Table structure for table `visits`
--

CREATE TABLE `visits` (
  `id` int(100) NOT NULL,
  `employee_id` int(100) NOT NULL,
  `login_time` datetime(6) NOT NULL,
  `logout_time` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visits`
--

INSERT INTO `visits` (`id`, `employee_id`, `login_time`, `logout_time`) VALUES
(1, 2, '2026-05-21 16:57:40.000000', '2026-05-21 16:58:04.000000'),
(15, 2, '2026-05-21 18:13:10.000000', '2026-05-21 18:13:22.000000'),
(16, 3, '2026-05-21 18:13:28.000000', '2026-05-21 18:13:40.000000'),
(17, 2, '2026-05-21 18:25:08.000000', '2026-05-21 18:26:01.000000'),
(18, 5, '2026-05-21 18:26:08.000000', '2026-05-21 18:26:22.000000'),
(19, 2, '2026-05-21 18:26:27.000000', '2026-05-21 18:26:34.000000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `visits`
--
ALTER TABLE `visits`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `task_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `visits`
--
ALTER TABLE `visits`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
