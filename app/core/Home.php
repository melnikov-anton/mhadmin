<?php

class Home {

  public function indexAction() {
    echo "Home";
    require_once(ROOT . DS . 'app' . DS . 'login_page.php');
  }

}
