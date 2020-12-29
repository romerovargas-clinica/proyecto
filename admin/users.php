<?php
  $maxRow = 10; // Número de registros a mostrar
  $row = $db->send("SELECT Count(*) as total FROM users;");
  $numResult = $row[0]['total'];  
  $page = false;
  if (isset($_GET["page"])) {
    $page = $_GET["page"];
  }
 
  if (!$page) {
    $start = 0;
    $page = 1;
  } else {
    $start = ($page - 1) * $maxRow;
  }
  //calculo el total de paginas
  $total_pages = ceil($numResult / $maxRow);

  $users = $db->select("users", "1 = 1 ORDER BY id DESC LIMIT ".$start.", ".$maxRow);

  ?>
<h2><?=__('sect_users',$lang)?></h2>
<div class="table-responsive">
    <table class="table table-striped table-sm table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th><?=__('frm_Name',$lang)?></th>
                <th><?=__('frm_FirstName',$lang)?></th>
                <th><?=__('frm_LastName',$lang)?></th>
                <th><?=__('frm_Role',$lang)?></th>
                <th><?=__('frm_Email',$lang)?></th>
            </tr>
        </thead>
        <tbody>
        <?php if(!empty($users)):
          $cont = 0;
          foreach($users as $user):?>
            <tr class="tbl-h" onclick="window.location='admin.php?section=users&page=<?=($page)?>&edit=<?=$user["id"]?>';">
                <td><?=$user["id"]?></td>
                <td><?=$user["name"]?></td>
                <td><?=$user["firstname"]?></td>
                <td><?=$user["lastname"]?></td>
                <td><?=$user["roles"]?></td>
                <td><?=$user["email"]?></td>
            </tr>
        <?php
            $cont++;
            if($cont>=$maxRow) break;
          endforeach;
        endif;?>
        </tbody>
    </table>
</div>    

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
<?php
if(isset($_GET['edit'])):
  $userEdit = $db->send("SELECT * FROM users WHERE id = ".$_GET['edit']);?>

    <div class="mb-6 row">
      <label for="inputName" class="col-sm-2 col-form-label"><?=__('frm_Name',$lang)?></label>
      <div class="col-sm-6">
        <input type="text" readonly class="form-control-plaintext form-control-sm" id="inputName" value="<?=$userEdit[0]["name"]?>">
      </div>
    </div>
    <div class="mb-6 row">
      <label for="inputFirstName" class="col-sm-2 col-form-label"><?=__('frm_FirstName',$lang)?></label>
      <div class="col-sm-6">
        <input type="text" class="form-control form-control-sm" id="inputFirstName" value="<?=$userEdit[0]["firstname"]?>">
      </div>
    </div>
    <div class="mb-6 row">
      <label for="inputLastName" class="col-sm-2 col-form-label"><?=__('frm_LastName',$lang)?></label>
      <div class="col-sm-6">
        <input type="text" class="form-control form-control-sm" id="inputLastName" value="<?=$userEdit[0]["lastname"]?>">
      </div>
    </div>
    <div class="mb-6 row">
      <label for="inputEmail" class="col-sm-2 col-form-label"><?=__('frm_Email',$lang)?></label>
      <div class="col-sm-6">
        <input type="email" class="form-control form-control-sm" id="inputEmail" value="<?=$userEdit[0]["email"]?>">
      </div>
    </div>
    <div class="mb-6 row">
      <label for="inputRoles" class="col-sm-2 col-form-label"><?=__('frm_Roles',$lang)?></label>
      <div class="col-sm-6">
      <select class="form-select" aria-label="Default select">
        <?php $roles = array("[ADMIN-USER]", "[AUTHOR]", "[CUSTOMER]","[USER]","[NONE]");
        foreach($roles as $key):?>
        <option value="<?=$key?>"<?=$userEdit[0]["roles"]==$key ? " selected" : ""?>><?=$key?></option>
        <?php endforeach;?>        
      </select>        
      </div>
    </div>
  <?php endif;?>