<?php

class Router {

  public static function route($url) {

    if(isset($url[0]) && $url[0] !== '') {
      $controller = ucwords($url[0]);
    } else {
      $controller = DEFAULT_CONTROLLER;
    }
    $controller_name = $controller;
    array_shift($url);

    if(isset($url[0]) && $url[0] !== '') {
      $action = $url[0] . 'Action';
    } else {
      $action = 'indexAction';
    }

    array_shift($url);

    $urlParams = $url;

    if(method_exists($controller, $action)) {
      $instance = new $controller();
      call_user_func_array([$instance, $action], $urlParams);
    } else {
        self::showErrorPage();
    }

  }

  public static function showErrorPage () {
    header("HTTP/1.1 404 Not Found");
    require_once(ROOT . DS . 'app' . DS . 'pages' . DS . 'error404.html');
    die();
  }

}
