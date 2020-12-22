<?php
session_start();

if (isset($_SESSION['lang'])){
    $lang = $_SESSION['lang'];
}else{
    $lang = null;
}

if(isset($_SESSION['dark'])):
  $dark = $_SESSION['dark'];
else:
  $dark = false;
endif;

function isAuthenticated() {
    if (isset($_SESSION['autentificado'])){
        return $_SESSION['autentificado'];
    } else return FALSE;    
}

function login($username, $password, $remember, $password_hashed = TRUE) {
  // Función que inicia sesión desde formulario login y cookies
  $db = new DataBase(DB_SERVER, DB_USER, DB_PASS, DB_NAME, 1);
  $passwd = $password_hashed ? md5($password) : $password;
  // Buscamos los datos name (o email) y lo comparamos con su pass
  $resultset = $db->select("users", "(nick = '" . $username . "' OR email = '".$username."') AND pass ='" . $passwd . "' AND enabled = 1");
  if (empty($resultset)) {
      return FALSE;
  } else {
      if ($remember) {
          // genera una nueva auth key en cada log in para que las viejas claves no pueden utilizarse varias veces
          // en caso de que "secuestren" la cookie
          $cookie_auth = rand_string() . $resultset[0]["name"];
          $auth_key = session_encrypt($cookie_auth);
          $anarray = array("auth_key" => $auth_key);
          $auth_query = $db->update("users", $anarray, "name = '" . $resultset[0]["name"] . "'");
          setcookie("auth_key", $auth_key, time() + 60 * 60 * 24 * 7, "/", null, FALSE, TRUE);            
      }
      session_regenerate_id(TRUE);
      $_SESSION['id'] = $resultset[0]["id"];
      $_SESSION['name'] = $resultset[0]["name"];
      $_SESSION['firstname'] = $resultset[0]["firstname"];
      $_SESSION['lastname'] = $resultset[0]["lastname"];            
      $_SESSION['email'] = $resultset[0]["email"];
      $_SESSION['auth_key'] = $resultset[0]["auth_key"];      
      $_SESSION['roles'] = $resultset[0]["roles"];      
      $_SESSION['lang'] = $resultset[0]["lang"];
      $_SESSION['autentificado'] = TRUE;
      $_SESSION['ultima_actividad_usuario'] = time();
      return TRUE;
  }
  $db->close();
}