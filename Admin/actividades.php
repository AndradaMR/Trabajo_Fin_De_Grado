<?php
$paginaActiva = "actividades";
$tituloPagina = "Actividades";
$etiquetaPagina = "Control de contenido";
$cssExtra = [
    "../css/admin-styles/actividades.css",
    "../css/admin-styles/empresas-aprobadas.css"
];

require_once("head-admin.php");

if(isset($_GET["cancelar"])){
    $idServicio = (int) $_GET["cancelar"];
    $bdadmin->CancelarActividadAdmin($idServicio);

    header("Location: actividades.php");
    exit();
}

if(isset($_GET["activar"])){
    $idServicio = (int) $_GET["activar"];
    $bdadmin->ActivarActividadAdmin($idServicio);

    header("Location: actividades.php");
    exit();
}

$actividades = $bdadmin->ObtenerTodasActividades();
$totalActividades = count($actividades);
?>

<main class="admin-content">

  <section class="activities-header-card">
    <div>
      <span class="admin-section-tag">Gestión</span>
      <h3>Actividades publicadas en la plataforma</h3>
      <p>
        Supervisa las actividades registradas por las empresas, revisa su estado y gestiona su visibilidad.
      </p>
    </div>

    <div class="activities-summary">
      <span class="activities-summary-number"><?= $totalActividades ?></span>
      <span class="activities-summary-label">Actividades</span>
    </div>
  </section>

  <section class="activities-filters-card">
    <div class="activities-search">
      <label for="buscar-actividad" class="sr-only">Buscar actividad</label>
      <input type="text" id="buscar-actividad" placeholder="Buscar actividad, empresa o ciudad">
    </div>

    <div class="activities-filters">
      <select>
        <option value="">Todas las categorías</option>
        <option value="deporte">Deporte</option>
        <option value="bienestar">Bienestar</option>
      </select>

      <select>
        <option value="">Todos los estados</option>
        <option value="activa">Activa</option>
        <option value="revision">En revisión</option>
        <option value="oculta">Oculta</option>
      </select>
    </div>
  </section>

  <section class="approved-list">

    <?php if(count($actividades) > 0): ?>

      <?php foreach($actividades as $actividad): ?>

        <?php
          $estado = $actividad["estado"] ?? "activo";

          if($estado == "activo"){
              $claseEstado = "approved";
              $textoEstado = "Activa";
          }else{
              $claseEstado = "blocked";
              $textoEstado = "Cancelada";
          }

          $imagen = $actividad["imagen"];

          if($imagen == "" || $imagen == null){
              $imagen = "../assets/placeholder.jpg";
          }
        ?>

        <article class="approved-company-card">
          <div class="approved-company-main">
            <div class="approved-company-header">

              <img 
                src="<?= htmlspecialchars($imagen) ?>" 
                alt="<?= htmlspecialchars($actividad["nombre_servicio"]) ?>" 
                class="approved-company-logo"
              >

              <div class="approved-company-title-block">
                <p class="approved-company-category">
                  <?= htmlspecialchars($actividad["categoria_padre"] ?? "") ?>
                  <?= $actividad["subcategoria"] ? " · " . htmlspecialchars($actividad["subcategoria"]) : "" ?>
                </p>

                <h3><?= htmlspecialchars($actividad["nombre_servicio"]) ?></h3>

                <p class="approved-company-location">
                  <?= htmlspecialchars($actividad["nombre_empresa"]) ?>
                </p>
              </div>

              <span class="admin-status-chip <?= $claseEstado ?>">
                <?= $textoEstado ?>
              </span>
            </div>

            <p class="approved-company-description">
              <?= nl2br(htmlspecialchars($actividad["descripcion"])) ?>
            </p>

            <div class="approved-company-grid">
              <div class="approved-info-item">
                <span class="info-label">Lugar</span>
                <span class="info-value"><?= htmlspecialchars($actividad["lugar"]) ?></span>
              </div>

              <div class="approved-info-item">
                <span class="info-label">Precio</span>
                <span class="info-value"><?= htmlspecialchars($actividad["precio"]) ?> €</span>
              </div>

              <div class="approved-info-item">
                <span class="info-label">Duración</span>
                <span class="info-value"><?= htmlspecialchars($actividad["duracion"]) ?></span>
              </div>

              <div class="approved-info-item">
                <span class="info-label">Reservas</span>
                <span class="info-value"><?= $actividad["total_reservas"] ?></span>
              </div>
            </div>
          </div>

          <div class="approved-company-actions">
            <a href="../publico/actividad.php?idact=<?= $actividad["id_servicio"] ?>" class="btn-detail">
              Ver actividad
            </a>

            <?php if($estado == "activo"): ?>
              <a href="actividades.php?cancelar=<?= $actividad["id_servicio"] ?>" 
                 class="btn-reject"
                 onclick="return confirm('¿Cancelar esta actividad?');">
                Cancelar
              </a>
            <?php else: ?>
              <a href="actividades.php?activar=<?= $actividad["id_servicio"] ?>" 
                 class="btn-approve"
                 onclick="return confirm('¿Reactivar esta actividad?');">
                Reactivar
              </a>
            <?php endif; ?>
          </div>
        </article>

      <?php endforeach; ?>

    <?php else: ?>

      <article class="approved-company-card">
        <div class="approved-company-main">
          <h3>No hay actividades publicadas</h3>
          <p class="approved-company-description">
            Todavía no hay actividades registradas en la plataforma.
          </p>
        </div>
      </article>

    <?php endif; ?>

  </section>

</main>

</div>
</div>

</body>
</html>