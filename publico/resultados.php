<?php
$titulo="<h1>Bienvenido a Body and Soul</h1>";
require_once("head.php");

//Comprobamos los parametros que nos han llegado
$buscador = trim($_GET["buscador"] ?? "");
$categoria = trim($_GET["categoria"] ?? "");
$subcategoria = trim($_GET["subcategoria"] ?? "");
$precio = trim($_GET["precio"] ?? "");


$resultados = $bdact->filtrarActividades($buscador, $categoria, $subcategoria, $precio);
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
                <img src="img/yoga1.jpg" alt="<?= htmlspecialchars($act["nombre_servicio"]) ?>" class="activity-image">
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