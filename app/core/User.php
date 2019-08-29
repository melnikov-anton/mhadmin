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

  public function accountAction($arg1='', $arg2='') {
    if(isset($_SESSION['username'])) {
      require_once(ROOT . DS . 'app' . DS . 'pages' . DS . 'account_page.php');

    } else {
      header('Location: /');
    }
  }

  public function logoutAction() {
    if(isset($_SESSION['username'])) {
      unset ($_SESSION['username']);
      if(isset($_SESSION['id_user'])) {
        unset ($_SESSION['id_user']);
      }
      header('Location: /');
    } else {
      header('Location: /');
      //echo "ERROR";
    }
  }


}
