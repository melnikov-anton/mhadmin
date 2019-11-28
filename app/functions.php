<?php

//очистка массива с регистрационными данными
function sanitize_reg_array($reg_array = []) {
  $args = [
    'fname' => FILTER_SANITIZE_STRING,
    'lname' => FILTER_SANITIZE_STRING,
    'email' => FILTER_SANITIZE_EMAIL,
    'password' => FILTER_SANITIZE_STRING,
    'rep_pass'  => FILTER_SANITIZE_STRING,
    'rest'     => FILTER_SANITIZE_STRING
  ];
  $reg = filter_var_array($reg_array, $args, false);
  if($reg['password'] == '') {
    $reg['password'] = DEFAULT_USER_PASSWORD; //пароль, если произошла полная очистка
  }
  return $reg;
}

//очистка массива с входными данными
function sanitize_log_array($log_array = []) {
  $args = [
    'username' => FILTER_SANITIZE_STRING,
    'password' => FILTER_SANITIZE_STRING
  ];
  $log = filter_var_array($log_array, $args, false);
  return $log;
}

//очистка массива с данными о сайте
function sanitize_site_array($site_array = []) {
  $args = [
    'title' => FILTER_SANITIZE_STRING,
    'description' => FILTER_SANITIZE_STRING
  ];
  $site = filter_var_array($site_array, $args, false);
  return $site;
}
