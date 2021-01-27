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
$PG_NAME = "NEWS";
$nav_style = "alt";
//CARGAR EL ÁRTICULO DE LA BASE DE DATOS//
$db = new DataBase(DB_SERVER, DB_USER, DB_PASS, DB_NAME, 1);


$db->close();
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<?php require "sections/head.php"; ?>

<body >
  <?php
    include "sections/header.php";
    include "sections/navbar.php";
    $db = new DataBase(DB_SERVER, DB_USER, DB_PASS, DB_NAME, 1);
    include "News/articles.php";
    $db->close();
    include "sections/footer.php";
    include "includes/scripts.php";
    ?>
</body>

</html>