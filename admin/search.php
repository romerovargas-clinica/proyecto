<?php
require("../config/config.php");

$valueSearch = $_POST['valueSearch'];
$table = $_POST['table'];

$return = "";

$array_fields = array();

switch ($table) {
  case 'settings':
    array_push($array_fields, "value");
    break;
  case 'users':
    array_push($array_fields, "firstname");
    array_push($array_fields, "lastname");
    array_push($array_fields, "email");
    break;
  case 'images':
    array_push($array_fields, "name");
    break;
  case 'articles':
    array_push($array_fields, "title");
    array_push($array_fields, "subtitle");
    array_push($array_fields, "text");
    break;
  case 'treatmentsCategories':
    array_push($array_fields, "name");
    array_push($array_fields, "info");
    break;
  case 'treatmentsInterventions':
    array_push($array_fields, "name");
    array_push($array_fields, "info");
    break;
  case 'images':
    array_push($array_fields, "name");
    break;
}

$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

$sqlCons = "SELECT * FROM " . $table . " WHERE ";
$cont = 0;
foreach ($array_fields as $where) :
  if ($cont != 0) $sqlCons .= " OR ";
  $sqlCons .= $where . " LIKE '%{$valueSearch}%'";
  $cont++;
endforeach;
//print_r($_POST);
//print_r($array_fields);
//echo $sqlCons;
//  $consulta = mysqli_query($conexion, "SELECT * FROM mmv001
//	WHERE nombre COLLATE UTF8_SPANISH_CI LIKE '%$consultaBusqueda%' 
//	OR apellido COLLATE UTF8_SPANISH_CI LIKE '%$consultaBusqueda%'
//	OR CONCAT(nombre,' ', apellido) COLLATE UTF8_SPANISH_CI LIKE '%$consultaBusqueda%'
//  ");

$consulta = mysqli_query($connection, $sqlCons);

$return = array();
while ($return[] = mysqli_fetch_assoc($consulta)) {
}
$stringReturn = "";
if (count($return) > 1) {
  unset($return[count($return) - 1]); // destruimos último valor que es 'vacio'  
  foreach ($return as $key => $row) :
    $stringReturn .= "#";
    foreach ($row as $clave => $valor) :
      if (in_array($clave, $array_fields)) {
        $stringReturn .= ";" . $valor . " ";
      }
    endforeach;
  endforeach;
}
echo $stringReturn;
