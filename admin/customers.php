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

$html = '';
$key = $_POST['client'];
$customers = $ndb->send("SELECT DISTINCTROW * FROM users WHERE roles='[CUSTOMER]' AND (firstname LIKE '%$key%' OR lastname LIKE '%$key%');");

if ($customers) :
  foreach ($customers as $user) :
    $html .= '<div><a class="suggest-element" data="' . $user['firstname'] . ' ' . $user['lastname'] . '" id="' . $user['id']  . '">' . $user['firstname'] . ' ' . $user['lastname'] . '</a></div>';
  endforeach;
endif;
echo $html;
