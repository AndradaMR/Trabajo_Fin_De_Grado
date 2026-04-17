<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Body and Soul | Acceso administrador</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Overpass:wght@300;400;500;600;700&family=Sansita:wght@700;800;900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="../css/styles.css">
  <link rel="stylesheet" href="../css/admin-styles/admin-login.css">
   <link rel="stylesheet" href="../css/admin-styles/admin-dashboard.css">
  <link rel="stylesheet" href="../css/admin-styles/crear-categoria.css">
</head>

<body class="admin-dashboard-body">

<div class="admin-layout">

<!-- SIDEBAR -->

    <aside class="admin-sidebar">

    <div class="admin-sidebar-top">
    <img src="../img/logo.PNG" class="admin-sidebar-logo">
        <h1 style="color: white;">Admin</h1>
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

  <main class="admin-login-page">
    <section class="admin-login-section">
      <div class="admin-login-wrapper">

        <div class="admin-login-card">
          <div class="admin-login-glow"></div>

          <div class="admin-login-header">
            <h1>Crear categorías y subcategorias</h1>
          </div>

         <div class="admin-form-card">

        <div class="admin-form-header">
            <p>Crea una categoría principal o una subcategoría para organizar las actividades.</p>
        </div>

        <form action="#" method="post" class="admin-category-form">

            <div class="form-group">
            <label for="nombre_categoria">Nombre de la categoría</label>
            <input
                type="text"
                id="nombre_categoria"
                name="nombre_categoria"
                placeholder="Ej: Yoga, Running, Spa..."
                required
            >
            </div>

            <div class="form-group">
            <label for="tipo_categoria">Jerarquía</label>
            <select id="tipo_categoria" name="tipo_categoria" required>
                <option value="">Selecciona una opción</option>
                <option value="categoria">Categoría principal</option>
                <option value="subcategoria">Subcategoría</option>
            </select>
            </div>

            <div class="form-group" id="grupo_categoria_padre">
            <label for="categoria_padre">Categoría padre</label>
            <select id="categoria_padre" name="categoria_padre">
                <option value="">Selecciona la categoría padre</option>
                <option value="deporte">Deporte</option>
                <option value="bienestar">Bienestar</option>
            </select>
            </div>

            <button type="submit" class="btn-submit-category">
            Guardar categoría
            </button>

        </form>


      </div>
    </section>
  </main>

</body>
</html>
