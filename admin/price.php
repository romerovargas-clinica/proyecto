<?php

include("../includes/class.data.php");
include("../config/config.php");
include("../includes/functions.php");
include("../includes/sessions.php");
// Recuperar la sesión anterior
initiate();
if (!isAuthenticated()) :
  echo "No Autorizado";
  exit();
endif;
$ndb = new DataBase();

$jsondata = array();
$treatments = $_POST['treatments'];
$price = $ndb->select("treatmentsinterventions", "id = $treatments");

if ($price) :
  $jsondata['code'] = '200';
  $jsondata['price'] = $price[0]['price'];
endif;

header('Content-type: application/json; charset=utf-8');
echo json_encode($jsondata);
exit();
