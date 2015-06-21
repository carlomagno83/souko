/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50534
Source Host           : localhost:3306
Source Database       : souko

Target Server Type    : MYSQL
Target Server Version : 50534
File Encoding         : 65001

Date: 2015-06-21 04:47:43
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for colors
-- ----------------------------
DROP TABLE IF EXISTS `colors`;
CREATE TABLE `colors` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `codcolor3` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `codcolor6` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `descolor` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of colors
-- ----------------------------
INSERT INTO `colors` VALUES ('1', 'NEG', 'NEGRO', 'NEGRO', '1', '2015-05-30 22:23:14', '2015-05-30 22:23:14');
INSERT INTO `colors` VALUES ('2', 'MAR', 'MARRON', 'MARRON', '1', '2015-05-31 00:13:48', '2015-05-31 00:14:51');
INSERT INTO `colors` VALUES ('3', 'NM', 'NEGMAR', 'NEGRO-MARRON', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `colors` VALUES ('4', 'MN', 'MARNEG', 'MARRON-NEGRO', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `colors` VALUES ('5', 'COB', 'COBRE', 'COBRE', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `colors` VALUES ('6', 'NAT', 'NATURA', 'NATURAL', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `colors` VALUES ('7', 'ACE', 'ACERO', 'ACERO', '1', '0000-00-00 00:00:00', '2015-06-11 20:32:00');
INSERT INTO `colors` VALUES ('8', 'AFR', 'AFRICA', 'AFRICA', '1', '0000-00-00 00:00:00', '2015-06-11 20:35:18');
INSERT INTO `colors` VALUES ('9', 'APA', 'APACHE', 'APACHE', '1', '0000-00-00 00:00:00', '2015-06-08 04:26:48');
INSERT INTO `colors` VALUES ('10', 'ARE', 'ARENA', 'ARENA', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `colors` VALUES ('11', 'AZU', 'AZUL', 'AZUL', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `colors` VALUES ('12', 'BLA', 'BLANCO', 'BLANCO', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `colors` VALUES ('13', 'CAN', 'CANELA', 'CANELA', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `colors` VALUES ('14', 'CAR', 'CARAME', 'CARAMELO', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `colors` VALUES ('15', 'CEM', 'CEMENT', 'CEMENTO', '3', '0000-00-00 00:00:00', '2015-06-08 23:04:46');
INSERT INTO `colors` VALUES ('16', 'GRI', 'GRIS', 'GRIS', '1', '0000-00-00 00:00:00', '2015-06-09 21:32:13');
INSERT INTO `colors` VALUES ('17', 'GUI', 'GUINDA', 'GUINDA', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `colors` VALUES ('18', 'HAB', 'HABANO', 'HABANO', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `colors` VALUES ('19', 'HUE', 'HUESO', 'HUESO', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `colors` VALUES ('20', 'JAM', 'JAMAIC', 'JAMAICA', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `colors` VALUES ('21', 'MIE', 'MIEL', 'MIEL', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `colors` VALUES ('22', 'MOR', 'MORO', 'MORO', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `colors` VALUES ('23', 'MUS', 'MUSGO', 'MUSGO', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `colors` VALUES ('24', 'NUT', 'NUTRIA', 'NUTRIA', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `colors` VALUES ('25', 'OLI', 'OLIVO', 'OLIVO', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `colors` VALUES ('26', 'PAC', 'PACAE', 'PACAE', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `colors` VALUES ('27', 'PAP', 'PAPA', 'PAPA', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `colors` VALUES ('28', 'PET', 'PETROL', 'PETROLEO', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `colors` VALUES ('29', 'PLA', 'PLATA', 'PLATA', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `colors` VALUES ('30', 'PLO', 'PLOMO', 'PLOMO', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `colors` VALUES ('31', 'ROJ', 'ROJO', 'ROJO', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `colors` VALUES ('32', 'TIE', 'TIERRA', 'TIERRA', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `colors` VALUES ('33', 'TOF', 'TOFFEE', 'TOFFEE', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `colors` VALUES ('34', 'TUM', 'TUMBO', 'TUMBO', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `colors` VALUES ('35', 'VER', 'VERDE', 'VERDE', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `colors` VALUES ('36', 'VIZ', 'VIZCAC', 'VIZCACHA', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for documentos
-- ----------------------------
DROP TABLE IF EXISTS `documentos`;
CREATE TABLE `documentos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fechadocumento` date NOT NULL,
  `tipomovimiento_id` int(11) unsigned NOT NULL,
  `localini_id` int(11) NOT NULL,
  `localfin_id` int(11) NOT NULL,
  `flagestado` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `tipomovimiento_id` (`tipomovimiento_id`),
  CONSTRAINT `documentos_ibfk_1` FOREIGN KEY (`tipomovimiento_id`) REFERENCES `tipomovimientos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of documentos
-- ----------------------------
INSERT INTO `documentos` VALUES ('2', '2015-06-20', '1', '1', '1', 'ACT', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `documentos` VALUES ('6', '2015-06-21', '1', '1', '1', 'ACT', '1', '2015-06-21 09:36:47', '2015-06-21 09:36:47');
INSERT INTO `documentos` VALUES ('7', '2015-06-21', '1', '1', '1', 'ACT', '1', '2015-06-21 09:40:03', '2015-06-21 09:40:03');

-- ----------------------------
-- Table structure for estados
-- ----------------------------
DROP TABLE IF EXISTS `estados`;
CREATE TABLE `estados` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `codestado3` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `codestado6` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `desestado` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of estados
-- ----------------------------
INSERT INTO `estados` VALUES ('1', 'ACT', 'ACTIVO', 'ACTIVO', '1', '2015-05-30 23:00:15', '2015-05-30 23:00:15');
INSERT INTO `estados` VALUES ('2', 'INA', 'INACTI', 'INACTIVO', '1', '2015-05-30 23:40:52', '2015-05-30 23:41:18');
INSERT INTO `estados` VALUES ('3', 'DEV', 'DEVUEL', 'DEVUELTO', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `estados` VALUES ('4', 'BAJ', 'BAJA', 'BAJA', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for locals
-- ----------------------------
DROP TABLE IF EXISTS `locals`;
CREATE TABLE `locals` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `codlocal3` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `codlocal6` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `deslocal` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of locals
-- ----------------------------
INSERT INTO `locals` VALUES ('1', 'ALM', 'ALMACE', 'ALMACEN', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `locals` VALUES ('2', 'P1', 'PTO1', 'PUNTO DE VENTA 1', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for marcas
-- ----------------------------
DROP TABLE IF EXISTS `marcas`;
CREATE TABLE `marcas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `codmarca3` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `codmarca6` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `desmarca` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of marcas
-- ----------------------------
INSERT INTO `marcas` VALUES ('1', 'AND', 'ANDERS', 'ANDERSON', '1', '2015-05-31 02:01:41', '2015-05-31 02:01:41');
INSERT INTO `marcas` VALUES ('2', 'BOA', 'BOAZ', 'BOAZ', '1', '2015-05-31 02:01:58', '2015-05-31 02:01:58');
INSERT INTO `marcas` VALUES ('3', 'AVE', 'AVENTU', 'AVENTURERO', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `marcas` VALUES ('4', 'BRA', 'BRASIL', 'BRASILIA', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `marcas` VALUES ('5', 'CZB', 'CALZ-B', 'CALZADO B', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `marcas` VALUES ('6', 'DAM', 'DAMBER', 'DAMBER', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `marcas` VALUES ('7', 'DRA', 'DRAGON', 'DRAGON', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `marcas` VALUES ('8', 'EB', 'EB', 'EB', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `marcas` VALUES ('9', 'EMB', 'EMBAJA', 'EMBAJADOR', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `marcas` VALUES ('10', 'KEN', 'KENSA', 'KENSA', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `marcas` VALUES ('11', 'PRI', 'PRINCE', 'PRINCE', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for materials
-- ----------------------------
DROP TABLE IF EXISTS `materials`;
CREATE TABLE `materials` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `codmaterial3` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `codmaterial6` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `desmaterial` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of materials
-- ----------------------------
INSERT INTO `materials` VALUES ('1', 'CRA', 'CRACK', 'CRACK', '1', '2015-06-02 22:56:25', '2015-06-02 22:56:25');
INSERT INTO `materials` VALUES ('2', 'CUE', 'CUERO', 'CUERO', '1', '2015-06-02 22:56:40', '2015-06-02 22:56:40');
INSERT INTO `materials` VALUES ('3', 'GRA', 'GRASO', 'GRASO', '1', '2015-06-02 22:56:58', '2015-06-02 22:56:58');
INSERT INTO `materials` VALUES ('4', 'GRE', 'GREYSI', 'GREYSI', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `materials` VALUES ('5', 'GUM', 'GUMI', 'GUMI', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `materials` VALUES ('6', 'NOB', 'NOBU', 'NOBU', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for mercaderias
-- ----------------------------
DROP TABLE IF EXISTS `mercaderias`;
CREATE TABLE `mercaderias` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) unsigned NOT NULL,
  `mercaderiacambio_id` int(11) NOT NULL,
  `local_id` int(11) unsigned NOT NULL,
  `estado` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `preciocompra` decimal(6,2) NOT NULL,
  `precioventa` decimal(6,2) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `local_id` (`local_id`),
  KEY `producto_id` (`producto_id`),
  CONSTRAINT `mercaderias_ibfk_1` FOREIGN KEY (`local_id`) REFERENCES `locals` (`id`),
  CONSTRAINT `mercaderias_ibfk_2` FOREIGN KEY (`local_id`) REFERENCES `estados` (`id`),
  CONSTRAINT `mercaderias_ibfk_3` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=665 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of mercaderias
-- ----------------------------
INSERT INTO `mercaderias` VALUES ('16', '1', '0', '1', 'ACT', '60.00', '90.00', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `mercaderias` VALUES ('17', '1', '0', '1', 'ACT', '60.00', '90.00', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `mercaderias` VALUES ('18', '1', '0', '1', 'ACT', '60.00', '90.00', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `mercaderias` VALUES ('19', '1', '0', '1', 'ACT', '60.00', '90.00', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `mercaderias` VALUES ('20', '1', '0', '1', 'ACT', '60.00', '90.00', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `mercaderias` VALUES ('648', '1', '0', '1', 'ACT', '60.00', '90.00', '1', '2015-06-21 09:36:47', '2015-06-21 09:36:47');
INSERT INTO `mercaderias` VALUES ('649', '1', '0', '1', 'ACT', '60.00', '90.00', '1', '2015-06-21 09:36:48', '2015-06-21 09:36:48');
INSERT INTO `mercaderias` VALUES ('650', '3', '0', '1', 'ACT', '60.00', '90.00', '1', '2015-06-21 09:36:48', '2015-06-21 09:36:48');
INSERT INTO `mercaderias` VALUES ('651', '3', '0', '1', 'ACT', '60.00', '90.00', '1', '2015-06-21 09:36:48', '2015-06-21 09:36:48');
INSERT INTO `mercaderias` VALUES ('652', '3', '0', '1', 'ACT', '60.00', '90.00', '1', '2015-06-21 09:40:03', '2015-06-21 09:40:03');
INSERT INTO `mercaderias` VALUES ('653', '3', '0', '1', 'ACT', '60.00', '90.00', '1', '2015-06-21 09:40:03', '2015-06-21 09:40:03');
INSERT INTO `mercaderias` VALUES ('654', '3', '0', '1', 'ACT', '60.00', '90.00', '1', '2015-06-21 09:40:03', '2015-06-21 09:40:03');
INSERT INTO `mercaderias` VALUES ('655', '5', '0', '1', 'ACT', '60.00', '90.00', '1', '2015-06-21 09:40:03', '2015-06-21 09:40:03');
INSERT INTO `mercaderias` VALUES ('656', '5', '0', '1', 'ACT', '60.00', '90.00', '1', '2015-06-21 09:40:04', '2015-06-21 09:40:04');
INSERT INTO `mercaderias` VALUES ('657', '5', '0', '1', 'ACT', '60.00', '90.00', '1', '2015-06-21 09:40:04', '2015-06-21 09:40:04');
INSERT INTO `mercaderias` VALUES ('658', '5', '0', '1', 'ACT', '60.00', '90.00', '1', '2015-06-21 09:40:04', '2015-06-21 09:40:04');
INSERT INTO `mercaderias` VALUES ('659', '5', '0', '1', 'ACT', '60.00', '90.00', '1', '2015-06-21 09:40:04', '2015-06-21 09:40:04');
INSERT INTO `mercaderias` VALUES ('660', '5', '0', '1', 'ACT', '60.00', '90.00', '1', '2015-06-21 09:40:04', '2015-06-21 09:40:04');
INSERT INTO `mercaderias` VALUES ('661', '5', '0', '1', 'ACT', '60.00', '90.00', '1', '2015-06-21 09:40:04', '2015-06-21 09:40:04');
INSERT INTO `mercaderias` VALUES ('662', '5', '0', '1', 'ACT', '60.00', '90.00', '1', '2015-06-21 09:40:05', '2015-06-21 09:40:05');
INSERT INTO `mercaderias` VALUES ('663', '5', '0', '1', 'ACT', '60.00', '90.00', '1', '2015-06-21 09:40:05', '2015-06-21 09:40:05');
INSERT INTO `mercaderias` VALUES ('664', '5', '0', '1', 'ACT', '60.00', '90.00', '1', '2015-06-21 09:40:05', '2015-06-21 09:40:05');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('2015_05_30_212818_create_colors_table', '1');
INSERT INTO `migrations` VALUES ('2015_05_30_212857_create_locals_table', '1');
INSERT INTO `migrations` VALUES ('2015_05_30_212940_create_estados_table', '1');
INSERT INTO `migrations` VALUES ('2015_05_30_213020_create_marcas_table', '1');
INSERT INTO `migrations` VALUES ('2015_05_30_213109_create_tipos_table', '1');
INSERT INTO `migrations` VALUES ('2015_05_30_213201_create_modelos_table', '1');
INSERT INTO `migrations` VALUES ('2015_05_30_213241_create_materials_table', '1');
INSERT INTO `migrations` VALUES ('2015_05_30_213322_create_rangos_table', '1');
INSERT INTO `migrations` VALUES ('2015_05_30_213356_create_tallas_table', '1');
INSERT INTO `migrations` VALUES ('2015_05_30_213458_create_tipomovimientos_table', '1');
INSERT INTO `migrations` VALUES ('2015_05_30_213633_create_documentos_table', '1');
INSERT INTO `migrations` VALUES ('2015_05_30_213804_create_mercaderias_table', '1');
INSERT INTO `migrations` VALUES ('2015_05_30_214233_create_movimientos_table', '1');
INSERT INTO `migrations` VALUES ('2015_06_01_221928_create_users_table', '2');

-- ----------------------------
-- Table structure for modelos
-- ----------------------------
DROP TABLE IF EXISTS `modelos`;
CREATE TABLE `modelos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `codmodelo3` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `codmodelo6` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `desmodelo` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=153 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of modelos
-- ----------------------------
INSERT INTO `modelos` VALUES ('1', '1', '1', '1', '1', '2015-05-31 16:06:28', '2015-05-31 16:06:28');
INSERT INTO `modelos` VALUES ('2', '2', '2', '2', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('3', '3', '3', '3', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('4', '4', '4', '4', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('5', '5', '5', '5', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('6', '6', '6', '6', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('7', '8', '8', '8', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('8', '10', '10', '10', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('9', '11', '11', '11', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('10', '12', '12', '12', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('11', '13', '13', '13', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('12', '14', '14', '14', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('13', '15', '15', '15', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('14', '16', '16', '16', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('15', '17', '17', '17', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('16', '18', '18', '18', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('17', '19', '19', '19', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('18', '20', '20', '20', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('19', '22', '22', '22', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('20', '23', '23', '23', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('21', '24', '24', '24', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('22', '25', '25', '25', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('23', '27', '27', '27', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('24', '28', '28', '28', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('25', '30', '30', '30', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('26', '31', '31', '31', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('27', '32', '32', '32', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('28', '33', '33', '33', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('29', '34', '34', '34', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('30', '35', '35', '35', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('31', '38', '38', '38', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('32', '40', '40', '40', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('33', '41', '41', '41', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('34', '42', '42', '42', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('35', '44', '44', '44', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('36', '46', '46', '46', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('37', '47', '47', '47', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('38', '48', '48', '48', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('39', '50', '50', '50', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('40', '50', '50', '50', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('41', '51', '51', '51', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('42', '52', '52', '52', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('43', '53', '53', '53', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('44', '54', '54', '54', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('45', '55', '55', '55', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('46', '56', '56', '56', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('47', '58', '58', '58', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('48', '59', '59', '59', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('49', '59', '59', '59', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('50', '60', '60', '60', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('51', '61', '61', '61', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('52', '62', '62', '62', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('53', '63', '63', '63', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('54', '64', '64', '64', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('55', '66', '66', '66', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('56', '67', '67', '67', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('57', '70', '70', '70', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('58', '72', '72', '72', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('59', '74', '74', '74', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('60', '76', '76', '76', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('61', '78', '78', '78', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('62', '80', '80', '80', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('63', '82', '82', '82', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('64', '83', '83', '83', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('65', '84', '84', '84', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('66', '85', '85', '85', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('67', '86', '86', '86', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('68', '88', '88', '88', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('69', '90', '90', '90', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('70', '91', '91', '91', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('71', '92', '92', '92', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('72', '94', '94', '94', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('73', '98', '98', '98', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('74', '100', '100', '100', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('75', '101', '101', '101', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('76', '104', '104', '104', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('77', '107', '107', '107', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('78', '112', '112', '112', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('79', '113', '113', '113', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('80', '115', '115', '115', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('81', '116', '116', '116', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('82', '118', '118', '118', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('83', '120', '120', '120', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('84', '121', '121', '121', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('85', '122', '122', '122', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('86', '123', '123', '123', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('87', '124', '124', '124', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('88', '125', '125', '125', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('89', '126', '126', '126', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('90', '127', '127', '127', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('91', '128', '128', '128', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('92', '130', '130', '130', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('93', '137', '137', '137', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('94', '141', '141', '141', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('95', '144', '144', '144', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('96', '145', '145', '145', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('97', '146', '146', '146', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('98', '147', '147', '147', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('99', '148', '148', '148', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('100', '149', '149', '149', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('101', '152', '152', '152', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('102', '157', '157', '157', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('103', '159', '159', '159', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('104', '160', '160', '160', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('105', '166', '166', '166', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('106', '170', '170', '170', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('107', '177', '177', '177', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('108', '198', '198', '198', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('109', '200', '200', '200', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('110', '210', '210', '210', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('111', '212', '212', '212', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('112', '216', '216', '216', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('113', '217', '217', '217', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('114', '218', '218', '218', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('115', '222', '222', '222', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('116', '223', '223', '223', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('117', '230', '230', '230', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('118', '238', '238', '238', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('119', '240', '240', '240', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('120', '241', '241', '241', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('121', '250', '250', '250', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('122', '270', '270', '270', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('123', '271', '271', '271', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('124', '272', '272', '272', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('125', '275', '275', '275', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('126', '300', '300', '300', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('127', '302', '302', '302', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('128', '304', '304', '304', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('129', '410', '410', '410', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('130', '450', '450', '450', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('131', '500', '500', '500', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('132', '502', '502', '502', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('133', '504', '504', '504', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('134', '506', '506', '506', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('135', '508', '508', '508', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('136', '800', '800', '800', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('137', '834', '834', '834', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('138', '970', '970', '970', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('139', '102', '1020', '1020', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('140', '102', '1026', '1026', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('141', '102', '1027', '1027', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('142', '134', '1341', '1341', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('143', '134', '1342', '1342', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('144', '134', '1343', '1343', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('145', '200', '2008', '2008', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('146', '205', '2050', '2050', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('147', '602', '6026', '6026', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('148', '602', '6027', '6027', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('149', '802', '8026', '8026', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('150', 'COR', 'CORAZO', 'CORAZON', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('151', 'NUE', 'NUEVA', 'NUEVA', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `modelos` VALUES ('152', 'RAY', 'RAYA', 'RAYA', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for movimientos
-- ----------------------------
DROP TABLE IF EXISTS `movimientos`;
CREATE TABLE `movimientos` (
  `mercaderia_id` int(11) unsigned NOT NULL,
  `documento_id` int(11) unsigned NOT NULL,
  `flagoferta` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`mercaderia_id`,`documento_id`),
  KEY `documento_id` (`documento_id`),
  CONSTRAINT `movimientos_ibfk_1` FOREIGN KEY (`mercaderia_id`) REFERENCES `mercaderias` (`id`),
  CONSTRAINT `movimientos_ibfk_2` FOREIGN KEY (`documento_id`) REFERENCES `documentos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of movimientos
-- ----------------------------
INSERT INTO `movimientos` VALUES ('16', '2', '000', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `movimientos` VALUES ('17', '2', '000', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `movimientos` VALUES ('18', '2', '000', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `movimientos` VALUES ('19', '2', '000', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `movimientos` VALUES ('20', '2', '000', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `movimientos` VALUES ('648', '6', '', '2015-06-21 09:36:47', '2015-06-21 09:36:47');
INSERT INTO `movimientos` VALUES ('649', '6', '', '2015-06-21 09:36:48', '2015-06-21 09:36:48');
INSERT INTO `movimientos` VALUES ('650', '6', '', '2015-06-21 09:36:48', '2015-06-21 09:36:48');
INSERT INTO `movimientos` VALUES ('651', '6', '', '2015-06-21 09:36:48', '2015-06-21 09:36:48');
INSERT INTO `movimientos` VALUES ('652', '7', '', '2015-06-21 09:40:03', '2015-06-21 09:40:03');
INSERT INTO `movimientos` VALUES ('653', '7', '', '2015-06-21 09:40:03', '2015-06-21 09:40:03');
INSERT INTO `movimientos` VALUES ('654', '7', '', '2015-06-21 09:40:03', '2015-06-21 09:40:03');
INSERT INTO `movimientos` VALUES ('655', '7', '', '2015-06-21 09:40:03', '2015-06-21 09:40:03');
INSERT INTO `movimientos` VALUES ('656', '7', '', '2015-06-21 09:40:04', '2015-06-21 09:40:04');
INSERT INTO `movimientos` VALUES ('657', '7', '', '2015-06-21 09:40:04', '2015-06-21 09:40:04');
INSERT INTO `movimientos` VALUES ('658', '7', '', '2015-06-21 09:40:04', '2015-06-21 09:40:04');
INSERT INTO `movimientos` VALUES ('659', '7', '', '2015-06-21 09:40:04', '2015-06-21 09:40:04');
INSERT INTO `movimientos` VALUES ('660', '7', '', '2015-06-21 09:40:04', '2015-06-21 09:40:04');
INSERT INTO `movimientos` VALUES ('661', '7', '', '2015-06-21 09:40:05', '2015-06-21 09:40:05');
INSERT INTO `movimientos` VALUES ('662', '7', '', '2015-06-21 09:40:05', '2015-06-21 09:40:05');
INSERT INTO `movimientos` VALUES ('663', '7', '', '2015-06-21 09:40:05', '2015-06-21 09:40:05');
INSERT INTO `movimientos` VALUES ('664', '7', '', '2015-06-21 09:40:05', '2015-06-21 09:40:05');

-- ----------------------------
-- Table structure for productos
-- ----------------------------
DROP TABLE IF EXISTS `productos`;
CREATE TABLE `productos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `provider_id` int(11) unsigned NOT NULL,
  `marca_id` int(11) unsigned NOT NULL,
  `tipo_id` int(11) unsigned NOT NULL,
  `modelo_id` int(11) unsigned NOT NULL,
  `material_id` int(11) unsigned NOT NULL,
  `color_id` int(11) unsigned NOT NULL,
  `rango_id` int(11) unsigned NOT NULL,
  `talla_id` int(11) unsigned NOT NULL,
  `desproducto` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `codproducto31` char(45) COLLATE utf8_spanish_ci NOT NULL,
  `preciocompra` decimal(6,2) NOT NULL,
  `precioventa` decimal(6,2) NOT NULL,
  `usuario_id` int(11) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `marca_id` (`marca_id`),
  KEY `talla_id` (`talla_id`),
  KEY `tipo_id` (`tipo_id`),
  KEY `color_id` (`color_id`),
  KEY `provider_id` (`provider_id`),
  KEY `material_id` (`material_id`),
  KEY `modelo_id` (`modelo_id`),
  KEY `rango_id` (`rango_id`),
  CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`marca_id`) REFERENCES `marcas` (`id`),
  CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`talla_id`) REFERENCES `tallas` (`id`),
  CONSTRAINT `productos_ibfk_3` FOREIGN KEY (`tipo_id`) REFERENCES `tipos` (`id`),
  CONSTRAINT `productos_ibfk_4` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`),
  CONSTRAINT `productos_ibfk_5` FOREIGN KEY (`provider_id`) REFERENCES `providers` (`id`),
  CONSTRAINT `productos_ibfk_6` FOREIGN KEY (`material_id`) REFERENCES `materials` (`id`),
  CONSTRAINT `productos_ibfk_7` FOREIGN KEY (`modelo_id`) REFERENCES `modelos` (`id`),
  CONSTRAINT `productos_ibfk_8` FOREIGN KEY (`rango_id`) REFERENCES `rangos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of productos
-- ----------------------------
INSERT INTO `productos` VALUES ('1', '3', '3', '27', '42', '2', '1', '2', '7', null, 'AVE-VESTIR-52-CUE-NEGRO-3-8-33', '0.00', '0.00', '1', '2015-06-10 20:50:38', '2015-06-10 20:50:38');
INSERT INTO `productos` VALUES ('3', '3', '3', '27', '42', '2', '1', '2', '9', '', 'AVE-VESTIR-52-CUE-NEGRO-3-8-35', '0.00', '0.00', '1', '2015-06-10 20:50:38', '2015-06-10 20:50:38');
INSERT INTO `productos` VALUES ('4', '3', '3', '27', '42', '2', '1', '2', '10', null, 'AVE-VESTIR-52-CUE-NEGRO-3-8-36', '0.00', '0.00', '1', '2015-06-10 20:50:39', '2015-06-10 20:50:39');
INSERT INTO `productos` VALUES ('5', '3', '3', '27', '42', '2', '1', '2', '11', null, 'AVE-VESTIR-52-CUE-NEGRO-3-8-37', '0.00', '0.00', '1', '2015-06-10 20:50:39', '2015-06-10 20:50:39');
INSERT INTO `productos` VALUES ('6', '3', '3', '27', '42', '2', '1', '2', '12', null, 'AVE-VESTIR-52-CUE-NEGRO-3-8-38', '0.00', '0.00', '1', '2015-06-10 20:50:39', '2015-06-10 20:50:39');
INSERT INTO `productos` VALUES ('7', '2', '2', '13', '11', '2', '1', '2', '7', null, 'BOA-ESCNIÑO-13-CUE-NEGRO-3-8-33', '0.00', '0.00', '1', '2015-06-10 20:50:41', '2015-06-10 20:50:41');
INSERT INTO `productos` VALUES ('8', '2', '2', '13', '11', '2', '1', '2', '8', '', 'BOA-ESCNIÑO-13-CUE-NEGRO-3-8-34', '0.00', '0.00', '1', '2015-06-10 20:50:41', '2015-06-10 20:50:41');
INSERT INTO `productos` VALUES ('9', '2', '2', '13', '11', '2', '1', '2', '9', '', 'BOA-ESCNIÑO-13-CUE-NEGRO-3-8-35', '0.00', '0.00', '1', '2015-06-10 20:50:41', '2015-06-10 20:50:41');
INSERT INTO `productos` VALUES ('10', '2', '2', '13', '11', '2', '1', '2', '10', '', 'BOA-ESCNIÑO-13-CUE-NEGRO-3-8-36', '0.00', '0.00', '1', '2015-06-10 20:50:42', '2015-06-10 20:50:42');
INSERT INTO `productos` VALUES ('11', '2', '2', '13', '11', '2', '1', '2', '11', '', 'BOA-ESCNIÑO-13-CUE-NEGRO-3-8-37', '0.00', '0.00', '1', '2015-06-10 20:50:42', '2015-06-10 20:50:42');
INSERT INTO `productos` VALUES ('12', '2', '2', '13', '11', '2', '1', '2', '12', '', 'BOA-ESCNIÑO-13-CUE-NEGRO-3-8-38', '0.00', '0.00', '1', '2015-06-10 20:50:42', '2015-06-10 20:50:42');
INSERT INTO `productos` VALUES ('13', '1', '1', '23', '79', '2', '11', '3', '12', null, 'AND-SANDCHAL-113-CUE-AZUL-8-4-38', '0.00', '0.00', '1', '2015-06-10 20:50:44', '2015-06-10 20:50:44');
INSERT INTO `productos` VALUES ('14', '1', '1', '23', '79', '2', '11', '3', '13', null, 'AND-SANDCHAL-113-CUE-AZUL-8-4-39', '0.00', '0.00', '1', '2015-06-10 20:50:44', '2015-06-10 20:50:44');
INSERT INTO `productos` VALUES ('15', '1', '1', '23', '79', '2', '11', '3', '14', null, 'AND-SANDCHAL-113-CUE-AZUL-8-4-40', '0.00', '0.00', '1', '2015-06-10 20:50:44', '2015-06-10 20:50:44');
INSERT INTO `productos` VALUES ('16', '1', '1', '23', '79', '2', '11', '3', '15', null, 'AND-SANDCHAL-113-CUE-AZUL-8-4-41', '0.00', '0.00', '1', '2015-06-10 20:50:44', '2015-06-10 20:50:44');
INSERT INTO `productos` VALUES ('17', '1', '1', '23', '79', '2', '11', '3', '16', null, 'AND-SANDCHAL-113-CUE-AZUL-8-4-42', '0.00', '0.00', '1', '2015-06-10 20:50:45', '2015-06-10 20:50:45');
INSERT INTO `productos` VALUES ('18', '1', '1', '23', '79', '2', '11', '3', '17', null, 'AND-SANDCHAL-113-CUE-AZUL-8-4-43', '0.00', '0.00', '1', '2015-06-10 20:50:45', '2015-06-10 20:50:45');
INSERT INTO `productos` VALUES ('19', '1', '1', '23', '79', '2', '11', '3', '18', null, 'AND-SANDCHAL-113-CUE-AZUL-8-4-44', '0.00', '0.00', '1', '2015-06-10 20:50:45', '2015-06-10 20:50:45');
INSERT INTO `productos` VALUES ('20', '9', '9', '12', '38', '2', '1', '1', '1', null, 'EMB-ESCHOMBR-48-CUE-NEGRO-7-2-27', '0.00', '0.00', '1', '2015-06-10 20:50:48', '2015-06-10 20:50:48');
INSERT INTO `productos` VALUES ('21', '9', '9', '12', '38', '2', '1', '1', '2', null, 'EMB-ESCHOMBR-48-CUE-NEGRO-7-2-28', '0.00', '0.00', '1', '2015-06-10 20:50:48', '2015-06-10 20:50:48');
INSERT INTO `productos` VALUES ('22', '9', '9', '12', '38', '2', '1', '1', '3', null, 'EMB-ESCHOMBR-48-CUE-NEGRO-7-2-29', '0.00', '0.00', '1', '2015-06-10 20:50:48', '2015-06-10 20:50:48');
INSERT INTO `productos` VALUES ('23', '9', '9', '12', '38', '2', '1', '1', '4', null, 'EMB-ESCHOMBR-48-CUE-NEGRO-7-2-30', '0.00', '0.00', '1', '2015-06-10 20:50:49', '2015-06-10 20:50:49');
INSERT INTO `productos` VALUES ('24', '9', '9', '12', '38', '2', '1', '1', '5', null, 'EMB-ESCHOMBR-48-CUE-NEGRO-7-2-31', '0.00', '0.00', '1', '2015-06-10 20:50:54', '2015-06-10 20:50:54');
INSERT INTO `productos` VALUES ('25', '9', '9', '12', '38', '2', '1', '1', '6', null, 'EMB-ESCHOMBR-48-CUE-NEGRO-7-2-32', '0.00', '0.00', '1', '2015-06-10 20:50:54', '2015-06-10 20:50:54');
INSERT INTO `productos` VALUES ('32', '7', '7', '4', '109', '5', '12', '2', '7', null, 'DRA-BOTINESC-200-GUM-BLANCO-3-8-33', '0.00', '0.00', '0', '2015-06-10 20:50:56', '2015-06-10 20:50:56');
INSERT INTO `productos` VALUES ('34', '7', '7', '4', '109', '5', '12', '2', '9', null, 'DRA-BOTINESC-200-GUM-BLANCO-3-8-35', '0.00', '0.00', '0', '2015-06-10 20:50:56', '2015-06-10 20:50:56');
INSERT INTO `productos` VALUES ('35', '7', '7', '4', '109', '5', '12', '2', '10', null, 'DRA-BOTINESC-200-GUM-BLANCO-3-8-36', '0.00', '0.00', '0', '2015-06-10 20:50:56', '2015-06-10 20:50:56');
INSERT INTO `productos` VALUES ('36', '7', '7', '4', '109', '5', '12', '2', '11', null, 'DRA-BOTINESC-200-GUM-BLANCO-3-8-37', '0.00', '0.00', '0', '2015-06-10 20:50:56', '2015-06-10 20:50:56');
INSERT INTO `productos` VALUES ('37', '7', '7', '4', '109', '5', '12', '2', '12', null, 'DRA-BOTINESC-200-GUM-BLANCO-3-8-38', '0.00', '0.00', '0', '2015-06-10 20:50:57', '2015-06-10 20:50:57');
INSERT INTO `productos` VALUES ('45', '7', '7', '4', '109', '5', '12', '2', '8', null, 'DRA-BOTINESC-200-GUM-BLANCO-3-8-34', '0.00', '0.00', '0', '2015-06-10 20:50:58', '2015-06-10 20:50:58');

-- ----------------------------
-- Table structure for providers
-- ----------------------------
DROP TABLE IF EXISTS `providers`;
CREATE TABLE `providers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `codprovider3` varchar(3) COLLATE utf8_spanish_ci NOT NULL,
  `codprovider6` varchar(6) COLLATE utf8_spanish_ci NOT NULL,
  `desprovider` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of providers
-- ----------------------------
INSERT INTO `providers` VALUES ('1', 'AND', 'ANDERS', 'ANDERSON', '1', '2015-06-20 20:02:20', '2015-06-20 20:02:20');
INSERT INTO `providers` VALUES ('2', 'BOA', 'BOAZ', 'BOAZ', '1', '2015-06-20 20:02:20', '2015-06-20 20:02:20');
INSERT INTO `providers` VALUES ('3', 'AVE', 'AVENTU', 'AVENTURERO', '1', '2015-06-06 00:54:01', '2015-06-06 00:54:01');
INSERT INTO `providers` VALUES ('4', 'BRA', 'BRASIL', 'BRASILIA', '1', '2015-06-06 00:54:01', '2015-06-06 00:54:01');
INSERT INTO `providers` VALUES ('5', 'CZB', 'CALZ-B', 'CALZADO B', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `providers` VALUES ('6', 'DAM', 'DAMBER', 'DAMBER', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `providers` VALUES ('7', 'DRA', 'DRAGON', 'DRAGON', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `providers` VALUES ('8', 'EB', 'EB', 'EB', '1', '2015-06-06 00:57:07', '2015-06-06 00:57:07');
INSERT INTO `providers` VALUES ('9', 'EMB', 'EMBAJA', 'EMBAJADOR', '1', '2015-06-06 00:57:07', '2015-06-06 00:57:07');
INSERT INTO `providers` VALUES ('10', 'KEN', 'KENSA', 'KENSA', '1', '2015-06-06 00:57:07', '2015-06-06 00:57:07');
INSERT INTO `providers` VALUES ('11', 'PRI', 'PRINCE', 'PRINCE', '1', '2015-06-06 00:57:07', '2015-06-06 00:57:07');

-- ----------------------------
-- Table structure for rangos
-- ----------------------------
DROP TABLE IF EXISTS `rangos`;
CREATE TABLE `rangos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `codrango3` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `codrango6` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `desrango` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of rangos
-- ----------------------------
INSERT INTO `rangos` VALUES ('1', '7-2', '27-32', '27-32', '1', '2015-05-31 17:13:59', '2015-05-31 17:13:59');
INSERT INTO `rangos` VALUES ('2', '3-8', '33-38', '33-38', '1', '2015-05-31 17:14:23', '2015-05-31 17:14:23');
INSERT INTO `rangos` VALUES ('3', '8-4', '38-44', '38-44', '1', '2015-06-01 01:06:43', '2015-06-01 01:06:43');

-- ----------------------------
-- Table structure for tallas
-- ----------------------------
DROP TABLE IF EXISTS `tallas`;
CREATE TABLE `tallas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `codtalla3` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `codtalla6` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `destalla` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `rango_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tallas
-- ----------------------------
INSERT INTO `tallas` VALUES ('1', '27', '27', '27', '1', '1', '2015-05-31 17:14:45', '2015-05-31 21:09:40');
INSERT INTO `tallas` VALUES ('2', '28', '28', '28', '1', '1', '2015-05-31 17:14:57', '2015-05-31 17:14:57');
INSERT INTO `tallas` VALUES ('3', '29', '29', '29', '1', '1', '2015-05-31 17:15:17', '2015-05-31 17:15:17');
INSERT INTO `tallas` VALUES ('4', '30', '30', '30', '1', '1', '2015-05-31 17:15:34', '2015-05-31 17:15:34');
INSERT INTO `tallas` VALUES ('5', '31', '31', '31', '1', '1', '2015-05-31 17:15:45', '2015-05-31 17:15:45');
INSERT INTO `tallas` VALUES ('6', '32', '32', '32', '1', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tallas` VALUES ('7', '33', '33', '33', '1', '2', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tallas` VALUES ('8', '34', '34', '34', '1', '2', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tallas` VALUES ('9', '35', '35', '35', '1', '2', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tallas` VALUES ('10', '36', '36', '36', '1', '2', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tallas` VALUES ('11', '37', '37', '37', '1', '2', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tallas` VALUES ('12', '38', '38', '38', '1', '2', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tallas` VALUES ('13', '38', '38', '38', '1', '3', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tallas` VALUES ('14', '39', '39', '39', '1', '3', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tallas` VALUES ('15', '40', '40', '40', '1', '3', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tallas` VALUES ('16', '41', '41', '41', '1', '3', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tallas` VALUES ('17', '42', '42', '42', '1', '3', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tallas` VALUES ('18', '43', '43', '43', '1', '3', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tallas` VALUES ('19', '44', '44', '44', '1', '3', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for tipomovimientos
-- ----------------------------
DROP TABLE IF EXISTS `tipomovimientos`;
CREATE TABLE `tipomovimientos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `codtipomovimiento3` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `codtipomovimiento6` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `destipomovimiento` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tipomovimientos
-- ----------------------------
INSERT INTO `tipomovimientos` VALUES ('1', 'in', 'in', 'ingreso prov- almacen', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tipomovimientos` VALUES ('2', 'sa', 'sa', 'salida almacen - pto', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tipomovimientos` VALUES ('3', 've', 've', 'venta pto - cliente', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tipomovimientos` VALUES ('4', 'ca', 'ca', 'cambio cliente - punto', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tipomovimientos` VALUES ('5', 're', 're', 'reingreso pto- almacen', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tipomovimientos` VALUES ('6', 'de', 'de', 'devolucion pto/almacen - almacen', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tipomovimientos` VALUES ('7', 'ba', 'ba', 'baja almacen - prov', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for tipos
-- ----------------------------
DROP TABLE IF EXISTS `tipos`;
CREATE TABLE `tipos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `codtipo3` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `codtipo8` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `destipo` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tipos
-- ----------------------------
INSERT INTO `tipos` VALUES ('1', 'BAL', 'BALE', 'BALE', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tipos` VALUES ('2', 'BOT', 'BOTA', 'BOTA', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tipos` VALUES ('3', 'BOT', 'BOTIN', 'BOTIN', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tipos` VALUES ('4', 'BES', 'BOTINESC', 'BOTIN ESCOLAR', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tipos` VALUES ('5', 'BMI', 'BOTINMIL', 'BOTIN MILITAR', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tipos` VALUES ('6', 'BPC', 'BOTPLCAU', 'BOTIN PLANTA CAUCHO', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tipos` VALUES ('7', 'BOT', 'BOTINTEX', 'BOTIN TEXANO', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tipos` VALUES ('8', 'BOT', 'BOTINVES', 'BOTIN VESTIR', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tipos` VALUES ('9', 'CAM', 'CAMPER', 'CAMPER', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tipos` VALUES ('10', 'DEM', 'DEMOCRAT', 'DEMOCRATICO', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tipos` VALUES ('11', 'ESC', 'ESCODAMA', 'ESCOLAR DAMA', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tipos` VALUES ('12', 'ESC', 'ESCHOMBR', 'ESCOLAR HOMBRE', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tipos` VALUES ('13', 'ESC', 'ESCNIÑO', 'ESCOLAR NIÑO', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tipos` VALUES ('14', 'F20', 'F20', 'F20', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tipos` VALUES ('15', 'GRA', 'GRAF', 'GRAF', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tipos` VALUES ('16', 'HUE', 'HUELLA', 'HUELLA', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tipos` VALUES ('17', 'KEN', 'KENNEDY', 'KENNEDY', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tipos` VALUES ('18', 'MOC', 'MOCASIN', 'MOCASIN', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tipos` VALUES ('19', 'NOR', 'NORMAL', 'NORMAL', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tipos` VALUES ('20', 'PAL', 'PALA', 'PALA', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tipos` VALUES ('21', 'PLA', 'PLANTCAU', 'PLANTA CAUCHO', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tipos` VALUES ('22', 'PLA', 'PLANTSUE', 'PLANTA SUELA', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tipos` VALUES ('23', 'SAN', 'SANDCHAL', 'SANDALIA CHALA', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tipos` VALUES ('24', 'SPO', 'SPORTMOC', 'SPORT MOCASIN', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tipos` VALUES ('25', 'SPO', 'SPORTSID', 'SPORT TOP SIDER', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tipos` VALUES ('26', 'TOP', 'TOPEROL', 'TOPEROL', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tipos` VALUES ('27', 'VES', 'VESTIR', 'VESTIR', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `desusuario` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `rolusuario` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'MARIO', 'MARIO BORJA', 'SUPER', '$2y$10$v5tjhujPQPEARx.9lGAdyOZkEqjc/xYssPPr3gG7jE6mM6e.lYGcu', '1', 'xms2D9a6zPCZNULfbJvnCbo8TLYfXCFY6mIGkWVC9S1JzsptuPXjcs6I4IW8', '0000-00-00 00:00:00', '2015-06-16 16:20:47');
INSERT INTO `users` VALUES ('2', 'ADMIN1', 'NOMBRE ADMINISTRADOR1', 'ADMIN', '$2y$10$dihXxahbQs8KYga.5afoguOtmRDNqJZw12XvUc3SMCn.oAwN8HFLG', '1', null, '0000-00-00 00:00:00', '2015-06-15 22:28:37');
INSERT INTO `users` VALUES ('3', 'ADMIN2', 'ADMINIST DOS', 'ADMIN', '$2y$10$Hz0X52u9isgmyTNEzhvbCe9lTxmAkTHP0in8ts0Va59N4jAF7RcOi', '1', null, '0000-00-00 00:00:00', '2015-06-15 22:28:46');
INSERT INTO `users` VALUES ('4', 'ALMAC', 'NOMBRE ALMACENERO', 'ALMAC', '$2y$10$/Dr8TdfgYVzGbiYwizUWOesbj71EFILqyQDZuRPf/tI1ian7ZnF/6', '1', null, '0000-00-00 00:00:00', '2015-06-15 22:28:58');
INSERT INTO `users` VALUES ('5', 'VENDE1', 'NOMBRE VENDE1', 'VENDE', '$2y$10$9RCGX6kNeDI6q4zjzlUSD.WvyZ3U9tToQ7vTMtlOKmZDWEid27No6', '1', null, '0000-00-00 00:00:00', '2015-06-15 22:29:07');
INSERT INTO `users` VALUES ('6', 'VENDE2', 'NOMBRE VENDE DOS', 'VENDE', '$2y$10$GW3ECOk8Gtfx/ausOPbwWOy33HtIQh0twGJ543OtQuhID7QSeQh.q', '1', null, '0000-00-00 00:00:00', '2015-06-15 22:29:17');
INSERT INTO `users` VALUES ('7', 'VENDE3', 'NOMBRE VEMDE3', 'VENDE', '$2y$10$A9uBrL8BwrpPX7jOWdHIzeHF3t2aMtdB7rnW.h6FQ5kqM9jBZpb3u', '1', null, '0000-00-00 00:00:00', '2015-06-15 22:29:25');
INSERT INTO `users` VALUES ('14', 'ADMIN3', 'NOMBRE ADMINISTRADOR3', 'ADMIN', '$2y$10$Z1KDDYig3P701Hx0AvEMCOIK5pdjRknlWF4WPCJJqsD4S2SnJNtLC', '1', null, '2015-06-04 21:13:31', '2015-06-15 22:29:55');

-- ----------------------------
-- Procedure structure for AddDocumentos
-- ----------------------------
DROP PROCEDURE IF EXISTS `AddDocumentos`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `AddDocumentos`( 		
        tipomovimiento_id   int,
		localini_id         int,
		localfin_id         int,
		flagestado          char(3),

		usuario_id          int,
 out    er_text             char(25),
 out    documento_id        int)
BEGIN

/*
Procedimiento para el ingreso de los documentos ( archivo maestro de los movimientos )
declare full_error char(50);
*/

declare exit handler for sqlexception
begin
	rollback;
    set er_text = 'error en sp_adddocumentos';
end;

start transaction;

		INSERT INTO `souko`.`documentos`
		(`fechadocumento`,
		`tipomovimiento_id`,
		`localini_id`,
		`localfin_id`,
		`flagestado`,
		`usuario_id`)
		VALUES
		(curdate(),
		tipomovimiento_id,
		localini_id,
		localfin_id,
		flagestado,
		usuario_id);
      
commit;
 SET documento_id = LAST_INSERT_ID();
 set er_text = 'ok';

END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for AddMercaderias
-- ----------------------------
DROP PROCEDURE IF EXISTS `AddMercaderias`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `AddMercaderias`(
		producto_id  			int, 
		local_id 				int, 
		preciocompra 			decimal(6,2),
		precioventa 			decimal(6,2),
		usuario_id 				int,
 out    er_text                 char(25))
BEGIN

/*
ingresa items en la tabla mercaderias

*/
declare mercaderiacambio_id INT;
declare estado char(3);

declare exit handler for sqlexception
begin
	rollback;
    set er_text = 'error en sp_addmercaderias';
end;


start transaction;

	set mercaderiacambio_id = 0;
    set estado = 'ACT';
    
	INSERT INTO `souko`.`mercaderias`
	(`producto_id`,
	`mercaderiacambio_id`,
	`local_id`,
	`estado`,
	`preciocompra`,
	`precioventa`,
	`usuario_id`)
	VALUES
	(producto_id,
	 mercaderiacambio_id,
	 local_id,
	 estado,
	 preciocompra,
	 precioventa,
	 usuario_id);

commit;

 set er_text = 'ok';
 
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for AddMovimientos
-- ----------------------------
DROP PROCEDURE IF EXISTS `AddMovimientos`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `AddMovimientos`(
		 mercaderia_id   int, 
         documento_id    int,
 out    er_text             char(25))
BEGIN

declare flagoferta  char(3);

declare exit handler for sqlexception
begin
	rollback;
    set er_text = 'error en sp_addmovimientos';
end;

start transaction;

	set flagoferta = '000';

		-- ingreso y registro demovimientos
		INSERT INTO `souko`.`movimientos`
		(`mercaderia_id`,`documento_id`,`flagoferta`)
		values
		(mercaderia_id,documento_id, flagoferta );

 commit; 
 set er_text = 'ok';
 
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for IngresoMercaderiaProveedor
-- ----------------------------
DROP PROCEDURE IF EXISTS `IngresoMercaderiaProveedor`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `IngresoMercaderiaProveedor`(
		documento_id            int,
		producto_id  			int,  
		local_id 				int, 
		preciocompra 			decimal(6,2),
		precioventa 			decimal(6,2),
		usuario_id 				int,
        cant                    int,
 out    er_text                 char(25))
BEGIN
/*´
se usa para el ingreso de mercaderias al almacen, desde el proveedor.
usa un loop de acuerdo a la cantida ingresada
1. registrar en la tabla mercadería.
2. registra el movimiento de ingreso del producto para su trazabilidad
*/
declare cont int default 1;
declare mercaderia_id int;

declare exit handler for sqlexception
begin
	rollback;
    set er_text = 'error en IngresoMercaderiaProveedor';
end;

start transaction;

   WHILE cont  <= cant DO
		-- llamar al procedimiento de mercadería
		CALL `AddMercaderias`
        (producto_id,   
		 local_id, 
		 preciocompra,
		 precioventa,
		 usuario_id,
         er_text);
		SET mercaderia_id = LAST_INSERT_ID();
       
		CALL `AddMovimientos`(mercaderia_id, documento_id,er_text);

		SET  cont = cont + 1; 
   END WHILE;
   
commit;
 set er_text = 'ok';
 
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for SalidaMercaderiaPto
-- ----------------------------
DROP PROCEDURE IF EXISTS `SalidaMercaderiaPto`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SalidaMercaderiaPto`(
		documento_id            int,
		mercaderia_id  			int,  
		usuario_id 				int,
 out    er_text                 char(25))
BEGIN

/*´
se usa para el movimiento de mercaderias entre los locales.

1. registra el movimiento de ingreso del producto para su trazabilidad
2. carga los datos de documentos en las variables
2. actualiza el estado en la tabla mercadería.
*/

declare locini_id int;
declare locfin_id int;

declare exit handler for sqlexception
begin
	rollback;
    set er_text = 'Error SalidaMercaderiaPto';
end;


	select `localfin_id` , `localini_id` into locfin_id, locini_id
    from `souko`.`documentos`
    where `id`  = documento_id;


start transaction;
 	
	UPDATE `souko`.`mercaderias`
	SET `local_id` = locfin_id  
	WHERE `id` = mercaderia_id;

	CALL `AddMovimientos`(mercaderia_id, documento_id, er_text);


commit;
 set er_text = 'ok';
 
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for VentaMercaderia
-- ----------------------------
DROP PROCEDURE IF EXISTS `VentaMercaderia`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `VentaMercaderia`(
		documento_id            int,
		mercaderia_id  			int,  
        _precioventa             decimal(6,2),
		usuario_id 				int,
 out    er_text                 char(25))
BEGIN

/*´
se usa para el movimiento de mercaderias entre los locales.

1. carga los datos de documentos en las variables
2. actualiza mercaderias estado y precioventa
2. adiciona registro de movimiento de asociado a documento.
*/

declare locini_id int;
declare locfin_id int;

declare exit handler for sqlexception
begin
	rollback;
    set er_text = 'Error VentaMercaderia';
end;

	select `localfin_id` , `localini_id` into locfin_id, locini_id
    from `souko`.`documentos`
    where `id`  = documento_id;

start transaction;
 	
	UPDATE `souko`.`mercaderias`
	SET `estado` = 'VEN',
         `precioventa` = _precioventa,
         `local_id` = locfin_id
	WHERE `id` = mercaderia_id;

	CALL `AddMovimientos`(mercaderia_id, documento_id, er_text);


commit;
 set er_text = 'ok';
 end
;;
DELIMITER ;
