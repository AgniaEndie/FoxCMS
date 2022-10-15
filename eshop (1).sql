-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 08 2022 г., 07:59
-- Версия сервера: 8.0.15
-- Версия PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `eshop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `cart_tovar_id` int(11) NOT NULL,
  `cart_user_id` int(11) NOT NULL,
  `cart_count` int(11) NOT NULL,
  `cart_tovar_name` text NOT NULL,
  `cart_tovar_img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `cart_tovar_about` text NOT NULL,
  `cart_tovar_cost` int(11) NOT NULL,
  `cart_tovar_status` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'новый'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cart`
--

INSERT INTO `cart` (`cart_id`, `cart_tovar_id`, `cart_user_id`, `cart_count`, `cart_tovar_name`, `cart_tovar_img`, `cart_tovar_about`, `cart_tovar_cost`, `cart_tovar_status`) VALUES
(58, 1, 1, 2, 'Iphone 14X', 'uploads/items/iphone14.png', 'Дерзкий Iphone 14X. По-настоящему волшебный новый опыт взаимодействия с iPhone. Прорывные функции безопасности, созданные, чтобы сберечь жизнь. Инновационная 48 Мп камера, чьи возможности потрясают воображение. И всё это под управлением самого производительного мобильного процессора.', 100000, 'выполнен'),
(60, 1, 1, 2, 'Iphone 14X', 'uploads/items/iphone14.png', 'Дерзкий Iphone 14X. По-настоящему волшебный новый опыт взаимодействия с iPhone. Прорывные функции безопасности, созданные, чтобы сберечь жизнь. Инновационная 48 Мп камера, чьи возможности потрясают воображение. И всё это под управлением самого производительного мобильного процессора.', 100000, 'выполнен'),
(61, 1, 1, 2, 'Iphone 14X', 'uploads/items/iphone14.png', 'Дерзкий Iphone 14X. По-настоящему волшебный новый опыт взаимодействия с iPhone. Прорывные функции безопасности, созданные, чтобы сберечь жизнь. Инновационная 48 Мп камера, чьи возможности потрясают воображение. И всё это под управлением самого производительного мобильного процессора.', 100000, 'выполнен'),
(62, 1, 1, 2, 'Iphone 14X', 'uploads/items/iphone14.png', 'Дерзкий Iphone 14X. По-настоящему волшебный новый опыт взаимодействия с iPhone. Прорывные функции безопасности, созданные, чтобы сберечь жизнь. Инновационная 48 Мп камера, чьи возможности потрясают воображение. И всё это под управлением самого производительного мобильного процессора.', 100000, 'выполнен'),
(63, 2, 1, 1, 'Samsung Galaxy S22', 'uploads/items/s22.png', 'Новейший Samsung Galaxy S22. Утонченные лицевые панели гармонично сочетаются с изысканным корпусом. Роскошный вид дополняет лаконичная система линейных камер . Он просто великолепен!', 25000, 'выполнен'),
(64, 2, 1, 1, 'Samsung Galaxy S22', 'uploads/items/s22.png', 'Новейший Samsung Galaxy S22. Утонченные лицевые панели гармонично сочетаются с изысканным корпусом. Роскошный вид дополняет лаконичная система линейных камер . Он просто великолепен!', 25000, 'выполнен'),
(68, 1, 1, 3, 'Iphone 14X', 'uploads/items/iphone14.png', 'Дерзкий Iphone 14X. По-настоящему волшебный новый опыт взаимодействия с iPhone. Прорывные функции безопасности, созданные, чтобы сберечь жизнь. Инновационная 48 Мп камера, чьи возможности потрясают воображение. И всё это под управлением самого производительного мобильного процессора.', 1000, 'выполнен');

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(3, 'Все товары'),
(4, 'Samsung'),
(5, 'Apple');

-- --------------------------------------------------------

--
-- Структура таблицы `country`
--

CREATE TABLE `country` (
  `country_id` int(11) NOT NULL,
  `country_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `country`
--

INSERT INTO `country` (`country_id`, `country_name`) VALUES
(1, 'Россия'),
(2, 'Китай');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `OrderId` int(11) NOT NULL,
  `OrderCartId` int(11) NOT NULL,
  `OrderDate` date NOT NULL,
  `OrderUserId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`OrderId`, `OrderCartId`, `OrderDate`, `OrderUserId`) VALUES
(9, 58, '2005-10-22', 1),
(10, 60, '2005-10-22', 1),
(11, 61, '2005-10-22', 1),
(12, 62, '2005-10-22', 1),
(13, 58, '2005-10-22', 1),
(14, 60, '2005-10-22', 1),
(15, 61, '2005-10-22', 1),
(16, 62, '2005-10-22', 1),
(17, 63, '2005-10-22', 1),
(18, 64, '2005-10-22', 1),
(19, 68, '2007-10-22', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tovar`
--

CREATE TABLE `tovar` (
  `tovar_id` int(11) NOT NULL,
  `tovar_name` text NOT NULL,
  `tovar_count` int(11) NOT NULL,
  `tovar_price` int(11) NOT NULL,
  `tovar_about` text NOT NULL,
  `tovar_country` int(11) NOT NULL,
  `tovar_mainimage` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `tovar_images` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tovar`
--

INSERT INTO `tovar` (`tovar_id`, `tovar_name`, `tovar_count`, `tovar_price`, `tovar_about`, `tovar_country`, `tovar_mainimage`, `tovar_images`, `category`) VALUES
(1, 'Iphone 14X', -6, 1000, 'Дерзкий Iphone 14X. По-настоящему волшебный новый опыт взаимодействия с iPhone. Прорывные функции безопасности, созданные, чтобы сберечь жизнь. Инновационная 48 Мп камера, чьи возможности потрясают воображение. И всё это под управлением самого производительного мобильного процессора.', 1, 'iphone14.png', '1', 5),
(2, 'Samsung Galaxy S22', 20, 25000, 'Новейший Samsung Galaxy S22. Утонченные лицевые панели гармонично сочетаются с изысканным корпусом. Роскошный вид дополняет лаконичная система линейных камер . Он просто великолепен!', 2, 's22.png', '1', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `auth_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `status` int(2) NOT NULL,
  `adress` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `auth_token`, `status`, `adress`) VALUES
(1, '123', 'asd@123.123', '$2y$10$ePzPAkp2l2yzjbgHRJK3Xen2RIyxNXjskIZcuR9mhnh19sW6HFGuO', '', 1, '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `cart_tovar_id` (`cart_tovar_id`),
  ADD KEY `cart_user_id` (`cart_user_id`),
  ADD KEY `cart_tovar_img` (`cart_tovar_img`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Индексы таблицы `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderId`),
  ADD KEY `OrderUserId` (`OrderUserId`),
  ADD KEY `OrderCartId` (`OrderCartId`) USING BTREE;

--
-- Индексы таблицы `tovar`
--
ALTER TABLE `tovar`
  ADD PRIMARY KEY (`tovar_id`),
  ADD KEY `category` (`category`),
  ADD KEY `tovar_country` (`tovar_country`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `tovar`
--
ALTER TABLE `tovar`
  MODIFY `tovar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`cart_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`cart_tovar_id`) REFERENCES `tovar` (`tovar_id`);

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`OrderUserId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`OrderCartId`) REFERENCES `cart` (`cart_id`);

--
-- Ограничения внешнего ключа таблицы `tovar`
--
ALTER TABLE `tovar`
  ADD CONSTRAINT `tovar_ibfk_1` FOREIGN KEY (`category`) REFERENCES `category` (`category_id`),
  ADD CONSTRAINT `tovar_ibfk_2` FOREIGN KEY (`tovar_country`) REFERENCES `country` (`country_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
