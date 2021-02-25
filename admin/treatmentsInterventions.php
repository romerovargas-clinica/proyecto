<?php


$error = "";
if (isset($_POST['inputName']) && isset($_GET['edit'])) :
  if (isset($_POST['inputDelete']) && $_POST['inputDelete'] == 1) :
    $id = $_POST['inputId'];
    $db->send("DELETE FROM treatmentsinterventions
    WHERE id = $id;");
  endif;
  // Campos Obligatorios
  $id = $_POST['inputId'];
  $name = $_POST['inputName'];
  $categorie = $_POST['inputCategorie'];
  $imageFile = $_POST['inputImageFile'];
  $imageDir = $_POST['inputImageDir'];
  $info = $_POST['inputInfo'];
  $duration = $_POST['inputDuration'];
  $price = $_POST['inputPrice'];
  //TO-DO: hay que adaptar la comprobacion de los datos para esta parte
  $anarray = array();
  $anarray["name"] = $name;
  $anarray["categorie"] = $categorie;
  $anarray["image"] = $imageFile;
  $anarray["info"] = $info;
  $anarray["duration"] = $duration;
  $anarray["Price"] = $price;
  $recordset = $db->update("treatmentsInterventions", $anarray, "id = " . $id);
endif;

//añadir
if (isset($_POST['InputNew'])) :
  $name = $_POST['inputName'];
  $categorie = $_POST['inputCategorie'];
  $imageFile = $_POST['inputImageFile'];
  $info = $_POST['inputInfo'];
  $duration = $_POST['inputDuration'];
  $price = $_POST['inputPrice'];

  $db->send("INSERT INTO `treatmentsinterventions` ( `name`, `categorie`, `duration`, `price`, `info`, `image`) VALUES
  ( '$name', $categorie, $duration, $price, '$info', '$imageFile');");
endif;



// SQL for ForeignKey table
$categories = $db->send("SELECT name FROM treatmentsCategories;");
$categoriesNames = array(); //nombre de las
foreach ($categories as $categorie) {
  array_push($categoriesNames, $categorie['name']);
}
?>

<!--Tabla para los tratamientos-->
<h2><?= __('sect_treatments', $lang) ?></h2>
<div class="table-responsive">

  <?php
  $table = "treatmentsinterventions";
  $maxRow = 5; // Número de registros a mostrar
  include "admin/pagination.php";
  ?>

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
      <?php if (!empty($records)) :
        $cont = 0;
        foreach ($records as $recordT) :
          if (isset($_GET['edit']) && $recordT['id'] == $_GET['edit']) :
            $class = " fw-bold";
          else :
            $class = "";
          endif;
      ?>
          <tr class="tbl-h<?= $class ?>" onclick="window.location='admin.php?section=treatmentsInterventions&page=<?= ($page) ?>&edit=<?= $recordT['id'] ?>';">
            <td><?= $recordT["id"] ?></td>
            <td><?= $recordT["name"] ?></td>
            <td><?= $categoriesNames[$recordT["categorie"] - 1] ?></td>
            <td>
              <?php if ($recordT["image"] != null) : ?>
                <img src="images/uploads/<?= $recordT["image"] ?>" class="crop rounded d-block" alt="" height="25">
              <?php else : ?>
                <img src="images/blank.png" class="crop rounded d-block" alt="" height="25">
              <?php endif; ?>
            </td>
            <td><?= strlen($recordT['info']) > 200 ? substr($recordT["info"], 0, 200) . "..." : $recordT["info"] ?></td>
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



<?php
//Añadir nueva Intervencion
if (isset($_GET['AddNew'])) : ?>
  <div class="container-md border position-relative p-3">
    <button type="button" class="btn-close p-3 position-absolute top-0 end-0" aria-label="Close" onclick="frm_close()" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?= __('btn_Close', $lang) ?>"></button>
    <form id="interventionsAddform" action="admin.php?section=treatmentsInterventions&page=<?= $page ?>" method="POST">

      <div class="mb-6 row">
        <label for="inputName" class="col-sm-2 col-form-label"><?= __('frm_FirstName', $lang) ?></label>
        <div class="col-sm-6">
          <input type="text" class="form-control form-control-sm" name="inputName" id="inputName" required>
        </div>
      </div>
      <div class="mb-6 row">
        <label for="inputCategorie" class="col-sm-2 col-form-label"><?= __('frm_Categorie', $lang) ?></label>
        <div class="col-sm-6">
          <select class="form-select" aria-label="Default select" name="inputCategorie" required>
            <?php
            for ($i = 0; $i < count($categoriesNames); $i++) {
              $key = $categoriesNames[$i];
            ?>
              <option value="<?= $i + 1 ?>"><?= $key ?> </option>
            <?php }; ?>
          </select>
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
          <input type="text" class="form-control form-control-sm" name="inputInfo" id="inputInfo" required>
        </div>
      </div>
      <div class="mb-6 row">
        <label for="inputDuration" class="col-sm-2 col-form-label"><?= __('frm_Duration', $lang) ?></label>
        <div class="col-sm-6">
          <input type="number" class="form-control form-control-sm" name="inputDuration" id="inputDuration" min="0" required>
        </div>
      </div>
      <div class="mb-6 row">
        <label for="inputPrice" class="col-sm-2 col-form-label"><?= __('frm_Price', $lang) ?></label>
        <div class="col-sm-6">
          <input type="number" class="form-control form-control-sm" name="inputPrice" id="inputPrice" min="0" step=".01" required>
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
    $fields[0]["name"] = $name;
    $fields[0]["categorie"] = $categorie;
    $fields[0]["image"] = $imageFile;
    $fields[0]["info"] = $info;
    $fields[0]["duration"] = $duration;
    $fields[0]["price"] = $price;

  else :
    $fields = $db->send("SELECT * FROM treatmentsInterventions WHERE id = " . $_GET['edit']);
  endif;
?>
  <a name="form"></a>
  <div class="container-md border position-relative p-3">
    <button type="button" class="btn-close p-3 position-absolute top-0 end-0" aria-label="Close" onclick="frm_close()" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?= __('btn_Close', $lang) ?>"></button>
    <form id="interventionsEditform" action="admin.php?section=treatmentsInterventions&page=<?= $page ?>&edit=<?= $_GET['edit'] ?>#form" method="POST">

      <div class="mb-6 row">
        <label for="inputName" class="col-sm-2 col-form-label"><?= __('frm_FirstName', $lang) ?></label>
        <div class="col-sm-6">
          <input type="text" class="form-control form-control-sm" name="inputName" id="inputName" value="<?= $fields[0]["name"] ?>">
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
          <?php if ($fields[0]["image"] == null) :
            $_img = "images/blank.png";
          else :
            $_img = "images/uploads/" . $fields[0]["image"];
          endif; ?>
          <div class="card-img-top"><img src="<?= $_img ?>" class="crop rounded d-block" alt="" height="50" onclick="changeImg();" id="img_base"></div>
          <input type="hidden" name="inputImageFile" value="" id="inputImageFile">
          <input type="hidden" name="inputImageDir" value="" id="inputImageDir">
        </div>
      </div>

      <div class="mb-6 row">
        <label for="inputInfo" class="col-sm-2 col-form-label"><?= __('frm_Desc', $lang) ?></label>
        <div class="col-sm-6">
          <textarea class="form-control form-control-sm" name="inputInfo" id="inputInfo"><?= $fields[0]["info"] ?></textarea>
        </div>
      </div>
      <div class="mb-6 row">
        <label for="inputDuration" class="col-sm-2 col-form-label"><?= __('frm_Duration', $lang) ?> (min)</label>
        <div class="col-sm-6">
          <input type="number" class="form-control form-control-sm" name="inputDuration" id="inputDuration" min="0" value="<?= $fields[0]["duration"] ?>">
        </div>
      </div>
      <div class="mb-6 row">
        <label for="inputPrice" class="col-sm-2 col-form-label"><?= __('frm_Price', $lang) ?> (€)</label>
        <div class="col-sm-6">
          <input type="number" class="form-control form-control-sm" name="inputPrice" id="inputPrice" min="0" step=".01" value="<?= $fields[0]["price"] ?>">
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
    document.getElementById("interventionsEditform").submit();
  }

  function frm_close() {
    window.location.href = "<?= $urlsite ?>/admin.php?section=treatmentsInterventions&page=<?= $page ?>";
  }
</script>