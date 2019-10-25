-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 22. Okt 2019 um 11:42
-- Server-Version: 10.3.17-MariaDB-0+deb10u1
-- PHP-Version: 7.3.9-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `mhadmin_db`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sites`
--

CREATE TABLE `sites` (
  `id_site` mediumint(8) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `site_dir` varchar(100) NOT NULL,
  `description` tinytext DEFAULT NULL,
  `site_name` varchar(100) NOT NULL,
  `db_name` varchar(25) NOT NULL,
  `id_user` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `sites`
--

INSERT INTO `sites` (`id_site`, `title`, `site_dir`, `description`, `site_name`, `db_name`, `id_user`) VALUES
(17, 'Персональная страница Вани Иванова', 'ivaiva01/site_1', 'Описание измененное', 'ivaiva01-site-1', 'ivaiva01_site_1_db', 2),
(19, 'Эдуард Суровый о музыке', 'edusur14/site_1', 'Размышления о музыке', 'edusur14-site-1', '', 126),
(21, 'Уроки игры на гитаре', 'edusur14/site_2', 'Уроки игры на гитаре от Эдуарда Сурового', 'edusur14-site-2', '', 126),
(22, 'Petrovs Site', 'petpet26/site_1', 'Description', 'petpet26-site-1', '', 10),
(25, 'New Site', 'ivaiva01/site_3', 'Description', 'ivaiva01-site-3', 'ivaiva01_site_3_db', 2),
(26, 'New test site', 'ivaiva01/site_2', 'Should be number 2', 'ivaiva01-site-2', 'ivaiva01_site_2_db', 2),
(28, 'My First Site', 'antmel01/site_1', 'Description', 'antmel01-site-1', 'antmel01_site_1_db', 1),
(29, 'My Second Site', 'antmel01/site_2', 'Desc', 'antmel01-site-2', '', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id_user` smallint(5) UNSIGNED NOT NULL,
  `fname` varchar(25) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(70) NOT NULL,
  `email` varchar(254) DEFAULT NULL,
  `rest` tinytext DEFAULT NULL,
  `usertype` enum('user','admin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id_user`, `fname`, `lname`, `username`, `password`, `email`, `rest`, `usertype`) VALUES
(1, 'Антон', 'Мельников', 'antmel01', '$2y$10$txrOAUEmeQbgPTAUbOCq.eGM5FbmYLsUGGwyZtyVZmDd9.0FxcHx6', 'anton.melnikov@test.com', 'I&#39;m the boss!!! Yes, I am!!!', 'admin'),
(2, 'Иван', 'Иванов', 'ivaiva01', '$2y$10$SeGfSoaadKozsrvvXeNRoO4JLtjGm0miVuOl780g0AktL8wlbC8ce', 'ivan.ivanov@test.com', 'Измененные данные 2', 'user'),
(10, 'Петр', 'Петров', 'petpet26', '$2y$10$WIDfeEKY9FdJd.8ObHsYIOxMK9oaWUCPG0S78zkPDeI.FgWvmc82y', NULL, NULL, 'user'),
(28, 'Петр', 'Васечкин', 'petvas89', '$2y$10$LluLWclMKlx9Zyipl2SG/uqmZTkAnxMZt9P/oWJYm2fAktp3EuO4G', NULL, NULL, 'user'),
(38, 'Иван', 'Сидоров', 'ivasid01', '$2y$10$0Gp/m02a.5/CQAY3h35asO3nHMBI4elO6oqyTPduJq7y3e0utvxw6', NULL, NULL, 'user'),
(102, 'Иван', 'Сидоров', 'ivasid25', '$2y$10$AEpdlGqLDtw5L7pnh2bZhesWThG58tE.jQnJYYp.KRIty.FZKTady', NULL, NULL, 'user'),
(117, 'Сидор', 'Безмолвный', 'sidbez50', '$2y$10$hgEV5ssPUoTC0rpPyBMX0OvY9UEwnVTPORB2nikIvFYQQGXA9jGy2', NULL, NULL, 'user'),
(126, 'Эдуард', 'Суровый', 'edusur14', '$2y$10$53yNtinZ.GBzh0i3roMR9.UZ5aMZtva.433JDY/TasG54W1TXvR0W', 'eduard.suroviy@ggg.ru', 'Проект: Пиво\r\nУчастники: группа Губы', 'admin'),
(134, 'Петр', 'Петров', 'petpet58', '$2y$10$JbnfSDvDtvsgi5vSSf9fhO3ZBk/kIqS98KJzz8q4xQLpryLWfMwKa', NULL, NULL, 'user'),
(135, 'Петр', 'Петров', 'petpet41', '$2y$10$CZdHPiKq/jKpgcIbRG9zeec6LViOoEfR7sC0Crm0ewxhgYhF8LT3W', NULL, NULL, 'user'),
(143, 'Антон', 'Ежов', 'antezh22', '$2y$10$S9ZtZojNtvvTMcgm4hwLP.o/CwygIqIGbxV/xRvp8pw9ZzLo.Rzo2', NULL, NULL, 'admin'),
(144, 'Сергей', 'Мухин', 'sermuk11', '$2y$10$6mjlzB.w6iXOf8HVUw/B4eiCS/jAJmWRnegd2lcDHE0JL4GSImcgi', 'test1@test.ru', NULL, 'admin'),
(145, 'Ольга', 'Петрухина', 'olgpet98', '$2y$10$uD05Dax6is1VtEKmjjK.TufXVn7FOnce7Jwzebo6ZZ83NUVTlWm9.', 'test2@test.ru', NULL, 'user'),
(146, 'Василий', 'Пупкин', 'vaspup97', '$2y$10$KtOmMD4OtVLIPLsInipEjuqArWJA.96hZA7Gk8gsrdS7FYf6pJJ5q', NULL, NULL, 'user'),
(147, 'Катерина', 'Баринова', 'katbar91', '$2y$10$62sN0m8Nnoh99CUzZLA92u6Pm1OY/w2Eds05.N9rrE05OtK4urmGO', NULL, NULL, 'user'),
(148, 'Сергей', 'Харламов', 'serkha44', '$2y$10$7xGedG8V4Pt5DPEtVmCUc.5Z9J8ABHpcQTN4VWTRnKZ2pUSP6zCj6', NULL, NULL, 'user'),
(157, 'qqqq', 'wwww', 'qqqwww96', '$2y$10$P6u3zpU3KFvBPWIl2R5fBulza2yFL7ZTdVAIQf4wxx/27qoD1hVCi', NULL, NULL, 'user'),
(158, 'Василий', 'Петров', 'vaspet26', '$2y$10$TnzMnE6x2BWIFnxtpDuYIemEQdnZvuxV0rAmnR1.qZqBD/6Rn/TIq', NULL, NULL, 'user'),
(159, 'Иван', 'Жуков', 'ivazhu21', '$2y$10$D3bL9vkbq1gHRoMqicX7jOdEL337uavP2X.SRXAVNconU41Uy22Uy', NULL, NULL, 'user'),
(160, 'Сергей', 'Пятницкий', 'serpya28', '$2y$10$2a0Vvy67k7lxnK2AWg4Yae8cUbsGffMkJXslA7izotHJyAhP.WZvq', NULL, NULL, 'user');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `sites`
--
ALTER TABLE `sites`
  ADD PRIMARY KEY (`id_site`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `uname` (`username`) USING BTREE;

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `sites`
--
ALTER TABLE `sites`
  MODIFY `id_site` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id_user` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
