-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 14-04-2018 a las 06:56:12
-- Versión del servidor: 5.7.19
-- Versión de PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `symfony-4-by-samples`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `app_config`
--

DROP TABLE IF EXISTS `app_config`;
CREATE TABLE IF NOT EXISTS `app_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option` int(11) DEFAULT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `option` (`option`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `app_config`
--

INSERT INTO `app_config` (`id`, `option`, `name`) VALUES
(1, 1, 'app_name'),
(2, 2, 'keep_me_logged_in'),
(3, 5, 'register_new_user'),
(4, 7, 'first_user');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `app_config_options`
--

DROP TABLE IF EXISTS `app_config_options`;
CREATE TABLE IF NOT EXISTS `app_config_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `app_config` int(11) DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `app_config` (`app_config`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `app_config_options`
--

INSERT INTO `app_config_options` (`id`, `app_config`, `name`) VALUES
(1, 1, 'AppExample'),
(2, 2, 'yes'),
(3, 2, 'no'),
(4, 3, 'administrators_only'),
(5, 3, 'visitors'),
(6, 3, 'visitors_but_approval_is_required'),
(7, 4, 'first_user');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plain_password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `role` json NOT NULL COMMENT '(DC2Type:json_array)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `app_config`
--
ALTER TABLE `app_config`
  ADD CONSTRAINT `FK_318942FC5A8600B0` FOREIGN KEY (`option`) REFERENCES `app_config_options` (`id`);

--
-- Filtros para la tabla `app_config_options`
--
ALTER TABLE `app_config_options`
  ADD CONSTRAINT `FK_7AD3AA89318942FC` FOREIGN KEY (`app_config`) REFERENCES `app_config` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
