<?php

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

session_start();

//-------------------------------------
echo 'Wellcome to MHAdmin!!!</br>';
echo $_SERVER['PATH_INFO'] . '</br>';
echo $_SERVER['QUERY_STRING'] . '</br>';

if(isset($_SERVER['PATH_INFO'])) {
  $url=explode('/', $_SERVER['PATH_INFO']);
} else {
  $url=[];
}

//echo password_hash("antmel01", PASSWORD_BCRYPT);

$db = Db::getInstance(DB_NAME, DB_USER, DB_PASSWORD);
$ant = Db::getInstance('anton_db', 'anton', '123456');
$db2 = Db::getInstance('mhadmin_db', 'mhadmin', 'mhadmin');
$db3 = Db::getInstance('mhadmin_db', 'mhadmin', 'mhadmin');
$db4 = Db::getInstance('mhadmin_db', 'mhadmin', 'mhadmin');
$ant2 = Db::getInstance('anton_db', 'anton', '123456');
var_dump($db);
echo "</br>";
var_dump($ant);
echo "</br>";
var_dump($db2);
echo "</br>";
var_dump($db3);
