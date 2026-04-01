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

//No tiene en cuenta si la cat es padre(ver como hacer con la descripcion de las cathijo)
function obtenerdescripcioncat($idcat) {
    $sentencia = "SELECT descripcion FROM categoria WHERE id_categoria = :id_categoria_padre";

    $ejecuccion = $this->pdo->prepare($sentencia);
    $ejecuccion->execute([
        ":id_categoria" => $idcat
    ]);

    $fila=$ejecuccion->fetch(PDO::FETCH_ASSOC);
    return $fila["descripcion"];
}

public function obtenerSubcat($idcatpadre){

    $sentencia = "SELECT * FROM categoria WHERE id_categoria_padre = :idcatpadre";

    $ejecuccion = $this->pdo->prepare($sentencia);
    $ejecuccion->execute([
        ":idcatpadre" => $idcatpadre
    ]);

    $fila=$ejecuccion->fetchAll(PDO::FETCH_ASSOC);
    return $fila;    

}

public function obteneractividades($idcat){

    $sentencia = "SELECT * FROM servicio WHERE id_categoria = :idcat";

    $ejecuccion = $this->pdo->prepare($sentencia);
    $ejecuccion->execute([
        ":idcat" => $idcat
    ]);

    $fila=$ejecuccion->fetchAll(PDO::FETCH_ASSOC);
    return $fila;

}


}

?>