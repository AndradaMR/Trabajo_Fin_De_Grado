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
          <div class="home-search-block">
            <form class="home-search-form" action="resultados.php" method="get">
              <label for="buscador" class="sr-only">Buscar actividad</label>
              <input
                type="text"
                id="buscador"
                name="buscador"
                class="search-input"
                placeholder="¿Que te gustaría hacer?"
              />
            </form>

            <div class="home-filter-row">
              <select id="categoria_filtro" name="categoria" class="filter-pill filter-select">
                <option value="">Categoría</option>
                <?php foreach ($categorias as $categoria) { ?>
                  <option value="<?= htmlspecialchars($categoria["nombre"]) ?>">
                    <?= htmlspecialchars($categoria["nombre"]) ?>
                  </option>
                <?php } ?>
              </select>
              <button type="button" class="filter-pill">Hoy</button>
              <button type="button" class="filter-pill">Esta semana</button>

              <select id="precio" name="precio" class="filter-pill filter-select">
                <option value="">Precio</option>
                <option value="0-10">0€ - 10€</option>
                <option value="10-25">10€ - 25€</option>
                <option value="25-50">25€ - 50€</option>
                <option value="50+">Más de 50€</option>
              </select>
            </div>
          </div>
        </div>
        <div id="resultadosBusqueda" class="resultados-live"></div>
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
              <?php
              $imagen = !empty($act["imagen"]) ? "../" . $act["imagen"] : "../assets/placeholder.jpg";
              ?>

              <img src="<?= $imagen ?>" alt="<?= htmlspecialchars($act["nombre_servicio"]) ?>" class="activity-image">
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
              <a href="actividad.php?idact=<?=$act["id_servicio"]?>" class="btn btn-primary btn-full" aria-label="Ver actividad <?=$act["nombre_servicio"]?>">Ver actividad</a>
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
//Necesitamos pasar a mi script las subcategorias organizadas para usarlas con el filtro
let subcategoriasPorPadre = <?= json_encode($subcategoriasPorPadre, JSON_UNESCAPED_UNICODE); ?>;
</script>

<script src="../js/filtrosindex.js"></script>
<script>
  document.addEventListener("DOMContentLoaded", function () {

    const input = document.getElementById("buscador");
    const contenedor = document.getElementById("resultadosBusqueda");
    const categoria = document.getElementById("categoria_filtro");
    const precio = document.getElementById("precio");

    function buscar() {
      const texto = input.value.trim();
      const cat = categoria.value;
      const pre = precio.value;

      if (texto.length < 2 && cat === "" && pre === "") {
        contenedor.innerHTML = "";
        return;
      }

      fetch(
        "ajax_busqueda.php?buscador=" + encodeURIComponent(texto) +
        "&categoria=" + encodeURIComponent(cat) +
        "&precio=" + encodeURIComponent(pre)
      )
        .then(res => res.text())
        .then(data => {
          contenedor.innerHTML = data;
        });
    }

    input.addEventListener("input", buscar);
    categoria.addEventListener("change", buscar);
    precio.addEventListener("change", buscar);

  });
</script>


 <?php
require_once("footer.php");
?>

</body>
</html>