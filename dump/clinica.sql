-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-03-2021 a las 10:08:27
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
  `category` int(9) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_published` datetime DEFAULT NULL,
  `date_modifiqued` datetime DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL,
  `author` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `articles`
--

INSERT INTO `articles` (`id`, `category`, `title`, `subtitle`, `text`, `image`, `date_created`, `date_published`, `date_modifiqued`, `enabled`, `author`) VALUES
(1, 1, 'Article example - title', 'Article example - subtitle', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>\r\n', 'shutterstock-696x46461.jpg', '2021-03-08 09:57:32', '2021-03-08 10:07:32', NULL, 1, 2);

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
  `text` varchar(56) DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `blocks`
--

INSERT INTO `blocks` (`id`, `id_page`, `name`, `label`, `order_n`, `title`, `subtitle`, `text`, `enabled`) VALUES
(1, 1, 'we-do-section', 'section', 0, NULL, NULL, NULL, 0),
(2, 5, 'about-more-section', 'Mapa Web', 9, 'about-more-section-title', 'about-more-section-subtitle', 'about-more-section-text', 1),
(3, 3, 'schedule-section', 'Gestión de Citas', 9, 'schedule-section-title', 'schedule-section-subtitle', 'schedule-section-text', 1),
(4, 1, 'service-section', 'Especialidades', 3, 'service-section-title', 'service-section-subtitle', 'service-section-text', 1),
(6, 6, 'interventions', 'Intervenciones', 9, NULL, NULL, NULL, 1),
(7, 2, 'login-block', 'Login', 9, NULL, NULL, NULL, 1),
(8, 1, 'about-section', 'Sobre Nosotros', 2, 'about-section-title', 'about-section-subtitle', 'about-section-text', 1),
(9, 1, 'testimonial-section', 'Testimonios', 7, 'testimonial-section-title', 'testimonial-section-subtitle', 'testimonial-section-text', 1),
(10, 1, 'faq-section', 'Faq', 8, 'faq-section-title', 'faq-section-subtitle', 'faq-section-text', 1),
(11, 1, 'team-section', 'Equipo', 4, 'team-section-title', 'team-section-subtitle', 'team-section-text', 1),
(12, 1, 'subscribe-section', 'Suscríbete', 0, NULL, NULL, NULL, 0),
(13, 1, 'blog-section', 'Novedades', 5, 'blog-section-title', 'blog-section-subtitle', 'blog-section-text', 1),
(14, 1, 'contact-section', 'Contacto', 6, 'contact-section-title', 'contact-section-subtitle', 'contact-section-text', 1),
(15, 1, 'slider-section', 'Carrusel', 1, NULL, NULL, NULL, 1),
(16, 7, 'budget-section', 'Presupuestos', 9, 'budget-section-title', 'budget-client-subtitle', 'budget-section-text', 1),
(17, 8, 'register-section', 'Registro', 1, 'register-section-title', 'register-section-subtitle', 'register-section-text', 1),
(18, 4, 'article-section', 'article-section', 1, 'article-section-title', 'article-section-subtitle', 'article-section-text', 1),
(19, 9, 'profile-section', 'Perfil', 1, 'profile-section-title', 'profile-section-subtitle', 'profile-section-text', 1),
(20, 10, 'team-member-section', 'team-member-section', 1, 'team-member-section-title', 'team-member-section-subtitle', 'team-member-section-text', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `budgets`
--

CREATE TABLE `budgets` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `customer_id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `discount` float NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `budgets_treatments`
--

CREATE TABLE `budgets_treatments` (
  `id` int(11) NOT NULL,
  `id_budget` int(11) NOT NULL,
  `id_treatments` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `budgets_treatments`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'news'),
(2, 'about');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cites`
--

CREATE TABLE `cites` (
  `id` int(9) NOT NULL,
  `date` date NOT NULL,
  `time_from` time NOT NULL,
  `time_until` time NOT NULL,
  `user_id` int(9) NOT NULL,
  `id_treatments` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `response` text NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `faq`
--

INSERT INTO `faq` (`id`, `question`, `response`, `enabled`) VALUES
(1, 'FAQ Question example', 'Response example', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `images`
--

CREATE TABLE `images` (
  `id` int(8) NOT NULL,
  `name` varchar(255) NOT NULL,
  `src` varchar(255) NOT NULL,
  `alt` varchar(255) NOT NULL,
  `dir` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `images`
--

INSERT INTO `images` (`id`, `name`, `src`, `alt`, `dir`) VALUES
(763, 'David', 'testimonial-125.png', 'David', NULL),
(764, 'Doctor Pedro Sánchez', 'team-363.png', 'Pedro Sanchez', NULL),
(768, 'Obturaciones', 'Obturaciones42.png', 'Obturaciones', NULL),
(769, 'Tratamiento endodóntico', 'Tratamiento_endodontico64.png', 'Endodóntico', NULL),
(770, 'Blanqueamiento', 'Blanqueamiento15.png', 'Blanqueamiento', NULL),
(771, 'Carillas dentales', 'Carillas_dentales39.png', 'Carillas dentales', NULL),
(772, 'Coronas de circonio', 'Coronas_circonio13.png', 'Coronas de circonio', NULL),
(773, 'Brackets estéticos', 'Brackets_esteticos78.png', 'Brackets estéticos', NULL),
(774, 'Sistema Damon', 'Sistema_damon26.png', 'Sistema Damon', NULL),
(775, 'Invisalign', 'Invisalign76.png', 'Invisalign', NULL),
(776, 'Implantes dentales', 'Implantes_dentales91.png', 'Implantes dentales', NULL),
(777, 'Extracción de cordales', 'Extraccion_cordales8.png', 'Extracción de cordales', NULL),
(778, 'Regeneración ósea', 'Regeneracion_osea20.png', 'Regeneración', NULL),
(779, 'Pulpotomía ', 'Pulpotomia81.png', 'Pulpotomía ', NULL),
(780, 'Mantenedores de espacio', 'mantenedores_espacio79.png', 'Mantenedores de espacio', NULL),
(783, 'Mujer dentista', 'shutterstock-696x46461.jpg', 'Mujer', NULL);

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
(4, 'ARTICLE', '2021-01-11 08:37:54', 1),
(5, 'ABOUTMORE', '2021-01-29 19:45:07', 1),
(6, 'SPECIALITIE', '2021-01-30 19:00:49', 1),
(7, 'BUDGET', '2021-02-22 10:20:53', 1),
(8, 'REGISTER', '2021-02-23 17:29:59', 1),
(9, 'PROFILE', '2021-03-04 18:08:49', 1),
(10, 'TEAM', '2021-03-07 01:39:27', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `professionals`
--

CREATE TABLE `professionals` (
  `id` int(3) NOT NULL,
  `image` varchar(150) NOT NULL,
  `info` text NOT NULL,
  `tr` varchar(15) DEFAULT NULL,
  `name` varchar(150) NOT NULL,
  `degree` varchar(150) NOT NULL,
  `job` varchar(150) NOT NULL,
  `enabled` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `professionals`
--

INSERT INTO `professionals` (`id`, `image`, `info`, `tr`, `name`, `degree`, `job`, `enabled`) VALUES
(1, 'team-363.png', 'Info Text Example', 'Dr.', 'FirstName LastName', 'Degree', 'Job', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `settings`
--

CREATE TABLE `settings` (
  `id` int(9) NOT NULL,
  `type` varchar(10) NOT NULL,
  `label` varchar(25) NOT NULL,
  `value` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `settings`
--

INSERT INTO `settings` (`id`, `type`, `label`, `value`) VALUES
(1, 'general', 'namesite', 'NameSite'),
(2, 'general', 'urlsite', 'http://clinica.es'),
(3, 'social', 'lni lni-twitter-filled', 'https://twitter.com/user-twitter'),
(4, 'social', 'lni lni-facebook-filled', 'https://facebook.com/user-facebook'),
(5, 'social', 'lni lni-instagram-filled', 'https://www.instagram.com/user'),
(6, 'social', 'lni lni-linkedin-original', 'https://es.linkedin.com/user'),
(7, 'social', 'fab fa-youtube-square', ''),
(8, 'social', 'pinterest_usefa-pinterest', ''),
(9, 'social', 'fab fa-whatsapp-square', ''),
(10, 'email', 'lni lni-envelope', 'email@user.com'),
(12, 'phone', 'lni lni-phone', '666666666'),
(13, 'map', 'location', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d51249.88551714757!2d-6.28643238339175!3d36.599470727418385!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd0dd011d731c25b%3A0x929c66b8e1876e00!2sEl%20Puerto%20de%20Sta%20Mar%C3%ADa%2C%20C%C3%A1diz!5e0!3m2!1ses!2ses!4v1613841399397!5m2!1ses!2ses');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `testimonial`
--

CREATE TABLE `testimonial` (
  `id` int(11) NOT NULL,
  `name` varchar(56) NOT NULL,
  `occupation` varchar(56) NOT NULL,
  `image` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `testimonial`
--

INSERT INTO `testimonial` (`id`, `name`, `occupation`, `image`, `comment`, `enabled`) VALUES
(1, 'LastName FirstName', 'Ocuppation example', 'testimonial-125.png', 'Comment Example', 1);

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
  `info` text NOT NULL,
  `image` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `treatmentsinterventions`
--

INSERT INTO `treatmentsinterventions` (`id`, `name`, `categorie`, `duration`, `price`, `info`, `image`) VALUES
(1, 'Obturacion', 1, 50, 45.00, 'LorYm ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit', 'Obturaciones42.png'),
(2, 'Tratamiento endodóntico', 1, 90, 235.00, 'LoreM ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor', 'Tratamiento_endodontico64.png'),
(3, 'Blanqueamiento', 2, 45, 220.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit ', 'Blanqueamiento15.png'),
(4, 'Carillas dentales', 2, 120, 270.00, 'Las carillas dentales son unas finas láminas de porcelana o composite que se adhieren a la cara visible del diente para mejorar su aspecto estético.\r\n\r\nDebido a su finalidad estética, estas láminas se colocan en la cara vestibular de los dientes frontales, por ser los más visibles cuando sonreímos.\r\n\r\nPor tanto, su objetivo no es el de mejorar la funcionalidad de las piezas dentales, solo el de darles un aspecto más armónico.\r\n\r\nSon elementos que se crean a medida de cada paciente con el fin de que tenga la mayor naturalidad posible al ser colocados junto al resto de dientes.', 'Carillas_dentales39.png'),
(5, 'Coronas de circonio', 2, 140, 700.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit ', 'Coronas_circonio13.png'),
(6, 'Brackets estéticos', 3, 90, 3500.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit', 'Brackets_esteticos78.png'),
(7, 'Sistema damon', 3, 75, 2300.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in repreuptaborum', 'Sistema_damon26.png'),
(8, 'Invisalign', 3, 45, 4780.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in repre voluptate um', 'Invisalign76.png'),
(9, 'Implantes dentales ', 4, 90, 1300.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in vest laborum', 'Implantes_dentales91.png'),
(10, 'Extracción de cordales', 4, 40, 15.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolorhenderit ind est laborum', 'Extraccion_cordales8.png'),
(11, 'Regeneración oseas', 4, 50, 60.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in volu laborum', 'Regeneracion_osea20.png'),
(12, 'Pulpotomía ', 5, 35, 40.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate um', 'Pulpotomia81.png'),
(13, 'Mantenedores de espacio', 5, 40, 90.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit iid est laborum', 'mantenedores_espacio79.png'),
(29, 'Estudio', 5, 30, 30.00, 'Analizamos el crecimiento y formación dentaria de niños menores de 16 años, elaborando un exhaustivo informe sobre el estado y las incidencias con mayor probabilidad ', 'Pulpotomia81.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `confirmKey` varchar(15) NOT NULL,
  `pass` varchar(50) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `roles` varchar(100) DEFAULT '[USER]',
  `auth_key` varchar(100) DEFAULT NULL,
  `lang` varchar(2) NOT NULL DEFAULT 'es',
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(256) DEFAULT NULL,
  `postalcode` varchar(5) DEFAULT NULL,
  `city` varchar(56) DEFAULT NULL,
  `province` varchar(56) DEFAULT NULL,
  `phone` varchar(9) DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `confirmKey`, `pass`, `last_login`, `roles`, `auth_key`, `lang`, `firstname`, `lastname`, `email`, `address`, `postalcode`, `city`, `province`, `phone`, `enabled`) VALUES
(2, 'admin', '', '21232f297a57a5a743894a0e4a801fc3', '2021-03-08 08:55:46', '[ADMIN-USER]', '', 'es', 'admin', 'admin', 'admin@sonriseclinic.es', '', '', '', '', '', 1);

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
-- Indices de la tabla `blocks`
--
ALTER TABLE `blocks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `budgets`
--
ALTER TABLE `budgets`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `budgets_treatments`
--
ALTER TABLE `budgets_treatments`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cites`
--
ALTER TABLE `cites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_treatments` (`id_treatments`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `faq`
--
ALTER TABLE `faq`
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
-- Indices de la tabla `professionals`
--
ALTER TABLE `professionals`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `testimonial`
--
ALTER TABLE `testimonial`
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
-- AUTO_INCREMENT de la tabla `blocks`
--
ALTER TABLE `blocks`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `budgets`
--
ALTER TABLE `budgets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `budgets_treatments`
--
ALTER TABLE `budgets_treatments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `cites`
--
ALTER TABLE `cites`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `images`
--
ALTER TABLE `images`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=785;

--
-- AUTO_INCREMENT de la tabla `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `professionals`
--
ALTER TABLE `professionals`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `testimonial`
--
ALTER TABLE `testimonial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `treatmentscategories`
--
ALTER TABLE `treatmentscategories`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `treatmentsinterventions`
--
ALTER TABLE `treatmentsinterventions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

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
