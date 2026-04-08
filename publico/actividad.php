<?php
$titulo="<h1>Bienvenido a Body and Soul</h1>";
require_once("head.php");

if (!isset($_GET['idact'])) {
  echo $_GET['idact'];
    echo "Actividad no encontrada";
    exit;
}else{
  $id = (int) $_GET['idact'];
}

$rutaJson = "../JSON/actividades.json";
//VERIFICO QUE EXISTA EN ARCHIVO
if (!file_exists($rutaJson)) {
    echo "No se encuentra el archivo JSON";
    exit;
}
$contenidoJson = file_get_contents($rutaJson);
$datos = json_decode($contenidoJson, true);

if (!$datos) {
    echo "Error al cargar los datos";
    exit;
}

$actividad = null;
$empresaActividad = null;
//CARGO LOS DATOS DE LA ACTIVIDAD CONCRETA
foreach ($datos as $empresa) {
    if (isset($empresa['servicios']) && is_array($empresa['servicios'])) {
        foreach ($empresa['servicios'] as $servicio) {
            if (isset($servicio['id_actividad']) && $servicio['id_actividad'] == $id) {
                $actividad = $servicio;
                $empresaActividad = $empresa['nombre_empresa'];
                break 2;
            }
        }
    }
}

if (!$actividad) {
    echo "Actividad no encontrada";
    exit;
}

?>

  <main class="activity-page">
    <section class="activity-section">
      <div class="container">

        <div class="activity-breadcrumb">
          <a href="categoria.php?cat=<?=$actividad['categoria']?>"><?=$actividad['categoria']?></a>
          <span>/</span>
          <a href="#"><?=$actividad['subcategoria']?></a>
        </div>

        <div class="activity-layout">

          <!-- GALERÍA -->
          <article class="activity-gallery-card">
            <div class="activity-gallery-header">
              <span class="section-tag">Experiencia destacada</span>
            </div>

            <div class="activity-gallery">
              <button class="gallery-btn gallery-btn-left" type="button" aria-label="Imagen anterior">
                &#10094;
              </button>

              <div class="activity-image-wrapper">
                <img
                  src="<?=$actividad['imagenes'][0]?>"
                  alt="<?=$actividad['nombre_servicio']?>"
                  class="activity-main-image"
                >
              </div>

              <button class="gallery-btn gallery-btn-right" type="button" aria-label="Imagen siguiente">
                &#10095;
              </button>
            </div>
          </article>

          <!-- INFORMACIÓN -->
          <article class="activity-info-card">
            <div class="activity-info-header">
              <h2><?=$actividad['nombre_servicio']?></h2>
            </div>

            <div class="activity-info-content">
              <div class="info-block">
                <h3>Descripción</h3>
                <p><?=$actividad['descripcion']?></p>
              </div>

              <div class="info-grid">
                <div class="info-item">
                  <h3>Duración</h3>
                  <p><?=$actividad['duracion']?></p>
                </div>

                <div class="info-item">
                  <h3>Ubicación</h3>
                  <p><?=$actividad['lugar']?></p>
                </div>

                <div class="info-item info-item-full">
                  <h3>Materiales necesarios</h3>
                  <p><?=$actividad['materiales']?></p>
                </div>
              </div>

              <a href="reserva.php?id=<?= $id ?>" class="btn btn-primary btn-full reserve-btn">
                Reservar actividad
              </a>
            </div>
          </article>

        </div>
      </div>
    </section>
  </main>


 <?php
require_once("footer.php");
?>

</body>
</html>