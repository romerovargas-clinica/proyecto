<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("../includes/class.data.php");
include("../config/config.php");

// Revisa periódicamente la existencia de nuevos mensajes en la tabla chat (date_read = null)
// Si los encuentra, y comprueba que la conversación no está siendo atendida, emite un mensaje
// contesta en el chat con un mensaje automático (configurable desde admin) y notifica al administrador 
// vía email para que atienda a quien lo ha escrito.

$db = new DataBase();
$field = array();

$field['user_id'] = 2;
$field['name'] = 'system';

$sql = $db->select("chat", "date_read IS NULL");
$sql = $db->send("SELECT DISTINCT session_id FROM chat WHERE date_read IS NULL AND session_id NOT IN (SELECT session_id FROM chat WHERE date_read IS NOT NULL)");

if ($sql) :
  $param = $db->send("SELECT * FROM settings WHERE label = 'response_bot';");
  $response_bot = $param[0]['value'];

  foreach ($sql as $row) :
    $automatiq = array();
    $field['session_id'] = $row['session_id'];
    $field['message'] = $response_bot;
    $insert = $db->insert("chat", $field);
    // actualizamos el date_read
    $dateread = array();
    //$dateread['session_id'] = $row['session_id'];
    $dateread['date_read'] = date("Y-m-d H:i:s");
    $update = $db->update("chat", $dateread, "session_id = '" . $row['session_id'] . "'");
  endforeach;
endif;
$db->close();
