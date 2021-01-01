<?php

  // Procesamiento de formulario
  $error = "";
  if(isset($_POST['inputId'])):
    if(isset($_POST['inputDelete']) && $_POST['inputDelete']==1):
      echo "Pendiente:";
    endif;  
    // Campos Obligatorios
    $id = $_POST['inputId'];
    $type = $_POST['inputType'];
    $label = $_POST['inputLabel'];
    $value = $_POST['inputValue'];    
    if($value!=""):
      //update($table, $update, $where, $SQLInyection = 'YES')
      $anarray = array();
      $anarray["value"] = $value;      
      $recordset = $db->update("config", $anarray, "id = ".$id);
      if(!$recordset):
        $error = "Error al actualizar los datos"; // To-Do Translate
      endif;
    else:
      $error = "Falta cumplimentar datos"; // TO-DO Translate
    endif;
  endif;

  // Gestión de la paginación de registros
  include "admin/pagination.php";

  //calculo el total de paginas
  $row = $db->send("SELECT Count(*) as total FROM config;");
  $numResult = $row[0]['total'];
  $total_pages = ceil($numResult / $maxRow);  
  $records = $db->select("config", "1 = 1 ORDER BY id ASC LIMIT ".$start.", ".$maxRow);
?>

<h2><?=__('sect_settings',$lang)?></h2>
<div class="table-responsive">
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-end">
      <?php if ($total_pages >= 1) {
        if ($page != 1) {?>
      <li class="page-item"><a class="page-link" href="admin.php?section=settings&page=<?=($page-1)?>">&laquo;</a></li>
      <?php }
  
      for ($i=1;$i<=$total_pages;$i++) {
        if ($page == $i) {?>
          <li class="page-item"><a class="page-link" href="#"><?=$i?></a></li>
      <?php } else { ?>
        <li class="page-item"><a class="page-link" href="admin.php?section=settings&page=<?=$i?>"><?=$i?></a></li>
      <?php }
      }
  
      if ($page != $total_pages) { ?>
        <li class="page-item"><a class="page-link" href="admin.php?section=settings&page=<?=$page+1?>">&raquo;</a></li>
      <?php }
      }?>
    </ul>
  </nav>

  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th>#</th>
        <th><?=__('frm_Type',$lang)?></th>
        <th><?=__('frm_Label',$lang)?></th>
        <th><?=__('frm_Value',$lang)?></th>
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
      <tr class="tbl-h<?=$class?>" onclick="window.location='admin.php?section=settings&page=<?=($page)?>&edit=<?=$record['id']?>';">
        <td><?=$record["id"]?></td>
        <td><?=$record["type"]?></td>
        <td><?=$record["label"]?></td>
        <td><?=$record["value"]?></td>
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
  if(isset($id)):
    $fields[0]["id"] = $id;
    $fields[0]["type"] = $type;
    $fields[0]["label"] = $label;
    $fields[0]["value"] = $value;    
  else:
    $fields = $db->send("SELECT * FROM config WHERE id = ".$_GET['edit']);
  endif;
  ?>
  <a name="form"></a>
  <div class="container-md border position-relative p-3">
  <button type="button" class="btn-close p-3 position-absolute top-0 end-0" aria-label="Close" onclick="frmUser_close()"></button>
  <form id="userform" action="admin.php?section=settings&page=<?=$_GET['page']?>&edit=<?=$_GET['edit']?>#form" method="POST">
    <div class="mb-6 row">
      <label for="inputType" class="col-sm-2 col-form-label"><?=__('frm_Type',$lang)?></label>
      <div class="col-sm-6">
        <input type="text" readonly class="form-control form-control-sm" name="inputType" id="inputType" value="<?=$fields[0]["type"]?>">
      </div>
    </div>
    <div class="mb-6 row">
      <label for="inputLabel" class="col-sm-2 col-form-label"><?=__('frm_Label',$lang)?></label>
      <div class="col-sm-6">
        <input type="text" readonly class="form-control form-control-sm" name="inputLabel" id="inputLabel" value="<?=$fields[0]["label"]?>">
      </div>
    </div>
    <div class="mb-6 row">
      <label for="inputValue" class="col-sm-2 col-form-label"><?=__('frm_Value',$lang)?></label>
      <div class="col-sm-6">
        <input type="text" class="form-control form-control-sm" name="inputValue" id="inputValue" value="<?=$fields[0]["value"]?>">
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
function frmUser_close(){
  window.location.href="http://clinica.com/admin.php?section=settings&page=<?=$page?>";
}
</script>