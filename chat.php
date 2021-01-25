<?php
// Si hay algún error, descomentar las siguiente líneas
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// TODAS LAS PÁGINAS CARGAN LOS SIGUIENTE ARCHIVOS //
include("includes/data.php");
include("includes/functions.php");
include("includes/sessions.php");
// Recuperar la sesión anterior
initiate();
// TITLE DE LA PÁGINA ACTUAL //
$PG_NAME = "Chat";
$nav_style = "alt";
if (!(isAuthenticated())) {
  // Sólo usuarios identificados
  header("location:index.php");
}
if (isset($_SESSION['roles']) && $_SESSION['roles'] == "[ADMIN-USER]") {
  header("location:admin.php");
}

// comprobamos fecha último mensaje
$db = new DataBase();
$sql = $db->send("SELECT * FROM chat WHERE session_id IN (SELECT session_id FROM chat WHERE user_id = " . $_SESSION['id'] . ");");
//$sql = $db->select("chat", "session_id = '" . session_id() . "'");

?>

<!DOCTYPE html>
<html lang="<?= $lang ?>">
<?php require "sections/head.php"; ?>

<body>
  <meta http-equiv="refresh" content="20">
  <?php
  include "sections/header.php";
  include "sections/navbar.php";
  // cargar los bloques desde la configuración
  ?>

  <div class="container" id="content">

    <label class="mt-5"><?= __('lbl_chat', $lang) ?></label>
    <div id="display-chat" class="tab-content overflow-auto border-end border-bottom border-start p-3 position-relative w-75 m-auto" style="height:450px; background-color: #FFF3CD">
      <?php if ($sql) : ?>
        <?php foreach ($sql as $row) : ?>
          <?php if ($row['user_id'] == $_SESSION['id']) : ?>
            <div class="container w-75 clearfix" style="float:right; background-color: #c616e469; color: yellow; border-radius: 5px; padding: 5px; margin-bottom: 3%;">
            <?php else : ?>
              <div class="container w-75 clearfix" style="float:left; background-color: #22A797; color: white; border-radius: 5px; padding: 5px; margin-bottom: 3%;">
              <?php endif; ?>
              <p>
                <span class="small text-dark clearfix"><?php echo $row['name']; ?> :</span>
                <span class="clearfix" style="float: left;"><?php echo $row['message']; ?></span>
              </p>
              </div>
            <?php endforeach; ?>
            <?php
            // En espera de respuesta  
            if ($row['date_read'] == null) :
            ?>
              <div class="spinner-border position-absolute bottom-100 start-0 " role="status">
                <span class="visually-hidden">Loading...</span>
              </div>
            <?php endif; ?>
          <?php else : ?>
            <div class="message">
              <p>No hay ninguna conversación previa.</p>
            </div>
          <?php endif; ?>
            </div>

            <form class="form-horizontal m-auto w-75 mt-2" method="post" action="chat/send.php">
              <div class="form-group">
                <div class="col-sm-10">
                  <textarea name="msg" class="form-control" placeholder="Escribe tu mensaje..."></textarea>
                </div>

                <div class="col-sm-2">
                  <button type="submit" class="btn btn-primary">Enviar</button>
                </div>

              </div>
            </form>
    </div>

    <?php
    include "sections/footer.php";
    include "includes/scripts.php";
    ?>
    <script>
      $(document).ready(function() {
        // Set trigger and container variables
        var trigger = $('.container .display-chat '),
          container = $('#content');

        // Fire on click
        trigger.on('click', function() {
          // Set $this for re-use. Set target from data attribute
          var $this = $(this),
            target = $this.data('target');

          // Load target page into container
          container.load(target + '.php');

          // Stop normal link behavior
          return false;
        });
      });
    </script>
</body>

</html>