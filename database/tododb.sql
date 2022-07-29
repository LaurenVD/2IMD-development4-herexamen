-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 29 jul 2022 om 11:24
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
-- Tabelstructuur voor tabel `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `text` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `userId` int(11) NOT NULL,
  `taskId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `comment`
--

INSERT INTO `comment` (`id`, `text`, `userId`, `taskId`) VALUES
(1, 'dfwgdg', 1, 5),
(2, 'nog een', 1, 5),
(3, 'qrgee', 1, 5),
(4, 'dwfb', 1, 5),
(5, 'dwfbsdef', 1, 5),
(6, 'hyyy', 1, 5),
(7, 'hyyyyyyy', 1, 5),
(8, '<rg', 1, 5),
(9, 'wrgvgw', 1, 5),
(10, 'qderg', 1, 4),
(11, 'dtsbrt', 1, 8),
(12, 'hallo', 1, 27),
(13, 'Eerste reactie', 1, 27),
(14, 'Hallo', 1, 27),
(15, 'Hallo', 1, 27),
(16, 'opnieuw', 1, 27),
(17, 'Ikke', 1, 27),
(18, 'Nog eens', 1, 27),
(19, 'Nog eens', 1, 27),
(20, 'Nog eens', 1, 27),
(21, 'Hallo', 1, 27),
(22, '63456', 1, 27),
(23, '468', 1, 27);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `lijst`
--

CREATE TABLE `lijst` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `title` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(300) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `lijst`
--

INSERT INTO `lijst` (`id`, `userId`, `title`, `description`) VALUES
(11, 1, 'tesdt', 'fgqdger'),
(12, 1, 'test2', 'tekst2'),
(13, 1, 'test3', 'tekst3'),
(14, 5, 'test4', 'tekst4'),
(15, 5, 'test5', 'tekst5');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `lijstId` int(11) NOT NULL,
  `title` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `hour` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `task`
--

INSERT INTO `task` (`id`, `userId`, `lijstId`, `title`, `hour`, `date`) VALUES
(27, 1, 11, 'eqrs', 4, '2022-09-21'),
(28, 1, 11, 'sth', 3, '2022-07-28'),
(29, 1, 12, 'test', 4, '2022-07-27'),
(30, 1, 12, 'test', 4, '2022-07-27');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(300) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'Laurenvdl', '$2y$12$pcJXQFbPsnlyfxphikLxzuMrYv2uHPtY4q/NU1PpUPDQliQ9Ax94O'),
(5, 'Highness', '$2y$12$2de4HccWooEvz6s5nUQ/bOv7Pu9hbev2SvznBx8A0cSP6DQ3.e0Bi');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `lijst`
--
ALTER TABLE `lijst`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indexen voor tabel `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT voor een tabel `lijst`
--
ALTER TABLE `lijst`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT voor een tabel `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `lijst`
--
ALTER TABLE `lijst`
  ADD CONSTRAINT `lijst_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;