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
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="navbar-area">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="navbar navbar-expand-lg">
              <a class="navbar-brand" href="index.php">
                <img src="assets/img/logo/logo-dark.png" style="width:280px" alt="Logo">
              </a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="toggler-icon"></span>
                <span class="toggler-icon"></span>
                <span class="toggler-icon"></span>
              </button>
              <?php
              if ($_SERVER['PHP_SELF'] == "/index.php") :
                $href = "";
              else :
                $href = "index.php";
              endif;
              if (!isAuthenticated()) :
              ?>
                <nav class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                  <ul id="nav" class="navbar-nav ml-auto">
                    <li class="nav-item active">
                      <a class="active" href="<?= $href ?>#home">Home</a>
                    </li>
                    <li class="nav-item">
                      <a href="<?= $href ?>#about"><?= __('mn_AboutUs', $lang) ?></a>
                    </li>
                    <li class="nav-item">
                      <a href="<?= $href ?>#services"><?= __('mn_Speciality', $lang) ?></a>
                    </li>
                    <li class="nav-item">
                      <a href="<?= $href ?>#team"><?= __('mn_Team', $lang) ?></a>
                    </li>
                    <li class="nav-item">
                      <a href="<?= $href ?>#blog"><?= __('mn_News', $lang) ?></a>
                    </li>
                    <li class="nav-item">
                      <a href="<?= $href ?>#contact"><?= __('mn_Contact', $lang) ?></a>
                    </li>
                  </ul>
                </nav> <!-- navbar collapse -->
              <?php else : ?>
                <nav class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                  <ul id="nav" class="navbar-nav ml-auto">
                    <li class="nav-item active">
                      <a class="active" href="<?= $href ?>#home">Home</a>
                    </li>
                    <li class="nav-item">
                      <a href="chat.php"><?= __('mn_Chat', $lang) ?></a>
                    </li>
                    <li class="nav-item">
                      <a href="<?= $href ?>cites.php"><?= __('mn_Cites', $lang) ?></a>
                    </li>
                    <li class="nav-item">
                      <a href="<?= $href ?>#blog"><?= __('mn_News', $lang) ?></a>
                    </li>
                    <?php
                    if (isset($_SESSION['roles']) && $_SESSION['roles'] == "[ADMIN-USER]") : ?>
                      <li class="nav-item">
                        <a href="budget.php"><?= __('mn_budget', $lang) ?></a>
                      </li>
                      <li class="nav-item">
                        <a href="admin.php"><?= __('mn_Admin', $lang) ?></a>
                      </li>
                    <?php endif ?>
                  </ul>
                </nav> <!-- navbar collapse -->
              <?php endif ?>
            </div> <!-- navbar -->
          </div>
        </div> <!-- row -->
      </div> <!-- container -->
    </div> <!-- navbar area -->

  </div>
</header>
<!-- ========================= header end ========================= -->