-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-02-2019 a las 12:54:52
-- Versión del servidor: 10.1.34-MariaDB
-- Versión de PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `allison`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acceso`
--

CREATE TABLE `acceso` (
  `id_empleado` int(11) NOT NULL,
  `usuario` varchar(25) DEFAULT NULL,
  `pass` char(255) DEFAULT NULL,
  `estatus` char(1) DEFAULT NULL,
  `remember_token` char(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `acceso`
--

INSERT INTO `acceso` (`id_empleado`, `usuario`, `pass`, `estatus`, `remember_token`) VALUES
(17, 'bol', '$2y$10$SwdTQbB6Wp4qdmbhhRvWtuBm0vb0PQkWUGPe5dKy.depLenM18y0G', '1', 'v1kEET2OC7NGsA57KFXOpzvaCBO1KV3oMeo07ikjRUG5PVaEzm4Y4sjlRHki'),
(18, 'rider2', '$2y$10$97cP9dpG0QaaZWqafQhCLu.MO9KtEi5GcMb8kqrddaFxGD5Its.AG', '0', 'ESuM0aNWqVSi9BJRwIfv2bX0YIGXFgKaVuEwSXXhQQ3JorlSBCRVj8mEUcmL'),
(19, 'Jose', '$2y$10$5MnfbGOEfQ/wZ5FwTQIr6.uPec6lWwubUtf3XMjlgvvhJHX0Ayzom', '1', NULL),
(24, 'pepe', '$2y$10$OTYhEEZ01jQDCSldN1xsj.mYZIezY2QYGAJTHymaY3R7RsNo2KN2K', '1', 'dJvcXdefQ3t6y1XbZxvoH7gBwWmM2unXP3tAvcwbmAQtyzuCUzHEEjM08wm3'),
(26, 'pepito', '$2y$10$9QJv0JV3A99INi9I6rBeOuTDQQOMIZZntbK6c3vVTYHWFTWwtMB56', '1', 'ZLTOP15pfQc3lNVVE1UNWp8Q3PQj3FWEc1lAKxaLM6kDgXhrOwau2Vd5HKsI'),
(27, 'admin', '$2y$10$RDYnGWuXvMVFGOrEsH3iU.5eX1r8udYxRvM7lCC0yo4as1m.1wNJS', '1', 'veWDeHceVcahzzyFBH4uCPXbVfs2WGq2St4GumOqCGcx5j3wcfSIVJ9yyZxr');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE `almacen` (
  `id_almacen` int(11) NOT NULL,
  `codigo` varchar(50) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `id_sucursal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `almacen`
--

INSERT INTO `almacen` (`id_almacen`, `codigo`, `direccion`, `id_sucursal`) VALUES
(1, 'Almacen 2', 'Zona Estadium Patria', 2),
(2, 'Almacen 23', 'Av. de las Americas 33', 4),
(3, 'Almacen 100', 'Ravelo 25', 1),
(4, 'Almacen 1', 'PLaza 25 de Mayo Nº 25', 4),
(5, 'Almacen 3', 'Terminal', 2),
(6, 'Almacen 300', 'Potosi', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo`
--

CREATE TABLE `articulo` (
  `id_articulo` int(11) NOT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `codigo` varchar(50) DEFAULT NULL,
  `codigo_barra` varchar(50) DEFAULT NULL,
  `caracteristicas` text,
  `precio_compra` decimal(10,2) DEFAULT NULL,
  `precio_produccion` decimal(10,2) DEFAULT NULL,
  `estatus` char(1) DEFAULT NULL,
  `imagen` char(254) DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL,
  `divisible` tinyint(1) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `id_fabricante` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `articulo`
--

INSERT INTO `articulo` (`id_articulo`, `nombre`, `codigo`, `codigo_barra`, `caracteristicas`, `precio_compra`, `precio_produccion`, `estatus`, `imagen`, `fecha_registro`, `divisible`, `id_categoria`, `id_fabricante`) VALUES
(15, 'jhkjhjkh', 'kj', 'hjk', 'hkjhk', '546545.00', '0.00', '1', 'images/1545922268favicon.png', '2018-12-27', 0, 39, 1),
(16, 'SEÑOR DE LAS TINTAS', '2255', '32568525', 'Melaminico 3255', '150.00', '3.00', '1', NULL, '2019-01-10', 1, 30, 1),
(17, 'Madera Roble plano', '100', '2333556545', 'Madena para puertas', '150.00', '0.00', '1', NULL, '2019-01-16', 1, 30, 1),
(18, 'Melamico 1010', '101', '3526518946513', 'para escritorios', '10.00', '0.00', '1', NULL, '2019-01-16', 0, 30, 1),
(19, 'Prensa de madera', '456', '456465', '', '12.00', '0.00', '1', NULL, '2019-01-23', 1, 37, 1),
(20, 'Prensa de cobre', '4645', '454564', '', '54.00', '0.00', '1', NULL, '2019-01-23', 1, 31, 1),
(21, 'Articulo 2 Modificado', '4654', '45', '', '10.00', '0.00', '1', NULL, '2019-01-23', 1, NULL, NULL),
(22, 'Articulo 3', '45', '455', '', '445.00', '0.00', '1', NULL, '2019-01-23', 0, NULL, NULL),
(23, 'Melaminico', '23533', '132524521352', '', '300.00', '500.00', '1', NULL, '2019-02-08', 1, NULL, NULL),
(24, 'Articulo de prueba', '4694654', '5465465', '', '200.00', '0.00', '1', NULL, '2019-02-17', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos_sucursales`
--

CREATE TABLE `articulos_sucursales` (
  `id_articulo` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `precio_1` decimal(10,2) NOT NULL DEFAULT '0.00',
  `precio_2` decimal(10,2) NOT NULL DEFAULT '0.00',
  `precio_3` decimal(10,2) NOT NULL DEFAULT '0.00',
  `precio_4` decimal(10,2) NOT NULL DEFAULT '0.00',
  `precio_5` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `articulos_sucursales`
--

INSERT INTO `articulos_sucursales` (`id_articulo`, `id_sucursal`, `precio_1`, `precio_2`, `precio_3`, `precio_4`, `precio_5`) VALUES
(16, 2, '10.00', '10.00', '10.00', '10.00', '10.00'),
(17, 1, '10.00', '10.00', '10.00', '10.00', '10.00'),
(17, 2, '50.00', '50.00', '50.00', '50.00', '50.00'),
(17, 3, '10.00', '10.00', '10.00', '10.00', '10.00'),
(17, 4, '5.00', '5.00', '5.00', '5.00', '5.00'),
(19, 1, '50.00', '54.00', '5.00', '56.00', '5.00'),
(21, 2, '1000.00', '50.00', '10.00', '25.00', '25.00'),
(21, 3, '5.00', '5.00', '56.00', '5.00', '5.00'),
(21, 4, '100.00', '100.00', '100.00', '100.00', '50.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora`
--

CREATE TABLE `bitacora` (
  `id` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `accion` text,
  `fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `bitacora`
--

INSERT INTO `bitacora` (`id`, `id_empleado`, `descripcion`, `accion`, `fecha`) VALUES
(13, 17, 'data={\"id_caja\":null,\"nombre\":\"Prueba 4\",\"id_empleado\":19,\"empleado\":{\"id_empleado\":19,\"nombre\":\"Jose Jose\"}}', 'CREATE', '2019-02-07 12:31:10'),
(14, 17, 'data={\"id_caja\":19,\"nombre\":\"Prueba 10\",\"status\":null,\"id_empleado\":18,\"empleado\":{\"nombre\":\"Rider\",\"id_empelado\":18}}', 'CREATE', '2019-02-07 12:32:55'),
(15, 17, 'previusData={\"id_caja\":19,\"nombre\":\"Prueba 1\",\"status\":null,\"id_empleado\":18,\"empleado\":{\"nombre\":\"Rider\",\"id_empelado\":18}}', 'UPDATE', '2019-02-07 12:34:02'),
(16, 17, '', 'LOGOUT', '2019-02-07 12:35:49'),
(17, 18, '', 'LOGIN', '2019-02-07 12:35:53'),
(18, 17, '', 'LOGIN', '2019-02-07 15:19:59'),
(19, 17, 'previusData={\"id_fabricante\":1,\"nombre\":\"fabricante1\",\"contacto\":\"2312\",\"sitio_web\":null}', 'UPDATE', '2019-02-07 16:14:26'),
(20, 17, 'previusData={\"id_fabricante\":2,\"nombre\":\"fabricante2\",\"contacto\":null,\"sitio_web\":null}', 'UPDATE', '2019-02-07 16:14:31'),
(21, 17, 'previusData={\"id_fabricante\":1,\"nombre\":\"fabricante1\",\"contacto\":\"2312\",\"sitio_web\":\"Mi sitio\"}', 'UPDATE', '2019-02-07 16:17:06'),
(22, 17, 'previusData={\"id_articulo\":21,\"nombre\":\"Articulo 2\",\"codigo\":\"4654\",\"codigo_barra\":\"45\",\"caracteristicas\":\"\",\"precio_compra\":\"10.00\",\"precio_produccion\":\"0.00\",\"estatus\":\"1\",\"imagen\":null,\"fecha_registro\":\"2019-01-23\",\"divisible\":1,\"id_categoria\":null,\"id_fabricante\":null}', 'UPDATE', '2019-02-07 16:29:09'),
(23, 17, '', 'LOGOUT', '2019-02-07 16:45:16'),
(24, 27, '', 'LOGIN', '2019-02-07 16:45:22'),
(25, 27, 'previusData={\"id_empleado\":27,\"usuario\":\"admin\",\"pass\":\"123\",\"permisos_permitidos\":[{\"id_permiso\":12,\"descripcion\":\"venta\",\"permitir\":0},{\"id_permiso\":7,\"descripcion\":\"gasto\",\"permitir\":0},{\"id_permiso\":6,\"descripcion\":\"factura\",\"permitir\":0},{\"id_permiso\":5,\"descripcion\":\"cuenta\",\"permitir\":0},{\"id_permiso\":4,\"descripcion\":\"contacto\",\"permitir\":0},{\"id_permiso\":9,\"descripcion\":\"cliente\",\"permitir\":0},{\"id_permiso\":3,\"descripcion\":\"categoria\",\"permitir\":0},{\"id_permiso\":2,\"descripcion\":\"Cargo\",\"permitir\":0},{\"id_permiso\":11,\"descripcion\":\"cambio\",\"permitir\":0},{\"id_permiso\":1,\"descripcion\":\"Articulo\",\"permitir\":0},{\"id_permiso\":8,\"descripcion\":\"almacen\",\"permitir\":0}]}', 'UPDATE', '2019-02-07 18:31:43'),
(26, 27, '', 'LOGOUT', '2019-02-07 18:31:49'),
(27, 27, '', 'LOGIN', '2019-02-07 18:31:54'),
(28, 17, '', 'LOGIN', '2019-02-08 09:57:16'),
(29, 17, '', 'LOGOUT', '2019-02-08 10:48:35'),
(30, 27, '', 'LOGIN', '2019-02-08 10:56:26'),
(31, 27, '', 'LOGOUT', '2019-02-08 10:59:04'),
(32, 17, '', 'LOGIN', '2019-02-08 11:00:53'),
(33, 17, '', 'LOGOUT', '2019-02-08 11:01:46'),
(34, 17, '', 'LOGIN', '2019-02-08 11:01:51'),
(35, 27, '', 'LOGIN', '2019-02-08 11:02:40'),
(36, 27, '', 'LOGOUT', '2019-02-08 11:08:48'),
(37, 17, '', 'LOGIN', '2019-02-08 11:08:53'),
(38, 17, '', 'LOGIN', '2019-02-08 11:09:37'),
(39, 17, '', 'LOGIN', '2019-02-08 11:14:59'),
(40, 17, '', 'LOGIN', '2019-02-08 11:16:31'),
(41, 17, '', 'LOGIN', '2019-02-08 11:18:03'),
(42, 17, '', 'LOGIN', '2019-02-08 11:20:04'),
(43, 17, '', 'LOGIN', '2019-02-08 11:22:07'),
(44, 17, '', 'LOGIN', '2019-02-08 11:26:28'),
(45, 17, '', 'LOGIN', '2019-02-08 11:28:47'),
(46, 27, '', 'LOGIN', '2019-02-08 11:29:10'),
(47, 27, '', 'LOGOUT', '2019-02-08 11:42:18'),
(48, 17, '', 'LOGIN', '2019-02-08 11:42:23'),
(49, 27, '', 'LOGIN', '2019-02-08 11:42:29'),
(50, 27, '', 'LOGOUT', '2019-02-08 11:46:57'),
(51, 17, '', 'LOGIN', '2019-02-08 11:47:04'),
(52, 24, '', 'LOGIN', '2019-02-08 11:47:20'),
(53, 17, '', 'LOGIN', '2019-02-08 15:00:21'),
(54, 27, '', 'LOGIN', '2019-02-08 15:00:34'),
(55, 27, '', 'LOGOUT', '2019-02-08 15:02:37'),
(56, 17, '', 'LOGIN', '2019-02-08 15:02:43'),
(57, 17, 'previusData={\"id_empleado\":17,\"usuario\":\"bol\",\"pass\":null,\"permisos_permitidos\":[{\"id_permiso\":14,\"descripcion\":\"Ventas\",\"permitir\":0},{\"id_permiso\":13,\"descripcion\":\"Panel de Administraci\\u00f3n\",\"permitir\":\"1\"},{\"id_permiso\":18,\"descripcion\":\"Crear Cajas\",\"permitir\":0},{\"id_permiso\":15,\"descripcion\":\"Compras\",\"permitir\":0},{\"id_permiso\":17,\"descripcion\":\"Caja\",\"permitir\":0},{\"id_permiso\":16,\"descripcion\":\"Art\\u00edculo\",\"permitir\":0}]}', 'UPDATE', '2019-02-08 15:03:28'),
(58, 17, '', 'LOGOUT', '2019-02-08 15:03:37'),
(59, 17, '', 'LOGIN', '2019-02-08 15:03:45'),
(60, 17, '', 'LOGOUT', '2019-02-08 15:07:20'),
(61, 24, '', 'LOGIN', '2019-02-08 15:07:26'),
(62, 24, '', 'LOGOUT', '2019-02-08 15:32:42'),
(63, 27, '', 'LOGIN', '2019-02-08 15:32:55'),
(64, 27, '', 'LOGOUT', '2019-02-08 15:33:12'),
(65, 27, '', 'LOGIN', '2019-02-08 15:35:45'),
(66, 27, 'previusData={\"id_empleado\":27,\"usuario\":\"admin\",\"pass\":null,\"permisos_permitidos\":[{\"id_permiso\":14,\"descripcion\":\"Ventas\",\"permitir\":0},{\"id_permiso\":13,\"descripcion\":\"Panel de Administraci\\u00f3n\",\"permitir\":\"0\"},{\"id_permiso\":18,\"descripcion\":\"Crear Cajas\",\"permitir\":0},{\"id_permiso\":15,\"descripcion\":\"Compras\",\"permitir\":0},{\"id_permiso\":17,\"descripcion\":\"Caja\",\"permitir\":0},{\"id_permiso\":16,\"descripcion\":\"Art\\u00edculo\",\"permitir\":0}]}', 'UPDATE', '2019-02-08 15:36:29'),
(67, 27, 'previusData={\"id_empleado\":17,\"usuario\":\"bol\",\"pass\":null,\"permisos_permitidos\":[{\"id_permiso\":14,\"descripcion\":\"Ventas\",\"permitir\":1},{\"id_permiso\":13,\"descripcion\":\"Panel de Administraci\\u00f3n\",\"permitir\":1},{\"id_permiso\":18,\"descripcion\":\"Crear Cajas\",\"permitir\":1},{\"id_permiso\":15,\"descripcion\":\"Compras\",\"permitir\":1},{\"id_permiso\":17,\"descripcion\":\"Caja\",\"permitir\":1},{\"id_permiso\":16,\"descripcion\":\"Art\\u00edculo\",\"permitir\":1}]}', 'UPDATE', '2019-02-08 15:37:58'),
(68, 27, 'previusData={\"id_empleado\":24,\"usuario\":\"emp\",\"pass\":null,\"permisos_permitidos\":[{\"id_permiso\":14,\"descripcion\":\"Ventas\",\"permitir\":0},{\"id_permiso\":13,\"descripcion\":\"Panel de Administraci\\u00f3n\",\"permitir\":0},{\"id_permiso\":18,\"descripcion\":\"Crear Cajas\",\"permitir\":0},{\"id_permiso\":15,\"descripcion\":\"Compras\",\"permitir\":0},{\"id_permiso\":17,\"descripcion\":\"Caja\",\"permitir\":0},{\"id_permiso\":16,\"descripcion\":\"Art\\u00edculo\",\"permitir\":0}]}', 'UPDATE', '2019-02-08 15:38:05'),
(69, 27, '', 'LOGOUT', '2019-02-08 15:38:26'),
(70, 17, '', 'LOGIN', '2019-02-08 15:38:31'),
(71, 17, 'previusData={\"id_empleado\":17,\"usuario\":\"bol\",\"pass\":null,\"permisos_permitidos\":[{\"id_permiso\":14,\"descripcion\":\"Ventas\",\"permitir\":1},{\"id_permiso\":13,\"descripcion\":\"Panel de Administraci\\u00f3n\",\"permitir\":1},{\"id_permiso\":18,\"descripcion\":\"Crear Cajas\",\"permitir\":\"0\"},{\"id_permiso\":15,\"descripcion\":\"Compras\",\"permitir\":1},{\"id_permiso\":17,\"descripcion\":\"Caja\",\"permitir\":1},{\"id_permiso\":16,\"descripcion\":\"Art\\u00edculo\",\"permitir\":1}]}', 'UPDATE', '2019-02-08 15:39:21'),
(72, 17, 'previusData={\"id_empleado\":24,\"usuario\":\"emp\",\"pass\":null,\"permisos_permitidos\":[{\"id_permiso\":14,\"descripcion\":\"Ventas\",\"permitir\":0},{\"id_permiso\":13,\"descripcion\":\"Panel de Administraci\\u00f3n\",\"permitir\":0},{\"id_permiso\":18,\"descripcion\":\"Crear Cajas\",\"permitir\":\"1\"},{\"id_permiso\":15,\"descripcion\":\"Compras\",\"permitir\":0},{\"id_permiso\":17,\"descripcion\":\"Caja\",\"permitir\":0},{\"id_permiso\":16,\"descripcion\":\"Art\\u00edculo\",\"permitir\":\"1\"}]}', 'UPDATE', '2019-02-08 15:52:11'),
(73, 17, '', 'LOGOUT', '2019-02-08 16:11:39'),
(74, 17, '', 'LOGIN', '2019-02-08 16:14:55'),
(75, 17, '', 'LOGOUT', '2019-02-08 16:15:14'),
(76, 24, '', 'LOGIN', '2019-02-08 16:15:19'),
(77, 24, '', 'LOGOUT', '2019-02-08 16:15:26'),
(78, 24, '', 'LOGIN', '2019-02-08 16:15:42'),
(79, 24, '', 'LOGOUT', '2019-02-08 16:15:56'),
(80, 27, '', 'LOGIN', '2019-02-08 16:16:27'),
(81, 27, 'previusData={\"id_empleado\":24,\"usuario\":\"emp\",\"pass\":null,\"permisos_permitidos\":[{\"id_permiso\":14,\"descripcion\":\"Ventas\",\"permitir\":0},{\"id_permiso\":13,\"descripcion\":\"Panel de Administraci\\u00f3n\",\"permitir\":0},{\"id_permiso\":18,\"descripcion\":\"Crear Cajas\",\"permitir\":0},{\"id_permiso\":15,\"descripcion\":\"Compras\",\"permitir\":0},{\"id_permiso\":17,\"descripcion\":\"Caja\",\"permitir\":0},{\"id_permiso\":16,\"descripcion\":\"Art\\u00edculo\",\"permitir\":0}]}', 'UPDATE', '2019-02-08 16:16:57'),
(82, 27, '', 'LOGOUT', '2019-02-08 16:17:08'),
(83, 24, '', 'LOGIN', '2019-02-08 16:17:16'),
(84, 24, '', 'LOGOUT', '2019-02-08 16:22:07'),
(85, 17, '', 'LOGIN', '2019-02-08 16:26:57'),
(86, 17, '', 'LOGIN', '2019-02-08 17:44:02'),
(87, 17, '', 'LOGOUT', '2019-02-08 17:44:25'),
(88, 17, '', 'LOGIN', '2019-02-08 17:44:32'),
(89, 17, '', 'LOGOUT', '2019-02-08 17:44:45'),
(90, 17, '', 'LOGIN', '2019-02-08 17:47:25'),
(91, 17, '', 'LOGOUT', '2019-02-08 17:48:13'),
(92, 17, '', 'LOGIN', '2019-02-08 17:48:54'),
(93, 17, 'previusData={\"id_sucursal\":3,\"nombre\":\"Sucre 2\",\"casa_matriz\":1,\"direccion\":\"Junin 511\",\"telefono\":\"214214\",\"fecha_apertura\":\"2019-01-17\",\"estatus\":null,\"id_ciudad\":2,\"id_empresa\":3}', 'UPDATE', '2019-02-08 18:00:11'),
(94, 17, 'previusData={\"id_sucursal\":1,\"nombre\":\"Potos1\",\"casa_matriz\":\"0\",\"direccion\":\"Boliva 233\",\"telefono\":\"45554456\",\"fecha_apertura\":\"2018-12-04\",\"estatus\":\"A\",\"id_ciudad\":1,\"id_empresa\":2}', 'UPDATE', '2019-02-08 18:01:09'),
(95, 17, 'previusData={\"id_sucursal\":1,\"nombre\":\"Potosi 1\",\"casa_matriz\":0,\"direccion\":\"Boliva 233\",\"telefono\":\"45554456\",\"fecha_apertura\":\"2018-12-04\",\"estatus\":\"A\",\"id_ciudad\":1,\"id_empresa\":2}', 'UPDATE', '2019-02-08 18:02:36'),
(96, 17, 'previusData={\"id_empleado\":24,\"usuario\":\"pepe\",\"pass\":\"123123\",\"permisos_permitidos\":[{\"id_permiso\":14,\"descripcion\":\"Ventas\",\"permitir\":0},{\"id_permiso\":13,\"descripcion\":\"Panel de Administraci\\u00f3n\",\"permitir\":0},{\"id_permiso\":18,\"descripcion\":\"Crear Cajas\",\"permitir\":0},{\"id_permiso\":15,\"descripcion\":\"Compras\",\"permitir\":0},{\"id_permiso\":17,\"descripcion\":\"Caja\",\"permitir\":0},{\"id_permiso\":16,\"descripcion\":\"Art\\u00edculo\",\"permitir\":0}]}', 'UPDATE', '2019-02-08 18:04:28'),
(97, 17, 'previusData={\"id_empleado\":24,\"usuario\":\"pepe\",\"pass\":\"123123\",\"permisos_permitidos\":[{\"id_permiso\":14,\"descripcion\":\"Ventas\",\"permitir\":\"1\"},{\"id_permiso\":13,\"descripcion\":\"Panel de Administraci\\u00f3n\",\"permitir\":\"1\"},{\"id_permiso\":18,\"descripcion\":\"Crear Cajas\",\"permitir\":\"1\"},{\"id_permiso\":15,\"descripcion\":\"Compras\",\"permitir\":\"1\"},{\"id_permiso\":17,\"descripcion\":\"Caja\",\"permitir\":\"1\"},{\"id_permiso\":16,\"descripcion\":\"Art\\u00edculo\",\"permitir\":\"1\"}]}', 'UPDATE', '2019-02-08 18:04:39'),
(98, 17, '', 'LOGOUT', '2019-02-08 18:04:49'),
(99, 24, '', 'LOGIN', '2019-02-08 18:05:05'),
(100, 24, '', 'LOGOUT', '2019-02-08 18:05:12'),
(101, 24, '', 'LOGIN', '2019-02-08 18:05:25'),
(102, 24, 'previusData={\"id_empleado\":19,\"usuario\":\"Jose\",\"pass\":\"123123\",\"permisos_permitidos\":[{\"id_permiso\":14,\"descripcion\":\"Ventas\",\"permitir\":1},{\"id_permiso\":13,\"descripcion\":\"Panel de Administraci\\u00f3n\",\"permitir\":1},{\"id_permiso\":18,\"descripcion\":\"Crear Cajas\",\"permitir\":1},{\"id_permiso\":15,\"descripcion\":\"Compras\",\"permitir\":1},{\"id_permiso\":17,\"descripcion\":\"Caja\",\"permitir\":1},{\"id_permiso\":16,\"descripcion\":\"Art\\u00edculo\",\"permitir\":1}]}', 'UPDATE', '2019-02-08 18:18:15'),
(103, 24, 'previusData={\"id_empleado\":26,\"usuario\":\"pepito\",\"pass\":\"123123\",\"permisos_permitidos\":[{\"id_permiso\":14,\"descripcion\":\"Ventas\",\"permitir\":1},{\"id_permiso\":13,\"descripcion\":\"Panel de Administraci\\u00f3n\",\"permitir\":1},{\"id_permiso\":18,\"descripcion\":\"Crear Cajas\",\"permitir\":1},{\"id_permiso\":15,\"descripcion\":\"Compras\",\"permitir\":1},{\"id_permiso\":17,\"descripcion\":\"Caja\",\"permitir\":1},{\"id_permiso\":16,\"descripcion\":\"Art\\u00edculo\",\"permitir\":1}]}', 'UPDATE', '2019-02-08 18:22:35'),
(104, 27, '', 'LOGIN', '2019-02-08 19:02:23'),
(105, 27, '', 'LOGOUT', '2019-02-08 19:02:37'),
(106, 17, '', 'LOGIN', '2019-02-08 19:02:41'),
(107, 24, '', 'LOGOUT', '2019-02-08 19:28:28'),
(108, 17, '', 'LOGIN', '2019-02-11 09:43:06'),
(109, 17, '', 'LOGIN', '2019-02-11 09:48:31'),
(110, 17, '', 'LOGIN', '2019-02-11 15:07:07'),
(111, 17, '', 'LOGIN', '2019-02-11 15:07:07'),
(112, 17, 'previusData={\"id\":5,\"fecha\":\"2019-02-12 10:19:06\",\"observaciones\":null,\"status\":null,\"id_empleado\":17,\"id_almacen_origen\":5,\"id_almacen_destino\":3}', 'DELETE', '2019-02-12 12:19:00'),
(113, 17, 'previusData={\"id\":4,\"fecha\":\"2019-02-12 10:00:18\",\"observaciones\":\"jkhjkwqhekwqhejkwqhk\",\"status\":null,\"id_empleado\":17,\"id_almacen_origen\":4,\"id_almacen_destino\":3}', 'DELETE', '2019-02-12 12:20:06'),
(114, 17, 'previusData={\"id\":3,\"fecha\":\"2019-02-12 09:58:13\",\"observaciones\":\"jkhjkwqhekwqhejkwqhk\",\"status\":null,\"id_empleado\":17,\"id_almacen_origen\":4,\"id_almacen_destino\":3}', 'DELETE', '2019-02-12 12:20:26'),
(115, 17, 'previusData={\"id_articulo\":24,\"nombre\":\"Articulo de prueba\",\"codigo\":\"4694654\",\"codigo_barra\":\"5465465\",\"caracteristicas\":\"\",\"precio_compra\":\"100.00\",\"precio_produccion\":null,\"estatus\":\"1\",\"imagen\":null,\"fecha_registro\":\"2019-02-17\",\"divisible\":0,\"id_categoria\":null,\"id_fabricante\":null}', 'UPDATE', '2019-02-17 19:17:46'),
(116, 17, 'previusData={\"id_articulo\":24,\"nombre\":\"Articulo de prueba\",\"codigo\":\"4694654\",\"codigo_barra\":\"5465465\",\"caracteristicas\":\"\",\"precio_compra\":\"200.00\",\"precio_produccion\":null,\"estatus\":\"1\",\"imagen\":null,\"fecha_registro\":\"2019-02-17\",\"divisible\":0,\"id_categoria\":null,\"id_fabricante\":null}', 'UPDATE', '2019-02-17 19:17:55'),
(117, 17, 'previusData={\"id_articulo\":24,\"nombre\":\"Articulo de prueba\",\"codigo\":\"4694654\",\"codigo_barra\":\"5465465\",\"caracteristicas\":\"\",\"precio_compra\":\"200.00\",\"precio_produccion\":\"50.00\",\"estatus\":\"1\",\"imagen\":null,\"fecha_registro\":\"2019-02-17\",\"divisible\":0,\"id_categoria\":null,\"id_fabricante\":null}', 'UPDATE', '2019-02-17 19:18:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE `caja` (
  `id_caja` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `status` char(1) DEFAULT NULL,
  `id_empleado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`id_caja`, `nombre`, `status`, `id_empleado`) VALUES
(1, 'Caja 1', 'a', 17),
(2, 'Caja 2', NULL, 18),
(3, 'Caja2', NULL, 18),
(19, 'Prueba 1', NULL, 18),
(20, 'Prueba 3', NULL, 26),
(21, 'Prueba 4', NULL, 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja_chica`
--

CREATE TABLE `caja_chica` (
  `id_caja_chica` int(11) NOT NULL,
  `fecha_apertura` datetime DEFAULT NULL,
  `fecha_cierre` datetime DEFAULT NULL,
  `monto_apertura` decimal(10,2) DEFAULT NULL,
  `diferencia` decimal(10,2) DEFAULT NULL,
  `monto_declarado` decimal(10,2) DEFAULT NULL,
  `observaciones` text,
  `id_caja` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `caja_chica`
--

INSERT INTO `caja_chica` (`id_caja_chica`, `fecha_apertura`, `fecha_cierre`, `monto_apertura`, `diferencia`, `monto_declarado`, `observaciones`, `id_caja`) VALUES
(2, '2019-02-01 12:17:12', '2019-02-01 16:40:28', '100.00', '-1900.00', '2000.00', NULL, 1),
(4, '2019-02-01 16:43:26', '2019-02-01 16:44:42', '500.00', '400.00', '100.00', 'nbmbn', 1),
(5, '2019-02-01 16:54:05', '2019-02-01 16:56:52', '1000.00', '500.00', '20000.00', NULL, 1),
(6, '2019-02-01 17:08:57', '2019-02-01 18:15:56', '100.00', '200.00', '5000.00', NULL, 1),
(7, '2019-02-06 11:48:20', '2019-02-06 12:05:36', '1.00', '0.00', '0.00', NULL, 1),
(8, '2019-02-06 12:05:40', NULL, '0.00', NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja_chica_detalle`
--

CREATE TABLE `caja_chica_detalle` (
  `id_detalle` int(11) NOT NULL,
  `b200` int(11) DEFAULT NULL,
  `b100` int(11) DEFAULT NULL,
  `b50` int(11) DEFAULT NULL,
  `b20` int(11) DEFAULT NULL,
  `b10` int(11) DEFAULT NULL,
  `m5` int(11) DEFAULT NULL,
  `m2` int(11) DEFAULT NULL,
  `m1` int(11) DEFAULT NULL,
  `c50` int(11) DEFAULT NULL,
  `c20` int(11) DEFAULT NULL,
  `c10` int(11) DEFAULT NULL,
  `id_caja_chica` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cambio`
--

CREATE TABLE `cambio` (
  `id_cambio` int(11) NOT NULL,
  `id_moneda_1` int(11) DEFAULT NULL,
  `id_moneda_2` int(11) DEFAULT NULL,
  `valor_de_cambio` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `id_cargo` int(11) NOT NULL,
  `nombre` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`id_cargo`, `nombre`) VALUES
(21, 'Administración'),
(22, 'Almacen'),
(19, 'Contabilidad'),
(20, 'Ventas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `descripcion` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `categoria`, `descripcion`) VALUES
(30, 'Bisagras', 'Bisagras para los muebles que se elaboran en la empresa'),
(31, 'Melanico', 'Melaminicos de todos los colores'),
(37, 'madera', 'Madera Para Utilizar en las puertas como llistones'),
(39, 'Cintas', 'Cintas Para los bordes para los muebles');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `id_ciudad` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `id_pais` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`id_ciudad`, `nombre`, `id_pais`) VALUES
(1, 'Sucre', 1),
(2, 'La Paz', 1),
(3, 'Oruro', 1),
(4, 'Santa Cruz', 1),
(5, 'Potosí', 1),
(6, 'Pando', 1),
(7, 'Beni', 1),
(8, 'Tarija', 1),
(9, 'Cochabamba', 1),
(10, '-', 1),
(11, 'jghkjhkjhkj', 1),
(12, 'ooopppp', 1),
(13, 'jhkjhkjh', 3),
(14, 'qweqweqw', 3),
(15, 'qweqwe', 3),
(16, 'qweqw', 3),
(17, 'qweqwe', 3),
(18, 'qeqwe', 3),
(19, 'q', 5),
(20, 'e', 5),
(21, 'jhgjhg', 9),
(22, 'ciudad 2', 9),
(23, 'ciudad 3', 9),
(24, 'ciudad 4', 9),
(25, 'ciudad 4', 9),
(26, 'ciudad 4', 9),
(27, 'ciudad 4', 9),
(28, 'sss', 9),
(29, 'aaaaa', 9),
(30, 'algo', 10),
(31, 'Sucre', 12),
(32, 'Salta', 10),
(33, 'Sal2', 10),
(34, 'Villa2', 10),
(35, 'Potosi', 12),
(36, 'Ciudad 1 edu', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `razon_social` varchar(200) DEFAULT NULL,
  `nit` varchar(32) DEFAULT NULL,
  `actividad` varchar(200) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `celular` varchar(15) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `id_ciudad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `razon_social`, `nit`, `actividad`, `telefono`, `celular`, `correo`, `direccion`, `id_ciudad`) VALUES
(1, 'jkhkjhk', '76786786', '678687678', NULL, NULL, NULL, NULL, NULL),
(2, 'Ernesto', '987654', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Romulo', '46545646', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Rosa Fernandes', '165432215', NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'Ramiro Ramires', '64654', 'jkdgjkhj', '4565456', '545646', 'eqweqw', NULL, 1),
(6, 'Maria Martinez', '465456', 'Cosas', '4564546', '565464454', 'hjkhjkjkjk', '6546546', NULL),
(7, 'S/N', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Leo', '45464', NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'Sergio Gutierez', '555666', NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'Teresa Rogelia', '555777', NULL, NULL, NULL, NULL, NULL, 5),
(11, 'Teresa Romelia', '22221111', NULL, NULL, NULL, NULL, NULL, 35),
(12, 'Produccion prueba', '222555', NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'Prueba 1', '5554444', NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'Prueba 2', '46546545', NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'Prueba 5', '55554444', NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'prueba 10', '10101010', NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'Prueba 20', '32323232232332', NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'Prueba 30', '30303030', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id_compra` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `descuento` decimal(10,2) DEFAULT NULL,
  `costo_total` decimal(10,2) DEFAULT NULL,
  `codigo_tarjeta_cheque` varchar(36) DEFAULT NULL,
  `nro_factura` varchar(50) DEFAULT NULL,
  `observaciones` text,
  `estatus` char(2) DEFAULT NULL,
  `id_moneda` int(11) DEFAULT NULL,
  `id_empleado` int(11) DEFAULT NULL,
  `id_proveedor` int(11) DEFAULT NULL,
  `tipo_pago` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`id_compra`, `fecha`, `descuento`, `costo_total`, `codigo_tarjeta_cheque`, `nro_factura`, `observaciones`, `estatus`, `id_moneda`, `id_empleado`, `id_proveedor`, `tipo_pago`) VALUES
(35, '2019-01-17', '0.00', '1311.00', '4564646', '45654564', 'jwwkhfjkwh', NULL, 1, 18, 2, 'ef'),
(36, '2019-01-17', '0.00', '123.00', NULL, NULL, 'jhgjkhkjhkj', NULL, 1, 18, NULL, 'ef'),
(37, '2019-01-17', '0.00', '5416.00', NULL, NULL, NULL, NULL, 1, 18, NULL, 'ef'),
(38, '2019-01-17', '0.00', '260.00', NULL, NULL, NULL, NULL, 1, 18, NULL, 'ef'),
(39, '2019-01-17', '0.00', '250.00', NULL, NULL, NULL, NULL, 1, 18, NULL, 'ef'),
(40, '2019-01-21', '0.00', '525.00', NULL, NULL, NULL, NULL, 1, 17, NULL, 'ef'),
(41, '2019-01-21', '96.00', '396.00', NULL, NULL, NULL, NULL, 1, 17, NULL, 'ef'),
(42, '2019-01-21', '0.00', '350.00', NULL, NULL, NULL, 'cv', 1, 18, NULL, 'cr'),
(43, '2019-01-22', '10.00', '300.00', NULL, NULL, NULL, 'cv', 1, 17, NULL, 'cr'),
(44, '2019-01-22', '0.00', '2988.00', NULL, NULL, NULL, NULL, 1, 18, 1, 'ef'),
(45, '2019-01-25', '0.00', '667.00', NULL, NULL, NULL, NULL, 1, 17, NULL, 'ef'),
(46, '2019-01-25', '0.00', '500.00', NULL, NULL, NULL, NULL, 1, 17, NULL, 'ef'),
(47, '2019-01-25', '0.00', '600.00', NULL, NULL, NULL, NULL, 1, 17, NULL, 'ef'),
(48, '2019-01-30', '0.00', '700.00', NULL, NULL, NULL, NULL, 1, 18, NULL, 'ef'),
(49, '2019-01-31', '0.00', '100.00', NULL, NULL, NULL, NULL, 1, 18, NULL, 'ef'),
(50, '2019-01-31', '0.00', '100.00', NULL, NULL, NULL, NULL, 1, 18, NULL, 'ef'),
(51, '2019-02-06', '0.00', '200.00', NULL, '33', NULL, NULL, 1, 17, 2, 'ef'),
(52, '2019-02-08', '0.00', '250.00', NULL, NULL, NULL, NULL, 1, 24, NULL, 'ef');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra_credito`
--

CREATE TABLE `compra_credito` (
  `id` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `monto` decimal(10,2) NOT NULL,
  `tipo_pago` char(2) NOT NULL,
  `observaciones` text,
  `id_compra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compra_credito`
--

INSERT INTO `compra_credito` (`id`, `fecha`, `monto`, `tipo_pago`, `observaciones`, `id_compra`) VALUES
(66, '2019-01-22 11:57:34', '34.00', 'ef', NULL, 42);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `id_contacto` int(11) NOT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `interno` varchar(15) DEFAULT NULL,
  `celular` varchar(15) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL,
  `estatus` char(1) DEFAULT NULL,
  `id_proveedor` int(11) DEFAULT NULL,
  `id_cargo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`id_contacto`, `nombre`, `telefono`, `interno`, `celular`, `correo`, `fecha_registro`, `estatus`, `id_proveedor`, `id_cargo`) VALUES
(1, 'qweweqweqw', '214214', NULL, NULL, NULL, '2019-01-07', NULL, 1, 20),
(2, 'Bolivia', '214214', '43324', '4232', '23432s', '2019-01-07', NULL, 1, 20),
(3, 'Bolivia', '21421423', '322323', '4232', '23432wq', '2019-01-07', NULL, 1, 20),
(4, 'qweweqweqw', '214214', '43324', '4232', '23432e', '2019-01-07', NULL, 2, 20),
(5, 'Pil', '54564', NULL, NULL, NULL, '2019-01-16', NULL, 1, 20),
(6, 'Pil dos', '232', NULL, NULL, '41', '2019-01-16', NULL, 1, 20),
(7, 'pil 3', '41654', NULL, NULL, '234322', '2019-01-16', NULL, 1, 20),
(8, 'Pil 4', NULL, NULL, NULL, '456', '2019-01-16', NULL, 1, 20),
(9, 'Pil 5', '4564', NULL, NULL, NULL, '2019-01-16', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta`
--

CREATE TABLE `cuenta` (
  `id_cuenta` int(11) NOT NULL,
  `entidad` varchar(50) DEFAULT NULL,
  `nro_cuenta` varchar(50) DEFAULT NULL,
  `id_moneda` int(11) DEFAULT NULL,
  `id_empresa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta_proveedor`
--

CREATE TABLE `cuenta_proveedor` (
  `id_cuenta` int(11) NOT NULL,
  `entidad` varchar(50) DEFAULT NULL,
  `nro_cuenta` varchar(50) DEFAULT NULL,
  `id_moneda` int(11) DEFAULT NULL,
  `id_proveedor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cuenta_proveedor`
--

INSERT INTO `cuenta_proveedor` (`id_cuenta`, `entidad`, `nro_cuenta`, `id_moneda`, `id_proveedor`) VALUES
(1, 'Banco Sol', '125352545', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra`
--

CREATE TABLE `detalle_compra` (
  `id_detalle_compra` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio_unitario` decimal(10,0) DEFAULT NULL,
  `id_articulo` int(11) DEFAULT NULL,
  `id_almacen` int(11) DEFAULT NULL,
  `id_compra` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_compra`
--

INSERT INTO `detalle_compra` (`id_detalle_compra`, `cantidad`, `precio_unitario`, `id_articulo`, `id_almacen`, `id_compra`) VALUES
(57, 33, '23', 16, 4, 35),
(58, 29, '19', 15, 4, 35),
(59, 41, '3', 16, 4, 36),
(60, 100, '54', 18, 4, 37),
(61, 4, '4', 15, 4, 37),
(62, 10, '25', 16, 4, 38),
(63, 2, '5', 18, 4, 38),
(64, 10, '25', 18, 4, 39),
(65, 11, '25', 17, 4, 40),
(66, 10, '25', 18, 4, 40),
(67, 12, '12', 17, 2, 41),
(68, 12, '21', 18, 2, 41),
(69, 10, '25', 15, 4, 42),
(70, 10, '10', 18, 4, 42),
(71, 10, '12', 18, 1, 43),
(72, 15, '12', 17, 1, 43),
(73, 12, '15', 17, 1, 44),
(74, 54, '52', 16, 1, 44),
(75, 25, '25', 22, 5, 45),
(76, 21, '2', 21, 5, 45),
(77, 100, '5', 16, 4, 46),
(78, 12, '50', 16, 1, 47),
(79, 100, '2', 20, 6, 48),
(80, 20, '25', 16, 6, 48),
(81, 10, '10', 19, 4, 49),
(82, 100, '1', 16, 6, 50),
(83, 10, '20', 17, 4, 51),
(84, 10, '25', 17, 4, 52);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_produccion`
--

CREATE TABLE `detalle_produccion` (
  `id_detalle_produccion` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `ancho` decimal(10,2) DEFAULT NULL,
  `alto` decimal(10,2) DEFAULT NULL,
  `id_articulo` int(11) DEFAULT NULL,
  `id_produccion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `id_detalle_venta` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `id_articulo` int(11) DEFAULT NULL,
  `id_venta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`id_detalle_venta`, `cantidad`, `precio_unitario`, `id_articulo`, `id_venta`) VALUES
(143, 10, '10.00', 16, 43),
(144, 1, '10.00', 17, 43),
(145, 10, '10.00', 17, 44),
(146, 10, '10.00', 16, 44),
(147, 10, '10.00', 16, 45),
(149, 10, '10.00', 16, 47),
(151, 10, '10.00', 16, 49),
(152, 10, '10.00', 16, 50),
(153, 1, '50.00', 19, 51),
(154, 1, '10.00', 16, 51);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dimensiones`
--

CREATE TABLE `dimensiones` (
  `id_articulo` int(11) NOT NULL,
  `largo` decimal(10,0) DEFAULT NULL,
  `ancho` decimal(10,0) DEFAULT NULL,
  `espesor` decimal(10,0) DEFAULT NULL,
  `volumen` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `dimensiones`
--

INSERT INTO `dimensiones` (`id_articulo`, `largo`, `ancho`, `espesor`, `volumen`) VALUES
(16, '20', '40', '1', '800'),
(17, '20', '81', '1', '1620'),
(19, '121', '21', '21', '0'),
(20, '45', '45', '40', '0'),
(21, '40', '52', '10', '20800'),
(23, '250', '195', '1', '24375');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dosificacion`
--

CREATE TABLE `dosificacion` (
  `id_dosificacion` int(11) NOT NULL,
  `nro_autorizacion` varchar(50) DEFAULT NULL,
  `fecha_limite_emision` date DEFAULT NULL,
  `nro_inicial` int(11) DEFAULT NULL,
  `nro_final` int(11) DEFAULT NULL,
  `llave` longtext,
  `leyenda` tinytext,
  `estatus` char(1) DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id_empleado` int(11) NOT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `ci` char(15) DEFAULT NULL,
  `sexo` char(1) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `celular` varchar(15) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `foto` char(255) DEFAULT NULL,
  `persona_referencia` varchar(200) DEFAULT NULL,
  `telefono_referencia` varchar(15) DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL,
  `estatus` char(1) DEFAULT NULL,
  `id_almacen` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id_empleado`, `nombre`, `ci`, `sexo`, `fecha_nacimiento`, `telefono`, `celular`, `correo`, `direccion`, `foto`, `persona_referencia`, `telefono_referencia`, `fecha_registro`, `estatus`, `id_almacen`) VALUES
(17, 'Bolivia', '87687687', 'm', '2000-01-18', '214214', '4232', '23432', 'iuqhjkhjkhk', '1547042188logo-icon.png', 'hhjgjhghj', '5757576', '2019-01-09', '1', 4),
(18, 'Rider', '8998696', 'm', '2016-11-29', '4343', '4232', '87896798', 'we', '', 'hhjgjhghj', '5757576', '2019-01-10', '1', 6),
(19, 'Jose Jose', '549247', 'm', '1995-01-10', '6410244', '73402108', '', 'Japon # 25', '1547157899b1.jpg', 'pedro', '42565566', '2019-01-10', '1', 3),
(24, 'Empleado', '456564', '', NULL, NULL, NULL, NULL, '', '', '', '', '2019-01-29', '1', 4),
(25, 'Empleado 2', '56456456', '', NULL, NULL, NULL, NULL, '', '', '', '', '2019-01-29', '1', 1),
(26, 'Jose Luis Coronado Anagua', '5492796011', 'm', '1985-06-21', '46410244', '73402108', 'pepejlc@gmail.com', 'PLaza 25 de Mayo Nº 25', '1549481830capitan america.jpg', 'Jose Jose', '73412345', '2019-02-06', '1', 3),
(27, 'Admin', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL),
(28, 'Jose Luis Coronado', '5492796', 'm', '1983-06-21', '6410244', '73402108', 'openredkt@gmail.com', 'Sucebo 54', '', 'pedro', '42565566', '2019-02-08', '1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id_empresa` int(11) NOT NULL,
  `razon_social` varchar(200) DEFAULT NULL,
  `nit` varchar(32) DEFAULT NULL,
  `propietario` varchar(50) DEFAULT NULL,
  `actividad` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id_empresa`, `razon_social`, `nit`, `propietario`, `actividad`) VALUES
(1, 'ALLISON', '1234567012', 'Orlando Barron', 'Venta de Puertas  y Ventanas'),
(2, 'TABLETEC-POTOSI', '1234567013', 'Orlando Barron', 'Muebleria'),
(3, 'TABLETEC', '1234567011', 'Orlando Barron', 'Produccion de Muebles'),
(4, 'TABLETEC-CBBA', '1234567014', 'Jose Jose', 'Venta de Muebles - Puertas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fabricante`
--

CREATE TABLE `fabricante` (
  `id_fabricante` int(11) NOT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `contacto` varchar(36) DEFAULT NULL,
  `sitio_web` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `fabricante`
--

INSERT INTO `fabricante` (`id_fabricante`, `nombre`, `contacto`, `sitio_web`) VALUES
(1, 'fabricante1', '2312', 'Mi sitio'),
(2, 'fabricante2', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id_factura` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `codigo_control` varchar(50) DEFAULT NULL,
  `codigo_qr` text,
  `nro_factura` varchar(50) DEFAULT NULL,
  `nit` varchar(32) DEFAULT NULL,
  `importe_credito_fiscal` decimal(10,0) DEFAULT NULL,
  `observaciones` text,
  `id_dosificacion` int(11) DEFAULT NULL,
  `id_venta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gasto`
--

CREATE TABLE `gasto` (
  `id` int(11) NOT NULL,
  `monto` decimal(10,0) DEFAULT NULL,
  `fecha` datetime NOT NULL,
  `descripcion` text,
  `id_caja` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `impuesto`
--

CREATE TABLE `impuesto` (
  `id_impuesto` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `alicuota` decimal(10,0) DEFAULT NULL,
  `estatus` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `impuesto_articulo`
--

CREATE TABLE `impuesto_articulo` (
  `id_impuesto_articulo` int(11) NOT NULL,
  `id_impuesto` int(11) DEFAULT NULL,
  `id_articulo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kardex`
--

CREATE TABLE `kardex` (
  `id_kardex` int(11) NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_baja` date DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL,
  `id_empleado` int(11) DEFAULT NULL,
  `id_cargo` int(11) DEFAULT NULL,
  `id_tipo_empleado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `kardex`
--

INSERT INTO `kardex` (`id_kardex`, `fecha_inicio`, `fecha_baja`, `fecha_registro`, `id_empleado`, `id_cargo`, `id_tipo_empleado`) VALUES
(20, '2019-02-19', NULL, '2019-01-22', 17, 21, NULL),
(21, '2019-02-01', NULL, '2019-02-08', 28, 21, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kardex_observaciones`
--

CREATE TABLE `kardex_observaciones` (
  `id_kardex_observaciones` int(11) NOT NULL,
  `id_kardex` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `observacion` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mediciones`
--

CREATE TABLE `mediciones` (
  `id` int(11) NOT NULL,
  `fecha_visita` datetime NOT NULL,
  `direccion` text NOT NULL,
  `descripcion_direccion` text NOT NULL,
  `observaciones` text,
  `id_cliente` int(11) DEFAULT NULL,
  `id_empleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `mediciones`
--

INSERT INTO `mediciones` (`id`, `fecha_visita`, `direccion`, `descripcion_direccion`, `observaciones`, `id_cliente`, `id_empleado`) VALUES
(3, '2019-02-14 10:24:00', 'Calle 25 de mayo #456', 'Plaza 25', NULL, 6, 27);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mediciones_detalle`
--

CREATE TABLE `mediciones_detalle` (
  `id` int(11) NOT NULL,
  `descripcion` tinytext NOT NULL,
  `ancho` decimal(10,2) NOT NULL,
  `alto` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `ubicacion` tinytext,
  `id_medicion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `mediciones_detalle`
--

INSERT INTO `mediciones_detalle` (`id`, `descripcion`, `ancho`, `alto`, `cantidad`, `ubicacion`, `id_medicion`) VALUES
(3, 'Puerta', '23.00', '3.00', 3, 'terraza', 3),
(4, 'Puerta', '54.00', '545.00', 23, 'Primer piso', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `moneda`
--

CREATE TABLE `moneda` (
  `id_moneda` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `codigo` char(16) DEFAULT NULL,
  `id_pais` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `moneda`
--

INSERT INTO `moneda` (`id_moneda`, `nombre`, `codigo`, `id_pais`) VALUES
(1, 'Bolivianos', 'BOB', 1),
(30, 'Dolares', 'Sus', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos_almacen`
--

CREATE TABLE `movimientos_almacen` (
  `id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `observaciones` text,
  `status` char(2) DEFAULT NULL,
  `id_empleado` int(11) NOT NULL,
  `id_almacen_origen` int(11) NOT NULL,
  `id_almacen_destino` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `movimientos_almacen`
--

INSERT INTO `movimientos_almacen` (`id`, `fecha`, `observaciones`, `status`, `id_empleado`, `id_almacen_origen`, `id_almacen_destino`) VALUES
(2, '2019-02-12 09:57:51', NULL, NULL, 17, 4, 3),
(3, '2019-02-12 09:58:13', 'jkhjkwqhekwqhejkwqhk', 'mc', 17, 4, 3),
(4, '2019-02-12 10:00:18', 'jkhjkwqhekwqhejkwqhk', 'mc', 17, 4, 3),
(5, '2019-02-12 10:19:06', NULL, NULL, 17, 5, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos_almacen_detalle`
--

CREATE TABLE `movimientos_almacen_detalle` (
  `id` int(11) NOT NULL,
  `id_articulo` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `id_movimiento_almacen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `movimientos_almacen_detalle`
--

INSERT INTO `movimientos_almacen_detalle` (`id`, `id_articulo`, `cantidad`, `id_movimiento_almacen`) VALUES
(1, 22, 10, 2),
(2, 16, 2, 2),
(3, 22, 10, 3),
(4, 16, 2, 3),
(5, 22, 10, 4),
(6, 16, 2, 4),
(7, 21, 10, 5),
(8, 20, 10, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE `pais` (
  `id_pais` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`id_pais`, `nombre`) VALUES
(10, 'Argentina'),
(1, 'Bolivia'),
(4, 'Brazil'),
(9, 'Chile'),
(12, 'Estados Unidos'),
(7, 'lor'),
(2, 'Olanda 3'),
(11, 'Paraguay'),
(3, 'Peru'),
(8, 'qwewqeq'),
(5, 'Rus'),
(6, 'wqeqweq');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `id_permiso` int(11) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`id_permiso`, `descripcion`) VALUES
(13, 'Panel de Administración'),
(14, 'Ventas'),
(15, 'Compras'),
(16, 'Artículo'),
(17, 'Caja'),
(18, 'Crear Cajas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso_usuario`
--

CREATE TABLE `permiso_usuario` (
  `id` int(11) NOT NULL,
  `id_permiso` int(11) DEFAULT NULL,
  `id_acceso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permiso_usuario`
--

INSERT INTO `permiso_usuario` (`id`, `id_permiso`, `id_acceso`) VALUES
(1, 13, 17),
(2, 14, 17),
(4, 15, 17),
(5, 17, 17),
(6, 16, 17),
(9, 14, 24),
(10, 13, 24),
(11, 18, 24),
(12, 15, 24),
(13, 17, 24),
(14, 16, 24),
(15, 14, 19),
(16, 13, 19),
(17, 18, 19),
(18, 15, 19),
(19, 17, 19),
(20, 16, 19),
(21, 14, 26),
(22, 13, 26),
(23, 18, 26),
(24, 15, 26),
(25, 17, 26),
(26, 16, 26);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pieza`
--

CREATE TABLE `pieza` (
  `id_pieza` int(11) NOT NULL,
  `id_articulo` int(11) DEFAULT NULL,
  `corte` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `produccion`
--

CREATE TABLE `produccion` (
  `id_produccion` int(11) NOT NULL,
  `observaciones` text,
  `id_empleado` int(11) DEFAULT NULL,
  `costo_total` decimal(10,2) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `status` char(2) NOT NULL,
  `tipo_pago` char(2) NOT NULL,
  `id_almacen` int(11) NOT NULL,
  `id_caja` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL,
  `razon_social` varchar(200) DEFAULT NULL,
  `nit` varchar(32) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `fax` varchar(15) DEFAULT NULL,
  `celular` varchar(15) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `sitio_web` varchar(50) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL,
  `rubro` varchar(50) DEFAULT NULL,
  `id_ciudad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_proveedor`, `razon_social`, `nit`, `telefono`, `fax`, `celular`, `correo`, `sitio_web`, `direccion`, `fecha_registro`, `rubro`, `id_ciudad`) VALUES
(1, 'EEEEEE', '12321', '214214', NULL, NULL, NULL, NULL, NULL, '2019-01-07', NULL, 5),
(2, 'Open red', '2242', '4343', '2434', '4232', '23432', '334', 'we', '2019-01-07', 'qrqwrw', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salario`
--

CREATE TABLE `salario` (
  `id_kardex` int(11) NOT NULL,
  `monto` decimal(10,0) DEFAULT NULL,
  `id_moneda` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `salario`
--

INSERT INTO `salario` (`id_kardex`, `monto`, `id_moneda`) VALUES
(20, '50', 30),
(21, '2500', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock`
--

CREATE TABLE `stock` (
  `id_stock` int(11) NOT NULL,
  `id_articulo` int(11) DEFAULT NULL,
  `id_almacen` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `stock`
--

INSERT INTO `stock` (`id_stock`, `id_articulo`, `id_almacen`, `cantidad`) VALUES
(1, 16, 4, 60),
(2, 15, 4, 1103),
(3, 17, 4, 103),
(7, 18, 1, 0),
(10, 22, 5, 25),
(11, 21, 5, 21),
(12, 16, 1, 12),
(13, 20, 6, 100),
(14, 16, 6, 150),
(15, 19, 4, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategoria`
--

CREATE TABLE `subcategoria` (
  `id_subcategoria` int(11) NOT NULL,
  `subcategoria` varchar(50) DEFAULT NULL,
  `descripcion` text,
  `id_categoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

CREATE TABLE `sucursal` (
  `id_sucursal` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `casa_matriz` tinyint(1) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `fecha_apertura` date DEFAULT NULL,
  `estatus` char(1) DEFAULT NULL,
  `id_ciudad` int(11) DEFAULT NULL,
  `id_empresa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sucursal`
--

INSERT INTO `sucursal` (`id_sucursal`, `nombre`, `casa_matriz`, `direccion`, `telefono`, `fecha_apertura`, `estatus`, `id_ciudad`, `id_empresa`) VALUES
(1, 'Potosi 1', 0, 'Boliva 233', '45554456', '2018-12-04', 'A', 1, 2),
(2, 'Sucre 1', 1, 'Junin 511', '6412345', '2018-12-20', 'A', 1, 3),
(3, 'Sucre 2', 1, 'Junin 511', '214214', '2019-01-17', NULL, 2, 3),
(4, 'Mercado Central', 1, 'Japon # 30', '6410244', '2019-01-10', NULL, 8, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_empleado`
--

CREATE TABLE `tipo_empleado` (
  `id_tipo_empleado` int(11) NOT NULL,
  `tipo` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_empleado`
--

INSERT INTO `tipo_empleado` (`id_tipo_empleado`, `tipo`) VALUES
(1, 'normal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id_venta` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `costo_total` decimal(10,0) DEFAULT NULL,
  `codigo_tarjeta_cheque` varchar(36) DEFAULT NULL,
  `descuento` decimal(10,0) DEFAULT NULL,
  `estatus` char(2) DEFAULT NULL,
  `id_almacen` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `id_moneda` int(11) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_caja` int(11) DEFAULT NULL,
  `tipo_pago` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id_venta`, `fecha`, `costo_total`, `codigo_tarjeta_cheque`, `descuento`, `estatus`, `id_almacen`, `id_empleado`, `id_moneda`, `id_cliente`, `id_caja`, `tipo_pago`) VALUES
(43, '2019-01-30', '110', NULL, '0', NULL, 4, 17, 1, 7, 1, 'ef'),
(44, '2019-01-30', '200', NULL, '0', NULL, 4, 17, 1, 7, 1, 'ef'),
(45, '2019-01-31', '100', NULL, '0', 'vc', 6, 18, 1, 7, 2, 'ef'),
(47, '2019-01-31', '100', NULL, '0', NULL, 6, 18, 1, 3, 2, 'ef'),
(49, '2019-01-31', '100', NULL, '0', 'cc', 6, 18, 1, 7, 2, 'cr'),
(50, '2019-01-31', '100', NULL, '0', NULL, 4, 17, 1, 7, 1, 'ef'),
(51, '2019-01-31', '60', NULL, '0', 'cv', 4, 17, 1, 7, 1, 'cr');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_credito`
--

CREATE TABLE `venta_credito` (
  `id` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `monto` decimal(10,2) NOT NULL,
  `tipo_pago` char(2) NOT NULL,
  `observaciones` text,
  `id_venta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `venta_credito`
--

INSERT INTO `venta_credito` (`id`, `fecha`, `monto`, `tipo_pago`, `observaciones`, `id_venta`) VALUES
(22, '2019-01-31 15:54:22', '50.00', 'ef', NULL, 49),
(23, '2019-01-31 15:54:27', '50.00', 'ef', NULL, 49),
(24, '2019-01-31 16:08:47', '10.00', 'ef', NULL, 51),
(25, '2019-01-31 16:08:50', '10.00', 'ef', NULL, 51),
(26, '2019-01-31 16:08:53', '10.00', 'ef', NULL, 51),
(27, '2019-01-31 16:09:00', '10.00', 'ef', NULL, 51),
(28, '2019-01-31 18:51:51', '5.00', 'ef', NULL, 51);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acceso`
--
ALTER TABLE `acceso`
  ADD PRIMARY KEY (`id_empleado`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- Indices de la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD PRIMARY KEY (`id_almacen`),
  ADD UNIQUE KEY `codigo` (`codigo`),
  ADD KEY `id_sucursal` (`id_sucursal`);

--
-- Indices de la tabla `articulo`
--
ALTER TABLE `articulo`
  ADD PRIMARY KEY (`id_articulo`),
  ADD UNIQUE KEY `codigo` (`codigo`),
  ADD KEY `id_fabricante` (`id_fabricante`),
  ADD KEY `articulo_ibfk_1` (`id_categoria`);

--
-- Indices de la tabla `articulos_sucursales`
--
ALTER TABLE `articulos_sucursales`
  ADD PRIMARY KEY (`id_articulo`,`id_sucursal`),
  ADD KEY `id_sucursal` (`id_sucursal`);

--
-- Indices de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_empleado` (`id_empleado`);

--
-- Indices de la tabla `caja`
--
ALTER TABLE `caja`
  ADD PRIMARY KEY (`id_caja`),
  ADD KEY `id_empleado` (`id_empleado`);

--
-- Indices de la tabla `caja_chica`
--
ALTER TABLE `caja_chica`
  ADD PRIMARY KEY (`id_caja_chica`),
  ADD KEY `id_caja` (`id_caja`);

--
-- Indices de la tabla `caja_chica_detalle`
--
ALTER TABLE `caja_chica_detalle`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_caja_chica` (`id_caja_chica`);

--
-- Indices de la tabla `cambio`
--
ALTER TABLE `cambio`
  ADD PRIMARY KEY (`id_cambio`),
  ADD KEY `id_moneda_1` (`id_moneda_1`),
  ADD KEY `id_moneda_2` (`id_moneda_2`);

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id_cargo`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`id_ciudad`),
  ADD KEY `id_pais` (`id_pais`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `nit` (`nit`),
  ADD KEY `id_ciudad` (`id_ciudad`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `id_moneda` (`id_moneda`),
  ADD KEY `id_empleado` (`id_empleado`),
  ADD KEY `compra_ibfk_3` (`id_proveedor`);

--
-- Indices de la tabla `compra_credito`
--
ALTER TABLE `compra_credito`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_compra` (`id_compra`);

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`id_contacto`),
  ADD KEY `id_proveedor` (`id_proveedor`),
  ADD KEY `id_cargo` (`id_cargo`);

--
-- Indices de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD PRIMARY KEY (`id_cuenta`),
  ADD KEY `id_empresa` (`id_empresa`),
  ADD KEY `id_moneda` (`id_moneda`);

--
-- Indices de la tabla `cuenta_proveedor`
--
ALTER TABLE `cuenta_proveedor`
  ADD PRIMARY KEY (`id_cuenta`),
  ADD KEY `id_moneda` (`id_moneda`),
  ADD KEY `id_proveedor` (`id_proveedor`);

--
-- Indices de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD PRIMARY KEY (`id_detalle_compra`),
  ADD KEY `id_articulo` (`id_articulo`),
  ADD KEY `id_almacen` (`id_almacen`),
  ADD KEY `id_compra` (`id_compra`);

--
-- Indices de la tabla `detalle_produccion`
--
ALTER TABLE `detalle_produccion`
  ADD PRIMARY KEY (`id_detalle_produccion`),
  ADD KEY `id_articulo` (`id_articulo`),
  ADD KEY `id_produccion` (`id_produccion`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`id_detalle_venta`),
  ADD KEY `id_articulo` (`id_articulo`),
  ADD KEY `id_venta` (`id_venta`);

--
-- Indices de la tabla `dimensiones`
--
ALTER TABLE `dimensiones`
  ADD PRIMARY KEY (`id_articulo`);

--
-- Indices de la tabla `dosificacion`
--
ALTER TABLE `dosificacion`
  ADD PRIMARY KEY (`id_dosificacion`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id_empleado`),
  ADD UNIQUE KEY `ci` (`ci`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `empleado_ibfk_1` (`id_almacen`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id_empresa`),
  ADD UNIQUE KEY `nit` (`nit`);

--
-- Indices de la tabla `fabricante`
--
ALTER TABLE `fabricante`
  ADD PRIMARY KEY (`id_fabricante`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id_factura`),
  ADD KEY `id_dosificacion` (`id_dosificacion`),
  ADD KEY `id_venta` (`id_venta`);

--
-- Indices de la tabla `gasto`
--
ALTER TABLE `gasto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_empleado` (`id_empleado`),
  ADD KEY `id_caja` (`id_caja`);

--
-- Indices de la tabla `impuesto`
--
ALTER TABLE `impuesto`
  ADD PRIMARY KEY (`id_impuesto`);

--
-- Indices de la tabla `impuesto_articulo`
--
ALTER TABLE `impuesto_articulo`
  ADD PRIMARY KEY (`id_impuesto_articulo`),
  ADD KEY `id_impuesto` (`id_impuesto`),
  ADD KEY `id_articulo` (`id_articulo`);

--
-- Indices de la tabla `kardex`
--
ALTER TABLE `kardex`
  ADD PRIMARY KEY (`id_kardex`),
  ADD KEY `id_empleado` (`id_empleado`),
  ADD KEY `id_cargo` (`id_cargo`),
  ADD KEY `id_tipo_empleado` (`id_tipo_empleado`);

--
-- Indices de la tabla `kardex_observaciones`
--
ALTER TABLE `kardex_observaciones`
  ADD PRIMARY KEY (`id_kardex_observaciones`),
  ADD KEY `id_kardex` (`id_kardex`);

--
-- Indices de la tabla `mediciones`
--
ALTER TABLE `mediciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_empleado` (`id_empleado`);

--
-- Indices de la tabla `mediciones_detalle`
--
ALTER TABLE `mediciones_detalle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_medicion` (`id_medicion`);

--
-- Indices de la tabla `moneda`
--
ALTER TABLE `moneda`
  ADD PRIMARY KEY (`id_moneda`),
  ADD KEY `id_pais` (`id_pais`);

--
-- Indices de la tabla `movimientos_almacen`
--
ALTER TABLE `movimientos_almacen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_almacen_destino` (`id_almacen_destino`),
  ADD KEY `id_almacen_origen` (`id_almacen_origen`),
  ADD KEY `id_empleado` (`id_empleado`);

--
-- Indices de la tabla `movimientos_almacen_detalle`
--
ALTER TABLE `movimientos_almacen_detalle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_articulo` (`id_articulo`),
  ADD KEY `id_movimiento_almacen` (`id_movimiento_almacen`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`id_pais`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`id_permiso`);

--
-- Indices de la tabla `permiso_usuario`
--
ALTER TABLE `permiso_usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_permiso` (`id_permiso`),
  ADD KEY `id_acceso` (`id_acceso`);

--
-- Indices de la tabla `pieza`
--
ALTER TABLE `pieza`
  ADD PRIMARY KEY (`id_pieza`),
  ADD KEY `id_articulo` (`id_articulo`);

--
-- Indices de la tabla `produccion`
--
ALTER TABLE `produccion`
  ADD PRIMARY KEY (`id_produccion`),
  ADD KEY `id_empleado` (`id_empleado`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_caja` (`id_caja`),
  ADD KEY `id_almacen` (`id_almacen`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_proveedor`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `id_ciudad` (`id_ciudad`);

--
-- Indices de la tabla `salario`
--
ALTER TABLE `salario`
  ADD PRIMARY KEY (`id_kardex`),
  ADD KEY `id_moneda` (`id_moneda`);

--
-- Indices de la tabla `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id_stock`),
  ADD UNIQUE KEY `id_articulo` (`id_articulo`,`id_almacen`),
  ADD KEY `id_almacen` (`id_almacen`);

--
-- Indices de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD PRIMARY KEY (`id_subcategoria`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD PRIMARY KEY (`id_sucursal`),
  ADD UNIQUE KEY `nombre` (`nombre`),
  ADD KEY `id_ciudad` (`id_ciudad`),
  ADD KEY `id_empresa` (`id_empresa`);

--
-- Indices de la tabla `tipo_empleado`
--
ALTER TABLE `tipo_empleado`
  ADD PRIMARY KEY (`id_tipo_empleado`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `id_moneda` (`id_moneda`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_caja` (`id_caja`),
  ADD KEY `id_empleado` (`id_empleado`),
  ADD KEY `id_almacen` (`id_almacen`);

--
-- Indices de la tabla `venta_credito`
--
ALTER TABLE `venta_credito`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_venta` (`id_venta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `almacen`
--
ALTER TABLE `almacen`
  MODIFY `id_almacen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `articulo`
--
ALTER TABLE `articulo`
  MODIFY `id_articulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `id_caja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `caja_chica`
--
ALTER TABLE `caja_chica`
  MODIFY `id_caja_chica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `caja_chica_detalle`
--
ALTER TABLE `caja_chica_detalle`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cambio`
--
ALTER TABLE `cambio`
  MODIFY `id_cambio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `id_cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `id_ciudad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `compra_credito`
--
ALTER TABLE `compra_credito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
  MODIFY `id_contacto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  MODIFY `id_cuenta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cuenta_proveedor`
--
ALTER TABLE `cuenta_proveedor`
  MODIFY `id_cuenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  MODIFY `id_detalle_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT de la tabla `detalle_produccion`
--
ALTER TABLE `detalle_produccion`
  MODIFY `id_detalle_produccion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id_detalle_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT de la tabla `dosificacion`
--
ALTER TABLE `dosificacion`
  MODIFY `id_dosificacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `fabricante`
--
ALTER TABLE `fabricante`
  MODIFY `id_fabricante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gasto`
--
ALTER TABLE `gasto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `impuesto`
--
ALTER TABLE `impuesto`
  MODIFY `id_impuesto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `impuesto_articulo`
--
ALTER TABLE `impuesto_articulo`
  MODIFY `id_impuesto_articulo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `kardex`
--
ALTER TABLE `kardex`
  MODIFY `id_kardex` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `kardex_observaciones`
--
ALTER TABLE `kardex_observaciones`
  MODIFY `id_kardex_observaciones` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mediciones`
--
ALTER TABLE `mediciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `mediciones_detalle`
--
ALTER TABLE `mediciones_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `moneda`
--
ALTER TABLE `moneda`
  MODIFY `id_moneda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `movimientos_almacen`
--
ALTER TABLE `movimientos_almacen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `movimientos_almacen_detalle`
--
ALTER TABLE `movimientos_almacen_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
  MODIFY `id_pais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `permiso_usuario`
--
ALTER TABLE `permiso_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `pieza`
--
ALTER TABLE `pieza`
  MODIFY `id_pieza` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `produccion`
--
ALTER TABLE `produccion`
  MODIFY `id_produccion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `stock`
--
ALTER TABLE `stock`
  MODIFY `id_stock` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  MODIFY `id_subcategoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  MODIFY `id_sucursal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo_empleado`
--
ALTER TABLE `tipo_empleado`
  MODIFY `id_tipo_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `venta_credito`
--
ALTER TABLE `venta_credito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `acceso`
--
ALTER TABLE `acceso`
  ADD CONSTRAINT `acceso_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD CONSTRAINT `almacen_ibfk_1` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursal` (`id_sucursal`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `articulo`
--
ALTER TABLE `articulo`
  ADD CONSTRAINT `articulo_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON UPDATE CASCADE,
  ADD CONSTRAINT `articulo_ibfk_2` FOREIGN KEY (`id_fabricante`) REFERENCES `fabricante` (`id_fabricante`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `articulos_sucursales`
--
ALTER TABLE `articulos_sucursales`
  ADD CONSTRAINT `articulos_sucursales_ibfk_1` FOREIGN KEY (`id_articulo`) REFERENCES `articulo` (`id_articulo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `articulos_sucursales_ibfk_2` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursal` (`id_sucursal`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD CONSTRAINT `bitacora_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`);

--
-- Filtros para la tabla `caja`
--
ALTER TABLE `caja`
  ADD CONSTRAINT `caja_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `caja_chica`
--
ALTER TABLE `caja_chica`
  ADD CONSTRAINT `caja_chica_ibfk_1` FOREIGN KEY (`id_caja`) REFERENCES `caja` (`id_caja`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `caja_chica_detalle`
--
ALTER TABLE `caja_chica_detalle`
  ADD CONSTRAINT `caja_chica_detalle_ibfk_1` FOREIGN KEY (`id_caja_chica`) REFERENCES `caja_chica` (`id_caja_chica`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cambio`
--
ALTER TABLE `cambio`
  ADD CONSTRAINT `cambio_ibfk_1` FOREIGN KEY (`id_moneda_1`) REFERENCES `moneda` (`id_moneda`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cambio_ibfk_2` FOREIGN KEY (`id_moneda_2`) REFERENCES `moneda` (`id_moneda`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD CONSTRAINT `ciudad_ibfk_1` FOREIGN KEY (`id_pais`) REFERENCES `pais` (`id_pais`);

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`id_ciudad`) REFERENCES `ciudad` (`id_ciudad`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`id_moneda`) REFERENCES `moneda` (`id_moneda`) ON UPDATE CASCADE,
  ADD CONSTRAINT `compra_ibfk_2` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`) ON UPDATE CASCADE,
  ADD CONSTRAINT `compra_ibfk_3` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `compra_credito`
--
ALTER TABLE `compra_credito`
  ADD CONSTRAINT `compra_credito_ibfk_1` FOREIGN KEY (`id_compra`) REFERENCES `compra` (`id_compra`);

--
-- Filtros para la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD CONSTRAINT `contacto_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contacto_ibfk_2` FOREIGN KEY (`id_cargo`) REFERENCES `cargo` (`id_cargo`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD CONSTRAINT `cuenta_ibfk_1` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id_empresa`) ON UPDATE CASCADE,
  ADD CONSTRAINT `cuenta_ibfk_2` FOREIGN KEY (`id_moneda`) REFERENCES `moneda` (`id_moneda`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `cuenta_proveedor`
--
ALTER TABLE `cuenta_proveedor`
  ADD CONSTRAINT `cuenta_proveedor_ibfk_1` FOREIGN KEY (`id_moneda`) REFERENCES `moneda` (`id_moneda`) ON UPDATE CASCADE,
  ADD CONSTRAINT `cuenta_proveedor_ibfk_2` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD CONSTRAINT `detalle_compra_ibfk_1` FOREIGN KEY (`id_articulo`) REFERENCES `articulo` (`id_articulo`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_compra_ibfk_2` FOREIGN KEY (`id_almacen`) REFERENCES `almacen` (`id_almacen`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_compra_ibfk_3` FOREIGN KEY (`id_compra`) REFERENCES `compra` (`id_compra`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_produccion`
--
ALTER TABLE `detalle_produccion`
  ADD CONSTRAINT `detalle_produccion_ibfk_1` FOREIGN KEY (`id_articulo`) REFERENCES `articulo` (`id_articulo`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_produccion_ibfk_3` FOREIGN KEY (`id_produccion`) REFERENCES `produccion` (`id_produccion`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `detalle_venta_ibfk_1` FOREIGN KEY (`id_articulo`) REFERENCES `articulo` (`id_articulo`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_venta_ibfk_3` FOREIGN KEY (`id_venta`) REFERENCES `venta` (`id_venta`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `dimensiones`
--
ALTER TABLE `dimensiones`
  ADD CONSTRAINT `dimensiones_ibfk_1` FOREIGN KEY (`id_articulo`) REFERENCES `articulo` (`id_articulo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`id_almacen`) REFERENCES `almacen` (`id_almacen`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`id_dosificacion`) REFERENCES `dosificacion` (`id_dosificacion`) ON UPDATE CASCADE,
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`id_venta`) REFERENCES `venta` (`id_venta`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `gasto`
--
ALTER TABLE `gasto`
  ADD CONSTRAINT `gasto_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gasto_ibfk_2` FOREIGN KEY (`id_caja`) REFERENCES `caja` (`id_caja`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `impuesto_articulo`
--
ALTER TABLE `impuesto_articulo`
  ADD CONSTRAINT `impuesto_articulo_ibfk_1` FOREIGN KEY (`id_impuesto`) REFERENCES `impuesto` (`id_impuesto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `impuesto_articulo_ibfk_2` FOREIGN KEY (`id_articulo`) REFERENCES `articulo` (`id_articulo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `kardex`
--
ALTER TABLE `kardex`
  ADD CONSTRAINT `kardex_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kardex_ibfk_2` FOREIGN KEY (`id_cargo`) REFERENCES `cargo` (`id_cargo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `kardex_ibfk_3` FOREIGN KEY (`id_tipo_empleado`) REFERENCES `tipo_empleado` (`id_tipo_empleado`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `kardex_observaciones`
--
ALTER TABLE `kardex_observaciones`
  ADD CONSTRAINT `kardex_observaciones_ibfk_1` FOREIGN KEY (`id_kardex`) REFERENCES `kardex` (`id_kardex`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mediciones`
--
ALTER TABLE `mediciones`
  ADD CONSTRAINT `mediciones_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`),
  ADD CONSTRAINT `mediciones_ibfk_2` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`);

--
-- Filtros para la tabla `mediciones_detalle`
--
ALTER TABLE `mediciones_detalle`
  ADD CONSTRAINT `mediciones_detalle_ibfk_1` FOREIGN KEY (`id_medicion`) REFERENCES `mediciones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `moneda`
--
ALTER TABLE `moneda`
  ADD CONSTRAINT `moneda_ibfk_1` FOREIGN KEY (`id_pais`) REFERENCES `pais` (`id_pais`);

--
-- Filtros para la tabla `movimientos_almacen`
--
ALTER TABLE `movimientos_almacen`
  ADD CONSTRAINT `movimientos_almacen_ibfk_2` FOREIGN KEY (`id_almacen_destino`) REFERENCES `almacen` (`id_almacen`),
  ADD CONSTRAINT `movimientos_almacen_ibfk_3` FOREIGN KEY (`id_almacen_origen`) REFERENCES `almacen` (`id_almacen`),
  ADD CONSTRAINT `movimientos_almacen_ibfk_4` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`);

--
-- Filtros para la tabla `movimientos_almacen_detalle`
--
ALTER TABLE `movimientos_almacen_detalle`
  ADD CONSTRAINT `movimientos_almacen_detalle_ibfk_1` FOREIGN KEY (`id_articulo`) REFERENCES `articulo` (`id_articulo`),
  ADD CONSTRAINT `movimientos_almacen_detalle_ibfk_2` FOREIGN KEY (`id_movimiento_almacen`) REFERENCES `movimientos_almacen` (`id`);

--
-- Filtros para la tabla `permiso_usuario`
--
ALTER TABLE `permiso_usuario`
  ADD CONSTRAINT `permiso_usuario_ibfk_1` FOREIGN KEY (`id_permiso`) REFERENCES `permiso` (`id_permiso`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permiso_usuario_ibfk_2` FOREIGN KEY (`id_acceso`) REFERENCES `acceso` (`id_empleado`);

--
-- Filtros para la tabla `pieza`
--
ALTER TABLE `pieza`
  ADD CONSTRAINT `pieza_ibfk_1` FOREIGN KEY (`id_articulo`) REFERENCES `articulo` (`id_articulo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `produccion`
--
ALTER TABLE `produccion`
  ADD CONSTRAINT `produccion_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produccion_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produccion_ibfk_3` FOREIGN KEY (`id_caja`) REFERENCES `caja` (`id_caja`),
  ADD CONSTRAINT `produccion_ibfk_4` FOREIGN KEY (`id_almacen`) REFERENCES `almacen` (`id_almacen`);

--
-- Filtros para la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD CONSTRAINT `proveedor_ibfk_1` FOREIGN KEY (`id_ciudad`) REFERENCES `ciudad` (`id_ciudad`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `salario`
--
ALTER TABLE `salario`
  ADD CONSTRAINT `salario_ibfk_1` FOREIGN KEY (`id_kardex`) REFERENCES `kardex` (`id_kardex`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `salario_ibfk_2` FOREIGN KEY (`id_moneda`) REFERENCES `moneda` (`id_moneda`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`id_articulo`) REFERENCES `articulo` (`id_articulo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_ibfk_2` FOREIGN KEY (`id_almacen`) REFERENCES `almacen` (`id_almacen`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD CONSTRAINT `subcategoria_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD CONSTRAINT `sucursal_ibfk_1` FOREIGN KEY (`id_ciudad`) REFERENCES `ciudad` (`id_ciudad`) ON UPDATE CASCADE,
  ADD CONSTRAINT `sucursal_ibfk_2` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id_empresa`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`id_moneda`) REFERENCES `moneda` (`id_moneda`) ON UPDATE CASCADE,
  ADD CONSTRAINT `venta_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON UPDATE CASCADE,
  ADD CONSTRAINT `venta_ibfk_3` FOREIGN KEY (`id_caja`) REFERENCES `caja` (`id_caja`) ON UPDATE CASCADE,
  ADD CONSTRAINT `venta_ibfk_4` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`),
  ADD CONSTRAINT `venta_ibfk_5` FOREIGN KEY (`id_almacen`) REFERENCES `almacen` (`id_almacen`);

--
-- Filtros para la tabla `venta_credito`
--
ALTER TABLE `venta_credito`
  ADD CONSTRAINT `venta_credito_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `venta` (`id_venta`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
