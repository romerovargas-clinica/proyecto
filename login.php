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
$nav_style = "alt";
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
    $name = $_POST['name'];
  }
endif;
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<?php require "sections/head.php" ?>

<body>
  <?php include "sections/header.php" ?>
  <?php include "sections/navbar.php" ?>
  <div class="container">
    <!-- login -->
    <form id="frmLogin" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
      <div class="container-fluid container-sm p-5" style="width: 20rem;">
        <div class="mb-3">
          <label for="frmInputEmail" class="form-label"><?= __('frm_Email', $lang) ?></label>
          <input type="text" class="form-control" name="frmInputEmail" id="frmInputEmail" placeholder="nick our name@example.com" required>
        </div>
        <div class="mb-3">
          <label for="frmInputPass" class="form-label"><?= __('frm_Pass', $lang) ?></label>
          <input type="password" class="form-control" name="frmInputPass" id="frmInputPass" placeholder="password" required>
        </div>
        <div class="mb-3">
          <label for="frmInputRemember" class="form-label"><?= __('frm_Remember', $lang) ?>
            <input type="checkbox" class="" name="frmInputRemember" id="frmInputRemember" value="1"></label>
        </div>
        <div class="mb-3">
          <input type="submit" class="btn btn-primary" value="<?= __('frm_Send', $lang) ?>">
        </div>
      </div>
    </form>
    <div class="container-fluid container-sm" style="width: 20rem;">
      <i class="fas fa-users"></i> | <a class="small" href="register.php"><?= __('frm_Register', $lang) ?></a>
    </div>
    <?php include("includes/scripts.php") ?>
  </div>
</body>

</html>