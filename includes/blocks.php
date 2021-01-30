<?php
// cargar los bloques desde la configuración
$db = new DataBase();
$sql = "SELECT * FROM pages a INNER JOIN blocks b ON a.id = b.id_page WHERE a.page = '" . $PG_NAME . "' ORDER BY order_n ASC";
$blocks = $db->send($sql);
foreach ($blocks as $block) :
    $name_block = $block['name'];
    include "blocks/" . $block['block'] . ".php";
endforeach;
$db->close();
