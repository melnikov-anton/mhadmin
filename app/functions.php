<?php


// транслитерация
function translit($stroka) {
  $converter = array(
'а' => 'a', 'б' => 'b', 'в' => 'v',
'г' => 'g', 'д' => 'd', 'е' => 'e',
'ё' => 'e', 'ж' => 'zh', 'з' => 'z',
'и' => 'i', 'й' => 'y', 'к' => 'k',
'л' => 'l', 'м' => 'm', 'н' => 'n',
'о' => 'o', 'п' => 'p', 'р' => 'r',
'с' => 's', 'т' => 't', 'у' => 'u',
'ф' => 'f', 'х' => 'kh', 'ц' => 'ts',
'ч' => 'ch', 'ш' => 'sh', 'щ' => 'shch',
'ь' => '', 'ы' => 'y', 'ъ' => '',
'э' => 'e', 'ю' => 'yu', 'я' => 'ya',
'А' => 'A', 'Б' => 'B', 'В' => 'V',
'Г' => 'G', 'Д' => 'D', 'Е' => 'E',
'Ё' => 'E', 'Ж' => 'Zh', 'З' => 'Z',
'И' => 'I', 'Й' => 'Y', 'К' => 'K',
'Л' => 'L', 'М' => 'M', 'Н' => 'N',
'О' => 'O', 'П' => 'P', 'Р' => 'R',
'С' => 'S', 'Т' => 'T', 'У' => 'U',
'Ф' => 'F', 'Х' => 'Kh', 'Ц' => 'Ts',
'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Shch',
'Ь' => '', 'Ы' => 'Y', 'Ъ' => '',
'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya',
);
 return strtr($stroka, $converter);
}

function print_data($data) {
  echo "<pre>";
  print_r($data);
  echo "</pre>";
}

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
    $reg['password'] = '1234'; //пароль, если произошла полная очистка
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
