<a name="specialties"></a>
<div class="container bg-light" style="border-top: 8px solid black">
  <?php
  // Parámetros de configuración del bloque
  $specialties = $db->select("block", "name = '" . $name_block . "'");
  //$num_articles = $articles[0]['num#1'];
  //$truncate = 0;
  //if($articles[0]['num#2']==1) $truncate = $articles[0]['num#3'];
  $recordset = $db->send("SELECT * FROM treatmentsCategories;");
  ?>
  <div class="row" style="border-top: 8px solid #00A797">
    <nav class="navbar navbar-expand-lg bg-primary shadow navbar-dark" style="padding-top: 0">
      <a class="navbar-brand" href="#"><?= $name_block ?></a>
    </nav>
  </div>
  <div class="d-flex p-2 bd-highlight flex-wrap justify-content-around">
    <?php foreach ($recordset as $specialty) : ?>
      <div class="p-2 bd-highlight text-center">
        <div class="card" style="width: 18rem;">
          <figure class="figure" style="margin-top:5px">
            <?php if (isset($specialty['image']) && $specialty['image'] != "") : ?>
              <img src="images/specialties/<?= $specialty['image'] ?>" class="t-opacity">
            <?php endif; ?>
          </figure>
          <div class="card-header"><?= $specialty['name'] ?></div>

        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>