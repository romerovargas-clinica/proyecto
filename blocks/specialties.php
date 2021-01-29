<a name="specialties"></a>
<div class="container" style="border-top: 8px solid white">
  <?php
  // Parámetros de configuración del bloque
  $specialties = $db->select("block", "name = '" . $name_block . "'");
  //$num_articles = $articles[0]['num#1'];
  //$truncate = 0;
  //if($articles[0]['num#2']==1) $truncate = $articles[0]['num#3'];
  $recordset = $db->send("SELECT * FROM treatmentscategories;");
  ?>
  <div class="row" style="border-top: 8px solid black">
    <nav class="navbar navbar-expand-lg  shadow navbar-dark" style="padding-top: 0; background-color:#0ee3d8">
      <a class="navbar-brand" href="#"><?= $name_block ?></a>
    </nav>
  </div>
  <!-- MUESTRA DE FLEX -->
  <div class="d-flex p-2 bd-highlight flex-wrap justify-content-around">
    <?php foreach ($recordset as $specialty) : ?>
      <div class="p-2 bd-highlight text-center">
        <div class="card" style="width:140px;" onclick="window.location='../categorieInterventions.php?categorie=<?= $specialty['id'] ?>';">
          <figure class="figure mt-2">
            <?php if (isset($specialty['image']) && $specialty['image'] != "") : ?>
              <img src="images/specialties/<?= $specialty['image'] ?>" class="t-opacity">
            <?php endif; ?>
          </figure>
          <div class="card-header" style="font-size: 9px"><?= $specialty['name'] ?></div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>