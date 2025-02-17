<?php

require_once('../env.php');

if(defined('DEBUG') && constant('DEBUG') == true) {
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
} else {
  ini_set('display_errors', '0');
}

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__, 2));
define('WORK_ROOT', dirname(__FILE__, 3));
define('VHOSTS_DIR', ROOT . DS . 'vhosts');
define('ARCHIVE_DIR', ROOT . DS . 'archive');
define('PAGES_DIR', ROOT . DS . 'app' . DS . 'pages');

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

if(isset($_SERVER['PATH_INFO'])) {
  $url=explode('/', ltrim($_SERVER['PATH_INFO'], '/'));
} else {
  $url=[];
}

Router::route($url);
