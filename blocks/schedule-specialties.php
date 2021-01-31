<div class="accordion mt-2" id="accordionExample">
  <?php
  $db = new DataBase();
  $treatments = $db->select("treatmentscategories", "1 = 1");
  $countTabs = 0;
  if ($treatments) :
    foreach ($treatments as $categoria) :
      $tratamientos[] = ["id" => $categoria["id"], "nombre" => $categoria["name"]]; ?>
      <div class="accordion-item">
        <h2 class="accordion-header" id="heading<?= $countTabs ?>">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $countTabs ?>" aria-expanded="false" aria-controls="collapse<?= $countTabs ?>">
            <?= $categoria["name"] ?>
          </button>
        </h2>
        <div id="collapse<?= $countTabs ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $countTabs ?>" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <ul>
              <?php
              $interventios = $db->select("treatmentsinterventions", "categorie = " . $categoria["id"]);
              foreach ($interventios as $intervention) : ?>
                <li>
                  <h4><span class="badge bg-primary"><a href="cites.php?new&intervention=<?= $intervention["id"] ?>" class="text-decoration-none text-white"><?= $intervention["name"] ?></a></span></h4>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </div>
  <?php
      $countTabs++;
    endforeach;
  endif;
  ?>
</div>