-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 01, 2024 at 01:15 AM
-- Server version: 5.7.35-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `IT`
--

-- --------------------------------------------------------

--
-- Table structure for table `Paskyros_tipas`
--

CREATE TABLE `Paskyros_tipas` (
  `id` int(11) NOT NULL,
  `pavadinimas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Paskyros_tipas`
--

INSERT INTO `Paskyros_tipas` (`id`, `pavadinimas`) VALUES
(1, 'Reader'),
(2, 'Publisher'),
(3, 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `Paveikslelis`
--

CREATE TABLE `Paveikslelis` (
  `id` int(11) NOT NULL,
  `pavadinimas` varchar(255) NOT NULL,
  `pozicija` enum('left','right','down','up') NOT NULL DEFAULT 'down',
  `url` varchar(2047) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Straipsnis`
--

CREATE TABLE `Straipsnis` (
  `id` int(11) NOT NULL,
  `pavadinimas` varchar(255) NOT NULL,
  `sukurimo_data` datetime NOT NULL,
  `vartotojas_id` int(11) NOT NULL,
  `tema_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Straipsnis`
--

INSERT INTO `Straipsnis` (`id`, `pavadinimas`, `sukurimo_data`, `vartotojas_id`, `tema_id`) VALUES
(1, 'Sveikas gyvenimas misko apsuptyje', '2024-12-01 01:04:27', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Straipsnis_Blokas`
--

CREATE TABLE `Straipsnis_Blokas` (
  `id` int(11) NOT NULL,
  `tekstas` text,
  `straipsnis_id` int(11) NOT NULL,
  `paveikslelis_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Straipsnis_Blokas`
--

INSERT INTO `Straipsnis_Blokas` (`id`, `tekstas`, `straipsnis_id`, `paveikslelis_id`) VALUES
(2, 'Antroje pastraipoje yra svarbu, kad nera paveikslelio', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Tema`
--

CREATE TABLE `Tema` (
  `id` int(11) NOT NULL,
  `pavadinimas` varchar(255) NOT NULL,
  `vartotojas_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Tema`
--

INSERT INTO `Tema` (`id`, `pavadinimas`, `vartotojas_id`) VALUES
(1, 'Sveikas gyvenimas', 2),
(2, 'Mityba ir maistas', 2),
(3, 'Informacines technologijos', 2),
(4, 'Kompiuteriai ir technika', 2),
(5, 'Mokslas universitete', 2),
(6, 'Juokeliai', 2),
(7, 'Geras miegas', 2);

-- --------------------------------------------------------

--
-- Table structure for table `Vartotojas`
--

CREATE TABLE `Vartotojas` (
  `id` int(11) NOT NULL,
  `prisijungimo_vardas` varchar(255) NOT NULL,
  `slaptazodis` varchar(255) NOT NULL,
  `vardas` varchar(255) NOT NULL,
  `pavarde` varchar(255) NOT NULL,
  `paskyros_tipas_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Vartotojas`
--

INSERT INTO `Vartotojas` (`id`, `prisijungimo_vardas`, `slaptazodis`, `vardas`, `pavarde`, `paskyros_tipas_id`) VALUES
(1, 'rasytojas', '$2y$10$8FbuaePSEtJNQl72EK1uFOlOAiz8Oar.5vnrffgRzx5JEW2h/9wcm', 'Simas', 'Rasytojas', 2),
(2, 'admin', '$2y$10$OQRCYeBplJUfPcgOWqMqk.ffkN.e02GbOsavpskXlcIcR5.9EqF9y', 'Simas', 'Administratorius', 3),
(3, 'skaitytojas', '$2y$10$AZxuDHhJOjtYGoT3a.0JSud3UnoQg2BskH/6Z6LsEpMp5Dcw6FJ0W', 'Simas', 'Skaitytojas', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Vartotojas_Tema`
--

CREATE TABLE `Vartotojas_Tema` (
  `id` int(11) NOT NULL,
  `vartotojas_id` int(11) NOT NULL,
  `tema_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Vartotojas_Tema`
--

INSERT INTO `Vartotojas_Tema` (`id`, `vartotojas_id`, `tema_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `Vertinimas`
--

CREATE TABLE `Vertinimas` (
  `id` int(11) NOT NULL,
  `vertinimas` int(11) NOT NULL,
  `sukurimo_data` datetime NOT NULL,
  `vartotojas_id` int(11) NOT NULL,
  `straipsnis_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Paskyros_tipas`
--
ALTER TABLE `Paskyros_tipas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Paveikslelis`
--
ALTER TABLE `Paveikslelis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Straipsnis`
--
ALTER TABLE `Straipsnis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vartotojas_id` (`vartotojas_id`),
  ADD KEY `tema_id` (`tema_id`);

--
-- Indexes for table `Straipsnis_Blokas`
--
ALTER TABLE `Straipsnis_Blokas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `straipsnis_id` (`straipsnis_id`),
  ADD KEY `paveikslelis_id` (`paveikslelis_id`);

--
-- Indexes for table `Tema`
--
ALTER TABLE `Tema`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vartotojas_id` (`vartotojas_id`);

--
-- Indexes for table `Vartotojas`
--
ALTER TABLE `Vartotojas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paskyros_tipas_id` (`paskyros_tipas_id`);

--
-- Indexes for table `Vartotojas_Tema`
--
ALTER TABLE `Vartotojas_Tema`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tema_id` (`tema_id`),
  ADD KEY `vartotojas_id` (`vartotojas_id`);

--
-- Indexes for table `Vertinimas`
--
ALTER TABLE `Vertinimas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vartotojas_id` (`vartotojas_id`),
  ADD KEY `straipsnis_id` (`straipsnis_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Paskyros_tipas`
--
ALTER TABLE `Paskyros_tipas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `Paveikslelis`
--
ALTER TABLE `Paveikslelis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Straipsnis`
--
ALTER TABLE `Straipsnis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `Straipsnis_Blokas`
--
ALTER TABLE `Straipsnis_Blokas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `Tema`
--
ALTER TABLE `Tema`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `Vartotojas`
--
ALTER TABLE `Vartotojas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `Vartotojas_Tema`
--
ALTER TABLE `Vartotojas_Tema`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `Vertinimas`
--
ALTER TABLE `Vertinimas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Straipsnis`
--
ALTER TABLE `Straipsnis`
  ADD CONSTRAINT `Straipsnis_ibfk_1` FOREIGN KEY (`vartotojas_id`) REFERENCES `Vartotojas` (`id`),
  ADD CONSTRAINT `Straipsnis_ibfk_2` FOREIGN KEY (`tema_id`) REFERENCES `Tema` (`id`);

--
-- Constraints for table `Straipsnis_Blokas`
--
ALTER TABLE `Straipsnis_Blokas`
  ADD CONSTRAINT `Straipsnis_Blokas_ibfk_1` FOREIGN KEY (`straipsnis_id`) REFERENCES `Straipsnis` (`id`),
  ADD CONSTRAINT `Straipsnis_Blokas_ibfk_2` FOREIGN KEY (`paveikslelis_id`) REFERENCES `Paveikslelis` (`id`);

--
-- Constraints for table `Tema`
--
ALTER TABLE `Tema`
  ADD CONSTRAINT `Tema_ibfk_1` FOREIGN KEY (`vartotojas_id`) REFERENCES `Vartotojas` (`id`);

--
-- Constraints for table `Vartotojas`
--
ALTER TABLE `Vartotojas`
  ADD CONSTRAINT `Vartotojas_ibfk_1` FOREIGN KEY (`paskyros_tipas_id`) REFERENCES `Paskyros_tipas` (`id`);

--
-- Constraints for table `Vartotojas_Tema`
--
ALTER TABLE `Vartotojas_Tema`
  ADD CONSTRAINT `Vartotojas_Tema_ibfk_1` FOREIGN KEY (`tema_id`) REFERENCES `Tema` (`id`),
  ADD CONSTRAINT `Vartotojas_Tema_ibfk_2` FOREIGN KEY (`vartotojas_id`) REFERENCES `Vartotojas` (`id`);

--
-- Constraints for table `Vertinimas`
--
ALTER TABLE `Vertinimas`
  ADD CONSTRAINT `Vertinimas_ibfk_1` FOREIGN KEY (`vartotojas_id`) REFERENCES `Vartotojas` (`id`),
  ADD CONSTRAINT `Vertinimas_ibfk_2` FOREIGN KEY (`straipsnis_id`) REFERENCES `Straipsnis` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
