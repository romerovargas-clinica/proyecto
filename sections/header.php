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
                $db = new DataBase(DB_SERVER, DB_USER, DB_PASS, DB_NAME, 1);
                $social = $db->send("SELECT * FROM config WHERE label like 'fab %' AND value<>'';");
                if(!empty($social)):
                  $cont = 0;
                  foreach($social as $key):
                    $cont++;
                    if($cont>1) echo "|";?>
                <i class="fab <?=$key['label']?> my-2 my-sm-0"
                  onclick="window.open('<?=$key['value']?>', '_blank')"></i>
                <?php endforeach;
                endif;
                $email = $db->select("config", "type = 'email' AND value <>''");
                if(!empty($email)) echo "| <i class='fas ".$email[0]['label']." my-2 my-sm-0'></i>";
                $db->close();
                ?>
              </div>
            </div>

            <div class="col">
              <div class="p-3 border bg-light text-center text-success">

                <?php if(!isAuthenticated()):?>
                <i class="fas fa-users my-2 my-sm-0"></i> | <a href="login.php"><?=__('mn_Login', $lang)?></a>
                <?php else: ?>
                <i class="fas fa-user my-2 my-sm-0"></i> | <?=$_SESSION['name']?>
                <?php endif;?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>