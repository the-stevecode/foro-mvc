-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-10-2023 a las 15:39:23
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbforo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hilo`
--

CREATE TABLE `hilo` (
  `id` int(11) NOT NULL,
  `titulo` varchar(250) NOT NULL,
  `contenido` varchar(1000) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `hilo`
--

INSERT INTO `hilo` (`id`, `titulo`, `contenido`, `fecha_creacion`, `usuario_id`) VALUES
(9, 'El Futuro de la Inteligencia Artificial: Tendencias y Desarrollos', 'En este hilo, discutamos las últimas tendencias y desarrollos en el campo de la inteligencia artificial. Desde el aprendizaje profundo hasta la automatización, compartamos nuestras perspectivas sobre cómo la IA está moldeando nuestro mundo y qué podemos esperar en el futuro.', '2023-10-30 05:41:37', 3),
(10, 'Reseñas de los Últimos Dispositivos Tecnológicos', '¿Has tenido la oportunidad de probar un dispositivo tecnológico emocionante recientemente? Comparte tus reseñas y experiencias sobre smartphones, laptops, wearables u otros gadgets. Ayuda a la comunidad a tomar decisiones informadas sobre sus próximas compras tecnológicas.', '2023-10-30 05:42:08', 3),
(11, 'Ciberseguridad en un Mundo Conectado', 'Contenido: La seguridad en línea es crucial en la era digital. En este hilo, discutamos estrategias y mejores prácticas para mantener nuestros datos seguros, así como las amenazas cibernéticas más recientes. Comparte consejos para proteger tu información personal y empresarial en un mundo cada vez más conectado.', '2023-10-30 05:42:35', 3),
(12, 'Problemas con la Actualización de Software en mi Dispositivo Móvi', 'Hola a todos, recientemente intenté actualizar el software en mi teléfono y me encontré con algunos problemas. La actualización no se instaló correctamente y ahora estoy experimentando problemas de rendimiento. ¿Alguien más ha tenido este problema o tiene alguna sugerencia para solucionarlo?', '2023-10-30 05:44:52', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta`
--

CREATE TABLE `respuesta` (
  `id` int(11) NOT NULL,
  `contenido` varchar(1000) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuario_id` int(11) NOT NULL,
  `hilo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `usuario` varchar(60) NOT NULL,
  `correo` varchar(60) NOT NULL,
  `clave` varchar(60) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `usuario`, `correo`, `clave`, `fecha_registro`) VALUES
(1, 'steve', 'steve@foro.com', '$2y$10$cndiUJiBOaRn2D4fErXS9eUXBLIY7GJh4xT9nNG33ximEFt0PAIFC', '2023-10-14 08:40:06'),
(2, 'j', 'j@foro.com', '$2y$10$JIJaOosnZybCYZJsSu1m3.7hgbHr0F9wtv69XXBT8.NcBzxDwvYZq', '2023-10-28 16:41:50'),
(3, 'pepe', 'pepe@g.com', '$2y$10$4UDvMr4y1AmmOhN.MCvAOeOCHU8.a2NlW8CIg1yZlCvqbNXcS0gUW', '2023-10-29 23:42:50'),
(4, 'Montoya', 'montoya@g.com', '$2y$10$gvtnt.6dcvjCVBwSXoGqgex7v6ympeMLWE3rSB.7eEvvk4D4KWhcS', '2023-10-30 05:10:53'),
(5, 'medrano', 'medrano@g.com', '$2y$10$UvSyMa.soXoXd7SuCVTFDOUy4POzOCQ9K4uBHfY6ImCKG4MOU0ZN6', '2023-10-30 05:44:24');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `hilo`
--
ALTER TABLE `hilo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_hilo` (`usuario_id`);

--
-- Indices de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_respuesta` (`usuario_id`),
  ADD KEY `hilo_respuesta` (`hilo_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `hilo`
--
ALTER TABLE `hilo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `hilo`
--
ALTER TABLE `hilo`
  ADD CONSTRAINT `usuario_hilo` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD CONSTRAINT `hilo_respuesta` FOREIGN KEY (`hilo_id`) REFERENCES `hilo` (`id`),
  ADD CONSTRAINT `usuario_respuesta` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
