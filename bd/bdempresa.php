<?php


class bdempresa{

public $pdo = "";

public function __construct($host,$port,$db,$user,$pass) { 
    $this->pdo = new PDO("mysql:host=".$host.";port=".$port.";dbname=".$db.";charset=utf8", $user, $pass);
    }

public function ComprobarLoginEmpresa($email, $contraseña){

    $sentencia = "SELECT * FROM empresa WHERE email = :email LIMIT 1";
    $ejecuccion = $this->pdo->prepare($sentencia);
    $ejecuccion->execute([
        ":email" => $email
    ]);

    $fila = $ejecuccion->fetch(PDO::FETCH_ASSOC);

    //Si no saca resultados es que no existe
    if($fila == false){
        return "empresanoexiste";
    }else{

        $contrabuena = $fila["contrasena"];
        //compruebo que la contraseña es la adecuada con pasword verify y devuelvo el id
        if(password_verify($contraseña, $contrabuena) == true){
            
            return $fila["id_empresa"]; 
        
        }
    }
}


//Esto lo hará el administrador
public function AprobarEmpresa($idSolicitud){

    try{
        $this->pdo->beginTransaction();

        $sentencia = "SELECT * FROM solicitud_empresa 
                      WHERE id_solicitud = :id_solicitud 
                      AND estado = 'pendiente'";

        $ejecucion = $this->pdo->prepare($sentencia);
        $ejecucion->execute([
            ":id_solicitud" => $idSolicitud
        ]);

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

        $idEmpresaNueva = $this->pdo->lastInsertId();

        $sentencia3 = "UPDATE solicitud_empresa
                       SET estado = 'aprobada', id_empresa = :id_empresa
                       WHERE id_solicitud = :id_solicitud";

        $ejecucion3 = $this->pdo->prepare($sentencia3);
        $ejecucion3->execute([
            ":id_empresa" => $idEmpresaNueva,
            ":id_solicitud" => $idSolicitud
        ]);

        $this->pdo->commit();
        return true;

    }catch(PDOException $e){
        $this->pdo->rollBack();
        return false;
    }
}

public function RechazarEmpresa($idSolicitud){

    $sentencia = "UPDATE solicitud_empresa 
                  SET estado = 'rechazada' 
                  WHERE id_solicitud = :id";

    $ejecucion = $this->pdo->prepare($sentencia);
    $ejecucion->execute([
        ":id" => $idSolicitud
    ]);
}

public function ExisteEmpresa($email){

    $sentencia = "SELECT * FROM empresa WHERE email = :email LIMIT 1";
    $ejecuccion = $this->pdo->prepare($sentencia);
    $ejecuccion->execute([
        ":email" => $email
    ]);

    $fila = $ejecuccion->fetch(PDO::FETCH_ASSOC);

    if($fila == false){
        return false;
    }else{
        return true;
    }
}

public function RegistrarSolicitudEmpresa($nombre, $email, $logo, $ciudad, $telefono, $direccion, $contrasena, $categoria, $descripcion){

    $contraCifrada = password_hash($contrasena, PASSWORD_DEFAULT);

    $sentencia = "INSERT INTO solicitud_empresa 
    (nombre, email, logo_empresa, ciudad_empresa, telefono, direccion, contrasena, categoria_empresa, datos)
    VALUES 
    (:nombre, :email, :logo, :ciudad, :telefono, :direccion, :contra, :categoria, :datos)";

    $ejecucion = $this->pdo->prepare($sentencia);

    $ejecucion->execute([
        ":nombre" => $nombre,
        ":email" => $email,
        ":logo" => $logo,
        ":ciudad" => $ciudad,
        ":telefono" => $telefono,
        ":direccion" => $direccion,
        ":contra" => $contraCifrada,
        ":categoria" => $categoria,
        "datos" => $descripcion
    ]);
}

public function ObtenerSolicitudEmpresaPorId($idSolicitud){

    $sentencia = "SELECT * FROM solicitud_empresa WHERE id_solicitud = :id";
    $ejecucion = $this->pdo->prepare($sentencia);
    $ejecucion->execute([
        ":id" => $idSolicitud
    ]);

    return $ejecucion->fetch(PDO::FETCH_ASSOC);
}

public function ModificarPerfilEmpresa($idEmpresa, $nombre, $categoria, $telefono, $ciudad, $direccion, $descripcion, $logo){

    $sentencia = "UPDATE empresa 
                  SET nombre_empresa = :nombre,
                      categoria_empresa = :categoria,
                      telefono = :telefono,
                      ciudad_empresa = :ciudad,
                      direccion = :direccion,
                      descripcion_empresa = :descripcion,
                      logo_empresa = :logo
                  WHERE id_empresa = :idEmpresa";

    $ejecucion = $this->pdo->prepare($sentencia);

    $ejecucion->execute([
        ":nombre" => $nombre,
        ":categoria" => $categoria,
        ":telefono" => $telefono,
        ":ciudad" => $ciudad,
        ":direccion" => $direccion,
        ":descripcion" => $descripcion,
        ":logo" => $logo,
        ":idEmpresa" => $idEmpresa
    ]);
}


public function sacardatosempresa($idEmpresa){

    $sentencia = "SELECT * FROM empresa WHERE id_empresa = :id LIMIT 1";
    $ejecucion = $this->pdo->prepare($sentencia);

    $ejecucion->execute([
        ":id" => $idEmpresa
    ]);

    $empresa = $ejecucion->fetch(PDO::FETCH_ASSOC);

    return $empresa;
}

public function ObtenerActividadesPorEmpresa($idEmpresa){

    $sentencia = "SELECT * 
                  FROM servicio 
                  WHERE id_empresa = :idEmpresa";

    $ejecucion = $this->pdo->prepare($sentencia);

    $ejecucion->execute([
        ":idEmpresa" => $idEmpresa
    ]);

    $actividades = $ejecucion->fetchAll(PDO::FETCH_ASSOC);

    return $actividades;
}


public function ObtenerServiciosEmpresa($idEmpresa){

    $sentencia = "SELECT 
                    s.*,
                    c.nombre AS subcategoria,
                    cp.nombre AS categoria_padre,

                    (
                        SELECT i.url_imagen 
                        FROM imagen_servicio i
                        WHERE i.id_servicio = s.id_servicio
                        LIMIT 1
                    ) AS imagen,

                    (
                        SELECT COUNT(*) 
                        FROM detalle_actividad d
                        WHERE d.id_servicio = s.id_servicio
                    ) AS total_sesiones

                  FROM servicio s
                  INNER JOIN categoria c 
                    ON s.id_categoria = c.id_categoria
                  LEFT JOIN categoria cp 
                    ON c.id_categoria_padre = cp.id_categoria
                  WHERE s.id_empresa = :idEmpresa
                  ORDER BY s.id_servicio DESC";

    $ejecucion = $this->pdo->prepare($sentencia);

    $ejecucion->execute([
        ":idEmpresa" => $idEmpresa
    ]);

    return $ejecucion->fetchAll(PDO::FETCH_ASSOC);
}

public function ObtenerSubcategoriasEmpresa($idEmpresa){

    $sentencia = "SELECT DISTINCT c.id_categoria, c.nombre
                  FROM servicio s
                  INNER JOIN categoria c ON s.id_categoria = c.id_categoria
                  WHERE s.id_empresa = :idEmpresa";

    $ejecucion = $this->pdo->prepare($sentencia);

    $ejecucion->execute([
        ":idEmpresa" => $idEmpresa
    ]);

    $subcategorias = $ejecucion->fetchAll(PDO::FETCH_ASSOC);

    return $subcategorias;
}

public function ObtenerReservasEmpresa($idempresa){

    $sentencia = "SELECT 
                    r.id_reserva,
                    r.fecha_hora,
                    r.estado,
                    r.id_detalle_actividad,

                    u.nombre AS nombre_usuario,
                    u.apellido AS apellido_usuario,
                    u.email AS email_usuario,

                    s.id_servicio,
                    s.nombre_servicio,
                    s.descripcion,
                    s.lugar,

                    c.nombre AS subcategoria,
                    cp.nombre AS categoria_padre

                  FROM reserva r
                  INNER JOIN usuario u ON r.id_usuario = u.id_usuario
                  INNER JOIN servicio s ON r.id_servicio = s.id_servicio
                  INNER JOIN categoria c ON s.id_categoria = c.id_categoria
                  LEFT JOIN categoria cp ON c.id_categoria_padre = cp.id_categoria

                  WHERE s.id_empresa = :idEmpresa
                  ORDER BY r.fecha_hora DESC";

    $ejecucion = $this->pdo->prepare($sentencia);

    $ejecucion->execute([
        ":idEmpresa" => $idempresa
    ]);

    return $ejecucion->fetchAll(PDO::FETCH_ASSOC);
}

public function CancelarServicioEmpresa($idServicio, $idEmpresa){

    try{
        $this->pdo->beginTransaction();

        // Cancelar el servicio
        $sentencia = "UPDATE servicio
                      SET estado = 'cancelado'
                      WHERE id_servicio = :idServicio
                      AND id_empresa = :idEmpresa";

        $ejecucion = $this->pdo->prepare($sentencia);
        $ejecucion->execute([
            ":idServicio" => $idServicio,
            ":idEmpresa" => $idEmpresa
        ]);

        // Cancelar todas las reservas confirmadas de ese servicio
        $sentencia = "UPDATE reserva
                      SET estado = 'cancelada'
                      WHERE id_servicio = :idServicio
                      AND estado = 'confirmada'";

        $ejecucion = $this->pdo->prepare($sentencia);
        $ejecucion->execute([
            ":idServicio" => $idServicio
        ]);

        $this->pdo->commit();

        return true;

    }catch(Exception $e){
        $this->pdo->rollBack();
        return false;
    }
}

}

?>