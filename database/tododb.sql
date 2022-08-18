-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 18 aug 2022 om 17:38
-- Serverversie: 10.4.24-MariaDB
-- PHP-versie: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tododb`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `text` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `userId` int(11) NOT NULL,
  `taskId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `comments`
--

INSERT INTO `comments` (`id`, `text`, `userId`, `taskId`) VALUES
(46, 'CSS is aangepast', 1, 28),
(47, 'Hosting is nagekeken en werkt nog', 1, 45),
(48, 'Zeep moet worden ingekocht', 1, 70);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `listId` int(11) NOT NULL,
  `title` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `hour` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `done` tinyint(1) NOT NULL DEFAULT 0,
  `attachment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `tasks`
--

INSERT INTO `tasks` (`id`, `userId`, `listId`, `title`, `hour`, `date`, `done`, `attachment`) VALUES
(28, 1, 11, 'Github', 3, '2022-08-22', 1, NULL),
(45, 1, 11, 'Website hosting', 2, '2022-08-24', 0, ''),
(69, 1, 12, 'Vaatwas leegmaken', 1, '2022-09-02', 0, NULL),
(70, 1, 12, 'Dweilen', 3, '2022-09-01', 0, NULL),
(71, 1, 13, 'Stal uitmesten', 1, '2022-08-23', 0, NULL),
(72, 1, 13, 'Weide maken', 6, '2022-08-26', 0, NULL),
(73, 1, 14, 'Rijden', 2, '2022-08-16', 1, NULL),
(74, 1, 14, 'Longeren', 1, '2022-08-20', 0, NULL),
(75, 1, 14, 'Wandelen', 2, '2022-08-30', 0, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `todo_lists`
--

CREATE TABLE `todo_lists` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `title` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(300) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `todo_lists`
--

INSERT INTO `todo_lists` (`id`, `userId`, `title`, `description`) VALUES
(11, 1, 'Development', 'Alle opdrachten voor development 4, herexamen php.'),
(12, 1, 'Huishoud taken', 'Alle zaken die in het huishouden moeten gebeuren.'),
(13, 1, 'Stal', 'Alle klusjes op stal.'),
(14, 1, 'Da Vinci', 'Trainingen die met Da Vinci (paard) moeten gebeuren.'),
(15, 5, 'Hogeschool', 'Zaken die in orde moeten gebracht worden voor het nieuwe academiejaar.');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `is_admin`) VALUES
(1, 'Laurenvdl', '$2y$12$pcJXQFbPsnlyfxphikLxzuMrYv2uHPtY4q/NU1PpUPDQliQ9Ax94O', 1),
(5, 'Highness', '$2y$12$2de4HccWooEvz6s5nUQ/bOv7Pu9hbev2SvznBx8A0cSP6DQ3.e0Bi', 0),
(8, 'DaVinci', '$2y$12$4MpSq3zbsPE/7j7a3mc/3O9QgHUCT2zJQOsXeUm51sohRVb2rAjDC', 0);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `todo_lists`
--
ALTER TABLE `todo_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT voor een tabel `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT voor een tabel `todo_lists`
--
ALTER TABLE `todo_lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `todo_lists`
--
ALTER TABLE `todo_lists`
  ADD CONSTRAINT `todo_lists_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;