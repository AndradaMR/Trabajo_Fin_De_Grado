<?php

class bdact{

public $pdo = "";

public function __construct($host,$port,$db,$user,$pass) { 
    $this->pdo = new PDO("mysql:host=".$host.";port=".$port.";dbname=".$db.";charset=utf8", $user, $pass);
    }

function obtenerCategoriasPadre() {
    $sentencia = "SELECT id_categoria, nombre 
            FROM categoria WHERE id_categoria_padre IS NULL
            ORDER BY nombre ASC";

    $ejecuccion = $this->pdo->prepare($sentencia);
    $ejecuccion->execute();

    return $ejecuccion->fetchAll(PDO::FETCH_ASSOC);
}


function obtenerSubcategoriasPorId($idCategoriaPadre) {
    $sentencia = "SELECT id_categoria, nombre, id_categoria_padre
            FROM categorias
            WHERE id_categoria_padre = :id_categoria_padre";

    $ejecuccion = $this->pdo->prepare($sentencia);
    $ejecuccion->execute([
        ":id_categoria_padre" => $idCategoriaPadre
    ]);

    return $ejecuccion->fetch(PDO::FETCH_ASSOC);
}

}

?>