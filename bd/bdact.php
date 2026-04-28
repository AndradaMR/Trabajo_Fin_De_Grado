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


public function ObtenerCategoriaConPadre($idCategoriaHijo){

    $sentencia = "SELECT 
                    c.nombre AS subcategoria,
                    cp.nombre AS categoria_padre
                  FROM categoria c
                  LEFT JOIN categoria cp 
                  ON c.id_categoria_padre = cp.id_categoria
                  WHERE c.id_categoria = :idCategoria";

    $ejecucion = $this->pdo->prepare($sentencia);

    $ejecucion->execute([
        ":idCategoria" => $idCategoriaHijo
    ]);

    return $ejecucion->fetch(PDO::FETCH_ASSOC);
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
                    COUNT(r.id_reserva) AS total_reservas
                  FROM servicio s
                  INNER JOIN reserva r ON s.id_servicio = r.id_servicio
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
    $fila=$ejecucion->fetchAll(PDO::FETCH_ASSOC);

    return $fila;
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


}

?>