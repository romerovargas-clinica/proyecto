<?php
// Procesamiento de formulario
$error = "";
if (isset($_POST['inputName']) && isset($_GET['edit'])) :
  if (isset($_POST['inputDelete']) && $_POST['inputDelete'] == 1) :
    echo "Pendiente: Eliminar usuario";
  endif;
  // Campos Obligatorios
  $id = $_POST['inputId'];
  $name = $_POST['inputName'];
  $alt = $_POST['inputAlt'];
  $style = $_POST['inputStyle'];
  $src = $_POST['inputSrc'];
  if ($name != "" && $alt != "") :
    //update($table, $update, $where, $SQLInyection = 'YES')
    $anarray = array();
    $anarray["name"] = $name;
    $anarray["alt"] = $alt;
    $anarray["style"] = $style;
    $recordset = $db->update("images", $anarray, "id = " . $id);
    if (!$recordset) :
      $error = "Error al actualizar los datos"; // To-Do Translate
    endif;
  else :
    $error = "Falta cumplimentar datos"; // TO-DO Translate
  endif;
endif;
$max_file_size = "5120000";


// new


if (isset($_POST['inputNew'])) :
  $directorioSubida = "images/uploads/";
  $extensionesValidas = array("jpg", "png", "gif");
  // Campos Obligatorios
  $anarray = array();
  $anarray['name'] = $_POST['inputName'];
  $anarray['alt'] = $_POST['inputAlt'];
  $anarray['style'] = $_POST['inputStyle'];
  // Archivos
  if (isset($_FILES['inputSrc'])) :
    $errores = array();
    $nombreArchivo = $_FILES['inputSrc']['name'];
    $filesize = $_FILES['inputSrc']['size'];
    $directorioTemp = $_FILES['inputSrc']['tmp_name'];
    $tipoArchivo = $_FILES['inputSrc']['type'];
    $arrayArchivo = pathinfo($nombreArchivo);
    $extension = $arrayArchivo['extension'];
    // Comprobamos la extensión del archivo
    if (!in_array($extension, $extensionesValidas)) {
      $errores[] = "La extensión del archivo no es válida o no se ha subido ningún archivo";
    }
    // Comprobamos el tamaño del archivo
    if ($filesize > $max_file_size) {
      $errores[] = "La imagen debe de tener un tamaño inferior a 5Mb";
    }
    // Comprobamos y renombramos el nombre del archivo
    $nombreArchivo = $arrayArchivo['filename'];
    $nombreArchivo = preg_replace("/[^A-Z0-9._-]/i", "_", $nombreArchivo);
    $nombreArchivo = $nombreArchivo . rand(1, 100);
    // Desplazamos el archivo si no hay errores
    if (empty($errores)) {
      $nombreCompleto = $directorioSubida . $nombreArchivo . "." . $extension;
      move_uploaded_file($directorioTemp, $nombreCompleto);
      // mensaje de ok

      // actualizamos la base
      $anarray["src"] = "../../" . $nombreCompleto;
      $recordset = $db->insert("images", $anarray);
    }
  endif;
endif;
?>

<h2><?= __('sect_gallery', $lang) ?></h2>
<div class="table-responsive">

  <?php
  $table = "images";
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
                  <div class="card-header"><?= $record['name'] ?></div>
                  <div class="card-img-top"><img src="<?= $record['src'] ?>" class="crop rounded d-block" alt="<?= $record['id'] ?>" height="50"></div>
                  <div class="card-title small text-truncate text-center" style="max-width:150px"><?= $record['alt'] ?></div>
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

<?php //Añadir nueva Imagen
if (isset($_GET['AddNew'])) : ?>
  <a name="form"></a>
  <div class="container-md border position-relative p-3">
    <button type="button" class="btn-close p-3 position-absolute top-0 end-0" aria-label="Close" onclick="frm_close()" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?= __('btn_Close', $lang) ?>"></button>
    <form id="userform" enctype="multipart/form-data" action="admin.php?section=images&page=<?= $_GET['page'] ?>#form" method="POST">
      <div class="mb-6 row">
        <label for="inputName" class="col-sm-2 col-form-label"><?= __('frm_lblImages', $lang) ?></label>
        <div class="col-sm-6">
          <input type="text" class="form-control form-control-sm" name="inputName" id="inputName" value="">
        </div>
      </div>
      <div class="mb-6 row">
        <label for="inputSrc" class="col-sm-2 col-form-label"><?= __('frm_Src', $lang) ?></label>
        <div class="col-sm-6">
          <input type="file" name="inputSrc" id="inputSrc">
          <input type="hidden" name="MAX_FILE_SIZE" value="<?= $max_file_size; ?>" />
        </div>
      </div>
      <div class="mb-6 row">
        <label for="inputAlt" class="col-sm-2 col-form-label"><?= __('frm_lblLong', $lang) ?></label>
        <div class="col-sm-6">
          <input type="text" class="form-control form-control-sm" name="inputAlt" id="inputAlt" value="">
        </div>
      </div>
      <div class="mb-6 row">
        <label for="inputStyle" class="col-sm-2 col-form-label"><?= __('frm_Style', $lang) ?></label>
        <div class="col-sm-6">
          <input type="text" class="form-control form-control-sm" name="inputStyle" id="inputStyle" value="">
        </div>
      </div>
      <input type="hidden" name="inputNew">
      <button type="submit" class="btn btn-primary" name="bttn1"><?= __('btn_Update', $lang) ?></button>
    </form>
  </div>
<?php endif; ?>
<?php
if (isset($_GET['edit'])) :
  if (isset($name)) :
    $fields[0]["name"] = $name;
    $fields[0]["src"] = $src;
    $fields[0]["alt"] = $alt;
    $fields[0]["style"] = $style;
  else :
    $fields = $db->send("SELECT * FROM $adm_pag WHERE id = '" . $_GET['edit'] . "';");
  endif;

  // formulario EDITAR
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
          <input type="text" class="form-control form-control-sm" name="inputAlt" id="inputAlt" value="<?= $fields[0]["alt"] ?>">
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