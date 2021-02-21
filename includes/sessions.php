<?php
session_start();

if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];
    $_SESSION['lang'] = $lang;
}

if (isset($_SESSION['lang'])) {
    $lang = $_SESSION['lang'];
} else {
    $lang = null;
}

if (isset($_SESSION['dark'])) :
    $dark = $_SESSION['dark'];
else :
    $dark = false;
endif;

function isAuthenticated()
{
    if (isset($_SESSION['autentificado'])) {
        return $_SESSION['autentificado'];
    } else return FALSE;
}

if (!isset($lang)) :
    $lang = "es";
endif;

function login($username, $password, $remember, $password_hashed = TRUE)
{
    // Función que inicia sesión desde el formulario de login o desde las cookies
    $db = new DataBase(DB_SERVER, DB_USER, DB_PASS, DB_NAME, 1);
    $passwd = $password_hashed ? md5($password) : $password;
    // Buscamos los datos name (o email) y lo comparamos con su pass
    $resultset = $db->select("users", "(name = '" . $username . "' OR email = '" . $username . "') AND pass ='" . $passwd . "' AND enabled = 1");
    if (empty($resultset)) {
        return FALSE;
    } else {
        $auth_key = $resultset[0]["auth_key"];
        if ($remember) {
            // genera una nueva auth key en cada log in para que las viejas claves no pueden utilizarse varias veces
            // en caso de que "secuestren" la cookie
            $cookie_auth = rand_string() . $resultset[0]["name"];
            $auth_key = session_encrypt($cookie_auth);
            $anarray = array();
            $anarray["auth_key"] = $auth_key;
            $auth_query = $db->update("users", $anarray, "name = '" . $resultset[0]["name"] . "'");
            setcookie("auth_key", $auth_key, time() + 60 * 60 * 24 * 30, "/", null, FALSE, TRUE);
        }
        session_regenerate_id(TRUE);
        $_SESSION['id'] = $resultset[0]["id"];
        $_SESSION['name'] = $resultset[0]["name"];
        $_SESSION['firstname'] = $resultset[0]["firstname"];
        $_SESSION['lastname'] = $resultset[0]["lastname"];
        $_SESSION['email'] = $resultset[0]["email"];
        $_SESSION['auth_key'] = $auth_key;
        $_SESSION['roles'] = $resultset[0]["roles"];
        $_SESSION['lang'] = $resultset[0]["lang"];
        $_SESSION['autentificado'] = TRUE;
        $_SESSION['ultima_actividad_usuario'] = time();
        return TRUE;
    }
    $db->close();
}

function logout()
{
    // Es necesario borrar la auth key de la base de datos de modo que la cookie deje ser válida
    if (isset($_SESSION['name'])) {
        $name = $_SESSION['name'];
        setcookie("auth_key", "", time() - 3600);
        $db = new DataBase(DB_SERVER, DB_USER, DB_PASS, DB_NAME, 1);
        $anarray = array("auth_key" => "");
        $auth_query = $db->update("users", $anarray, "name = '" . $name . "'");
        // If auth key is deleted from database proceed to unset all session variables
    } else $auth_query = FALSE;
    session_unset();
    session_destroy();
    if ($auth_query) {
        return TRUE;
    } else {
        return FALSE;
    }
    $db->close();
}

function initiate()
{
    $logged_in = FALSE;
    if (isAuthenticated()) {
        $logged_in = TRUE;
    }
    // Hay cookie definida?    
    if (isset($_COOKIE['auth_key'])) {
        $auth_key = $_COOKIE['auth_key'];
        if ($logged_in === FALSE) {
            // selecciona usuario de la base de datos cuya auth key coincida (las auth keys son únicas)            
            $db = new DataBase(DB_SERVER, DB_USER, DB_PASS, DB_NAME, 1);
            $resultset = $db->select("users", "auth_key ='" . $auth_key . "' AND enabled = 1");
            if (empty($resultset)) {
                // si la clave no pertenece a ningún usuario borra cookie
                setcookie("auth_key", "", time() - 3600);
            } else {
                // adelante con el login
                login($resultset[0]['name'], $resultset[0]['pass'], TRUE, FALSE);
            }
            $db->close();
        }
    } else {
        setcookie("auth_key", "", time() - 3600);
    }
}
