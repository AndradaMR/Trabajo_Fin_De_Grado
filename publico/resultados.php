<?php
$titulo="<h1>Bienvenido a Body and Soul</h1>";
require_once("head.php");

//Comprobamos los parametros que nos han llegado
$buscador = trim($_GET["buscador"] ?? "");
$categoria = trim($_GET["categoria"] ?? "");
$subcategoria = trim($_GET["subcategoria"] ?? "");
$precio = trim($_GET["precio"] ?? "");


$rutaJson = "../JSON/actividades.json";
$datos = json_decode(file_get_contents($rutaJson), true);

$resultados = [];

foreach ($datos as $empresa) {
    foreach ($empresa["servicios"] as $servicio) {

        $coincide = true;

        if ($buscador !== "") {
            $texto = strtolower(
                $servicio["nombre_servicio"] . " " .
                $servicio["descripcion"] . " " .
                $servicio["lugar"]
            );

            if (strpos($texto, strtolower($buscador)) === false) {
                $coincide = false;
            }
        }

        if ($categoria !== "" && $servicio["categoria"] !== $categoria) {
            $coincide = false;
        }

        if ($subcategoria !== "" && $servicio["id_categoria"] != $subcategoria) {
            $coincide = false;
        }

        if ($precio !== "") {
            $precioServicio = (float)$servicio["precio"];

            if ($precio === "gratis" && $precioServicio > 0) {
                $coincide = false;
            }

            if ($precio === "menos20" && $precioServicio >= 20) {
                $coincide = false;
            }

            if ($precio === "20a50" && ($precioServicio < 20 || $precioServicio > 50)) {
                $coincide = false;
            }

            if ($precio === "mas50" && $precioServicio <= 50) {
                $coincide = false;
            }
        }

        if ($coincide) {
            $resultados[] = $servicio;
        }
    }
}

?>

<main>
  <section class="featured-section">
    <div class="container">
      <div class="section-header">
        <span class="section-tag">Resultados</span>
        <h2>Actividades encontradas</h2>
        <p>Hemos encontrado <?= count($resultados) ?> actividades.</p>
      </div>

      <div class="activities-grid">
        <?php if (!empty($resultados)) { ?>
          <?php foreach ($resultados as $act) { ?>
            <article class="activity-card">
              <div class="activity-image-wrapper">
                <?php
                $imagen = !empty($act["imagenes"][0])
                    ? "../" . $act["imagenes"][0]
                    : "../img/default.jpg";
                ?>

                <img src="<?= htmlspecialchars($imagen) ?>" alt="<?= htmlspecialchars($act["nombre_servicio"]) ?>" class="activity-image">
              </div>

              <div class="activity-content">
                <h3><?= htmlspecialchars($act["nombre_servicio"]) ?></h3>
                <p><?= htmlspecialchars($act["descripcion"]) ?></p>
                <p><strong>Lugar:</strong> <?= htmlspecialchars($act["lugar"]) ?></p>
                <p><strong>Precio:</strong> <?= htmlspecialchars($act["precio"]) ?> €</p>
                <a href="actividad.php?idact=<?= $act["id_servicio"] ?>" class="btn btn-primary btn-full">Ir a la actividad</a>
              </div>
            </article>
          <?php } ?>
        <?php } else { ?>
          <p>No se han encontrado actividades con esos filtros.</p>
        <?php } ?>
      </div>
    </div>
  </section>
</main>

<?php require_once("footer.php"); ?>
</body>
</html>