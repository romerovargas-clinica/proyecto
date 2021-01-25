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
$db = new DataBase(DB_SERVER, DB_USER, DB_PASS, DB_NAME, 1);
$categorie = $_GET['categorie'];
$interventions = $db->send("SELECT * FROM treatmentsInterventions WHERE  categorie = $categorie");



$db->close();
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<?php require "sections/head.php"; ?>

<body >
    <?php
    include "sections/header.php";
    include "sections/navbar.php";
    ?>

    <div class="d-flex p-2 bd-highlight flex-wrap justify-content-around">
        <?php foreach ($interventions as $intervention) : ?>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="images/interventions/<?= $intervention['image'] ?>" class="t-opacity"> <!--TODO imagenes -->
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $intervention['name'] ?></h5>
                            <p class="card-text"><?= $intervention['info'] ?> </p>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><?= __('frm_Duration',$lang).': '. $intervention['duration'] ?> </li>
                                <li class="list-group-item"><?= __('frm_Price',$lang).': '. $intervention['price'].'€'?> </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php
    $db->close();
    include "sections/footer.php";
    include "includes/scripts.php";
    ?>
</body>

</html>