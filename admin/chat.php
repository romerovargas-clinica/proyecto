<?php
// Procesamiento de formulario #TO DO: esta copiado de users
$error = "";
?>

<h2><?= __('sect_Chat', $lang) ?></h2>
<div class="table-responsive">

  <?php
  $table = "users";
  include "admin/pagination.php";
  ?>

  <div class="col-12 nav nav-pills mt-2" id="v-pills-tab" role="tablist" aria-orientation="vertical">
    <!-- class="nav flex-column nav-pills me-3" -->
    <?php

    if (!empty($records)) :
      $cont = 0;
      foreach ($records as $record) :
        if ($record['id'] != $_SESSION['id']) : ?>
          <?php
          // comprueba la existencia de sesiones de chat pendientes
          $pendientes = $db->send("SELECT Count(DISTINCT session_id) as m FROM chat WHERE date_read IS NULL AND user_id = " . $record['id']);
          $p = 0;
          if ($pendientes) :
            $p = $pendientes[0]['m'];
          endif;
          ?>
          <a class="nav-link position-relative border ms-2" id="v-pills-<?= $record['id'] ?>-tab" data-bs-toggle="pill" href="#v-pills-<?= $record['id'] ?>" role="tab" aria-controls="v-pills-<?= $record['id'] ?>"><?= $record['lastname'] ?>
            <?= $p > 0 ? '<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">' . $p . '</span>' : '' ?>
          </a>
        <?php endif; ?>
      <?php endforeach; ?>
  </div>
  <div class="tab-content overflow-auto border border-primary mt-1 p-3" id="v-pills-tabContent" style="height:500px; background-color: #FFF3CD">
    <?php foreach ($records as $record) :
        $chats = $db->send("SELECT * FROM chat WHERE session_id IN (SELECT session_id FROM chat WHERE user_id = " . $record['id'] . ");");
    ?>
      <div class="tab-pane fade" id="v-pills-<?= $record['id'] ?>" role="tabpanel" aria-labelledby="v-pills-<?= $record['id'] ?>-tab">
        <?php
        if ($chats) :
          foreach ($chats as $row) : ?>
            <?php if ($row['user_id'] == $record['id']) : ?>
              <div class="container w-75 clearfix mt-2" style="float:right; background-color: #c616e469; color: yellow; border-radius: 5px; padding: 5px; margin-bottom: 3%;">
              <?php else : ?>
                <div class="container w-75 clearfix mt-2" style="float:left; background-color: #22A797; color: white; border-radius: 5px; padding: 5px; margin-bottom: 3%;">
                <?php endif; ?>
                <span class="small text-dark" style="float:left"><?php echo $row['name']; ?> :</span>
                <span class="small text-dark mb-1" style="float:right"><?php echo $row['created_on']; ?></span>
                <div class="clearfix"></div>
                <span class="clearfix"><?php echo $row['message']; ?></span>
                </div>
                <div class="clear:both"></div>
            <?php endforeach;
        // To-Do: Hacer una llamada a una función para marcar los mensajes no leídos del usuario $record['id] como leídos
        else :
          echo "No conversations";
        endif;
            ?>
              </div>
              <div class="clearfix"></div>
            <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
  <script>

  </script>
  <div class="container text-warning bg-danger"><?php if ($error != "") echo $error; ?></div>
</div>
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