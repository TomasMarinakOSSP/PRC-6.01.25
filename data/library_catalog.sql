-- Adminer 4.8.1 MySQL 8.0.33 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `books`;
CREATE TABLE `books` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `author` varchar(255) NOT NULL,
  `price` int NOT NULL,
  `category_id` int DEFAULT NULL,
  `year` date NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `books_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `books` (`id`, `title`, `author`, `price`, `category_id`, `year`, `description`) VALUES
(1,	'To Kill a Mockingbird',	'Harper Lee',	399,	1,	'1960-07-11',	'asdf'),
(2,	'1984',	'George Orwell',	299,	2,	'1949-06-08',	'asdf'),
(3,	'Pride and Prejudice',	'Jane Austen',	349,	1,	'1813-01-28',	'asdf'),
(4,	'The Great Gatsby',	'F. Scott Fitzgerald',	299,	1,	'1925-04-10',	'asdfsxcvbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb'),
(5,	'The Catcher in the Rye',	'J.D. Salinger',	349,	3,	'1951-07-16',	'asdf'),
(6,	'Moby-Dick',	'Herman Melville',	399,	4,	'1851-10-18',	'asdf'),
(7,	'The Hobbit',	'J.R.R. Tolkien',	499,	5,	'1937-09-21',	'asdf'),
(8,	'Harry Potter and the Sorcerer\'s Stone',	'J.K. Rowling',	599,	5,	'1997-06-26',	'asdf'),
(9,	'The Da Vinci Code',	'Dan Brown',	399,	6,	'2003-03-18',	'asdf'),
(10,	'The Alchemist',	'Paulo Coelho',	299,	7,	'1988-04-15',	'asdf');

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int NOT NULL,
  `category_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `category` (`id`, `category_name`) VALUES
(1,	'Klasická literatura'),
(2,	'Sci-fi / Dystopie'),
(3,	'Psychologie / Romány'),
(4,	'Dobrodružné příběhy'),
(5,	'Fantasy'),
(6,	'Thriller / Detektivky'),
(7,	'Filozofie / Duchovní');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `role` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(1,	'admin',	'admin@gmail.com',	'$2y$10$S5Nonqcere1LzF4NLM4H2e15XrOREtVzBKqwsw3rhGUIlEP7Ws6kq',	'admin');

-- 2025-01-13 11:44:38