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