<?php

$paginaActiva = "usuarios";
$tituloPagina = "Usuarios registrados";
$etiquetaPagina = "Gestión de usuarios";
$cssExtra = [
    "../css/admin-styles/usuarios.css"
];

require_once("head-admin.php");

if(isset($_GET["suspender"])){
    $idUsuario = (int) $_GET["suspender"];
    $bdadmin->SuspenderUsuario($idUsuario);

    header("Location: usuarios.php");
    exit();
}

if(isset($_GET["activar"])){
    $idUsuario = (int) $_GET["activar"];
    $bdadmin->ActivarUsuario($idUsuario);

    header("Location: usuarios.php");
    exit();
}

$usuarios = $bdadmin->ObtenerUsuariosAdmin();
$datosUsuarios = $bdadmin->ObtenerDatosUsuariosAdmin();
?>

<main class="admin-content">

  <section class="admin-hero-card">
    <div class="admin-hero-text">
      <span class="section-badge">Control</span>
      <h3>Gestión de usuarios de la plataforma</h3>
      <p>
        Consulta los usuarios registrados, revisa su actividad y gestiona su estado dentro del sistema.
      </p>
    </div>

    <div class="admin-hero-stat">
      <span class="admin-hero-number"><?= $datosUsuarios["activos"] ?></span>
      <span class="admin-hero-label">Usuarios activos</span>
    </div>
  </section>

  <section class="admin-stats-grid">
    <article class="admin-stat-card">
      <h4>Usuarios activos</h4>
      <strong><?= $datosUsuarios["activos"] ?></strong>
      <p>Cuentas habilitadas</p>
    </article>

    <article class="admin-stat-card">
      <h4>Nuevos registros</h4>
      <strong><?= $datosUsuarios["nuevos_hoy"] ?></strong>
      <p>Hoy</p>
    </article>

    <article class="admin-stat-card">
      <h4>Usuarios con reservas</h4>
      <strong><?= $datosUsuarios["con_reservas"] ?></strong>
      <p>Han realizado al menos una reserva</p>
    </article>

    <article class="admin-stat-card">
      <h4>Cuentas suspendidas</h4>
      <strong><?= $datosUsuarios["suspendidos"] ?></strong>
      <p>Requieren revisión</p>
    </article>
  </section>

  <section class="admin-filters-box">
    <form class="admin-filters-form" action="" method="get">
      <div class="admin-search-wrap">
        <input
          type="text"
          name="buscar_usuario"
          class="admin-search-input"
          placeholder="Buscar usuario o email"
        >
      </div>

      <select name="tipo_usuario" class="admin-filter-select">
        <option value="">Todos los tipos</option>
        <option value="cliente">Clientes</option>
        <option value="admin">Administradores</option>
      </select>

      <select name="estado_usuario" class="admin-filter-select">
        <option value="">Todos los estados</option>
        <option value="activo">Activo</option>
        <option value="suspendido">Suspendido</option>
      </select>
    </form>
  </section>

  <section class="admin-users-list">

    <?php if(count($usuarios) > 0): ?>

      <?php foreach($usuarios as $usuario): ?>

        <?php
          $nombreCompleto = trim($usuario["nombre"] . " " . $usuario["apellido"]);
          $inicial = strtoupper(substr($usuario["nombre"], 0, 1));
          $estado = $usuario["estado"] ?? "activo";

          if($usuario["id_rol"] == 3){
              $rolTexto = "Administrador";
          }else{
              $rolTexto = "Cliente";
          }

          if($estado == "activo"){
              $estadoClase = "status-active";
              $estadoTexto = "Activo";
          }else{
              $estadoClase = "status-blocked";
              $estadoTexto = "Suspendido";
          }
        ?>

        <article class="admin-user-card">
          <div class="admin-user-left">
            <div class="admin-user-avatar"><?= htmlspecialchars($inicial) ?></div>
          </div>

          <div class="admin-user-content">
            <div class="admin-user-topline">
              <span class="admin-user-role"><?= $rolTexto ?></span>

              <span class="admin-user-status <?= $estadoClase ?>">
                <?= $estadoTexto ?>
              </span>
            </div>

            <h3 class="admin-user-name"><?= htmlspecialchars($nombreCompleto) ?></h3>

            <p class="admin-user-meta">
              <?= htmlspecialchars($usuario["email"]) ?>
            </p>

            <p class="admin-user-description">
              Usuario registrado en la plataforma Body and Soul.
            </p>

            <div class="admin-user-data-grid">
              <div class="admin-user-data-box">
                <span class="data-label">Fecha alta</span>
                <strong><?= date("d/m/Y", strtotime($usuario["fecha_registro"])) ?></strong>
              </div>

              <div class="admin-user-data-box">
                <span class="data-label">Reservas</span>
                <strong><?= $usuario["total_reservas"] ?></strong>
              </div>

              <div class="admin-user-data-box">
                <span class="data-label">Rol</span>
                <strong><?= $rolTexto ?></strong>
              </div>

              <div class="admin-user-data-box">
                <span class="data-label">Valoraciones</span>
                <strong><?= $usuario["total_resenas"] ?></strong>
              </div>
            </div>
          </div>

          <div class="admin-user-actions">
            <a href="reservas-usuario.php?id=<?= $usuario["id_usuario"] ?>" class="btn-admin btn-primary">
              Ver reservas
            </a>

            <?php if($usuario["id_rol"] != 3): ?>

              <?php if($estado == "activo"): ?>
                <a href="usuarios.php?suspender=<?= $usuario["id_usuario"] ?>" 
                   class="btn-admin btn-warning"
                   onclick="return confirm('¿Suspender este usuario?');">
                  Suspender
                </a>
              <?php else: ?>
                <a href="usuarios.php?activar=<?= $usuario["id_usuario"] ?>" 
                   class="btn-admin btn-success"
                   onclick="return confirm('¿Reactivar este usuario?');">
                  Reactivar
                </a>
              <?php endif; ?>

            <?php endif; ?>
          </div>
        </article>

      <?php endforeach; ?>

    <?php else: ?>

      <article class="admin-user-card">
        <div class="admin-user-content">
          <h3 class="admin-user-name">No hay usuarios registrados</h3>
          <p class="admin-user-description">
            Todavía no existen usuarios dados de alta en la plataforma.
          </p>
        </div>
      </article>

    <?php endif; ?>

  </section>

</main>

</div>
</div>

</body>
</html>