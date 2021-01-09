<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// TODAS LAS PÁGINAS CARGAN LOS SIGUIENTE ARCHIVOS //
include ("includes/data.php");
include ("includes/functions.php");
include ("includes/sessions.php");
// Recuperar la sesión anterior
initiate();
// TITLE DE LA PÁGINA ACTUAL //
$PG_NAME = "Cites";
$nav_style = "alt";
?>
<!DOCTYPE html>
<html lang="<?=$lang?>">
<?php require "sections/head.php";?>

<body class="bg-light">
  <?php 
    include "sections/header.php";
    include "sections/navbar.php";
    // cargar los bloques desde la configuración
    $db = new DataBase(DB_SERVER, DB_USER, DB_PASS, DB_NAME, 1);
    $sql = "SELECT * FROM pages a INNER JOIN blocks b ON a.id = b.id_page WHERE a.page = '".$PG_NAME."' ORDER BY order_n ASC";
    $blocks = $db->send($sql);
    foreach($blocks as $block):
      $name_block = $block['name'];
      include "blocks/".$block['block'].".php";
    endforeach;
    $db->close();
    include "sections/footer.php";
    include "includes/scripts.php";
  ?>
</body>

</html>