<?php
$ndb = new DataBase();
$trataiments = $ndb->select("treatmentsinterventions", "id = " . $_SESSION["cite"]["intervention"]);
if ($trataiments) :
  $duration = $trataiments[0]["duration"];
  // construimos una tabla de horas para el día elegido, eliminando los huecos ya ocupados por citas anteriores teniendo en cuenta la duración de esta intervención
  $fecha = explode("/", $_SESSION["cite"]["date"]);
  $citas = $ndb->select("cites", "date = '" . $fecha[2] . "-" . $fecha[1] . "-" . $fecha[0] . "'");
  // leer parámetros de la tabla settings
  $horario_apertura = "09:00";
  $horario_de_atencion_total = 600; // 10 horas (09-14/16-20)  => TODO Extraer de tabla settings en la configuración  
  $hora_comida = new DateTime("14:00");
  $hora_fin_comida = new DateTime("16:00");
  $minutos_primer_tramo = 300;
  $minutos_segundo_tramo = 300;
  $horario_de_descanso[] = ["desde" => $hora_comida, "hasta" => $hora_fin_comida];

  $tramos = ceil($minutos_primer_tramo / $duration);
  $a = 0;
  $inicio = $horario_apertura;
  $disponibles = array();
  $ocupped = array();
  while ($a < $tramos) :
    $ini = new DateTime($inicio);
    $fin = new DateTime($inicio);
    $fin->modify('+ ' . $duration . ' minute');
    $disponibles[] = ["desde" => $ini, "hasta" => $fin];
    $inicio = $fin->format("H:i");
    $a++;
  endwhile;

  $tramos = ceil($minutos_segundo_tramo / $duration);
  $a = 0;
  $inicio = $hora_fin_comida->format("H:i");
  while ($a < $tramos) :
    $ini = new DateTime($inicio);
    $fin = new DateTime($inicio);
    $fin->modify('+ ' . $duration . ' minute');
    $disponibles[] = ["desde" => $ini, "hasta" => $fin];
    $inicio = $fin->format("H:i");
    $a++;
  endwhile;
?>

  <div class="container mt-2">
    <?php if ($citas) :
      foreach ($citas as $ocupado) :
        $ocupped[] = ["desde" => strtotime($ocupado["time_from"]), "hasta" => strtotime($ocupado["time_until"])];
      endforeach;
    endif;


    foreach ($disponibles as $libre) :
      $posible = true;
      $tramo_ini = new DateTime($libre["desde"]->format("H:i"));
      $tramo_fin = new DateTime($libre["hasta"]->format("H:i"));
      foreach ($ocupped as $oc) :
        /*echo "<br>";
        var_dump($libre["desde"]);
        echo "<br>";
        var_dump($tramo_ini);
        echo "<br>";
        var_dump($oc["desde"]);*/
        if ($tramo_ini->getTimestamp() < $oc["desde"] && $tramo_fin->getTimestamp() > $oc["desde"]) {
          $posible = false;
        }
        if ($tramo_ini->getTimestamp() > $oc["desde"] && $tramo_fin->getTimestamp() < $oc["desde"]) {
          $posible = false;
        }
      endforeach;
      foreach ($horario_de_descanso as $oc) :
        if ($tramo_ini < $oc["desde"] && $tramo_fin > $oc["desde"]) {
          $posible = false;
        }
        /*echo "<br>";
        var_dump($tramo_ini);
        echo "<br>";
        var_dump($tramo_fin);
        echo "<br>";
        var_dump($oc["desde"]);
        echo "<br>";
        var_dump($oc["hasta"]);*/
        if ($tramo_ini > $oc["desde"] && $tramo_fin <= $oc["hasta"]) {
          $posible = false;
        }
      endforeach;
      if ($posible) {
        echo "<div class='badge bg-primary me-1'><a class='text-decoration-none text-white' href='cites.php?new&time_from=" . $libre["desde"]->format("H:i") . "&time_until=" . $libre["hasta"]->format("H:i") . "'>" . $libre["desde"]->format("H:i") . "-" . $libre["hasta"]->format("H:i") . "</a></div>";
      } else {
        echo "<div class='badge bg-secondary me-1'>" . $libre["desde"]->format("H:i") . "-" . $libre["hasta"]->format("H:i") . "</div>";
      }
    endforeach;

    ?>
  </div>
<?php endif; ?>