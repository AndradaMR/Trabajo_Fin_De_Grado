<?php
require_once("head.php");
require_once("../bd/bdempresa.php");

if(!isset($_SESSION["empresa"])){
    header("Location: login.php");
    exit();
}

$idEmpresa = $_SESSION["empresa"];

$empresa = $bdempre->sacardatosempresa($idEmpresa);

if($empresa["estado"] == "suspendida"){
?>
<div class="company-main">

  <header class="company-topbar">
    <div class="company-topbar-left">
      <span class="company-page-tag">Empresa suspendida</span>
      <h2>Añadir nueva actividad</h2>
    </div>
  </header>

  <main class="company-content">
    <section class="company-form-hero">
      <div>
        <h3>No puedes publicar nuevas actividades</h3>
        <p>
          Tu empresa está suspendida temporalmente. Mientras el estado siga suspendido,
          no podrás crear nuevas actividades ni volver a activar servicios cancelados.
        </p>
      </div>
    </section>

    <div class="booking-alert booking-alert-error">
      <p>
        Si necesitas resolver esta situación, contacta con administración.
      </p>
    </div>
  </main>

</div>

</body>
</html>
<?php
    exit();
}
?>

$idCategoriaPadre=$bdact->ObtenerIdCategoriaPorNombre($empresa["categoria_empresa"]);

//obtener todas las subcategorias de la categoria de la empresa
$subcat=$bdact->obtenerSubcat($idCategoriaPadre);

$registro_ok = false;
$banderaerror = false;

$nombre_servicio = "";
$nombreservicioerror = "";

$id_categoria = "";
$categoriaerror = "";

$horas = "";
$minutos = "";
$duracion = "";
$duracionerror = "";

$direccion_lugar = "";
$direccionlugarerror = "";

$localidad_lugar = "";
$localidadlugarerror = "";

$nombre_lugar = "";
$lugar = "";

$precio = "";
$precioerror = "";

$descripcion = "";
$descripcionerror = "";

$materiales = "";
$materialeserror = "";

$imagen = "";
$imagenerror = "";

if(isset($_POST["nombre_servicio"])){
    $nombre_servicio = trim($_POST["nombre_servicio"]);

    if($nombre_servicio == ""){
        $nombreservicioerror = "El nombre de la actividad no puede estar vacío";
        $banderaerror = true;
    }else{
        // 🔥 VALIDACIÓN DE DUPLICADO (aquí es donde va bien)
        if($bdempre->ExisteServicioEmpresa($idEmpresa, $nombre_servicio)){
            $nombreservicioerror = "Ya tienes una actividad con ese nombre";
            $banderaerror = true;
        }
    }
}

if(isset($_POST["id_categoria"])){
    $id_categoria = (trim($_POST["id_categoria"]));

    if($id_categoria == ""){
        $categoriaerror = "Debes seleccionar una subcategoría";
        $banderaerror = true;
    }
}

if(isset($_POST["horas"])){
    $horas = trim($_POST["horas"]);
}

if(isset($_POST["minutos"])){
    $minutos = trim($_POST["minutos"]);
}

if(isset($_POST["enviar"])){

    $horasNumero = (int)$horas;
    $minutosNumero = (int)$minutos;

    if($horas === "" && $minutos === ""){
        $duracionerror = "Debes indicar la duración";
        $banderaerror = true;

    }else if($horasNumero < 0 || $minutosNumero < 0){
        $duracionerror = "La duración no puede ser negativa";
        $banderaerror = true;

    }else if($minutosNumero > 55){
        $duracionerror = "Los minutos deben estar entre 0 y 55";
        $banderaerror = true;

    }else if($minutosNumero % 5 != 0){
        $duracionerror = "Los minutos deben ir de 5 en 5";
        $banderaerror = true;

    }else if($horasNumero == 0 && $minutosNumero == 0){
        $duracionerror = "La duración debe ser mayor que 0";
        $banderaerror = true;

    }else{

        if($horasNumero > 0 && $minutosNumero > 0){

            if($horasNumero == 1){
                $textoHoras = "1 hora";
            }else{
                $textoHoras = $horasNumero . " horas";
            }

            if($minutosNumero == 1){
                $textoMinutos = "1 minuto";
            }else{
                $textoMinutos = $minutosNumero . " minutos";
            }

            $duracion = $textoHoras . " y " . $textoMinutos;

        }else if($horasNumero > 0){

            if($horasNumero == 1){
                $duracion = "1 hora";
            }else{
                $duracion = $horasNumero . " horas";
            }

        }else{

            if($minutosNumero == 1){
                $duracion = "1 minuto";
            }else{
                $duracion = $minutosNumero . " minutos";
            }
        }
    }
}

if(isset($_POST["direccion_lugar"])){
    $direccion_lugar = trim($_POST["direccion_lugar"]);

    if($direccion_lugar == ""){
        $direccionlugarerror = "Debes indicar la calle y número";
        $banderaerror = true;

    }else if(!preg_match('/\d/', $direccion_lugar)){
        $direccionlugarerror = "La dirección debe incluir un número";
        $banderaerror = true;
    }
}

if(isset($_POST["localidad_lugar"])){
    $localidad_lugar = trim($_POST["localidad_lugar"]);

    if($localidad_lugar == ""){
        $localidadlugarerror = "Debes indicar la localidad";
        $banderaerror = true;
    }
}

if(isset($_POST["nombre_lugar"])){
    $nombre_lugar = trim($_POST["nombre_lugar"]);
}

if($direccion_lugar != "" && $localidad_lugar != ""){

    if($nombre_lugar != ""){
        $lugar = $nombre_lugar . ", " . $direccion_lugar . ", " . $localidad_lugar;
    }else{
        $lugar = $direccion_lugar . ", " . $localidad_lugar;
    }
}


if(isset($_POST["precio"])){
    $precio = trim($_POST["precio"]);

    if($precio == ""){
        $precioerror = "El precio no puede estar vacío";
        $banderaerror = true;
    }else if($precio < 0){
        $precioerror = "El precio no puede ser negativo";
        $banderaerror = true;
    }
}

if(isset($_POST["descripcion"])){
    $descripcion = trim($_POST["descripcion"]);

    if($descripcion == ""){
        $descripcionerror = "La descripción no puede estar vacía";
        $banderaerror = true;
    }else if(strlen($descripcion) > 400){
    $descripcionerror = "La descripción es demasiado larga";
    $banderaerror = true;
  }
  
}

if(isset($_POST["materiales"])){
    $materiales = trim($_POST["materiales"]);

    if(strlen($materiales) > 200){
        $materialeserror = "Los materiales no pueden superar los 200 caracteres";
        $banderaerror = true;
    }
}


if(isset($_POST["enviar"])){

    if(!isset($_FILES["imagen"]) || $_FILES["imagen"]["error"] == 4){
        $imagenerror = "Debes subir una imagen principal";
        $banderaerror = true;
    }else{
        $tiposPermitidos = ["image/jpeg", "image/png", "image/webp"];
        $tipoArchivo = $_FILES["imagen"]["type"];

        if(!in_array($tipoArchivo, $tiposPermitidos)){
            $imagenerror = "La imagen debe ser JPG, PNG o WEBP";
            $banderaerror = true;
        }
    }
}

    if($banderaerror == false && isset($_POST["enviar"])){

    $nombreArchivo = $_FILES["imagen"]["name"];
    $ruta = "../img/".$empresa["categoria_empresa"]."/" . $nombreArchivo;

    move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta);

    $idServicio = $bdempre->InsertarServicio(
    $idEmpresa,
    $nombre_servicio,
    $descripcion,
    $lugar,
    $id_categoria,
    $precio,
    $duracion,
    $materiales
    );

    $bdempre->InsertarImagenServicio($idServicio, $ruta);

    $registro_ok = true;

    header("Location: gestionar-horarios.php?idservicio=".$idServicio);
    exit();
}
?>

<div class="company-main">

  <header class="company-topbar">
    <div class="company-topbar-left">
      <span class="company-page-tag">Publicación</span>
      <h2>Añadir nueva actividad</h2>
    </div>

    <div class="company-topbar-right">
      <a href="mis-servicios.php" class="company-back-link">Ver mis servicios</a>
    </div>
  </header>

  <main class="company-content">

    <section class="company-form-hero">
      <div>
        <h3>Información general de la actividad</h3>
        <p>
          Completa los datos principales de la actividad. Después podrás añadir fechas,
          horarios y plazas disponibles.
        </p>
      </div>
    </section>

    <?php if($registro_ok == true){ ?>
      <div class="booking-alert booking-alert-ok">
        <p>La actividad se ha guardado correctamente.</p>
      </div>
    <?php } ?>

    <section class="company-form-card">
      <form action="" method="post" enctype="multipart/form-data" class="company-service-form">

  <div class="form-grid">

    <!-- NOMBRE -->
    <div class="form-group">
      <label for="nombre_servicio">Nombre</label>
      <input 
        type="text" 
        id="nombre_servicio" 
        name="nombre_servicio" 
        placeholder="Ej. Yoga Flow Sunset"
        value="<?php echo $nombre_servicio; ?>"
      >
      <span class="form-error"><?php echo $nombreservicioerror; ?></span>
    </div>

    <!-- SUBCATEGORÍA -->
    <div class="form-group">
      <label for="id_categoria">Subcategoría</label>
      <select id="id_categoria" name="id_categoria">
        <option value="">Selecciona una subcategoría</option>

        <?php foreach($subcat as $subcategoria){ ?>
          <option 
            value="<?php echo $subcategoria["id_categoria"]; ?>"
            <?php if($id_categoria == $subcategoria["id_categoria"]){ echo "selected"; } ?>
          >
            <?php echo $subcategoria["nombre"]; ?>
          </option>
        <?php } ?>

      </select>
      <span class="form-error"><?php echo $categoriaerror; ?></span>
    </div>

    <!-- DURACIÓN -->
    <div class="form-group">
      <label>Duración</label>

      <div class="duration-inputs">

        <input 
          type="number" 
          id="horas" 
          name="horas" 
          min="0"
          placeholder="Horas (ej. 2)"
          value="<?php echo $horas; ?>"
        >

        <select id="minutos" name="minutos">
          <option value="0" <?php if($minutos == "0"){ echo "selected"; } ?>>0 min</option>
          <option value="5" <?php if($minutos == "5"){ echo "selected"; } ?>>5 min</option>
          <option value="10" <?php if($minutos == "10"){ echo "selected"; } ?>>10 min</option>
          <option value="15" <?php if($minutos == "15"){ echo "selected"; } ?>>15 min</option>
          <option value="20" <?php if($minutos == "20"){ echo "selected"; } ?>>20 min</option>
          <option value="25" <?php if($minutos == "25"){ echo "selected"; } ?>>25 min</option>
          <option value="30" <?php if($minutos == "30"){ echo "selected"; } ?>>30 min</option>
          <option value="35" <?php if($minutos == "35"){ echo "selected"; } ?>>35 min</option>
          <option value="40" <?php if($minutos == "40"){ echo "selected"; } ?>>40 min</option>
          <option value="45" <?php if($minutos == "45"){ echo "selected"; } ?>>45 min</option>
          <option value="50" <?php if($minutos == "50"){ echo "selected"; } ?>>50 min</option>
          <option value="55" <?php if($minutos == "55"){ echo "selected"; } ?>>55 min</option>
        </select>

      </div>

      <span class="form-error"><?php echo $duracionerror; ?></span>
    </div>

    <!-- PRECIO -->
    <div class="form-group">
      <label for="precio">Precio (€)</label>
      <input 
        type="number" 
        id="precio" 
        name="precio" 
        placeholder="Ej. 18.50" 
        min="0" 
        step="0.01"
        value="<?php echo $precio; ?>"
      >
      <span class="form-error"><?php echo $precioerror; ?></span>
    </div>

    <!-- DIRECCIÓN -->
    <div class="form-group">
      <label for="direccion_lugar">Dirección</label>
      <input 
        type="text" 
        id="direccion_lugar" 
        name="direccion_lugar" 
        placeholder="Ej. Calle Alcalá, 25"
        value="<?php echo $direccion_lugar; ?>"
      >
      <span class="form-error"><?php echo $direccionlugarerror; ?></span>
    </div>

    <!-- LOCALIDAD -->
    <div class="form-group">
      <label for="localidad_lugar">Localidad</label>
      <input 
        type="text" 
        id="localidad_lugar" 
        name="localidad_lugar" 
        placeholder="Ej. Madrid"
        value="<?php echo $localidad_lugar; ?>"
      >
      <span class="form-error"><?php echo $localidadlugarerror; ?></span>
    </div>

    <!-- NOMBRE LUGAR -->
    <div class="form-group full-width">
      <label for="nombre_lugar">
        Nombre del lugar <span class="optional-label">(opcional)</span>
      </label>
      <input 
        type="text" 
        id="nombre_lugar" 
        name="nombre_lugar" 
        placeholder="Ej. Indoor Pádel Center"
        value="<?php echo $nombre_lugar; ?>"
      >
    </div>

    <!-- DESCRIPCIÓN -->
    <div class="form-group full-width">
      <label for="descripcion">Descripción</label>
      <textarea 
  id="descripcion" 
  name="descripcion" 
  rows="5" 
  maxlength="400"
  placeholder="Describe la actividad con detalle..."
      ><?php echo $descripcion; ?></textarea>
        <small class="form-hint">
          Máximo 400 caracteres
        </small>

        <small id="contadorDescripcion" class="form-counter">
          0 / 400
        </small>

      <span class="form-error"><?php echo $descripcionerror; ?></span>
    </div>

    <!-- MATERIALES -->
    <div class="form-group full-width">
  <label for="materiales">Materiales empleados</label>

  <textarea 
    id="materiales" 
    name="materiales" 
    rows="3" 
    maxlength="200"
    placeholder="Ej. Esterilla, bloques, cinta elástica..."
  ><?php echo $materiales; ?></textarea>

  <small class="form-hint">
    Máximo 200 caracteres
  </small>

  <small id="contadorMateriales" class="form-counter">
    0 / 200
  </small>

  <span class="form-error"><?php echo $materialeserror; ?></span>
</div>

    <!-- IMAGEN -->
    <div class="form-group full-width">
      <label for="imagen">Imagen principal</label>
      <input 
        type="file" 
        id="imagen" 
        name="imagen" 
        accept="image/*"
      >
      <span class="form-error"><?php echo $imagenerror; ?></span>
    </div>

  </div>

  <div class="form-actions">
    <button type="submit" name="enviar" class="btn-primary-company">
      Guardar actividad
    </button>
  </div>

</form>
    </section>

  </main>
</div>

</body>
</html>