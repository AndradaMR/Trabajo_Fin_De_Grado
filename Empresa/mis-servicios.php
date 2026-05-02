<?php
require_once("head.php");
require_once("../bd/bdempresa.php");

if(!isset($_SESSION["empresa"])){
    header("Location: login.php");
    exit();
}

$idEmpresa = $_SESSION["empresa"];

$servicios = $bdempre->ObtenerServiciosEmpresa($idEmpresa);
$totalServicios = count($servicios);

if(isset($_POST["cancelar"])){

    $idServicio = (int) $_POST["id_servicio"];

    $bdempre->CancelarServicioEmpresa($idServicio, $idEmpresa);

    header("Location: mis-servicios.php");
    exit();
}


?>


    <div class="company-main">

      <header class="company-topbar">
        <div class="company-topbar-left">
          <span class="company-page-tag">Gestión de servicios</span>
          <h2>Mis servicios</h2>
        </div>

        <div class="company-topbar-right">
          <a href="nueva-actividad.html" class="company-add-btn">+ Añadir servicio</a>
        </div>
      </header>

      <main class="company-content">

        <section class="services-header-card">
          <div>
            <span class="company-section-badge">Publicación</span>
            <h3>Servicios publicados por tu empresa</h3>
            <p>
              Consulta, organiza y edita los servicios que has creado en la plataforma.
            </p>
          </div>

          <div class="services-summary">
            <span class="services-summary-number"><?=$totalServicios?></span>
            <span class="services-summary-label">Servicios</span>
          </div>
        </section>

        <section class="services-filters-card">
          <div class="services-search">
            <label for="buscar-servicio" class="sr-only">Buscar servicio</label>
            <input type="text" id="buscar-servicio" placeholder="Buscar por nombre, categoría o ubicación">
          </div>

          <div class="services-filters">
            <select>
              <option value="">Todas las categorías</option>
              <option value="bienestar">Bienestar</option>
              <option value="deporte">Deporte</option>
            </select>

            <select>
              <option value="">Todos los estados</option>
              <option value="activo">Activo</option>
              <option value="borrador">Borrador</option>
            </select>
          </div>
        </section>

        <section class="services-list">

          <?php if(empty($servicios)){ ?>

        <p>No tienes servicios publicados todavía.</p>

      <?php }else{ ?>

        <?php foreach($servicios as $servicio){ 
          
          $imagen =$servicio["imagen"];

        ?>

          <article class="service-company-card">
            <div class="service-company-image">
              <img src="../<?=$imagen?>" alt="<?=htmlspecialchars($servicio["nombre_servicio"])?>">
            </div>

            <div class="service-company-main">
              <div class="service-company-top">
                <div>
                  <p class="service-company-category"> <?=ucfirst($servicio["categoria_padre"])?> · <?=ucfirst($servicio["subcategoria"])?></p>
                  <h3><?=htmlspecialchars($servicio["nombre_servicio"])?></h3>

                  <p class="service-company-location"><?=$servicio["lugar"]?></p>
                </div>

              </div>

              <p class="service-company-description">
                <?=$servicio["descripcion"]?>
              </p>

              <div class="service-company-grid">
                <div class="service-info-item">
                  <span class="info-label">Precio</span>
                  <span class="info-value"><?=$servicio["precio"]?> €</span>
                </div>

                <div class="service-info-item">
                  <span class="info-label">Estado</span>
                  <span class="info-value"><?=$servicio["estado"]?></span>
                </div>

              </div>
            </div>

            <div class="service-company-actions">
              <a href="../publico/actividad.php?idact=<?=$servicio["id_servicio"]?>" class="btn-detail">Ver</a>
              <a href="editar-servicio.php?id=<?=$servicio["id_servicio"]?>" class="btn-secondary-company">Editar</a>
              <?php if($servicio["estado"] == "activo"){ ?>
              <form method="post" onsubmit="return confirm('¿Seguro que quieres cancelar este servicio? También se cancelarán sus reservas.');">
                <input type="hidden" name="id_servicio" value="<?=$servicio["id_servicio"]?>">
                <button type="submit" name="cancelar_servicio" class="btn-reject">
                  Cancelar servicio
                </button>
              </form>
            <?php }else{ ?>
              <form method="post" onsubmit="return confirm('¿Seguro que quieres reactivar este servicio? Los usuarios tendrán que reservar de nuevo.');">
                <input type="hidden" name="id_servicio" value="<?=$servicio["id_servicio"]?>">
                <button type="submit" name="reactivar_servicio" class="btn-reject">
                  Reactivar servicio
                </button>
              </form>
            <?php } ?>
            </div>
          </article>

           <?php } ?>

      <?php } ?>

        </section>

      </main>
    </div>
  </div>

</body>
</html>