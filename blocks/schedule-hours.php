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
    /*
      if ($posible) {
        echo "<div class='badge bg-primary me-1'><a class='text-decoration-none text-white' href='cites.php?new&time_from=" . $libre["desde"]->format("H:i") . "&time_until=" . $libre["hasta"]->format("H:i") . "'>" . $libre["desde"]->format("H:i") . "-" . $libre["hasta"]->format("H:i") . "</a></div>";
      } else {
        echo "<div class='badge bg-secondary me-1'>" . $libre["desde"]->format("H:i") . "-" . $libre["hasta"]->format("H:i") . "</div>";
      }
      */
    endforeach;

    ?>
  </div>
<?php endif; ?>
<div class="container mt-2">
  <table class="table">
    <tr>
      <td>
        <div class='me-1'><?= $trataiments[0]['name'] ?>:</div>
        <div class='me-1' id="duration" value="<?= $trataiments[0]['duration'] ?>"><?= $trataiments[0]['duration'] . " minutos" ?></div>

        <?php
        if ($citas) :
          $cont = 0;
          foreach ($citas as $ocupado) :
            $ocupped[] = ["desde" => strtotime($ocupado["time_from"]), "hasta" => strtotime($ocupado["time_until"])];
        ?>
            <div class="visually-hidden from" value="<?= $ocupado["time_from"] ?>"></div>
            <div class="visually-hidden until" value="<?= $ocupado["time_until"] ?>"></div>
        <?php
            $cont++;
          endforeach;
        endif;
        ?>
      </td>
    </tr>
    <tr>
      <td>
        <div class='badge bg-secondary me-1' id="lbl"></div>
      </td>
    </tr>
    <tr>
      <td><input type="range" class="form-range" min="0" max="600" step="15" id="customRange3"></td>
    </tr>
  </table>
</div>
<div class="col-xl-4 text-center">
  <div class="faq-content-wrapper">
    <div class="mt-5">
      <a id="bttn_hours" class="btn theme-btn wow fadeInUp" data-wow-delay=".8s" style="visibility: hidden"></a>
    </div>
  </div>
</div>

<script>
  // cambios de idioma
  /*
  const selectElement = document.getElementById('selectlang');
  selectElement.addEventListener('change', (event) => {
  	let url = window.location.href.toString();
  	const regex = /\?lang\=[a-z]\*/
  /*g;
  			url = url.replace(regex, '');
  			window.location.href = url + '?lang=' + selectElement.value;
  		});
  		*/
  // selector horario para citas
  const selectHour = document.getElementById('customRange3');
  const lblHours = document.getElementById("lbl");
  const widthLbl = lblHours.scrollWidth;
  selectHour.value = 0;
  const duration = document.getElementById('duration').getAttribute("value");
  const dur = parseInt(duration);
  var h = "9";
  var m = "0";

  function horas(h) {
    if (h < 10) {
      return "0" + h;
    } else {
      return h.toString();
    }
  }

  function minutos(m) {
    if (m < 10) {
      return "0" + m;
    } else {
      return m.toString();
    }
  }

  function hourIsBetween(h_inicio, h_fin, h_inicio_ocupada, h_fin_ocupada) {
    let f_inicio = Date.parse("Thu dec 28 1972 " + h_inicio + ":00 GMT");
    let f_fin = Date.parse("Thu dec 28 1972 " + h_fin + ":00 GMT");
    let f_inicio_ocupada = Date.parse("Thu dec 28 1972 " + h_inicio_ocupada + ":00 GMT");
    let f_fin_ocupada = Date.parse("Thu dec 28 1972 " + h_fin_ocupada + ":00 GMT");
    let libre = true;
    if (f_inicio <= f_inicio_ocupada && f_fin > f_inicio_ocupada) libre = false;
    if (f_inicio >= f_inicio_ocupada && f_inicio < f_fin_ocupada) libre = false;
    return libre;
  }

  let arrF = new Array();
  let arrU = new Array();
  lblHours.innerHTML = horas(h) + ":" + minutos(m);
  selectHour.addEventListener('input', (event) => {
    let val = selectHour.value;
    arrF = [];
    arrU = [];
    // hora inicial
    mi = val % 60;
    hi = 9 + Math.trunc((val - mi) / 60);
    // hora final
    mf1 = Math.trunc((mi + dur) / 60);
    mf = (mi + dur) % 60;
    hf = hi + mf1 + Math.trunc(dur / 60);
    // Colección con todos los tramos horarios ocupados
    let from = document.getElementsByClassName("from");
    let until = document.getElementsByClassName("until");
    Array.prototype.filter.call(from, function(occupedFrom) {
      arrF.push(occupedFrom.getAttribute("value").substr(0, 5));
    })
    Array.prototype.filter.call(until, function(occupedUntil) {
      arrU.push(occupedUntil.getAttribute("value").substr(0, 5));
    })
    color = true;
    for (hora_ocupada_inicio of arrF) {
      hora_ocupada_final = arrU[arrF.indexOf(hora_ocupada_inicio)];
      horas_inicio = horas(hi) + ":" + minutos(mi);
      horas_fin = horas(hf) + ":" + minutos(mf)
      if (!hourIsBetween(horas_inicio, horas_fin, hora_ocupada_inicio, hora_ocupada_final)) {
        color = false;
        break;
      }
    }
    let posX = Math.trunc((val * selectHour.scrollWidth / 600) - (widthLbl / 2));
    lblHours.setAttribute("style", "transform: translate(" + posX + "px, 0);");
    if (color) {
      lblHours.setAttribute("class", "badge bg-success me-1");
      lblHours.setAttribute("onclick", "location.href='cites.php?new&tab=3&hourfrom=" + horas(hi) + ":" + minutos(mi) + "&houruntil=" + horas(hf) + ":" + minutos(mf) + "'");
      lblHours.innerHTML = horas(hi) + ":" + minutos(mi) + " - " + horas(hf) + ":" + minutos(mf);
      $("#bttn_hours").attr("style", "visibility: visible");
      $("#bttn_hours").attr("onclick", "location.href='cites.php?new&tab=3&hourfrom=" + horas(hi) + ":" + minutos(mi) + "&houruntil=" + horas(hf) + ":" + minutos(mf) + "'");
      $("#bttn_hours").html(horas(hi) + ":" + minutos(mi) + " - " + horas(hf) + ":" + minutos(mf));
    } else {
      lblHours.removeAttribute("onclick");
      lblHours.setAttribute("class", "badge bg-danger me-1");
      lblHours.innerHTML = horas(hi) + ":" + minutos(mi) + " - " + horas(hf) + ":" + minutos(mf);
      $("#bttn_hours").attr("style", "visibility: hidden");
    }
  })
</script>