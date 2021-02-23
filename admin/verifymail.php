<?php

include("../includes/class.data.php");
include("../config/config.php");
include("../includes/functions.php");
include("../includes/sessions.php");
$ndb = new DataBase();

$jsondata = array();
$jsondata['code'] = '200';
$email = $_POST['email'];
$price = $ndb->select("users", "email = '$email'");
if ($price) :
  $jsondata['code'] = '300';
endif;

header('Content-type: application/json; charset=utf-8');
echo json_encode($jsondata);
exit();
