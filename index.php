<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));

require_once(ROOT . DS . 'app' . DS . 'functions.php');
require_once(ROOT . DS . 'config' . DS . 'config.php');

// автозагрузка классов
function autoload($className) {
  if(file_exists(ROOT . DS . 'app' . DS . 'core' . DS . $className . '.php')) {
    require_once(ROOT . DS . 'app' . DS . 'core' . DS . $className . '.php');
  }
}

spl_autoload_register('autoload');
//-----------------------------------

Session::startSession();


//-------------------------------------
//echo 'Wellcome to MHAdmin!!!</br>';
//echo $_SERVER['PATH_INFO'] . '</br>';
//echo $_SERVER['QUERY_STRING'] . '</br>';

if(isset($_SERVER['PATH_INFO'])) {
  $url=explode('/', ltrim($_SERVER['PATH_INFO'], '/'));
} else {
  $url=[];
}

Router::route($url);

//echo password_hash("antmel01", PASSWORD_BCRYPT);

//echo password_hash("123456", PASSWORD_BCRYPT);
