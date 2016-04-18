-- phpMyAdmin SQL Dump
-- version 4.0.10.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 18 2016 г., 08:41
-- Версия сервера: 5.5.45-log
-- Версия PHP: 5.4.44

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `kandagar_it_otchet`
--

-- --------------------------------------------------------

--
-- Структура таблицы `main`
--

CREATE TABLE IF NOT EXISTS `main` (
  `main_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) NOT NULL,
  `office_id` int(11) NOT NULL,
  `date_start` date DEFAULT NULL,
  `date_recieved` date DEFAULT NULL,
  `date_period` date DEFAULT NULL,
  `month_period_id` int(11) NOT NULL,
  `pay` int(11) DEFAULT NULL,
  `receive` int(11) DEFAULT NULL,
  `archive` int(11) DEFAULT NULL,
  `sum` int(11) DEFAULT NULL,
  PRIMARY KEY (`main_id`,`service_id`,`office_id`,`month_period_id`),
  KEY `service_id` (`service_id`),
  KEY `office_id` (`office_id`),
  KEY `month_period_id` (`month_period_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Дамп данных таблицы `main`
--

INSERT INTO `main` (`main_id`, `service_id`, `office_id`, `date_start`, `date_recieved`, `date_period`, `month_period_id`, `pay`, `receive`, `archive`, `sum`) VALUES
(1, 1, 1, '2016-04-17', '2016-05-17', '2016-10-17', 6, 0, 0, 0, 6890),
(10, 18, 5, '2016-04-05', '2016-04-05', '2016-06-30', 2, 0, 0, 0, 213),
(11, 19, 5, '2016-04-05', '2016-04-05', '2016-06-30', 2, 0, 0, 0, 213),
(12, 20, 5, '2016-04-05', '2016-04-05', '2016-06-30', 2, 0, 0, 0, 213),
(13, 21, 1, '2016-05-05', '2016-05-05', '2016-11-30', 7, 0, 0, 0, 2143),
(14, 22, 1, '2016-05-05', '2016-05-05', '2016-11-30', 7, 0, 0, 0, 2143),
(15, 23, 1, '2016-04-18', '2016-04-18', '2016-10-30', 6, 0, 0, 0, 213),
(16, 24, 1, '2016-05-06', '2016-05-06', '0000-00-00', 10, 0, 0, 0, 4326),
(17, 25, 1, '2016-04-18', '2016-04-18', '2017-01-05', 7, 0, 0, 0, 213);

-- --------------------------------------------------------

--
-- Структура таблицы `month_period`
--

CREATE TABLE IF NOT EXISTS `month_period` (
  `month_period_id` int(11) NOT NULL AUTO_INCREMENT,
  `month_count_name` varchar(75) DEFAULT NULL,
  PRIMARY KEY (`month_period_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

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
  `office_id` int(11) NOT NULL AUTO_INCREMENT,
  `office_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`office_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

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
  `service_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_name` varchar(60) NOT NULL,
  `service_about` varchar(255) NOT NULL,
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Таблица для хранения организаций предоставляющие услуги.' AUTO_INCREMENT=26 ;

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
(7, 'Ньюком Порт', 'Телефон'),
(18, 'test2', 'testing this site2'),
(19, 'test2', 'testing this site2'),
(20, 'test2', 'testing this site2'),
(21, 'test', 'testing this site'),
(22, 'test', 'testing this site'),
(23, 'test2', 'testing this site2'),
(24, 'test2', 'testing this site2'),
(25, 'test', 'testing this site');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `main`
--
ALTER TABLE `main`
  ADD CONSTRAINT `main_ibfk_3` FOREIGN KEY (`month_period_id`) REFERENCES `month_period` (`month_period_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `main_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `service` (`service_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `main_ibfk_2` FOREIGN KEY (`office_id`) REFERENCES `office` (`office_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
