<?php 
// Clase para la gestión de la base de datos
include("class.data.php");
// Archivo de configuración excluido del control de versiones
include("config/config.php");

//devuelve una conexión a la base de datos
foreach ($_GET as $variable => $valor) {
    $_GET [$variable] = str_replace("'", "", $_GET [$variable]);
    $_GET [$variable] = str_replace("\"", "", $_GET [$variable]);
    $_GET [$variable] = str_replace("=", "", $_GET [$variable]);
}

foreach ($_POST as $variable => $valor) {
    $_POST [$variable] = str_replace("'", "", $_POST [$variable]);
    $_POST [$variable] = str_replace("\"", "", $_POST [$variable]);
    $_POST [$variable] = str_replace("=", "", $_POST [$variable]);
}