<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Body and Soul | Categoría Bienestar</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Overpass:wght@300;400;500;600;700&family=Sansita:wght@700;800;900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/categoria.css">
</head>
<body>

  <header class="main-header">
    <div class="container header-container">

      <div class="header-left">
        <a href="index.php" class="logo-link" aria-label="Ir al inicio">
          <img src="img/logo.png" class="logo" alt="Body and Soul">
        </a>

        <div class="nav-categories">
          <label for="categorias" class="sr-only">Categorías</label>
          <select id="categorias" class="categories-select">
            <option value="">Categorias</option>
            <option value="deporte">Deporte</option>
            <option value="bienestar" selected>Bienestar</option>
          </select>
        </div>
      </div>

      <div class="header-title">
        <h1>Bienvenida a Body and Soul</h1>
      </div>

      <div class="header-right">
        <a href="login.php" class="btn btn-outline">Iniciar sesión</a>
      </div>

    </div>
  </header>

  <main class="category-page">
    <section class="category-hero">
      <div class="container">
        <span class="section-tag">Explora actividades</span>
        <h2 class="category-title">Bienestar</h2>
        <p class="category-description">
          Encuentra experiencias pensadas para desconectar, cuidarte y dedicarte tiempo de calidad a ti misma.
        </p>
      </div>
    </section>

    <section class="subcategory-section">
      <div class="container">

        <!-- SUBCATEGORÍA 1 -->
        <article class="subcategory-block">
          <div class="subcategory-header">
            <h3>Yoga</h3>
          </div>

          <div class="carousel-wrapper">
            <button class="carousel-btn carousel-btn-left" type="button" aria-label="Desplazar yoga a la izquierda">
              &#10094;
            </button>

            <div class="carousel-track">
              <a href="actividad.php" class="subcategory-card">
                <img src="assets/yoga-1.jpg" alt="Clase de yoga flow">
                <span>Yoga Flow</span>
              </a>

              <a href="actividad.php" class="subcategory-card">
                <img src="assets/yoga-2.jpg" alt="Clase de hatha yoga">
                <span>Hatha Yoga</span>
              </a>

              <a href="actividad.php" class="subcategory-card">
                <img src="assets/yoga-3.jpg" alt="Sesión de yoga al aire libre">
                <span>Yoga al aire libre</span>
              </a>

              <a href="actividad.php" class="subcategory-card">
                <img src="assets/yoga-4.jpg" alt="Clase de yoga para principiantes">
                <span>Iniciación</span>
              </a>

              <a href="actividad.php" class="subcategory-card">
                <img src="assets/yoga-5.jpg" alt="Sesión de yoga relajante">
                <span>Yoga Relax</span>
              </a>

              <a href="actividad.php" class="subcategory-card">
                <img src="assets/yoga-6.jpg" alt="Clase de vinyasa yoga">
                <span>Vinyasa</span>
              </a>

              <a href="actividad.php" class="subcategory-card">
                <img src="assets/yoga-7.jpg" alt="Sesión de yoga al atardecer">
                <span>Sunset Yoga</span>
              </a>
            </div>

            <button class="carousel-btn carousel-btn-right" type="button" aria-label="Desplazar yoga a la derecha">
              &#10095;
            </button>
          </div>
        </article>

        <!-- SUBCATEGORÍA 2 -->
        <article class="subcategory-block">
          <div class="subcategory-header">
            <h3>Spa</h3>
          </div>

          <div class="carousel-wrapper">
            <button class="carousel-btn carousel-btn-left" type="button" aria-label="Desplazar spa a la izquierda">
              &#10094;
            </button>

            <div class="carousel-track">
              <a href="actividad.php" class="subcategory-card">
                <img src="assets/spa-1.jpg" alt="Circuito spa relajante">
                <span>Circuito termal</span>
              </a>

              <a href="actividad.php" class="subcategory-card">
                <img src="assets/spa-2.jpg" alt="Piscina climatizada en spa">
                <span>Piscina climatizada</span>
              </a>

              <a href="actividad.php" class="subcategory-card">
                <img src="assets/spa-3.jpg" alt="Sesión de jacuzzi y relax">
                <span>Jacuzzi Relax</span>
              </a>

              <a href="actividad.php" class="subcategory-card">
                <img src="assets/spa-4.jpg" alt="Spa con sauna">
                <span>Spa + sauna</span>
              </a>

              <a href="actividad.php" class="subcategory-card">
                <img src="assets/spa-5.jpg" alt="Experiencia spa en pareja">
                <span>Spa en pareja</span>
              </a>

              <a href="actividad.php" class="subcategory-card">
                <img src="assets/spa-6.jpg" alt="Spa con vistas">
                <span>Spa premium</span>
              </a>

              <a href="actividad.php" class="subcategory-card">
                <img src="assets/spa-7.jpg" alt="Experiencia wellness en balneario">
                <span>Balneario</span>
              </a>
            </div>

            <button class="carousel-btn carousel-btn-right" type="button" aria-label="Desplazar spa a la derecha">
              &#10095;
            </button>
          </div>
        </article>

        <!-- SUBCATEGORÍA 3 -->
        <article class="subcategory-block">
          <div class="subcategory-header">
            <h3>Masajes</h3>
          </div>

          <div class="carousel-wrapper">
            <button class="carousel-btn carousel-btn-left" type="button" aria-label="Desplazar masajes a la izquierda">
              &#10094;
            </button>

            <div class="carousel-track">
              <a href="actividad.php" class="subcategory-card">
                <img src="assets/masajes-1.jpg" alt="Masaje relajante corporal">
                <span>Masaje relajante</span>
              </a>

              <a href="actividad.php" class="subcategory-card">
                <img src="assets/masajes-2.jpg" alt="Masaje descontracturante">
                <span>Descontracturante</span>
              </a>

              <a href="actividad.php" class="subcategory-card">
                <img src="assets/masajes-3.jpg" alt="Masaje con aceites esenciales">
                <span>Aromático</span>
              </a>

              <a href="actividad.php" class="subcategory-card">
                <img src="assets/masajes-4.jpg" alt="Masaje de espalda">
                <span>Espalda y cuello</span>
              </a>

              <a href="actividad.php" class="subcategory-card">
                <img src="assets/masajes-5.jpg" alt="Masaje de piedras calientes">
                <span>Piedras calientes</span>
              </a>

              <a href="actividad.php" class="subcategory-card">
                <img src="assets/masajes-6.jpg" alt="Masaje facial relajante">
                <span>Masaje facial</span>
              </a>

              <a href="actividad.php" class="subcategory-card">
                <img src="assets/masajes-7.jpg" alt="Masaje premium de cuerpo completo">
                <span>Cuerpo completo</span>
              </a>
            </div>

            <button class="carousel-btn carousel-btn-right" type="button" aria-label="Desplazar masajes a la derecha">
              &#10095;
            </button>
          </div>
        </article>

        <!-- SUBCATEGORÍA 4 -->
        <article class="subcategory-block">
          <div class="subcategory-header">
            <h3>Meditación</h3>
          </div>

          <div class="carousel-wrapper">
            <button class="carousel-btn carousel-btn-left" type="button" aria-label="Desplazar meditación a la izquierda">
              &#10094;
            </button>

            <div class="carousel-track">
              <a href="actividad.php" class="subcategory-card">
                <img src="assets/meditacion-1.jpg" alt="Sesión de meditación guiada">
                <span>Meditación guiada</span>
              </a>

              <a href="actividad.php" class="subcategory-card">
                <img src="assets/meditacion-2.jpg" alt="Meditación mindfulness">
                <span>Mindfulness</span>
              </a>

              <a href="actividad.php" class="subcategory-card">
                <img src="assets/meditacion-3.jpg" alt="Meditación para reducir estrés">
                <span>Anti-estrés</span>
              </a>

              <a href="actividad.php" class="subcategory-card">
                <img src="assets/meditacion-4.jpg" alt="Meditación al amanecer">
                <span>Mañanas conscientes</span>
              </a>

              <a href="actividad.php" class="subcategory-card">
                <img src="assets/meditacion-5.jpg" alt="Meditación en grupo">
                <span>Sesión en grupo</span>
              </a>

              <a href="actividad.php" class="subcategory-card">
                <img src="assets/meditacion-6.jpg" alt="Meditación para principiantes">
                <span>Iniciación</span>
              </a>

              <a href="actividad.php" class="subcategory-card">
                <img src="assets/meditacion-7.jpg" alt="Meditación con cuencos tibetanos">
                <span>Cuencos tibetanos</span>
              </a>
            </div>

            <button class="carousel-btn carousel-btn-right" type="button" aria-label="Desplazar meditación a la derecha">
              &#10095;
            </button>
          </div>
        </article>

        <!-- SUBCATEGORÍA 5 -->
        <article class="subcategory-block">
          <div class="subcategory-header">
            <h3>Aromaterapia</h3>
          </div>

          <div class="carousel-wrapper">
            <button class="carousel-btn carousel-btn-left" type="button" aria-label="Desplazar aromaterapia a la izquierda">
              &#10094;
            </button>

            <div class="carousel-track">
              <a href="actividad.php" class="subcategory-card">
                <img src="assets/aromaterapia-1.jpg" alt="Sesión de aromaterapia relajante">
                <span>Relax esencial</span>
              </a>

              <a href="actividad.php" class="subcategory-card">
                <img src="assets/aromaterapia-2.jpg" alt="Aromaterapia con masaje">
                <span>Aromaterapia + masaje</span>
              </a>

              <a href="actividad.php" class="subcategory-card">
                <img src="assets/aromaterapia-3.jpg" alt="Terapia de aceites esenciales">
                <span>Aceites esenciales</span>
              </a>

              <a href="actividad.php" class="subcategory-card">
                <img src="assets/aromaterapia-4.jpg" alt="Sesión sensorial de bienestar">
                <span>Experiencia sensorial</span>
              </a>

              <a href="actividad.php" class="subcategory-card">
                <img src="assets/aromaterapia-5.jpg" alt="Aromaterapia para dormir mejor">
                <span>Sueño profundo</span>
              </a>

              <a href="actividad.php" class="subcategory-card">
                <img src="assets/aromaterapia-6.jpg" alt="Sesión de bienestar con fragancias">
                <span>Fragancias calmantes</span>
              </a>

              <a href="actividad.php" class="subcategory-card">
                <img src="assets/aromaterapia-7.jpg" alt="Ritual de aromaterapia premium">
                <span>Ritual premium</span>
              </a>
            </div>

            <button class="carousel-btn carousel-btn-right" type="button" aria-label="Desplazar aromaterapia a la derecha">
              &#10095;
            </button>
          </div>
        </article>

      </div>
    </section>
  </main>


 <?php
require_once("footer.php");
?>

</body>
</html>