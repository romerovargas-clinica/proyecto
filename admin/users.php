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
  $row = $db->send("SELECT Count(*) as total FROM users;");
  $numResult = $row[0]['total'];
  $total_pages = ceil($numResult / $maxRow);
  $records = $db->select("users", "1 = 1 ORDER BY id ASC LIMIT ".$start.", ".$maxRow);
?>

<h2><?=__('sect_users',$lang)?></h2>
<div class="table-responsive">
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-end">
      <?php if ($total_pages >= 1) {
        if ($page != 1) {?>
          <li class="page-item"><a class="page-link" href="admin.php?section=users&page=<?=($page-1)?>">&laquo;</a></li>         
        <?php }
  
        for ($i=1;$i<=$total_pages;$i++) {
          if ($page == $i) {?>
            <li class="page-item"><a class="page-link" href="#"><?=$i?></a></li>
          <?php } else { ?>
            <li class="page-item"><a class="page-link" href="admin.php?section=users&page=<?=$i?>"><?=$i?></a></li>
          <?php }
        }
  
        if ($page != $total_pages) { ?>
          <li class="page-item"><a class="page-link" href="admin.php?section=users&page=<?=$page+1?>">&raquo;</a></li>
        <?php }
      }?>
    </ul>
  </nav>

  <table class="table table-striped table-sm table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th><?=__('frm_Name',$lang)?></th>
        <th><?=__('frm_FirstName',$lang)?></th>
        <th><?=__('frm_LastName',$lang)?></th>
        <th><?=__('frm_Roles',$lang)?></th>
        <th><?=__('frm_Email',$lang)?></th>
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
            <tr class="tbl-h<?=$class?>" onclick="window.location='admin.php?section=users&page=<?=($page)?>&edit=<?=$record['id']?>';">
                <td><?=$record["id"]?></td>
                <td><?=$record["name"]?></td>
                <td><?=$record["firstname"]?></td>
                <td><?=$record["lastname"]?></td>
                <td><?=$record["roles"]?></td>
                <td><?=$record["email"]?></td>
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
    $fields[0]["name"] = $name;
    $fields[0]["firstname"] = $firstname;
    $fields[0]["lastname"] = $lastname;
    $fields[0]["email"] = $email;
    $fields[0]["roles"] = $rol;
  else:
    $fields = $db->send("SELECT * FROM users WHERE id = ".$_GET['edit']);
  endif;
  ?>
  <a name="form"></a>
  <div class="container-md border position-relative p-3">
  <button type="button" class="btn-close p-3 position-absolute top-0 end-0" aria-label="Close" onclick="frmUser_close()"></button>
  <form id="userform" action="admin.php?section=users&page=<?=$_GET['page']?>&edit=<?=$_GET['edit']?>#form" method="POST">
    <div class="mb-6 row">
      <label for="inputName" class="col-sm-2 col-form-label"><?=__('frm_Name',$lang)?></label>
      <div class="col-sm-6">
        <input type="text" readonly class="form-control form-control-sm" name="inputName" id="inputName" value="<?=$fields[0]["name"]?>">
      </div>
    </div>
    <div class="mb-6 row">
      <label for="inputFirstName" class="col-sm-2 col-form-label"><?=__('frm_FirstName',$lang)?></label>
      <div class="col-sm-6">
        <input type="text" class="form-control form-control-sm" name="inputFirstName" id="inputFirstName" value="<?=$fields[0]["firstname"]?>">
      </div>
    </div>
    <div class="mb-6 row">
      <label for="inputLastName" class="col-sm-2 col-form-label"><?=__('frm_LastName',$lang)?></label>
      <div class="col-sm-6">
        <input type="text" class="form-control form-control-sm" name="inputLastName" id="inputLastName" value="<?=$fields[0]["lastname"]?>">
      </div>
    </div>
    <div class="mb-6 row">
      <label for="inputEmail" class="col-sm-2 col-form-label"><?=__('frm_Email',$lang)?></label>
      <div class="col-sm-6">
        <input type="email" class="form-control form-control-sm" name="inputEmail" id="inputEmail" value="<?=$fields[0]["email"]?>">
      </div>
    </div>
    <div class="mb-6 row">
      <label for="inputRoles" class="col-sm-2 col-form-label"><?=__('frm_Roles',$lang)?></label>
      <div class="col-sm-6">
      <select class="form-select" aria-label="Default select" name="inputRol">
        <?php $roles = array("[ADMIN-USER]", "[AUTHOR]", "[CUSTOMER]","[USER]","[NONE]");
        foreach($roles as $key):?>
        <option value="<?=$key?>"<?=$fields[0]["roles"]==$key ? " selected" : ""?>><?=$key?></option>
        <?php endforeach;?>        
      </select>        
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
  window.location.href="http://clinica.com/admin.php?section=users&page=<?=$page?>";
}
</script>