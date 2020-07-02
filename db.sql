-- Host: 127.0.0.1
-- Server-Version: 8.0.20
-- PHP-Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Datenbank: `sportradar`
--
CREATE DATABASE IF NOT EXISTS `sportradar` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `sportradar`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `events`
--

CREATE TABLE `events` (
  `id` int NOT NULL,
  `time` datetime NOT NULL,
  `details` varchar(255) COLLATE utf8_bin NOT NULL,
  `team_home_fk` int DEFAULT NULL,
  `team_away_fk` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `events`
--

INSERT INTO `events` (`id`, `time`, `details`, `team_home_fk`, `team_away_fk`) VALUES
(1, '2020-07-23 12:52:13', '', 1, 2),
(3, '2020-07-23 12:52:13', '', 1, 2),
(4, '2020-07-23 12:52:13', '', 1, 2),
(5, '2020-07-23 12:52:13', 'a cool event', 1, 2),
(6, '2020-07-23 12:52:13', 'a cool event 1', 1, 2),
(7, '2020-07-23 12:52:13', 'a cool event 2', 1, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sports`
--

CREATE TABLE `sports` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `sports`
--

INSERT INTO `sports` (`id`, `name`) VALUES
(1, 'Soccer'),
(2, 'Football');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `teams`
--

CREATE TABLE `teams` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `sport_fk` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `teams`
--

INSERT INTO `teams` (`id`, `name`, `sport_fk`) VALUES
(1, 'Real Madrid', 1),
(2, 'Barcelona', 1);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `team_home_fk` (`team_home_fk`,`team_away_fk`),
  ADD KEY `team_away_fk` (`team_away_fk`);

--
-- Indizes für die Tabelle `sports`
--
ALTER TABLE `sports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indizes für die Tabelle `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `sport_fk` (`sport_fk`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `events`
--
ALTER TABLE `events`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT für Tabelle `sports`
--
ALTER TABLE `sports`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`team_home_fk`) REFERENCES `teams` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`team_away_fk`) REFERENCES `teams` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints der Tabelle `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `teams_ibfk_1` FOREIGN KEY (`sport_fk`) REFERENCES `sports` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;
