-- phpMyAdmin SQL Dump
-- version 4.4.14.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Сен 26 2015 г., 22:26
-- Версия сервера: 5.5.44-0ubuntu0.14.04.1
-- Версия PHP: 5.5.9-1ubuntu4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `robotkos`
--

-- --------------------------------------------------------

--
-- Структура таблицы `fos_user_group`
--

CREATE TABLE IF NOT EXISTS `fos_user_group` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `fos_user_user`
--

CREATE TABLE IF NOT EXISTS `fos_user_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `date_of_birth` datetime DEFAULT NULL,
  `firstname` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `biography` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `locale` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `timezone` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_uid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_data` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:json)',
  `twitter_uid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter_data` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:json)',
  `gplus_uid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gplus_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gplus_data` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:json)',
  `token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `two_step_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `returned` int(255) NOT NULL DEFAULT '0',
  `counts` int(255) NOT NULL DEFAULT '0',
  `count_all` int(255) NOT NULL DEFAULT '0',
  `paid` tinyint(1) DEFAULT NULL,
  `gallery_id` int(255) NOT NULL,
  `tbname` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT 'имя таблицы галлереи'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `fos_user_user`
--

INSERT INTO `fos_user_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `created_at`, `updated_at`, `date_of_birth`, `firstname`, `lastname`, `website`, `biography`, `gender`, `locale`, `timezone`, `phone`, `facebook_uid`, `facebook_name`, `facebook_data`, `twitter_uid`, `twitter_name`, `twitter_data`, `gplus_uid`, `gplus_name`, `gplus_data`, `token`, `two_step_code`, `returned`, `counts`, `count_all`, `paid`, `gallery_id`, `tbname`) VALUES
(1, 'admin', 'admin', 'sjay23@mail.ru', 'sjay23@mail.ru', 1, 'r1xfsoicny844o4kg8sg4o8og0w00ok', 'FQNw9wHr32Je9H/LFR7PU3hNnXKlN3G4/CVlVNCVrcA0HYtfTi4D9ADXPCmZ+i/QSBW8AFJ5heeZnj0LCEMFeg==', '2015-09-26 20:10:37', 0, 0, NULL, '3qzlmey3ew2soogo44s44wggsskk0w88gkk04og48c48goccks', '2015-09-17 23:44:44', 'a:1:{i:0;s:16:"ROLE_SUPER_ADMIN";}', 0, NULL, '2014-09-01 03:57:50', '2015-09-26 20:10:37', NULL, NULL, NULL, NULL, NULL, 'u', NULL, NULL, NULL, NULL, NULL, 'null', NULL, '1', 'null', NULL, NULL, 'null', NULL, NULL, 0, 7, 7, 0, 484434, '');

-- --------------------------------------------------------

--
-- Структура таблицы `fos_user_user_group`
--

CREATE TABLE IF NOT EXISTS `fos_user_user_group` (
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL,
  `parser_id` int(11) NOT NULL,
  `pn` text,
  `old_pn` text,
  `descr` text,
  `includes` text,
  `notes` text,
  `img` text
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `items`
--

INSERT INTO `items` (`id`, `parser_id`, `pn`, `old_pn`, `descr`, `img`) VALUES
(31, 1, '24-000321', 'F4-B46-0032-H1', '<div style="clear: both"></div>\n<p>Bilstein 4600 Series Shock Absorbers and Struts are designed specifically to help your truck, van or SUV reach its pinnacle in ride performance and handling, while still providing the comfortable ride that has come to be expected from the name BILSTEIN. A 4600 Series equipped vehicle offers superior control compared to conventional alternatives, allowing you to keep cargo secure-from your kids to work equipment, mile after mile. Utilizing our patented design, the dampers allow the vehicle to glide over every type of road surface you may encounter while maintaining complete command at all times. These dampers are the least expensive and most effective upgrade to extend the service life of any vehicle out on the road today.\n<div class="noprint"><b><a href="/pdfs/E4-WM5-Y217A00.pdf">Download Installation Instructions</a></b> <img src="/images/pdficon_small.gif" alt="PDF" style="max-width: 12px" /></div>\n<br /><div class="noprint"><h3 onClick="$(''#vehicleapps'').toggle(200);"><img src="/images/silk/add.png" height="12px" /> <a href="" onClick="return false">View Vehicle Applications</a></h3></div><div id="vehicleapps" style="display: none"><h4>Volkswagen</h4>\n1950 Volkswagen Beetle Base H4 1.1L Front\r<br />1950 Volkswagen Beetle Deluxe H4 1.1L Front\r<br />1951 Volkswagen Beetle Base H4 1.1L Front\r<br />1951 Volkswagen Beetle Deluxe H4 1.1L Front\r<br />1952 Volkswagen Beetle Base H4 1.1L Front\r<br />1952 Volkswagen Beetle Deluxe H4 1.1L Front\r<br />1953 Volkswagen Beetle Base H4 1.1L Front\r<br />1953 Volkswagen Beetle Deluxe H4 1.1L Front\r<br />1954 Volkswagen Beetle Base H4 1.2L Front\r<br />1954 Volkswagen Beetle Base H4 1.1L Front\r<br />1954 Volkswagen Beetle Deluxe H4 1.2L Front\r<br />1955 Volkswagen Beetle Base H4 1.2L Front\r<br />1955 Volkswagen Beetle Deluxe H4 1.2L Front\r<br />1955 Volkswagen Transporter Base H4 1.2L Front\r<br />1956 Volkswagen Beetle Base H4 1.2L Front\r<br />1956 Volkswagen Beetle Deluxe H4 1.2L Front\r<br />1956 Volkswagen Karmann Ghia Base H4 1.2L Front\r<br />1956 Volkswagen Transporter Base H4 1.2L Front\r<br />1957 Volkswagen Beetle Base H4 1.2L Front\r<br />1957 Volkswagen Beetle Deluxe H4 1.2L Front\r<br />1957 Volkswagen Karmann Ghia Base H4 1.2L Front\r<br />1957 Volkswagen Transporter Base H4 1.2L Front\r<br />1958 Volkswagen Beetle Base H4 1.2L Front\r<br />1958 Volkswagen Beetle Deluxe H4 1.2L Front\r<br />1958 Volkswagen Karmann Ghia Base H4 1.2L Front\r<br />1958 Volkswagen Transporter Base H4 1.2L Front\r<br />1959 Volkswagen Beetle Base H4 1.2L Front\r<br />1959 Volkswagen Beetle Deluxe H4 1.2L Front\r<br />1959 Volkswagen Karmann Ghia Base H4 1.2L Front\r<br />1959 Volkswagen Transporter Base H4 1.2L Front\r<br />1960 Volkswagen Beetle Base H4 1.2L Front\r<br />1960 Volkswagen Beetle Deluxe H4 1.2L Front\r<br />1960 Volkswagen Karmann Ghia Base H4 1.2L Front\r<br />1960 Volkswagen Transporter Base H4 1.2L Front\r<br />1961 Volkswagen Beetle Base H4 1.2L Front\r<br />1961 Volkswagen Beetle Deluxe H4 1.2L Front\r<br />1961 Volkswagen Karmann Ghia Base H4 1.2L Front\r<br />1961 Volkswagen Transporter Base H4 1.2L Front\r<br />1962 Volkswagen Beetle Base H4 1.2L Front\r<br />1962 Volkswagen Beetle Deluxe H4 1.2L Front\r<br />1962 Volkswagen Karmann Ghia Base H4 1.2L Front\r<br />1962 Volkswagen Transporter Base H4 1.2L Front\r<br />1963 Volkswagen Beetle Base H4 1.2L Front\r<br />1963 Volkswagen Beetle Deluxe H4 1.2L Front\r<br />1963 Volkswagen Karmann Ghia Base H4 1.2L Front\r<br />1963 Volkswagen Transporter Base H4 1.5L Front\r<br />1963 Volkswagen Transporter Base H4 1.2L Front\r<br />1964 Volkswagen Beetle Base H4 1.2L Front\r<br />1964 Volkswagen Karmann Ghia Base H4 1.2L Front\r<br />1964 Volkswagen Transporter Base H4 1.5L Front\r<br />1964 Volkswagen Transporter Base H4 1.2L Front\r<br />1965 Volkswagen Beetle Base H4 1.2L Front\r<br />1965 Volkswagen Karmann Ghia Base H4 1.2L Front\r<br />1965 Volkswagen Transporter Base H4 1.5L Front\r<br />1965 Volkswagen Transporter Base H4 1.2L Front\r<br />1966 Volkswagen Squareback Base H4 1.6L Front\r<br />1966 Volkswagen Transporter Base H4 1.5L Front\r<br />1967 Volkswagen Squareback Base H4 1.6L Front\r<br />1967 Volkswagen Transporter Base H4 1.5L Front\r<br />1968 Volkswagen Squareback Base H4 1.6L Front\r<br />1968 Volkswagen Transporter Base H4 1.6L Front\r<br />1969 Volkswagen Squareback Base H4 1.6L Front\r<br />1969 Volkswagen Transporter Base H4 1.6L Front\r<br />1970 Volkswagen Squareback Base H4 1.6L Front\r<br />1971 Volkswagen Squareback Base H4 1.6L Front\r<br />1972 Volkswagen Squareback Base H4 1.6L Front\r<br />1973 Volkswagen Squareback Base H4 1.6L Front\r<br /></div></div>\n<div class="noprint">\n<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like href="" send="true" width="450" show_faces="false" font="verdana"></fb:like>\n<div id="printer" style="position: absolute; right: 25px; bottom: 25px;"><input type="button" class="btn btn-blue" value="Print Result" onClick="window.print(); return false;" /></div>\n</di', ''),
(32, 1, '47-217522', 'Null', '<div style="clear: both"></div>\n<p>The Bilstein B14 PSS kit features both coilover and standard monotube gas shocks with performance-level valving, with application specific, progressive rate coil springs. The solid aluminum spring seat and lock nut allows for precise adjustment of the vehicle''s lowered ride height from 30mm to 50mm, even while installed. Bilstein''s patented Triple-C-Technology coating ensures long-lasting resistance to corrosion. This kit is ideal for the driver looking to set a car''s ride height for both looks and improved handling.\n<div class="noprint"><b><a href="/pdfs/E4-WM4-Y650A00.pdf">Download Installation Instructions</a></b> <img src="/images/pdficon_small.gif" alt="PDF" style="max-width: 12px" /></div>\n<br /><div class="noprint"><h3 onClick="$(''#vehicleapps'').toggle(200);"><img src="/images/silk/add.png" height="12px" /> <a href="" onClick="return false">View Vehicle Applications</a></h3></div><div id="vehicleapps" style="display: none"><h4>BMW</h4>\n2012 BMW 328i Base L4 2.0L Front and Rear\r<br />2012 BMW 328i Base L6 3.0L Front and Rear\r<br />2012 BMW 335i Base L6 3.0L Front and Rear\r<br />2013 BMW 320i M Sport L4 2.0L Front and Rear\r<br />2013 BMW 320i Base L4 2.0L Front and Rear\r<br />2013 BMW 328i Base L4 2.0L Front and Rear\r<br />2013 BMW 328i Base L6 3.0L Front and Rear\r<br />2013 BMW 335i Base L6 3.0L Front and Rear\r<br />2014 BMW 228i Base L4 2.0L Front and Rear\r<br />2014 BMW 235i Base L6 3.0L Front and Rear\r<br />2014 BMW 320i M Sport L4 2.0L Front and Rear\r<br />2014 BMW 320i Sport L4 2.0L Front and Rear\r<br />2014 BMW 320i Luxury L4 2.0L Front and Rear\r<br />2014 BMW 320i Modern L4 2.0L Front and Rear\r<br />2014 BMW 320i Base L4 2.0L', ''),
(33, 1, '24-001861', 'F4-B46-0186-H1,F4-B46-0186-H2', '<div style="clear: both"></div>\n<p>Bilstein 4600 Series Shock Absorbers and Struts are designed specifically to help your truck, van or SUV reach its pinnacle in ride performance and handling, while still providing the comfortable ride that has come to be expected from the name BILSTEIN. A 4600 Series equipped vehicle offers superior control compared to conventional alternatives, allowing you to keep cargo secure-from your kids to work equipment, mile after mile. Utilizing our patented design, the dampers allow the vehicle to glide over every type of road surface you may encounter while maintaining complete command at all times. These dampers are the least expensive and most effective upgrade to extend the service life of any vehicle out on the road today.\n<div class="noprint"><b><a href="/pdfs/E4-WM5-Y217A00.pdf">Download Installation Instructions</a></b> <img src="/images/pdficon_small.gif" alt="PDF" style="max-width: 12px" /></div>\n<br /><div class="noprint"><h3 onClick="$(''#vehicleapps'').toggle(200);"><img src="/images/silk/add.png" height="12px" /> <a href="" onClick="return false">View Vehicle Applications</a></h3></div><div id="vehicleapps" style="display: none"><h4>Isuzu</h4>\n1984 Isuzu Trooper Base L4 2.2L Front\r<br />1984 Isuzu Trooper Base L4 1.9L Front\r<br />1985 Isuzu Trooper Base L4 1.9L Front\r<br />1986 Isuzu Trooper DLX L4 2.2L Front\r<br />1986 Isuzu Trooper DLX L4 2.3L Front\r<br />1986 Isuzu Trooper LS L4 2.2L Front\r<br />1986 Isuzu Trooper LS L4 2.3L Front\r<br />1986 Isuzu Trooper LX L4 2.2L Front\r<br />1986 Isuzu Trooper LX L4 2.3L Front\r<br />1987 Isuzu Trooper DLX L4 2.2L Front\r<br />1987 Isuzu Trooper DLX L4 2.3L Front\r<br />1987 Isuzu Trooper LS L4 2.2L Front\r<br />1987 Isuzu Trooper LS L4 2.3L Front\r<br />1988 Isuzu Trooper LS L4 2.6L Front\r<br />1988 Isuzu Trooper S L4 2.6L Front\r<br />1988 Isuzu Trooper XS L4 2.6L Front\r<br />1989 Isuzu Trooper LS V6 2.8L Front\r<br />1989 Isuzu Trooper LS L4 2.6L Front\r<br />1989 Isuzu Trooper RS V6 2.8L Front\r<br />1989 Isuzu Trooper RS L4 2.6L Front\r<br />1989 Isuzu Trooper S V6 2.8L Front\r<br />1989 Isuzu Trooper S L4 2.6L Front\r<br />1989 Isuzu Trooper XS V6 2.8L Front\r<br />1989 Isuzu Trooper XS L4 2.6L Front\r<br />1990 Isuzu Trooper LS V6 2.8L Front\r<br />1990 Isuzu Trooper LS L4 2.6L Front\r<br />1990 Isuzu Trooper RS V6 2.8L Front\r<br />1990 Isuzu Trooper RS L4 2.6L Front\r<br />1990 Isuzu Trooper S V6 2.8L Front\r<br />1990 Isuzu Trooper S L4 2.6L Front\r<br />1990 Isuzu Trooper XS V6 2.8L Front\r<br />1990 Isuzu Trooper XS L4 2.6L Front\r<br />1991 Isuzu Trooper LS V6 2.8L Front\r<br />1991 Isuzu Trooper LS L4 2.6L Front\r<br />1991 Isuzu Trooper S V6 2.8L Front\r<br />1991 Isuzu Trooper S L4 2.6L Front\r<br />1991 Isuzu Trooper SE V6 2.8L Front\r<br />1991 Isuzu Trooper SE L4 2.6L Front\r<br />1991 Isuzu Trooper XS V6 2.8L Front\r<br />1991 Isuzu Trooper XS L4 2.6L Front\r<br /></div></div>\n<div class="noprint">\n<div id="fb-root"></div><script src="http://connect.facebook.net/e', '');

-- --------------------------------------------------------

--
-- Структура таблицы `parsers`
--

CREATE TABLE IF NOT EXISTS `parsers` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `parts` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `date_start` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `parsers`
--

INSERT INTO `parsers` (`id`, `name`, `parts`, `status`, `date_start`) VALUES
(1, 'test', '24-000321,47-217522,24-001861,24-001960,24-000321,47-217522,24-001861,24-001960,24-000321,47-217522,24-001861,24-001960,24-000321,47-217522,24-001861,24-001960,24-000321,47-217522,24-001861,24-001960,24-000321,47-217522,24-001861,24-001960,24-000321,47-217522,24-001861,24-001960,24-000321,47-217522,24-001861,24-001960,24-000321,47-217522,24-001861,24-001960,24-000321,47-217522,24-001861,24-001960,24-000321,47-217522,24-001861,24-001960,24-000321,47-217522,24-001861,24-001960,24-000321,47-217522,24-001861,24-001960,24-000321,47-217522,24-001861,24-001960,24-000321,47-217522,24-001861,24-001960,24-000321,47-217522,24-001861,24-001960,24-000321,47-217522,24-001861,24-001960,24-000321,47-217522,24-001861,24-001960,24-000321,47-217522,24-001861,24-001960,24-000321,47-217522,24-001861,24-001960,24-000321,47-217522,24-001861,24-001960,24-000321,47-217522,24-001861,24-001960,24-000321,47-217522,24-001861,24-001960,24-000321,47-217522,24-001861,24-001960,24-000321,47-217522,24-001861,24-001960,24-000321,47-217522,24-001861,24-001960,24-000321,47-217522,24-001861,24-001960,24-000321,47-217522,24-001861,24-001960,24-000321,47-217522,24-001861,24-001960,24-000321,47-217522,24-001861,24-001960,24-000321,47-217522,24-001861,24-001960,24-000321,47-217522,24-001861,24-001960,24-000321,47-217522,24-001861,24-001960,24-000321,47-217522,24-001861,24-001960', 1, '2015-09-26 19:21:29');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `fos_user_group`
--
ALTER TABLE `fos_user_group`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_583D1F3E5E237E06` (`name`);

--
-- Индексы таблицы `fos_user_user`
--
ALTER TABLE `fos_user_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_C560D76192FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_C560D761A0D96FBF` (`email_canonical`);

--
-- Индексы таблицы `fos_user_user_group`
--
ALTER TABLE `fos_user_user_group`
  ADD PRIMARY KEY (`user_id`,`group_id`),
  ADD KEY `IDX_B3C77447A76ED395` (`user_id`),
  ADD KEY `IDX_B3C77447FE54D947` (`group_id`);

--
-- Индексы таблицы `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `parsers`
--
ALTER TABLE `parsers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `fos_user_group`
--
ALTER TABLE `fos_user_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `fos_user_user`
--
ALTER TABLE `fos_user_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT для таблицы `parsers`
--
ALTER TABLE `parsers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `fos_user_user_group`
--
ALTER TABLE `fos_user_user_group`
  ADD CONSTRAINT `FK_B3C77447A76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user_user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_B3C77447FE54D947` FOREIGN KEY (`group_id`) REFERENCES `fos_user_group` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
