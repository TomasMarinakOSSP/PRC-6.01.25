-- Adminer 4.8.1 MySQL 8.0.30 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP DATABASE IF EXISTS `library_catalog`;
CREATE DATABASE `library_catalog` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `library_catalog`;

DROP TABLE IF EXISTS `books`;
CREATE TABLE `books` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `author` varchar(255) NOT NULL,
  `price` int NOT NULL,
  `category_id` int NOT NULL,
  `year` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `books_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `books` (`id`, `title`, `author`, `price`, `category_id`, `year`) VALUES
(1,	'To Kill a Mockingbird',	'Harper Lee',	399,	1,	'1960-07-11'),
(2,	'1984',	'George Orwell',	299,	2,	'1949-06-08'),
(3,	'Pride and Prejudice',	'Jane Austen',	349,	1,	'1813-01-28'),
(4,	'The Great Gatsby',	'F. Scott Fitzgerald',	299,	1,	'1925-04-10'),
(5,	'The Catcher in the Rye',	'J.D. Salinger',	349,	3,	'1951-07-16'),
(6,	'Moby-Dick',	'Herman Melville',	399,	4,	'1851-10-18'),
(7,	'The Hobbit',	'J.R.R. Tolkien',	499,	5,	'1937-09-21'),
(8,	'Harry Potter and the Sorcerer\'s Stone',	'J.K. Rowling',	599,	5,	'1997-06-26'),
(9,	'The Da Vinci Code',	'Dan Brown',	399,	6,	'2003-03-18'),
(10,	'The Alchemist',	'Paulo Coelho',	299,	7,	'1988-04-15')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `title` = VALUES(`title`), `author` = VALUES(`author`), `price` = VALUES(`price`), `category_id` = VALUES(`category_id`), `year` = VALUES(`year`);

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
(7,	'Filozofie / Duchovní')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `category_name` = VALUES(`category_name`);

-- 2025-01-06 12:51:19
