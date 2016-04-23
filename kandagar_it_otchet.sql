-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 23 2016 г., 20:40
-- Версия сервера: 5.5.48
-- Версия PHP: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `kandagar_it_otchet`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cash`
--

CREATE TABLE IF NOT EXISTS `cash` (
  `cash_id` int(11) NOT NULL,
  `cash_country` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cash`
--

INSERT INTO `cash` (`cash_id`, `cash_country`) VALUES
(1, 'руб.'),
(2, '$'),
(3, 'бел.руб.'),
(4, 'грн.'),
(5, 'евро');

-- --------------------------------------------------------

--
-- Структура таблицы `main`
--

CREATE TABLE IF NOT EXISTS `main` (
  `main_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `office_id` int(11) NOT NULL,
  `date_start` date DEFAULT NULL,
  `date_recieved` date DEFAULT NULL,
  `date_period` date DEFAULT NULL,
  `month_period_id` int(11) NOT NULL,
  `stat_id` int(11) NOT NULL DEFAULT '0',
  `cash_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `month_period`
--

CREATE TABLE IF NOT EXISTS `month_period` (
  `month_period_id` int(11) NOT NULL,
  `month_count_name` varchar(75) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `month_period`
--

INSERT INTO `month_period` (`month_period_id`, `month_count_name`) VALUES
(1, 'Месяц'),
(2, '2 Месяца'),
(3, '3 Месяца'),
(4, '4 Месяца'),
(5, '5 Месяцев'),
(6, '6 Месяцев'),
(7, '7 Месяцев'),
(8, '8 Месяцев'),
(9, '9 Месяцев'),
(10, '10 Месяцев'),
(11, '11 Месяцев'),
(12, 'Год');

-- --------------------------------------------------------

--
-- Структура таблицы `office`
--

CREATE TABLE IF NOT EXISTS `office` (
  `office_id` int(11) NOT NULL,
  `office_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `office`
--

INSERT INTO `office` (`office_id`, `office_name`) VALUES
(1, 'ТК Кандагар-Крым'),
(2, 'ТК Канадгар'),
(3, 'ЧП Кандагар-Тревел'),
(4, 'ТК Кандагар-НОРД'),
(5, 'ТК Кандагар-СОЮЗТУР'),
(6, 'ТК Кандагар-Ростов'),
(7, 'Все офисы');

-- --------------------------------------------------------

--
-- Структура таблицы `service`
--

CREATE TABLE IF NOT EXISTS `service` (
  `service_id` int(11) NOT NULL,
  `service_name` varchar(60) NOT NULL,
  `service_about` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='Таблица для хранения организаций предоставляющие услуги.';

--
-- Дамп данных таблицы `service`
--

INSERT INTO `service` (`service_id`, `service_name`, `service_about`) VALUES
(1, 'НПП Мист', 'Интернет'),
(2, 'CloudLite', 'Аренда Вычислительных Мощностей'),
(3, 'Транзитек', 'Телефон'),
(4, 'MTT YouMagicPro', 'IP Телефония'),
(5, 'Караван телеком', 'Хостинг Сервера'),
(6, 'MTT Buissnes', 'IP Телефония'),
(7, 'Ньюком Порт', 'Телефон');

-- --------------------------------------------------------

--
-- Структура таблицы `statistic`
--

CREATE TABLE IF NOT EXISTS `statistic` (
  `stat_id` int(11) NOT NULL,
  `stat_service_id` int(11) NOT NULL,
  `stat_month` date NOT NULL,
  `stat_summ` int(11) NOT NULL,
  `stat_payment` varchar(255) NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `status`
--

INSERT INTO `status` (`status_id`, `status_name`) VALUES
(1, 'Оплачено'),
(2, 'Получено'),
(3, 'В процессе'),
(4, 'В архиве'),
(5, 'Просроченно');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cash`
--
ALTER TABLE `cash`
  ADD PRIMARY KEY (`cash_id`);

--
-- Индексы таблицы `main`
--
ALTER TABLE `main`
  ADD PRIMARY KEY (`main_id`,`service_id`,`office_id`,`month_period_id`,`stat_id`,`cash_id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `office_id` (`office_id`),
  ADD KEY `month_period_id` (`month_period_id`),
  ADD KEY `main_ibfk_5` (`cash_id`),
  ADD KEY `main_ibfk_6` (`stat_id`);

--
-- Индексы таблицы `month_period`
--
ALTER TABLE `month_period`
  ADD PRIMARY KEY (`month_period_id`);

--
-- Индексы таблицы `office`
--
ALTER TABLE `office`
  ADD PRIMARY KEY (`office_id`);

--
-- Индексы таблицы `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`service_id`);

--
-- Индексы таблицы `statistic`
--
ALTER TABLE `statistic`
  ADD PRIMARY KEY (`stat_id`,`stat_service_id`,`status_id`),
  ADD KEY `stat_service_id` (`stat_service_id`),
  ADD KEY `statistic_ibfk_2` (`status_id`);

--
-- Индексы таблицы `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cash`
--
ALTER TABLE `cash`
  MODIFY `cash_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `main`
--
ALTER TABLE `main`
  MODIFY `main_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT для таблицы `month_period`
--
ALTER TABLE `month_period`
  MODIFY `month_period_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT для таблицы `office`
--
ALTER TABLE `office`
  MODIFY `office_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `service`
--
ALTER TABLE `service`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `statistic`
--
ALTER TABLE `statistic`
  MODIFY `stat_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `main`
--
ALTER TABLE `main`
  ADD CONSTRAINT `main_ibfk_6` FOREIGN KEY (`stat_id`) REFERENCES `statistic` (`stat_service_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `main_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `service` (`service_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `main_ibfk_2` FOREIGN KEY (`office_id`) REFERENCES `office` (`office_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `main_ibfk_3` FOREIGN KEY (`month_period_id`) REFERENCES `month_period` (`month_period_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `main_ibfk_5` FOREIGN KEY (`cash_id`) REFERENCES `cash` (`cash_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `statistic`
--
ALTER TABLE `statistic`
  ADD CONSTRAINT `statistic_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`),
  ADD CONSTRAINT `statistic_ibfk_1` FOREIGN KEY (`stat_service_id`) REFERENCES `service` (`service_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
