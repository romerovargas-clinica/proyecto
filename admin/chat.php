<?php
// To Do: Buscar código javascript para que el scroll del div muestre los últimos mensajes al cargar la página
$error = "";
if (isset($_GET['user'])) :
  $chat_user_id = $_GET['user'];
else :
  $chat_user_id = null;
endif;
?>
<meta http-equiv="refresh" content="20">
<h2><?= __('sect_Chat', $lang) ?></h2>
<div class="table-responsive">

  <?php
  $table = "users";
  $maxRow = 5; // Número de registros a mostrar
  include "admin/pagination.php";
  ?>

  <div class="container">
    <!-- class="nav flex-column nav-pills me-3" -->

    <ul class="nav nav-tabs">
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
            <li class="nav-item position-relative">
              <a class="border border-end border-start nav-link<?= $chat_user_id == $record['id'] ? ' active" aria-current="page" style="background-color: #FFF3CD"' : '"' ?> href=" admin.php?section=<?= $adm_pag ?>&user=<?= $record['id'] ?>"><?= $record['lastname'] ?><?= $p > 0 ? '<span class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-danger">' . $p . '</span>' : '' ?></a>
            </li>
          <?php endif; ?>
        <?php endforeach; ?>
    </ul>

    <div class="tab-content overflow-auto border-end border-bottom border-start p-3" style="height:450px; background-color: #FFF3CD">
      <?php
        if ($chat_user_id) :
          $chats = $db->send("SELECT * FROM chat WHERE session_id IN (SELECT session_id FROM chat WHERE user_id = " . $chat_user_id . ");");
          if ($chats) :
            foreach ($chats as $row) : ?>
            <?php if ($row['user_id'] == $chat_user_id) : ?>
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
          <?php
              $session_id = $row['session_id'];
            endforeach;
            // marcar como leídos todos los mensajes con el usuario $chat_user_id
            $valores = array();
            $dateread['date_read'] = date("Y-m-d H:i:s");
            $update = $db->update("chat", $dateread, "date_read IS NULL && session_id='" . $session_id . "'");
          else :
            echo "Not conversations";
          endif;
        endif; ?>
              </div>
            <?php endif; ?>
    </div>
    <form class="form-horizontal" method="post" action="admin/send.php">
      <input type="hidden" name="chat_id" value="<?= $session_id ?>">
      <input type="hidden" name="user_id" value="<?= $chat_user_id ?>">
      <div class="form-group">
        <div class="col-sm-10">
          <textarea name="msg" class="form-control" placeholder="Ingresa tu mensaje acá..."></textarea>
        </div>

        <div class="col-sm-2">
          <button type="submit" class="btn btn-primary">Enviar</button>
        </div>

      </div>
    </form>
  </div>