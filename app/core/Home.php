<?php

class Home {

  public function indexAction() {
    setcookie("UserTest", "TestName", "/");
    require_once(ROOT . DS . 'app' . DS . 'pages' . DS . 'login_page.php');
  }

  public function regpageAction() {
    setcookie("UserTest", "", time()-10, "/");
    require_once(ROOT . DS . 'app' . DS . 'pages' . DS .'register_page.php');
  }

}
