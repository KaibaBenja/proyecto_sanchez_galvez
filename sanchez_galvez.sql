-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-06-2025 a las 21:46:12
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sanchez_galvez`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `brands`
--
-- Creación: 18-06-2025 a las 17:09:07
-- Última actualización: 18-06-2025 a las 19:24:10
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `brands`:
--

--
-- Volcado de datos para la tabla `brands`
--

INSERT INTO `brands` (`id`, `name`) VALUES
(1, 'Adidas'),
(2, 'Nike'),
(3, 'New Balance'),
(4, 'Reebok'),
(5, 'Puma'),
(6, 'Converse');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart`
--
-- Creación: 18-06-2025 a las 17:09:06
-- Última actualización: 18-06-2025 a las 18:46:10
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `cart`:
--   `user_id`
--       `users` -> `id`
--   `product_id`
--       `products` -> `id`
--   `size_id`
--       `sizes` -> `id`
--

--
-- Volcado de datos para la tabla `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `size_id`, `quantity`, `active`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 1, 1, 0, '2025-06-18 17:11:04', '2025-06-18 17:46:40'),
(2, 5, 1, 2, 2, 0, '2025-06-18 17:47:06', '2025-06-18 17:52:18'),
(3, 5, 1, 4, 1, 0, '2025-06-18 17:52:24', '2025-06-18 17:55:58'),
(4, 5, 1, 3, 1, 0, '2025-06-18 17:57:25', '2025-06-18 18:46:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--
-- Creación: 18-06-2025 a las 17:09:07
-- Última actualización: 18-06-2025 a las 19:19:21
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `categories`:
--

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Urbano'),
(2, 'Urbano'),
(3, 'Baloncesto'),
(4, 'Entrenamiento');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--
-- Creación: 18-06-2025 a las 17:59:53
-- Última actualización: 18-06-2025 a las 18:03:56
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` enum('pending','paid','shipped','cancelled') NOT NULL DEFAULT 'pending',
  `total_price` decimal(10,2) NOT NULL,
  `created_at` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `orders`:
--

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `status`, `total_price`, `created_at`, `updated_at`) VALUES
(9, 5, 'pending', 198000.00, '2025-06-18 18:02:07.000000', '2025-06-18 18:02:07'),
(10, 5, 'pending', 198000.00, '2025-06-18 18:03:56.000000', '2025-06-18 18:03:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order_items`
--
-- Creación: 18-06-2025 a las 17:09:07
-- Última actualización: 18-06-2025 a las 18:03:56
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `price_at_purchase` decimal(10,2) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `order_items`:
--   `order_id`
--       `orders` -> `id`
--   `product_id`
--       `products` -> `id`
--

--
-- Volcado de datos para la tabla `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `price_at_purchase`, `product_id`, `size_id`, `quantity`) VALUES
(1, 9, 198000.00, 1, 3, 1),
(2, 10, 198000.00, 1, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--
-- Creación: 18-06-2025 a las 19:43:08
-- Última actualización: 18-06-2025 a las 19:43:51
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `image_url` varchar(200) NOT NULL,
  `created_at` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `products`:
--   `brand_id`
--       `brands` -> `id`
--   `category_id`
--       `categories` -> `id`
--

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `brand_id`, `category_id`, `price`, `description`, `image_url`, `created_at`) VALUES
(1, 'Adi2000', 1, 1, 198000.00, 'Mostrá tu lado más rebelde con las zapatillas adi2000, inspiradas en la era audaz de principios de los 2000. Con un ADN de skate y una paleta de colores versátiles, estas zapatillas adidas fueron diseñadas pensando en tu estilo único. El diseño actualizado de las 3 Tiras aporta un toque divertido, mientras que el exterior de cuero y la suela de caucho se encargan de brindar comodidad.\r\n\r\nProducto hecho parcialmente con contenido reciclado generado a partir de desechos de producción, tales como recortes de tela y desechos domésticos posconsumo, para evitar un mayor impacto ambiental al producir contenido virgen.', '1750266641_6f81e2dedc2c1fc35930.webp', '2025-06-18 14:10:41.102100'),
(2, 'Air Jordan 1 High OG Black Toe Reimagined', 2, 2, 220000.00, 'Las Jordan 1 Retro High OG Black Toe Reimagined son una nueva versión de una de las combinaciones de colores más icónicas de las Air Jordan 1. La combinación de negro, rojo universitario y blanco es un guiño al lanzamiento original de 1985 que ayudó a definir la cultura de las zapatillas. Sin embargo, esta versión reimaginada incluye varias actualizaciones especiales, que añaden un toque moderno a un aspecto clásico. Una de las características más destacadas es el texto \"Air Jordan\" que reemplaza el tradicional logotipo de las alas en el cuello, ofreciendo un cambio sutil pero significativo.\r\n\r\nOtro detalle llamativo es la lengüeta negra, que contrasta con los paneles rojos y blancos, junto con una entresuela de aspecto ligeramente envejecido, que le da a la zapatilla un aire vintage pero mantiene su atractivo atemporal. La firma de Michael Jordan y un mensaje sincero hacen que esta pareja sea realmente única. Agregue una caja única con una imagen de las campañas de marketing originales de Air Jordan 1, y este lanzamiento es una verdadera pieza de colección.\r\n\r\nLanzadas en 2025, las Jordan 1 Retro High OG Black Toe Reimagined se vendieron por 180 dólares. Con su mezcla de elementos nostálgicos y actualizaciones basadas en las Air Jordan 1 High originales que nunca se lanzaron al público, este lanzamiento tan esperado es imprescindible tanto para los fanáticos de Jordan de toda la vida como para los nuevos coleccionistas.', '1750273863_291ab8785080ca2d8cdc.webp', '2025-06-18 16:11:03.233325'),
(3, 'New Balance 550', 3, 1, 230000.00, 'l modelo 550 original debutó en 1989 y dejó huella de costa a costa en las canchas de baloncesto. Después de su lanzamiento inicial, el modelo 550 se guardó en los archivos antes de reintroducirse en ediciones limitadas a finales de 2020 y volvió a la cancha de tiempo completo en el 2021, convirtiéndose rápidamente en un favorito de la moda en todo el mundo. La silueta aerodinámica y de corte bajo del modelo 550 ofrece una visión elegante de los diseños más resistentes de finales de los 80, mientras que la confiable parte superior de cuero es un clásico en cualquier época.', '1750274013_b6088eb9f25091866096.webp', '2025-06-18 16:13:33.227359'),
(4, 'Nike Giannis Immortality 3', 2, 3, 154999.00, '¿Cómo querés que recuerden tu juego? Ganate tu lugar entre las estrellas como Giannis con las Zapatillas Nike Giannis Immortality 3 5 The Hard Way Hombre. Creadas cuidadosamente para el baloncesto de hoy en día, de ritmo intenso y sin posiciones fijas, estas zapatillas son más suaves que la versión anterior, con un patrón de tracción perfecto para hacer los mejores Euro-Step.', '1750274153_a24e504b0438f83445c4.jpg', '2025-06-18 16:15:53.033754'),
(5, 'Zapatillas Reebok Nano X4', 4, 4, 189999.00, 'Las Zapatillas Reebok Nano X4 Hombre están diseñadas para ofrecer un rendimiento excepcional en entrenamientos de alta intensidad. Con una parte superior de malla técnica que favorece la transpiración y flexibilidad, garantizan comodidad durante todo el día. Su suela de goma con tracción mejorada proporciona un agarre firme, ideal tanto para levantamiento de pesas como para ejercicios dinámicos. Incorporan una tecnología de amortiguación que maximiza la comodidad sin perder estabilidad, y su diseño robusto asegura una gran durabilidad. Perfectas para quienes buscan versatilidad y rendimiento en su calzado de entrenamiento.', '1750274361_d5fb1cd254e722272324.jpg', '2025-06-18 16:19:21.703462'),
(6, 'Puma Caven 2.0 Lux', 5, 1, 119999.00, 'Las Zapatillas Puma Caven 2.0 Lux fusionan el estilo retro del básquet de los 80 con detalles modernos. Confeccionadas en cuero premium y una entresuela apilada, ofrecen comodidad y un look urbano versátil para el día a día.', '1750274530_a02fc5979f685a97db44.jpg', '2025-06-18 16:22:10.662482'),
(7, 'Converse Chuck Taylor Core Hi', 6, 1, 89899.00, '', '1750274650_2dc9bee0cd2f4642a582.jpg', '2025-06-18 16:24:10.690993'),
(8, 'Nike Legend Essential 3 Next Nature Hombre', 1, 4, 119999.00, 'Zapatillas Entrenamiento Nike Legend Essential 3 Next Nature Hombre están diseñadas con una estructura ligera y duradera. Están fabricadas con materiales reciclados, lo que las convierte en una opción más sostenible sin comprometer el rendimiento. La suela ofrece una excelente tracción, mientras que la parte superior de malla proporciona ventilación para mantener los pies frescos durante los entrenamientos más exigentes.', '1750274816_f92f17dda1eebb40b78f.jpg', '2025-06-18 16:26:56.972483'),
(13, 'Adidas Dropset 3', 1, 4, 189999.00, 'Ya sea levantando, empujando o tirando, las Zapatillas adidas Dropset 3 proporcionan el soporte estable necesario para el entrenamiento de fuerza. Una entresuela de doble densidad mantiene los pies amortiguados durante las repeticiones intensas, mientras que la pared lateral de TPU bloquea la parte media del pie. adidas HEAT. RDY mantiene los pies frescos incluso cuando el entrenamiento se calienta. Más anchas que el ajuste estándar, estas zapatillas contienen cómodamente cualquier hinchazón del pie por el esfuerzo.', '1750275831_08a660941ad72ab8e6a4.jpg', '2025-06-18 16:43:51.579915');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_sizes`
--
-- Creación: 18-06-2025 a las 17:09:07
-- Última actualización: 18-06-2025 a las 19:43:51
--

CREATE TABLE `product_sizes` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `stock` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `product_sizes`:
--   `product_id`
--       `products` -> `id`
--   `size_id`
--       `sizes` -> `id`
--

--
-- Volcado de datos para la tabla `product_sizes`
--

INSERT INTO `product_sizes` (`id`, `product_id`, `size_id`, `stock`) VALUES
(1, 1, 1, 0),
(2, 1, 2, 0),
(3, 1, 3, 2),
(4, 1, 4, 2),
(5, 2, 1, 4),
(6, 2, 2, 2),
(7, 2, 4, 1),
(8, 2, 3, 2),
(9, 3, 1, 3),
(10, 3, 3, 4),
(11, 3, 4, 5),
(12, 3, 5, 3),
(13, 3, 2, 7),
(14, 4, 1, 7),
(15, 4, 5, 4),
(16, 4, 3, 7),
(17, 4, 4, 3),
(18, 4, 2, 2),
(19, 5, 1, 3),
(20, 5, 3, 4),
(21, 5, 2, 0),
(22, 6, 1, 7),
(23, 6, 5, 10),
(24, 6, 6, 6),
(25, 6, 3, 1),
(26, 7, 1, 5),
(27, 7, 5, 6),
(28, 7, 6, 4),
(29, 7, 3, 8),
(30, 8, 1, 5),
(31, 8, 2, 6),
(32, 8, 5, 12),
(33, 8, 6, 1),
(34, 8, 3, 0),
(35, 13, 2, 12),
(36, 13, 1, 10),
(37, 13, 6, 3),
(38, 13, 5, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sizes`
--
-- Creación: 18-06-2025 a las 17:09:07
-- Última actualización: 18-06-2025 a las 19:22:10
--

CREATE TABLE `sizes` (
  `id` int(11) NOT NULL,
  `size_label` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `sizes`:
--

--
-- Volcado de datos para la tabla `sizes`
--

INSERT INTO `sizes` (`id`, `size_label`) VALUES
(1, '8'),
(2, '7'),
(3, '11'),
(4, '6'),
(5, '9'),
(6, '10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--
-- Creación: 18-06-2025 a las 17:09:07
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `role` enum('cliente','vendedor','admin') NOT NULL DEFAULT 'cliente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `users`:
--

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`, `role`) VALUES
(5, 'Facundo Ruben Boutron Angeloff', 'martinbosch1996@gmail.com', '$2y$10$O8kGfSqaXPyuhHPHezwaW.4tlOsywNVkqmkZBZ4HltL1GVDtdkbpC', '2025-06-17 12:02:13', '2025-06-17 12:02:13', 'cliente'),
(6, 'Admin Sanchez', 'admin@sneakers.com', '$2y$10$qJO8lsib0NOP0VYhU4TxIeqNN1UVdfYW/xflAl6tJu2DsYXmpSavG', '2025-06-17 12:05:06', '2025-06-17 12:05:06', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_product_size` (`user_id`,`product_id`,`size_id`),
  ADD KEY `cart_ibfk_2` (`product_id`),
  ADD KEY `cart_ibfk_3` (`size_id`);

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_2` (`user_id`);

--
-- Indices de la tabla `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_id` (`order_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `products_ibfk_1` (`brand_id`);

--
-- Indices de la tabla `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_id` (`product_id`,`size_id`),
  ADD KEY `size_id` (`size_id`);

--
-- Indices de la tabla `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_3` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD CONSTRAINT `product_sizes_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_sizes_ibfk_2` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;


--
-- Metadatos
--
USE `phpmyadmin`;

--
-- Metadatos para la tabla brands
--

--
-- Metadatos para la tabla cart
--

--
-- Metadatos para la tabla categories
--

--
-- Metadatos para la tabla orders
--

--
-- Metadatos para la tabla order_items
--

--
-- Metadatos para la tabla products
--

--
-- Volcado de datos para la tabla `pma__table_uiprefs`
--

INSERT INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
('root', 'sanchez_galvez', 'products', '{\"CREATE_TIME\":\"2025-06-18 14:09:07\"}', '2025-06-18 19:44:11');

--
-- Metadatos para la tabla product_sizes
--

--
-- Metadatos para la tabla sizes
--

--
-- Metadatos para la tabla users
--

--
-- Metadatos para la base de datos sanchez_galvez
--
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
