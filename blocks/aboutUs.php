<div class="container-fluid bg-light p-2">
    <a name="aboutus"></a>
    <div class="container p-2 mt-2 mb-2 bg-white">
        <div class="h1"><?= __($tt_name_int, $lang) ?></div>
        <!-- about -->
        <?php
        // Parámetros de configuración del bloque
        // El contenido de esta sección se extrae de la tabla articles (categoría=2)
        $specialties = $db->select("block", "name = '" . $name_block . "'");
        $recordset = $db->send("SELECT * FROM block where name = '$name_block';");
        $articles = $db->select("articles", "category=2"); ?>
        <?php foreach ($articles as $article) : ?>
            <div class="row">
                <div class="col-lg">
                    <div class="container-fluid container-sm p-5" style="width: 20rem;">
                        <div class="col-sm">
                            <img class="img-thumbnail" src="<?= idToImage($article["image_id"]) ?>">
                        </div>
                    </div>
                </div>

                <div class="col-8">
                    <div class="bd-highlight fs-2"><?= $article["title"] ?></div>
                    <hr>
                    <div class="container p-1 mb-2"><?= $article["subtitle"] ?></div>
                    <div class="container"><?= $article["text"] ?></div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>