-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2020 at 07:44 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tema_3`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'mihai', '$2y$10$CKkeOtXQu8uy7FEmyXMIgeLcEg9LVo9s6XRZkL8KoMG6eqoLJMyQe');

-- --------------------------------------------------------

--
-- Table structure for table `anunturi`
--

CREATE TABLE `anunturi` (
  `id` int(11) NOT NULL,
  `titlu` varchar(255) NOT NULL,
  `descriere` varchar(255) NOT NULL,
  `data` date NOT NULL,
  `jobs` tinyint(1) NOT NULL,
  `prezentari` tinyint(1) NOT NULL,
  `internship` tinyint(1) NOT NULL,
  `informatica` tinyint(1) NOT NULL,
  `tehnologie` tinyint(1) NOT NULL,
  `studenti` tinyint(1) NOT NULL,
  `diverse` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anunturi`
--

INSERT INTO `anunturi` (`id`, `titlu`, `descriere`, `data`, `jobs`, `prezentari`, `internship`, `informatica`, `tehnologie`, `studenti`, `diverse`) VALUES
(7, 'Concurs programare procedurala', 'In data de 20 mai 2020, Departamentul de Informatica organizeaza un concurs de programare procedurala. Text', '2020-05-18', 0, 0, 0, 1, 0, 1, 0),
(8, 'Cazarea in camine', 'Caminele studentesti asteapta studentii sa fie cazati', '2020-05-18', 0, 0, 0, 0, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cadre_didactice`
--

CREATE TABLE `cadre_didactice` (
  `id` int(11) NOT NULL,
  `nume` varchar(255) NOT NULL,
  `grad` varchar(8) NOT NULL,
  `titlu` varchar(8) NOT NULL,
  `pagina` varchar(255) NOT NULL,
  `telefon` varchar(255) NOT NULL,
  `fax` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cadre_didactice`
--

INSERT INTO `cadre_didactice` (`id`, `nume`, `grad`, `titlu`, `pagina`, `telefon`, `fax`, `email`, `image`) VALUES
(5, 'Gabroveanu Mihai', 'Lect', 'Dr', ' http://inf.ucv.ro/~mihaiug/', '07696969696', '07696969696', 'mihaiug@central.ucv.ro', '11.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anunturi`
--
ALTER TABLE `anunturi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cadre_didactice`
--
ALTER TABLE `cadre_didactice`
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
-- AUTO_INCREMENT for table `anunturi`
--
ALTER TABLE `anunturi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cadre_didactice`
--
ALTER TABLE `cadre_didactice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
