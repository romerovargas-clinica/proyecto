-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-01-2021 a las 14:10:38
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `clinica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articles`
--

CREATE TABLE `articles` (
  `id` int(9) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_published` datetime DEFAULT NULL,
  `date_modifiqued` datetime DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL,
  `author` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `articles`
--

INSERT INTO `articles` (`id`, `title`, `subtitle`, `text`, `date_created`, `date_published`, `date_modifiqued`, `enabled`, `author`) VALUES
(1, '#1 Hola, Mundo!', 'Un subtítulo de muestra, para un artículo de muestra', '<hr />\r\n<p>[IMG:754f4263]Voluptatem alias neque eum labore, soluta officiis eaque et officia porro quibusdam dicta eius voluptate. Ex rem assumenda ea a corporis mollitia quis illo modi sapiente nulla laboriosam, tenetur quaerat. <strong>Vitae in laborum atque</strong>. Eius accusamus, et voluptates, doloribus facere, mollitia ipsa necessitatibus recusandae optio soluta quae rem tempora eum labore consequuntur ea eveniet nisi quidem omnis. Autem, possimus tempora.</p>\r\n', '2021-01-02 06:40:27', '2021-01-02 06:40:27', NULL, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `block`
--

CREATE TABLE `block` (
  `id` int(9) NOT NULL,
  `name` varchar(56) NOT NULL,
  `description` varchar(256) NOT NULL,
  `label#01` varchar(256) NOT NULL,
  `num#1` int(9) DEFAULT NULL,
  `label#02` varchar(256) DEFAULT NULL,
  `num#2` int(9) DEFAULT NULL,
  `label#03` varchar(256) DEFAULT NULL,
  `num#3` int(9) DEFAULT NULL,
  `label#04` varchar(256) DEFAULT NULL,
  `num#4` int(9) DEFAULT NULL,
  `label#05` varchar(256) DEFAULT NULL,
  `num#5` int(9) DEFAULT NULL,
  `label#06` varchar(256) DEFAULT NULL,
  `text#1` varchar(56) DEFAULT NULL,
  `label#0` varchar(256) DEFAULT NULL,
  `text#2` varchar(56) DEFAULT NULL,
  `label#08` varchar(256) DEFAULT NULL,
  `text#3` varchar(56) DEFAULT NULL,
  `label#09` varchar(256) DEFAULT NULL,
  `text#4` varchar(56) DEFAULT NULL,
  `label#10` varchar(256) DEFAULT NULL,
  `text#5` varchar(56) DEFAULT NULL,
  `css` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `block`
--

INSERT INTO `block` (`id`, `name`, `description`, `label#01`, `num#1`, `label#02`, `num#2`, `label#03`, `num#3`, `label#04`, `num#4`, `label#05`, `num#5`, `label#06`, `text#1`, `label#0`, `text#2`, `label#08`, `text#3`, `label#09`, `text#4`, `label#10`, `text#5`, `css`) VALUES
(1, 'Novedades', 'Listado de artículos que aparecen en portada', 'num_max_articles', 3, 'truncate_text', 1, 'truncate_lenght', 56, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'carousel#1', 'Carrusel de imagenes que aparecen en portada', 'num_images', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'imagen1', 'doctor-563429_640.jpg', 'imagen2', 'chair-2589771_640.jpg', 'imagen3', 'chair-2584260_640.jpg', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `blocks`
--

CREATE TABLE `blocks` (
  `id` int(9) NOT NULL,
  `id_page` int(9) NOT NULL,
  `name` varchar(56) NOT NULL,
  `block` varchar(56) NOT NULL,
  `order_n` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `blocks`
--

INSERT INTO `blocks` (`id`, `id_page`, `name`, `block`, `order_n`) VALUES
(1, 1, 'carousel#1', 'carousel', 1),
(2, 1, 'Novedades', 'articles', 2),
(3, 3, 'schedule', 'schedule', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config`
--

CREATE TABLE `config` (
  `id` int(9) NOT NULL,
  `type` varchar(10) NOT NULL,
  `label` varchar(25) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `config`
--

INSERT INTO `config` (`id`, `type`, `label`, `value`) VALUES
(1, 'general', 'namesite', 'SonriseClinic'),
(2, 'general', 'urlsite', 'https://clinica.com'),
(3, 'social', 'fab fa-twitter-square', 'https://twitter.com/sonriseclinic'),
(4, 'social', 'fab fa-facebook-square', 'https://facebook.com/sonriseclinic'),
(5, 'social', 'fab fa-instagram-square', 'Imstagrammer'),
(6, 'social', 'fab fa-google-plus-square', ''),
(7, 'social', 'fab fa-youtube-square', ''),
(8, 'social', 'pinterest_usefa-pinterest', ''),
(9, 'social', 'fab fa-whatsapp-square', ''),
(10, 'email', 'fas fa-envelope-square', 'admin@sonriseclinic.es');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `content`
--

CREATE TABLE `content` (
  `id` int(11) NOT NULL,
  `label` varchar(15) NOT NULL,
  `content` text NOT NULL,
  `last_modify` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `images`
--

CREATE TABLE `images` (
  `id` varchar(8) NOT NULL,
  `src` varchar(255) NOT NULL,
  `alt` varchar(255) NOT NULL,
  `style` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `images`
--

INSERT INTO `images` (`id`, `src`, `alt`, `style`) VALUES
('754f4263', '../../images/uploads/compartecoche.png', '', 'float:left; height:32px; width:32px');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pages`
--

CREATE TABLE `pages` (
  `id` int(9) NOT NULL,
  `page` varchar(56) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `enabled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pages`
--

INSERT INTO `pages` (`id`, `page`, `created`, `enabled`) VALUES
(1, 'HOME', '2021-01-01 07:01:12', 1),
(2, 'LOGIN', '2021-01-02 07:01:12', 1),
(3, 'CITES', '2021-01-09 13:35:36', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `roles` varchar(100) DEFAULT '[USER]',
  `auth_key` varchar(100) DEFAULT NULL,
  `lang` varchar(2) NOT NULL DEFAULT 'es',
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `pass`, `last_login`, `roles`, `auth_key`, `lang`, `firstname`, `lastname`, `email`, `enabled`) VALUES
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3', '2021-01-02 08:44:05', '[ADMIN-USER]', '0e7d77e86a861b5636eb2291b802c21d', 'es', 'admin', 'admin', 'admin@sonriseclinic.es', 1),
(3, 'david', '81dc9bdb52d04dc20036dbd8313ed055', '2021-01-09 13:37:44', '[CUSTOMER]', '', 'en', 'David Antonio', 'Bermúdez Moreno', 'davidbermudezmoreno@fp.iesromerovargas.com', 1),
(4, 'cintia', '81dc9bdb52d04dc20036dbd8313ed055', NULL, '[AUTHOR]', NULL, 'es', 'Cintia', 'Cabrera Gamaza', 'cintiacabreragamaza@fp.iesromerovargas.com', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author` (`author`);

--
-- Indices de la tabla `block`
--
ALTER TABLE `block`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `blocks`
--
ALTER TABLE `blocks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `images`
--
ALTER TABLE `images`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`,`email`),
  ADD KEY `user_id_IDX` (`id`) USING BTREE,
  ADD KEY `user_email_IDX` (`email`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `block`
--
ALTER TABLE `block`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `blocks`
--
ALTER TABLE `blocks`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `config`
--
ALTER TABLE `config`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `content`
--
ALTER TABLE `content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`author`) REFERENCES `users` (`id`) ON DELETE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
