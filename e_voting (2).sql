-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 31, 2024 at 04:08 AM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_voting`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'virat', '123');

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

DROP TABLE IF EXISTS `candidates`;
CREATE TABLE IF NOT EXISTS `candidates` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `party` varchar(100) DEFAULT NULL,
  `votes` int DEFAULT '0',
  `image_path` varchar(255) DEFAULT NULL,
  `experience` int NOT NULL DEFAULT '0',
  `manifesto` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`id`, `name`, `party`, `votes`, `image_path`, `experience`, `manifesto`) VALUES
(1, 'vishal', 'AAP', 0, NULL, 0, NULL),
(2, 'abhishekh', 'BJP', 0, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('voter','admin') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'John', '$2y$10$YCDe8TWb6dKMGB/fEiMAb.DDfKjRsDCQtN2QBF0Q7hpcWMsiiIHRK', 'voter'),
(2, 'Robert', '$2y$10$kNS/awmkcCG6EI/Cf286kODAfbO9WNOUXLA9W7vZI6wfNaS/uL8Ai', 'voter'),
(3, 'Jane', '$2y$10$uofNW.D4xo6GIuJmDZ/Joe5/q2jvd5VxvjFWepY6hc2ez8FySg8kO', 'voter'),
(4, 'Alice', '$2y$10$IcFSqub/PNfP/e146P1eaeG2cw.jVy0PZOHgNag2emDff2He2eHM6', 'voter'),
(5, 'Emily', '$2y$10$zp/OoYzS3RbSxiXI8/e17.GpsCf7aTGAviUD00N.Z68Kl05TF.sGu', 'voter'),
(6, 'Rohit', '$2y$10$Ce/XZ/olvg4yYrVQDTx6u.nywDD/sbXGVPoblwU5Ip0w73Xrg2OIq', 'voter'),
(7, 'Anjali', '$2y$10$P7gcWRNsadMpeiWkYKoEpuJwqqOujh9NboZYgRq2V852kFzFbSeri', 'voter'),
(8, 'Sunil', '$2y$10$NpXQ9Ule3AyfpqlVNa6DT.uGRF5CfKs7fDYv8qhxBdZ5fqgEvRiz2', 'voter'),
(9, 'pulsar', '$2y$10$i8jiXqN4/EKpf23Azz/NFey1V2RJW1x20/dKjMZxAhpebZgtEjjy6', 'voter'),
(10, 'Amit', '$2y$10$RxVe7r4XgH0TOLymiw5Lie.38hKwZ/KEi0d4cgcepNNFKWRUnlUAq', 'voter'),
(11, 'Sumit', '$2y$10$ylb7dSR24Q.d.hp.BoDMQ.ypzI.fE7i2IHtIzxgj8bsqGVhOUxLF6', 'voter');

-- --------------------------------------------------------

--
-- Table structure for table `verification`
--

DROP TABLE IF EXISTS `verification`;
CREATE TABLE IF NOT EXISTS `verification` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `date_of_birth` date NOT NULL,
  `aadhar_no` varchar(12) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `aadhar_no` (`aadhar_no`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `verification`
--

INSERT INTO `verification` (`id`, `name`, `date_of_birth`, `aadhar_no`) VALUES
(1, 'John Doe', '1990-01-15', '123456789012'),
(2, 'Jane Smith', '1985-05-20', '987654321098'),
(3, 'Robert Brown', '1978-03-25', '111122223333'),
(4, 'Alice Green', '1995-07-10', '444455556666'),
(5, 'Emily White', '2000-12-01', '777788889999'),
(6, 'Rohit Sharma', '1990-04-30', '123456789022'),
(7, 'Anjali Verma', '1985-11-22', '234567890123'),
(8, 'Sunil Kumar', '1978-03-15', '345678901234'),
(9, 'Meena Gupta', '1992-07-19', '456789012345'),
(10, 'Amit Singh', '1980-05-21', '567890123456'),
(11, 'Priya Desai', '1987-09-12', '678901234567'),
(12, 'Vikram Patel', '1991-01-25', '789012345678'),
(13, 'Neha Chandra', '1995-08-10', '890123456789'),
(14, 'Rahul Joshi', '1983-12-05', '901234567890'),
(15, 'Sakshi Malik', '1993-06-30', '012345678901'),
(16, 'Sumit', '2000-01-01', '333366669999');

-- --------------------------------------------------------

--
-- Table structure for table `voters`
--

DROP TABLE IF EXISTS `voters`;
CREATE TABLE IF NOT EXISTS `voters` (
  `voter_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `aadhar_no` varchar(12) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `has_voted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`voter_id`),
  UNIQUE KEY `aadhar_no` (`aadhar_no`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `voters`
--

INSERT INTO `voters` (`voter_id`, `name`, `dob`, `aadhar_no`, `username`, `password`, `has_voted`) VALUES
(1, 'John Doe', '1990-05-10', '123456789012', 'john_doe', 'hashed_password_here', 0),
(2, 'Jane Smith', '1985-08-25', '987654321098', 'jane_smith', 'hashed_password_here', 0);

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

DROP TABLE IF EXISTS `votes`;
CREATE TABLE IF NOT EXISTS `votes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `voter_id` int NOT NULL,
  `candidate_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `voter_id` (`voter_id`),
  KEY `candidate_id` (`candidate_id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `voter_id`, `candidate_id`) VALUES
(1, 2, 1),
(2, 3, 1),
(3, 3, 1),
(4, 3, 1),
(5, 3, 1),
(6, 4, 2),
(7, 4, 1),
(8, 4, 1),
(9, 4, 1),
(10, 4, 1),
(11, 4, 1),
(12, 4, 1),
(13, 4, 1),
(14, 4, 1),
(15, 4, 1),
(16, 3, 2),
(17, 3, 2),
(18, 3, 2),
(19, 5, 5),
(20, 6, 5),
(21, 1, 1),
(22, 7, 5),
(23, 8, 5),
(24, 9, 5),
(25, 10, 2),
(26, 11, 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
