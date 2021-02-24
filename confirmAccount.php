<?php

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
$PG_NAME = "ConfirmAccount";
$nav_style = "alt";

$db = new DataBase();
$confirmKey = $_GET['clave'];
$account = $db->send("SELECT * FROM users WHERE confirmKey = '$confirmKey'");
if (!$account) die("ERROR: La clave de validación no es válida"); // To-Do traducción
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<?php require "sections/head.php"; ?>

<body>
  <!-- ========================= preloader start ========================= -->
  <div class="preloader">
    <div class="loader">
      <div class="ytp-spinner">
        <div class="ytp-spinner-container">
          <div class="ytp-spinner-rotator">
            <div class="ytp-spinner-left">
              <div class="ytp-spinner-circle"></div>
            </div>
            <div class="ytp-spinner-right">
              <div class="ytp-spinner-circle"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- preloader end -->
  <?php
  include "sections/header.php";
  ?>
  <section id="contact" class="contact-section pt-120 pb-160">
    <div class="shape shape-7">
      <img src="assets/img/shapes/shape-7.svg" alt="">
    </div>
    <div class="container">
      <div class="row">
        <div class="col-xl-8 mx-auto">
          <div class="section-title text-center mb-55">
            <span class="wow fadeInDown" data-wow-delay=".2s"><?= $account[0]["name"] ?></span>
            <h2 class="mb-15 wow fadeInUp" data-wow-delay=".4s"><?= $account[0]["firstname"] . " " . $account[0]["lastname"] ?></h2>
            <p class="wow fadeInLeft" data-wow-delay=".6s"></p>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="alert alert-primary" id="warning" style="visibility: hidden"></div>
      </div>

      <div class="row">
        <div class="col-xl-8 mx-auto">
          <div id="mail-status" style="visibility: hidden;"></div>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-12">

          <div id="contact-form" class="contact-form">
            <div class="row">
              <div class="col-md-6">
                <input type="password" id="pass1" name="pass1" placeholder="Password" required>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <input type="password" id="pass2" name="pass2" placeholder="Repeat Password" required>
                <input type="hidden" id="id" name="id" value="<?= $account[0]["id"] ?>">
                <input type="hidden" id="token" name="token" value="<?= $confirmKey ?>">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xl-12">
              <button class="btn theme-btn" onClick="verifyPass()">Send Password</button>
              <div id="loader"></div>
            </div>
          </div>
        </div>
        <p class="form-message pt-15"></p>
      </div>
    </div>
    </div>
  </section>

  <script>
    function verifyPass() {
      $('#loader').html('<div class="loading"><img src="images/loader.gif" alt="loading" /></div>');
      console.log("si");
      let p1 = $("#pass1").val();
      let p2 = $("#pass2").val();
      // bloqueando campos
      $("#pass1").prop("disabled", true);
      $("#pass2").prop("disabled", true);
      $("#pass1").css('background-color', '#FFDCE0');
      $("#pass2").css('background-color', '#FFDCE0');
      if (p1 === "") {
        $('#warning').html("Please, completes the dates");
      }
      if (p1 === p2) {
        $.post("admin/passwordUpdate.php", {
          pass: p1,
          id: $('#id').val(),
          token: $("#token").val(),
        }, function(m) {
          if (m["code"] == 200) {
            window.open("login.php", "_self");
          }
          $('#loader').html('');
        });
      } else {
        // desbloquear
        $('#warning').html("Passwords are not the same");
      }
      $('#warning').attr("class", "alert alert-danger");
      $('#warning').attr("style", "visibility: visible");
      $("#pass1").prop("disabled", false);
      $("#pass2").prop("disabled", false);
      $("#pass1").css('background-color', '#FFFFFF');
      $("#pass2").css('background-color', '#FFFFFF');
    }
  </script>
  <?php
  include "sections/footer.php";
  include "includes/scripts.php";
  ?>
</body>

</html>