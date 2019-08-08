<?php
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));

require_once(ROOT . DS . 'app' . DS . 'functions.php');

echo 'Welcome to MHAdmin!!!</br>';
echo $_SERVER['PATH_INFO'] . '</br>';
echo $_SERVER['QUERY_STRING'];
