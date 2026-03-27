<?php
$titulo="<h1>Bienvenido a Body and Soul</h1>";
require_once("head.php");

?>

  <main class="activity-page">
    <section class="activity-section">
      <div class="container">

        <div class="activity-breadcrumb">
          <a href="bienestar.php">Bienestar</a>
          <span>/</span>
          <a href="bienestar.php#yoga">Yoga</a>
        </div>

        <div class="activity-layout">

          <!-- GALERÍA -->
          <article class="activity-gallery-card">
            <div class="activity-gallery-header">
              <span class="section-tag">Experiencia destacada</span>
            </div>

            <div class="activity-gallery">
              <button class="gallery-btn gallery-btn-left" type="button" aria-label="Imagen anterior">
                &#10094;
              </button>

              <div class="activity-image-wrapper">
                <img
                  src="assets/yoga-detalle-1.jpg"
                  alt="Clase de yoga en estudio luminoso"
                  class="activity-main-image"
                >
              </div>

              <button class="gallery-btn gallery-btn-right" type="button" aria-label="Imagen siguiente">
                &#10095;
              </button>
            </div>
          </article>

          <!-- INFORMACIÓN -->
          <article class="activity-info-card">
            <div class="activity-info-header">
              <h2>Yoga Flow</h2>
            </div>

            <div class="activity-info-content">
              <div class="info-block">
                <h3>Descripción</h3>
                <p>
                  Yoga Flow es una actividad pensada para conectar cuerpo y mente a través
                  de una secuencia fluida de posturas, respiración consciente y momentos de
                  relajación. La sesión combina trabajo de movilidad, equilibrio y fuerza suave,
                  adaptándose tanto a personas principiantes como a quienes ya tienen experiencia.
                  Es ideal para reducir el estrés, mejorar la flexibilidad y dedicarte un rato
                  de autocuidado en un ambiente tranquilo y agradable.
                </p>
              </div>

              <div class="info-grid">
                <div class="info-item">
                  <h3>Duración</h3>
                  <p>60 minutos</p>
                </div>

                <div class="info-item">
                  <h3>Ubicación</h3>
                  <p>Centro Body and Soul, Madrid</p>
                </div>

                <div class="info-item info-item-full">
                  <h3>Materiales empleados</h3>
                  <p>
                    Esterilla, bloque de yoga, cinta elástica y manta ligera para la relajación final.
                  </p>
                </div>
              </div>

              <a href="reserva.php" class="btn btn-primary btn-full reserve-btn">
                Reservar actividad
              </a>
            </div>
          </article>

        </div>
      </div>
    </section>
  </main>


 <?php
require_once("footer.php");
?>

</body>
</html>