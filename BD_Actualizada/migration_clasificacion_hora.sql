-- Ejecutar una vez en la base de datos `sgh` (phpMyAdmin o cliente MySQL).
-- Agrega la clasificación laboral (Ordinaria / Extra / Doble) a cada registro de horas.

USE sgh;

ALTER TABLE registro_horas
ADD COLUMN clasificacion_hora ENUM('Ordinaria','Extra','Doble') NOT NULL DEFAULT 'Ordinaria'
AFTER id_categoria_hora;

DROP PROCEDURE IF EXISTS sgh_RegistrarHoras;
DELIMITER ;;
CREATE PROCEDURE sgh_RegistrarHoras(
    IN p_idUsuario INT,
    IN p_idCliente INT,
    IN p_idCategoriaHora INT,
    IN p_clasificacionHora VARCHAR(20),
    IN p_cantidad INT,
    IN p_descripcion VARCHAR(255),
    IN p_fecha DATE
)
BEGIN
    INSERT INTO registro_horas(id_usuario, id_cliente, id_categoria_hora, clasificacion_hora, cantidad, descripcion, fecha)
    VALUES (p_idUsuario, p_idCliente, p_idCategoriaHora, p_clasificacionHora, p_cantidad, p_descripcion, p_fecha);

    SELECT 1 AS resultado, 'Horas registradas correctamente' AS mensaje;
END ;;
DELIMITER ;

DROP PROCEDURE IF EXISTS sgh_EditarHoras;
DELIMITER ;;
CREATE PROCEDURE sgh_EditarHoras(
    IN p_idRegistro INT,
    IN p_idCliente INT,
    IN p_idCategoriaHora INT,
    IN p_clasificacionHora VARCHAR(20),
    IN p_cantidad INT,
    IN p_descripcion VARCHAR(255),
    IN p_fecha DATE
)
BEGIN
    UPDATE registro_horas
    SET id_cliente = p_idCliente,
        id_categoria_hora = p_idCategoriaHora,
        clasificacion_hora = p_clasificacionHora,
        cantidad = p_cantidad,
        descripcion = p_descripcion,
        fecha = p_fecha
    WHERE id_registro = p_idRegistro;

    SELECT 1 AS resultado, 'Horas actualizadas correctamente' AS mensaje;
END ;;
DELIMITER ;

DROP PROCEDURE IF EXISTS sgh_ListarHorasPorUsuario;
DELIMITER ;;
CREATE PROCEDURE sgh_ListarHorasPorUsuario(
    IN p_idUsuario INT,
    IN p_inicio INT,
    IN p_registrosPorPagina INT
)
BEGIN
    SELECT rh.id_registro,
           c.nombre AS cliente,
           cat.nombre AS categoria,
           rh.clasificacion_hora,
           rh.cantidad,
           rh.descripcion,
           rh.fecha
    FROM registro_horas rh
    INNER JOIN cliente c ON rh.id_cliente = c.id_cliente
    INNER JOIN categoria_hora cat ON rh.id_categoria_hora = cat.id_categoria_hora
    WHERE rh.id_usuario = p_idUsuario
    ORDER BY rh.fecha DESC
    LIMIT p_inicio, p_registrosPorPagina;
END ;;
DELIMITER ;

DROP PROCEDURE IF EXISTS sgh_ObtenerHoraPorId;
DELIMITER ;;
CREATE PROCEDURE sgh_ObtenerHoraPorId(IN p_idRegistro INT)
BEGIN
    SELECT rh.id_registro,
           rh.id_cliente,
           rh.id_categoria_hora,
           rh.clasificacion_hora,
           rh.cantidad,
           rh.descripcion,
           rh.fecha
    FROM registro_horas rh
    WHERE rh.id_registro = p_idRegistro;
END ;;
DELIMITER ;
