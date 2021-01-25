<?php
  // ESTE ES EL BLOQUE DE AGENDA. 
  // PARA QUE SE MUESTRE CORRECTAMENTE, NECESITAMOS:
  //    1. Usuario Identificado  

?>
<div class="container ">
  <div class="container-fluid px-3 py-3 " style="background-color: white">
    <p class="lead"><?=__('lbl_Agenda', $lang)?></p>
    <?php if(isAuthenticated()):?>
    Usuario Identificado, montar aquí todo
    <?php else: ?>
    <!-- el usuario no está identificado, mostrar mensaje -->
    <div class="alert alert-danger w-25 bottom-50" role="alert">
      <?=__('err_NotAutenticates', $lang)?>
      <div class="clearfix"></div>
      <a class="btn btn-primary btn-md" href="login.php" role="button"><?=__('mn_Login', $lang)?></a>
    </div>
    <?php endif ?>
  </div>
</div>
<div class="clearfix"></div>