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
$PG_NAME = "Specialitie";
$nav_style = "alt";
//CARGAR EL ÁRTICULO DE LA BASE DE DATOS//
$db = new DataBase();
$categorie = $_GET['categorie'];
$categories = $db->send("SELECT * FROM treatmentscategories WHERE id = $categorie");

$db->close();
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<?php require "sections/head.php"; ?>

<body>
    <?php
    include "sections/header.php";
    include "includes/blocks.php";
    include "sections/footer.php";
    include "includes/scripts.php";
    ?>
</body>

</html>