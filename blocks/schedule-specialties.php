<div class="faq-content-wrapper pt-90 pb-90">
  <div class="faq-wrapper accordion" id="accordionExample">
    <?php
    $db = new DataBase();
    $treatments = $db->select("treatmentscategories", "1 = 1");
    $countTabs = 0;
    $collapsed = array("One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Teen");
    $cont = 0;
    if ($treatments) :
      foreach ($treatments as $categoria) :
        $tratamientos[] = ["id" => $categoria["id"], "nombre" => $categoria["name"]]; ?>

        <div class="faq-item mb-20">
          <div id="heading<?= $collapsed[$cont] ?>">
            <h5 class="mb-0">
              <button class="faq-btn btn collapsed" type="button" data-toggle="collapse" data-target="#collapse<?= $collapsed[$cont] ?>" aria-expanded="true" aria-controls="collapse<?= $collapsed[$cont] ?>">
                <?= $categoria["name"] ?><i class="lni"></i>
              </button>
            </h5>
            <div id="collapse<?= $collapsed[$cont] ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $countTabs ?>" data-bs-parent="#accordionExample">
              <div class="faq-content">
                <ul>
                  <?php
                  $interventions = $db->select("treatmentsinterventions", "categorie = " . $categoria["id"]);
                  if ($interventions) :
                    foreach ($interventions as $intervention) : ?>
                      <li>
                        <h4><span class="badge bg-primary"><a href="cites.php?new&intervention=<?= $intervention["id"] ?>" class="text-decoration-none text-white"><?= $intervention["name"] ?></a></span></h4>
                      </li>
                  <?php endforeach;
                  endif; ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
    <?php
        $countTabs++;
        $cont++;
      endforeach;
    endif;
    ?>
  </div>
</div>
</div>