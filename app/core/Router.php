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
    
    $instance = new $controller();

    if(method_exists($instance, $action)) {
      call_user_func_array([$instance, $action], $urlParams);
    } else {
      die('Нет такого класса или метода');
    }

  }

}
