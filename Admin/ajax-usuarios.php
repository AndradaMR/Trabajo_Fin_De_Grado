<?php
require_once("../bd/bdadmin.php");

$bdadmin = new bdadmin("localhost", 3306, "plataforma_servicios1", "root", "");

$buscar = trim($_GET["buscar"] ?? "");
$tipo = trim($_GET["tipo"] ?? "");
$estadoFiltro = trim($_GET["estado"] ?? "");

$usuarios = $bdadmin->ObtenerUsuariosAdmin($buscar, $tipo, $estadoFiltro);

if(count($usuarios) > 0){

    foreach($usuarios as $usuario){

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

        <?php
    }

}else{
    ?>

    <article class="admin-user-card">
      <div class="admin-user-content">
        <h3 class="admin-user-name">No hay usuarios</h3>
        <p class="admin-user-description">
          No se han encontrado usuarios con los filtros seleccionados.
        </p>
      </div>
    </article>

    <?php
}
?>