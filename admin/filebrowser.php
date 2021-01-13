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
include("../config/config.php");
include("../includes/functions.php");
include("../includes/sessions.php");

//include('inc/common.php');
if (!isAuthenticated() && $_SESSION["roles"] != ["ADMIN-USER"]) {
  // fuera de aquí!!
  die('Hack?');
}

$filesSorted=null;
$dirsSorted=null;

$path = (isset($_GET['path'])) ? "../images/uploads/".$_GET['path'] : "../images/uploads/";
$subPath = (isset($_GET['path'])) ? $_GET['path'] : "";
var_dump('Path: '.$path); //
//if(!path_is_safe($path, GSDATAUPLOADPATH)) die();
$returnid = isset($_GET['returnid']) ? var_out($_GET['returnid']) : "";
var_dump('returnid: '.$returnid); //
$func = (isset($_GET['func'])) ? var_out($_GET['func']) : "";
var_dump('func: '.$func); //
$path = tsl($path);
var_dump('tsl: '.$path); //
// check if host uses Linux (used for displaying permissions)
$isUnixHost = (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN' ? false : true);
var_dump('isUnixHost: '.$isUnixHost); //
$CKEditorFuncNum = isset($_GET['CKEditorFuncNum']) ? var_out($_GET['CKEditorFuncNum']) : '';
var_dump('CKEditorFuncNum: '.$CKEditorFuncNum); //
$sitepath = suggest_site_path();
//var_dump('sitepath: '.$sitepath); //
$fullPath = $sitepath . "images/uploads/";
$type = isset($_GET['type']) ? var_out($_GET['type']) : '';

global $LANG;
$LANG = 'es';
var_dump('LANG: '.$LANG); //
$LANG_header = preg_replace('/(?:(?<=([a-z]{2}))).*/', '', $LANG);
var_dump('LANG_header: '.$LANG_header);//
?>
<!DOCTYPE html>
<html lang="<?php echo $LANG_header; ?>">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"  />
	<title>FILE_BROWSER</title>
	<link rel="shortcut icon" href="favicon.png" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="template/style.php?v=<?php echo GSVERSION; ?>" media="screen" />
	<style>
		.wrapper, #maincontent, #imageTable { width: 100% }
	</style>
	<script type='text/javascript'>	
		 
	function submitLink($funcNum, $url) {
        <?php if (isset($_GET['returnid'])){ ?>
            if(window.opener){
            	window.opener.document.getElementById('<?php echo $returnid; ?>').focus();
                window.opener.document.getElementById('<?php echo $returnid; ?>').value=$url;
            }
        <?php 
			if (isset($_GET['func'])){
		?>
				if(window.opener){
					if(typeof window.opener.<?php echo $func; ?> == 'function') {
						window.opener.<?php echo $func; ?>('<?php echo $returnid; ?>');
					}
				}		
		<?php 
			}
		}
		 else { ?>
            if(window.opener){
                window.opener.CKEDITOR.tools.callFunction($funcNum, $url);
            }
        <?php } ?>
        window.close();
    }
	</script>
</head>
<body id="filebrowser" >	
 <div class="wrapper">
  <div id="maincontent">
	<div class="main" style="border:none;">
		<h3>Subida de Archivos<span id="filetypetoggle">&nbsp;&nbsp;/&nbsp;&nbsp;<?php echo ($type == 'images' ? 'IMAGES' : 'SHOW_ALL' ); ?></span></h3>
<?php
	$count="0";
	$dircount="0";
	$counter = "0";
	$totalsize = 0;
	$filesArray = array();
	$dirsArray = array();

  $filenames = getFiles($path);
  echo "array de archivos en: ".$path."<br>";
  print_r($filenames);
	if (count($filenames) != 0) { 
		foreach ($filenames as $file) {
      echo $file.'<br/>'.$count;
			if ($file == "." || $file == ".." || $file == ".htaccess" ){
			// not a upload file
			} elseif (is_dir($path . $file)) {
			  $dirsArray[$dircount]['name'] = $file;
			  $dircount++;
			} else {
				$filesArray[$count]['name'] = $file;
				$ext = substr($file, strrpos($file, '.') + 1);
				$extention = get_FileType($ext);
				$filesArray[$count]['type'] = $extention;
				clearstatcache();
				$ss = @stat($path . $file);
				$filesArray[$count]['date'] = @date('M j, Y',$ss['mtime']);
				$filesArray[$count]['size'] = fSize($ss['size']);
				$totalsize = $totalsize + $ss['size'];
				$count++;
			}
		}
		$filesSorted = subval_sort($filesArray,'name');
    $dirsSorted = subval_sort($dirsArray,'name');
    echo "<br>FilesSorted:";
    print_r($filesSorted);
    echo "<br>DirSorted:";
    print_r($dirsSorted);
	}

	$pathParts=explode("/",$subPath);
	$urlPath="";

	echo '<div class="h5">/ <a href="?CKEditorFuncNum='.$CKEditorFuncNum.'&amp;type='.$type.'">uploads</a> / ';
	foreach ($pathParts as $pathPart){
		if ($pathPart!=''){
			$urlPath.=$pathPart."/";
			echo '<a href="?path='.$urlPath.'&amp;CKEditorFuncNum='.$CKEditorFuncNum.'&amp;type='.$type.'&amp;func='.$func.'">'.$pathPart.'</a> / ';
		}
	}
	echo "</div>";

  echo '<table class="highlight" id="imageTable">';
  echo "<br>";
  print_r($dirsSorted);
  echo "Count dirsSorted: ".count($dirsSorted);
	if (count($dirsSorted) != 0) {       
		foreach ($dirsSorted as $upload) {
			echo '<tr class="All" >';  
			echo '<td class="" colspan="5">';
			$adm = substr($path . $upload['name'] ,  16); 
			if ($returnid!='') {
				$returnlink = '&returnid='.$returnid;
			} else {
				$returnlink='';
			}
			if ($func!='') {
				$funct = '&func='.$func;
			} else {
				$funct='';
			}
			echo '<img src="template/images/folder.png" width="11" /> <a href="filebrowser.php?path='.$adm.'&amp;CKEditorFuncNum='.$CKEditorFuncNum.'&amp;type='.$type.$returnlink.'&amp;'.$funct.'" title="'. $upload['name'] .'"  ><strong>'.$upload['name'].'</strong></a>';
			echo '</td>';
			echo '</tr>';
		}
	}

	if (count($filesSorted) != 0) {
		foreach ($filesSorted as $upload) {
      print_r($upload);
			$upload['name'] = rawurlencode($upload['name']);
      $thumb = null;
      $thumbnailLink = null;
			$subDir = ($subPath == '' ? '' : $subPath.'/');
      $selectLink = 'title="'.'SELECT_FILE'.': '. htmlspecialchars($upload['name']) .'" href="javascript:void(0)" onclick="submitLink('.$CKEditorFuncNum.',\''.$fullPath.$subDir.$upload['name'].'\')"';
      var_dump('Type: '.$type);
			if ($type == 'images') {
				if ($upload['type'] == 'Images') {
          $thumbLink = $urlPath.'/'.$upload['name'];
          ?>
          <div class="card mb-3" onclick="submitLink('<?=$fullPath.$upload['name']?>')">
            <div class="card-header"></div>
            <div class="card-img-top"><img src="<?=$thumbLink?>" class="crop rounded d-block" alt="" height="50"></div>
            <div class="card-title small text-truncate" style="max-width:150px"><?=$upload['name']?></div>
          </div>
          <?php
					# get internal thumbnail to show beside link in table
					$thumb = '<td class="imgthumb" style="display:table-cell" >';
          
          var_dump('thmbLink: '.$thumbLink); //
					if (file_exists('../images/uploads/'.$thumbLink)) {
						$imgSrc='<img src="../images/uploads/'. $thumbLink .'" />';
					} else {
						$imgSrc='<img src="inc/thumb.php?src='. $urlPath . $upload['name'] .'&amp;dest='. $thumbLink .'&amp;x=65&amp;f=1" />';
					}
					$thumb .= '<a '.$selectLink.' >'.$imgSrc.'</a>';
					$thumb .= '</td>';
					
					# get external thumbnail link
					$thumbLinkExternal = '../images/uploads/'.$urlPath.'thumbnail.'.$upload['name'];
					if (file_exists('../'.$thumbLinkExternal)) {
					$thumbnailLink = '<span>&nbsp;&ndash;&nbsp;&nbsp;</span><a href="javascript:void(0)" onclick="submitLink('.$CKEditorFuncNum.',\''.$sitepath.$thumbLinkExternal.'\')">'.i18n_r('THUMBNAIL').'</a>';
					}
				}
				else { 
          echo "no";
          continue; 
        }
			}

			$counter++;	

			echo '<tr class="All '.$upload['type'].'" >';
			echo ($thumb=='' ? '<td style="display: none"></td>' : $thumb);
			echo '<td><a '.$selectLink.' class="primarylink">'.htmlspecialchars($upload['name']) .'</a>'.$thumbnailLink.'</td>';
			echo '<td style="width:80px;text-align:right;" ><span>'. $upload['size'] .'</span></td>';

			// get the file permissions.
			if ($isUnixHost && function_exists('posix_getpwuid')) {
				$filePerms = substr(sprintf('%o', fileperms($path.$upload['name'])), -4);
				$fileOwner = posix_getpwuid(fileowner($path.$upload['name']));
				echo '<td style="width:70px;text-align:right;"><span>'.$fileOwner['name'].'/'.$filePerms.'</span></td>';
			}

			echo '<td style="width:85px;text-align:right;" ><span>'. shtDate($upload['date']) .'</span></td>';
			echo '</tr>';
		}

	}
	echo '</table>';
	echo '<p><em><b>'. $counter .'</b> '.'TOTAL_FILES'.' ('. fSize($totalsize) .')</em></p>';
?>	
	</div>
  </div>
 </div>	
</body>
</html>
