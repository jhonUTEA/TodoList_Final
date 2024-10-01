-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-10-2024 a las 11:44:18
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
-- Base de datos: `db_login`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_BorrarTarea` (IN `tareaID` INT)   BEGIN
    DELETE FROM Tareas WHERE id_tarea = tareaID;  -- Cambié 'ID' por 'id_tarea'
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_BUSCARTAREA` (IN `p_id` INT)   BEGIN
    SELECT id_user, tarea, estado, fecha
    FROM TAREAS
    WHERE id_tarea = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ListaTareas` ()   BEGIN
    SELECT id_tarea AS ID, 
           tarea AS TA, 
           estado AS ES, 
           fecha AS FECHA
    FROM TAREAS;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_TareaNueva` (IN `p_id_tarea` INT, IN `p_id_usuario` INT, IN `p_tarea` VARCHAR(255), IN `p_fecha` DATE, IN `p_estado` VARCHAR(50))   BEGIN
    INSERT INTO TAREAS (id_tarea, id_user, tarea, fecha, estado)
    VALUES (p_id_tarea, p_id_usuario, p_tarea, p_fecha, p_estado);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `id_tarea` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `tarea` varchar(200) DEFAULT NULL,
  `Estado` varchar(50) DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`id_tarea`, `id_user`, `tarea`, `Estado`, `fecha`) VALUES
(3, 1, 'MIRAR TV', 'Completada', '2024-09-06'),
(4, 13, 'Jugar Siempre', 'Completada', '2024-09-08'),
(5, 13, 'bailar', 'Completada', '2024-09-10'),
(6, 13, 'correr', 'Pendiente', '2024-10-01'),
(7, 13, 'volar', 'En Proceso', '2024-09-28'),
(8, 13, 'pasear', 'Pendiente', '2024-09-29'),
(9, 13, 'trotar', 'Completada', '2024-09-27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_user` int(11) NOT NULL,
  `NombreCompleto` varchar(200) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `contraseña` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_user`, `NombreCompleto`, `username`, `contraseña`) VALUES
(1, '', 'jhon', '$2y$10$XAQSmg/R0l4Skot9YznVO.NLY0B4puNS6UsKuwF5Rp7axViO2RI2a'),
(2, 'Limbert Falcon Huanca', 'LimberthStyle', '20Limbert'),
(3, 'Junior Huamanñahui Zea', 'Papita', '21Papita'),
(4, 'Cristian Mondragon Huanca', 'Cristian', 'mondra'),
(5, 'Kevin Rojas Fuentes', 'Kevin', 'leonidas'),
(6, 'Bill Romero Cayllahua', 'Romero', 'bill'),
(7, 'Vicente Silva Ferro', 'Vicent', 'silva'),
(8, 'Elvis Chura Cruz', 'Elvis', 'chura12'),
(9, 'Ronald Salinas Soria', 'Ronald', 'chalinas50'),
(10, 'Melany Guevara Paucar', 'Melany', 'lstyle08'),
(11, 'Sofia Guillen Ramirez', 'Sofia', 'sofi99'),
(12, 'jhon juares', 'jhoncito', '$2y$10$qGr3i6KZFYmbLdSK7qKHB.NaAao4FdSrpyh3rwFNJ/iQc1j6rO.MK'),
(13, 'jhoncito juarez sandoval', 'juarez', '$2y$10$g8TlkZrh7pFFuwfrMO.Ezes14/HYWk.bgCmykGcgROWEcqtAGSQ.i');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`id_tarea`),
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `id_tarea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD CONSTRAINT `tareas_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `usuario` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;