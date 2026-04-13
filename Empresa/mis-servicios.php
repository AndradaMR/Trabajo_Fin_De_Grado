<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Body and Soul | Mis servicios</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Overpass:wght@300;400;500;600;700&family=Sansita:wght@700;800;900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="../css/empresa-styles/mis-servicios.css">
</head>
<body class="company-body">

  <div class="company-layout">

    <aside class="company-sidebar">
      <div class="company-sidebar-top">
        <img src="../assets/logo-body-and-soul.png" alt="Logo Body and Soul" class="company-sidebar-logo">
        <h1>Empresa</h1>
      </div>

      <nav class="company-sidebar-nav">
        <a href="index.html" class="company-nav-link">Inicio</a>
        <a href="mis-servicios.html" class="company-nav-link active">Mis servicios</a>
        <a href="nueva-actividad.html" class="company-nav-link">Añadir servicio</a>
        <a href="reservas.html" class="company-nav-link">Reservas</a>
        <a href="perfil-empresa.html" class="company-nav-link">Perfil empresa</a>
        <a href="logout.php" class="company-nav-link company-nav-link-logout">Cerrar sesión</a>
      </nav>
    </aside>

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
            <span class="services-summary-number">5</span>
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

          <article class="service-company-card">
            <div class="service-company-image">
              <img src="../assets/yoga-company.jpg" alt="Yoga Flow Sunset">
            </div>

            <div class="service-company-main">
              <div class="service-company-top">
                <div>
                  <p class="service-company-category">Bienestar · Yoga</p>
                  <h3>Yoga Flow Sunset</h3>
                  <p class="service-company-location">Madrid Centro</p>
                </div>

                <span class="company-status-chip active">Activa</span>
              </div>

              <p class="service-company-description">
                Clase de yoga guiada al atardecer centrada en respiración, movilidad y relajación final.
              </p>

              <div class="service-company-grid">
                <div class="service-info-item">
                  <span class="info-label">Precio</span>
                  <span class="info-value">18 €</span>
                </div>

                <div class="service-info-item">
                  <span class="info-label">Duración</span>
                  <span class="info-value">60 min</span>
                </div>

                <div class="service-info-item">
                  <span class="info-label">Plazas</span>
                  <span class="info-value">12</span>
                </div>

                <div class="service-info-item">
                  <span class="info-label">Fecha alta</span>
                  <span class="info-value">12/03/2026</span>
                </div>
              </div>
            </div>

            <div class="service-company-actions">
              <a href="detalle-servicio.html" class="btn-detail">Ver</a>
              <a href="editar-servicio.html" class="btn-secondary-company">Editar</a>
              <button type="button" class="btn-warning">Ocultar</button>
              <button type="button" class="btn-reject">Eliminar</button>
            </div>
          </article>

          <article class="service-company-card">
            <div class="service-company-image">
              <img src="../assets/meditacion-company.jpg" alt="Meditación guiada">
            </div>

            <div class="service-company-main">
              <div class="service-company-top">
                <div>
                  <p class="service-company-category">Bienestar · Meditación</p>
                  <h3>Meditación guiada</h3>
                  <p class="service-company-location">Madrid</p>
                </div>

                <span class="company-status-chip active">Activa</span>
              </div>

              <p class="service-company-description">
                Sesión enfocada en reducir el estrés, mejorar la concentración y favorecer la calma mental.
              </p>

              <div class="service-company-grid">
                <div class="service-info-item">
                  <span class="info-label">Precio</span>
                  <span class="info-value">15 €</span>
                </div>

                <div class="service-info-item">
                  <span class="info-label">Duración</span>
                  <span class="info-value">45 min</span>
                </div>

                <div class="service-info-item">
                  <span class="info-label">Plazas</span>
                  <span class="info-value">10</span>
                </div>

                <div class="service-info-item">
                  <span class="info-label">Fecha alta</span>
                  <span class="info-value">09/03/2026</span>
                </div>
              </div>
            </div>

            <div class="service-company-actions">
              <a href="detalle-servicio.html" class="btn-detail">Ver</a>
              <a href="editar-servicio.html" class="btn-secondary-company">Editar</a>
              <button type="button" class="btn-warning">Ocultar</button>
              <button type="button" class="btn-reject">Eliminar</button>
            </div>
          </article>

          <article class="service-company-card">
            <div class="service-company-image">
              <img src="../assets/relax-company.jpg" alt="Sesión Relax Premium">
            </div>

            <div class="service-company-main">
              <div class="service-company-top">
                <div>
                  <p class="service-company-category">Bienestar · Relajación</p>
                  <h3>Sesión Relax Premium</h3>
                  <p class="service-company-location">Pozuelo</p>
                </div>

                <span class="company-status-chip draft">Borrador</span>
              </div>

              <p class="service-company-description">
                Experiencia de desconexión con técnicas suaves de relajación y ambiente sensorial guiado.
              </p>

              <div class="service-company-grid">
                <div class="service-info-item">
                  <span class="info-label">Precio</span>
                  <span class="info-value">22 €</span>
                </div>

                <div class="service-info-item">
                  <span class="info-label">Duración</span>
                  <span class="info-value">75 min</span>
                </div>

                <div class="service-info-item">
                  <span class="info-label">Plazas</span>
                  <span class="info-value">8</span>
                </div>

                <div class="service-info-item">
                  <span class="info-label">Fecha alta</span>
                  <span class="info-value">07/03/2026</span>
                </div>
              </div>
            </div>

            <div class="service-company-actions">
              <a href="detalle-servicio.html" class="btn-detail">Ver</a>
              <a href="editar-servicio.html" class="btn-secondary-company">Editar</a>
              <button type="button" class="btn-approve">Publicar</button>
              <button type="button" class="btn-reject">Eliminar</button>
            </div>
          </article>

        </section>

      </main>
    </div>
  </div>

</body>
</html>