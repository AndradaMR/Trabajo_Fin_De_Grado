<?php
session_start();

require_once("../bd/bd.php");
$bbdd = new db("localhost",3306,"plataforma_servicios","root","");

require_once("../bd/bdact.php");
$bdact = new bdact("localhost",3306,"plataforma_servicios","root","");

if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}

if (!isset($_POST["id_servicio"]) || !isset($_POST["id_detalle_actividad"])) {
    echo "Faltan datos para realizar la reserva";
    exit;
}

$idUsuario = (int) $_SESSION["usuario"];
$idServicio = (int) $_POST["id_servicio"];
$idDetalle = (int) $_POST["id_detalle_actividad"];

// Obtener datos de la franja elegida
$franja = $bdact->obtenerDetalleActividadPorId($idDetalle);

if (!$franja) {
    header("Location: reserva.php?idact=".$idServicio."&error=franja");
    exit;
}

if ((int)$franja["id_servicio"] !== $idServicio) {
    header("Location: reserva.php?idact=".$idServicio."&error=franja_invalida");
    exit;
}

$ocupadas = $bdact->contarReservasConfirmadasPorDetalle($idDetalle);

if ($ocupadas >= (int)$franja["plazas_maximas"]) {
    header("Location: reserva.php?idact=".$idServicio."&error=sinplazas");
    exit;
}

$yaReservada = $bdact->usuarioYaReservoEsaFranja($idUsuario, $idDetalle);

if ($yaReservada) {
    header("Location: reserva.php?idact=".$idServicio."&error=duplicada");
    exit;
}

$fechaHora = $franja["fecha"] . " " . $franja["hora_inicio"];

$reservaOk = $bdact->crearReserva($idUsuario, $idServicio, $fechaHora, $idDetalle);

if ($reservaOk) {
    header("Location: reserva.php?idact=".$idServicio."&ok=1");
    exit;
} else {
    header("Location: reserva.php?idact=".$idServicio."&error=bd");
    exit;
}

// Crear la reserva
$fechaHora = $franja["fecha"] . " " . $franja["hora_inicio"];

$reservaOk = $bdact->crearReserva($idUsuario, $idServicio, $fechaHora, $idDetalle);

if ($reservaOk) {
    header("Location: perfil.php?reserva=ok");
    exit;
} else {
    echo "No se pudo realizar la reserva";
}
?>