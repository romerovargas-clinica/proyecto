<!-- ========================= header start ========================= -->
<header id="home" class="header">
  <div class="header-wrapper">
    <div class="header-top theme-bg">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <?php
            $db = new DataBase();
            $phone = $db->select("settings", "label ='lni lni-phone'");
            $mail = $db->select("settings", "label ='lni lni-envelope'");
            ?>
            <div class="header-top-left text-center text-md-left">
              <ul>
                <li><a href="#"><i class="lni lni-phone"></i> <?= isset($phone) ? $phone[0]["value"] : "" ?></a></li>
                <li><a href="#"><i class="lni lni-envelope"></i> <?= isset($mail) ? $mail[0]["value"] : "" ?></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-4">
            <div class="header-top-right d-none d-md-block">
              <ul>
                <?php
                $db->close();
                $db = new DataBase();
                $social = $db->send("SELECT * FROM settings WHERE type = 'social' AND value<>'';");
                if (!empty($social)) :
                  foreach ($social as $key) : ?>
                    <li class="nav-item">
                      <a href="<?= $key['value'] ?>">
                        <i class="<?= $key['label'] ?>"></i>
                      </a>
                    </li>
                <?php endforeach;
                endif;
                $db->close();
                ?>
                <!-- login -->
                <li class="nav-item">
                  <?php if (!isAuthenticated()) : ?>
                    <a href="login.php">
                      <i class="lni lni-user"></i>
                    </a>
                  <?php else : ?>
                    <a href="logout.php">
                      <i class="lni lni-close"></i>
                    </a>
                  <?php endif; ?>
                </li>
                <li class="nav-item">
                  <button onclick="window.location.href='<?=$_SERVER['PHP_SELF']?>?lang=es'" class="es-button" style="height: 30px;width: 30px;border-radius:50%;border:none;background-image:url('../images/lenguages/espana.svg');background-repeat: no-repeat;"  > &nbsp; </button>
                </li>
                <li class="nav-item">
                <button onclick="window.location.href='<?=$_SERVER['PHP_SELF']?>?lang=e'" class="en-button" style="height: 30px; width: 30px; border-radius:50%; border:none; background-image: url('images/lenguages/reino-unido.svg');   background-repeat: no-repeat"> &nbsp; </button>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
    if ($_SERVER['PHP_SELF'] == "/index.php") :
      $href = "";
    else :
      $href = "index.php";
    endif;
    ?>
    <div class="navbar-area bg-light">
      <div class="container ">
        <div class="row">
          <div class="col-lg-12">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">

              <a class="navbar-brand" href="index.php">
                <img src="assets/img/logo/logo-dark.png" style="width:280px" alt="Logo">
              </a>

              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="toggler-icon"></span>
                <span class="toggler-icon"></span>
                <span class="toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                <ul id="nav" class="navbar-nav ml-auto">

                  <li class="nav-item">
                    <a class="nav-link" href="<?= $href ?>#about"><?= __('mn_AboutUs', $lang) ?></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="<?= $href ?>#services"><?= __('mn_Speciality', $lang) ?></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="<?= $href ?>#team"><?= __('mn_Team', $lang) ?></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="<?= $href ?>#blog"><?= __('mn_News', $lang) ?></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="<?= $href ?>#contact"><?= __('mn_Contact', $lang) ?></a>
                  </li>
                  <?php if (isAuthenticated()) : ?>
                    <!-- Menu Usuario -->
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= $_SESSION['firstname'] ?>
                      </a>
                      <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="cites.php"><?= __('mn_Cites', $lang) ?></a></li>
                        <?php if (isset($_SESSION["roles"]) && $_SESSION["roles"] == "[ADMIN-USER]") : ?>
                          <li>
                            <hr class="dropdown-divider">
                          </li>
                          <li><a class="dropdown-item" href="admin.php"><?= __('mn_Admin', $lang) ?></a></li>
                          <li><a class="dropdown-item" href="budget.php"><?= __('mn_budget', $lang) ?></a></li>
                        <?php endif; ?>
                        <li>
                          <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="logout.php"><?= __('mn_Logout', $lang) ?></a></li>
                      </ul>
                    </li>
                  <?php endif; ?>
              </div>

            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
<!-- ========================= header end ========================= -->

