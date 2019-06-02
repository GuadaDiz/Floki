# ************************************************************
# Sequel Pro SQL dump
# Versión 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.5.5-10.3.13-MariaDB)
# Base de datos: db_floki
# Tiempo de Generación: 2019-05-09 18:43:12 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

create schema db_floki;


# Volcado de tabla categorias
# ------------------------------------------------------------

DROP TABLE IF EXISTS `categorias`;

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Volcado de tabla compras
# ------------------------------------------------------------

DROP TABLE IF EXISTS `compras`;

CREATE TABLE `compras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `cantidad_productos` int(11) DEFAULT NULL,
  `precio_final` decimal(6,2) NOT NULL,
  `monto_descuento` int(11) DEFAULT NULL,
  `domicilio_envio_id` int(11) DEFAULT NULL,
  `fecha_envio` date DEFAULT NULL,
  `correo_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario_compra` (`usuario_id`),
  KEY `fk_domicilio_envio` (`domicilio_envio_id`),
  KEY `fk_correos` (`correo_id`),
  KEY `fk_estado_compra` (`estado_id`),
  CONSTRAINT `fk_correos` FOREIGN KEY (`correo_id`) REFERENCES `correos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_domicilio_envio` FOREIGN KEY (`domicilio_envio_id`) REFERENCES `domicilios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_estado_compra` FOREIGN KEY (`estado_id`) REFERENCES `estado_compra` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_usuario_compra` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Volcado de tabla correos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `correos`;

CREATE TABLE `correos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telefono` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Volcado de tabla descuentos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `descuentos`;

CREATE TABLE `descuentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `porcentaje` int(11) NOT NULL,
  `estado` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Volcado de tabla detalle_compra
# ------------------------------------------------------------

DROP TABLE IF EXISTS `detalle_compra`;

CREATE TABLE `detalle_compra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `compra_id` int(11) DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio_final` decimal(6,2) DEFAULT NULL,
  `descuento` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_compra` (`compra_id`),
  KEY `fk_producto_comprado` (`producto_id`),
  CONSTRAINT `fk_compra` FOREIGN KEY (`compra_id`) REFERENCES `compras` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_producto_comprado` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Volcado de tabla domicilios
# ------------------------------------------------------------

DROP TABLE IF EXISTS `domicilios`;

CREATE TABLE `domicilios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `domicilio_linea1` varchar(100) DEFAULT NULL,
  `domicilio_linea2` varchar(100) DEFAULT NULL,
  `ciudad` varchar(30) DEFAULT NULL,
  `provincia` varchar(30) DEFAULT NULL,
  `pais` varchar(30) DEFAULT NULL,
  `codigo_postal` int(11) DEFAULT NULL,
  `tipo` varchar(20) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuarios` (`usuario_id`),
  CONSTRAINT `fk_usuarios` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Volcado de tabla estado_compra
# ------------------------------------------------------------

DROP TABLE IF EXISTS `estado_compra`;

CREATE TABLE `estado_compra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `estado_compra` WRITE;
/*!40000 ALTER TABLE `estado_compra` DISABLE KEYS */;

INSERT INTO `estado_compra` (`id`, `estado`)
VALUES
	(1,'ESPERANDO PAGO'),
	(2,'PAGO APROBADO'),
	(3,'PAGO RECHAZADO'),
	(4,'COMPRA CANCELADA'),
	(5,'ENVIO REALIZADO'),
	(6,'COMPRA FINALIZADA OK'),
	(7,'RECLAMADA'),
	(8,'ESPERANDO PAGO'),
	(9,'PAGO APROBADO'),
	(10,'PAGO RECHAZADO'),
	(11,'COMPRA CANCELADA'),
	(12,'ENVIO REALIZADO'),
	(13,'COMPRA FINALIZADA OK'),
	(14,'RECLAMADA');

/*!40000 ALTER TABLE `estado_compra` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla producto_categoria
# ------------------------------------------------------------

DROP TABLE IF EXISTS `producto_categoria`;

CREATE TABLE `producto_categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_productos` (`producto_id`),
  KEY `fk_categorias` (`categoria_id`),
  CONSTRAINT `fk_categorias` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_productos` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Volcado de tabla productos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `productos`;

CREATE TABLE `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `precio` decimal(6,2) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `descuento_id` int(11) DEFAULT NULL,
  `fotos` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_descuentos` (`descuento_id`),
  CONSTRAINT `fk_descuentos` FOREIGN KEY (`descuento_id`) REFERENCES `descuentos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Volcado de tabla roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rol` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;

INSERT INTO `roles` (`id`, `rol`)
VALUES
	(1,'ADMIN'),
	(2,'USUARIO REGISTRADO'),
	(3,'INVITADO'),
	(4,'ADMIN'),
	(5,'USUARIO REGISTRADO'),
	(6,'INVITADO');

/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla usuarios
# ------------------------------------------------------------

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(200) NOT NULL DEFAULT '',
  `telefono` int(11) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `rol_id` int(11) NOT NULL DEFAULT 2,
  `news` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_roles` (`rol_id`),
  CONSTRAINT `fk_roles` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `email`, `pass`, `telefono`, `fecha_nacimiento`, `rol_id`, `news`)
VALUES
	(6,'beli','ioci','beluiocca@gmail.com','$2y$10$Q7LQ/Di6/G/oUPHWZlb8ee81THgOWQ/AAUO.YjJiuGS1BmyByUW8q',123456789,'2019-05-15',2,0),
	(7,'María','Iocca','belen@empujesar.com.ar','$2y$10$mR3pNs0DN4kwLSjDax.CAuawJVo.d2CANWxYAwtQENR8dZt4p.nHe',NULL,NULL,2,1),
	(8,'María','Iocca','abc@123.com','$2y$10$G21v6DnnALnmKq/GQrzY.egpxHHeL3YOzgh.aHVvrnpBXYfVWgJam',NULL,NULL,2,0);

/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
