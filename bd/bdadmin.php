<?php


class bdadmin{

public $pdo = "";

public function __construct($host,$port,$db,$user,$pass) { 
    $this->pdo = new PDO("mysql:host=".$host.";port=".$port.";dbname=".$db.";charset=utf8", $user, $pass);
    }

public function ObtenerSolicitudesPendientes(){

    $sentencia = "SELECT * 
                  FROM solicitud_empresa 
                  WHERE estado = 'pendiente'
                  ORDER BY fecha DESC";

    $ejecucion = $this->pdo->prepare($sentencia);
    $ejecucion->execute();

    return $ejecucion->fetchAll(PDO::FETCH_ASSOC);
}

public function ObtenerSolicitudEmpresaPorId($idSolicitud){

    $sentencia = "SELECT * 
                  FROM solicitud_empresa 
                  WHERE id_solicitud = :id";

    $ejecucion = $this->pdo->prepare($sentencia);
    $ejecucion->execute([
        ":id" => $idSolicitud
    ]);

    return $ejecucion->fetch(PDO::FETCH_ASSOC);
}

public function AprobarEmpresa($idSolicitud){

    try{
        $this->pdo->beginTransaction();

        $sentencia = "SELECT * FROM solicitud_empresa 
                      WHERE id_solicitud = :id 
                      AND estado = 'pendiente'";

        $ejecucion = $this->pdo->prepare($sentencia);
        $ejecucion->execute([":id" => $idSolicitud]);

        $solicitud = $ejecucion->fetch(PDO::FETCH_ASSOC);

        if($solicitud == false){
            $this->pdo->rollBack();
            return false;
        }

        $sentencia2 = "INSERT INTO empresa 
        (nombre_empresa, email, contrasena, direccion, telefono, ciudad_empresa, categoria_empresa, logo_empresa, descripcion_empresa)
        VALUES 
        (:nombre, :email, :contrasena, :direccion, :telefono, :ciudad, :categoria, :logo, :descripcion)";

        $ejecucion2 = $this->pdo->prepare($sentencia2);
        $ejecucion2->execute([
            ":nombre" => $solicitud["nombre"],
            ":email" => $solicitud["email"],
            ":contrasena" => $solicitud["contrasena"],
            ":direccion" => $solicitud["direccion"],
            ":telefono" => $solicitud["telefono"],
            ":ciudad" => $solicitud["ciudad_empresa"],
            ":categoria" => $solicitud["categoria_empresa"],
            ":logo" => $solicitud["logo_empresa"],
            ":descripcion" => $solicitud["datos"]
        ]);

        $idEmpresa = $this->pdo->lastInsertId();

        $sentencia3 = "UPDATE solicitud_empresa 
                      SET estado = 'aprobada', id_empresa = :id_empresa
                      WHERE id_solicitud = :id";

        $ejecucion3 = $this->pdo->prepare($sentencia3);
        $ejecucion3->execute([
            ":id_empresa" => $idEmpresa,
            ":id" => $idSolicitud
        ]);

        $this->pdo->commit();
        return true;

    }catch(Exception $e){
        $this->pdo->rollBack();
        return false;
    }
}

public function RechazarEmpresa($idSolicitud){

    $sentencia = "UPDATE solicitud_empresa 
                  SET estado = 'rechazada' 
                  WHERE id_solicitud = :id 
                  AND estado = 'pendiente'";

    $ejecucion = $this->pdo->prepare($sentencia);
    return $ejecucion->execute([
        ":id" => $idSolicitud
    ]);
}

public function ObtenerEmpresasAprobadas(){

    $sentencia = "SELECT 
                    e.*,
                    (
                        SELECT COUNT(*) 
                        FROM servicio s 
                        WHERE s.id_empresa = e.id_empresa
                    ) AS total_servicios
                  FROM empresa e
                  ORDER BY e.id_empresa DESC";

    $ejecucion = $this->pdo->prepare($sentencia);
    $ejecucion->execute();

    return $ejecucion->fetchAll(PDO::FETCH_ASSOC);
}

public function ObtenerTodasActividades(){

    $sentencia = "SELECT 
                    s.*,
                    e.nombre_empresa,
                    c.nombre AS subcategoria,
                    cp.nombre AS categoria_padre,
                    (
                        SELECT url_imagen 
                        FROM imagen_servicio i
                        WHERE i.id_servicio = s.id_servicio
                        LIMIT 1
                    ) AS imagen,
                    (
                        SELECT COUNT(*) 
                        FROM reserva r
                        WHERE r.id_servicio = s.id_servicio
                    ) AS total_reservas
                  FROM servicio s
                  INNER JOIN empresa e ON s.id_empresa = e.id_empresa
                  INNER JOIN categoria c ON s.id_categoria = c.id_categoria
                  LEFT JOIN categoria cp ON c.id_categoria_padre = cp.id_categoria
                  ORDER BY s.id_servicio DESC";

    $ejecucion = $this->pdo->prepare($sentencia);
    $ejecucion->execute();

    return $ejecucion->fetchAll(PDO::FETCH_ASSOC);
}

public function CancelarActividadAdmin($idServicio){

    $sentencia = "UPDATE servicio 
                  SET estado = 'cancelado'
                  WHERE id_servicio = :id_servicio";

    $ejecucion = $this->pdo->prepare($sentencia);
    return $ejecucion->execute([
        ":id_servicio" => $idServicio
    ]);
}

public function ActivarActividadAdmin($idServicio){

    $sentencia = "UPDATE servicio 
                  SET estado = 'activo'
                  WHERE id_servicio = :id_servicio";

    $ejecucion = $this->pdo->prepare($sentencia);
    return $ejecucion->execute([
        ":id_servicio" => $idServicio
    ]);
}

public function ObtenerUltimasSolicitudes(){
    $sentencia = "SELECT * FROM solicitud_empresa 
            WHERE estado = 'pendiente'
            ORDER BY fecha DESC
            LIMIT 3";

    $ejecucion = $this->pdo->prepare($sentencia);
    $ejecucion->execute();

    return $ejecucion->fetchAll(PDO::FETCH_ASSOC);
}

public function ObtenerUltimasActividades(){
    $sentencia = "SELECT s.*, e.nombre_empresa, c.nombre AS subcategoria, cp.nombre AS categoria_padre
            FROM servicio s
            INNER JOIN empresa e ON s.id_empresa = e.id_empresa
            INNER JOIN categoria c ON s.id_categoria = c.id_categoria
            LEFT JOIN categoria cp ON c.id_categoria_padre = cp.id_categoria
            ORDER BY s.id_servicio DESC
            LIMIT 3";

    $ejecucion = $this->pdo->prepare($sentencia);
    $ejecucion->execute();

    return $ejecucion->fetchAll(PDO::FETCH_ASSOC);
}

public function ObtenerDatosDashboard(){

    $datos = [];

    $consultas = [
        "pendientes" => "SELECT COUNT(*) FROM solicitud_empresa WHERE estado = 'pendiente'",

        "pendientes_hoy" => "SELECT COUNT(*) 
                             FROM solicitud_empresa 
                             WHERE estado = 'pendiente' 
                             AND DATE(fecha) = CURDATE()",

        "empresas" => "SELECT COUNT(*) FROM empresa",

        "empresas_mes" => "SELECT COUNT(*) 
                           FROM solicitud_empresa 
                           WHERE estado = 'aprobada'
                           AND MONTH(fecha) = MONTH(CURDATE())
                           AND YEAR(fecha) = YEAR(CURDATE())",

        "actividades" => "SELECT COUNT(*) FROM servicio",

        "actividades_canceladas" => "SELECT COUNT(*) 
                             FROM servicio 
                             WHERE estado = 'cancelado'",

        "usuarios" => "SELECT COUNT(*) FROM usuario",

        "usuarios_semana" => "SELECT COUNT(*) 
                              FROM usuario 
                              WHERE fecha_registro >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)"
    ];

    foreach($consultas as $clave => $sentencia){
        $ejecucion = $this->pdo->prepare($sentencia);
        $ejecucion->execute();
        $datos[$clave] = $ejecucion->fetchColumn();
    }

    return $datos;
}

public function SuspenderUsuario($idUsuario){

    $sentencia = "UPDATE usuario 
            SET estado = 'suspendido'
            WHERE id_usuario = :id
            AND id_rol != 3";

    $ejecucion = $this->pdo->prepare($sentencia);
    return $ejecucion->execute([":id" => $idUsuario]);
}

public function ActivarUsuario($idUsuario){

    $sentencia = "UPDATE usuario 
            SET estado = 'activo'
            WHERE id_usuario = :id";

    $ejecucion = $this->pdo->prepare($sentencia);
    return $ejecucion->execute([":id" => $idUsuario]);
}

public function ObtenerDatosUsuariosAdmin(){

    $datos = [];

    $consultas = [
        "total" => "SELECT COUNT(*) FROM usuario",
        "activos" => "SELECT COUNT(*) FROM usuario WHERE estado = 'activo'",
        "suspendidos" => "SELECT COUNT(*) FROM usuario WHERE estado = 'suspendido'",
        "nuevos_hoy" => "SELECT COUNT(*) FROM usuario WHERE DATE(fecha_registro) = CURDATE()",
        "nuevos_semana" => "SELECT COUNT(*) FROM usuario WHERE fecha_registro >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)",
        "con_reservas" => "SELECT COUNT(DISTINCT id_usuario) FROM reserva"
    ];

    foreach($consultas as $clave => $sql){
        $ejecucion = $this->pdo->prepare($sql);
        $ejecucion->execute();
        $datos[$clave] = $ejecucion->fetchColumn();
    }

    return $datos;
}

public function ObtenerUsuariosAdmin(){

    $sentencia = "SELECT 
                    u.*,

                    (
                        SELECT COUNT(*) 
                        FROM reserva r
                        WHERE r.id_usuario = u.id_usuario
                    ) AS total_reservas,

                    (
                        SELECT COUNT(*) 
                        FROM resena rs
                        WHERE rs.id_usuario = u.id_usuario
                    ) AS total_resenas

                  FROM usuario u
                  ORDER BY u.fecha_registro DESC";

    $ejecucion = $this->pdo->prepare($sentencia);
    $ejecucion->execute();

    return $ejecucion->fetchAll(PDO::FETCH_ASSOC);
}

public function ObtenerReservasUsuarioAdmin($idUsuario){

    $sentencia = "SELECT 
                    r.*,
                    s.nombre_servicio,
                    s.lugar,
                    u.nombre,
                    u.apellido,
                    u.email,
                    d.fecha,
                    d.hora_inicio,
                    d.hora_fin
                  FROM reserva r
                  INNER JOIN usuario u ON r.id_usuario = u.id_usuario
                  INNER JOIN servicio s ON r.id_servicio = s.id_servicio
                  LEFT JOIN detalle_actividad d ON r.id_detalle_actividad = d.id
                  WHERE r.id_usuario = :id_usuario
                  ORDER BY r.fecha_hora DESC";

    $ejecucion = $this->pdo->prepare($sentencia);
    $ejecucion->execute([
        ":id_usuario" => $idUsuario
    ]);

    return $ejecucion->fetchAll(PDO::FETCH_ASSOC);
}



}