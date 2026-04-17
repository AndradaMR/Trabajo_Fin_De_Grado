<?php
require_once("head.php");

if(!isset($_SESSION["empresa"])){
  header("Location: registro-empresa.php");
  exit();
}

?>

    <!-- CONTENIDO -->
    <div class="company-main">

      <header class="company-topbar">
        <div class="company-topbar-left">
          <span class="company-page-tag">Panel de gestión</span>
          <h2>Bienvenida, Zen Balance Studio</h2>
        </div>

        <div class="company-topbar-right">
          <a href="nueva-actividad.html" class="company-add-btn">+ Añadir servicio</a>
        </div>
      </header>

      <main class="company-content">

        <!-- HERO -->
        <section class="company-hero-card">
          <div class="company-hero-text">
            <span class="company-section-badge">Resumen</span>
            <h3>Gestiona tu presencia en la plataforma</h3>
            <p>
              Desde aquí puedes consultar la información de tu empresa, ver las categorías en las que publicas
              y administrar los servicios que has subido a Body and Soul.
            </p>
          </div>

          <div class="company-hero-stat">
            <span class="company-hero-number">5</span>
            <span class="company-hero-label">Servicios activos</span>
          </div>
        </section>

        <!-- TARJETAS RESUMEN -->
        <section class="company-stats-grid">
          <article class="company-stat-card">
            <p class="company-stat-label">Reservas recibidas</p>
            <h3>42</h3>
            <span class="company-stat-detail">+8 esta semana</span>
          </article>

          <article class="company-stat-card">
            <p class="company-stat-label">Categorías activas</p>
            <h3>3</h3>
            <span class="company-stat-detail">Bienestar, Yoga, Meditación</span>
          </article>

          <article class="company-stat-card">
            <p class="company-stat-label">Valoración media</p>
            <h3>4.8</h3>
            <span class="company-stat-detail">Excelente experiencia</span>
          </article>
        </section>

        <!-- GRID PRINCIPAL -->
        <section class="company-panels-grid">

          <!-- INFO EMPRESA -->
          <article class="company-panel-card">
            <div class="company-panel-header">
              <div>
                <span class="company-section-badge">Empresa</span>
                <h3>Información general</h3>
              </div>
              <a href="perfil-empresa.html" class="company-panel-link">Editar</a>
            </div>

            <div class="company-info-grid">
              <div class="company-info-item">
                <span class="info-label">Nombre comercial</span>
                <span class="info-value">Zen Balance Studio</span>
              </div>

              <div class="company-info-item">
                <span class="info-label">Categoría principal</span>
                <span class="info-value">Bienestar</span>
              </div>

              <div class="company-info-item">
                <span class="info-label">Ubicación</span>
                <span class="info-value">Madrid</span>
              </div>

              <div class="company-info-item">
                <span class="info-label">Email</span>
                <span class="info-value">info@zenbalance.com</span>
              </div>
            </div>
          </article>

          <!-- CATEGORÍAS -->
          <article class="company-panel-card">
            <div class="company-panel-header">
              <div>
                <span class="company-section-badge">Publicación</span>
                <h3>Categorías subidas</h3>
              </div>
            </div>

            <div class="company-tags">
              <span class="company-tag">Bienestar</span>
              <span class="company-tag">Yoga</span>
              <span class="company-tag">Meditación</span>
              <span class="company-tag">Relajación</span>
            </div>
          </article>

          <!-- SERVICIOS -->
          <article class="company-panel-card company-panel-card-wide">
            <div class="company-panel-header">
              <div>
                <span class="company-section-badge">Servicios</span>
                <h3>Servicios publicados</h3>
              </div>
              <a href="mis-servicios.html" class="company-panel-link">Ver todos</a>
            </div>

            <div class="company-services-list">

              <div class="company-service-item">
                <div class="company-service-info">
                  <h4>Yoga Flow Sunset</h4>
                  <p>Bienestar · Yoga · 18 €</p>
                </div>
                <span class="company-status-chip active">Activa</span>
              </div>

              <div class="company-service-item">
                <div class="company-service-info">
                  <h4>Meditación guiada</h4>
                  <p>Bienestar · Meditación · 15 €</p>
                </div>
                <span class="company-status-chip active">Activa</span>
              </div>

              <div class="company-service-item">
                <div class="company-service-info">
                  <h4>Sesión Relax Premium</h4>
                  <p>Bienestar · Relajación · 22 €</p>
                </div>
                <span class="company-status-chip draft">Borrador</span>
              </div>

            </div>
          </article>


        </section>

      </main>
    </div>
  </div>

</body>
</html>