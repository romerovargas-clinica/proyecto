<h2><?= __('mn_Meeting', $lang) ?></h2>


<?php
// recuperamos variables de navegación o creamos los valores por defecto
if (!isset($_GET['m'])) {
  $month = date("n");
} else {
  $month = $_GET['m'];
  if (!is_numeric($month) or $month < 0 or $month > 12)
    $month = date('n');
}
if (!isset($_GET['y'])) {
  $year = date("Y");
} else {
  $year = $_GET['y'];
  if (!is_numeric($year) or $year < 2011 or $year > 2020)
    $year = date("Y");
}
$mes["1"] = "enero";
$mes["2"] = "febrero";
$mes["3"] = "marzo";
$mes["4"] = "abril";
$mes["5"] = "mayo";
$mes["6"] = "junio";
$mes["7"] = "julio";
$mes["8"] = "agosto";
$mes["9"] = "septiembre";
$mes["10"] = "octubre";
$mes["11"] = "noviembre";
$mes["12"] = "diciembre";
// navegación
$numDayMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
// Primer día de la semana
$diaSemana = date("N", mktime(0, 0, 0, $month, 1, $year));
?>
<div class="container overflow-hidden">
  <div class="row gx-5">
    <div class="col">
      <div class="p-3 border bg-light text-center">
        <div class="table-responsive">
          <table class="table table-responsive .table-bordered mt-2 text-center">
            <thead>
              <?php
              $anteriorYear = $year;
              $siguienteYear = $year;
              if ($month == 1) {
                $anterior = 12;
                $anteriorYear = $year - 1;
              } else
                $anterior = $month - 1;
              if ($month == 12) {
                $siguiente = 1;
                $siguienteYear = $year + 1;
              } else
                $siguiente = $month + 1;
              ?>
              <tr class="table-primary">
                <th><a href="admin.php?section=cites&tab=1&m=<?= $anterior ?>&y=<?= $anteriorYear ?>"><span data-feather="arrow-left-circle"></span></a></th>
                <th colspan="5"><?php echo substr($mes[$month], 0, 3) . " $year" ?></th>
                <th><a href="admin.php?section=cites&tab=1&m=<?= $siguiente ?>&y=<?= $siguienteYear ?>"><span data-feather="arrow-right-circle"></span></a></th>
              </tr>
            </thead>
            <tbody>
              <tr class="table-info">
                <td>L</td>
                <td>M</td>
                <td>M</td>
                <td>J</td>
                <td>V</td>
                <td>S</td>
                <td>D</td>
              </tr>
              <?php
              $dia = 1;
              $filas = ceil(($diaSemana - 1 + $numDayMonth) / 7);
              $hoy = date("Y-m-d");
              for ($s = 0; $s < $filas; $s++) : ?>
                <tr class="table-warning">
                  <?php for ($d = 0; $d < 7; $d++) : ?>
                    <?php if (($s == 0 && $d < ($diaSemana - 1)) || $dia > $numDayMonth) : ?>
                      <td></td>
                    <?php else : ?>
                      <?php if ($d != 6 && date_create($year . "-" . $month . "-" . $dia)->format('Y-m-d') > $hoy) : ?>
                        <?php // dias elegibles por el usuario 
                        if ($dia == date('d') && $month == date('m') && $year = date('Y')) : ?>
                          <td class="day-calendar"><a href="admin.php?section=cites&tab=2&day=<?= $dia ?>&m=<?= $month ?>&y=<?= $year ?>" class="text-decoration-none"><?= $dia ?></a></td>
                        <?php else : ?>
                          <td class="day-calendar table-warning"><a href="admin.php?section=cites&tab=2&day=<?= $dia ?>&m=<?= $month ?>&y=<?= $year ?>" class="text-decoration-none"><?= $dia ?></a></td>
                        <?php endif ?>
                      <?php else : ?>
                        <td class="table-secondary"><a href="admin.php?section=cites&tab=2&day=<?= $dia ?>&m=<?= $month ?>&y=<?= $year ?>" class="text-decoration-none"><?= $dia ?></a></td>
                      <?php endif; ?>
                    <?php $dia++;
                    endif; ?>
                  <?php endfor; ?>
                </tr>
              <?php endfor ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="p-3 border bg-light">
        <div class="card">
        <?php
          $db = new Database();
          if(isset($_GET["day"])):
            $fechamostrar = $_GET["y"] . "-" . $_GET["m"] . "-" . $_GET["day"];
          else:
            $fechamostrar = date("Y-m-d");            
          endif;
          $a = explode("-", $fechamostrar);
          $fechaformat = $a[2] . "/" . $a[1] . "/" . $a[0];
          $cites = $db->send("SELECT * FROM cites a INNER JOIN users b ON a.user_id = b.id WHERE a.date = '" . $fechamostrar . "' ORDER BY a.time_from");
          ?>
          <div class="card-header">            
            Citas <?= $fechaformat ?>
          </div>
          <div class="card-body">
            <h5 class="card-title">Registradas las siguientes citas:</h5> <?php //TODO TRADUCIR // ?>
            <p class="card-text"></p>
            <?php            
            if ($cites) :
              echo "<ul>";
              foreach ($cites as $cite) : ?>
                <li>
                  <?= $cite["time_from"] . " / " . $cite["time_until"] . " | " . $cite["firstname"] . " " . $cite["lastname"] ?>
                </li>
            <?php endforeach;
              echo "</ul>";
            else :
              echo "<ul><li>No existen citas</li></ul>";
            endif;
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>