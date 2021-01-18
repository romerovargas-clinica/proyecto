-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-01-2021 a las 08:28:49
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
(2, 'carousel#1', 'Carrusel de imagenes que aparecen en portada', 'num_images', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'imagen1', 'doctor-563429_640.jpg', 'imagen2', 'chair-2589771_640.jpg', 'imagen3', 'chair-2584260_640.jpg', NULL, NULL, NULL, NULL, NULL),
(3, 'Especialidades', 'Bloque de presentación de las especialidades médicas', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
(3, 3, 'schedule', 'schedule', 1),
(4, 1, 'Especialidades', 'specialties', 3);

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
  `name` varchar(255) NOT NULL,
  `src` varchar(255) NOT NULL,
  `alt` varchar(255) NOT NULL,
  `style` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `images`
--

INSERT INTO `images` (`id`, `name`, `src`, `alt`, `style`) VALUES
('754f4263', 'autobus', '../../images/uploads/compartecoche.png', '', 'float:left; height:32px; width:32px');

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
(3, 'CITES', '2021-01-09 13:35:36', 1),
(4, 'ARTICLE', '2021-01-11 08:37:54', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `settings`
--

CREATE TABLE `settings` (
  `id` int(9) NOT NULL,
  `type` varchar(10) NOT NULL,
  `label` varchar(25) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `settings`
--

INSERT INTO `settings` (`id`, `type`, `label`, `value`) VALUES
(1, 'general', 'namesite', 'SonriseClinic3'),
(2, 'general', 'urlsite', 'http://clinica.es'),
(3, 'social', 'fab fa-twitter-square', 'https://twitter.com/sonriseclinic'),
(4, 'social', 'fab fa-facebook-square', 'https://facebook.com/sonriseclinic'),
(5, 'social', 'fab fa-instagram-square', 'Instagrammer'),
(6, 'social', 'fab fa-google-plus-square', ''),
(7, 'social', 'fab fa-youtube-square', ''),
(8, 'social', 'pinterest_usefa-pinterest', ''),
(9, 'social', 'fab fa-whatsapp-square', ''),
(10, 'email', 'fas fa-envelope-square', 'admin@sonriseclinic.es');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `treatmentscategories`
--

CREATE TABLE `treatmentscategories` (
  `id` int(1) NOT NULL,
  `name` varchar(100) NOT NULL,
  `info` text NOT NULL,
  `image` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `treatmentscategories`
--

INSERT INTO `treatmentscategories` (`id`, `name`, `info`, `image`) VALUES
(1, 'Odontología conservadora', 'La Odontología Conservadora tiene como objetivo salvar y conservar en la boca del paciente un diente enfermo o dañado, ya sea por caries, desgaste o traumatismo. Comprende, por tanto, todos aquellos tratamientos que tratan de evitar la extracción de la pieza dental y la posterior colocación de un implante.', 'conservadora.jpg'),
(2, 'Estética', 'La Estética Dental es la especialidad de la Odontología que se encarga de mejorar la apariencia de la boca para que tenga un aspecto más armónico y saludable. Para ello, ponemos a disposición de nuestros pacientes los tratamientos de carillas, blanqueamiento y coronas de zirconio.', 'estetica.jpg'),
(3, 'Ortodoncia', 'La ortodoncia es una especialidad de la odontología que estudia, previene y corrige las alteraciones del desarrollo, las formas de las arcadas dentarias y la posición de los maxilares, con el objetivo de restablecer el equilibrio tanto en forma como en función de la boca y de la cara, mejorando también la estética', 'ortodoncia.jpg'),
(4, 'Cirugía', 'La cirugía bucal es un campo amplio que abarca diferentes tipos de tratamientos. Sin embargo, las técnicas que se llevan a cabo para realizar las intervenciones quirúrgicas son muy similares: requieren anestesia y abordar el procedimiento desde una pequeña incisión en la encía.', 'cirugia.jpg'),
(5, 'Odontopediatría', 'Aunque tu hijo/a no presente problemas de salud oral, es recomendable que acudas con él al odontopediatra cuando cumpla su primer año. De esta manera, el profesional podrá detectar posibles patologías que compremeterían su desarrollo más adelante.', 'odontopediatria.jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `treatmentsinterventions`
--

CREATE TABLE `treatmentsinterventions` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `categorie` int(1) NOT NULL,
  `duration` int(3) NOT NULL,
  `price` float(6,2) NOT NULL,
  `info` varchar(400) NOT NULL,
  `image` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `treatmentsinterventions`
--

INSERT INTO `treatmentsinterventions` (`id`, `name`, `categorie`, `duration`, `price`, `info`, `image`) VALUES
(1, 'Obturacion', 1, 50, 45.00, 'LorYm ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit', 1),
(2, 'Tratamiento endodóntico', 1, 90, 235.00, 'LoreM ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor', 1),
(3, 'Blanqueamiento', 2, 45, 220.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit ', 1),
(4, 'Carillas dentales', 1, 120, 270.00, 'Loremzo ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit', 1),
(5, 'Coronas de circonio', 2, 140, 700.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit ', 1),
(6, 'Brackets estéticos', 3, 90, 3500.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit', 1),
(7, 'Sistema damon', 3, 75, 2300.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in repreuptaborum', 1),
(8, 'Invisalign', 3, 45, 4780.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in repre voluptate um', 1),
(9, 'Implantes dentales ', 4, 90, 1300.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in vest laborum', 1),
(10, 'Extracción de cordales', 4, 40, 15.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolorhenderit ind est laborum', 1),
(11, 'Regeneración osease', 1, 50, 60.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in volu laborum', 1),
(12, 'Pulpotomía ', 5, 35, 40.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate um', 1),
(13, 'Mantenedores de espacio', 5, 40, 90.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit iid est laborum', 1);

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
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3', '2021-01-16 10:01:54', '[ADMIN-USER]', 'da49a0c190f18db1b46a59d41dd04f82', 'es', 'admin', 'admin', 'admin@sonriseclinic.es', 1),
(3, 'david', '81dc9bdb52d04dc20036dbd8313ed055', '2021-01-09 13:37:44', '[CUSTOMER]', '', 'en', 'David', 'Bermúdez Moreno', 'davidbermudezmoreno@fp.iesromerovargas.com', 1),
(4, 'cintia', '81dc9bdb52d04dc20036dbd8313ed055', '2021-01-09 15:06:52', '[AUTHOR]', NULL, 'es', 'Cintia probando', 'Cabrera Gamaza', 'cintiacabreragamaza@fp.iesromerovargas.com', 1);

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
-- Indices de la tabla `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `treatmentscategories`
--
ALTER TABLE `treatmentscategories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `treatmentsinterventions`
--
ALTER TABLE `treatmentsinterventions`
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
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `blocks`
--
ALTER TABLE `blocks`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `content`
--
ALTER TABLE `content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
