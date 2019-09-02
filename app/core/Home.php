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


}
