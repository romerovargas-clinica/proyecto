<?php
// ESTE ES EL BLOQUE DE AGENDA. 
// PARA QUE SE MUESTRE CORRECTAMENTE, NECESITAMOS:
//    1. Usuario Identificado  

?>

<div class="container-fluid bg-light p-2">
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
                    <strong>Aquí aparecerán todas las citas que el cliente haya tenido anteriormente</strong>
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
                    <strong>Aquí estarán las citas que tenga pendientes</strong>
                  </div>
                </div>
              </div>
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