<?php

require_once("utils/mailer.php");

$datosReserva = [
    "actividad" => "Clase de Yoga Relax",
    "fecha" => "25/05/2026",
    "hora" => "18:00",
    "duracion" => "1 hora",
    "ubicacion" => "Madrid",
    "empresa" => "Zen Studio",
    "telefono" => "600123123"
];

$resultado = enviarCorreoReserva(
    "cristinagonzalez22daw@gmail.com",
    "Cristina",
    $datosReserva
);

if($resultado){

    echo "Correo enviado correctamente";

}else{

    echo "Error al enviar correo";

}