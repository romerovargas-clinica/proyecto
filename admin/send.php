<?php

include("../includes/class.data.php");
include("../config/config.php");
include("../includes/functions.php");
include("../includes/sessions.php");
// Recuperar la sesión anterior
initiate();
if ($_POST) {
  $name = $_SESSION['name'];
  $msg = $_POST['msg']; // to-do analizar
  $session = $_POST['chat_id'];

  $db = new DataBase();
  $field = array();

  $field['session_id'] = $session;
  $field['user_id'] = $_SESSION['id'];
  $field['name'] = $_SESSION['name'];
  $field['message'] = $msg;

  //var_dump($cons);
  $sql = $db->insert("chat", $field);

  if ($sql) {
    header('Location: ../admin.php?section=chat&user=' . $_POST['user_id']);
  } else {
    echo "Algo salió mal";
  }
}
