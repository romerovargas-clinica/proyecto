<?php
// Si hay algún error, descomentar las siguiente líneas

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// TODAS LAS PÁGINAS CARGAN LOS SIGUIENTE ARCHIVOS //
include ("includes/data.php");
include ("includes/functions.php");
include ("includes/sessions.php");
// Recuperar la sesión anterior
initiate();
// TITLE DE LA PÁGINA ACTUAL //
$PG_NAME = "Admin";
$nav_style = "alt";
if (!isAuthenticated() && $_SESSION["roles"]!=["ADMIN-USER"]) {
  // fuera de aquí!!
  header("location:index.php");
}
// Página del main
if(isset($_GET["section"])):
  $adm_pag = $_GET["section"];
else:
  $adm_pag = "dashboard";
endif;

// Datos
$db = new DataBase(DB_SERVER, DB_USER, DB_PASS, DB_NAME, 1);
$param = $db->send("SELECT * FROM config;");
?>
<!DOCTYPE html>
<html lang="<?=$lang?>">
    <?php require "admin/head.php";?>

    <body>
        <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
            <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="index.php"><?=$param[0]["value"]?></a>
            <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
            <ul class="navbar-nav px-3">
                <li class="nav-item text-nowrap">
                    <a class="nav-link" href="logout.php"><?=__('mn_Logout', $lang)?></a>
                </li>
            </ul>
        </header>

        <div class="container-fluid">
            <div class="row">
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                    <div class="position-sticky pt-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="admin.php">
                                    <span data-feather="home"></span>
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="admin.php?section=settings">
                                    <span data-feather="layers"></span>
                                    <?=__('sect_settings',$lang)?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="admin.php?section=users">
                                    <span data-feather="users"></span>
                                    <?=__('sect_users',$lang)?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="admin.php?section=articles">
                                    <span data-feather="file-text"></span>
                                    <?=__('sect_articles',$lang)?>
                                </a>
                            </li>                            
                        </ul>

                        <h6
                            class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                            <span>Saved reports</span>
                            <a class="link-secondary" href="#" aria-label="Add a new report">
                                <span data-feather="plus-circle"></span>
                            </a>
                        </h6>
                        <ul class="nav flex-column mb-2">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span data-feather="file-text"></span>
                                    Current month
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span data-feather="file-text"></span>
                                    Last quarter
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span data-feather="file-text"></span>
                                    Social engagement
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span data-feather="file-text"></span>
                                    Year-end sale
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>

                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" style="margin-left:219px">
                    <div
                        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Dashboard</h1>                        
                    </div>                                  
                    <?php
                    switch($adm_pag):
                      case("dashboard"):
                        $sectTitle = __('sect_title_users',$lang);
                        include "admin/dashboard.php";                        
                        break;
                      case ("settings"):
                        $sectTitle = __('sect_settings',$lang);
                        include "admin/settings.php";
                        break;
                      case("users"):
                        $sectTitle = __('sect_users',$lang);
                        include "admin/users.php";                        
                        break;
                    endswitch;
                    ?>                    
                </main>
            </div>
        </div>
        <?php include "admin/scripts.php"?>
    </body>

</html>