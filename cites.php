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
  $field['id_treatments'] = $_POST['trataiments'];
  $sql = "SELECT * FROM cites WHERE date='" . $field['date'] . "' AND (time_from > '" . $field['time_from'] . "' AND time_from < '" . $field['time_until'] . "' OR time_until > '" . $field['time_from'] . "' AND time_until < '" . $field['time_until'] . "')";
  $comprobar = $ndb->send($sql);
  if ($comprobar) die("Hack???");
  $add = $ndb->insert("cites", $field);
  if ($add) {
    unset($_GET);
    unset($_SESSION["cite"]["date"]);
    unset($_SESSION["cite"]["intervention"]);
    unset($_SESSION["cite"]["step"]);
    unset($_SESSION["cite"]["hourfrom"]);
    unset($_SESSION["cite"]["houruntil"]);
    $exito = true;
    $email = $ndb->emailUser($_SESSION["id"]);
    $message = "No conteste a este email por favor.\n\nSe ha registrado correctamente su cita en nuestra clínica \n Día: " . $_POST['date'] . "\n Hora: " . $field['time_from'] . "\n";
    mail($email, "Confirmación de cita ", $message, "From: admin@sonriseclinic.es");
    unset($_POST);
  }
  $ndb->close();
endif;

?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<?php require "sections/head.php"; ?>

<body>
  <?php if (!isset($_GET['new'])) : ?>
    <!-- ========================= preloader start ========================= -->
    <div class="preloader">
      <div class="loader">
        <div class="ytp-spinner">
          <div class="ytp-spinner-container">
            <div class="ytp-spinner-rotator">
              <div class="ytp-spinner-left">
                <div class="ytp-spinner-circle"></div>
              </div>
              <div class="ytp-spinner-right">
                <div class="ytp-spinner-circle"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- preloader end -->
  <?php endif ?>
  <?php
  include "sections/header.php";
  include "includes/blocks.php";
  include "sections/footer.php";
  include "includes/scripts.php";
  ?>
</body>

</html>