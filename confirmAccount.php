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
//if(isAuthenticated()) header("location:index.php");
// TITLE DE LA PÁGINA ACTUAL //
$PG_NAME = "Confirm";
$nav_style = "alt";
// Procesado de formulario
/*if(isset($_POST['frmInputEmail'])):
  if (isset($_POST['frmInputRemember']) && $_POST['frmInputRemember'] == 1):
    $rem = 1;
  else:
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
endif;*/
//RECOJO LOS DATOS DE LA CUENTA
$db = new DataBase(DB_SERVER, DB_USER, DB_PASS, DB_NAME, 1);
$confirmKey = $_GET['clave'];
$cuenta = $db -> send("SELECT * FROM users WHERE users.confirmKey = $confirmKey");
print_r($cuenta);

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
                <h2>Confirmación de cuenta: <span><?= $name ?><span></h2>
                <form id="frmConfirm" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
                    <div class="container-fluid container-sm p-5" style="width: 20rem;">
                        <div class="mb-3">
                            <label for="frmInputPass" class="form-label"><?= __('frm_Pass', $lang) ?></label>
                            <input type="password" class="form-control" name="frmInputPass" id="frmInputPass" placeholder="password">
                        </div>
                    
                    </div>
                </form>
            </div>
        </div>

        
        <?php 
        include("includes/scripts.php");
        $db->close();
        ?>
</body>

</html>