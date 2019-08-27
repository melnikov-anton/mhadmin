<?php

class User {

  public function loginAction() {
    if($_SERVER['REQUEST_METHOD']=='POST') {
      $log = sanitize_log_array($_POST);

      $db = Db::getConnection();
      $res = $db->checkUser($log['username'], $log['password']);
      if($res) {
        $_SESSION['username'] = $log['username'];
        header('Location: /user/account');
      } else {
          $_SESSION['wrong_msg'] = MSG_LOG_ERR;
          header('Location: /home/wrong');
      }
    }

  }

  public function registerAction() {

    if($_SERVER['REQUEST_METHOD']=='POST') {
      $reg = sanitize_reg_array($_POST);
      if(UserModel::registerUser($reg)) {
        header('Location: /home/success');
      } else {
        $_SESSION['wrong_msg'] = MSG_REG_ERR;
        header('Location: /home/wrong');
      }
    }
  }

  public function accountAction() {
    if(isset($_SESSION['username'])) {
      $user = new UserModel($_SESSION['username']);
      print_data($user);

    } else {
      header('Location: /');
    }
  }



}
