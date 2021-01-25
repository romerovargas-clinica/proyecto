<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// TODAS LAS PÁGINAS CARGAN LOS SIGUIENTE ARCHIVOS //
include("includes/data.php");
include("includes/functions.php");
include("includes/sessions.php");
// Recuperar la sesión anterior
initiate();
// TITLE DE LA PÁGINA ACTUAL //
$PG_NAME = "ARTICLE";
$nav_style = "alt";
//CARGAR EL ÁRTICULO DE LA BASE DE DATOS//
$db = new DataBase(DB_SERVER, DB_USER, DB_PASS, DB_NAME, 1);
$id = $_GET['id'];
$article = $db->send("SELECT * FROM articles WHERE enabled = 1 AND id = $id");
$articleX = $article[0];

$db->close();
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<?php require "sections/head.php"; ?>

<body >
  <?php
    include "sections/header.php";
    include "sections/navbar.php";
  ?>
  <div class="container">
    <div class="container-fluid px-3 py-3" style="background-color: white">
      <div class="position-relative">
        <div class="position-absolute top-0 end-0"><?=__("date_Published", $lang)?>
          <div class="badge bg-success"><?=$articleX['date_published']?></div>
        </div>
      </div>
      <h2><?=$articleX['title']?></h2>
      <h3><?=$articleX['subtitle']?></h3>

      <p><?=$articleX['text']?></p>
    </div>
  </div>
  <?php
    $db->close();
    include "sections/footer.php";
    include "includes/scripts.php";
    ?>
</body>

</html>