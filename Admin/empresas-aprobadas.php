<?php

$paginaActiva = "empresas-aprobadas";
$tituloPagina = "Empresas aprobadas";
$etiquetaPagina = "Empresas activas";
$cssExtra = [
    "../css/admin-styles/empresas-aprobadas.css"
];

require_once("head-admin.php");

if(isset($_GET["suspender"])){
    $idEmpresa = (int) $_GET["suspender"];
    $bdadmin->SuspenderEmpresa($idEmpresa);

    header("Location: empresas-aprobadas.php");
    exit();
}

if(isset($_GET["activar"])){
    $idEmpresa = (int) $_GET["activar"];
    $bdadmin->ActivarEmpresa($idEmpresa);

    header("Location: empresas-aprobadas.php");
    exit();
}

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
      <select id="filtro-categoria-empresa">
        <option value="">Todas las categorías</option>
        <option value="deporte">Deporte</option>
        <option value="bienestar">Bienestar</option>
      </select>

      <select id="filtro-estado-empresa">
        <option value="">Todos los estados</option>
        <option value="activa">Activa</option>
        <option value="suspendida">Suspendida</option>
      </select>
    </div>
  </section>

  <section class="approved-list" id="lista-empresas-aprobadas">

    <?php if(count($empresas) > 0): ?>

      <?php foreach($empresas as $empresa): ?>
        <?php
        $estado = $empresa["estado"] ?? "activa";

        if($estado == "activa"){
            $claseEstado = "approved";
            $textoEstado = "Activa";
        }else{
            $claseEstado = "blocked";
            $textoEstado = "Suspendida";
        }
        ?>
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

              <span class="admin-status-chip <?= $claseEstado ?>">
                  <?= $textoEstado ?>
              </span>
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
            <?php if($estado == "activa"): ?>
              <a href="empresas-aprobadas.php?suspender=<?= $empresa["id_empresa"] ?>" 
                class="btn-warning"
                onclick="return confirm('¿Suspender esta empresa? También se cancelarán sus actividades.');">
                  Suspender
              </a>

          <?php else: ?>

              <a href="empresas-aprobadas.php?activar=<?= $empresa["id_empresa"] ?>" 
                class="btn-approve"
                onclick="return confirm('¿Reactivar esta empresa?');">
                  Reactivar
              </a>

          <?php endif; ?>
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

<script>
  const buscadorEmpresa = document.getElementById("buscar-aprobada");
  const filtroCategoriaEmpresa = document.getElementById("filtro-categoria-empresa");
  const filtroEstadoEmpresa = document.getElementById("filtro-estado-empresa");
  const listaEmpresasAprobadas = document.getElementById("lista-empresas-aprobadas");

  let temporizadorEmpresa = null;

  function cargarEmpresasAprobadas(){
      const buscar = buscadorEmpresa.value;
      const categoria = filtroCategoriaEmpresa.value;
      const estado = filtroEstadoEmpresa.value;

      const url = "ajax-empresas-aprobadas.php?buscar=" + encodeURIComponent(buscar) +
                  "&categoria=" + encodeURIComponent(categoria) +
                  "&estado=" + encodeURIComponent(estado);

      fetch(url)
          .then(response => response.text())
          .then(data => {
              listaEmpresasAprobadas.innerHTML = data;
          });
  }

  buscadorEmpresa.addEventListener("input", function(){
      clearTimeout(temporizadorEmpresa);

      temporizadorEmpresa = setTimeout(function(){
          cargarEmpresasAprobadas();
      }, 300);
  });

  filtroCategoriaEmpresa.addEventListener("change", cargarEmpresasAprobadas);
  filtroEstadoEmpresa.addEventListener("change", cargarEmpresasAprobadas);
</script>

</body>
</html>