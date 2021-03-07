<?php

// Procesamiento de formularios
$error = "";

if (isset($_POST['inputName']) && isset($_GET['edit'])) :
  if (isset($_POST['inputDelete']) && $_POST['inputDelete'] == 1) :
    $id = $_POST['inputId'];
    $db->delete("professionals", "id = $id");
    unset($_GET['edit']);
  else :
    // EDIT
    // Campos Obligatorios
    $id = $_POST['inputId'];
    $imageFile = $_POST['inputImageFile'];
    $info = $_POST['inputInfo'];
    $tr = $_POST['inputTr'];
    $name = $_POST['inputName'];
    $degree = $_POST['inputDegree'];
    $job = $_POST['inputJob'];
    $enable = $_POST['inputEnable'];
    //TO-DO: hay que adaptar la comprobacion de los datos para esta parte
    $anarray = array();
    $anarray["image"] = $imageFile;
    $anarray["info"] = $info;
    $anarray["tr"] = $tr;
    $anarray["name"] = $name;
    $anarray["degree"] = $degree;
    $anarray["job"] = $job;
    $anarray["enabled"] = $enable;
    $recordset = $db->update("professionals", $anarray, "id = " . $id,);
  endif;
endif;

// ADD
if (isset($_POST['InputNew'])) :
  // Campos Obligatorios  
  /*
  $imageFile = $_POST['inputImageFile'];
  $info = $_POST['inputInfo'];
  $tr = $_POST['inputTr'];
  $name = $_POST['inputName'];
  $degree = $_POST['inputDegree'];
  $job = $_POST['inputJob'];
  $enable = $_POST['inputEnable'];
  */
  $anarray = array();
  $anarray["image"] = $_POST['inputImageFile'];
  $anarray["info"] = $_POST['inputInfo'];
  $anarray["tr"] = $_POST['inputTr'];
  $anarray["name"] = $_POST['inputName'];
  $anarray["degree"] = $_POST['inputDegree'];
  $anarray["job"] = $_POST['inputJob'];
  $anarray["enabled"] = $_POST['inputEnable'];
  $insert = $db->insert("professionals", $anarray);
//$db->send("INSERT INTO `professionals` ( `image`, `info`, `tr`, `name`, `degree`, `job`, `enabled`) VALUES
//( '$imageFile', '$info', '$tr', '$name', '$degree', '$job', $enable);");
endif;

$isEnable[0] = "Case_Disable";
$isEnable[1] = "Case_Enable";
?>

<!--Tabla para los profesionales -->
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
        <!--id, name, categorie, duration, price, info, image-->
        <th>#</th>
        <th><?= __('frm_FirstName', $lang) ?></th>
        <th><?= __('frm_Occupation', $lang) ?></th>
        <th><?= __('frm_Image', $lang) ?></th>
        <th><?= __('frm_Comment', $lang) ?></th>
        <th><?= __('frm_Enable', $lang) ?></th>
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
          <tr class="tbl-h<?= $class ?>" onclick="window.location='admin.php?section=professionals&page=<?= ($page) ?>&edit=<?= $recordT['id'] ?>';">
            <td><?= $recordT["id"] ?></td>
            <td><?= $recordT["tr"] . " " . $recordT["name"] ?></td>
            <td><?= $recordT["degree"] ?></td>
            <td>
              <?php if ($recordT["image"] != null) : ?>
                <img src="images/uploads/<?= $recordT["image"] ?>" class="crop rounded d-block" alt="" height="25">
              <?php else : ?>
                <img src="images/blank.png" class="crop rounded d-block" alt="" height="25">
              <?php endif; ?>
            </td>
            <td><?= $recordT["info"] ?></td>
            <td>
              <?= $recordT["enabled"] == 1 ? __('Case_Enable', $lang) : __('Case_Disable', $lang) ?>
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
    <form id="opinionsAddform" action="admin.php?section=professionals&page=<?= $page ?>" method="POST">

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
          <input type="hidden" name="inputImageFile" value="" id="inputImageFile">
          <input type="hidden" name="inputImageDir" value="" id="inputImageDir">
        </div>
      </div>

      <div class="mb-6 row">
        <label for="inputInfo" class="col-sm-2 col-form-label"><?= __('frm_Desc', $lang) ?></label>
        <div class="col-sm-6">
          <textarea class="form-control form-control-sm" name="inputInfo" id="inputInfo" required></textarea>
        </div>
      </div>

      <div class="mb-6 row">
        <label for="inputEnable" class="col-sm-2 col-form-label"><?= __('frm_Active', $lang) ?></label>
        <div class="col-sm-6">
          <select class="form-select" aria-label="Default select" name="inputEnable" required>
            <option value="0"><?= __($isEnable[0], $lang) ?></option>
            <option value="1" selected="selected"><?= __($isEnable[1], $lang) ?></option>
          </select>
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
    $fields[0]["tr"] = $tr;
    $fields[0]["name"] = $name;
    $fields[0]["degree"] = $degree;
    $fields[0]["image"] = $imageFile;
    $fields[0]["info"] = $info;
    $fields[0]["job"] = $job;
    $fields[0]["enabled"] = $enable;
  else :
    $fields = $db->send("SELECT * FROM professionals WHERE id = " . $_GET['edit']);
  endif;
?>
  <a name="form"></a>
  <div class="container-md border position-relative p-3">
    <button type="button" class="btn-close p-3 position-absolute top-0 end-0" aria-label="Close" onclick="frm_close()" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?= __('btn_Close', $lang) ?>"></button>
    <form id="opinionsEditform" action="admin.php?section=professionals&page=<?= $page ?>&edit=<?= $_GET['edit'] ?>#form" method="POST">

      <div class="mb-6 row">
        <label for="inputTr" class="col-sm-2 col-form-label"><?= __('frm_Treat', $lang) ?></label>
        <div class="col-sm-6">
          <input type="text" class="form-control form-control-sm" name="inputTr" id="inputTr" required value="<?= $fields[0]["tr"] ?>">
        </div>
      </div>

      <div class=" mb-6 row">
        <label for="inputName" class="col-sm-2 col-form-label"><?= __('frm_FirstName', $lang) ?></label>
        <div class="col-sm-6">
          <input type="text" class="form-control form-control-sm" name="inputName" id="inputName" required value="<?= $fields[0]["name"] ?>">
        </div>
      </div>

      <div class="mb-6 row">
        <label for="inputDegree" class="col-sm-2 col-form-label"><?= __('frm_Degree', $lang) ?></label>
        <div class="col-sm-6">
          <input type="text" class="form-control form-control-sm" name="inputDegree" id="inputDegree" required value="<?= $fields[0]["degree"] ?>">
        </div>
      </div>

      <div class="mb-6 row">
        <label for="inputJob" class="col-sm-2 col-form-label"><?= __('frm_Job', $lang) ?></label>
        <div class="col-sm-6">
          <input type="text" class="form-control form-control-sm" name="inputJob" id="inputJob" required value="<?= $fields[0]["job"] ?>">
        </div>
      </div>

      <div class="mb-6 row">
        <label for="inputImageFile" class="col-sm-2 col-form-label"><?= __('frm_Image', $lang) ?></label>
        <div class="col-sm-6">
          <?php if ($fields[0]["image"] == null) :
            $_img = "images/blank.png";
          else :
            $_img = "images/uploads/" . $fields[0]["image"];
          endif; ?>
          <div class="card-img-top"><img src="<?= $_img ?>" class="crop rounded d-block" alt="" height="50" onclick="changeImg();" id="img_base"></div>
          <input type="hidden" name="inputImageFile" value="<?= $fields[0]["image"] ?>" id="inputImageFile">
          <input type="hidden" name="inputImageDir" value="" id="inputImageDir">
        </div>
      </div>

      <div class="mb-6 row">
        <label for="inputInfo" class="col-sm-2 col-form-label"><?= __('frm_Desc', $lang) ?></label>
        <div class="col-sm-6">
          <textarea class="form-control form-control-sm" name="inputInfo" id="inputInfo" required><?= $fields[0]["info"] ?></textarea>
        </div>
      </div>

      <div class="mb-6 row">
        <label for="inputEnable" class="col-sm-2 col-form-label"><?= __('frm_Active', $lang) ?></label>
        <div class="col-sm-6">
          <select class="form-select" aria-label="Default select" name="inputEnable" required>
            <option value="0" <?= $fields[0]["enabled"] == 0 ? " selected='selected'" : "" ?> ;>
              <?= __($isEnable[0], $lang) ?></option>
            <option value="1" <?= $fields[0]["enabled"] == 1 ? " selected='selected'" : "" ?>>
              <?= __($isEnable[1], $lang) ?></option>
          </select>
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
    console.log("Activo");
    var configuracion_ventana =
      "menubar=no,toolbar=no,location=yes,resizable=no,scrollbars=yes,status=no,height=500,width=800";
    var anotherwindow = window.open("filebrowser.php", "test", configuracion_ventana);
    //anotherwindow.bgColor = "black";
  }

  function aceptar() {
    document.getElementById("inputDelete").value = "1";
    //$('#myModal').modal('hide');
    document.getElementById("opinionsEditform").submit();
  }

  function frm_close() {
    window.location.href = "<?= $urlsite ?>/admin.php?section=professionals&page=<?= $page ?>";
  }
</script>