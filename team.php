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
$PG_NAME = "Team";
$nav_style = "alt";
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