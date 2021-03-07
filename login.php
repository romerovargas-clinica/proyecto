<?php
// Si hay algún error, descomentar las siguiente líneas

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// TODAS LAS PÁGINAS CARGAN LOS SIGUIENTE ARCHIVOS //
include("includes/data.php");
include("includes/functions.php");
include("includes/sessions.php");
// Si ya estamos logueados, salir de aquí
if (isAuthenticated()) header("location:index.php");
// TITLE DE LA PÁGINA ACTUAL //
$PG_NAME = "Login";
$tt_name_int = "Bl_Login";
$nav_style = "alt";
$loginFailedMessage = "err_NotAutenticates";
// Procesado de formulario //
if (isset($_POST['frmInputEmail'])) :
  if (isset($_POST['frmInputRemember']) && $_POST['frmInputRemember'] == 1) :
    $rem = 1;
  else :
    $rem = 0;
  endif;

  if (login($_POST['frmInputEmail'], $_POST['frmInputPass'], $rem, TRUE)) {
    $db = new DataBase();
    $anarray = array();
    $anarray["last_login"] = date("Y-m-d H:i:s");
    $resultset = $db->update("users", $anarray, "name = '" . $_SESSION['name'] . "'");
    $db->close();
    header("location:index.php");
  } else {
    $mensaje = $loginFailedMessage;
    //$name = $_POST['name'];
  }
endif;
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<?php require "sections/head.php" ?>

<body>
  <?php
  include "sections/header.php";
  include "includes/blocks.php";
  include "sections/footer.php";
  include "includes/scripts.php";
  ?>
</body>

</html>