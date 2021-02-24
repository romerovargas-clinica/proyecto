<?php
$db = new DataBase();
$result = $db->select("blocks", "id = " . $block["id"]);

if (isset($_GET['new'])) :
  include 'blocks/schedule-new-section.php';
else :
?>

  <!-- ========================= cites-section start ========================= -->
  <section id="faq" class="faq-section">

    <div class="shape shape-7">
      <img src="assets/img/shapes/shape-6.svg" alt="" class="shape-faq">
    </div>
    <div class="container">
      <div class="row">
        <div class="col-xl-8 mx-auto">
          <div class="section-title text-center mb-55">
            <span class="wow fadeInDown" data-wow-delay=".2s"><?= __($result[0]["title"], $lang) ?></span>
            <h2 class="mb-15 wow fadeInUp" data-wow-delay=".4s"><?= __($result[0]["subtitle"], $lang) ?></h2>
            <p class="wow fadeInUp" data-wow-delay=".6s"><?= __($result[0]["text"], $lang) ?></p>
            <?php if ($exito) : ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Cita fijada correctamente</strong> Se ha enviado un email a su correo a modo de recordatorio
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php endif ?>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <?php if (isAuthenticated()) : ?>
            <div class="col-lg-8 col-md-10">
              <div class="faq-content-wrapper pt-90 pb-90">
                <div class="faq-wrapper accordion" id="accordionExample">
                  <div class="faq-item mb-20">
                    <div id="headingOne">
                      <h5 class="mb-0">
                        <button class="faq-btn btn collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          <?= __('lbl_CitesHistory', $lang) ?><i class="lni"></i>
                        </button>
                      </h5>
                    </div>
                    <div id="collapseOne" class="collapse collapsed" aria-labelledby="headingOne" data-parent="#accordionExample">
                      <div class="faq-content">
                        <?php
                        $db = new DataBase();
                        $citas = $db->select("cites", "user_id = " . $_SESSION['id'] . " ORDER BY date, time_from;");
                        $historial = array();
                        $pendiente = array();
                        if ($citas) :
                          foreach ($citas as $cita) :
                            if ($cita["date"] < date("Y-m-d")) :
                              $historial[] = ["Date" => $cita["date"], "Hour" => $cita["time_from"]];
                            else :
                              $pendiente[] = ["Date" => $cita["date"], "Hour" => $cita["time_from"]];
                            endif;
                          endforeach;
                        endif;
                        ?>
                        <ul>
                          <?php
                          foreach ($historial as $cita) :
                            $day = date_create($cita["Date"]); ?>
                            <li><?= date_format($day, "d/m/Y") . " " . $cita["Hour"] ?></li>
                          <?php endforeach; ?>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="faq-item mb-20">
                    <div id="headingTwo">
                      <h5 class="mb-0">
                        <button class="faq-btn btn collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                          <?= __('lbl_CitesPending', $lang) ?><i class="lni"></i>
                        </button>
                      </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                      <div class="faq-content">
                        <ul>
                          <?php
                          foreach ($pendiente as $cita) :
                            $day = date_create($cita["Date"]); ?>
                            <li><?= date_format($day, "d/m/Y") . " " . $cita["Hour"] ?></li>
                          <?php endforeach; ?>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 text-center border">
              <div class="faq-content-wrapper">
                <div class="mt-5">
                  <a href="cites.php?new" class="btn theme-btn wow fadeInUp" data-wow-delay=".8s"><?= __('btn_NewCite', $lang) ?></a>
                </div>
              </div>
            </div>
          <?php else : ?>

            <!-- invitar a loguearse/registrarse -->

          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>
  <div style="height:20px"></div>
  <!-- ========================= cites-section end ========================= -->
<?php endif; ?>