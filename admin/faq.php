<?php

// Procesamiento de formulario 
$error = "";
if (isset($_POST['inputQuestion']) && isset($_GET['edit'])) :
  if (isset($_POST['inputDelete']) && $_POST['inputDelete'] == 1) :
    $id = $_POST['inputId'];
    $db->delete("faq", "id = $id");
    unset($_GET['edit']);
  else :
    // EDIT
    // Campos Obligatorios
    $id = $_POST['inputId'];
    $question = $_POST['inputQuestion'];
    $response = $_POST['inputResponse'];
    $enable = $_POST['inputEnable'];

    $anarray = array();
    $anarray["question"] = $question;
    $anarray["response"] = $response;
    $anarray["enabled"] = $enable;
    $recordset = $db->update("faq", $anarray, "id = " . $id);
  endif;
endif;

//añadir
if (isset($_POST['InputNew'])) :
  $anarray = array();
  $anarray["question"] = $_POST['inputQuestion'];
  $anarray["response"] = $_POST['inputResponse'];
  $anarray["enabled"] = $_POST['inputEnable'];

  $db->insert("faq", $anarray);

endif;

$isEnable[0] = "Case_Disable";
$isEnable[1] = "Case_Enable";
?>

<!--Tabla para los testimonios -->
<h2><?= __('sect_Faq', $lang) ?></h2>
<div class="table-responsive">

  <?php
  $table = "faq";
  $maxRow = 10; // Número de registros a mostrar
  include "admin/pagination.php";
  ?>

  <table class="table table-striped table-sm table-hover">
    <thead>
      <tr>

        <th>#</th>
        <th><?= __('frm_Question', $lang) ?></th>
        <th><?= __('frm_Response', $lang) ?></th>
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
          <tr class="tbl-h<?= $class ?>" onclick="window.location='admin.php?section=faq&page=<?= ($page) ?>&edit=<?= $recordT['id'] ?>';">
            <td><?= $recordT["id"] ?></td>
            <td><?= $recordT["question"] ?></td>
            <td><?= $recordT["response"] ?></td>
            <td class="" style=""><?= $recordT["enabled"] == 1 ? __('Case_Enable', $lang) : __('Case_Disable', $lang) ?></td>
          </tr>
      <?php

        endforeach;
      endif; ?>
    </tbody>
  </table>
</div>


<div class="container text-warning bg-danger"><?php if ($error != "") echo $error; ?></div>



<?php
//Añadir nueva Opinión
if (isset($_GET['AddNew'])) : ?>
  <div class="container-md border position-relative p-3">
    <button type="button" class="btn-close p-3 position-absolute top-0 end-0" aria-label="Close" onclick="frm_close()" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?= __('btn_Close', $lang) ?>"></button>
    <form id="opinionsAddform" action="admin.php?section=faq&page=<?= $page ?>" method="POST">

      <div class="mb-6 row">
        <label for="inputQuestion" class="col-sm-2 col-form-label"><?= __('frm_Question', $lang) ?></label>
        <div class="col-sm-6">
          <input type="text" class="form-control form-control-sm" name="inputQuestion" id="inputQuestion" required>
        </div>
      </div>

      <div class="mb-6 row">
        <label for="inputResponse" class="col-sm-2 col-form-label"><?= __('frm_Response', $lang) ?></label>
        <div class="col-sm-6">
          <input type="text" class="form-control form-control-sm" name="inputResponse" id="inputResponse" required>
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
    $fields[0]["question"] = $question;
    $fields[0]["response"] = $response;
    $fields[0]["enabled"] = $enable;
  else :
    $fields = $db->send("SELECT * FROM faq WHERE id = " . $_GET['edit']);
  endif;
?>
  <a name="form"></a>
  <div class="container-md border position-relative p-3">
    <button type="button" class="btn-close p-3 position-absolute top-0 end-0" aria-label="Close" onclick="frm_close()" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?= __('btn_Close', $lang) ?>"></button>
    <form id="opinionsEditform" action="admin.php?section=faq&page=<?= $page ?>&edit=<?= $_GET['edit'] ?>#form" method="POST">

      <div class="mb-6 row">
        <label for="inputQuestion" class="col-sm-2 col-form-label"><?= __('frm_Question', $lang) ?></label>
        <div class="col-sm-6">
          <input type="text" class="form-control form-control-sm" name="inputQuestion" id="inputQuestion" required value="<?= $fields[0]["question"] ?>">
        </div>
      </div>

      <div class="mb-6 row">
        <label for="inputResponse" class="col-sm-2 col-form-label"><?= __('frm_Response', $lang) ?></label>
        <div class="col-sm-6">
          <input type="text" class="form-control form-control-sm" name="inputResponse" id="inputResponse" required value="<?= $fields[0]["response"] ?>">
        </div>
      </div>

      <div class="mb-6 row">
        <label for="inputEnable" class="col-sm-2 col-form-label"><?= __('frm_Active', $lang) ?></label>
        <div class="col-sm-6">
          <select class="form-select" aria-label="Default select" name="inputEnable" required>
            <option value="0" <?= $fields[0]["enabled"] == 0 ? " selected='selected'" : "" ?> ;><?= __($isEnable[0], $lang) ?></option>
            <option value="1" <?= $fields[0]["enabled"] == 1 ? " selected='selected'" : "" ?>><?= __($isEnable[1], $lang) ?></option>
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
  function aceptar() {
    document.getElementById("inputDelete").value = "1";
    //$('#myModal').modal('hide');
    document.getElementById("opinionsEditform").submit();
  }

  function frm_close() {
    window.location.href = "<?= $urlsite ?>/admin.php?section=faq&page=<?= $page ?>";
  }
</script>