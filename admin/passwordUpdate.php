<?php

include("../includes/class.data.php");
include("../config/config.php");
include("../includes/functions.php");
include("../includes/sessions.php");
$ndb = new DataBase();

$jsondata = array();
$jsondata['code'] = '200';
$pass = $_POST['pass'];
$id = $_POST['id'];
$token = $_POST['token'];
$datos = array();
$datos["pass"] = md5($pass);
$datos["confirmKey"] = "";
$price = $ndb->update("users", $datos, "id = $id AND confirmKey = '" . $token . "'");
if ($price) :
  $jsondata['code'] = '300';
endif;
header('Content-type: application/json; charset=utf-8');
echo json_encode($jsondata);
exit();
