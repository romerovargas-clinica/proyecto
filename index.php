<?php
// TODAS LAS PÁGINAS CARGAN LOS SIGUIENTE ARCHIVOS //
include ("includes/data.php");
include ("includes/functions.php");
include ("includes/sessions.php");
// TITLE DE LA PÁGINA ACTUAL //
$PG_NAME = "Home";
$nav_style = "alt";
?>
<!DOCTYPE html>
<html lang="<?=$lang?>">
<?php require "sections/head.php";?>

<body>
  <?php include "sections/navbar.php"?>
  <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <!-- Imagen de Darko Stojanovic https://pixabay.com/es/users/darkostojanovic-638422/ -->
        <img class="d-block w-100" src="images/carousel/doctor-563429_640.jpg" alt="First slide">
      </div>
      <div class="carousel-item">
        <!-- Imagen de StockSnap https://pixabay.com/es/users/stocksnap-894430/ -->
        <img class="d-block w-100" src="images/carousel/chair-2589771_640.jpg" alt="Second slide">
      </div>
      <div class="carousel-item">
        <!-- Imagen de StockSnap https://pixabay.com/es/users/stocksnap-894430/ -->
        <img class="d-block w-100" src="images/carousel/chair-2584260_640.jpg" alt="Third slide">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
    <img class="carousel-control-prev logo" src="images/logoAzul.svg" role="button">
  </div>
  <?php include ("includes/scripts.php")?>
</body>

</html>