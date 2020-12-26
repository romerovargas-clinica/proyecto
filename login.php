<?php
// TODAS LAS PÁGINAS CARGAN LOS SIGUIENTE ARCHIVOS //
include ("includes/data.php");
include ("includes/functions.php");
include ("includes/sessions.php");
// TITLE DE LA PÁGINA ACTUAL //
$PG_NAME = "Login";
$nav_style = "alt";
?>
<!DOCTYPE html>
<html lang="<?=$lang?>">
<?php require "sections/head.php";?>
<body>
  <?php include "sections/header.php"?>
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
        <a href="#" class="btn btn-primary"><?=__('frm_Send',$lang)?></a>
      </div>
    </div>
    <?php include ("includes/scripts.php")?>
</body>
</html>