<?php
$titulo="<h1>Bienvenido a Body and Soul</h1>";
require_once("head.php");


?>

  <main>
    
    <section class="hero-section">
      <div class="container">
        <div class="hero-box">
          <div class="hero-text">
            <span class="section-tag">Descubre experiencias</span>
            <h2>¿Buscando algún plan entretenido?</h2>
            <p>
              Encuentra actividades de deporte, bienestar y experiencias que te ayuden a cuidarte por dentro y por fuera.
            </p>
          </div>

          <div class="categories-bar">
          <div class="container categories-bar-inner">
            <div class="categories-box">
              <label for="categoria" class="categories-label">Explora por categorías</label>

              <select id="categoria_top" name="id_categoria" class="categories-select">
                <option value="">Categorías</option>
                <?php foreach ($categorias as $categoria){ ?>
                  <option value="<?= $categoria["nombre"]; ?>">
                    <?= htmlspecialchars($categoria["nombre"]); ?>
                  </option>
                <?php } ?>
              </select>
            </div>
          </div>
        </div>

          <div class="search-panel">
            <form class="search-form" action="#" method="get">
              <label for="buscador" class="sr-only">Buscar actividad</label>
              <input
                type="text"
                id="buscador"
                name="buscador"
                class="search-input"
                placeholder="Busca una actividad, centro o experiencia"
              />
            </form>

            <div class="filters-box">
              <h3>Filtros</h3>

              <div class="filters-grid">
                <div class="form-group">
                  <select  id="categoria_filtro" name="id_categoria" class="categories-select">
                    <option value="">Categorias</option>
                    <?php foreach ($categorias as $categoria){
                      ?>
                    <option value="<?= $categoria["nombre"]; ?>">
                        <?= htmlspecialchars($categoria["nombre"]); ?>
                    </option>
                    <?php 
                    }
                    ?>
                </select>
                </div>

                <div class="form-group">
                  <select id="subcategoria_filtro" name="subcategoria" class="categories-select">
                    <option value="">Subcategorías</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="precio">Rango de precio</label>
                  <select id="precio" name="precio">
                    <option value="">Cualquiera</option>
                    <option value="0-10">0€ - 10€</option>
                    <option value="10-25">10€ - 25€</option>
                    <option value="25-50">25€ - 50€</option>
                    <option value="50+">Más de 50€</option>
                  </select>
                </div>
              </div>

              <button id="filtrosbuscar" type="button" class="btn btn-secondary">Buscar</button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="featured-section">
      <div class="container">
        <div class="section-header">
          <span class="section-tag">Top actividades</span>
          <h2>Actividades más reservadas</h2>
          <p>
            Estas son algunas de las experiencias favoritas de nuestras usuarias.
          </p>
        </div>

        <div class="activities-grid">
          <?php
          $numact=4;
           foreach($actividadesmasreservadas as $act){
          if($numact>0){
          ?>
          <article class="activity-card">
            <div class="activity-image-wrapper">
              <img src="img/yoga1.jpg" alt="<?=$act["nombre_servicio"]?>" class="activity-image">
            </div>

            <div class="activity-content">
              <div class="activity-rating" aria-label="Puntuación 4,8 de 5">
                <span class="stars">★★★★★</span>
                <span class="rating-value">4.8</span>
              </div>
              <h3><?=$act["nombre_servicio"]?></h3>
              <p>
                <?=$act["descripcion"]?>
              </p>
              <a href="actividad.php?idact=<?=$act["id_servicio"]?>" class="btn btn-primary btn-full">Ir a la actividad</a>
            </div>
          </article>
          <?php
           }
           $numact--;
          }
          ?>

        </div>
      </div>
    </section>
  </main>

<script>
let subcategoriasPorPadre = <?= json_encode($subcategoriasPorPadre, JSON_UNESCAPED_UNICODE); ?>;
</script>

<script src="../js/filtros.js"></script>

 <?php
require_once("footer.php");
?>

</body>
</html>