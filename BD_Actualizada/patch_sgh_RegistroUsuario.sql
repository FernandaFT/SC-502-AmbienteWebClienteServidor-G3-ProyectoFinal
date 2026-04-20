DELIMITER ;;
DROP PROCEDURE IF EXISTS `sgh_RegistroUsuario` ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sgh_RegistroUsuario`(
    pIdentificacion VARCHAR(50),
    pNombre VARCHAR(200),
    pCorreo VARCHAR(150),
    pContrasenna VARCHAR(255),
    pRol INT
)
BEGIN
    DECLARE idUsuarioN INT;

    IF EXISTS (SELECT 1 FROM usuario WHERE identificacion = pIdentificacion) THEN
        SELECT 0 AS resultado, 'err_ident' AS codigo;
    ELSEIF EXISTS (SELECT 1 FROM usuario WHERE correo = pCorreo) THEN
        SELECT 0 AS resultado, 'err_correo' AS codigo;
    ELSE
        INSERT INTO usuario(identificacion, nombre, correo, contrasenna, estado, rol)
        VALUES(pIdentificacion, pNombre, pCorreo, pContrasenna, b'1', pRol);

        SELECT LAST_INSERT_ID() INTO idUsuarioN;

        INSERT INTO vacaciones(id_usuario, dias_acumulados, dias_usados, fecha_ultimo_calculo)
        VALUES(idUsuarioN, 0, 0, CURDATE());

        SELECT 1 AS resultado, 'ok' AS codigo;
    END IF;
END ;;
DELIMITER ;
