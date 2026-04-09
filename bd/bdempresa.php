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

public function RegistrarEmpresa($nombre, $email, $contraseña, $direccion, $telefono, $descripcion_empresa, $ciudad_empresa,$categoria_empresa, $logo_empresa){

    $contracifrada = password_hash($contraseña, PASSWORD_DEFAULT);

    $sentencia = "INSERT INTO empresa (nombre_empresa, email, contrasena, direccion, telefono, logo_empresa, categoria_empresa, ciudad_empresa, descripcion_empresa) 
                  VALUES (:nombre, :email, :contra, :direccion, :telefono, :logo_empresa, :categoria_empresa, :ciudad_empresa, :descripcion_empresa)";

    $ejecuccion = $this->pdo->prepare($sentencia);
    $ejecuccion->execute([
        ":nombre" => $nombre,
        ":email" => $email,
        ":contra" => $contracifrada,
        ":direccion" => $direccion,
        ":telefono" => $telefono,
        ":descripcion_empresa" => $descripcion_empresa,
        ":ciudad_empresa" => $ciudad_empresa,
        ":categoria_empresa" => $categoria_empresa,
        ":logo_empresa" => $logo_empresa
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

}



?>