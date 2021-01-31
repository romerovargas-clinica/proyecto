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
      <th><a href="cites.php?new&tab=1&m=<?= $anterior ?>&y=<?= $anteriorYear ?>"><i class="fas fa-chevron-circle-left"></i></a></th>
      <th colspan="5"><?php echo substr($mes[$month], 0, 3) . " $year" ?></th>
      <th><a href="cites.php?new&tab=1&m=<?= $siguiente ?>&y=<?= $siguienteYear ?>"><i class="fas fa-chevron-circle-right"></i></a></th>
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
                <td class="day-calendar"><a href="cites.php?new&tab=2&day=<?= $dia ?>&m=<?= $month ?>&y=<?= $year ?>" class="text-decoration-none"><?= $dia ?></a></td>
              <?php else : ?>
                <td class="day-calendar table-warning"><a href="cites.php?new&tab=2&day=<?= $dia ?>&m=<?= $month ?>&y=<?= $year ?>" class="text-decoration-none"><?= $dia ?></a></td>
              <?php endif ?>
            <?php else : ?>
              <td class="table-secondary"><?= $dia ?></td>
            <?php endif; ?>
          <?php $dia++;
          endif; ?>
        <?php endfor; ?>
      </tr>
    <?php endfor ?>
  </tbody>
</table>