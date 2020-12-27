<?php
// Si hay algún error, descomentar las siguiente líneas
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
// TODAS LAS PÁGINAS CARGAN LOS SIGUIENTE ARCHIVOS //
include ("includes/data.php");
include ("includes/functions.php");
include ("includes/sessions.php");
logout();
header("location:index.php");
?>