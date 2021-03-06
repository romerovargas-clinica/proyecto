<?php

// Procesamiento de formulario edit
//print_r($_POST);
$error = "";
if (isset($_POST['inputTitle']) && isset($_GET['edit'])) :
  if (isset($_POST['inputDelete']) && $_POST['inputDelete'] == 1) :
    $id = $_POST['inputId'];
    $db->delete("articles" ,"id = $id");
    unset($_GET['edit']);
  else:
    // EDIT
    // Campos Obligatorios
    //print_r($_POST);
    $id = $_POST['inputId'];
    $title = $_POST['inputTitle'];
    $subtitle = $_POST['inputSubTitle'];
    $author = $_POST['inputAuthor'];
    $imageFile = $_POST['inputImageFile'];
    $text = $_POST['inputText'];
    $enabled = isset($_POST["flexSwitchCheckDefault"]) ? 1 : 0;
    $date_published = $_POST["date_published"] == "" ? Null : $_POST["date_published"];
    if ($date_published == "" && $enabled == 1) :
      $date_published = date("Y-m-d H:i:s");
    endif;
    if ($title != "") :
      //update($table, $update, $where, $SQLInyection = 'YES')
      $anarray = array();
      $anarray["title"] = $title;
      $anarray["subtitle"] = $subtitle;
      $anarray["author"] = $author;
      $anarray["image"] = $imageFile;
      $anarray["text"] = $text;
      $anarray["enabled"] = $enabled;
      $anarray["date_published"] = $date_published;
      $recordset = $db->update("articles", $anarray, "id = " . $id);
      if (!$recordset) :
        $error = __('err_UpdateInfo', $lang);
      endif;
    else :
      $error = __('err_MissingData', $lang);
    endif;
  endif;
endif;


//Añadir nuevos artículos

if (isset($_POST['InputNew'])) :
  // Campos Obligatorios    
  // print_r($_POST);
  $title = $_POST['inputTitle'];
  $subtitle = $_POST['inputSubTitle'];
  $author = $_POST['inputAuthor'];
  $imageFile = $_POST['inputImageFile'];
  $text = htmlspecialchars($_POST['inputText'], ENT_QUOTES);
  $author = $_POST['inputAuthor'];
  // $enabled = isset($_POST["flexSwitchCheckDefault"]) ? 1 : 0;
  if ($title != "") :
    $anarray = array();
    $anarray["title"] = $title;
    $anarray["image"] = $imageFile;
    $anarray["subtitle"] = $subtitle;
    $anarray["author"] = $author;
    $anarray["category"] = 1;
    $anarray["text"] = $text;
    $anarray["enabled"] = 0;
    $recordset = $db->insert("articles", $anarray);
    if (!$recordset) :
      $error = __('err_UpdateInfo', $lang);
    endif;
  else :
    $error = __('err_MissingData', $lang);
  endif;
endif;
?>

<h2><?= __('sect_articles', $lang) ?></h2>

<div class="table-responsive">
  <?php
  $table = "articles";
  $where = "category = 1";
  $maxRow = 5; // Número de registros a mostrar
  include "admin/pagination.php";
  ?>

  <table class="table table-striped table-sm table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th><?= __('frm_Title', $lang) ?></th>
        <th><?= __('frm_Image', $lang) ?></th>
        <th id="subtitle"><?= __('frm_Subtitle', $lang) ?></th>
        <th><?= __('date_Published', $lang) ?></th>
        <th><?= __('frm_Text', $lang) ?></th>
        <th><?= __('frm_Enable', $lang) ?></th>
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
          <tr class="tbl-h<?= $class ?>" onclick="window.location='admin.php?section=articles&page=<?= ($page) ?>&edit=<?= $record['id'] ?>';" style="background-color: rgba(0, 0, 0, 0.05); background-image:linear-gradient(var(--bs-table-accent-bg),var(--bs-table-accent-bg))">
            <td><?= $record["id"] ?></td>
            <td><?= $record["title"] ?></td>
            <td>
              <?php if ($record["image"] != null) : ?>
                <img src="images/uploads/<?= $record["image"] ?>" class="crop rounded d-block" alt="" height="30">
              <?php else : ?>
                <img src="images/blank.png" class="crop rounded d-block" alt="" height="30">
              <?php endif; ?>
            </td>
            <td class="d-inline-block text-truncate" style="max-width: 200px"><?= $record["subtitle"] ?></td>
            <td><?= $record["date_published"] ?></td>
            <td class="d-inline-block text-truncate" style="max-width: 300px"><?= strip_tags($record["text"]) ?></td>
            <td class="" style=""><?= $record["enabled"] == 1 ? __('Case_Enable', $lang) : __('Case_Disable', $lang) ?></td>
          </tr>
      <?php
          $cont++;
          if ($cont >= $maxRow) break;
        endforeach;
      endif; ?>
    </tbody>
  </table>
</div>

<div class="container text-warning bg-danger"><?php if ($error != "") echo $error; ?></div>

<?php
//Añadir nuevo articulo
if (isset($_GET['AddNew'])) :
?>
  <a name="form"></a>
  <div class="container-md border position-relative p-3">
    <button type="button" class="btn-close p-3 position-absolute top-0 end-0" aria-label="Close" onclick="frm_close()" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?= __('btn_Close', $lang) ?>"></button>
    <form id="articleNewform" action="admin.php?section=articles&page=<?= $_GET['page'] ?>" method="POST">

      <div class="mb-6 row">
        <label for="inputTitle" class="col-sm-2 col-form-label"><?= __('frm_Title', $lang) ?></label>
        <div class="col-sm-6">
          <input type="text" class="form-control form-control-sm" name="inputTitle" id="inputTitle" required>
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
        <label for="inputSubTitle" class="col-sm-2 col-form-label"><?= __('frm_Subtitle', $lang) ?></label>
        <div class="col-sm-6">
          <input type="text" class="form-control form-control-sm" name="inputSubTitle" id="inputSubTitle" required>
        </div>
      </div>

      <div class="mb-6 row">
        <label for="inputAuthor" class="col-sm-2 col-form-label"><?= __('frm_Author', $lang) ?></label>
        <div class="col-sm-6">
          <select class="form-select" aria-label="Default select" name="inputAuthor" id="inputAuthor">
            <?php
            $authors = $db->send("SELECT id, name FROM users;"); ?>
            <option value="0">...</option>
            <?php foreach ($authors as $key) : ?>
              <option value="<?= $key['id'] ?>" <?= $key['id'] == $_SESSION["id"] ? " selected " : "" ?>><?= $key['name'] ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>

      <div class="mb-6 row">
        <label for="inputText" class="col-sm-2 col-form-label"><?= __('frm_Text', $lang) ?></label>
        <div class="col-sm-6">
          <textarea cols="100" name="inputText" id="inputText"></textarea>
        </div>
      </div>

      <input type="hidden" name="InputNew">
      <button type="submit" class="btn btn-primary" name="bttn1"><?= __('btn_Add', $lang) ?></button>
    </form>
  </div>
<?php endif;

//Formulario editar

if (isset($_GET['edit'])) :
  if (isset($name)) :
    $fields[0]["title"] = $title;
    $fields[0]["subtitle"] = $subtitle;
    $fields[0]["text"] = $text;
    $fields[0]["image"] = $imageFile;
    $fields[0]["enabled"] = $enabled;
    $fields[0]["author"] = $author;
    $fields[0]["date_published"] = $date_published;
  else :
    $fields = $db->send("SELECT a.id, a.image, a.title, a.subtitle, a.text, a.date_published, a.enabled, b.id as author FROM articles a INNER JOIN users b ON a.author = b.id WHERE a.id = " . $_GET['edit']);
  endif;

?>
  <a name="form"></a>
  <div class="container-md border position-relative p-3">
    <button type="button" class="btn-close p-3 position-absolute top-0 end-0" aria-label="Close" onclick="frm_close()" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?= __('btn_Close', $lang) ?>"></button>
    <form id="articleEditform" action="admin.php?section=articles&page=<?= $_GET['page'] ?>&edit=<?= $_GET['edit'] ?>#form" method="POST">
      <input type="hidden" name="date_published" value="<?= $fields[0]["date_published"] ?>">
      <div class="mb-6 row">
        <label for="inputTitle" class="col-sm-2 col-form-label"><?= __('frm_Title', $lang) ?></label>
        <div class="col-sm-6">
          <input type="text" class="form-control form-control-sm" name="inputTitle" id="inputTitle" value="<?= $fields[0]["title"] ?>">
        </div>
      </div>

      <div class="mb-6 row">
        <label for="flexSwitchCheckDefault" class="col-sm-2 col-form-label"><?= __('frm_Enabled', $lang) ?></label>
        <div class="col-sm-6">
          <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" name="flexSwitchCheckDefault" id="flexSwitchCheckDefault" <?= $fields[0]["enabled"] == 1 ? "checked" : "" ?>>
            <label class="form-check-label" for="flexSwitchCheckDefault"></label>
          </div>
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
        <label for="inputSubTitle" class="col-sm-2 col-form-label"><?= __('frm_Subtitle', $lang) ?></label>
        <div class="col-sm-6">
          <input type="text" class="form-control form-control-sm" name="inputSubTitle" id="inputSubTitle" value="<?= $fields[0]["subtitle"] ?>">
        </div>
      </div>

      <div class="mb-6 row">
        <label for="inputAuthor" class="col-sm-2 col-form-label"><?= __('frm_Author', $lang) ?></label>
        <div class="col-sm-6">
          <select class="form-select" aria-label="Default select" name="inputAuthor" id="inputAuthor">
            <?php
            $authors = $db->send("SELECT id, name FROM users;"); ?>
            <option value="0">Default</option>
            <?php foreach ($authors as $key) : ?>
              <option value="<?= $key['id'] ?>" <?= $key['id'] == $fields[0]["author"] ? " selected" : "" ?>>
                <?= $key['name'] ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

      </div>
      <div>
        <!-- class="mb-6 row" -->
        <label for="inputText" class="col-sm-2 col-form-label"><?= __('frm_Text', $lang) ?></label>
        <div>
          <!-- class="col-sm-6" -->
          <textarea cols="100" name="inputText" id="inputText"><?= $fields[0]["text"] ?></textarea>
        </div>
      </div>
      <!-- -->
      <input type="hidden" id="inputId" name="inputId" value="<?= $fields[0]["id"] ?>">
      <input type="hidden" id="inputDelete" name="inputDelete" value="0">
      <button type="button" onclick="aceptar(0);" class="btn btn-primary" name="bttn1"><?= __('btn_Update', $lang) ?></button>
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
        <button type="button" class="btn btn-primary" onclick="aceptar(1);"><?= __('btn_Ok', $lang) ?></button>
      </div>
    </div>
  </div>
</div>

<script>
  function changeImg() {
    console.log("Activo");
    var configuracion_ventana = "menubar=no,toolbar=no,location=yes,resizable=no,scrollbars=yes,status=no,height=500,width=800";
    var anotherwindow = window.open("filebrowser.php", "test", configuracion_ventana);
    //anotherwindow.bgColor = "black";
  }

  CKEDITOR.replace('inputText', {
    //filebrowserUploadUrl: 'js/ckeditor/ck_upload.php',
    //extraAllowedContent: 'img[idunique]',
    //filebrowserBrowseUrl: 'admin/filebrowserv.php?type=all',
    filebrowserImageBrowseUrl: 'filebrowser2.php?type=images',
    filebrowserWindowWidth: '730',
    filebrowserWindowHeight: '500',
    removeDialogTabs: "image:advanced",

  });

  function aceptar(del) {
    /*
    Envía el formulario desde el botón Actualizar (del=false) y el botón Eliminar(del= true)
    */
    document.getElementById("inputDelete").value = del;
    if (!del) {
      var texto = CKEDITOR.instances['inputText'].getData();
      CKEDITOR.instances['inputText'].setData(texto);
    }
    document.getElementById("articleEditform").submit();
  }

  function frm_close() {
    window.location.href = "<?= $urlsite ?>/admin.php?section=articles&page=<?= $page ?>";
  }
</script>