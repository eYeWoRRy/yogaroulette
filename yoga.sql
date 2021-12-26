-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 03. Jan 2020 um 15:50
-- Server-Version: 10.1.21-MariaDB
-- PHP-Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `yoga`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kategorie`
--

CREATE TABLE `kategorie` (
  `KID` int(2) NOT NULL,
  `Kat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `kategorie`
--

INSERT INTO `kategorie` (`KID`, `Kat`) VALUES
(1, 'Bauch'),
(2, 'Schulter'),
(3, 'RÃ¼cken'),
(4, 'Entspannung'),
(5, 'GanzkÃ¶rper'),
(6, 'Flow'),
(7, 'HÃ¼ftÃ¶ffner'),
(8, 'AnfÃ¤nger'),
(9, 'Abend'),
(10, 'Morgen'),
(11, 'Nacken'),
(12, 'Office'),
(13, 'Dehnen'),
(14, 'Workout'),
(15, 'Beine'),
(16, 'Konzentration'),
(17, 'Po'),
(18, 'AufwÃ¤rmen'),
(19, 'Arme');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rel_v_k`
--

CREATE TABLE `rel_v_k` (
  `VKID` int(9) NOT NULL,
  `VID` int(4) NOT NULL,
  `KID` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `time`
--

CREATE TABLE `time` (
  `TID` int(11) NOT NULL,
  `Dauer` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `time`
--

INSERT INTO `time` (`TID`, `Dauer`) VALUES
(1, '05-10'),
(2, '10-20'),
(3, '20-30'),
(4, '30-40'),
(5, '40-50'),
(6, '50+');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `video`
--

CREATE TABLE `video` (
  `VID` int(4) NOT NULL,
  `URL` varchar(255) NOT NULL,
  `titel` varchar(255) NOT NULL,
  `TimeID` int(2) NOT NULL,
  `kid` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `video`
--

INSERT INTO `video` (`VID`, `URL`, `titel`, `TimeID`, `kid`) VALUES
(1, 'BnpArk7M6wg', 'Yoga Power Flow | Bauch Beine Po | Effektiv & Intensiv', 3, 15),
(2, 'qH-3MOOYQBw', 'Yoga Stretch Relax Entspannung | Intensiv Dehnen und den Kopf frei bekommen', 3, 4),
(3, 'hQ8vRYGRiec', 'Yoga Entspannung Anti Stress Programm | Fï¿½r mehr Ruhe, Gelassenheit und Zufriedenheit', 3, 4),
(4, 'O4sv7iTUzoY', 'Fatburning Yoga Flow | Intensives Ganzkï¿½rperworkout  | Fett verbrennen  & Stoffwechsel anregen', 3, 5),
(5, 'Nwg5j55gicI', 'Yoga Schulter Nacken Entspannen | Verspannungen lï¿½sen | ï¿½bungen fï¿½r den Alltag', 3, 11),
(6, 'eHGEmo2NGkc', 'Yoga Anfï¿½nger | Entspannung & Selbstliebe | Yin Yoga inspiriert', 3, 4),
(7, 'nCOgtI7dCUk', 'Summerbody Vinyasa Yoga Flow | Ganzkï¿½rper Workout fï¿½r Bauch Beine Po Rï¿½cken', 3, 5),
(8, 'yBstij2DS2k', 'Yoga Vinyasa Flow | Fit Im Frï¿½hling | Happy Herzï¿½ffner', 3, 6),
(9, 'LCFrL_rJ510', 'Yoga Hï¿½ftï¿½ffner Intensive Dehnung | Deep Stretch Routine', 3, 7),
(10, 'rgogXx8PGjk', 'Yoga fï¿½r Anfï¿½nger | 30 Minuten Vinyasa Home Workout', 3, 8),
(11, 'JoCtY5ZIl5E', 'Yoga Anfï¿½nger | Sanfte Morgen Routine | Ruhig, Achtsam & Meditativ', 3, 10),
(12, 'bno1z2-Hg-4', 'Power Vinyasa Yoga fï¿½r Kraft & Willensstï¿½rke |  25 Minuten Home Workout', 3, 14),
(13, 'KZ_CLzIDHYQ', 'Yoga fï¿½r straffe Beine | 25 Minuten Vinyasa Yoga Workout', 3, 15),
(14, 'UErN1VLCXC0', 'YOGA fu?r Anfa?nger | 20 Minuten Home Workout', 3, 8),
(15, 'Qq-4EM5cqQY', 'Yoga fï¿½r Kraft, Beweglichkeit & innere Ruhe | Beine stï¿½rken und dehnen | Vinyasa Flow', 3, 4),
(16, 'zMQ1EIIz6Rc', 'Yoga Bauch Workout | Core stï¿½rken | Nacken entspannen | Intensiv & Effektiv', 2, 11),
(17, 'p3Q_L90be2s', 'Yoga Rï¿½cken Anfï¿½nger Programm | ï¿½bungen gegen Verspannungen und Rï¿½ckenschmerzen', 2, 3),
(18, '8dS4DUkLhBU', 'Yoga Ganzkï¿½rper Flow | Verspannungen im oberen Rï¿½cken lï¿½sen | Entspannt in den Feierabend', 2, 5),
(19, 'AgkawTO_bBA', 'Yoga Twist & Detox Flow | Neue Kraft & Energie tanken in 15 Minuten', 2, 6),
(20, 'd_Ibq08-ucg', 'Sonnengruss Yoga Morgen Routine | Mit 11 Minuten in den Tag starten | Einfach Mitmachen!', 2, 10),
(21, 'KlYaZcLu_l8', 'Aufwï¿½rmen vor dem Yoga | Perfekt nach dem Aufstehen | Warm Up Morgen Routine', 2, 10),
(22, 'Nm6RlQiwvgc', 'Yoga Morgen-Routine | Wach & Energiegeladen | Der perfekte Start in den Tag', 2, 10),
(23, 'JXYXEYuGCYI', 'Yoga  Power Vinyasa Flow | Dynamisch & Kraftvoll | 15 Minuten Ganzkï¿½rper Programm', 2, 5),
(24, '3jFTXfIapLw', 'Yoga Laufen Dehnen Stretchen | Cooldown nach dem Joggen', 2, 13),
(25, 'B3G-NSuuxws', 'Yoga Arme Schultern Straffen - Anfï¿½nger + Fortgeschrittene - 20 Min Home Workout', 2, 2),
(26, '_i32hVOPlTA', 'Yoga Abend Bett Routine | Besser Schlafen + Atemï¿½bung', 2, 9),
(27, 'EiCgTI0uOPc', 'Yoga Core Balance | Vinyasa Flow fï¿½r mehr Gleichgewicht | Mittelstufe', 2, 6),
(28, '9gjYZ-2WGOk', 'Yoga im Bï¿½ro, Office, Arbeitsplatz | Sitting Lunch Break Yoga', 2, 12),
(29, 'fABvf_pqXhc', 'Mit Yoga Entspannt Einschlafen | Sanfte Abendroutine im Bett zum Loslassen & Entspannen', 1, 9),
(30, 'fWRa-6T0bv0', 'Yoga Anfï¿½nger Morgenroutine im Bett | Wach und Entspannt in den Tag | Nur 5 Minuten', 1, 10),
(31, 'pQszu5WBNCc', 'Yoga fï¿½r Energie und Konzentration | Knackiger 8 Minuten Vinyasa Flow', 1, 16),
(32, '7Av1kR5TnIA', 'Yoga Flow Anfï¿½nger und Mittelstufe | 10 Minuten Entspannung, Dehnung & Kraft', 1, 4),
(33, '2SyGLbXtS68', 'Yoga Sonnengruss Morgenroutine | 5 Minuten fï¿½r jeden Tag', 1, 10),
(34, 'tV3tCLZtNeg', 'Yoga Sonnengruï¿½ B Anfï¿½nger Routine | 10 Minuten Morgenroutine | Energie fï¿½r den Tag', 1, 10),
(35, '6Ct6N1vEWhQ', 'Yoga Wechselatmung fï¿½r Anfï¿½nger - fï¿½r Konzentration, Innere Balance & gegen Stress, Kopfschmerzen', 1, 16),
(36, 'ajPbiwOjrss', 'Yoga Sonnengruss Anfa?nger Routine | 6 Runden Surya Namaskar A Morgenroutine', 1, 10),
(37, 'XZ-0BRG1OiM', 'Handgelenke Stï¿½rken Dehnen Schï¿½tzen | Yoga Mobility | Schmerzen vorbeugen', 1, 13),
(38, 'w4FCGciGIms', 'Yoga Flow fï¿½r Energie & Power | Wach und fit in 5 Minuten | Dein Yogasnack fï¿½r zwischendurch!', 1, 14),
(39, 's6Jazu4oXls', 'Yoga Morgenroutine fï¿½r Anfï¿½nger | Den ganzen Kï¿½rper Dehnen & Mobilisieren | 10 Minuten', 1, 10),
(40, '5lqHPAXwk4Q', 'Power Yoga Workout fï¿½r straffe Arme und eine starke Kï¿½rpermitte | 10 Minuten zum Schwitzen', 1, 14),
(41, '6CxOSicx_Wc', 'Yoga gegen Verspannungen im Schulter Nacken Bereich | Effektive ï¿½bungen', 1, 2),
(42, 'va4JgmVNTPQ', 'Plank Challenge Bauch Workout - Starker Straffer Bauch in nur 4 Minuten #plank4change', 1, 1),
(43, 'zC1QEnFICTM', 'Po Workout fï¿½r Zuhause | 5 Minuten Kurz & Intensiv  + Stretching', 1, 13),
(44, 'Z2DrCQOalBs', 'Workout fï¿½r straffe Arme | 5 Minuten Kurz & Intensiv + Stretching | Zuhause trainieren', 1, 19),
(45, 'vujKKqYR5-I', 'Rï¿½cken Home Workout ohne Gerï¿½te | 5 Minuten kurz & knackig zum Mitmachen', 1, 3),
(46, 'e_Z2tX5tkeI', 'Bauch Home Workout | Kurz & Intensiv | 5 Minuten Core Training + Stretching', 1, 1),
(47, 'qWdw8FvJlaI', 'Handstand Lernen | Anfa?nger Tutorial | Warm Up ï¿½bungen zum Aufwï¿½rmen', 1, 18),
(48, 'mBUmpMr1F4w', 'Handstand Lernen | Anfï¿½nger Tutorial | Die besten Vorï¿½bungen um frei zu Stehen', 1, 18),
(49, '1vcr_hb3zds', 'Partner Ganzkï¿½rper Workout | Gemeinsam Trainieren | Intensiv & Effektiv', 1, 5),
(50, 'jUa00O7whXg', 'Anfï¿½nger HIIT Workout | Fatburner Fitness fï¿½r Zuhause | Mit Warm Up und Cool Down', 1, 14),
(51, 'mJjxKfl6qr0', 'Bauch HIIT Workout fï¿½r Zuhause | Fett verbrennen & Core stï¿½rken in 15 Minuten', 2, 1),
(52, 'R9LaiJjOMjA', 'Fitness Morgenroutine fï¿½r Anfï¿½nger | 10 Minuten zum Mitmachen | Perfekter Start in den Tag', 2, 10),
(53, '-HyO3hDaKbI', 'Beine Po HIIT Workout | Fett verbrennen | 15 Min. Intensiv & Effektiv', 2, 15),
(54, 'JmHcsX0goAw', 'Ganzkï¿½rper HIIT Workout | Effektiv Fett verbrennen | 15 Minuten ohne Gerï¿½te', 2, 5),
(55, 'Bm1vdZHbZnQ', 'Rï¿½cken Yoga Anfï¿½nger | Entspannung fï¿½r den unteren Rï¿½cken | Gegen Rï¿½ckenschmerzen', 2, 3),
(56, 'Tj3eHle5xTM', 'Yoga Bauch Workout Intensiv | 15 Minuten Core & Abs fï¿½r einen straffen Bauch', 2, 14),
(57, '1vVwY60_pyk', 'Yoga & Meditation Morgenroutine | Selbstbewusst, Positiv & Dankbar in deinen Tag starten!', 2, 10),
(58, 'kRxclhGDZtQ', 'Yoga fï¿½r Energie und Lebenskraft | Kï¿½rper stï¿½rken  | In 15 Minuten wach und voller Power!', 2, 14),
(59, 'kApPj-mNcO4', 'Yoga Beweglichkeit, Dehnung, Entspannung | Hï¿½ften ï¿½ffnen & Rï¿½cken mobilisieren | Zur Ruhe kommen', 2, 13),
(60, '2vQHMM5Sc2w', 'Yoga fï¿½r Beweglichkeit Entspannung | Gesunder Rï¿½cken | Den Ganzen Kï¿½rper Dehnen', 5, 3),
(61, 'QH8KrTKvv2E', 'Yoga Morgenroutine Vinyasa Flow |  Fit & Wach den Tag beginnen | Mittelstufe', 2, 10),
(62, '4CBKYS9ywBQ', 'Yoga Flow fï¿½r Energie, Kraft & Beweglichkeit | wach und klar | Joshua Tree', 3, 18),
(63, '5L0WUcbwMtc', 'Yoga fï¿½r einen gesunden Rï¿½cken und geschmeidige Hï¿½ften | Verspannungen lï¿½sen & Energie tanken', 3, 3),
(64, 'AtQIr3QX4pY', 'Yoga Abendroutine fï¿½r Anfï¿½nger | Entspannung & Ruhe fï¿½r die Nacht | Besser einschlafen', 2, 9),
(65, '3YpRJeAbo7E', 'Yoga Flow fï¿½r Energie, Konzentration & Selbstbewusstsein | schnell und effektiv | 10 Minuten', 2, 3),
(66, 'dXFoauG-sbc', 'Yoga Anfa?nger Entspannung und Dehnung | Verspannungen im unteren Rï¿½cken lï¿½sen & Hï¿½ften ï¿½ffnen', 4, 4),
(67, '0Csrx8r6FAs', 'Yoga Ganzkï¿½rper Flow | 45 Minuten Bauch Beine Po Workout + Stretch', 5, 5),
(68, 'mn-KTgQnYg0', 'Gefï¿½hrte Meditation fï¿½r Entspannung & Zufriedenheit | Selbstwert und Selbstliebe stï¿½rken', 2, 4),
(69, '6CgoQCbnYMc', 'Power Yoga fï¿½r Kraft und Beweglichkeit | Arme, Schultern & Bauch | Mittelstufe', 3, 2),
(70, 'TAbH1yusgRo', 'Yoga Ganzkï¿½rper Flow | Bauch Beine Po & Rï¿½cken | 30 Min. Workout', 3, 5),
(71, 'pDcwnOWgO4A', 'Yoga Vinyasa Flow | Ashtanga inspiriert | dynamisch & kraftvoll | 15 Minuten Mittelstufe', 2, 6),
(72, 'FUHzkAbrOlg', 'Yoga Deep Stretch Routine | Den ganzen Kï¿½rper dehnen | Entspannung & Beweglichkeit', 4, 13),
(73, 'oj-hxr2bZkI', 'Yoga Flow 60 Minuten | Ganzkï¿½rper Programm | Selbstbewusstsein und innere Stï¿½rke', 6, 5),
(74, 't1Yskz4LBBY', 'Yoga Beweglichkeit, Kraft, Entspannung | Hï¿½ftbeuger dehnen gegen Rï¿½ckenschmerzen | Stress lass nach!', 2, 7),
(75, 'LOi9B2Syej8', 'Yoga Ganzkörper Flow | Stark, Konzentriert & Selbstbewusst | 25 Minuten Mittelstufe', 3, 0),
(76, '9mq66ZKmoyc', 'Yoga Flow fï¿½r Balance, Kraft & Beweglichkeit | 15 Min. Vinyasa Flow | Mittelstufe', 2, 6);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`KID`);

--
-- Indizes für die Tabelle `rel_v_k`
--
ALTER TABLE `rel_v_k`
  ADD PRIMARY KEY (`VKID`);

--
-- Indizes für die Tabelle `time`
--
ALTER TABLE `time`
  ADD PRIMARY KEY (`TID`);

--
-- Indizes für die Tabelle `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`VID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `KID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT für Tabelle `rel_v_k`
--
ALTER TABLE `rel_v_k`
  MODIFY `VKID` int(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `time`
--
ALTER TABLE `time`
  MODIFY `TID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT für Tabelle `video`
--
ALTER TABLE `video`
  MODIFY `VID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
