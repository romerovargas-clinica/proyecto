<?php
$maxRow = 5; // Número de registros a mostrar
    
  $page = false;
  if (isset($_GET["page"])) {
    $page = $_GET["page"];
  }
 
  if (!$page) {
    $start = 0;
    $page = 1;
  } else {
    $start = ($page - 1) * $maxRow;
  }
?>