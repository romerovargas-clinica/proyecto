<?php
  $maxRow = 10; // Número de registros a mostrar
  $row = $db->send("SELECT Count(*) as total FROM config;");
  $numResult = $row[0]['total'];
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
  //calculo el total de paginas
  $total_pages = ceil($numResult / $maxRow);

  $params = $db->select("config", "1 = 1 ORDER BY id ASC LIMIT ".$start.", ".$maxRow);  
?>
<h2><?=__('sect_settings',$lang)?></h2>
<div class="table-responsive">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th>#</th>
        <th>Group</th>
        <th>Param</th>
        <th>Value</th>
      </tr>
    </thead>
    <tbody>
      <?php if(!empty($params)):
          $cont = 0;
          foreach($params as $key):?>
      <tr>
        <td><?=$key["id"]?></td>
        <td><?=$key["type"]?></td>
        <td><?=$key["label"]?></td>
        <td><?=$key["value"]?></td>
      </tr>
      <?php
            $cont++;
            if($cont>=$maxRow) break;
          endforeach;
        endif;?>
    </tbody>
  </table>
</div>

<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-end">
    <?php if ($total_pages >= 1) {
        if ($page != 1) {?>
    <li class="page-item"><a class="page-link" href="admin.php?section=settings&page=<?=($page-1)?>">&laquo;</a></li>
    <?php }
 
        for ($i=1;$i<=$total_pages;$i++) {
            if ($page == $i) {?>
    <li class="page-item"><a class="page-link" href="#"><?=$i?></a></li>
    <?php } else { ?>
    <li class="page-item"><a class="page-link" href="admin.php?section=settings&page=<?=$i?>"><?=$i?></a></li>
    <?php }
        }
 
        if ($page != $total_pages) { ?>
    <li class="page-item"><a class="page-link" href="admin.php?section=settings&page=<?=$page+1?>">&raquo;</a></li>
    <?php }
    }?>
  </ul>
</nav>