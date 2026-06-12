-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2026 at 08:58 PM
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
-- Database: `musicpedia_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `glazba`
--

CREATE TABLE `glazba` (
  `id` int(11) NOT NULL,
  `izvodjac` varchar(100) NOT NULL,
  `zanr` varchar(50) NOT NULL,
  `biografija` text NOT NULL,
  `korisnik_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `koncerti`
--

CREATE TABLE `koncerti` (
  `id` int(11) NOT NULL,
  `bend` varchar(100) NOT NULL,
  `datum_koncerta` date NOT NULL,
  `mjesto` varchar(255) DEFAULT NULL,
  `vrijeme` varchar(50) DEFAULT NULL,
  `cijena` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `koncerti`
--

INSERT INTO `koncerti` (`id`, `bend`, `datum_koncerta`, `mjesto`, `vrijeme`, `cijena`) VALUES
(1, 'Black Sabbath', '2026-07-09', 'Tvornica kulture, Ul. Pavla Šubića 2, 10000, Zagreb', '9:00 PM(21:00)', 120.00),
(5, 'Michael Jackson', '2026-08-17', 'Arena  Zagreb, Ul. Vice Vukova 8, 10000, Zagreb', '8 PM(20:00)', 200.00),
(6, 'Prince', '2026-09-08', 'Arena Pula, Flavijevska ul., 52100, Pula', '10 PM(10:00)', 160.00),
(7, 'The Rolling Stones', '2027-05-19', 'Arena Zagreb, Ul. Vice Vukova 8, 10000, Zagreb', '9:30 PM(21:30)', 250.00);

-- --------------------------------------------------------

--
-- Table structure for table `kosarica`
--

CREATE TABLE `kosarica` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `koncert_id` int(11) NOT NULL,
  `dodano_u` datetime DEFAULT current_timestamp(),
  `kolicina` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `narudzbe`
--

CREATE TABLE `narudzbe` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `ukupna_cijena` decimal(10,2) NOT NULL,
  `datum_kupnje` datetime DEFAULT current_timestamp(),
  `opis` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `narudzbe`
--

INSERT INTO `narudzbe` (`id`, `user_id`, `username`, `ukupna_cijena`, `datum_kupnje`, `opis`) VALUES
(14, 22, 'sanja.gavran@gmail.com', 960.00, '2026-06-11 20:47:15', 'Black Sabbath|2|120.00|240|Tvornica kulture, Ul. Pavla Šubića 2, 10000, Zagreb|9:00 PM(21:00);Michael Jackson|2|200.00|400|Arena  Zagreb, Ul. Vice Vukova 8, 10000, Zagreb|8 PM(20:00);Prince|2|160.00|320|Arena Pula, Flavijevska ul., 52100, Pula|10 PM(10:00)');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `uloga` varchar(20) DEFAULT 'korisnik',
  `ime` varchar(100) DEFAULT NULL,
  `prezime` varchar(100) DEFAULT NULL,
  `adresa` varchar(255) DEFAULT NULL,
  `oib` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `uloga`, `ime`, `prezime`, `adresa`, `oib`) VALUES
(2, 'lukas.gavran17@gmail.com', 'tock', 'administrator', 'Lukas', 'Gavran', 'Zagrebacka 200', '12345678945'),
(22, 'sanja.gavran@gmail.com', 'tocker', 'korisnik', 'Sanja', 'Gavran', 'Posavska 20 ', '12345678945');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `glazba`
--
ALTER TABLE `glazba`
  ADD PRIMARY KEY (`id`),
  ADD KEY `korisnik_id` (`korisnik_id`);

--
-- Indexes for table `koncerti`
--
ALTER TABLE `koncerti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kosarica`
--
ALTER TABLE `kosarica`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `narudzbe`
--
ALTER TABLE `narudzbe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `glazba`
--
ALTER TABLE `glazba`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `koncerti`
--
ALTER TABLE `koncerti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kosarica`
--
ALTER TABLE `kosarica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `narudzbe`
--
ALTER TABLE `narudzbe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `glazba`
--
ALTER TABLE `glazba`
  ADD CONSTRAINT `glazba_ibfk_1` FOREIGN KEY (`korisnik_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
