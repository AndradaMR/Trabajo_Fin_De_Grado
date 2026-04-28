<?php
require_once("head.php");
require_once("../bd/bdempresa.php");

$bdempre = new bdempresa("localhost", 3306, "plataforma_servicios", "root", "");

if(!isset($_SESSION["empresa"])){
    header("Location: login.php");
    exit();
}

$idEmpresa = $_SESSION["empresa"];

$servicios = $bdempre->ObtenerServiciosEmpresa($idEmpresa);
$totalServicios = count($servicios);
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
              <option value="oculto">Oculto</option>
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
              <img src="<?=$imagen?>" alt="<?=htmlspecialchars($servicio["nombre_servicio"])?>">
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

                <!--METEMOS DURACION? TODOS LOS SERVICOS TIENEN LA MISmA? HAY UE CALCULARLA
                <div class="service-info-item">
                <span class="info-label">Duración</span>
                  <span class="info-value"><?=$servicio["duracion"]?> min</span>
                </div>-->

                <div class="service-info-item">
                  <span class="info-label">Plazas</span>
                  <span class="info-value"><?=$servicio["plazas"]?></span>
                </div>

                <div class="service-info-item">
                  <span class="info-label">Fecha alta</span>
                  <span class="info-value">12/03/2026</span>
                </div>
              </div>
            </div>

            <div class="service-company-actions">
              <a href="../publico/actividad.php?idact=<?=$servicio["id_servicio"]?>" class="btn-detail">Ver</a>
              <a href="editar-servicio.php?id=<?=$servicio["id_servicio"]?>" class="btn-secondary-company">Editar</a>
              <button type="button" class="btn-warning">Ocultar</button>
              <button type="button" class="btn-reject">Eliminar</button>
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