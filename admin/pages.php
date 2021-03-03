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
  $recordset = $db->update("treatmentsInterventions", $anarray, "id = " . $id);
endif;
?>

<!--Tabla para paginas-->
<h2><?= __('pages', $lang) ?></h2>
<div class="table-responsive">

  <?php
  $table = "pages";
  $maxRow = 8; // Número de registros a mostrar
  include "admin/pagination.php";
  ?>

  <table class="table table-striped table-sm table-hover">
    <thead>
      <tr>
        <!--id, page, enabled -->
        <th>#</th>
        <th><?= __('frm_Page', $lang) ?></th>
        <th><?= __('frm_Block', $lang) ?></th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($records)) :
        $cont = 0;
        foreach ($records as $recordT) :
          if (isset($_GET['edit']) && $recordT['id'] == $_GET['edit']) :
            $class = " fw-bold";
          else :
            $class = "";
          endif;
      ?>
          <tr class="tbl-h<?= $class ?>" onclick="window.location='admin.php?section=pages&page=<?= ($page) ?>&edit=<?= $recordT['id'] ?>';">
            <td><?= $recordT["id"] ?></td>
            <td><?= $recordT["page"] ?></td>
            <td>
              <?php
              $bloques = $db->select("blocks", "id_page = " . $recordT["id"] . " ORDER BY order_n ASC");
              if ($bloques) : ?>
                <?php foreach ($bloques as $bloque) : ?>
                  <div class="badge bg-secondary"><?= $bloque["name"] ?></div>
                <?php endforeach; ?>

              <?php endif; ?>
            </td>
          </tr>
      <?php

        endforeach;
      endif; ?>
    </tbody>
  </table>
</div>


<div class="container text-warning bg-danger"><?php if ($error != "") echo $error; ?></div>


<?php
//Añadir nuevo Profesional
if (isset($_GET['AddNew'])) : ?>
  <div class="container-md border position-relative p-3">
    <button type="button" class="btn-close p-3 position-absolute top-0 end-0" aria-label="Close" onclick="frm_close()" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?= __('btn_Close', $lang) ?>"></button>
    <form id="opinionsAddform" action="admin.php?section=opinions&page=<?= $page ?>" method="POST">

      <div class="mb-6 row">
        <label for="inputTr" class="col-sm-2 col-form-label"><?= __('frm_Treat', $lang) ?></label>
        <div class="col-sm-6">
          <input type="text" class="form-control form-control-sm" name="inputTr" id="inputTr" required>
        </div>
      </div>

      <div class="mb-6 row">
        <label for="inputName" class="col-sm-2 col-form-label"><?= __('frm_FirstName', $lang) ?></label>
        <div class="col-sm-6">
          <input type="text" class="form-control form-control-sm" name="inputName" id="inputName" required>
        </div>
      </div>

      <div class="mb-6 row">
        <label for="inputDegree" class="col-sm-2 col-form-label"><?= __('frm_Degree', $lang) ?></label>
        <div class="col-sm-6">
          <input type="text" class="form-control form-control-sm" name="inputDegree" id="inputDegree" required>
        </div>
      </div>

      <div class="mb-6 row">
        <label for="inputJob" class="col-sm-2 col-form-label"><?= __('frm_Job', $lang) ?></label>
        <div class="col-sm-6">
          <input type="text" class="form-control form-control-sm" name="inputJob" id="inputJob" required>
        </div>
      </div>

      <div class="mb-6 row">
        <label for="inputImage" class="col-sm-2 col-form-label"><?= __('frm_Image', $lang) ?></label>
        <div class="col-sm-6">
          <div class="card-img-top"><img src="images/blank.png" class="crop rounded d-block" alt="" height="50" onclick="changeImg();" id="img_base"></div>
          <input type="hidden" name="inputImageFile" value="" id="img_file">
          <input type="hidden" name="inputImageDir" value="" id="img_dir">
        </div>
      </div>

      <div class="mb-6 row">
        <label for="inputInfo" class="col-sm-2 col-form-label"><?= __('frm_Desc', $lang) ?></label>
        <div class="col-sm-6">
          <textarea class="form-control form-control-sm" name="inputInfo" id="inputInfo" required></textarea>
        </div>
      </div>

      <input type="hidden" name="InputNew">
      <button type="submit" class="btn btn-primary" name="bttn1"><?= __('btn_Add', $lang) ?></button>
    </form>
  </div>

<?php endif;

//formulario para editar

if (isset($_GET['edit'])) :
  if (isset($name)) :
    $fields[0]["id"] = $id;
    $fields[0]["page"] = $name;
  else :
    $fields = $db->select("pages", "id = " . $_GET['edit']);
  endif;
?>
  <a name="form"></a>
  <div class="container-md border position-relative p-3">
    <button type="button" class="btn-close p-3 position-absolute top-0 end-0" aria-label="Close" onclick="frm_close()" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?= __('btn_Close', $lang) ?>"></button>
    <form id="userform" action="admin.php?section=pages&page=<?= $page ?>&edit=<?= $_GET['edit'] ?>#form" method="POST">

      <div class="mb-6 row">
        <label for="inputName" class="col-sm-2 col-form-label"><?= __('frm_Page', $lang) ?></label>
        <div class="col-sm-6">
          <input type="text" class="form-control form-control-sm" name="inputName" id="inputName" value="<?= $fields[0]["page"] ?>" disabled="disabled">
        </div>
      </div>

      <div class="mb-6 row">
        <label for="inputImage" class="col-sm-2 col-form-label"><?= __('frm_Block', $lang) ?></label>
        <div class="col-sm-6">
          <table class="table">
            <thead>
              <tr>
                <th><?= __('frm_Block', $lang) ?></th>
                <th><?= __('frm_BlockUp', $lang) ?></th>
                <th><?= __('frm_BlockDown', $lang) ?></th>
                <th></th>
              </tr>
            </thead>
            <tbody>

              <?php
              $bloques = $db->select("blocks", "id_page = " . $fields[0]["id"] . " ORDER BY order_n ASC");
              if ($bloques) :
                $cont = 1;
                foreach ($bloques as $bloque) :
              ?>
                  <tr>
                    <td>
                      <h5><span style="cursor: pointer;" class="badge bg-dark"><?= $bloque["name"] ?></span></h5>
                    </td>
                    <td>
                      <?php if ($cont != 1) : ?>
                        <span style="cursor: pointer;" id="<?= $bloque["name"] ?>_up" data-feather="arrow-up-circle" data-order="<?= $cont ?>" onclick="moveUp(<?= $cont ?>, this.id)"></span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <?php if ($cont != count($bloques)) : ?>
                        <span style="cursor: pointer;" id="<?= $bloque["name"] ?>_down" data-feather="arrow-down-circle" data-order="<?= $cont ?>" onclick="moveDown(<?= $cont ?>, this.id)"></span>
                      <?php endif; ?>
                    </td>
                    <td id="<?= $bloque["name"] ?>_flag"></td>
                  </tr>
                <?php
                  $cont++;
                endforeach; ?>
                </td>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
      <input type="hidden" id="inputId" name="inputId" value="<?= $fields[0]["id"] ?>">
      <input type="hidden" id="inputDelete" name="inputDelete" value="0">
      <!-- button type="submit" class="btn btn-primary" name="bttn1"><?= __('btn_Update', $lang) ?></button> -->
      <!-- <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#myModal"><?= __('btn_Deleted', $lang) ?></button> -->
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
    window.location.href = "<?= $urlsite ?>/admin.php?section=users&page=<?= $page ?>";
  }

  function moveUp(pos, ele) {
    var flag = ele.slice(0, -3);
    $("#" + flag + "_flag").html('<div class="loading"><img src="images/loader.gif" alt="loading" /></div>');
    $.post("admin/reorder.php", {
      ele: flag,
      pos: pos,
      flag: 1
    }, function(data) {
      if (data["code"] == 200) {
        $("#" + flag + "_flag").html('');
        location.reload();
      }
    });
  }

  function moveDown(pos, ele) {
    var flag = ele.slice(0, -5);
    $("#" + flag + "_flag").html('<div class="loading"><img src="images/loader.gif" alt="loading" /></div>');
    $.post("admin/reorder.php", {
      ele: flag,
      pos: pos,
      flag: 0
    }, function(data) {
      if (data["code"] == 200) {
        $("#" + flag + "_flag").html('');
        location.reload();
      }
    });
  }
</script>