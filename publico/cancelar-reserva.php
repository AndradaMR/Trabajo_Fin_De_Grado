<?php
require_once("../bd/bdact.php");
session_start();

$bdact = new bdact("localhost", 3306, "plataforma_servicios1", "root", "");

if(!isset($_SESSION["usuario"])){
    header("Location: index.php");
    exit();
}

if(!isset($_GET["idreserva"])){
    echo "Reserva no válida";
    exit();
}

$idReserva = (int) $_GET["idreserva"];
$idUsuario = $_SESSION["usuario"];

$reserva = $bdact->ObtenerReservaUsuarioPorId($idUsuario, $idReserva);

if($reserva == false){
    echo "Reserva no encontrada";
    exit();
}

$esPasada = strtotime($reserva['fecha_hora']) < time();
$menos24h = strtotime($reserva['fecha_hora']) <= strtotime('+24 hours') && !$esPasada;

if($esPasada || $menos24h){
    header("Location: perfil.php?error=no_cancelable");
    exit();
}

$bdact->CancelarReserva($idUsuario, $idReserva);

header("Location: perfil.php");
exit();