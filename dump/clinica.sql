-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: mysqlc
-- Tiempo de generación: 29-12-2020 a las 16:41:18
-- Versión del servidor: 5.7.28
-- Versión de PHP: 7.4.13

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
  `date_created` datetime NOT NULL,
  `date_published` datetime NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `author` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config`
--

CREATE TABLE `config` (
  `id` int(9) NOT NULL,
  `label` varchar(25) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `config`
--

INSERT INTO `config` (`id`, `label`, `value`) VALUES
(1, 'namesite', 'SonriseClinic'),
(2, 'urlsite', 'http://clinica.com');

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
  `enabled` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `pass`, `last_login`, `roles`, `auth_key`, `lang`, `firstname`, `lastname`, `email`, `enabled`) VALUES
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3', '2020-12-29 03:43:04', '[ADMIN-USER]', '', 'es', 'admin', 'admin', 'admin@sonriseclinic.es', 1),
(3, 'david', '81dc9bdb52d04dc20036dbd8313ed055', '2020-12-29 03:17:20', '[AUTHOR]', '', 'es', 'David', 'Bermúdez', 'davidbermudezmoreno@fp.iesromerovargas.com', 1),
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
-- AUTO_INCREMENT de la tabla `config`
--
ALTER TABLE `config`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `content`
--
ALTER TABLE `content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
