<nav class="navbar fixed-top navbar-expand-lg scrolling-navbar" id="barramenuprincipal">
    <div class="container-fluid">
        <a href="index.php">
            <img class="rounded float-start" src="images/logo-dark.png" width="300">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <!-- left -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="<?= $PG_NAME == "About" ? 'nav-link active bd-highlight" aria-current="page' : 'nav-link' ?>" href="about.php"><?= __('mn_AboutUs', $lang) ?></a>
                </li>
                <li class="nav-item">
                    <a class="<?= $PG_NAME == "Cites" ? 'nav-link active bd-highlight" aria-current="page' : 'nav-link' ?>" href="cites.php"><?= __('mn_Cites', $lang) ?></a>
                </li>
                <?php if (!isAuthenticated()) : ?>
                    <li class="nav-item">
                        <a class="<?= $PG_NAME == "Login" ? 'nav-link active bd-highlight" aria-current="page' : 'nav-link' ?>" href="login.php"><?= __('mn_Login', $lang) ?></a>
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
            <!-- Right -->
            <ul class="navbar-nav nav-flex-icons">
                <?php
                $db = new DataBase();
                $social = $db->send("SELECT * FROM settings WHERE label like 'fab %' AND value<>'';");
                if (!empty($social)) :
                    foreach ($social as $key) : ?>
                        <li class="nav-item">
                            <a href="<?= $key['value'] ?>" class="nav-link" target="_blank" style="text-decoration:none;">
                                <i class="fab <?= $key['label'] ?> my-2 my-sm-0"></i>
                            </a>
                        </li>
                    <?php endforeach;
                endif;
                $email = $db->select("settings", "type = 'email' AND value <>''");
                if (!empty($email)) : ?>
                    <li class="nav-item">
                        <a href="mailto:<?= $email[0]['value'] ?>" class="nav-link"><i class="fas <?= $email[0]['label'] ?> my-2 my-sm-0"></i></a>
                    </li>
                <?php endif;
                $db->close();
                ?>
                <li class="nav-item">
                    <select class="small nav-link" id="selectlang">
                        <option value="es" <?= $lang == 'es' ? ' selected' : '' ?>>es</option>
                        <option value="en" <?= $lang == 'en' ? ' selected' : '' ?>>en</option>
                    </select>
                </li>

            </ul>
        </div>
    </div>
</nav>