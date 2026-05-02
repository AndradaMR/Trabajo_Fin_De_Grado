<?php

session_start();

if(!isset($_SESSION["usuario"])){
    header("Location: login.php");
    exit();
}

require_once("../bd/bdact.php");
$bdact = new bdact("localhost", 3306, "plataforma_servicios1", "root", "");

if(!isset($_GET["idservicio"])){
    header("Location: index.php");
    exit();
}

$idUsuario = $_SESSION["usuario"];
$idServicio = (int) $_GET["idservicio"];

if($bdact->esFavorito($idUsuario, $idServicio)){
    $bdact->eliminarFavorito($idUsuario, $idServicio);
}else{
    $bdact->agregarFavorito($idUsuario, $idServicio);
}


if(isset($_GET["volver"])){
    header("Location: " . $_GET["volver"]);
}else{
    header("Location: index.php");
}
exit();