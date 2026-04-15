<?php
require_once("../bd/bdempresa.php");
$bdempre = new bdempresa("localhost",3306,"plataforma_servicios","root","");

// SI PULSAN APROBAR
if(isset($_GET["aprobar"])){
    $idSolicitud = (int) $_GET["aprobar"];
    $bdempre->AprobarEmpresa($idSolicitud);

    header("Location: empresas-pendientes.php");
    exit();
}
// SI PULSAN RECHAZAR
if(isset($_GET["rechazar"])){
    $idSolicitud = (int) $_GET["rechazar"];
    $bdempre->RechazarEmpresa($idSolicitud);

    header("Location: empresas-pendientes.php");
    exit();
}

if(!isset($_GET["id"])){
    echo "Empresa no encontrada";
    exit();
}

$idSolicitud = (int) $_GET["id"];
$empresa = $bdempre->ObtenerSolicitudEmpresaPorId($idSolicitud);

if($empresa == false){
    echo "Solicitud no encontrada";
    exit();
}


?>


<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Detalle empresa | Body and Soul</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Overpass:wght@300;400;500;600;700&family=Sansita:wght@700;800;900&display=swap" rel="stylesheet">

<link rel="stylesheet" href="../css/admin-styles/admin-dashboard.css">
<link rel="stylesheet" href="../css/admin-styles/admin-detalle-empresa.css">

</head>

<body class="admin-dashboard-body">

<div class="admin-layout">

<!-- SIDEBAR -->

<aside class="admin-sidebar">

<div class="admin-sidebar-top">
<img src="../img/logo.PNG" class="admin-sidebar-logo">
<h1>Admin</h1>
</div>

<nav class="admin-sidebar-nav">

        <a href="dashboard.html" class="admin-nav-link">Dashboard</a>
        <a href="empresas-pendientes.html" class="admin-nav-link">Empresas pendientes</a>
        <a href="empresas-aprobadas.html" class="admin-nav-link">Empresas aprobadas</a>
        <a href="actividades.html" class="admin-nav-link">Actividades</a>
        <a href="usuarios.html" class="admin-nav-link active">Usuarios</a>
        <a href="reportes.html" class="admin-nav-link">Reportes</a>
        <a href="Crear-categoria.html" class="admin-nav-link admin-nav-link-logout">Crear categoría</a>
        <a href="../logout.php" class="admin-nav-link admin-logout">Cerrar sesión</a>

</nav>

</aside>

<!-- MAIN -->

<div class="admin-main">

<header class="admin-topbar">

<div class="admin-topbar-left">
<span class="admin-page-tag">Revisión empresa</span>
<h2>Detalle de empresa</h2>
</div>

</header>

<main class="admin-content">

<section class="empresa-detalle-card">

<div class="empresa-detalle-header">
<img src="<?=htmlspecialchars($empresa["logo_empresa"])?>" class="empresa-logo" alt="Logo empresa">

<div>
<span class="empresa-categoria"><?=ucfirst(htmlspecialchars($empresa["categoria_empresa"]))?></span>
<h2><?=htmlspecialchars($empresa["nombre"])?></h2>
<p class="empresa-ciudad"><?=htmlspecialchars($empresa["ciudad_empresa"])?></p>
</div>

</div>

<p class="empresa-descripcion">
<?=nl2br(htmlspecialchars($empresa["datos"]))?>
</p>

<div class="empresa-info-grid">

<div class="empresa-info-item">
<span class="info-label">Email</span>
<span class="info-value"><?=htmlspecialchars($empresa["email"])?></span>
</div>

<div class="empresa-info-item">
<span class="info-label">Teléfono</span>
<span class="info-value"><?=htmlspecialchars($empresa["telefono"])?></span>
</div>

<div class="empresa-info-item">
<span class="info-label">Dirección</span>
<span class="info-value"><?=htmlspecialchars($empresa["direccion"])?></span>
</div>

<div class="empresa-info-item">
<span class="info-label">Fecha solicitud</span>
<span class="info-value"><?=htmlspecialchars($empresa["fecha"])?></span>
</div>

</div>

</section>

<section class="empresa-actividades-preview">

<!--QUITAR? NO PUEDE PEDIR ACTIVIDADES HASTA UE ACPETE EMPRESA-->
<h3>Actividades que quiere publicar</h3>

<div class="actividades-grid">

<article class="actividad-preview-card">

<img src="../assets/yoga.jpg">

<h4>Yoga Flow</h4>

<p>Clase dinámica de yoga centrada en respiración y movilidad.</p>

</article>

<article class="actividad-preview-card">

<img src="../assets/meditacion.jpg">

<h4>Meditación guiada</h4>

<p>Sesión para reducir estrés y mejorar concentración.</p>

</article>

</div>

</section>

<div class="empresa-acciones">

<a href="?id=<?=$empresa["id_solicitud"]?>&aprobar=<?=$empresa["id_solicitud"]?>" 
   class="btn-approve"
   onclick="return confirm('¿Aprobar esta empresa?');">
   Aprobar empresa
</a>

<a href="?id=<?=$empresa["id_solicitud"]?>&rechazar=<?=$empresa["id_solicitud"]?>" 
   class="btn-reject"
   onclick="return confirm('¿Rechazar esta empresa?');">
   Rechazar empresa
</a>

</div>

</main>

</div>

</div>

</body>
</html>