<?php
session_start();

require_once("../bd/bd.php");
$bbdd= new db("localhost",3306,"plataforma_servicios","root","");

require_once("../bd/bdact.php");
$bdact= new bdact("localhost",3306,"plataforma_servicios","root","");

//require_once("bdreservas/bd.php");
//$bbdd= new dbreservas("localhost",3306,"pruebatfg","root","");

if(isset($_SESSION["usuario"])){

  $usuario=$bbdd->ObtenerUsuario($_SESSION["usuario"]);

  $nombre=$usuario["nombre"];
   $apellido=$usuario["apellido"];
  $inicial=strtoupper($nombre[0]);

  $iniciosesion="<div class=contenedorinicio><a href='perfil.php' aria-label='Perfil de usuario'>
  <span class='profile-avatar'>".$inicial."</span>
  <span class='profile-name'>".$nombre." ".$apellido."</span>
</a></div>";

}else{

  $iniciosesion="<a href='login.php' class='btn btn-outline'>Iniciar sesión</a>";

}

if(isset($_GET["cerrar"])){
  // borrar todas las variables de sesión
  $_SESSION = [];

  // destruir la sesión
  session_destroy();

  // redirigir al inicio
  header("Location: index.php");
  exit();
}

$categorias = $bdact->obtenerCategoriasPadre();

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Body and Soul | Inicio</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Overpass:wght@300;400;500;600;700&family=Sansita+Swashed:wght@700;800;900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="../css/styles.css" />
  <link rel="stylesheet" href="../css/public-styles/index.css" />
  <link rel="stylesheet" href="../css/public-styles/login.css">
  <link rel="stylesheet" href="../css/public-styles/perfil.css">
   <link rel="stylesheet" href="../css/public-styles/categoria.css">
   <link rel="stylesheet" href="../css/public-styles/actividad.css">
  
<script>

  document.addEventListener("DOMContentLoaded", function () {
    
    document.getElementById("categoria").addEventListener("change", function() {

    let categoria = this.value;
    if (categoria !== "") {
        window.location.href = "categoria.php?cat="+encodeURIComponent(categoria);
        this.selected;
    }
    
});

});

</script>
</head>

<body>
<header class="main-header">
  <div class="container header-container">

    <div class="header-left">
      <a href="index.php">
        <img src="../img/logo.PNG" class="logo" alt="Body and Soul">
      </a>


    </div>

    <div class="header-title">
      <?=$titulo?>
    </div>
    <div class="header-right">
      <?=$iniciosesion?>
    </div>
  </div>

</header>

  <div class="categories-bar">
  <div class="container categories-bar-inner">
    <div class="categories-box">
      <label for="categoria" class="categories-label">Explora por categorías</label>

      <select id="categoria" name="id_categoria" class="categories-select">
        <option value="">Categorías</option>
        <?php foreach ($categorias as $categoria){ ?>
          <option value="<?= $categoria["nombre"]; ?>">
            <?= htmlspecialchars($categoria["nombre"]); ?>
          </option>
        <?php } ?>
      </select>
    </div>
  </div>
</div>