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

              <button type="submit" class="btn btn-primary">Buscar</button>
            </form>

            <div class="filters-box">
              <h3>Filtros</h3>

              <div class="filters-grid">
                <div class="form-group">
                  <label for="categoria">Categoría</label>
                  <select id="categoria" name="categoria">
                    <option value="">Todas</option>
                    <option value="deporte">Deporte</option>
                    <option value="bienestar">Bienestar</option>
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

              <button type="button" class="btn btn-secondary">Aplicar filtros</button>
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
          <article class="activity-card">
            <div class="activity-image-wrapper">
              <img src="img/yoga1.jpg" alt="Clase de yoga" class="activity-image">
            </div>

            <div class="activity-content">
              <div class="activity-rating" aria-label="Puntuación 4,8 de 5">
                <span class="stars">★★★★★</span>
                <span class="rating-value">4.8</span>
              </div>

              <h3>Yoga Flow</h3>
              <p>
                Clase guiada para mejorar flexibilidad, respiración y equilibrio en un entorno relajante.
              </p>

              <a href="actividad.php" class="btn btn-primary btn-full">Ir a la actividad</a>
            </div>
          </article>

          <article class="activity-card">
            <div class="activity-image-wrapper">
              <img src="img/pilates1.jpg" alt="Sesión de pilates" class="activity-image">
            </div>

            <div class="activity-content">
              <div class="activity-rating" aria-label="Puntuación 4,7 de 5">
                <span class="stars">★★★★★</span>
                <span class="rating-value">4.7</span>
              </div>

              <h3>Pilates Core</h3>
              <p>
                Entrenamiento centrado en fuerza, postura y control corporal con sesiones adaptadas.
              </p>

              <a href="actividad.php" class="btn btn-primary btn-full">Ir a la actividad</a>
            </div>
          </article>

          <article class="activity-card">
            <div class="activity-image-wrapper">
              <img src="img/spa1.jpg" alt="Experiencia de spa y bienestar" class="activity-image">
            </div>

            <div class="activity-content">
              <div class="activity-rating" aria-label="Puntuación 4,9 de 5">
                <span class="stars">★★★★★</span>
                <span class="rating-value">4.9</span>
              </div>

              <h3>Spa Relax</h3>
              <p>
                Un plan perfecto para desconectar con circuito termal y tratamientos pensados para tu bienestar.
              </p>

              <a href="actividad.php" class="btn btn-primary btn-full">Ir a la actividad</a>
            </div>
          </article>

          <article class="activity-card">
            <div class="activity-image-wrapper">
              <img src="img/box-fitness1.png" alt="Actividad deportiva de boxeo fitness" class="activity-image">
            </div>

            <div class="activity-content">
              <div class="activity-rating" aria-label="Puntuación 4,6 de 5">
                <span class="stars">★★★★☆</span>
                <span class="rating-value">4.6</span>
              </div>

              <h3>Box Fitness</h3>
              <p>
                Sesión intensa y divertida para liberar estrés, mejorar resistencia y mantenerte activa.
              </p>

              <a href="actividad.php" class="btn btn-primary btn-full">Ir a la actividad</a>
            </div>
          </article>
        </div>
      </div>
    </section>
  </main>

 <?php
require_once("footer.php");
?>

<script>
document.getElementById("categoria").addEventListener("change", function() {
  
  if(this.value !== ""){
    if(this.value=="deporte"){
      window.location.href="categoria-deporte.php";
    }
  }

});
</script>

</body>
</html>