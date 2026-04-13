<?php
require_once("head.php");
?>

    <div class="company-main">

      <header class="company-topbar">
        <div class="company-topbar-left">
          <span class="company-page-tag">Configuración</span>
          <h2>Perfil empresa</h2>
        </div>
      </header>

      <main class="company-content">

        <section class="company-profile-hero">
          <div class="company-profile-brand">
            <img src="../assets/empresa-zen.jpg" alt="Zen Balance Studio" class="company-profile-logo">
            <div>
              <span class="company-section-badge">Empresa activa</span>
              <h3>Zen Balance Studio</h3>
              <p>Bienestar · Madrid</p>
            </div>
          </div>
        </section>

        <section class="company-profile-card">
          <form action="#" method="post" enctype="multipart/form-data" class="company-profile-form">

            <div class="form-grid">

              <div class="form-group">
                <label for="nombre_empresa">Nombre de la empresa</label>
                <input type="text" id="nombre_empresa" name="nombre_empresa" value="Zen Balance Studio" required>
              </div>

              <div class="form-group">
                <label for="categoria_principal">Categoría principal</label>
                <select id="categoria_principal" name="categoria_principal" required>
                  <option value="bienestar" selected>Bienestar</option>
                  <option value="deporte">Deporte</option>
                </select>
              </div>

              <div class="form-group">
                <label for="email_empresa">Correo electrónico</label>
                <input type="email" id="email_empresa" name="email_empresa" value="info@zenbalance.com" required>
              </div>

              <div class="form-group">
                <label for="telefono_empresa">Teléfono</label>
                <input type="text" id="telefono_empresa" name="telefono_empresa" value="611222333" required>
              </div>

              <div class="form-group">
                <label for="ciudad_empresa">Ciudad</label>
                <input type="text" id="ciudad_empresa" name="ciudad_empresa" value="Madrid" required>
              </div>

              <div class="form-group">
                <label for="direccion_empresa">Dirección</label>
                <input type="text" id="direccion_empresa" name="direccion_empresa" value="Calle Ejemplo, 24" required>
              </div>

              <div class="form-group full-width">
                <label for="descripcion_empresa">Descripción de la empresa</label>
                <textarea id="descripcion_empresa" name="descripcion_empresa" rows="5" required>Centro especializado en yoga, meditación y actividades de bienestar enfocadas en el equilibrio físico y mental.</textarea>
              </div>

              <div class="form-group">
                <label for="web_empresa">Página web</label>
                <input type="text" id="web_empresa" name="web_empresa" value="www.zenbalance.com">
              </div>

              <div class="form-group">
                <label for="instagram_empresa">Instagram</label>
                <input type="text" id="instagram_empresa" name="instagram_empresa" value="@zenbalance.studio">
              </div>

              <div class="form-group full-width">
                <label for="logo_empresa">Actualizar logo o imagen</label>
                <input type="file" id="logo_empresa" name="logo_empresa" accept="image/*">
              </div>

            </div>

            <div class="form-actions">
              <button type="submit" class="btn-primary-company">Guardar cambios</button>
            </div>

          </form>
        </section>

      </main>
    </div>
  </div>

</body>
</html>