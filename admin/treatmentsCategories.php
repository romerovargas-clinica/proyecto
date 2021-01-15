<?php

// Procesamiento de formulario
$error = "";
if (isset($_POST['inputName'])) :
    echo "<h1> SI esto se ve esta funcionando el submit</h1>";  //COMPROBACION <-
    if (isset($_POST['inputDelete']) && $_POST['inputDelete'] == 1) :
        echo "Pendiente: Eliminar";
    endif;
    // Campos Obligatorios
    $id = $_POST['inputId'];
    $name = $_POST['inputName'];
    $image = $_POST['inputImage'];
    $info = $_POST['inputInfo'];
    if ($name != "" && $image != "" && $info != "") :
        //update($table, $update, $where, $SQLInyection = 'YES')
        $anarray = array();
        $anarray["name"] = $name;
        $anarray["image"] = $image;
        $anarray["info"] = $info;
        $recordset = $db->update("treatments_categories", $anarray, "id = " . $id);
        if (!$recordset) :
            $error = "Error al actualizar los datos"; // To-Do Translate
        endif;
    else :
        $error = "Falta cumplimentar datos"; // TO-DO Translate
    endif;
endif;

// Gestión de la paginación de registros
include "admin/pagination.php";
// Calculo el total de paginas
$row = $db->send("SELECT Count(*) as total FROM treatments_categories;");
$numResult = $row[0]['total'];
$total_pages = ceil($numResult / $maxRow);
$records = $db->select("treatments_categories", "1 = 1 ORDER BY id ASC LIMIT ".$start.", ".$maxRow);

//Descargar los datos de la base de datos
$categories =  $db->send("SELECT * FROM treatments_categories;"); //descargo la tabla categorias
$categoriesNames = array();
?>

<!--Tabla para las categorias-->
<h2><?= __('sect_treatments', $lang) ?>: <?= __('sect_categories', $lang) ?></h2>
<div class="table-responsive">
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-end">
      <?php if ($total_pages >= 1) {
        if ($page != 1) {?>
      <li class="page-item"><a class="page-link"
          href="admin.php?section=treatmentsCategories&page=<?=($page-1)?>">&laquo;</a></li>
      <?php }
  
        for ($i=1;$i<=$total_pages;$i++) {
          if ($page == $i) {?>
      <li class="page-item"><a class="page-link" href="#"><?=$i?></a></li>
      <?php } else { ?>
      <li class="page-item"><a class="page-link" href="admin.php?section=treatmentsCategories&page=<?=$i?>"><?=$i?></a>
      </li>
      <?php }
        }
  
        if ($page != $total_pages) { ?>
      <li class="page-item"><a class="page-link"
          href="admin.php?section=treatmentsCategories&page=<?=$page+1?>">&raquo;</a></li>
      <?php }
      }?>
    </ul>
  </nav>
  <table class="table table-striped table-sm table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th><?= __('frm_FirstName', $lang) ?></th>
        <th><?= __('frm_Image', $lang) ?></th>
        <th><?= __('frm_Desc', $lang) ?></th>

      </tr>
    </thead>
    <tbody>
      <?php if (!empty($categories)) :
                $cont = 0;
                foreach ($categories as $record) :
                    array_push($categoriesNames, $record['name']);
                    if (isset($_GET['edit']) && $record['id'] == $_GET['edit']) :
                        $class = " fw-bold";
                    else :
                        $class = "";
                    endif;
            ?>
      <tr class="tbl-h<?= $class ?>"
        onclick="window.location='admin.php?section=treatmentsCategories&edit=<?= $record['id'] ?>';">
        <td><?= $record["id"] ?></td>
        <td><?= $record["name"] ?></td>
        <td><?= $record["image"] ?></td>
        <td><?= $record["info"] ?></td>

      </tr>
      <?php
                endforeach;
            endif; ?>
    </tbody>
  </table>
</div>


<div class="container text-warning bg-danger"><?php if ($error != "") echo $error; ?></div>

<!-- /////////////////////TO DO: el botón de submit no me está funcionando , Buscar razón////////////////////// -->
<?php //formulario para editar
if (isset($_GET['edit'])) :
    if (isset($name)) :
        $fields[0]["id"] = $id;
        $fields[0]["name"] = $name;
        $fields[0]["image"] = $image;
        $fields[0]["info"] = $info;

    else :
        $fields = $db->send("SELECT * FROM treatments_categories WHERE id = " . $_GET['edit']);
    endif;
?>
<a name="form"></a>
<div class="container-md border position-relative p-3">
  <button type="button" class="btn-close p-3 position-absolute top-0 end-0" aria-label="Close"
    onclick="frmUser_close()"></button>
  <form id="categoriesform"
    action="admin.php?section=treatmentsCategories&page=<?=$page?>&edit=<?= $_GET['edit'] ?>#form" method="POST">

    <div class="mb-6 row">
      <label for="inputName" class="col-sm-2 col-form-label"><?=__('frm_FirstName', $lang)?></label>
      <div class="col-sm-6">
        <input type="text" class="form-control form-control-sm" name="inputName" id="inputName"
          value="<?=$fields[0]["name"]?>">
      </div>
    </div>
    <div class="mb-6 row">
      <label for="inputImage" class="col-sm-2 col-form-label"><?=__('frm_Image', $lang)?></label>
      <div class="col-sm-6">
        <input type="text" class="form-control form-control-sm" name="inputImage" id="inputImage"
          value="<?=$fields[0]["image"]?>">
      </div>
    </div>
    <div class="mb-6 row">
      <label for="inputInfo" class="col-sm-2 col-form-label"><?=__('frm_Desc', $lang)?></label>
      <div class="col-sm-6">
        <input type="inputInfo" class="form-control form-control-sm" name="inputInfo" id="inputInfo"
          value="<?=$fields[0]["info"]?>">
      </div>
    </div>

    <input type="hidden" id="inputId" name="inputId" value="<?=$fields[0]["id"]?>">
    <input type="hidden" id="inputDelete" name="inputDelete" value="0">
    <button type="submit" class="btn btn-primary" name="bttn1"><?=__('btn_Update', $lang)?></button>
    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
      data-bs-target="#myModal"><?= __('btn_Deleted', $lang) ?></button>
  </form>
</div>
<?php endif; ?>

<!-- Modal -->
<?php

?>
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?= __('modal_title_confirm', $lang) ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body"><?= __('modal_text_confirm', $lang) ?></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?= __('btn_Close', $lang) ?></button>
        <button type="button" class="btn btn-primary" onclick="aceptar();"><?= __('btn_Ok', $lang) ?></button>
      </div>
    </div>
  </div>
</div>

<script>
function aceptar() {
  document.getElementById("inputDelete").value = "1";
  //$('#myModal').modal('hide');
  document.getElementById("categoriesform").submit();
}

function frmUser_close() {
  window.location.href = "http://clinica.es/admin.php?section=treatmentsCategories&page=<?= $page ?>";
}
</script>