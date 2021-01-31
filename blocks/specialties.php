<div class="container-fluid bg-light p-2">
  <a name="specialties"></a>
  <div class="container p-2 mt-2 mb-2 bg-white">
    <div class="h1"><?= __('mn_Speciality', $lang) ?></div>
    <!-- specialties -->
    <?php
    // Parámetros de configuración del bloque
    $specialties = $db->select("block", "name = '" . $name_block . "'");
    $recordset = $db->send("SELECT * FROM treatmentscategories;"); ?>
    <div class="row">
      <div class="d-flex p-2 bd-highlight flex-wrap justify-content-around">
        <?php foreach ($recordset as $specialty) : ?>
          <div class="p-2 bd-highlight text-center">
            <div class="card card-shadow" style="width:140px;" onclick="window.location='../categorieInterventions.php?categorie=<?= $specialty['id'] ?>';">
              <figure class="figure mt-2">
                <?php if (isset($specialty['image']) && $specialty['image'] != "") : ?>
                  <img src="images/specialities/<?= $specialty['image'] ?>" class="t-opacity">
                <?php endif; ?>
              </figure>
              <div class="card-header text-wrap" style="font-size: 12px"><?= $specialty['name'] ?></div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

    </div>
  </div>
</div>