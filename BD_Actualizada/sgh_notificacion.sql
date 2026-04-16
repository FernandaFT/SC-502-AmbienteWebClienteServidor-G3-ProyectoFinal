-- Estructura de la tabla para notificaciones
CREATE TABLE IF NOT EXISTS `notificacion` (
  `id_notificacion` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario_destino` int(11) NOT NULL COMMENT 'Quién recibe la notificación (Empleado o Administrador)',
  `id_usuario_origen` int(11) NOT NULL COMMENT 'Quién generó la acción (genera la notificación)',
  `descripcion` varchar(500) NOT NULL COMMENT 'Breve descripción de lo que se notifica',
  `leida` bit(1) DEFAULT b'0' COMMENT 'Marca si la notificación fue leída (interacción)',
  `fecha_creacion` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de creación automática',
  PRIMARY KEY (`id_notificacion`),
  KEY `fk_usuario_destino` (`id_usuario_destino`),
  KEY `fk_usuario_origen` (`id_usuario_origen`),
  CONSTRAINT `fk_notificacion_destino` FOREIGN KEY (`id_usuario_destino`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE,
  CONSTRAINT `fk_notificacion_origen` FOREIGN KEY (`id_usuario_origen`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=1;
