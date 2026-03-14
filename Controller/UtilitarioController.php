<?php

function GenerarContrasenna()
{
    $letras = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $longitud = 8;
    $contrasena = '';

    for ($i = 0; $i < $longitud; $i++) {
        $indice = rand(0, strlen($letras) - 1);
        $contrasena .= $letras[$indice];
    }

    return $contrasena;
}

function EnviarCorreo($asunto, $contenido, $destinatario)
{
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    $correoSalida = "@ufide.ac.cr"; //Añadir el correo de fide
    $contrasennaSalida = ""; // su contraseña

    $mail = new PHPMailer();
    $mail->CharSet = 'UTF-8';

    $mail->IsSMTP();
    $mail->IsHTML(true);
    $mail->Host = 'smtp.office365.com';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->Username = $correoSalida;
    $mail->Password = $contrasennaSalida;

    $mail->SetFrom($correoSalida);
    $mail->Subject = $asunto;
    $mail->MsgHTML($contenido);
    $mail->AddAddress($destinatario);

    try {
        if ($mail->send()) {
            return true; // Envío exitoso
        } else {
            return false; // Falló el envío
        }
    } catch (Exception $e) {
        return false;
    }
}