<?php
$maxRow = 5; // Número de registros a mostrar

$row = $db->send("SELECT Count(*) as total FROM $adm_pag;");

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

$numResult = $row[0]['total'];
$total_pages = ceil($numResult / $maxRow);
$records = $db->select($adm_pag, "1 = 1 ORDER BY id ASC LIMIT " . $start . ", " . $maxRow);
?>

<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-end">
    <?php if ($total_pages >= 1) {
      if ($page != 1) { ?>
        <li class="page-item"><a class="page-link" href="admin.php?section=<?= $adm_pag ?>&page=<?= ($page - 1) ?>">&laquo;</a>
        </li>
        <?php }

      for ($i = 1; $i <= $total_pages; $i++) {
        if ($page == $i) { ?>
          <li class="page-item"><span class="page-link bg-primary text-white" href="#"><?= $i ?></span></li>
        <?php } else { ?>
          <li class="page-item"><a class="page-link" href="admin.php?section=<?= $adm_pag ?>&page=<?= $i ?>"><?= $i ?></a></li>
        <?php }
      }

      if ($page != $total_pages) { ?>
        <li class="page-item"><a class="page-link" href="admin.php?section=<?= $adm_pag ?>&page=<?= $page + 1 ?>">&raquo;</a>
        </li>
    <?php }
    } ?>
  </ul>
</nav>