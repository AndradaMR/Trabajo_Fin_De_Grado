<?php
$titulo="<h1>Bienvenido a Body and Soul</h1>";
require_once("head.php");

if(isset($_GET["cat"])){
  $nombrecatpadre=$_GET["cat"];
  $idcatpadre=$bdact->obteneridcat($nombrecatpadre);
  
}else{
  header("Location: index.php");
}

//CUANDO LA TENGAMOS LA PONEMOS ABAJO EN EL P
//$descripcion=$bdact->obtenerdescripcioncat($idcatpadre);

$subcategorias=$bdact->obtenerSubcat($idcatpadre);

?>


  <main class="category-page">
    <section class="category-hero">
      <div class="container">
        <span class="section-tag">Explora actividades</span>
        <h2 class="category-title"><?=$nombrecatpadre?></h2>
        <p class="category-description">
          Aqui tenemos que añadir la descripcion de la nombrecat(añadir a la bbdd)(ya esta hecha la funcion)
        </p>
      </div>
    </section>

    <section class="subcategory-section">
      <div class="container">

        <?php
        foreach($subcategorias as $subcat){  
        $actividades=$bdact->obteneractividades($subcat["id_categoria"]);
        ?>

        <!-- SUBCATEGORÍA 1 -->
        <article class="subcategory-block">
          <div class="subcategory-header">
            <h3><?=$subcat["nombre"]?></h3>
          </div>

          <div class="carousel-wrapper">
            <button class="carousel-btn carousel-btn-left" type="button" aria-label="Desplazar a la izquierda">
              &#10094;
            </button>
            <div class="carousel-track">
              <?php
            foreach($actividades as $act){
              ?>
              <a href="actividad.php?idact=<?=$act['id_servicio']?>" class="subcategory-card">
                <img src="assets/yoga-1.jpg" alt="<?=$act['nombre_servicio']?>">
                <span><?=$act['nombre_servicio']?></span>
              </a>
            <?php
            }
            ?>
            </div>
            <button class="carousel-btn carousel-btn-right" type="button" aria-label="Desplazar a la derecha">
              &#10095;
            </button>
          </div>
        </article>

        <?php
        }
        ?>        

      </div>
    </section>
  </main>


 <?php
require_once("footer.php");
?>

</body>
</html>