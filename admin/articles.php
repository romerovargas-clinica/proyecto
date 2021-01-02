<?php

  // Procesamiento de formulario
  $error = "";
  if(isset($_POST['inputName'])):
    if(isset($_POST['inputDelete']) && $_POST['inputDelete']==1):
      echo "Pendiente: Eliminar usuario";
    endif;  
    // Campos Obligatorios
    $id = $_POST['inputId'];
    $name = $_POST['inputName'];
    $firstname = $_POST['inputFirstName'];
    $lastname = $_POST['inputLastName'];
    $email = $_POST['inputEmail'];
    $rol = $_POST['inputRol'];
    if($firstname!="" && $lastname!="" && $email!=""):
      //update($table, $update, $where, $SQLInyection = 'YES')
      $anarray = array();
      $anarray["firstname"] = $firstname;
      $anarray["lastname"] = $lastname;
      $anarray["email"] = $email;
      $anarray["roles"] = $rol;
      $recordset = $db->update("users", $anarray, "id = ".$id);
      if(!$recordset):
        $error = "Error al actualizar los datos"; // To-Do Translate
      endif;
    else:
      $error = "Falta cumplimentar datos"; // TO-DO Translate
    endif;
  endif;

  // Gestión de la paginación de registros
  include "admin/pagination.php";
  
  // Calculo el total de paginas
  $row = $db->send("SELECT Count(*) as total FROM articles;");
  $numResult = $row[0]['total'];
  $total_pages = ceil($numResult / $maxRow);
  $records = $db->select("articles", "1 = 1 ORDER BY id ASC LIMIT ".$start.", ".$maxRow);
?>

<h2><?=__('sect_articles',$lang)?></h2>
<div class="table-responsive">
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-end">
      <?php if ($total_pages >= 1) {
        if ($page != 1) {?>
          <li class="page-item"><a class="page-link" href="admin.php?section=articles&page=<?=($page-1)?>">&laquo;</a></li>
        <?php }
  
        for ($i=1;$i<=$total_pages;$i++) {
          if ($page == $i) {?>
            <li class="page-item"><a class="page-link" href="#"><?=$i?></a></li>
          <?php } else { ?>
            <li class="page-item"><a class="page-link" href="admin.php?section=articles&page=<?=$i?>"><?=$i?></a></li>
          <?php }
        }
  
        if ($page != $total_pages) { ?>
          <li class="page-item"><a class="page-link" href="admin.php?section=articles&page=<?=$page+1?>">&raquo;</a></li>
        <?php }
      }?>
    </ul>
  </nav>

  <table class="table table-striped table-sm table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th><?=__('frm_Title',$lang)?></th>
        <th id="subtitle"><?=__('frm_Subtitle',$lang)?></th>
        <th><?=__('frm_Publish',$lang)?></th>
        <th><?=__('frm_Text',$lang)?></th>        
      </tr>
    </thead>
    <tbody>
        <?php if(!empty($records)):
          $cont = 0;
          foreach($records as $record):
            if(isset($_GET['edit']) && $record['id']==$_GET['edit']):
              $class = " fw-bold";
            else:
              $class = "";
            endif;
          ?>
            <tr class="tbl-h<?=$class?>" onclick="window.location='admin.php?section=articles&page=<?=($page)?>&edit=<?=$record['id']?>';" style="background-color: rgba(0, 0, 0, 0.05); background-image:linear-gradient(var(--bs-table-accent-bg),var(--bs-table-accent-bg))">
                <td><?=$record["id"]?></td>
                <td><?=$record["title"]?></td>
                <td class="d-inline-block text-truncate" style="max-width: 200px"><?=$record["subtitle"]?></td>
                <td><?=$record["date_published"]?></td>
                <td class="d-inline-block text-truncate" style="max-width: 300px"><?=$record["text"]?></td>                
            </tr>
        <?php
            $cont++;
            if($cont>=$maxRow) break;
          endforeach;
        endif;?>
        </tbody>
    </table>
</div>    

<div class="container text-warning bg-danger"><?php if($error!="") echo $error;?></div>

<?php
if(isset($_GET['edit'])):
  if(isset($name)):
    $fields[0]["title"] = $title;
    $fields[0]["subtitle"] = $subtitle;
    $fields[0]["text"] = $text;
    $fields[0]["enabled"] = $enabled;
    $fields[0]["author"] = $author;
  else:
    $fields = $db->send("SELECT * FROM articles WHERE id = ".$_GET['edit']);
  endif;
  ?>
  <a name="form"></a>
  <div class="container-md border position-relative p-3">
  <button type="button" class="btn-close p-3 position-absolute top-0 end-0" aria-label="Close" onclick="frmUser_close()"></button>
  <form id="userform" action="admin.php?section=articles&page=<?=$_GET['page']?>&edit=<?=$_GET['edit']?>#form" method="POST">
    <div class="mb-6 row">
      <label for="inputTitle" class="col-sm-2 col-form-label"><?=__('frm_Title',$lang)?></label>
      <div class="col-sm-6">
        <input type="text" readonly class="form-control form-control-sm" name="inputTitle" id="inputTitle" value="<?=$fields[0]["title"]?>">
      </div>
    </div>
    <div class="mb-6 row">
      <label for="inputSubTitle" class="col-sm-2 col-form-label"><?=__('frm_Subtitle',$lang)?></label>
      <div class="col-sm-6">
        <input type="text" class="form-control form-control-sm" name="inputSubTitle" id="inputSubTitle" value="<?=$fields[0]["subtitle"]?>">
      </div>
    </div>
    <div class="mb-6 row">
      <label for="inputText" class="col-sm-2 col-form-label"><?=__('frm_Text',$lang)?></label>
      <div class="col-sm-6">
        <input type="text" class="form-control form-control-sm" name="inputText" id="inputText" value="<?=$fields[0]["text"]?>">
      </div>
    </div>    
    <div class="mb-6 row">
      <label for="inputAuthor" class="col-sm-2 col-form-label"><?=__('frm_Author',$lang)?></label>
      <div class="col-sm-6">
        <input type="text" class="form-control form-control-sm" name="inputAuthor" id="inputAuthor" value="<?=$fields[0]["author"]?>">
      </div>
    </div>
    <input type="hidden" id="inputId" name="inputId" value="<?=$fields[0]["id"]?>">
    <input type="hidden" id="inputDelete" name="inputDelete" value="0">
    <button type="submit" class="btn btn-primary" name="bttn1"><?=__('btn_Update',$lang)?></button> 
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#myModal"><?=__('btn_Deleted',$lang)?></button>    
  </form>
  </div>
  <?php endif;?>
  
  <!-- Modal -->
  <?php

  ?>
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?=__('modal_title_confirm',$lang)?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body"><?=__('modal_text_confirm',$lang)?></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?=__('btn_Close',$lang)?></button>
        <button type="button" class="btn btn-primary" onclick="aceptar();"><?=__('btn_Ok',$lang)?></button>
      </div>
    </div>
  </div>
</div>
<script>
function aceptar(){
  document.getElementById("inputDelete").value = "1";  
  //$('#myModal').modal('hide');
  document.getElementById("userform").submit();
}
function frm_close(){
  window.location.href="http://clinica.com/admin.php?section=articles&page=<?=$page?>";
}
</script>