<?php
require_once("head.php");
?>

    <div class="company-main">

      <header class="company-topbar">
        <div class="company-topbar-left">
          <span class="company-page-tag">Publicación</span>
          <h2>Añadir nuevo servicio</h2>
        </div>

        <div class="company-topbar-right">
          <a href="mis-servicios.html" class="company-back-link">Ver mis servicios</a>
        </div>
      </header>

      <main class="company-content">

        <section class="company-form-hero">
          <div>
            <h3>Publica una nueva actividad</h3>
            <p>
              Completa la información del servicio para que los usuarios puedan descubrirlo y reservarlo desde la plataforma.
            </p>
          </div>
        </section>

        <section class="company-form-card">
          <form action="#" method="post" enctype="multipart/form-data" class="company-service-form">

            <div class="form-grid">

              <div class="form-group">
                <label for="nombre">Nombre de la actividad</label>
                <input type="text" id="nombre" name="nombre" placeholder="Ej. Yoga Flow Sunset" required>
              </div>

              <div class="form-group">
                <label for="categoria">Categoría</label>
                <select id="categoria" name="categoria" required>
                  <option value="">Selecciona una categoría</option>
                  <option value="deporte">Deporte</option>
                  <option value="bienestar">Bienestar</option>
                </select>
              </div>

              <div class="form-group">
                <label for="subcategoria">Subcategoría</label>
                <select id="subcategoria" name="subcategoria" required>
                  <option value="">Selecciona una subcategoría</option>
                  <option value="yoga">Yoga</option>
                  <option value="pilates">Pilates</option>
                  <option value="spa">Spa</option>
                  <option value="meditacion">Meditación</option>
                  <option value="running">Running</option>
                  <option value="padel">Pádel</option>
                </select>
              </div>

              <div class="form-group">
                <label for="duracion">Duración</label>
                <input type="text" id="duracion" name="duracion" placeholder="Ej. 60 minutos" required>
              </div>

              <div class="form-group">
                <label for="ubicacion">Ubicación</label>
                <input type="text" id="ubicacion" name="ubicacion" placeholder="Ej. Madrid Centro" required>
              </div>

              <div class="form-group">
                <label for="precio">Precio (€)</label>
                <input type="number" id="precio" name="precio" placeholder="Ej. 18" min="0" step="0.01" required>
              </div>

              <div class="form-group">
                <label for="plazas">Plazas máximas</label>
                <input type="number" id="plazas" name="plazas" placeholder="Ej. 12" min="1" required>
              </div>

              <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="date" id="fecha" name="fecha" required>
              </div>

              <div class="form-group">
                <label for="hora_inicio">Hora inicio</label>
                <input type="time" id="hora_inicio" name="hora_inicio" required>
              </div>

              <div class="form-group">
                <label for="hora_fin">Hora fin</label>
                <input type="time" id="hora_fin" name="hora_fin" required>
              </div>

              <div class="form-group full-width">
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" rows="5" placeholder="Describe la actividad con detalle..." required></textarea>
              </div>

              <div class="form-group full-width">
                <label for="materiales">Materiales empleados</label>
                <textarea id="materiales" name="materiales" rows="3" placeholder="Ej. Esterilla, bloques, cinta elástica..."></textarea>
              </div>

              <div class="form-group full-width">
                <label for="imagen">Imagen principal</label>
                <input type="file" id="imagen" name="imagen" accept="image/*">
              </div>

            </div>

            <div class="form-actions">
              <button type="button" class="btn-secondary-company">Guardar borrador</button>
              <button type="submit" class="btn-primary-company">Publicar servicio</button>
            </div>

          </form>
        </section>

      </main>
    </div>
  </div>

</body>
</html>