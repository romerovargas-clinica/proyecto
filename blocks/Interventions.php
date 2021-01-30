<div class="container-fluid bg-light p-2">
  <a name="specialities"></a>
  <div class="container p-2 mt-2 mb-2 bg-white">
    <?php
    //CARGAR EL ÁRTICULO DE LA BASE DE DATOS//
    $db = new DataBase();
    $categorie = $_GET['categorie'];
    $categories = $db->send("SELECT * FROM treatmentscategories WHERE id = $categorie");
    if ($categories) : ?>
      <div class="h1"><?= $categories[0]['name'] ?></div>
      <div class="row justify-content-evenly">
        <div class="col-2">
          <img src="images/specialities/<?= $categories[0]['image'] ?>" class="img-thumbnail">
        </div>
        <div class="col-10">
          <div class="h4"><?= $categories[0]['info'] ?></div>
        </div>
      </div>

      <div class="row">
        <div class="col-2">

        </div>

        <div class="col-10">
          <div class="container-fluid container p-5">
            <?php
            $ndb = new DataBase();
            $interventions = $ndb->select('treatmentsinterventions', "categorie = " . $categories[0]['id']); ?>
            <?php foreach ($interventions as $intervention) : ?>
              <ul class="list-group list-group-flush border mb-3">
                <li class="list-group-item text-primary "><?= $intervention['name'] ?> </li>
                <li class="list-group-item text-truncate"><span class="text-secondary"><?= __('frm_Desc', $lang) . ':</span> ' . $intervention['info'] ?>
                </li>
                <li class="list-group-item"><span class="text-secondary"><?= __('frm_Duration', $lang) . ':</span> ' . $intervention['duration'] ?>
                </li>
                <li class="list-group-item"><span class="text-secondary"><?= __('frm_Price', $lang) . ':</span> ' . $intervention['price'] . '€' ?>
                </li>
              </ul>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </div>
</div>