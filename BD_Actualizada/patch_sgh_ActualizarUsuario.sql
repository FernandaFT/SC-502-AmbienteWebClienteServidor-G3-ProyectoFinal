DELIMITER ;;
DROP PROCEDURE IF EXISTS `sgh_ActualizarUsuario` ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sgh_ActualizarUsuario`(
    pId INT,
    pIdentificacion VARCHAR(15),
    pNombre VARCHAR(200),
    pRol INT
)
BEGIN
    IF EXISTS (
        SELECT 1 FROM usuario
        WHERE identificacion = pIdentificacion AND id_usuario <> pId
    ) THEN
        SELECT 0 AS resultado, 'err_ident' AS codigo;
    ELSE
        UPDATE usuario
        SET identificacion = pIdentificacion,
            nombre = pNombre,
            rol = pRol
        WHERE id_usuario = pId;

        SELECT 1 AS resultado, 'ok' AS codigo;
    END IF;
END ;;
DELIMITER ;
