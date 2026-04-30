<?php
$rutaJson = "../JSON/actividades.json";

if (!file_exists($rutaJson)) {
    echo "<p>No se encuentra el archivo JSON.</p>";
    exit;
}

$contenidoJson = file_get_contents($rutaJson);
$datos = json_decode($contenidoJson, true);

if (!$datos) {
    echo "<p>Error al cargar los datos.</p>";
    exit;
}

$buscador = trim($_GET["buscador"] ?? "");
$categoria = $_GET["categoria"] ?? "";
$precio = $_GET["precio"] ?? "";
$fecha = $_GET["fecha"] ?? "";
$resultados = [];

foreach ($datos as $empresa) {
    if (!isset($empresa["servicios"]) || !is_array($empresa["servicios"])) {
        continue;
    }

    foreach ($empresa["servicios"] as $servicio) {

        $texto = strtolower(
            $servicio["nombre_servicio"] . " " .
            $servicio["descripcion"] . " " .
            $servicio["lugar"] . " " .
            $servicio["categoria"] . " " .
            $servicio["subcategoria"]
        );

        $coincide = true;

        if ($buscador !== "" && strpos($texto, strtolower($buscador)) === false) {
            $coincide = false;
        }

        if ($categoria !== "" && $servicio["categoria"] !== $categoria) {
            $coincide = false;
        }

        if ($precio !== "") {
            $precioServicio = (float)$servicio["precio"];

            if ($precio == "0-10" && ($precioServicio < 0 || $precioServicio > 10)) {
                $coincide = false;
            }

            if ($precio == "10-25" && ($precioServicio < 10 || $precioServicio > 25)) {
                $coincide = false;
            }

            if ($precio == "25-50" && ($precioServicio < 25 || $precioServicio > 50)) {
                $coincide = false;
            }

            if ($precio == "50+" && $precioServicio <= 50) {
                $coincide = false;
            }
        }

        if ($coincide) {
            $resultados[] = $servicio;
        }
    }
}

if (empty($resultados)) {
    echo "<p>No se han encontrado actividades.</p>";
    exit;
}
?>

<div class="activities-grid live-results-grid">
  <?php foreach ($resultados as $act) { ?>
    <article class="activity-card">
      <div class="activity-image-wrapper">
        <?php
        $imagen = !empty($act["imagenes"][0]) ? "../" . $act["imagenes"][0] : "../assets/placeholder.jpg";
        ?>

        <img src="<?= htmlspecialchars($imagen) ?>" alt="<?= htmlspecialchars($act["nombre_servicio"]) ?>" class="activity-image">
      </div>

      <div class="activity-content">
        <div class="activity-rating" aria-label="Puntuación 4,8 de 5">
          <span class="stars">★★★★★</span>
          <span class="rating-value">4.8</span>
        </div>

        <h3><?= htmlspecialchars($act["nombre_servicio"]) ?></h3>

        <p>
          <?= htmlspecialchars($act["descripcion"]) ?>
        </p>

        <a href="actividad.php?idact=<?= $act["id_servicio"] ?>" class="btn btn-primary btn-full" aria-label="Ver actividad <?= htmlspecialchars($act["nombre_servicio"]) ?>">
          Ver actividad
        </a>
      </div>
    </article>
  <?php } ?>
</div>