<?php

$paginaActiva = "empresas-aprobadas";
$tituloPagina = "Empresas aprobadas";
$etiquetaPagina = "Empresas activas";
$cssExtra = [
    "../css/admin-styles/empresas-aprobadas.css"
];

require_once("head-admin.php");

$empresas = $bdadmin->ObtenerEmpresasAprobadas();
$totalEmpresas = count($empresas);
?>

<main class="admin-content">

  <section class="approved-header-card">
    <div>
      <span class="admin-section-tag">Gestión</span>
      <h3>Empresas activas en la plataforma</h3>
      <p>
        Consulta las empresas aprobadas, revisa sus actividades y gestiona su estado dentro del sistema.
      </p>
    </div>

    <div class="approved-summary">
      <span class="approved-summary-number"><?= $totalEmpresas ?></span>
      <span class="approved-summary-label">Aprobadas</span>
    </div>
  </section>

  <section class="approved-filters-card">
    <div class="approved-search">
      <label for="buscar-aprobada" class="sr-only">Buscar empresa</label>
      <input type="text" id="buscar-aprobada" placeholder="Buscar empresa, ciudad o email">
    </div>

    <div class="approved-filters">
      <select>
        <option value="">Todas las categorías</option>
        <option value="deporte">Deporte</option>
        <option value="bienestar">Bienestar</option>
      </select>

      <select>
        <option value="">Todos los estados</option>
        <option value="activa">Activa</option>
        <option value="bloqueada">Bloqueada</option>
      </select>
    </div>
  </section>

  <section class="approved-list">

    <?php if(count($empresas) > 0): ?>

      <?php foreach($empresas as $empresa): ?>

        <article class="approved-company-card">
          <div class="approved-company-main">
            <div class="approved-company-header">

              <img 
                src="<?= htmlspecialchars($empresa["logo_empresa"] ?? "../assets/placeholder.jpg") ?>" 
                alt="<?= htmlspecialchars($empresa["nombre_empresa"]) ?>" 
                class="approved-company-logo"
              >

              <div class="approved-company-title-block">
                <p class="approved-company-category">
                  <?= ucfirst(htmlspecialchars($empresa["categoria_empresa"] ?? "Sin categoría")) ?>
                </p>

                <h3><?= htmlspecialchars($empresa["nombre_empresa"]) ?></h3>

                <p class="approved-company-location">
                  <?= htmlspecialchars($empresa["ciudad_empresa"] ?? "Sin ciudad") ?>
                </p>
              </div>

              <span class="admin-status-chip approved">Activa</span>
            </div>

            <p class="approved-company-description">
              <?= nl2br(htmlspecialchars($empresa["descripcion_empresa"] ?? "")) ?>
            </p>

            <div class="approved-company-grid">
              <div class="approved-info-item">
                <span class="info-label">Actividades</span>
                <span class="info-value"><?= $empresa["total_servicios"] ?></span>
              </div>

              <div class="approved-info-item">
                <span class="info-label">Ciudad</span>
                <span class="info-value">
                  <?= htmlspecialchars($empresa["ciudad_empresa"] ?? "Sin ciudad") ?>
                </span>
              </div>

              <div class="approved-info-item">
                <span class="info-label">Email</span>
                <span class="info-value">
                  <?= htmlspecialchars($empresa["email"]) ?>
                </span>
              </div>

              <div class="approved-info-item">
                <span class="info-label">Teléfono</span>
                <span class="info-value">
                  <?= htmlspecialchars($empresa["telefono"] ?? "No indicado") ?>
                </span>
              </div>
            </div>
          </div>

          <div class="approved-company-actions">
            <a href="detalle-empresa-aprobada.php?id=<?= $empresa["id_empresa"] ?>" class="btn-detail">
              Ver empresa
            </a>

            <a href="servicios-empresa.php?id=<?= $empresa["id_empresa"] ?>" class="btn-secondary-admin">
              Ver actividades
            </a>
          </div>
        </article>

      <?php endforeach; ?>

    <?php else: ?>

      <article class="approved-company-card">
        <div class="approved-company-main">
          <h3>No hay empresas aprobadas</h3>
          <p class="approved-company-description">
            Todavía no hay empresas activas en la plataforma.
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