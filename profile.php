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
$PG_NAME = "Profile";
$nav_style = "alt";

// Gestión del formulario de actualización de datos del usuario
if (isset($_POST['enviar'])) :
  $errores = false;
  // datos obligatorios
  $firstname = $_POST["firstname"] != "" ? $_POST['firstname'] : "";
  $lastname = $_POST["lastname"] != "" ? $_POST['lastname'] : "";
  $email = $_POST["email"] != "" ? $_POST['email'] : "";
  $phone = $_POST["phone"] != "" ? $_POST['phone'] : "";
  if ($firstname = "" || $lastname = "" || $email = "" || $phone = "") :
    $errores = true;
    $msgError = 'err_MissingData';
  endif;
  // array sólo con los datos que hayan sufrido variación
  $base = new DataBase();
  $usuario = $base->select("users", "id = " . $_SESSION['id']);
  $anarray = array();
  foreach ($usuario as  $dato) :
    foreach ($dato as $key => $campo) :
      if (isset($_POST[$key]) && $_POST[$key] != $campo) :
        $anarray[$key] = $_POST[$key];
      endif;
    endforeach;
  endforeach;
  // Si el email ha sufrido variación, comprobar que no esté repetido
  if (isset($anarray["email"])) :
    $busca = $base->select("users", "email = '" . $anarray["email"] . "' AND id <> " . $_SESSION['id']);
    if ($busca) :
      $errores = true;
      $msgError = 'err_RepeatEmail';
    endif;
  endif;
  // Por fin, actualizar
  if (!$errores && count($anarray) > 0) :
    $update = $base->update("users", $anarray, "id = " . $_SESSION['id']);
    if ($update) :
      $msgError = 'ok_Update';
    endif;
  elseif (!$errores && count($anarray) == 0) :
    $errores = true;
    $msgError = 'err_NothingUpdate';
  endif;
  // Ver si ha cambiado el idioma
  if (isset($anarray["lang"])) :
    $lang = $anarray["lang"];
  endif;
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