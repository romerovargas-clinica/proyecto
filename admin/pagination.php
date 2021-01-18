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
<div class="d-flex bd-highlight">
  <div class="p-2 w-100 row row-cols-lg-auto g-3 align-items-center">
    <div class="col-12">
      <button type="button" class="page-link btn-sm bg-primary text-white" onclick="window.location='admin.php?section=<?= $adm_pag ?>&page=<?= ($page) ?>&AddNew';"><?= __('btn_Add', $lang) ?></button>
    </div>
    <div class="col-12">
      <input type="text" class="page-link btn-sm" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1" id="search" name="search" onKeyUp="search();">
    </div>
  </div>
  <nav aria-label="navigation flex-shrink-1">
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
</div>
<ul id="resultSearch" class="list-group"></ul>
<div class="list-group"></div>
<script>
  function search() {
    var textSearch = $("input#search").val();
    var div = document.getElementById("resultSearch");
    while (div.firstChild) {
      div.removeChild(div.lastChild);
    }
    if (textSearch != "") {
      $.post("admin/search.php", {
        valueSearch: textSearch,
        table: '<?= $adm_pag ?>'
      }, function(message) {
        //$("#resultSearch").html(message);        
        //$("input#search").attr('data-bs-content', message);
        console.log(message);
        var row = message.split("#");
        row.forEach(element => {
          if (element != "") {
            let option = document.createElement("a");
            div.appendChild(option);
            let field = element.split(";");
            let texto = "";
            colores = new Array('bg-light', 'bg-light', 'bg-primary', 'bg-secondary', 'bg-success', 'bg-warning text-dark', 'bg-info text-dark', 'bg-dark', 'bg-light text-dark', 'bg-danger');
            let cont = 0;
            field.forEach(value => {
              let txt = String(value);
              var temporal = document.createElement("div");
              temporal.innerHTML = txt;
              txt = temporal.textContent || temporal.innerText || "";
              if (cont == 1) id = txt;
              let l = txt.length;
              if (l > 50) {
                txt = txt.substr(0, 50) + "...";
              }
              texto = texto + " <span class='badge " + colores[cont] + "'>" + txt + "</span> ";
              cont++;
            })
            option.setAttribute('class', 'list-group-item list-group-item-action');
            option.setAttribute('href', 'admin.php?section=<?= $adm_pag ?>&edit=' + id);
            option.innerHTML = texto;
          }
        });
      });
    } else {
      div.setAttribute('arial-label', 'Disabled size 0');
      div.setAttribute('visible', 'hidden');
    };
  };
</script>