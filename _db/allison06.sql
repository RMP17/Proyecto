-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-02-2019 a las 12:59:12
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
(17, 'bol', '$2y$10$SwdTQbB6Wp4qdmbhhRvWtuBm0vb0PQkWUGPe5dKy.depLenM18y0G', '1', 'trmDOjy8bvTiIH9bhxAH6j5P5F1MAQIH9u78NwvQkou3mdxKZGczNvQcJ78O'),
(18, 'rider2', '$2y$10$97cP9dpG0QaaZWqafQhCLu.MO9KtEi5GcMb8kqrddaFxGD5Its.AG', NULL, 'CauVSQBIQstgBNxLqP4mqB2omeyttyEsHkEw72znP4SNaGIMporEWeVFnYxt'),
(19, 'Jose', '$2y$10$Q0QsySi9ztebcRZLkGg4yuZpTWwBYOgbGl3bJn3ppoJ69marH495C', '1', NULL),
(24, 'emp', '$2y$10$Ebcoj2NelIMUOpRtWRWlUuU743L82mcLeSMlaOeJZFq3gN3f14tJG', '1', 'qUgdVn9l7wGgbg1G6AsGHI6lCKi59axn4zd6EtFAXdxpL1DKR4U6cWs2SrfE');

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
(1, 'ALma6000', 'kjhjhkjhk', 1),
(2, 'Almacen 23', 'kkhwlekjqwlekqj', 2),
(3, 'Almacen 100', 'ojkjawldkj', 2),
(4, 'Alma33333', 'we', 2),
(5, 'Almacen 200', 'wwwwww', 1),
(6, 'Almacen 300', 'eeeeeeeeeeeeee', 3);

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
  `precio_produccion` decimal(10,2) NOT NULL,
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
(21, 'Articulo 2', '4654', '45', '', '10.00', '0.00', '1', NULL, '2019-01-23', 1, NULL, NULL),
(22, 'Articulo 3', '45', '455', '', '445.00', '0.00', '1', NULL, '2019-01-23', 0, NULL, NULL);

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
  `usuario` varchar(25) DEFAULT NULL,
  `accion` text,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'Caja 1', 'c', 17),
(2, 'Caja 2', 'a', 18),
(3, 'Caja2', NULL, 18);

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
(7, '2019-02-04 09:07:37', '2019-02-04 19:49:03', '1000.00', '200.00', '500.00', 'falata 200', 1),
(8, '2019-02-04 10:01:42', NULL, '2500.00', NULL, NULL, NULL, 2);

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
(20, 'cargo 12'),
(19, 'cargo 13');

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
(30, 'ooooooooooooooooooo', 'qweqweooooooooooooooooooooooooooo'),
(31, 'iiiiiiiiiiiiiiiiiiiiiiii', 'aaaaa'),
(32, 'uiwqeowuei', 'wwwwww'),
(33, 'kljeklwjewkjq', 'lllllll'),
(34, 'pppppppppppppmmmmmmmmmmmmmmm', 'lopkoiuoi'),
(35, 'mkkjkljlk', 'jlkjkljk'),
(36, 'lkjkljklpopppppp', 'nnmbnbmnbnmbm'),
(37, 'jhkjhjkhkjkkjkkknnn', 'kjhjkhjkhkuukhh'),
(38, 'poopiopipoi', 'oipoiopi'),
(39, 'jlkjlkjlkj', 'jkljlkjkljlkjklj'),
(40, 'kljkljkljkj', 'lkjlkjl,l,jjl,jl,jkj,k'),
(41, 'weqwewqe', 'qweqweq');

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
(20, 'e', 5);

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
(7, 'S/N', '0', NULL, NULL, NULL, NULL, NULL, NULL);

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
(50, '2019-01-31', '0.00', '100.00', NULL, NULL, NULL, NULL, 1, 18, NULL, 'ef');

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
(82, 100, '1', 16, 6, 50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_produccion`
--

CREATE TABLE `detalle_produccion` (
  `id_detalle_produccion` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `id_articulo` int(11) DEFAULT NULL,
  `id_almacen` int(11) DEFAULT NULL,
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
(154, 1, '10.00', 16, 51),
(155, 40, '10.00', 16, 52),
(156, 10, '10.00', 16, 53),
(158, 10, '10.00', 16, 55);

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
(21, '40', '52', '10', '20800');

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
(25, 'Empleado 2', '56456456', '', NULL, NULL, NULL, NULL, '', '', '', '', '2019-01-29', '1', 1);

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
(1, 'jkhrjkhjwhjkwh', '7468544', 'qwjelwqkj', '4654564'),
(2, 'qjwelwjk', '744541112', 'Pablo', '5456'),
(3, 'balbla', '11233', 'oopoo', 'lalalalal'),
(4, 'Razon Social 1', '1234567023', 'Jose Jose', 'Venta de Muebles - Puertas');

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
(1, 'fabricante1', '2312', 'kjhwqeejkwqhejkhqw'),
(2, 'fabricante2', NULL, 'qweqwqwe');

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
  `monto` decimal(10,2) DEFAULT NULL,
  `fecha` datetime NOT NULL,
  `descripcion` text,
  `id_caja` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `gasto`
--

INSERT INTO `gasto` (`id`, `monto`, `fecha`, `descripcion`, `id_caja`, `id_empleado`) VALUES
(1, '100.25', '2019-02-04 08:54:09', 'por compras de galletas', 1, 17),
(2, '150.00', '2019-02-04 08:56:57', 'por compra de sodas', 1, 17),
(3, '254.00', '2019-02-04 09:03:21', '54', 1, 17),
(4, '200.00', '2019-02-04 09:07:55', NULL, 1, 17),
(5, '2100.00', '2019-02-04 10:01:48', NULL, 2, 18);

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
(14, '2019-01-30', NULL, '2019-01-09', 17, 20, NULL),
(15, '2017-11-29', NULL, '2019-01-10', 18, 19, NULL),
(16, '2019-01-02', NULL, '2019-01-10', 19, 20, NULL),
(17, NULL, NULL, '2019-01-29', 24, NULL, NULL),
(18, NULL, NULL, '2019-01-29', 25, NULL, NULL);

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

--
-- Volcado de datos para la tabla `kardex_observaciones`
--

INSERT INTO `kardex_observaciones` (`id_kardex_observaciones`, `id_kardex`, `fecha`, `observacion`) VALUES
(4, 15, '2019-01-10', 'es normal 4'),
(5, 15, '2019-01-10', 'es normal'),
(7, 15, '2019-01-10', 'es normal 6'),
(8, 15, '2019-01-10', 'es normal 7'),
(9, 15, '2019-01-10', 'es normal 2'),
(10, 15, '2019-01-10', 'es normal 8'),
(11, 14, '2019-01-10', 'es normal 3'),
(12, 14, '2019-01-10', 'es normal'),
(13, 15, '2019-02-04', 'no es normal');

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
(1, 'Bolivianos', 'BOB', 2),
(9, 'mnmnbmbn', 'kjbhkjghkjh', 1),
(22, 'jkhewkjqwhekjqwhe', '42412', 1),
(27, 'ooooooooooooo', 'ooooooooooooo', 2),
(28, 'Soles', 'SOL', 3),
(29, 'Pesos', 'PES', 2);

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
(4, '-'),
(1, 'Bolivia'),
(9, 'Chile'),
(7, 'lor'),
(2, 'Olanda 3'),
(3, 'Peru'),
(8, 'qwewqeq'),
(5, 'qwewqeqjjjjjjppppwwwwwwwwwwwwwwwwwwwwwwwwwwww'),
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
(1, 'Articulo'),
(2, 'Cargo'),
(3, 'categoria'),
(4, 'contacto'),
(5, 'cuenta'),
(6, 'factura'),
(7, 'gasto'),
(8, 'almacen'),
(9, 'cliente'),
(11, 'cambio'),
(12, 'venta');

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
(13, 12, 19),
(14, 3, 19),
(22, 7, 17),
(23, 5, 17),
(24, 3, 17),
(25, 2, 17),
(26, 11, 17),
(28, 12, 17),
(36, 12, 18),
(37, 6, 18),
(38, 2, 18),
(39, 8, 18);

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
  `fecha` date DEFAULT NULL,
  `observaciones` text,
  `costo` decimal(10,0) DEFAULT NULL,
  `id_empleado` int(11) DEFAULT NULL,
  `producto` varchar(200) DEFAULT NULL,
  `cantidad_producida` int(11) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_produccion` date DEFAULT NULL,
  `fecha_terminado` date DEFAULT NULL
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
(14, '876866', 22),
(15, '876866', 22),
(16, '2500', 27),
(17, '2000', 1),
(18, '2500', 1);

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
(3, 17, 4, 83),
(7, 18, 1, 0),
(10, 22, 5, 25),
(11, 21, 5, 21),
(12, 16, 1, 12),
(13, 20, 6, 100),
(14, 16, 6, 90),
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
(1, 'sucursal', 0, 'jkhjkhjkhjk', '45554456', '2018-12-04', 'A', 1, 2),
(2, 'Lo', 1, 'dir', '12345', '2018-12-20', 'A', 1, 3),
(3, 'qweweqweqw', 1, 'we', '214214', '2019-01-17', NULL, 2, 3),
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
(51, '2019-01-31', '60', NULL, '0', 'cv', 4, 17, 1, 7, 1, 'cr'),
(52, '2019-02-04', '400', NULL, '0', NULL, 6, 18, 1, 7, 2, 'ef'),
(53, '2019-02-04', '100', NULL, '0', NULL, 6, 18, 1, 7, 2, 'ef'),
(55, '2019-02-04', '100', NULL, '0', 'cv', 6, 18, 1, 7, 2, 'cr');

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
(28, '2019-01-31 18:51:51', '5.00', 'ef', NULL, 51),
(29, '2019-02-04 14:12:36', '25.50', 'ef', NULL, 55),
(30, '2019-02-04 14:13:01', '5.00', 'ef', NULL, 51),
(31, '2019-02-04 14:13:21', '1.50', 'ef', NULL, 55);

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
  ADD KEY `usuario` (`usuario`);

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
  ADD KEY `id_almacen` (`id_almacen`),
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
-- Indices de la tabla `moneda`
--
ALTER TABLE `moneda`
  ADD PRIMARY KEY (`id_moneda`),
  ADD KEY `id_pais` (`id_pais`);

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
  ADD KEY `id_empleado` (`id_empleado`);

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
  MODIFY `id_articulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `id_caja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id_cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `id_ciudad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

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
  MODIFY `id_detalle_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT de la tabla `detalle_produccion`
--
ALTER TABLE `detalle_produccion`
  MODIFY `id_detalle_produccion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id_detalle_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT de la tabla `dosificacion`
--
ALTER TABLE `dosificacion`
  MODIFY `id_dosificacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id_kardex` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `kardex_observaciones`
--
ALTER TABLE `kardex_observaciones`
  MODIFY `id_kardex_observaciones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `moneda`
--
ALTER TABLE `moneda`
  MODIFY `id_moneda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
  MODIFY `id_pais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `permiso_usuario`
--
ALTER TABLE `permiso_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

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
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `venta_credito`
--
ALTER TABLE `venta_credito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

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
  ADD CONSTRAINT `bitacora_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `acceso` (`usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `detalle_produccion_ibfk_2` FOREIGN KEY (`id_almacen`) REFERENCES `almacen` (`id_almacen`) ON DELETE SET NULL ON UPDATE CASCADE,
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
-- Filtros para la tabla `moneda`
--
ALTER TABLE `moneda`
  ADD CONSTRAINT `moneda_ibfk_1` FOREIGN KEY (`id_pais`) REFERENCES `pais` (`id_pais`);

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
  ADD CONSTRAINT `produccion_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`) ON UPDATE CASCADE;

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
