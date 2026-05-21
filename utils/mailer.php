<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once(__DIR__ . "/../libs/PHPMailer/Exception.php");
require_once(__DIR__ . "/../libs/PHPMailer/PHPMailer.php");
require_once(__DIR__ . "/../libs/PHPMailer/SMTP.php");

function enviarCorreoReserva($destinatario, $nombreUsuario, $datosReserva){

    $mail = new PHPMailer(true);

    try{

        // CONFIG SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp-relay.brevo.com';
        $mail->SMTPAuth   = true;

        // DATOS SMTP
        $mail->Username   = 'ac225b001@smtp-brevo.com';
        $mail->Password   = '';

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // REMITENTE
        $mail->setFrom('trabajofindegrado2026@gmail.com', 'Body & Soul');

        // DESTINATARIO
        $mail->addAddress($destinatario, $nombreUsuario);

        // EMAIL HTML
        $mail->isHTML(true);

        $mail->Subject = 'Reserva confirmada - Body & Soul';

        $mail->Body = "

        <div style='font-family: Arial; max-width:600px; margin:auto; padding:20px;'>

            <h1 style='color:#1B4965;'>Reserva confirmada</h1>

            <p>Hola <strong>{$nombreUsuario}</strong>,</p>

            <p>Tu reserva se ha realizado correctamente.</p>

            <div style='background:#f5f5f5; padding:20px; border-radius:10px;'>

                <h2>{$datosReserva["actividad"]}</h2>

                <p><strong>Fecha:</strong> {$datosReserva["fecha"]}</p>

                <p><strong>Hora:</strong> {$datosReserva["hora"]}</p>

                <p><strong>Duración:</strong> {$datosReserva["duracion"]}</p>

                <p><strong>Ubicación:</strong> {$datosReserva["ubicacion"]}</p>

                <p><strong>Empresa:</strong> {$datosReserva["empresa"]}</p>

                <p><strong>Teléfono:</strong> {$datosReserva["telefono"]}</p>

            </div>

            <p style='margin-top:20px;'>
                Gracias por confiar en Body & Soul 💚
            </p>

        </div>

        ";

        $mail->send();

        return true;

    }catch(Exception $e){

        return false;

    }

}

function enviarCorreoCancelacion($destinatario, $nombreUsuario, $datosReserva){

    $mail = new PHPMailer(true);

    try{

        $mail->isSMTP();
        $mail->Host       = 'smtp-relay.brevo.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'ac225b001@smtp-brevo.com';
        $mail->Password   = '';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('trabajofindegrado2026@gmail.com', 'Body & Soul');
        $mail->addAddress($destinatario, $nombreUsuario);

        $mail->isHTML(true);
        $mail->Subject = 'Reserva cancelada - Body & Soul';

        $mail->Body = "
        <div style='font-family: Arial; max-width:600px; margin:auto; padding:20px;'>
            <h1 style='color:#cc4c66;'>Reserva cancelada</h1>

            <p>Hola <strong>{$nombreUsuario}</strong>,</p>

            <p>Te informamos de que tu reserva ha sido cancelada.</p>

            <div style='background:#f5f5f5; padding:20px; border-radius:10px;'>
                <h2>{$datosReserva["actividad"]}</h2>

                <p><strong>Fecha:</strong> {$datosReserva["fecha"]}</p>
                <p><strong>Hora:</strong> {$datosReserva["hora"]}</p>
                <p><strong>Duración:</strong> {$datosReserva["duracion"]}</p>
                <p><strong>Ubicación:</strong> {$datosReserva["ubicacion"]}</p>
                <p><strong>Empresa:</strong> {$datosReserva["empresa"]}</p>
                <p><strong>Teléfono:</strong> {$datosReserva["telefono"]}</p>
            </div>

            <p style='margin-top:20px;'>
                Puedes consultar otras actividades disponibles en Body & Soul.
            </p>
        </div>
        ";

        $mail->send();
        return true;

    }catch(Exception $e){
      return false;
    }
} 