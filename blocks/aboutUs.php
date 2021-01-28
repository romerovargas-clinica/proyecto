<a name="specialties"></a>
<div class="container" style="border-top: 8px solid white">
  <?php
  // Parámetros de configuración del bloque
  $specialties = $db->select("block", "name = '" . $name_block . "'");
  //$num_articles = $articles[0]['num#1'];
  //$truncate = 0;
  //if($articles[0]['num#2']==1) $truncate = $articles[0]['num#3'];
  $recordset = $db->send("SELECT * FROM block where name = '$name_block';");
  ?>
  <div class="row" style="border-top: 8px solid black">
    <nav class="navbar navbar-expand-lg  shadow navbar-dark" style="padding-top: 0;  background-color:#0ee3d8">
      <a class="navbar-brand" href="#"><?= __($name_block,$lang) ?></a>
    </nav>
  </div>
  <div>

  
  <div class="d-line w-50">
  <p style="color:red;">quiero que esto salga a la izquierda</p>
  <p><?=$recordset[0][15]?></p>
  </div>
  <div>
  <p style="color:red;">y esto a la derecha, pero no se usar el bootstrap esta e.e</p>
  <img class="d-line w-50"  src="../images/aboutUs/<?=$recordset[0][14]?>" style="display: inline;">
  </div>

  </div>
  
 

</div>