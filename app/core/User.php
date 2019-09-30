<?php

class User {

  public function loginAction() {
    if($_SERVER['REQUEST_METHOD']=='POST') {
      $log = sanitize_log_array($_POST);

      $db = Db::getConnection();
      $res = $db->checkUser($log['username'], $log['password']);
      if($res) {
        $user = new UserModel($log['username']);
        $_SESSION['admin'] = $user->isAdmin();
        $_SESSION['username'] = $log['username'];

        header('Location: /user/account');
      } else {
          $_SESSION['wrong_msg'] = MSG_LOG_ERR;
          header('Location: /home/wrong');
          exit();
      }
    }

  }

  public function registerAction() {

    if($_SERVER['REQUEST_METHOD']=='POST') {
      if($_POST['password'] != $_POST['rep_pass']) {
        $_SESSION['wrong_msg'] = MSG_PASSNOTEVEN_ERR;
        header('Location: /home/wrong');
        exit();
      }
      $reg = sanitize_reg_array($_POST);
      if(UserModel::registerUser($reg)) {
        $_SESSION['success_msg'] = MSG_REG_SUC;
        header('Location: /home/success');
        exit();
      } else {
        $_SESSION['wrong_msg'] = MSG_REG_ERR;
        header('Location: /home/wrong');
        exit();
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
        $site_data = $user->prepareSiteData($site_input);
      }
      if($db->saveSiteInDb($site_data)) {
        $this->createVirtualHost($site_data);
        exec('service apache2 reload');
        $_SESSION['success_msg'] = MSG_SITEREG_SUC;
        header('Location: /home/success');
        exit();
      } else {
        $_SESSION['wrong_msg'] = MSG_SITEREG_ERR;
        header('Location: /home/wrong');
        exit();
      }
    }
  }

  public function deletesiteAction($site_id) {
    if($_SERVER['REQUEST_METHOD']=='POST') {
      $db = Db::getConnection();
      $sd = $db->getSiteDataById($site_id);
      $main_user = new UserModel($_SESSION['username']);
      $perm = $main_user->getUserPermissions();
      $check = $db->checkUser($_SESSION['username'], $_POST['password']);
      if($check) {
        if($_SESSION['admin'] || in_array($site_id, $perm['site'])) {
          $file_name = $sd['site_name'] . '.tar.gz';
          $archive_fn = ARCHIVE_DIR . DS . $file_name;
          $vhost_dir = VHOSTS_DIR . DS . $sd['site_dir'];
          $archive_script_command = ROOT . DS . 'shell' . DS . ARCHIVE_SITE_SCRIPT . ' ' . $archive_fn . ' ' . VHOSTS_DIR . ' ' . $sd['site_dir'];
          $delete_script_command = ROOT . DS . 'shell' . DS . DELETE_SITE_SCRIPT . ' ' . $vhost_dir;
          $output = [];
          exec($archive_script_command, $output, $ret);
          if($ret == 0) {
            exec($delete_script_command, $output, $ret);
            if($ret == 0) {
              $site_conf_fn = ROOT . DS . 'config' . DS . 'sites-config' . DS . $sd['site_name'] . '.conf';
              if(file_exists($site_conf_fn)) {
                unlink($site_conf_fn);
              }
              $res = $db->deleteSiteById($site_id);
              if($res) {
                $_SESSION['success_msg'] = MSG_DELETESITE_SUC;
                header('Location: /home/success');
              }
            }
          }
          //$_SESSION['wrong_msg'] = MSG_SITEDEL_ERR;
          //header('Location: /home/wrong');
        } else {
          $_SESSION['wrong_msg'] = MSG_RESTR_ERR;
          header('Location: /home/wrong');
          exit();
        }
      } else {
        $_SESSION['wrong_msg'] = MSG_RESTR_ERR;
        header('Location: /home/wrong');
        exit();
      }
    }
  }




  public function changeprofilAction($u_id) {
    if($_SERVER['REQUEST_METHOD']=='POST') {
      $dbc = Db::getConnection();
      $change_data = sanitize_reg_array($_POST);
      if(($u_id == $_SESSION['id_user']) || $_SESSION['admin']) {
        $check = $dbc->checkUser($_SESSION['username'], $change_data['password']);
      } else {
        $_SESSION['wrong_msg'] = MSG_RESTR_ERR;
        header('Location: /home/wrong');
        exit();
      }
      if($check) {
        $res = $dbc->changeUserData([$change_data['email'], $change_data['rest'], $u_id]);
        if($res) {
          $_SESSION['success_msg'] = MSG_CHANGE_SUC;
          header('Location: /home/success');
          exit();
        } else {
          $_SESSION['wrong_msg'] = MSG_DB_ERR;
          header('Location: /home/wrong');
          exit();
          }
      } else {
        $_SESSION['wrong_msg'] = MSG_USERINDB_ERR;
        header('Location: /home/wrong');
        exit();
      }
    }
  }


  public function changepasswordAction($u_id) {
    if($_SERVER['REQUEST_METHOD']=='POST') {
      if($_POST['new_pass'] != $_POST['rep_new_pass']) {
        $_SESSION['wrong_msg'] = MSG_PASSNOTEVEN_ERR;
        header('Location: /home/wrong');
        exit();
      }
      $dbc = Db::getConnection();
      if(($u_id == $_SESSION['id_user']) || $_SESSION['admin']) {
        $check = $dbc->checkUser($_SESSION['username'], $_POST['password']);
      } else {
        $_SESSION['wrong_msg'] = MSG_RESTR_ERR;
        header('Location: /home/wrong');
        exit();
      }
      if($check) {
        $new_passw = password_hash($_POST['new_pass'], PASSWORD_BCRYPT);
        $res = $dbc->changeUserPassword([$new_passw, $u_id]);
        if($res) {
          $_SESSION['success_msg'] = MSG_PASSCHANGE_SUC;
          header('Location: /home/success');
          exit();
        } else {
          $_SESSION['wrong_msg'] = MSG_DB_ERR;
          header('Location: /home/wrong');
          exit();
          }
        } else {
          $_SESSION['wrong_msg'] = MSG_LOG_ERR;
          header('Location: /home/wrong');
          exit();
        }
    }
  }

  public function changesiteAction($s_id) {
    if($_SERVER['REQUEST_METHOD']=='POST') {
      $dbc = Db::getConnection();
      $s_data = $dbc->getSiteDataById($s_id);
      $change_data = sanitize_site_array($_POST);
      if(($s_data['id_user'] == $_SESSION['id_user']) || $_SESSION['admin']) {
        $check = $dbc->checkUser($_SESSION['username'], $_POST['password']);
      } else {
        $_SESSION['wrong_msg'] = MSG_RESTR_ERR;
        header('Location: /home/wrong');
        exit();
      }
      if($check) {
        $res = $dbc->changeSiteData([$change_data['title'], $change_data['description'], $s_id]);
        if($res) {
          $_SESSION['success_msg'] = MSG_CHANGESITE_SUC;
          header('Location: /home/success');
          exit();
        } else {
          $_SESSION['wrong_msg'] = MSG_DB_ERR;
          header('Location: /home/wrong');
          exit();
          }
      } else {
        $_SESSION['wrong_msg'] = MSG_USERINDB_ERR;
        header('Location: /home/wrong');
        exit();
      }
    }
  }

  public function makeadminAction($user_id) {
    if($_SERVER['REQUEST_METHOD']=='POST') {
      $db = Db::getConnection();
      if($_SESSION['admin']) {
        $check = $db->checkUser($_SESSION['username'], $_POST['password']);
      } else {
        $_SESSION['wrong_msg'] = MSG_RESTR_ERR;
        header('Location: /home/wrong');
        exit();
      }
      if($check) {
        $res = $db->makeAdmin($user_id);
        if($res) {
          $_SESSION['success_msg'] = MSG_CHANGETYPE_SUC;
          header('Location: /home/success');
          exit();
        } else {
          $_SESSION['wrong_msg'] = MSG_USERINDB_ERR;
          header('Location: /home/wrong');
          exit();
        }
      } else {
        $_SESSION['wrong_msg'] = MSG_LOG_ERR;
        header('Location: /home/wrong');
        exit();
      }

    }
  }

  public function createdbAction($s_id, $u_id) {
    if($_SERVER['REQUEST_METHOD']=='POST') {
      $db = Db::getConnection();
      $main_user = new UserModel($_SESSION['username']);
      $perm = $main_user->getUserPermissions();
      $check = $db->checkUser($_SESSION['username'], $_POST['password']);
      if($check) {
          if($u_id == $perm['id'] && in_array($s_id, $perm['site'])) {
            $sd = $db->getSiteDataById($s_id);
            $site_index = explode('-', $sd['site_name'])[2];
            $db_name = $main_user->getUsername() . '_site_' . $site_index . '_db';
            $db_general = Db::getConnection('', DB_USER, DB_PASSWORD);

            $res = $db_general->createSitesDb($db_name, $_SESSION['username'], $_POST['password'], $s_id);
            if($res) {
              $_SESSION['success_msg'] = MSG_CREATEDB_SUC;
              header('Location: /home/success');
              exit();
            } else {
              $_SESSION['wrong_msg'] = MSG_DB_ERR;
              header('Location: /home/wrong');
              exit();
            }

          } else {
            $_SESSION['wrong_msg'] = MSG_RESTR_ERR;
            header('Location: /home/wrong');
            exit();
          }
        } else {
          $_SESSION['wrong_msg'] = MSG_RESTR_ERR;
          header('Location: /home/wrong');
          exit();
        }


    }

  }


  private function createVirtualHost($sd = []) {
    $site_dir = $sd['site_dir'];
    $site_name = $sd['site_name'];
    $admin_email = ADMIN_EMAIL;
    $wsgi_dir = VHOSTS_DIR . DS . $site_dir . DS .'wsgi';
    $log_dir = VHOSTS_DIR . DS . $site_dir . DS .'log';
    $site_conf_link = APACHE_SITES_ENABLED_DIR . DS . $site_name . '.conf';

    $vhost_temp_fn = ROOT . DS . 'config' . DS . VHOST_TEMPLATE_FILE;
    $site_conf_fn = ROOT . DS . 'config' . DS . 'sites-config' . DS . $site_name . '.conf';

    $site_conf_file = fopen($site_conf_fn, "w");
    $pattern = array('{SITE_DIR}', '{ADMIN_EMAIL}', '{SITE_NAME}');
    $replacement = array(VHOSTS_DIR . DS . $site_dir, $admin_email, $site_name);

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

public function testAction() {


}

}
