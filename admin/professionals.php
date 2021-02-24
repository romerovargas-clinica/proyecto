<?php

// Procesamiento de formulario
$error = "";
if (isset($_POST['inputName']) && isset($_GET['edit'])) :
  if (isset($_POST['inputDelete']) && $_POST['inputDelete'] == 1) :
    $id = $_POST['inputId'];
    $db->send("DELETE FROM professionals WHERE id = $id;");
    header("url= <?= $urlsite ?>/admin.php?section=professionals&page=<?= $page ?>");
  endif;
  // Campos Obligatorios
  $id = $_POST['inputId'];
  $name = $_POST['inputName'];
  $degree = $_POST['inputDegree'];
  $job = $_POST['inputJob'];
  $imageFile = $_POST['inputImageFile'];
  $info = $_POST['inputInfo'];
  if ($name != "" && $imageFile != "" && $info != "") :
    //update
    $anarray = array();
    $anarray["image"] = $imageFile;
    $anarray["info"] = $info;
    $anarray["name"] = $name;
    $anarray["degree"] = $degree;
    $anarray["job"] = $job;

    $recordset = $db->update("professionals", $anarray, "id = " . $id);
    if (!$recordset) :
      $error = __('err_UpdateInfo', $lang);
    endif;
  else :
    $error = __('err_MissingData', $lang);
  endif;
endif;

//añadir
if (isset($_POST['InputNew'])) :
  $name = $_POST['inputName'];
  $degree = $_POST['inputDegree'];
  $job = $_POST['inputJob'];
  $image = $_POST['inputImage'];
  $info = $_POST['inputInfo'];

  $db->send("INSERT INTO `professionals` (`image`, `info`, `name`, `degree`, `job`) VALUES
    ('$image', '$info', '$name', '$degree', '$job');");

endif;

?>

<!--Tabla para las categorias-->
<h2><?= __('sect_professionals', $lang) ?></h2>
<div class="table-responsive">

  <?php
  $table = "professionals";
  $maxRow = 5; // Número de registros a mostrar
  include "admin/pagination.php";
  ?>

  <table class="table table-striped table-sm table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th><?= __('frm_FirstName', $lang) ?></th>
        <th><?= __('frm_Degree', $lang) ?></th>
        <th><?= __('frm_Job', $lang) ?></th>
        <th><?= __('frm_Image', $lang) ?></th>
        <th><?= __('frm_Desc', $lang) ?></th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($records)) :
        $cont = 0;
        foreach ($records as $record) :
          if (isset($_GET['edit']) && $record['id'] == $_GET['edit']) :
            $class = " fw-bold";
          else :
            $class = "";
          endif;
      ?>
          <tr class="tbl-h<?= $class ?>" onclick="window.location='admin.php?section=professionals&edit=<?= $record['id'] ?>';">
            <td><?= $record["id"] ?></td>
            <td><?= $record["name"] ?></td>
            <td><?= $record["degree"] ?></td>
            <td><?= $record["job"] ?></td>
            <td>
              <?php if ($record["image"] != null) : ?>
                <img src="images/uploads/<?= $record["image"] ?>" class="crop rounded d-block" alt="" height="25">
              <?php else : ?>
                <img src="images/blank.png" class="crop rounded d-block" alt="" height="25">
              <?php endif; ?>
            </td>
            <td><?= $record["info"] ?></td>
          </tr>
      <?php
        endforeach;
      endif; ?>
    </tbody>
  </table>
</div>


<div class="container text-warning bg-danger"><?php if ($error != "") echo $error; ?></div>


<?php
//Añadir nuevo profesional

if (isset($_GET['AddNew'])) : ?>
  <div class="container-md border position-relative p-3">
    <button type="button" class="btn-close p-3 position-absolute top-0 end-0" aria-label="Close" onclick="frm_close()" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?= __('btn_Close', $lang) ?>"></button>
    <form id="professionalsAddform" action="admin.php?section=professionals&page=<?= $page ?>" method="POST">
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
          <input type="inputInfo" class="form-control form-control-sm" name="inputInfo" id="inputInfo" required>
        </div>
      </div>

      <input type="hidden" name="InputNew">
      <button type="submit" class="btn btn-primary" name="bttn1"><?= __('btn_Add', $lang) ?></button>
    </form>
  </div>
<?php endif;

?>
<?php
//formulario para editar
if (isset($_GET['edit'])) :
  if (isset($name)) :
    $fields[0]["id"] = $id;
    $fields[0]["name"] = $name;
    $fields[0]["degree"] = $degree;
    $fields[0]["job"] = $job;
    $fields[0]["image"] = $imageFile;
    $fields[0]["info"] = $info;

  else :
    $fields = $db->send("SELECT * FROM professionals WHERE id = " . $_GET['edit']);
  endif;
?>
  <a name="form"></a>
  <div class="container-md border position-relative p-3">
    <button type="button" class="btn-close p-3 position-absolute top-0 end-0" aria-label="Close" onclick="frm_close()" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?= __('btn_Close', $lang) ?>"></button>
    <form id="professionalsEditform" action="admin.php?section=professionals&page=<?= $page ?>&edit=<?= $_GET['edit'] ?>#form" method="POST">

      <div class="mb-6 row">
        <label for="inputName" class="col-sm-2 col-form-label"><?= __('frm_FirstName', $lang) ?></label>
        <div class="col-sm-6">
          <input type="text" class="form-control form-control-sm" name="inputName" id="inputName" value="<?= $fields[0]["name"] ?>">
        </div>
      </div>
      <div class="mb-6 row">
        <label for="inputDegree" class="col-sm-2 col-form-label"><?= __('frm_Degree', $lang) ?></label>
        <div class="col-sm-6">
          <input type="text" class="form-control form-control-sm" name="inputDegree" id="inputDegree" value="<?= $fields[0]["degree"] ?>">
        </div>
      </div>
      <div class="mb-6 row">
        <label for="inputJob" class="col-sm-2 col-form-label"><?= __('frm_Job', $lang) ?></label>
        <div class="col-sm-6">
          <input type="text" class="form-control form-control-sm" name="inputJob" id="inputJob" value="<?= $fields[0]["job"] ?>">
        </div>
      </div>
      <div class="mb-6 row">
        <label for="inputImage" class="col-sm-2 col-form-label"><?= __('frm_Image', $lang) ?></label>
        <div class="col-sm-6">
          <?php if ($fields[0]["image"] == null) :
            $_img = "images/blank.png";
          else :
            $_img = "images/uploads/" . $fields[0]["image"];
          endif; ?>
          <div class="card-img-top"><img src="<?= $_img ?>" class="crop rounded d-block" alt="" height="50" onclick="changeImg();" id="img_base"></div>
          <input type="hidden" name="inputImageFile" value="" id="inputImageFile">
          <input type="hidden" name="inputImageDir" value="" id="inputImageDir">
        </div>
        <div class="mb-6 row">
          <label for="inputInfo" class="col-sm-2 col-form-label"><?= __('frm_Desc', $lang) ?></label>
          <div class="col-sm-6">
            <input type="inputInfo" class="form-control form-control-sm" name="inputInfo" id="inputInfo" value="<?= $fields[0]["info"] ?>">
          </div>
        </div>

        <input type="hidden" id="inputId" name="inputId" value="<?= $fields[0]["id"] ?>">
        <input type="hidden" id="inputDelete" name="inputDelete" value="0">
        <button type="submit" class="btn btn-primary" name="bttn1"><?= __('btn_Update', $lang) ?></button>
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#myModal"><?= __('btn_Deleted', $lang) ?></button>
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
  function changeImg() {
    var configuracion_ventana = "menubar=no,toolbar=no,location=yes,resizable=no,scrollbars=yes,status=no,height=500,width=800";
    var anotherwindow = window.open("filebrowser.php", "test", configuracion_ventana);
    //anotherwindow.bgColor = "black";
  }

  function aceptar() {
    document.getElementById("inputDelete").value = "1";
    //$('#myModal').modal('hide');
    document.getElementById("professionalsEditform").submit();
  }

  function frm_close() {
    window.location.href = "<?= $urlsite ?>/admin.php?section=professionals&page=<?= $page ?>";
  }
</script>