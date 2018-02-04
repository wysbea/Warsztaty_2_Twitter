-- phpMyAdmin SQL Dump
-- version 4.6.6deb1+deb.cihar.com~xenial.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 04 Lut 2018, 13:13
-- Wersja serwera: 5.7.21-0ubuntu0.16.04.1
-- Wersja PHP: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `twitter`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Comment`
--

CREATE TABLE `Comment` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `postId` int(11) NOT NULL,
  `text` varchar(60) DEFAULT NULL,
  `creationDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `Comment`
--

INSERT INTO `Comment` (`id`, `userId`, `postId`, `text`, `creationDate`) VALUES
(1, 8, 1, 'Dzisiaj nic, fajny dzieÅ„', '2018-01-23 09:36:29'),
(2, 7, 1, 'CzeÅ›Ä‡, wszystko w porzÄ…dku', '2018-01-23 09:37:53'),
(3, 8, 1, 'Hello', '2018-01-25 20:52:51'),
(4, 8, 1, 'hgjuhy', '2018-01-25 21:20:43'),
(5, 8, 8, 'tralala', '2018-01-25 22:24:00'),
(6, 10, 8, 'Chyba Ci bardzo wesoÅ‚o sÅ‚onko', '2018-01-26 00:14:02'),
(7, 10, 9, 'No dobra', '2018-01-26 00:14:29'),
(8, 10, 11, 'Komentuje', '2018-01-26 01:46:13'),
(9, 10, 10, 'fajnie', '2018-01-26 01:46:59'),
(10, 8, 11, 'wyÅ›lij', '2018-01-26 01:48:44'),
(11, 8, 1, 'koleÅ¼ka', '2018-01-26 02:27:45'),
(12, 5, 1, 'Komentuje', '2018-01-26 02:30:04'),
(13, 5, 15, 'Co siÄ™ dzieje?', '2018-01-26 02:30:28'),
(14, 5, 17, 'Kiedy skacze?', '2018-01-26 02:49:08'),
(15, 5, 10, 'tak mi siÄ™ teÅ¼ wydaje', '2018-01-26 02:50:51'),
(16, 10, 17, 'ZakomentowaÄ‡ moÅ¼na', '2018-01-26 03:00:21');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Message`
--

CREATE TABLE `Message` (
  `id` int(11) NOT NULL,
  `messageReceiverId` int(11) NOT NULL,
  `messageSenderId` int(11) NOT NULL,
  `text` varchar(140) DEFAULT NULL,
  `creationDate` datetime DEFAULT NULL,
  `isRead` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `Message`
--

INSERT INTO `Message` (`id`, `messageReceiverId`, `messageSenderId`, `text`, `creationDate`, `isRead`) VALUES
(1, 8, 7, 'CzeÅ›Ä‡ co u Ciebie?', '2018-01-23 09:38:37', 1),
(2, 8, 7, 'Jak siÄ™ masz?', '2018-01-23 09:38:45', 1),
(3, 8, 10, 'Hello, co tam w wielkim Å›wiecie.', '2018-01-26 01:14:30', 1),
(4, 8, 10, 'Hello, co tam w wielkim Å›wiecie.', '2018-01-26 01:14:57', 1),
(5, 10, 7, 'jej', '2018-01-26 02:42:05', 0),
(6, 8, 5, 'Ciekawa sprawa', '2018-01-26 02:49:52', 0),
(7, 10, 5, 'KoleÅ¼ka na grzybach?', '2018-01-26 02:50:35', 1),
(8, 10, 5, 'No tak', '2018-01-26 02:51:20', 0),
(9, 8, 5, 'maksimum', '2018-01-26 02:55:25', 0),
(10, 10, 5, 'gggg', '2018-01-26 02:58:13', 1),
(11, 10, 5, 'bublu', '2018-01-26 02:59:02', 1),
(12, 5, 10, 'klo', '2018-01-26 03:02:16', 0),
(13, 10, 10, 'hh', '2018-01-26 03:06:13', 0),
(14, 5, 10, 'yyyeti', '2018-01-26 03:06:46', 1),
(15, 10, 5, 'beka', '2018-01-26 03:12:20', 0),
(16, 10, 5, 'klatka', '2018-01-26 03:13:06', 1),
(17, 5, 8, 'Jest dobrze', '2018-01-26 03:30:00', 0),
(18, 5, 8, 'ZÅ‚ota?', '2018-01-26 03:31:48', 0),
(19, 5, 8, 'CzeÅ›Ä‡ co u Ciebie?', '2018-01-26 03:32:30', 0),
(20, 5, 8, 'CoÅ›', '2018-01-26 17:55:32', 0),
(21, 5, 8, 'CzeÅ›Ä‡ co u Ciebie?', '2018-01-26 18:18:24', 0),
(22, 5, 8, 'Hejka', '2018-01-26 19:14:27', 0),
(23, 5, 8, 'Magda?', '2018-01-26 19:21:43', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Tweet`
--

CREATE TABLE `Tweet` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `text` varchar(140) DEFAULT NULL,
  `creationDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `Tweet`
--

INSERT INTO `Tweet` (`id`, `userId`, `text`, `creationDate`) VALUES
(1, 8, 'Co siÄ™ dzieje?', '2018-01-23 09:35:53'),
(2, 8, 'ecedrfce', '2018-01-25 20:53:10'),
(3, 8, 'khjki', '2018-01-25 21:19:34'),
(4, 8, 'ggg', '2018-01-25 21:20:14'),
(5, 8, 'Dzisiaj nic, fajny dzieÅ„', '2018-01-25 22:21:32'),
(6, 8, 'Dzisiaj nic, fajny dzieÅ„', '2018-01-25 22:22:24'),
(7, 8, 'Dzisiaj nic, fajny dzieÅ„', '2018-01-25 22:22:36'),
(8, 8, 'Dzisiaj nic, fajny dzieÅ„', '2018-01-25 22:22:46'),
(9, 10, 'Jest okej, bardzo podoba mi siÄ™ obecna praca, jestem speÅ‚niony.', '2018-01-26 00:12:36'),
(10, 10, 'Lorem ipsum', '2018-01-26 01:29:39'),
(11, 10, 'Teka', '2018-01-26 01:45:59'),
(12, 8, 'hhhhh', '2018-01-26 01:48:26'),
(13, 8, 'jjjjjj', '2018-01-26 02:17:21'),
(14, 8, 'gbug', '2018-01-26 02:26:12'),
(15, 8, 'boberek', '2018-01-26 02:26:45'),
(16, 8, 'Halo, co sÅ‚ychaÄ‡', '2018-01-26 02:32:00'),
(17, 5, 'Koza lubi skakaÄ‡', '2018-01-26 02:48:43'),
(18, 8, 'Kiedy skacze?', '2018-01-26 03:31:35'),
(19, 8, 'jnj', '2018-01-26 17:40:20');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Users`
--

CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `username` varchar(255) NOT NULL,
  `hash_pass` varchar(60) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `Users`
--

INSERT INTO `Users` (`id`, `email`, `username`, `hash_pass`) VALUES
(5, 'magda@wp.pl', 'magda12', '$2y$10$/dhHCpBMLShyqh5i9xe.LufUetjiGsJTBeHMwWOVwCHoBXBNDekwe'),
(7, 'magdawp@wp.pl', 'magda123', '$2y$10$PteGUxZiXkSqrij7jYibTeDtu2Ut/egpfHNPt2sAtRcrk0D41RK.S'),
(8, 'wysbea@gmail.com', 'wysbea', '$2y$10$mONMrKv9B7w4v2s5JexXE.oQnoS9lF0eZzay/Y18CGlMQQcf7mceq'),
(9, 'woop@wp.pl', 'beata', '$2y$10$Inx.aV6aHN3u6h51e7dFleMJ5qHwNU.brod5IU7xDF/SnXRCmeahO'),
(10, 'marian@op.pl', 'marian', '$2y$10$kduEm.ROZAI1mYQs7e.xe.B960k34bi8MJL5Zq8/JltY1wdr8pzkO'),
(11, 'jacek@op.pl', 'jacek', '$2y$10$P9cnuf5S32pWSEyb/mszfOW7kAypWtTE/ZRY7ET9.GUtDoRCMW3H2');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `Comment`
--
ALTER TABLE `Comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`),
  ADD KEY `postId` (`postId`);

--
-- Indexes for table `Message`
--
ALTER TABLE `Message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messageReceiverId` (`messageReceiverId`),
  ADD KEY `messageSenderId` (`messageSenderId`);

--
-- Indexes for table `Tweet`
--
ALTER TABLE `Tweet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `Comment`
--
ALTER TABLE `Comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT dla tabeli `Message`
--
ALTER TABLE `Message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT dla tabeli `Tweet`
--
ALTER TABLE `Tweet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT dla tabeli `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `Comment`
--
ALTER TABLE `Comment`
  ADD CONSTRAINT `Comment_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `Users` (`id`),
  ADD CONSTRAINT `Comment_ibfk_2` FOREIGN KEY (`postId`) REFERENCES `Tweet` (`id`);

--
-- Ograniczenia dla tabeli `Message`
--
ALTER TABLE `Message`
  ADD CONSTRAINT `Message_ibfk_1` FOREIGN KEY (`messageReceiverId`) REFERENCES `Users` (`id`),
  ADD CONSTRAINT `Message_ibfk_2` FOREIGN KEY (`messageSenderId`) REFERENCES `Users` (`id`);

--
-- Ograniczenia dla tabeli `Tweet`
--
ALTER TABLE `Tweet`
  ADD CONSTRAINT `Tweet_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `Users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
