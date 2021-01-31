<?php
$tab = array();
$tabDisabled = " disabled\" aria-disabled=\"true";
$tabActive = " active\" aria-current=\"page";
$tabEnabled = "";

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
endif;

if (isset($_GET["tab"])) :
  $_SESSION["cite"]["step"] = $_GET["tab"];
endif;

switch ($_SESSION["cite"]["step"]):
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
endswitch;
?>

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
            switch ($_SESSION["cite"]["step"]):
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
              <!-- <a class="btn btn-primary btn-md m-5" href="cites.php?new" role="button"><?= __('btn_NewCite', $lang) ?></a> -->
            </div>
          </div>
        </div>
        <div class="col-4 border border-2">
          <?php
          $ndb = new DataBase();
          $trataiments = $ndb->select("treatmentsinterventions", "id = " . $_SESSION["cite"]["intervention"]);
          if ($trataiments) : ?>
            <h4><span class="badge bg-secondary mt-2"><a href="cites.php?new" class="text-decoration-none text-white"><?= $trataiments[0]["name"] ?></a></span></h4>
          <?php endif;
          if (isset($_SESSION["cite"]["date"])) : ?>
            <h4><span class="badge bg-secondary mt-2"><a href="cites.php?new" class="text-decoration-none text-white"><?= $_SESSION["cite"]["date"] ?></a></span></h4>
          <?php endif;
          ?>

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