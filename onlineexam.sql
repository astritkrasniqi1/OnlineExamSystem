-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Mar 28, 2023 at 03:07 PM
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
-- Database: `onlineexam`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `Id` int(11) NOT NULL,
  `QuestionId` int(11) DEFAULT NULL,
  `Title` mediumtext DEFAULT NULL,
  `Status` char(1) DEFAULT NULL,
  `Created_at` datetime DEFAULT NULL,
  `Professor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `Id` int(11) NOT NULL,
  `Subject` int(11) DEFAULT NULL,
  `Professor` int(11) DEFAULT NULL,
  `Duration` varchar(50) DEFAULT NULL,
  `Created_at` datetime DEFAULT NULL,
  `Deadline` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `Id` int(11) NOT NULL,
  `ExamId` int(11) DEFAULT NULL,
  `Title` mediumtext DEFAULT NULL,
  `Points` int(11) DEFAULT NULL,
  `Subject` int(11) DEFAULT NULL,
  `Created_at` datetime DEFAULT NULL,
  `Professor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `studentanswers`
--

CREATE TABLE `studentanswers` (
  `Id` int(11) DEFAULT NULL,
  `QuestionId` int(11) DEFAULT NULL,
  `Title` mediumtext DEFAULT NULL,
  `Status` char(1) DEFAULT NULL,
  `Created_at` datetime DEFAULT NULL,
  `Professor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `studentexam`
--

CREATE TABLE `studentexam` (
  `Id` int(11) DEFAULT NULL,
  `Subject` int(11) DEFAULT NULL,
  `Professor` int(11) DEFAULT NULL,
  `Student` int(11) DEFAULT NULL,
  `StartTime` datetime DEFAULT NULL,
  `EndTime` datetime DEFAULT NULL,
  `Created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `studentquestions`
--

CREATE TABLE `studentquestions` (
  `Id` int(11) DEFAULT NULL,
  `ExamId` int(11) DEFAULT NULL,
  `Title` mediumtext DEFAULT NULL,
  `Points` int(11) DEFAULT NULL,
  `Subject` int(11) DEFAULT NULL,
  `Created_at` datetime DEFAULT NULL,
  `Professor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `Id` int(11) NOT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `Created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `UserType` char(1) DEFAULT NULL,
  `Email` varchar(150) DEFAULT NULL,
  `Username` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `Created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `FirstName`, `LastName`, `UserType`, `Email`, `Username`, `Password`, `Created_at`) VALUES
(1, 'Blert', 'Osmani', '0', 'blertosmani15@gmail.com', 'blert_osmani', '0b58c57fa4e3c8c8c317b092b10f5aaa', '2023-03-27 13:59:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `QuestionId` (`QuestionId`),
  ADD KEY `Professor` (`Professor`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Subject` (`Subject`),
  ADD KEY `Professor` (`Professor`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `ExamId` (`ExamId`),
  ADD KEY `Subject` (`Subject`),
  ADD KEY `Professor` (`Professor`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`QuestionId`) REFERENCES `questions` (`Id`),
  ADD CONSTRAINT `answers_ibfk_2` FOREIGN KEY (`Professor`) REFERENCES `users` (`Id`);

--
-- Constraints for table `exam`
--
ALTER TABLE `exam`
  ADD CONSTRAINT `exam_ibfk_1` FOREIGN KEY (`Subject`) REFERENCES `subject` (`Id`),
  ADD CONSTRAINT `exam_ibfk_2` FOREIGN KEY (`Professor`) REFERENCES `users` (`Id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`ExamId`) REFERENCES `exam` (`Id`),
  ADD CONSTRAINT `questions_ibfk_2` FOREIGN KEY (`Subject`) REFERENCES `subject` (`Id`),
  ADD CONSTRAINT `questions_ibfk_3` FOREIGN KEY (`Professor`) REFERENCES `users` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
