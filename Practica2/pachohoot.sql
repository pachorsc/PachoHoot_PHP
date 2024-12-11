-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-12-2024 a las 14:07:32
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
-- Base de datos: `pachohoot`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `id` int(11) NOT NULL,
  `enun` varchar(200) DEFAULT NULL,
  `resp` varchar(200) DEFAULT NULL,
  `opcion` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`id`, `enun`, `resp`, `opcion`) VALUES
(1, '¿De qué país es originario el sushi?', 'Japón', 'China,Japón,Corea,Tailandia'),
(2, '¿Qué tipo de pasta es tradicionalmente usada para hacer lasaña?', 'Láminas de lasaña', 'Láminas de lasaña,Espagueti,Macarrones,Fettuccine'),
(3, '¿Qué comida típica se come en Estados Unidos en el Día de Acción de Gracias?', 'Pavo', ''),
(4, '¿Cuáles de estos ingredientes son comunes en una ensalada César? (Selecciona todas las que apliquen)', 'Lechuga romana,Pollo a la parrilla,Pan tostado (croutons)', 'Lechuga romana,Tomate,Pollo a la parrilla,Pan tostado (croutons),Salsa de soya'),
(5, '¿Cuántos granos de café se utilizan aproximadamente para hacer una taza de café promedio?', '150', ''),
(6, '¿Cuántos litros de agua aproximadamente se necesitan para producir 1 kg de carne de res?(sin comas ni puntos)', '15000', ''),
(7, '¿Qué tipo de comida es una pizza?', 'Italiana', ''),
(8, '¿Cuáles de estos personajes aparecen en la serie Arcane? (Selecciona todas las que apliquen)', 'Jinx,Vi,Viktor', 'Jinx,Vi,Viktor,Yasuo'),
(9, '¿Qué personaje es conocido como \"El Artífice\" en Arcane?', 'Viktor', 'Jayce,Viktor,Ekko,Silco'),
(10, '¿Qué parte del microondas es responsable de calentar los alimentos?', 'La magnetrón', 'La magnetrón,El ventilador,La puerta de vidrio,El plato giratorio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usu`
--

CREATE TABLE `usu` (
  `nombre` varchar(50) NOT NULL,
  `tim` timestamp NOT NULL DEFAULT current_timestamp(),
  `record` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usu`
--
ALTER TABLE `usu`
  ADD PRIMARY KEY (`nombre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
