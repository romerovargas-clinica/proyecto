<?php

// Procesamiento de formulario #TO DO: esta copiado de users
$error = "";
if (isset($_POST['inputTitle']) && isset($_GET['edit'])) :
    echo "LLEGO HASTA AQUI";
    if (isset($_POST['inputDelete']) && $_POST['inputDelete'] == 1) :
        $id = $_POST['inputId'];
        $db->send("DELETE FROM publi WHERE id = $id;");
    endif;
    // Campos Obligatorios
    $id = $_POST['inputId'];
    $title = $_POST['inputTitle'];
    $block1 = $_POST['inputBlock1'];
    $block2 = $_POST['inputBlock2'];
    $enable = $_POST['inputEnable'];
    if ($enable == 1) {
        $db->send("UPDATE publi SET enable = 0");
    }

    if (isset($title)) :
        //update()
        $anarray = array();
        $anarray["title"] = $title;
        $anarray["block1"] = $block1;
        $anarray["block2"] = $block2;
        $anarray["enable"] = $enable;
        $recordset = $db->update("publi", $anarray, "id = " . $id);
        if (!$recordset) :
            $error = __('err_UpdateInfo', $lang);
        endif;
    else :
        $error = __('err_MissingData', $lang);
    endif;
endif;

//añadir
if (isset($_POST['InputNew'])) :
    $title = $_POST['inputTitle'];
    $block1 = $_POST['inputBlock1'];
    $block2 = $_POST['inputBlock2'];
    $enable = $_POST['inputEnable'];
    if ($enable == 1) {
        $db->send("UPDATE publi SET enable = 0");
    }

    $db->send("INSERT INTO `publi`(`title`, `block1`, `block2`, `enable`) VALUES 
    ('$title','$block1','$block2',$enable)");
endif;

$isEnable[0] = "Case_Disable";
$isEnable[1] = "Case_Enable";

?>

<!--Tabla para los tratamientos-->
<h2><?= __('sect_announce', $lang) ?></h2>
<div class="table-responsive">

    <?php
    $table = "publi";
    include "admin/pagination.php";
    ?>

    <table class="table table-striped table-sm table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th><?= __('frm_Title', $lang) ?></th>
                <th><?= __('frm_Block1', $lang) ?></th>
                <th><?= __('frm_Block2', $lang) ?></th>
                <th><?= __('frm_Active', $lang) ?></th>


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
                    <tr class="tbl-h<?= $class ?>" onclick="window.location='admin.php?section=announce&page=<?= ($page) ?>&edit=<?= $recordT['id'] ?>';">
                        <td><?= $recordT["id"] ?></td>
                        <td><?= $recordT["title"] ?></td>
                        <td><?= $recordT["block1"] ?></td>
                        <td><?= $recordT["block2"] ?></td>
                        <td><?= __($isEnable[$recordT["enable"]], $lang) ?></td>



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
        <form id="AnnounceAddform" action="admin.php?section=announce&page=<?= $page ?>" method="POST">

            <div class="mb-6 row">
                <label for="inputTitle" class="col-sm-2 col-form-label"><?= __('frm_Title', $lang) ?></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control form-control-sm" name="inputTitle" id="inputTitle" required>
                </div>
            </div>
            <div class="mb-6 row">
                <label for="inputBlock1" class="col-sm-2 col-form-label"><?= __('frm_Block1', $lang) ?></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control form-control-sm" name="inputBlock1" id="inputBlock1">
                </div>
            </div>
            <div class="mb-6 row">
                <label for="inputBlock2" class="col-sm-2 col-form-label"><?= __('frm_Block2', $lang) ?></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control form-control-sm" name="inputBlock2" id="inputBlock2">
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
        $fields[0]["title"] = $title;
        $fields[0]["block1"] = $block1;
        $fields[0]["block2"] = $block2;
        $fields[0]["enable"] = $enable;
    else :
        $fields = $db->send("SELECT * FROM publi WHERE id = " . $_GET['edit']);
    endif;
?>
    <a name="form"></a>
    <div class="container-md border position-relative p-3">
        <button type="button" class="btn-close p-3 position-absolute top-0 end-0" aria-label="Close" onclick="frm_close()" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?= __('btn_Close', $lang) ?>"></button>
        <form id="announceEditform" action="admin.php?section=announce&page=<?= $page ?>&edit=<?= $_GET['edit'] ?>#form" method="POST">

            <div class="mb-6 row">
                <label for="inputTitle" class="col-sm-2 col-form-label"><?= __('frm_Title', $lang) ?></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control form-control-sm" name="inputTitle" id="inputTitle" required value="<?= $fields[0]["title"] ?>">
                </div>
            </div>
            <div class="mb-6 row">
                <label for="inputBlock1" class="col-sm-2 col-form-label"><?= __('frm_Block1', $lang) ?></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control form-control-sm" name="inputBlock1" id="inputBlock1" value="<?= $fields[0]["block1"] ?>">
                </div>
            </div>
            <div class="mb-6 row">
                <label for="inputBlock2" class="col-sm-2 col-form-label"><?= __('frm_Block2', $lang) ?></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control form-control-sm" name="inputBlock2" id="inputBlock2" value="<?= $fields[0]["block2"] ?>">
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
    function aceptar() {
        document.getElementById("inputDelete").value = "1";
        //$('#myModal').modal('hide');
        document.getElementById("announceEditform").submit();
    }

    function frm_close() {
        window.location.href = "<?= $urlsite ?>/admin.php?section=announce&page=<?= $page ?>";
    }
</script>