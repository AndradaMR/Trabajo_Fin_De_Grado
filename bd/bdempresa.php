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
        //Avisa si el usuario ya está bloqueado por intentos
        if($fila["intentos"] >= 3){
            //return "usuariobloqueado";
        }

        $contrabuena = $fila["contrasena"];
        //compruebo que la contraseña es la adecuada con pasword verify y devuelvo el id
        if(password_verify($contraseña, $contrabuena) == true){
            //$this->ResetearIntentos($email);
            return $fila["id_usuario"]; 
        //Si no es adecuada incremento aquí directamente los intentos y muestro el aviso en la pagina
        }else{
            $this->IncrementarIntentos($email);
            return "fallocontraseña";
        }
    }
}

public function IncrementarIntentos($email){

    $sentencia = "UPDATE usuario SET intentos = intentos + 1 WHERE email = :email";
    $ejecuccion = $this->pdo->prepare($sentencia);
    $ejecuccion->execute([
        ":email" => $email
    ]);
}

public function ResetearIntentos($email){

    $sentencia = "UPDATE usuario SET intentos = 0 WHERE email = :email";
    $ejecuccion = $this->pdo->prepare($sentencia);
    $ejecuccion->execute([
        ":email" => $email
    ]);
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

}



?>