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

$categorias = $bdadmin->ObtenerCategoriasFiltroAdmin();
$categoriaSeleccionada = $_GET["categoria"] ?? "";

$ciudades = $bdadmin->ObtenerCiudadesEmpresasPendientes();
$ciudadSeleccionada = $_GET["ciudad"] ?? "";

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
      <label for="buscar-empresa-pendiente" class="sr-only">Buscar empresa</label>
      <input type="text" id="buscar-empresa-pendiente" placeholder="Buscar empresa, ciudad o email">
    </div>

    <div class="pending-filters">
      <select id="filtro-categoria-pendiente">
        <option value="">Todas las categorías</option>
        <?php foreach($categorias as $cat){ ?>
            <option value="<?= $cat["id_categoria"] ?>"
                <?= ($categoriaSeleccionada == $cat["id_categoria"]) ? "selected" : "" ?>>
                <?= htmlspecialchars($cat["nombre"]) ?>
            </option>
        <?php } ?>
      </select>

      <select id="filtro-ciudad-pendiente">
        <option value="">Todas las ciudades</option>
        <?php foreach($ciudades as $ciudad){ ?>
            <option value="<?= htmlspecialchars($ciudad["ciudad_empresa"]) ?>"
                <?= ($ciudadSeleccionada == $ciudad["ciudad_empresa"]) ? "selected" : "" ?>>
                <?= htmlspecialchars($ciudad["ciudad_empresa"]) ?>
            </option>
        <?php } ?>
      </select>
    </div>
  </section>

  <section class="pending-list" id="lista-empresas-pendientes">

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

<script>
  const buscadorPendiente = document.getElementById("buscar-empresa-pendiente");
  const filtroCategoriaPendiente = document.getElementById("filtro-categoria-pendiente");
  const filtroCiudadPendiente = document.getElementById("filtro-ciudad-pendiente");
  const listaPendientes = document.getElementById("lista-empresas-pendientes");

  let temporizadorPendiente = null;

  function cargarEmpresasPendientes(){
      const buscar = buscadorPendiente.value;
      const categoria = filtroCategoriaPendiente.value;
      const ciudad = filtroCiudadPendiente.value;

      const url = "ajax-empresas-pendientes.php?buscar=" + encodeURIComponent(buscar) +
                  "&categoria=" + encodeURIComponent(categoria) +
                  "&ciudad=" + encodeURIComponent(ciudad);

      fetch(url)
          .then(response => response.text())
          .then(data => {
              listaPendientes.innerHTML = data;
          });
  }

  buscadorPendiente.addEventListener("input", function(){
      clearTimeout(temporizadorPendiente);

      temporizadorPendiente = setTimeout(function(){
          cargarEmpresasPendientes();
      }, 300);
  });

  filtroCategoriaPendiente.addEventListener("change", cargarEmpresasPendientes);
  filtroCiudadPendiente.addEventListener("change", cargarEmpresasPendientes);
</script>

</body>
</html>