-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 02 jul 2019 om 16:29
-- Serverversie: 10.1.37-MariaDB
-- PHP-versie: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stenden_helpdesk`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `contact`
--

CREATE TABLE `contact` (
  `Contact_id` int(4) NOT NULL,
  `Company_id` int(4) DEFAULT NULL,
  `First_name` varchar(25) NOT NULL,
  `Last_name` varchar(25) NOT NULL,
  `Phone` int(15) NOT NULL,
  `Email` varchar(62) NOT NULL,
  `Username` varchar(40) DEFAULT NULL,
  `password` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `contact`
--

INSERT INTO `contact` (`Contact_id`, `Company_id`, `First_name`, `Last_name`, `Phone`, `Email`, `Username`, `password`) VALUES
(5, 10, 'QW', 'E', 1234124123, 'QWE@QWE.com', 'QWE', '$2y$10$TRg6zXc8zaTwZ44KxwQrvOBj8grf9udzmIZfjJcq0EXzm0UnZ4lEO'),
(6, 11, 'test', 'test', 2147483647, 'test@test.test', 'Test', '$2y$10$8fdw5MOIrcAoKSR1qg7jGecn5WUqGNS0X2ZrqPmMnIb5/Xa30kxX2'),
(7, 11, 'Thomas', 'Koops', 2147483647, 'thomas_koops@hotmail.com', 'Thomas', '$2y$10$AYBLu4p4TCuU92Q3e2CDeuajPvpGKMdq8PuVzhQahPDjXUUk7KzVG');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `customer`
--

CREATE TABLE `customer` (
  `Company_id` int(4) NOT NULL,
  `Company_name` varchar(40) NOT NULL,
  `Perm_level` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `customer`
--

INSERT INTO `customer` (`Company_id`, `Company_name`, `Perm_level`) VALUES
(0, 'Unregistered', NULL),
(10, 'QWE entertainment', 0),
(11, 'Test', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `incident`
--

CREATE TABLE `incident` (
  `Incident_id` int(4) NOT NULL,
  `Status_id` int(4) NOT NULL DEFAULT '0',
  `Solution_id` int(4) DEFAULT NULL,
  `Contact_id` int(4) NOT NULL,
  `Operator_id` int(4) DEFAULT NULL,
  `Date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Description` varchar(254) NOT NULL,
  `type_id` int(4) DEFAULT NULL,
  `Solution` varchar(254) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `incident`
--

INSERT INTO `incident` (`Incident_id`, `Status_id`, `Solution_id`, `Contact_id`, `Operator_id`, `Date_time`, `Description`, `type_id`, `Solution`) VALUES
(7, 3, NULL, 7, 1, '2019-06-30 23:01:16', 'adsdasd', 1, 'Proposed solution'),
(8, 3, NULL, 7, 1, '2019-07-01 23:56:38', 'fsafsafasf', 1, 'Proposed solution'),
(9, 3, NULL, 7, 1, '2019-07-01 23:56:41', 'fsafsafsa', 1, 'Proposed solution');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `incident_status`
--

CREATE TABLE `incident_status` (
  `Status_id` int(4) NOT NULL,
  `Description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `incident_status`
--

INSERT INTO `incident_status` (`Status_id`, `Description`) VALUES
(0, 'Pending'),
(1, 'Open and unsolved'),
(2, 'Closed and unsolved'),
(3, 'Open and solved'),
(4, 'Closed and solved');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `licence`
--

CREATE TABLE `licence` (
  `Licence_code` varchar(10) NOT NULL,
  `Company_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `licence`
--

INSERT INTO `licence` (`Licence_code`, `Company_id`) VALUES
('cTzcqw7kPi', 0),
('dkFxij4Dib', 0),
('eSmXaVFA0H', 0),
('hYVocLt8MP', 0),
('wCEBMcyDS2', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `operator`
--

CREATE TABLE `operator` (
  `Operator_id` int(4) NOT NULL,
  `First_name` varchar(25) NOT NULL,
  `Last_name` varchar(25) NOT NULL,
  `Email` varchar(62) NOT NULL,
  `Perm_level` tinyint(1) NOT NULL,
  `Picture` blob NOT NULL,
  `Password` varchar(120) DEFAULT NULL,
  `Username` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `operator`
--

INSERT INTO `operator` (`Operator_id`, `First_name`, `Last_name`, `Email`, `Perm_level`, `Picture`, `Password`, `Username`) VALUES
(1, 'Victor', 'Peters', 'Victor.Peters@stenden.com', 2, '', '$2y$10$AYBLu4p4TCuU92Q3e2CDeuajPvpGKMdq8PuVzhQahPDjXUUk7KzVG', 'Victor');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `solution`
--

CREATE TABLE `solution` (
  `Solution_id` int(4) NOT NULL,
  `Description` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `type`
--

CREATE TABLE `type` (
  `type_id` int(4) NOT NULL,
  `type_description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `type`
--

INSERT INTO `type` (`type_id`, `type_description`) VALUES
(1, 'Technical Problem'),
(2, 'Functional Problem'),
(3, 'Failure'),
(4, 'Question'),
(5, 'Wish'),
(6, 'Other');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`Contact_id`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD KEY `Company_id` (`Company_id`);

--
-- Indexen voor tabel `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Company_id`),
  ADD UNIQUE KEY `Company_name` (`Company_name`);

--
-- Indexen voor tabel `incident`
--
ALTER TABLE `incident`
  ADD PRIMARY KEY (`Incident_id`),
  ADD KEY `FK_status_id` (`Status_id`),
  ADD KEY `FK_solution_id` (`Solution_id`),
  ADD KEY `fk_contact_id` (`Contact_id`),
  ADD KEY `fk_operator_id` (`Operator_id`),
  ADD KEY `fk_type_id` (`type_id`);

--
-- Indexen voor tabel `incident_status`
--
ALTER TABLE `incident_status`
  ADD PRIMARY KEY (`Status_id`);

--
-- Indexen voor tabel `licence`
--
ALTER TABLE `licence`
  ADD PRIMARY KEY (`Licence_code`),
  ADD KEY `fk_company_id` (`Company_id`);

--
-- Indexen voor tabel `operator`
--
ALTER TABLE `operator`
  ADD PRIMARY KEY (`Operator_id`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexen voor tabel `solution`
--
ALTER TABLE `solution`
  ADD PRIMARY KEY (`Solution_id`);

--
-- Indexen voor tabel `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`type_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `contact`
--
ALTER TABLE `contact`
  MODIFY `Contact_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT voor een tabel `customer`
--
ALTER TABLE `customer`
  MODIFY `Company_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT voor een tabel `incident`
--
ALTER TABLE `incident`
  MODIFY `Incident_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT voor een tabel `incident_status`
--
ALTER TABLE `incident_status`
  MODIFY `Status_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `operator`
--
ALTER TABLE `operator`
  MODIFY `Operator_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `solution`
--
ALTER TABLE `solution`
  MODIFY `Solution_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `Company_id` FOREIGN KEY (`Company_id`) REFERENCES `customer` (`Company_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `incident`
--
ALTER TABLE `incident`
  ADD CONSTRAINT `FK_solution_id` FOREIGN KEY (`Solution_id`) REFERENCES `solution` (`Solution_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_status_id` FOREIGN KEY (`Status_id`) REFERENCES `incident_status` (`Status_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_contact_id` FOREIGN KEY (`Contact_id`) REFERENCES `contact` (`Contact_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_operator_id` FOREIGN KEY (`Operator_id`) REFERENCES `operator` (`Operator_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_type_id` FOREIGN KEY (`type_id`) REFERENCES `type` (`type_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `licence`
--
ALTER TABLE `licence`
  ADD CONSTRAINT `fk_company_id` FOREIGN KEY (`Company_id`) REFERENCES `customer` (`Company_id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
