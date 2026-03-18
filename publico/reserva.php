<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Body and Soul | Reservar actividad</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Overpass:wght@300;400;500;600;700&family=Sansita:wght@700;800;900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/reserva.css">
</head>
<body>

  <header class="main-header">
    <div class="container header-container">

      <div class="header-left">
        <a href="index.php" class="logo-link" aria-label="Ir al inicio">
          <img src="assets/logo-body-and-soul.png" class="logo" alt="Body and Soul">
        </a>

        <div class="nav-categories">
          <label for="categorias" class="sr-only">Categorías</label>
          <select id="categorias" class="categories-select">
            <option value="">Categorías</option>
            <option value="deporte">Deporte</option>
            <option value="bienestar">Bienestar</option>
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

  <main class="booking-page">
    <section class="booking-section">
      <div class="container">

        <div class="booking-title-block">
          <span class="section-tag">Reserva tu experiencia</span>
          <h2>Yoga Flow</h2>
        </div>

        <div class="booking-layout">

          <!-- MAPA -->
          <article class="booking-map-card">
            <h3>Ubicación</h3>

            <div class="map-wrapper">
              <iframe
                src="https://www.google.com/maps?q=Madrid&output=embed"
                title="Mapa de ubicación de la actividad"
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
              </iframe>
            </div>
          </article>

          <!-- RESERVA -->
          <article class="booking-form-card">
            <h3>Selecciona fecha y hora</h3>

            <form action="#" method="post" class="booking-form">

              <div class="calendar-block">
                <label for="fecha" class="calendar-label">Fecha</label>
                <input type="date" id="fecha" name="fecha" required>
              </div>

              <div class="time-slots-block">
                <h4>Tramos horarios disponibles</h4>

                <div class="time-slots-grid">
                  <label class="time-slot">
                    <input type="radio" name="hora" value="09:00" required>
                    <span>09:00</span>
                  </label>

                  <label class="time-slot">
                    <input type="radio" name="hora" value="10:30">
                    <span>10:30</span>
                  </label>

                  <label class="time-slot">
                    <input type="radio" name="hora" value="12:00">
                    <span>12:00</span>
                  </label>

                  <label class="time-slot">
                    <input type="radio" name="hora" value="16:00">
                    <span>16:00</span>
                  </label>

                  <label class="time-slot">
                    <input type="radio" name="hora" value="17:30">
                    <span>17:30</span>
                  </label>

                  <label class="time-slot">
                    <input type="radio" name="hora" value="19:00">
                    <span>19:00</span>
                  </label>
                </div>
              </div>

              <button type="submit" class="btn btn-primary btn-full reserve-activity-btn">
                Reservar actividad
              </button>

            </form>
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