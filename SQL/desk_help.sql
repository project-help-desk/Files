-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июн 15 2019 г., 17:18
-- Версия сервера: 10.1.37-MariaDB
-- Версия PHP: 7.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `desk_help`
--

-- --------------------------------------------------------

--
-- Структура таблицы `contactperson`
--

CREATE TABLE `contactperson` (
  `contact_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `first_name` int(11) NOT NULL,
  `last_name` int(11) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(40) NOT NULL,
  `role` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `company_name` varchar(40) NOT NULL,
  `license_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `incident`
--

CREATE TABLE `incident` (
  `incident_id` int(4) NOT NULL,
  `status_id` int(4) NOT NULL,
  `solution_id` int(4) NOT NULL,
  `contact_id` int(4) NOT NULL,
  `operator_id` int(4) NOT NULL,
  `date_time` timestamp(4) NOT NULL DEFAULT CURRENT_TIMESTAMP(4) ON UPDATE CURRENT_TIMESTAMP(4),
  `description` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `incidentstatus`
--

CREATE TABLE `incidentstatus` (
  `status_id` int(2) NOT NULL,
  `description` varchar(260) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `license`
--

CREATE TABLE `license` (
  `license_id` int(4) NOT NULL,
  `valid_until` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `operator`
--

CREATE TABLE `operator` (
  `operatot_id` int(2) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `perm_level` int(1) NOT NULL,
  `picture` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `solution`
--

CREATE TABLE `solution` (
  `solution_id` int(11) NOT NULL,
  `desc_solution` varchar(254) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `contactperson`
--
ALTER TABLE `contactperson`
  ADD PRIMARY KEY (`contact_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Индексы таблицы `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `license_id` (`license_id`);

--
-- Индексы таблицы `incident`
--
ALTER TABLE `incident`
  ADD PRIMARY KEY (`incident_id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `solution_id` (`solution_id`),
  ADD KEY `contact_id` (`contact_id`),
  ADD KEY `operator_id` (`operator_id`);

--
-- Индексы таблицы `incidentstatus`
--
ALTER TABLE `incidentstatus`
  ADD PRIMARY KEY (`status_id`);

--
-- Индексы таблицы `license`
--
ALTER TABLE `license`
  ADD PRIMARY KEY (`license_id`);

--
-- Индексы таблицы `operator`
--
ALTER TABLE `operator`
  ADD PRIMARY KEY (`operatot_id`);

--
-- Индексы таблицы `solution`
--
ALTER TABLE `solution`
  ADD PRIMARY KEY (`solution_id`);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `contactperson`
--
ALTER TABLE `contactperson`
  ADD CONSTRAINT `contactperson_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

--
-- Ограничения внешнего ключа таблицы `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`license_id`) REFERENCES `license` (`license_id`);

--
-- Ограничения внешнего ключа таблицы `incident`
--
ALTER TABLE `incident`
  ADD CONSTRAINT `incident_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `incidentstatus` (`status_id`),
  ADD CONSTRAINT `incident_ibfk_2` FOREIGN KEY (`solution_id`) REFERENCES `solution` (`solution_id`),
  ADD CONSTRAINT `incident_ibfk_3` FOREIGN KEY (`contact_id`) REFERENCES `contactperson` (`contact_id`),
  ADD CONSTRAINT `incident_ibfk_4` FOREIGN KEY (`operator_id`) REFERENCES `operator` (`operatot_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
