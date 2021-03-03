<?php

include("../includes/class.data.php");
include("../config/config.php");
include("../includes/functions.php");
include("../includes/sessions.php");
$ndb = new DataBase();

$jsondata = array();
$jsondata['code'] = '200';

$ele = $_POST['ele'];
$pos = $_POST['pos'];
$flag = $_POST['flag'];

$elem = $ndb->select("blocks", "name = '$ele'");

if ($elem && ($flag == 0 || $flag == 1)) :    // Reordenacion de secciones
  $anarray = array();

  if ($flag == 1) : // subir
    // Val = 2    =>  1->2 && 2->1
    $anarray["order_n"] = $pos;
    $where = "id_page = " . $elem[0]["id_page"] . " AND order_n = " . ($pos - 1);
    $upSQL1 = $ndb->update("blocks", $anarray, $where);
    $pos--;
  endif;

  if ($flag == 0) : // bajar
    // Val = 2    =>  3->2 && 2->3
    $anarray["order_n"] = $pos;
    $where = "id_page = " . $elem[0]["id_page"] . " AND order_n = " . ($pos + 1);
    $upSQL1 = $ndb->update("blocks", $anarray, $where);
    $pos++;
  endif;

  $anarray = array();
  $anarray["order_n"] = $pos;
  $where = "name = '" . $ele . "'";

  $upSQL2 = $ndb->update("blocks", $anarray, $where);

endif;

$elem = $ndb->select("blocks", "name = '$ele'");

if ($elem && ($flag == 2 || $flag == 3)) :    // Habilitar/Deshabilitar secciones

  $anarray = array();

  if ($flag == 2) : // Habilitar
    $max = $ndb->send("SELECT MAX(order_n) as maxim FROM blocks WHERE id_page = " . $elem[0]["id_page"] . " AND enabled = 1");
    $maxim = $max[0]["maxim"] + 1;
    $anarray["order_n"] = $maxim; //Colocar el último de los habilitados
    $anarray["enabled"] = 1;
    $where = "name = '" . $ele . "'";
    $upSQL1 = $ndb->update("blocks", $anarray, $where);
  endif;

  if ($flag == 3) : // Deshabilitar    
    $anarray["order_n"] = 0;
    $anarray["enabled"] = 0;
    $where = "name = '" . $ele . "'";
    $upSQL1 = $ndb->update("blocks", $anarray, $where);
  endif;

endif;

// Reordenar
$reorder = $ndb->select("blocks", "id_page = " . $elem[0]["id_page"] . " AND enabled = 1 ORDER BY order_n ASC");
if ($reorder) :
  $pos = 1;
  foreach ($reorder as $bloque) :
    $anarray = array();
    $anarray["order_n"] = $pos;
    $where = "name = '" . $bloque["name"] . "'";
    $upd = $ndb->update("blocks", $anarray, $where);
    $pos++;
  endforeach;
endif;

header('Content-type: application/json; charset=utf-8');
echo json_encode($jsondata);
exit();
