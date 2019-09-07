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

  public function accountAction($arg1 = '', $arg2 = '', $arg3 = '') {

    if(isset($_SESSION['username'])) {
      $main_user = new UserModel($_SESSION['username']);
      $_SESSION['id_user'] = $main_user->getUserId();
      $perm = $main_user->getUserPermissions();
      if($main_user->isAdmin()) {
        define('USER_ROLE', 'admin');
        define('IS_ADMIN', true);
        $users_list = '';
      } else {
        define('USER_ROLE', 'user');
        define('IS_ADMIN', false);
      }
      $user = $main_user;

      if($arg1 == '') {
        $action = 'indexView';
      } else {$action = $arg1 . 'View';}

      if(method_exists('View', $action)) {
        $instance = new View();
        call_user_func_array([$instance, $action], [$arg2, $arg3]);
      }

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
    }
  }


  public function createsiteAction($user_id) {
    if($_SERVER['REQUEST_METHOD']=='POST') {
      $site_input = sanitize_site_array($_POST);
      $db = Db::getConnection();
      if((int)$user_id != 0) {
        $user = UserModel::getUser($user_id);
        //print_data($site_input);
        $site_data = $user->prepareSiteData($site_input);
      }
      //$res = $db->saveSiteInDb($site_data);
      if($db->saveSiteInDb($site_data)) {
        $this->createVirtualHost($site_data);
        exec('service apache2 reload');
        $_SESSION['success_msg'] = MSG_SITEREG_SUC;
        header('Location: /home/success');
      } else {
        $_SESSION['wrong_msg'] = MSG_SITEREG_ERR;
        header('Location: /home/wrong');
      }
    }
  }


  private function createVirtualHost($sd = []) {
    $site_dir = $sd['site_dir'];
    $site_name = $sd['site_name'];
    $admin_email = ADMIN_EMAIL;
    $wsgi_dir = WORK_ROOT . DS . $site_dir . DS .'wsgi';
    $log_dir = WORK_ROOT . DS . $site_dir . DS .'log';
    $site_conf_link = APACHE_SITES_ENABLED_DIR . DS . $site_name . '.conf';

    $vhost_temp_fn = ROOT . DS . 'config' . DS . VHOST_TEMPLATE_FILE;
    $site_conf_fn = ROOT . DS . 'config' . DS . 'sites-config' . DS . $site_name . '.conf';

    $site_conf_file = fopen($site_conf_fn, "w");
    $pattern = array('{SITE_DIR}', '{ADMIN_EMAIL}', '{SITE_NAME}');
    $replacement = array(WORK_ROOT . DS . $site_dir, $admin_email, $site_name);

    $vh_file = file($vhost_temp_fn, FILE_SKIP_EMPTY_LINES);
    foreach ($vh_file as $key => $line) {
      $vh_file[$key] = str_replace($pattern, $replacement, $line);

      fwrite($site_conf_file, $vh_file[$key]);
    }
    fclose($site_conf_file);

    if(!is_dir($wsgi_dir)) {
      mkdir($wsgi_dir, 0775, true);
    }
    if(!is_dir($log_dir)) {
      mkdir($log_dir, 0775, true);
    }
    chown($site_conf_fn, 33);
    chgrp($site_conf_fn, 33);
    chmod($site_conf_fn, 0664);
    if(!is_link($site_conf_link)) {
      symlink($site_conf_fn, $site_conf_link);
    }
  }


}
