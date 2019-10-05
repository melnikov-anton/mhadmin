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

  public static function showErrorPage ($msg = MSG_404) {
    if($msg == MSG_404) {
      header("HTTP/1.1 404 Not Found");
    }
    require_once(ROOT . DS . 'app' . DS . 'pages' . DS . 'error_page.php');
    exit();
  }

  public static function showSuccessPage ($msg = 'Что-то завершилось успешно!') {
    require_once(ROOT . DS . 'app' . DS . 'pages' . DS . 'success_page.php');
    exit();
  }

  public static function redirectToSuccess($message = 'Что-то завершилось успешно!') {
    $_SESSION['success_msg'] = $message;
    header('Location: /home/success');
    exit();
  }

  public static function redirectToWrong($message = 'Что-то завершилось неудачно!') {
    $_SESSION['wrong_msg'] = $message;
    header('Location: /home/wrong');
    exit();
  }


}
