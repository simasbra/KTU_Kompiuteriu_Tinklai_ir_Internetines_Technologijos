-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 01, 2024 at 12:06 PM
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
(3, 'Senas kompiuteris', 'left', 'https://www.startpage.com/av/proxy-image?piurl=http%3A%2F%2Fwww.vintageisthenewold.com%2Fwp-content%2Fuploads%2F2017%2F08%2Fimbpc.jpg&sp=1733045479Tba613dc2d27484b1fa9d9a26b892d5bcd4678e0cfbed2c61fa38d2469eb6124d'),
(4, 'El Capitan', 'top', 'https://www.startpage.com/av/proxy-image?piurl=https%3A%2F%2Fentechonline.com%2Fwp-content%2Fuploads%2F2024%2F11%2Fworlds-fastest-supercomputer-870x468.jpg&sp=1733046754Tbd63c1763126feb99cbf6167679270cd905038ef9a4f346c718e1114b46a0269'),
(5, 'Blynai', 'top', 'https://www.lamaistas.lt/uploads/modules/recipes/thumb920x573/44676.jpg'),
(6, 'Blynai', 'left', 'https://www.lamaistas.lt/uploads/modules/recipes/thumb920x573/44677.jpg');

--
-- Dumping data for table `Straipsnis`
--

INSERT INTO `Straipsnis` (`id`, `pavadinimas`, `sukurimo_data`, `vartotojas_id`, `tema_id`) VALUES
(1, 'Sveikas gyvenimas misko apsuptyje', '2024-11-28 01:04:27', 1, 1),
(2, 'Kodel miegoti yra svarbu?', '2024-12-28 01:47:48', 1, 7),
(3, 'Koki kompiuteri yra geriausia pirkti?', '2024-12-01 11:33:34', 1, 4),
(4, 'Galingiausias kompiuteris pasaulyje', '2024-12-01 11:59:33', 1, 4),
(5, 'SkanÅ«s miltiniai blynai', '2024-12-01 12:02:16', 1, 2);

--
-- Dumping data for table `Straipsnis_Blokas`
--

INSERT INTO `Straipsnis_Blokas` (`id`, `tekstas`, `straipsnis_id`, `paveikslelis_id`) VALUES
(1, 'Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje. Labai idomus straipsnis apie gyvenima misko apsuktyje.', 1, NULL),
(2, 'Labai idomus straipsnis apie gyvenima misko apsuktyje pabaiga.', 1, NULL),
(3, 'Miegoti yra svarbu', 2, 1),
(4, 'Miegoti svarbu', 2, NULL),
(5, 'Miegoti yra labai svarbu', 2, 2),
(6, 'Kompiuteriai yra labai svarbus musu gyvenime, todel daznai kyla klausimas koki kompiuteri yra geriausia pirkti?\r\nKompiuteriai yra labai svarbus musu gyvenime, todel daznai kyla klausimas koki kompiuteri yra geriausia pirkti?\r\nKompiuteriai yra labai svarbus musu gyvenime, todel daznai kyla klausimas koki kompiuteri yra geriausia pirkti?\r\nKompiuteriai yra labai svarbus musu gyvenime, todel daznai kyla klausimas koki kompiuteri yra geriausia pirkti?\r\nKompiuteriai yra labai svarbus musu gyvenime, todel daznai kyla klausimas koki kompiuteri yra geriausia pirkti?\r\nKompiuteriai yra labai svarbus musu gyvenime, todel daznai kyla klausimas koki kompiuteri yra geriausia pirkti?\r\nKompiuteriai yra labai svarbus musu gyvenime, todel daznai kyla klausimas koki kompiuteri yra geriausia pirkti?\r\nKompiuteriai yra labai svarbus musu gyvenime, todel daznai kyla klausimas koki kompiuteri yra geriausia pirkti?\r\nKompiuteriai yra labai svarbus musu gyvenime, todel daznai kyla klausimas koki kompiuteri yra geriausia pirkti?\r\nKompiuteriai yra labai svarbus musu gyvenime, todel daznai kyla klausimas koki kompiuteri yra geriausia pirkti?\r\nKompiuteriai yra labai svarbus musu gyvenime, todel daznai kyla klausimas koki kompiuteri yra geriausia pirkti?\r\nKompiuteriai yra labai svarbus musu gyvenime, todel daznai kyla klausimas koki kompiuteri yra geriausia pirkti?', 3, 3),
(7, 'As of November 2024, the number one supercomputer is El Capitan, the leader on Green500 is JEDI, a Bull Sequana XH3000 system using the Nvidia Grace Hopper GH200 Superchip. In June 2022, the top 4 systems of Graph500 used both AMD CPUs and AMD accelerators. After an upgrade, for the 56th TOP500 in November 2020,', 4, 4),
(8, 'El Capitan uses a combined 11,039,616 CPU and GPU cores consisting of 43,808 AMD 4th Gen EPYC 24C \"Genoa\" 24 core 1.8 GHz CPUs (1,051,392 cores) and 43,808 AMD Instinct MI300A GPUs (9,988,224 cores). The MI300A consists of 24 Zen4 based CPU cores, and a CDNA3 based GPU integrated onto a single organic package, along with 128GB of HBM3 memory.', 4, NULL),
(9, 'Labai gardÅ«s miltiniai blyneliai. Tokius kepdavo mano moÄiutÄ—. Pagal Å¡Ä¯ receptÄ… pagaminti jie pavyksta gana ploni, minkÅ¡tuÄiai ir tiesiog sutirpsta burnoje. Jeigu mÄ—gstate puresnius, storesnius blynelius, galite vietoje pieno pilti kefyrÄ…, Ä¯dÄ—ti Å¡iek tiek kepimo milteliÅ³ bei daryti truputÄ¯ tirÅ¡tesnÄ™ teÅ¡lÄ…. Bet prieÅ¡ eksperimentus bÅ«tinai paragaukite blyneliÅ³, iÅ¡keptÅ³ pagal originalÅ³ receptÄ…, nes jie tikrai labai geri ir mane paÄiÄ…, daÅ¾niausiai puriÅ³ blynÅ³ mylÄ—tojÄ…, kaskart nustebina, kokie jie skanÅ«s. O tarp vaikÅ³ Å¡ie blynukai turi iÅ¡vis neÄ¯tikÄ—tina pasisekimÄ…. Beje, cukraus kiekÄ¯ galite koreguoti savo nuoÅ¾iÅ«ra. Jeigu valgysite su saldesne uogiene, tikrai pakaks ir 1 Å¡aukÅ¡to ar maÅ¾iau. IÅ¡ recepte nurodyto kiekio mums paprastai iÅ¡kepu 18-20 blyneliÅ³, kuriÅ³ uÅ¾tenka 2 alkaniems arba 3 maÅ¾iau alkaniems valgytojams.', 5, 5),
(10, 'SKANIÅ² MILTINIÅ² BLYNÅ² PARUOÅ IMO BÅªDAS:\r\nParuoÅ¡imo laikas: Apie 30 min.\r\n1.\r\nKiauÅ¡inius Ä¯muÅ¡ti Ä¯ indÄ…, berti cukrÅ³, Å¾iupsnelÄ¯ druskos ir gerai. iÅ¡plakti.\r\n2.\r\nSuberti miltus ir Å¡aukÅ¡tu gerai iÅ¡maiÅ¡yti. Per kelis kartus supilti pienÄ…, kaskart gerai iÅ¡maiÅ¡ant. TurÄ—tÅ³ gautis poskystÄ— teÅ¡la. JÄ… palikti 10-15 min pastovÄ—ti, kad miltai iÅ¡brinktÅ³.\r\n3.\r\nKeptuvÄ—je Ä¯kaitinti truputÄ¯ aliejaus arba sviesto. Vienam blyneliui dÄ—ti po daugmaÅ¾ Å¡aukÅ¡tÄ… teÅ¡los. Kepti ant vidutinÄ—s kaitros. Kai blyneliÅ³ virÅ¡us pakeisk spalvÄ… ir atsiras burbuliukÅ³, apversti ir dar Å¡iek tiek pakepti.\r\n4.\r\nTiekti iÅ¡ karto iÅ¡keptus, paÅ¡ildytose lÄ—kÅ¡tÄ—se arba laikyti Å¡iltoje orkaitÄ—je, kad neatvÄ—stÅ³.\r\n5.\r\nÅ iuos blynelius tinka valgyti su uogiene, grietine, jogurtu ar kaip tik mÄ—gstate.', 5, NULL),
(11, 'Patarimai:\r\nâ€¢\r\nBlyneliÅ³ forma. Kepant apvertus blyneliai Å¡iek tiek iÅ¡siries, tarsi dubenÄ—liai - viskas tvarkoje, taip ir turi bÅ«ti. SudÄ—jus Ä¯ lÄ—kÅ¡tÄ™ jie suplokÅ¡tÄ—s.\r\nâ€¢\r\nStorumas. Å ie blyneliai yra ploni, minkÅ¡tuÄiai ir tiesiog sutirpsta burnoje. Jeigu mÄ—gstate puresnius, storesnius blynelius, galite vietoje pieno pilti kefyrÄ…, Ä¯dÄ—ti Å¡iek tiek kepimo milteliÅ³ bei daryti truputÄ¯ tirÅ¡tesnÄ™ teÅ¡lÄ… dÄ—dami daugiau miltÅ³.\r\nâ€¢\r\nSaldumas. Cukraus kiekÄ¯ galite koreguoti savo nuoÅ¾iÅ«ra. Jei valgysite su saldesne uogiene, cukraus pakaks ir 1 Å¡aukÅ¡to.', 5, 6);

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
