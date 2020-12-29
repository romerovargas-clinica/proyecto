<?php
// TODAS LAS PÁGINAS CARGAN LOS SIGUIENTE ARCHIVOS //
include ("includes/data.php");
include ("includes/functions.php");
include ("includes/sessions.php");
// Recuperar la sesión anterior
initiate();
// TITLE DE LA PÁGINA ACTUAL //
$PG_NAME = "Home";
$nav_style = "alt";
?>
<!DOCTYPE html>
<html lang="<?=$lang?>">
<?php require "sections/head.php";?>

<body class="bg-light">
  <?php include "sections/header.php"?>
  <?php include "sections/navbar.php"?>
  <div id="carouselExampleControls" class="container carousel slide bd-light" data-ride="carousel">
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
  </div>
  <div class="container bg-light" style="border-top: 8px solid black">
    <div class="row" style="border-top: 8px solid #00A797">
      <nav class="navbar navbar-expand-lg bg-primary shadow navbar-dark" style="padding-top: 0">
        <a class="navbar-brand" href="index.php"><?=__('mn_News', $lang)?></a>
      </nav>
    </div>
    <div class="container-fluid px-3 py-3" style="background-color: white">
      <h2>#1 Hello, world!</h2>
      <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to
        featured content or information.</p>
      <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
      <a class="btn btn-primary btn-md" href="#" role="button">Learn more</a>
    </div>
    <hr class="my-4">
    <div class="container-fluid px-3 py-3" style="background-color: white">
      <h2>#2 Hello, world!</h2>
      <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to
        featured content or information.</p>
      <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
      <a class="btn btn-primary btn-md" href="#" role="button">Learn more</a>
    </div>
    <hr class="my-4">
    <div class="container-fluid px-3 py-3" style="background-color: white">
      <h2>#3 Hello, world!</h2>
      <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to
        featured content or information.</p>
      <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
      <a class="btn btn-primary btn-md" href="#" role="button">Learn more</a>
    </div>
  </div>
  <?php include "sections/footer.php"?>
  <?php include ("includes/scripts.php")?>
</body>

</html>