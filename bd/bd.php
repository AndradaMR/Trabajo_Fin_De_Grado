<?php

class db{

public $pdo = "";

public function __construct($host,$port,$db,$user,$pass) { 
    $this->pdo = new PDO("mysql:host=".$host.";port=".$port.";dbname=".$db.";charset=utf8", $user, $pass);
    }

//Introducir usuario en base de datos(id autoincremental)
public function RegistrarUsuario($email,$contraseña,$nombre,$apellido){

   $contracifrada=password_hash($contraseña, PASSWORD_DEFAULT);

    $sentencia="INSERT INTO usuarios (nombre,apellido,email,contraseña, intentos) VALUES (:nombre,:apellido,:email,:contra,0)";
    $ejecuccion=$this->pdo->prepare($sentencia);
    $ejecuccion->execute([
        ":nombre" => $nombre,
        ":apellido" => $apellido,
        ":email" => $email,
        ":contra" => $contracifrada
    ]);
}

//comprobación de ue el email no esté en la base de datos
public function emailexiste($email){

    $sentencia = "SELECT email FROM usuarios WHERE email = :email LIMIT 1";
    
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

    $sentencia = "SELECT * FROM usuarios WHERE email = :email LIMIT 1";
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

        $contrabuena = $fila["contraseña"];
        //compruebo que la contraseña es la adecuada con pasword verify y devuelvo el id
        if(password_verify($contraseña, $contrabuena) == true){
            $this->ResetearIntentos($email);
            return $fila["id"]; 
        //Si no es adecuada incremento aquí directamente los intentos y muestro el aviso en la pagina
        }else{
            $this->IncrementarIntentos($email);
            return "fallocontraseña";
        }
    }
}

public function IncrementarIntentos($email){

    $sentencia = "UPDATE usuarios SET intentos = intentos + 1 WHERE email = :email";
    $ejecuccion = $this->pdo->prepare($sentencia);
    $ejecuccion->execute([
        ":email" => $email
    ]);
}

public function ResetearIntentos($email){

    $sentencia = "UPDATE usuarios SET intentos = 0 WHERE email = :email";
    $ejecuccion = $this->pdo->prepare($sentencia);
    $ejecuccion->execute([
        ":email" => $email
    ]);
}

public function ObtenerUsuario($id){

    $sentencia="SELECT * FROM usuarios WHERE id = :id";
    $ejecuccion=$this->pdo->prepare($sentencia);
    $ejecuccion->execute([
        ":id" => $id
    ]);    

    $fila = $ejecuccion->fetch(PDO::FETCH_ASSOC);
    
    return $fila;

}


public function ModificarUsuarioSincontraseña($idUsuario, $nombre, $apellido, $email){

    $sentencia = "UPDATE usuarios SET nombre = :nombre,
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

public function ModificarUsuarioConcontraseña($idUsuario, $nombre, $apellido, $email, $contraseña){

    $contraCifrada = password_hash($contraseña, PASSWORD_DEFAULT);

    $sentencia = "UPDATE usuarios 
                  SET nombre = :nombre,
                      apellido = :apellido,
                      email = :email,
                      contraseña = :contra,
                  WHERE id = :id";

    $ejecuccion = $this->pdo->prepare($sentencia);
    $ejecuccion->execute([
        ":nombre" => $nombre,
        ":apellido" => $apellido,
        ":email" => $email,
        ":contra" => $contraCifrada,
        ":id" => $idUsuario
    ]);
}

}


?>