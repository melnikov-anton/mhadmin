<?php

session_start();
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));

require_once(ROOT . DS . 'app' . DS . 'functions.php');


//-------------------------------------
echo 'Welcome to MHAdmin!!!</br>';
echo $_SERVER['PATH_INFO'] . '</br>';
echo $_SERVER['QUERY_STRING'] . '</br>';

if(isset($_SERVER['PATH_INFO'])) {
  $url=explode('/', $_SERVER['PATH_INFO']);
} else {
  $url=[];
}

var_dump($url);
echo "</br>";
echo translit('Прощай цыпочки цыплёнок');
echo "</br>";
echo create_username('Антон', 'Мельников');
