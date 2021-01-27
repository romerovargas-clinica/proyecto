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
$db = new DataBase();
$categorie = $_GET['categorie'];
$categories = $db->send("SELECT * FROM treatmentscategories WHERE id = $categorie");

$db->close();
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<?php require "sections/head.php"; ?>

<body>
<?php
include "sections/header.php";
include "sections/navbar.php";
?>

<div class="d-flex p-2 bd-highlight flex-wrap justify-content-around">
    <?php if ($categories): ?>
        <div class="card mb-3 w-75" style="">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="images/interventions/<?= $categories[0]['image'] ?>" class="t-opacity">
                    <!--TODO imagenes -->
                </div>
                <div class="col-md-8 p-2">
                    <div class="container">
                        <h5 class="card-title"><?= $categories[0]['name'] ?></h5>
                        <p class="card-text"><?= $categories[0]['info'] ?> </p>
                        <?php
                        $ndb = new DataBase();
                        $interventions = $ndb->select('treatmentsinterventions', "categorie = " . $categories[0]['id']); ?>

                        <?php foreach ($interventions as $intervention) : ?>
                            <ul class="list-group list-group-flush border mb-3">
                                <li class="list-group-item text-primary "><?= $intervention['name'] ?> </li>
                                <li class="list-group-item text-truncate"><span
                                            class="text-secondary"><?= __('frm_Desc', $lang) . ':</span> ' . $intervention['info'] ?>
                                </li>
                                <li class="list-group-item"><span
                                            class="text-secondary"><?= __('frm_Duration', $lang) . ':</span> ' . $intervention['duration'] ?>
                                </li>
                                <li class="list-group-item"><span
                                            class="text-secondary"><?= __('frm_Price', $lang) . ':</span> ' . $intervention['price'] . '€' ?>
                                </li>
                            </ul>

                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php
$db->close();
include "sections/footer.php";
include "includes/scripts.php";
?>
</body>

</html>