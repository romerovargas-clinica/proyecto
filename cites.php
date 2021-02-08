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
$PG_NAME = "Cites";
$nav_style = "alt";
$exito = false;

if (isset($_POST["trataiments"])) :
  $ndb = new DataBase();
  $fecha = explode("/", $_POST['date']);
  $field['date'] = $fecha[2] . "-" . $fecha[1] . "-" . $fecha[0];
  $field['time_from'] = $_POST['hourfrom'];
  $field['time_until'] = $_POST['houruntil'];
  $field['user_id'] = $_SESSION['id'];
  $comprobar = $ndb->send("SELECT * FROM cites WHERE date='" . $field['date'] . "' AND (time_from BETWEEN '" . $field['time_from'] . "' AND '" . $field['time_until'] . "' OR time_until BETWEEN '" . $field['time_from'] . "' AND '" . $field['time_until'] . "')");
  if ($comprobar) die("Hack!!");
  $add = $ndb->insert("cites", $field);
  if ($add) {
    unset($_GET);
    unset($_SESSION["cite"]["date"]);
    unset($_SESSION["cite"]["intervention"]);
    unset($_SESSION["cite"]["step"]);
    unset($_SESSION["cite"]["hourfrom"]);
    unset($_SESSION["cite"]["houruntil"]);
    unset($_POST);
    $exito = true;
  }
  $ndb->close();
endif;

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