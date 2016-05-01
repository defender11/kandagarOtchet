-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 30 2016 г., 19:09
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
-- Структура таблицы `agreement`
--

CREATE TABLE IF NOT EXISTS `agreement` (
  `agreement_id` int(11) NOT NULL,
  `agreement_name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

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
  `date_recieved` date NOT NULL DEFAULT '0000-00-00',
  `date_period` date DEFAULT NULL,
  `month_period_id` int(11) NOT NULL,
  `cash_id` int(11) NOT NULL DEFAULT '0',
  `agreement_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='Таблица для хранения организаций предоставляющие услуги.';

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
(8, 'Рога и Копыта', 'Услуга по осуществлению документации на коров'),
(9, 'Ньюком Порт', 'IP Телефония');

-- --------------------------------------------------------

--
-- Структура таблицы `statistic`
--

CREATE TABLE IF NOT EXISTS `statistic` (
  `stat_id` int(11) NOT NULL,
  `stat_month` date NOT NULL DEFAULT '0000-00-00',
  `stat_summ` int(11) DEFAULT NULL,
  `stat_payment` varchar(255) DEFAULT NULL,
  `status_id` int(11) NOT NULL DEFAULT '0',
  `main_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL,
  `user_login` varchar(50) NOT NULL,
  `user_passwd` int(11) NOT NULL,
  `user_access` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `user_login`, `user_passwd`, `user_access`) VALUES
(1, 'test', 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `user_access`
--

CREATE TABLE IF NOT EXISTS `user_access` (
  `user_access_id` int(11) NOT NULL,
  `user_access_name` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_access`
--

INSERT INTO `user_access` (`user_access_id`, `user_access_name`) VALUES
(1, 'Normal'),
(2, 'Proffi');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `agreement`
--
ALTER TABLE `agreement`
  ADD PRIMARY KEY (`agreement_id`);

--
-- Индексы таблицы `cash`
--
ALTER TABLE `cash`
  ADD PRIMARY KEY (`cash_id`);

--
-- Индексы таблицы `main`
--
ALTER TABLE `main`
  ADD PRIMARY KEY (`main_id`,`service_id`,`office_id`,`month_period_id`,`cash_id`,`agreement_id`,`user_id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `office_id` (`office_id`),
  ADD KEY `month_period_id` (`month_period_id`),
  ADD KEY `main_ibfk_5` (`cash_id`),
  ADD KEY `agreement_id` (`agreement_id`),
  ADD KEY `user_id` (`user_id`);

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
  ADD PRIMARY KEY (`stat_id`,`status_id`,`main_id`),
  ADD KEY `statistic_ibfk_2` (`status_id`),
  ADD KEY `statistic_ibfk_3` (`main_id`);

--
-- Индексы таблицы `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`,`user_access`),
  ADD KEY `users_ibfk_1` (`user_access`);

--
-- Индексы таблицы `user_access`
--
ALTER TABLE `user_access`
  ADD PRIMARY KEY (`user_access_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `agreement`
--
ALTER TABLE `agreement`
  MODIFY `agreement_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT для таблицы `cash`
--
ALTER TABLE `cash`
  MODIFY `cash_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `main`
--
ALTER TABLE `main`
  MODIFY `main_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
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
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `statistic`
--
ALTER TABLE `statistic`
  MODIFY `stat_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT для таблицы `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `user_access`
--
ALTER TABLE `user_access`
  MODIFY `user_access_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `main`
--
ALTER TABLE `main`
  ADD CONSTRAINT `main_ibfk_7` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `main_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `service` (`service_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `main_ibfk_2` FOREIGN KEY (`office_id`) REFERENCES `office` (`office_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `main_ibfk_3` FOREIGN KEY (`month_period_id`) REFERENCES `month_period` (`month_period_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `main_ibfk_5` FOREIGN KEY (`cash_id`) REFERENCES `cash` (`cash_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `main_ibfk_6` FOREIGN KEY (`agreement_id`) REFERENCES `agreement` (`agreement_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `statistic`
--
ALTER TABLE `statistic`
  ADD CONSTRAINT `statistic_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `statistic_ibfk_3` FOREIGN KEY (`main_id`) REFERENCES `main` (`main_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_access`) REFERENCES `user_access` (`user_access_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
