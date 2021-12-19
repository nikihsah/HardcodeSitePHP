-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3307
-- Время создания: Дек 01 2021 г., 20:49
-- Версия сервера: 8.0.24
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `biblio`
--

DELIMITER $$
--
-- Процедуры
--
CREATE DEFINER=`mysql`@`127.0.0.1` PROCEDURE `ex1` ()  BEGIN
	SELECT * FROM genres;
END$$

CREATE DEFINER=`mysql`@`127.0.0.1` PROCEDURE `ex2` (IN `nam` VARCHAR(20))  BEGIN
	SELECT genres.* FROM genres, books 
    WHERE books.idgenre = genres.id AND books.name LIKE nam;
END$$

CREATE DEFINER=`mysql`@`127.0.0.1` PROCEDURE `ex3` (IN `nam` VARCHAR(20))  BEGIN
	SELECT books.* FROM genres, books 
    WHERE books.idgenre = genres.id AND genres.genre LIKE nam;
END$$

CREATE DEFINER=`mysql`@`127.0.0.1` PROCEDURE `ex4` (IN `nam` VARCHAR(100))  BEGIN
	SELECT authors.* FROM authors, books 
    WHERE books.idgenre = authors.id AND books.name LIKE nam;
END$$

CREATE DEFINER=`mysql`@`127.0.0.1` PROCEDURE `recountAuthor` ()  BEGIN
	DECLARE i INT;
    DECLARE colvos INT;
    DECLARE ids INT;
    SET i = (SELECT COUNT(id) FROM authors);
    WHILE i > -1 DO
    	SET ids = (SELECT id from authors limit i,1);
        SET colvos = (SELECT COUNT(idauthor) FROM books WHERE idauthor = ids);
        UPDATE authors SET colvo = colvos WHERE id = ids;
        SET i = i - 1;
    END WHILE;
END$$

CREATE DEFINER=`mysql`@`127.0.0.1` PROCEDURE `recountGenre` ()  BEGIN
	DECLARE i INT;
    DECLARE colvos INT;
    DECLARE ids INT;
    SET i = (SELECT COUNT(id) FROM genres);
    WHILE i > -1 DO
    	SET ids = (SELECT id from genres limit i,1);
        SET colvos = (SELECT COUNT(idgenre) FROM books WHERE idgenre = ids);
        UPDATE genres SET colvo = colvos WHERE id = ids;
        SET i = i - 1;
    END WHILE;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `authors`
--

CREATE TABLE `authors` (
  `id` int UNSIGNED NOT NULL,
  `fio` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `birthday` datetime DEFAULT NULL,
  `death` datetime DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `colvo` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `authors`
--

INSERT INTO `authors` (`id`, `fio`, `birthday`, `death`, `city`, `colvo`) VALUES
(1, 'Лев Николаевич Толстой', '2021-10-03 00:00:00', '1910-11-11 00:00:00', 'Ясная поляна', 1),
(2, 'Александр Сергеевич Пушкин', '1799-05-26 00:00:00', '1837-01-29 00:00:00', 'Москва', 1),
(3, 'Агата Мэри Кларисса', '1976-09-15 00:00:00', '1976-01-12 00:00:00', 'Торки', 1),
(4, 'Достоевский Фёдор Михайлович', '1821-11-11 00:00:00', '1881-02-09 00:00:00', 'Москва', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

CREATE TABLE `books` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `years` datetime DEFAULT NULL,
  `description` text,
  `city` varchar(100) DEFAULT NULL,
  `idauthor` int UNSIGNED NOT NULL,
  `idgenre` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`id`, `name`, `years`, `description`, `city`, `idauthor`, `idgenre`) VALUES
(3, 'Партнёры по преступлению', '2021-11-08 00:00:00', 'Сборник рассказов английской писательницы детективов Агаты Кристи, повествующий о расследованиях Томми и Таппенс Бересфордов. В сборник входит 17 рассказов, но некоторые из них связаны друг с другом общим сюжетом и считаются одним рассказом.', 'Лондон', 3, 5),
(9, 'Пиковая дама', '1834-09-11 00:00:00', 'Повесть Александра Сергеевича Пушкина с мистическими элементами, послужившая источником сюжета одноимённой оперы П. И. Чайковского', 'Большое Болдино', 2, 2),
(16, 'Я и мой сайт', '2021-11-08 00:00:00', 'Никита пишет свой сайт', 'Сочи', 1, 1),
(41, 'detective', '2021-11-29 00:00:00', 'dadadadadadad', 'Ростов-на-Дону', 4, 4);

--
-- Триггеры `books`
--
DELIMITER $$
CREATE TRIGGER `addcolvo` AFTER INSERT ON `books` FOR EACH ROW BEGIN

UPDATE genres set colvo = colvo + 1 WHERE genres.id = new.idgenre;

UPDATE authors set colvo = colvo + 1 WHERE authors.id = new.idauthor;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `deletecolvo` AFTER DELETE ON `books` FOR EACH ROW BEGIN

UPDATE genres set colvo = colvo - 1 WHERE genres.id = old.idgenre;

UPDATE authors set colvo = colvo - 1 WHERE authors.id = old.idauthor;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `idUser` int NOT NULL,
  `idBook` int UNSIGNED NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `idUser`, `idBook`, `text`) VALUES
(1, 1, 3, 'Класс!'),
(2, 2, 3, 'супер!'),
(3, 2, 3, 'Кайф!'),
(4, 2, 3, 'Кайф!'),
(5, 2, 3, 'Вау!'),
(6, 2, 3, 'Вот это да!'),
(7, 2, 3, 'Вот это да!'),
(8, 2, 3, 'Вот это да!'),
(9, 2, 3, 'Вот это да!'),
(10, 2, 3, 'Vay'),
(11, 2, 3, 'Vay'),
(12, 2, 3, 'Vay'),
(13, 2, 3, 'kaif'),
(14, 2, 3, 'kaif'),
(15, 2, 3, 'Просто шедевр!'),
(16, 2, 3, 'Просто шедевр!'),
(17, 2, 3, 'Просто шедевр!');

-- --------------------------------------------------------

--
-- Структура таблицы `genres`
--

CREATE TABLE `genres` (
  `id` int UNSIGNED NOT NULL,
  `genre` varchar(100) DEFAULT NULL,
  `colvo` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `genres`
--

INSERT INTO `genres` (`id`, `genre`, `colvo`) VALUES
(1, 'Роман', 1),
(2, 'Классическая проза', 1),
(3, 'Повесть', 0),
(4, 'Детектив', 1),
(5, 'Рассказ', 1),
(6, 'Ужасы', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `korzina`
--

CREATE TABLE `korzina` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `years` datetime NOT NULL,
  `description` text NOT NULL,
  `city` varchar(100) NOT NULL,
  `idauthor` int UNSIGNED NOT NULL,
  `idgenre` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `username` varchar(16) NOT NULL,
  `password` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(30) NOT NULL,
  `rank` tinyint(1) NOT NULL,
  `id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`username`, `password`, `email`, `rank`, `id`) VALUES
('nikihsah', '123456789nikihsah', 'nikihsah@gmail.com', 0, 1),
('admin', '123456789admin', 'admin@example.com', 1, 2),
('123456789Nik', '123456789Nik', 'nikih@mail.ru', 0, 3),
('nikihsah', '123Password', 'test@mail.ru', 0, 4),
('nikihsah', '123Password', 'nikihsah@example.ru', 0, 5);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idAuthor` (`idauthor`),
  ADD KEY `idGenre` (`idgenre`);

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idBook` (`idBook`);

--
-- Индексы таблицы `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `korzina`
--
ALTER TABLE `korzina`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idauthor` (`idauthor`),
  ADD KEY `idgenre` (`idgenre`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `books`
--
ALTER TABLE `books`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`idauthor`) REFERENCES `authors` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `books_ibfk_2` FOREIGN KEY (`idgenre`) REFERENCES `genres` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`idBook`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `korzina`
--
ALTER TABLE `korzina`
  ADD CONSTRAINT `korzina_ibfk_1` FOREIGN KEY (`idauthor`) REFERENCES `authors` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `korzina_ibfk_2` FOREIGN KEY (`idgenre`) REFERENCES `genres` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

DELIMITER $$
--
-- События
--
CREATE DEFINER=`mysql`@`127.0.0.1` EVENT `korzina` ON SCHEDULE AT '2021-11-17 14:19:42' ON COMPLETION PRESERVE DISABLE DO INSERT INTO korzina
SELECT books.* FROM books, genres WHERE genres.id = books.idgenre and books.idgenre in (SELECT id from genres where genre LIKE "Детектив")$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
