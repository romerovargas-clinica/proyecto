<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/**
 * Basic File Browser for CKEditor
 *
 * Displays and selects file link to insert into CKEditor
 *
 * @package GetSimple
 * @subpackage Files
 * 
 * Version: 1.1 (2011-03-12)
 */

// Setup inclusions
include("config/config.php");
include("includes/functions.php");
include("includes/sessions.php");
include("includes/class.data.php");
// Archivo de configuración excluido del control de versiones

//include('inc/common.php');
if (!isAuthenticated() && $_SESSION["roles"] != ["ADMIN-USER"]) {
  // fuera de aquí!!
  die('Hack?');
}

$filesSorted = null;
$dirsSorted = null;

$path = (isset($_GET['path'])) ? "../images/uploads/" . $_GET['path'] : "../images/uploads/";
$subPath = (isset($_GET['path'])) ? $_GET['path'] : "";
//var_dump('Path: '.$path); //
//if(!path_is_safe($path, GSDATAUPLOADPATH)) die();
$returnid = isset($_GET['returnid']) ? var_out($_GET['returnid']) : "";
//var_dump('returnid: '.$returnid); //
$func = (isset($_GET['func'])) ? var_out($_GET['func']) : "";
//var_dump('func: '.$func); //
$path = tsl($path);
//var_dump('tsl: '.$path); //
// check if host uses Linux (used for displaying permissions)
$isUnixHost = (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN' ? false : true);
//var_dump('isUnixHost: '.$isUnixHost); //
$CKEditorFuncNum = isset($_GET['CKEditorFuncNum']) ? var_out($_GET['CKEditorFuncNum']) : '';
//var_dump('CKEditorFuncNum: '.$CKEditorFuncNum); //
$sitepath = suggest_site_path();
//var_dump('sitepath: '.$sitepath); //
$fullPath = $sitepath . "images/uploads/";
$type = isset($_GET['type']) ? var_out($_GET['type']) : '';

global $LANG;
$LANG = 'es';
//var_dump('LANG: '.$LANG); //
$LANG_header = preg_replace('/(?:(?<=([a-z]{2}))).*/', '', $LANG);
//var_dump('LANG_header: '.$LANG_header);//
?>
<!DOCTYPE html>
<html lang="<?php echo $LANG_header; ?>">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>FILE_BROWSER</title>
  <link rel="shortcut icon" href="favicon.png" type="image/x-icon" />
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/styles_.css">
  <style>
    .wrapper,
    #maincontent,
    #imageTable {
      width: 100%
    }

    .img-thumbnail {
      height: 150px;
    }

    .card-img-top {
      width: 150px;
      height: 150px;
      overflow: hidden;
      margin: 10px;
      position: relative;
    }

    .card-img-top>.crop {
      position: absolute;
      left: -100%;
      right: -100%;
      top: -100%;
      bottom: -100%;
      margin: auto;
      min-height: 100%;
      min-width: 100%;
    }
  </style>
  <script type='text/javascript'>
    function submitLink($funcNum, $url) {
      var _open1 = window.opener.document.getElementById("img_base");
      var _open2 = window.opener.document.getElementById("img_base_hd");
      _open1.setAttribute("src", $url);
      _open2.setAttribute("value", $url);
      window.close();
    }
  </script>
</head>

<body>
  <div class="wrapper">
    <div id="maincontent">
      <div class="main" style="border:none;">
        <h3>Subida de Archivos<span id="filetypetoggle">&nbsp;&nbsp;/&nbsp;&nbsp;<?php echo ($type == 'images' ? 'IMAGES' : 'SHOW_ALL'); ?></span></h3>
      </div>
    </div>
  </div>
  <!-- nuevo -->
  <?php
  $db = new DataBase(DB_SERVER, DB_USER, DB_PASS, DB_NAME, 1);
  $table = "images";
  include "admin/pagination.php";
  // Calculo el total de paginas
  $row = $db->send("SELECT Count(*) as total FROM images;");
  $numResult = $row[0]['total'];
  $total_pages = ceil($numResult / $maxRow);
  $records = $db->select("images", "1 = 1 ORDER BY id ASC LIMIT " . $start . ", " . $maxRow);
  ?>
  <div class="container-fluid">
    <div class="row">
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" style="margin-left:219px">
        <h2><?= __('sect_gallery', $lang) ?></h2>
        <div class="table-responsive">
          <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
              <?php if ($total_pages >= 1) {
                if ($page != 1) { ?>
                  <li class="page-item"><a class="page-link" href="filebrowser2.php?type=images&CKEditor=inputText&CKEditorFuncNum=1&langCode=es&page=<?= ($page - 1) ?>">&laquo;</a>
                  </li>
                  <?php }

                for ($i = 1; $i <= $total_pages; $i++) {
                  if ($page == $i) { ?>
                    <li class="page-item"><a class="page-link" href="#"><?= $i ?></a></li>
                  <?php } else { ?>
                    <li class="page-item"><a class="page-link" href="filebrowser2.php?type=images&CKEditor=inputText&CKEditorFuncNum=1&langCode=es&page=<?= $i ?>"><?= $i ?></a>
                    </li>
                  <?php }
                }

                if ($page != $total_pages) { ?>
                  <li class="page-item"><a class="page-link" href="filebrowser2.php?type=images&CKEditor=inputText&CKEditorFuncNum=1&langCode=es&page=<?= $page + 1 ?>">&raquo;</a>
                  </li>
              <?php }
              } ?>
            </ul>
          </nav>

          <table class="table table-striped table-sm table-hover">
            <thead>
              <tr>
                <th>Images</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <?php
                  if (!empty($records)) :
                    $cont = 0; ?>
                    <div class="d-flex p-2 bd-highlight">
                      <?php foreach ($records as $record) : ?>
                        <div class="card mb-3" onclick="submitLink(0,'http://clinica.es/<?= substr($record['src'], 6) ?>')">
                          <div class="card-header"><?= "[IMG:" . $record['id'] . "]" ?></div>
                          <div class="card-img-top"><img src="<?= $record['src'] ?>" class="crop rounded d-block" alt="<?= $record['id'] ?>" height="50"></div>
                          <div class="card-title small text-truncate" style="max-width:150px"><?= $record['name'] ?></div>
                        </div>
                      <?php endforeach; ?>
                    </div>
                  <?php endif; ?>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </main>
    </div>
  </div>
  <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>