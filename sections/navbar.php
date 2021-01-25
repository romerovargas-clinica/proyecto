<div class="container" style="border-top: 8px solid black">
  <div class="row align-items-start" style="border-top: 8px solid #00A797">
    <nav class="navbar navbar-expand-lg bg-primary shadow navbar-dark" style="padding-top: 0">
      <a class="navbar-brand" href="index.php"><?= __('app_Title', $lang) ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto fs-5">
          <li class="nav-item">
            <a class="nav-link fs-5" href="index.php#<?= __('mn_News', $lang) ?>"><?= __('mn_News', $lang) ?></a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?= __('mn_Categories', $lang) ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#"><?= __('mn_Meeting', $lang) ?></a>
              <a class="dropdown-item" href="#"><?= __('mn_Chat', $lang) ?></a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#"><?= __('mn_Speciality', $lang) ?></a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cites.php"><?= __('mn_Cites', $lang) ?></a>
          </li>
          <?php if (!isAuthenticated()) : ?>
            <li class="nav-item<?php if ($PG_NAME == "Login") : ?> active<?php endif; ?>">
              <a class="nav-link" href="login.php"><?= __('mn_Login', $lang) ?><?php if ($PG_NAME == "Login") : ?>
                <span class="sr-only">(current)</span><?php endif; ?>
              </a>
            </li>
          <?php else : ?>
            <?php if (isset($_SESSION["roles"]) && $_SESSION["roles"] == "[ADMIN-USER]") : ?>
              <li class="nav-item">
                <a class="nav-link text-warning" href="admin.php"><?= __('mn_Admin', $lang) ?></a>
              </li>
            <?php else : ?>
              <li class="nav-item<?= $PG_NAME == "Chat" ? ' active' : '' ?>">
                <a class="nav-link" href="chat.php"><?= __('mn_Chat', $lang) ?><?php if ($PG_NAME == "Chat") : ?>
                  <span class="sr-only">(current)</span><?php endif; ?>
                </a>
              </li>
            <?php endif; ?>

            <li class="nav-item">
              <a class="nav-link" href="logout.php"><?= __('mn_Logout', $lang) ?></a>
            </li>
          <?php endif ?>
        </ul>
        <!--
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
    -->
      </div>
    </nav>
  </div>
</div>