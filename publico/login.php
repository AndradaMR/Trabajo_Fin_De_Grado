<?php

$titulo="<h1>Bienvenido a Body and Soul</h1>";
require_once("head.php");

if(isset($_SESSION["usuario"])){
  header("Location: index.php");
  exit();
}//asi si ya tengo sesion iniciada me lleva al index

$banderaerror = false;

$email = "";
$emailerror = "";
if(isset($_POST["email"])){
    $email = htmlentities($_POST["email"]);
    if($email == ""){
        $emailerror = "El campo email no puede estar vacío";
        $banderaerror = true;
    }
}

$contraseña = "";
$contraerror = "";
if(isset($_POST["contraseña"])){
    $contraseña = htmlentities($_POST["contraseña"]);
    if($contraseña == ""){
        $contraerror = "El campo contraseña no puede estar vacío";
        $banderaerror = true;
    }
}

$usuarioerror="";
if($banderaerror == false && isset($_POST["enviar"])){

    $respuesta = $bbdd->ComprobarLogin($email, $contraseña);

    if($respuesta == "usuarionoexiste"){
        $emailerror = "Este email no existe, prueba de nuevo";
        $banderaerror = true;

    }else if($respuesta == "usuariobloqueado"){
        $contraerror = "Usuario bloqueado por exceso de intentos";
        $banderaerror = true;

    }else if($respuesta == "fallocontraseña"){
        $contraerror = "Contraseña incorrecta, prueba de nuevo";
        $banderaerror = true;

    }else{
      //Si todo ha ido bien me ha devuelto el id de usuario por lo que inicio sesion
        $_SESSION["usuario"] = $respuesta;
        header("Location: perfil.php");
        exit();
    }
}

?>

<body>

  <main class="login-page">
    <section class="login-section">
      <div class="container">
        <div class="login-wrapper">

          <div class="login-card">
            <div class="heart-glow"></div>

            <div class="login-card-header">
              <span class="section-tag">Accede a tu cuenta</span>
              <h2>Iniciar sesión</h2>
            </div>

            <form action="" method="post" class="login-form">
              <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input
                  type="email"
                  id="email"
                  name="email"
                  placeholder="Introduce tu correo"
                >
                <small><?php echo $emailerror; ?></small>
              </div>

              <div class="form-group">
                <label for="contraseña">Contraseña</label>
                <input
                  type="password"
                  id="contraseña"
                  name="contraseña"
                  placeholder="Introduce tu contraseña"
                >
                <small><?php echo $contraerror; ?></small>
                
              </div>

              <button type="submit" name="enviar" value="enviar" class="btn btn-primary btn-full login-btn">
                Iniciar sesión
              </button>
            </form>

            <p class="login-register-text">
              ¿No tienes cuenta?
              <a href="registro.php" class="register-link">Regístrate</a>
            </p>
          </div>

        </div>
      </div>
    </section>
  </main>

 
 <?php
require_once("footer.php");
?>

</body>
</html>