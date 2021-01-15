<?php

// Procesamiento de formulario #TO DO: esta copiado de users
$error = "";
if (isset($_POST['inputName'])) :
    if (isset($_POST['inputDelete']) && $_POST['inputDelete'] == 1) :
        echo "Pendiente: Eliminar usuario";
    endif;
    // Campos Obligatorios
    /*id name"]categorie"image""info""duration""price"*/
    $id = $_POST['inputId'];
    $name = $_POST['inputName'];
    $categorie = $_POST['inputCategorie'];
    $image = $_POST['inputImage'];
    $info = $_POST['inputInfo'];
    $duration = $_POST['inputDuration'];
    $price = $_POST['inputPrice'];              //TO-DO: hay que adaptar la comprobacion de los datos para esta parte
   // if ($id != "" && $name != "" && $categorie != "" && $image != "" && $info != "" && $duration != "" && $price != ""):
        //update($table, $update, $where, $SQLInyection = 'YES')
        $anarray = array();
        $anarray["name"] = $name;
        $anarray["categorie"] = $categorie;
        $anarray["image"] = $image;
        $anarray["info"] = $info;
        $anarray["duration"] = $duration;
        $anarray["Price"] = $price;
        $recordset = $db->update("treatments_interventions", $anarray, "id = " . $id);
        //if (!$recordset) :
        //    $error = "Error al actualizar los datos"; // To-Do Translate
        //endif;
     // else :
     //    $error = "Falta cumplimentar datos"; // TO-DO Translate
     // endif;
endif;

  // Gestión de la paginación de registros
  include "admin/pagination.php";  
  //Descargar los datos de la base de datos
  $row =  $db->send("SELECT Count(*) as total FROM treatments_interventions;"); //descargo los nombres de las categorias
  $numResult = $row[0]['total'];
  $total_pages = ceil($numResult / $maxRow);
  $treatments = $db->select("treatments_interventions", "1 = 1 ORDER BY id ASC LIMIT ".$start.", ".$maxRow);

  $categories =$db->send("SELECT name FROM treatments_categories;");
  $categoriesNames = array(); //nombre de las
  foreach ($categories as $categorie) {
      array_push($categoriesNames, $categorie['name']);
  }
?>

<!--Tabla para los tratamientos-->
<h2><?= __('sect_treatments', $lang) ?></h2>
<div class="table-responsive">
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-end">
      <?php if ($total_pages >= 1) {
        if ($page != 1) {?>
      <li class="page-item"><a class="page-link"
          href="admin.php?section=treatmentsInterventions&page=<?=($page-1)?>">&laquo;</a></li>
      <?php }
  
        for ($i=1;$i<=$total_pages;$i++) {
          if ($page == $i) {?>
      <li class="page-item"><a class="page-link" href="#"><?=$i?></a></li>
      <?php } else { ?>
      <li class="page-item"><a class="page-link"
          href="admin.php?section=treatmentsInterventions&page=<?=$i?>"><?=$i?></a></li>
      <?php }
        }
  
        if ($page != $total_pages) { ?>
      <li class="page-item"><a class="page-link"
          href="admin.php?section=treatmentsInterventions&page=<?=$page+1?>">&raquo;</a></li>
      <?php }
      }?>
    </ul>
  </nav>
  <table class="table table-striped table-sm table-hover">
    <thead>
      <tr>
        <!--id, name, categorie, duration, price, info, image-->
        <th>#</th>
        <th><?= __('frm_FirstName', $lang) ?></th>
        <th><?= __('frm_Type', $lang) ?></th>
        <th><?= __('frm_Image', $lang) ?></th>
        <th><?= __('frm_Desc', $lang) ?></th>
        <th><?= __('frm_Duration', $lang) ?></th>
        <th><?= __('frm_Price', $lang) ?></th>

      </tr>
    </thead>
    <tbody>
      <?php if (!empty($treatments)) :
                $cont = 0;
                foreach ($treatments as $recordT) :
                    if (isset($_GET['edit']) && $recordT['id'] == $_GET['edit']) :
                        $class = " fw-bold";
                    else :
                        $class = "";
                    endif;
            ?>
      <tr class="tbl-h<?= $class ?>"
        onclick="window.location='admin.php?section=treatmentsInterventions&page=<?= ($page) ?>&edit=<?= $recordT['id'] ?>';">
        <td><?= $recordT["id"] ?></td>
        <td><?= $recordT["name"] ?></td>
        <td><?= $categoriesNames[$recordT["categorie"] - 1] ?></td>
        <td><?= $recordT["image"] ?></td>
        <td><?= $recordT["info"] ?></td>
        <td><?= $recordT["duration"] ?></td>
        <td><?= $recordT["price"] ?></td>
      </tr>
      <?php

                endforeach;
            endif; ?>
    </tbody>
  </table>
</div>


<div class="container text-warning bg-danger"><?php if ($error != "") echo $error; ?></div>


<?php //formulario para editar
/*id name"]categorie"image""info""duration""price"*/
if (isset($_GET['edit'])) :
    if (isset($name)) :
        $fields[0]["id"] = $id;
        $fields[0]["name"] = $name;
        $fields[0]["categorie"] = $categorie;
        $fields[0]["image"] = $image;
        $fields[0]["info"] = $info;
        $fields[0]["duration"] = $duration;
        $fields[0]["price"] = $price;

    else :
        $fields = $db->send("SELECT * FROM treatments_interventions WHERE id = " . $_GET['edit']);
    endif;
?>
<a name="form"></a>
<div class="container-md border position-relative p-3">
  <button type="button" class="btn-close p-3 position-absolute top-0 end-0" aria-label="Close"
    onclick="frmUser_close()"></button>
  <form id="userform" action="admin.php?section=treatmentsInterventions&page=<?=$page?>&edit=<?=$_GET['edit']?>#form"
    method="POST">

    <div class="mb-6 row">
      <label for="inputName" class="col-sm-2 col-form-label"><?= __('frm_FirstName', $lang) ?></label>
      <div class="col-sm-6">
        <input type="text" class="form-control form-control-sm" name="inputName" id="inputName"
          value="<?= $fields[0]["name"] ?>">
      </div>
    </div>
    <div class="mb-6 row">
      <label for="inputCategorie" class="col-sm-2 col-form-label"><?= __('frm_Categorie', $lang) ?></label>
      <div class="col-sm-6">
        <select class="form-select" aria-label="Default select" name="inputCategorie">
          <?php
                        for ($i = 0; $i < count($categoriesNames); $i++) {
                            $key = $categoriesNames[$i];
                        ?>
          <option value="<?= $i + 1 ?>" <?= $fields[0]["categorie"] == $key ? " selected" : "" ?>> <?= $key ?> </option>
          <?php }; ?>
        </select>
      </div>
    </div>
    <div class="mb-6 row">
      <label for="inputImage" class="col-sm-2 col-form-label"><?= __('frm_Image', $lang) ?></label>
      <div class="col-sm-6">
        <input type="text" class="form-control form-control-sm" name="inputImage" id="inputImage"
          value="<?= $fields[0]["image"] ?>">
      </div>
    </div>
    <div class="mb-6 row">
      <label for="inputInfo" class="col-sm-2 col-form-label"><?= __('frm_Desc', $lang) ?></label>
      <div class="col-sm-6">
        <input type="text" class="form-control form-control-sm" name="inputInfo" id="inputInfo"
          value="<?= $fields[0]["info"] ?>">
      </div>
    </div>
    <div class="mb-6 row">
      <label for="inputDuration" class="col-sm-2 col-form-label"><?= __('frm_Duration', $lang) ?></label>
      <div class="col-sm-6">
        <input type="number" class="form-control form-control-sm" name="inputDuration" id="inputDuration" min="0"
          value="<?= $fields[0]["duration"] ?>">
      </div>
    </div>
    <div class="mb-6 row">
      <label for="inputPrice" class="col-sm-2 col-form-label"><?= __('frm_Price', $lang) ?></label>
      <div class="col-sm-6">
        <input type="number" class="form-control form-control-sm" name="inputPrice" id="inputPrice" min="0" step=".01"
          value="<?= $fields[0]["price"] ?>">
      </div>
    </div>

    <input type="hidden" id="inputId" name="inputId" value="<?= $fields[0]["id"] ?>">
    <input type="hidden" id="inputDelete" name="inputDelete" value="0">
    <button type="submit" class="btn btn-primary" name="bttn1"><?= __('btn_Update', $lang) ?></button>
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
  document.getElementById("userform").submit();
}

function frmUser_close() {
  window.location.href = "http://clinica.com/admin.php?section=users&page=<?= $page ?>";
}
</script>