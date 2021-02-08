<?php
if (isset($_GET['new'])) :
  include 'blocks/schedule_new.php';
else :
?>
  <div class="container-fluid bg-light p-2">
    <?php if ($exito) : ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Cita fijada correctamente</strong> Se ha enviado un email a su correo a modo de recordatorio
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif ?>
    <a name="schedule"></a>
    <div class="container p-2 mt-2 mb-2 bg-white">
      <div class="h1"><?= __('mn_Cites', $lang) ?></div>
      <div class="row">
        <?php if (isAuthenticated()) : ?>
          <div class="col-lg">
            <div class="container-fluid container p-1">
              <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                      <?= __('lbl_CitesHistory', $lang) ?>
                    </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
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
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      <?= __('lbl_CitesPending', $lang) ?>
                    </button>
                  </h2>
                  <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
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
              <div>
                <a class="btn btn-primary btn-md m-5" href="cites.php?new" role="button"><?= __('btn_NewCite', $lang) ?></a>
              </div>
            </div>
          </div>
          <div class="col-sm">
            <img src="images/carousel/chair-2589771_640.jpg" class="img-thumbnail">
          </div>
        <?php else : ?>
          <!-- el usuario no está identificado, mostrar mensaje -->
          <div class="col align-self-center">
            <div class="alert alert-danger bottom-50" role="alert">
              <?= __('err_NotAutenticates', $lang) ?>
              <div class="clearfix"></div>
              <a class="btn btn-primary btn-md m-5" href="login.php" role="button"><?= __('mn_Login', $lang) ?></a>
            </div>
          </div>
        <?php endif ?>
      </div>
    </div>
  </div>
<?php
endif;
?>