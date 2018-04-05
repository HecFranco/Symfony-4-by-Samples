-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 03-04-2018 a las 18:19:54
-- Versión del servidor: 5.7.19
-- Versión de PHP: 5.6.31

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
  `option` int(11) NOT NULL,
  `configuration` varchar(150) CHARACTER SET utf8mb4 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `register_new_user` (`option`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `app_config`
--

INSERT INTO `app_config` (`id`, `option`, `configuration`) VALUES
(1, 1, 'app_name'),
(2, 2, 'keep_me_logged_in'),
(3, 5, 'register_new_user'),
(4, 7, 'login_form');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `app_config_options`
--

DROP TABLE IF EXISTS `app_config_options`;
CREATE TABLE IF NOT EXISTS `app_config_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option` varchar(100) NOT NULL,
  `app_config` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `app_config` (`app_config`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `app_config_options`
--

INSERT INTO `app_config_options` (`id`, `option`, `app_config`) VALUES
(1, 'AppExample', 1),
(2, 'yes', 2),
(3, 'no', 2),
(4, 'administrators_only', 3),
(5, 'visitors', 3),
(6, 'visitors_but_approval_is_required', 3),
(7, 'first_user', 4),
(8, 'no_first_user', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  ADD CONSTRAINT `app_config_ibfk_1` FOREIGN KEY (`option`) REFERENCES `app_config_options` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `app_config_options`
--
ALTER TABLE `app_config_options`
  ADD CONSTRAINT `app_config_options_ibfk_1` FOREIGN KEY (`app_config`) REFERENCES `app_config` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
