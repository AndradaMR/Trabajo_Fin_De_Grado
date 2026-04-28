<?php
require_once("head.php");
?>

    <div class="company-main">

      <header class="company-topbar">
        <div class="company-topbar-left">
          <span class="company-page-tag">Edición</span>
          <h2>Editar servicio</h2>
        </div>

        <div class="company-topbar-right">
          <a href="mis-servicios.php" class="company-back-link">Volver a mis servicios</a>
        </div>
      </header>

      <main class="company-content">

        <section class="company-form-hero">
          <div>
            <span class="company-section-badge">Servicio existente</span>
            <h3>Actualiza la información de tu actividad</h3>
            <p>
              Modifica los datos del servicio para mantener la información actualizada y mejorar la experiencia de reserva.
            </p>
          </div>
        </section>

        <section class="company-form-card">
          <form action="#" method="post" enctype="multipart/form-data" class="company-service-form">

            <div class="form-grid">

              <div class="form-group">
                <label for="nombre">Nombre de la actividad</label>
                <input type="text" id="nombre" name="nombre" value="Yoga Flow Sunset" required>
              </div>

              <div class="form-group">
                <label for="categoria">Categoría</label>
                <select id="categoria" name="categoria" required>
                  <option value="">Selecciona una categoría</option>
                  <option value="deporte">Deporte</option>
                  <option value="bienestar" selected>Bienestar</option>
                </select>
              </div>

              <div class="form-group">
                <label for="subcategoria">Subcategoría</label>
                <select id="subcategoria" name="subcategoria" required>
                  <option value="">Selecciona una subcategoría</option>
                  <option value="yoga" selected>Yoga</option>
                  <option value="pilates">Pilates</option>
                  <option value="spa">Spa</option>
                  <option value="meditacion">Meditación</option>
                </select>
              </div>

              <div class="form-group">
                <label for="duracion">Duración</label>
                <input type="text" id="duracion" name="duracion" value="60 minutos" required>
              </div>

              <div class="form-group">
                <label for="ubicacion">Ubicación</label>
                <input type="text" id="ubicacion" name="ubicacion" value="Madrid Centro" required>
              </div>

              <div class="form-group">
                <label for="precio">Precio (€)</label>
                <input type="number" id="precio" name="precio" value="18" min="0" step="0.01" required>
              </div>

              <div class="form-group">
                <label for="plazas">Plazas máximas</label>
                <input type="number" id="plazas" name="plazas" value="12" min="1" required>
              </div>

              <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="date" id="fecha" name="fecha" value="2026-04-15" required>
              </div>

              <div class="form-group">
                <label for="hora_inicio">Hora inicio</label>
                <input type="time" id="hora_inicio" name="hora_inicio" value="18:00" required>
              </div>

              <div class="form-group">
                <label for="hora_fin">Hora fin</label>
                <input type="time" id="hora_fin" name="hora_fin" value="19:00" required>
              </div>

              <div class="form-group full-width">
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" rows="5" required>Clase de yoga guiada al atardecer centrada en respiración, movilidad y relajación final en un ambiente tranquilo y acogedor.</textarea>
              </div>

              <div class="form-group full-width">
                <label for="materiales">Materiales empleados</label>
                <textarea id="materiales" name="materiales" rows="3">Esterilla, bloque de yoga y manta ligera.</textarea>
              </div>

              <div class="form-group full-width">
                <label for="imagen">Actualizar imagen principal</label>
                <input type="file" id="imagen" name="imagen" accept="image/*">
              </div>

            </div>

            <div class="form-actions">
              <button type="button" class="btn-warning">Desactivar servicio</button>
              <button type="submit" class="btn-primary-company">Guardar cambios</button>
            </div>

          </form>
        </section>

      </main>
    </div>
  </div>

</body>
</html>