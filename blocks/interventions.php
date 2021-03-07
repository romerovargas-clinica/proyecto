<?php
$db = new DataBase();
$categorie = $_GET['categorie'];
$categories = $db->send("SELECT * FROM treatmentscategories WHERE id = $categorie");
?>

<!--========================= interventions-block start ========================= -->
<section class="faq-section theme-bg">
  <div class="faq-video-wrapper">
    <div class="faq-video">
      <img src="images/specialities/<?= $categories[0]['image'] ?>" alt="">

    </div>
    <div class="shape">
      <img src="assets/img/shapes/shape-8.svg" alt="" class="shape-faq">
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-xl-6 offset-xl-6 col-lg-8 col-md-10">
        <div class="faq-content-wrapper pt-90 pb-90">
          <div class="section-title">
            <span class="text-white wow fadeInDown" data-wow-delay=".2s"><?= __('mn_Speciality', $lang) ?></span>
            <h2 class="text-white mb-35 wow fadeInUp" data-wow-delay=".4s"><?= $categories[0]["name"] ?></h2>
          </div>
          <div class="faq-wrapper accordion" id="accordionExample">
            <?php
            $ndb = new DataBase();
            $interventions = $ndb->select('treatmentsinterventions', "categorie = " . $categorie);
            $collapsed = array("One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Teen");
            $cont = 0;
            if($interventions):
            foreach ($interventions as $intervention) : ?>
              <div class="faq-item mb-20">
                <div id="heading<?= $collapsed[$cont] ?>">
                  <h5 class="mb-0">
                    <button class="faq-btn btn<?= $cont != 0 ? " collapsed" : "" ?>" type="button" data-toggle="collapse" data-target="#collapse<?= $collapsed[$cont] ?>" aria-expanded="true" aria-controls="collapse<?= $collapsed[$cont] ?>">
                      <?= $intervention['name'] ?><i class="lni"></i>
                    </button>
                  </h5>
                </div>
                <div id="collapse<?= $collapsed[$cont] ?>" class="collapse<?= $cont == 0 ? " show" : "" ?>" aria-labelledby=" heading<?= $collapsed[$cont] ?>" data-parent="#accordionExample">
                  <div class="faq-content">

                    <?= $intervention['info'] ?>
                  </div>
                  <?php
                  if (file_exists("images/uploads/" . $intervention['image'])) :
                    $_img = "images/uploads/" . $intervention['image'];
                  else :
                    $_img = "images/blank.png";
                  endif;
                  ?>
                  <div class="mx-auto">
                    <div class="card mx-auto" style="width: 18rem;">
                      <img class="card-img-top" src="<?= $_img ?>" class="crop rounded d-block" alt="">
                      <div class="card-body">
                        <p class="card-text"><?= $intervention['name'] ?></p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php $cont++ ?>
            <?php endforeach; 
            endif;?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--========================= interventions-block end ========================= -->