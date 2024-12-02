-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 02. Des, 2024 18:31 PM
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

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `rom`
--

CREATE TABLE `rom` (
  `Romnummer` varchar(10) NOT NULL,
  `Type` varchar(20) NOT NULL,
  `Beskrivelse` varchar(500) DEFAULT NULL,
  `Pris` int(11) NOT NULL,
  `Maks_voksne` int(11) NOT NULL,
  `Maks_barn` int(11) NOT NULL,
  `Tilgjengelighet` varchar(20) NOT NULL,
  `innsjekk` date NOT NULL,
  `utsjekk` date NOT NULL,
  `Etasje` varchar(20) NOT NULL,
  `Nar_heis` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dataark for tabell `rom`
--

INSERT INTO `rom` (`Romnummer`, `Type`, `Beskrivelse`, `Pris`, `Maks_voksne`, `Maks_barn`, `Tilgjengelighet`, `innsjekk`, `utsjekk`, `Etasje`, `Nar_heis`) VALUES
('101', 'Enkeltrom', 'For den enslige reisende. Koselig og privat.', 800, 1, 0, 'Ledig', '0000-00-00', '0000-00-00', 'Lavere', 'Ja'),
('102', 'Dobbeltrom', 'Perfekt for par eller to venner. To enkle senger som kan slåes sammen.', 1200, 2, 1, 'Ledig', '0000-00-00', '0000-00-00', 'Lavere', 'Ja'),
('103', 'Enkeltrom', 'For den enslige reisende. Koselig og privat.', 800, 1, 0, 'Ledig', '0000-00-00', '0000-00-00', 'Lavere', 'Nei'),
('104', 'Dobbeltrom', 'Perfekt for par eller to venner. To enkle senger som kan slåes sammen.', 1200, 2, 1, 'Opptatt', '2024-12-09', '2024-12-11', 'Lavere', 'Nei'),
('105', 'Junior Suite', 'For ekstra komfort og plass. En dobbeltseng, en enkeltseng og en sovesofa. ', 2000, 2, 2, 'Ledig', '0000-00-00', '0000-00-00', 'Lavere', 'Ja'),
('201', 'Enkeltrom', 'For den enslige reisende. Frittstående enkeltseng. Koselig og privat.', 800, 1, 0, 'Ledig', '0000-00-00', '0000-00-00', 'Lavere', 'Ja'),
('202', 'Dobbeltrom', 'Perfekt for par eller to venner. To enkle senger som kan slåes sammen.', 1200, 2, 1, 'Opptatt', '2024-12-16', '2024-12-18', 'Lavere', 'Ja'),
('203', 'Enkeltrom', 'For den enslige reisende. Enkeltseng. Koselig og privat.', 800, 1, 0, 'Ledig', '0000-00-00', '0000-00-00', 'Lavere', 'Nei'),
('204', 'Dobbeltrom', 'Perfekt for par eller to venner. To enkle senger som kan slåes sammen.', 1200, 2, 1, 'Ledig', '0000-00-00', '0000-00-00', 'Lavere', 'Nei'),
('205', 'Junior Suite', 'For ekstra komfort og plass. En dobbeltseng, en enkeltseng og en sovesofa. ', 2000, 2, 2, 'Ledig', '0000-00-00', '0000-00-00', 'Lavere', 'Ja'),
('301', 'Enkeltrom', 'For den enslige reisende. Enkeltseng. Koselig og privat.', 800, 1, 0, 'Ledig', '0000-00-00', '0000-00-00', 'Høyere', 'Ja'),
('302', 'Dobbeltrom', 'Perfekt for par eller to venner. To enkle senger som kan slåes sammen.', 1200, 2, 1, 'Ledig', '0000-00-00', '0000-00-00', 'Høyere', 'Ja'),
('303', 'Enkeltrom', 'For den enslige reisende. Enkeltseng. Koselig og privat.', 800, 1, 0, 'Ledig', '0000-00-00', '0000-00-00', 'Høyere', 'Nei'),
('304', 'Dobbeltrom', 'Perfekt for par eller to venner. To enkle senger som kan slåes sammen.', 1200, 2, 1, 'Ledig', '0000-00-00', '0000-00-00', 'Høyere', 'Nei'),
('305', 'Junior Suite', 'For ekstra komfort og plass. En dobbeltseng og to enkeltsenger med mulighet for sammenslåing.', 2000, 2, 2, 'Ledig', '0000-00-00', '0000-00-00', 'Høyere', 'Ja'),
('401', 'Enkeltrom', 'For den enslige reisende. Frittstående enkeltseng. Koselig og privat.', 900, 1, 0, 'Ledig', '0000-00-00', '0000-00-00', 'Høyere', 'Ja'),
('402', 'Dobbeltrom', 'Perfekt for par eller to venner. Queen size bed.', 1400, 2, 1, 'Ledig', '0000-00-00', '0000-00-00', 'Høyere', 'Ja'),
('403', 'Enkeltrom', 'Enkeltseng med mulighet for barneseng eller feltseng.', 1000, 1, 1, 'Ledig', '0000-00-00', '0000-00-00', 'Høyere', 'Nei'),
('404', 'Dobbeltrom', 'Perfekt for par eller to venner. King size bed.', 1400, 2, 1, 'Ledig', '0000-00-00', '0000-00-00', 'Høyere', 'Nei'),
('405', 'Junior Suite', 'For ekstra komfort og plass. En dobbeltseng og to enkeltsenger med mulighet for sammenslåing.', 2200, 2, 2, 'Ledig', '0000-00-00', '0000-00-00', 'Høyere', 'Ja'),
('501', 'Enkeltrom', 'Enslig reisende med utsikt over sjøen.', 900, 1, 0, 'Ledig', '0000-00-00', '0000-00-00', 'Høyere', 'Ja'),
('502', 'Dobbeltrom', 'Perfekt for par eller to venner. King size bed. Utsikt til sjøen.', 1500, 2, 1, 'Ledig', '0000-00-00', '0000-00-00', 'Høyere', 'Ja'),
('503', 'Enkeltrom', 'Enkeltseng med mulighet for barneseng eller feltseng.', 1000, 1, 1, 'Ledig', '0000-00-00', '0000-00-00', 'Høyere', 'Nei'),
('504', 'Dobbeltrom', 'Perfekt for par eller to venner. To enkle senger som kan slåes sammen. Utsikt til sjøen.', 1400, 2, 1, 'Ledig', '0000-00-00', '0000-00-00', 'Høyere', 'Nei'),
('505', 'Junior Suite', 'For ekstra komfort og plass. To soverom. En dobbeltseng og to enkeltsenger med mulighet for sammenslåing. Utsikt til sjøen.', 2500, 2, 2, 'Ledig', '0000-00-00', '0000-00-00', 'Høyere', 'Ja');

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
  `rolle` enum('gjest','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dataark for tabell `users`
--

INSERT INTO `users` (`bruker_id`, `fornavn`, `etternavn`, `mobil`, `epost`, `passord`, `rolle`) VALUES
(7, 'Annette', 'Brynhildsen', 97697177, 'annetteab98@gmail.com', '$2y$10$fZCzxjVY2E7irBnFwpSk9uCrYwD472Cz1An0RL.tqWFerVMVCrqzO', 'admin'),
(8, 'Rebekka', 'Broderstad', 98765432, 'rb@gmail.com', '$2y$10$Di9vDDbrd2MZuxGfr0scCeOJfNh8q3cjw0Hq.XZg81NwyBKXRHDc2', 'gjest');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `bruker_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
