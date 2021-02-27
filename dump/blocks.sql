-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-02-2021 a las 20:16:37
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
-- Estructura de tabla para la tabla `blocks`
--

CREATE TABLE `blocks` (
  `id` int(9) NOT NULL,
  `id_page` int(9) NOT NULL,
  `name` varchar(56) NOT NULL,
  `label` varchar(56) DEFAULT NULL,
  `order_n` int(9) NOT NULL,
  `title` varchar(56) DEFAULT NULL,
  `subtitle` varchar(56) DEFAULT NULL,
  `text` varchar(56) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `blocks`
--

INSERT INTO `blocks` (`id`, `id_page`, `name`, `label`, `order_n`, `title`, `subtitle`, `text`) VALUES
(1, 1, 'we-do-section', 'section', 9, NULL, NULL, NULL),
(2, 5, 'about-more-section', 'Mapa Web', 9, 'about-more-section-title', 'about-more-section-subtitle', 'about-more-section-text'),
(3, 3, 'schedule-section', 'Gestión de Citas', 9, 'schedule-section-title', 'schedule-section-subtitle', 'schedule-section-text'),
(4, 1, 'service-section', 'Especialidades', 9, 'service-section-title', 'service-section-subtitle', 'service-section-text'),
(6, 6, 'interventions', 'Intervenciones', 9, NULL, NULL, NULL),
(7, 2, 'login-block', 'Login', 9, NULL, NULL, NULL),
(8, 1, 'about-section', 'Sobre Nosotros', 9, 'about-section-title', 'about-section-subtitle', 'about-section-text'),
(9, 1, 'testimonial-section', 'Testimonios', 9, 'testimonial-section-title', 'testimonial-section-subtitle', 'testimonial-section-text'),
(10, 1, 'faq-section', 'Faq', 9, 'faq-section-title', 'faq-section-subtitle', 'faq-section-text'),
(11, 1, 'team-section', 'Equipo', 9, 'team-section-title', 'team-section-subtitle', 'team-section-text'),
(12, 1, 'subscribe-section', 'Suscríbete', 9, NULL, NULL, NULL),
(13, 1, 'blog-section', 'Novedades', 9, 'blog-section-title', 'blog-section-subtitle', 'blog-section-text'),
(14, 1, 'contact-section', 'Contacto', 9, 'contact-section-title', 'contact-section-subtitle', 'contact-section-text'),
(15, 1, 'slider-section', 'Carrusel', 9, NULL, NULL, NULL),
(16, 7, 'budget-section', 'Presupuestos', 9, 'budget-section-title', 'budget-client-subtitle', 'budget-section-text'),
(17, 8, 'register-section', 'Registro', 9, 'register-section-title', 'register-section-subtitle', 'register-section-text');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `blocks`
--
ALTER TABLE `blocks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `blocks`
--
ALTER TABLE `blocks`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
