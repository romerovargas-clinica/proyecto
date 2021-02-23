<?php

include("../includes/class.data.php");
include("../config/config.php");
include("../includes/functions.php");
include("../includes/sessions.php");
// Recuperar la sesión anterior
initiate();
if (!isAuthenticated() && !isset($_POST['hash'])) :
  echo "No Autorizado";
  exit();
endif;
$ndb = new DataBase();

$jsondata = array();

$campos = array();
$campos['firstname'] = isset($_POST['firstname']) ? $_POST['firstname'] : "";
$campos['lastname'] = isset($_POST['lastname']) ? $_POST['lastname'] : "";
$campos['email'] = isset($_POST['email']) ? $_POST['email'] : "";
$campos['phone'] = isset($_POST['phone']) ? substr($_POST['phone'] . "          ", 0, 9) : "";
$campos['address'] = isset($_POST['address']) ? $_POST['address'] : "";
$campos['postalcode'] = isset($_POST['postalCode']) ? $_POST['postalCode'] : "";
$campos['city'] = isset($_POST['city']) ? $_POST['city'] : "";
$campos['province'] = isset($_POST['province']) ? $_POST['province'] : "";
$campos['roles'] = "[CUSTOMER]";
$campos['name'] = uniqid();

if (isset($_POST['hash'])) $campos['confirmKey'] = $campos['name'];  // autoregistro

$repetido = $ndb->select("users", "email = '" . $campos['email'] . "'");
if ($repetido) {
  $jsondata["code"] = 302;
  $jsondata["msg"] = "El email already exist";
} else {

  $newUser = $ndb->insert("users", $campos);

  if ($newUser) :
    $jsondata["code"] = 200;
    $jsondata["msg"] = "El usuario ha sido añadido a la base de datos";  // todo traducir el mensaje de la manera en la que se encuentra assets/contact.php

    // enviar un email de verificación
    if (isset($_POST['hash'])) :
      $url = "http://" . $_SERVER['SERVER_NAME'] . "/confirmAccount.php?clave=" . $campos['name']; //ToDo
      $message = "Bienvenido a SonriseClinic " . $campos['firstname'] . ".\nEstamos encantados de tenerte con nosotros. \n" .
        "Ahora para confirmar tu cuenta tienes que acceder a este link y asignar tu contraseña:\n " . $url;
      mail($campos['email'], "Confirmación de cuenta " . $campos['email'], $message, "From: SonriseClinic. \n No conteste a este email por favor.");
    endif;
  else :
    $jsondata["code"] = 301;
    $jsondata["msg"] = "Error";
  endif;
}

header('Content-type: application/json; charset=utf-8');
echo json_encode($jsondata);
exit();
