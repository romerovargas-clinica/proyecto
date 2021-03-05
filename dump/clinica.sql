-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-03-2021 a las 10:31:07
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
(1, 1, 'Este es el título de un artículo', 'Un subtítulo de muestra, para un artículo de muestra', '<p>Voluptatem alias neque eum labore, soluta officiis eaque et officia porro quibusdam dicta eius voluptate. Ex rem assumenda ea a corporis mollitia quis illo modi sapiente nulla laboriosam, tenetur quaerat. <strong>Vitae in laborum atque</strong>. Eius accusamus, et voluptates, doloribus facere, mollitia ipsa necessitatibus recusandae optio soluta quae rem tempora eum labore consequuntur ea eveniet nisi quidem omnis. Autem, possimus tempora.sdf dsfds</p>\r\n\r\n<p><img alt=\"\" src=\"http://clinica.es/images/uploads/compartecoche.png\" style=\"height:354px; width:354px\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>dlskjfldsjf</p>\r\n\r\n<p><img alt=\"\" src=\"http://clinica.es/images/uploads/juanjuanjuan.jpg\" style=\"height:148px; width:185px\" /></p>\r\n\r\n<p>fdlsfjsdlk</p>\r\n', '', '2021-01-02 06:40:27', '2021-01-02 06:40:27', NULL, 1, 2),
(7, 2, 'La Clínica', '', '<p>En SonriseClinic cuidamos tu salud y estética dental utilizando la tecnología más avanzada para lograr los mejores resultados.</p>\r\n\r\n<p>Contamos con un equipo profesionales que harán que por fin consigas sonreír. </p>\r\n\r\n<p>Hoy en día, están en expansión los modelos de Clínicas Dentales, en muchos casos franquicias, las cuales “obligan” al paciente a realizarse costosos tratamientos finalizados en tiempos récords, los cuales a medio plazo fracasan. Fracasan no sólo por los tiempos inadecuados que emplean e ellos, sino también por la incorporación a su plantilla principal de Odontólogos sin experiencia en el campo, además sometidos a usar materiales “low cost”, que en muchas ocasiones acaparan tratamientos de gran envergadura atraídos por la repercusión económica que les aporta sin evaluar si están preparados para realizarlos. Esto deja desamparados a numerosos pacientes que, bien por principios no están dispuestos a ser manejados al antojo de estas clínicas, o por incapacidad económica desisten de realizarse los tratamientos propuestos en estos tipos de clínicas. Son en estos pacientes y en todos los demás en los que volcaremos nuestros esfuerzos para atenderlos de la mejor manera que se merecen.</p>', NULL, '2021-01-29 20:38:54', NULL, NULL, 0, 2),
(8, 2, 'Mensaje del Director', 'Dr. D. Juan Juan Juan', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', NULL, '2021-01-29 21:21:00', NULL, NULL, 1, 2),
(10, 1, 'Este es el título de un artículo', 'Un subtítulo de muestra, para un artículo de muestra', '<p>Voluptatem alias neque eum labore, soluta officiis eaque et officia porro quibusdam dicta eius voluptate. Ex rem assumenda ea a corporis mollitia quis illo modi sapiente nulla laboriosam, tenetur quaerat. <strong>Vitae in laborum atque</strong>. Eius accusamus, et voluptates, doloribus facere, mollitia ipsa necessitatibus recusandae optio soluta quae rem tempora eum labore consequuntur ea eveniet nisi quidem omnis. Autem, possimus tempora.sdf dsfds</p>\r\n\r\n<p><img alt=\"\" src=\"http://clinica.es/images/uploads/compartecoche.png\" style=\"height:354px; width:354px\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>dlskjfldsjf</p>\r\n\r\n<p><img alt=\"\" src=\"http://clinica.es/images/uploads/juanjuanjuan.jpg\" style=\"height:148px; width:185px\" /></p>\r\n\r\n<p>fdlsfjsdlk</p>\r\n', '', '2021-01-02 06:40:27', '2021-01-02 06:40:27', NULL, 1, 2),
(11, 1, 'Este es el título de un artículo', 'Un subtítulo de muestra, para un artículo de muestra', '<p>Voluptatem alias neque eum labore, soluta officiis eaque et officia porro quibusdam dicta eius voluptate. Ex rem assumenda ea a corporis mollitia quis illo modi sapiente nulla laboriosam, tenetur quaerat. <strong>Vitae in laborum atque</strong>. Eius accusamus, et voluptates, doloribus facere, mollitia ipsa necessitatibus recusandae optio soluta quae rem tempora eum labore consequuntur ea eveniet nisi quidem omnis. Autem, possimus tempora.sdf dsfds</p>\r\n\r\n<p><img alt=\"\" src=\"http://clinica.es/images/uploads/compartecoche.png\" style=\"height:354px; width:354px\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>dlskjfldsjf</p>\r\n\r\n<p><img alt=\"\" src=\"http://clinica.es/images/uploads/juanjuanjuan.jpg\" style=\"height:148px; width:185px\" /></p>\r\n\r\n<p>fdlsfjsdlk</p>\r\n', '', '2021-01-02 06:40:27', '2021-01-02 06:40:27', NULL, 1, 2),
(12, 1, 'Este Artículo pretende ser una muestra para poder tener más de tres', 'Este subtitulo acompaña al artículo que pretende ser una muestra para poder tener más de tres', '<p><strong>Ha aumentado la demanda de tratamientos sencillos, como limpiezas y revisiones, mientras que disminuye la de implantes, cirug&iacute;as y est&eacute;tica dental</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>El Observatorio de la Salud Oral (OSOE), puesto en marcha en 2015 por el Consejo General de Dentistas y la Fundaci&oacute;n Dental Espa&ntilde;ola, uno de los pocos que existen en el mundo, ha publicado los resultados del an&aacute;lisis que se ha realizado en el periodo 2015-2019 sobre la salud oral y la profesi&oacute;n de dentista en Espa&ntilde;a.<br />\r\n&nbsp;</p>\r\n\r\n<p>En el estudio ha participado una red de dentistas centinela que han hecho posible la recogida de datos para el OSOE bianualmente. De las encuestas realizadas se extraen varias conclusiones.<br />\r\n<br />\r\n<strong>Pacientes y tratamientos</strong><br />\r\n&nbsp;</p>\r\n\r\n<p>En cuanto al perfil de los pacientes, existe una mayor demanda de tratamientos odontol&oacute;gicos por parte de las mujeres (un 57%), cuando representan el 51% de la poblaci&oacute;n en Espa&ntilde;a. Por el contrario, existe una infra demanda por parte de los pacientes mayores de 65 a&ntilde;os, puesto que solo representan un 15% de los pacientes cuando su peso poblacional es del 21%.<br />\r\n&nbsp;</p>\r\n\r\n<p>En el periodo 2015-2019, se aprecia un incremento del 2-12% de las actividades cl&iacute;nicas m&aacute;s sencillas, como tartrectom&iacute;as (limpiezas dentales), revisiones, tratamientos restauradores y endodoncias. Sin embargo, los tratamientos est&eacute;ticos (blanqueamientos, carillas), cirug&iacute;a oral, prostodoncia e implantes, han disminuido un 18-20%.<br />\r\n&nbsp;</p>\r\n\r\n<p>Situaci&oacute;n de los dentistas<br />\r\n&nbsp;</p>\r\n\r\n<p>Seg&uacute;n los datos obtenidos, los dentistas trabajan un promedio de 120 horas mensuales y atienden a unos 190 pacientes. En este sentido, existe un mayor volumen de trabajo durante el primer semestre del a&ntilde;o. El 76% del tiempo laboral lo emplean en actividades asistenciales, un 13% a tareas administrativas y un 11% a otras actividades, como formaci&oacute;n. As&iacute;, de cada 10 horas de actividad asistencial, 6 se dedican a tratamientos curativos, 2 a actividades preventivas y 2 a revisiones de pacientes.<br />\r\n&nbsp;</p>\r\n\r\n<p>Con relaci&oacute;n a su situaci&oacute;n econ&oacute;mica, un 27% de los dentistas estiman que sus ingresos se redujeron de 2015 a 2019. En 2020, como consecuencia de la pandemia COVID-19, el impacto en los ingresos ser&aacute; muy significativo. El an&aacute;lisis de la encuesta realizada a cerca de 3.000 dentistas espa&ntilde;oles en noviembre de 2020 muestra que 9 de cada 10 dentistas encuestados esperaban una reducci&oacute;n de los ingresos. La cuant&iacute;a esperada de reducci&oacute;n es muy variable, predominando los que la estiman entre un 11-20% (27% de la muestra) y un 21-30% (27%).<br />\r\n<br />\r\nUno de cada 10 dentistas piensa que esta reducci&oacute;n incluso superar&aacute; el 40%. Estas cifras, unidas a la solicitud de ayudas (ERTEs) en cerca del 30% de las cl&iacute;nicas y al hecho de que durante el periodo hayan perdido su trabajo un 3% de los encuestados, muestran el alcance y el impacto de la crisis en la profesi&oacute;n dental.<br />\r\n&nbsp;</p>\r\n\r\n<p>Por &uacute;ltimo, el an&aacute;lisis confirma que las principales preocupaciones de los dentistas encuestados son la pl&eacute;tora profesional, la necesidad de legislar la publicidad sanitaria e incrementar los controles de las cl&iacute;nicas dentales por parte de la Administraci&oacute;n.</p>\r\n', 'juanjuanjuan.jpg', '2021-02-25 18:17:31', '2021-02-25 19:07:44', NULL, 1, 2),
(13, 1, 'Hola', 'Caracola', '&lt;p&gt;asdsadasd sa d&lt;/p&gt;\r\n\r\n&lt;p&gt;as&lt;/p&gt;\r\n\r\n&lt;p&gt;d ad&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;asd&lt;/p&gt;\r\n', '', '2021-02-28 02:36:58', NULL, NULL, 0, 2),
(14, 1, 'Utilizar productos sanitarios destinados al uso exclusivo del facultativo supone un grave riesgo para la salud', 'Muchos influencers promocionan estos productos en sus redes sociales, especialmente, blanqueamientos dentales y ortodoncias', '<p>El Consejo General de Dentistas de Espa&ntilde;a vuelve a advertir a los ciudadanos de los peligros de adquirir determinados productos sanitarios por internet. La Organizaci&oacute;n Colegial lleva a&ntilde;os denunciando ante la AEMPS (Agencia Espa&ntilde;ola del Medicamento y Productos Sanitarios) y ante la Administraci&oacute;n, que algunas p&aacute;ginas web, as&iacute; como plataformas como Amazon y Aliexpress, venden directamente al consumidor art&iacute;culos que solo pueden ser utilizados por profesionales sanitarios y que pueden suponer un riesgo para la salud.</p>\r\n\r\n<p>De hecho, seg&uacute;n el Real Decreto Legislativo 1/2015, de 24 de julio, por el que se aprueba el texto refundido de la Ley de garant&iacute;as y uso racional de los medicamentos y productos sanitarios, &ldquo;se proh&iacute;be la venta, por correspondencia y por procedimientos telem&aacute;ticos, de medicamentos y productos sanitarios sujetos a prescripci&oacute;n&rdquo;. Asimismo, en el art&iacute;culo 80.7 se a&ntilde;ade que &ldquo;no podr&aacute;n ser objeto de publicidad destinada al p&uacute;blico los productos sanitarios que est&eacute;n destinados a ser utilizados o aplicados exclusivamente por profesionales sanitarios.&rdquo;</p>\r\n\r\n<p>El riesgo de estos productos se ve incrementado cuando influencers con miles de seguidores los promocionan en las redes sociales, induciendo a su consumo sin ning&uacute;n tipo de control ni de conocimiento sanitario. Entre ellos, destacan los blanqueamientos dentales con carb&oacute;n activado o productos blanqueadores, as&iacute; como las ortodoncias que prometen resultados visibles en cuesti&oacute;n de d&iacute;as sin necesidad de ir al dentista.</p>\r\n\r\n<p><img alt=\"\" src=\"images/uploads/Obturaciones42.png\" style=\"border-style:solid; border-width:1px; float:left; height:202px; margin-bottom:20px; margin-top:20px; width:300px\" />En este sentido, el Dr. &Oacute;scar Castro Reino, presidente del Consejo General de Dentistas, asegura que el carb&oacute;n activado no blanquea los dientes ni elimina las manchas, por lo que las afirmaciones que lo describen como un producto milagro, son falsas y, por tanto, se trata de publicidad enga&ntilde;osa. &ldquo;La principal caracter&iacute;stica del carb&oacute;n activado es su capacidad abrasiva, es como pasar una lija por los dientes. Desgasta el esmalte y, como consecuencia, queda a la vista la dentina (m&aacute;s amarilla que el propio esmalte), aumenta la sensibilidad dental y puede da&ntilde;ar las enc&iacute;as&rdquo;, declara el Dr. Castro.</p>\r\n\r\n<p>En cuanto al blanqueamiento dental, explica que se trata de un proceso sanitario que debe ser realizado por un dentista o bajo su supervisi&oacute;n, puesto que previamente hay que descartar cualquier patolog&iacute;a bucodental del paciente.&nbsp;&nbsp;</p>\r\n\r\n<p>Las mol&eacute;culas m&aacute;s utilizadas por los laboratorios para este tratamiento son el per&oacute;xido de hidr&oacute;geno (en concentraciones entre el 0,1 y el 12%) y el per&oacute;xido de carbamida (entre el 16 y 32%). Y, seg&uacute;n el Real Decreto 1599/1997, de 17 de octubre, por el que se regulan los productos cosm&eacute;ticos:</p>\r\n\r\n<p>Una concentraci&oacute;n &le;0,1% de pe&shy;r&oacute;xido de hidr&oacute;geno, presente en los productos bucales o liberada de otros compuestos o mezclas en esos produc&shy;tos se considera segura. Pero sus efectos son m&iacute;nimos, en ocasiones, ni siquiera apreciables. De nuevo, en muchos casos, podr&iacute;a tratarse de publicidad enga&ntilde;osa&rdquo;, apunta el Dr. Castro.<br />\r\nEn concentraciones &gt;0,1 y &le;6% de per&oacute;xido de hidr&oacute;geno, se con&shy;sidera que estos productos pueden ser seguros siempre y cuando se cumplan las siguientes condiciones: que se realice un examen cl&iacute;nico ade&shy;cuado para garantizar que no exis&shy;ten factores de riesgo en la utilizaci&oacute;n en el paciente de estos productos; que la venta de los productos con estas concentraciones de per&oacute;xido de hidr&oacute;&shy;geno quede restringida exclusivamente a los dentistas, y que no se utilicen en menores de 18 a&ntilde;os.<br />\r\nEn concentraciones superiores al 6%, ya no se consideran productos cosm&eacute;ticos sino &ldquo;Productos de Cuidado Personal&rdquo;. La AEMPS limita su uso de la siguiente forma:<br />\r\n- La distribuci&oacute;n de estos productos ser&aacute; exclusiva a dentistas (odont&oacute;logos/es&shy;tomat&oacute;logos).</p>\r\n', 'Blanqueamiento15.png', '2021-02-28 02:40:32', '2021-02-28 03:40:46', NULL, 1, 2);

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
(4, 1, 'service-section', 'Especialidades', 4, 'service-section-title', 'service-section-subtitle', 'service-section-text', 1),
(6, 6, 'interventions', 'Intervenciones', 9, NULL, NULL, NULL, 1),
(7, 2, 'login-block', 'Login', 9, NULL, NULL, NULL, 1),
(8, 1, 'about-section', 'Sobre Nosotros', 2, 'about-section-title', 'about-section-subtitle', 'about-section-text', 1),
(9, 1, 'testimonial-section', 'Testimonios', 3, 'testimonial-section-title', 'testimonial-section-subtitle', 'testimonial-section-text', 1),
(10, 1, 'faq-section', 'Faq', 7, 'faq-section-title', 'faq-section-subtitle', 'faq-section-text', 1),
(11, 1, 'team-section', 'Equipo', 6, 'team-section-title', 'team-section-subtitle', 'team-section-text', 1),
(12, 1, 'subscribe-section', 'Suscríbete', 0, NULL, NULL, NULL, 0),
(13, 1, 'blog-section', 'Novedades', 5, 'blog-section-title', 'blog-section-subtitle', 'blog-section-text', 1),
(14, 1, 'contact-section', 'Contacto', 8, 'contact-section-title', 'contact-section-subtitle', 'contact-section-text', 1),
(15, 1, 'slider-section', 'Carrusel', 1, NULL, NULL, NULL, 1),
(16, 7, 'budget-section', 'Presupuestos', 9, 'budget-section-title', 'budget-client-subtitle', 'budget-section-text', 1),
(17, 8, 'register-section', 'Registro', 1, 'register-section-title', 'register-section-subtitle', 'register-section-text', 1),
(18, 4, 'article-section', 'article-section', 1, 'article-section-title', 'article-section-subtitle', 'article-section-text', 1),
(19, 9, 'profile-section', 'Perfil', 1, 'profile-section-title', 'profile-section-subtitle', 'profile-section-text', 1);

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

--
-- Volcado de datos para la tabla `budgets`
--

INSERT INTO `budgets` (`id`, `date`, `customer_id`, `amount`, `discount`, `enabled`) VALUES
(7, '2021-03-11', 39, 455, 10, 1),
(9, '2021-03-26', 40, 1865, 15, 1);

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

INSERT INTO `budgets_treatments` (`id`, `id_budget`, `id_treatments`) VALUES
(1, 6, 2),
(2, 6, 4),
(3, 7, 2),
(4, 7, 3),
(7, 9, 9),
(8, 9, 10),
(9, 9, 11),
(10, 9, 3),
(11, 9, 4);

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

--
-- Volcado de datos para la tabla `cites`
--

INSERT INTO `cites` (`id`, `date`, `time_from`, `time_until`, `user_id`, `id_treatments`) VALUES
(7, '2021-03-04', '12:30:00', '15:00:00', 4, 2),
(8, '2021-03-04', '15:00:00', '15:45:00', 4, 3),
(9, '2021-03-04', '09:30:00', '11:45:00', 3, 7);

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
(1, '¿Dónde se encuentra la clínica?', 'Nuestra ubicación es C/ XXXX, nº XX de la localidad de El Puerto de Santa María. En la parte inferior de la página podrás ver un mapa con la localización exacta.', 1),
(2, '¿Se aceptan pacientes de mutuas y sanidad privada?', 'Por supuesto. En la actualidad mantenemos convenios con ASISA, ADESLAS y SANITAS para la atención preferencial de sus afiliados en nuestra clínica', 1),
(3, '¿Participan en el programa de salud dental infantil?', 'Los niños hasta 9 años que se acojan al plan de salud dental infantil aprobado por la Junta de Andalucía tendrán asistencia gratuita en odontología y odontopediatría.', 1);

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
(755, 'Director', 'juanjuanjuan.jpg', 'director', 'uploads'),
(761, 'Juan Jesus Bernal Garcia', 'team-152.png', 'Juan Jesus', NULL),
(762, 'Ana Bernal García', 'team-2100.png', 'Ana Bernal', NULL),
(763, 'David', 'testimonial-125.png', 'David', NULL),
(764, 'Doctor Pedro Sánchez', 'team-363.png', 'Pedro Sanchez', NULL),
(765, 'Dra. Isabel Muñoz', 'team-413.png', 'Isabel Muñoz', NULL),
(766, 'Personas Anónimas 1', 'testimonial-286.png', 'anonimo', NULL),
(767, 'Personas Anónimas 2', 'testimonial-352.png', 'Anonimas 2', NULL),
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
(780, 'Mantenedores de espacio', 'mantenedores_espacio79.png', 'Mantenedores de espacio', NULL);

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
(9, 'PROFILE', '2021-03-04 18:08:49', 1);

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
(1, 'team-152.png', 'Dr. Juan es el Director de SonriseClinic con una amplia experiencia en el tratamiento de las correcciones.', 'Dr.', 'Juan Jesús Bernal García', 'Ortodentista', 'Director', 1),
(3, 'team-2100.png', 'La Doctora Dª. Ana Bernal se ha formado en el prestigioso Institute Dental of Massachusetts adquiriendo una experiencia inmejorable en las intervenciones quirúrgicas y de corrección maxilofacial que realizamos en nuestra propia clínica con las máximas garantías.', 'Dra.', 'Ana Bernal García', 'Cirujía maxilofacial', 'Quirófano', 1);

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

--
-- Volcado de datos para la tabla `register`
--

INSERT INTO `register` (`id`, `name`, `email`, `password`, `number`, `address`, `modified_on`) VALUES
(1, 'david', 'davidbermudez@jerez.es', '1234', '987', '987', '2021-01-22 10:18:02'),
(2, 'pepe', 'pepe@pepe.es', '1234', '32132', '321321', '2021-01-22 10:19:02');

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
(1, 'general', 'namesite', 'SonriseClinic3'),
(2, 'general', 'urlsite', 'http://clinica.es'),
(3, 'social', 'lni lni-twitter-filled', 'https://twitter.com/sonriseclinic'),
(4, 'social', 'lni lni-facebook-filled', 'https://facebook.com/sonriseclinic'),
(5, 'social', 'lni lni-instagram-filled', 'https://www.instagram.com/sonriseClinic/'),
(6, 'social', 'lni lni-linkedin-original', 'https://es.linkedin.com/sonriseClinic'),
(7, 'social', 'fab fa-youtube-square', ''),
(8, 'social', 'pinterest_usefa-pinterest', ''),
(9, 'social', 'fab fa-whatsapp-square', ''),
(10, 'email', 'lni lni-envelope', 'admin@sonriseclinic.es'),
(11, 'chat', 'response_bot', 'Keep waiting. An operator will briefly contact you.'),
(12, 'phone', 'lni lni-phone', '956875858'),
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
(1, 'David Bermudez', 'Funcionario', 'testimonial-125.png', 'Una clínica espectacular en cuanto a organización y equipamiento con los mejores profesionales que he conocido. A partir de ahora recomendaré SonriseClinic a familia y amigos. Gracias', 1),
(2, 'Cintia Cabrera', 'Estudiante', 'team-2100.png', 'Pues a mi no me gusta nada!!', 1),
(3, 'John Smith', 'Asesor Fiscal', 'testimonial-286.png', 'Yo sólo quería que me sacasen una muela, pero salí sin muela y sin pasta', 1);

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
(5, 'Odontopediatría', 'Aunque tu hijo/a no presente problemas de salud oral, es recomendable que acudas con él al odontopediatra cuando cumpla su primer año. De esta manera, el profesional podrá detectar posibles patologías que compremeterían su desarrollo más adelante.', 'odontopediatria.jpeg'),
(6, 'sdfsdf', '1579004124255489.jpg', 'sdfsdf');

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
(2, 'admin', '', '21232f297a57a5a743894a0e4a801fc3', '2021-03-05 08:55:34', '[ADMIN-USER]', '', 'es', 'admin', 'admin', 'admin@sonriseclinic.es', '', '', '', '', '', 1),
(3, 'david', '', '81dc9bdb52d04dc20036dbd8313ed055', '2021-03-04 18:05:43', '[CUSTOMER]', '', 'es', 'Antonio David', 'Bermúdez Moreno', 'davidbermudezmoreno@fp.iesromerovargas.com', 'C/ Real, 46', '11406', 'Jerez de la Frontera', 'Cádiz', '987987987', 1),
(4, 'cintia', '', '81dc9bdb52d04dc20036dbd8313ed055', '2021-03-03 19:50:35', '[AUTHOR]', '', 'es', 'Cintia probando', 'Cabrera Gamaza', 'cintiacabreragamaza@fp.iesromerovargas.com', '', '', '', '', '', 1),
(38, '60362cdb001c6', '', '81dc9bdb52d04dc20036dbd8313ed055', NULL, '[CUSTOMER]', NULL, 'es', 'David', 'Bermudez', 'davidbermudez@jerez.es', 'Calle Parque de Doñana', '11400', 'Jerez', 'Cádiz', '654654654', 1),
(39, '6038f56999690', '', '81dc9bdb52d04dc20036dbd8313ed055', '2021-02-26 16:47:15', '[CUSTOMER]', '', 'es', 'Antonio', 'Gomez', 'elarahal.1972@gmail.com', '', '', '', '', '897987987', 1),
(40, '603f8f6577f5e', '', NULL, NULL, '[CUSTOMER]', NULL, 'es', 'Gustavo Adolfo', 'Domínguez Bastida', 'becquer@gmail.com', 'C/ Puerto Serrano, 61', '11010', 'Cádiz', 'Cádiz', '989879879', 1);

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
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `blocks`
--
ALTER TABLE `blocks`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `budgets`
--
ALTER TABLE `budgets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `budgets_treatments`
--
ALTER TABLE `budgets_treatments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `cites`
--
ALTER TABLE `cites`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `images`
--
ALTER TABLE `images`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=781;

--
-- AUTO_INCREMENT de la tabla `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
