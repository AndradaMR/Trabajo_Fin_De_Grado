<?php

class bdact{

public $pdo = "";

public function __construct($host,$port,$db,$user,$pass) { 
    $this->pdo = new PDO("mysql:host=".$host.";port=".$port.";dbname=".$db.";charset=utf8", $user, $pass);
    }

function obtenerCategoriasPadre() {
    $sentencia = "SELECT * FROM categoria WHERE id_categoria_padre IS NULL
            ORDER BY nombre ASC";

    $ejecuccion = $this->pdo->prepare($sentencia);
    $ejecuccion->execute();

    $fila=$ejecuccion->fetchAll(PDO::FETCH_ASSOC);
    return $fila;
}


function obtenerSubcategoriasPorId($idCategoriaPadre) {
    $sentencia = "SELECT * FROM categoria WHERE id_categoria_padre = :id_categoria_padre";

    $ejecuccion = $this->pdo->prepare($sentencia);
    $ejecuccion->execute([
        ":id_categoria_padre" => $idCategoriaPadre
    ]);

    return $ejecuccion->fetch(PDO::FETCH_ASSOC);
}

public function obteneridcat($nombrecat){

    $sentencia = "SELECT id_categoria FROM categoria WHERE nombre = :nombre";

    $ejecuccion = $this->pdo->prepare($sentencia);
    $ejecuccion->execute([
        ":nombre" => $nombrecat
    ]);

    $fila=$ejecuccion->fetch(PDO::FETCH_ASSOC);
    return $fila["id_categoria"];

}

//AUN NO SE USA tiene en cuenta si la cat es padre(ver como hacer con la descripcion de las cathijo)
//Debe obtener la descripcion de las categorias padre
function obtenerdescripcioncat($idcat) {
    $sentencia = "SELECT descripcion FROM categoria WHERE id_categoria = :id_categoria_padre";

    $ejecuccion = $this->pdo->prepare($sentencia);
    $ejecuccion->execute([
        ":id_categoria" => $idcat
    ]);

    $fila=$ejecuccion->fetch(PDO::FETCH_ASSOC);
    return $fila["descripcion"];
}

//Obtiene todas las subcategorias de la categoria padre dada
public function obtenerSubcat($idcatpadre){

    $sentencia = "SELECT * FROM categoria WHERE id_categoria_padre = :idcatpadre ORDER BY nombre ASC";

    $ejecuccion = $this->pdo->prepare($sentencia);
    $ejecuccion->execute([
        ":idcatpadre" => $idcatpadre
    ]);

    $fila=$ejecuccion->fetchAll(PDO::FETCH_ASSOC);
    return $fila;    

}

//Obteine las actividades de una subcategoria concreta
public function obteneractividades($idcat){

    $sentencia = "SELECT * FROM servicio WHERE id_categoria = :idcat";

    $ejecuccion = $this->pdo->prepare($sentencia);
    $ejecuccion->execute([
        ":idcat" => $idcat
    ]);

    $fila=$ejecuccion->fetchAll(PDO::FETCH_ASSOC);
    return $fila;

}

public function obtenerActividadesMasReservadas(){
    $sentencia = "SELECT 
                    s.id_servicio,
                    s.nombre_servicio,
                    s.descripcion,
                    s.lugar,
                    s.precio,
                    s.id_categoria,
                    MIN(i.url_imagen) AS imagen,
                    COUNT(r.id_reserva) AS total_reservas
                  FROM servicio s
                  INNER JOIN reserva r ON s.id_servicio = r.id_servicio
                  LEFT JOIN imagen_servicio i ON s.id_servicio = i.id_servicio
                  WHERE r.estado = 'confirmada'
                  GROUP BY 
                    s.id_servicio,
                    s.nombre_servicio,
                    s.descripcion,
                    s.lugar,
                    s.precio,
                    s.id_categoria
                  ORDER BY total_reservas DESC";

    $ejecucion = $this->pdo->prepare($sentencia);
    $ejecucion->execute();
    return $ejecucion->fetchAll(PDO::FETCH_ASSOC);
}

//Aplicar filtros
public function filtrarActividades($buscador = "", $categoria = "", $subcategoria = "", $precio = ""){
    $sql = "SELECT s.*
            FROM servicio s
            INNER JOIN categoria c ON s.id_categoria = c.id_categoria
            LEFT JOIN categoria cp ON c.id_categoria_padre = cp.id_categoria";

    $condiciones = [];
    $parametros = [];

    if (!empty($buscador)) {
        $condiciones[] = "(s.nombre_servicio LIKE :buscador 
                        OR s.descripcion LIKE :buscador 
                        OR s.lugar LIKE :buscador)";
        $parametros[":buscador"] = "%" . $buscador . "%";
    }

    if (!empty($subcategoria)) {
        $condiciones[] = "s.id_categoria = :subcategoria";
        $parametros[":subcategoria"] = $subcategoria;
    } elseif (!empty($categoria)) {
        $condiciones[] = "cp.nombre = :categoria";
        $parametros[":categoria"] = $categoria;
    }

    if (!empty($precio)) {
        if ($precio == "0-10") {
            $condiciones[] = "s.precio BETWEEN 0 AND 10";
        } elseif ($precio == "10-25") {
            $condiciones[] = "s.precio BETWEEN 10 AND 25";
        } elseif ($precio == "25-50") {
            $condiciones[] = "s.precio BETWEEN 25 AND 50";
        } elseif ($precio == "50+") {
            $condiciones[] = "s.precio > 50";
        }
    }

    if (!empty($condiciones)) {
        $sql .= " WHERE " . implode(" AND ", $condiciones);
    }

    $sql .= " ORDER BY s.nombre_servicio ASC";

    $ejecucion = $this->pdo->prepare($sql);
    $ejecucion->execute($parametros);

    return $ejecucion->fetchAll(PDO::FETCH_ASSOC);
}

public function obtenerActividadPorId($idServicio){
    $sentencia = "SELECT * FROM servicio WHERE id_servicio = :id_servicio";
    $ejecucion = $this->pdo->prepare($sentencia);
    $ejecucion->execute([
        ":id_servicio" => $idServicio
    ]);
    $fila = $ejecucion->fetch(PDO::FETCH_ASSOC);
    return $fila;
}

public function obtenerDisponibilidadesPorServicio($idServicio){
    $sentencia = "SELECT *
            FROM detalle_actividad
            WHERE id_servicio = :id_servicio
            ORDER BY fecha ASC, hora_inicio ASC";

    $ejecucion = $this->pdo->prepare($sentencia);
    $ejecucion->execute([
        ":id_servicio" => $idServicio
    ]);
    $fila = $ejecucion->fetchAll(PDO::FETCH_ASSOC);
    return $fila;
}

public function obtenerDetalleActividadPorId($idDetalle){
    $sentencia = "SELECT * FROM detalle_actividad WHERE id = :id";
    $ejecucion = $this->pdo->prepare($sentencia);
    $ejecucion->execute([
        ":id" => $idDetalle
    ]);
    $fila = $ejecucion->fetch(PDO::FETCH_ASSOC);
    return $fila;
}

public function contarReservasConfirmadasPorDetalle($idDetalle){
    $sentencia = "SELECT COUNT(*) 
            FROM reserva
            WHERE id_detalle_actividad = :id_detalle
              AND estado = 'confirmada'";
    $ejecucion = $this->pdo->prepare($sentencia);
    $ejecucion->execute([
        ":id_detalle" => $idDetalle
    ]);
    $fila = (int) $ejecucion->fetchColumn();
    return $fila;
}

public function usuarioYaReservoEsaFranja($idUsuario, $idDetalle){
    $sentencia = "SELECT COUNT(*)
            FROM reserva
            WHERE id_usuario = :id_usuario
              AND id_detalle_actividad = :id_detalle
              AND estado = 'confirmada'";
    $ejecucion = $this->pdo->prepare($sentencia);
    $ejecucion->execute([
        ":id_usuario" => $idUsuario,
        ":id_detalle" => $idDetalle
    ]);
    $fila = ((int)$ejecucion->fetchColumn() > 0);
    return  $fila;
}

public function crearReserva($idUsuario, $idServicio, $fechaHora, $idDetalle){
    $sentencia = "INSERT INTO reserva (id_usuario, id_servicio, fecha_hora, estado, id_detalle_actividad)
            VALUES (:id_usuario, :id_servicio, :fecha_hora, 'confirmada', :id_detalle)";
    $ejecucion = $this->pdo->prepare($sentencia);
    return $ejecucion->execute([
        ":id_usuario" => $idUsuario,
        ":id_servicio" => $idServicio,
        ":fecha_hora" => $fechaHora,
        ":id_detalle" => $idDetalle
    ]);
}

public function ObtenerReservasUsuario($idUsuario){
    $sentencia = "SELECT 
                    r.id_reserva,
                    r.estado,
                    r.id_servicio,
                    r.fecha_hora,
                    s.nombre_servicio,
                    s.descripcion,
                    s.lugar,
                    s.precio,
                    s.duracion,
                    d.fecha,
                    d.hora_inicio,
                    d.hora_fin,
                    c.nombre AS subcategoria,
                    cp.nombre AS categoria_padre
                  FROM reserva r
                  INNER JOIN servicio s 
                    ON r.id_servicio = s.id_servicio
                  INNER JOIN detalle_actividad d 
                    ON r.id_detalle_actividad = d.id
                  LEFT JOIN categoria c 
                    ON s.id_categoria = c.id_categoria
                  LEFT JOIN categoria cp 
                    ON c.id_categoria_padre = cp.id_categoria
                  WHERE r.id_usuario = :id_usuario
                  ORDER BY d.fecha ASC, d.hora_inicio ASC";

    $ejecucion = $this->pdo->prepare($sentencia);
    $ejecucion->execute([
        ":id_usuario" => $idUsuario
    ]);

    $fila = $ejecucion->fetchAll(PDO::FETCH_ASSOC);
    return $fila;
}

//Cancelar una reserva, comprobando que la reserva ya esté cancelada.
public function CancelarReserva($idUsuario, $idReserva){
    $sentencia = "UPDATE reserva
                  SET estado = 'cancelada'
                  WHERE id_reserva = :id_reserva
                  AND id_usuario = :id_usuario
                  AND estado = 'confirmada'";

    $ejecucion = $this->pdo->prepare($sentencia);

    return $ejecucion->execute([
        ":id_reserva" => $idReserva,
        ":id_usuario" => $idUsuario
    ]);
}

public function ObtenerReservaUsuarioPorId($idUsuario, $idReserva){
    $sentencia = "SELECT 
                    r.id_reserva,
                    r.estado,
                    r.id_servicio,
                    r.fecha_hora,
                    r.id_detalle_actividad,
                    s.nombre_servicio,
                    s.descripcion,
                    s.lugar,
                    s.precio,
                    s.duracion,
                    d.fecha,
                    d.hora_inicio,
                    d.hora_fin
                  FROM reserva r
                  INNER JOIN servicio s 
                    ON r.id_servicio = s.id_servicio
                  INNER JOIN detalle_actividad d 
                    ON r.id_detalle_actividad = d.id
                  WHERE r.id_usuario = :id_usuario
                  AND r.id_reserva = :id_reserva
                  LIMIT 1";

    $ejecucion = $this->pdo->prepare($sentencia);
    $ejecucion->execute([
        ":id_usuario" => $idUsuario,
        ":id_reserva" => $idReserva
    ]);

    $fila = $ejecucion->fetch(PDO::FETCH_ASSOC);
    return $fila;
}

public function ModificarReserva($idUsuario, $idReserva, $idDetalle, $fechaHora){
    $sentencia = "UPDATE reserva
                  SET id_detalle_actividad = :id_detalle,
                      fecha_hora = :fecha_hora
                  WHERE id_reserva = :id_reserva
                  AND id_usuario = :id_usuario
                  AND estado = 'confirmada'";

    $ejecucion = $this->pdo->prepare($sentencia);

    return $ejecucion->execute([
        ":id_detalle" => $idDetalle,
        ":fecha_hora" => $fechaHora,
        ":id_reserva" => $idReserva,
        ":id_usuario" => $idUsuario
    ]);
}

public function usuarioTieneReservaEnMismaFechaHora($idUsuario, $fecha, $horaInicio){
    $sentencia = "SELECT COUNT(*)
                  FROM reserva r
                  INNER JOIN detalle_actividad d 
                    ON r.id_detalle_actividad = d.id
                  WHERE r.id_usuario = :id_usuario
                  AND d.fecha = :fecha
                  AND d.hora_inicio = :hora_inicio
                  AND r.estado = 'confirmada'";

    $ejecucion = $this->pdo->prepare($sentencia);
    $ejecucion->execute([
        ":id_usuario" => $idUsuario,
        ":fecha" => $fecha,
        ":hora_inicio" => $horaInicio
    ]);

    return ((int)$ejecucion->fetchColumn() > 0);
}

public function usuarioTieneReservaEnMismaFechaHoraModificar($idUsuario, $fecha, $horaInicio, $idReservaActual){
    $sentencia = "SELECT COUNT(*)
                  FROM reserva r
                  INNER JOIN detalle_actividad d 
                    ON r.id_detalle_actividad = d.id
                  WHERE r.id_usuario = :id_usuario
                  AND d.fecha = :fecha
                  AND d.hora_inicio = :hora_inicio
                  AND r.estado = 'confirmada'
                  AND r.id_reserva != :id_reserva";

    $ejecucion = $this->pdo->prepare($sentencia);
    $ejecucion->execute([
        ":id_usuario" => $idUsuario,
        ":fecha" => $fecha,
        ":hora_inicio" => $horaInicio,
        ":id_reserva" => $idReservaActual
    ]);

    return ((int)$ejecucion->fetchColumn() > 0);
}

public function obtenerImagenesPorServicio($idServicio){
    $sentencia = "SELECT url_imagen 
                  FROM imagen_servicio 
                  WHERE id_servicio = :id_servicio";

    $ejecucion = $this->pdo->prepare($sentencia);
    $ejecucion->execute([
        ":id_servicio" => $idServicio
    ]);

    return $ejecucion->fetchAll(PDO::FETCH_ASSOC);
}


}

?>