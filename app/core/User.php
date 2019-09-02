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
        $_SESSION['success_msg'] = MSG_REG_SUC;
        header('Location: /home/success');
      } else {
        $_SESSION['wrong_msg'] = MSG_REG_ERR;
        header('Location: /home/wrong');
      }
    }
  }

  public function accountAction($arg1='', $arg2='', $arg3='') {
    if(isset($_SESSION['username'])) {

      require_once(ROOT . DS . 'app' . DS . 'pages' . DS . 'account_page.php');
    } else {
      header('Location: /');
    }
  }

  public function logoutAction() {
    if(isset($_SESSION['username'])) {
      //unset ($_SESSION['username']);
      //if(isset($_SESSION['id_user'])) {
        //unset ($_SESSION['id_user']);
      //}
      session_unset();
      header('Location: /');
    } else {
      header('Location: /');
      //echo "ERROR";
    }
  }

  public function createsiteAction($user_id) {
    if($_SERVER['REQUEST_METHOD']=='POST') {
      $site_input = sanitize_site_array($_POST);
      $db = Db::getConnection();
      if((int)$user_id != 0) {
        $user = UserModel::getUser($user_id);
        $site_data = $user->prepareSiteData($site_input);
      }
      //$res = $db->saveSiteInDb($site_data);
      if($db->saveSiteInDb($site_data)) {
        $_SESSION['success_msg'] = MSG_SITEREG_SUC;
        header('Location: /home/success');
      } else {
        $_SESSION['wrong_msg'] = MSG_SITEREG_ERR;
        header('Location: /home/wrong');
      }
    }

  }


}
