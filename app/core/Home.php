<?php

class Home {

  public function indexAction() {
    if(isset($_SESSION['username'])) {
      header('Location: /user/account');
    } else {
      header('Location: /home/logpage');
    }
  }

  public function logpageAction() {
    require_once(ROOT . DS . 'app' . DS . 'pages' . DS . 'login_page.php');
  }

  public function regpageAction() {
    require_once(ROOT . DS . 'app' . DS . 'pages' . DS .'register_page.php');
  }

  public function wrongAction() {
    if(isset($_SESSION['wrong_msg'])) {
      Router::showErrorPage($_SESSION['wrong_msg']);
    } else {
      Router::showErrorPage();
    }
  }

  public function successAction() {
    if(isset($_SESSION['success_msg'])) {
    Router::showSuccessPage($_SESSION['success_msg']);
    } else {
      Router::showSuccessPage();
    }
  }

  public function testAction() {
    $site_dir = 'vaspup97/site_1';
    $site_name = 'vaspup97-site-1';
    $admin_email = 'admin@mhadmin.ru';
    $wsgi_dir = WORK_ROOT . DS . $site_dir . DS .'wsgi';
    $log_dir = WORK_ROOT . DS . $site_dir . DS .'log';
    $site_conf_link = APACHE_SITES_ENABLED_DIR . DS . $site_name . '.conf';

    $vhost_temp_fn = ROOT . DS . 'config' . DS . 'vhost_template.conf';
    $site_conf_fn = ROOT . DS . 'config' . DS . 'sites-config' . DS . $site_name . '.conf';

    $site_conf_file = fopen($site_conf_fn, "w");
    $pattern = array('{SITE_DIR}', '{ADMIN_EMAIL}', '{SITE_NAME}');
    $replacement = array(WORK_ROOT . DS . $site_dir, $admin_email, $site_name);
    //echo $vhost_temp_fn;
    $vh_file = file($vhost_temp_fn, FILE_SKIP_EMPTY_LINES);
    foreach ($vh_file as $key => $line) {
      $vh_file[$key] = str_replace($pattern, $replacement, $line);
      //print_data($line);
      fwrite($site_conf_file, $vh_file[$key]);
    }
    fclose($site_conf_file);
    //print_data($vh_file);
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

    $stat = stat($site_conf_fn);
    print_r(posix_getpwuid($stat['uid']));


  }

}
