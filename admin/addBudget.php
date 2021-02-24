<?php

include("../includes/class.data.php");
include("../config/config.php");
include("../includes/functions.php");
include("../includes/sessions.php");
$ndb = new DataBase();

$jsondata = array();
$jsondata['code'] = '200';

// param
$datos = array();
$datos['amount'] = $_POST['amount'];
$datos['customer_id'] = $_POST['client'];
$datos['discount'] = $_POST['discount'];
$datos['date'] = $_POST['date'];

$tratamientos = json_decode($_POST['treatments'], true);
$indexInsert = $ndb->insert("budgets", $datos);

if ($indexInsert) :
  foreach ($tratamientos as $trat) :
    $tratamientosArr = array();
    $tratamientosArr["id_budget"] = $indexInsert;
    $tratamientosArr["id_treatments"] = $trat;
    $dev = $ndb->insert("budgets_treatments", $tratamientosArr);
  endforeach;
  $jsondata['code'] = '200';
else :
  $jsondata['code'] = '300';
endif;

header('Content-type: application/json; charset=utf-8');
echo json_encode($jsondata);
exit();
