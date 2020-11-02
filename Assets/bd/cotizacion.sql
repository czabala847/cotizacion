-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.11-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.0.0.5929
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura para tabla cotizacion.cotizaciones
CREATE TABLE IF NOT EXISTS `cotizaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(83) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `correo` varchar(50) NOT NULL DEFAULT '0',
  `asunto` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `cedula` (`cedula`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla cotizacion.cotizaciones: ~12 rows (aproximadamente)
DELETE FROM `cotizaciones`;
/*!40000 ALTER TABLE `cotizaciones` DISABLE KEYS */;
INSERT INTO `cotizaciones` (`id`, `nombre`, `cedula`, `correo`, `asunto`, `created_at`, `update_at`) VALUES
	(23, '1143460015', 'carlos', 'carlos@example.com', 'dks', '2020-04-16 18:43:12', '2020-04-16 18:43:12'),
	(24, '11', 'ds', 'ds@exmple.com', 'ds', '2020-04-16 21:10:27', '2020-04-16 21:10:27'),
	(25, 'Prueba1', '1143460015', 'prueba@example.com', '', '2020-05-21 16:08:29', '2020-05-21 16:08:29'),
	(26, 'cotizacion', '111', 'cotizacion@example.com', '', '2020-05-21 16:11:35', '2020-05-21 16:11:35'),
	(37, 'Carlos', '11', 'czabala847@gm.com', 'ds', '2020-08-19 14:49:01', '2020-08-19 14:49:01'),
	(38, 'car', '11', 'czabala847@gmail.com', 'dsdsdsds', '2020-08-19 14:55:00', '2020-08-19 14:55:00'),
	(39, 'Prueba', '111', 'pru@example.com', 'dds', '2020-08-19 15:00:24', '2020-08-19 15:00:24'),
	(40, 'rr', '1', 'ds@x.com', 'sd', '2020-08-19 15:02:16', '2020-08-19 15:02:16'),
	(41, 'ss', '5454', 'sas@exma.com', 'dsd', '2020-08-19 15:03:05', '2020-08-19 15:03:05'),
	(42, '1', '1', '1@example.com', '1', '2020-09-28 18:56:05', '2020-09-28 18:56:05'),
	(43, '1', '1', '1@example.com', '', '2020-09-28 18:59:30', '2020-09-28 18:59:30'),
	(44, '1', '1', '1@example.com', '1', '2020-09-28 19:03:36', '2020-09-28 19:03:36');
/*!40000 ALTER TABLE `cotizaciones` ENABLE KEYS */;

-- Volcando estructura para tabla cotizacion.cotizaciones_detalle
CREATE TABLE IF NOT EXISTS `cotizaciones_detalle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ruta` varchar(100) NOT NULL,
  `codigo_cotizacion` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `FK_detalle_cotizacion` (`codigo_cotizacion`),
  CONSTRAINT `FK_detalle_cotizacion` FOREIGN KEY (`codigo_cotizacion`) REFERENCES `cotizaciones` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla cotizacion.cotizaciones_detalle: ~16 rows (aproximadamente)
DELETE FROM `cotizaciones_detalle`;
/*!40000 ALTER TABLE `cotizaciones_detalle` DISABLE KEYS */;
INSERT INTO `cotizaciones_detalle` (`id`, `ruta`, `codigo_cotizacion`, `created_at`, `update_at`) VALUES
	(1, 'src/archivos/carlos/5688eb9b100bf8d59578c6967c823c1f.pdf', 23, '2020-04-16 18:43:12', '2020-04-16 18:43:12'),
	(2, 'src/archivos/carlos/a749097b13a3685b8aec111487d018aa.pdf', 23, '2020-04-16 18:43:12', '2020-04-16 18:43:12'),
	(3, 'src/archivos/ds/259bab58dfb7cab24815bad749146347.pdf', 24, '2020-04-16 21:10:27', '2020-04-16 21:10:27'),
	(4, 'src/archivos/1143460015/b8a6c440e95d3211c428a6d3a39663bc.pdf', 25, '2020-05-21 16:08:29', '2020-05-21 16:08:29'),
	(5, 'src/archivos/111/116b4e7f44c5da5e8fa1a3b865fe3d43.pdf', 26, '2020-05-21 16:11:35', '2020-05-21 16:11:35'),
	(6, 'src/archivos/111/7217343c4d7c6c434cad07ed76ff1839.pdf', 26, '2020-05-21 16:11:35', '2020-05-21 16:11:35'),
	(7, 'src/archivos/111/51e4b366d01feaa074b8a2833b11ebdd.pdf', 26, '2020-05-21 16:11:35', '2020-05-21 16:11:35'),
	(18, '11/76888e30b07bababe00b8cab585b49b6.jpg', 37, '2020-08-19 14:49:01', '2020-08-19 14:49:01'),
	(19, '11/d492b6b8b6b44c3ba9cc39cb7731a2be.jpg', 38, '2020-08-19 14:55:00', '2020-08-19 14:55:00'),
	(20, 'Files/111/eb5cfee67dcd01a7b939b5e640a8282a.jpg', 39, '2020-08-19 15:00:24', '2020-08-19 15:00:25'),
	(21, 'Files/1/c83fcec9766a713172da9dd1fe22c111.jpg', 40, '2020-08-19 15:02:16', '2020-08-19 15:02:16'),
	(22, 'Files/5454/24294fadc0571fb306ed698ad8c52837.jpg', 41, '2020-08-19 15:03:05', '2020-08-19 15:03:05'),
	(23, 'Files/1/07f7018fa2b09fe3da49b9a982d8550a.jpg', 42, '2020-09-28 18:56:05', '2020-09-28 18:56:06'),
	(24, 'Files/1/6cfbc2aa71bcc3b830f0250c4b735497.jpg', 43, '2020-09-28 18:59:30', '2020-09-28 18:59:30'),
	(25, 'Files/1/eac7b5b0de6e8246dbecc7fdb5e6f7fe.pdf', 44, '2020-09-28 19:03:36', '2020-09-28 19:03:37'),
	(26, 'Files/1/b2925a751f6c402fbacdb11847fd8a84.jpg', 44, '2020-09-28 19:03:37', '2020-09-28 19:03:37');
/*!40000 ALTER TABLE `cotizaciones_detalle` ENABLE KEYS */;

-- Volcando estructura para tabla cotizacion.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `estado` char(1) NOT NULL DEFAULT 'A',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla cotizacion.roles: ~2 rows (aproximadamente)
DELETE FROM `roles`;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `nombre`, `descripcion`, `estado`, `created_at`, `updated_at`) VALUES
	(1, 'Administrador', 'Puede gestionar todos los módulos que maneja el sistema.', 'A', '2020-07-13 12:29:10', '2020-08-27 13:39:25'),
	(2, 'Estandar', 'Rol inicial, se le asigna por defecto cuando se crea un usuario.', 'A', '2020-07-13 12:30:14', '2020-08-27 13:39:26'),
	(3, 'Caja', 'cajero dd', 'I', '2020-09-28 19:13:11', '2020-09-28 19:13:21');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Volcando estructura para tabla cotizacion.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(60) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT 'A',
  `rol` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `cedula` (`cedula`),
  KEY `FK_usuario_rol` (`rol`),
  CONSTRAINT `FK_usuario_rol` FOREIGN KEY (`rol`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla cotizacion.usuarios: ~36 rows (aproximadamente)
DELETE FROM `usuarios`;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `cedula`, `nombre`, `correo`, `contrasena`, `estado`, `rol`, `created_at`, `updated_at`) VALUES
	(1, '1234', 'Carlos Zabala', 'admin@example.com', '$2y$10$dLlaRWMyEmuVhw57MfY.6ucfqhaLVHgBvfZ80AvkNw58RBK/eVsPm', 'A', 1, '2020-04-16 11:36:03', '2020-09-28 19:08:59'),
	(2, '1', 'Bad', 'bad@example.com', '$2y$10$/6RwdUC4yZekwOuL2BFnkOD17WSxBqOgV2mnmy69hpsZ8SW2kLJXq', 'A', 2, '2020-05-04 14:45:56', '2020-08-29 21:15:43'),
	(3, '111', '111', '111@example.com', '1', 'A', 2, '2020-05-31 20:41:47', '2020-07-13 12:30:59'),
	(4, '2', 'Prueba2', 'prueba2@example.com', '$2y$10$yw/aRnjvypcnoX9YraKZkOYiUk1zhgzPHVAXZBT.uAj2LxtLJWjDW', 'A', 2, '2020-05-13 18:50:02', '2020-07-13 14:01:59'),
	(5, '3', 'Prueba3', 'prueba3@example.com', '$2y$10$onXcQKSM2EEhzvWFgC0MZuQk9ci9LLxRn1ilU0SyL5k9RP.7wd0k6', 'A', 2, '2020-05-13 18:50:14', '2020-07-13 12:31:00'),
	(6, '4', 'Prueba4', 'prueba4@example.com', '$2y$10$LTQKOrspkzgMEMzgy9nTiOsa8KKzoawwRWsJ31ZBwN9BNcdSMHuEy', 'A', 2, '2020-05-13 18:50:25', '2020-07-13 12:31:00'),
	(7, '5', 'Prueba5', 'prueba5@example.com', '$2y$10$gB0jFOB8AXdFIljUuvZN5.Vk9lpKEPCA9Lin1MYBjJC1zpPGc9l6W', 'A', 2, '2020-05-13 18:50:40', '2020-07-13 12:31:00'),
	(8, '6', 'Prueba6', 'prueba6@example.com', '$2y$10$ip.eDDF.ovYCptU7MLuXL.F04nND03Uwur/XP0OXc2eBVVJnULEZi', 'I', 2, '2020-05-13 18:51:18', '2020-07-13 12:31:02'),
	(9, '7', 'Prueba7', 'prueba7@example.com', '$2y$10$wlP1VsiQdIdDWpIV5BF4QeT9698W0oVvaNW/pCEyZoL6JgsjCn37.', 'A', 2, '2020-05-13 18:51:31', '2020-07-13 12:31:01'),
	(10, '8', 'Prueba8', 'prueba8@example.com', '$2y$10$WM9kawBuq3j2Vq3YiKLis.BhtT49reyJGzKlf7zlDv92kBOqrOLcW', 'A', 2, '2020-05-13 18:51:43', '2020-07-13 12:31:04'),
	(11, '11', 'Milky Change', 'milkychange@exemple.com', '$2y$10$oYtd2FQPc0RMRENam8vMm.BcZIpmS4gjX4bhA1CVDvhAOMhkQVY7u', 'A', 2, '2020-05-14 19:19:21', '2020-07-13 12:31:04'),
	(12, '2121', 'The Score', 'thescore@example.com', '$2y$10$NythF385pSN7tTicdR5j4uiNyNyAtahHhAUkF8BgTvEgdlfI6SSei', 'I', 2, '2020-05-14 19:20:00', '2020-07-13 12:31:05'),
	(13, '69', 'Ya no', 'soyunhacker@hacker.com', '$2y$10$Bk0xCY/6EfHIvY3JGUdZieg20v15GQ1plByCJBIVVTOnJwoFkbROu', 'I', 2, '2020-05-19 20:53:26', '2020-09-11 17:27:35'),
	(14, '15', 'Prueba15', 'prueba15@example.com', '$2y$10$dB.PmhdhlVZ2cmuQSYAhbueg.5N6zLWtNn7hdKjT0elLDQ6BkcZy.', 'I', 2, '2020-05-20 19:50:49', '2020-08-22 11:06:27'),
	(15, '16', 'Prueba16', 'prueba16@example.com', '$2y$10$KozrM5QhugLnE2tjPUhC..H0lYk3eviiqwadZ8s6VdwMhyy/Qj6N2', 'A', 2, '2020-05-31 18:03:19', '2020-07-13 12:31:06'),
	(16, '17', 'Prueba17', 'Prueba17@example.com', '$2y$10$9UrH1aDwKpjbZoVw/p4MH.kdR7V0rigNc3vvmiuYhIrydjvO2amaG', 'A', 2, '2020-05-31 18:03:34', '2020-07-13 12:31:06'),
	(17, '19', 'Prueba19', 'Prueba19@example.com', '$2y$10$0hJmzZtrj8K/pFB4givYY.GZw1130K0UPrCSXHUIkQi2t8g/kYwRq', 'A', 2, '2020-05-31 18:03:51', '2020-07-13 12:31:07'),
	(18, '20', 'Prueba20', 'Prueba20@example.com', '$2y$10$0.hpTYXRBAnhkmnrNHPrl.4TvdvdO6zLX2NJZVKhqDfWEkhrAcHdm', 'A', 2, '2020-05-31 18:04:07', '2020-07-13 12:31:07'),
	(19, '21', 'Prueba21', 'Prueba21@example.com', '$2y$10$SldMHYQ0W3l13Dab69z9U.S/btdWKQ4ywGnhyYkgtQKA8BVM1Nl6y', 'A', 2, '2020-05-31 18:04:21', '2020-07-13 12:31:07'),
	(20, '22', 'Prueba22', 'Prueba20@example.com', '$2y$10$4BMwdi3ttnaFBWQKopX42O45J3QtfND98vUMbpv1r.Gjq8RPqlNg.', 'A', 2, '2020-05-31 18:05:34', '2020-07-13 12:31:08'),
	(21, '23', 'Prueba23', 'Prueba23@example.com', '$2y$10$iU5.Jc63bLbh6LqFAVXux.V6WLdYTra7hiOEm.s1AvSGUvaj14G8a', 'A', 2, '2020-05-31 18:05:48', '2020-07-13 12:31:08'),
	(22, '24', 'Prueba24', 'Prueba24@example.com', '$2y$10$fIBaSXRfzqw4f2oahSTp1eCh66KalQYE9inC71KHiGbSZ1rN5Bq3a', 'A', 2, '2020-05-31 18:06:00', '2020-07-13 12:31:10'),
	(23, '25', 'Prueba25', 'Prueba25@example.com', '$2y$10$erTS8qmixVRSMJYrWlhDzOyM0D4D6GDHGP7Q70qJSAFSEDleWX6ha', 'A', 2, '2020-05-31 18:06:14', '2020-07-13 12:31:10'),
	(24, '30', 'Prueba30', 'Prueba30@example.com', '$2y$10$0701kLIhqhzszQpzjtuWT.YvxGKAT5B714W0rayEobInbxekUYGtC', 'A', 2, '2020-05-31 18:14:54', '2020-07-13 12:31:10'),
	(25, '31', 'Prueba31', 'Prueba31@example.com', '$2y$10$mmzkXQ2uQiZ.kGYNT/hGu.mbpjizza9E8YDZZi9U7nXIG0M2Mbak.', 'A', 2, '2020-05-31 18:15:06', '2020-07-13 12:31:11'),
	(26, '32', 'Prueba32', 'Prueba32@example.com', '$2y$10$Sdlly4Kf44Ps97z97lDf.O0/cE0rPwWOg1THKTiS6Qm.HGMsDIKLK', 'A', 2, '2020-05-31 18:15:21', '2020-07-13 12:31:12'),
	(27, '33', 'Prueba33', 'Prueba33@example.com', '$2y$10$IN8EH6e4ycCZKSvEfvdsgeLkbKp6esuuUmP2wH9GFjBQbLqTaps4u', 'A', 2, '2020-05-31 18:15:36', '2020-07-13 12:31:11'),
	(28, '34', 'Prueba34', 'Prueba34@example.com', '$2y$10$HgeW1O4flstFPNG0HBPnkeStje7mNri5p4Jkm7RytfLPo15JdeDMC', 'A', 2, '2020-05-31 18:15:55', '2020-07-13 12:31:12'),
	(29, '35', 'Prueba35', 'Prueba35@example.com', '$2y$10$rKYNaEqoyRe6GahXRotADeyeysuDckODPbtZMk8oPnqSuCrN/PxlC', 'I', 2, '2020-05-31 18:16:08', '2020-07-13 12:31:14'),
	(30, '1111', 'bad', 'bad@dsds.com', '$2y$10$TEFw1aXwoQMd4fLtdM8.oOLVzVKzPwa4MhbUhlHB1gQKkahhY71ii', 'A', 2, '2020-07-13 12:03:51', '2020-07-13 12:31:13'),
	(31, '23232', 'bad', 'bad@example.com', '$2y$10$i.rwOLzBq72tC/VzFKufY.uvaU.sHY1VRwBSHTdO6/D3zbxyY1vs2', 'A', 2, '2020-07-13 12:04:06', '2020-07-13 12:31:14'),
	(32, '322', 'bad', 'bad2@example.com', '$2y$10$sQN2b54aJe8iH1dt/wy7gezJdBWMvE1lZg.eoE7RCJQbZp5rx7wyu', 'A', 2, '2020-07-13 12:04:18', '2020-07-13 12:31:15'),
	(33, '323', 'bad', 'bad@dsd.com', '$2y$10$eu8STigwZDEWwhNTBN5qN.40sBV6Y3QJljcBTpD2IYRRn6YrXp6Ny', 'A', 2, '2020-07-13 12:05:04', '2020-07-13 12:31:15'),
	(34, '11111', 'bad', 'bad@ecm.com', '$2y$10$1XxDxin3kcjdprQjzUzave/ftK3g6b94n9xJnCfCUG4Fmz0bAaKHy', 'A', 2, '2020-07-13 12:08:21', '2020-07-13 12:31:15'),
	(35, '110011', 'prueba rol', 'rol@example.com', '$2y$10$rLincGaxKobxseubIPMbm..GQ9Nba5rYt7J963deVeVo8n0wVm2Dy', 'A', 2, '2020-07-13 12:58:33', '2020-07-13 12:58:33'),
	(36, '0987', 'prueba', 'prueba@example.com', '$2y$10$ejy4GJqvNaMNg5MMTIP1eeT9F/gmQjdthIKG3n7gV9sfUOhTkrG7u', 'A', 2, '2020-07-31 09:57:19', '2020-07-31 09:57:19');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
