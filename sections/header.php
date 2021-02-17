<?php include('sections/navbar.php') ?>
<!-- LEER BASE DE DATOS -->
<?php
$db = new DataBase(DB_SERVER, DB_USER, DB_PASS, DB_NAME, 1);
$publi = $db->send("SELECT * FROM publi WHERE enable = 1");
$db->close();
//SOlO SE MOSTRARA LA PRIMERA ENABLE
?>
<div class="header container-fluid position-relative">
    <div class="d-flex position-absolute bottom-0 start-50 translate-middle-x">
        <div class="card bg-transparent text-primary mb-2 border-0" style="">
            <?php if (isset($publi)) : ?>
                <?php if ($publi[0]['block1'] != "") : ?>
                    <div class="card-header bg-transparent text-center">
                        <h2 class="text-shadow text-white"><?= $publi[0]['block1'] ?></span></h2>
                    </div>
                <?php endif; ?>

                <div class="card-body bg-transparent text-center">
                    <h1 class="text-shadow text-white"><?= $publi[0]['title'] ?></h1>
                </div>

                <?php if ($publi[0]['block2'] != "") : ?>
                    <div class="card-footer bg-transparent text-center">
                        <h2 class="text-shadow text-white"><?= $publi[0]['block2'] ?></h2>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>