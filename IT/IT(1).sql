-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 01, 2024 at 11:44 AM
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

--
-- Dumping data for table `Paskyros_tipas`
--

INSERT INTO `Paskyros_tipas` (`id`, `pavadinimas`) VALUES
(1, 'Reader'),
(2, 'Publisher'),
(3, 'Administrator');

--
-- Dumping data for table `Paveikslelis`
--

INSERT INTO `Paveikslelis` (`id`, `pavadinimas`, `pozicija`, `url`) VALUES
(1, 'Lova', 'left', 'https://www.premierinnbed.co.uk/media/catalog/product/cache/215e62282d4b4b68400b8137e0654108/p/r/premierinn_mattress2.0_lilith_charcoal_gbtb_lifestyle_-_demand_gen_square.jpg'),
(2, 'Lova2', 'right', 'https://www.premierinnbed.co.uk/media/catalog/product/cache/215e62282d4b4b68400b8137e0654108/p/r/premierinn_mattress2.0_lilith_charcoal_gbtb_lifestyle_-_demand_gen_square.jpg'),
(3, 'Senas kompiuteris', 'left', 'https://www.startpage.com/av/proxy-image?piurl=http%3A%2F%2Fwww.vintageisthenewold.com%2Fwp-content%2Fuploads%2F2017%2F08%2Fimbpc.jpg&sp=1733045479Tba613dc2d27484b1fa9d9a26b892d5bcd4678e0cfbed2c61fa38d2469eb6124d');

--
-- Dumping data for table `Straipsnis`
--

INSERT INTO `Straipsnis` (`id`, `pavadinimas`, `sukurimo_data`, `vartotojas_id`, `tema_id`) VALUES
(1, 'Sveikas gyvenimas misko apsuptyje', '2024-11-28 01:04:27', 1, 1),
(2, 'Kodel miegoti yra svarbu?', '2024-12-28 01:47:48', 1, 7),
(3, 'Koki kompiuteri yra geriausia pirkti?', '2024-12-01 11:33:34', 1, 4);

--
-- Dumping data for table `Straipsnis_Blokas`
--

INSERT INTO `Straipsnis_Blokas` (`id`, `tekstas`, `straipsnis_id`, `paveikslelis_id`) VALUES
(1, 'Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje.', 1, NULL),
(2, 'Labai idomus straipsnis apie gyvenima misko apsuktyje pabaiga.', 1, NULL),
(3, 'Miegoti yra svarbu', 2, 1),
(4, 'Miegoti svarbu', 2, NULL),
(5, 'Miegoti yra labai svarbu', 2, 2),
(6, 'Kompiuteriai yra labai svarbus musu gyvenime, todel daznai kyla klausimas koki kompiuteri yra geriausia pirkti?\r\nKompiuteriai yra labai svarbus musu gyvenime, todel daznai kyla klausimas koki kompiuteri yra geriausia pirkti?\r\nKompiuteriai yra labai svarbus musu gyvenime, todel daznai kyla klausimas koki kompiuteri yra geriausia pirkti?\r\nKompiuteriai yra labai svarbus musu gyvenime, todel daznai kyla klausimas koki kompiuteri yra geriausia pirkti?\r\nKompiuteriai yra labai svarbus musu gyvenime, todel daznai kyla klausimas koki kompiuteri yra geriausia pirkti?\r\nKompiuteriai yra labai svarbus musu gyvenime, todel daznai kyla klausimas koki kompiuteri yra geriausia pirkti?\r\nKompiuteriai yra labai svarbus musu gyvenime, todel daznai kyla klausimas koki kompiuteri yra geriausia pirkti?\r\nKompiuteriai yra labai svarbus musu gyvenime, todel daznai kyla klausimas koki kompiuteri yra geriausia pirkti?\r\nKompiuteriai yra labai svarbus musu gyvenime, todel daznai kyla klausimas koki kompiuteri yra geriausia pirkti?\r\nKompiuteriai yra labai svarbus musu gyvenime, todel daznai kyla klausimas koki kompiuteri yra geriausia pirkti?\r\nKompiuteriai yra labai svarbus musu gyvenime, todel daznai kyla klausimas koki kompiuteri yra geriausia pirkti?\r\nKompiuteriai yra labai svarbus musu gyvenime, todel daznai kyla klausimas koki kompiuteri yra geriausia pirkti?', 3, 3);

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

--
-- Dumping data for table `Vartotojas`
--

INSERT INTO `Vartotojas` (`id`, `prisijungimo_vardas`, `slaptazodis`, `vardas`, `pavarde`, `paskyros_tipas_id`) VALUES
(1, 'rasytojas', '$2y$10$8FbuaePSEtJNQl72EK1uFOlOAiz8Oar.5vnrffgRzx5JEW2h/9wcm', 'Simas', 'Rasytojas', 2),
(2, 'admin', '$2y$10$OQRCYeBplJUfPcgOWqMqk.ffkN.e02GbOsavpskXlcIcR5.9EqF9y', 'Simas', 'Administratorius', 3),
(3, 'skaitytojas', '$2y$10$AZxuDHhJOjtYGoT3a.0JSud3UnoQg2BskH/6Z6LsEpMp5Dcw6FJ0W', 'Simas', 'Skaitytojas', 1);

--
-- Dumping data for table `Vartotojas_Tema`
--

INSERT INTO `Vartotojas_Tema` (`id`, `vartotojas_id`, `tema_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(6, 3, 1),
(7, 3, 2);

--
-- Dumping data for table `Vertinimas`
--

INSERT INTO `Vertinimas` (`id`, `vertinimas`, `sukurimo_data`, `vartotojas_id`, `straipsnis_id`) VALUES
(1, 8, '2024-11-30 10:15:00', 3, 1),
(2, 9, '2024-11-30 11:20:00', 3, 1),
(3, 7, '2024-11-30 12:30:00', 3, 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
