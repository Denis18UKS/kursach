-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 12 2024 г., 14:48
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `CITY-TAXI`
--

-- --------------------------------------------------------

--
-- Структура таблицы `address`
--

CREATE TABLE `address` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `address`
--

INSERT INTO `address` (`id`, `id_user`, `address`) VALUES
(1, 13, 'Мушникова 11'),
(4, 13, 'Транспортная 42'),
(5, 13, 'Мушникова 13/2'),
(7, 13, 'Мушникова 11/3'),
(8, 13, 'Транспортная 50'),
(9, 14, 'Кирова 65/2'),
(10, 14, 'ул. Баязита Бикбая 20/1'),
(11, 14, 'ул. Вологодская 50');

-- --------------------------------------------------------

--
-- Структура таблицы `cars`
--

CREATE TABLE `cars` (
  `id_cars` int NOT NULL,
  `model_car` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `number_car` int NOT NULL,
  `status` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `cars`
--

INSERT INTO `cars` (`id_cars`, `model_car`, `number_car`, `status`) VALUES
(1, 'Lada Granta', 487, 'Активна'),
(2, 'Kia Rio', 758, 'Активна'),
(3, 'Lada Vesta', 747, 'Активна'),
(4, 'Ford', 563, 'Активна'),
(5, 'Nissan ', 748, 'Активна'),
(6, 'BMW', 895, 'Активна'),
(7, 'Solaris', 868, 'активна');

-- --------------------------------------------------------

--
-- Структура таблицы `city`
--

CREATE TABLE `city` (
  `id_city` int NOT NULL,
  `name_city` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_travel` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `city`
--

INSERT INTO `city` (`id_city`, `name_city`, `price_travel`) VALUES
(1, 'Москва', 8600),
(2, 'Уфа', 3200),
(3, 'Краснодар', 4900),
(4, 'Казань', 3499),
(5, 'Красноярск', 8300),
(6, 'Саранск', 6600),
(7, 'Пенза', 5879),
(8, 'Самара', 4989),
(9, 'Санкт-Петербург', 12300),
(10, 'Тюмень', 5600),
(11, 'Белебей', 15500),
(12, 'Туймазы', 3200),
(13, 'Бирск', 3600),
(14, 'Волгоград', 10000);

-- --------------------------------------------------------

--
-- Структура таблицы `drivers`
--

CREATE TABLE `drivers` (
  `id` int NOT NULL,
  `id_cars` int NOT NULL,
  `surname_driver` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_driver` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `patronymic_driver` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` int NOT NULL,
  `experience` int NOT NULL,
  `driver_license` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_driver` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_reg` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status_work` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_role` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `drivers`
--

INSERT INTO `drivers` (`id`, `id_cars`, `surname_driver`, `name_driver`, `patronymic_driver`, `age`, `experience`, `driver_license`, `password`, `status_driver`, `date_reg`, `status_work`, `id_role`) VALUES
(1, 1, 'Шиппухин', 'Макар', 'Олегович', 31, 9, 'SH0M2O', 'SHMO', 'Активен', '2024-05-25 20:29:23', 'на смене', 2),
(2, 2, 'Злаков', 'Рустем', 'Денисович', 22, 3, 'Z20RM24', '2024', 'Активен', '2024-05-26 16:04:20', 'на смене', 2),
(3, 3, 'Супрахин', 'Олег', 'Максимович', 25, 5, 'COM8748', '1111', 'Активен', '2024-05-27 16:56:14', 'на смене', 2),
(4, 4, 'Дмитриев', 'Игорь', 'Сергеевич', 28, 8, 'ДИС22', 'DIS22', 'Активен', '2024-06-11 17:11:25', 'не на смене', 2),
(5, 5, 'Абрамов', 'Виктор', 'Олегович ', 25, 5, 'АВО25', 'ABO25', 'Активен', '2024-06-11 17:12:05', 'не на смене', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id_order` int NOT NULL,
  `id_user` int NOT NULL,
  `id_drivers` int NOT NULL,
  `id_tarifs` int NOT NULL,
  `point_A` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_city` int NOT NULL,
  `street` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order-travel` date NOT NULL,
  `price_all` int NOT NULL,
  `order-date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `time-travel` time NOT NULL,
  `status_ord` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id_order`, `id_user`, `id_drivers`, `id_tarifs`, `point_A`, `id_city`, `street`, `order-travel`, `price_all`, `order-date`, `time-travel`, `status_ord`) VALUES
(24, 13, 1, 10, 'Уфа, Георгия Мушникова д. 11, п.13', 4, 'Казанская 30', '2024-06-08', 8950, '2024-06-02 13:42:03', '19:42:00', 'выполнен'),
(26, 13, 2, 9, 'Уфа, Георгия Мушникова д. 11, п.13', 4, 'Кремлевская 100', '2024-06-03', 8950, '2024-06-02 14:01:41', '19:01:00', 'принят'),
(40, 19, 1, 9, 'г. Санкт-Петербург, ул. Набережная 30, дом 1', 8, 'Самарская 60/2', '2024-06-12', 8950, '2024-06-11 16:46:16', '00:00:00', 'выполнен'),
(41, 19, 1, 9, 'г. Самара, Самарская 60/2', 9, 'ул. Набережная 30/1', '2024-06-15', 8950, '2024-06-11 16:47:53', '00:00:00', 'выполнен'),
(42, 14, 1, 8, 'Уфа, Георгия Мушникова д. 11, п.13', 1, 'Кремлевская 100', '2024-06-13', 9100, '2024-06-11 22:42:22', '04:42:00', 'в обработке');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `name_role` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name_role`) VALUES
(1, 'Пользователь'),
(2, 'Водитель'),
(3, 'Администратор');

-- --------------------------------------------------------

--
-- Структура таблицы `tarifs`
--

CREATE TABLE `tarifs` (
  `id` int NOT NULL,
  `picture_tarif` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_tarif` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_tarif` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_tarif` int NOT NULL,
  `status_tarif` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tarifs`
--

INSERT INTO `tarifs` (`id`, `picture_tarif`, `title_tarif`, `description_tarif`, `price_tarif`, `status_tarif`) VALUES
(8, '../tarifs/file (1).png', 'Путешествие', 'Тариф \"Путешествие\" для ночного такси обычно представляет собой специальное предложение, которое ориентировано на обеспечение удобства, безопасности и комфорта во время ночных поездок.', 500, 'активен'),
(9, '../tarifs/comfort.png', 'Комфорт', 'Тариф \"Комфорт\" включает в себя комфортабельные автомобили более высокого класса, например, бизнес- или премиум-класса, которые обеспечивают более приятное и удобное путешествие. Пассажиры выбирают тариф \"Комфорт\" за его дополнительные возможности, такие как бесплатный Wi-Fi, возможность выбора конкретного водителя, бесплатная бутылка воды или другие мелочи, которые делают поездку более приятной.', 350, 'активен'),
(10, '../tarifs/relax.png', 'Релакс', 'Тариф \"Релакс\" для ночного такси обычно представляет собой специальное предложение, направленное на обеспечение максимального комфорта, расслабления и удовольствия во время поездки в ночное время суток.', 350, 'активен'),
(14, '../tarifs/изображение_2024-04-03_142214445.png', 'Экскурсионный', 'Предлагаем вам тариф \"Экскурсия\" по любому городу который вы выберете сами исходя из нашего списка :)', 500, 'активен'),
(15, '../tarifs/tNHrJ5yRJww.jpg', 'Быстрый', 'Тариф «Быстрый» доставит вас до места назначения очень быстро! И без пробок!', 300, 'активен');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `surname` varchar(85) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(85) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `login` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `reg-time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('активен','заблокирован') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_role` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `surname`, `name`, `login`, `email`, `password`, `address`, `reg-time`, `status`, `id_role`) VALUES
(13, 'Сабрамов', 'Денис', 'Dens123', 'honorxpremium75@gmail.com', '123456', 'Транспортная 50/2', '2024-05-22 07:57:51', 'активен', 1),
(14, 'Данилов', 'Марат', 'Darat', 'lakos208@gmail.com', 'DM', 'Кирова 65/2', '2024-05-24 23:38:59', 'активен', 1),
(15, 'Карпов', 'Денис', 'admin', 'hcsland87@gmail.com', 'admin', 'ул. Г. Мушникова д. 11', '2024-05-25 19:43:23', 'активен', 3),
(16, 'Петухов', 'Никита', 'Zenforz', 'programmad000@gmail.com', 'ZZZ', 'ул. Г. Мушникова д. 11', '2024-05-27 17:58:02', 'активен', 1),
(19, 'Синитенко', 'Олег', 'Olesin', 'olesin@gmail.com', 'olesin', 'ул. Набережная 30/1', '2024-06-11 16:43:36', 'активен', 1),
(20, 'Кинзябулатова', 'Алина', 'Airin', 'airin@gmail.com', 'Airin', 'ул. Г. Мушникова 13/2', '2024-06-11 19:47:42', 'активен', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Индексы таблицы `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id_cars`);

--
-- Индексы таблицы `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id_city`);

--
-- Индексы таблицы `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cars` (`id_cars`),
  ADD KEY `id_role` (`id_role`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_tarifs` (`id_tarifs`),
  ADD KEY `id_drivers` (`id_drivers`),
  ADD KEY `id_city` (`id_city`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tarifs`
--
ALTER TABLE `tarifs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_role` (`id_role`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `address`
--
ALTER TABLE `address`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `cars`
--
ALTER TABLE `cars`
  MODIFY `id_cars` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `city`
--
ALTER TABLE `city`
  MODIFY `id_city` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `tarifs`
--
ALTER TABLE `tarifs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `drivers`
--
ALTER TABLE `drivers`
  ADD CONSTRAINT `drivers_ibfk_1` FOREIGN KEY (`id_cars`) REFERENCES `cars` (`id_cars`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `drivers_ibfk_2` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`id_tarifs`) REFERENCES `tarifs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`id_drivers`) REFERENCES `drivers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`id_city`) REFERENCES `city` (`id_city`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
