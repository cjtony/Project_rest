-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-04-2019 a las 06:35:20
-- Versión del servidor: 10.1.25-MariaDB
-- Versión de PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `playita`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `est_cuenta_adm` tinyint(4) DEFAULT '1',
  `nombre_adm` varchar(50) DEFAULT NULL,
  `correo_adm` varchar(50) DEFAULT NULL,
  `usuario_adm` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `privilegio_adm` varchar(50) DEFAULT NULL,
  `fecha_reg` date DEFAULT NULL,
  `fech_activ` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id_admin`, `est_cuenta_adm`, `nombre_adm`, `correo_adm`, `usuario_adm`, `password`, `privilegio_adm`, `fecha_reg`, `fech_activ`) VALUES
(1, 1, 'Marco', 'marco@gmail.com', 'tony', '81dc9bdb52d04dc20036dbd8313ed055', 'ALL', '2019-04-05', '2019-04-08'),
(2, 1, 'marc', 'marco2@gmail.com', 'tony', '827ccb0eea8a706c4c34a16891f84e7b', 'LIM', '2019-04-07', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id_carrito` int(11) NOT NULL,
  `id_platillo` int(11) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `fecha_dat` date DEFAULT NULL,
  `estad_car` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`id_carrito`, `id_platillo`, `id_cliente`, `fecha_dat`, `estad_car`) VALUES
(36, 1, 1, '2019-03-15', 0),
(37, 1, 1, '2019-03-15', 0),
(39, 1, 1, '2019-04-02', 0),
(40, 1, 1, '2019-04-02', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre_cat` varchar(50) DEFAULT NULL,
  `descripcion_cat` varchar(500) DEFAULT NULL,
  `estado_cat` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre_cat`, `descripcion_cat`, `estado_cat`) VALUES
(1, 'Mariscos', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias, dignissimos unde omnis, doloribus amet nemo ratione!.', 1),
(2, 'Hamburguesas', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias, dignissimos unde omnis, doloribus amet nemo ratione!.', 0),
(3, 'Mar y Tierra', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias, dignissimos unde omnis, doloribus amet nemo ratione!.', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre_cli` varchar(50) DEFAULT NULL,
  `telefono_cli` varchar(50) DEFAULT NULL,
  `correo_cli` varchar(50) DEFAULT NULL,
  `usuario_cli` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `fecha_reg_cli` date DEFAULT NULL,
  `fech_activ_cli` date DEFAULT NULL,
  `estado_cli` tinyint(1) UNSIGNED ZEROFILL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre_cli`, `telefono_cli`, `correo_cli`, `usuario_cli`, `password`, `fecha_reg_cli`, `fech_activ_cli`, `estado_cli`) VALUES
(1, 'Marco aguilar', '7321193748', 'marcocaaguilar@gmail.com', 'tony', '81dc9bdb52d04dc20036dbd8313ed055', '2019-02-28', '2019-04-07', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `det_pedido`
--

CREATE TABLE `det_pedido` (
  `id_detpedido` int(11) NOT NULL,
  `id_carrito` int(11) DEFAULT NULL,
  `id_direccion` int(11) DEFAULT NULL,
  `confirm_ped` tinyint(4) DEFAULT NULL,
  `fecha_hora_ped` datetime DEFAULT NULL,
  `fecha_confirm_ped` datetime DEFAULT NULL,
  `cod_conf` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `det_pedido`
--

INSERT INTO `det_pedido` (`id_detpedido`, `id_carrito`, `id_direccion`, `confirm_ped`, `fecha_hora_ped`, `fecha_confirm_ped`, `cod_conf`) VALUES
(1, 36, 1, 0, '2019-04-07 09:19:17', '2019-04-07 09:21:17', 'PEDsvzy5m'),
(2, 37, 1, 0, '2019-04-07 09:19:17', '2019-04-07 09:21:17', 'PEDsvzy5m'),
(3, 39, 1, 1, '2019-04-07 09:15:13', '2019-04-07 09:20:13', 'PEDwgba7n'),
(4, 40, 1, 1, '2019-04-07 09:15:13', '2019-04-07 09:20:13', 'PEDwgba7n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direcciones`
--

CREATE TABLE `direcciones` (
  `id_direccion` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `direccion_cli` varchar(100) DEFAULT NULL,
  `referencia_cli` varchar(80) DEFAULT NULL,
  `num_ext` varchar(10) DEFAULT NULL,
  `num_int` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `direcciones`
--

INSERT INTO `direcciones` (`id_direccion`, `id_cliente`, `direccion_cli`, `referencia_cli`, `num_ext`, `num_int`) VALUES
(1, 1, 'Independencia', 'Frente al restaurante las palmitas', '12', '7');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plat_menu`
--

CREATE TABLE `plat_menu` (
  `id_platillo` int(11) NOT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `nombre_plat` varchar(50) DEFAULT NULL,
  `descripcion_plat` varchar(500) DEFAULT NULL,
  `precio_plat` float DEFAULT NULL,
  `tiempo_prepare` varchar(50) DEFAULT NULL,
  `imagen_plat1` varchar(100) DEFAULT NULL,
  `imagen_plat2` varchar(100) DEFAULT NULL,
  `estado_plat` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `plat_menu`
--

INSERT INTO `plat_menu` (`id_platillo`, `id_categoria`, `nombre_plat`, `descripcion_plat`, `precio_plat`, `tiempo_prepare`, `imagen_plat1`, `imagen_plat2`, `estado_plat`) VALUES
(1, 2, 'Hamburguesa jalapeña', 'La mejor hamburguesa con jalapeño que puedes probar', 60, '00:25:00', 'hamburger.jpg', 'hamburger.jpg', 1),
(2, 2, 'Hamburguesa con queso', 'La mejor hamburguesa de queso de todos los tiempos', 45, '20 minutos', 'hamburger.jpg', NULL, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id_carrito`),
  ADD KEY `FK_carrito_plat_menu` (`id_platillo`),
  ADD KEY `FK_carrito_clientes` (`id_cliente`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `det_pedido`
--
ALTER TABLE `det_pedido`
  ADD PRIMARY KEY (`id_detpedido`),
  ADD KEY `FK_det_pedido_carrito` (`id_carrito`),
  ADD KEY `FK_det_pedido_direcciones` (`id_direccion`);

--
-- Indices de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD PRIMARY KEY (`id_direccion`),
  ADD KEY `FK_direcciones_clientes` (`id_cliente`);

--
-- Indices de la tabla `plat_menu`
--
ALTER TABLE `plat_menu`
  ADD PRIMARY KEY (`id_platillo`),
  ADD KEY `FK_plat_menu_categoria` (`id_categoria`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id_carrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `det_pedido`
--
ALTER TABLE `det_pedido`
  MODIFY `id_detpedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  MODIFY `id_direccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `plat_menu`
--
ALTER TABLE `plat_menu`
  MODIFY `id_platillo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `FK_carrito_clientes` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  ADD CONSTRAINT `FK_carrito_plat_menu` FOREIGN KEY (`id_platillo`) REFERENCES `plat_menu` (`id_platillo`);

--
-- Filtros para la tabla `det_pedido`
--
ALTER TABLE `det_pedido`
  ADD CONSTRAINT `FK_det_pedido_carrito` FOREIGN KEY (`id_carrito`) REFERENCES `carrito` (`id_carrito`),
  ADD CONSTRAINT `FK_det_pedido_direcciones` FOREIGN KEY (`id_direccion`) REFERENCES `direcciones` (`id_direccion`);

--
-- Filtros para la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD CONSTRAINT `FK_direcciones_clientes` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`);

--
-- Filtros para la tabla `plat_menu`
--
ALTER TABLE `plat_menu`
  ADD CONSTRAINT `FK_plat_menu_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
