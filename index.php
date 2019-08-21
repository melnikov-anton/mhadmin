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

session_start();

//-------------------------------------
echo 'Wellcome to MHAdmin!!!</br>';
//echo $_SERVER['PATH_INFO'] . '</br>';
//echo $_SERVER['QUERY_STRING'] . '</br>';

if(isset($_SERVER['PATH_INFO'])) {
  $rli=explode('/', ltrim($_SERVER['PATH_INFO'], '/'));
} else {
  $rli=[];
}

var_dump($rli);

Router::route($rli);

//echo password_hash("antmel01", PASSWORD_BCRYPT);
echo "</br>";
//echo password_hash("123456", PASSWORD_BCRYPT);

/*if($_SERVER['REQUEST_METHOD']=='POST') {
  $db = Db::getConnection();

  $res = $db->checkUser($_POST['username'], $_POST['password']);
  //var_dump($res);
    if($res) {
      echo $res['fname'] . " " . $res['lname'] . "</br>";
      echo "Usertype: " . $res['usertype'];
    } else echo "Имя пользователя или пароль не правильные!";
}*/
//var_dump($_POST);
//$db = Db::getConnection();
//$aa = $db->sqlQuery('SELECT fname, lname FROM users WHERE username= ?', ['antmel01']);
//$aa = $db->sqlQuery('SELECT * FROM users WHERE username= ? AND lname= ?', ['antmel01', 'Мельников']);
//$aa = $db->sqlQuery("SELECT ?, ? FROM users", ['fname', 'lname']);
//$aa = $db->sqlQuery("SELECT fname, lname FROM users");
//var_dump($aa);

//$sq = 'INSERT INTO users (fname, lname, username, password) VALUES (?, ?, ?, ?)';
//$par = ['Петр', 'Васечкин', create_username('Петр', 'Васечкин'), password_hash("123456", PASSWORD_BCRYPT)];
//$b = $db->sqlQuery($sq, $par);
//var_dump($b);
/*$uData = [
  'fname' => 'Иван',
  'lname' => 'Сидоров',
  'username' => 'ivasid25',
  'password' => password_hash("123456", PASSWORD_BCRYPT)
];
$ins = $db->saveUserInDb($uData);
var_dump($ins);*/
