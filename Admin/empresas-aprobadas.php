<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Body and Soul | Empresas aprobadas</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Overpass:wght@300;400;500;600;700&family=Sansita:wght@700;800;900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="../css/admin-styles/empresas-aprobadas.css">
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
          <span class="admin-page-tag">Empresas activas</span>
          <h2>Empresas aprobadas</h2>
        </div>

        <div class="admin-topbar-right">
          <div class="admin-admin-chip">
            <span class="admin-admin-avatar">A</span>
            <span>Administrador</span>
          </div>
        </div>
      </header>

      <main class="admin-content">

        <section class="approved-header-card">
          <div>
            <span class="admin-section-tag">Gestión</span>
            <h3>Empresas activas en la plataforma</h3>
            <p>
              Consulta las empresas aprobadas, revisa sus actividades y gestiona su estado dentro del sistema.
            </p>
          </div>

          <div class="approved-summary">
            <span class="approved-summary-number">48</span>
            <span class="approved-summary-label">Aprobadas</span>
          </div>
        </section>

        <section class="approved-filters-card">
          <div class="approved-search">
            <label for="buscar-aprobada" class="sr-only">Buscar empresa</label>
            <input type="text" id="buscar-aprobada" placeholder="Buscar empresa, ciudad o email">
          </div>

          <div class="approved-filters">
            <select>
              <option value="">Todas las categorías</option>
              <option value="deporte">Deporte</option>
              <option value="bienestar">Bienestar</option>
            </select>

            <select>
              <option value="">Todos los estados</option>
              <option value="activa">Activa</option>
              <option value="bloqueada">Bloqueada</option>
            </select>
          </div>
        </section>

        <section class="approved-list">

          <article class="approved-company-card">
            <div class="approved-company-main">
              <div class="approved-company-header">
                <img src="../assets/empresa-zen.jpg" alt="Zen Balance Studio" class="approved-company-logo">

                <div class="approved-company-title-block">
                  <p class="approved-company-category">Bienestar</p>
                  <h3>Zen Balance Studio</h3>
                  <p class="approved-company-location">Madrid</p>
                </div>

                <span class="admin-status-chip approved">Activa</span>
              </div>

              <p class="approved-company-description">
                Centro especializado en yoga, meditación y actividades de bienestar enfocadas en equilibrio físico y mental.
              </p>

              <div class="approved-company-grid">
                <div class="approved-info-item">
                  <span class="info-label">Fecha aprobación</span>
                  <span class="info-value">10/03/2026</span>
                </div>

                <div class="approved-info-item">
                  <span class="info-label">Actividades activas</span>
                  <span class="info-value">5</span>
                </div>

                <div class="approved-info-item">
                  <span class="info-label">Email</span>
                  <span class="info-value">info@zenbalance.com</span>
                </div>

                <div class="approved-info-item">
                  <span class="info-label">Teléfono</span>
                  <span class="info-value">611 222 333</span>
                </div>
              </div>
            </div>

            <div class="approved-company-actions">
              <a href="detalle-empresa.html" class="btn-detail">Ver empresa</a>
              <a href="actividades.html" class="btn-secondary-admin">Ver actividades</a>
              <button type="button" class="btn-warning">Bloquear</button>
              <button type="button" class="btn-reject">Eliminar</button>
            </div>
          </article>

          <article class="approved-company-card">
            <div class="approved-company-main">
              <div class="approved-company-header">
                <img src="../assets/empresa-padel.jpg" alt="Urban Pádel Club" class="approved-company-logo">

                <div class="approved-company-title-block">
                  <p class="approved-company-category">Deporte</p>
                  <h3>Urban Pádel Club</h3>
                  <p class="approved-company-location">Alcobendas</p>
                </div>

                <span class="admin-status-chip approved">Activa</span>
              </div>

              <p class="approved-company-description">
                Club deportivo especializado en pádel y actividades de raqueta con pistas cubiertas y formación.
              </p>

              <div class="approved-company-grid">
                <div class="approved-info-item">
                  <span class="info-label">Fecha aprobación</span>
                  <span class="info-value">08/03/2026</span>
                </div>

                <div class="approved-info-item">
                  <span class="info-label">Actividades activas</span>
                  <span class="info-value">7</span>
                </div>

                <div class="approved-info-item">
                  <span class="info-label">Email</span>
                  <span class="info-value">contacto@urbanpadel.com</span>
                </div>

                <div class="approved-info-item">
                  <span class="info-label">Teléfono</span>
                  <span class="info-value">622 555 888</span>
                </div>
              </div>
            </div>

            <div class="approved-company-actions">
              <a href="detalle-empresa.html" class="btn-detail">Ver empresa</a>
              <a href="actividades.html" class="btn-secondary-admin">Ver actividades</a>
              <button type="button" class="btn-warning">Bloquear</button>
              <button type="button" class="btn-reject">Eliminar</button>
            </div>
          </article>

          <article class="approved-company-card">
            <div class="approved-company-main">
              <div class="approved-company-header">
                <img src="../assets/empresa-spa.jpg" alt="Wellness Spa Center" class="approved-company-logo">

                <div class="approved-company-title-block">
                  <p class="approved-company-category">Bienestar</p>
                  <h3>Wellness Spa Center</h3>
                  <p class="approved-company-location">Pozuelo</p>
                </div>

                <span class="admin-status-chip blocked">Bloqueada</span>
              </div>

              <p class="approved-company-description">
                Espacio dedicado a spa, circuitos termales y experiencias premium de relajación y autocuidado.
              </p>

              <div class="approved-company-grid">
                <div class="approved-info-item">
                  <span class="info-label">Fecha aprobación</span>
                  <span class="info-value">04/03/2026</span>
                </div>

                <div class="approved-info-item">
                  <span class="info-label">Actividades activas</span>
                  <span class="info-value">3</span>
                </div>

                <div class="approved-info-item">
                  <span class="info-label">Email</span>
                  <span class="info-value">admin@wellnessspa.com</span>
                </div>

                <div class="approved-info-item">
                  <span class="info-label">Teléfono</span>
                  <span class="info-value">633 444 999</span>
                </div>
              </div>
            </div>

            <div class="approved-company-actions">
              <a href="detalle-empresa.html" class="btn-detail">Ver empresa</a>
              <a href="actividades.html" class="btn-secondary-admin">Ver actividades</a>
              <button type="button" class="btn-approve">Desbloquear</button>
              <button type="button" class="btn-reject">Eliminar</button>
            </div>
          </article>

        </section>

      </main>
    </div>
  </div>

</body>
</html>