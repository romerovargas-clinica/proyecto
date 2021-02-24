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
    function submitLink($funcNum, $dir, $file) {
      var _open1 = window.opener.document.getElementById("img_base");
      var _open2 = window.opener.document.getElementById("inputImageFile");
      var _open3 = window.opener.document.getElementById("inputImageDir");
      _open1.setAttribute("src", "images/" + $dir + "/" + $file);
      _open2.setAttribute("value", $file);
      _open3.setAttribute("value", $dir);
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
  // ===============================
  $maxRow = 5; // Número de registros a mostrar

  $sql = "SELECT Count(*) as total FROM " . $table;

  if (isset($where)) :
    $sql = $sql . " WHERE " . $where . ";";
  else :
    $sql = $sql . ";";
  endif;

  $row = $db->send($sql);

  $page = false;

  if (isset($_GET["page"])) {
    $page = $_GET["page"];
  }

  if (!$page) {
    $start = 0;
    $page = 1;
  } else {
    $start = ($page - 1) * $maxRow;
  }

  $numResult = $row[0]['total'];
  $total_pages = ceil($numResult / $maxRow);

  if (isset($where)) :
    $sql = $where;
  else :
    $sql = "1 = 1";
  endif;

  $records = $db->select($table, $sql . " ORDER BY id ASC LIMIT " . $start . ", " . $maxRow);
  ?>
  <div class="d-flex bd-highlight">
    <div class="p-2 w-100 row row-cols-lg-auto g-3 align-items-center">
      <?php if (isset($adm_pag) && $adm_pag != "chat") : ?>
        <div class="col-12">
          <button type="button" class="page-link btn-sm bg-primary text-white" onclick="window.location='filebrowser.php?page=<?= ($page) ?>&AddNew';"><?= __('btn_Add', $lang) ?></button>
        </div>
      <?php endif; ?>
      <div class="col-12">
        <input type="text" class="page-link btn-sm" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1" id="search" name="search" onKeyUp="search();">
      </div>
    </div>
    <nav aria-label="navigation flex-shrink-1">
      <ul class="pagination justify-content-end">
        <?php if ($total_pages >= 1) {
          if ($page != 1) { ?>
            <li class="page-item"><a class="page-link" href="filebrowser.php?page=<?= ($page - 1) ?>">&laquo;</a>
            </li>
            <?php }

          for ($i = 1; $i <= $total_pages; $i++) {
            if ($page == $i) { ?>
              <li class="page-item"><span class="page-link bg-primary text-white" href="#"><?= $i ?></span></li>
            <?php } else { ?>
              <li class="page-item"><a class="page-link" href="filebrowser.php?page=<?= $i ?>"><?= $i ?></a></li>
            <?php }
          }

          if ($page != $total_pages) { ?>
            <li class="page-item"><a class="page-link" href="filebrowser.php?page=<?= $page + 1 ?>">&raquo;</a>
            </li>
        <?php }
        } ?>
      </ul>
    </nav>
  </div>
  <ul id="resultSearch" class="list-group"></ul>
  <div class="list-group"></div>
  <?php
  // ===================================
  // Calculo el total de paginas
  $row = $db->send("SELECT Count(*) as total FROM images;");
  $numResult = $row[0]['total'];
  $total_pages = ceil($numResult / $maxRow);
  $records = $db->select("images", "1 = 1 ORDER BY id ASC LIMIT " . $start . ", " . $maxRow);
  ?>
  <div class="container-fluid">
    <div class="row">
      <main class="col-md-12 col-lg-10 px-md-4">
        <h2><?= __('sect_gallery', $lang) ?></h2>
        <div class="table-responsive">
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
                        <div class="card mb-3" onclick="submitLink(0, 'uploads', '<?= $record['src'] ?>')">
                          <div class="card-header"><?= "[IMG:" . $record['id'] . "]" ?></div>
                          <div class="card-img-top"><img src="images/uploads/<?= $record['src'] ?>" class="crop rounded d-block" alt="<?= $record['id'] ?>" height="50"></div>
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

  <script>
    function search() {
      var textSearch = $("input#search").val();
      var div = document.getElementById("resultSearch");
      while (div.firstChild) {
        div.removeChild(div.lastChild);
      }
      if (textSearch != "") {
        $.post("admin/search.php", {
          valueSearch: textSearch,
          table: '<?= $table ?>'
        }, function(message) {
          //$("#resultSearch").html(message);        
          //$("input#search").attr('data-bs-content', message);
          console.log(message);
          var row = message.split("#");
          row.forEach(element => {
            if (element != "") {
              let option = document.createElement("a");
              div.appendChild(option);
              let field = element.split(";");
              let texto = "";
              colores = new Array('bg-light', 'bg-light', 'bg-primary', 'bg-secondary', 'bg-success', 'bg-warning text-dark', 'bg-info text-dark', 'bg-dark', 'bg-light text-dark', 'bg-danger');
              let cont = 0;
              field.forEach(value => {
                let txt = String(value);
                var temporal = document.createElement("div");
                temporal.innerHTML = txt;
                txt = temporal.textContent || temporal.innerText || "";
                if (cont == 1) id = txt;
                let l = txt.length;
                if (l > 50) {
                  txt = txt.substr(0, 50) + "...";
                }
                texto = texto + " <span class='badge " + colores[cont] + "'>" + txt + "</span> ";
                cont++;
              })
              option.setAttribute('class', 'list-group-item list-group-item-action');
              option.setAttribute('href', 'admin.php?section=<?= $adm_pag ?>&edit=' + id);
              option.innerHTML = texto;
            }
          });
        });
      } else {
        div.setAttribute('arial-label', 'Disabled size 0');
        div.setAttribute('visible', 'hidden');
      };
    };
  </script>
  <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>