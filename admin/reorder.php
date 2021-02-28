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

if ($elem) :
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
else :

    $jsondata['code'] = '300';

endif;

header('Content-type: application/json; charset=utf-8');
echo json_encode($jsondata);
exit();
