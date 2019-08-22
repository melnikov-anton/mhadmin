<?php

class User {

  public function loginAction() {
    echo "User->loginAction";
    //нужно зачистить пользовательский ввод
    if($_SERVER['REQUEST_METHOD']=='POST') {
      $db = Db::getConnection();

      $res = $db->checkUser($_POST['username'], $_POST['password']);
      //var_dump($res);
        if($res) {
          echo $res['fname'] . " " . $res['lname'] . "</br>";
          echo "Usertype: " . $res['usertype'];
        } else echo "Имя пользователя или пароль не правильные!";
    }
  }

  public function registerAction() {
    echo "User->registerAction" . "</br>";
    if($_SERVER['REQUEST_METHOD']=='POST') {
      var_dump($_POST);
    }

  }

}
