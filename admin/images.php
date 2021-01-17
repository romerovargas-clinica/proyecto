<?php
// Procesamiento de formulario
$error = "";
if (isset($_POST['inputName'])) :
  if (isset($_POST['inputDelete']) && $_POST['inputDelete'] == 1) :
    echo "Pendiente: Eliminar usuario";
  endif;
  // Campos Obligatorios
  $id = $_POST['inputId'];
  if ($firstname != "" && $lastname != "" && $email != "") :
    //update($table, $update, $where, $SQLInyection = 'YES')
    $anarray = array();
    $anarray["firstname"] = $firstname;
    $anarray["lastname"] = $lastname;
    $anarray["email"] = $email;
    $anarray["roles"] = $rol;
    $recordset = $db->update("images", $anarray, "id = " . $id);
    if (!$recordset) :
      $error = "Error al actualizar los datos"; // To-Do Translate
    endif;
  else :
    $error = "Falta cumplimentar datos"; // TO-DO Translate
  endif;
endif;

?>

<h2><?= __('sect_gallery', $lang) ?></h2>
<div class="table-responsive">

  <?php
  include "admin/pagination.php";
  ?>



  <table class="table table-striped table-sm table-hover">
    <thead>
      <tr>
        <th>Images</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>
          <?php
          if (!empty($records)) :
            $cont = 0; ?>
            <div class="d-flex p-2 bd-highlight">
              <?php foreach ($records as $record) : ?>
                <div class="card mb-3" onclick="window.location='admin.php?section=images&page=<?= ($page) ?>&edit=<?= $record['id'] ?>';">
                  <div class="card-header"><?= "[IMG:" . $record['id'] . "]" ?></div>
                  <div class="card-img-top"><img src="<?= $record['src'] ?>" class="crop rounded d-block" alt="<?= $record['id'] ?>" height="50"></div>
                  <div class="card-title small text-truncate text-center" style="max-width:150px"><?= $record['name'] ?></div>
                </div>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        </td>
      </tr>
    </tbody>
  </table>
</div>

<div class="container text-warning bg-danger"><?php if ($error != "") echo $error; ?></div>

<?php
if (isset($_GET['edit'])) :
  if (isset($name)) :
    $fields[0]["name"] = $name;
    $fields[0]["firstname"] = $firstname;
    $fields[0]["lastname"] = $lastname;
    $fields[0]["email"] = $email;
    $fields[0]["roles"] = $rol;
  else :
    $fields = $db->send("SELECT * FROM $adm_pag WHERE id = '" . $_GET['edit'] . "';");
  endif;
?>
  <a name="form"></a>
  <div class="container-md border position-relative p-3">
    <button type="button" class="btn-close p-3 position-absolute top-0 end-0" aria-label="Close" onclick="frm_close()" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?= __('btn_Close', $lang) ?>"></button>
    <form id="userform" action="admin.php?section=images&page=<?= $_GET['page'] ?>&edit=<?= $_GET['edit'] ?>#form" method="POST">
      <div class="mb-6 row">
        <label for="inputName" class="col-sm-2 col-form-label"><?= __('frm_lblImages', $lang) ?></label>
        <div class="col-sm-6">
          <input type="text" class="form-control form-control-sm" name="inputName" id="inputName" value="<?= $fields[0]["name"] ?>">
        </div>
      </div>
      <div class="mb-6 row">
        <label for="inputSrc" class="col-sm-2 col-form-label"><?= __('frm_Src', $lang) ?></label>
        <div class="col-sm-6">
          <input type="text" readonly class="form-control form-control-sm" name="inputSrc" id="inputSrc" value="<?= $fields[0]["src"] ?>">
        </div>
      </div>
      <div class="mb-6 row">
        <label for="inputAlt" class="col-sm-2 col-form-label"><?= __('frm_lblLong', $lang) ?></label>
        <div class="col-sm-6">
          <input type="text" class="form-control form-control-sm" name="inputSrc" id="inputSrc" value="<?= $fields[0]["alt"] ?>">
        </div>
      </div>
      <div class="mb-6 row">
        <label for="inputStyle" class="col-sm-2 col-form-label"><?= __('frm_Style', $lang) ?></label>
        <div class="col-sm-6">
          <input type="text" class="form-control form-control-sm" name="inputStyle" id="inputStyle" value="<?= $fields[0]["style"] ?>">
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
    document.getElementById("userform").submit();
  }

  function frm_close() {
    window.location.href = "<?= $urlsite ?>/admin.php?section=images&page=<?= $page ?>";
  }
</script>