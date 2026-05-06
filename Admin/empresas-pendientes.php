<?php

$paginaActiva = "empresas-pendientes";
$tituloPagina = "Empresas pendientes";
$etiquetaPagina = "Gestión de empresas";
$cssExtra = [
    "../css/admin-styles/empresas-pendientes.css"
];

require_once("head-admin.php");

$solicitudes = $bdadmin->ObtenerSolicitudesPendientes();
$totalPendientes = count($solicitudes);
?>

<main class="admin-content">

  <section class="pending-header-card">
    <div>
      <span class="admin-section-tag">Validación</span>
      <h3>Solicitudes recibidas</h3>
      <p>
        Revisa las empresas registradas y decide si cumplen los requisitos para formar parte de la plataforma.
      </p>
    </div>

    <div class="pending-summary">
      <span class="pending-summary-number"><?= $totalPendientes ?></span>
      <span class="pending-summary-label">Pendientes</span>
    </div>
  </section>

  <section class="pending-filters-card">
    <div class="pending-search">
      <label for="buscar-empresa" class="sr-only">Buscar empresa</label>
      <input type="text" id="buscar-empresa" placeholder="Buscar empresa, ciudad o email">
    </div>

    <div class="pending-filters">
      <select>
        <option value="">Todas las categorías</option>
        <option value="deporte">Deporte</option>
        <option value="bienestar">Bienestar</option>
      </select>

      <select>
        <option value="">Todas las ciudades</option>
        <option value="madrid">Madrid</option>
        <option value="pozuelo">Pozuelo</option>
        <option value="alcobendas">Alcobendas</option>
      </select>
    </div>
  </section>

  <section class="pending-list">

    <?php if(count($solicitudes) > 0): ?>

      <?php foreach($solicitudes as $solicitud): ?>

        <article class="pending-company-card">

          <div class="pending-company-main">

            <div class="pending-company-top">
              <div>
                <p class="pending-company-category">
                  <?= ucfirst(htmlspecialchars($solicitud["categoria_empresa"] ?? "Sin categoría")) ?>
                </p>

                <h3>
                  <?= htmlspecialchars($solicitud["nombre"]) ?>
                </h3>
              </div>

              <span class="admin-status-chip pending">
                Pendiente
              </span>
            </div>

            <p class="pending-company-description">
              <?= nl2br(htmlspecialchars($solicitud["datos"] ?? "")) ?>
            </p>

            <div class="pending-company-grid">

              <div class="pending-info-item">
                <span class="info-label">Fecha de solicitud</span>
                <span class="info-value">
                  <?= date("d/m/Y", strtotime($solicitud["fecha"])) ?>
                </span>
              </div>

              <div class="pending-info-item">
                <span class="info-label">Ubicación</span>
                <span class="info-value">
                  <?= htmlspecialchars($solicitud["ciudad_empresa"] ?? "Sin ciudad") ?>
                </span>
              </div>

              <div class="pending-info-item">
                <span class="info-label">Email</span>
                <span class="info-value">
                  <?= htmlspecialchars($solicitud["email"]) ?>
                </span>
              </div>

              <div class="pending-info-item">
                <span class="info-label">Teléfono</span>
                <span class="info-value">
                  <?= htmlspecialchars($solicitud["telefono"] ?? "No indicado") ?>
                </span>
              </div>

            </div>
          </div>

          <div class="pending-company-actions">

            <a href="detalle-empresa.php?id=<?= $solicitud["id_solicitud"] ?>" class="btn-detail">
              Ver detalle
            </a>

            <a href="detalle-empresa.php?id=<?= $solicitud["id_solicitud"] ?>&aprobar=<?= $solicitud["id_solicitud"] ?>" 
               class="btn-approve"
               onclick="return confirm('¿Aprobar esta empresa?');">
              Aprobar
            </a>

            <a href="detalle-empresa.php?id=<?= $solicitud["id_solicitud"] ?>&rechazar=<?= $solicitud["id_solicitud"] ?>" 
               class="btn-reject"
               onclick="return confirm('¿Rechazar esta empresa?');">
              Rechazar
            </a>

          </div>

        </article>

      <?php endforeach; ?>

    <?php else: ?>

      <article class="pending-company-card">
        <div class="pending-company-main">
          <h3>No hay empresas pendientes</h3>

          <p class="pending-company-description">
            Actualmente no existen solicitudes de empresa pendientes de revisión.
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