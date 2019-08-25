<?php

class User {

  public function loginAction() {
    //echo "User->loginAction";
    if($_SERVER['REQUEST_METHOD']=='POST') {
      $log = sanitize_log_array($_POST);

      $db = Db::getConnection();
      $res = $db->checkUser($log['username'], $log['password']);
      //var_dump($res);
        if($res) {
          echo $res['fname'] . " " . $res['lname'] . "</br>";
          echo "Usertype: " . $res['usertype'];
        } else echo "Имя пользователя или пароль не правильные!";
    }

  }

  public function registerAction() {
    //echo "User->registerAction" . "</br>";

    if($_SERVER['REQUEST_METHOD']=='POST') {
      $reg = sanitize_reg_array($_POST);
      //var_dump($reg);
    }
    UserModel::registerUser($reg);

  }

  public function accountAction() {

  }

}
