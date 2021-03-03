<?php

$tab = array();
$tabDisabled = " disabled\" aria-disabled=\"true";
$tabActive = " active\" aria-current=\"page";
$tabEnabled = "";

if (isset($_GET['hourfrom'])) :
  $_SESSION["cite"]["hourfrom"] = $_GET['hourfrom'];
  $_SESSION["cite"]["houruntil"] = $_GET['houruntil'];
endif;

if (isset($_GET["intervention"])) :
  $_SESSION["cite"]["step"] = 1;
  $_SESSION["cite"]["intervention"] = $_GET["intervention"];
  unset($_SESSION["cite"]["date"]);
  unset($_SESSION["cite"]["time"]);
endif;

if (isset($_GET["day"])) :
  $_SESSION["cite"]["step"] = 2;
  $_SESSION["cite"]["date"] = $_GET["day"] . "/" . $_GET["m"] . "/" . $_GET["y"];
  unset($_SESSION["cite"]["time"]);
endif;

if (isset($_SESSION["cite"]["step"])) :
  $step = $_SESSION["cite"]["step"];
else :
  $step = 0;
endif;

if (isset($_GET["tab"])) :
  $_SESSION["cite"]["step"] = $_GET["tab"];
endif;

switch ($step):
  case 0:
    $tab[0] = $tabActive;
    if (!isset($_SESSION["cite"]["intervention"])) $tab[1] = $tabDisabled;
    else $tab[1] = $tabEnabled;
    $tab[2] = $tabDisabled;
    break;
  case 1:
    $tab[0] = $tabEnabled;
    $tab[1] = $tabActive;
    $tab[2] = $tabDisabled;
    break;
  case 2:
    $tab[0] = $tabEnabled;
    $tab[1] = $tabEnabled;
    $tab[2] = $tabActive;
    break;
  case 3:
    $tab[0] = $tabEnabled;
    $tab[1] = $tabEnabled;
    $tab[2] = $tabActive;
endswitch;
?>


<!-- ========================= cites-new-section start ========================= -->
<section id="faq" class="faq-section">
  <div class="container-fluid bg-light p-2">
    <a name="schedule"></a>
    <div class="container p-2 mt-2 mb-2 bg-white">
      <div class="h1"><?= __('btn_NewCite', $lang) ?></div>
      <div class="row">
        <?php if (isAuthenticated()) : ?>
          <div class="col-8">
            <div class="container-fluid container p-1">
              <ul class="nav nav-pills">
                <li class="nav-item">
                  <a class="nav-link<?= $tab[0] ?>" href="cites.php?new&tab=0">Seleccione el tipo de tratamiento</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link<?= $tab[1] ?>" href="cites.php?new&tab=1">Seleccione un Día</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link<?= $tab[2] ?>" href="cites.php?new&tab=2">Seleccione una hora</a>
                </li>
              </ul>
              <?php
              // Son tres acciones, guardamos cada una en una variable de sesión (vaciar en el último paso).
              // Si el usuario pierde el foco o se equivoca de enlace, al volver aquí recupera las opciones que hubiera elegido antes
              // En este punto valoramos en qué apartado está, ofreciendo las opciones correspondientes
              switch ($step):
                case 0:
                  include("blocks/schedule-specialties.php");
                  break;
                case 1:
                  include("blocks/schedule-calendar.php");
                  break;
                case 2:
                  include("blocks/schedule-hours.php");
                  break;
              endswitch;
              ?>
              <div>

              </div>
            </div>
          </div>
          <div class="col-4 border border-2">
            <div class="bd-highlight fs-2">Tu cita</div><!-- to-do traducir -->
            <form id="frmCites" method="POST" action="cites.php?new">
              <div class="card">
                <div class="card-body">
                  <?php
                  if (isset($_SESSION["cite"]["intervention"])) :
                    $ndb = new DataBase();
                    $trataiments = $ndb->select("treatmentsinterventions", "id = " . $_SESSION["cite"]["intervention"]);
                    if ($trataiments) : ?>
                      <h5 class="card-title">
                        <a href="cites.php?new" class="text-decoration-none"><?= $trataiments[0]["name"] ?></a>
                      </h5>
                      <div class="card-body">
                      <?php endif;
                    if (isset($_SESSION["cite"]["date"])) : ?>
                        <p class="card-text">
                          <?= __('budget-list-date', $lang) ?>:
                          <a href="cites.php?new&tab=1" class="text-decoration-none"><?= $_SESSION["cite"]["date"] ?>
                          </a>
                        </p>
                      <?php endif;
                    if (isset($_SESSION["cite"]["hourfrom"])) : ?>
                        <p class="card-text">
                          <?= __('schedule-section-hour', $lang) ?>:
                          <a href="cites.php?new&tab=2" class="text-decoration-none"><?= $_SESSION["cite"]["hourfrom"] . " - " . $_SESSION["cite"]["houruntil"] ?></a>
                        </p>
                    <?php endif;
                  endif; ?>
                    <div class="card-footer">
                      <?php if (isset($_SESSION["cite"]["hourfrom"])) : ?>
                        <input type="hidden" name="trataiments" value="<?= $_SESSION["cite"]["intervention"] ?>">
                        <input type="hidden" name="date" value="<?= $_SESSION["cite"]["date"] ?>">
                        <input type="hidden" name="hourfrom" value="<?= $_SESSION["cite"]["hourfrom"] ?>">
                        <input type="hidden" name="houruntil" value="<?= $_SESSION["cite"]["houruntil"] ?>">
                        <button type="button" class="btn theme-btn wow fadeInUp" data-wow-delay=".8s" data-bs-toggle="modal" data-bs-target="#myModal"><?= __('btn_NewCite', $lang) ?></button>
                      <?php endif; ?>
                    </div>
                      </div>
                </div>
            </form>
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

</section>
<!-- Modal -->
<?php

?>
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?= __('modal_title_confirm', $lang) ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body"><?= __('modal_cite_confirm', $lang) ?></div>
      <div class="modal-body">
        <?= $trataiments[0]["name"] ?> <br /> <?= $_SESSION["cite"]["date"] ?> <br> <?= $_SESSION["cite"]["hourfrom"] . " - " . $_SESSION["cite"]["houruntil"] ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?= __('btn_Close', $lang) ?></button>
        <button type="button" class="btn btn-primary" onclick="aceptar();"><?= __('btn_Ok', $lang) ?></button>
      </div>
    </div>
  </div>
</div>

<script>
  function aceptar() {
    document.getElementById("frmCites").submit();
  }
</script>