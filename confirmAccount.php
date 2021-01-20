<?php
// Si hay algún error, descomentar las siguiente líneas

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// TODAS LAS PÁGINAS CARGAN LOS SIGUIENTE ARCHIVOS //
include("includes/data.php");
include("includes/functions.php");
include("includes/sessions.php");
logout();
// TITLE DE LA PÁGINA ACTUAL //
$PG_NAME = "Confirm";
$nav_style = "alt";

//RECOJO LOS DATOS DE LA CUENTA
$db = new DataBase(DB_SERVER, DB_USER, DB_PASS, DB_NAME, 1);
$confirmKey = $_GET['clave'];
$account = $db->send("SELECT * FROM users WHERE confirmKey = '$confirmKey'");

if (!$account) $error = "ERROR: La clave de validación no es válida"; // To-Do traducción

?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<?php require "sections/head.php"; ?>

<body>
  <?php include "sections/header.php" ?>
  <?php include "sections/navbar.php" ?>
  <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="container bg-light">
      <div class="container-fluid px-3 py-3" style="background-color: white">
        <div class="alert alert-secondary" style="grid-column:1/3">
          <p id="display"><?= isset($error) && $error != '' ? $error : '' ?></p>
        </div>
        <?php if ($error == "") : ?>
          <!--        ¡¡¡¡¡MUESTRA DE GRID!!!!     -->
          <div id="grid" style="display:grid; grid-template-columns:1fr 1fr;">
            <h2 style="grid-column:1/3">Confirmación de cuenta: <span><?= $account[0]['name'] ?><span></h2>
            <hr style="grid-column:1/3">
            <div>
              <form id="frmConfirm" method="post" action="updatePass.php">
                <div class="container-fluid container-sm p-5" style="width: 20rem;">

                  <div class="mb-3">
                    <label for="frmInputPass" class="form-label"><?= __('frm_Password', $lang) ?></label>
                    <input type="password" class="form-control" name="frmInputPass" id="frmInputPass" placeholder="password">
                  </div>
                  <div class="mb-3">
                    <label for="frmInputPassConfirm" class="form-label"><?= __('frm_ConfirmPassword', $lang) ?></label>
                    <input type="password" class="form-control" name="frmInputPassConfirm" id="frmInputPassConfirm" placeholder="password">
                  </div>
                  <input name="key" type="hidden" value="<?= $confirmKey ?>">
                  <input onclick="samePass()" class="btn btn-primary" value="<?= __('btn_Ok', $lang) ?>">
                </div>
              </form>
            </div>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ducimus architecto id delectus molestiae quaerat repudiandae reiciendis ea eos accusamus, doloribus sunt at iste. Quia minima nemo sit ab corrupti laboriosam! </p>


          </div>
        <?php else : ?>

        <?php endif; ?>
      </div>
    </div>


    <?php
    include("includes/scripts.php");
    $db->close();
    ?>
    <script>
      function samePass() {
        pass = document.getElementById("frmInputPass").value;
        passConfirm = document.getElementById("frmInputPassConfirm").value;
        if (pass == passConfirm) {
          display = "Correcto ahora podrá loguear, espere unos segundos!";
          document.getElementById("display").innerHTML = display;
          // se supone que queria hacer por aqui un sleep para que se vea el mensaje, peeero no lo consegui 
          // Añade, si quieres, un div del tipo Modal (tienes ejemplos en la carpeta admin). Esto mantedrá una pantalla activa hasta que el usuario pulse en aceptar
          document.getElementById("frmConfirm").submit();
        } else {
          alert("estoy fasd");
          display = "Las contraseñas no son iguales"; // To-Do traducción
          document.getElementById("display").innerHTML = display;
        }
      }
    </script>
</body>

</html>