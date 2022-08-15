-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 15 aug 2022 om 10:11
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
(23, '468', 1, 27),
(24, 'Test', 5, 41),
(25, 'Hallo', 5, 41),
(26, 'Test', 5, 41),
(27, 'test', 5, 41),
(28, 'test', 5, 41),
(29, 'test', 5, 41),
(30, 'Hallo', 5, 41),
(31, 'test', 5, 41),
(32, 'Hallo', 5, 41),
(33, 'Ik', 5, 41),
(34, 'Ik', 5, 41),
(35, 'Nu', 5, 41),
(36, 'Nu test', 5, 41),
(37, 'Nog is', 5, 41),
(38, 'nog een test', 5, 41),
(39, 'Hii', 1, 28),
(40, 'het werkt', 1, 44),
(41, 'Hallo', 1, 28),
(42, '888', 1, 27),
(43, 'test', 1, 65),
(44, 'hallo', 1, 45);

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
(28, 1, 11, 'sth', 3, '2022-08-29', 1, NULL),
(29, 1, 12, 'test', 4, '2022-07-27', 0, NULL),
(30, 1, 12, 'test', 4, '2022-07-27', 0, NULL),
(40, 5, 0, 'test', 3, '2022-08-01', 0, NULL),
(41, 5, 14, 'Test', 1, '2022-08-01', 0, NULL),
(42, 5, 14, 'test2', 2, '2022-08-10', 0, NULL),
(43, 5, 14, 'test', 1, '2022-08-03', 0, NULL),
(44, 1, 16, 'task', 3, '2022-08-18', 0, NULL),
(45, 1, 11, 'test', 5, '2022-08-10', 0, 'task_files/2d718d51-e297-406d-b8e1-e08dfe3afad4.jfif'),
(65, 1, 17, 'test4', 3, '2022-08-26', 1, NULL);

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
(11, 1, 'tesdt', 'fgqdger'),
(12, 1, 'test2', 'tekst2'),
(13, 1, 'test3', 'tekst3'),
(14, 5, 'test4', 'tekst4'),
(15, 5, 'test5', 'tekst5'),
(16, 1, 'test5', 'tekst5'),
(17, 1, 'test4', 'test4'),
(18, 1, 'Kathleen', 'Kathleentje heeft nog werk'),
(19, 1, 'lauren', 'test');

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
(5, 'Highness', '$2y$12$2de4HccWooEvz6s5nUQ/bOv7Pu9hbev2SvznBx8A0cSP6DQ3.e0Bi', 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT voor een tabel `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT voor een tabel `todo_lists`
--
ALTER TABLE `todo_lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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