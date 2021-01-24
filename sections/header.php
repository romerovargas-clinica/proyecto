<div class="container bg-light">
  <div class="row" style="border-top: 8px solid black"></div>
  <div class="row align-items-start" style="border-top: 8px solid #00A797">
    <div class="col">
      <img class="rounded float-start" src="images/logo.png" width="300" height="175">
    </div>
    <div class="col">
      <div class="social">
        <div class="container px-4">
          <div class="row gx-5">
            <div class="col ">
              <div class="p-3 border bg-light text-center text-primary">
                <?php
                $db = new DataBase();
                $social = $db->send("SELECT * FROM settings WHERE label like 'fab %' AND value<>'';");
                if (!empty($social)) :
                  $cont = 0;
                  foreach ($social as $key) :
                    $cont++;
                    if ($cont > 1) echo "|"; ?>
                    <a href="<?= $key['value'] ?>" target="_blank" style="text-decoration:none;">
                      <i class="fab <?= $key['label'] ?> my-2 my-sm-0"></i>
                    </a>
                  <?php endforeach;
                endif;
                $email = $db->select("settings", "type = 'email' AND value <>''");
                if (!empty($email)) : ?>
                  | <a href="mailto:<?= $email[0]['value'] ?>"><i class="fas <?= $email[0]['label'] ?> my-2 my-sm-0"></i></a>
                <?php endif;
                $db->close();
                ?>
              </div>
            </div>

            <div class="col">
              <div class="p-3 border bg-light text-center text-success">
                <?php if (!isAuthenticated()) : ?>
                  <i class="fas fa-users"></i> | <a class="small" href="login.php"><?= __('mn_Login', $lang) ?></a>
                <?php else : ?>
                  <i class="fas fa-user my-2 my-sm-0"></i> | <?= $_SESSION['name'] ?>
                <?php endif; ?> |
                <select class="w-25 d-inline small" id="selectlang">
                  <option value="es" <?= $lang == 'es' ? ' selected' : '' ?>>es</option>
                  <option value="en" <?= $lang == 'en' ? ' selected' : '' ?>>en</option>
                </select>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>