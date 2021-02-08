<?php
// Si hay algún error, descomentar las siguiente líneas

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

// TODAS LAS PÁGINAS CARGAN LOS SIGUIENTE ARCHIVOS //
include("includes/data.php");
include("includes/functions.php");
include("includes/sessions.php");
// Si ya estamos logueados, salir de aquí
if (isAuthenticated()) header("location:index.php");
// TITLE DE LA PÁGINA ACTUAL //
$PG_NAME = "Register";
$nav_style = "alt";
// Procesado de formulario
if (isset($_POST['frmInputEmail'])) :
  $name = $_POST['inputName'];
  $firstname = $_POST['frmInputFirstName'];
  $lastname = $_POST['frmInputLastName'];
  $email = $_POST['frmInputEmail'];
  $lenguage = $lang;
  $db = new DataBase();
  $repeat = $db->send("SELECT Count(*) as repetido FROM users a WHERE a.email='$email'  OR a.name='$name';");
  if ($repeat[0]['repetido']) {
    $error = __('err_RepeatData', $lang);
  } else {
    $clave = uniqid(); //clave unica

    $sql = "INSERT INTO users (name, confirmKey, roles, lang, firstname, lastname, email, enabled) VALUES
    ('$name', '$clave', '[CUSTOMER]', '$lenguage', '$firstname', '$lastname', '$email' , '0');";
    $result = $db->send($sql, "");
    $param = $db->send("SELECT * FROM settings;");
    $urlsite = $param[1]['value']; // value of urlsite in settings table

    $url = "$urlsite/confirmAccount.php?clave=$clave"; //ToDo

    $message = "Bienvenido a SonriseClinic " . $firstname . ".\nEstamos encantados de tenerte con nosotros. \n" .
      "Ahora para confirmar tu cuenta tienes que acceder a este link y asignar tu contraseña:\n " . $url;
    mail($email, "Confirmación de cuenta " . $name, $message, "From: SonriseClinic. \n No conteste a este email por favor.");
  }
  $ok = true;
endif;
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<?php require "sections/head.php"; ?>

<body>
  <?php include "sections/header.php" ?>
  <?php include "sections/navbar.php" ?>
  <?php if (isset($error) && $error != "") : ?>
    <div class="container mt-5">
      <div class="alert alert-danger" role="alert">
        <?= $error ?>
      </div>
    </div>
  <?php elseif (isset($ok)) : ?>
    <div class="container mt-5">
      <div class="alert alert-primary" role="alert">
        <?= __('frm_RegisterEmail', $lang) ?>
      </div>
    </div>
  <?php endif; ?>
  <div class="container">
    <!-- login -->
    <form id="frmLogin" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
      <div class="container-fluid container p-5" style="width: 30rem;">
        <div class="mb-3">
          <label for="inputName" class="form-label"><?= __('frm_Name', $lang) ?></label>
          <input type="text" class="form-control" name="inputName" id="inputName" placeholder="<?= __('frm_Name', $lang) ?>" required>
        </div>
        <div class="mb-3">
          <label for="frmInputFirstName" class="form-label"><?= __('frm_FirstName', $lang) ?></label>
          <input type="text" class="form-control" name="frmInputFirstName" id="frmInputFirstName" placeholder="<?= __('frm_FirstName', $lang) ?>" required>
        </div>
        <div class="mb-3">
          <label for="frmInputLastName" class="form-label"><?= __('frm_LastName', $lang) ?></label>
          <input type="text" class="form-control" name="frmInputLastName" id="frmInputLastName" placeholder="<?= __('frm_LastName', $lang) ?>" required>
        </div>
        <div class="mb-3">
          <label for="frmInputEmail" class="form-label"><?= __('frm_Email', $lang) ?></label>
          <input type="email" class="form-control" name="frmInputEmail" id="frmInputEmail" placeholder="<?= __('frm_Email', $lang) ?>" required>
        </div>
        <div class="mb-3">
          <label for="frmInputCheck" class="form-label"><?= __('frm_Policies', $lang) ?>
            <input type="checkbox" class="" name="frmInputCheck" id="frmInputCheck" value="1" required></label>
        </div>
        <div class="mb-3">
          <input type="submit" class="btn btn-primary" value="<?= __('frm_Send', $lang) ?>">
        </div>
      </div>
    </form>
    <?php include("includes/scripts.php") ?>
  </div>
</body>

</html>