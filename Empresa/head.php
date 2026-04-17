<?php

require_once("../bd/bdact.php");
$bdact= new bdact("localhost",3306,"plataforma_servicios","root","");

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Body and Soul | Panel empresa</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Overpass:wght@300;400;500;600;700&family=Sansita:wght@700;800;900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="../css/empresa-styles/empresa-index.css">
    <link rel="stylesheet" href="../css/empresa-styles/perfil-empresa.css">
   <link rel="stylesheet" href="../css/styles.css">
</head>
<body class="company-body">

  <div class="company-layout">

    <!-- SIDEBAR -->
    <aside class="company-sidebar">
      <div class="company-sidebar-top">
        <img src="../assets/logo-body-and-soul.png" alt="Logo Body and Soul" class="company-sidebar-logo">
        <h1>Empresa</h1>
      </div>

      <nav class="company-sidebar-nav">
        <a href="index.php" class="company-nav-link active">Inicio</a>
        <a href="mis-servicios.php" class="company-nav-link">Mis servicios</a>
        <a href="nueva-actividad.php" class="company-nav-link">Añadir servicio</a>
        <a href="reservas.php" class="company-nav-link">Reservas</a>
        <a href="perfil-empresa.php" class="company-nav-link">Perfil</a>
        <a href="logout.php" class="company-nav-link company-nav-link-logout">Cerrar sesión</a>
      </nav>
    </aside>


