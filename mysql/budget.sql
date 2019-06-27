-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июн 27 2019 г., 17:27
-- Версия сервера: 10.1.38-MariaDB
-- Версия PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `budget`
--

-- --------------------------------------------------------

--
-- Структура таблицы `current_e`
--

CREATE TABLE `current_e` (
  `id_costs` int(3) NOT NULL COMMENT 'Код текущего расхода',
  `id_family` int(3) NOT NULL COMMENT 'Код члена семьи',
  `date_c` date NOT NULL COMMENT 'Дата расхода',
  `id_expenditure` int(3) NOT NULL COMMENT 'Код статьи расхода',
  `sum_c` decimal(12,2) NOT NULL COMMENT 'Сумма расхода'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `current_e`
--

INSERT INTO `current_e` (`id_costs`, `id_family`, `date_c`, `id_expenditure`, `sum_c`) VALUES
(1, 1, '2019-06-02', 1, '1500.00'),
(2, 1, '2019-06-30', 1, '1500.00'),
(3, 2, '2019-07-23', 5, '3500.00');

-- --------------------------------------------------------

--
-- Структура таблицы `current_i`
--

CREATE TABLE `current_i` (
  `id_income` int(3) NOT NULL COMMENT 'Код текущего дохода',
  `id_family` int(3) NOT NULL COMMENT 'Код члена семьи',
  `date_i` date NOT NULL COMMENT 'Дата дохода',
  `id_sources` int(3) NOT NULL COMMENT 'Код источника дохода',
  `sum_i` decimal(12,2) NOT NULL COMMENT 'Сумма дохода'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `current_i`
--

INSERT INTO `current_i` (`id_income`, `id_family`, `date_i`, `id_sources`, `sum_i`) VALUES
(1, 1, '2019-06-04', 1, '325000.00'),
(4, 1, '2019-06-07', 2, '1000.00'),
(5, 2, '2019-06-25', 2, '500.00');

-- --------------------------------------------------------

--
-- Структура таблицы `expenditure`
--

CREATE TABLE `expenditure` (
  `id_expenditure` int(3) NOT NULL COMMENT 'Код статьи расходов',
  `e_name` varchar(25) NOT NULL COMMENT 'Название статьи расходов'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `expenditure`
--

INSERT INTO `expenditure` (`id_expenditure`, `e_name`) VALUES
(1, 'Маникюр'),
(5, 'Собака');

-- --------------------------------------------------------

--
-- Структура таблицы `family`
--

CREATE TABLE `family` (
  `id_family` int(3) NOT NULL COMMENT 'Код ',
  `full_name` varchar(100) NOT NULL COMMENT 'ФИО',
  `date_b` date NOT NULL COMMENT 'Дата рождения'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `family`
--

INSERT INTO `family` (`id_family`, `full_name`, `date_b`) VALUES
(1, 'Гордеева Софья Дмитриевна', '1998-07-01'),
(2, 'Гордеева Ольга Юрьевна', '1967-08-14');

-- --------------------------------------------------------

--
-- Структура таблицы `sources_i`
--

CREATE TABLE `sources_i` (
  `id_sources` int(3) NOT NULL COMMENT 'Код источника дохода',
  `s_name` varchar(25) NOT NULL COMMENT 'Название источника дохода'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sources_i`
--

INSERT INTO `sources_i` (`id_sources`, `s_name`) VALUES
(1, 'Зарплата'),
(2, 'Лотерея'),
(4, 'Стипендия'),
(5, 'Премия');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `current_e`
--
ALTER TABLE `current_e`
  ADD PRIMARY KEY (`id_costs`),
  ADD KEY `id_family` (`id_family`),
  ADD KEY `id_expenditure` (`id_expenditure`);

--
-- Индексы таблицы `current_i`
--
ALTER TABLE `current_i`
  ADD PRIMARY KEY (`id_income`),
  ADD KEY `id_family` (`id_family`),
  ADD KEY `id_sources` (`id_sources`);

--
-- Индексы таблицы `expenditure`
--
ALTER TABLE `expenditure`
  ADD PRIMARY KEY (`id_expenditure`);

--
-- Индексы таблицы `family`
--
ALTER TABLE `family`
  ADD PRIMARY KEY (`id_family`);

--
-- Индексы таблицы `sources_i`
--
ALTER TABLE `sources_i`
  ADD PRIMARY KEY (`id_sources`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `current_e`
--
ALTER TABLE `current_e`
  MODIFY `id_costs` int(3) NOT NULL AUTO_INCREMENT COMMENT 'Код текущего расхода', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `current_i`
--
ALTER TABLE `current_i`
  MODIFY `id_income` int(3) NOT NULL AUTO_INCREMENT COMMENT 'Код текущего дохода', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `expenditure`
--
ALTER TABLE `expenditure`
  MODIFY `id_expenditure` int(3) NOT NULL AUTO_INCREMENT COMMENT 'Код статьи расходов', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `family`
--
ALTER TABLE `family`
  MODIFY `id_family` int(3) NOT NULL AUTO_INCREMENT COMMENT 'Код ', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `sources_i`
--
ALTER TABLE `sources_i`
  MODIFY `id_sources` int(3) NOT NULL AUTO_INCREMENT COMMENT 'Код источника дохода', AUTO_INCREMENT=6;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `current_e`
--
ALTER TABLE `current_e`
  ADD CONSTRAINT `current_e_ibfk_1` FOREIGN KEY (`id_expenditure`) REFERENCES `expenditure` (`id_expenditure`),
  ADD CONSTRAINT `current_e_ibfk_2` FOREIGN KEY (`id_family`) REFERENCES `family` (`id_family`);

--
-- Ограничения внешнего ключа таблицы `current_i`
--
ALTER TABLE `current_i`
  ADD CONSTRAINT `current_i_ibfk_1` FOREIGN KEY (`id_sources`) REFERENCES `sources_i` (`id_sources`),
  ADD CONSTRAINT `current_i_ibfk_2` FOREIGN KEY (`id_family`) REFERENCES `family` (`id_family`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
