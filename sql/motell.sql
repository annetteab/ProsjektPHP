-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 18. Nov, 2024 14:32 PM
-- Tjener-versjon: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `motell`
--

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `reservasjoner`
--

CREATE TABLE `reservasjoner` (
  `id` int(11) NOT NULL,
  `romnummer` varchar(50) DEFAULT NULL,
  `gjest_id` int(11) DEFAULT NULL,
  `innsjekk` date DEFAULT NULL,
  `utsjekk` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dataark for tabell `reservasjoner`
--

INSERT INTO `reservasjoner` (`id`, `romnummer`, `gjest_id`, `innsjekk`, `utsjekk`) VALUES
(2, '102', NULL, NULL, NULL),
(3, '102', NULL, NULL, NULL),
(4, '102', NULL, NULL, NULL),
(5, '102', NULL, NULL, NULL),
(6, '102', NULL, NULL, NULL),
(7, '104', NULL, NULL, NULL),
(8, '104', 2, NULL, NULL),
(9, '104', 2, NULL, NULL),
(10, '102', 2, '2024-11-13', '2024-11-14'),
(11, '102', 2, '2024-11-19', '2024-11-20'),
(12, '505', 2, '2024-11-19', '2024-11-20');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `rom`
--

CREATE TABLE `rom` (
  `Romnummer` varchar(10) NOT NULL,
  `Type` varchar(20) NOT NULL,
  `Pris` int(11) NOT NULL,
  `Maks_voksne` int(11) NOT NULL,
  `Maks_barn` int(11) NOT NULL,
  `Tilgjengelighet` varchar(20) NOT NULL,
  `innsjekk` DATE NOT NULL,
  `utsjekk` DATE NOT NULL,
  `Etasje` varchar(20) NOT NULL,
  `Nar_heis` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dataark for tabell `rom`
--

INSERT INTO `rom` (`Romnummer`, `Type`, `Pris`, `Maks_voksne`, `Maks_barn`, `Tilgjengelighet`, `Etasje`, `Nar_heis`) VALUES
('101', 'Enkeltrom', 800, 1, 0, 'Ledig', 'Lavere', 'Ja'),
('102', 'Dobbeltrom', 1200, 2, 1, 'Opptatt', 'Lavere', 'Ja'),
('103', 'Enkeltrom', 800, 1, 0, 'Ledig', 'Lavere', 'Nei'),
('104', 'Dobbeltrom', 1200, 2, 1, 'Ledig', 'Lavere', 'Nei'),
('105', 'Junior Suite', 2000, 2, 2, 'Ledig', 'Lavere', 'Ja'),
('201', 'Enkeltrom', 800, 1, 0, 'Ledig', 'Lavere', 'Ja'),
('202', 'Dobbeltrom', 1200, 2, 1, 'Ledig', 'Lavere', 'Ja'),
('203', 'Enkeltrom', 800, 1, 0, 'Ledig', 'Lavere', 'Nei'),
('204', 'Dobbeltrom', 1200, 2, 1, 'Ledig', 'Lavere', 'Nei'),
('205', 'Junior Suite', 2000, 2, 2, 'Ledig', 'Lavere', 'Ja'),
('301', 'Enkeltrom', 800, 1, 0, 'Ledig', 'Høyere', 'Ja'),
('302', 'Dobbeltrom', 1200, 2, 1, 'Ledig', 'Høyere', 'Ja'),
('303', 'Enkeltrom', 800, 1, 0, 'Ledig', 'Høyere', 'Nei'),
('304', 'Dobbeltrom', 1200, 2, 1, 'Ledig', 'Høyere', 'Nei'),
('305', 'Junior Suite', 2000, 2, 2, 'Ledig', 'Høyere', 'Ja'),
('401', 'Enkeltrom', 900, 1, 0, 'Ledig', 'Høyere', 'Ja'),
('402', 'Dobbeltrom', 1400, 2, 1, 'Ledig', 'Høyere', 'Ja'),
('403', 'Enkeltrom', 1000, 1, 1, 'Ledig', 'Høyere', 'Nei'),
('404', 'Dobbeltrom', 1400, 2, 1, 'Ledig', 'Høyere', 'Nei'),
('405', 'Junior Suite', 2200, 2, 2, 'Ledig', 'Høyere', 'Ja'),
('501', 'Enkeltrom', 900, 1, 0, 'Ledig', 'Høyere', 'Ja'),
('502', 'Dobbeltrom', 1400, 2, 1, 'Ledig', 'Høyere', 'Ja'),
('503', 'Enkeltrom', 1000, 1, 1, 'Ledig', 'Høyere', 'Nei'),
('504', 'Dobbeltrom', 1400, 2, 1, 'Ledig', 'Høyere', 'Nei'),
('505', 'Junior Suite', 2500, 2, 2, 'Opptatt', 'Høyere', 'Ja');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `users`
--

CREATE TABLE `users` (
  `bruker_id` int(11) NOT NULL,
  `fornavn` varchar(50) DEFAULT NULL,
  `etternavn` varchar(50) DEFAULT NULL,
  `mobil` int(15) DEFAULT NULL,
  `epost` varchar(100) DEFAULT NULL,
  `passord` varchar(100) DEFAULT NULL,
  `rolle` enum('gjest','admin') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dataark for tabell `users`
--

INSERT INTO `users` (`bruker_id`, `fornavn`, `etternavn`, `mobil`, `epost`, `passord`, `rolle`) VALUES
(1, 'Annette', 'Brynhildsen', 97697177, 'annetteab98@gmail.com', '$2y$10$okftSgTC3.e4NGKfhRAWje/auAHMGZkdjXraxCw8098UWAImk6S5y', 'gjest'),
(2, 'Annette', 'Brynhildsen', 97697100, 'annetteab@test.com', '$2y$10$pCpAzl2fGdgmx0nGWZ0gF.rHpWksOt/Vi4MAWMDGuDyYkvLxlg.Yu', 'gjest');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reservasjoner`
--
ALTER TABLE `reservasjoner`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_romnummer` (`romnummer`),
  ADD KEY `fk_gjest_id` (`gjest_id`);

--
-- Indexes for table `rom`
--
ALTER TABLE `rom`
  ADD PRIMARY KEY (`Romnummer`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`bruker_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reservasjoner`
--
ALTER TABLE `reservasjoner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `bruker_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Begrensninger for dumpede tabeller
--

--
-- Begrensninger for tabell `reservasjoner`
--
ALTER TABLE `reservasjoner`
  ADD CONSTRAINT `fk_gjest_id` FOREIGN KEY (`gjest_id`) REFERENCES `users` (`bruker_id`),
  ADD CONSTRAINT `fk_romnummer` FOREIGN KEY (`romnummer`) REFERENCES `rom` (`Romnummer`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
