<?php

// Procesamiento de formulario
$error = "";
if (isset($_POST['inputTitle'])) :
  if (isset($_POST['inputDelete']) && $_POST['inputDelete'] == 1) :
    echo "Pendiente: Eliminar Articulo";
  endif;
  // Campos Obligatorios    
  $id = $_POST['inputId'];
  $title = $_POST['inputTitle'];
  $subtitle = $_POST['inputSubTitle'];
  $author = $_POST['inputAuthor'];
  $text = $_POST['inputText'];
  echo "<pre>" . $text . "</pre>";
  // Función inversa para leer las etiquetas de imagenes escritas por javascript, crear los registros necesarios y sustituirlas por sus referencias en la base de datos
  if (preg_match_all('#{(.*?)}#', $text, $match) != 0) :
    $img = array();
    $i = 0;
    foreach ($match[0] as $imagenes) :
      preg_match('#alt\[(.*?)\]#', $imagenes, $match);
      $img[$i]['alt'] = $match[1];
      preg_match('#src\[(.*?)\]#', $imagenes, $match);
      $img[$i]['src'] = $match[1];
      preg_match('#style\[(.*?)\]#', $imagenes, $match);
      $img[$i]['style'] = $match[1];
      preg_match('#idunique\[(.*?)\]#', $imagenes, $match);
      $idunique = $match[1];
      if ($idunique == "none") {
        // actualizar registro
        // numero unico 
        $bytes = openssl_random_pseudo_bytes(4, $cstrong);
        $hex   = bin2hex($bytes);
        $img[$i]['id'] = $hex;
        $recordset = $db->insert("images", $img[$i]);
        if (!$recordset) :
          echo "Error introduciendo datos en tabla images"; // To-Do Translate
        endif;
      } else {
        $hex = $idunique;
        $recordset = $db->update("images", $img[$i], "id = '$idunique'");
      }
      // por último, quitar del texto la etiqueta entre llaves y sustituirlo por la referencia de la imagen
      $text = str_replace($imagenes, "[IMG:" . $hex . "]", $text);
      $i++;
    endforeach;
  endif;
  if ($title != "") :
    //update($table, $update, $where, $SQLInyection = 'YES')
    $anarray = array();
    $anarray["title"] = $title;
    $anarray["subtitle"] = $subtitle;
    $anarray["author"] = $author;
    $anarray["text"] = $text;
    $recordset = $db->update("articles", $anarray, "id = " . $id);
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
  include "admin/pagination.php";
  ?>

  <table class="table table-striped table-sm table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th><?= __('frm_Title', $lang) ?></th>
        <th id="subtitle"><?= __('frm_Subtitle', $lang) ?></th>
        <th><?= __('frm_Publish', $lang) ?></th>
        <th><?= __('frm_Text', $lang) ?></th>
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
            <td class="d-inline-block text-truncate" style="max-width: 200px"><?= $record["subtitle"] ?></td>
            <td><?= $record["date_published"] ?></td>
            <td class="d-inline-block text-truncate" style="max-width: 300px"><?= strip_tags($record["text"]) ?></td>
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
if (isset($_GET['edit'])) :
  if (isset($name)) :
    $fields[0]["title"] = $title;
    $fields[0]["subtitle"] = $subtitle;
    $fields[0]["text"] = $text;
    $fields[0]["enabled"] = $enabled;
    $fields[0]["author"] = $author;
  else :
    $fields = $db->send("SELECT a.id, a.title, a.subtitle, a.text, b.id as author FROM articles a INNER JOIN users b ON a.author = b.id WHERE a.id = " . $_GET['edit']);
  endif;
  // reemplazamos los IMG:id
  if (preg_match_all('#\[(.*?)\]#', $fields[0]["text"], $match) != 0) :
    foreach ($match[0] as $etiquetas) :
      $html = labelToImage($etiquetas);
      $fields[0]["text"] = str_replace($etiquetas, $html, $fields[0]["text"]);
    endforeach;
  endif;
?>
  <a name="form"></a>
  <div class="container-md border position-relative p-3">
    <button type="button" class="btn-close p-3 position-absolute top-0 end-0" aria-label="Close" onclick="frm_close()"></button>
    <form id="userform" action="admin.php?section=articles&page=<?= $_GET['page'] ?>&edit=<?= $_GET['edit'] ?>#form" method="POST">
      <div class="mb-6 row">
        <label for="inputTitle" class="col-sm-2 col-form-label"><?= __('frm_Title', $lang) ?></label>
        <div class="col-sm-6">
          <input type="text" readonly class="form-control form-control-sm" name="inputTitle" id="inputTitle" value="<?= $fields[0]["title"] ?>">
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
      <button type="button" onclick="aceptar(false);" class="btn btn-primary" name="bttn1"><?= __('btn_Update', $lang) ?></button>
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
        <button type="button" class="btn btn-primary" onclick="aceptar(true);"><?= __('btn_Ok', $lang) ?></button>
      </div>
    </div>
  </div>
</div>

<script>
  CKEDITOR.replace('inputText', {
    //filebrowserUploadUrl: 'js/ckeditor/ck_upload.php',
    extraAllowedContent: 'img[idunique]',
    //filebrowserBrowseUrl: 'admin/filebrowserv.php?type=all',
    filebrowserImageBrowseUrl: 'filebrowser.php?type=images',
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
      // sustituimos las etiquetas "img" por otra pseudo-etiqueta segura que pase el filtro anti SQL_Injection
      // <img alt="hola" src="../../images/uploads/compartecoche.png" style="height:354px; width:354px" />
      // <img => [IMG:
      // /> => ]      
      var texto = CKEDITOR.instances['inputText'].getData();

      var imagen = texto.match(/<img\s+[^>]*\b[(.*?)]*\"\s*\/>/)[0];
      while (imagen !== null) {
        console.log('Imagen: ' + imagen);
        console.log(typeof(image));
        var var_alt = imagen.match(/alt\=\"[a-zA-Z]*\"/)[0];
        var var_src = imagen.match(/src\=\"[\-|\_|\,|\.|\/|a-zA-ZÀ-ÿ\u00f1\u00d1|A-Z|0-9|\:|\;|\s|\.]*\"/)[0];
        var var_style = imagen.match(/style\=\"[a-zA-Z0-9\:|\;|\s]*\"/)[0];
        var var_idunique = imagen.match(/idunique\=\"[a-zA-Z0-9]*\"/)[0];
        if (var_alt !== null) {
          console.log(var_alt);
          var_alt_length = var_alt.length;
          var_alt = var_alt.substring(5, var_alt_length - 1);
        } else var_alt = "";
        if (var_src !== null) {
          console.log(var_src);
          var_src_length = var_src.length;
          var_src = var_src.substring(5, var_src_length - 1);
        } else var_src = "";
        if (var_style !== null) {
          console.log(var_style);
          var_style_length = var_style.length;
          var_style = var_style.substring(7, var_style_length - 1);
        } else var_style = "";

        if (var_idunique === null) {
          var_idunique = "none";
        } else var_idunique = var_idunique.substring(10, var_idunique.length - 1);
        var new_text = "{IMG:alt[" + var_alt + "]";
        new_text = new_text + "IMG:src[" + var_src + "]";
        new_text = new_text + "IMG:style[" + var_style + "]";
        new_text = new_text + "IMG:idunique[" + var_idunique + "]}";

        console.log(new_text);
        texto = texto.replace(imagen, new_text);

        try {
          imagen = texto.match(/<img\s+[^>]*\b[(.*?)]*\"\s*\/>/)[0];
        } catch (e) {
          console.log(e);
          break;
        }
      }
      CKEDITOR.instances['inputText'].setData(texto);
    }
    document.getElementById("userform").submit();
  }

  function frm_close() {
    window.location.href = "/admin.php?section=articles&page=<?= $page ?>";
  }
</script>