<?php

class db{

public $pdo = "";

public function __construct($host,$port,$db,$user,$pass) { 
    $this->pdo = new PDO("mysql:host=".$host.";port=".$port.";dbname=".$db.";charset=utf8", $user, $pass);
    }

//Introducir usuario en base de datos(id autoincremental)
public function RegistrarUsuario($email,$contraseña,$nombre,$apellido,$telefono){

   $contracifrada=password_hash($contraseña, PASSWORD_DEFAULT);

    $sentencia="INSERT INTO usuario (nombre,apellido,email,contrasena,telefono,id_rol,intentos) VALUES (:nombre,:apellido,:email,:contra,:telefono,:idrol,:intentos)";
    $ejecuccion=$this->pdo->prepare($sentencia);
    $ejecuccion->execute([
        ":nombre" => $nombre,
        ":apellido" => $apellido,
        ":email" => $email,
        ":contra" => $contracifrada,
        ":telefono" => $telefono,
        ":idrol" => 1,
        ":intentos" => 0
    ]);
}

//comprobación de ue el email no esté en la base de datos
public function emailexiste($email){

    $sentencia = "SELECT email FROM usuario WHERE email = :email LIMIT 1";
    
    $ejecucion = $this->pdo->prepare($sentencia);
    $ejecucion->execute([
        ":email" => $email
    ]);

    if($ejecucion->rowCount() > 0){
        return true;
    }else{
        return false;
    }

}

public function ComprobarLogin($email, $contraseña){

    $sentencia = "SELECT * FROM usuario WHERE email = :email LIMIT 1";
    $ejecuccion = $this->pdo->prepare($sentencia);
    $ejecuccion->execute([
        ":email" => $email
    ]);

    $fila = $ejecuccion->fetch(PDO::FETCH_ASSOC);

    //Si no saca resultados es que no existe
    if($fila == false){
        return "usuarionoexiste";
    }else{
        //Avisa si el usuario ya está bloqueado por intentos
        if($fila["intentos"] >= 3){
            return "usuariobloqueado";
        }

        $contrabuena = $fila["contrasena"];
        //compruebo que la contraseña es la adecuada con pasword verify y devuelvo el id
        if(password_verify($contraseña, $contrabuena) == true){
            $this->ResetearIntentos($email);
            //La respuesta será el id si todo ha ido bien
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

public function ObtenerUsuario($id){

    $sentencia="SELECT * FROM usuario WHERE id_usuario = :id";
    $ejecuccion=$this->pdo->prepare($sentencia);
    $ejecuccion->execute([
        ":id" => $id
    ]);    

    $fila = $ejecuccion->fetch(PDO::FETCH_ASSOC);
    
    return $fila;

}


public function ModificarUsuarioSincontraseña($idUsuario, $nombre, $apellido, $email){

    $sentencia = "UPDATE usuario SET nombre = :nombre,
                      apellido = :apellido,
                      email = :email
                  WHERE id = :id";

    $ejecuccion = $this->pdo->prepare($sentencia);
    $ejecuccion->execute([
        ":nombre" => $nombre,
        ":apellido" => $apellido,
        ":email" => $email,
        ":id" => $idUsuario
    ]);
}

public function ModificarUsuarioConcontraseña($id, $nombre, $apellido, $email, $contraseña){

    $contraCifrada = password_hash($contraseña, PASSWORD_DEFAULT);

    $sentencia = "UPDATE usuario 
                  SET nombre = :nombre,
                      apellido = :apellido,
                      email = :email,
                      contrasena = :contra,
                  WHERE id = :id";

    $ejecuccion = $this->pdo->prepare($sentencia);
    $ejecuccion->execute([
        ":nombre" => $nombre,
        ":apellido" => $apellido,
        ":email" => $email,
        ":contra" => $contraCifrada,
        ":id" => $id
    ]);
}

public function obtenerrolus($id){

$sentencia="SELECT id_rol FROM usuario WHERE id_usuario = :id";
    $ejecuccion=$this->pdo->prepare($sentencia);
    $ejecuccion->execute([
        ":id" => $id
    ]);    

    $rol = $ejecuccion->fetch(PDO::FETCH_ASSOC);
    
    return $rol["id_rol"];

}

}

?>