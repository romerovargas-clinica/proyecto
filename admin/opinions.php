<?php

// Procesamiento de formulario 
$error = "";
if (isset($_POST['inputName']) && isset($_GET['edit'])) :
    if (isset($_POST['inputDelete']) && $_POST['inputDelete'] == 1) :
        $id = $_POST['inputId'];
        $db->send("DELETE FROM testimonial WHERE id = $id;");
    endif;
    // Campos Obligatorios
    $id = $_POST['inputId'];
    $name = $_POST['inputName'];
    $occupation = $_POST['inputOccupation'];
    $image = $_POST['inputImage'];
    $comment = $_POST['inputComment'];
    $enable = $_POST['inputEnable'];
    //TO-DO: hay que adaptar la comprobacion de los datos para esta parte
    $anarray = array();
    $anarray["name"] = $name;
    $anarray["occupation"] = $occupation;
    $anarray["image"] = $image;
    $anarray["comment"] = $comment;
    $anarray["enabled"] = $enable;
    $recordset = $db->update("testimonial", $anarray, "id = " . $id);
endif;
//añadir
if (isset($_POST['InputNew'])) :
    $name = $_POST['inputName'];
    $occupation = $_POST['inputOccupation'];
    $image = $_POST['inputImage'];
    $comment = $_POST['inputComment'];
    $enable = $_POST['inputEnable'];

    $db->send("INSERT INTO `testimonial` ( `name`, `occupation`, `image`, `comment`, `enabled`) VALUES
  ( '$name', '$occupation', '$image', '$comment', $enable);");
endif;

$isEnable[0] = "Case_Disable";
$isEnable[1] = "Case_Enable";


?>

<!--Tabla para los tratamientos-->
<h2><?= __('sect_opinions', $lang) ?></h2>
<div class="table-responsive">

    <?php
    $table = "testimonial";
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
                    <tr class="tbl-h<?= $class ?>" onclick="window.location='admin.php?section=opinions&page=<?= ($page) ?>&edit=<?= $recordT['id'] ?>';">
                        <td><?= $recordT["id"] ?></td>
                        <td><?= $recordT["name"] ?></td>
                        <td><?= $recordT["occupation"] ?></td>
                        <td>
                            <?php if ($recordT["image"] != null) : ?>
                                <img src="<?= $recordT["image"] ?>" class="crop rounded d-block" alt="" height="25">
                            <?php else : ?>
                                <img src="images/blank.png" class="crop rounded d-block" alt="" height="25">
                            <?php endif; ?>
                        </td>
                        <td><?= $recordT["comment"] ?></td>
                        <td><?= $recordT["enabled"] ?></td>
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
        <form id="opinionsAddform" action="admin.php?section=opinions&page=<?= $page ?>" method="POST">

            <div class="mb-6 row">
                <label for="inputName" class="col-sm-2 col-form-label"><?= __('frm_FirstName', $lang) ?></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control form-control-sm" name="inputName" id="inputName" required>
                </div>
            </div>
            <div class="mb-6 row">
                <label for="inputOccupation" class="col-sm-2 col-form-label"><?= __('frm_Occupation', $lang) ?></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control form-control-sm" name="inputOccupation" id="inputOccupation" required>
                </div>
            </div>
            <div class="mb-6 row">
                <label for="inputImage" class="col-sm-2 col-form-label"><?= __('frm_Image', $lang) ?></label>
                <div class="col-sm-6">
                    <div class="card-img-top"><img src="images/blank.png" class="crop rounded d-block" alt="" height="50" onclick="changeImg();" id="img_base"></div>
                    <input type="hidden" name="inputImage" value="<?= $fields[0]["image"] ?>" id="img_base_hd">
                </div>
            </div>
            <div class="mb-6 row">
                <label for="inputComment" class="col-sm-2 col-form-label"><?= __('frm_Comment', $lang) ?></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control form-control-sm" name="inputComment" id="inputComment" required>
                </div>
            </div>
            <div class="mb-6 row">
                <label for="inputEnable" class="col-sm-2 col-form-label"><?= __('frm_Active', $lang) ?></label>
                <div class="col-sm-6">
                    <select class="form-select" aria-label="Default select" name="inputEnable" required>
                        <option value="0"><?= __($isEnable[0], $lang) ?></option>
                        <option value="1"><?= __($isEnable[1], $lang) ?></option>
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
        $fields[0]["name"] = $name;
        $fields[0]["occupation"] = $occupation;
        $fields[0]["image"] = $image;
        $fields[0]["comment"] = $comment;
        $fields[0]["enable"] = $enable;

    else :
        $fields = $db->send("SELECT * FROM testimonial WHERE id = " . $_GET['edit']);
    endif;
?>
    <a name="form"></a>
    <div class="container-md border position-relative p-3">
        <button type="button" class="btn-close p-3 position-absolute top-0 end-0" aria-label="Close" onclick="frm_close()" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?= __('btn_Close', $lang) ?>"></button>
        <form id="opinionsEditform" action="admin.php?section=opinions&page=<?= $page ?>&edit=<?= $_GET['edit'] ?>#form" method="POST">

            <div class="mb-6 row">
                <label for="inputName" class="col-sm-2 col-form-label"><?= __('frm_FirstName', $lang) ?></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control form-control-sm" name="inputName" id="inputName" required value="<?= $fields[0]["name"] ?>">
                </div>
            </div>
            <div class="mb-6 row">
                <label for="inputOccupation" class="col-sm-2 col-form-label"><?= __('frm_Occupation', $lang) ?></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control form-control-sm" name="inputOccupation" id="inputOccupation" required value="<?= $fields[0]["occupation"] ?>">
                </div>
            </div>
            <div class="mb-6 row">
                <label for="inputImage" class="col-sm-2 col-form-label"><?= __('frm_Image', $lang) ?></label>
                <div class="col-sm-6">
                    <?php if ($fields[0]["image"] == null) :
                        $_img = "images/blank.png";
                    else :
                        $_img = $fields[0]["image"];
                    endif; ?>
                    <div class="card-img-top"><img src="<?= $_img ?>" class="crop rounded d-block" alt="" height="50" onclick="changeImg();" id="img_base"></div>
                    <input type="hidden" name="inputImage" value="<?= $fields[0]["image"] ?>" id="img_base_hd">
                </div>
            </div>
            <div class="mb-6 row">
                <label for="inputComment" class="col-sm-2 col-form-label"><?= __('frm_Comment', $lang) ?></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control form-control-sm" name="inputComment" id="inputComment" required value="<?= $fields[0]["comment"] ?>">
                </div>
            </div>
            <div class="mb-6 row">
                <label for="inputEnable" class="col-sm-2 col-form-label"><?= __('frm_Active', $lang) ?></label>
                <div class="col-sm-6">
                    <select class="form-select" aria-label="Default select" name="inputEnable" required>
                        <option value="0"><?= __($isEnable[0], $lang) ?></option>
                        <option value="1"><?= __($isEnable[1], $lang) ?></option>
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
        var configuracion_ventana = "menubar=no,toolbar=no,location=yes,resizable=no,scrollbars=yes,status=no,height=500,width=800";
        var anotherwindow = window.open("filebrowser.php", "test", configuracion_ventana);
        //anotherwindow.bgColor = "black";
    }

    function aceptar() {
        document.getElementById("inputDelete").value = "1";
        //$('#myModal').modal('hide');
        document.getElementById("opinionsEditform").submit();
    }

    function frm_close() {
        window.location.href = "<?= $urlsite ?>/admin.php?section=opinions&page=<?= $page ?>";
    }
</script>