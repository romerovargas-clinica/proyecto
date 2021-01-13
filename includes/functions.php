<?php
/* FUNCIONES DE UTILIDAD A UTILIZAR EN TODO EL SITE */

// traductor
function __($str, $lang = null){
  if(!isset($lang)):
    $lang = "es";
  endif;
  if (file_exists('lang/'.$lang.'.php')):
    include('lang/'.$lang.'.php');
    if ( isset($texts[$str]) ){
      $str = $texts[$str];
    }
  endif;
  return $str;
}

// funciones de encriptación
function session_encrypt($string) {
  $salt = "UnAfRaSePaRaAñAdIrAlAiDdEsEsIoN";
  return md5($salt . $string);
}

function rand_string() {
  $length = 26;
  return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
}

function labelToImage($label){
  // [IMG:8949566]
  $db = new DataBase(DB_SERVER, DB_USER, DB_PASS, DB_NAME, 1);
  $code = strstr($label,":");
  $code = substr($code, 1, 8);
  $recordset = $db->select("images","id = '$code'");
  $html = "<img alt='". $recordset[0]['alt']."' src='". $recordset[0]['src']."' style='". $recordset[0]['style']."' idunique='".$code."'>";
  return $html;
}

function getFiles($path) {
	$handle = opendir($path) or die("getFiles: Unable to open $path");
	$file_arr = array();
	while ($file = readdir($handle)) {
		if ($file != '.' && $file != '..') {
			$file_arr[] = $file;
		}
	}
	closedir($handle);
	return $file_arr;
}

function shtDate($dt) {
	//global $i18n;
	
	if (!$dt) {
		$data = date('DATE_FORMAT');
	} else {
		$data = date('DATE_FORMAT', strtotime($dt));
	}
	return $data;
}

function get_FileType($ext) {

	$ext = lowercase($ext);
	if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'pct' || $ext == 'gif' || $ext == 'bmp' || $ext == 'png' ) {
		return 'Images';
	} elseif ( $ext == 'zip' || $ext == 'gz' || $ext == 'rar' || $ext == 'tar' || $ext == 'z' || $ext == '7z' || $ext == 'pkg' ) {
		return 'FTYPE_COMPRESSED';
	} elseif ( $ext == 'ai' || $ext == 'psd' || $ext == 'eps' || $ext == 'dwg' || $ext == 'tif' || $ext == 'tiff' || $ext == 'svg' ) {
		return 'FTYPE_VECTOR';
	} elseif ( $ext == 'swf' || $ext == 'fla' ) {
		return 'FTYPE_FLASH';	
	} elseif ( $ext == 'mov' || $ext == 'mpg' || $ext == 'avi' || $ext == 'mpeg' || $ext == 'rm' || $ext == 'wmv' ) {
		return 'FTYPE_VIDEO';
	} elseif ( $ext == 'mp3' || $ext == 'wav' || $ext == 'wma' || $ext == 'midi' || $ext == 'mid' || $ext == 'm3u' || $ext == 'ra' || $ext == 'aif' ) {
		return 'FTYPE_AUDIO';
	} elseif ( $ext == 'php' || $ext == 'phps' || $ext == 'asp' || $ext == 'xml' || $ext == 'js' || $ext == 'jsp' || $ext == 'sql' || $ext == 'css' || $ext == 'htm' || $ext == 'html' || $ext == 'xhtml' || $ext == 'shtml' ) {
		return 'FTYPE_WEB';
	} elseif ( $ext == 'mdb' || $ext == 'accdb' || $ext == 'pdf' || $ext == 'xls' || $ext == 'xlsx' || $ext == 'csv' || $ext == 'tsv' || $ext == 'ppt' || $ext == 'pps' || $ext == 'pptx' || $ext == 'txt' || $ext == 'log' || $ext == 'dat' || $ext == 'text' || $ext == 'doc' || $ext == 'docx' || $ext == 'rtf' || $ext == 'wks' ) {
		return 'FTYPE_DOCUMENTS';
	} elseif ( $ext == 'exe' || $ext == 'msi' || $ext == 'bat' || $ext == 'download' || $ext == 'dll' || $ext == 'ini' || $ext == 'cab' || $ext == 'cfg' || $ext == 'reg' || $ext == 'cmd' || $ext == 'sys' ) {
		return 'FTYPE_SYSTEM';
	} else {
		return 'FTYPE_MISC';
	}
}

function http_protocol() {
	if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) {
	  return 'https';
	} else {
		return 'http';
	}
}

function suggest_site_path($parts=false, $protocolRelative = false) {
	global $GSADMIN;
	$protocol   = $protocolRelative ? '' : http_protocol().':';
	$path_parts = pathinfo(htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES));
	$path_parts = str_replace("/".$GSADMIN, "", $path_parts['dirname']);
	$port       = ($p=$_SERVER['SERVER_PORT'])!='80'&&$p!='443'?':'.$p:'';
	
	if($path_parts == '/') {
	
		$fullpath = $protocol."//". htmlentities($_SERVER['SERVER_NAME'], ENT_QUOTES) . $port . "/";
	
	} else {
		
		$fullpath = $protocol."//". htmlentities($_SERVER['SERVER_NAME'], ENT_QUOTES) . $port . $path_parts ."/";
		
	}
		
	if ($parts) {
		return $path_parts;
	} else {
		return $fullpath;
	}
}

function tsl($path) {
	if( substr($path, strlen($path) - 1) != '/' ) {
		$path .= '/';
	}
	return $path;
}

function lowercase($text) {
	if (function_exists('mb_strtolower')) {
		$text = mb_strtolower($text, 'UTF-8'); 
	} else {
		$text = strtolower($text); 
	}
	
	return $text;
}

function fSize($s) {
	$size = '<span>'. ceil(round(($s / 1024), 1)) .'</span> KB'; // in kb
	if ($s >= "1000000") {
		$size = '<span>'. round(($s / 1048576), 1) .'</span> MB'; // in mb
	}
	if ($s <= "999") {
		$size = '<span>&lt; 1</span> KB'; // in kb
	}
	
	return $size;
}

function subval_sort($a,$subkey, $order='asc',$natural = true) {
	if (count($a) != 0 || (!empty($a))) { 
		foreach($a as $k=>$v) {
			if(isset($v[$subkey])) $b[$k] = lowercase($v[$subkey]);
		}

		if(!isset($b)) return $a;

		if($natural){
			natsort($b);
			if($order=='desc') $b = array_reverse($b,true);	
		} 
		else {
			($order=='asc')? asort($b) : arsort($b);
		}
		
		foreach($b as $key=>$val) {
			$c[] = $a[$key];
		}

		return $c;
	}
}

function var_out($var,$filter = "special"){
	$var = (string)$var;

	// php 5.2 shim
	if(!defined('FILTER_SANITIZE_FULL_SPECIAL_CHARS')){
		define('FILTER_SANITIZE_FULL_SPECIAL_CHARS',522);
		if($filter == "full") return htmlspecialchars($var, ENT_QUOTES);
	}

	if(function_exists( "filter_var") ){
		$aryFilter = array(
			"string"  => FILTER_SANITIZE_STRING,
			"int"     => FILTER_SANITIZE_NUMBER_INT,
			"float"   => FILTER_SANITIZE_NUMBER_FLOAT,
			"url"     => FILTER_SANITIZE_URL,
			"email"   => FILTER_SANITIZE_EMAIL,
			"special" => FILTER_SANITIZE_SPECIAL_CHARS,
			"full"    => FILTER_SANITIZE_FULL_SPECIAL_CHARS
		);
		if(isset($aryFilter[$filter])) return filter_var( $var, $aryFilter[$filter]);
		return filter_var( $var, FILTER_SANITIZE_SPECIAL_CHARS);
	}
	else {
		return htmlentities($var);
	}
}

function validImageFilename($file){
	$image_exts = array('jpg','jpeg','gif','png');
	return in_array(getFileExtension($file),$image_exts);
}