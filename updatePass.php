<?php
// Si hay algún error, descomentar las siguiente líneas

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// TODAS LAS PÁGINAS CARGAN LOS SIGUIENTE ARCHIVOS //
include("includes/data.php");
include("includes/functions.php");
include("includes/sessions.php");
logout();
// Si ya estamos logueados, salir de aquí
//if(isAuthenticated()) header("location:index.php");
// TITLE DE LA PÁGINA ACTUAL //
$PG_NAME = "updating pass";
$nav_style = "alt";

//RECOJO LOS DATOS DE LA CUENTA
$db = new DataBase(DB_SERVER, DB_USER, DB_PASS, DB_NAME, 1);
$pass = $_POST['frmInputPass'];
$confirmKey =  $_POST['key'];
$account = $db->send("SELECT * FROM users WHERE confirmKey = '$confirmKey'");
$anarray = array();
$anarray["confirmKey"] = '';
$anarray["pass"] = md5($pass);
$anarray["enabled"] = 1;
$recordset = $db->update("users", $anarray, "confirmKey = " . "'$confirmKey'");
$db->close();
//esta linea de abajo se puede quitar perfectamente

header("location:login.php");

?>

