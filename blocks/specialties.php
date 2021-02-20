<!--========================= specialties-block start ========================= -->
<?php
// Parámetros de configuración del bloque
$specialties = $db->select("block", "name = '" . $name_block . "'");
$recordset = $db->send("SELECT * FROM treatmentscategories;"); ?>

<section class="faq-section theme-bg">
  <div class="faq-video-wrapper">
    <div class="faq-video">
      <img src="images/specialities/<?= $specialty['image'] ?>" alt="">
      <div class="video-btn">
        <a class="popup-video glightbox" href="#"><i class="lni lni-play"></i></a>
      </div>
    </div>
  </div>
  <div class="shape">
    <img src="assets/img/shapes/shape-8.svg" alt="" class="shape-faq">
  </div>
  <div class="container">
    <div class="row">
      <div class="col-xl-6 offset-xl-6 col-lg-8 col-md-10">
        <div class="faq-content-wrapper pt-90 pb-90">
          <div class="section-title">
            <span class="text-white wow fadeInDown" data-wow-delay=".2s"><?= __('mn_Speciality', $lang) ?></span>
            <h2 class="text-white mb-35 wow fadeInUp" data-wow-delay=".4s">Estos son nuestos tratamientos</h2>
          </div>
          <div class="faq-wrapper accordion" id="accordionExample">
            <?php foreach ($recordset as $specialty) : ?>
              <div class="faq-item mb-20">
                <div id="headingOne">
                  <h5 class="mb-0">
                    <button class="faq-btn btn" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">

                      <i class="lni"></i>
                    </button>
                  </h5>
                </div>





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

          <div class="container-fluid bg-light p-2">
            <a name="specialties"></a>
            <div class="container p-2 mt-2 mb-2 bg-white">
              <div class="h1"><?= __('mn_Speciality', $lang) ?></div>
              <!-- specialties -->

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
        </div>
      </div>
    </div>
  </div>
</section>
<!--========================= specialties-block end ========================= -->