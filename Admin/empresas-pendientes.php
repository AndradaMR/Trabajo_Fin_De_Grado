<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Body and Soul | Empresas pendientes</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Overpass:wght@300;400;500;600;700&family=Sansita:wght@700;800;900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="../css/admin-styles/empresas-pendientes.css">
</head>
<body class="admin-dashboard-body">

  <div class="admin-layout">

    <aside class="admin-sidebar">
      <div class="admin-sidebar-top">
        <img src="../img/logo.PNG" alt="Logo Body and Soul" class="admin-sidebar-logo">
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
          <span class="admin-page-tag">Gestión de empresas</span>
          <h2>Empresas pendientes</h2>
        </div>

        <div class="admin-topbar-right">
          <div class="admin-admin-chip">
            <span class="admin-admin-avatar">A</span>
            <span>Administrador</span>
          </div>
        </div>
      </header>

      <main class="admin-content">

        <section class="pending-header-card">
          <div>
            <span class="admin-section-tag">Validación</span>
            <h3>Solicitudes recibidas</h3>
            <p>
              Revisa las empresas registradas y decide si cumplen los requisitos para formar parte de la plataforma.
            </p>
          </div>

          <div class="pending-summary">
            <span class="pending-summary-number">12</span>
            <span class="pending-summary-label">Pendientes</span>
          </div>
        </section>

        <section class="pending-filters-card">
          <div class="pending-search">
            <label for="buscar-empresa" class="sr-only">Buscar empresa</label>
            <input type="text" id="buscar-empresa" placeholder="Buscar empresa, ciudad o email">
          </div>

          <div class="pending-filters">
            <select>
              <option value="">Todas las categorías</option>
              <option value="deporte">Deporte</option>
              <option value="bienestar">Bienestar</option>
            </select>

            <select>
              <option value="">Todas las ciudades</option>
              <option value="madrid">Madrid</option>
              <option value="pozuelo">Pozuelo</option>
              <option value="alcobendas">Alcobendas</option>
            </select>
          </div>
        </section>

        <section class="pending-list">

          <article class="pending-company-card">
            <div class="pending-company-main">
              <div class="pending-company-top">
                <div>
                  <p class="pending-company-category">Bienestar</p>
                  <h3>Zen Balance Studio</h3>
                </div>
                <span class="admin-status-chip pending">Pendiente</span>
              </div>

              <p class="pending-company-description">
                Centro especializado en yoga, meditación y actividades de bienestar orientadas al equilibrio físico y mental.
              </p>

              <div class="pending-company-grid">
                <div class="pending-info-item">
                  <span class="info-label">Fecha de solicitud</span>
                  <span class="info-value">12/03/2026</span>
                </div>

                <div class="pending-info-item">
                  <span class="info-label">Ubicación</span>
                  <span class="info-value">Madrid</span>
                </div>

                <div class="pending-info-item">
                  <span class="info-label">Email</span>
                  <span class="info-value">info@zenbalance.com</span>
                </div>

                <div class="pending-info-item">
                  <span class="info-label">Teléfono</span>
                  <span class="info-value">611 222 333</span>
                </div>
              </div>
            </div>

            <div class="pending-company-actions">
              <a href="detalle-empresa.html" class="btn-detail">Ver detalle</a>
              <button type="button" class="btn-approve">Aprobar</button>
              <button type="button" class="btn-reject">Rechazar</button>
            </div>
          </article>

          <article class="pending-company-card">
            <div class="pending-company-main">
              <div class="pending-company-top">
                <div>
                  <p class="pending-company-category">Deporte</p>
                  <h3>Urban Pádel Club</h3>
                </div>
                <span class="admin-status-chip pending">Pendiente</span>
              </div>

              <p class="pending-company-description">
                Club deportivo centrado en pádel y actividades de raqueta con pistas indoor y clases para todos los niveles.
              </p>

              <div class="pending-company-grid">
                <div class="pending-info-item">
                  <span class="info-label">Fecha de solicitud</span>
                  <span class="info-value">11/03/2026</span>
                </div>

                <div class="pending-info-item">
                  <span class="info-label">Ubicación</span>
                  <span class="info-value">Alcobendas</span>
                </div>

                <div class="pending-info-item">
                  <span class="info-label">Email</span>
                  <span class="info-value">contacto@urbanpadel.com</span>
                </div>

                <div class="pending-info-item">
                  <span class="info-label">Teléfono</span>
                  <span class="info-value">622 555 888</span>
                </div>
              </div>
            </div>

            <div class="pending-company-actions">
              <a href="detalle-empresa.html" class="btn-detail">Ver detalle</a>
              <button type="button" class="btn-approve">Aprobar</button>
              <button type="button" class="btn-reject">Rechazar</button>
            </div>
          </article>

          <article class="pending-company-card">
            <div class="pending-company-main">
              <div class="pending-company-top">
                <div>
                  <p class="pending-company-category">Bienestar</p>
                  <h3>Wellness Spa Center</h3>
                </div>
                <span class="admin-status-chip pending">Pendiente</span>
              </div>

              <p class="pending-company-description">
                Espacio wellness con tratamientos de spa, circuitos termales y experiencias premium de relajación.
              </p>

              <div class="pending-company-grid">
                <div class="pending-info-item">
                  <span class="info-label">Fecha de solicitud</span>
                  <span class="info-value">10/03/2026</span>
                </div>

                <div class="pending-info-item">
                  <span class="info-label">Ubicación</span>
                  <span class="info-value">Pozuelo</span>
                </div>

                <div class="pending-info-item">
                  <span class="info-label">Email</span>
                  <span class="info-value">admin@wellnessspa.com</span>
                </div>

                <div class="pending-info-item">
                  <span class="info-label">Teléfono</span>
                  <span class="info-value">633 444 999</span>
                </div>
              </div>
            </div>

            <div class="pending-company-actions">
              <a href="detalle-empresa.html" class="btn-detail">Ver detalle</a>
              <button type="button" class="btn-approve">Aprobar</button>
              <button type="button" class="btn-reject">Rechazar</button>
            </div>
          </article>

        </section>
      </main>
    </div>
  </div>

</body>
</html>