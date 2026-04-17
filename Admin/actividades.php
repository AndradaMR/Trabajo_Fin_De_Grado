<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Body and Soul | Actividades</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Overpass:wght@300;400;500;600;700&family=Sansita:wght@700;800;900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="../css/admin-styles/actividades.css">
</head>
<body class="admin-dashboard-body">

  <div class="admin-layout">

    <aside class="admin-sidebar">
      <div class="admin-sidebar-top">
        <img src="../img/logo.PNG " alt="Logo Body and Soul" class="admin-sidebar-logo">
        <h1>Admin</h1>
      </div>

      <nav class="admin-sidebar-nav">
    <a href="dashboard.html" class="admin-nav-link">Dashboard</a>
        <a href="empresas-pendientes.html" class="admin-nav-link">Empresas pendientes</a>
        <a href="empresas-aprobadas.html" class="admin-nav-link">Empresas aprobadas</a>
        <a href="actividades.html" class="admin-nav-link">Actividades</a>
        <a href="usuarios.html" class="admin-nav-link active">Usuarios</a>
        <a href="reportes.html" class="admin-nav-link">Reportes</a>
        <a href="Crear-categoria.html" class="admin-nav-link admin-nav-link-logout">Crear categoría</a>
        <a href="../logout.php" class="admin-nav-link admin-logout">Cerrar sesión</a>
      </nav>
    </aside>

    <div class="admin-main">

      <header class="admin-topbar">
        <div class="admin-topbar-left">
          <span class="admin-page-tag">Control de contenido</span>
          <h2>Actividades</h2>
        </div>

        <div class="admin-topbar-right">
          <div class="admin-admin-chip">
            <span class="admin-admin-avatar">A</span>
            <span>Administrador</span>
          </div>
        </div>
      </header>

      <main class="admin-content">

        <section class="activities-header-card">
          <div>
            <span class="admin-section-tag">Gestión</span>
            <h3>Actividades publicadas en la plataforma</h3>
            <p>
              Supervisa las actividades registradas por las empresas, revisa su estado y gestiona su visibilidad.
            </p>
          </div>

          <div class="activities-summary">
            <span class="activities-summary-number">136</span>
            <span class="activities-summary-label">Actividades</span>
          </div>
        </section>

        <section class="activities-filters-card">
          <div class="activities-search">
            <label for="buscar-actividad" class="sr-only">Buscar actividad</label>
            <input type="text" id="buscar-actividad" placeholder="Buscar actividad, empresa o ciudad">
          </div>

          <div class="activities-filters">
            <select>
              <option value="">Todas las categorías</option>
              <option value="deporte">Deporte</option>
              <option value="bienestar">Bienestar</option>
            </select>

            <select>
              <option value="">Todos los estados</option>
              <option value="activa">Activa</option>
              <option value="revision">En revisión</option>
              <option value="oculta">Oculta</option>
            </select>
          </div>
        </section>

        <section class="activities-list">

          <article class="activity-admin-card">
            <div class="activity-admin-image">
              <img src="../assets/yoga-admin.jpg" alt="Yoga Flow Sunset">
            </div>

            <div class="activity-admin-main">
              <div class="activity-admin-top">
                <div>
                  <p class="activity-admin-category">Bienestar · Yoga</p>
                  <h3>Yoga Flow Sunset</h3>
                  <p class="activity-admin-company">Zen Balance Studio · Madrid</p>
                </div>

                <span class="admin-status-chip pending">En revisión</span>
              </div>

              <p class="activity-admin-description">
                Clase de yoga guiada al atardecer enfocada en respiración, movilidad y relajación consciente.
              </p>

              <div class="activity-admin-grid">
                <div class="activity-admin-info-item">
                  <span class="info-label">Duración</span>
                  <span class="info-value">60 min</span>
                </div>

                <div class="activity-admin-info-item">
                  <span class="info-label">Ubicación</span>
                  <span class="info-value">Madrid Centro</span>
                </div>

                <div class="activity-admin-info-item">
                  <span class="info-label">Precio</span>
                  <span class="info-value">18 €</span>
                </div>

                <div class="activity-admin-info-item">
                  <span class="info-label">Fecha alta</span>
                  <span class="info-value">12/03/2026</span>
                </div>
              </div>
            </div>

            <div class="activity-admin-actions">
              <a href="detalle-actividad.html" class="btn-detail">Ver detalle</a>
              <button type="button" class="btn-approve">Publicar</button>
              <button type="button" class="btn-warning">Ocultar</button>
              <button type="button" class="btn-reject">Eliminar</button>
            </div>
          </article>

          <article class="activity-admin-card">
            <div class="activity-admin-image">
              <img src="../assets/padel-admin.jpg" alt="Partido de pádel indoor">
            </div>

            <div class="activity-admin-main">
              <div class="activity-admin-top">
                <div>
                  <p class="activity-admin-category">Deporte · De raqueta</p>
                  <h3>Partido de pádel indoor</h3>
                  <p class="activity-admin-company">Urban Pádel Club · Alcobendas</p>
                </div>

                <span class="admin-status-chip approved">Activa</span>
              </div>

              <p class="activity-admin-description">
                Reserva de pista cubierta de pádel con vestuarios, iluminación profesional y zona de descanso.
              </p>

              <div class="activity-admin-grid">
                <div class="activity-admin-info-item">
                  <span class="info-label">Duración</span>
                  <span class="info-value">90 min</span>
                </div>

                <div class="activity-admin-info-item">
                  <span class="info-label">Ubicación</span>
                  <span class="info-value">Alcobendas</span>
                </div>

                <div class="activity-admin-info-item">
                  <span class="info-label">Precio</span>
                  <span class="info-value">24 €</span>
                </div>

                <div class="activity-admin-info-item">
                  <span class="info-label">Fecha alta</span>
                  <span class="info-value">08/03/2026</span>
                </div>
              </div>
            </div>

            <div class="activity-admin-actions">
              <a href="detalle-actividad.html" class="btn-detail">Ver detalle</a>
              <button type="button" class="btn-secondary-admin">Editar</button>
              <button type="button" class="btn-warning">Ocultar</button>
              <button type="button" class="btn-reject">Eliminar</button>
            </div>
          </article>

          <article class="activity-admin-card">
            <div class="activity-admin-image">
              <img src="../assets/spa-admin.jpg" alt="Circuito termal premium">
            </div>

            <div class="activity-admin-main">
              <div class="activity-admin-top">
                <div>
                  <p class="activity-admin-category">Bienestar · Spa</p>
                  <h3>Circuito termal premium</h3>
                  <p class="activity-admin-company">Wellness Spa Center · Pozuelo</p>
                </div>

                <span class="admin-status-chip blocked">Oculta</span>
              </div>

              <p class="activity-admin-description">
                Experiencia completa de bienestar con piscina climatizada, sauna, jacuzzi y zona de relajación.
              </p>

              <div class="activity-admin-grid">
                <div class="activity-admin-info-item">
                  <span class="info-label">Duración</span>
                  <span class="info-value">90 min</span>
                </div>

                <div class="activity-admin-info-item">
                  <span class="info-label">Ubicación</span>
                  <span class="info-value">Pozuelo</span>
                </div>

                <div class="activity-admin-info-item">
                  <span class="info-label">Precio</span>
                  <span class="info-value">35 €</span>
                </div>

                <div class="activity-admin-info-item">
                  <span class="info-label">Fecha alta</span>
                  <span class="info-value">04/03/2026</span>
                </div>
              </div>
            </div>

            <div class="activity-admin-actions">
              <a href="detalle-actividad.html" class="btn-detail">Ver detalle</a>
              <button type="button" class="btn-approve">Reactivar</button>
              <button type="button" class="btn-secondary-admin">Editar</button>
              <button type="button" class="btn-reject">Eliminar</button>
            </div>
          </article>

        </section>

      </main>
    </div>
  </div>

</body>
</html> 