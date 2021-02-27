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

$ele = $ndb->select("blocks", "name = '$ele'");

if ($ele) :
  $anarray = array();
  
  if ($flag == 1) : // subir
    // Val = 1     =>     2->1 1->2
    $anarray["order_n"] = $pos + 1;
    $where = "id_page = " . $ele[0]["id_page"] . " AND order_n = " . $pos;
    $upSQL1 = $ndb->update("blocks", $anarray, $where);
  endif;  
  
  if ($flag == 0) : // bajar
    // Valores = 8,      =>     10->9 9->10
    $pos++; //9
    $anarray["order_n"] = $pos;
    $where = "id_page = " . $ele[0]["id_page"] . " AND order_n = " . ($pos + 1);
    $upSQL1 = $ndb->update("blocks", $anarray, $where);
  endif;
  
  $anarray["order_n"] = $pos;
  $where = "name = '" . $ele . "'";
  $upSQL2 = $ndb->update("blocks", $anarray, $where);

else :

    $jsondata['code'] = '300';

endif;

header('Content-type: application/json; charset=utf-8');
echo json_encode($jsondata);
exit();
