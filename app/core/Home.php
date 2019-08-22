<?php

class Home {

  public function indexAction() {
    require_once(ROOT . DS . 'app' . DS . 'pages' . DS . 'login_page.php');
  }

  public function regpageAction() {
    require_once(ROOT . DS . 'app' . DS . 'pages' . DS .'register_page.php');
  }

}
