<?php
// Si hay algún error, descomentar las siguiente líneas

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// TODAS LAS PÁGINAS CARGAN LOS SIGUIENTE ARCHIVOS //
include("includes/data.php");
include("includes/functions.php");
include("includes/sessions.php");
// Si no somos ADMIN salir de aqui
if ($_SESSION['roles'] != "[ADMIN-USER]") :
  header("location:index.php");
endif;
// TITLE DE LA PÁGINA ACTUAL //
$PG_NAME = "Budget";
$tt_name_int = "";
$nav_style = "";
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<?php require "sections/head.php" ?>

<body>
  <!-- ========================= preloader start ========================= -->
  <div class="preloader">
    <div class="loader">
      <div class="ytp-spinner">
        <div class="ytp-spinner-container">
          <div class="ytp-spinner-rotator">
            <div class="ytp-spinner-left">
              <div class="ytp-spinner-circle"></div>
            </div>
            <div class="ytp-spinner-right">
              <div class="ytp-spinner-circle"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- preloader end -->
  <?php
  include "sections/header.php";
  include "includes/blocks.php";
  include "includes/scripts.php";

  ?>
  <a href="#" class="scroll-top">
    <i class="lni lni-arrow-up"></i>
  </a>
</body>

</html>