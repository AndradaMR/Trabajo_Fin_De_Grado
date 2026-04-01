<?php

require_once("model.php");

/* 
LA ESTRUCTURA QUE VA A SEGUIR EL JSON ES LA SIGUIENTE: 

{
  "id_empresa": 1,
  "nombre_empresa": "Zen Studio",
  "servicio": {
    "id_servicio": 1,
    "nombre_servicio": "Yoga al aire libre",
    "descripcion": "Clase grupal de yoga para todos los niveles en parque",
    "lugar": "Madrid",
    "id_categoria": 2,
    "precio": 18,
    "detalles": [
      {
        "fecha": "2026-04-10",
        "hora_inicio": "10:00:00",
        "hora_fin": "12:00:00",
        "plazas_maximas": 15
      },
      {
        "fecha": "2026-04-11",
        "hora_inicio": "16:00:00",
        "hora_fin": "18:00:00",
        "plazas_maximas": 15
      }
    ]
  }
}
*/
public function generarJSON(){

    //CON ESTO VAMOS A SACAR LA INFORMACIÓN QUE QUEREMOS GUARDER EN EL JSON DE LA BBDD. CON ELLO SACO TODO
    $sql = "SELECT e.nombre_empresa, e.id_empresa, s.id_servicio, s.nombre_servicio, s.descripcion,  s.lugar, s.precio, s.id_categoria, da.fecha, da.hora_inicio, da.hora_fin, da.plazas_maximas, imgs.url_imagen
            FROM 
            empresa e 
            INNER JOIN 
            servicio s on e.id_empresa=s.id_empresa 
            INNER JOIN detalle_actividad da on s.id_servicio =da.id_servicio
            INNER JOIN imagen_servicio imgs on s.id_servicio =imgs.id_servicio";
    $stmt = $bbdd->pdo->prepare($sql);   
    $stmt->execute();             

    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);  // obtener datos

    //print_r($resultados);
    
    //AHORA VAMOS A ORGANIZAR LA INFORMACIÓN PARA NO TENER DUPLICADA INFORMACIÓN. USAREMOS UN FOREACH.

    $empresas=[];//aqui irán todas las empresas ordenadas por su id.

    foreach($resultados as $fila){
        $id_empresa= $fila['id_empresa'];
        $id_servicio= $fila['id_servicio'];

        //si mi id de empresa no está en mi array de empresas la creo
        if(!isset($empresas[$id_empresa])){
            $empresas[$id_empresa]=[
                "id_empresa" => $fila["id_empresa"],
                "nombre_empresa"=> $fila["nombre_empresa"],
                "servicios"=>[]
            ];
        }

         // Ahora vamos a crear los servicios 
        if (!isset($empresas[$id_empresa]["servicios"][$id_servicio])) {
            $empresas[$id_empresa]["servicios"][$id_servicio] = [
                "id_servicio" => $fila["id_servicio"],
                "id_categoria" => $fila["id_categoria"],
                "nombre_servicio" => $fila["nombre_servicio"],
                "descripcion" => $fila["descripcion"],
                "lugar" => $fila["lugar"],
                "precio" => $fila["precio"],
                "imagenes" => [],
                "detalles" => [],
                "_detalles_vistos" => [],
                "_imagenes_vistas" => []
            ];
        }

        //ahora vamos a crear el detalle del servicio

        //LO MONTAMOS PARA QUE SEA COMO UNA CLAVE CONJUNTA
       $claveDetalle = $fila["fecha"] . "|" . $fila["hora_inicio"] . "|" . $fila["hora_fin"] . "|" . $fila["plazas_maximas"];

        if (!isset($empresas[$id_empresa]["servicios"][$id_servicio]["_detalles_vistos"][$claveDetalle])) {
            $empresas[$id_empresa]["servicios"][$id_servicio]["detalles"][] = [
                "fecha" => $fila["fecha"],
                "hora_inicio" => $fila["hora_inicio"],
                "hora_fin" => $fila["hora_fin"],
                "plazas_maximas" => $fila["plazas_maximas"]
            ];


            $empresas[$id_empresa]["servicios"][$id_servicio]["_detalles_vistos"][$claveDetalle] = true;
        }
    
        //AQUI AÑADIMOS LAS IMAGENES
        if (!isset($empresas[$id_empresa]["servicios"][$id_servicio]["_imagenes_vistas"][$fila["url_imagen"]])) {
            $empresas[$id_empresa]["servicios"][$id_servicio]["imagenes"][] = $fila["url_imagen"];
            $empresas[$id_empresa]["servicios"][$id_servicio]["_imagenes_vistas"][$fila["url_imagen"]] = true;
        }
        
    }
    //AQUI LO QUE HACEMOS ES QUITAR LOS DETALLES E IMAGENES VISTOS PARA EVITAR DUPLICADOS 
    foreach ($empresas as &$empresa) {
        foreach ($empresa["servicios"] as &$servicio) {
            unset($servicio["_detalles_vistos"]);
            unset($servicio["_imagenes_vistas"]);

        }
        //esto lo hacemos para que las claves empiecen en 0 
        $empresa["servicios"] = array_values($empresa["servicios"]);
    }
    unset($empresa, $servicio);

    // Convertir empresas a lista
    $empresas = array_values($empresas);

    // Convertir a JSON
    $json = json_encode($empresas, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    // Crear carpeta si no existe
    $rutaCarpeta = __DIR__ . "/../JSON/";

    if (!is_dir($rutaCarpeta)) {
        mkdir($rutaCarpeta, 0777, true);
    }

    // Guardar cambios
    $rutaArchivo = $rutaCarpeta . "/actividades.json";
    file_put_contents($rutaArchivo, $json);

}
?>