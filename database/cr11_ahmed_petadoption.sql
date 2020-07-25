-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 25. Jul 2020 um 16:42
-- Server-Version: 10.4.13-MariaDB
-- PHP-Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `cr11_ahmed_petadoption`
--
CREATE DATABASE IF NOT EXISTS `cr11_ahmed_petadoption` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cr11_ahmed_petadoption`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `animals`
--

CREATE TABLE `animals` (
  `id` int(11) NOT NULL,
  `animal_image` varchar(255) NOT NULL,
  `animal_name` varchar(255) NOT NULL,
  `animal_description` varchar(255) NOT NULL,
  `animal_location` varchar(255) NOT NULL,
  `hobbies` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `animal_type` enum('small','big') NOT NULL,
  `animal_status` enum('junior','senior') NOT NULL,
  `active` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `animals`
--

INSERT INTO `animals` (`id`, `animal_image`, `animal_name`, `animal_description`, `animal_location`, `hobbies`, `age`, `animal_type`, `animal_status`, `active`) VALUES
(2, 'images/bernese.jpg', 'Bruno', 'A small dog', 'Test', 'Playing fetch', 1, 'small', 'junior', 0),
(3, 'images/kitty.jpg', 'Max', 'A nice cat', 'Test', 'Scratching your couch', 9, 'small', 'senior', 0),
(4, 'images/aussie.jpg', 'Sally', 'A good doggo', 'Test', 'Running around in circles', 3, 'small', 'junior', 0),
(5, 'images/babyhorse.jpg', 'Epona', 'A young horse', 'Somewhere in Vienna', 'Eating carrots', 1, 'big', 'junior', 0),
(6, 'images/kangal.jpg', 'Pluto', 'A big doggo', 'Somewhere in Austria', 'Hunting squirrels around', 8, 'big', 'senior', 0),
(7, 'images/beaver.jpg', 'Matthew', 'A wild animal', 'Test', 'Building dams', 2, 'small', 'junior', 0),
(8, 'images/tibetan.jpg', 'Brutus', 'A huge doggo', 'Somewhere in Austria', 'Herding Sheep', 11, 'big', 'senior', 0),
(9, 'images/tarantula.jpg', 'Toby', 'Dont let it out of the cage!', 'Test', 'Unknown', 1, 'small', 'junior', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `userName` varchar(30) NOT NULL,
  `userEmail` varchar(60) NOT NULL,
  `userPass` varchar(255) NOT NULL,
  `status` enum('user','admin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`userId`, `userName`, `userEmail`, `userPass`, `status`) VALUES
(1, 'Test', 'test@test.at', '37268335dd6931045bdcdf92623ff819a64244b53d0e746d438797349d4da578', 'user'),
(2, 'Admin', 'admin@admin.at', '37268335dd6931045bdcdf92623ff819a64244b53d0e746d438797349d4da578', 'admin');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `userEmail` (`userEmail`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `animals`
--
ALTER TABLE `animals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
