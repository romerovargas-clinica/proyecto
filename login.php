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
  <div class="container-lg">
    <div class="row align-items-start">
      <div class="col">
        <figure class="figure">
          <img class="rounded float-start" src="images/logoAzul.svg" width="300" height="175">
        </figure>
      </div>
      <div class="col">
        <div class="social">
          <div class="container px-4">
            <div class="row gx-5">
              <div class="col ">
                <div class="p-3 border bg-light"><i class="fab fa-twitter-square my-2 my-sm-0"></i></div>
              </div>
              <div class="col">
                <div class="p-3 border bg-light">Custom column padding</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <?php include "sections/navbar.php"?>
  <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <!-- login -->

    <div class="container-fluid container-sm p-5" style="width: 20rem;">
      <div class="mb-3">
        <label for="FormControlInput1" class="form-label"><?=__('frm_Email',$lang)?></label>
        <input type="email" class="form-control" id="FormControlInput1" placeholder="name@example.com">
      </div>
      <div class="mb-3">
        <label for="FormControlPass" class="form-label"><?=__('frm_Pass',$lang)?></label>
        <input type="password" class="form-control" id="FormControlPass" placeholder="password">
      </div>
      <div class="mb-3">
        <a href="#" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>
    <?php include ("includes/scripts.php")?>
</body>

</html>