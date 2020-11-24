-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               8.0.19 - MySQL Community Server - GPL
-- Операционная система:         Win64
-- HeidiSQL Версия:              11.0.0.5958
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп данных таблицы testpkr.companies: ~0 rows (приблизительно)
DELETE FROM `companies`;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
INSERT INTO `companies` (`id`, `name`, `inn`, `director`, `address`) VALUES
	(1, 'Тестовая компания', 1234567890, 'Иванов Иван Иванович', 'Санкт-Петербург, Невский проспект'),
	(2, 'Рога и Копыта', 555777888, 'Петров Иван Михайлович', 'Лиговский проспект'),
	(3, 'Рога и Копыта', 555777888, 'Петров Иван Михайлович', 'Лиговский проспект'),
	(4, 'Альфа', 1543355, 'Васильев Василий Васильевич', 'Москва, Тверская улица'),
	(5, 'Тестовая компания a', 54668464, 'Иванов Иван Иванович', 'Лиговский проспект'),
	(6, 'Бета', 465445435, 'Иванов Иван Иванович', 'Ростов-на-Дону, улица Ленина'),
	(7, 'Гамма', 14413544, 'Иванов Иван Иванович', 'Тверь, улица Карла Маркса'),
	(8, 'Дельта', 678969879, 'Петров Иван Михайлович', 'Тихвин, улица Садовая'),
	(9, 'Сигма', 123456789, 'Петров Иван Михайлович', 'Томск, улица Добронравова'),
	(10, 'Рога и Копыта', 456789, 'Иванов Иван Иванович', 'Лиговский проспект');
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;

-- Дамп данных таблицы testpkr.user: ~0 rows (приблизительно)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `password`, `role`, `auth_key`, `access_token`) VALUES
	(1, 'admin', 'admin', 1, '0', '0'),
	(2, 'demo', 'demo', 0, '0', '0');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
